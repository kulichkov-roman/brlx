<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections",
	"",
	Array(
		"IS_SEF" => "Y",
		"ID" => $_REQUEST["ID"],
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "1",
		"SECTION_URL" => "",
		"DEPTH_LEVEL" => "2",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000",
		"SEF_BASE_URL" => SITE_DIR."/catalog/",
		"SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/",
		"DETAIL_PAGE_URL" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/"
	)
);

foreach ($aMenuLinksExt as &$val){
	$val["DEPTH_LEVEL"]++;
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>