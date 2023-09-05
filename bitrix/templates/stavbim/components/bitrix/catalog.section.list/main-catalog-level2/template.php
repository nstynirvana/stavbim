<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        //slider Product
        $('.product__list-slider').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                    }
                }
            ]
        });
    });</script>


<?//dp($arResult["SECTION"]); ?>

<section class="product">
    <div class="product__info">
        <?$arFile = CFile::GetFileArray($arResult["SECTION"]["DETAIL_PICTURE"]);?>
        <div class="product__info-img"><img src="<?= $arFile["SRC"] ?>" alt=""></div>
        <div class="product__info-block">
            <h1 class="product__info-block-title"><?= $arResult["SECTION"]["NAME"] ?></h1>
            <h2 class="product__info-block-descr"><?= $arResult["SECTION"]["DESCRIPTION"] ?></h2>
        </div>
    </div>
    <div class="product__list">
        <? foreach ($arResult["SECTIONS"] as $arSection): ?>
        <div class="product__list-block">
            <a href="<?= $arSection["CODE"] ?>/" class="product__list-block-item">
                <div class="product__list-block-item-link"><?= $arSection["NAME"] ?></div>
            </a>
        </div>
        <?endforeach;?>
    </div>

    <div class="product__list-slider">
        <? foreach ($arResult["SECTIONS"] as $arSection): ?>
            <div style="width: auto!important" class="product__list-block">
                <a href="<?= $arSection["CODE"] ?>/" class="product__list-block-item">
                    <div class="product__list-block-item-link"><?= $arSection["NAME"] ?></div>
                </a>
            </div>
        <? endforeach; ?>
    </div>

</section>
