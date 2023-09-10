<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use \Bitrix\Main\Localization\Loc,
    \Bitrix\Main\Config\Option,
    \Bitrix\Main\Loader;

if (Loader::includeModule("pvgroup.cart") && !empty($_REQUEST["SignatureValue"])) {

// регистрационная информация (пароль #1)
    $mrh_pass1 = Option::get("pvgroup.cart", "ROBO_PASS1_" . SITE_ID);

    $IsTest = 0;
    if (Option::get('pvgroup.cart', "ROBO_TEST_" . SITE_ID) == "Y") {
        $IsTest = 1;
        $mrh_pass1 = Option::get("pvgroup.cart", "ROBO_TEST_PASS1_" . SITE_ID);
    }

    $out_summ = $_REQUEST["OutSum"];
    $inv_id = $_REQUEST["InvId"];
    $shp_item = $_REQUEST["Shp_item"];
    $crc = $_REQUEST["SignatureValue"];

    $crc = strtoupper($crc);

    $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1"));

// проверка корректности подписи
// check signature
    if ($my_crc != $crc) {
        ?>
        <p>Произошла ошибка. Пожалуйста свяжитесь с администрацией магазина.</p>
        <?
        exit();
    }
    ?>

    <div class="robo-sucsess">
        <p>Ваш платёж успешно проведён.</p><p>В ближайшее время с Вами свяжется наш менеджер.</p>
    </div>

    <style>

        .robo-sucsess {
            background-position: center top;
            background-repeat: no-repeat;
            font-family: roboto, helvetica, sans-serif;
            font-size: 18px;
            font-weight: 300;
            padding-top: 200px;
            text-align: center;
        }
        .robo-sucsess {
            background-image: url(robo-sucsess.png);
        }
        .robo-sucsess p:first-child {
            color: #6c9814;
        }
        .robo-cancel p:first-child {
            color: #c11212;
        }
        .robo-sucsess p,
        .robo-cancel p {
            text-indent: 0;
        }
        .robo-sucsess p:first-child,
        .robo-cancel p:first-child {
            font-size: 28px;
            margin-bottom: 20px;
        }
    </style>


    <?php
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");