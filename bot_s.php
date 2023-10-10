<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once __DIR__ . '/local/vendor/autoload.php';

define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/log.txt");
define('TOKEN', '6144021597:AAF9jN9hqPcWaprOPjGBolZ2hLqASqPEfgQ');
define('HL_USER', 15);
define('HL_CHAT', 14);
define('ADMIN', 566824642);
define('ACCSESS_CODE', 566824642);

use TelegramBot\Api\Client;

$botToken = TOKEN;
$bot = new Client('6144021597:AAF9jN9hqPcWaprOPjGBolZ2hLqASqPEfgQ');

$bot->on(function ($update) use ($bot) {
    $message = $update->getMessage();
    $messageId = $message->getMessageId();
    $chatId = $message->getChat()->getId();
    $text = $message->getText();
    $dateTime = date("d.m.Y H:i:s",$message->getDate());
    $userId = $message->getFrom()->getId();
    $firstName = $message->getFrom()->getFirstName();
    $lastName = $message->getFrom()->getLastName();

    $lastMessage = getLastMessage($userId);
    $bot->sendMessage($chatId, 'ты писал ранее '.$lastMessage);
    addChatHistory($userId, $firstName, $lastName, $text, $messageId, $dateTime);


    switch ($text){
        case 'привет':
            $bot->sendMessage($chatId, 'и тебе привет ');
            break;

        case 'добавить событие':
            $bot->sendMessage($chatId, 'опиши событие'."и я его добавлю");

        default:

            break;


    }





}, function ($update) {
    return true;
});

$bot->run();

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

function getLastMessage($userId){
    $HLblockID = HL_CHAT;
    $entity_data_class = GetEntityDataClass($HLblockID);
    // Get the UF_MESSAGE_ID of the last message for the selected user
    $row = $entity_data_class::getList(array(
        "select" => array("UF_MESSAGE_ID", "UF_USER_MESSAGE_TEXT"),
        "filter" => array("UF_USER_ID" => $userId),
        "order" => array("UF_MESSAGE_ID" => "DESC"), // Order by UF_MESSAGE_ID in descending order to get the latest message first
        "limit" => 1, // Limit the result to one row, which is the latest message
    ))->fetch();
    if ($row) {
        return $row['UF_USER_MESSAGE_TEXT']; // Return the text of the last message
    } else {
        return false; // User not found or no messages for the user
    }
}

function addChatHistory($userId, $firstName, $lastName, $text, $messageId, $dateTime)
{
    $HLblockID = HL_CHAT;
    $entity_data_class = GetEntityDataClass($HLblockID);
    // Insert a new row
    $result = $entity_data_class::add(array(
        "UF_USER_ID" => $userId,
        "UF_USER_FIRST_NAME" => $firstName,
        "UF_USER_LAST_NAME" => $lastName,
        "UF_USER_MESSAGE_TEXT" => $text,
        "UF_MESSAGE_ID" => $messageId,
        "UF_USER_MESSAGE_TIME" => $dateTime));
    if (!$result->isSuccess()) {
        throw new Exception("Failed to add new row to highloadblock table");
    }
}

function setUser($userId, $firstName, $lastName)
{
    $HLblockID = HL_USER;
    $entity_data_class = GetEntityDataClass($HLblockID);
    // Insert a new row
    $result = $entity_data_class::add(array(
        "UF_USER_ID" => $userId,
        "UF_FIRST_NAME" => $firstName,
        "UF_LAST_NAME" => $lastName));

    if (!$result->isSuccess()) {
        throw new Exception("Failed to add new row to highloadblock table");
    }
}

function getUser($userId)
{
    $result = false;
    $HLblockID = HL_USER;
    $entity_data_class = GetEntityDataClass($HLblockID);
    // Try to find an existing row for this user
    $row = $entity_data_class::getList(array(
        "select" => array("*"),
        "filter" => array("UF_USER_ID" => $userId)
    ))->fetch();
    if ($row == $userId) {
        return true;
    } else {
        if (!$result->isSuccess()) {
            throw new Exception("Failed to add new row to highloadblock table");

        }
    }
}




