<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$this->setFrameMode(true);
?>
<?if(count($arResult["ITEMS"]) == 0)return false;?>
<div style="clear:both;"></div>
<ul class="rklite-banners-v">
<?foreach($arResult["ITEMS"] as $cell=>$strBanner):?>
	<li>
		<?=$strBanner;?>
	</li>
<?endforeach;?>
</ul>