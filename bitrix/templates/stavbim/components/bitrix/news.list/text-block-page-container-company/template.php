<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="about-company-text-block">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="one-text-block" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <?if($arItem["PROPERTIES"]["PICTURE_LEFT"]["VALUE"] != ""):?>
                <div class="picture left-side">
                    <?$arFile_1 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_LEFT"]["VALUE"]);?>
                    <img src="<?=$arFile_1["SRC"]?>" alt="<?=$arFile_1["ALT"]?>">
                </div>
            <?endif;?>
            <div class="one-text-block-container">
                <?if($arItem["PROPERTIES"]["PICTURE_RIGHT"]["VALUE"] != ""):?>
                    <div class="picture right-side">
                        <?$arFile_1 = CFile::GetFileArray($arItem["PROPERTIES"]["PICTURE_RIGHT"]["VALUE"]);?>
                        <img src="<?=$arFile_1["SRC"]?>" alt="<?=$arFile_1["ALT"]?>">
                    </div>
                <?endif;?>
                <?=$arItem["PREVIEW_TEXT"]?>
            </div>

        </div>
    <?endforeach;?>
</div>
