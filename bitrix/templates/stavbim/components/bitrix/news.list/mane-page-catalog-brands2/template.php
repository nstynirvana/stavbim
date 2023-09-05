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
        $('.brands__slider').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 1,
            variableWidth: true,
            arrows: false,
            dotsClass: 'slick-dots brands__dots',
        });
    });</script>

<section class="brandsBlock">
    <div class="container">
        <h2 class="brandsBlock__title"><?= $arResult["SECTION"]["PATH"][0]["NAME"] ?></h2>
        <div class="brandsBlock__wrapper">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>

            <div class="brandsBlock__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <? $arFile = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_BRAND"]["VALUE"]); ?>
                <img src="<?= $arFile["SRC"] ?>" alt="">
            </div>
            <? endforeach; ?>
        </div>
        <div class="brandsBlock__slider">

            <!-- Slider -->
            <div class="brands__slider">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <div class="brands__slide">
                        <? $arFile = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_BRAND"]["VALUE"]); ?>
                        <img src="<?= $arFile["SRC"] ?>" class="brands__slide-img" alt="">
                    </div>
                <? endforeach; ?>
            </div>

        </div>
</section>


<?echo "<pre>";//print_r($arResult);
echo "</pre>"; ?>
