<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="search-page">
    <form class="myworks__searchpanel" method="get"
          action="<?= $arResult["FORM_ACTION"] ?>"><? if ($arParams["USE_SUGGEST"] === "Y"):
            if (mb_strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"])) {
                $arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
                $obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
                $obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
            }
            ?>

            <? $APPLICATION->IncludeComponent(
            "bitrix:search.suggest.input",
            "",
            array(
                "NAME" => "q",
                "VALUE" => $arResult["REQUEST"]["~QUERY"],
                "INPUT_SIZE" => 40,
                "DROPDOWN_SIZE" => 10,
            ),
            $component, array("HIDE_ICONS" => "Y")
        ); ?>

        <? else: ?>
            <input placeholder="Поиск" type="search" id="myworks__searchpanel__input" name="q">
        <? endif; ?>
        <button class="myworks__searchpanel__btn"><img src="/design/icons/search.svg" alt=""></button>
    </form>

    <? if (isset($arResult["REQUEST"]["ORIGINAL_QUERY"])): ?>
        <div class="search-language-guess">
            <? echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#" => '<a href="' . $arResult["ORIGINAL_QUERY_URL"] . '">' . $arResult["REQUEST"]["ORIGINAL_QUERY"] . '</a>')) ?>
        </div>
    <? endif; ?>
</div>

<section class="search-resault">
    <div class="container">


        <? if ($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false): ?>

        <? elseif ($arResult["ERROR_CODE"] != 0): ?>
            <p><?= GetMessage("SEARCH_ERROR") ?></p>
            <? ShowError($arResult["ERROR_TEXT"]); ?>
            <p><?= GetMessage("SEARCH_CORRECT_AND_CONTINUE") ?></p>
            <br/><br/>
            <p><?= GetMessage("SEARCH_SINTAX") ?><br/><b><?= GetMessage("SEARCH_LOGIC") ?></b></p>
            <table border="0" cellpadding="5">
                <tr>
                    <td align="center" valign="top"><?= GetMessage("SEARCH_OPERATOR") ?></td>
                    <td valign="top"><?= GetMessage("SEARCH_SYNONIM") ?></td>
                    <td><?= GetMessage("SEARCH_DESCRIPTION") ?></td>
                </tr>
                <tr>
                    <td align="center" valign="top"><?= GetMessage("SEARCH_AND") ?></td>
                    <td valign="top">and, &amp;, +</td>
                    <td><?= GetMessage("SEARCH_AND_ALT") ?></td>
                </tr>
                <tr>
                    <td align="center" valign="top"><?= GetMessage("SEARCH_OR") ?></td>
                    <td valign="top">or, |</td>
                    <td><?= GetMessage("SEARCH_OR_ALT") ?></td>
                </tr>
                <tr>
                    <td align="center" valign="top"><?= GetMessage("SEARCH_NOT") ?></td>
                    <td valign="top">not, ~</td>
                    <td><?= GetMessage("SEARCH_NOT_ALT") ?></td>
                </tr>
                <tr>
                    <td align="center" valign="top">( )</td>
                    <td valign="top">&nbsp;</td>
                    <td><?= GetMessage("SEARCH_BRACKETS_ALT") ?></td>
                </tr>
            </table>


        <? elseif (count($arResult["SEARCH"]) > 0): ?>

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


    <? if ($arParams["DISPLAY_BOTTOM_PAGER"] == "Y"): ?>
        <div class="catalog-cards-navigation">

            <?= $arResult['NAV_STRING'] ?>

            <? if ($page < $totalPages) { ?>
                <div class="catalog-cards-links">
                    <a href="" class="btn btn-secondary btn-blue ix-show-more-btn"
                       data-url="<?= $APPLICATION->GetCurPageParam($pageN . '=' . ($page + 1), [$pageN, 'clear_cache']) ?>"></a>
                </div>
            <? } ?>
        </div>
    <? endif; ?>


    <? else: ?>

        <div class="nothingToFind">
            <p>По вашему запросу ничего не найдено</p>
        </div>

    <? endif; ?>

</section>
