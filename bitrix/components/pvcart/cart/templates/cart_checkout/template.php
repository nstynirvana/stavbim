<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

$this->addExternalCss($templateFolder . "/css/font-awesome.min.css");
$this->addExternalCss($templateFolder . "/css/media.css");

?>
<div class='bc-cart-page-w' id="BC_C_CART_page">
    <div class='bc-cart-page-w-content'>
        <div class="bc-cart-page-inner-w" v-cloak>

            <div class='bc-cart-page-w-content-inner'>
                <div v-if="ELEMENTS.length > 0">
                    <div class='bc-cart-page-w-title-w'>
                        <div class='bc-cart-page-w-title'>
                            <?= Loc::GetMessage("BC_C_CART_PAGE_TITLE") ?> {{ELEMENTS.length}} {{
                            formatPlural(ELEMENTS.length) }}
                        </div>
                        <a class='bc-cart-page-w-delete-all' href='javascript:void(0);' v-if="ELEMENTS.length > 0"
                           @click="removeAllItems"><?= Loc::getMessage("BC_C_CART_PAGE_CLEAR_TEXT") ?></a>
                    </div>
                    <div class="bc-cart-page-w-content-top">
                        <div class='bc-cart-page-w-content-item-header-w'>
                            <div class='bc-cart-page-w-content-item-header bc-cart-page-w-content-item-header-1'>
                                <?= Loc::getMessage("BC_C_CART_PAGE_NAME_TEXT") ?>
                            </div>
                            <div class='bc-cart-page-w-content-item-header bc-cart-page-w-content-item-header-2'>
                                <?= Loc::getMessage("BC_C_CART_PAGE_PRICE_TEXT") ?>
                            </div>
                            <div class='bc-cart-page-w-content-item-header bc-cart-page-w-content-item-header-3'>
                                <?= Loc::getMessage("BC_C_CART_PAGE_COUNT_TEXT") ?>
                            </div>
                        </div>
                        <div class='bc-cart-page-w-content-tbl-w'>
                            <div class='bc-cart-page-w-content-item' v-for="(item, index) in ELEMENTS">
                                <div class='bc-cart-page-w-content-item-body bc-cart-page-w-content-item-body-1'>
                                    <div class='bc-cart-page-w-content-item-image' v-if="item.IMAGE.src">
                                        <img :src="item.IMAGE.src"/>
                                    </div>
                                    <div class="bc-cart-page-w-content-item-detail">
                                        <div class='bc-cart-page-w-content-name'>
                                            <a :href="item.DETAIL_PAGE_URL">{{ item.NAME }}</a>
                                        </div>
                                        <div class='bc-cart-page-w-content-attr'>
                                            <div class='bc-cart-page-w-content-attr-row' v-if="item.MODEL">
                                                <span class="bc-cart-page-w-content-attr-name">
                                                <?= Loc::getMessage("BC_C_CART_PAGE_MODEL_TITLE") ?>
                                                </span>
                                                <span
                                                        class="bc-cart-page-w-content-attr-value">{{ item.MODEL }}</span>
                                            </div>
                                            <div class='bc-cart-page-w-content-attr-row' v-if="item.STATUS">
                                                <span
                                                        class="bc-cart-page-w-content-attr-value">{{ item.STATUS }}</span>
                                            </div>
                                            <div class='bc-cart-w-content-attr-row bc-cart-w-content-attr-row--additional-params'
                                                 v-if="item.PARAMS_STR">

                                                <span class="additional-params-item" v-html="item.PARAMS_STR"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='bc-cart-page-w-content-item-body bc-cart-page-w-content-item-body-2'
                                     v-if="item.PRICE">
                                    <div class="bc-cart-page-w-content-price-w">
                                        <div class='bc-cart-page-w-content-price'>
                                            {{ item.PRICE }} {{DATA.CURRENCY}}
                                        </div>
                                        <div class='bc-cart-page-w-content--old-price' v-if="item.OLD_PRICE">
                                            {{ item.OLD_PRICE }} {{DATA.CURRENCY}}
                                        </div>
                                    </div>

                                </div>
                                <div class='bc-cart-page-w-content-item-body bc-cart-page-w-content-item-body-3'>
                                    <div class="bc-cart-page-w-content-counter">
                                <span class="bc-cart-page-w-content-counter-qty minus"
                                      @click="changeItemCount(item.CART_ITEM_ID, item.QTY*1-1, $event)">-</span>
                                        <input class="counter-field" type='text' size='2'
                                               min='1' step='1'
                                               v-model="item.QTY"
                                               @change="changeItemCount(item.CART_ITEM_ID, item.QTY*1, $event)">
                                        <span class="bc-cart-page-w-content-counter-qty plus"
                                              @click="changeItemCount(item.CART_ITEM_ID, item.QTY*1+1, $event)">+</span>
                                    </div>
                                    <span class='bc-cart-page-w-content-td-remove-link'
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
                    <div class='bc-cart-page-w-conten-bottom'>
                        <div class='bc-cart-page-w-content-tbl-minimal_order_sum' v-if="0 != DATA.MINIMAL_ORDER_SUM">
                            <?= Loc::getMessage("BC_C_CART_PAGE_MINIMAL_ORDER_SUM") ?> {{DATA.MINIMAL_ORDER_SUM}} {{DATA.CURRENCY}}<br>
                            <div v-if="DATA.TOTAL_SUM < DATA.MINIMAL_ORDER_SUM">
                                <?= Loc::getMessage("BC_C_CART_PAGE_MINIMAL_ORDER_SUM_NOT_ENOUGH") ?>
                                {{ DATA.MINIMAL_ORDER_SUM - DATA.TOTAL_SUM }} {{DATA.CURRENCY}}
                            </div>
                        </div>
                        <div class='bc-cart-page-w-content-tbl-total'>
                            <div class='bc-cart-w-content-tbl-discount' v-if="DATA.TOTAL_DISCOUNT_SUM != 0">
                                <?= Loc::getMessage("BC_C_CART_PAGE_TOTAL_DISCOUNT_SUM_TEXT") ?>:
                                {{ DATA.TOTAL_DISCOUNT_SUM }} {{DATA.CURRENCY}}
                            </div>
                            <?= Loc::getMessage("BC_C_CART_PAGE_TOTAL_SUM") ?>
                            {{ DATA.TOTAL_SUM * 1 + DATA.DELIVERY_PRICE}} {{DATA.CURRENCY}}
                        </div>
                    </div>
                </div>
                <div v-else class='bc-cart-page-w-content-title bc-cart-page-w-content-title-empty'>
                    <?= Loc::getMessage("BC_C_CART_PAGE_EMPTY_TEXT_TITLE") ?><br>
                    <? if (!empty($arParams["BEE_VIEW_CATALOG_LINK"])) { ?>
                        <?= Loc::getMessage("BC_C_CART_PAGE_EMPTY_TEXT") ?><br>
                        <a href="<?= $arParams["BEE_VIEW_CATALOG_LINK"] ?>"><?= Loc::getMessage("BC_C_CART_PAGE_EMPTY_LINK_TEXT") ?></a>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    new BeeCartAppObject({
        selector: '#BC_C_CART_page',
        type: 'page',
        path: <?=CUtil::PhpToJSObject($this->__component->GetPath() . "/ajax.php")?>});

    console.log(BeeCartAppObject);
</script>