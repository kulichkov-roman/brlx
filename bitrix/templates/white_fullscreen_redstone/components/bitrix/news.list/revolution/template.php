<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->createFrame()->begin('...');
?>

<?if (count($arResult)<=0) return;?>

<?if (count($arResult)>0):?>


<div class="col-lg-12 xs-hide">
	<div class="tp-banner-container" style="position: relative">
		<div class="tp-banner" >
			<ul>	<!-- SLIDE  -->
					<?foreach ($arResult["ITEMS"] as $key => $item):?>
						<?if ($item["PROPERTIES"]["EFFECT"]["VALUE"] != ""):
							$effectParts = explode(";", $item["PROPERTIES"]["EFFECT"]["VALUE"]);
							$effect = $effectParts[0];
						  else:
							$effect = "slidehorizontal";
						  endif;?>
						<?if ($item["PROPERTIES"]["MASTERSPEED"]["VALUE"] != ""):
							$masterspeed = $item["PROPERTIES"]["MASTERSPEED"]["VALUE"];
						  else:
							$masterspeed = 500;
						  endif;?>
						<?$delay = $item["PROPERTIES"]["DELAY"]["VALUE"] * 1000;?>
						<li class="slide"
							data-transition="<?=$effect?>"
							data-slotamount="7"
							data-masterspeed="<?=$masterspeed?>"
							<?if ($item["PROPERTIES"]["NEW_TAB"]["VALUE"] == "Y"):?>data-target="_blank" <?endif;?>
							<?if ($item["PROPERTIES"]["LINK"]["VALUE"] != ""):?>data-link="<?=$item["PROPERTIES"]["LINK"]["VALUE"]?>" <?endif;?>
							<?if ($item["PROPERTIES"]["DELAY"]["VALUE"] != ""):?> data-delay="<?=$delay?>" <?endif;?> alt="<?=$item["NAME"]?>" title="<?=$item["NAME"]?>">
									<img src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>"  alt="<?=$item["NAME"]?>"  data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
							<? if ($item["PREVIEW_TEXT"] != "" || $item["PROPERTIES"]["CAPTION_LINKS"]["VALUE"] != ""): ?>
									<? if ($item["PROPERTIES"]["LINKS_EFFECT"]["VALUE"] != ""):
										$linksEffectParts = explode(";", $item["PROPERTIES"]["LINKS_EFFECT"]["VALUE"]);
										$linksEffect = $linksEffectParts[0];
									else:
										$effect = "stl";
									endif;?>
									<? if ($USER->GetId() == 717):?>
									<div class="caption <?=$linksEffect?> big_white"  data-x="400" data-y="100" data-speed="700" data-start="1700" data-easing="easeOutBack">

									</div>
									<? endif;?>
							<? endif;?>
						</li>
					<?endforeach;?>
	</ul>
			<div class="tp-bannertimer"></div>
		</div>
	</div>
</div>
<?endif;?>

<script>
	window.MainSlider = {

		startWidth: 0,
		initRevApi: false,

		init: function(){

			var revapi = jQuery('.tp-banner').revolution(
				{
					delay:9000,
					/*startwidth:'100%',*/
					startheight:366,
					autoHeight:"off",
					fullScreenAlignForce:"on",
					onHoverStop:"off",
					lazyLoad: "on",
					hideThumbs: 0

				});
		}
	}

	$(document).ready(function(){
		MainSlider.initRevApi = true;
		MainSlider.init();
	});
</script>

