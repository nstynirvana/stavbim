<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

$arTemplateParameters = array(

    "BEE_VIEW_BLOCK_TOP" => array(
        "PARENT" => "VIEW_BLOCK",
        "NAME" => Loc::GetMessage("BC_C_CART_VIEW_BLOCK_TOP"),
        "SORT" => 500,
        "TYPE" => "STRING",
    ),
    "BEE_VIEW_ICON_COLOR" => array(
        "PARENT" => "VIEW_BLOCK",
        "NAME" => Loc::GetMessage("BC_C_CART_VIEW_ICON_COLOR"),
        "SORT" => 500,
        "TYPE" => "COLORPICKER",
    ),
    "BEE_VIEW_COUNT_COLOR" => array(
        "PARENT" => "VIEW_BLOCK",
        "NAME" => Loc::GetMessage("BC_C_CART_VIEW_COUNT_COLOR"),
        "SORT" => 500,
        "TYPE" => "COLORPICKER",
    ),
    "BEE_VIEW_BTN_COLOR" => array(
        "PARENT" => "VIEW_BLOCK",
        "NAME" => Loc::GetMessage("BC_C_CART_VIEW_BTN_COLOR"),
        "SORT" => 500,
        "TYPE" => "COLORPICKER",
    ),
    "BEE_VIEW_POSITION" => array(
        "PARENT" => "VIEW_BLOCK",
        "NAME" => Loc::GetMessage("BC_C_CART_VIEW_POSITION"),
        "SORT" => 500,
        "TYPE" => "LIST",
        "VALUES" => array(
            "LEFT" => Loc::GetMessage("BC_C_CART_VIEW_POSITION_LEFT"),
            "RIGHT" => Loc::GetMessage("BC_C_CART_VIEW_POSITION_RIGHT"),
        ),
    ),


);
