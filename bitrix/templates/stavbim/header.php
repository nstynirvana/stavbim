<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?CModule::IncludeModule("iblock");?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <? include($_SERVER['DOCUMENT_ROOT'] . "/include/template/head.php"); ?>
</head>

<? $APPLICATION->ShowPanel(); ?>

<? include($_SERVER['DOCUMENT_ROOT'] . "/include/template/counters.php"); ?>

<body>
<header class="header">
    <div class="container">
        <div class="header__wrapper">
            <div class="header__mobile-wrapper">

                <div class="header__mobil-btn">
                    <span class="header__mobil-btn-top"></span>
                    <span class="header__mobil-btn-custom"></span>
                </div>

                <a href="/" class="header__logo">
                    <? include($_SERVER['DOCUMENT_ROOT'] . "/include/template/logo.php"); ?>
                </a>

            </div>

            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "main-menu-header",
                array(
                    "COMPONENT_TEMPLATE" => "main-menu-header",
                    "ROOT_MENU_TYPE" => "main",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MAX_LEVEL" => "2",
                    "CHILD_MENU_TYPE" => "main",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N"
                ),
                false
            ); ?>


            <div class="header__mobile-wrapper">

                <div class="header__change-language">
                    <a href="#" class="header__change-language-btn active"><p>RUS</p></a>
                    <a href="/en<?= $_SERVER["REQUEST_URI"] ?>" class="header__change-language-btn"><p>ENG</p></a>
                </div>

                <div class="header__search-basket">

                    <div id="search" class="header__search-basket-btn">
                        <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.7301 24.75C6.25181 24.75 1.00015 19.4334 1.00015 12.875C1.00015 6.31662 6.25181 1 12.7301 1C19.2083 1 24.46 6.31662 24.46 12.875C24.46 19.4334 19.2083 24.75 12.7301 24.75Z"
                                  stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M31 31L21.6012 21.484" stroke="currentColor" stroke-miterlimit="10"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <div id="basket" class="header__search-basket-btn">
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

                </div>
            </div>
        </div>
    </div>

    <?$APPLICATION->IncludeComponent(
        "bitrix:search.form",
        "seacrh-form",
        Array(
            "COMPONENT_TEMPLATE" => "flat",
            "PAGE" => "#SITE_DIR#search/index.php",
            "USE_SUGGEST" => "N"
        )
    );?>

</header>


<? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "main-menu-header-mobile",
    array(
        "COMPONENT_TEMPLATE" => "main-menu-header-mobile",
        "ROOT_MENU_TYPE" => "main",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array(),
        "MAX_LEVEL" => "2",
        "CHILD_MENU_TYPE" => "main",
        "USE_EXT" => "N",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N"
    ),
    false
); ?>

<!-- КОРЗИНА -->

<div class="basket">
    <div class="basket__title">
        <div class="basket__title__wrapper">
            Корзина <span></span>
        </div>
    </div>
    <div class="basket__list">
        <div class="basket__list__scroll">
            <div class="basket__item">
                <div class="basket__item__thing">
                    <div class="basket__item__thing__icon"><img src="/design/icons/works_icon.svg" alt=""></div>
                    <div class="basket__item__thing__descr">
                        <div class="basket__item__thing__descr__title">Модель для проектирования</div>
                        <div class="basket__item__thing__descr__price">500 ₽</div>
                    </div>
                </div>
                <div class="basket__item__remove">&#10006;</div>
            </div>
            <div class="basket__item">
                <div class="basket__item__thing">
                    <div class="basket__item__thing__icon"><img src="/design/icons/works_icon.svg" alt=""></div>
                    <div class="basket__item__thing__descr">
                        <div class="basket__item__thing__descr__title">Модель для проектирования</div>
                        <div class="basket__item__thing__descr__price">500 ₽</div>
                    </div>
                </div>
                <div class="basket__item__remove">&#10006;</div>
            </div>
            <div class="basket__item">
                <div class="basket__item__thing">
                    <div class="basket__item__thing__icon"><img src="/design/icons/works_icon.svg" alt=""></div>
                    <div class="basket__item__thing__descr">
                        <div class="basket__item__thing__descr__title">Модель для проектирования</div>
                        <div class="basket__item__thing__descr__price">500 ₽</div>
                    </div>
                </div>
                <div class="basket__item__remove">&#10006;</div>
            </div>
            <div class="basket__item">
                <div class="basket__item__thing">
                    <div class="basket__item__thing__icon"><img src="/design/icons/works_icon.svg" alt=""></div>
                    <div class="basket__item__thing__descr">
                        <div class="basket__item__thing__descr__title">Модель для проектирования</div>
                        <div class="basket__item__thing__descr__price">500 ₽</div>
                    </div>
                </div>
                <div class="basket__item__remove">&#10006;</div>
            </div>
            <div class="basket__item">
                <div class="basket__item__thing">
                    <div class="basket__item__thing__icon"><img src="/design/icons/works_icon.svg" alt=""></div>
                    <div class="basket__item__thing__descr">
                        <div class="basket__item__thing__descr__title">Модель для проектирования</div>
                        <div class="basket__item__thing__descr__price">500 ₽</div>
                    </div>
                </div>
                <div class="basket__item__remove">&#10006;</div>
            </div>
            <div class="basket__item">
                <div class="basket__item__thing">
                    <div class="basket__item__thing__icon"><img src="/design/icons/works_icon.svg" alt=""></div>
                    <div class="basket__item__thing__descr">
                        <div class="basket__item__thing__descr__title">Модель для проектирования</div>
                        <div class="basket__item__thing__descr__price">500 ₽</div>
                    </div>
                </div>
                <div class="basket__item__remove">&#10006;</div>
            </div>
            <div class="basket__item">
                <div class="basket__item__thing">
                    <div class="basket__item__thing__icon"><img src="/design/icons/works_icon.svg" alt=""></div>
                    <div class="basket__item__thing__descr">
                        <div class="basket__item__thing__descr__title">Модель для проектирования</div>
                        <div class="basket__item__thing__descr__price">500 ₽</div>
                    </div>
                </div>
                <div class="basket__item__remove">&#10006;</div>
            </div>
            <div class="basket__item">
                <div class="basket__item__thing">
                    <div class="basket__item__thing__icon"><img src="/design/icons/works_icon.svg" alt=""></div>
                    <div class="basket__item__thing__descr">
                        <div class="basket__item__thing__descr__title">Модель для проектирования</div>
                        <div class="basket__item__thing__descr__price">500 ₽</div>
                    </div>
                </div>
                <div class="basket__item__remove">&#10006;</div>
            </div>
        </div>
    </div>
    <div class="basket__pay">
        <div class="basket__pay__title">Сумма заказа:</div>
        <div class="basket__pay__sum">0 ₽</div>
    </div>
    <form action="" class="basket__pay__form">
        <div class="basket__pay__form__name-phone">
            <input placeholder="Имя" type="text" class="basket__pay__form__name">
            <input placeholder="Номер телефона" type="text" class="basket__pay__form__phone">
        </div>
        <input placeholder="Электронная почта" type="text" class="basket__pay__form__mail">
    </form>
    <div class="basket__pay__choice">
        <div class="basket__pay__choice__title">Способ оплаты</div>
        <div class="basket__pay__choice__btn">
            <div class="basket__pay__choice__btn-online">
                <input type="radio" id="online" name="choice" value="online" checked>
                <label for="online">Онлайн</label>
            </div>
            <div class="basket__pay__choice__btn-crypto">
                <input type="radio" id="crypto" name="choice" value="crypto">
                <label for="crypto">Криптовалюта</label>
            </div>
        </div>
        <form action="" class="basket__pay__choice__form__online active">
            <div class="basket__pay__choice__form__name-secondname">
                <input placeholder="Имя" type="text" class="basket__pay__choice__form__name">
                <input placeholder="Фамилия" type="text" class="basket__pay__choice__form__secondname">
            </div>
            <input placeholder="Номер карты" type="text" class="basket__pay__choice__form__card">
            <div class="basket__pay__choice__form__card-info">
                <input placeholder="Действует до " type="text" class="basket__pay__choice__form__card-time">
                <input placeholder="CVV - код" type="text" class="basket__pay__choice__form__card-cvv">
            </div>
        </form>
        <form action="" class="basket__pay__choice__form__crypto">
            <input placeholder="Номер кошелька" type="text" class="basket__pay__choice__form__wallet-number">
        </form>
    </div>
    <div class="basket__pay__btn__block">
        <button class="basket__pay__btn">Купить</button>
    </div>
    <div class="basket__copyright"><p>Нажимая кнопку «Купить» вы соглашаетесь с <a href="/confidentiality.html">политикой конфиденциальности</a></p></div>
</div>

<!-- КОРЗИНА -->