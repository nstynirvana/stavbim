<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

$this->addExternalCss($templateFolder . "/css/font-awesome.min.css");
$this->addExternalCss($templateFolder . "/css/media.css");

?>
<div class='bc-cart-page-w' style="width: 100%" id="BC_C_CART_page" v-cloak>
    <div class="basket__list" v-if="ELEMENTS.length > 0">
        <div class='bc-cart-page-w-title-w'></div>
        <div class="bc-cart-page-w-content-top">
            <div class='bc-cart-page-w-content-tbl-w'>
                <div class="basket__list__scroll">

                    <div class='basket__item bc-cart-page-w-content-item'
                         v-for="(item, index) in ELEMENTS">
                        <div class='basket__item__thing bc-cart-page-w-content-item-body bc-cart-page-w-content-item-body-1'>
                            <div class='basket__item__thing-container'>
                                <div class='basket__item__thing__icon bc-cart-page-w-content-item-image'
                                     v-if="item.IMAGE.src">
                                    <img :src="item.IMAGE.src"/>
                                </div>
                                <div class="basket__item__thing__descr bc-cart-page-w-content-item-detail">
                                    <div class='basket__item__thing__descr__title bc-cart-page-w-content-name'>
                                        <a :href="item.DETAIL_PAGE_URL">{{ item.NAME }}</a>
                                    </div>
                                    <div class='bc-cart-page-w-content-attr'>
                                        <div class='basket__item__thing__descr__price bc-cart-page-w-content-item-body'
                                             v-if="item.PRICE">
                                            <div class="bc-cart-page-w-content-price-w">
                                                <div class='bc-cart-page-w-content-price'>
                                                    {{ item.PRICE }} {{DATA.CURRENCY}}
                                                </div>
                                                <div class='bc-cart-page-w-content--old-price'
                                                     v-if="item.OLD_PRICE">
                                                    {{ item.OLD_PRICE }} {{DATA.CURRENCY}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class='bc-cart-page-w-content-item-body bc-cart-page-w-content-item-body-3'>
                                                <span class='basket__item__remove bc-cart-page-w-content-td-remove-link'
                                                      @click="removeItemById(item.CART_ITEM_ID, $event)">
                                                    <svg class='basket__item__remove-img' id="close" viewBox="0 0 32 32"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         style="enable-background:new 0 0 485.213 485.212;">
                                                    <path d="M4 8 L8 4 L16 12 L24 4 L28 8 L20 16 L28 24 L24 28 L16 20 L8 28 L4 24 L12 16 z"/>
                                                    </svg>
                                                </span>
                                <div class="bc-cart-page-w-content-counter"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class='basket__list-bottom bc-cart-page-w-conten-bottom'>

            <div class="basket__pay bc-cart-page-w-content-tbl-total">
                <div class='basket__pay__title bc-cart-w-content-tbl-discount'>Сумма заказа:</div>
                <div class="basket__pay__sum">{{ DATA.TOTAL_SUM * 1 + DATA.DELIVERY_PRICE}}
                    {{DATA.CURRENCY}}
                </div>
            </div>
            <div class='basket__remove-all'>
                <a class='basket__remove-all_text bc-cart-page-w-delete-all' href='javascript:void(0);'
                   v-if="ELEMENTS.length > 0"
                   @click="removeAllItems">Очистить корзину</a>
            </div>
        </div>
    </div>

    <div v-else class='cart-empty bc-cart-page-w-content-title bc-cart-page-w-content-title-empty'>
        <div class="cart-empty__things">
            <img class="cart-empty_img" src="/design/img/cart_empty.png">
            <h2 class="cart-empty_text">Ваша корзина пуста.</h2>
            <a class="cart-empty_button button" href="/catalog/">Перейти к покупкам</a>
        </div>
    </div>
</div>
<script>
    new BeeCartAppObject({
        selector: '#BC_C_CART_page',
        type: 'page',
        path: <?=CUtil::PhpToJSObject($this->__component->GetPath() . "/ajax.php")?>
    });

    console.log(BeeCartAppObject);
</script>