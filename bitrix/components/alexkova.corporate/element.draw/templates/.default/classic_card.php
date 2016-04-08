<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//echo "<pre>";
//print_r($arParams);
//echo "</pre>";
?>


    <?if (isset($arResult["ELEMENT"]["START_DATE"]) && strlen($arResult["ELEMENT"]["START_DATE"])>0):?>
        <div class="classic-card-date">
                <?=$arResult["ELEMENT"]["START_DATE"]?>
                <? echo (isset($arResult["ELEMENT"]["FINISH_DATE"]) && strlen($arResult["ELEMENT"]["FINISH_DATE"])>0) ? ' - '.$arResult["ELEMENT"]["FINISH_DATE"] : ''?>
        </div>
    <?endif;?>

<div class="element-card classic-card rounded <?=$arResult["ELEMENT"]['TYPE_CARD']?> <?echo ($arResult["ELEMENT"]['LINE']=='Y') ? 'card-name-line' : ''?> <? echo ($arResult["ELEMENT"]['CARD_BORDER']=='N') ? 'no-border' : '' ?>">
    
    
    <div class="classic-card-name">
        <a href="<?=$arResult["ELEMENT"]["LINK"]?>">
            <?=$arResult["ELEMENT"]["NAME"]?>
        </a>
    </div>
    <div class="classic-card-text">
        <?=htmlspecialchars_decode($arResult["ELEMENT"]["TEXT"])?>
    </div>
    <div class="classic-card-link">
        <?if (isset($arResult["ELEMENT"]["LINK_TITLE"]) && strlen($arResult["ELEMENT"]["LINK_TITLE"])>0):?>
            <a href="<?=$arResult["ELEMENT"]["LINK"]?>"><?=html_entity_decode(html_entity_decode($arResult["ELEMENT"]["LINK_TITLE"]))?></a>
        <?endif;?>
    </div>
    <div class="clearfix"></div>
</div>
