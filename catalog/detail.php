<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Каталог");
?>

<?
$arFilter = array('IBLOCK_ID' => 5, 'GLOBAL_ACTIVE' => 'Y', "CODE" => $_REQUEST["SECTION_CODE"]);
$db_list = CIBlockSection::GetList(array($by => $order), $arFilter, true);
while ($ar_result = $db_list->GetNext()) {
    $arrCurrentSection = $ar_result;
}
?>


    <div class="container">
        <? $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "breadcrumbs",
            array(
                "COMPONENT_TEMPLATE" => "breadcrumbs",
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1",
            ),
            false
        ); ?>
    </div>

    <div class="container product-container">
        <a href="<?= $arrCurrentSection["LIST_PAGE_URL"] ?>" class="back-to-page">
            <img src="/design/icons/back-to-page.svg" alt="Back Arrow" class="back-to-page-img">
            <p class="back-to-page-text">Вернуться назад</p>
            <img src="/design/icons/back-to-page-mobile.svg" alt="Back Arrow" class="back-to-page-img-mobile">
        </a>
    </div>

    <section class="product-card">
        <div class="container product-card-container">
            <? $detailElementId = $APPLICATION->IncludeComponent(
                "bitrix:news.detail",
                "product-detail",
                array(
                    "COMPONENT_TEMPLATE" => "product-detail",
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => "5",
                    "ELEMENT_ID" => "",
                    "ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
                    "CHECK_DATES" => "Y",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "VENDOR_CODE",
                        1 => "REVIT_VERSION",
                        2 => "OMNI_TITLE",
                        3 => "OMNI_NUMBER",
                        4 => "PROCREATOR",
                        5 => "LINK_PRODUCT",
                        6 => "PRICE",
                        7 => "",
                    ),
                    "IBLOCK_URL" => "",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_GROUPS" => "Y",
                    "SET_TITLE" => "Y",
                    "SET_CANONICAL_URL" => "N",
                    "SET_BROWSER_TITLE" => "Y",
                    "BROWSER_TITLE" => "NAME",
                    "SET_META_KEYWORDS" => "Y",
                    "META_KEYWORDS" => "-",
                    "SET_META_DESCRIPTION" => "Y",
                    "META_DESCRIPTION" => "-",
                    "SET_LAST_MODIFIED" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "ADD_ELEMENT_CHAIN" => "Y",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "USE_PERMISSIONS" => "N",
                    "STRICT_SECTION_CHECK" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "USE_SHARE" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Страница",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "SET_STATUS_404" => "N",
                    "SHOW_404" => "N",
                    "MESSAGE_404" => ""
                ),
                false
            ); ?>

            <? $_SESSION["VIEWD_PRODUCTS"][$detailElementId] = $detailElementId; ?>


            <?
            $db_props = CIBlockElement::GetProperty(5, $detailElementId, array("sort" => "asc"), array("CODE" => "PROCREATOR"));
            if ($ar_props = $db_props->Fetch()) {
                $procreator = $ar_props["VALUE_ENUM"];
            }

            $arSelect[] = 'PROPERTY_PROCREATOR';
            $arSelect[] = 'ID';
            $arFilter = array('IBLOCK_ID' => 5, 'GLOBAL_ACTIVE' => 'Y', "CODE" => $_REQUEST["SECTION_CODE"], "!ID" => $detailElementId);
            if ($procreator != "") {
                $arFilter["PROPERTY_PROCREATOR_VALUE"] = $procreator;
            }
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arrElements[] = $arFields["ID"];
            }
            ?>

        </div>
    </section>

<? $arrFilterSimilar = array("ID" => $arrElements); ?>

<? if (isset($arrElements) && count($arrElements) > 1): ?>

    <section class="similar">
        <div class="container">
            <div class="similar__wrapper">
                <div class="similar__title">Похожие товары</div>

                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "detail-page-similar",
                    array(
                        "COMPONENT_TEMPLATE" => "detail-page-similar",
                        "IBLOCK_TYPE" => "catalog",
                        "IBLOCK_ID" => "5",
                        "NEWS_COUNT" => "20",
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_ORDER1" => "DESC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",

                        "FILTER_NAME" => 'arrFilterSimilar',
                        "FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "PRICE",
                            1 => "PICTURE_DESKTOP",
                            2 => "",
                        ),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "Y",
                        "SET_BROWSER_TITLE" => "Y",
                        "SET_META_KEYWORDS" => "Y",
                        "SET_META_DESCRIPTION" => "Y",
                        "SET_LAST_MODIFIED" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "STRICT_SECTION_CHECK" => "N",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "PAGER_TEMPLATE" => ".default",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "PAGER_TITLE" => "Новости",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => ""
                    ),
                    false
                ); ?>
            </div>
        </div>
    </section>
<? endif; ?>

<? if (isset($_SESSION["VIEWD_PRODUCTS"]) && count($_SESSION["VIEWD_PRODUCTS"]) > 1): ?>

    <section class="yousee">
        <div class="container">
            <h2 class="yousee__title">Вы смотрели</h2>

            <? $arrFilterViewd = array("ID" => $_SESSION["VIEWD_PRODUCTS"], "!ID" => $detailElementId); ?>



            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "detail-page-seen",
                array(
                    "COMPONENT_TEMPLATE" => "detail-page-seen",
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => "5",
                    "NEWS_COUNT" => "30",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "arrFilterViewd",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "PRICE",
                        1 => "PICTURE_DESKTOP",
                        2 => "",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "Y",
                    "SET_BROWSER_TITLE" => "Y",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_META_DESCRIPTION" => "Y",
                    "SET_LAST_MODIFIED" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "STRICT_SECTION_CHECK" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "PAGER_TEMPLATE" => ".default",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "SET_STATUS_404" => "N",
                    "SHOW_404" => "N",
                    "MESSAGE_404" => ""
                ),
                false
            ); ?>

            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "detail-page-seen-mobile",
                array(
                    "COMPONENT_TEMPLATE" => "detail-page-seen-mobile",
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => "5",
                    "NEWS_COUNT" => "20",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "arrFilterViewd",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "VENDOR_CODE",
                        1 => "REVIT_VERSION",
                        2 => "OMNI_NUMBER",
                        3 => "PROCREATOR",
                        4 => "PRICE",
                        5 => "TYPE_SIZE",
                        6 => "",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "Y",
                    "SET_BROWSER_TITLE" => "Y",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_META_DESCRIPTION" => "Y",
                    "SET_LAST_MODIFIED" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "STRICT_SECTION_CHECK" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "PAGER_TEMPLATE" => ".default",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "SET_STATUS_404" => "N",
                    "SHOW_404" => "N",
                    "MESSAGE_404" => ""
                ),
                false
            ); ?>

        </div>
    </section>

<? endif; ?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>