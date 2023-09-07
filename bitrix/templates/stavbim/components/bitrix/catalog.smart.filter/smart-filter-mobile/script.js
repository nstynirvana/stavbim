function JCSmartFilter(ajaxURL, viewMode, params) {
    this.ajaxURL = ajaxURL;
    this.form = null;
    this.timer = null;
    this.cacheKey = '';
    this.cache = [];
    this.popups = [];
    this.viewMode = viewMode;
    if (params && params.SEF_SET_FILTER_URL) {
        this.bindUrlToButton('set_filter', params.SEF_SET_FILTER_URL);
        this.sef = true;
    }
    if (params && params.SEF_DEL_FILTER_URL) {
        this.bindUrlToButton('del_filter', params.SEF_DEL_FILTER_URL);
    }
}

JCSmartFilter.prototype.keyup = function (input) {
    if (!!this.timer) {
        clearTimeout(this.timer);
    }
    this.timer = setTimeout(BX.delegate(function () {
        this.reload(input);
    }, this), 500);
};

JCSmartFilter.prototype.click = function (checkbox) {
    if (!!this.timer) {
        clearTimeout(this.timer);
    }

    this.timer = setTimeout(BX.delegate(function () {
        this.reload(checkbox);
    }, this), 500);
};

JCSmartFilter.prototype.reload = function (input) {
    if (this.cacheKey !== '') {
        //Postprone backend query
        if (!!this.timer) {
            clearTimeout(this.timer);
        }
        this.timer = setTimeout(BX.delegate(function () {
            this.reload(input);
        }, this), 1000);
        return;
    }
    this.cacheKey = '|';

    this.position = BX.pos(input, true);
    this.form = BX.findParent(input, {'tag': 'form'});
    if (this.form) {
        var values = [];
        values[0] = {name: 'ajax', value: 'y'};
        this.gatherInputsValues(values, BX.findChildren(this.form, {'tag': new RegExp('^(input|select)$', 'i')}, true));

        for (var i = 0; i < values.length; i++)
            this.cacheKey += values[i].name + ':' + values[i].value + '|';

        if (this.cache[this.cacheKey]) {
            this.curFilterinput = input;
            this.postHandler(this.cache[this.cacheKey], true);
        } else {
            if (this.sef) {
                var set_filter = BX('set_filter');
                set_filter.disabled = true;
            }

            this.curFilterinput = input;
            BX.ajax.loadJSON(
                this.ajaxURL,
                this.values2post(values),
                BX.delegate(this.postHandler, this)
            );
        }
    }
};

JCSmartFilter.prototype.updateItem = function (PID, arItem) {
    if (arItem.PROPERTY_TYPE === 'N' || arItem.PRICE) {
        var trackBar = window['trackBar' + PID];
        if (!trackBar && arItem.ENCODED_ID)
            trackBar = window['trackBar' + arItem.ENCODED_ID];

        if (trackBar && arItem.VALUES) {
            if (arItem.VALUES.MIN) {
                if (arItem.VALUES.MIN.FILTERED_VALUE)
                    trackBar.setMinFilteredValue(arItem.VALUES.MIN.FILTERED_VALUE);
                else
                    trackBar.setMinFilteredValue(arItem.VALUES.MIN.VALUE);
            }

            if (arItem.VALUES.MAX) {
                if (arItem.VALUES.MAX.FILTERED_VALUE)
                    trackBar.setMaxFilteredValue(arItem.VALUES.MAX.FILTERED_VALUE);
                else
                    trackBar.setMaxFilteredValue(arItem.VALUES.MAX.VALUE);
            }
        }
    } else if (arItem.VALUES) {
        for (var i in arItem.VALUES) {
            if (arItem.VALUES.hasOwnProperty(i)) {
                var value = arItem.VALUES[i];
                var control = BX(value.CONTROL_ID);

                if (!!control) {
                    var label = document.querySelector('[data-role="label_' + value.CONTROL_ID + '"]');
                    if (value.DISABLED) {
                        if (label)
                            BX.addClass(label, 'disabled');
                        else
                            BX.addClass(control.parentNode, 'disabled');
                    } else {
                        if (label)
                            BX.removeClass(label, 'disabled');
                        else
                            BX.removeClass(control.parentNode, 'disabled');
                    }

                    if (value.hasOwnProperty('ELEMENT_COUNT')) {
                        label = document.querySelector('[data-role="count_' + value.CONTROL_ID + '"]');
                        if (label)
                            label.innerHTML = value.ELEMENT_COUNT;
                    }
                }
            }
        }
    }
};

JCSmartFilter.prototype.postHandler = function (result, fromCache) {
    var hrefFILTER, url, curProp;
    var modef = BX('modef');
    var modef_num = BX('modef_num');

    if (!!result && !!result.ITEMS) {
        for (var popupId in this.popups) {
            if (this.popups.hasOwnProperty(popupId)) {
                this.popups[popupId].destroy();
            }
        }
        this.popups = [];

        for (var PID in result.ITEMS) {
            if (result.ITEMS.hasOwnProperty(PID)) {
                this.updateItem(PID, result.ITEMS[PID]);
            }
        }

        if (!!modef && !!modef_num) {
            modef_num.innerHTML = result.ELEMENT_COUNT;
            hrefFILTER = BX.findChildren(modef, {tag: 'A'}, true);


            // $(document).find('.item__catalog__content-block-mobile-filter-main__accept').on('click', function () {
                $.ajax({
                    url: BX.util.htmlspecialcharsback(result.FILTER_URL),
                    type: 'GET', //Тип запроса
                    dataType: "html", //Тип данных
                    data: '',
                    success: function (response) { //Если все нормально
                        var resultElements = $(response).find(".block__sort").get(0);
                        $(".block__sort").replaceWith(resultElements);
                        history.pushState('', '', BX.util.htmlspecialcharsback(result.FILTER_URL))
                        executeScript();
                    },
                    error: function (response) {
                        console.log("Ошибка при отправке формы");
                    }
                });
            // });

            function executeScript() {
                    function openCatalogGraade2Content(content) {
                        content.style.height = `${content.scrollHeight}px`;
                    }
                    function closeCatalogGraade2Content(content) {
                        content.style.height = 0;
                    }
                    const catalogGrade2AccordBtn = document.querySelectorAll('.item__catalog-accord-title'),
                        catalogGrade2MobileBtn = document.querySelector('.item__catalog__content-block-mobile-filter-main-btn'),
                        catalogGrade2MobileContent = document.querySelector('.item__catalog__content-block-mobile-filter-main-content'),
                        catalogGrade2AccordContent = document.querySelectorAll('.item__catalog-accord-descr');
                    catalogGrade2AccordContent.forEach(item => openCatalogGraade2Content(item));
                    closeCatalogGraade2Content(catalogGrade2MobileContent);
                    catalogGrade2MobileBtn.addEventListener('click', () => {

                        catalogGrade2MobileBtn.classList.toggle('active')
                        if (catalogGrade2MobileBtn.classList.contains('active')) {
                            openCatalogGraade2Content(catalogGrade2MobileContent);
                        } else {
                            closeCatalogGraade2Content(catalogGrade2MobileContent);
                        }
                    });

                    catalogGrade2AccordBtn.forEach(function(item, index) {
                        item.addEventListener('click', function(e) {
                            item.classList.toggle('active');
                            catalogGrade2AccordContent[index].classList.toggle('active');
                            if (item.classList.contains('active')) {
                                openCatalogGraade2Content(catalogGrade2AccordContent[index]);
                            } else {
                                closeCatalogGraade2Content(catalogGrade2AccordContent[index]);
                            }
                            catalogGrade2MobileContent.style.height = catalogGrade2MobileContent.maxheight = '901px';
                        });
                    });
            }


            if (result.FILTER_URL && hrefFILTER) {
                hrefFILTER[0].href = BX.util.htmlspecialcharsback(result.FILTER_URL);
            }

            if (result.FILTER_AJAX_URL && result.COMPONENT_CONTAINER_ID) {
                BX.unbindAll(hrefFILTER[0]);
                BX.bind(hrefFILTER[0], 'click', function (e) {
                    url = BX.util.htmlspecialcharsback(result.FILTER_AJAX_URL);
                    BX.ajax.insertToNode(url, result.COMPONENT_CONTAINER_ID);
                    return BX.PreventDefault(e);
                });
            }

            if (result.INSTANT_RELOAD && result.COMPONENT_CONTAINER_ID) {
                url = BX.util.htmlspecialcharsback(result.FILTER_AJAX_URL);
                BX.ajax.insertToNode(url, result.COMPONENT_CONTAINER_ID);
            } else {
                // if (modef.style.display === 'none') {
                //     modef.style.display = 'inline-block';
                // }

                if (this.viewMode == "VERTICAL") {
                    curProp = BX.findChild(BX.findParent(this.curFilterinput, {'class': 'bx-filter-parameters-box'}), {'class': 'bx-filter-container-modef'}, true, false);
                    curProp.appendChild(modef);
                }

                if (result.SEF_SET_FILTER_URL) {
                    this.bindUrlToButton('set_filter', result.SEF_SET_FILTER_URL);
                }
            }
        }
    }

    if (this.sef) {
        var set_filter = BX('set_filter');
        set_filter.disabled = false;
        set_filter.focus();
    }

    if (!fromCache && this.cacheKey !== '') {
        this.cache[this.cacheKey] = result;
    }
    this.cacheKey = '';
};

JCSmartFilter.prototype.bindUrlToButton = function (buttonId, url) {
    var button = BX(buttonId);
    if (button) {
        var proxy = function (j, func) {
            return function () {
                return func(j);
            }
        };

        if (button.type == 'submit')
            button.type = 'button';

        BX.bind(button, 'click', proxy(url, function (url) {
            window.location.href = url;
            return false;
        }));
    }
};

JCSmartFilter.prototype.gatherInputsValues = function (values, elements) {
    if (elements) {
        for (var i = 0; i < elements.length; i++) {
            var el = elements[i];
            if (el.disabled || !el.type)
                continue;

            switch (el.type.toLowerCase()) {
                case 'text':
                case 'textarea':
                case 'password':
                case 'hidden':
                case 'select-one':
                    if (el.value.length)
                        values[values.length] = {name: el.name, value: el.value};
                    break;
                case 'radio':
                case 'checkbox':
                    if (el.checked)
                        values[values.length] = {name: el.name, value: el.value};
                    break;
                case 'select-multiple':
                    for (var j = 0; j < el.options.length; j++) {
                        if (el.options[j].selected)
                            values[values.length] = {name: el.name, value: el.options[j].value};
                    }
                    break;
                default:
                    break;
            }
        }
    }
};

JCSmartFilter.prototype.values2post = function (values) {
    var post = [];
    var current = post;
    var i = 0;

    while (i < values.length) {
        var p = values[i].name.indexOf('[');
        if (p == -1) {
            current[values[i].name] = values[i].value;
            current = post;
            i++;
        } else {
            var name = values[i].name.substring(0, p);
            var rest = values[i].name.substring(p + 1);
            if (!current[name])
                current[name] = [];

            var pp = rest.indexOf(']');
            if (pp == -1) {
                //Error - not balanced brackets
                current = post;
                i++;
            } else if (pp == 0) {
                //No index specified - so take the next integer
                current = current[name];
                values[i].name = '' + current.length;
            } else {
                //Now index name becomes and name and we go deeper into the array
                current = current[name];
                values[i].name = rest.substring(0, pp) + rest.substring(pp + 1);
            }
        }
    }
    return post;
};

JCSmartFilter.prototype.hideFilterProps = function (element) {
    var obj = element.parentNode,
        filterBlock = obj.querySelector("[data-role='bx_filter_block']"),
        propAngle = obj.querySelector("[data-role='prop_angle']");

    if (BX.hasClass(obj, "bx-active")) {
        new BX.easing({
            duration: 300,
            start: {opacity: 1, height: filterBlock.offsetHeight},
            finish: {opacity: 0, height: 0},
            transition: BX.easing.transitions.quart,
            step: function (state) {
                filterBlock.style.opacity = state.opacity;
                filterBlock.style.height = state.height + "px";
            },
            complete: function () {
                filterBlock.setAttribute("style", "");
                BX.removeClass(obj, "bx-active");
            }
        }).animate();

        BX.addClass(propAngle, "fa-angle-down");
        BX.removeClass(propAngle, "fa-angle-up");
    } else {
        filterBlock.style.display = "block";
        filterBlock.style.opacity = 0;
        filterBlock.style.height = "auto";

        var obj_children_height = filterBlock.offsetHeight;
        filterBlock.style.height = 0;

        new BX.easing({
            duration: 300,
            start: {opacity: 0, height: 0},
            finish: {opacity: 1, height: obj_children_height},
            transition: BX.easing.transitions.quart,
            step: function (state) {
                filterBlock.style.opacity = state.opacity;
                filterBlock.style.height = state.height + "px";
            },
            complete: function () {
            }
        }).animate();

        BX.addClass(obj, "bx-active");
        BX.removeClass(propAngle, "fa-angle-down");
        BX.addClass(propAngle, "fa-angle-up");
    }
};

BX.namespace("BX.Iblock.SmartFilter");
BX.Iblock.SmartFilter = (function () {
    /** @param {{
			leftSlider: string,
			rightSlider: string,
			tracker: string,
			trackerWrap: string,
			minInputId: string,
			maxInputId: string,
			minPrice: float|int|string,
			maxPrice: float|int|string,
			curMinPrice: float|int|string,
			curMaxPrice: float|int|string,
			fltMinPrice: float|int|string|null,
			fltMaxPrice: float|int|string|null,
			precision: int|null,
			colorUnavailableActive: string,
			colorAvailableActive: string,
			colorAvailableInactive: string
		}} arParams
     */
    var SmartFilter = function (arParams) {
        if (typeof arParams === 'object') {
            this.leftSlider = BX(arParams.leftSlider);
            this.rightSlider = BX(arParams.rightSlider);
            this.tracker = BX(arParams.tracker);
            this.trackerWrap = BX(arParams.trackerWrap);

            this.minInput = BX(arParams.minInputId);
            this.maxInput = BX(arParams.maxInputId);

            this.minPrice = parseFloat(arParams.minPrice);
            this.maxPrice = parseFloat(arParams.maxPrice);

            this.curMinPrice = parseFloat(arParams.curMinPrice);
            this.curMaxPrice = parseFloat(arParams.curMaxPrice);

            this.fltMinPrice = arParams.fltMinPrice ? parseFloat(arParams.fltMinPrice) : parseFloat(arParams.curMinPrice);
            this.fltMaxPrice = arParams.fltMaxPrice ? parseFloat(arParams.fltMaxPrice) : parseFloat(arParams.curMaxPrice);

            this.precision = arParams.precision || 0;

            this.priceDiff = this.maxPrice - this.minPrice;

            this.leftPercent = 0;
            this.rightPercent = 0;

            this.fltMinPercent = 0;
            this.fltMaxPercent = 0;

            this.colorUnavailableActive = BX(arParams.colorUnavailableActive);//gray
            this.colorAvailableActive = BX(arParams.colorAvailableActive);//blue
            this.colorAvailableInactive = BX(arParams.colorAvailableInactive);//light blue

            this.isTouch = false;

            this.init();

            if ('ontouchstart' in document.documentElement) {
                this.isTouch = true;

                BX.bind(this.leftSlider, "touchstart", BX.proxy(function (event) {
                    this.onMoveLeftSlider(event)
                }, this));

                BX.bind(this.rightSlider, "touchstart", BX.proxy(function (event) {
                    this.onMoveRightSlider(event)
                }, this));
            } else {
                BX.bind(this.leftSlider, "mousedown", BX.proxy(function (event) {
                    this.onMoveLeftSlider(event)
                }, this));

                BX.bind(this.rightSlider, "mousedown", BX.proxy(function (event) {
                    this.onMoveRightSlider(event)
                }, this));
            }

            BX.bind(this.minInput, "keyup", BX.proxy(function (event) {
                this.onInputChange();
            }, this));

            BX.bind(this.maxInput, "keyup", BX.proxy(function (event) {
                this.onInputChange();
            }, this));
        }
    };

    SmartFilter.prototype.getXCoord = function (elem) {
        var box = elem.getBoundingClientRect();
        var body = document.body;
        var docElem = document.documentElement;

        var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;
        var clientLeft = docElem.clientLeft || body.clientLeft || 0;
        var left = box.left + scrollLeft - clientLeft;

        return Math.round(left);
    };

    SmartFilter.prototype.getPageX = function (e) {
        e = e || window.event;
        var pageX = null;

        if (this.isTouch && event.targetTouches[0] != null) {
            pageX = e.targetTouches[0].pageX;
        } else if (e.pageX != null) {
            pageX = e.pageX;
        } else if (e.clientX != null) {
            var html = document.documentElement;
            var body = document.body;

            pageX = e.clientX + (html.scrollLeft || body && body.scrollLeft || 0);
            pageX -= html.clientLeft || 0;
        }

        return pageX;
    };


    SmartFilter.prototype.onMoveRightSlider = function (e) {
        if (!this.isTouch) {
            this.rightSlider.ondragstart = function () {
                return false;
            };
        }

        if (!this.isTouch) {
            document.onmousemove = BX.proxy(function (event) {
                this.rightPercent = 100 - (((this.countNewLeft(event)) * 100) / (this.trackerWrap.offsetWidth));
                this.makeRightSliderMove();
            }, this);

            document.onmouseup = function () {
                document.onmousemove = document.onmouseup = null;
            };
        } else {
            document.ontouchmove = BX.proxy(function (event) {
                this.rightPercent = 100 - (((this.countNewLeft(event)) * 100) / (this.trackerWrap.offsetWidth));
                this.makeRightSliderMove();
            }, this);

            document.ontouchend = function () {
                document.ontouchmove = document.ontouchend = null;
            };
        }

        return false;
    };

    return SmartFilter;
})();