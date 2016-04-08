<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?print_r($arResult["ELEMENT"]["SALE_TITLE"])?>
<div class="element-card sale-card rounded <?=$arResult["ELEMENT"]["CLASS_NAME"]?>">
	<a href="<?=$arResult["ELEMENT"]["LINK"]?>">
		<div class="sale-card-image">
			<img src="<?=$arResult["ELEMENT"]["IMAGE"]?>" alt="<?=$arResult["ELEMENT"]["NAME"]?>">
		</div>
		<div class="sale-card-name">
			<span><?=$arResult["ELEMENT"]["NAME"]?></span>
		</div>
		<div class="clearfix"></div>
	</a>

	<?if (isset($arResult["ELEMENT"]["MARKERS"]) && count($arResult["ELEMENT"]["MARKERS"])>0):?>
		<div class="emarket-average-label-area">
			<?foreach($arResult["ELEMENT"]["MARKERS"] as $val):?>
				<div class="emarket-label <?=$val?>"></div>
			<?endforeach;?>
		</div>
		<div class="clearfix"></div>
	<?endif;?>

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

	<?if (isset($arResult["ELEMENT"]["SALE_TITLE"]) && strlen($arResult["ELEMENT"]["SALE_TITLE"])>0):?>
		<div class="sale-card-operation">
			<div class="emarket-sale-buttons">
				<a href="<?=$arResult["ELEMENT"]["LINK"]?>" class="color-button small-button"><?=$arResult["ELEMENT"]["SALE_TITLE"]?></a>
			</div>
		</div>

	<?endif;?>
	<div class="clearfix"></div>
</div>