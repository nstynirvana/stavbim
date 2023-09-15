const searchPanel = document.querySelector('.search-panel'),
    searchOpenBtn = document.querySelector('.header__search-basket-btn');

const basketInputOnlinePay = document.querySelector('#online'),
    basketInputCryptoPay = document.querySelector('#crypto'),
    basketFormOnlinePay = document.querySelector('.basket__pay__choice__form__online'),
    basketFormCryptoPay = document.querySelector('.basket__pay__choice__form__crypto'),
    basketOpenPopupBtn = document.querySelector('#basket'),
    basketClosePopupBtn = document.querySelector('.basket__title__wrapper span'),
    basketPopup = document.querySelector('.basket'),
    basketPopupParent = document.querySelector('.basket__list__scroll'),
    basketPopupItem = document.querySelectorAll('.basket__item'),
    basketPrice = document.querySelector('.basket__pay__sum');

const removeBlockBtn = document.querySelectorAll('.basket__item__remove');

const mobileMenuBtn = document.querySelector('.header__mobil-btn'),
    mobileMenuWrapper = document.querySelector('.mobile__menu__wrapper'),
    mobileMenuContent = document.querySelector('.mobile__menu');

const card = document.querySelectorAll('.catalog__card');
const accordion = document.querySelectorAll('.openable');
const accordionBtn = document.querySelectorAll('.accordion__more-btn');
const accordionContent = document.querySelectorAll('.accordion__hidden');

const filterPrice = document.querySelectorAll('.catalog-cards__sort-panel__price'),
    filterPopular = document.querySelectorAll('.catalog-cards__sort-panel__popular');
const filter = document.querySelectorAll('.catalog-cards__sort-panel__filter');

const catalogLink = document.querySelectorAll('.catalog-cards-links-item'),
    catalogPrev = document.querySelector('.catalog-cards-navigation-prev'),
    catalogNext = document.querySelector('.catalog-cards-navigation-next');

const catalogGrade2AccordBtn = document.querySelectorAll('.item__catalog-accord-title'),
    catalogGrade2MobileBtn = document.querySelector('.item__catalog__content-block-mobile-filter-main-btn'),
    catalogGrade2MobileContent = document.querySelector('.item__catalog__content-block-mobile-filter-main-content'),
    catalogGrade2AccordContent = document.querySelectorAll('.item__catalog-accord-descr');

const productCardTableContent = document.querySelector('.product-card__text__sizes__accordion'),
    productCardTableOpenBtn = document.querySelector('.product-card__text__sizes__btn-open'),
    productCardTableCloseBtn = document.querySelector('.product-card__text__sizes__btn-close');

const accordionWrapperSize = document.querySelectorAll('.accordion__wrapper'),
    accordionWrapperSizeHead = document.querySelector('.catalog__card-wrapper');

const dropList = document.querySelector('.droplist'),
    dropListWrapper = document.querySelector('.droplist__wrapper'),
    dropListBtn = document.querySelector('.link-more');

const openMoreMenuBtn = document.querySelector('.mobile__more'),
    moreMenuList = document.querySelector('.mobile__menu__more'),
    moreMenuWrapper = document.querySelector('.mobile__menu__more__wrapper');

window.addEventListener('DOMContentLoaded', () => {

    searchOpenBtn.addEventListener('click', () => {
        searchPanel.classList.toggle('active');
        if (searchPanel.classList.contains('active')) {
            basketPopup.classList.remove('active');
            mobileMenuBtn.classList.remove('active');
            mobileMenuContent.classList.remove('active');
            dropList.classList.remove('active');
            dropListBtn.classList.remove('active');
            moreMenuList.classList.remove('active');
            moreMenuWrapper.classList.remove('active');
            mobileMenuWrapper.classList.remove('active');
        }
    });


    //Basket

    // basketOpenPopupBtn.addEventListener('click', () => {
    //     basketPopup.classList.toggle('active');
    //     if (basketPopup.classList.contains('active')) {
    //         searchPanel.classList.remove('active');
    //         mobileMenuBtn.classList.remove('active');
    //         mobileMenuContent.classList.remove('active');
    //         dropList.classList.remove('active');
    //         dropListBtn.classList.remove('active');
    //         moreMenuList.classList.remove('active');
    //         moreMenuWrapper.classList.remove('active');
    //         mobileMenuWrapper.classList.remove('active');
    //     }
    // });

    // basketClosePopupBtn.addEventListener('click', () => {
    //     basketPopup.classList.remove('active');
    // });

    /*basketInputOnlinePay.addEventListener('change', (e) => {
        basketFormOnlinePay.classList.add('active');
        basketFormCryptoPay.classList.remove('active');
    });*/

    /*basketInputCryptoPay.addEventListener('change', (e) => {
        basketFormOnlinePay.classList.remove('active');
        basketFormCryptoPay.classList.add('active');
    });*/

    // basketPopupItem.forEach((item, index) => {
    //     const removeBlockBtn = document.querySelectorAll('.basket__item__remove');
    //     removeBlockBtn[index].addEventListener('click', () => {
    //         item.remove();
    //         countPrice();
    //     });
    // });

    // function countPrice() {
    //     const result = [];
    //
    //     let sum = 0;
    //
    //     document.querySelectorAll('.basket__item__thing__descr__price').forEach(item => {
    //         const digits = item.innerHTML.match(/\d+/g).join('');
    //         result.push(+digits);
    //     });
    //
    //     for (let i = 0; i < result.length; i++) {
    //         sum += result[i];
    //     }
    //
    //     basketPrice.textContent = `${sum} ₽`;
    // }
    //
    // countPrice();

    //mobile menu
    mobileMenuBtn.addEventListener('click', () => {

        mobileMenuBtn.classList.toggle('active');
        mobileMenuContent.classList.toggle('active');
        moreMenuList.classList.remove('active');
        mobileMenuWrapper.classList.toggle('active');
        if (mobileMenuContent.classList.contains('active')) {
            searchPanel.classList.remove('active');
            basketPopup.classList.remove('active');
            dropList.classList.remove('active');
            dropListBtn.classList.remove('active');
        }
    });

    document.addEventListener('click', (e) => {
        if (mobileMenuContent.classList.contains('active')) {
            if (e.target === mobileMenuWrapper) {
                mobileMenuContent.classList.remove('active');
                mobileMenuBtn.classList.remove('active');
                mobileMenuWrapper.classList.remove('active');
            }
        }
    });


    // Функция для переключения состояния элемента
    function toggleAccordion(accordionWrapper) {
        const accordionContent = accordionWrapper.querySelector('.accordion__hidden');
        const accordionBtn = accordionWrapper.querySelector('.accordion__more-btn');

        if (accordionContent && accordionBtn) {
            if (accordionWrapper.classList.contains('active')) {
                // Скрываем содержимое и меняем текст кнопки на "Показать еще"
                accordionContent.style.height = '0px';
                accordionBtn.textContent = 'Показать еще';
                accordionWrapper.classList.remove('active');
            } else {
                // Показываем содержимое, меняем текст кнопки на "Скрыть"
                const contentHeight = accordionContent.scrollHeight + 'px';
                accordionContent.style.height = contentHeight;
                accordionBtn.textContent = 'Скрыть';
                accordionWrapper.classList.add('active');
            }
        }
    }

    // Обработчик клика на кнопку "Показать еще"
    function handleAccordionClick(event) {
        const accordionWrapper = event.currentTarget.closest('.openable');
        if (accordionWrapper) {
            toggleAccordion(accordionWrapper);
        }
    }

    // Получаем все кнопки "Показать еще"
    const accordionBtns = document.querySelectorAll('.accordion__more-btn');

    // Добавляем обработчик клика для каждой кнопки
    accordionBtns.forEach(btn => {
        btn.addEventListener('click', handleAccordionClick);
    });


    //запрос на сортировку без перезагрузки страницы my-works

    $("body").on("click", ".catalog-cards__sort-panel__filter a", function () {

        var sortField = $(this).data("sortfield");
        var sortOrder = $(this).data("sortorder");

        var stringToSend = "sortField=" + sortField + "&sortOrder=" + sortOrder;

        $("main.content").addClass("active");

        console.log("Это я сортирую тут все");


        sendQueryAction(stringToSend, "/my-works/", "sortChange", "POST");

        return false;
    });

    function sendQueryAction(strToSend, URL, action, method) {

        console.log("Нет я");

        $.ajax({
            url: location.href, //Адрес подгружаемой страницы
            type: method, //Тип запроса
            dataType: "html", //Тип данных
            data: strToSend,
            success: function (response) { //Если все нормально

                var resultElements = $(response).find(".block__sort").get(0);


                console.log("а может и я");


                $(".block__sort").replaceWith(resultElements);


            },
            error: function (response) {
                console.log("Ошибка при отправке формы");
            }
        });

    }

    //catalog list my-works

    $("body").on("click", ".catalog-cards-links-item a", function () {

        var valuePage = $(this).data("page");
        var navNum = $(this).data("navnum");

        var stringToSend = 'PAGEN_' + navNum + '=' + valuePage;

        $("main.content").addClass("active");

        sendQueryAction(stringToSend, "/my-works/", "pageChange", "GET");

        var newUrl = window.location.href.split('?')[0] + '?PAGEN_1=' + valuePage;
        history.pushState({path: newUrl}, '', newUrl);

        return false;
    });

    $("body").on("click", ".catalog-cards-navigation-prev", function () {
        var currentPage = parseInt($(".catalog-cards-links-item.active a").data("page"));
        if (currentPage > 1) {
            var prevPage = currentPage - 1;
            $(".catalog-cards-links-item a[data-page='" + prevPage + "']").click();
            var newUrl = window.location.href.split('?')[0] + '?PAGEN_1=' + prevPage;
            history.pushState({path: newUrl}, '', newUrl);
        }

        return false;
    });

    $("body").on("click", ".catalog-cards-navigation-next", function () {
        var currentPage = parseInt($(".catalog-cards-links-item.active a").data("page"));
        var countPages = parseInt($(".catalog-cards-links-item a").data("countpages"));
        if (currentPage < countPages) {
            var nextPage = currentPage + 1;
            $(".catalog-cards-links-item a[data-page='" + nextPage + "']").click();
            var newUrl = window.location.href.split('?')[0] + '?PAGEN_1=' + nextPage;
            history.pushState({path: newUrl}, '', newUrl);
        }
        return false;
    });

    // catalog grade 2

    function openCatalogGraade2Content(content) {
        content.style.height = `${content.scrollHeight}px`;
    }

    function closeCatalogGraade2Content(content) {
        content.style.height = 0;
    }

    if (catalogGrade2MobileContent == null || catalogGrade2AccordContent == null) {
    } else {

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


    let dinamicHeight;

    if (productCardTableOpenBtn == null || productCardTableCloseBtn == null) {
    } else {
        productCardTableOpenBtn.addEventListener('click', () => {
            addSize();
        });
        productCardTableCloseBtn.addEventListener('click', () => {
            removeSize();
        });
    }

    function addSize() {
        if (productCardTableContent == null && productCardTableOpenBtn == null && productCardTableCloseBtn == null) {
        } else {
            dinamicHeight = window.getComputedStyle(productCardTableContent).getPropertyValue("height");
            productCardTableContent.style.height = `${productCardTableContent.scrollHeight}px`;
        }
    }

    function removeSize() {
        if (productCardTableContent == null) {
        } else {
            productCardTableContent.style.height = `${dinamicHeight}`;
        }
    }

    let dinamicWidth;

    function getSizeandAdd() {
        if (accordionWrapperSize == null || accordionWrapperSizeHead == null) {
        } else {
            dinamicWidth = window.getComputedStyle(accordionWrapperSizeHead).getPropertyValue('width');
            accordionWrapperSize.forEach(item => item.style.width = dinamicWidth);
        }
    }

    getSizeandAdd();

    window.addEventListener('resize', () => {
        removeSize();
        getSizeandAdd();
    });

    window.addEventListener('scroll', () => {
        const parallax = document.querySelector('.howtobuy');
        const scrollY = window.pageYOffset;
        if (parallax == null) {
        } else {
            parallax.style.backgroundPositionY = scrollY * -0.8 + 'px';
        }
    });


    dropListBtn.addEventListener('click', () => {
        dropListBtn.classList.toggle('active');
        dropList.classList.toggle('active');
        dropListWrapper.classList.toggle('active');
        searchPanel.classList.remove('active');
        mobileMenuBtn.classList.remove('active');
        mobileMenuContent.classList.remove('active');
        basketPopup.classList.remove('active');
    });

    document.addEventListener('click', (e) => {
        if (e.target === dropListWrapper) {
            dropList.classList.remove('active');
            dropListWrapper.classList.remove('active');
            dropListBtn.classList.remove('active');
        }
    });
    console.log(openMoreMenuBtn);
    openMoreMenuBtn.addEventListener('click', () => {
        moreMenuWrapper.classList.add('active');
        moreMenuList.classList.add('active');
    });

    document.addEventListener('click', (e) => {
        if (moreMenuList.classList.contains('active')) {
            if (e.target === moreMenuWrapper || e.target.getAttribute('data-closeMoreMenu') == "") {
                moreMenuList.classList.remove('active');
                moreMenuWrapper.classList.remove('active');
            }
        }
    });

});

$(document).ready(function(){
    $('.product-card__slider').hover(function(){
        var helptext = $('.product-card__slider__item').attr('data');
        $('.tooltip-block_text').html(helptext).show();
        $('.tooltip-block').show();
    },function(){
        $('.tooltip-block_text').hide();
        $('.tooltip-block').hide();
    });
});
