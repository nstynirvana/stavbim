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
<? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

    <section class="order" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <div class="container">
            <div class="order__wrapper">
                <?$arFile_1 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_RIGHT"]["VALUE"]);?>
                <div class="order__text">
                    <h1 class="order__title"><?= $arItem["NAME"] ?></h1>
                    <div class="order__descr">
                        <?= $arItem["PREVIEW_TEXT"] ?>
                    </div>
                    <button class="order__btn">
                        <p>Связаться со мной</p>
                        <img src="/design/icons/telegram.svg"  alt="">
                    </button>
                </div>
                <div class="order__img">

                    <img src="<?=$arFile_1["SRC"]?>" alt="">
                </div>
            </div>
        </div>
    </section>

<? endforeach; ?>

