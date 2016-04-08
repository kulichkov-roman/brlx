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

//echo "<pre>"; print_r($arParams); echo "</pre>";
//echo "<pre>"; print_r($arResult); echo "</pre>";

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
                    //echo "<pre>"; print_r($arItem); echo "</pre>";
			$img = SITE_TEMPLATE_PATH.'/images/no-image.png';
			if (is_array($arItem["PREVIEW_PICTURE"])){
				$img = \Alexkova\Corporate\Catalog\Image::getResizeImage($arItem["PREVIEW_PICTURE"]["ID"]);
			}elseif(is_array($arItem["DETAIL_PICTURE"])){
				$img = \Alexkova\Corporate\Catalog\Image::getResizeImage($arItem["DETAIL_PICTURE"]["ID"]);
			}

			$boolDiscountShow = (0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF']);

			?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
			$strMainID = $this->GetEditAreaId($arItem['ID']);

			$sale_text = $arParams["MESS_BTN_BUY"];
			if (strlen($arItem["PROPERTIES"]["BUTTON_TITLE"]["VALUE"])>0)
				$sale_text = $arItem["PROPERTIES"]["BUTTON_TITLE"]["VALUE"];

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

			<div class="col-lg-12" id="<?=$strMainID?>">

				<?
				$template = "sale_cart_list";
				$arElementDrawParams = array(
					"DISPLAY_VARIANT" => $template,
					"ELEMENT" => array(
						"NAME" => $arItem["NAME"],
						"IMAGE" => $img,
						"LINK" => $arItem["DETAIL_PAGE_URL"],
						"SALE_TITLE" => $sale_text,
						"MARKERS" => $arMarkers,
						"PRICE" => $price,
						"OLD_PRICE" => $oldPrice,
						"TEXT"=> $arItem['PREVIEW_TEXT'],
						"TEXT_TYPE"=> $arItem['PREVIEW_TEXT_TYPE'],                                        
                                                "OPERATION"=> array(
							array(
								"LINK"=>$arItem["DETAIL_PAGE_URL"],
								"TITLE"=>GetMessage('CATALOG_DETAIL'),
								"CLASS"=>'color-button color-button-light  small-button'
							),
							/*array(
								"LINK"=>"/ajax/question.php?PRODUCT=".$arItem["ID"],
								"TITLE"=>$sale_text,
								"CLASS"=>'color-button ajax-show  small-button'
							)*/
						),
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

		<div class="clearfix"></div>
	</div></div>
		<?
		}
		if ($arParams["DISPLAY_BOTTOM_PAGER"])
		{
			echo $arResult["NAV_STRING"];
		}

		?>

