<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $unicumID;
if ($unicumID<=0) $unicumID = 1;
else $unicumID++;

$resize = '';
if ($arParams["AUTORESIZE_CART"] == "Y") $resize = 'data-resize="autoresize"';
?>
<?if ($arParams["SLIDER"] == "Y") {?>
<div class="slider-carousel">
<?}?>
<?
foreach ($arResult["SECTIONS"] as $cell => $arSection):?>
?>
    <div class="t_<?=$unicumID?> col-lg-<?=$arParams["LG_CNT"]?> col-md-<?=$arParams["MD_CNT"]?> col-sm-<?=$arParams["SM_CNT"]?> col-xs-<?=$arParams["XS_CNT"]?>"
         <?=$resize?>>

     <?$template = ($arParams["CUSTOM_STYLE"] == "Y" && $arSection["PROPERTIES"]["CUSTOM_STYLE"]["VALUE_XML_ID"] != "") ? $arSection["PROPERTIES"]["CUSTOM_STYLE"]["VALUE_XML_ID"] : $arParams["VISUAL_STYLE"];
        $arElementDrawParams = array(
            "DISPLAY_VARIANT" => $template,
            "ELEMENT" => array(
                "NAME" => $arSection["NAME"],
                "IMAGE" => $arSection["PICTURE"]["SRC"],
                "TEXT" => $arSection["DESCRIPTION"],
                "LINK" => $arSection["SECTION_PAGE_URL"]
            ),
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