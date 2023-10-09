<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
$page = $arResult['NAV_RESULT']->NavPageNomer;
$totalPages = $arResult['NAV_RESULT']->NavPageCount;
$pageN = "PAGEN_".$arResult['NAV_RESULT']->NavNum;
?>

<div class="catalog-cards-block-container-with-nav">

    <div class="catalog-cards-block ix-list-block">

        <? foreach ($arResult['ITEMS'] as $arItem): ?>

            <?
            $arProps = $arItem['PROPERTIES'];

            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>

            <div id="content" class="item__catalog-cards-block-item ix-list-item">

                <div class="catalog-cards-block-item-wrapper product-buy-block" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="catalog-cards-block-item-img">
                        <? $arFile = CFile::GetFileArray(($arItem["PROPERTIES"]["PICTURES"]["VALUE"][0])); ?>
                        <img src="<?= $arFile["SRC"] ?>" alt="">
                        <?if($arItem["PROPERTIES"]["PDF_FILE"]["VALUE"]):?>
                            <img src="/design/icons/works_icon.svg" class="works__icon" alt="">
                        <?endif;?>
                    </a>
                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="catalog-cards-block-item-text">
                        <div class="catalog-cards-block-item-text-title"><?=$arResult["SECTIONS_LIST"][$arItem["IBLOCK_SECTION_ID"]]?></div>
                        <div class="catalog-cards-block-item-text-descr"><?= $arItem["NAME"]  ?></div>
                        <div class="catalog-cards-block-item-text-price"><?=number_format($arItem["PROPERTIES"]["PRICE"]["VALUE"], 0, ',', ' ')?> ₽</div>
                    </a>
                    <button class="catalog-cards-block-item-text-btn add2Cart product-buy-link" data-id="<?=$arItem["ID"]?>" data-itemid="<?=$arItem["ID"]?>" data-price="<?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?>">Добавить в корзину</button>
                </div>
            </div>
        <? endforeach; ?>
    </div>

</div>

<?if($page != $totalPages):?>
    <?if($totalPages != 0):?>
        <div class="action ix-nav-block">
            <a href="#" class="btn btn-primary btn-outline ix-show-more-btn"  data-url="<?= $APPLICATION->GetCurPageParam($pageN.'=' . ($page + 1), [$pageN, 'clear_cache']) ?>">
                Показать еще
            </a>

            <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                <?= $arResult["NAV_STRING"] ?>
            <? endif; ?>

        </div>
    <?endif;?>
<?endif;?>