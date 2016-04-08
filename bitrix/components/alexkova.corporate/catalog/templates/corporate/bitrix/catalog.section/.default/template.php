<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use Alexkova\Corporate\Catalog\Image;
use Alexkova\Corporate\Catalog\Tools;

$this->setFrameMode(true);


if($USER->isAdmin()){
	//echo "<pre>"; print_r($arResult['ITEMS']); echo "</pre>";
}


global $eMarketBasketData;

if (!empty($arResult['ITEMS']))
{

?>
<?
	if ($arParams["DISPLAY_TOP_PAGER"])
	{
		echo $arResult["NAV_STRING"];
	}
?>

<div class="container full-width">
	<div class="row">
	<?

	$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
	$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
	$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

	foreach ($arResult['ITEMS'] as $key => $arItem):
	$img = SITE_TEMPLATE_PATH.'/images/no-image.png';
	if (is_array($arItem["PREVIEW_PICTURE"])){
		$img = \Alexkova\Corporate\Catalog\Image::getResizeImage($arItem["PREVIEW_PICTURE"]["ID"]);
	}elseif(is_array($arItem["DETAIL_PICTURE"])){
		$img = \Alexkova\Corporate\Catalog\Image::getResizeImage($arItem["DETAIL_PICTURE"]["ID"]);
	}

		$boolDiscountShow = (0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF']);

		$sale_text = $arParams["MESS_BTN_BUY"];
		/*if (strlen($arItem["PROPERTIES"]["BUTTON_TITLE"]["VALUE"])>0)
			$sale_text = $arItem["PROPERTIES"]["BUTTON_TITLE"]["VALUE"];*/

		$price = "";
		$oldPrice = "";

		if ($arItem["PROPERTIES"]["PRICE"]["VALUE"]>0)
			$price = \Alexkova\Corporate\Catalog\Tools::formatPrice($arItem["PROPERTIES"]["PRICE"]["VALUE"]);
		if ($arItem["PROPERTIES"]["OLD_PRICE"]["VALUE"]>0)
			$oldPrice = \Alexkova\Corporate\Catalog\Tools::formatPrice($arItem["PROPERTIES"]["OLD_PRICE"]["VALUE"]);
		$discount = $oldPrice - $price;

		$arMarkers = array();
		if ($discount>0)
			$arMarkers[] = 'emarket-label-sale';
		if ($arItem["PROPERTIES"]["SPECIALOFFER"]["VALUE_ENUM_ID"]>0)
			$arMarkers[] = 'emarket-label-soffer';
		if ($arItem["PROPERTIES"]["NEWPRODUCT"]["VALUE_ENUM_ID"]>0)
			$arMarkers[] = 'emarket-label-new';
		if ($arItem["PROPERTIES"]["SALELEADER"]["VALUE_ENUM_ID"]>0)
			$arMarkers[] = 'emarket-label-hit';
		if ($arItem["PROPERTIES"]["RECOMMENDED"]["VALUE_ENUM_ID"]>0)
			$arMarkers[] = 'emarket-label-rec';

	?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
		$strMainID = $this->GetEditAreaId($arItem['ID']);

		$boolDiscountShow = (0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF']);



		?>

	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" id="<?=$strMainID?>" data-resize="autoresize" data-row-lg="0" data-row-md="0" data-row-sm="0" data-row-xs="0">

		<?
		$template = "sale_cart";
		$arElementDrawParams = array(
			"DISPLAY_VARIANT" => $template,
			"ELEMENT" => array(
				"NAME" => $arItem["NAME"],
				"TEXT" => "",
				"IMAGE" => $img,
				"LINK" => $arItem["DETAIL_PAGE_URL"],
				"SALE_TITLE" => $sale_text,
				"MARKERS" => $arMarkers,
				"PRICE" => $price,
				"OLD_PRICE" => $oldPrice,
				"CLASS_NAME"=>" wow fadeIn"
			),
			"LINK_ALL_BLOCK" => "N",
		);
		?>

		<?
		$APPLICATION->IncludeComponent(
			"alexkova.corporate:element.draw",
			".default",
			$arElementDrawParams,
			false,
                        array("HIDE_ICONS"=>"Y")
		);
		?>
	</div>
	<?endforeach;?>


	</div>
</div>
<?
}
if ($arParams["DISPLAY_BOTTOM_PAGER"])
{
	echo $arResult["NAV_STRING"];
}

?>
<script>
			$(window).load(function() {
				autoResize(".sale-card", 'sale_cart');
			})
		</script>
