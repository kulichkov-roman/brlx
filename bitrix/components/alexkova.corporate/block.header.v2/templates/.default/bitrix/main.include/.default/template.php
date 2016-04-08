<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if($arResult["FILE"] <> '')
	include($arResult["FILE"]);
if(strlen($arParams["AREA_EDIT_TEXT"])>0){
	$t = $component->getIncludeAreaIcons();
	$t[0]["TITLE"] = htmlspecialchars(trim($arParams["AREA_EDIT_TEXT"]));
	$component->addIncludeAreaIcons($t);
}
?>

