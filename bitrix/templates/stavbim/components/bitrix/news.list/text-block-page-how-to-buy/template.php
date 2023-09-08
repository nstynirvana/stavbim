<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

    <div class="howToBuy__wrapper" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
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