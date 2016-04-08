<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this->setFrameMode(true);?>

<?
global $addHeaderStyle, $addHeaderClass, $addContentClass;
$addHeaderStyle='';
$addHeaderClass='';
$addContentClass = '';
?>

<?

if (isset($arResult["PARAMS"]["COLOR"]) && strlen($arResult["PARAMS"]["COLOR"])>0){
	$addHeaderStyle = 'background-color: '.$arResult["PARAMS"]["COLOR"].";";
}
if ($arResult["PARAMS"]["INVERSION"]){
	$addHeaderClass = ' inversion';
}
if ($arResult["PARAMS"]["FULLSCREEN"]){
	$addHeaderClass .= ' full-screen';
	$addContentClass = ' full-screen';
}

if (in_array($arResult["PARAMS"]["HEAD_THEME"], array('color_sample', 'color_sample_fullscreen'))){
	$addHeaderClass .= ' color-scheme';
}
$mainPage = str_replace("//","/", SITE_DIR.'/index.php');

if (strlen($addHeaderStyle)>0) $addHeaderStyle = 'style="'.$addHeaderStyle.'"';
?>

<div class="dcontainer <?=$addHeaderClass?> head-container" <?=$addHeaderStyle?>>
<?
global $TopCompanySettings;
$BannerTemplate = 'full-static';
$BannerActive = "Y";
$element_type = $TopCompanySettings["top_banner_type"];
if ($element_type == "DISABLE") $BannerActive = "N";
if ($element_type == "RESPONSIVE") $BannerTemplate = "full-responsive";
?>
<?$APPLICATION->IncludeComponent("alexkova.corporate:abmanager", $BannerTemplate, array(
		"SHOW" => "TOP",
		"BANTYPE" => "TOP",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "0",
		"USE_IN_LG_MODE" => "Y",
		"USE_IN_MD_MODE" => "Y",
		"USE_IN_SM_MODE" => "N",
		"USE_IN_XS_MODE" => "N"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => $BannerActive
	)
);?>
</div>

<div class="dcontainer dark-light border-light theme3 <?=$addHeaderClass?>  head-container" <?=$addHeaderStyle?>">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-10 col-xs-9">
				<a class="logo" href="<?=SITE_DIR?>">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"corporate_include",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => $arResult["LOGO_FILE"],
							"INCLUDE_PTITLE"=>GetMessage('LOGO_AREA')
						),
						$component
					);?>

				</a>
			</div>
			<div class="col-sm-2 col-md-4 col-xs-3 hidden-lg hidden-md">
				<div id="menuitem" class="mobile-menu-button pull-right"></div>
			</div>

			<?$arAddClasses = array(
				"menu_version_v1" => 'compound-clgradient',
				"menu_version_v2" => 'compound-clwhite',
				"menu_version_v3" => 'compound-cldark',
				"menu_version_v4" => 'compound-cldarkcolor',
			);?>

			<div class="col-lg-8 col-md-8 hidden-sm hidden-xs <?=$arAddClasses[$arResult["PARAMS"]["DISPLAY_MENU_VARIANT"]]?>">
				<?
				global $compoundMenu;
				$compoundMenu = true;
				if (file_exists(dirname(__FILE__)."/".$arResult["PARAMS"]["DISPLAY_MENU_VARIANT"]."3.php"))
					include($arResult["PARAMS"]["DISPLAY_MENU_VARIANT"]."3.php");
				?>
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-12 col-lg-12 hidden-lg hidden-md"  id="mobile-menu-container">
				<div id="mobile-menu-body"></div>
			</div>
		</div>

		<?if ($APPLICATION->GetCurPage(true) == $mainPage  && $arParams["NOT_SHOW_SLIDER"] != "Y"):?>
		<?if ($arResult["PARAMS"]["FULL_SCREEN_MODE"] == "Y"):?>
	</div>
	<div class="container full-width">
		<?endif;?>
            
                <? 
                    $typeSlider = "revolution";
                    if(isset($arParams['TYPE_SLIDER']) && !empty($arParams['TYPE_SLIDER']))
                       $typeSlider = $arParams['TYPE_SLIDER'];
                    
                    $arSliderParams = Array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_SLIDER_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_SLIDER_ID"],
                        "NEWS_COUNT" => "5",
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_ORDER1" => "DESC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => array(0=>"ID",1=>"CODE",2=>"NAME",3=>"PREVIEW_PICTURE",4=>"DETAIL_PICTURE",),
                        "PROPERTY_CODE" => array(0=>"LINK",1=>"DELAY",2=>"NEW_TAB",3=>"MASTERSPEED",4=>"EFFECT"),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "360000",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_STATUS_404" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "PAGER_TITLE" => "Slides",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => "",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "AJAX_OPTION_ADDITIONAL" => ""
                    );
                                
                    if($typeSlider=="revolution") {
                        $arSliderParams['SLIDER_HEIGHT'] = $arParams["SLIDER_HEIGHT"];
                    }                    
                    
                    if($typeSlider=="slick") {
                        $arSliderParams['SLIDER_SPEED'] = $arParams["SLIDER_SPEED"];
                        $arSliderParams['SLIDER_AUTOPLAY_SPEED'] = $arParams["SLIDER_AUTOPLAY_SPEED"];
                        $arSliderParams['SLIDER_FUUL_SCREEN'] = $arParams["SLIDER_FUUL_SCREEN"];
                        $arSliderParams['SLIDER_AUTOPLAY'] = $arParams["SLIDER_AUTOPLAY"];
                        $arSliderParams['SLIDER_NAVIGATION_BUTTONS'] = $arParams["SLIDER_NAVIGATION_BUTTONS"];
                        $arSliderParams['SLIDER_FADE'] = $arParams["SLIDER_FADE"];
                    };
                    
                ?>

		<div class="row slider-line">
			<div class="<? if($typeSlider!="slick") echo "col-lg-12 col-md-12 col-sm-12 "; ?>col-lg-12 col-md-12 col-sm-12 hidden-xs">
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list",
					$typeSlider,
					$arSliderParams,
					$component
				);?>
			</div>
		</div>
		<?endif;?>

		<?if ($APPLICATION->GetCurPage(true) == $mainPage && intval($arParams["IBLOCK_ID"]>0)   && $arParams["NOT_SHOW_IBLOCK"] != "Y"):
		global $arrFilter;
		$arrFilter["!PROPERTY_SHOW_MAIN"] = false;
		?>

		<?if ($arResult["PARAMS"]["FULL_SCREEN_MODE"] == "Y"):?>
	</div>
	<div class="container">
		<?endif;?>

		<div class="row">
			<div class="col-lg-12">
				<?$translateParams = array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"NEWS_COUNT" => $arParams["NEWS_COUNT"]>0? $arParams["NEWS_COUNT"] : 4,
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ACTIVE_FROM",
					"SORT_ORDER2" => "DSC",
					"FILTER_NAME" => "arrFilter",
					"FIELD_CODE" => array(
						0 => "NAME",
						1 => "PREVIEW_PICTURE",
						2 => "DETAIL_PICTURE",
						3 => "",
					),
					"CHECK_DATES" => "Y",
					"VISUAL_STYLE" => $arParams["VISUAL_STYLE"],
					"CUSTOM_STYLE" => "N",
					"LG_CNT" => $arParams["LG_CNT"],
					"MD_CNT" => $arParams["MD_CNT"],
					"SM_CNT" => $arParams["SM_CNT"],
					"XS_CNT" => $arParams["XS_CNT"],
					"SLIDER" => $arParams["SLIDER"],
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
					"PAGE_BLOCK_TITLE_GLYPHICON"=>"",
					'PAGE_BLOCK_TITLE'=>"",
					"SHOW_ELEMENT_URL"=>$arParams["SHOW_ELEMENT_URL"],
					"SHOW_ELEMENT_URL_TITLE"=>$arParams["SHOW_ELEMENT_URL_TITLE"],
					"AUTORESIZE_CART"=>$arParams["AUTORESIZE_CART"]
				);

				$translateParams = array_merge($translateParams, \Alexkova\Corporate\Catalog\Element::prepareParams($arParams, true));

				?>

				<?$APPLICATION->IncludeComponent(
					"alexkova.corporate:block.list",
					".default",
					$translateParams,
					false,
					array("HIDE_ICONS"=>"Y")
				);?>
			</div>
		</div>
		<?endif;?>


	<div class="row">

		<div class="col-lg-12 navigation">

			<div class="breadcrumb">
				<?$APPLICATION->IncludeComponent(
					"bitrix:breadcrumb",
					".default",
					array(
						"START_FROM" => "0",
						"PATH" => "",
						"SITE_ID" => "-"
					),
					false
				);?>
			</div>


		</div>

	</div>
	</div>


</div>



