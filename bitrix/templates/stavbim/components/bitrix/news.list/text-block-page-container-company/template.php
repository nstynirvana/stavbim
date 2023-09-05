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
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <section class="aboutCompany" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

        <div class="container">
            <?$arFile_1 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_RIGHT"]["VALUE"]);?>
            <?$arFile_2 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_LEFT"]["VALUE"]);?>
            <img src="/design/img/aboutCompany/aboutCompany1.png" alt="" class="onlymobilevisible">
            <h1 class="aboutCompany__title"><?=$arItem["NAME"]?></h1>
            <div class="aboutCompany__wrapper">
                <div class="aboutCompany__text">
                    <?=$arItem["PREVIEW_TEXT"]?>
                </div>
                <div class="aboutCompany__img">
                    <img src="<?=$arFile_1["SRC"]?>" alt="">
                </div>
            </div>
            <p class="onlytablevisible"><?=$arItem["DETAIL_TEXT"]?></p>
            <div class="aboutCompany__wrapper">
                <div class="aboutCompany__img">
                    <img src="<?=$arFile_2["SRC"]?>" alt="">
                </div>
                <div class="aboutCompany__text">
                    <?=$arItem["PREVIEW_TEXT"]?>
                </div>
            </div>
            <p class="onlytablevisible"><?=$arItem["DETAIL_TEXT"]?></p>
        </div>

    </section>
    <?echo "<pre style=display:none;>"; print_r($arItem); echo "</pre>";?>

<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

