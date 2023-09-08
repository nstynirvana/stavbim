<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?>

<div class="container">
    <? $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "breadcrumbs",
        array(
            "COMPONENT_TEMPLATE" => "breadcrumbs",
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "s1"
        ),
        false
    ); ?>
</div>



<section class="aboutCompany">
    <div class="container">

        <div class="page-title">
            <h1 class="aboutCompany__title"><?$APPLICATION->ShowTitle(false)?></h1>
        </div>

        <div class="pvashoot about-page">

            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "text-block-page-container-company",
                array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "2",
                    "IBLOCK_TYPE" => "infoblocks",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "20",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "5",
                    "PARENT_SECTION_CODE" => "o-kompanii-podrobnee",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "PICTURE_RIGHT",
                        2 => "PICTURE_LEFT",
                        3 => "",
                    ),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N",
                    "COMPONENT_TEMPLATE" => "text-block-page-container-company"
                ),
                false
            ); ?>

        </div>
    </div>
</section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>