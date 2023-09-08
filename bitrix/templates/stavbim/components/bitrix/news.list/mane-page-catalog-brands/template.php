<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
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
    });
</script>

<section class="brands">
    <div class="container">
        <div class="brands__title-wrapper">
            <h3 class="brands__title">Бренды</h3>
            <a href="/brands/" class="brands__link">
                <p>Смотреть все</p>
                <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 7H16M16 7L10 1M16 7L10 13" stroke="currentColor"/>
                </svg>
            </a>
        </div>
        <div class="brands__wrapper">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="brands__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>">
                </div>
            <? endforeach; ?>
        </div>

        <div class="brands__slider">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <div class="brands__slide">
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" class="brands__slide-img" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>">
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>