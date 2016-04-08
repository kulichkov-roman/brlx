<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->createFrame()->begin('...');
?>
<?if (count($arResult)<=0) return;?>
<?if (count($arResult)>0):?>
<div class="v-slick-conteiner v-big_button <? if($arParams['SLIDER_NAVIGATION_BUTTONS']=="Y") {echo "hover_button";} ?>" style="position: relative">
<?foreach ($arResult["ITEMS"] as $key => $item):?>
                <?
                    $target = "";
                    ($item["PROPERTIES"]["NEW_TAB"]["VALUE"] == "Y") ? $target = "target='_blank'" : $target = "target='_self'";
                
                    if ($item["PROPERTIES"]["LOCATION"]["VALUE"] != ""):
                        $locationParts = explode(";", $item["PROPERTIES"]["LOCATION"]["VALUE"]);
                        $location = $locationParts[0];
                    else:
                        $location = "left";
                    endif;
                ?>
                
                <div class="container full-width <?=$location;?>" style="background: url('<?=$item["DETAIL_PICTURE"]["SRC"]?>');"
                    alt="<?=$item["NAME"]?>" title="<?=$item["NAME"]?>"><div class="row">
                    <?
                        $link = "/";
                        if(isset($item["PROPERTIES"]["LINK"]["VALUE"][0]))
                            $link = $item["PROPERTIES"]["LINK"]["VALUE"][0];
                    ?> 
                    <?if ($item["PROPERTIES"]["SLIDER_LINK"]["VALUE"] == "Y"):?>
                        <a <?=$target;?> href="<?=$link;?>">
                    <?endif;?>
                    <div class="container"><div class="row">
                        <div class="col-md-6 hidden-xs hidden-sm pull-<?=$location?>">
                            <?if(isset($item["PREVIEW_PICTURE"]["SRC"])):?>
                                <img class="img-responsive" src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>"  alt="<?=$item["NAME"]?>"  data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                            <?endif;?>
                        </div>
                        <?                       
                            if ($item["PROPERTIES"]["TITLE_COLOR"]["VALUE"] != "")
                                $title_color = "#" . $item["PROPERTIES"]["TITLE_COLOR"]["VALUE"];
                            else
                               $title_color = "fff";
                            
                            if ($item["PROPERTIES"]["TEXT_COLOR"]["VALUE"] != "")
                                $text_color = "#" . $item["PROPERTIES"]["TEXT_COLOR"]["VALUE"];
                            else
                               $text_color = "fff";
                        ?>
                        <div class="col-md-5 nopadding col-sm-8 slick-banner-content">
                            <h1 style="color: <?=$title_color?>" ><?=$item["NAME"]?></h1>
                            <?if ($item["PROPERTIES"]["SHOW_PREVIEW_TEXT"]["VALUE"] == "Y"):?>
                                <p style="color: <?=$text_color?>"><?=$item["PREVIEW_TEXT"]?></p>
                            <? endif;?>
                                <div class="slick-buttons">
                                <?foreach ($item["PROPERTIES"]["LINK"]["VALUE"] as $k => $link):?>
                                    <div class="modern-card-buttons">
                                        <?if ($item["PROPERTIES"]["SLIDER_LINK"]["VALUE"] != "Y"):?>
                                            <a href="<?=$link;?>" class="button-heder2-slider "><?=$item["PROPERTIES"]["LINK"]["DESCRIPTION"][$k];?></a>
                                        <?else:?>
                                            <span class="button-heder2-slider"><?=$item["PROPERTIES"]["LINK"]["DESCRIPTION"][$k];?></span>
                                        <? endif;?>
                                    </div>
                                <?endforeach;?>
                            </div>
                        </div>
                    </div></div>
                    <?if ($item["PROPERTIES"]["SLIDER_LINK"]["VALUE"] == "Y"):?>
                        </a>
                    <?endif;?>
                </div></div>

        <?endforeach;?>
</div>
<?endif;?>
<script>
	window.SlickSliderTop = {
            init: function(){

                $('.v-slick-conteiner').slick({
                    slidesToShow: 1,
                    dots: true,
                    <?
                        $fade = "false";
                        if($arParams['SLIDER_FADE']=="Y")
                            $fade = "true";
                    ?>
                    fade: <?=$fade;?>,
                    <? 
                        $speed = 1500;
                        if(isset($arParams['SLIDER_SPEED']) && is_numeric($arParams['SLIDER_SPEED']))
                            $speed = $arParams['SLIDER_SPEED'];
                    ?>
                    speed: <?=$speed;?>,
                    <? 
                        $autoplaySpeed = 3000;
                        if(isset($arParams['SLIDER_AUTOPLAY_SPEED']) && is_numeric($arParams['SLIDER_AUTOPLAY_SPEED']))
                            $autoplaySpeed = $arParams['SLIDER_AUTOPLAY_SPEED'];
                    ?>
                    autoplaySpeed: <?=$autoplaySpeed;?>,
                    <?
                       $autoplay = "false";
                       if($arParams['SLIDER_AUTOPLAY']=="Y")
                            $autoplay = "true";
                    ?>
                    autoplay: <?=$autoplay;?>,

                });

                $('.v-slick-conteiner').css("visibility", "visible");
                //$('.v-slick-conteiner .slick-prev, .v-slick-conteiner .slick-next').addClass("colored_0").addClass("colored_hover_0").addClass("coloredf_f");
            }
	}

	$(document).ready(function(){
            SlickSliderTop.init();
	});
</script>



