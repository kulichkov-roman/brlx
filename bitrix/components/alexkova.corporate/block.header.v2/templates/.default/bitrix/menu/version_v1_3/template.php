<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>

<?if (!empty($arResult)):?>
<?$compound = $arParams["COMPOUND"] == "Y"? " compound pull-right":""?>
<ul class="flex-menu top-menu-v2  hidden-sm hidden-xs <?=$compound?>">

<?
$previousLevel = 0;
	$flagFirst = true;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?$addFirst = "";
		$addClass=array();
	if ($flagFirst){
		$addClass[] = 'first';
		$flagFirst = false;
	}
	if ($arItem["SELECTED"]){
		$addClass[] = 'selected';
	}
	if (count($addClass)>0){
		$addFirst = ' class="'.implode(" ",$addClass).'"';
	}
	?>
    
        <?  
            $glyphicon = "";        
            if($arItem["DEPTH_LEVEL"]==1)
                 $glyphicon = '<span class="glyphicon glyphicon-chevron-down"></span>';   
        ?>

	<li<?=$addFirst?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?><?=$glyphicon?></a>

	<?if (!$arItem["IS_PARENT"]):?>
		</li>
	<?else:?>
		<ul>
	<?endif;?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

	<li class="other" id="flex-menu-li">&nbsp;</li>
        <li class="last li-visible" ><a href="#"><span class="glyphicon glyphicon-search"></span></a></li>
			<div class="clearfix"></div>
</ul>
                

<?endif?>

