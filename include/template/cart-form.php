<? $APPLICATION->IncludeComponent(
    "pvcart:cart.form",
    "",
    array(
        "AJAX_MODE" => "Y",    // Включить режим AJAX
        "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
        "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
        "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "N",    // Включить подгрузку стилей
        "PERSONAL_AGREE" => "N",    // Выводить запрос на обработку персональных данных
        "PERSONAL_AGREE_LINK" => "",    // Ссылка на соглашение в отношении обработки персональных данных
        "USE_PHONE_MASK" => "Y",    // Использовать маску для ввода телефона
    ),
    false
); ?>