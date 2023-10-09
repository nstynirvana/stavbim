<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Ваш заказ успешно оформлен");
?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<link rel="stylesheet" href="/design/css/style.css">

<?/* $sectionName = array_pop($arResult["SECTION"]["PATH"]); */?>

<div class="container product-container">
    <a href="<?= $sectionName["SECTION_PAGE_URL"] ?>" class="back-to-page">
        <img src="/design/icons/back-to-page.svg" alt="Back Arrow" class="back-to-page-img">
        <p class="back-to-page-text">Вернуться назад</p>
        <img src="/design/icons/back-to-page-mobile.svg" alt="Back Arrow" class="back-to-page-img-mobile">
    </a>
</div>

<div class="container__form-success">
    <div class="bee-form form-success">

        <div class="message message-ok form-success__message">
            <i class="fa fa-check"></i>
            <img class="form-success__message_img" src="/design/img/success-img.svg">
            <h1 class="form-success__message_title">Заказ сформирован</h1>
            <p class="form-success__message_clue">В течении 5 секунд вы будете перенаправлены на Telegram-бота для оплаты</p>
        </div>
        <div class="form-success__path">
            <p class="form-success__path_clue">Если у вас возникли какие-то проблемы, перейдите в Telegram нажав кнопку ниже:</p>
            <button onclick="opennewtab('https://t.me/stavbim_bot/')" type="submit" name="submit" class="form-success__path_button">
                <p class="form-success__path_button-text">@StavBim</p>
                <img class="form-success__path_button-img" src="/design/img/telegram-icon.svg">
            </button>
        </div>
    </div>
</div>

<script>
    function opennewtab(url) {
        var win = window.open(url, '_blank');
    }
</script>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
