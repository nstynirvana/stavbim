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
<? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?><br/>
<? endif; ?>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        $('.works__slider').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 1,
            variableWidth: true,
            arrows: false,
            dotsClass: 'slick-dots brands__dots',
        });
    });</script>

<section class="brands">

    <div class="container">
        <div class="works__title-wrapper">
            <h3 class="works__title">Готовые работы</h3>
            <a href="/my-works/" class="works__link">
                <p>
                    Смотреть все
                </p>
                <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 7H16M16 7L10 1M16 7L10 13" stroke="currentColor"/>
                </svg>
            </a>
        </div>

        <div class="works__wrapper">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>

<!--                --><?//dp($arItem["PROPERTIES"]["PRICE"]["VALUE"]);?>

                <div class="works__card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <a href="<?= $arItem["LINK_PRODUCT"] ?>" class="works__img-container">
                        <?$arFile_1 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_DESKTOP"]["VALUE"]);?>
                        <?$arFile_2 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_FILE"]["VALUE"]);?>
                        <img src="<?=$arFile_1["SRC"]?>" class="works__img" alt="">
                        <img src="<?=$arFile_2["SRC"]?>" class="works__icon" alt="">
                        <a href="<?= $arItem["LINK_PRODUCT"] ?>" class="works__card-modal">Модель для проектирования</a>
                        <a href="<?= $arItem["LINK_PRODUCT"] ?>" class="works__card-descr"><?=$arItem["NAME"]?></a>
                        <a href="<?= $arItem["LINK_PRODUCT"] ?>" class="works__card-price"><?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?></a>
                        <button class="works__card-addToBasket">Добавить модель в корзину</button>
                </div>
            <? endforeach; ?>
        </div>

        <div class="works__slider">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <div class="works__slide">
                    <div class="works__card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="works__img-container">
                            <?$arFile_1 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_DESKTOP"]["VALUE"]);?>
                            <?$arFile_2 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_FILE"]["VALUE"]);?>
                            <img src="<?=$arFile_1["SRC"]?>" class="works__img" alt="">
                            <img src="<?=$arFile_2["SRC"]?>" class="works__icon" alt="">
                            <a href="<?= $arItem["LINK_PRODUCT"] ?>" class="works__card-modal">Модель для проектирования</a>
                            <a href="<?= $arItem["LINK_PRODUCT"] ?>" class="works__card-descr"><?=$arItem["NAME"]?></a>
                            <a href="<?= $arItem["LINK_PRODUCT"] ?>" class="works__card-price"><?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?></a>
                            <button class="works__card-addToBasket">Добавить модель в корзину</button>
                    </div>
                </div>
            <? endforeach; ?>
        </div>

    </div>

</section>

