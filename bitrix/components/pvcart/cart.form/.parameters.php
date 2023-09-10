<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

$arrDeliveryParams = array(
    "not_show" => Loc::GetMessage("BC_C_FORM_CART_PARAM_DELIVERY_NOT_SHOW"),
    "select" => Loc::GetMessage("BC_C_FORM_CART_PARAM_DELIVERY_SELECT"),
    "list" => Loc::GetMessage("BC_C_FORM_CART_PARAM_DELIVERY_LIST")
);

$arComponentParameters = array(
    "PARAMETERS" => array(
        "AJAX_MODE" => "Y",
        "USE_PHONE_MASK" => array(
            "NAME" => Loc::GetMessage("BC_C_FORM_CART_PARAM_USE_PHONE_MASK"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ),
        "SHOW_DELIVERY_SERVICES" => array(
            "NAME" => GetMessage("BC_C_FORM_CART_PARAM_SHOW_DELIVERY_SERVICES"),
            "TYPE" => "LIST",
            "VALUES" => $arrDeliveryParams,
            "DEFAULT" => "not_show",
        ),
        "PERSONAL_AGREE" => array(
            "NAME" => Loc::GetMessage("BC_C_FORM_CART_PARAM_PERSONAL_AGREE"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ),
        "PERSONAL_AGREE_LINK" => array(
            "NAME" => Loc::GetMessage("BC_C_FORM_CART_PARAM_PERSONAL_AGREE_LINK"),
            "TYPE" => "TEXT",
            "DEFAULT" => "/processing-cart/"
        ),
    )
);
?>