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

use Bitrix\Iblock\SectionPropertyTable;

$this->setFrameMode(true);

$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/colors.css',
    'TEMPLATE_CLASS' => 'bx-' . $arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME'])) {
    $this->addExternalCss($templateData['TEMPLATE_THEME']);
}
//$this->addExternalCss("/bitrix/css/main/bootstrap.css");
//$this->addExternalCss("/bitrix/css/main/font-awesome.css");
?>
<div class="bx-filter <?= $templateData["TEMPLATE_CLASS"] ?> <? if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL") echo "bx-filter-horizontal" ?>">
    <div style="background:none; padding-top: 0;" class="bx-filter-section container-fluid">
        <div class="row">
            <div class="<? if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL"): ?>col-sm-6 col-md-4<? else: ?>col-lg-12<? endif ?> bx-filter-title"></div>
        </div>
        <form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>"
              method="get" class="smartfilter">
            <? foreach ($arResult["HIDDEN"] as $arItem): ?>
                <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
                       value="<? echo $arItem["HTML_VALUE"] ?>"/>
            <? endforeach; ?>
            <div class="row">
                <? foreach ($arResult["ITEMS"] as $key => $arItem)//prices
                {
                    $key = $arItem["ENCODED_ID"];
                    if (isset($arItem["PRICE"])):
                        if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                            continue;

                        $precision = 0;
                        $step_num = 4;
                        $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
                        $prices = array();
                        if (Bitrix\Main\Loader::includeModule("currency")) {
                            for ($i = 0; $i < $step_num; $i++) {
                                $prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step * $i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
                            }
                            $prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
                        } else {
                            $precision = $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0;
                            for ($i = 0; $i < $step_num; $i++) {
                                $prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * $i, $precision, ".", "");
                            }
                            $prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                        }
                        ?>
                        <div class="<? if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL"):?>col-sm-6 col-md-4<? else:?>col-lg-12<?endif ?> bx-filter-parameters-box bx-active">
                           <?/* <span class="bx-filter-container-modef"></span>
                            <div class="bx-filter-parameters-box-title"
                                 onclick="smartFilter.hideFilterProps(this)"
                            >
                                <span><?= $arItem["NAME"] ?>
                                <i data-role="prop_angle"class="fa fa-angle-<? if ($arItem["DISPLAY_EXPANDED"] == "Y"):?>up<? else:?>down<?endif ?>"></i></span>
                            </div>
                            <div class="bx-filter-block" data-role="bx_filter_block">
                                <div class="row bx-filter-parameters-box-container">
                                    <div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
                                        <i class="bx-ft-sub"><?= GetMessage("CT_BCSF_FILTER_FROM") ?></i>
                                        <div class="bx-filter-input-container">
                                            <input
                                                    class="min-price"
                                                    type="text"
                                                    name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                                    id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                                    value="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
                                        <i class="bx-ft-sub"><?= GetMessage("CT_BCSF_FILTER_TO") ?></i>
                                        <div class="bx-filter-input-container">
                                            <input
                                                    class="max-price"
                                                    type="text"
                                                    name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                                    id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                                    value="<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                            />
                                        </div>
                                    </div>

                                    <div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">
                                        <div class="bx-ui-slider-track" id="drag_track_<?= $key ?>">
                                            <? for ($i = 0; $i <= $step_num; $i++):?>
                                                <div class="bx-ui-slider-part p<?= $i + 1 ?>">
                                                    <span><?= $prices[$i] ?></span></div>
                                            <?endfor; ?>

                                            <div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;"
                                                 id="colorUnavailableActive_<?= $key ?>"></div>
                                            <div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;"
                                                 id="colorAvailableInactive_<?= $key ?>"></div>
                                            <div class="bx-ui-slider-pricebar-v" style="left: 0;right: 0;"
                                                 id="colorAvailableActive_<?= $key ?>"></div>
                                            <div class="bx-ui-slider-range" id="drag_tracker_<?= $key ?>"
                                                 style="left: 0%; right: 0%;">
                                                <a class="bx-ui-slider-handle left" style="left:0;"
                                                   href="javascript:void(0)" id="left_slider_<?= $key ?>"></a>
                                                <a class="bx-ui-slider-handle right" style="right:0;"
                                                   href="javascript:void(0)" id="right_slider_<?= $key ?>"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        */?>
                        </div>
                    <?
                    $arJsParams = array(
                        "leftSlider" => 'left_slider_' . $key,
                        "rightSlider" => 'right_slider_' . $key,
                        "tracker" => "drag_tracker_" . $key,
                        "trackerWrap" => "drag_track_" . $key,
                        "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                        "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                        "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                        "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                        "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                        "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                        "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"],
                        "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                        "precision" => $precision,
                        "colorUnavailableActive" => 'colorUnavailableActive_' . $key,
                        "colorAvailableActive" => 'colorAvailableActive_' . $key,
                        "colorAvailableInactive" => 'colorAvailableInactive_' . $key,
                    );
                    ?>
                        <script type="text/javascript">
                            BX.ready(function () {
                                window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                            });
                        </script>
                    <?endif;
                }

                //not prices
                foreach ($arResult["ITEMS"] as $key => $arItem) {
                    if (
                        empty($arItem["VALUES"])
                        || isset($arItem["PRICE"])
                    )
                        continue;

                    if (
                        $arItem["DISPLAY_TYPE"] === SectionPropertyTable::NUMBERS_WITH_SLIDER
                        && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                    )
                        continue;
                    ?>
                    <div class="item__catalog__filter-block__smart <? if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL"):?>col-sm-6 col-md-4<? else:?>col-lg-12<?endif ?> bx-filter-parameters-box  <? if ($arItem["DISPLAY_EXPANDED"] == "Y"):?>bx-active<?endif ?>">
                        <?/*dp($arItem);*/ ?>
                        <span class="bx-filter-container-modef"></span>

                        <div class="item__catalog__filter-block__smart__title item__catalog-accord-title active">
<!--                             onclick="smartFilter.hideFilterProps(this)">-->
                            <p style="margin: 0;"><?= $arItem["NAME"] ?>
                                <? if ($arItem["FILTER_HINT"] <> ""):?>
                                    <i id="item_title_hint_<? echo $arItem["ID"] ?>" class="fa fa-question-circle"></i>
                                    <script type="text/javascript">
                                        new top.BX.CHint({
                                            parent: top.BX("item_title_hint_<?echo $arItem["ID"]?>"),
                                            show_timeout: 10,
                                            hide_timeout: 200,
                                            dx: 2,
                                            preventHide: true,
                                            min_width: 250,
                                            hint: '<?= CUtil::JSEscape($arItem["FILTER_HINT"])?>'
                                        });
                                    </script>
                                <?endif ?>
                            </p>
                            <span data-role="prop_angle" class="fa fa-angle-<? if ($arItem["DISPLAY_EXPANDED"] == "Y"):?>up<? else:?>down<?endif ?>"></span>
                        </div>

                        <div class="item__catalog__filter-block__smart__descr bx-filter-block item__catalog-accord-descr active" data-role="bx_filter_block">

                            <div class="row bx-filter-parameters-box-container">

                                <?
                                $arCur = current($arItem["VALUES"]);
                                switch ($arItem["DISPLAY_TYPE"]) {
                                case SectionPropertyTable::NUMBERS_WITH_SLIDER://NUMBERS_WITH_SLIDER
                                    ?>
                                    <div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
                                        <i class="bx-ft-sub"><?= GetMessage("CT_BCSF_FILTER_FROM") ?></i>
                                        <div class="bx-filter-input-container">
                                            <input
                                                    class="min-price"
                                                    type="text"
                                                    name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                                    id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                                    value="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
                                        <i class="bx-ft-sub"><?= GetMessage("CT_BCSF_FILTER_TO") ?></i>
                                        <div class="bx-filter-input-container">
                                            <input
                                                    class="max-price"
                                                    type="text"
                                                    name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                                    id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                                    value="<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                            />
                                        </div>
                                    </div>

                                    <div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">
                                        <div class="bx-ui-slider-track" id="drag_track_<?= $key ?>">
                                            <?
                                            $precision = $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0;
                                            $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
                                            $value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
                                            $value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
                                            $value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
                                            $value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
                                            $value5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                                            ?>
                                            <div class="bx-ui-slider-part p1"><span><?= $value1 ?></span></div>
                                            <div class="bx-ui-slider-part p2"><span><?= $value2 ?></span></div>
                                            <div class="bx-ui-slider-part p3"><span><?= $value3 ?></span></div>
                                            <div class="bx-ui-slider-part p4"><span><?= $value4 ?></span></div>
                                            <div class="bx-ui-slider-part p5"><span><?= $value5 ?></span></div>

                                            <div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;"
                                                 id="colorUnavailableActive_<?= $key ?>"></div>
                                            <div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;"
                                                 id="colorAvailableInactive_<?= $key ?>"></div>
                                            <div class="bx-ui-slider-pricebar-v" style="left: 0;right: 0;"
                                                 id="colorAvailableActive_<?= $key ?>"></div>
                                            <div class="bx-ui-slider-range" id="drag_tracker_<?= $key ?>"
                                                 style="left: 0;right: 0;">
                                                <a class="bx-ui-slider-handle left" style="left:0;"
                                                   href="javascript:void(0)" id="left_slider_<?= $key ?>"></a>
                                                <a class="bx-ui-slider-handle right" style="right:0;"
                                                   href="javascript:void(0)" id="right_slider_<?= $key ?>"></a>
                                            </div>
                                        </div>
                                    </div>
                                <?
                                $arJsParams = array(
                                    "leftSlider" => 'left_slider_' . $key,
                                    "rightSlider" => 'right_slider_' . $key,
                                    "tracker" => "drag_tracker_" . $key,
                                    "trackerWrap" => "drag_track_" . $key,
                                    "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                                    "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                                    "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                                    "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                                    "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                    "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                    "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"],
                                    "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                                    "precision" => $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0,
                                    "colorUnavailableActive" => 'colorUnavailableActive_' . $key,
                                    "colorAvailableActive" => 'colorAvailableActive_' . $key,
                                    "colorAvailableInactive" => 'colorAvailableInactive_' . $key,
                                );
                                ?>
                                    <script type="text/javascript">
                                        BX.ready(function () {
                                            window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                                        });
                                    </script>
                                <?/*
                                break;
                                case SectionPropertyTable::NUMBERS://NUMBERS
                                ?>
                                <?
                                break;
                                case SectionPropertyTable::CHECKBOXES_WITH_PICTURES://CHECKBOXES_WITH_PICTURES
                                ?>
                                <?
                                break;
                                case SectionPropertyTable::CHECKBOXES_WITH_PICTURES_AND_LABELS://CHECKBOXES_WITH_PICTURES_AND_LABELS
                                ?>
                                <?
                                break;
                                case SectionPropertyTable::DROPDOWN://DROPDOWN
                                $checkedItemExist = false;
                                ?>
                                <?
                                break;
                                case SectionPropertyTable::DROPDOWN_WITH_PICTURES_AND_LABELS://DROPDOWN_WITH_PICTURES_AND_LABELS
                                ?>
                                <?
                                break;
                                case SectionPropertyTable::RADIO_BUTTONS://RADIO_BUTTONS
                                ?>
                                <?
                                break;
                                case SectionPropertyTable::CALENDAR://CALENDAR
                                */?>
                                <?
                                break;
                                default://CHECKBOXES
                                ?>
                                <? foreach ($arItem["VALUES"] as $val => $ar): ?>

                                    <label data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                           class="checkcontainer bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled' : '' ?>"
                                           for="<? echo $ar["CONTROL_ID"] ?>">
                                        <input
                                                class="filter_checkbox"
                                                type="checkbox"
                                                value="<? echo $ar["HTML_VALUE"] ?>"
                                                name="<? echo $ar["CONTROL_NAME"] ?>"
                                                id="<? echo $ar["CONTROL_ID"] ?>"
                                                <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                onclick="smartFilter.click(this)"
                                        />
                                        <?/*dp($ar["CONTROL_ID"])*/?>
                                        <div class="checkmark"></div>
                                        <div class="name bx-filter-param-text"
                                             title="<?= $ar["VALUE"]; ?>"><?= $ar["VALUE"]; ?><?
                                            if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                ?>&nbsp;<span style="display:none"
                                                              data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?>
                                                </span><?
                                            endif; ?>
                                        </div>

                                    </label>

                                <? endforeach; ?>

                                <?
                                }
                                ?>
                            </div>
                            <div style="clear: both"></div>
                        </div>
                    </div>
                    <?
                }
                ?>
            </div><!--//row-->
            <div class="row">
                <div class="col-xs-12 bx-filter-button-box">
                    <div class="bx-filter-block">
                        <div class="bx-filter-parameters-box-container">
                            <input  style="display:none"
                                    class="btn btn-themes"
                                    type="submit"
                                    id="set_filter"
                                    name="set_filter"
                                    value="<?= GetMessage("CT_BCSF_SET_FILTER") ?>"
                            />
                            <input  style="display:none"
                                    class="btn btn-link"
                                    type="submit"
                                    id="del_filter"
                                    name="del_filter"
                                    value="<?= GetMessage("CT_BCSF_DEL_FILTER") ?>"
                            />
                            <div class="bx-filter-popup-result <? if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"] ?>"
                                 id="modef" <? if (!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"'; ?>
                                 style="display: none;">
                                <? echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span  style="display: none;" id="modef_num">' . (int)($arResult["ELEMENT_COUNT"] ?? 0) . '</span>')); ?>
                                <span  style="display: none;" class="arrow"></span>
                                <br/>
                                <a  style="display: none;" href="<? echo $arResult["FILTER_URL"] ?>"
                                    target=""><? echo GetMessage("CT_BCSF_FILTER_SHOW") ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clb"></div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>