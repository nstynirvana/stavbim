<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;

$arComponentDescription = array(
	"NAME" => Loc::GetMessage("BC_C_FORM_CART_NAME"),
	"DESCRIPTION" => Loc::GetMessage("BC_C_FORM_CART_DESCRIPTION"),
	"ICON" => "/images/feedback.gif",
	"PATH" => array(
		"ID" => "pvcart",
        "NAME" => Loc::GetMessage("BC_C_FORM_CART_SECTION"),
        "CHILD" => array(
            "ID" => "cart_form",
            "NAME" => Loc::GetMessage("BC_C_FORM_CART_SUBCATEGORY")
        )
	),
);
?>