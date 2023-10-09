<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?CModule::IncludeModule("iblock");?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <? include($_SERVER['DOCUMENT_ROOT'] . "/include/template/head.php"); ?>
</head>

<? $APPLICATION->ShowPanel(); ?>

<? include($_SERVER['DOCUMENT_ROOT'] . "/include/template/counters.php"); ?>

<body>
<header class="header">
    <div class="container">
        <div class="header__wrapper">
            <div class="header__mobile-wrapper">

                <div class="header__mobil-btn">
                    <span class="header__mobil-btn-top"></span>
                    <span class="header__mobil-btn-custom"></span>
                </div>

                <a href="/" class="header__logo">
                    <? include($_SERVER['DOCUMENT_ROOT'] . "/include/template/logo.php"); ?>
                </a>

            </div>

            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "main-menu-header",
                array(
                    "COMPONENT_TEMPLATE" => "main-menu-header",
                    "ROOT_MENU_TYPE" => "main",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MAX_LEVEL" => "2",
                    "CHILD_MENU_TYPE" => "main",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N"
                ),
                false
            ); ?>


            <div class="header__mobile-wrapper">

                <div class="header__change-language">
                    <a href="#" class="header__change-language-btn active"><p>RUS</p></a>
                    <a href="/en<?= $_SERVER["REQUEST_URI"] ?>" class="header__change-language-btn"><p>ENG</p></a>
                </div>

                <div class="header__search-basket">

                    <div id="search" class="header__search-basket-btn">
                        <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.7301 24.75C6.25181 24.75 1.00015 19.4334 1.00015 12.875C1.00015 6.31662 6.25181 1 12.7301 1C19.2083 1 24.46 6.31662 24.46 12.875C24.46 19.4334 19.2083 24.75 12.7301 24.75Z"
                                  stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M31 31L21.6012 21.484" stroke="currentColor" stroke-miterlimit="10"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <div id="basket" class="header__search-basket-btn">
                        <? $APPLICATION->IncludeComponent(
	"pvcart:cart", 
	"cart_block_edited", 
	array(
		"COMPONENT_TEMPLATE" => "cart_block_edited",
		"BEE_VIEW_BLOCK_TOP" => "",
		"BEE_VIEW_ICON_COLOR" => "",
		"BEE_VIEW_COUNT_COLOR" => "",
		"BEE_VIEW_BTN_COLOR" => "",
		"BEE_VIEW_POSITION" => "RIGHT",
		"BEE_VIEW_CATALOG_LINK" => ""
	),
	false
);?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?$APPLICATION->IncludeComponent(
        "bitrix:search.form",
        "seacrh-form",
        Array(
            "COMPONENT_TEMPLATE" => "flat",
            "PAGE" => "#SITE_DIR#search/index.php",
            "USE_SUGGEST" => "N"
        )
    );?>

</header>


<? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "main-menu-header-mobile",
    array(
        "COMPONENT_TEMPLATE" => "main-menu-header-mobile",
        "ROOT_MENU_TYPE" => "main",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array(),
        "MAX_LEVEL" => "2",
        "CHILD_MENU_TYPE" => "main",
        "USE_EXT" => "N",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N"
    ),
    false
); ?>


