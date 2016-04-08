<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (count($arResult["ITEMS"])>0):?>

<div class="panel-group col-lg-12" id="accordion" role="tablist" aria-multiselectable="true">

<? foreach ($arResult["ITEMS"] as $cell => $arItem):?>

    <div class="panel panel-default">
        
        <div class="panel-heading" role="tab" id="heading<?=$arItem['ID']?>">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$arItem['ID']?>" aria-expanded="false" aria-controls="collapse<?=$arItem['ID']?>">
                    <?=$arItem["NAME"]?>
                </a>
            </h4>
        </div>
        
        <div id="collapse<?=$arItem['ID']?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$arItem['ID']?>">
            <div class="panel-body">
                <?=$arItem["DETAIL_TEXT"]?>
            </div>
        </div>
        
    </div>

<? endforeach; ?>

</div>

<?endif;?>
   
