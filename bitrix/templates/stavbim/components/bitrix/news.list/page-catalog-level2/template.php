<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$this->setFrameMode(true);
?>
<? //
//echo "<pre>";
//print_r($arResult);
//echo "</pre>";
//?>


<? // echo "<pre>"; print_r($arResult); echo "</pre>";?>



<div class="catalog-cards-block">

    <? foreach ($arResult['ITEMS'] as $arItem): ?>
        <?//dp($arItem);?>
        <?
        $arProps = $arItem['PROPERTIES'];

        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <div class="catalog-cards-block-item">

            <div class="catalog-cards-block-item-wrapper" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="catalog-cards-block-item-img">
                    <? $arFile = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_DESKTOP"]["VALUE"]); ?>
                    <img src="<?= $arFile["SRC"] ?>" alt="">
                </a>
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="catalog-cards-block-item-text">
                    <?
                    $res = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
                    if ($ar_res = $res->GetNext())
                    ?>
                        <div class="catalog-cards-block-item-text-title"><?= $ar_res['NAME'] ?></div>
                    <div class="catalog-cards-block-item-text-descr"><?= $arItem["NAME"] ?></div>
                    <div class="catalog-cards-block-item-text-price"><?= $arItem["PROPERTIES"]["PRICE"]["VALUE"] ?></div>
                </a>
                <button class="catalog-cards-block-item-text-btn">Добавить в корзину</button>
            </div>
        </div>
    <? endforeach; ?>
</div>


<? /*echo "<pre>";
print_r($arResult['SHOW_COUNTER']);
echo "</pre>"; */ ?>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <br/><?= $arResult["NAV_STRING"] ?>
<? endif; ?>
