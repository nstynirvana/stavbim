<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <section class="brandsBlockText">
        <div class="container" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <h2 class="brandsBlock__title"><?= $arItem["NAME"] ?></h2>
            <span class="brandsBlockText__text"><?= $arItem["PREVIEW_TEXT"] ?></span>
        </div>
    </section>

<? endforeach; ?>