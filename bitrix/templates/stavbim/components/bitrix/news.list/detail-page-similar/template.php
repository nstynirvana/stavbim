<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>


<div class="similar__slider">

    <? foreach ($arResult['ITEMS'] as $arItem): ?>

        <?
        $arProps = $arItem['PROPERTIES'];

        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <div class="similar__slider__item">

            <div class="similar__slider__item-wrapper" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <? /*dp($arItem)*/?>
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="similar__slider__item-img">
                    <? $arFile = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_DESKTOP"]["VALUE"]); ?>
                    <img src="<?= $arFile["SRC"] ?>" alt="">
                    <?if($arItem["PROPERTIES"]["PDF_FILE"]["VALUE"]):?>
                        <img src="/design/icons/works_icon.svg" class="works__icon" alt="">
                    <?endif;?>
                </a>
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="similar__slider__item-text">
                    <div class="similar__slider__item-text-title"><?=$arResult["SECTIONS_LIST"][$arItem["IBLOCK_SECTION_ID"]]?></div>
                    <div class="similar__slider__item-text-descr"><?= $arItem["NAME"] ?></div>
                    <div class="similar__slider__item-text-price"><?=number_format($arItem["PROPERTIES"]["PRICE"]["VALUE"], 0, ',', ' ')?> ₽</div>
                </a>
                <button class="similar__slider__item-text-btn add2Cart" data-itemid="<?=$arItem["ID"]?>" data-price="<?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?>">Добавить в корзину</button>
            </div>
        </div>
    <? endforeach; ?>

</div>
