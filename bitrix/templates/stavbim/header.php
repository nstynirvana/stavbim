<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?CModule::IncludeModule("iblock");?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <? include($_SERVER['DOCUMENT_ROOT'] . "/include/template/head.php"); ?>
</head>

<? $APPLICATION->ShowPanel(); ?>

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
                    <svg width="220" height="40" viewBox="0 0 220 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.3848 39.948C8.14221 39.948 5.48753 39.2554 3.4208 37.8701C1.3897 36.4848 0.249433 34.5108 0 31.9481H2.4587C2.63686 33.7836 3.49206 35.2381 5.0243 36.3117C6.59216 37.3853 8.71234 37.9221 11.3848 37.9221C13.5941 37.9221 15.3401 37.3853 16.6229 36.3117C17.9414 35.2035 18.6006 33.8528 18.6006 32.2597C18.6006 31.1515 18.2443 30.2511 17.5316 29.5584C16.8546 28.8312 15.9994 28.2771 14.966 27.8961C13.9326 27.5152 12.5251 27.0996 10.7434 26.6493C8.60544 26.0952 6.87723 25.5584 5.5588 25.039C4.24036 24.4848 3.11791 23.671 2.19145 22.5974C1.26498 21.5238 0.801749 20.0866 0.801749 18.2857C0.801749 16.9697 1.21153 15.7576 2.0311 14.6494C2.85066 13.5065 3.99093 12.6061 5.4519 11.9481C6.91286 11.29 8.56981 10.961 10.4227 10.961C13.4516 10.961 15.8925 11.7056 17.7454 13.1948C19.634 14.6493 20.6495 16.6753 20.792 19.2727H18.3868C18.2799 17.4026 17.5316 15.8788 16.1419 14.7013C14.7522 13.5238 12.828 12.9351 10.3693 12.9351C8.30256 12.9351 6.59216 13.4545 5.2381 14.4935C3.88403 15.5325 3.207 16.7965 3.207 18.2857C3.207 19.6017 3.58115 20.6753 4.32945 21.5065C5.11338 22.303 6.05766 22.9264 7.16229 23.3766C8.30256 23.7922 9.79916 24.2424 11.6521 24.7273C13.6832 25.2468 15.3045 25.7662 16.516 26.2857C17.7632 26.7706 18.8144 27.4978 19.6696 28.4675C20.5248 29.4026 20.9524 30.6667 20.9524 32.2597C20.9524 33.7143 20.5426 35.0303 19.723 36.2078C18.9035 37.3853 17.7632 38.303 16.3022 38.961C14.8413 39.619 13.2021 39.948 11.3848 39.948Z"
                              fill="#1A1A1A"/>
                        <path d="M31.8599 13.3506V32C31.8599 34.0779 32.2519 35.5152 33.0358 36.3117C33.8198 37.0736 35.2095 37.4545 37.2049 37.4545H40.4654V39.5325H36.8308C34.3008 39.5325 32.4301 38.961 31.2185 37.8182C30.0426 36.6407 29.4547 34.7013 29.4547 32V13.3506H25.0718V11.3247H29.4547V4.15584H31.8599V11.3247H40.4654V13.3506H31.8599Z"
                              fill="#1A1A1A"/>
                        <path d="M45.3122 25.4026C45.3122 22.4935 45.9001 19.9481 47.076 17.7662C48.2876 15.5844 49.9445 13.9048 52.0469 12.7273C54.1849 11.5498 56.608 10.961 59.3161 10.961C62.3805 10.961 64.9818 11.6883 67.1198 13.1429C69.2578 14.5974 70.7544 16.4502 71.6096 18.7013V11.3247H74.0148V39.5325H71.6096V32.1039C70.7544 34.3896 69.24 36.2771 67.0663 37.7662C64.9283 39.2208 62.3449 39.948 59.3161 39.948C56.608 39.948 54.1849 39.3593 52.0469 38.1818C49.9445 36.9697 48.2876 35.2727 47.076 33.0909C45.9001 30.8745 45.3122 28.3117 45.3122 25.4026ZM71.6096 25.4026C71.6096 22.9437 71.0751 20.7792 70.0061 18.9091C68.9727 17.0043 67.5474 15.5498 65.7301 14.5455C63.9128 13.5065 61.8817 12.987 59.6368 12.987C57.285 12.987 55.2183 13.4892 53.4366 14.4935C51.6549 15.4632 50.2652 16.8831 49.2675 18.7532C48.2698 20.6234 47.7709 22.8398 47.7709 25.4026C47.7709 27.9654 48.2698 30.1818 49.2675 32.0519C50.2652 33.9221 51.6549 35.3593 53.4366 36.3636C55.2539 37.368 57.3206 37.8701 59.6368 37.8701C61.8817 37.8701 63.9128 37.368 65.7301 36.3636C67.583 35.3247 69.0262 33.8701 70.0595 32C71.0929 30.0952 71.6096 27.8961 71.6096 25.4026Z"
                              fill="#1A1A1A"/>
                        <path d="M92.6075 36.987L103.297 11.3247H105.863L93.8368 39.5325H91.3247L79.2984 11.3247H81.9175L92.6075 36.987Z"
                              fill="#1A1A1A"/>
                        <path d="M115.765 16.3636C116.762 14.6667 118.223 13.2814 120.148 12.2078C122.072 11.1342 124.263 10.5974 126.722 10.5974C129.359 10.5974 131.728 11.2035 133.831 12.4156C135.933 13.6277 137.59 15.342 138.802 17.5584C140.013 19.7403 140.619 22.2857 140.619 25.1948C140.619 28.0693 140.013 30.632 138.802 32.8831C137.59 35.1342 135.915 36.8831 133.777 38.1299C131.675 39.3766 129.323 40 126.722 40C124.192 40 121.965 39.4632 120.041 38.3896C118.152 37.316 116.727 35.9481 115.765 34.2857V39.5325H110.901V1.09091H115.765V16.3636ZM135.648 25.1948C135.648 23.0476 135.203 21.1775 134.312 19.5844C133.421 17.9913 132.209 16.7792 130.677 15.9481C129.181 15.1169 127.524 14.7013 125.706 14.7013C123.925 14.7013 122.268 15.1342 120.736 16C119.239 16.8312 118.027 18.0606 117.101 19.6883C116.21 21.2814 115.765 23.1342 115.765 25.2468C115.765 27.3939 116.21 29.2814 117.101 30.9091C118.027 32.5022 119.239 33.7316 120.736 34.5974C122.268 35.4286 123.925 35.8442 125.706 35.8442C127.524 35.8442 129.181 35.4286 130.677 34.5974C132.209 33.7316 133.421 32.5022 134.312 30.9091C135.203 29.2814 135.648 27.3766 135.648 25.1948Z"
                              fill="#1A1A1A"/>
                        <path d="M149.533 6.44156C148.607 6.44156 147.823 6.12987 147.182 5.50649C146.54 4.88312 146.219 4.12121 146.219 3.22078C146.219 2.32035 146.54 1.55844 147.182 0.935065C147.823 0.311688 148.607 0 149.533 0C150.424 0 151.172 0.311688 151.778 0.935065C152.42 1.55844 152.74 2.32035 152.74 3.22078C152.74 4.12121 152.42 4.88312 151.778 5.50649C151.172 6.12987 150.424 6.44156 149.533 6.44156ZM151.885 11.0649V39.5325H147.021V11.0649H151.885Z"
                              fill="#1A1A1A"/>
                        <path d="M195.398 10.5455C197.679 10.5455 199.71 11.013 201.492 11.9481C203.273 12.8485 204.681 14.2165 205.714 16.0519C206.748 17.8874 207.264 20.1212 207.264 22.7532V39.5325H202.454V23.4286C202.454 20.5887 201.723 18.4242 200.262 16.9351C198.837 15.4113 196.895 14.6494 194.436 14.6494C191.906 14.6494 189.893 15.4459 188.396 17.039C186.9 18.5974 186.152 20.8658 186.152 23.8442V39.5325H181.341V23.4286C181.341 20.5887 180.611 18.4242 179.15 16.9351C177.724 15.4113 175.782 14.6494 173.324 14.6494C170.794 14.6494 168.78 15.4459 167.284 17.039C165.787 18.5974 165.039 20.8658 165.039 23.8442V39.5325H160.175V11.0649H165.039V15.1688C166.001 13.6797 167.284 12.5368 168.887 11.7403C170.526 10.9437 172.326 10.5455 174.286 10.5455C176.744 10.5455 178.918 11.0823 180.807 12.1558C182.695 13.2294 184.103 14.8052 185.029 16.8831C185.849 14.8745 187.203 13.316 189.091 12.2078C190.98 11.0996 193.082 10.5455 195.398 10.5455Z"
                              fill="#1A1A1A"/>
                        <path d="M216.793 39.8442C215.867 39.8442 215.083 39.5325 214.441 38.9091C213.8 38.2857 213.479 37.5238 213.479 36.6234C213.479 35.7229 213.8 34.961 214.441 34.3377C215.083 33.7143 215.867 33.4026 216.793 33.4026C217.684 33.4026 218.432 33.7143 219.038 34.3377C219.679 34.961 220 35.7229 220 36.6234C220 37.5238 219.679 38.2857 219.038 38.9091C218.432 39.5325 217.684 39.8442 216.793 39.8442Z"
                              fill="#1A1A1A"/>
                    </svg>
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