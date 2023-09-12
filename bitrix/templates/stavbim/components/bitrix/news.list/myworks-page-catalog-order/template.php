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

<div class="brands__title-wrapper">
    <h3 class="brands__title">Примеры работ</h3>
    <a href="/my-works/" class="brands__link"><p>Смотреть все</p>
        <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 7H16M16 7L10 1M16 7L10 13" stroke="currentColor"/>
        </svg>
    </a>
</div>


<? $worksCounter = 1; ?>
<div class="yousee__slider__item">
    <div class="yousee__slider__inner">
<? foreach ($arResult['ITEMS'] as $arItem): ?>

<?
$arProps = $arItem['PROPERTIES'];

$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>


<? if ($worksCounter == 1 || $worksCounter == 6): ?>
        <div class="yousee__slider__inner__item big">
    <? else: ?>
            <div class="yousee__slider__inner__item">
        <? endif; ?>

        <div class="yousee__slider__item-wrapper" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <a href="<?= $arItem["LINK_PRODUCT"] ?>" class="yousee__slider__item-img">
                <? $arFile_1 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURES"]["VALUE"][0]); ?>
                <img src="<?= $arFile_1["SRC"] ?>" alt="">
            </a>
            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="yousee__slider__item-text">
                <div class="yousee__slider__item-text-title"><?=$arResult["SECTIONS_LIST"][$arItem["IBLOCK_SECTION_ID"]]?>
                <?dp($arResult["SECTIONS_LIST"])?></div>
                <div class="yousee__slider__item-text-descr"><?= $arItem["NAME"] ?></div>
                <div class="yousee__slider__item-text-price"><?=number_format($arItem["PROPERTIES"]["PRICE"]["VALUE"], 0, ',', ' ')?> ₽</div>
            </a>
            <button class="similar__slider__item-text-btn">Добавить в корзину</button>
        </div>
    </div>
    <? $worksCounter++ ?>
    <? endforeach; ?>
</div>
</div>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <br/><?= $arResult["NAV_STRING"] ?>
<? endif; ?>

