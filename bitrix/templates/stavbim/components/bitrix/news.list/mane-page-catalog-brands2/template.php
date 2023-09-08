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

<?foreach($arResult["SECTIONS_LIST"] as $groupId => $groupArray):?>

    <section class="brandsBlock">
        <div class="container">
            <h2 class="brandsBlock__title"><?=$groupArray["NAME"]?></h2>

            <div class="brandsBlock__wrapper">
                <?foreach($groupArray["ITEMS"] as $itemKey => $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="brandsBlock__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></div>
                <?endforeach;?>
            </div>
            <div class="brandsBlock__slider">
                <!-- Slider -->
                <div class="brands__slider">
                    <?foreach($groupArray["ITEMS"] as $itemKey => $arItem):?>
                        <div class="brands__slide"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" class="brands__slide-img"></div>
                    <?endforeach;?>
                </div>
            </div>

        </div>
    </section>
<?endforeach;?>