<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

foreach ($arResult['SECTIONS'] as $arSection){
	if ($arSection["DEPTH_LEVEL"] == 1){
		$arSection["ITEMS"] = array();
		$arResult["TREE"][$arSection["ID"]] = $arSection;
		$parent = $arSection["ID"];
	}
	else{
		$arResult["TREE"][$parent]["ITEMS"][] = $arSection;
	}
}

?>