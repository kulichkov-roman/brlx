<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!CModule::IncludeModule("alexkova.popupad"))
	return false;

$moduleId = 'alexkova.popupad';
$jqueryOn = COption::GetOptionString($moduleId, "POPUP_JQUERY", 0);

if ($jqueryOn){
	CJSCore::Init(array("jquery"));
}
$FancyBoxOn = COption::GetOptionString($moduleId, "POPUP_FANCYBOX", 1);
$arParams['DELAY'] = COption::GetOptionString($moduleId, "POPUP_TIME_DELAY_SHOW", 0);

if ($FancyBoxOn){
	$componentDir = $this->__path;
	$APPLICATION->AddHeadScript($componentDir."/fancybox/lib/jquery.mousewheel-3.0.6.pack.js");
	$APPLICATION->AddHeadScript($componentDir."/fancybox/source/jquery.fancybox.js");
	$APPLICATION->AddHeadScript($componentDir."/fancybox/source/helpers/jquery.fancybox-buttons.js");
	$APPLICATION->AddHeadScript($componentDir."/fancybox/source/helpers/jquery.fancybox-thumbs.js");
	$APPLICATION->AddHeadScript($componentDir."/fancybox/source/helpers/jquery.fancybox-media.js");
	$APPLICATION->SetAdditionalCSS($componentDir.'/fancybox/source/jquery.fancybox.css');
	$APPLICATION->SetAdditionalCSS($componentDir.'/fancybox/source/helpers/jquery.fancybox-buttons.css');
}

$arResult = Array();
$limit=0;

$curPage = $APPLICATION->GetCurDir();
$arBanners = CKuznicaPopupad::GetBanners($limit );
$cnt=0;
$incIDs = array();
$incDayIDs = array();
$uniqueInfo = array();
if(!is_array($arBanners))
	return false;

//get time protect
$arResult['OPTIONS']['PROTECT_TIME'] = COption::GetOptionString($moduleId,'POPUP_PROTECTION_TIMER',3600);

foreach($arBanners as $key=>$arBanner)
{
	$arInfo = unserialize($arBanner['~INFO']);
	$arResult['OPTIONS']['DELAY'] = intval($arParams['DELAY']);
	$arBanner['TIME_NOT_SHOW'] = intval($arInfo['SHOW_PER_TIME']);
	$overflowLink = "";
	if(strlen($arBanner["URL"])>0)
	{
		if($arBanner["SHOW_TYPE"] <> "html")
			$overflowLink = $arBanner["URL"];
	}

	if($arBanner["IMAGE_ID"]>0)
		$bannerContent = CKuznicaPopupad::getContent($arBanner["IMAGE_ID"],$arBanner["FLASH_TRANSPARENT"],$overflowLink,true,$arBanner);
	else
	{
		if($arBanner["CODE_TYPE"] == "html")
			$bannerContent = $arBanner["CODE"];
		else
			$bannerContent = nl2br(strip_tags($arBanner["CODE"]));
	}
	$arResult["BANNERS"][$key] = $arBanner;
	$arResult["BANNERS"][$key]["HTML"] = $bannerContent;
	$incIDs[] = $arBanner["ID"];
}
//$this->IncludeComponentTemplate();



if(count($incIDs)>0)
	CKuznicaPopupad::incShow($incIDs);

include($_SERVER['DOCUMENT_ROOT']."/".$this->__path.'/templates/'.$this->__templateName.'/template.php');
?>