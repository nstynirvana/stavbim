<?
function dp($array = ""){
    echo "<pre>";  print_r($array); echo "</pre>";
}

define("PREFIX_PATH_404", "/404.php");

AddEventHandler("main", "OnAfterEpilog", "Prefix_FunctionName");

function Prefix_FunctionName() {
    global $APPLICATION;

    // Проверка, нужно ли нам показывать содержимое страницы 404 на битрикс
    if (!defined('ERROR_404') || ERROR_404 != 'Y') {
        return;
    }

    // Отобразить страницу 404, если она еще не отображается
    if ($APPLICATION->GetCurPage() != PREFIX_PATH_404) {
        header('X-Accel-Redirect: '.PREFIX_PATH_404);
        exit();
    }
}