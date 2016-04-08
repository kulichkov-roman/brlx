<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//echo "<pre>";print_r($arResult);echo "</pre>";
?>

<?
$imgString = '';
if ($arResult["ELEMENT"]['TYPE_IMG']=='glyph'){
	if (strlen($arResult["ELEMENT"]["GLYPH"]['GLYPH_CLASS'])){
            $num_matches = preg_match("/glyphicon/", $arResult["ELEMENT"]["GLYPH"]['GLYPH_CLASS']);
            if($num_matches>0) 
            {
		$imgString = '<span class="glyphicon ';
		$imgString.= $arResult["ELEMENT"]["GLYPH"]['GLYPH_CLASS'].'" ';
		$imgString.= 'style="font-size:'.($arResult["ELEMENT"]['IMAGE_MAX_WIDTH']).'px;"></span>';
            } 
            else 
            {
                $imgString = '<span class="';
		$imgString.= $arResult["ELEMENT"]["GLYPH"]['GLYPH_CLASS'].'" ';
		$imgString.= 'style="font-size:'.($arResult["ELEMENT"]['IMAGE_MAX_WIDTH']).'px;"></span>';
            }  
        }
}else{
	if (strlen($arResult["ELEMENT"]["IMAGE"])){
		$imgString = '<img src="'.$arResult["ELEMENT"]["IMAGE"].'" ';
		$imgString.= 'alt="'.$arResult["ELEMENT"]["NAME"].'" ';
		$imgString.= 'style="width:'.$arResult["ELEMENT"]['IMAGE_MAX_WIDTH'].'px;">';
	}
}

?>

    
<div class="element-card modern-card-vertical rounded <?=$arResult["ELEMENT"]['TYPE_CARD']?> <?echo ($arResult["ELEMENT"]['TYPE_IMG']=='image') ? $arResult["ELEMENT"]['IMAGE_COLOR'] : ''?> <?=$arResult["ELEMENT"]['BORDER_COLOR']?> <?=$arResult["ELEMENT"]["CLASS_NAME"]?> <?=$arResult["ELEMENT"]["CARD_ALIGN"]?> <?=$arResult["ELEMENT"]["GLYPH"]['GLYPH_TYPE']?> <? echo ($arResult["ELEMENT"]['CARD_BORDER']=='N') ? 'no-border' : '' ?> <?=$arResult["ELEMENT"]['BUTTON']['BUTTON_TYPE']?>">
    
    <? if ($arResult["ELEMENT"]["HIDE_LINKS"]=='N') {?>
        <a href="<?=$arResult["ELEMENT"]["LINK"]?>" class='<?echo ($arResult["ELEMENT"]["FANCYBOX_TYPE"]=='Y') ? 'card-element' : '' ?>'>
    <? } ?>
            
        <? if ($arResult["ELEMENT"]['TYPE_IMG']=='glyph' && $arResult["ELEMENT"]['GLYPH']['GLYPH_CLASS'] || $arResult["ELEMENT"]['TYPE_IMG']=='image') {?>
            <div class="modern-card-image <?=$arResult["ELEMENT"]['IMAGE_BORDER']?>" style='height:<?=$arResult["ELEMENT"]['IMAGE_SIZE_HEIGHT']?>px; line-height:<?=$arResult["ELEMENT"]['IMAGE_SIZE_HEIGHT']?>px; width:<?=$arResult["ELEMENT"]['IMAGE_SIZE_HEIGHT']?>px;'>
                <?=$imgString?>
            </div>
        <? } ?>
            
        <div class="modern-card-name">
            <span><?=$arResult["ELEMENT"]["NAME"]?></span>
        </div>
            
    <? if ($arResult["ELEMENT"]["HIDE_LINKS"]=='N') {?>
        </a>
    <? } ?>
    
        <? if ($arResult["ELEMENT"]['SHOW_DESCRIPTION']!=='N') {?>
            <div class="modern-card-text">
                <span><?=htmlspecialchars_decode($arResult["ELEMENT"]["TEXT"])?></span>
            </div>
        <? } ?>
    
        <div class="clearfix"></div>

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
				<a href="#" class="color-button small-button"><?=$arResult["ELEMENT"]["SALE_TITLE"]?></a>
			</div>
		</div>
	<?endif;?>  
                
        <?if (($arResult["ELEMENT"]['SHOW_ELEMENT_URL']=='Y' && strlen($arResult["ELEMENT"]["SHOW_ELEMENT_URL_TITLE"])>0) || ($arResult["ELEMENT"]['SHOW_ELEMENT_BUTTONS']=='Y' && count($arResult["ELEMENT"]['CARD_BUTTONS'])>0)):?> 
            <div class="modern-card-operation">
                <div class="modern-card-buttons">
                    <?if ($arResult["ELEMENT"]['SHOW_ELEMENT_URL']=='Y' && strlen($arResult["ELEMENT"]["SHOW_ELEMENT_URL_TITLE"])>0):?>
                        <a href="<?=$arResult["ELEMENT"]["LINK"]?>" class="color-button small-button <?=$arResult["ELEMENT"]["URL_TITLE_COLOR"]?>" <? echo ($arResult["ELEMENT"]['SHOW_ELEMENT_BUTTONS']=='Y' && $arResult["ELEMENT"]["CARD_BUTTONS_WIDTH"]>0) ? 'style="width:'.$arResult["ELEMENT"]["CARD_BUTTONS_WIDTH"].';"' : ''; ?>><?=$arResult["ELEMENT"]["SHOW_ELEMENT_URL_TITLE"]?></a>
                        <div class="clearfix"></div>
                    <?endif;?>
                    <?if ($arResult["ELEMENT"]['SHOW_ELEMENT_BUTTONS']=='Y' && count($arResult["ELEMENT"]['CARD_BUTTONS'])>0):?>
                        <?foreach ($arResult["ELEMENT"]['CARD_BUTTONS'] as $key => $value) {?>
                            <?if (isset($value["TITLE"]) && strlen($value["TITLE"])>0):?>
                                <a href="<?echo ($value["LINK"]) ? $value["LINK"] : '#'?>" class="color-button small-button <?=$arResult["ELEMENT"]["CARD_BUTTONS_CLASS"]?> <?=$arResult["ELEMENT"]["CARD_BUTTONS_TYPE"]?>" <? echo ($arResult["ELEMENT"]["CARD_BUTTONS_WIDTH"]>0) ? 'style="width:'.$arResult["ELEMENT"]["CARD_BUTTONS_WIDTH"].';"' : ''; ?> <? echo (isset($arResult["ELEMENT"]["CARD_BUTTONS_TYPE"]) && strlen($arResult["ELEMENT"]["CARD_BUTTONS_TYPE"])>0) ? 'target='.'"'.$arResult["ELEMENT"]["CARD_BUTTONS_TARGET"].'"' : '' ?>><?=$value["TITLE"]?></a>
                                <div class="clearfix"></div>
                            <?endif;?>
                        <?}?>
                    <?endif;?>
                </div>
            </div>
        <?endif;?>
                
	<div class="clearfix"></div>
</div>