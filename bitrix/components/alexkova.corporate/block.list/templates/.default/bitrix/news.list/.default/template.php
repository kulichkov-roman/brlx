<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$this->setFrameMode(true);
global $$arParams["ADDITIONAL_PARAMS"];
global $unicumID;
$arExtParams = $$arParams["ADDITIONAL_PARAMS"];
if ($unicumID<=0) {$unicumID = 1;}
else {$unicumID++;}

$resize = '';
if ($arParams["AUTORESIZE_CART"] == "Y") $resize = 'data-resize="autoresize"';
$colToElem = array(1 => 12, 2 => 6, 3 => 4, 4 => 3, 6 => 2, 12 => 1);
?>

<? //echo "<pre>"; print_r($arParams); echo "</pre>";?>

<?if (count($arResult["ITEMS"])>0):?>

	<?if ($arParams["DISPLAY_TOP_PAGER"] && $arParams["SLIDER"] != "Y")
	{
		echo $arResult["NAV_STRING"];
	}?>

	<?if (strlen($arParams["PAGE_BLOCK_TITLE"])>0):
		$addClass = '';
		if (strlen($arParams["PAGE_BLOCK_TITLE_GLYPHICON"])>0){
			$addClass = 'glyphicon glyphicon-pad '.$arParams["PAGE_BLOCK_TITLE_GLYPHICON"];
		}
		?>

		<h2 class="<?=$addClass?>"><?=$arParams["PAGE_BLOCK_TITLE"]?></h2>
	<?endif;?>

	<?if ($arParams["SLIDER"] == "Y") {?>
	<div class="slider-carousel" id="sl_<?=$unicumID?>">
		<?}?>
		<?
		foreach ($arResult["ITEMS"] as $cell => $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			$strMainID = $this->GetEditAreaId($arItem['ID']);
			?>
                
			<div id="<?=$strMainID?>" class="t_<?=$unicumID?> col-lg-<?=$arParams["LG_CNT"]?> col-md-<?=$arParams["MD_CNT"]?> col-sm-<?=$arParams["SM_CNT"]?> col-xs-<?=$arParams["XS_CNT"]?>"
				<?=$resize?>>
				<?$template = ($arParams["CUSTOM_STYLE"] == "Y" && $arItem["PROPERTIES"]["CUSTOM_STYLE"]["VALUE_XML_ID"] != "") ? $arItem["PROPERTIES"]["CUSTOM_STYLE"]["VALUE_XML_ID"] : $arParams["VISUAL_STYLE"];

				$elementParams = $arParams["ELEMENT"];



					if (strlen($arItem["PROPERTIES"]["GLYPHICON"]["VALUE"])>0)
						$elementParams["GLYPH"]["GLYPH_CLASS"] = $arItem["PROPERTIES"]["GLYPHICON"]["VALUE"];
//
                                
                                if ($template == 'glyph_links'){
                                    $elementParams["ACTIVE_FROM"] = $arItem["DATE_ACTIVE_FROM"];
                                    $elementParams["ACTIVE_TO"] = $arItem["DATE_ACTIVE_TO"];
				}
                                
//                                if ($template == 'video_card'){
//                                    foreach ($arItem["PROPERTIES"]["VIDEO"]["VALUE"] as $key=>$value) {
//                                        $elementParams["VIDEO"][$key]=array(
//                                            'NAME' => $arItem["PROPERTIES"]["VIDEO"]["DESCRIPTION"][$key],
//                                            'LINK' => $arItem["PROPERTIES"]["VIDEO"]["VALUE"][$key]
//                                        );
//                                    }
//				}

				if (strlen($arItem["PROPERTIES"]["LINK"]["VALUE"])>0){
					$arItem["DETAIL_PAGE_URL"] = $arItem["PROPERTIES"]["LINK"]["VALUE"];
				}

				$elementParams["NAME"] = $arItem["NAME"];
				$elementParams["TEXT"] = $arItem["PREVIEW_TEXT"];
				$elementParams["IMAGE"] = $arItem["PICTURE"];
				$elementParams["LINK"] = $arItem["DETAIL_PAGE_URL"];
                                $elementParams["SHOW_ELEMENT_URL"]=$arParams["ELEMENT"]["SHOW_ELEMENT_URL"];
                                $elementParams["SHOW_ELEMENT_URL_TITLE"]=$arParams["ELEMENT"]["SHOW_ELEMENT_URL_TITLE"];
                                $elementParams["CARD_BUTTONS"][]=array();
                                foreach ($arItem["PROPERTIES"]["LIST_BUTTONS"]["VALUE"] as $key=>$value) {
                                    $elementParams["CARD_BUTTONS"][$key]=array(
                                        'TITLE' => $arItem["PROPERTIES"]["LIST_BUTTONS"]["DESCRIPTION"][$key],
                                        'LINK' => $arItem["PROPERTIES"]["LIST_BUTTONS"]["VALUE"][$key]
                                    );
                                }
                                
				if (in_array('DATE_ACTIVE_FROM',$arParams["FIELD_CODE"])){
					$elementParams["ACTIVE_FROM"] = $arItem["ACTIVE_FROM"];
				}
				if (in_array('DATE_ACTIVE_TO',$arParams["FIELD_CODE"])){
					$elementParams["ACTIVE_TO"] = $arItem["ACTIVE_TO"];
				}


				if (in_array('PRICE', $arParams["PROPERTY_CODE"]) || $template == "sale-cart"){
					$elementParams["PRICE"] = $arItem["PROPERTIES"]['PRICE']['VALUE'];
					if (in_array('PRICE', $arParams["OLD_PRICE"]) || $template == "sale-card"){
						$elementParams["OLD_PRICE"] = $arItem["PROPERTIES"]['OLD_PRICE']['VALUE'];
					}
				}

				if ($arParams["ADD_ELEMENT_CLASS"] == "Y" && $arItem["PROPERTIES"]["ADD_CLASS"]["VALUE"] != "")
					$elementParams["CLASS_NAME"] = $arItem["PROPERTIES"]["ADD_CLASS"]["VALUE"];


				$arElementDrawParams = array(
					"DISPLAY_VARIANT" => $template,
					"ELEMENT" => $elementParams,
					"LINK_ALL_BLOCK" => $arParams["LINK_ALL_BLOCK"],
				);




				//echo "<pre>"; print_r($arElementDrawParams); echo "</pre>";
				$arElementDrawParams["ELEMENT_RESULT"] = $arItem;

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

		<? endforeach; ?>
		<?if ($arParams["SLIDER"] == "Y") {?>
	</div>

	<script>
            function isTouchDevice() {
              try {
                document.createEvent('TouchEvent');
                return true;
              }
              catch(e) {
                return false;
              }
            }
            <?if ($arParams["HIDE_SLIDER_ARROWS"] == "Y" || !isset($arParams["HIDE_SLIDER_ARROWS"])) {?>
                if (!isTouchDevice()) {
                    prevBtn = '<button type="button" class="slick-prev hidden-arrow">Previous</button>';
                    nextBtn = '<button type="button" class="slick-next hidden-arrow">Next</button>';
                }
            <?} else {?>
                if (!isTouchDevice()) {
                    prevBtn = '<button type="button" class="slick-prev">Previous</button>';
                    nextBtn = '<button type="button" class="slick-next">Next</button>';
                }
            <?}?>
            <?if ($arParams["HIDE_MOBILE_SLIDER_ARROWS"] == "Y") {?>
                if (isTouchDevice()) {
                    prevBtn = '<button type="button" class="slick-prev hidden-arrow">Previous</button>';
                    nextBtn = '<button type="button" class="slick-next hidden-arrow">Next</button>';
                }
            <?} else {?>
                if (isTouchDevice()) {
                    prevBtn = '<button type="button" class="slick-prev">Previous</button>';
                    nextBtn = '<button type="button" class="slick-next">Next</button>';
                }
            <?}?>
		$('#sl_'+<?=$unicumID?>).slick({
			dots: false,
			infinite: true,
			speed: 300,
                        <?if ($arParams["VERTICAL_SLIDER_MODE"] == "Y") {?>
                            vertical: true,
                        <?}?>
			slidesToShow: <?=$colToElem[$arParams["LG_CNT"]]?>,
			slidesToScroll: 1,     
                        prevArrow: prevBtn,
                        nextArrow: nextBtn,
			responsive: [
				{
					breakpoint: 1199,
					settings: {
						slidesToShow: <?=$colToElem[$arParams["MD_CNT"]]?>,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 991,
					settings: {
						slidesToShow: <?=$colToElem[$arParams["SM_CNT"]]?>,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: <?=$colToElem[$arParams["XS_CNT"]]?>,
						slidesToScroll: 1
					}
				},
			]
		});

		

	</script>
<?}?>

	<div class='clearfix'></div>
	<?if ($arParams["DISPLAY_BOTTOM_PAGER"] && $arParams["SLIDER"] != "Y")
	{
		echo $arResult["NAV_STRING"];
	}?>

	<?if ($arParams["AUTORESIZE_CART"] == "Y") :?>
		<script>
			$(window).load(function() {
				autoResize(".t_<?=$unicumID?>[data-resize=autoresize] .element-card", '<?=$template?>');
			})
		</script>
	<?endif;?>

<?endif;?>




