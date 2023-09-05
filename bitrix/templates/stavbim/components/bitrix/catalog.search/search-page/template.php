<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */

/** @var CBitrixComponent $component */

use Bitrix\Main\Loader;

$this->setFrameMode(true);

global $searchFilter;

$elementOrder = [];
if ($arParams['USE_SEARCH_RESULT_ORDER'] === 'N')
{
	$elementOrder = [
		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
		"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
		"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
	];
}

if (Loader::includeModule('search'))
{
	$arElements = $APPLICATION->IncludeComponent(
        "bitrix:search.page",
        "search-page",
        [
            "RESTART" => $arParams["RESTART"],
            "NO_WORD_LOGIC" => $arParams["NO_WORD_LOGIC"],
            "USE_LANGUAGE_GUESS" => $arParams["USE_LANGUAGE_GUESS"],
            "CHECK_DATES" => $arParams["CHECK_DATES"],
            "arrFILTER" => [
                "iblock_".$arParams["IBLOCK_TYPE"],
            ],
            "arrFILTER_iblock_".$arParams["IBLOCK_TYPE"] => [
                $arParams["IBLOCK_ID"],
            ]	,
            "USE_TITLE_RANK" => $arParams['USE_TITLE_RANK'],
            "DEFAULT_SORT" => "rank",
            "FILTER_NAME" => "",
            "SHOW_WHERE" => "N",
            "arrWHERE" => [],
            "SHOW_WHEN" => "N",
            "PAGE_RESULT_COUNT" => ($arParams["PAGE_RESULT_COUNT"] ?? 50),
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_TITLE" => "",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "N",
        ],
        $component,
        [
            'HIDE_ICONS' => 'Y',
        ]
    );


	if (!empty($arElements) && is_array($arElements))
	{
		$searchFilter = [
			"ID" => $arElements,
		];
		if ($arParams['USE_SEARCH_RESULT_ORDER'] === 'Y')
		{
			$elementOrder = [
				"ELEMENT_SORT_FIELD" => "ID",
				"ELEMENT_SORT_ORDER" => $arElements,
			];
		}
	}
	else
	{
		if (is_array($arElements))
		{
			echo GetMessage("CT_BCSE_NOT_FOUND");
			return;
		}
	}
}
else
{
	$searchQuery = '';
	if (isset($_REQUEST['q']) && is_string($_REQUEST['q']))
		$searchQuery = trim($_REQUEST['q']);
	if ($searchQuery !== '')
	{
		$searchFilter = [
			'*SEARCHABLE_CONTENT' => $searchQuery
		];
	}
	unset($searchQuery);
}

if (!empty($searchFilter) && is_array($searchFilter))
{

    $APPLICATION->IncludeComponent(
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
            "FILTER_NAME" => "searchFilter",
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
    );

}
