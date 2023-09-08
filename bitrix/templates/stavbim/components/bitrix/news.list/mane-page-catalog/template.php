<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?><br/>
<? endif; ?>

<section class="catalog">
    <div class="container">
        <h2 class="catalog__title">Каталог</h2>
        <div class="catalog__cards-block">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>


            <div class="catalog__card" style="height: auto;" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" class="catalog__card-wrapper">
                    <div class="catalog__card-img">
                        <?$arFile_1 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_DESKTOP"]["VALUE"]);?>
                        <?$arFile_2 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_TABLET"]["VALUE"]);?>
                        <img src="<?=$arFile_1["SRC"]?>" class="catalog__card-img-desc" alt="">
                        <img src="<?=$arFile_2["SRC"]?>" class="catalog__card-img-tablet" alt="">
                    </div>
                    <div class="catalog__card-descr">
                        <?= $arItem["NAME"] ?>
                    </div>
                </a>
                </div><? endforeach; ?>
        </div>
    </div>
</section>


<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <br/><?= $arResult["NAV_STRING"] ?>
<? endif; ?>
