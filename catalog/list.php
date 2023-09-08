<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Каталог");
?>

<?
$arFilter = array('IBLOCK_ID' => 5, 'GLOBAL_ACTIVE' => 'Y', "CODE" => $_REQUEST["SECTION_CODE"]);
$db_list = CIBlockSection::GetList(array($by => $order), $arFilter, true);
while ($ar_result = $db_list->GetNext()) {

    $arrCurrentSectionInfo = $ar_result;

    $arFilterChilds = array('IBLOCK_ID' => 5, "SECTION_ID" => $ar_result['ID']);
    $db_listChilds = CIBlockSection::GetList(array("sort" => "asc"), $arFilterChilds, true);
    while ($ar_resultChilds = $db_listChilds->GetNext()) {

        $arrChilds[] = $ar_resultChilds;

    }

}

//ОПРЕДЕЛЯЕМ НАЗАД ЭТО КУДА
$backLink = "";
$explodePath = explode("/", $arrCurrentSectionInfo["SECTION_PAGE_URL"]);
$lastElement = array_pop($explodePath);
$lastElement = array_pop($explodePath);
$backLink = implode("/", $explodePath)."/";
//ОПРЕДЕЛЯЕМ НАЗАД ЭТО КУДА


if ($_REQUEST["PROPARENT_SECTION_CODE"] != ""):
    $sectionCode = $_REQUEST["PROPARENT_SECTION_CODE"];
elseif ($_REQUEST["PARENT_SECTION_CODE"] != ""):
    $sectionCode = $_REQUEST["PARENT_SECTION_CODE"];
elseif ($_REQUEST["SECTION_CODE"] != ""):
    $sectionCode = $_REQUEST["SECTION_CODE"];
endif;

?>

<? include($_SERVER['DOCUMENT_ROOT'] . "/include/template/breadcrumbs.php"); ?>

<? if (is_array($arrChilds) && count($arrChilds) > 0): ?>

    <div class="container product-container">
        <a href="<?=$backLink?>" class="back-to-page">
            <svg class="back-to-page-img" width="17" height="14" viewBox="0 0 17 14" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M17 7H1M1 7L7 1M1 7L7 13" stroke="currentColor"/>
            </svg>
            <p class="back-to-page-text">Вернуться назад</p>
            <svg class="back-to-page-img-mobile" width="31" height="14" viewBox="0 0 31 14" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M31 7H0.999985M0.999985 7L6.99998 1M0.999985 7L6.99998 13" stroke="currentColor"/>
            </svg>
        </a>

        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list",
            "main-catalog-level2",
            array(
                "COMPONENT_TEMPLATE" => "main-catalog-level2",
                "ADD_SECTIONS_CHAIN" => "N",
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => "5",
                "SECTION_ID" => "",
                "SECTION_CODE" => $_REQUEST["SECTION_CODE"],
                "COUNT_ELEMENTS" => "Y",
                "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
                "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
                "TOP_DEPTH" => "5",
                "SECTION_FIELDS" => array(
                    0 => "",
                    1 => "",
                ),
                "SECTION_USER_FIELDS" => array(
                    0 => "",
                    1 => "PICTURE",
                    2 => "",
                ),
                "FILTER_NAME" => "",
                "VIEW_MODE" => "LINE",
                "SHOW_PARENT_NAME" => "Y",
                "SECTION_URL" => "",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_GROUPS" => "Y",
                "CACHE_FILTER" => "N"
            ),
            false
        ); ?>
    </div>
    <section class="catalog-cards">
        <div class="container">

            <?
            if (isset($_REQUEST['sortField'])) {
                $_SESSION["SORT"]["FIELD"] = $_REQUEST['sortField'];
            } else {
                if ($_SESSION["SORT"]["FIELD"] == "") {
                    $_SESSION["SORT"]["FIELD"] = 'sort';
                }
            }

            if (isset($_REQUEST['sortOrder'])) {
                $_SESSION["SORT"]["ORDER"] = $_REQUEST['sortOrder'];
            } else {
                if ($_SESSION["SORT"]["ORDER"] == "") {
                    $_SESSION["SORT"]["ORDER"] = 'asc';
                }
            }
            ?>
            <div class="block__sort">
                <div class="catalog-cards__sort-panel">
                    <div class="catalog-cards__sort-panel__title">Сортировать по:</div>
                    <div class="catalog-cards__sort-panel__price catalog-cards__sort-panel__filter <? if ($_SESSION["SORT"]["ORDER"] == "asc" && $_SESSION["SORT"]["FIELD"] == "property_PRICE"): ?> active <? endif; ?>">
                        <a data-sortfield="property_PRICE"
                           data-sortorder="<? if ($_SESSION["SORT"]["ORDER"] == "asc"): ?>desc<? else: ?>asc<? endif; ?>"
                           rel="nofollow"
                           href="#">цене</a>
                        <img src="/design/icons/arrow_upp.svg" alt="">
                    </div>
                    <div class="catalog-cards__sort-panel__popular catalog-cards__sort-panel__filter <? if ($_SESSION["SORT"]["ORDER"] == "asc" && $_SESSION["SORT"]["FIELD"] == "shows"): ?> active <? endif; ?>">
                        <a data-sortfield="shows"
                           data-sortorder="<? if ($_SESSION["SORT"]["ORDER"] == "asc"): ?>desc<? else: ?>asc<? endif; ?>"
                           rel="nofollow"
                           href="#">популярности</a>
                        <img src="/design/icons/arrow_upp.svg" alt="">
                    </div>
                </div>

                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "page-catalog-level2",
                    array(
                        "ADD_SECTIONS_CHAIN" => "Y",
                        "ADD_ELEMENT_CHAIN" => "Y",
                        "COMPONENT_TEMPLATE" => "page-catalog-level2",
                        "IBLOCK_TYPE" => "catalog",
                        "IBLOCK_ID" => "5",
                        "NEWS_COUNT" => "12",
                        "SORT_BY1" => $_SESSION["SORT"]["FIELD"],
                        "SORT_ORDER1" => $_SESSION["SORT"]["ORDER"],
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => array(
                            0 => "",
                            1 => "PICTURE_DESKTOP",
                            2 => "",
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "",
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
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => $_REQUEST["SECTION_CODE"],
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "STRICT_SECTION_CHECK" => "N",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "PAGER_TEMPLATE" => "navigation",
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


<? else: ?>

    <div class="container product-container">
        <a href="<?=$backLink?>" class="back-to-page">
            <svg class="back-to-page-img" width="17" height="14" viewBox="0 0 17 14" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M17 7H1M1 7L7 1M1 7L7 13" stroke="currentColor"/>
            </svg>
            <p class="back-to-page-text">Вернуться назад</p>
            <svg class="back-to-page-img-mobile" width="31" height="14" viewBox="0 0 31 14" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M31 7H0.999985M0.999985 7L6.99998 1M0.999985 7L6.99998 13" stroke="currentColor"/>
            </svg>
        </a>
    </div>

    <section class="item__catalog">
        <div class="container">
            <div class="item__catalog__wrapper">
                <div class="item__catalog__filter-block">
                    <form class="item__catalog__filter-block-form">
                        <div class="item__catalog__filter-block__kind">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:catalog.section.list",
                                "catalog-list-left-menu",
                                array(
                                    "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "CACHE_FILTER" => "N",
                                    "CACHE_GROUPS" => "Y",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_TYPE" => "A",
                                    "COUNT_ELEMENTS" => "Y",
                                    "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                                    "FILTER_NAME" => "",
                                    "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
                                    "IBLOCK_ID" => "5",
                                    "IBLOCK_TYPE" => "catalog",
                                    "SECTION_ID" => "",
                                    "SECTION_CODE" => $_REQUEST["PARENT_SECTION_CODE"],
                                    "SECTION_FIELDS" => array(
                                        0 => "",
                                        1 => "",
                                    ),
                                    "SECTION_URL" => "",
                                    "SECTION_USER_FIELDS" => array(
                                        0 => "",
                                        1 => "",
                                    ),
                                    "SHOW_PARENT_NAME" => "Y",
                                    "TOP_DEPTH" => "2",
                                    "VIEW_MODE" => "LINE",
                                    "COMPONENT_TEMPLATE" => "catalog-list-left-menu"
                                ),
                                false
                            ); ?>

                        </div>

                        <? $APPLICATION->IncludeComponent(
                            "bitrix:catalog.smart.filter",
                            "smart-filter",
                            array(
                                "CACHE_GROUPS" => "Y",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "A",
                                "DISPLAY_ELEMENT_COUNT" => "Y",
                                "FILTER_NAME" => "arrFilter",
                                "FILTER_VIEW_MODE" => "vertical",
                                "IBLOCK_ID" => "5",
                                "IBLOCK_TYPE" => "catalog",
                                "PAGER_PARAMS_NAME" => "arrPager",
                                "POPUP_POSITION" => "left",
                                "PREFILTER_NAME" => "smartPreFilter",
                                "CUSTOME_FILTER_PARAMS" => $_REQUEST["CUSTOME_FILTER"],
                                "SAVE_IN_SESSION" => "N",
                                "SECTION_CODE" => "",
                                "SECTION_DESCRIPTION" => "-",
                                "SECTION_ID" => "",
                                "SECTION_TITLE" => "-",
                                "SEF_MODE" => "N",
                                "TEMPLATE_THEME" => "blue",
                                "XML_EXPORT" => "N",
                                "COMPONENT_TEMPLATE" => "smart-menu-procreator"
                            ),
                            false
                        ); ?>

                    </form>
                </div>

                <div class="item__catalog__content-block">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section.list",
                        "main-catalog-level3",
                        array(
                            "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "COMPONENT_TEMPLATE" => "main-catalog-level3",
                            "COUNT_ELEMENTS" => "Y",
                            "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                            "FILTER_NAME" => "arFilter",
                            "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
                            "IBLOCK_ID" => "5",
                            "IBLOCK_TYPE" => "catalog",
                            "SECTION_CODE" => $_REQUEST["PARENT_SECTION_CODE"],
                            "SECTION_FIELDS" => array(
                                0 => "",
                                1 => "",
                            ),
                            "SECTION_ID" => "",
                            "SECTION_URL" => "",
                            "SECTION_USER_FIELDS" => array(
                                0 => "",
                                1 => "PICTURE",
                                2 => "",
                            ),
                            "SHOW_PARENT_NAME" => "Y",
                            "TOP_DEPTH" => "5",
                            "VIEW_MODE" => "LINE"
                        ),
                        false
                    ); ?>


                    <?
                    if (isset($_REQUEST['sortField'])) {
                        $_SESSION["SORT"]["FIELD"] = $_REQUEST['sortField'];
                    } else {
                        if ($_SESSION["SORT"]["FIELD"] == "") {
                            $_SESSION["SORT"]["FIELD"] = 'sort';
                        }
                    }

                    if (isset($_REQUEST['sortOrder'])) {
                        $_SESSION["SORT"]["ORDER"] = $_REQUEST['sortOrder'];
                    } else {
                        if ($_SESSION["SORT"]["ORDER"] == "") {
                            $_SESSION["SORT"]["ORDER"] = 'asc';
                        }
                    }
                    ?>
                    <div class="block__sort">

                        <div class="item__catalog__content-block-filters">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:catalog.smart.filter",
                                "tags",
                                array(

                                    "CACHE_GROUPS" => "Y",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_TYPE" => "A",
                                    "DISPLAY_ELEMENT_COUNT" => "Y",
                                    "FILTER_NAME" => "",
                                    "FILTER_VIEW_MODE" => "vertical",
                                    "IBLOCK_ID" => "5",
                                    "IBLOCK_TYPE" => "catalog",
                                    "PAGER_PARAMS_NAME" => "arrPager",
                                    "POPUP_POSITION" => "left",
                                    "PREFILTER_NAME" => "smartPreFilter",
                                    "CUSTOME_FILTER_PARAMS" => $_REQUEST["CUSTOME_FILTER"],
                                    "SAVE_IN_SESSION" => "N",
                                    "SECTION_CODE" => "",
                                    "SECTION_DESCRIPTION" => "-",
                                    "SECTION_ID" => "",
                                    "SECTION_TITLE" => "-",
                                    "SEF_MODE" => "N",
                                    "TEMPLATE_THEME" => "blue",
                                    "XML_EXPORT" => "N",
                                    "COMPONENT_TEMPLATE" => "smart-menu-procreator"

                                ),

                                false
                            ); ?>

                            <div class="item__catalog__content-block-filters-sort">
                                <div class="catalog-cards__sort-panel">
                                    <div class="catalog-cards__sort-panel__title">Сортировать по:</div>
                                    <div class="catalog-cards__sort-panel__price catalog-cards__sort-panel__filter <? if ($_SESSION["SORT"]["ORDER"] == "asc" && $_SESSION["SORT"]["FIELD"] == "property_PRICE"): ?> active <? endif; ?>">
                                        <a data-sortfield="property_PRICE"
                                           data-sortorder="<? if ($_SESSION["SORT"]["ORDER"] == "asc"): ?>desc<? else: ?>asc<? endif; ?>"
                                           rel="nofollow"
                                           href="#">цене</a>
                                        <img src="/design/icons/arrow_upp.svg" alt="">
                                    </div>

                                    <div class="catalog-cards__sort-panel__popular catalog-cards__sort-panel__filter <? if ($_SESSION["SORT"]["ORDER"] == "asc" && $_SESSION["SORT"]["FIELD"] == "shows"): ?> active <? endif; ?>">
                                        <a data-sortfield="shows"
                                           data-sortorder="<? if ($_SESSION["SORT"]["ORDER"] == "asc"): ?>desc<? else: ?>asc<? endif; ?>"
                                           rel="nofollow"
                                           href="#">популярности</a>
                                        <img src="/design/icons/arrow_upp.svg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <? /* mobile filter */ ?>
                        <div class="item__catalog__content-block-mobile">
                            <div class="item__catalog__content-block-mobile-filters">
                                <form action="" class="item__catalog__content-block-mobile-form">
                                    <div class="item__catalog__content-block-mobile-filter-main">
                                        <div class="item__catalog__content-block-mobile-filter-main-btn">
                                            <img src="/design/icons/filter.svg" alt="">
                                            <p>Фильтр</p>
                                        </div>
                                        <div class="item__catalog__content-block-mobile-filter-main-content">
                                            <div class="item__catalog__content-block-mobile-filter-main__kind">
                                                <? $APPLICATION->IncludeComponent(
                                                    "bitrix:catalog.section.list",
                                                    "catalog-list-left-menu-mobile",
                                                    array(
                                                        "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
                                                        "ADD_SECTIONS_CHAIN" => "N",
                                                        "CACHE_FILTER" => "N",
                                                        "CACHE_GROUPS" => "Y",
                                                        "CACHE_TIME" => "36000000",
                                                        "CACHE_TYPE" => "A",
                                                        "COUNT_ELEMENTS" => "Y",
                                                        "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                                                        "FILTER_NAME" => "",
                                                        "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
                                                        "IBLOCK_ID" => "5",
                                                        "IBLOCK_TYPE" => "catalog",
                                                        "SECTION_CODE" => $_REQUEST["PARENT_SECTION_CODE"],
                                                        "SECTION_FIELDS" => array(
                                                            0 => "",
                                                            1 => "",
                                                        ),
                                                        "SECTION_ID" => "",
                                                        "SECTION_URL" => "",
                                                        "SECTION_USER_FIELDS" => array(
                                                            0 => "",
                                                            1 => "",
                                                        ),
                                                        "SHOW_PARENT_NAME" => "Y",
                                                        "TOP_DEPTH" => "2",
                                                        "VIEW_MODE" => "LINE",
                                                        "COMPONENT_TEMPLATE" => "catalog-list-left-menu-mobile"
                                                    ),
                                                    false
                                                ); ?>
                                            </div>
                                            <? $APPLICATION->IncludeComponent(
                                                "bitrix:catalog.smart.filter",
                                                "smart-filter-mobile",
                                                array(
                                                    "CACHE_GROUPS" => "Y",
                                                    "CACHE_TIME" => "36000000",
                                                    "CACHE_TYPE" => "A",
                                                    "DISPLAY_ELEMENT_COUNT" => "Y",
                                                    "FILTER_NAME" => "",
                                                    "FILTER_VIEW_MODE" => "vertical",
                                                    "IBLOCK_ID" => "5",
                                                    "IBLOCK_TYPE" => "catalog",
                                                    "PAGER_PARAMS_NAME" => "arrPager",
                                                    "POPUP_POSITION" => "left",
                                                    "PREFILTER_NAME" => "smartPreFilter",
                                                    "SAVE_IN_SESSION" => "N",
                                                    "SECTION_CODE" => "",
                                                    "SECTION_DESCRIPTION" => "-",
                                                    "SECTION_ID" => $_REQUEST["SECTION_ID"],
                                                    "SECTION_TITLE" => "-",
                                                    "SEF_MODE" => "N",
                                                    "TEMPLATE_THEME" => "blue",
                                                    "XML_EXPORT" => "N",
                                                    "COMPONENT_TEMPLATE" => "smart-menu-main-mobile"
                                                ),
                                                false
                                            ); ?>
                                        </div>
                                        <div class="item__catalog__content-block-mobile-filter-main-sort hiddensort">
                                            <div class="item__catalog__content-block-filters-sort">
                                                <div class="catalog-cards__sort-panel">
                                                    <div class="catalog-cards__sort-panel__title">Сортировать по:</div>
                                                    <div class="catalog-cards__sort-panel__price catalog-cards__sort-panel__filter <? if ($_SESSION["SORT"]["ORDER"] == "asc" && $_SESSION["SORT"]["FIELD"] == "property_PRICE"): ?> active <? endif; ?>">
                                                        <a data-sortfield="property_PRICE"
                                                           data-sortorder="<? if ($_SESSION["SORT"]["ORDER"] == "asc"): ?>desc<? else: ?>asc<? endif; ?>"
                                                           rel="nofollow"
                                                           href="#">цене</a>
                                                        <img src="/design/icons/arrow_upp.svg" alt="">
                                                    </div>

                                                    <div class="catalog-cards__sort-panel__popular catalog-cards__sort-panel__filter <? if ($_SESSION["SORT"]["ORDER"] == "asc" && $_SESSION["SORT"]["FIELD"] == "shows"): ?> active <? endif; ?>">

                                                        <a data-sortfield="shows"
                                                           data-sortorder="<? if ($_SESSION["SORT"]["ORDER"] == "asc"): ?>desc<? else: ?>asc<? endif; ?>"
                                                           rel="nofollow"
                                                           href="#">популярности</a>
                                                        <img src="/design/icons/arrow_upp.svg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <? $APPLICATION->IncludeComponent(
                                "bitrix:catalog.smart.filter",
                                "tags-mobile",
                                array(
                                    "CACHE_GROUPS" => "Y",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_TYPE" => "A",
                                    "DISPLAY_ELEMENT_COUNT" => "Y",
                                    "FILTER_NAME" => "",
                                    "FILTER_VIEW_MODE" => "vertical",
                                    "IBLOCK_ID" => "5",
                                    "IBLOCK_TYPE" => "catalog",
                                    "PAGER_PARAMS_NAME" => "arrPager",
                                    "POPUP_POSITION" => "left",
                                    "PREFILTER_NAME" => "smartPreFilter",
                                    "CUSTOME_FILTER_PARAMS" => $_REQUEST["CUSTOME_FILTER"],
                                    "SAVE_IN_SESSION" => "N",
                                    "SECTION_CODE" => "",
                                    "SECTION_DESCRIPTION" => "-",
                                    "SECTION_ID" => "",
                                    "SECTION_TITLE" => "-",
                                    "SEF_MODE" => "N",
                                    "TEMPLATE_THEME" => "blue",
                                    "XML_EXPORT" => "N",
                                    "COMPONENT_TEMPLATE" => "tags-mobile"
                                ),
                                false
                            ); ?>

                            <div class="item__catalog__content-block-filters-sort">
                                <div class="catalog-cards__sort-panel">
                                    <div class="catalog-cards__sort-panel__title">Сортировать по:
                                        <div class="catalog-cards__sort-panel__price catalog-cards__sort-panel__filter <? if ($_SESSION["SORT"]["ORDER"] == "asc" && $_SESSION["SORT"]["FIELD"] == "property_PRICE"): ?> active <? endif; ?>">
                                            <a data-sortfield="property_PRICE"
                                               data-sortorder="<? if ($_SESSION["SORT"]["ORDER"] == "asc"): ?>desc<? else: ?>asc<? endif; ?>"
                                               rel="nofollow"
                                               href="#">цене</a>
                                            <img src="/design/icons/arrow_upp.svg" alt="">
                                        </div>
                                        <div class="catalog-cards__sort-panel__popular catalog-cards__sort-panel__filter <? if ($_SESSION["SORT"]["ORDER"] == "asc" && $_SESSION["SORT"]["FIELD"] == "shows"): ?> active <? endif; ?>">
                                            <a data-sortfield="shows"
                                               data-sortorder="<? if ($_SESSION["SORT"]["ORDER"] == "asc"): ?>desc<? else: ?>asc<? endif; ?>"
                                               rel="nofollow"
                                               href="#">популярности</a>
                                            <img src="/design/icons/arrow_upp.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <? $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "page-catalog-level3",
                            array(
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "ADD_SECTIONS_CHAIN" => "Y",
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
                                "COMPONENT_TEMPLATE" => "page-catalog-level3",
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
                                "FILTER_NAME" => "arrFilter",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => "5",
                                "IBLOCK_TYPE" => "catalog",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "9",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => "navigation",
                                "PAGER_TITLE" => "Новости",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => $_REQUEST["SECTION_CODE"],
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "PROPERTY_CODE" => array(
                                    0 => "REVIT_VERSION",
                                    1 => "PROCREATOR",
                                    2 => "",
                                ),
                                "SET_BROWSER_TITLE" => "Y",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "Y",
                                "SET_META_KEYWORDS" => "Y",
                                "SET_STATUS_404" => "N",
                                "SET_TITLE" => "Y",
                                "SHOW_404" => "N",
                                "SORT_BY1" => $_SESSION["SORT"]["FIELD"],
                                "SORT_ORDER1" => $_SESSION["SORT"]["ORDER"],
                                "STRICT_SECTION_CHECK" => "N",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER2" => "ASC"
                            ),
                            false
                        ); ?>

                    </div>
                </div>

            </div>

        </div>
    </section>

<? endif; ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>