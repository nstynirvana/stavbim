<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use \Bitrix\Main\Localization\Loc,
    \Bitrix\Main\Config\Option,
    \Bitrix\Main\Loader;

if (Loader::includeModule("pvgroup.cart")) {


// регистрационная информация (пароль #2)
// registration info (password #2)
    $mrh_pass2 = Option::get("pvgroup.cart", "ROBO_PASS2_" . SITE_ID);;

    $IsTest = 0;
    if (Option::get('pvgroup.cart', "ROBO_TEST_" . SITE_ID) == "Y") {
        $IsTest = 1;
        $mrh_pass2 = Option::get("pvgroup.cart", "ROBO_TEST_PASS2_" . SITE_ID);
    }

//установка текущего времени
//current date
    $tm = getdate(time() + 9 * 3600);
    $date = "$tm[year]-$tm[mon]-$tm[mday] $tm[hours]:$tm[minutes]:$tm[seconds]";

// чтение параметров
// read parameters
    $out_summ = $_REQUEST["OutSum"];
    $inv_id = (int)$_REQUEST["InvId"];
    $shp_item = $_REQUEST["Shp_item"];
    $crc = $_REQUEST["SignatureValue"];
    $crc = strtoupper($crc);
    $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));

// проверка корректности подписи
// check signature
    if ($my_crc != $crc) {
        exit();
    }

// признак успешно проведенной операции
// success
    CBeeOrder::updateOrder($inv_id, array("PAYED" => "Y"));
}
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
