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
                </a>
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="similar__slider__item-text">
                    <?
                    $res = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
                    if ($ar_res = $res->GetNext())
                    ?>
                    <div class="similar__slider__item-text-title"><?= $ar_res['NAME'] ?></div>
                    <div class="similar__slider__item-text-descr"><?= $arItem["NAME"] ?></div>
                    <div class="similar__slider__item-text-price"><?= $arItem["PROPERTIES"]["PRICE"]["VALUE"] ?></div>
                </a>
                <button class="similar__slider__item-text-btn">Добавить в корзину</button>
            </div>
        </div>
    <? endforeach; ?>

</div>
