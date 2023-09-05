<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
?>
<?
$currentPage = $arResult["NavPageNomer"];
$startPage = $arResult["nStartPage"];
$endPage = $arResult["nEndPage"];
$countPages = $arResult["NavPageCount"];
$navNum = $arResult["NavNum"];
?>

<div class="catalog-cards-navigation">
    <div class="catalog-cards-links">
        <? if ($currentPage > 1) { ?>
            <? if ($currentPage > 2) { ?>
                <a data-navnum="<?= $navNum ?>" class="catalog-cards-navigation-prev" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $navNum ?>=<?= ($currentPage - 1) ?>"><img src="/design/icons/nav_prev.svg" alt=""></a>
            <? } else { ?>
                <a data-navnum="<?= $navNum ?>" class="catalog-cards-navigation-prev" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><img src="/design/icons/nav_prev.svg" alt=""></a>
            <? } ?>
        <? } else { // Если страница первая?>
            <a class="catalog-cards-navigation-prev" href=""><img src="/design/icons/nav_prev.svg" alt=""></a>
        <? } ?>

        <? $i = 1; ?>
        <? while ($startPage <= $endPage) { ?>
            <?
            $isActivePage = ($startPage == $currentPage);
            $class = $isActivePage ? ' active' : '';
            $page = $isActivePage ? $currentPage : $startPage;
            ?>
            <div  class="catalog-cards-links-item<?= $class ?>">
                <? if ($isActivePage) { ?>
                    <a data-page="<?= $page ?>" data-countpages="<?= $countPages ?>" data-navnum="<?= $navNum ?>"> <?= $startPage ?></a>
                <? } elseif ($i == 5) { ?>
                    <a data-page="<?= $countPages ?>" data-navnum="<?= $navNum ?>" data-countpages="<?= $countPages ?>" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $navNum ?>=<?= $countPages ?>"><?= $countPages ?></a>
                <? } else { ?>
                    <a data-page="<?= $page ?>" data-navnum="<?= $navNum ?>" data-countpages="<?= $countPages ?>" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $navNum ?>=<?= $startPage ?>"><?= $startPage ?></a>
                <? } ?>
            </div>
            <? if ($i == 4 && $countPages > 4) { ?>
                <span class="catalog-cards-links-down">...</span>
            <? } ?>
            <? $i++; ?>
            <? $startPage++ ?>
        <? } ?>
        <? if ($currentPage < $countPages) { ?>
            <a data-navnum="<?= $navNum ?>" class="catalog-cards-navigation-next" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $navNum ?>=<?= ($currentPage + 1) ?>"><img src="/design/icons/nav_next.svg" alt=""></a>
        <? } else { // Если страница последняя ?>
            <a data-navnum="<?= $navNum ?>" class="catalog-cards-navigation-next" href=""><img src="/design/icons/nav_next.svg" alt=""></a>
        <? } ?>
    </div>
</div>


<?//
//echo "<pre>";
////print_r($arResult);
//echo "</pre>";
//?>
