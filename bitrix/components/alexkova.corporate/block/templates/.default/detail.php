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
//echo "<pre>"; print_r($arParams); echo "</pre>";
?>
<div class="container full-width">
    <div class="row">


		<div class="col-lg-12 extented-labels">
			<?$APPLICATION->ShowViewContent('header_extented_labels');?>
		</div>

		<div class="col-lg-12">

			<?
			$arParams["DETAIL_URL"] = $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"];
			$arParams["SECTION_URL"] = $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"];
			$arParams["ELEMENT_ID"] = $arResult["VARIABLES"]["ELEMENT_ID"];
			$arParams["ELEMENT_CODE"] = $arResult["VARIABLES"]["ELEMENT_CODE"];

			$arParams["PROPERTY_CODE"] = $arParams["DETAIL_PROPERTY_CODE"];
			$arParams["FIELD_CODE"] = $arParams["DETAIL_FIELD_CODE"];

			if ($arParams["USE_EXT_IBLOCK_SETTINGS"] == "Y" && strlen($arParams["LINK_PROPERTY_CODE"])>0)
				$arParams["PROPERTY_CODE"][] = $arParams["LINK_PROPERTY_CODE"];
			$arParams["IBLOCK_URL"] = $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"];

			//$arParams["ADD_SECTIONS_CHAIN"] = "Y";
			//$arParams["INCLUDE_IBLOCK_INTO_CHAIN"] = "Y";
			//$arParams["CACHE_TIME"] = ;
			?>
			<?$ElementID = $APPLICATION->IncludeComponent(
				"bitrix:news.detail",
				"",
				$arParams,
				$component
			);?>

		</div>



		<div class="col-lg-12"><hr /></div>

                <?if (isset($arParams['DETAIL_SHOW_CALLBACK']) && $arParams['DETAIL_SHOW_CALLBACK']=='Y'):?>
                    <div class="col-lg-12 "> 
                        <div class="product-detail-info"> 
                            <?$APPLICATION->IncludeComponent( 
                                "bitrix:main.include", 
                                "corporate_include", 
                                array( 
                                    "AREA_FILE_SHOW" => "file", 
                                    "AREA_FILE_SUFFIX" => "inc", 
                                    "EDIT_TEMPLATE" => "", 
                                    "PATH" => SITE_DIR."/include/salecart_detail.php", 
                                    "INCLUDE_TITLE" => GetMessage('EDIT_DETAIL_INFO') 
                                ), 
                                false 
                            );?> 
                        </div> 
                    </div>
                <?endif;?>
                
		<div class="col-lg-12 wow fadeIn other_elements">
			<?$APPLICATION->ShowViewContent('bottom_content_block');?>
		</div>

		<?
		global $ELEMENT_DATA;
		$arActivities = array();
		if (intval($ELEMENT_DATA["ID"])>0 || count($ELEMENT_DATA["OTHER_ELEMENTS"])>0)
		if (
			$arParams["USE_EXT_IBLOCK_SETTINGS"] == "Y"
			&& intval($arParams["COUNT_EXT_IBLOCK_SETTINGS"])>0
		):?>

			<?
			$arBuffers = array();
			for($i=0; $i<intval($arParams["COUNT_EXT_IBLOCK_SETTINGS"]); $i++){
				if (isset($arParams["EXT_IBLOCK_".($i+1)."_SORT"]) && intval($arParams["EXT_IBLOCK_".($i+1)."_SORT"])>0)
					$sort = intval($arParams["EXT_IBLOCK_".($i+1)."_SORT"]);
				else
					$sort = 500;
				$sort += ($i+1);
				$target = 'bottom_content_block';
				if (strlen($arParams["EXT_IBLOCK_".($i+1)."_DISPLAY_VARIANT"])>0
					&& $arParams["EXT_IBLOCK_".($i+1)."_DISPLAY_VARIANT"] == "version_v2"
				)
					$target = "base_left_column";
				$arBuffers[$target][$sort] = $i;

			}
			foreach ($arBuffers as &$val){
				ksort($val);
			}


			?>

			<?
			global $setActivitiesLink;

			foreach ($arBuffers as $c=>$v){
				$target = $c;

				foreach ($v as $sort=>$i){

					if ($arParams["EXT_IBLOCK_".($i+1)."_ID"]>0){

						global $arrFilter;
						$arrFilter = array(
							"ACTIVE"=>"Y",
							array(
								"LOGIC"=>"OR",
								array("ID"=>$ELEMENT_DATA["OTHER_ELEMENTS"]),
								array("PROPERTY_OTHER_ELEMENTS"=>$ELEMENT_DATA["ID"])
							)
						);

						?>
						<?$this->SetViewTarget($target, $sort);?>

						<?if (strlen($arParams["EXT_IBLOCK_".($i+1)."_LINK_TITLE"])>0):?>
							<a name="target_<?=($i+1)?>" id="target_<?=($i+1)?>"></a>
						<?endif;?>

						<?
                                                $translateParams = array(
							"IBLOCK_TYPE" => $arParams["EXT_IBLOCK_".($i+1)."_TYPE"],
							"IBLOCK_ID" => $arParams["EXT_IBLOCK_".($i+1)."_ID"],
							"NEWS_COUNT" => $arParams["EXT_IBLOCK_".($i+1)."_MAX_COUNT"]>0? $arParams["EXT_IBLOCK_".($i+1)."_MAX_COUNT"]: 4,
							"SORT_BY1" => "ACTIVE_FROM",
							"SORT_ORDER1" => "DESC",
							"SORT_BY2" => "SORT",
							"SORT_ORDER2" => "ASC",
							"FILTER_NAME" => "arrFilter",
							"FIELD_CODE" => array(
								0 => "NAME",
								1 => "PREVIEW_PICTURE",
								2 => "DETAIL_PICTURE",
								3 => "",
							),
							"PROPERTY_CODE" => array(
								0 => "OTHER_ELEMENTS",
								1 => "",
							),
							"CHECK_DATES" => "Y",
							"VISUAL_STYLE" => $arParams["EXT_IBLOCK_".($i+1)."_ELEMENTS_MODEL"],
							"CUSTOM_STYLE" => "N",
							"LG_CNT" => $arParams["EXT_IBLOCK_".($i+1)."_LG_CNT"],
							"MD_CNT" => $arParams["EXT_IBLOCK_".($i+1)."_MD_CNT"],
							"SM_CNT" => $arParams["EXT_IBLOCK_".($i+1)."_SM_CNT"],
							"XS_CNT" => $arParams["EXT_IBLOCK_".($i+1)."_XS_CNT"],
							"SLIDER" => $arParams["EXT_IBLOCK_".($i+1)."_SLIDER"],
							"VERTICAL_SLIDER_MODE" => $arParams["EXT_IBLOCK_".($i+1)."_VERTICAL_SLIDER_MODE"],
							"DETAIL_URL" => "",
							"AJAX_MODE" => "N",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"CACHE_FILTER" => "N",
							"CACHE_GROUPS" => "Y",
							"PREVIEW_TRUNCATE_LEN" => "",
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"SET_TITLE" => "N",
							"SET_BROWSER_TITLE" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_STATUS_404" => "N",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"ADD_SECTIONS_CHAIN" => "N",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"PARENT_SECTION" => "",
							"PARENT_SECTION_CODE" => "",
							"INCLUDE_SUBSECTIONS" => "Y",
							"PAGER_TEMPLATE" => ".default",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "Y",
							"PAGER_TITLE" => "",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"LINK_ALL_BLOCK" => "N",
							"ADD_ELEMENT_CLASS" => "Y",
							"AJAX_OPTION_ADDITIONAL" => "",
							"ROW_ALIGN" => "N",
							"PAGE_BLOCK_TITLE_GLYPHICON"=>$arParams["EXT_IBLOCK_".($i+1)."_GLYPHICON"],
							'PAGE_BLOCK_TITLE'=>$arParams["EXT_IBLOCK_".($i+1)."_TITLE"],
							'AUTORESIZE_CART'=>$arParams["EXT_IBLOCK_".($i+1)."_AUTORESIZE_CART"],
						);

						$translateParams = array_merge($translateParams, \Alexkova\Corporate\Catalog\Element::prepareParams($arParams, true, "EXT_IBLOCK_".($i+1)."_"));
						//echo "<pre>"; print_r($translateParams); echo "</pre>";

						?>

						<?$APPLICATION->IncludeComponent(
							"alexkova.corporate:block.list",
							".default",
							$translateParams,
							false,
							array("HIDE_ICONS"=>"Y")
						);?>

						<?$this->EndViewTarget()?>

						<?
						if ($setActivitiesLink) $arActivities[$i] = true;
						else $arActivities[$i] = false;
						?>

				<?}
				}
			}?>

<?endif;?>

			<?
			for($i=0; $i<intval($arParams["COUNT_EXT_IBLOCK_SETTINGS"]); $i++):?>
				<?if ($arActivities[$i] && strlen($arParams["EXT_IBLOCK_".($i+1)."_LINK_TITLE"])>0):?>
					<?$this->SetViewTarget('header_extented_labels', $sort)?>
					<a href="#target_<?=($i+1)?>" class="jscroll" data-scroll="#target_<?=($i+1)?>">
						<span class="glyphicon glyphicon-star-empty"></span>
						<?=$arParams["EXT_IBLOCK_".($i+1)."_LINK_TITLE"]?>
					</a>
					<?$this->EndViewTarget()?>
				<?endif;?>
			<?endfor;

			?>








	</div>
</div>

