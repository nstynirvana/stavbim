<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
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
    });
</script>

<section class="brands">
    <div class="container">
        <div class="works__title-wrapper">
            <h3 class="works__title">Готовые работы</h3>
            <a href="/my-works/" class="works__link">
                <p>Смотреть все</p>
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

                <?$sectionID = $arItem["IBLOCK_SECTION_ID"];?>

                <div class="works__card product-buy-block" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="works__img-container">
                        <?$arFile_1 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURES"]["VALUE"][0]);?>
                        <img src="<?=$arFile_1["SRC"]?>" class="works__img" alt="">
                        <?if($arItem["PROPERTIES"]["PDF_FILE"]["VALUE"]):?>
                            <img src="/design/icons/works_icon.svg" class="works__icon" alt="">
                        <?endif;?>
                    </a>
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="works__card-modal"><?=$arResult["SECTIONS_LIST"][$sectionID]?></a>
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="works__card-descr"><?=$arItem["NAME"]?></a>
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="works__card-price"><?=number_format($arItem["PROPERTIES"]["PRICE"]["VALUE"], 0, ',', ' ')?> ₽</a>
                    <button class="works__card-addToBasket add2Cart product-buy-link" data-id="<?=$arItem["ID"]?>" data-itemid="<?=$arItem["ID"]?>" data-price="<?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?>">Добавить модель в корзину</button>
                </div>
            <? endforeach; ?>
        </div>

        <div class="works__slider">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>

                <?$sectionID = $arItem["IBLOCK_SECTION_ID"];?>

                <div class="works__slide product-buy-block">
                    <div class="works__card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="works__img-container">
                            <?$arFile_1 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURES"]["VALUE"][0]);?>
                            <img src="<?=$arFile_1["SRC"]?>" class="works__img" alt="">
                            <?if($arItem["PROPERTIES"]["PDF_FILE"]["VALUE"]):?>
                                <img src="/design/icons/works_icon.svg" class="works__icon" alt="">
                            <?endif;?>
                        </a>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="works__card-modal"><?=$arResult["SECTIONS_LIST"][$sectionID]?></a>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="works__card-descr"><?=$arItem["NAME"]?></a>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="works__card-price"><?=number_format($arItem["PROPERTIES"]["PRICE"]["VALUE"], 0, ',', ' ')?> ₽</a>
                        <button class="works__card-addToBasket add2Cart product-buy-link" data-id="<?=$arItem["ID"]?>" data-itemid="<?=$arItem["ID"]?>" data-price="<?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?>">Добавить модель в корзину</button>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>