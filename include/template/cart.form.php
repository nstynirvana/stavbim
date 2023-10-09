<?

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<?

use Bitrix\Main;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;

$this->addExternalCss($templateFolder . "/css/font-awesome.min.css");
$this->addExternalCss($templateFolder . "/css/media.css");
$this->addExternalCss($templateFolder . "/style.css");
if ($arParams["USE_PHONE_MASK"] == "Y") {
    $this->addExternalJS($templateFolder . "/js/jquery.mask.min.js");
}
?>
<?

$formId = "bee-form-w";
    if (count($arResult["ELEMENTS"]) > 0) {
?>

        <div id="<?= $formId ?>" class="bee-form-w bee-form-w--inline">
            <div class="bee-form-w bee-form-w--inline">
                <form class="bee-form" action="<?= POST_FORM_ACTION_URI ?>" method="POST" enctype="multipart/form-data">
                    <?= bitrix_sessid_post() ?>
                    <div class="basket__pay__form__name-phone">
                        <? foreach ($arResult["FIELDS"] as $arField) {
                            switch ($arField["FORM_TYPE"]) {
                                case "text": ?>
                                    <input required id="<?= $arField["CODE"] ?>" class="basket__pay__form__name <?= $arField["CLASS"] ?>" placeholder="<?= Loc::getMessage('BEEHIVE_CART_FORM_FIELD_' . $arField["CODE"]) ?><?= ($arField["IS_REQUIRED"] == "Y") ? ' *' : '' ?>" type='text' name='<?= $arResult["FIELDS_CODE"] ?>[<?= $arField["CODE"] ?>]' value="<?= $arField["SUBMITTED_VALUE"] ?>">

                        <?
                                    break;
                            }
                        } ?>
                    </div>

                    <div class="basket__pay_warning">
                        <img class="basket__pay_warning_img" src="/design/icons/tooltip_icon.svg">
                        <p class="basket__pay_warning_text">После оформления заказа вы будете перенаправлены на Telegram-бота</p>
                    </div>
                    <div class="basket__pay__btn__block bee-form-actions">
                     <button class="basket__pay__btn button" type="submit" onclick="checkForm(event, 'https://t.me/stavbim_bot/')" style="background-color: #1A1A1A;" name="submit">
                            Купить
                        </button> 
                    </div>
                    <div class="basket__copyright">
                        <p>Нажимая кнопку «Купить» вы соглашаетесь с <a href="/confidentiality/">политикой конфиденциальности</a></p>
                    </div>

                    <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">

                </form>
            </div>
        </div>

<script>
    function checkForm(event, url) {
        var form = document.querySelector('form'); // Получение формы

        // Проверка, что все поля формы заполнены
        if (form.checkValidity()) {
            opennewtab(url); // Вызов функции только если форма заполнена
        } else {
            event.preventDefault(); // Отмена отправки формы, если поля не заполнены
        }
    }

    function opennewtab(url) {
        var win = window.open(url, '_blank');
    }
</script>
        <script>
            $(function() {
                //Использование параметра completed
                $("#PHONE").mask("+7 (999) 999-99-99");
            });
        </script>
        <script>
            BeeCartAppObjects.formId = '<?= $formId ?>';
        </script>
    <?
    }

if ($arResult["SUCCESS_ORDER"]) {
    ?>
    <?
    include($_SERVER['DOCUMENT_ROOT'] . "/success/index.php"); 
    ?>
<?
}
?>