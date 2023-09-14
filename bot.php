<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once __DIR__ . '/local/vendor/autoload.php';

define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/log.txt");
define('TOKEN', '6379758770:AAHlkKBMcF6ugcV5fNn-9hqVSuaNdzXu7p4');
define('HL_USER', 1); //номер блока в битриксе
define('HL_CHAT', 2);
define('ADMIN', 566824642);

use TelegramBot\Api\Client;

$botToken = TOKEN;
$bot = new Client(TOKEN);

$bot->on(function ($update) use ($bot) {
    $message = $update->getMessage();
    $messageId = $message->getMessageId();
    $chatId = $message->getChat()->getId();
    $text = strtolower($message->getText());
    $date = $message->getDate();
    $userId = $message->getFrom()->getId();
    $firstName = $message->getFrom()->getFirstName();
    $lastName = $message->getFrom()->getLastName();
    $userPnoheNumber = $message->getContact()->getPhoneNumber();

    if (!empty($text)) {
        SetChatHistory($userId, $firstName, $lastName, $messageId, $text);
        switch ($text) {
            case '/start':
                $messageText = 'День добрый! Я бот который помогает оплатить и получить заказ.';
                UserUpdateInfo($userId, $firstName, $lastName);
                $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(array(array("оплатить заказ")), true, true); // true for one-time keyboard
                $bot->sendMessage($chatId, $messageText, null, false, null, $keyboard);
                MessageGetUserPhoneNumber(TOKEN, $chatId);
                break;

            case 'привет':
                $bot->sendMessage($chatId, 'привет');

                break;

            default:

                $bot->sendMessage($chatId, 'не понимаю о чем речь');

                break;
        }
    }
}, function ($update) {
    return true;
});
$bot->run();

function cleanUserInput($input)
{
    // List of characters to remove
    $remove_chars = array("~", "`", "#", "%", "^", "&", "*", "(", ")", "=", "+", "[", "{", "]", "}", "\\", "|", ";", "\"", "'", "&#39;", "<", ">", " ");

    // Remove unwanted characters
    $clean_input = str_replace($remove_chars, " ", $input);

    // Trim whitespace and remove forward slash
    //$clean_input = trim($clean_input, " /");

    // Return cleaned input
    return $clean_input;
}

function GetEntityDataClass($HlBlockId)
{
    if (empty($HlBlockId) || $HlBlockId < 1) {
        return false;
    }
    //подключаем модуль highloadblock
    CModule::IncludeModule('highloadblock');
    $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById($HlBlockId)->fetch();
    $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    return $entity_data_class;
}

//записывает каждое сообщение пользователя
function SetChatHistory($userId, $firstName, $lastName, $messageId, $text)
{
    $HLblockID = HL_CHAT;
    $entity_data_class = GetEntityDataClass($HLblockID);
    $result = $entity_data_class::add(array(
        "UF_USER_ID" => $userId,
        "UF_USER_FIRST_NAME" => $firstName,
        "UF_USER_LAST_NAME" => $lastName,
        "UF_MESSAGE_ID" => $messageId,
        "UF_MESSAGE_TEXT" => $text,
    ));
    if (!$result->isSuccess()) {
        throw new Exception("Failed to add new row to highloadblock table");
    }
}

function MessageGetUserPhoneNumber($bot_token, $chat_id)
{
    $message_text = 'Прошу предоставить номер телефона.';
    $keyboard = [
        'keyboard' => [
            [
                [
                    'text' => 'Поделиться номером телефона',
                    'request_contact' => true, // This requests the user's phone number
                ],
            ],
        ],
        'resize_keyboard' => true,
    ];

    $reply_markup = json_encode($keyboard);

    $ch = curl_init();
    $ch_post = [
        CURLOPT_URL => 'https://api.telegram.org/bot' . $bot_token . '/sendMessage',
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_POSTFIELDS => [
            'chat_id' => $chat_id,
            'parse_mode' => 'HTML',
            'text' => $message_text,
            'reply_markup' => $reply_markup,
        ]
    ];

    curl_setopt_array($ch, $ch_post);
    curl_exec($ch);
}

function getLastUserMessageText($userId)
{
    $res = null;
    $HLblockID = 12;
    $entity_data_class = GetEntityDataClass($HLblockID);
    $query = new \Bitrix\Main\Entity\Query($entity_data_class::getEntity());
    $query->setSelect(array('*'));
    $query->setFilter(array("UF_USER_ID" => $userId));

    try {
        $result = $query->exec();
        while ($element = $result->fetch()) {
            $res = $element["UF_MESSAGE_TEXT"];
        }
    } catch (\Exception $e) {
        // Handle the exception here
        error_log("Error executing query: " . $e->getMessage());
        return false;
    }
    return $res;
}

function UserUpdateInfo($userId, $firstName, $lastName)
{
    $HLblockID = HL_USER;
    $entity_data_class = GetEntityDataClass($HLblockID);
    // Try to find an existing row for this user
    $row = $entity_data_class::getList(array(
        "select" => array("*"),
        "filter" => array("UF_USER_ID" => $userId)
    ))->fetch();
    if ($row) {
        // Update the existing row
        $rowId = $row["ID"];
        $entity_data_class::update($rowId, array(
            "UF_TELEGA_ID" => $userId,
            "UF_FIRST_NAME" => $firstName,
            "UF_LAST_NAME" => $lastName));
    } else {
        // Insert a new row
        $result = $entity_data_class::add(array(
            "UF_TELEGA_ID" => $userId,
            "UF_FIRST_NAME" => $firstName,
            "UF_LAST_NAME" => $lastName));

        if (!$result->isSuccess()) {
            throw new Exception("Failed to add new row to highloadblock table");
        }
    }
}

function add_event($userId, $firstName, $lastName, $text)
{
    $delimiter = '$';
    $mass_text = explode($delimiter, $text);

    if (!empty($mass_text[1])) {
        $t = str_replace(" ", "", $mass_text[1]);
        $e = formatMinutes($t);
        $mass_text[1] = $e;
    }
    if (empty($mass_text[2])) {
        setlocale(LC_TIME, 'ru_RU.utf8');

        // Get the current month in Russian
        $currentMonth = strftime('%B');

        $mass_text[2] = $currentMonth;
    }

    //$sdate = date("d-m-Y H:i:s", $date);

    $HLblockID = 11;
    $entity_data_class = GetEntityDataClass($HLblockID);
    // Try to find an existing row for this user


    // Insert a new row
    $result = $entity_data_class::add(array(
        "UF_TELEGA_ID" => $userId,
        "UF_FIRST_NAME" => $firstName,
        "UF_LAST_NAME" => $lastName,
        "UF_TASK_DESCRIPTION" => !empty($mass_text[0]) ? $mass_text[0] : 'задача не описана',
        "UF_TASK_TIME" => !empty($mass_text[1]) ? $mass_text[1] : 'время не указано',
        "UF_TASKS_MONTH" => !empty($mass_text[2]) ? $mass_text[2] : 'месяц не указан',
    ));

    if (!$result->isSuccess()) {
        throw new Exception("Failed to add new row to highloadblock table");
    }
}









