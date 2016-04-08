<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arParams["SLIDER"] == "Y") {?>
<div class="slider-carousel">
<?}?>
<?
//echo "<pre>";
//print_r($arParams);
//echo "</pre>";
?>
<?
    $colToElem = array(1 => 12, 2 => 6, 3 => 4, 4 => 3, 6 => 2, 12 => 1);

    foreach ($arResult["SECTIONS"] as $cell => $arSection):?>
    <?
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
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
         data-row-lg="<?=$rowLg?>" data-row-md="<?=$rowMd?>" data-row-sm="<?=$rowSm?>" data-row-xs="<?=$rowXs?>" data-resize="autoresize">
    <?} else {?>
        <div class="col-lg-<?=$arParams["LG_CNT"]?> col-md-<?=$arParams["MD_CNT"]?> col-sm-<?=$arParams["SM_CNT"]?> col-xs-<?=$arParams["XS_CNT"]?>"
         data-row-lg="0" data-row-md="0" data-row-sm="0" data-row-xs="0" data-resize="autoresize">
    <?}?>
        <?

		$template = "glyph_links";

		$elementParams = array(
			"TYPE_CARD" => "white",
			"TYPE_IMG" => "image",
			"SHOW_DESCRIPTION" => "Y",
			"IMAGE_BORDER" => "img-square",
			"IMAGE_SIZE_HEIGHT" => "100",
			"IMAGE_MAX_WIDTH" => "50",
			"CARD_ALIGN" => "center",
			"CARD_BORDER" => "Y",
			"SHOW_ELEMENT_BUTTONS" => "N",
			"GLYPH"=>array("GLYPH_CLASS" => "glyphicon-download"),
			"SLIDER" => "N",
			"VERTICAL_SLIDER_MODE" => "N",

			"NAME" => $arSection["NAME"],
			"IMAGE" => $arSection["PICTURE"]["SRC"],
			"TEXT" => $arSection["DESCRIPTION"],
			"LINK" => $arSection["SECTION_PAGE_URL"]
		);



        $arElementDrawParams = array(
            "DISPLAY_VARIANT" => $template,
            "ELEMENT" => $elementParams,
            "LINK_ALL_BLOCK" => $arParams["LINK_ALL_BLOCK"],
        );
        if ($arParams["ADD_ELEMENT_CLASS"] == "Y" && $arSection["PROPERTIES"]["ADD_CLASS"]["VALUE"] != "")
            $arElementDrawParams["CLASS_NAME"] = $arSection["PROPERTIES"]["ADD_CLASS"]["VALUE"];
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