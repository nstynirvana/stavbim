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
        <div id="<?= $formId ?>" class="bee-form-w bee-form-w--inline">
            <div class="bee-form-w bee-form-w--inline">
                <form class="bee-form" action="<?= POST_FORM_ACTION_URI ?>" method="POST" enctype="multipart/form-data">
                    <?= bitrix_sessid_post() ?>
                    <header>
                        <div class="form-name"><?= Loc::GetMessage("BEEHIVE_CART_FORM_TITLE") ?></div>
                    </header>
                    <?
                    if (!empty($arResult["COMMON_ERRORS"])) {
                        ?>
                        <div class="message message-error">
                            <i class="fa fa-times"></i>
                            <? foreach ($arResult["COMMON_ERRORS"] as $ERROR) { ?>
                                <p><?= $ERROR ?></p>
                            <? } ?>
                        </div>
                        <?
                    }
                    ?>
                    <fieldset>
                        <? foreach ($arResult["FIELDS"] as $arField) {
                            switch ($arField["FORM_TYPE"]) {
                                case "text": ?>
                                    <div class="field-w">
                                        <label class="input<?= (!empty($arResult["ERROR_MESSAGE"][$arField["CODE"]])) ? '  state-error' : '' ?>">
                                            <?
                                            switch ($arField["CODE"]) {
                                                case 'NAME': ?>
                                                    <i class="icon-append fa fa-user"></i>
                                                    <? break;
                                                case 'EMAIL': ?>
                                                    <i class="icon-append fa fa-envelope-o"></i>
                                                    <? break;
                                                case 'PHONE': ?>
                                                    <i class="icon-append fa fa-phone"></i>
                                                    <? break;
                                                default: ?>
                                                    <i class="icon-append fa fa-tag"></i>
                                                    <? break;
                                            }
                                            ?>


                                            <input
                                                    class="<?= $arField["CLASS"] ?>"
                                                    placeholder="<?= Loc::getMessage('BEEHIVE_CART_FORM_FIELD_' . $arField["CODE"]) ?><?= ($arField["IS_REQUIRED"] == "Y") ? ' *' : '' ?>"
                                                    type='text'
                                                    name='<?= $arResult["FIELDS_CODE"] ?>[<?= $arField["CODE"] ?>]'
                                                    value="<?= $arField["SUBMITTED_VALUE"] ?>">
                                        </label>
                                        <? if (!empty($arResult["ERROR_MESSAGE"][$arField["CODE"]])) { ?>
                                            <em class="invalid"><?= $arResult["ERROR_MESSAGE"][$arField["CODE"]] ?></em>
                                        <? } ?>
                                    </div>
                                    <? break;
                                case "textarea": ?>
                                    <div class="field-w">
                                        <? if (!empty($arResult["ERROR_MESSAGE"][$arField["CODE"]])) { ?>
                                            <div
                                                    class="form-error-text form-error-field-text"><?= $arResult["ERROR_MESSAGE"][$arField["CODE"]] ?></div>
                                        <? } ?>
                                        <label class="textarea">
                                <textarea
                                        placeholder="<?= Loc::getMessage('BEEHIVE_CART_FORM_FIELD_' . $arField["CODE"]) ?>"
                                        name='<?= $arResult["FIELDS_CODE"] ?>[<?= $arField["CODE"] ?>]'><?= $arField["SUBMITTED_VALUE"] ?><?= ($arField["IS_REQUIRED"] == "Y") ? ' *' : '' ?></textarea>
                                        </label>
                                    </div>
                                    <?
                                    break;
                                case "select": ?>
                                    <span class="label__text"><?= Loc::getMessage('BEEHIVE_CART_FORM_FIELD_' . $arField["CODE"]) ?></span>
                                    <div class="field-w <?= mb_strtolower($arField["CODE"]) ?>">
                                        <? if (!empty($arResult["ERROR_MESSAGE"][$arField["CODE"]])) { ?>
                                            <div class="form-error-text form-error-field-text">
                                                <?= $arResult["ERROR_MESSAGE"][$arField["CODE"]] ?>
                                            </div>
                                        <? } ?>
                                        <label class="select">

                                            <i class="icon-append fa"></i>
                                            <select
                                                    name='<?= $arResult["FIELDS_CODE"] ?>[<?= $arField["CODE"] ?>]'>
                                                <? foreach ($arField["VALUES"] as $optKey => $option) { ?>
                                                    <option data-price="<?= $arField["INFO"][$optKey]["PRICE"] ?>"
                                                            value="<?= $optKey ?>" <?= $arField["SUBMITTED_VALUE"] == $optKey ? 'selected' : '' ?>>
                                                        <?= $option ?> <?= !empty($arField["INFO"][$optKey]["PRICE"]) ? '(+' . $arField["INFO"][$optKey]["PRICE"] . ' ' . $arResult["CURRENCY_TEXT"] . ')' : '(' . Loc::GetMessage("BEEHIVE_CART_FORM_DELIVERY_FREE") . ')'; ?>
                                                    </option>
                                                <? } ?>
                                            </select>
                                        </label>
                                    </div>
                                    <?
                                    break;

                                case "select_with_image": ?>
                                    <fieldset
                                            class="field-w select-with-image select-with-image--<?= mb_strtolower($arField["CODE"]) ?> <?= mb_strtolower($arField["CODE"]) ?>">
                                        <? if (!empty($arResult["ERROR_MESSAGE"][$arField["CODE"]])) { ?>
                                            <div class="form-error-text form-error-field-text">
                                                <?= $arResult["ERROR_MESSAGE"][$arField["CODE"]] ?>
                                            </div>
                                        <? } ?>
                                        <legend class="select-with-image__title"><?= Loc::getMessage('BEEHIVE_CART_FORM_FIELD_' . $arField["CODE"]) ?></legend>


                                        <?
                                        foreach ($arField["VALUES"] as $optKey => $option) {
                                            ?>


                                            <label class="checkbox select-with-image__label">

                                                <div class="select-with-image__col select-with-image__col--1">
                                                    <?
                                                    if (!empty($arField["INFO"][$optKey]["LOGO"]["SRC"])) {
                                                        ?>
                                                        <div class="select-with-image__image">

                                                            <img src="<?= $arField["INFO"][$optKey]["LOGO"]["SRC"] ?>"
                                                                 alt="<?= $arField["INFO"][$optKey]["LOGO"]["NAME"] ?>">

                                                        </div>
                                                        <?
                                                    }
                                                    ?>
                                                    <input data-price="<?= $arField["INFO"][$optKey]["PRICE"] ?>"
                                                           class="select-with-image__input"
                                                           name='<?= $arResult["FIELDS_CODE"] ?>[<?= $arField["CODE"] ?>]'
                                                           value="<?= $optKey ?>"
                                                           type="radio" <?= $arField["SUBMITTED_VALUE"] == $optKey ? 'checked' : '' ?>>
                                                    <i class="icon-append fa"></i>
                                                </div>

                                                <div class="select-with-image__col select-with-image__col--2">
                                                    <span class="select-with-image__text"><?= $option ?></span>
                                                    <span class="select-with-image__description"><?= $arField["INFO"][$optKey]["DESCRIPTION"] ?> </span>
                                                </div>
                                                <div class="select-with-image__col select-with-image__col--3">
                                                    <div class="select-with-image__price">
                                                        <?
                                                        if (!empty($arField["INFO"][$optKey]["PRICE"])) {
                                                            echo $arField["INFO"][$optKey]["PRICE"] . ' ' . $arResult["CURRENCY_TEXT"];
                                                        } else {
                                                            echo Loc::GetMessage("BEEHIVE_CART_FORM_DELIVERY_FREE");
                                                        }
                                                        ?>
                                                    </div>
                                                </div>


                                            </label>


                                        <? } ?>
                                    </fieldset>

                                    <?
                                    break;
                            }
                        } ?>
                    </fieldset>
                    <footer>
                        <?
                        if ($arParams["PERSONAL_AGREE"] == "Y") {
                            ?>
                            <input type="hidden" name="IS_PERSONAL_AGREE" value="Y">
                            <div class="personal_agree-block">
                                <input class="styled-checkbox" id="b_personal_agree" type="checkbox"
                                       name="PERSONAL_AGREE" value="Y" checked>
                                <label class="is-personal-agree <?= (!empty($arResult["ERROR_MESSAGE"]["PERSONAL_AGREE"])) ? '  state-error' : '' ?>"
                                       for="b_personal_agree">

                                    <?= Loc::GetMessage("BEEHIVE_CART_FORM_PERSONAL_AGREE", array('#PERSONAL_AGREE#' => $arParams["PERSONAL_AGREE_LINK"])) ?>
                                </label>
                                <? if (!empty($arResult["ERROR_MESSAGE"]["PERSONAL_AGREE"])) { ?>
                                    <em class="invalid"><?= $arResult["ERROR_MESSAGE"]["PERSONAL_AGREE"] ?></em>
                                <? } ?>
                            </div>
                            <?
                        }
                        ?>
                        <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
                        <div class="bee-form-actions">
                            <button class="button" type="submit" name="submit">
                                <?= Loc::GetMessage("BEEHIVE_CART_FORM_SUBMIT") ?>
                            </button>
                        </div>
                    </footer>
                </form>
            </div>
        </div>
        <script>
            BeeCartAppObjects.formId = '<?=$formId?>';
            jQuery(document).ready(function () {
                <? if ($arParams["USE_PHONE_MASK"] == "Y"):?>
                jQuery('.<?=$arResult["FIELDS"]["PHONE"]["CLASS"]?>').mask("+7 (000) 000-00-00", {
                    clearIfNotMatch: true,
                    placeholder: "+7 (___) ___-__-__<?= ($arResult["FIELDS"]["PHONE"]["IS_REQUIRED"] == "Y") ? ' *' : '' ?>"
                });
                <? endif; ?>
                jQuery('.delivery_services select').change(function () {
                    var addPrice = jQuery('option:selected', this).attr('data-price') * 1;
                    BeeCartAppObjects.cartPageApp.DATA.DELIVERY_PRICE = addPrice;
                });
                jQuery('.delivery_services [data-price]').change(function () {
                    var addPrice = jQuery(this).attr('data-price') * 1;
                    BeeCartAppObjects.cartPageApp.DATA.DELIVERY_PRICE = addPrice;
                });
                jQuery('.delivery_services select').trigger('change');
                jQuery('.delivery_services [data-price]').trigger('change');
            });
        </script>
        <?
    }
} elseif ($arResult["SUCCESS_ORDER"]) {
    ?>
    <div class="bee-form">
        <div class="message message-ok">
            <i class="fa fa-check"></i>
            <?= Loc::GetMessage("BEEHIVE_CART_FORM_ORDER_SUCCESS", array("#ORDER_ID#" => $arResult["ORDER"]["ORDER_ID"])) ?>

            <?
            if ($arResult["ORDER"]["PAYMENT_TYPE"] == "ROBOKASSA" && is_numeric($arResult["ORDER"]["ORDER_ID"])) {
                ?>
                <p>
                    <?= Loc::GetMessage("ROBOKASSA_TEXT") ?>
                </p>
                <?
                echo CBeeCartServices::getRoboForm($arResult["ORDER"]["ORDER_ID"], SITE_ID);
            }
            ?>
        </div>
    </div>
    <script>
        if (typeof BeeCartAppObjects.cartPageApp != "undefined")
            BeeCartAppObjects.cartPageApp.hideBlock();
    </script>
    <?
}

?>


