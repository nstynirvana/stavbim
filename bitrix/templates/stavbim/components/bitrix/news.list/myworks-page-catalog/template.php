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
<?//dp($arResult)?>
<? $worksCounter = 1; ?>
    <div class="myworks__block__slider__inner" ">

<? foreach ($arResult['ITEMS'] as $arItem): ?>

    <?
    $arProps = $arItem['PROPERTIES'];

    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>


    <? if ($worksCounter == 1 || $worksCounter == 6): ?>
        <div class="myworks__block__slider__inner__item big">
    <? else: ?>
        <div class="myworks__block__slider__inner__item">
    <? endif; ?>

    <div class="myworks__block__slider__item-wrapper" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <a href="<?= $arItem["LINK_PRODUCT"] ?>" class="myworks__block__slider__item-img">
            <? $arFile_1 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURES"]["VALUE"][0]); ?>
            <? $arFile_2 = CFile::GetFileArray($arItem["PROPERTIES"]["PDF_FILE"]["VALUE"]); ?>
            <img src="<?= $arFile_1["SRC"] ?>" class="myworks__block__slider__item-img-main" alt="">
            <img src="<?= $arFile_2["SRC"] ?>" class="myworks__block__slider__item-img-pdf" alt="">
        </a>
        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="myworks__block__slider__item-text">
            <div class="myworks__block__slider__item-text-title"><?=$arResult["SECTIONS_LIST"][$arItem["IBLOCK_SECTION_ID"]]?></div>
            <div class="myworks__block__slider__item-text-descr"><?= $arItem["NAME"] ?></div>
            <div class="myworks__block__slider__item-text-price"><?=number_format($arItem["PROPERTIES"]["PRICE"]["VALUE"], 0, ',', ' ')?> ₽</div>
        </a>
        <button class="similar__slider__item-text-btn">Добавить в корзину</button>
    </div>
    </div>
    <? $worksCounter++ ?>
<? endforeach; ?>
    </div>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
<? endif; ?>