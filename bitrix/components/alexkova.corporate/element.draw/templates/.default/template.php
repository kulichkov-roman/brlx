<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$this->setFrameMode(true);

if (strtoupper($arParams['ELEMENT']['TEXT_TYPE'])=='HTML')
    $arResult["ELEMENT"]["TEXT"] = htmlspecialchars_decode($arParams["ELEMENT"]["TEXT"]);

if ($arParams["DISPLAY_VARIANT"] == 'user_view' || $arParams["DISPLAY_VARIANT"] == 'library'){
	include($arResult["INCLUDE_VIEW"]);
}else{
	if (file_exists(dirname(__FILE__)."/".$arResult["ELEMENT_PAGE"].".php")){
		if (is_array($arResult["ELEMENT"]) && count($arResult["ELEMENT"]) >0 )
			include($arResult["ELEMENT_PAGE"].".php");
	}elseif(file_exists($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/elements/".$arResult["ELEMENT_PAGE"].".php")){
		include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/elements/".$arResult["ELEMENT_PAGE"].".php");
	}
}

?>