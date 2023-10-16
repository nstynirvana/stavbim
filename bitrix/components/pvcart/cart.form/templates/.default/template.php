<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
if ($arParams["USE_PHONE_MASK"] == "Y") {
    $this->addExternalJS($templateFolder . "/js/jquery.mask.min.js");
}
?>
<?

$formId = "bee-form-w";
if (!$arResult["SUCCESS_ORDER"]) {
    if (count($arResult["ELEMENTS"]) > 0) {
        ?>
        <div id="<?= $formId ?>" class="container_form bee-form-w bee-form-w--inline">

                <form class="bee-form" action="<?= POST_FORM_ACTION_URI ?>" method="POST" enctype="multipart/form-data">
                    <?= bitrix_sessid_post() ?>
                    <div class="basket__pay__form__name-phone">
                        <? foreach ($arResult["FIELDS"] as $arField) {
                            switch ($arField["FORM_TYPE"]) {
                                case "text": ?>
                                    <input style="background-color: #F8F8F8" required id="<?= $arField["CODE"] ?>" class="basket__pay__form__name <?= $arField["CLASS"] ?>" placeholder="<?= Loc::getMessage('BEEHIVE_CART_FORM_FIELD_' . $arField["CODE"]) ?><?= ($arField["IS_REQUIRED"] == "Y") ? ' *' : '' ?>" type='text' name='<?= $arResult["FIELDS_CODE"] ?>[<?= $arField["CODE"] ?>]' value="<?= $arField["SUBMITTED_VALUE"] ?>">

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
                        <button class="basket__pay__btn button" type="submit" onclick="opennewtab('https://stavbim.ru/catalog/')" style="background-color: #F8F8F8; border: 1px solid #1A1A1A; color: #1A1A1A" name="submit">
                            Продолжить покупки
                        </button>
                        <button id="buttonPay" class="basket__pay__btn button" type="submit" style="background-color: #1A1A1A;" name="submit">
                            Купить
                        </button>
                    </div>
                    <div class="basket__copyright">
                        <p>Нажимая кнопку «Купить» вы соглашаетесь<br>с <a href="/confidentiality/">политикой конфиденциальности</a></p>
                    </div>

                    <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">

                </form>
        </div>
        <script>
            let callbackObject = { handleEvent: function(event){
                    var form = document.querySelector('form'); // Получение формы
                    var isValid = true;
                    var inputs = form.querySelectorAll('input[required]');
                    for (var i = 0; i < inputs.length; i++) {
                        if (inputs[i].value.trim() === '') {
                            isValid = false;
                            inputs[i].classList.add('error');
                        } else {
                            inputs[i].classList.remove('error');
                        }
                    }
                    if (isValid) {
                        window.open('https://t.me/stavbim_bot/', '_blank');
                    } else {
                        event.preventDefault(); // Отмена отправки формы, если поля не заполнены
                    }
                }
            }
            function opennewtab(url) {
                var win = window.open(url, '_blank');
            }

            $(function() {
                $("#PHONE").mask("+7 (999) 999-99-99");
            });

            function callBackObject(event) {
                    var form = document.querySelector('form'); // Получение формы
                    var isValid = true;
                    var inputs = form.querySelectorAll('input[required]');
                    for (var i = 0; i < inputs.length; i++) {
                        if (inputs[i].value.trim() === '') {
                            isValid = false;
                            inputs[i].classList.add('error');
                        } else {
                            inputs[i].classList.remove('error');
                        }
                    }
                    if (isValid) {
                        window.open('https://t.me/stavbim_bot/', '_blank');
                    } else {
                        event.preventDefault(); // Отмена отправки формы, если поля не заполнены
                    }
            }

            var buttonPay = document.getElementById('buttonPay')
            buttonPay.addEventListener("click", callBackObject);

            BeeCartAppObjects.formId = '<?= $formId ?>';
        </script>
        <?
    }
} elseif ($arResult["SUCCESS_ORDER"]) {
    ?>
    <div class="container__form-success">
        <div class="bee-form form-success">

            <div class="message message-ok form-success__message">
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
        if (document.getElementById('comp_96044789c0705014c9d37bd2300f4e32')) {
            document.getElementById('comp_96044789c0705014c9d37bd2300f4e32').style.width = '100%';
        }

        function opennewtab(url) {
            var win = window.open(url, '_blank');
        }
    </script>
    <?
}

?>