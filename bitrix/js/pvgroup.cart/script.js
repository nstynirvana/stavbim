if (window.frameCacheVars !== undefined)
{
    BX.addCustomEvent("onFrameDataReceived" , function(json) {
        beeCartInit();
    });
} else {
    BX.ready(function() {
        beeCartInit();
    });
}


function beeCartInit(){
    if (typeof BeeCartAppObjects.cartPageApp == "undefined")
        jQuery(BeeCartAppObjects.cartBlockApp.$el).show();
    jQuery("body").on("click", '.product-buy-link:not(".product-buy-link_in-cart")', function () {

        //console.log("click button to carf");
        
        var btn = this;
        var id = jQuery(this).attr("data-id");
        var qty = parseInt(jQuery(this).closest('.product-buy-block').find('input[name=product_count]').val());
        var params = {};
        if (typeof beeCartGetParams !== "undefined")
            params = beeCartGetParams(btn);

        console.log(params);

        qty = !isNaN(qty) && qty > 0 ? qty : 1;
        jQuery.ajax({
            url: BeeCartAppObjects.path,
            data: {'method': 'addItemToCart', 'id': id, 'qty': qty, 'params': params, 'SITE_ID': BeeCartAppObjects.SITE_ID},
            type: 'POST',
            success: function (data) {
                if (data.STATUS) {
                    bcAnimateAdditionToCart(btn);
                    BeeCartAppObjects.cartBlockApp.ELEMENTS = data.ELEMENTS;
                    BeeCartAppObjects.cartBlockApp.ELEMENTS_IDS = [];
                    for (var i = 0, len = data.ELEMENTS.length; i < len; i++) {
                        BeeCartAppObjects.cartBlockApp.ELEMENTS_IDS.push(data.ELEMENTS[i].ID);
                    }

                    console.log("succes product changer");

                    BeeCartAppObjects.cartBlockApp.recalcTotalPrice();

                    console.log("after recalc callback");

                    BeeCartAppObjects.cartBlockApp.changeAddBtn();

                    console.log("after change Add BTN");

                    console.log(BeeCartAppObjects.cartBlockApp);

                }
            }
        });
    });
    jQuery("body").on("click", '.product-count-spinner__item--down', function () {
        var qty = parseInt(jQuery(this).closest('.product-buy-block').find('input[name=product_count]').val());
        qty = !isNaN(qty) ? qty : 1;
        qty--;
        if (qty < 1) {
            qty = 1;
        }
        jQuery(this).closest('.product-buy-block').find('input[name=product_count]').val(qty)
    });
    jQuery("body").on("click", '.product-count-spinner__item--up', function () {
        var qty = parseInt(jQuery(this).closest('.product-buy-block').find('input[name=product_count]').val());
        qty = !isNaN(qty) ? qty : 1;
        qty++;
        if (qty < 1) {
            qty = 1;
        }
        jQuery(this).closest('.product-buy-block').find('input[name=product_count]').val(qty)
    });

    if (typeof BeeCartAppObjects.cartBlockApp != "undefined")
        BeeCartAppObjects.cartBlockApp.changeAddBtn();
}

function bcAnimateAdditionToCart(obj) {
    if (typeof BeeCartAppObjects.effectAfterAdd == "undefined") return;
    switch (BeeCartAppObjects.effectAfterAdd) {
        case "fly":
            var element = document.createElement("div");
            element.className = "bc-cart-fly-item";
            jQuery(element)
                .css({
                    'position': 'absolute',
                    'z-index': '100',
                    'left': jQuery(obj).offset().left,
                    'top': jQuery(obj).offset().top
                })
                .appendTo('body')
                .animate({
                        left: jQuery(BeeCartAppObjects.cartBlockApp.$el).offset().left,
                        top: jQuery(BeeCartAppObjects.cartBlockApp.$el).offset().top
                    },
                    700, 'linear', function () {
                        $(this).remove();
                    });
            break;
        case "show":
            BeeCartAppObjects.cartBlockApp.showCartBlock(true);
            break;
    }
}

function changeAddBtnByParams(id){
    if (typeof BeeCartAppObjects.cartBlockApp != "undefined")
        BeeCartAppObjects.cartBlockApp.changeAddBtnHandler(id);
}

(function (window) {
    if (window.BeeCartAppObject)
        return;


    window.BeeCartAppObject = function (arParams) {
        switch (arParams.type) {
            case 'page':
                name = "cartPageApp";
                break;
            case 'block':
                name = "cartBlockApp";
                break;
        }
        BeeCartAppObjects.type = arParams.type;

        if (typeof arParams.path != "undefined")
            BeeCartAppObjects.path = arParams.path;

        BeeCartAppObjects.ELEMENTS_IDS = [];
        for (var i = 0, len = BeeCartAppObjects.ELEMENTS.length; i < len; i++) {
            BeeCartAppObjects.ELEMENTS_IDS.push(BeeCartAppObjects.ELEMENTS[i].ID);
        }
        BeeCartAppObjects.ELEMENTS_BTN_TEXTS = [];
        BeeCartAppObjects.DATA.DELIVERY_PRICE = 0;

        BeeCartAppObjects[name] = new Vue({
            el: arParams.selector,
            data: BeeCartAppObjects,
            methods: {
                showCartBlock: function (show) {
                    if (show === true) {
                        jQuery(this.$el).addClass('bc-cart-w-visible');
                        jQuery(this.$el).find(".basket").addClass("active");
                        return;
                    }
                    if (jQuery(this.$el).hasClass('bc-cart-w-visible')) {
                        jQuery(this.$el).removeClass('bc-cart-w-visible');
                        jQuery(this.$el).find(".basket").removeClass("active");

                    } else {
                        jQuery(this.$el).addClass('bc-cart-w-visible');
                        jQuery(this.$el).find(".basket").addClass("active");
                    }

                },
                changeItemCount: function (id, qty, $event) {

                    if (typeof qty !== 'number' || isNaN(qty)) {
                        qty = 1;
                    }
                    qty = parseInt(qty);
                    if (qty < 1) {
                        this.removeItemById(id, $event);
                    } else {
                        this.updateItemQty(id, qty);
                    }
                },
                updateItemQty: function (id, qty) {
                    var app = this;
                    jQuery.ajax({
                        url: app.path,
                        data: {'method': 'updateItemQty', 'id': id, 'qty': qty, 'SITE_ID': BeeCartAppObjects.SITE_ID},
                        type: 'POST',
                        success: function (data) {
                            if (data.STATUS) {
                                app.updateItemInModel(data);
                            } else {//error

                            }
                        }
                    });
                },
                updateItemInModel: function (data) {
                    this.ELEMENTS = data.ELEMENTS_IN_CART.ELEMENTS;
                    this.recalcTotalPrice();
                },
                removeItemById: function (id, $event) {
                    var app = this;
                    jQuery.ajax({
                        url: app.path,
                        data: {'method': 'removeItemById', 'id': id},
                        type: 'POST',
                        success: function (data) {
                            if (data.STATUS) {
                                for (var i = 0, len = app.ELEMENTS.length - 1; i <= len; i++) {
                                    if (app.ELEMENTS[i].CART_ITEM_ID == data.REMOVED_ITEM_ID) {
                                        app.findAndEnable(app.ELEMENTS[i].ID);
                                        app.ELEMENTS.splice(i, 1);
                                        app.ELEMENTS_IDS.splice(i, 1);
                                        if (typeof BeeCartAppObjects.formId != "undefined" && app.ELEMENTS.length == 0)
                                            jQuery('#' + BeeCartAppObjects.formId).remove();
                                        app.recalcTotalPrice();

                                        break;
                                    }
                                }
                                app.changeAddBtn();
                            } else {//error

                            }
                        }
                    });
                },
                removeAllItems: function () {
                    var app = this;
                    jQuery.ajax({
                        url: app.path,
                        data: {'method': 'removeAllItems', 'SITE_ID': BeeCartAppObjects.SITE_ID},
                        type: 'POST',
                        success: function (data) {
                            if (data.STATUS) {
                                app.ELEMENTS = [];
                                app.enableAllBtn();
                                app.ELEMENTS_IDS = [];
                                if (typeof BeeCartAppObjects.formId != "undefined")
                                    jQuery('#' + BeeCartAppObjects.formId).remove();
                            } else {
                                alert("Ошибко");
                            }
                        }
                    });
                },
                recalcTotalPrice: function () {
                    var totalPrice = 0;
                    var totalDiscountPrice = 0;
                    for (var i = 0, len = this.ELEMENTS.length - 1; i <= len; i++) {
                        totalPrice += this.ELEMENTS[i].PRICE * 100 * this.ELEMENTS[i].QTY;
                        if (this.ELEMENTS[i].OLD_PRICE)
                            totalDiscountPrice += (this.ELEMENTS[i].OLD_PRICE * 1 - this.ELEMENTS[i].PRICE) * 100 * this.ELEMENTS[i].QTY;
                    }
                    this.DATA.TOTAL_SUM = totalPrice / 100;
                    this.DATA.TOTAL_DISCOUNT_SUM = totalDiscountPrice / 100;
                },
                hideBlock: function () {
                    jQuery(this.$el).remove();
                },
                changeAddBtn: function () {
                    if (BeeCartAppObjects.changeAddToCartBtnText == "N" ||
                        BeeCartAppObjects.inCartBtnText.length == 0) return;
                    var elements = jQuery('.product-buy-link');
                    for (var i = 0, len = elements.length; i < len; i++) {
                        var ID = jQuery(elements[i]).attr("data-id");
                        if (this.ELEMENTS_IDS.indexOf(ID) != -1) {
                            this.changeAddBtnHandler(ID);
                        }
                    }
                },
                changeAddBtnHandler: function(id){
                    
                    if (BeeCartAppObjects.changeAddToCartBtnText == "N" ||
                        BeeCartAppObjects.inCartBtnText.length == 0) return;
                    var btn = this.findBtnById(id);
                    if (typeof btn == "undefined") return;

                    var params = {};
                    if (typeof BeeCartGetParams !== "undefined"){
                        var params = BeeCartGetParams(btn); 
                    }

                    //console.log("try to change btn name");

                    var elements = this.findElementsInCart(id);
                    for (var i = 0, len = elements.length; i < len; i++) {
                        var elementParams = JSON.stringify(elements[i].PARAMS);
                        if (elementParams == "[]") elementParams = "{}";
                        if (elementParams == JSON.stringify(params)){
                            this.disableBtn(id, btn);
                            break;
                        } else {
                            this.enableBtn(id, btn);
                        }
                    }

                },
                
                disableBtn: function(ID, obj){
                    this.ELEMENTS_BTN_TEXTS[ID] = jQuery(obj).html();
                    jQuery(obj).html(BeeCartAppObjects.inCartBtnText);
                    jQuery(obj).addClass('product-buy-link_in-cart');
                },
                enableBtn: function(ID, obj){
                    if (typeof this.ELEMENTS_BTN_TEXTS[ID] == "undefined") return;
                    jQuery(obj).html(this.ELEMENTS_BTN_TEXTS[ID]);
                    jQuery(obj).removeClass('product-buy-link_in-cart');
                },
                enableAllBtn: function(){
                    for (var i = 0, len = this.ELEMENTS_IDS.length; i < len; i++) {
                        this.findAndEnable(this.ELEMENTS_IDS[i]);
                    }
                },
                findAndEnable: function(id){
                    var btn = this.findBtnById(id);
                    if (typeof btn == "undefined") return;
                    this.enableBtn(id, btn);
                },
                findElementsInCart: function(id){
                    var elements = [];
                    for (var i = 0, len = this.ELEMENTS.length; i < len; i++) {
                        if (this.ELEMENTS[i].ID == id) elements.push(this.ELEMENTS[i]);
                    }
                    return elements;
                },
                findBtnById: function(id){
                    return jQuery('.product-buy-link[data-id='+id+']');
                },
                emptyParamsValue: function(params){
                    for (var i in params){
                        if (typeof params[i] == "undefined")
                            params[i] = "";
                    }
                    return params;
                },
                formatPlural: function (n) {
                    return this.forms_plural[n % 10 == 1 && n % 100 != 11 ? 0 : n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 10 || n % 100 >= 20) ? 1 : 2];
                }
            }
        });
    }
})(window)

// function checkDialogExistence(phoneNumber) {

// }
// function botAskNewOrder(phoneNumber) {
    
// }
// function moveToBotDialog(phoneNumber) {
    
// }

// function beeCartOrdering(phoneNumber) {
//     if (checkDialogExistence(phoneNumber)) {
//       botAskNewOrder(phoneNumber);
//     } else {
//       moveToBotDialog(phoneNumber);
//     }
//   }