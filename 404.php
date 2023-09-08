<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/header.php");
$APPLICATION->SetTitle("Страница не найдена");

?>

<section class="not-found">
    <div class="container">
        <div class="not-found__wrapper">
            <img src="design/img/404.png" alt="" class="not-found__img">
            <a href="/" class="not-found__btn">Вернуться на главную</a>
        </div>
    </div>
</section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>