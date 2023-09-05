<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
$dir = explode('/', $arResult["FILTER_URL"]);

foreach ($arResult["ITEMS"] as $key => &$arItem) {
    if ($arItem["PRICE"] == 1) $arItem["DISPLAY_TYPE"] = 'A';

    if (
        $arItem["DISPLAY_TYPE"] == "A"
        && (
            $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
        )
    )
        continue;


    $arCur = current($arItem["VALUES"]);
    switch ($arItem["DISPLAY_TYPE"]) {
        case "A"://NUMBERS_WITH_SLIDER
        case "B"://NUMBERS

            foreach ($arItem["VALUES"] as $val => $ar):
                if ($ar['HTML_VALUE']) {
                    $arLaber[$arItem["CODE"]]["NAME"] = $arItem["NAME"];
                    $arLaber[$arItem["CODE"]]["CODE"] = strtolower($arItem["CODE"]);
                    $arLaber[$arItem["CODE"]]["VALUES"][] = array(
                        "TRIGER_PRICE" => $ar["CONTROL_ID"],
                        "DISPLAY_TYPE" => $arItem["DISPLAY_TYPE"],
                        "TRIGER_SET" => $val,
                        "TRIGER_NAME" => $ar["HTML_VALUE"]
                    );
                }
            endforeach;

            break;

        case "G"://CHECKBOXES_WITH_PICTURES
            ?>

            <?
            break;
        case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
            ?>

            <?
            break;
        case "P"://DROPDOWN
            $checkedItemExist = false;
            ?>

            <?
            break;
        case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
            ?>

            <?
            break;
        case "K"://RADIO_BUTTONS
            foreach ($arItem["VALUES"] as $val => $ar):
                if ($ar["CHECKED"]):
                    $arLaber[$arItem["CODE"]]["NAME"] = $arItem["NAME"];
                    $arLaber[$arItem["CODE"]]["CODE"] = strtolower($arItem["CODE"]);
                    $arLaber[$arItem["CODE"]]["VALUES"][] = array(
                        "TRIGER_CLICK" => 'all_' . $ar["CONTROL_ID"],
                        "DISPLAY_TYPE" => $arItem["DISPLAY_TYPE"],
                        "TRIGER_NAME" => $ar["VALUE"]
                    );
                endif;
            endforeach;
            break;
        case "U"://CALENDAR
            ?>

            <?
            break;
        default://CHECKBOXES
            ?>
            <?
            foreach ($arItem["VALUES"] as $val => $ar):
                if ($ar["CHECKED"]):
                    $arLaber[$arItem["CODE"]]["NAME"] = $arItem["NAME"];
                    $arLaber[$arItem["CODE"]]["CODE"] = strtolower($arItem["CODE"]);
                    $arLaber[$arItem["CODE"]]["VALUES"][] = array(
                        "TRIGER_CLICK" => $ar["CONTROL_ID"],
                        "DISPLAY_TYPE" => $arItem["DISPLAY_TYPE"],
                        "TRIGER_NAME" => $ar["VALUE"]
                    );
                endif;
            endforeach;
            ?>
        <?
    }
}
?>

<? $filterColors = array(); ?>
<? if (isset($arLaber["COLOR"])): ?>
    <? foreach ($arLaber["COLOR"]["VALUES"] as $oneValue): ?>
        <? $filterColors[] = $oneValue["TRIGER_NAME"]; ?>
    <? endforeach; ?>
<? endif; ?>

<? if (!empty($filterColors)): ?>
    <?
    $arSelect = array("ID", "NAME", "PREVIEW_PICTURE");
    $arFilter = array("IBLOCK_ID" => 6, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "NAME" => $filterColors);
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arFields["PREVIEW_PICTURE"] = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array('width' => 50, 'height' => 50), BX_RESIZE_IMAGE_EXACT, true);
        $resultColor[$arFields["NAME"]] = $arFields["PREVIEW_PICTURE"]["src"];
    }
    ?>
<? endif; ?>

<? //dp($filterColors);?>


<div class="item__catalog__content-block-filters-show-items-mobile">

    <? foreach ($arLaber as $code => $setValue):

        $link = '';
        foreach ($dir as $key => $arSearch) {
            if (strpos($arSearch, $setValue["CODE"] . '-') !== false) {
                $delKey = $key;
                break;
            }
        }
        $dirThis = $dir;
        unset($dirThis[$delKey]);
        $link = str_replace("filter/apply/", '', implode('/', $dirThis));
        ?>

        <?
        $str = '';
        $arControl = array();
        $isNumeric = "N";
        foreach ($setValue["VALUES"] as $values) {
            if ($values["DISPLAY_TYPE"] == "F") {
                $currentUrl = $arResult['FILTER_URL'];
                $triggerClick = $values['TRIGER_CLICK'];
                $linkDelete = str_replace($triggerClick, '', $currentUrl);
                ?>
                <div class="item__catalog__content-block-filters-show-item-mobile _del-filter">
                    <p style="margin-bottom: 0">
                    <?= $values["TRIGER_NAME"] ?>
                    </p>
                    <a href="#" class="_target-filter" data-itemid="<?= $triggerClick ?>" data-link="<?= $linkDelete ?>" >
                        &#10006;</a>
                </div>

                <?
            }
            if ($values["DISPLAY_TYPE"] == "A" || $values["DISPLAY_TYPE"] == "B") {
                if ($values['TRIGER_SET'] == "MIN") {
                    $str .= 'от ' . $values["TRIGER_NAME"];
                }
                if ($values['TRIGER_SET'] == "MAX") {
                    $str .= ' до ' . $values["TRIGER_NAME"];
                }
                $isNumeric = "Y";
            }
        } ?>
        <? if ($isNumeric == "Y"):?>
        <div class="selected-filter-item _del-filter">
            <a href="#" class="_target-filter" data-link="<?= $link ?>">
                <span class="name"><?= $setValue["NAME"] ?>: <?= $str ?></span>
                <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                 fill="none">
                                <path d="M14.7616 0.920412L7.84102 7.84102M7.84102 7.84102L0.92041 14.7616M7.84102 7.84102L14.7616 14.7616M7.84102 7.84102L0.920412 0.92041"
                                      stroke="currentColor"/>
                            </svg>
                </span>
            </a>
        </div>
    <? endif; ?>

    <? endforeach; ?>

</div>