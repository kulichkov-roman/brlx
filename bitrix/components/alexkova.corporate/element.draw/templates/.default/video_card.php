<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (strlen($arResult["ELEMENT"]["VIDEO_IMG"])<=0){
	$arResult["ELEMENT"]["VIDEO_IMG"] = SITE_TEMPLATE_PATH."/images/video.png";
}
?>

<div class="video-card">
    <div class="video-card-link">
        <a href="<?=$arResult["ELEMENT"]["VIDEO"]?>" class="fancyvideo">
            <img src='<?=$arResult["ELEMENT"]["VIDEO_IMG"]?>' width="<?=$arResult["ELEMENT"]["VIDEO_IMG_WIDTH"]?>" class='video-img'>
    </div>
    <div class="video-card-name">
        <?=$arResult["ELEMENT"]["NAME"]?>
    </div>
        </a>
    <div class="clearfix"></div>
</div>


