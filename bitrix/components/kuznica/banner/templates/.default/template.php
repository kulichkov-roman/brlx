<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var $this CBitrixComponentTemplate */
$this->setFrameMode(true);
if(count($arResult["ITEMS"]) == 0)return false;
foreach($arResult["ITEMS"] as $cell=>$strBanner)
{
	echo $strBanner;
}
?>