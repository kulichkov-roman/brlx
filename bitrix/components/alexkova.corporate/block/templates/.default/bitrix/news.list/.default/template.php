<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this->setFrameMode(true);
global $$arParams["ADDITIONAL_PARAMS"];
global $unicumID;
$arExtParams = $$arParams["ADDITIONAL_PARAMS"];
if ($unicumID<=0) $unicumID = 1;
else $unicumID++;

$resize = '';
if ($arParams["AUTORESIZE_CART"] == "Y") $resize = 'data-resize="autoresize"';
//if ($USER->GetId() == 2) {
//echo "<pre>";
//print_r($arResult);
//print_r($arParams);
//echo "</pre>";
//}
?>

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
    $colToElem = array(1 => 12, 2 => 6, 3 => 4, 4 => 3, 6 => 2, 12 => 1);
    foreach ($arResult["ITEMS"] as $cell => $arItem):?>
    <?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	$strMainID = $this->GetEditAreaId($arItem['ID']);
    ?>
    <div id="<?=$strMainID?>" class="t_<?=$unicumID?> col-lg-<?=$arParams["LG_CNT"]?> col-md-<?=$arParams["MD_CNT"]?> col-sm-<?=$arParams["SM_CNT"]?> col-xs-<?=$arParams["XS_CNT"]?>"
         <?=$resize?>>

        <?
		$template = $arParams["LIST_VISUAL_STYLE"];

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
		$elementParams["CLASS_NAME"] = 'wow fadeIn';
		$elementParams["DISPLAY_PROPERTIES"] = $arItem["DISPLAY_PROPERTIES"];
		$elementParams["ACTIVE_FROM"] = $arItem["ACTIVE_FROM"];

		if (in_array('DATE_ACTIVE_FROM',$arParams["FIELD_CODE"])){
			$elementParams["ACTIVE_FROM"] = $arItem["ACTIVE_FROM"];
		}
		if (in_array('DATE_ACTIVE_TO',$arParams["FIELD_CODE"])){
			$elementParams["ACTIVE_TO"] = $arItem["DATE_ACTIVE_TO"];
		}

		if ('' != $arResult["PREVIEW_TEXT"])
			$elementParams["TEXT"] = $arResult['PREVIEW_TEXT'];



	if ($arParams["SHOW_ELEMENT_URL"] == "Y" && strlen($arParams["SHOW_ELEMENT_URL_TITLE"])>0){
		$elementParams["CARD_BUTTONS"][] = array(
			"LINK"=>$arItem["DETAIL_PAGE_URL"],
			"TITLE"=>$arParams["SHOW_ELEMENT_URL_TITLE"],
			"TYPE"=>'dark',
			"CLASS" => '',
		);
	}

	if (isset($arItem["PROPERTIES"]["LIST_BUTTONS"]) && $elementParams["SHOW_ELEMENT_BUTTONS"] == "Y"){


		foreach($arItem["PROPERTIES"]["LIST_BUTTONS"]["VALUE"] as $cell=>$val){
			$elementParams["CARD_BUTTONS"][] = array(
				"LINK"=>$val,
				"TITLE"=>$arItem["PROPERTIES"]["LIST_BUTTONS"]["DESCRIPTION"][$cell],
				"TYPE"=>'white-button',
				"CLASS" => '',
				"TARGET"=>'_blank_'
			);
		}
	}

	    $arElementDrawParams = array(
            "DISPLAY_VARIANT" => $template,
            "ELEMENT" => $elementParams,
            "LINK_ALL_BLOCK" => $arParams["LINK_ALL_BLOCK"],
        );

        

        if ($arParams["ADD_ELEMENT_CLASS"] == "Y" && $arItem["PROPERTIES"]["ADD_CLASS"]["VALUE"] != "")
            $arElementDrawParams["CLASS_NAME"] = $arItem["PROPERTIES"]["ADD_CLASS"]["VALUE"];

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

<? endforeach; ?>

<?
echo $arResult["NAV_STRING"];
?>

<?if ($arParams["SLIDER"] == "Y") {?>
</div>
    
<script>
$('#sl_<?=$unicumID?>').slick({
      dots: false,
      infinite: true,
      speed: 300,
      <?if ($arParams["VERTICAL_SLIDER_MODE"] == "Y") {?>
              vertical: true,
      <?}?>
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
      ],
      swipeToSlide: true
});
</script>
<?}?>

<?if ($arParams["AUTORESIZE_CART"] == "Y"):?>
	<script>
		$(window).load(function() {
			autoResize(".t_<?=$unicumID?>[data-resize=autoresize] .element-card", '<?=$template?>');
		})
	</script>
<?endif;?>