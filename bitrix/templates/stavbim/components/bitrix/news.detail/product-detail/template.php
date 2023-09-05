<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<?/*dp($arResult)*/?>
<div class="product-card__wrapper">
    <div class="product-card__slider__wrapper">
        <div class="product-card__slider">
            <? $arFile_1 = CFile::GetFileArray($arResult["PROPERTIES"]["PICTURE_DESKTOP"]["VALUE"]); ?>
            <img src="<?= $arFile_1["SRC"] ?>" alt="" class="product-card__slider__item">
            <img src="<?= $arFile_1["SRC"] ?>" alt="" class="product-card__slider__item">
            <img src="<?= $arFile_1["SRC"] ?>" alt="" class="product-card__slider__item">
            <img src="<?= $arFile_1["SRC"] ?>" alt="" class="product-card__slider__item">
            <img src="<?= $arFile_1["SRC"] ?>" alt="" class="product-card__slider__item">
        </div>
    </div>
    <div class="product-card__text">

        <?
        $nav = CIBlockSection::GetNavChain(false, $arResult["IBLOCK_SECTION_ID"]);
        while($arItem = $nav->Fetch()){
            $ITEMS[] = $arItem;
        }
        ?>

        <div class="product-card__text__prevtitle"><?= $ITEMS['0']['NAME'] ?></div>
        <h1 class="product-card__text__title"><?= $arResult["NAME"] ?></h1>
        <div class="product-card__text__price"><?= $arResult["PROPERTIES"]["PRICE"]["VALUE"] ?></div>
        <button class="product-card__text__btn">Добавить в корзину</button>
        <div class="product-card__text__wrapper">
            <div class="product-card__text__vendor__block">
                <div class="product-card__text__vendor__item">Артикул</div>
                <div class="product-card__text__vendor__value"><?= $arResult["PROPERTIES"]["VENDOR_CODE"]["VALUE"] ?></div>
            </div>
            <div class="product-card__text__manufacturer__block">
                <div class="product-card__text__manufacturer__item">Производитель</div>
                <div class="product-card__text__manufacturer__value"><?= $arResult["PROPERTIES"]["PROCREATOR"]["VALUE"] ?></div>
            </div>
            <div class="product-card__text__category__block">
                <div class="product-card__text__category__item">Категория семейства</div>
                <div class="product-card__text__category__value"><?= $ITEMS['1']['NAME'] ?></div>
            </div>
            <div class="product-card__text__number__block">
                <div class="product-card__text__number__item">Номер OmniClass</div>
                <div class="product-card__text__number__value"><?= $arResult["PROPERTIES"]["OMNI_NUMBER"]["VALUE"] ?></div>
            </div>
            <div class="product-card__text__title__block">
                <div class="product-card__text__title__item">Заголовок OmniClass</div>
                <div class="product-card__text__title__value"><?= $arResult["PROPERTIES"]["OMNI_TITLE"]["VALUE"] ?></div>
            </div>
            <div class="product-card__text__link__block">
                <div class="product-card__text__link__item">Ссылка на продукт</div>
                <a href="" class="product-card__text__link__value"><?= $arResult["PROPERTIES"]["LINK_PRODUCT"]["VALUE"] ?></a>
            </div>
            <div class="product-card__text__version__block">
                <div class="product-card__text__version__item">Версия Revit</div>
                <div class="product-card__text__version__value"><?= $arResult["PROPERTIES"]["REVIT_VERSION"]["VALUE"] ?></div>
            </div>
        </div>
        <div class="product-card__text__sizes">Доступные типоразмеры:</div>
        <div class="product-card__text__sizes__block">
            <div class="product-card__text__sizes__accordion">
                <div class="product-card__text__sizes__wrapper">
                    <?foreach($arResult["PROPERTIES"]["TYPE_SIZE"]["VALUE"] as $item):?>
                    <div class="product-card__text__sizes__item__inner" id="<?= $this->GetEditAreaId($arResult['ID']); ?>">
                        <p>
                            <?=$item?>
                        </p>
                    </div>
                    <?endforeach;?>
                </div>
                <div class="product-card__text__sizes__btn-close"></div>
            </div>
        </div>
        <div class="product-card__text__sizes__btn-open">Показать все типоразмеры</div>
    </div>
</div>
<div class="product-card__description">
    <h2 class="product-card__description__title">Описание</h2>
    <div class="product-card__description__subtitle"><?=$arResult["PREVIEW_TEXT"]?></div>
    <h3 class="product-card__description__descr">Основной состав проекта:</h3>
    <div class="product-card__description__subdescr"><?=$arResult["DETAIL_TEXT"]?>
    </div>
</div>