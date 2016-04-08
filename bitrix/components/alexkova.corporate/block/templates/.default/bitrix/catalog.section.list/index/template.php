<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);
global $unicumID;
if ($unicumID<=0) $unicumID = 1;
else $unicumID++;

$sectionLinc = array();
$arResult['ROOT'] = array();
$sectionLinc[0] = &$arResult['ROOT'];
foreach($arResult["SECTIONS"] as $cell=>$val) {
	$sectionLinc[intval($val['IBLOCK_SECTION_ID'])]['CHILD'][$val['ID']] = $val;
	$sectionLinc[$val['ID']] = &$val[intval($val['IBLOCK_SECTION_ID'])]['CHILD'][$val['ID']];
}
$resize = '';
if ($arParams["AUTORESIZE_CART"] == "Y") $resize = 'data-resize="autoresize"';




?>
<?if ($arParams["SLIDER"] == "Y") {?>
<div class="slider-carousel">
<?}?>
<?
    foreach ($arResult["ROOT"]["CHILD"] as $cell => $arSection):?>

        <div class="t_<?=$unicumID?> col-lg-<?=$arParams["LG_CNT"]?> col-md-<?=$arParams["MD_CNT"]?> col-sm-<?=$arParams["SM_CNT"]?> col-xs-<?=$arParams["XS_CNT"]?>"
         <?=$resize?>>
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
            <?
            $APPLICATION->IncludeComponent(
                    "alexkova.corporate:element.draw",
                    ".default",
                    $arElementDrawParams,
                    false,
                    array('HIDE_ICONS'=>"Y")
                    )
            ?>
        </div>

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

<script>
	$(window).load(function() {
		autoResize(".t_<?=$unicumID?>[data-resize=autoresize] .element-card", '<?=$template?>');
	})
</script>