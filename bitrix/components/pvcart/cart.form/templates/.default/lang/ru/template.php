<?
$MESS["BEEHIVE_CART_FORM_TITLE"] = "Оформить заказ";
$MESS["BEEHIVE_CART_FORM_SUBMIT"] = "Оформить";
$MESS["BEEHIVE_CART_FORM_PERSONAL_AGREE"] = "Я согласен на <a href='#PERSONAL_AGREE#' title='Согласие на обработку персональных данных' target='_blank'>обработку персональных данных</a>";
$MESS["ROBOKASSA_TEXT"] = "После нажатия на кнопку, Вы будете перенаправлены на страницу ROBOKASSA, где сможете оплатить заказ любым удобным для Вас способом.";
$MESS["BEEHIVE_CART_FORM_ORDER_SUCCESS"] = <<<TEXT
  <div class="form-success__message">
            <img class="form-success__message_img" src="/design/img/success-img.svg">
            <h1 class="form-success__message_title">Заказ сформирован</h1>
            <p class="form-success__message_clue">В течении 5 секунд вы будете перенаправлены на Telegram-бота для оплаты</p>
  </div>
  <div class="form-success__path">
      <p class="form-success__path_clue">Если у вас возникли какие-то проблемы, перейдите в Telegram нажав кнопку ниже:</p>
      <button onclick="opennewtab('https://t.me/stavbim_bot/')" type="submit" name="submit" class="form-success__path_button">
      <p class="form-success__path_button-text">@StavBim</p>
      <img class="form-success__path_button-img" src="/design/img/telegram-icon.svg">
      </button>
  </div>
TEXT;
$MESS["BEEHIVE_CART_FORM_ROBOPAY_BUTTON"] = "Оплатить";

$MESS["BEEHIVE_CART_FORM_FIELD_NAME"] = "Имя";
$MESS["BEEHIVE_CART_FORM_FIELD_EMAIL"] = "E-mail";
$MESS["BEEHIVE_CART_FORM_FIELD_PHONE"] = "Телефон";
$MESS["BEEHIVE_CART_FORM_FIELD_PAYMENT_TYPE"] = "Тип оплаты";
$MESS["BEEHIVE_CART_FORM_FIELD_ADDRESS"] = "Адрес";
$MESS["BEEHIVE_CART_FORM_FIELD_COMMENT"] = "Комментарий";
$MESS["BEEHIVE_CART_FORM_FIELD_DELIVERY_SERVICES"] = "Способ доставки";
$MESS["BEEHIVE_CART_FORM_DELIVERY_FREE"] = "Бесплатно";
?>