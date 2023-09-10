<?php

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use Bitrix\Main\Context;
Use \Bitrix\Main\Config\Option;

class CartFormClass extends CBitrixComponent
{
    const FIELDS_CODE = 'DATA';
    const MODULE_NAME = 'pvgroup.cart';

    protected function checkModules()
    {
        if (!Loader::includeModule(self::MODULE_NAME)) {
            ShowError(Loc::getMessage('BC_C_FORM_CART_NOT_INSTALLED'));
            return false;
        }

        return true;
    }

    protected function createOrder($arFields, $arElements)
    {
        $request = Context::getCurrent()->getRequest();
        $params = array();
        $FIELDS_DATA = $request[self::FIELDS_CODE];
        $currency = Option::Get(self::MODULE_NAME, "CURRENCY_TEXT_" . SITE_ID);
        $currencyVal = Option::Get(self::MODULE_NAME, "CURRENCY_" . SITE_ID);

        foreach ($arFields as $FIELD) {
            if (in_array($FIELD["FORM_TYPE"], array("text", "textarea", "select")))
                $params[$FIELD["CODE"]] = $FIELDS_DATA[$FIELD["CODE"]];
        }

        //Make product list table
        $params["ITEMS_TEXT"] = "<table style='width: 100%;border-collapse: collapse;'>
                                <tr style=' background-color: #e2e2e2; font-size: 15px;'>
                                   
                                    <th style='padding:10px 15px;' colspan='2'>" . Loc::getMessage('BC_C_FORM_CART_HEADER_PRODUCT') . "</th>
                                    <th style='padding:10px 15px;'>" . Loc::getMessage('BC_C_FORM_CART_HEADER_PRODUCT_PRICE') . "</th>
                                    <th style='padding:10px 15px;'>" . Loc::getMessage('BC_C_FORM_CART_HEADER_PRODUCT_COUNT') . "</th>
                               </tr>";
        /*Fill Order Params*/
        foreach ($arElements as $arElement) {
            $path = $_SERVER["DOCUMENT_ROOT"] . '/' . ltrim($arElement["IMAGE"]["src"], "/");
            $data = file_get_contents($path);
            $base64 = 'data:' . $arElement["IMAGE"]["content_type"] . ';base64,' . base64_encode($data);

            $productParams = "";
            if (!empty($arElement["PARAMS_STR"])) {
                $productParams = "<div style='font-weight: bold'>" . Loc::getMessage('BC_C_FORM_CART_HEADER_PRODUCT_PARAMS') . "</div>";
                $productParams .= "<div>" . $arElement["PARAMS_STR"] . "</div>";
            }

            $params["ITEMS_TEXT"] .= "<tr>";
            $params["ITEMS_TEXT"] .= "<td style='padding:15px;text-align: center;border-bottom: 1px solid #d6d6d6;'><img src='{$base64}' alt='{$arElement["NAME"]}'></td>";
            $params["ITEMS_TEXT"] .= "<td style='padding:5px 15px;border-bottom: 1px solid #d6d6d6;'>
                                        <a target='_blank' href='{$arElement["DETAIL_PAGE_URL"]}' title='{$arElement["NAME"]}'>{$arElement["NAME"]}</a>
                                        " . $productParams . "
                                    </td>";
            $params["ITEMS_TEXT"] .= "<td style='padding:5px 15px;border-bottom: 1px solid #d6d6d6;text-align: center;'>{$arElement["PRICE"]} " . $currency . "</td>";
            $params["ITEMS_TEXT"] .= "<td style='padding:5px 15px;border-bottom: 1px solid #d6d6d6;text-align: center;'>{$arElement["QTY"]} " . Loc::getMessage('BC_C_FORM_CART_HEADER_PRODUCT_UNIT') . "</td>";
            $params["ITEMS_TEXT"] .= "</tr>";
            $params["SUM"] += floatval($arElement["PRICE"]) * intval($arElement["QTY"]);
            if (!empty($arElement["OLD_PRICE"]) && is_numeric($arElement["OLD_PRICE"]))
                $params["DISCOUNT_SUM"] += floatval($arElement["OLD_PRICE"] - $arElement["PRICE"]) * intval($arElement["QTY"]);
        }
        $params["ITEMS_TEXT"] .= "</table>";

        /*ORM Order*/
        global $USER;
        $USER_ID = $USER->GetID();
        $params["USER_ID"] = $USER_ID;
        $params["SITE_ID"] = SITE_ID;
        $params["CURRENCY"] = $currencyVal;
        $ORDER = CBeeOrder::createOrder($params, $arElements);
        if ($ORDER["STATUS"]) {
            $result["status"] = true;
            $result["ORDER"] = $ORDER;
        } else {
            $result["status"] = false;
            $result["error"] = $ORDER["ERROR"];
        }
        /**/

        return $result;
    }

    protected function getOrderFields(){
        $arrFields = $this->getDefaultFields();
        foreach ($arrFields as $key => $field){
            $arrFields[$key]["IS_REQUIRED"] = "";
            $arrFields[$key]["CLASS"] = "bcf-checkout-".strtolower($field["CODE"]);
            if ($key == "PAYMENT_TYPE")
                $arrFields[$key]["VALUES"] = CBeeOrder::getOrderPaymentTypes();
            if ($key == "DELIVERY_SERVICES"){
                $arrFields[$key]["INFO"] = CBeeOrder::getDeliveryServices(SITE_ID);
                $arrFields[$key]["VALUES"] = array();
                foreach ($arrFields[$key]["INFO"] as $element){
                    $arrFields[$key]["VALUES"][$element["ID"]] = $element["NAME"];
                }
                reset($arrFields[$key]["VALUES"]);
                $arrFields[$key]["SUBMITTED_VALUE"] = key($arrFields[$key]["VALUES"]);
            }

        }

        return $arrFields;
    }

    protected function getDefaultFields(){
        $fields =  array(
            "NAME" => array(
                "FORM_TYPE" => "text",
                "CODE" => "NAME",
            ),
            "EMAIL" => array(
                "FORM_TYPE" => "text",
                "CODE" => "EMAIL",
            ),
            "PHONE" => array(
                "FORM_TYPE" => "text",
                "CODE" => "PHONE",
            ),
            "PAYMENT_TYPE" => array(
                "FORM_TYPE" => "select",
                "CODE" => "PAYMENT_TYPE",
            ),
            "ADDRESS" => array(
                "FORM_TYPE" => "text",
                "CODE" => "ADDRESS",
            ),
            "COMMENT" => array(
                "FORM_TYPE" => "textarea",
                "CODE" => "COMMENT",
            ),
        );
        if ($this->arParams["SHOW_DELIVERY_SERVICES"] != "not_show") {
            $fields["DELIVERY_SERVICES"] = array(
                'FORM_TYPE' => 'select',
                'CODE' => 'DELIVERY_SERVICES',
            );
        }
        if (COption::GetOptionString(self::MODULE_NAME, "FORM_FIELD_FILE_INCLUDE") == "Y"){
            $fields["FILE"] = array(
                'FORM_TYPE' => 'file',
                'CODE' => 'FILE',
            );
        }
        return $fields;
    }

    public function executeComponent()
    {
        $this->includeComponentLang('class.php');

        if ($this->checkModules()) {
            $arResult["SUCCESS_ORDER"] = false;
            $request = Context::getCurrent()->getRequest();

            $arResult += CBeeCart::getUserCart(SITE_ID);

            $arResult['CURRENCY_TEXT'] = Option::Get(self::MODULE_NAME, "CURRENCY_TEXT_" . SITE_ID);
            $arResult['CURRENCY'] = Option::Get(self::MODULE_NAME, "CURRENCY_" . SITE_ID);

            /*Form fields*/
            $arResult["COMMON_ERRORS"] = array();
            $arResult["ORDER_SUM_IS_PASSED"] = CBeeOrder::checkMinimalOrderSum($arResult["DATA"]["TOTAL_SUM"], SITE_ID);
            $arResult["FIELDS_CODE"] = self::FIELDS_CODE;

            $arrAllFields = $this->getOrderFields();
            $arrFields = explode(",", Option::Get(self::MODULE_NAME, "FORM_FIELDS"));
            $arrFieldsRequired = explode(",", Option::Get(self::MODULE_NAME, "FORM_FIELDS_REQUIRED"));
            foreach ($arrAllFields as $key => $field) {
                if (!in_array($key, $arrFields)) unset($arrAllFields[$key]);
                $arrAllFields[$key]["IS_REQUIRED"] = (!in_array($key, $arrFieldsRequired)) ? "N" : "Y";
            }

            $arResult["FIELDS"] = $arrAllFields;

            $arResult["PARAMS_HASH"] = md5(serialize($this->arParams) . $this->GetTemplateName());

            if ($request->isPost() && (!isset($request["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $request["PARAMS_HASH"])) {
                if (check_bitrix_sessid()) {
                    if (!$arResult["ORDER_SUM_IS_PASSED"]){
                        $arResult["COMMON_ERRORS"][] = Loc::getMessage('BC_C_FORM_CART_ERROR_MINIMAL_PRICE')." ".Option::get(self::MODULE_NAME, "MINIMAL_ORDER_SUM_".SITE_ID)." ".$arResult['CURRENCY_TEXT'];
                    }
                    //Check required fields & fill submitted values
                    $emptyFields = 0;
                    foreach ($request[self::FIELDS_CODE] as $fieldCode => $fieldData) {
                        if ($fieldCode == "EMAIL" && !empty($fieldData) && !check_email($fieldData))
                            $arResult["ERROR_MESSAGE"][$fieldCode] = Loc::getMessage('BC_C_FORM_CART_ERROR_EMAIL');

                        if (empty($fieldData) && $arResult["FIELDS"][$fieldCode]["IS_REQUIRED"] == "Y")
                            $arResult["ERROR_MESSAGE"][$fieldCode] = Loc::getMessage('BC_C_FORM_CART_ERROR_REQUIRED');

                        if (empty($fieldData))
                            $emptyFields++;
                        $arResult["FIELDS"][$fieldCode]["SUBMITTED_VALUE"] = $fieldData;
                    }

                    if ($request->getPost("IS_PERSONAL_AGREE") == "Y" && $request->getPost("PERSONAL_AGREE") != "Y") {
                        $arResult["ERROR_MESSAGE"]["PERSONAL_AGREE"] = Loc::getMessage('BC_C_FORM_CART_ERROR_PERSONAL_AGREE');
                    }

                    if ($emptyFields == count($request[self::FIELDS_CODE]) && empty($arResult["ERROR_MESSAGE"]))
                        $arResult["COMMON_ERRORS"][] = Loc::getMessage('BC_C_FORM_CART_ERROR_EMPTY_FIELDS');

                    if (empty($arResult["COMMON_ERRORS"]) && empty($arResult["ERROR_MESSAGE"])) {
                        $order = $this->createOrder($arResult["FIELDS"], $arResult["ELEMENTS"]);
                        if ($order["status"]) {
                            $arResult = array();
                            $arResult["SUCCESS_ORDER"] = true;
                            $arResult["ORDER"] = $order["ORDER"];
                            $arResult["ELEMENTS"] = array();
                            //clear fields
                            foreach ($request[self::FIELDS_CODE] as $fieldCode => $fieldData) {
                                $arResult["FIELDS"][$fieldCode]["SUBMITTED_VALUE"] = "";
                            }
                        }
                    }
                }
            }

            $this->arResult = $arResult;

            $this->includeComponentTemplate();
        }
    }
}