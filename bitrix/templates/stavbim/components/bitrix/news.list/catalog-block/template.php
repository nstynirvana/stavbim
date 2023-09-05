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

<? $counter = 0; ?>
<? $countElements = count($arResult); ?>

<? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

    <div class="catalog__card">
        <a href="<?= $arItem["LINK"] ?>" class="catalog__card-wrapper">
            <div class="catalog__card-img">
                <? $arFile_1 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_DESKTOP"]["VALUE"]); ?>
                <? $arFile_2 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_TABLET"]["VALUE"]); ?>
                <img src="<?= $arFile_1["SRC"] ?>" class="catalog__card-img-desc" alt="">
                <img src="<?= $arFile_2["SRC"] ?>" class="catalog__card-img-tablet" alt="">
            </div>
            <div class="catalog__card-descr"><p><?= $arItem["NAME"] ?></p></div>
        </a>
        <div class="accordion__wrapper openable">
            <div class="accordion__link"><a href="/catalog_grade_2.html">Кран шаровый</a></div>
            <div class="accordion__link"><a href="/catalog_grade_2.html">Обратный клапан</a></div>
            <div class="accordion__link"><a href="/catalog_grade_2.html">Вентиль</a></div>
            <div class="accordion__link"><a href="/catalog_grade_2.html">Клапан предохранительный</a></div>
            <div class="accordion__hidden">
                <div class="accordion__hidden__link"><a href="/catalog_grade_2.html">Lorem, ipsum.</a></div>
                <div class="accordion__hidden__link"><a href="/catalog_grade_2.html">Lorem, ipsum.</a></div>
                <div class="accordion__hidden__link"><a href="/catalog_grade_2.html">Lorem, ipsum.</a></div>
                <div class="accordion__hidden__link"><a href="/catalog_grade_2.html">Lorem, ipsum.</a></div>
            </div>
<!--            <div class="accordion__link"><a href="--><?php //= $arItem["LINK_PRODUCT"] ?><!--">--><?php //= $arItem["PREVIEW_TEXT"] ?><!--</a></div>-->
<!--            <div class="accordion__hidden">-->
<!--                <div class="accordion__hidden__link"><a href="--><?php //= $arItem["LINK_PRODUCT"] ?><!--">--><?php //= $arItem["PREVIEW_TEXT"] ?><!--</a></div>-->
<!--            </div>-->
            <div class="accordion__more-btn">Показать еще</div>
        </div>
    </div>

<? endforeach; ?>


<? echo "<pre>";//print_r($arResult);
echo "</pre>"; ?>

