<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<div class="catalog-cards-block">
    <? foreach ($arResult['ITEMS'] as $arItem): ?>
        <?
        $arProps = $arItem['PROPERTIES'];
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="catalog-cards-block-item">
            <div class="catalog-cards-block-item-wrapper product-buy-block" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="catalog-cards-block-item-img">
                    <? $arFile = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_DESKTOP"]["VALUE"]); ?>
                    <img src="<?= $arFile["SRC"] ?>" alt="">
                    <?if($arItem["PROPERTIES"]["PDF_FILE"]["VALUE"]):?>
                        <img src="/design/icons/works_icon.svg" class="works__icon" alt="">
                    <?endif;?>
                </a>
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="catalog-cards-block-item-text">
                    <div class="catalog-cards-block-item-text-title"><?=$arResult["SECTIONS_LIST"][$arItem["IBLOCK_SECTION_ID"]]?></div>
                    <div class="catalog-cards-block-item-text-descr"><?=$arItem["NAME"]?></div>
                    <div class="catalog-cards-block-item-text-price"><?=number_format($arItem["PROPERTIES"]["PRICE"]["VALUE"], 0, ',', ' ')?> ₽</div>
                </a>
                <button class="catalog-cards-block-item-text-btn add2Cart product-buy-link" data-id="<?=$arItem["ID"]?>" data-itemid="<?=$arItem["ID"]?>" data-price="<?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?>">Добавить в корзину</button>
            </div>
        </div>
    <? endforeach; ?>
</div>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <br/><?= $arResult["NAV_STRING"] ?>
<? endif; ?>


