<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

if (!empty($arParams["SHOW_DELIVERY_SERVICES"])
    && $arParams["SHOW_DELIVERY_SERVICES"] == 'list'
    && !empty($arResult["FIELDS"]["DELIVERY_SERVICES"])) {

    $arResult["FIELDS"]["DELIVERY_SERVICES"]["FORM_TYPE"] = 'select_with_image';
}
