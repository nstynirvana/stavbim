<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<script>
    //slider Product.html
    window.addEventListener('DOMContentLoaded', () => {
        $('.product-card__slider').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 1,
            variableWidth: true,
            arrows: true,
            dotsClass: 'slick-dots product-card__dots',
        });
    });
</script>

<?$sectionName = array_pop($arResult["SECTION"]["PATH"]);?>

<div class="container product-container">
    <a href="<?=$sectionName["SECTION_PAGE_URL"]?>" class="back-to-page">
        <img src="/design/icons/back-to-page.svg" alt="Back Arrow" class="back-to-page-img">
        <p class="back-to-page-text">Вернуться назад</p>
        <img src="/design/icons/back-to-page-mobile.svg" alt="Back Arrow" class="back-to-page-img-mobile">
    </a>
</div>

<section class="product-card">
    <div class="container product-card-container">

        <div class="product-card__wrapper">
            <div class="product-card__slider__wrapper">
                <div class="product-card__slider">
                    <?if(!empty($arResult["PROPERTIES"]["PICTURES"]["VALUE"])):?>
                        <?foreach($arResult["PROPERTIES"]["PICTURES"]["VALUE"] as $pictureOne):?>
                            <?$arFile_1 = CFile::GetFileArray($pictureOne); ?>
                            <img src="<?= $arFile_1["SRC"] ?>" alt="" class="product-card__slider__item">
                        <?endforeach;?>
                    <?else:?>
                        <? $arFile_1 = CFile::GetFileArray($arResult["PROPERTIES"]["PICTURE_DESKTOP"]["VALUE"]); ?>
                        <img src="<?= $arFile_1["SRC"] ?>" alt="" class="product-card__slider__item">
                    <?endif;?>
                </div>
            </div>
            <div class="product-card__text product-buy-block">
                <div class="product-card__text__prevtitle"><?=$sectionName['NAME']?></div>
                <h1 class="product-card__text__title"><?= $arResult["NAME"] ?></h1>
                <div class="product-card__text__price"><?=number_format($arResult["PROPERTIES"]["PRICE"]["VALUE"], 0, ',', ' ')?> ₽</div>
                <button class="product-card__text__btn add2Cart product-buy-link" data-id="<?=$arResult["ID"]?>" data-itemid="<?=$arResult["ID"]?>" data-price="<?=$arResult["PROPERTIES"]["PRICE"]["VALUE"]?>">Добавить в корзину</button>
                <div class="product-card__text__wrapper">
                    <?foreach($arResult["DISPLAY_PROPERTIES"] as $propCode => $propArray):?>

                        <?if($propArray["PROPERTY_TYPE"] == "E"):?>
                            <?$visibleValue = $propArray["LINK_ELEMENT_VALUE"][$propArray["VALUE"]]["NAME"];?>
                        <?else:?>
                            <?$visibleValue = $propArray["DISPLAY_VALUE"];?>
                        <?endif;?>

                        <div class="product-card__text__manufacturer__block">
                            <div class="product-card__text__manufacturer__item"><?=$propArray["NAME"]?></div>
                            <div class="product-card__text__manufacturer__value"><?=$visibleValue?></div>
                        </div>
                    <?endforeach;?>
                </div>
                <?if(!empty($arResult["PROPERTIES"]["TYPE_SIZE"]["VALUE"])):?>
                    <div class="product-card__text__sizes">Доступные типоразмеры:</div>
                    <div class="product-card__text__sizes__block">
                        <div class="product-card__text__sizes__accordion">
                            <div class="product-card__text__sizes__wrapper">
                                <?foreach($arResult["PROPERTIES"]["TYPE_SIZE"]["VALUE"] as $item):?>
                                    <div class="product-card__text__sizes__item__inner"><p><?=$item?></p></div>
                                <?endforeach;?>
                            </div>
                            <div class="product-card__text__sizes__btn-close"></div>
                        </div>
                    </div>
                    <div class="product-card__text__sizes__btn-open">Показать все типоразмеры</div>
                <?endif;?>
            </div>
        </div>
        <?if($arResult["DETAIL_TEXT"] != ""):?>
            <div class="product-card__description">
                <h2 class="product-card__description__title">Описание</h2>
                <?=$arResult["DETAIL_TEXT"]?>
            </div>
        <?endif;?>

    </div>
</section>
