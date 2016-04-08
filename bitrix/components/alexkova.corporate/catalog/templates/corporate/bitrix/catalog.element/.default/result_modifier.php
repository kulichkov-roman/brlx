<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$displayPreviewTextMode = array(
	'H' => true,
	'E' => true,
	'S' => true
);
$detailPictMode = array(
	'IMG' => true,
	'POPUP' => true,
	'MAGNIFIER' => true,
	'GALLERY' => true
);

$arDefaultParams = array(
	'TEMPLATE_THEME' => 'blue',
	'ADD_PICT_PROP' => '-',
	'LABEL_PROP' => '-',
	'OFFER_ADD_PICT_PROP' => '-',
	'OFFER_TREE_PROPS' => array('-'),
	'DISPLAY_NAME' => 'Y',
	'DETAIL_PICTURE_MODE' => 'IMG',
	'ADD_DETAIL_TO_SLIDER' => 'N',
	'DISPLAY_PREVIEW_TEXT_MODE' => 'E',
	'PRODUCT_SUBSCRIPTION' => 'N',
	'SHOW_DISCOUNT_PERCENT' => 'N',
	'SHOW_OLD_PRICE' => 'N',
	'SHOW_MAX_QUANTITY' => 'N',
	'DISPLAY_COMPARE' => 'N',
	'MESS_BTN_BUY' => '',
	'MESS_BTN_ADD_TO_BASKET' => '',
	'MESS_BTN_SUBSCRIBE' => '',
	'MESS_BTN_COMPARE' => '',
	'MESS_NOT_AVAILABLE' => '',
	'USE_VOTE_RATING' => 'N',
	'VOTE_DISPLAY_AS_RATING' => 'rating',
	'USE_COMMENTS' => 'N',
	'BLOG_USE' => 'N',
	'BLOG_URL' => 'catalog_comments',
	'VK_USE' => 'N',
	'VK_API_ID' => '',
	'FB_USE' => 'N',
	'FB_APP_ID' => '',
	'BRAND_USE' => 'N',
	'BRAND_PROP_CODE' => ''
);
$arParams = array_merge($arDefaultParams, $arParams);

$productSlider = array();
if (is_array($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) 
&& is_array($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"])
&& count($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"])>0){

	foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $val){
		$productSlider[] = CFile::GetFileArray($val);
	}
}

$arResult['MORE_PHOTO'] = $productSlider;

$arResult["FILES"] = array();

if (isset($arResult["PROPERTIES"]["FILES"])
	&& is_array($arResult["PROPERTIES"]["FILES"]["VALUE"])
	&& count($arResult["PROPERTIES"]["FILES"]["VALUE"])>0){

	foreach($arResult["PROPERTIES"]["FILES"]["VALUE"] as $val){
		$tFile = CFile::GetFileArray($val);
		$arExt = explode(".", $tFile["FILE_NAME"]);
		if (in_array(strtolower($arExt[count($arExt)-1]), array('xls', 'xlsx', 'rar', 'pdf', 'doc', 'docx')))
			$tFile["EXTENTION"] = strtolower($arExt[count($arExt)-1]);
		else
			$tFile["EXTENTION"] = 'file';

		$arResult["FILES"][] = $tFile;
	}
}



$arResult["BUTTON"] = array(
	"SHOW_BUTTON" => $arParams["SHOW_REQUEST_BUTTON"],
	"BUTTON_ACTION" => $arParams["REQUEST_BUTTON_ACTION"],
	"BUTTON_LINK" => $arParams["REQUEST_BUTTON_LINK"],
	"BUTTON_TARGET" => $arParams["REQUEST_BUTTON_TARGET"],
	"BUTTON_JS_CLASS" => $arParams["REQUEST_BUTTON_JS_CLASS"],
	"BUTTON_TITLE" => $arParams["REQUEST_BUTTON_TITLE"],
);

if (isset($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]))
	unset($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]);
if (isset($arResult["DISPLAY_PROPERTIES"]["FILES"]))
	unset($arResult["DISPLAY_PROPERTIES"]["FILES"]);
?>