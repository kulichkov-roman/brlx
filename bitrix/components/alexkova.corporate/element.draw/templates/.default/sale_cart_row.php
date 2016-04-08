<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<tr id="<?=$arResult["ELEMENT"]["HTML_ID"]?>" class="<?=$arResult["ELEMENT"]["CLASS_NAME"]?>">
	<td class="ico hidden-sm hidden-xs">
		<a href="<?=$arResult["ELEMENT"]["LINK"]?>">
			<img src="<?=$arResult["ELEMENT"]["IMAGE"]?>" alt="<?=$arResult["ELEMENT"]["NAME"]?>">
		</a>
	</td>

	<td class="details">
		<a href="<?=$arResult["ELEMENT"]["LINK"]?>">
			<div class="sale-card-list-name">
				<span><?=$arResult["ELEMENT"]["NAME"]?></span>
				<?if (isset($arResult["ELEMENT"]["MARKERS"]) && count($arResult["ELEMENT"]["MARKERS"])>0):?>
					<div class="emarket-little-label-area hidden-sm hidden-xs">
						<?foreach($arResult["ELEMENT"]["MARKERS"] as $val):?>
							<div class="emarket-label <?=$val?>"></div>
						<?endforeach;?>
					</div>
				<?endif;?>
			</div>
		</a>
	</td>

	<td class="price">

		<div class="sale-card-price-line">
			<div class="sale-card-price emarket-format-price">
				<?=$arResult["ELEMENT"]["PRICE"]?>
			</div>
			<?if (strlen($arResult["ELEMENT"]["OLD_PRICE"])>0):?>
				<div class="sale-card-old-price emarket-format-price">
					<?=$arResult["ELEMENT"]["OLD_PRICE"]?>
				</div>
			<?endif;?>
		</div>

	</td>


	<td class="operation">
		<div class="card-operation">
			<?foreach($arResult["ELEMENT"]["OPERATION"] as $operation):?>
				<a href="<?=$operation["LINK"]?>" class="<?=$operation["CLASS"]?>">
					<?=$operation["TITLE"]?>
				</a>
			<?endforeach?><div class="clearfix"></div>
		</div>
	</td>

</tr>