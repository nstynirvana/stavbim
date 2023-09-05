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

<section class="howtobuy">
    <div class="container">
        <h3 class="howtobuy__title_main">Как купить</h3>
        <div class="howtobuy__wrapper">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="howtobuy__row" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="howtobuy__img">
                        <? $arFile = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_DESKTOP"]["VALUE"]); ?>
                        <img src="<?= $arFile["SRC"] ?>" alt="">
                    </div>
                    <div class="howtobuy__descr">
                        <?= $arItem["PREVIEW_TEXT"] ?>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>
<?//echo "<pre style=display:none;>"; print_r($arItem); echo "</pre>";?>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <br/><?= $arResult["NAV_STRING"] ?>
<? endif; ?>
