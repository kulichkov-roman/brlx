<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var $this CBitrixComponent */
$arParams["BANTYPE"] = trim(strip_tags($arParams["BANTYPE"]));
if(strlen($arParams["BANTYPE"]) == 0)
	return false;
$arParams["MODE"] = strlen($arParams["MODE"])>0?$arParams["MODE"]:"SINGLE";
$arParams["CNT"] = intval($arParams["CNT"])>0?intval($arParams["CNT"]):1;
$arParams["HIDE_WIDTH_HEIGHT"] = $arParams["HIDE_WIDTH_HEIGHT"] == "Y"?"Y":"N";
$arParams["ADD_NOFOLLOW"] = $arParams["ADD_NOFOLLOW"] == "Y"?"Y":"N";
if(!CModule::IncludeModule("alexkova.rklite"))
	return false;

$arResult = Array();
if ($this->StartResultCache(false))
{
	//$limit=1;
	$limit = $arParams["MODE"] == 'SINGLE'? '1' : $arParams["CNT"];
	$curPage = $APPLICATION->GetCurDir();
	$arBanners = CKuznica_rklite::GetBanners($arParams["BANTYPE"],$limit);
	if(!$arBanners)
	{
		$this->AbortResultCache();
		return false;
	}
	$cnt=0;
	$incIDs = array();
	$incDayIDs = array();
	$uniqueInfo = array();
	foreach($arBanners as $arBanner)
	{
		$arInfo = unserialize(htmlspecialchars_decode($arBanner["INFO"]));
		if($arInfo['INC_SHOW_COUNT'] == "Y")
		{
			$incDayIDs[] = $arBanner["ID"];
			$uniqueInfo[$arBanner["ID"]]["SHOW"] = array(
				"TYPE"=>$arInfo["BANNER_USHOW_TYPE"],
				"COOKIE_TIME"=>$arInfo["BANNER_USHOW_COOKIE_TIME"],
				"BANNER_USHOW" => $arInfo["BANNER_USHOW"]
			);
		}
		$overflowLink = "";
		if(strlen($arBanner["URL"])>0)
		{
			if($arBanner["SHOW_TYPE"] <> "html")
				$overflowLink = $arBanner["URL"];
		}

		if($arBanner["IMAGE_ID"]>0)
			$arResult["ITEMS"][] = CKuznica_rklite::getContent($arBanner["IMAGE_ID"],$arBanner["FLASH_TRANSPARENT"],$overflowLink,true,$arBanner,$arParams["HIDE_WIDTH_HEIGHT"], $arParams["ADD_NOFOLLOW"]);
		else
		{
			if($arBanner["CODE_TYPE"] == "html")
				$arResult["ITEMS"][] = $arBanner["CODE"];
			else
				$arResult["ITEMS"][] = nl2br(strip_tags($arBanner["CODE"]));
		}
		$arResult["BANNERS"][] = $arBanner;
		$incIDs[] = $arBanner["ID"];
		if($arParams["MODE"] == 'SINGLE')
			break;
		elseif(++$cnt>=$arParams["CNT"])
			break;
	}
	$this->IncludeComponentTemplate();
}
if(is_array($incDayIDs) && !empty($incDayIDs))
{
	foreach ($incDayIDs as $incDayID)
	{
		if(isset($uniqueInfo[$incDayID]["SHOW"]))
		{
			if($uniqueInfo[$incDayID]["SHOW"]["BANNER_USHOW"] == "Y")
			{
				switch($uniqueInfo[$incDayID]["SHOW"]["TYPE"])
				{
					case "S":
						$banSess = $USER->GetParam("RKLITE_SHOW_{$incDayID}");
						if(!$banSess)
						{
							CKuznica_rklite::ChangeStat($incDayID,array("SHOW"=>1));
							$USER->SetParam("RKLITE_SHOW_{$incDayID}",$incDayID);
						}
						break;
					case "C":
						$banCookie = $APPLICATION->get_cookie("RKLITE_SHOW_{$incDayID}");
						if(!$banCookie)
						{
							CKuznica_rklite::ChangeStat($incDayID,array("SHOW"=>1));
							$APPLICATION->set_cookie("RKLITE_SHOW_{$incDayID}",$incDayID,time()+$uniqueInfo[$incDayID]["SHOW"]["COOKIE_TIME"]);
						}
						break;
					default :
						break;
				}
			}
			else
			{
				CKuznica_rklite::ChangeStat($incDayID,array("SHOW"=>1));
			}
		}
	}
}
elseif ($USER->IsAuthorized() && $APPLICATION->GetShowIncludeAreas())
	if(($arIcons = CKuznica_rklite::GetIcons(false,$arParams["BANTYPE"])) !== false)
			$this->AddIncludeAreaIcons($arIcons);
if(is_array($arResult["BANNERS"]) && !empty($arResult["BANNERS"]))
{
	foreach ($arResult["BANNERS"] as $arItem)
	{
		if ($USER->IsAuthorized() && $APPLICATION->GetShowIncludeAreas())
		{
			if (($arIcons = CKuznica_rklite::GetIcons($arItem, $arParams["BANTYPE"])) !== false)
				$this->AddIncludeAreaIcons($arIcons);
		}
	}
}
?>