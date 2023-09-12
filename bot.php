<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once __DIR__ . '/local/vendor/autoload.php';

define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/log.txt");
define('TOKEN' , '6379758770:AAHlkKBMcF6ugcV5fNn-9hqVSuaNdzXu7p4');
define('HL_USER',10);
define('ADMIN', 566824642);

use TelegramBot\Api\Client;

$botToken = TOKEN;
$bot = new Client(TOKEN);

$bot->on(function($update) use ($bot) {
    $message = $update->getMessage();
    $messageId = $message->getMessageId();
    $chatId = $message->getChat()->getId();
    $text = $message->getText();
    $date = $message->getDate();
    $userId = $message->getFrom()->getId();
    $text = cleanUserInput($text);
    $firstName = $message->getFrom()->getFirstName();
    $lastName = $message->getFrom()->getLastName();
    $lastMessage = getLastUserMessageText($userId);

    if(!empty($lastMessage)){
        switch ($lastMessage) {
            case 'добавить событие' :
                add_event($userId, $firstName, $lastName, $text);
                //$bot->sendMessage($chatId,'событие добавлено, добавить еще одно?');
                $messageText = 'событие добавлено, нажми что бы добавить еще?';
                $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(array(array("добавить событие")), true, true); // true for one-time keyboard
                $r = $bot->sendMessage($chatId, $messageText, null, false, null, $keyboard);
                break;
            default :
                break;
        }
    }

    if($chatId == ADMIN && $text == 'уведомление1'){
        $userIds = getAllUsersID();

        $messageText = 'Привет, не хочешь добавить немного событий по Феско?';
        bot_agent();

//        foreach ($userIds as $userId) {
//
//            $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(array(array("добавить событие")), true, true); // true for one-time keyboard
//            $r = $bot->sendMessage($userId, $messageText, null, false, null, $keyboard);
//        }
    }

    if(!empty($text)){
        message_Update2($userId, $messageId, $text);
        switch ($text) {
            case '/start':
                $messageText = 'День добрый! я помогу сохранить все задачи по Феско!
Для этого нажми "добавить событие", после чего расскажи что получилось сделать, поставь знак $ и напиши сколько минут это заняло. 
Вот пример "редактирование карты новый Яньтянь - Новороссийск $ 15" 
или можешь указать полное время $ 02:17:23
по умолчанию будет указан текущий месяц, если хочешь указать другой, после времени укажи месяц:
"редактирование карты Новороссийск-Москва $ 15 $ март"';

                user_update($userId, $firstName, $lastName );
                $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(array(array("добавить событие")), true, true); // true for one-time keyboard
                $r = $bot->sendMessage($chatId, $messageText, null, false, null, $keyboard);
                file_put_contents(__DIR__ . '/mess_bot_lib.txt', print_r($r, true));
                break;

            case 'привет':
                $bot->sendMessage($chatId,'привет');
                //$bot->sendMessage($chatId,$lastMessage);
                //addBitrixAgentForTelegramMessage();
                break;

            default:

                //$bot->sendMessage($chatId,'не понимаю о чем речь');
                //$bot->sendMessage($chatId, 'твое предыдущее сообщение ' . $lastMessage);

                break;
        }

    }

    //$lastMessage = $text;
}, function($update) {
    return true;
});

$bot->run();

function cleanUserInput($input) {
    // List of characters to remove
    $remove_chars = array("~", "`", "#",  "%", "^", "&", "*", "(", ")", "=", "+", "[", "{", "]", "}", "\\", "|", ";",  "\"", "'", "&#39;", "<", ">", " ");

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

function message_Update2($userId, $messageId, $text){

    //$sdate = date("d-m-Y H:i:s", $date);

    $HLblockID = 12;
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
            "UF_USER_ID" => $userId,
            "UF_MESSAGE_ID" => $messageId,
            "UF_MESSAGE_TEXT" => $text,
            //"UF_MESSAGE_DATE" => $sdate
        ));
    } else {
        // Insert a new row
        $result = $entity_data_class::add(array(
            "UF_USER_ID" => $userId,
            "UF_MESSAGE_ID" => $messageId,
            "UF_MESSAGE_TEXT" => $text,
            //"UF_MESSAGE_DATE" => $sdate
        ));

        if (!$result->isSuccess()) {
            throw new Exception("Failed to add new row to highloadblock table");
        }
    }
}

function getLastUserMessageText($userId) {
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

function user_update($userId, $firstName, $lastName ){

    $HLblockID = 10;
    $entity_data_class = GetEntityDataClass($HLblockID);
    // Try to find an existing row for this user
    $row = $entity_data_class::getList(array(
        "select" => array("*"),
        "filter" => array("UF_TELEGA_ID" => $userId)
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

function add_event($userId, $firstName, $lastName, $text){
    $delimiter = '$';
    $mass_text = explode($delimiter, $text);

    if(!empty($mass_text[1])){
        $t = str_replace(" ","",$mass_text[1]);
        $e = formatMinutes($t);
        $mass_text[1] = $e;
    }
    if(empty($mass_text[2])){
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
        "UF_TASK_DESCRIPTION" => !empty($mass_text[0]) ? $mass_text[0] : 'задача не описана' ,
        "UF_TASK_TIME" => !empty($mass_text[1]) ? $mass_text[1] : 'время не указано',
        "UF_TASKS_MONTH" => !empty($mass_text[2]) ? $mass_text[2] : 'месяц не указан',
    ));

    if (!$result->isSuccess()) {
        throw new Exception("Failed to add new row to highloadblock table");
    }
}

function getAllUsersID(){
    $HLblockID = 10;
    $entity_data_class = GetEntityDataClass($HLblockID);

    // Get all user ids
    $userIds = array();
    $rows = $entity_data_class::getList(array(
        "select" => array("UF_TELEGA_ID"),
    ));

    while ($row = $rows->fetch()) {
        $userIds[] = $row['UF_TELEGA_ID'];
    }
    return $userIds;
}

function formatMinutes($minutes) {
    if (!is_numeric($minutes) || $minutes < 0 || $minutes > 1440) {
        // Return an error string if the input is not a valid number of minutes
        return $minutes;
    }

    $seconds = $minutes * 60;
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds / 60) % 60);
    $seconds = $seconds % 60;

    return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
}

function bot_agent(){
    $userIds = getAllUsersID();
    //$userIds = [566824642];
    // Define the Telegram bot token and chat ID
    $bot_token = '6144021597:AAF9jN9hqPcWaprOPjGBolZ2hLqASqPEfgQ';

// Define the message text and the button
    $message_text = 'Привет, не хочешь добавить немного событий по Феско?';
    $button_text = 'добавить событие';

    foreach ($userIds as $userId) {
        // Build the cURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot{$bot_token}/sendMessage");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
            "chat_id" => $userId,
            "text" => $message_text,
            "reply_markup" => json_encode(array(
                "keyboard" => array(
                    array($button_text)
                ),
                "one_time_keyboard" => true,
                "resize_keyboard" => true
            ))
        )));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL request and get the response
        $response = curl_exec($ch);
        curl_close($ch);

// Output the response (for debugging purposes)
        var_dump($response);

    }
    return bot_agent();
}






