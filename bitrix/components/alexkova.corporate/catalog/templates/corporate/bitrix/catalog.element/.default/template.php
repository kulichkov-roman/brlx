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

use Alexkova\Corporate\Catalog\Tools;

$this->setFrameMode(true);

//unset($arResult["MORE_PHOTO"]);
global $moreSettings;
//echo "<pre>"; print_r($arParams); echo "</pre>";
//echo "<pre>"; print_r($arResult); echo "</pre>";
//echo "<pre>34"; print_r($arResult["OFFERS"]); echo "</pre>";

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_sticker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
	'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'BUY_LINK' => $strMainID.'_buy_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && '' != $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	: $arResult['NAME']
);
$strAlt = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && '' != $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	: $arResult['NAME']
);

$useVoteRating = ('Y' == $arParams['USE_VOTE_RATING']);
$boolDiscountShow = (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF']);

?>

<div class="container full-width" id="<? echo $arItemIDs['ID']; ?>">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">


				<?
				$firstPhoto = false;
				if (is_array($arResult["DETAIL_PICTURE"])){
					$firstPhoto = $arResult["DETAIL_PICTURE"];
				}
				elseif(count($arResult["MORE_PHOTO"]) > 0){
					$firstPhoto = $arResult["MORE_PHOTO"][0];
				}

				$price = "";
				$oldPrice = "";

				if ($arResult["PROPERTIES"]["PRICE"]["VALUE"]>0)
					$price = \Alexkova\Corporate\Catalog\Tools::formatPrice($arResult["PROPERTIES"]["PRICE"]["VALUE"]);
				if ($arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"]>0)
					$oldPrice = \Alexkova\Corporate\Catalog\Tools::formatPrice($arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"]);
				$discount = $oldPrice - $price;

				$QueryTitle = COption::GetOptionString('alexkova.corporate', 'query_button_title', GetMessage('QUERY_BUTTON_TITLE'));
				$SaleTitle = COption::GetOptionString('alexkova.corporate', 'query_button_title', GetMessage('SALE_BUTTON_TITLE'));

				?>

				<?if ($firstPhoto):?>
			<div class="emarket_slider wow fadeIn">
					<div id="emarket_big_photo">
						<?if (is_array($firstPhoto)):?>
							<a href="<?=$firstPhoto["SRC"]?>"  rel="emarket-gallery">
								<img id="iMain" src="<?=$firstPhoto["SRC"]?>" alt="<?=$arResult["NAME"]?>" class="inslider" data-state="show">
							</a>
						<?else:?>
							<img src="<?=$arResult["DEFAULT_PICTURE"]["SRC"]?>" alt=" ">
						<?endif;?>
						<?if (count($arResult["MORE_PHOTO"]) > 0):?>
							<?foreach($arResult["MORE_PHOTO"] as $cell=>$photo):?>
								<?if ($cell == 0) {
									continue;
								}?>
								<a href="<?=$photo["SRC"]?>" rel="emarket-gallery"><img id="i<?=$cell?>" src="<?=$photo["SRC"]?>" class="inslider inslider-hide" alt="<?=$arResult["NAME"]."_".$cell?>" data-state="hide"></a>
							<?endforeach;?>
						<?endif;?>
					</div>
				<?else:?>
					<?if ('' != $arResult["PREVIEW_TEXT"]):?>
						<div class="corporate-product-description">
							<?if ('html' == $arResult['PREVIEW_TEXT_TYPE'])
							{
								echo $arResult['PREVIEW_TEXT'];
							}
							else
							{
								?><p><? echo $arResult['PREVIEW_TEXT']; ?></p><?
							}?>
						</div>
					<?endif;?>
				<?endif;?>



				<?if (count($arResult["MORE_PHOTO"]) > 1):?>
					<div id="emarket-photo-slider" style="position: relative" class="sm-hide xs-hide">
						<div class="sale-carousel" id="c_photos">
							<ul class="sale-carousel-row">
								<?foreach($arResult["MORE_PHOTO"] as $cell=>$photo):?>
									<li class="photo <?=$cell == 0 ? 'active' : ''?>" id="rec_tab1" data-slide="1" data-type="group" data-state="load">
										<div class="photo-wrap">
											<img src="<?=$photo["SRC"]?>" alt="<?=$arResult["NAME"]."_".$cell?>" data-item="<?if ($cell == 0):?>iMain<?else:?>i<?=$cell?><?endif?>">
										</div>
									</li>
								<?endforeach;?>
							</ul>
						</div>

					</div>
				<?endif;?>


				<div class="emarket-big-label-area">
					<?if ($boolDiscountShow):?>
						<div class="emarket-label emarket-label-sale"></div>
					<?endif;?>
					<?if ($arResult["PROPERTIES"]["SPECIALOFFER"]["VALUE_ENUM_ID"]>0):?>
						<div class="emarket-label emarket-label-soffer"></div>
					<?endif;?>
					<?if ($arResult["PROPERTIES"]["NEWPRODUCT"]["VALUE_ENUM_ID"]>0):?>
						<div class="emarket-label emarket-label-new"></div>
					<?endif;?>
					<?if ($arResult["PROPERTIES"]["SALELEADER"]["VALUE_ENUM_ID"]>0):?>
						<div class="emarket-label emarket-label-hit"></div>
					<?endif;?>
					<?if ($arResult["PROPERTIES"]["RECOMMENDED"]["VALUE_ENUM_ID"]>0):?>
						<div class="emarket-label emarket-label-rec"></div>
					<?endif;?>

				</div>
				<div class="clearfix"></div>

			<?if ($firstPhoto):?></div><?endif;?>

		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="price-line">
				<?if (strlen($arResult["PROPERTIES"]["PRICE"]["VALUE"])>0):?>
					<div class="product-price emarket-format-price">
						<?=\Alexkova\Corporate\Catalog\Tools::formatPrice($arResult["PROPERTIES"]["PRICE"]["VALUE"]);?>
					</div>
					<?if (strlen($arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"])>0):?>
						<div class="product-old-price emarket-format-price">
							<?=\Alexkova\Corporate\Catalog\Tools::formatPrice($arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"]);?>
						</div>
					<?endif;?>
				<?endif;?>

				<? (strlen($arResult["BUTTON"]["BUTTON_JS_CLASS"])<=0) ? $arResult["BUTTON"]["BUTTON_JS_CLASS"]='open-feedback-form' : $arResult["BUTTON"]["BUTTON_JS_CLASS"]=$arResult["BUTTON"]["BUTTON_JS_CLASS"]?>
				<? (strlen($arResult["BUTTON"]["BUTTON_TITLE"])<=0) ? $arResult["BUTTON"]["BUTTON_TITLE"]='������' : $arResult["BUTTON"]["BUTTON_TITLE"]=$arResult["BUTTON"]["BUTTON_TITLE"]?>

				<?if (strlen($arResult["PROPERTIES"]["BUTTON_TITLE"]["VALUE"])>0):?>
					<?$arResult["BUTTON"]["BUTTON_TITLE"] = $arResult["PROPERTIES"]["BUTTON_TITLE"]["VALUE"];?>
				<?endif;?>

				<div class="corporate-product-operation">
					<?if ($arResult["BUTTON"]["SHOW_BUTTON"]=='Y') {?>
						<a href="<? echo ($arResult['BUTTON']["BUTTON_ACTION"]=='js') ? 'javascript:void(0)' : $arResult['BUTTON']["BUTTON_LINK"]?>" class="color-button small-button <? echo ($arResult['BUTTON']["BUTTON_ACTION"]=='js') ? $arResult['BUTTON']["BUTTON_JS_CLASS"] : ''?>" target="<?=$arResult['BUTTON']["BUTTON_TARGET"]?>">
							<?=$arResult['BUTTON']["BUTTON_TITLE"]?>
						</a>
					<? } ?>
				</div>

				<div class="clearfix"></div>
				<div class="clearfix"></div>

			</div>

			<?if (('S' == $arParams['DISPLAY_PREVIEW_TEXT_MODE'] && 
                              '' != $arResult["PREVIEW_TEXT"] && 
                              $firstPhoto) ||
                            ('E' == $arParams['DISPLAY_PREVIEW_TEXT_MODE'] &&
                               '' == $arResult['DETAIL_TEXT'] && 
                              '' != $arResult["PREVIEW_TEXT"] && 
                              $firstPhoto)):?>
				<div class="corporate-product-description">
					<?if ('html' == $arResult['PREVIEW_TEXT_TYPE'])
					{
						echo $arResult['PREVIEW_TEXT'];
					}
					else
					{
						?><p><? echo $arResult['PREVIEW_TEXT']; ?></p><?
					}?>
				</div>
			<?endif;?>

		</div>

	</div>

	<div class="row">
		<?$tmpActive =true;?>
		<div class="col-lg-12">



			<ul class="emarket-tabs hidden-sm hidden-xs">

				<li id="emarket-description" class="<?=($tmpActive)?'active':''?>"><span><?=GetMessage('CATALOG_DESCRIPTION')?></span></li>
				<?if (count($arResult["DISPLAY_PROPERTIES"])>0):?>
					<li id="emarket-props"><span><?=GetMessage('CATALOG_PROPS')?></span></li>
				<?endif;?>
				<?if (count($arResult["FILES"])>0):?>
					<li id="emarket-file"><span><?=GetMessage('CATALOG_FILES')?></span></li>
				<?endif;?>

			</ul>
			<div class="clear"></div>

		<div class="emarket-detail-area">



			<div class="emarket-detail-area-container"  style="<?=($tmpActive)?'display:block':''?>" id="emarket-description-tab">
				<h3 class="hidden-lg hidden-md"><?=GetMessage('CATALOG_DESCRIPTION')?></h3>

				<?
				if ('' != $arResult['DETAIL_TEXT'])
				{
					if ('html' == $arResult['DETAIL_TEXT_TYPE'])
					{
						echo $arResult['DETAIL_TEXT'];
					}
					else
					{
						?><p><? echo $arResult['DETAIL_TEXT']; ?></p><?
					}
				}		?>
			</div>

			<?if (count($arResult["FILES"])>0):?>
				<div class="emarket-detail-area-container"   id="emarket-file-tab">
					<h3 class="hidden-lg hidden-md"><?=GetMessage('CATALOG_FILES')?></h3>

					<?foreach ($arResult["FILES"] as $val):?>

						<?$template = "file_element";
						$arElementDrawParams = array(
							"DISPLAY_VARIANT" => $template,
							"ELEMENT" => array(
								"NAME" => $val["ORIGINAL_NAME"],
								"LINK" => $val["SRC"],
								"CLASS_NAME"=>$val["EXTENTION"]
							)
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

					<?endforeach;?>

				</div>
			<?endif;?>



			<?if (count($arResult["DISPLAY_PROPERTIES"])>0):?>
				<div class="emarket-detail-area-container"   id="emarket-props-tab">
					<h3 class="hidden-lg hidden-md"><?=GetMessage('CATALOG_PROPS')?></h3>

					<table width="100%" class="emarket-props-table">
						<?foreach($arResult["DISPLAY_PROPERTIES"] as $arProperty):?>
							<?if (!is_array($arProperty["VALUE"])){?>
								<tr>
									<td class="emarket-props-name"><span><?=$arProperty["NAME"]?></span></td>
									<td class="emarket-props-data"><?=$arProperty["VALUE"]?></td>
								</tr>
							<?}else{?>
							<?}?>
						<?endforeach;?>
						<?foreach($arResult["DISPLAY_PROPERTIES"] as $arProperty):?>
							<?if (is_array($arProperty["VALUE"]) && count($arProperty["VALUE"]>0)){?>
								<tr>
									<td colspan="2" class="emarket-props-data emarket-props-data-group">
										<b><?=$arProperty["NAME"]?></b>
									</td>
								</tr>
								<?foreach($arProperty["VALUE"] as $cell=>$val){?>
									<tr>
										<td class="emarket-props-name"><span><?=$arProperty["DESCRIPTION"][$cell]?></span></td>
										<td class="emarket-props-data"><?=$val?></td>
									</tr>
								<?}?>
							<?}else{?>
							<?}?>
						<?endforeach;?>
					</table>
				</div>
			<?endif;?>

		</div>

		</div>
		<div class="clearfix"></div>
	</div>
</div>

