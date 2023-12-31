<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<script>
    //slider Yousee
    window.addEventListener('DOMContentLoaded', () => {
        $('.yousee__slider').slick({
            dots: true,
            infinite: false,
            arrows: true,
            dotsClass: 'slick-dots similar__dots',
            slidesToShow: 1,
            slidesToScroll: 1,
        });
    });
</script>

<div class="yousee__slider">
    <?
    $worksCounter = 1;
    $sliderItemCounter = 0;

    if(!empty($arResult['ITEMS'])) {
        $counter = count($arResult['ITEMS']);
    }
    ?>
    <? foreach ($arResult['ITEMS'] as $arItem): ?>

        <?
        $arProps = $arItem['PROPERTIES'];

        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <?if($worksCounter == 1):?>
            <div class="yousee__slider__item">
                <div class="yousee__slider__inner">
        <?endif;?>

        <? if ($worksCounter == 1 || $worksCounter == 6): ?>
            <div class="yousee__slider__inner__item big">
        <? else: ?>
            <div class="yousee__slider__inner__item">
        <? endif; ?>

                <div class="yousee__slider__item-wrapper product-buy-block" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="yousee__slider__item-img">
                        <? $arFile = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURES"]["VALUE"][0]); ?>
                        <img src="<?= $arFile["SRC"] ?>" alt="">
                        <?if($arItem["PROPERTIES"]["PDF_FILE"]["VALUE"]):?>
                            <img src="/design/icons/works_icon.svg" style="height: 45px; width: 45px" class="myworks__block__slider__item-img-pdf" alt="">
                        <?endif;?>
                    </a>
                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="yousee__slider__item-text">
                        <div class="yousee__slider__item-text-title"><?=$arResult["SECTIONS_LIST"][$arItem["IBLOCK_SECTION_ID"]]?></div>
                        <div class="yousee__slider__item-text-descr"><?= $arItem["NAME"] ?></div>
                        <div class="yousee__slider__item-text-price"><?=number_format($arItem["PROPERTIES"]["PRICE"]["VALUE"], 0, ',', ' ')?> ₽</div>
                    </a>
                    <button class="yousee__slider__item-text-btn add2Cart product-buy-link" data-id="<?=$arItem["ID"]?>" data-itemid="<?=$arItem["ID"]?>" data-price="<?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?>">Добавить в корзину</button>
                </div>
            </div>

            <?$worksCounter++;?>
            <?$sliderItemCounter++;?>

            <?if($worksCounter == 7):?>
                <?$worksCounter = 1;?>
            <?endif;?>

            <?if($worksCounter == 1 or $sliderItemCounter == $counter):?>
                    </div>
                </div>
            <?endif;?>

    <? endforeach; ?>

</div>


