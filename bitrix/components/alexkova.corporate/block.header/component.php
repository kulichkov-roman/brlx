<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$module_id = 'alexkova.corporate';
if (!CModule::IncludeModule($module_id)) return ;
$arResult = array();

function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
	$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
	$rgbArray = array();
	if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
		$colorVal = hexdec($hexStr);
		$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
		$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
		$rgbArray['blue'] = 0xFF & $colorVal;
	} elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
		$rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
		$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
		$rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
	} else {
		return false; //Invalid hex color code
	}
	return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}

$pageTemplate = 'version_v1';


$inversion = 'false';
$fullscreen = 'false';
$arResult["LOGO_FILE"] = SITE_DIR."include/logo.php";

$mainPage = str_replace("//","/", SITE_DIR.'/index.php');

if ($APPLICATION->GetCurPage(true) != $mainPage){
	if ($arParams["ALL_HEAD_THEME"] != 'user_theme'){
		$arCurrentTheme = \Alexkova\Corporate\Skin::getSkinSettings($arParams["ALL_HEAD_THEME"]);
		if (count($arCurrentTheme["SETTINGS"]["PARAMS"])>0){
			foreach ($arCurrentTheme["SETTINGS"]["PARAMS"] as $cell=>$val){
				$arParams[$cell] = $val;
				$arParams["ALL_".$cell] = $val;
			}
		}

		if (strlen($arCurrentTheme["CSS"])>0)
			$APPLICATION->SetAdditionalCSS($arCurrentTheme["CSS"]);
	}
}else{
	if ($arParams["HEAD_THEME"] != 'user_theme'){
		$arCurrentTheme = \Alexkova\Corporate\Skin::getSkinSettings($arParams["HEAD_THEME"]);

		if (count($arCurrentTheme["SETTINGS"]["PARAMS"])>0){
			foreach ($arCurrentTheme["SETTINGS"]["PARAMS"] as $cell=>$val){
				$arParams[$cell] = $val;
				$arParams["ALL_".$cell] = $val;

			}
		}

		if (strlen($arCurrentTheme["CSS"])>0)
			$APPLICATION->SetAdditionalCSS($arCurrentTheme["CSS"]);
	}
}

//////////////



$pageParams = array(
	"HEAD_THEME",
	"DISPLAY_MENU_VARIANT",
	"DISPLAY_HEAD_VARIANT",
	"DARK_MODE",
	"DARK_MODE_TRANSPARENT",
	"DARK_MODE_INVERSION",
	"FULL_SCREEN_MODE",
	"DISPLAY_HEAD_TEMPLATE",
	"HEAD_THEME"
);

foreach ($pageParams as $cell=>$val){
	$arResult["PARAMS"][$val] = $APPLICATION->GetCurPage(true) != $mainPage ? $arParams["ALL_".$val] : $arParams[$val];
}

$pageTemplate = $arResult["PARAMS"]["DISPLAY_HEAD_VARIANT"];


if ($arResult["PARAMS"]["DARK_MODE_INVERSION"] == "Y") {
	$inversion = 'true';
	$arResult["PARAMS"]["INVERSION"] = true;
	if (file_exists($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/logo_light.php")){
		$arResult["LOGO_FILE"] = SITE_DIR."include/logo_light.php";
	}
}

if ($arResult["PARAMS"]["FULL_SCREEN_MODE"] == "Y") {
	$fullscreen = 'true';
	$arResult["PARAMS"]["FULLSCREEN"] = true;
}


if ($arResult["PARAMS"]["DISPLAY_HEAD_TEMPLATE"] == "Y") $arResult["PARAMS"]["COLOR_STYLE"] = '';
else{
	$arResult["PARAMS"]["TRANSPARENT"] = round((intval($arResult["PARAMS"]["DARK_MODE_TRANSPARENT"]))/100,1);
	$arResult["PARAMS"]["DARK_MODE"] = str_replace('#','',$arResult["PARAMS"]["DARK_MODE"]);
	$arResult["PARAMS"]["COLOR"] = "rgba(".hex2RGB($arResult["PARAMS"]["DARK_MODE"], true).", ".$arResult["PARAMS"]["TRANSPARENT"].")";
}



if (strlen(trim($pageTemplate))>0){
    $this->IncludeComponentTemplate($pageTemplate);
}

?>