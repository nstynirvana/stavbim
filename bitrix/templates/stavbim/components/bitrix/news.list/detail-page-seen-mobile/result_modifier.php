<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CModule::IncludeModule("iblock");

$arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"]);
$db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
while($ar_result = $db_list->GetNext()) {

    $arrSections[$ar_result['ID']] = $ar_result['NAME'];

}

$arResult["SECTIONS_LIST"] = $arrSections;


?>