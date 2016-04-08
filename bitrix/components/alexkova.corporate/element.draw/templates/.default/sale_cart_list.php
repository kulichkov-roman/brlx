<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="sale-card-list col-lg-12 rounded <?=$arResult["ELEMENT"]["CLASS_NAME"]?>">
	<div class="container full-width">
		<div class="row">
			<div class="col-lg-3 col-lg-3 col-sm-4 col-xs-4 card-image">

				<?if (isset($arResult["ELEMENT"]["MARKERS"]) && count($arResult["ELEMENT"]["MARKERS"])>0):?>
					<div class="emarket-average-label-area">
						<?foreach($arResult["ELEMENT"]["MARKERS"] as $val):?>
							<div class="emarket-label <?=$val?>"></div>
						<?endforeach;?>
					</div>
					<div class="clearfix"></div>
				<?endif;?>

				<a href="<?=$arResult["ELEMENT"]["LINK"]?>">
					<img src="<?=$arResult["ELEMENT"]["IMAGE"]?>">
				</a>



			</div>
			<div class="col-lg-9 col-md-7 col-sm-8 col-xs-8">

				<div class="card-text">
					<a href="<?=$arResult["ELEMENT"]["LINK"]?>" class="card-title">
						<?=$arResult["ELEMENT"]["NAME"]?>
					</a>
					<div class="card-preview-text">
						<?=$arResult["ELEMENT"]["TEXT"]?>
					</div>
				</div>


				<div class="sale-card-price-line">
					<div class="sale-card-price emarket-format-price">
						<?=$arResult["ELEMENT"]["PRICE"]?>
					</div>
					<?if (strlen($arResult["ELEMENT"]["OLD_PRICE"])>0):?>
						<div class="sale-card-old-price emarket-format-price">
							<?=$arResult["ELEMENT"]["OLD_PRICE"]?>
						</div>
					<?endif;?>
					<div class="clearfix"></div>
				</div>

				<div class="card-operation">
					<?foreach($arResult["ELEMENT"]["OPERATION"] as $operation):?>
						<a href="<?=$operation["LINK"]?>" class="<?=$operation["CLASS"]?>">
							<?=$operation["TITLE"]?>
						</a>
					<?endforeach?><div class="clearfix"></div>
				</div>


			</div>
		</div>
	</div>
</div>