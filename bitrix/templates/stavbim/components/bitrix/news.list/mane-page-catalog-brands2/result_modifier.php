<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CModule::IncludeModule("iblock");

$arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"]);
$db_list = CIBlockSection::GetList(Array("sort"=>"asc"), $arFilter, true);
while($ar_result = $db_list->GetNext()) {
    $arrSections[$ar_result['ID']]["NAME"] = $ar_result['NAME'];
}

foreach($arResult["ITEMS"] as $arItemIndex => $arItemArray){

    $arrSections[$arItemArray['IBLOCK_SECTION_ID']]["ITEMS"][$arItemIndex] = $arItemArray;

}

$arResult["SECTIONS_LIST"] = $arrSections;

?>