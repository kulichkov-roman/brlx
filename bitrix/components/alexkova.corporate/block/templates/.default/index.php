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
//echo '<pre>';
//print_r($arParams);
//echo '</pre>';
global $arrFilter;
if(!is_array($arrFilter)) {
    $arrFilter = array();
}
$iblock_text = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], "DESCRIPTION");
?>
<?
$res = CIBlock::GetByID($arParams["IBLOCK_ID"]);
if($ar_res = $res->GetNext())
    $iblockName = $ar_res['NAME'];
if ($arParams["INCLUDE_IBLOCK_INTO_CHAIN"] == "Y") {
    $APPLICATION->AddChainItem($iblockName, $arResult["FOLDER"]);
}

//$arParams["SHOW_INDEX_ELEMENTS"] = "N";
//$arParams["SHOW_INDEX_SECTIONS"] = "Y";

$translateParams = $arParams;
$translateParams["ELEMENT"] = \Alexkova\Corporate\Catalog\Element::prepareParams($arParams, false, "INDEX_PAGE_");
$translateParams["FIELD_CODE"] = $arParams["LIST_FIELD_CODE"];
$translateParams["PROPERTY_CODE"] = $arParams["LIST_PROPERTY_CODE"];
foreach($arParams as $cell=>$val){
	if (substr_count($cell, 'INDEX_PAGE_')>0 && substr_count($cell, "ELEMENTDRAW")<=0){
		$translateParams[str_replace('INDEX_PAGE_', '', $cell)] = $val;
	}
}
?>

<div class="container full-width">
    <?if ($arParams["INDEX_DESC_TEXT_UP"] == "Y"):?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?=$iblock_text?>
        </div>
    </div>
    <?endif;?>
	<?if ($arParams["SHOW_INDEX_SECTIONS"] == "Y"):?>
    <div class="row">
            <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "index",
				$translateParams,
                $component
            );?>
    </div>
	<?endif;?>

	<?

	if ($arParams["SHOW_INDEX_ELEMENTS"] == "Y"):




		$translateParams["ELEMENT"] = \Alexkova\Corporate\Catalog\Element::prepareParams($arParams, false, "LIST_PAGE_");
		foreach($arParams as $cell=>$val){
			if (substr_count($cell, 'LIST_PAGE_')>0 && substr_count($cell, "ELEMENTDRAW")<=0){
				$translateParams[str_replace('LIST_PAGE_', '', $cell)] = $val;
			}
		}
		?>
		<div class="row">
                    <?
                        if ($arParams["INCLUDE_SUBSECTIONS"] != "Y")
                        {
                            $arrFilter['SECTION_ID']=0;
                            $translateParams['FILTER_NAME'] = 'arrFilter';
                        }
                    ?>



			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"",
				$translateParams,
				$component
			);?>
		</div>
    <?if ($arParams["INDEX_DESC_TEXT_DOWN"] == "Y"):?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?=$iblock_text?>
        </div>
    </div>
    <?endif;?>
<?endif;?>
</div>
