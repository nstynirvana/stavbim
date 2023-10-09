<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?><?$APPLICATION->IncludeComponent(
	"pvcart:cart",
	"cart_checkout",
	Array(
		"BEE_VIEW_BLOCK_TOP" => "",
		"BEE_VIEW_BTN_COLOR" => "",
		"BEE_VIEW_CATALOG_LINK" => "",
		"BEE_VIEW_COUNT_COLOR" => "",
		"BEE_VIEW_ICON_COLOR" => "",
		"BEE_VIEW_POSITION" => "LEFT"
	)
);?><?$APPLICATION->IncludeComponent(
	"pvcart:cart.form", 
	".default", 
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"PERSONAL_AGREE" => "Y",
		"PERSONAL_AGREE_LINK" => "processing-cart/",
		"USE_PHONE_MASK" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"SHOW_DELIVERY_SERVICES" => "not_show"
	),
	false
);?><br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>