<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//echo "<pre>";
//print_r($arResult);
//echo "</pre>";
$num_matches = preg_match("/glyphicon/", $arResult["ELEMENT"]["GLYPH"]['GLYPH_CLASS']);
if ($num_matches>0) { $glyph_class = 'glyphicon '.$arResult["ELEMENT"]["GLYPH"]['GLYPH_CLASS']; }
else { $glyph_class = $arResult["ELEMENT"]["GLYPH"]['GLYPH_CLASS']; }
?>

<div class="glyph-links">
        
        <div class="glyph-links-image">
            <span class='<?=$glyph_class?>'></span>
        </div>
        <div class="glyph-links-name">
            <a href="<?=$arResult["ELEMENT"]["LINK"]?>"><?=htmlspecialcharsBack($arResult["ELEMENT"]["NAME"])?></a>

            <?if (isset($arResult["ELEMENT"]['ACTIVE_FROM']) && strlen($arResult["ELEMENT"]['ACTIVE_FROM'])>0):?>
                <br>
                <div class="glyph-links-date">
                        <?=$arResult["ELEMENT"]['ACTIVE_FROM']?>
                        <? echo (isset($arResult["ELEMENT"]["ACTIVE_TO"]) && strlen($arResult["ELEMENT"]["ACTIVE_TO"])>0) ? ' - '.$arResult["ELEMENT"]["ACTIVE_TO"] : ''?>
                </div>
            <?endif;?>
        </div>
        
    
    
        
    <div class="clearfix"></div>
</div>