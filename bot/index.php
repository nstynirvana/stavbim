<?/*
use Bitrix\Main\Loader;
use Pvgroup\Cart\OrderTable; // Подставьте корректное пространство имен вашего модуля

// Подключите модуль вашего модуля
$moduleId = 'pvgroup.cart';
if (!Loader::includeModule($moduleId)) {
    die('Module ' . $moduleId . ' not installed!');
}

// Получите все заказы
$orders = OrderTable::getList(array(
    'select' => array('*'), // Выберите необходимые поля
    'order' => array('ID' => 'ASC'), // Укажите порядок сортировки, если необходимо
))->fetchAll();
// Вывести список заказов
print_r($orders);

// Получение значения PHONE из GET-запроса
$phone = $_GET['phone'];

// Фильтрация заказов
$filteredOrders = array_filter($orders, function($order) use ($phone) {
    return $order['PAYED'] === 'N' && $order['PHONE'] === $phone;
});

// Вывод отфильтрованных заказов
print_r($filteredOrders);
*/
?>