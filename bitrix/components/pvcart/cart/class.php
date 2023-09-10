<?php
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main;

class CartClass extends CBitrixComponent
{
    const MODULE_NAME = "pvgroup.cart";

    protected function checkModules()
    {
        if (!Loader::includeModule(self::MODULE_NAME)) {
            ShowError(Loc::getMessage('BC_C_CART_NOT_INSTALLED'));
            return false;
        }

        return true;
    }

    public function executeComponent()
    {
        $this->includeComponentLang('class.php');

        if ($this->checkModules()) {
            $this->includeComponentTemplate();
        }
    }
}