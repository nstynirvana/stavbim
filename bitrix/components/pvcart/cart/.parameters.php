<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

$arComponentParameters = array(
    "GROUPS" => array(
        "MAIN" => array(
            "NAME" => Loc::GetMessage("BC_C_CART_GROUP_NAME_MAIN")
        ),
        "VIEW_BLOCK" => array(
            "NAME" => Loc::GetMessage("BC_C_CART_GROUP_NAME_VIEW_BLOCK")
        ),
    ),
    "PARAMETERS" => array(
        "BEE_VIEW_CATALOG_LINK" => array(
            "PARENT" => "MAIN",
            "NAME" => Loc::GetMessage("BC_C_CART_CATALOG_LINK"),
            "SORT" => 500,
            "TYPE" => "STRING",
        ),
    )

);
