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
    <section class="about-company" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="container">
            <div class="about-company__wrapper">
                <div class="about-company__text-block">
                    <h2 class="about-company__title"><?=$arItem["NAME"]?></h2>
                    <?=$arItem["PREVIEW_TEXT"]?>
                </div>
                <div class="about-company__img-block">
                    <img src="/design/img/aboutCompany.png" alt="About company" class="about-company__img">
                    <img src="/design/img/aboutCompanyMedium.png" alt="About company" class="about-company__img-medium">
                    <img src="/design/img/about-company-tablet.jpg" alt="About company" class="about-company__img-tablet">
                    <img src="/design/img/aboutCompanyMobile.jpg" alt="About company" class="about-company__img-mobile">
                </div>
            </div>
        </div>
    </section>
    <?echo "<pre style=display:none;>"; print_r($arItem); echo "</pre>";?>

<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

