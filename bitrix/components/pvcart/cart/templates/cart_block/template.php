<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?

use \Bitrix\Main\Localization\Loc;

$this->addExternalCss($templateFolder . "/css/media.css");
$blockId = 'bee_cart';
$arResult["CURRENCY"] = '&#x20bd;';
?>
<div class='bc-cart-w <?= (($arParams["BEE_VIEW_POSITION"] == 'LEFT') ? 'bc-cart-w--left' : '') ?>'
     id="<?= $blockId ?>"
     style="
             display: none;
     <?= (!empty($arParams["BEE_VIEW_BLOCK_TOP"]) ? "top: {$arParams["BEE_VIEW_BLOCK_TOP"]}%;" : '') ?>
             ">
    <div class="bc-cart-w-btn-show-cart" @click="showCartBlock(false)">
        <div class="bc-cart-w-btn-show-cart-image-w">
            <div class="bc-cart-w-btn-show-cart-count-w">
                <div class="bc-cart-w-btn-show-cart-count__ico">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="100%" height="100%" viewBox="0 0 485.213 485.212"
                         style="enable-background:new 0 0 485.213 485.212;
                         <?= (!empty($arParams["BEE_VIEW_ICON_COLOR"]) ? "fill: {$arParams["BEE_VIEW_ICON_COLOR"]};" : '') ?>
                                 "
                         xml:space="preserve">
                        <g>
                            <g>
                                <g>
                                    <polygon points="424.562,363.906 172.036,363.906 65.893,121.304 0.001,121.304 0.001,90.978 85.737,90.978 191.876,333.584
                                        424.562,333.584 			"/>
                                </g>
                                <path d="M272.934,439.727c0,25.109-20.381,45.485-45.49,45.485c-25.142,0-45.488-20.376-45.488-45.485
                                    c0-25.118,20.346-45.49,45.488-45.49C252.553,394.237,272.934,414.609,272.934,439.727z"/>
                                <path d="M424.562,439.727c0,25.109-20.376,45.485-45.485,45.485c-25.118,0-45.49-20.376-45.49-45.485
                                    c0-25.118,20.372-45.49,45.49-45.49C404.187,394.237,424.562,414.609,424.562,439.727z"/>

                                <path d="M379.077,242.606c-59.234,0-109.256-38.144-128.088-90.978h-99.36l60.654,151.629h212.279l35.008-87.482
                                    C436.944,232.42,409.255,242.606,379.077,242.606z"/>
                            </g>
                        </g>
                    </svg>


                </div>
                <div class="bc-cart-w-btn-show-cart-count__close">
                    <svg height="100%" width="100%" id="close" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                         style="
                                 enable-background:new 0 0 485.213 485.212;
                         <?= (!empty($arParams["BEE_VIEW_ICON_COLOR"]) ? "fill: {$arParams["BEE_VIEW_ICON_COLOR"]};" : '') ?>
                                 "
                    >
                        <path d="M4 8 L8 4 L16 12 L24 4 L28 8 L20 16 L28 24 L24 28 L16 20 L8 28 L4 24 L12 16 z"/>
                    </svg>
                </div>
                <div class="bc-cart-w-btn-show-cart-count"
                     style="
                     <?= (!empty($arParams["BEE_VIEW_COUNT_COLOR"]) ? "background-color: {$arParams["BEE_VIEW_COUNT_COLOR"]};" : '') ?>
                             "
                >
                    {{ ELEMENTS.length }}
                </div>

            </div>
        </div>
    </div>
    <div class='bc-cart-w-content'>
        <div class='bc-cart-w-title-w'>
            <div class='bc-cart-w-title'>
                <template v-if="ELEMENTS.length > 0">
                    <?= Loc::GetMessage("BC_C_CART_BLOCK_TITLE") ?> {{ELEMENTS.length}} {{ formatPlural(ELEMENTS.length)
                    }}
                </template>
                <template v-else>
                    <?= Loc::getMessage("BC_C_CART_EMPTY_TEXT_TITLE") ?>
                </template>
            </div>
            <a class='bc-cart-w-delete-all' href='javascript:void(0);' v-if="ELEMENTS.length > 0"
               @click="removeAllItems"><?= Loc::getMessage("BC_C_CART_CLEAR_TEXT") ?></a>
        </div>
        <div class='bc-cart-w-content-inner'>
            <div v-if="ELEMENTS.length > 0">
                <div class="bc-cart-w-content-top">
                    <div class='bc-cart-w-content-item-header-w'>
                        <div class='bc-cart-w-content-item-header bc-cart-w-content-item-header-1'>
                            <?= Loc::getMessage("BC_C_CART_NAME_TEXT") ?>
                        </div>
                        <div class='bc-cart-w-content-item-header bc-cart-w-content-item-header-2'>
                            <?= Loc::getMessage("BC_C_CART_PRICE_TEXT") ?>
                        </div>
                        <div class='bc-cart-w-content-item-header bc-cart-w-content-item-header-3'>
                            <?= Loc::getMessage("BC_C_CART_COUNT_TEXT") ?>
                        </div>
                    </div>
                    <div class='bc-cart-w-content-tbl-w'>
                        <div class='bc-cart-w-content-item' v-for="(item, index) in ELEMENTS">
                            <div class='bc-cart-w-content-item-body bc-cart-w-content-item-body-1'>
                                <div class='bc-cart-w-content-item-image' v-if="item.IMAGE.src">
                                    <img :src="item.IMAGE.src"/>
                                </div>
                                <div class="bc-cart-w-content-item-detail">
                                    <div class='bc-cart-w-content-name'>
                                        <a :href="item.DETAIL_PAGE_URL" v-html="item.NAME"></a>
                                    </div>
                                    <div class='bc-cart-w-content-attr'>
                                        <div class='bc-cart-w-content-attr-row' v-if="item.MODEL">
                                            <span
                                                    class="bc-cart-w-content-attr-name"><?= Loc::getMessage("BC_C_CART_MODEL_TEXT") ?>
                                                :</span>
                                            <span class="bc-cart-w-content-attr-value">{{ item.MODEL }}</span>
                                        </div>
                                        <div class='bc-cart-w-content-attr-row' v-if="item.STATUS">
                                            <span class="bc-cart-w-content-attr-value">{{ item.STATUS }}</span>
                                        </div>
                                        <div class='bc-cart-w-content-attr-row bc-cart-w-content-attr-row--additional-params' v-if="item.PARAMS_STR">

                                            <span class="additional-params-item" v-html="item.PARAMS_STR"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='bc-cart-w-content-item-body bc-cart-w-content-item-body-2' v-if="item.PRICE">
                                <div class="bc-cart-w-content-price-w">
                                    <div class='bc-cart-w-content-price'>
                                        {{ item.PRICE }} <?= $arResult["CURRENCY"] ?>
                                    </div>
                                    <div class='bc-cart-w-content--old-price' v-if="item.OLD_PRICE">
                                        {{ item.OLD_PRICE }} <?= $arResult["CURRENCY"] ?>
                                    </div>
                                </div>

                            </div>
                            <div class='bc-cart-w-content-item-body bc-cart-w-content-item-body-3'>
                                <div class="bc-cart-w-content-counter">
                                    <span class="bc-cart-w-content-counter-qty minus"
                                          @click="changeItemCount(item.CART_ITEM_ID, item.QTY*1-1, $event)">-</span>
                                    <input class="counter-field" type='text' size='2'
                                           min='1' step='1'
                                           v-model="item.QTY"
                                           @change="changeItemCount(item.CART_ITEM_ID, item.QTY*1, $event)">
                                    <span class="bc-cart-w-content-counter-qty plus"
                                          @click="changeItemCount(item.CART_ITEM_ID, item.QTY*1+1, $event)">+</span>
                                </div>
                                <span class='bc-cart-w-content-td-remove-link'
                                      @click="removeItemById(item.CART_ITEM_ID, $event)">
                                    <svg height="100%" width="100%" id="close" viewBox="0 0 32 32"
                                         xmlns="http://www.w3.org/2000/svg"
                                         style="enable-background:new 0 0 485.213 485.212;">
                                        <path d="M4 8 L8 4 L16 12 L24 4 L28 8 L20 16 L28 24 L24 28 L16 20 L8 28 L4 24 L12 16 z"/>
                                    </svg>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='bc-cart-w-conten-bottom'>
                    <div class='bc-cart-w-content-tbl-total'>
                        <div class='bc-cart-w-content-tbl-discount' v-if="DATA.TOTAL_DISCOUNT_SUM != 0">
                            <?= Loc::getMessage("BC_C_CART_TOTAL_DISCOUNT_SUM_TEXT") ?>: {{ DATA.TOTAL_DISCOUNT_SUM
                            }} <?= $arResult["CURRENCY"] ?>
                        </div>
                        <?= Loc::getMessage("BC_C_CART_TOTAL_SUM_TEXT") ?>: {{ DATA.TOTAL_SUM
                        }} <?= $arResult["CURRENCY"] ?>
                    </div>

                    <div class='bc-cart-w-content-tbl-checkout'>
                        <a href="javascript:void(0);" @click="showCartBlock(false)"
                           class="bc-cart-continue-shopping-link"><?= Loc::getMessage("BC_C_CART_CONTINUE_TEXT") ?></a>
                        <a
                                style="
                                <?= (!empty($arParams["BEE_VIEW_BTN_COLOR"]) ? "background-color: {$arParams["BEE_VIEW_BTN_COLOR"]};" : '') ?>
                                        "
                                class='bc-cart-w-content-checkout'
                                href='<?= SITE_DIR ?>cart/'><?= Loc::getMessage("BC_C_CART_CHECKOUT_TEXT") ?></a>
                    </div>
                </div>
            </div>
            <div v-else class='bc-cart-w-content-title bc-cart-w-content-title-empty'>
                <? if (!empty($arParams["BEE_VIEW_CATALOG_LINK"])) { ?>
                    <?= Loc::getMessage("BC_C_CART_EMPTY_TEXT") ?><br>
                    <a href="<?= $arParams["BEE_VIEW_CATALOG_LINK"] ?>"><?= Loc::getMessage("BC_C_CART_EMPTY_LINK_TEXT") ?></a>
                <? } ?>
            </div>
        </div>
    </div>
</div>
<script>
    new BeeCartAppObject({
        selector: '#<?=$blockId?>',
        type: 'block',
        path: <?=CUtil::PhpToJSObject($this->__component->GetPath() . "/ajax.php")?>});
</script>