<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Alexkova\Corporate\Catalog\Element;
//define("ELEMENT_DRAW_DEBUG","Y");

global $detectElementDrawInclude;
if (!isset($detectElementDrawInclude))
	$detectElementDrawInclude = false;

$module_id = 'alexkova.corporate';
if (!CModule::IncludeModule($module_id)) return ;
$arResult = array();

if (defined("ELEMENT_DRAW_DEBUG") && ELEMENT_DRAW_DEBUG == 'Y' && $USER->IsAdmin()){
	//echo "arParams<pre>"; print_r(var_export($arParams)); echo "</pre>";
}

if ($arParams["DISPLAY_VARIANT"] == 'user_view'){

	$arUserTemplates = \Alexkova\Corporate\Catalog\Element::getUserElements(SITE_TEMPLATE_PATH, $arParams["ELEMENT"]["USER_VIEW_MODE"]);

	$userElement = $arUserTemplates[$arParams["ELEMENT"]["USER_VIEW_MODE"]];

	if (strlen($userElement["ELEMENT"])>0){
		$arResult["INCLUDE_VIEW"] = $userElement["ELEMENT"];
		if (!file_exists($arResult["INCLUDE_VIEW"])){
			return;
		}
	}

	if (strlen($userElement["PARAMS"])>0){
		include($userElement["PARAMS"]);
	}
}

if ($arParams["DISPLAY_VARIANT"] == 'library'){
    
        $arLibTemplates = \Alexkova\Corporate\Catalog\Element::getLibraryElements(false);

	$libElement = $arLibTemplates[$arParams["ELEMENT"]["LIBRARY_VIEW_MODE"]];

	if (strlen($libElement["ELEMENT"])>0){
		$arResult["INCLUDE_VIEW"] = $libElement["ELEMENT"];
		if (!file_exists($arResult["INCLUDE_VIEW"])){
			return;
		}
	}

	if (strlen($libElement["PARAMS"])>0 && isset($libElement["ACTIVE"]) && $libElement["ACTIVE"] == "Y"){
		include($libElement["PARAMS"]);
	}    
}


if (is_array($arParams["ELEMENT"]) && count($arParams["ELEMENT"]) >0 ){
	$pageTemplate = (isset($arParams["DISPLAY_VARIANT"])) ? strval($arParams["DISPLAY_VARIANT"]) : 'classic_card';
	$image = (isset($arParams["ELEMENT"]["IMAGE"]) && $arParams["ELEMENT"]["IMAGE"] != "") ? $arParams["ELEMENT"]["IMAGE"] : SITE_TEMPLATE_PATH."/images/block_standart_bg.jpg";

	$arResult["ELEMENT"] = $arParams["ELEMENT"];
	$arResult["ELEMENT"]["IMAGE"] = $image;
}



if (strlen(trim($pageTemplate))>0){
	$arResult["ELEMENT_PAGE"] = $pageTemplate;
}

$this->IncludeComponentTemplate();

if (!$detectElementDrawInclude){
	$arUserTemplates = \Alexkova\Corporate\Catalog\Element::getUserElements(SITE_TEMPLATE_PATH);

	foreach ($arUserTemplates as $cell=>$val){
		if (isset($val["CSS"])){
			$APPLICATION->SetAdditionalCSS($val["CSS"], true);
		}
		if (isset($val["JS"])){
			$APPLICATION->AddHeadScript($val["JS"], true);
		}

	}
        
        $arLibTemplates = \Alexkova\Corporate\Catalog\Element::getLibraryElements(false);
        

	foreach ($arLibTemplates as $cell=>$val){

            if( isset($val['ACTIVE']) && $val['ACTIVE'] == "Y") {
		if (isset($val["CSS"])){
                    $APPLICATION->SetAdditionalCSS($val["CSS"], true);
                        
                }
		if (isset($val["JS"])){
                        $APPLICATION->AddHeadScript($val["JS"], true);
		}
            }

	}
        
	$detectElementDrawInclude = true;
}


?>