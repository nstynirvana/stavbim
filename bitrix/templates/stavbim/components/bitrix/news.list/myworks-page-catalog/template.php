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
$page = $arResult['NAV_RESULT']->NavPageNomer;
$totalPages = $arResult['NAV_RESULT']->NavPageCount;
$pageN = "PAGEN_".$arResult['NAV_RESULT']->NavNum;
?>
<?//dp($arResult)?>
<? $worksCounter = 1; ?>
    <div id="content" class="myworks__block__slider__inner ix-list-block">

<? foreach ($arResult['ITEMS'] as $arItem): ?>

    <?
    $arProps = $arItem['PROPERTIES'];

    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>


    <? if ($worksCounter == 1 || $worksCounter == 6): ?>
        <div class="myworks__block__slider__inner__item big ix-list-item">
    <? else: ?>
        <div class="myworks__block__slider__inner__item ix-list-item">
    <? endif; ?>

    <div class="myworks__block__slider__item-wrapper" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="myworks__block__slider__item-img">
            <? $arFile_1 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURES"]["VALUE"][0]); ?>
            <img src="<?= $arFile_1["SRC"] ?>" class="myworks__block__slider__item-img-main" alt="">
            <?if(!empty($arItem["PROPERTIES"]["PDF_FILE"]["VALUE"])):?>
                <img src="/design/icons/works_icon.svg" class="myworks__block__slider__item-img-pdf" alt="">
            <?endif;?>
        </a>
        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="myworks__block__slider__item-text">
            <div class="myworks__block__slider__item-text-title"><?=$arResult["SECTIONS_LIST"][$arItem["IBLOCK_SECTION_ID"]]?></div>
            <div class="myworks__block__slider__item-text-descr"><?= $arItem["NAME"] ?></div>
            <div class="myworks__block__slider__item-text-price"><?=number_format($arItem["PROPERTIES"]["PRICE"]["VALUE"], 0, ',', ' ')?> ₽</div>
        </a>
        <button class="similar__slider__item-text-btn add2Cart product-buy-link" data-id="<?=$arItem["ID"]?>" data-itemid="<?=$arItem["ID"]?>" data-price="<?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?>">Добавить в корзину</button>
    </div>
    </div>
    <? $worksCounter++ ?>
<? endforeach; ?>
    </div>

<?if($page != $totalPages):?>
    <?if($totalPages != 0):?>
        <div class="action ix-nav-block">
            <a href="#" class="btn btn-primary btn-outline ix-show-more-btn"  data-url="<?= $APPLICATION->GetCurPageParam($pageN.'=' . ($page + 1), [$pageN, 'clear_cache']) ?>">
                Показать еще
            </a>

            <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                <?= $arResult["NAV_STRING"] ?>
            <? endif; ?>

        </div>
    <?endif;?>
<?endif;?>