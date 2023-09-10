<?
define("STOP_STATISTICS", true);
define('NO_AGENT_CHECK', true);

require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?
use Bitrix\Main\Loader;
use Bitrix\Main\Context;
$moduleId = "pvgroup.cart";
if (!Loader::includeModule($moduleId)) die('Module ' . $moduleId . ' not installed!');

$request = Context::getCurrent()->getRequest();

$response = array();
switch ($request["method"]){
    case "addItemToCart":
        if (!empty($request["id"]) && !empty($request["qty"]) && !empty($request["SITE_ID"])){
            $params = (!empty($request["params"])) ? $request["params"] : array();
            $response = array_merge(CBeeCart::addItemToCart($request["id"], $request["qty"], $request["SITE_ID"], $params), CBeeCart::getUserCartInfoAfterAdd($request["SITE_ID"]));
        }
        break;
    case "removeAllItems":
        if (!empty($request["SITE_ID"]))
            $response = CBeeCart::removeAllItems($request["SITE_ID"]);
        break;
    case "removeItemById":
        if (!empty($request['id']))
            $response = CBeeCart::removeItemById($request['id']);
        break;
    case "updateItemQty":
        if (!empty($request['id']) && !empty($request['qty']) && !empty($request["SITE_ID"])){
            $response = CBeeCart::updateItemQty($request['id'], $request['qty']);
            $response["ELEMENTS_IN_CART"] = CBeeCart::getUserCart($request["SITE_ID"]);
        }
        break;
}

$APPLICATION->RestartBuffer();
header('Content-Type: application/json; charset='.LANG_CHARSET);
echo \Bitrix\Main\Web\Json::encode($response);
die();