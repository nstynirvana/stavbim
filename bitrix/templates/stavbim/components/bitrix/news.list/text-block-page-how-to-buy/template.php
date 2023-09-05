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


<section class="howToBuy_page">
    <div class="container">
        <h1 class="howToBuy__title">Как купить</h1>

        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>

            <div class="howToBuy__wrapper_page" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <? $arFile = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_LEFT"]["VALUE"]); ?>
                <div class="howToBuy__img">
                    <div class="howToBuy__img__wrapper">
                        <img src="<?= $arFile["SRC"] ?>" alt="">
                    </div>
                </div>
                <div class="howToBuy__text">
                    <h2 class="howToBuy__text__title"><?= $arItem["NAME"] ?></h2>
                    <div class="howToBuy__text__descr"><?= $arItem["PREVIEW_TEXT"] ?></div>
                </div>
            </div>
        <? endforeach; ?>
    </div>

</section>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <br/><?= $arResult["NAV_STRING"] ?>
<? endif; ?>

