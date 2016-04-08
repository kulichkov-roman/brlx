<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<? //$APPLICATION->SetAdditionalCSS('http://fonts.googleapis.com/css?family=Ubuntu:400,700&subset=cyrillic,latin');?>
<? $arResult["LOGO_FILE"] = SITE_DIR."include/logo.php"; ?>
<? 
    $mainPage = str_replace("//","/", SITE_DIR.'/index.php');
?>
<div class="container">
    <div class="row headline">
        <? 
            $tempClass = "col-lg-4 col-md-3 col-sm-10 col-xs-8";
            if($arParams['DISPLAY_HEAD_VARIANT'] == "head_v2")
                $tempClass = "col-lg-3 col-md-3 col-sm-10 col-xs-8";
        ?>
        <div class="<?=$tempClass;?>">
                <a class="logo" href="<?=SITE_DIR?>">
                        <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "corporate_include",
                                Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => $arResult["LOGO_FILE"] ,
                                        "INCLUDE_PTITLE"=>GetMessage('LOGO_AREA')
                                ),
                                $component
                        );?>
                </a>
        </div>
        <div class="col-sm-2 col-xs-3 hidden-lg hidden-md">
            <div id="menuitem" class="mobile-menu-button pull-right"></div>
        </div>

        <? 
            $includePath = SITE_DIR."include/contacts.php";
            $tempClass = "col-lg-4 col-md-4 hidden-xs hidden-sm chead-line";
            if($arParams['DISPLAY_HEAD_VARIANT'] == "head_v2") {
                $includePath = SITE_DIR."include/tagline.php";
                $tempClass = "col-lg-5 col-md-4 hidden-xs hidden-sm chead-line tagline";
            }                
        ?>
        <div class="<?=$tempClass;?> opacity_6 link_color_gray">
                <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "corporate_include",
                        Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => $includePath,
                                "INCLUDE_PTITLE"=>GetMessage('SPEED_LINK')
                        ),
                        $component
                );?>
        </div>

        
        <? 
            $includePath = SITE_DIR."include/phone.php";
            $tempClass = "col-lg-4 col-md-4 hidden-xs hidden-sm";
            if($arParams['DISPLAY_HEAD_VARIANT'] != "head_v1") {
                $includePath = SITE_DIR."include/phone_v2.php";
                $tempClass = "col-lg-4 col-md-5 hidden-xs hidden-sm";
            }
        ?>
        <div class="<?=$tempClass;?>">
                <div id="phone-line" class="open-answer-form-phone pull-right <?if($arParams['DISPLAY_HEAD_VARIANT'] != "head_v1") echo "head-big-phone"; ?>">
                        <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "corporate_include",
                                Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => $includePath,
                                        "INCLUDE_PTITLE"=>GetMessage('PHONE_AREA')
                                )
                        );?>

                </div>
                <? if($arParams['DISPLAY_HEAD_VARIANT'] == "head_v1"):?>
                <div id="ext-line" class="pull-right">
                        <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "corporate_include",
                                Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_DIR."include/extented_info.php",
                                        "INCLUDE_PTITLE"=>GetMessage('EXT_AREA')
                                )
                        );?>

                </div>
                <? endif;?>

        </div>
        <div class="col-sm-12 col-xs-12 hidden-lg hidden-md"  id="mobile-menu-container">
                <div id="mobile-menu-body"></div>
        </div>
    </div>
</div>
<?
    $typeMenu = "version_v1_1";
    if(isset($arParams['DISPLAY_MENU_VARIANT']))
        $typeMenu = $arParams['DISPLAY_MENU_VARIANT'];
    
    $typeSearch = "big_search"; 
    if(strpos($typeMenu , "version_v2" ) === false)
       $typeSearch =  "corporate_search";
    
    $style_menu = "colored_light";
    switch ($typeMenu) {
        case "version_v1_1": $style_menu = "colored_light"; break;
        case "version_v1_2": $style_menu = "colored_dark"; break;
        case "version_v1_3": $style_menu = "colored_color"; break;
        case "version_v2_1": $style_menu = "colored_light"; break;
        case "version_v2_2": $style_menu = "colored_dark"; break;
        case "version_v2_3": $style_menu = "colored_color"; break;
    }

    
    $fixed = "Y";    
    if(isset($arParams['FIXED_MENU']) && !empty($arParams['FIXED_MENU']))
        $fixed = $arParams['FIXED_MENU'];
    
?>
<div data-fixed="<?=$fixed;?>" class="dcontainer full-screen <?=$style_menu?> v-line_menu hidden-sm hidden-xs">
    <div class="container" >
        <div class="row">
            <div clss="col-md-12 hidden-xs hidden-sm ">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    $typeMenu ,
                    Array(
                            "ROOT_MENU_TYPE" => "top",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array(""),
                            "MAX_LEVEL" => "2",
                            "CHILD_MENU_TYPE" => "left",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N"
                    ),
                    $component
                );?>
            </div>
        </div> 
    </div>
    <div class="dcontainer full-screen dcontainer-search-form" >
        <div class="container">
            <div clss="row">
                <div id="search-line" class="inline-menu col-md-12 hidden-xs hidden-sm">
                    <?$APPLICATION->IncludeComponent(
                            "bitrix:search.form",
                            $typeSearch,
                            Array(
                                    "PAGE" => SITE_DIR."search/",
                                    "USE_SUGGEST" => "Y"
                            ),
                            $component
                    );?>
                </div>
            </div>
        </div>
    </div>
</div>

<?if ($APPLICATION->GetCurPage(true) == $mainPage &&  $arParams["NOT_SHOW_SLIDER"] != "Y"):?>
<div style="clear: both;" class="hidden-xs dcontainer <?if($arParams["SLIDER_FUUL_SCREEN"]=="Y") echo "full-screen"; ?> ">
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "slick",
        Array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_SLIDER_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_SLIDER_ID"],
                "NEWS_COUNT" => "5",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array(
                    0=>"ID",
                    1=>"CODE",
                    2=>"NAME",
                    3=>"PREVIEW_PICTURE",
                    4=>"",
                    "DETAIL_PICTURE",
                    "PREVIEW_TEXT"),
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
                "AJAX_OPTION_ADDITIONAL" => "",
                "SLIDER_SPEED" => $arParams["SLIDER_SPEED"],
                "SLIDER_AUTOPLAY_SPEED" => $arParams["SLIDER_AUTOPLAY_SPEED"],
                "SLIDER_FUUL_SCREEN" => $arParams["SLIDER_FUUL_SCREEN"],
                "SLIDER_AUTOPLAY" => $arParams["SLIDER_AUTOPLAY"],
                "SLIDER_NAVIGATION_BUTTONS" => $arParams["SLIDER_NAVIGATION_BUTTONS"],
                "SLIDER_FADE" => $arParams["SLIDER_FADE"],
        ),
        $component
    );?>
</div>
<?endif;?>

<div class="dcontainer">
    <div class="container navigation">
        <div class="row">
            <div class="col-lg-12">
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

<?if ($APPLICATION->GetCurPage(true) == $mainPage):?>
<div class="dcontainer <?if($arParams["SLIDER_FUUL_SCREEN"]=="Y") echo "full-screen"; ?>" >
   <div class="container">  
        <div class="row">
            <div class="col-md-12 demo-height-slick">
                <? 
                    $translateParams = array(
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
                        "HIDE_SLIDER_ARROWS" => $arParams["HIDE_SLIDER_ARROWS"],
                        "HIDE_MOBILE_SLIDER_ARROWS" => $arParams["HIDE_MOBILE_SLIDER_ARROWS"],
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
                        "DISPLAY_BOTTOM_PAGER" => "N",
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
                        "AUTORESIZE_CART"=>$arParams["AUTORESIZE_CART"],
                    );

                    $translateParams = array_merge($translateParams, \Alexkova\Corporate\Catalog\Element::prepareParams($arParams, true));
     
                ?>
                <?$APPLICATION->IncludeComponent(
                    "alexkova.corporate:block.list",
                    ".default",
                    $translateParams,
                    false,
                    array("HIDE_ICONS"=>"Y")
                  );
                ?>
            </div>
        </div>
    </div>
</div>
<?endif;?>
