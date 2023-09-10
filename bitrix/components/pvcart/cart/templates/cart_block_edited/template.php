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

                    <svg viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1H5.42581L7.25 7.25" stroke="currentColor" stroke-miterlimit="10"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M28.2021 30.198C29.2714 29.7551 29.7791 28.5293 29.3362 27.46C28.8933 26.3907 27.6675 25.883 26.5982 26.3259C25.5289 26.7688 25.0212 27.9947 25.4641 29.0639C25.907 30.1332 27.1328 30.641 28.2021 30.198Z"
                              stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M13.293 28.747C13.559 27.6207 12.8615 26.4919 11.7351 26.2259C10.6087 25.96 9.47999 26.6575 9.21402 27.7839C8.94804 28.9102 9.64554 30.039 10.7719 30.305C11.8983 30.5709 13.0271 29.8734 13.293 28.747Z"
                              stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M11.0819 21.8259C9.94813 21.8259 9.02898 22.7602 9.02898 23.9129C9.02898 25.0656 9.94807 26 11.0819 26H27.2941M7.25 7.25L11.0444 21.8259H27.2057L31 7.25H7.25Z"
                              stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round"
                              stroke-linejoin="round"/>
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

    <div v-if="ELEMENTS.length > 0">

        <div class="basket">
            <div class="basket__title">
                <div class="basket__title__wrapper">
                    Корзина <span></span>
                </div>
            </div>

            <div class="bc-cart-w-content-top basket__list">
                <div class='bc-cart-w-content-tbl-w basket__list__scroll'>

                    <div class="basket__item" v-for="(item, index) in ELEMENTS">
                        <div class="basket__item__thing">
                            <div class="basket__item__thing__icon" v-if="item.IMAGE.src">
                                <img :src="item.IMAGE.src"/>
                            </div>
                            <div class="basket__item__thing__descr">
                                <div class="basket__item__thing__descr__title">
                                    <a :href="item.DETAIL_PAGE_URL" v-html="item.NAME"></a>
                                </div>
                                <div class="basket__item__thing__descr__price" v-if="item.PRICE">{{ item.PRICE }} <?= $arResult["CURRENCY"] ?></div>
                            </div>
                        </div>
                        <div class="basket__item__remove" @click="removeItemById(item.CART_ITEM_ID, $event)">&#10006;</div>
                    </div>

                </div>
            </div>

            <div class="basket__pay">
                <div class="basket__pay__title">Сумма заказа:</div>
                <div class="basket__pay__sum">{{ DATA.TOTAL_SUM }} <?= $arResult["CURRENCY"] ?></div>
            </div>

            <div class='bc-cart-w-conten-bottom'>
                <div class='bc-cart-w-content-tbl-checkout'>
                    <a href="javascript:void(0);" @click="showCartBlock(false)" class="bc-cart-continue-shopping-link"><?= Loc::getMessage("BC_C_CART_CONTINUE_TEXT") ?></a>
                    <a style="
                    <?= (!empty($arParams["BEE_VIEW_BTN_COLOR"]) ? "background-color: {$arParams["BEE_VIEW_BTN_COLOR"]};" : '') ?>
                            " class='bc-cart-w-content-checkout' href='<?= SITE_DIR ?>cart/'><?= Loc::getMessage("BC_C_CART_CHECKOUT_TEXT") ?></a>
                </div>
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
<script>
    new BeeCartAppObject({
        selector: '#<?=$blockId?>',
        type: 'block',
        path: <?=CUtil::PhpToJSObject($this->__component->GetPath() . "/ajax.php")?>});
</script>