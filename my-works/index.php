<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Мои работы");
?>
    <div class="container">
        <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(),
            false
        ); ?>

        <? $APPLICATION->IncludeComponent("bitrix:search.form", "seacrh-form-on-page", array(
            "COMPONENT_TEMPLATE" => "flat",
            "PAGE" => "#SITE_DIR#search/index.php",    // Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
            "USE_SUGGEST" => "N",    // Показывать подсказку с поисковыми фразами
        ),
            false
        ); ?>

    </div>
    <section class="myworks__block">
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
                <div class="myworks__block__slider">

                    <div class="item__catalog__content-block-filters-sort">
                        <div class="catalog-cards__sort-panel">
                            <div class="catalog-cards__sort-panel__title">
                                Сортировать по:

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
                    <?$catalogListFilter = array("PROPERTY_MY_WORK_VALUE" => "Y");?>
                    <?// dp($catalogListFilter) ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "myworks-page-catalog",
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
                            "FILTER_NAME" => "catalogListFilter",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "5",
                            "IBLOCK_TYPE" => "catalog",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "6",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "Y",
                            "PAGER_TEMPLATE" => "navigation",
                            "PAGER_TITLE" => "",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(
                                0 => "",
                                1 => "PICTURE_DESKTOP",
                                2 => "PICTURE_FILE",
                                3 => "",
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
                            "COMPONENT_TEMPLATE" => "myworks-page-catalog",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER2" => "ASC"
                        ),
                        false
                    ); ?>
                </div>
            </div>

        </div>
    </section>
<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "text-block-page",
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
        "PARENT_SECTION" => "10",
        "PARENT_SECTION_CODE" => "blok-s-tekstom-vnizu-stranitsy",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "SET_BROWSER_TITLE" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "SHOW_404" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N",
        "COMPONENT_TEMPLATE" => "text-block-page"
    ),
    false
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>