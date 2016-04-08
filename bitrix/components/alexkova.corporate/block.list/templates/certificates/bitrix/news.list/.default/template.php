<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this->setFrameMode(true);
global $$arParams["ADDITIONAL_PARAMS"];
$arExtParams = $$arParams["ADDITIONAL_PARAMS"];
//echo "<pre>";
//print_r($arResult['ITEMS']);
//echo "</pre>";

$resize = '';
if ($arParams["AUTORESIZE_CART"] == "Y") $resize = 'data-resize="autoresize"';
?>

<?if (count($arResult["ITEMS"])>0 && strlen($arParams["PAGE_BLOCK_TITLE"])>0):
	$addClass = '';
	if (strlen($arParams["PAGE_BLOCK_TITLE_GLYPHICON"])>0){
		$addClass = 'glyphicon glyphicon-pad '.$arParams["PAGE_BLOCK_TITLE_GLYPHICON"];
	}
	?>

	<h2 class="<?=$addClass?>"><?=$arParams["PAGE_BLOCK_TITLE"]?></h2>
<?endif;?>

<?if ($arParams["SLIDER"] == "Y") {?>
<div class="slider-carousel">
<?}?>
<?
    $colToElem = array(1 => 12, 2 => 6, 3 => 4, 4 => 3, 6 => 2, 12 => 1);
    foreach ($arResult["ITEMS"] as $cell => $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <?
    $rowLg = floor($cell/$colToElem[$arParams["LG_CNT"]]);
    $rowMd = floor($cell/$colToElem[$arParams["MD_CNT"]]);
    $rowSm = floor($cell/$colToElem[$arParams["SM_CNT"]]);
    $rowXs = floor($cell/$colToElem[$arParams["XS_CNT"]]);
    if ($arParams["ROW_ALIGN"] != "Y") {
        $rowLg = floor($cell/$colToElem[$arParams["LG_CNT"]]);
        $rowMd = floor($cell/$colToElem[$arParams["MD_CNT"]]);
        $rowSm = floor($cell/$colToElem[$arParams["SM_CNT"]]);
        $rowXs = floor($cell/$colToElem[$arParams["XS_CNT"]]);
    }
    ?>
    <?if ($arParams["SLIDER"] != "Y") {?>
        <div class="col-lg-<?=$arParams["LG_CNT"]?> col-md-<?=$arParams["MD_CNT"]?> col-sm-<?=$arParams["SM_CNT"]?> col-xs-<?=$arParams["XS_CNT"]?>"
         data-row-lg="<?=$rowLg?>" data-row-md="<?=$rowMd?>" data-row-sm="<?=$rowSm?>" data-row-xs="<?=$rowXs?>" <?=$resize?>>
    <?} else {?>
        <div class="col-lg-<?=$arParams["LG_CNT"]?> col-md-<?=$arParams["MD_CNT"]?> col-sm-<?=$arParams["SM_CNT"]?> col-xs-<?=$arParams["XS_CNT"]?>"
         data-row-lg="0" data-row-md="0" data-row-sm="0" data-row-xs="0" <?=$resize?>>
    <?}?>
        <?$template = ($arParams["CUSTOM_STYLE"] == "Y" && $arItem["PROPERTIES"]["CUSTOM_STYLE"]["VALUE_XML_ID"] != "") ? $arItem["PROPERTIES"]["CUSTOM_STYLE"]["VALUE_XML_ID"] : $arParams["VISUAL_STYLE"];

		$elementParams = $arParams["ELEMENT"];

		if ($template == 'modern_card_vertical'){

			if (strlen($arItem["PROPERTIES"]["GLYPHICON"]["VALUE"])>0){
				$elementParams["GLYPH"]["GLYPH_CLASS"] = $arItem["PROPERTIES"]["GLYPHICON"]["VALUE"];
			}else{
				$elementParams["GLYPH"]["GLYPH_CLASS"] = 'glyphicon-file';
			}
		}

		$elementParams["NAME"] = $arItem["NAME"];
		$elementParams["TEXT"] = $arItem["PREVIEW_TEXT"];
		$elementParams["IMAGE"] = $arItem["PICTURE"];
		$elementParams["LINK"] = $arItem["DETAIL_PAGE_URL"];
                $elementParams["PRICE"] = $arItem["PROPERTIES"]['PRICE']['VALUE'];
                $elementParams["OLD_PRICE"] = $arItem["PROPERTIES"]['OLD_PRICE']['VALUE'];
                $elementParams["FANCYBOX_HREF"] = $arItem["ORIGINAL_PICTURE"];

        $arElementDrawParams = array(
            "DISPLAY_VARIANT" => $template,
            "ELEMENT" => $elementParams,
            "LINK_ALL_BLOCK" => $arParams["LINK_ALL_BLOCK"],
        );
        

        if ($arParams["ADD_ELEMENT_CLASS"] == "Y" && $arItem["PROPERTIES"]["ADD_CLASS"]["VALUE"] != "")
            $arElementDrawParams["ELEMENT"]["CLASS_NAME"] = $arItem["PROPERTIES"]["ADD_CLASS"]["VALUE"];

		//echo "<pre>"; print_r($arItem); echo "</pre>";

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
    <?if ($arParams["SLIDER"] != "Y") {?>   
        <?if ( ($cell+1) % $colToElem[$arParams["LG_CNT"]] == 0 && $cell != 0) {?>
            <div class="clearfix visible-lg hidden-md hidden-sm hidden-xs"></div>
        <?}?>
        <?if ( ($cell+1) % $colToElem[$arParams["MD_CNT"]] == 0 && $cell != 0) {?>
            <div class="clearfix visible-md hidden-lg hidden-sm hidden-xs"></div>
        <?}?>
        <?if ( ($cell+1) % $colToElem[$arParams["SM_CNT"]] == 0 && $cell != 0) {?>
            <div class="clearfix template visible-sm hidden-lg hidden-md hidden-xs"></div>
        <?}?>
        <?if ( ($cell+1) % $colToElem[$arParams["XS_CNT"]] == 0 && $cell != 0) {?>
            <div class="clearfix template visible-xs hidden-lg hidden-md hidden-sm"></div>
        <?}?>
    <?}?>
<? endforeach; ?>
<?if ($arParams["SLIDER"] == "Y") {?>
</div>
    
<script>
$('.slider-carousel').slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: <?=$colToElem[$arParams["LG_CNT"]]?>,
      slidesToScroll: 1,
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

<?if ($arParams["AUTORESIZE_CART"] == "Y") :?>
	<script>
		$(window).load(function() {
			autoResize(".t_<?=$unicumID?>[data-resize=autoresize] .element-card", '<?=$template?>');
		})
	</script>
<?endif;?>