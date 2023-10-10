<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once __DIR__ . '/local/vendor/autoload.php';

use Bitrix\Main\Loader;
use Pvgroup\Cart\OrderTable;


// Подставьте корректное пространство имен вашего модуля

// Подключите модуль вашего модуля
$moduleId = 'pvgroup.cart';
if (!Loader::includeModule($moduleId)) {
    die('Module ' . $moduleId . ' not installed!');
}

$server_path = 'https://stavbim.ru/download/';

define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/log.txt");
define('TOKEN', '6379758770:AAHlkKBMcF6ugcV5fNn-9hqVSuaNdzXu7p4');
define('HL_USER', 1);
define('HL_CHAT', 2);
define('ADMIN', 566824642);

$data = json_decode(file_get_contents('php://input'), TRUE);
$data = $data['callback_query'] ? $data['callback_query'] : $data['message'];
file_put_contents(__DIR__ . '/messageBot.txt', print_r($data, true));
if (!empty($data)) {
    $message_id = $data['message_id'];
    $chat_id = $data['chat']['id'];
    $user_id = $data['from']['id'];
    $user_name = $data['from']['username'];
    $phone_number = $data['contact']['phone_number'];
    $first_name = $data['from']['first_name'];
    $last_name = $data['from']['last_name'];
    $chat_date = $data['chat']['date'];
    $text = mb_strtolower(($data['text']), 'utf-8');
    $reply_massage = $data['reply_to_message']['text'];
    $text_array = explode(" ", $text);
    $callback = $data['data'];
    $dateTime = date("d.m.Y H:i:s", $data['date']);
}

$last_message = getLastMessage($user_id);
addChatHistory($user_id, $first_name, $last_name, $text, $message_id, $dateTime);

if (isset($data['photo'])) {
    sendMessage($user_id, 'Вы отправили чек, после подтверждения оплаты вам будет направлен заказ.');
    // If a photo is sent, save it
    $latest_photo = end($data['photo']); // Get the last photo in the array
    $photo_file_id = $latest_photo['file_id'];
    $file_name = $data['document']['file_name'];
    $saved_document_path = savePhoto($user_id, $photo_file_id, $file_name, $dateTime);
    // Now $saved_photo_path contains the path to the saved photo
    $method = 'sendPhoto';
    $send_data = [
        'photo' => $server_path . $saved_document_path,
        'caption' => 'Клиент ' . $first_name . " " . $last_name . ' с ником ' . $user_name . ' прислал чек. ',
//        'reply_markup' => [
//            'inline_keyboard' => [
//                [
//                    [
//                        'text' => 'текущие заказы клиента ' . $first_name . " " . $last_name,
//                        'callback_data' => $user_id
//                    ],
//
//                ]
//            ]
//        ]
    ];
    $send_data['chat_id'] = ADMIN;
    $res = sendToTelegram1537($method, $send_data);
    sendOrdersAdmin($user_id, $first_name, $last_name, $user_name);

} else if (isset($data['document'])) {
    sendMessage($user_id, 'Вы отправили чек, после подтверждения оплаты вам будет направлен заказ.');
    // If a document is sent, save it
    $document_file_id = $data['document']['file_id'];
    $file_name = $data['document']['file_name'];
    $saved_document_path = savePhoto($user_id, $document_file_id, $file_name, $dateTime);
    // Now $saved_document_path contains the path to the saved document
    $sendText = 'Клиент '. $first_name . " " . $last_name . ' прислал чек.';
    CurlSendDocument(ADMIN, './download/'.$saved_document_path, $sendText);
    sendOrdersAdmin($user_id, $first_name, $last_name, $user_name);
}


function sendMessage($chat_id, $text, $reply_markup = '')
{
    $bot_token = TOKEN;
    $ch = curl_init();
    $ch_post = [
        CURLOPT_URL => 'https://api.telegram.org/bot' . $bot_token . '/sendMessage',
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_POSTFIELDS => [
            'chat_id' => $chat_id,
            'parse_mode' => 'HTML',
            'text' => $text,
            'reply_markup' => $reply_markup,
        ]
    ];
    curl_setopt_array($ch, $ch_post);
    curl_exec($ch);
}


//if ($user_id == 566824642) {
//    sendMessage($chat_id, 'это ты, Создатель');
//}


if (empty(getUser($user_id))) {
    setUser($user_id, $first_name, $last_name, $phone_number);
} else if (!empty($phone_number) && empty(getUserPhone($user_id))) {
    updateUser($user_id, $first_name, $last_name, $phone_number);
    sendMessage($chat_id, 'Пользователь добавлен.', $reply_markup = '');
}

if ($last_message == '/start') {
    checkOrders($user_id, formatPhoneNumber($phone_number));
    $messageText = 'Вы всегда можете проверить свои заказы нажав кнопку "мои заказы". После оплаты заказа пришлите чек.';

    sendMessageWithPhoneRequest($chat_id, $messageText, $requestPhone = false);
    sendPayCode($user_id);
} else if (!empty($text)) {

    switch ($text) {
        case'/start':
            $messageText = 'Добрый день, ' . $first_name . '. Прошу прислать данные своего контакта, после чего я смогу проверить есть ли у вас неоплаченные заказы.';
            sendMessageWithPhoneRequest($chat_id, $messageText, $requestPhone = true);
            break;
        case 'привет':
            $messageText = 'привет, ' . $first_name . '!';
            sendMessageWithPhoneRequest($chat_id, $messageText, $requestPhone = false);
            break;
        case 'мои заказы':
            checkOrders($user_id, formatPhoneNumber(getUserPhone($user_id)));

            break;
        case 'кнопки':

            $method = 'sendMessage';
            $send_data = [
                'text' => 'для проверки неоплаченных заказов нажмите "мои заказы", для отправки чека после оплаты нажмите "отправить чек"',
                'reply_markup' => [
                    'inline_keyboard' => [
                        [
                            [
                                'text' => 'мои заказы',
                                'callback_data' => 'мои заказы'
                            ],
                            [
                                'text' => 'отправить чек',
                                'callback_data' => 'отправить чек'
                            ],

                        ]
                    ]
                ]
            ];
            $send_data['chat_id'] = $chat_id;
            $res = sendToTelegram1537($method, $send_data);
            break;

        default:
            $messageText = "Не понимаю о чем речь. Чтобы проверить свои заказы введите 'мои заказы' ";
            sendMessage($chat_id, $messageText);
            break;
    }
} else if (!empty($callback)) {
    switch ($callback) {
        case 'мои заказы':
            checkOrders($user_id, formatPhoneNumber(getUserPhone($user_id)));

            break;

        case 'отправить чек':
            sendMessage($user_id, 'Пришлите чек, в сообщение укажите номер заказа.');
            break;

        default:
            $callback_list = explode('/', $callback);
            orderPayed($callback_list[1], $callback_list[0]);
            //sendMessage($user_id, 'не понимаю о чем речь callBack = ' . $callback);
            break;

    }


}


function savePhoto($user_id, $file_id, $file_name, $dateTime)
{
    $file_info = file_get_contents("https://api.telegram.org/bot" . TOKEN . "/getFile?file_id=" . $file_id);
    $file_info = json_decode($file_info, true);
    if (empty($file_name)) {
        $file_name = $dateTime . '.jpg';
    }
    $file_path = $file_info['result']['file_path'];
    $file_url = "https://api.telegram.org/file/bot" . TOKEN . "/$file_path";
    $local_file_path = __DIR__ . '/download/' . $user_id . ' ' . $file_name;

    file_put_contents($local_file_path, file_get_contents($file_url));
    $file_path_name = $user_id . ' ' . $file_name;
    return $file_path_name;
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

function getLastMessage($userId)
{
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
    if (empty($text)) {
        $text = 'нет текста';
    }
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

function setUser($userId, $firstName, $lastName, $phone_number)
{
    $HLblockID = HL_USER;
    $entity_data_class = GetEntityDataClass($HLblockID);
    // Insert a new row
    $result = $entity_data_class::add(array(
        "UF_USER_ID" => $userId,
        "UF_USER_FIRST_NAME" => $firstName,
        "UF_USER_LAST_NAME" => $lastName,
        "UF_USER_PHONE_NUMBER" => $phone_number));

    if (!$result->isSuccess()) {
        throw new Exception("Failed to add new row to highloadblock table");
    }
}

function updateUser($userId, $firstName, $lastName, $phone_number)
{
    $HLblockID = HL_USER;
    $entity_data_class = GetEntityDataClass($HLblockID);

    // Find the existing row by user ID
    $row = $entity_data_class::getList(array(
        "select" => array("*"),
        "filter" => array("UF_USER_ID" => $userId)
    ))->fetch();

    if ($row) {
        $userFields = array(
            'UF_USER_PHONE_NUMBER' => $phone_number
        );

        $result = $entity_data_class::update($row['ID'], $userFields);

        if (!$result->isSuccess()) {
            throw new Exception("Failed to update user data in highloadblock table");
        }
    } else {
        throw new Exception("User not found in highloadblock table");
    }
}

function getUser($userId)
{
    $HLblockID = HL_USER;
    $entity_data_class = GetEntityDataClass($HLblockID);
    // Try to find an existing row for this user
    $row = $entity_data_class::getList(array(
        "select" => array("*"),
        "filter" => array("UF_USER_ID" => $userId)
    ))->fetch();
    if ($row['UF_USER_ID']) {
        return $row['UF_USER_ID'];
    }
}

function getUserPhone($userId)
{
    $HLblockID = HL_USER;
    $entity_data_class = GetEntityDataClass($HLblockID);
    // Try to find an existing row for this user
    $row = $entity_data_class::getList(array(
        "select" => array("*"),
        "filter" => array("UF_USER_ID" => $userId)
    ))->fetch();
    if ($row['UF_USER_PHONE_NUMBER']) {
        return $row['UF_USER_PHONE_NUMBER'];
    }
}

function sendMessageWithPhoneRequest($chatId, $messageText, $requestPhone = false)
{
    $botToken = TOKEN;
    // Prepare the keyboard based on the $requestPhone parameter
    $keyboard = [
        'keyboard' => [
            [
                [
                    'text' => $requestPhone ? 'Отправить данные контакта' : 'мои заказы',
                    'request_contact' => $requestPhone,
                ],


            ],
        ],
        'resize_keyboard' => true,
    ];

    $replyMarkup = json_encode($keyboard);

    // Set up cURL to send the message
    $ch = curl_init("https://api.telegram.org/bot$botToken/sendMessage");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'chat_id' => $chatId,
        'text' => $messageText,
        'reply_markup' => $replyMarkup,
    ]);

    // Execute the cURL request
    $result = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        // Successful request
        echo 'Message sent successfully.';
    }

    // Close cURL session
    curl_close($ch);
}


function checkOrders($user_id, $phone)
{
    CModule::IncludeModule('pvgroup.cart');
    $orders = OrderTable::getList(array(
        'select' => array('*'), // Выберите необходимые поля
        'filter' => array('PHONE' => $phone, 'CANCELED' => 'N', 'PAYED' => 'N'),
        'order' => array('ID' => 'ASC'), // Укажите порядок сортировки, если необходимо
    ))->fetchAll();
// Вывести список заказов
    if (!empty($orders)) {
        sendMessage($user_id, 'У вас есть следующие неоплаченные заказы: ');
        foreach ($orders as $order) {
            sendMessage($user_id, 'Заказ № ' . $order['ID'] . ', на сумму ' . $order['TOTAL'] . ' руб.');
        }
        sendMessage($user_id, 'После оплаты заказа пришлите чек.');
        sendPayCode($user_id);

    } else {
        sendMessage($user_id, 'У вас нет неоплаченных заказов');
    }

}

function sendOrdersAdmin($user_id, $first_name, $last_name, $username)
{
    $phone = formatPhoneNumber(getUserPhone($user_id));
    CModule::IncludeModule('pvgroup.cart');
    $orders = OrderTable::getList(array(
        'select' => array('*'), // Выберите необходимые поля
        'filter' => array('PHONE' => $phone, 'CANCELED' => 'N', 'PAYED' => 'N'),
        'order' => array('ID' => 'ASC'), // Укажите порядок сортировки, если необходимо
    ))->fetchAll();
// Вывести список заказов
    if (!empty($orders)) {
        sendMessage(ADMIN, 'У клиента ' . $first_name . " " . $last_name . " с ником " . $username . " есть следующие заказы:");
        foreach ($orders as $order) {
            $method = 'sendMessage';
            $send_data = [
                'text' => 'Заказ № ' . $order['ID'] . ', на сумму ' . $order['TOTAL'] . ' руб.',
                'reply_markup' => [
                    'inline_keyboard' => [
                        [
                            [
                                'text' => 'подтвердить оплату и отправить заказ № ' . $order['ID'],
                                'callback_data' => $user_id . '/' . $order['ID']
                            ],
                        ]
                    ]
                ]
            ];
            $send_data['chat_id'] = ADMIN;
            $res = sendToTelegram1537($method, $send_data);

        }
        sendMessage(ADMIN, 'Нажмите на заказ чтобы перевести его в статус "оплачено" и отправить клиенту.');
    } else {
        sendMessage(ADMIN, 'У клиента нет неоплаченных заказов');
    }

}

//отдаем телефон формата телеграма и возвращаем как в битриксе было +79286504248 стало +7 (918) 869-00-78
function formatPhoneNumber($phoneNumber)
{
    // Очистим от всего, кроме цифр
    $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

    // Добавим код страны и разделители
    $formattedNumber = '+7 (' . substr($phoneNumber, 1, 3) . ') ' . substr($phoneNumber, 4, 3) . '-' . substr($phoneNumber, 7, 2) . '-' . substr($phoneNumber, 9, 2);

    return $formattedNumber;
}


function sendToTelegram1537($method, $data, $headers = [])
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://api.telegram.org/bot' . TOKEN . '/' . $method,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array_merge(array("Content-Type: application/json"))
    ]);
    $result = curl_exec($curl);
    curl_close($curl);
    return (json_decode($result, 1) ? json_decode($result, 1) : $result);

}

function orderPayed($orderID, $user_id)
{

    CModule::IncludeModule('pvgroup.cart');
    $orders = OrderTable::getList(array(
        'select' => array('*'), // Выберите необходимые поля
        'filter' => array('ID' => $orderID, 'CANCELED' => 'N', 'PAYED' => 'N'),
        'order' => array('ID' => 'ASC'), // Укажите порядок сортировки, если необходимо
    ))->fetchAll();

    foreach ($orders as $order) {
        $orderId = $order['ID'];
        // Обновите статус оплаты на "Y"
        OrderTable::update($orderId, array('PAYED' => 'Y'));

        $orderInfo = CBeeOrder::getOrderInfo($order['ID']);

        foreach ($orderInfo['ITEMS'] as $orderInfoItem) {
            // Output item name

            sendPDF($orderInfoItem['PRODUCT_ID'], $user_id);
        }

    }
    sendMessage(ADMIN, 'Заказ №' . $orderID . ' доставлен клиенту.');

}

function sendPDF($orderID, $user_id)
{

    $iblockId = '5';
    CModule::IncludeModule('iblock');
    $rsElements = CIBlockElement::GetList(
        array('SORT' => 'ASC'),
        array('IBLOCK_ID' => $iblockId, 'ID' => $orderID),
        false,
        false,

    );
    sendMessage($user_id, 'Ваш заказ:');
    while ($ob = $rsElements->GetNextElement()) {
        $arProps = $ob->GetProperties();
        $pathToFile = CFile::GetPath($arProps['PDF_FILE']['VALUE']);

        file_put_contents(__DIR__ . '/answerBot.txt', print_r($arProps, true));
        $sendText = '';

        CurlSendDocument($user_id, '.'.$pathToFile, $sendText);

    }
    sendMessage($user_id, 'Благодарим за покупку. По всем допольнительным вопросам вы можете обратиться к нашему администратору @stavstepan.');


}

function CurlSendDocument($user_id, $file_name, $sendText) {

    // Ensure that the file exists
    if (!file_exists($file_name)) {
        sendMessage(ADMIN, 'File not found: ' . $file_name);
        return;
    }

    // Create CURL object
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot" . TOKEN . "/sendDocument?chat_id=" . $user_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);

    // Create CURLFile
    $finfo = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_name);
    $cFile = new CURLFile($file_name, $finfo);

    // Add CURLFile to CURL request
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        "document" => $cFile,
        'caption' => $sendText,
    ]);

    // Call
    $result = curl_exec($ch);

    // Show result and close curl
    var_dump($result);
    curl_close($ch);

}

function sendPayCode($user_id){
    $method = 'sendPhoto';
    $send_data = [
        'photo' => 'https://stavbim.ru/bot/qr_pay.jpg',
        'caption' => 'QR-код для оплаты заказа.',
//        'reply_markup' => [
//            'inline_keyboard' => [
//                [
//                    [
//                        'text' => 'текущие заказы клиента ' . $first_name . " " . $last_name,
//                        'callback_data' => $user_id
//                    ],
//
//                ]
//            ]
//        ]
    ];
    $send_data['chat_id'] = ADMIN;
    $res = sendToTelegram1537($method, $send_data);


}
