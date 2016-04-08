<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//echo "<pre>";print_r($arParams);echo "</pre>";
?>

<div class="element-card classic-image-card <?=$arResult["ELEMENT"]['SHOW_NAME']?> rounded <? echo ($arResult["ELEMENT"]['CARD_BORDER']=='N') ? 'no-border' : '' ?> <? echo ($arResult["ELEMENT"]['SHOW_NAME']=='show-name-part' && $arResult["ELEMENT"]['ACTION_TYPE']=='Y') ? 'action' : ''?>"
 <? if (isset($arResult["ELEMENT"]["SIZE_RATIO"]) && strlen($arResult["ELEMENT"]["SIZE_RATIO"])>0) {?> data-ratio="<?=$arResult["ELEMENT"]["SIZE_RATIO"]?>" <?}?>>
    
        <div class="classic-image-image">
            <a href="<?echo ($arResult["ELEMENT"]["FANCYBOX_TYPE"]=='Y') ? $arResult["ELEMENT"]["IMAGE"] : $arResult["ELEMENT"]["LINK"]?>" <?echo ($arResult["ELEMENT"]["FANCYBOX_TYPE"]=='Y') ? 'class="card-element"' : '' ?>>
                <img src="<?=$arResult["ELEMENT"]["IMAGE"]?>" alt="<?=$arResult["ELEMENT"]["NAME"]?>" class="img-responsive">
            </a>
        </div>
        <div class="classic-image-name">
            <a href="<?echo ($arResult["ELEMENT"]["FANCYBOX_TYPE"]=='Y') ? $arResult["ELEMENT"]["IMAGE"] : $arResult["ELEMENT"]["LINK"]?>" <?echo ($arResult["ELEMENT"]["FANCYBOX_TYPE"]=='Y') ? 'class="card-element"' : '' ?>>
                <?=$arResult["ELEMENT"]["NAME"]?>
            </a>
        </div>
    
    <div class="clearfix"></div>
</div>

<?// echo (isset($arResult["ELEMENT"]['SIZE_RATIO']) && strlen($arResult["ELEMENT"]["SIZE_RATIO"])>0) ? 'style="height: ;line-height: ;width: ;"' : '' ?>

