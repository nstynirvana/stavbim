function setMainFilterItem(id_element) {

    $("#" + id_element).trigger("click");

}

$(function () {
    "use strict";

    var lock = false;

    var ListLoader = function (wrap, url, append) {

        console.log("this");

        var listBlock = wrap.find('.ix-list-block');
        var navBlock = wrap.find('.ix-nav-block');

        if (lock) {
            return false;
        }
        lock = true;
        navBlock.find('.ix-show-more').addClass('_loading');

        if (!window.history.state) {
            window.history.replaceState({
                module: "skv",
                url: window.location.href
            }, document.title, window.location.href);
        }

        if (!append) {

            if (url.indexOf('PAGEN') > -1) {

                url = url.replace(/&?PAGEN_1=\d+/g, '');

                console.log(url);

            }

            window.history.pushState({
                module: "skv",
                url: url
            }, document.title, url);
        }

        if (url.indexOf('?') > 0) {
            url += '&'
        } else {
            url += '?'
        }

        console.log(url);

        var req = $.ajax({
            url: url + 'ajax=Y',
            type: 'get',
            dataType: 'html'
        });

        var scrollTo = function (wrap, force) {
            force = force || false;
            var scrollPosition = Math.max(wrap.offset().top - 100, 0);
            if (force || ((scrollPosition < $(document).scrollTop()) || (scrollPosition + 400 > ($(document).scrollTop() + $(window).height())))) {
                $('html, body').animate({
                    scrollTop: scrollPosition
                }, 1000);
            }
        };


        // Пришел ответ
        req.done(function (response) {  /* , textStatus, jqXHR */
            if (response) {
                if (!append) {
                    wrap.html(response);
                    scrollTo(wrap);
                } else {
                    var
                        _html = $(response),
                        products = _html.find('.ix-list-item'),
                        pageNav = _html.find('.ix-nav-block').html();
                    listBlock.append(products);
                    navBlock.empty().html(pageNav);

                }

            }
            lock = false;
        });

        // Запрос не удался
        req.fail(function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });

        // В любом случае
        req.always(function () {
            lock = false;
            wrap.find('._loading').removeClass('_loading');
        });


    };


    $(document)
        .on('click','.ix-show-more-btn', function(){
            var wrap = $(this).closest('.ix-cards-wrap');
            $(document).trigger('page:load', [wrap, $(this).data("url"), true]);
            return false;
        })
        .on('page:load', function (e, wrap, url, append) {
            ListLoader(wrap, url, append);
        });

});

$(window).scroll(function(){

    //СКОЛЬКО УЖЕ ПРОКРУТИЛИ
    var currentWindowScroll = $(window).scrollTop();
    //ОТПРАВНАЯ ТОЧКА ЭЛЕМЕНТА
    var blockStart = $("#content").offset().top;
    //ВЫСОТА БЛОКА
    var blockHeight = $("#content").height();
    //ВЫСОТА ПОЛЬЗОВАТЕЛЬСКОГО ОКНА БРАУЗЕРА
    var innerHeight = $(window).innerHeight();
    //ОТСТУП
    var diff = 300;
    //ГИГОУРОВНЕНИЕ
    var optimalSideWidow = blockStart+blockHeight-diff-innerHeight;

    //ЖМИ НА КНОПКУ
    if(currentWindowScroll > optimalSideWidow){
        $(".ix-show-more-btn").click();
    }

});
