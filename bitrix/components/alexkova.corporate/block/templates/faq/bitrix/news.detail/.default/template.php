<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//echo "<pre>";print_r($arResult["DISPLAY_PROPERTIES"]);echo "</pre>";
$excludeProps = array('PRICE', 'OLD_PRICE');
?>

<div class="element-detail">

	<div class="container full-width">
		<div class="row">
	<?if (count($arResult["IMAGES"])>0):?>

				<div class="col-lg-7 col-md-12">
					<div class="ax-element-slider">
						<div class="ax-element-slider-main">
                                                <!--<div class="slider slider-for">-->
							<?foreach ($arResult["IMAGES"] as $key => $val):?>
								<a href="<?=$val["SRC"]?>" class="fancybox">
									<img src="<?=$val["TMB"]["SRC"]?>">
								</a>
							<?endforeach;?>
						</div>
						<?if (count($arResult["IMAGES"])>1):?>
							<div class="ax-element-slider-nav">
                                                        <!--<div class="slider slider-nav">-->
								<?foreach ($arResult["IMAGES"] as $key => $val):?>
									<div>
                                                                            <div class="slide-wrap">
										<img src="<?=$val["TMB"]["SRC"]?>">
                                                                            </div>
									</div>
								<?endforeach;?>
							</div>
						<?endif;?>
					</div>
				</div>

	<?endif;?>
				<div class="col-lg-5 col-md-12">
					<table class="params-list">
						<?$gray = 'dark-gray';?>
						<?foreach($arResult["DISPLAY_PROPERTIES"] as $cell=>$val):?>
							<?if (!in_array($cell, $excludeProps)):?>
								<?if ($cell == "DETAIL_LIST"):?>
									<?foreach($val["VALUE"] as $cell=>$valItem):?>
										<tr class="<?=$gray?>">
											<td class="left"><?=$val["DESCRIPTION"][$cell]?></td>
											<td><?=$valItem?></td>
										</tr>
										<?$gray = $gray == 'light-gray' ? 'dark-gray' : 'light-gray'?>
									<?endforeach;?>
								<?else:?>
									<tr class="<?=$gray?>">
										<td class="left"><?=$val["NAME"]?></td>
										<td><?=$val["VALUE"]?></td>
									</tr>
									<?$gray = $gray == 'light-gray' ? 'dark-gray' : 'light-gray'?>
								<?endif;?>
							<?endif;?>
						<?endforeach;?>
					</table>
				</div>
			</div>
		</div><div class="clearfix"></div>

	<hr />

</div>

<ul class="nav nav-tabs" role="tablist" id="details">

	<li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab"><?=GetMessage("DETAIL_TEXT_DESC")?></a></li>

	<?if (count($arResult["VIDEO"])>0):?>
		<li role="presentation"><a href="#video" aria-controls="video" role="tab" data-toggle="tab"><?=GetMessage("VIDEO_TAB_DESC")?></a></li>
	<?endif;?>
	<?if (count($arResult["FILES"])>0):?>
		<li role="presentation" ><a href="#files" aria-controls="files" role="tab" data-toggle="tab"><?=GetMessage("CATALOG_FILES")?></a></li>
	<?endif;?>
</ul>

<div class="tab-content">
	<div role="tabpanel" class="tab-pane fade in active" id="description">
		<hr /><?echo $arResult["DETAIL_TEXT"];?>
	</div>

	<?if (count($arResult["FILES"])>0):?>
		<div id="files" class="element-files tb20 tab-pane fade" role="tabpanel">
			<hr />
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

		</div><div class="clearfix"></div>
	<?endif;?>

	<?if (count($arResult["VIDEO"])>0):?>
		<div id="video" class="element-files tb20 tab-pane fade" role="tabpanel">
			<hr />
			<?foreach ($arResult["VIDEO"] as $val):?>

				<?$template = "video_card";
				$arElementDrawParams = array(
					"DISPLAY_VARIANT" => $template,
					"ELEMENT" => array(
						"VIDEO" => $val["LINK"],                  //ссылка на видео
						"VIDEO_IMG" => '',               //ссылка на картинку
						"VIDEO_IMG_WIDTH" => '200',         //ширина картинки для видео
						"NAME" => $val["TITLE"]
					)
				);




				?>
				<div class="col-lg-3">
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

			<?endforeach;?>

		</div><div class="clearfix"></div>
	<?endif;?>



</div>

<script>
	$(function () {
		$('#details a').click(function (e) {
			e.preventDefault();
			$(this).tab('show')
		})
	})
</script>


<script>
$("a.fancybox").fancybox();

$('.ax-element-slider-main').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    speed: 500,
    arrows: true,
    fade: true,
    dots: false,
    infinite: true,
    asNavFor: '.ax-element-slider-nav'
});
$('.ax-element-slider-nav').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    speed: 500,
    asNavFor: '.ax-element-slider-main',
    arrows: true,
    dots: true,
    infinite: true,
    centerMode: false,
    focusOnSelect: true,
    slide: 'div'
});

$('.ax-element-slider-nav').on('afterChange', function(event, slick, currentSlide, nextSlide){
//  console.log(nextSlide, slick, event, this);
  $($('.ax-element-slider-nav .slick-track').children('.slick-slide')).css("border", "2px solid #CCC");
  $($($('.ax-element-slider-nav .slick-track').children('.slick-active'))[0]).css("border", "2px solid #000");
});

$(document).ready(function() {
    $($($('.ax-element-slider-nav .slick-track').children('.slick-active'))[0]).css("border", "2px solid #000");
    $(".ax-element-slider-nav").children(".slick-prev").css("display", "none");
    $(".ax-element-slider-nav").children(".slick-next").css("display", "none");
    $(".ax-element-slider-main").children(".slick-prev").css("display", "none");
    $(".ax-element-slider-main").children(".slick-next").css("display", "none");
    setSlideSizes();
});

$(document).on("mouseover", ".ax-element-slider-nav", function() {
    hideArrows(this, "block");
});

$(document).on("mouseover", ".ax-element-slider-main", function() {
    hideArrows(this, "block");
});

$(document).on("mouseout", ".ax-element-slider-nav", function() {
    hideArrows(this, "none");
});

$(document).on("mouseout", ".ax-element-slider-main", function() {
    hideArrows(this, "none");
});

$(window).resize(function() {
    setSlideSizes();
});

function hideArrows(elem, display) {
    $(elem).children(".slick-prev").css("display", display);
    $(elem).children(".slick-next").css("display", display);
}

function setSlideSizes() {
    border = 4;
    width = $('.ax-element-slider-nav .slick-list .slick-track .slick-slide').width();
    height = width + border;
    imgSize = width - 10;
    $('.ax-element-slider-nav .slick-list .slick-track .slick-slide').height(height);
    $('.ax-element-slider-nav .slick-list .slick-track .slick-slide .slide-wrap').css({'width': height, 'height': height})
//    $('.ax-element-slider-nav .slick-list .slick-track .slick-slide .slide-wrap img').css({'max-width': imgSize, 'max-height': imgSize})
}
</script>
