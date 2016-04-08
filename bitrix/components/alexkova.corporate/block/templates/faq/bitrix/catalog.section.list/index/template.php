<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

$sectionLinc = array();
$arResult['ROOT'] = array();
$sectionLinc[0] = &$arResult['ROOT'];
foreach($arResult["SECTIONS"] as $cell=>$val) {
	$sectionLinc[intval($val['IBLOCK_SECTION_ID'])]['CHILD'][$val['ID']] = $val;
	$sectionLinc[$val['ID']] = &$val[intval($val['IBLOCK_SECTION_ID'])]['CHILD'][$val['ID']];
}



?>
<?if ($arParams["SLIDER"] == "Y") {?>
<div class="slider-carousel">
<?}?>
<?
    $colToElem = array(1 => 12, 2 => 6, 3 => 4, 4 => 3, 6 => 2, 12 => 1);
    foreach ($arResult["ROOT"]["CHILD"] as $cell => $arSection):?>
    <?
    /*echo "<pre>";
    print_r($arSection);
    echo "</pre>";*/

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
		$template = $arParams["INDEX_VISUAL_STYLE"];

		$elementParams = $arParams["ELEMENT"];



		$elementParams["NAME"] = $arSection["NAME"];
		$elementParams["TEXT"] = htmlspecialchars_decode($arSection["DESCRIPTION"]);
		$elementParams["IMAGE"] = $arSection["PICTURE"]["SRC"];
		$elementParams["LINK"] = $arSection["SECTION_PAGE_URL"];
		$elementParams["CLASS_NAME"] = 'wow fadeIn';

		if ($arParams["SHOW_ELEMENT_URL"] == "Y" && strlen($arParams["SHOW_ELEMENT_URL_TITLE"])>0){
			$elementParams["CARD_BUTTONS"][] = array(
				"LINK"=>$arSection["SECTION_PAGE_URL"],
				"TITLE"=>$arParams["SHOW_ELEMENT_URL_TITLE"],
				"TYPE"=>'dark',
				"CLASS" => '',
			);
		}

        $arElementDrawParams = array(
            "DISPLAY_VARIANT" => $template,
            "ELEMENT" => $elementParams,
            "LINK_ALL_BLOCK" => $arParams["LINK_ALL_BLOCK"],
        );


        ?>
	<?//echo "<pre>"; print_r($arElementDrawParams); echo "</pre>";?>
            <?
            $APPLICATION->IncludeComponent(
                    "alexkova.corporate:element.draw",
                    ".default",
                    $arElementDrawParams,
                    false,
                    array('HIDE_ICONS'=>"Y")
                    );
            ?>
        </div>
    <?if ($arParams["SLIDER"] != "Y") {?>   
        <?/*if ( ($cell+1) % $colToElem[$arParams["LG_CNT"]] == 0 && $cell != 0) {?>
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
        <?}*/?>
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