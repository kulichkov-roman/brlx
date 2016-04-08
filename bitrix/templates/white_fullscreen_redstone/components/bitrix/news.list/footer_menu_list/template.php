<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);
$indicator = true;
?>
<div class='col-lg-3 col-md-3 col-sm-12 col-xs-12 footer-links'>
    <?foreach($arResult["ITEMS"] as $cell=>$arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
    
            <?if ($indicator && $cell > count($arResult["ITEMS"])/2) :?>
                <?$indicator = false;?>
    
</div><div class='col-lg-3 col-md-3 col-sm-12 col-xs-12 footer-links'>
    
            <?  endif;?>
    
            <small id="<?=$this->GetEditAreaId($arItem['ID']);?>">

				<a href="<?echo $arItem["PROPERTIES"]["LINK_URL"]["VALUE"]?>"><?echo $arItem["NAME"]?></a>
				<br />
			</small>
    <?endforeach;?>

</div>
