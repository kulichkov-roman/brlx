<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

if(!CModule::IncludeModule("alexkova.corporate"))
	return;

use Alexkova\Corporate\Catalog\Element;
$arVisualStyles = \Alexkova\Corporate\Catalog\Element::getElementViews();
/*$arVisualStyles['other_card'] = GetMessage('OTHER_MODEL_CARD_VIEW');
$arVisualStyles['other'] = GetMessage('OTHER_MODEL_SCRIPT_VIEW');*/

$arIBlockProjectsSettings = array(
	"version_v1"=>array(
		"TITLE" => GetMessage("IBLOCK_USE_PROJECT_PLACE_V1"),
		"DISPLAY_VARIANTS"=>$arVisualStyles,

		"ADDITIONAL_SETTINGS"=>array(
			'classic_small'=>\Alexkova\Corporate\Catalog\Element::getElementViewSettings('classic_small', true),
			'classic_dark_title'=>\Alexkova\Corporate\Catalog\Element::getElementViewSettings('classic_dark_title', true),
			'only_image'=>\Alexkova\Corporate\Catalog\Element::getElementViewSettings('only_image', true),

			'other' => array(
				"PROJECT_OTHER_VARIANT_CARD" => array(
					"PARENT" => "PROJECTS_SETTINGS",
					"NAME" => GetMessage("OTHER_VARIANT_CARD_DESC"),
					"TYPE" => "STRING",
					"DEFAULT" => "",
				),
			),

			'other_views' => array(
				"PROJECT_OTHER_VARIANT_PATH" => array(
					"PARENT" => "PROJECTS_SETTINGS",
					"NAME" => GetMessage("OTHER_VARIANT_PATH_DESC"),
					"TYPE" => "STRING",
					"DEFAULT" => "",
				),
			),
		),
		"DEFAULT_DISPLAY" => 'classic_small'
	),
	"version_v2"=>array(
		"TITLE" => GetMessage("IBLOCK_USE_PROJECT_PLACE_V2"),
		"DISPLAY_VARIANTS"=>$arVisualStyles,
		"ADDITIONAL_SETTINGS"=>array(
			'classic_small'=>\Alexkova\Corporate\Catalog\Element::getElementViewSettings('classic_small', true),
			'classic_dark_title'=>\Alexkova\Corporate\Catalog\Element::getElementViewSettings('classic_dark_title', true),
			'only_image'=>\Alexkova\Corporate\Catalog\Element::getElementViewSettings('only_image', true),

			'other' => array(
				"PROJECT_OTHER_VARIANT_CARD" => array(
					"PARENT" => "PROJECTS_SETTINGS",
					"NAME" => GetMessage("OTHER_VARIANT_CARD_DESC"),
					"TYPE" => "STRING",
					"DEFAULT" => "",
				),
			),

			'other_views' => array(
				"PROJECT_OTHER_VARIANT_PATH" => array(
					"PARENT" => "PROJECTS_SETTINGS",
					"NAME" => GetMessage("OTHER_VARIANT_PATH_DESC"),
					"TYPE" => "STRING",
					"DEFAULT" => "",
				),
			),
		),
		"DEFAULT_DISPLAY" => 'classic_small'
	),
);

$arDisplayModeList = array();
foreach($arIBlockProjectsSettings as $cell=>$val){
	$arDisplayModeList[$cell] = $val["TITLE"];
}

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arExtIblock = array();
if($arCurrentValues["USE_EXT_IBLOCK_SETTINGS"]=="Y")
{
	if ($arCurrentValues["COUNT_EXT_IBLOCK_SETTINGS"]<=0) $arCurrentValues["COUNT_EXT_IBLOCK_SETTINGS"] = 1;

	for ($i=0; $i<$arCurrentValues["COUNT_EXT_IBLOCK_SETTINGS"]; $i++){
		$arExtIblock[$i+1][0] = '';
		$rsExtIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["EXT_IBLOCK_".($i+1)."_TYPE"], "ACTIVE"=>"Y"));
		while($arr=$rsExtIBlock->Fetch())
		{
			$arExtIblock[$i+1][$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
		}
	}
}



$arSorts = Array("ASC"=>GetMessage("T_IBLOCK_DESC_ASC"), "DESC"=>GetMessage("T_IBLOCK_DESC_DESC"));
$arSortFields = Array(
	"ID"=>GetMessage("T_IBLOCK_DESC_FID"),
	"NAME"=>GetMessage("T_IBLOCK_DESC_FNAME"),
	"ACTIVE_FROM"=>GetMessage("T_IBLOCK_DESC_FACT"),
	"SORT"=>GetMessage("T_IBLOCK_DESC_FSORT"),
	"TIMESTAMP_X"=>GetMessage("T_IBLOCK_DESC_FTSAMP")
);

$arProperty_LNS = array();
$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
while ($arr=$rsProp->Fetch())
{
	$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S", "E")))
	{
		$arProperty_LNS[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	}
}

$arUGroupsEx = Array();
$dbUGroups = CGroup::GetList($by = "c_sort", $order = "asc");
while($arUGroups = $dbUGroups -> Fetch())
{
	$arUGroupsEx[$arUGroups["ID"]] = $arUGroups["NAME"];
}


$arComponentParameters = array(
	"GROUPS" => array(
		/*"RSS_SETTINGS" => array(
			"SORT" => 110,
			"NAME" => GetMessage("T_IBLOCK_DESC_RSS_SETTINGS"),
		),
		"RATING_SETTINGS" => array(
			"SORT" => 120,
			"NAME" => GetMessage("T_IBLOCK_DESC_RATING_SETTINGS"),
		),*/
		"EXT_IBLOCK_SETTINGS" => array(
			"SORT" => 1400,
			"NAME" => GetMessage("T_IBLOCK_DESC_EXT_IBLOCK_SETTINGS"),
		),
		/*"REVIEW_SETTINGS" => array(
			"SORT" => 140,
			"NAME" => GetMessage("T_IBLOCK_DESC_REVIEW_SETTINGS"),
		),
		"FILTER_SETTINGS" => array(
			"SORT" => 150,
			"NAME" => GetMessage("T_IBLOCK_DESC_FILTER_SETTINGS"),
		),*/
		"INDEX_SETTINGS" => array(
			"SORT" => 1100,
			"NAME" => GetMessage("INDEX_SETTINGS_DESC"),
		),
		"LIST_SETTINGS" => array(
			"NAME" => GetMessage("CN_P_LIST_SETTINGS"),
		),
		"ELEMENT_LIST_SETTINGS" => array(
			"NAME" => GetMessage("ELEMENT_LIST_SETTINGS_DESC"),
		),
		"DETAIL_SETTINGS" => array(
			"NAME" => GetMessage("CN_P_DETAIL_SETTINGS"),
		),
		"DETAIL_PAGER_SETTINGS" => array(
			"NAME" => GetMessage("CN_P_DETAIL_PAGER_SETTINGS"),
		),
                "REQUEST_BUTTON_SETTINGS" => array(
			"NAME" => GetMessage("REQUEST_BUTTON_SETTINGS"),
		),
	),
	"PARAMETERS" => array(
		"VARIABLE_ALIASES" => Array(
			"SECTION_ID" => Array("NAME" => GetMessage("BN_P_SECTION_ID_DESC")),
			"ELEMENT_ID" => Array("NAME" => GetMessage("NEWS_ELEMENT_ID_DESC")),
		),
		"SEF_MODE" => Array(
			"index" => array(
				"NAME" => GetMessage("T_IBLOCK_SEF_PAGE_NEWS"),
				"DEFAULT" => "",
				"VARIABLES" => array(),
			),
			"section" => array(
				"NAME" => GetMessage("T_IBLOCK_SEF_PAGE_NEWS_SECTION"),
				"DEFAULT" => "",
				"VARIABLES" => array("SECTION_ID"),
			),
			"detail" => array(
				"NAME" => GetMessage("T_IBLOCK_SEF_PAGE_NEWS_DETAIL"),
				"DEFAULT" => "#ELEMENT_ID#/",
				"VARIABLES" => array("ELEMENT_ID", "SECTION_ID"),
			),
			/*"search" => array(
				"NAME" => GetMessage("T_IBLOCK_SEF_PAGE_SEARCH"),
				"DEFAULT" => "search/",
				"VARIABLES" => array(),
			),
			"rss" => array(
				"NAME" => GetMessage("T_IBLOCK_SEF_PAGE_RSS"),
				"DEFAULT" => "rss/",
				"VARIABLES" => array(),
			),
			"rss_section" => array(
				"NAME" => GetMessage("T_IBLOCK_SEF_PAGE_RSS_SECTION"),
				"DEFAULT" => "#SECTION_ID#/rss/",
				"VARIABLES" => array("SECTION_ID"),
			),*/
		),
		"AJAX_MODE" => array(),
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("BN_P_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("BN_P_IBLOCK"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
			"ADDITIONAL_VALUES" => "Y",
		),
		"NEWS_COUNT" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_CONT"),
			"TYPE" => "STRING",
			"DEFAULT" => "20",
		),
		/*"USE_SEARCH" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_USE_SEARCH"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),*/

		"SORT_BY1" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("T_IBLOCK_DESC_IBORD1"),
			"TYPE" => "LIST",
			"DEFAULT" => "ACTIVE_FROM",
			"VALUES" => $arSortFields,
			"ADDITIONAL_VALUES" => "Y",
		),
		"SORT_ORDER1" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("T_IBLOCK_DESC_IBBY1"),
			"TYPE" => "LIST",
			"DEFAULT" => "DESC",
			"VALUES" => $arSorts,
			"ADDITIONAL_VALUES" => "Y",
		),
		"SORT_BY2" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("T_IBLOCK_DESC_IBORD2"),
			"TYPE" => "LIST",
			"DEFAULT" => "SORT",
			"VALUES" => $arSortFields,
			"ADDITIONAL_VALUES" => "Y",
		),
		"SORT_ORDER2" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("T_IBLOCK_DESC_IBBY2"),
			"TYPE" => "LIST",
			"DEFAULT" => "ASC",
			"VALUES" => $arSorts,
			"ADDITIONAL_VALUES" => "Y",
		),
		"CHECK_DATES" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("T_IBLOCK_DESC_CHECK_DATES"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		/*"PREVIEW_TRUNCATE_LEN" => Array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_PREVIEW_TRUNCATE_LEN"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),*/

		"LIST_ACTIVE_DATE_FORMAT" => CIBlockParameters::GetDateFormat(GetMessage("T_IBLOCK_DESC_ACTIVE_DATE_FORMAT"), "LIST_SETTINGS"),
		"LIST_FIELD_CODE" => CIBlockParameters::GetFieldCode(GetMessage("IBLOCK_FIELD"), "LIST_SETTINGS"),

		"LIST_PROPERTY_CODE" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_PROPERTY"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty_LNS,
			"ADDITIONAL_VALUES" => "Y",
		),

		/*"HIDE_LINK_WHEN_NO_DETAIL" => Array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_HIDE_LINK_WHEN_NO_DETAIL"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),*/

		"DISPLAY_NAME" => Array(
			"PARENT" => "DETAIL_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_NAME"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),

		"META_KEYWORDS" =>array(
			"PARENT" => "DETAIL_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_KEYWORDS"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"DEFAULT" => "-",
			"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		),
		"META_DESCRIPTION" =>array(
			"PARENT" => "DETAIL_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_DESCRIPTION"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"DEFAULT" => "-",
			"VALUES" => array_merge(Array("-"=>" "),$arProperty_LNS),
		),

		"BROWSER_TITLE" => array(
			"PARENT" => "DETAIL_SETTINGS",
			"NAME" => GetMessage("CP_BN_BROWSER_TITLE"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"DEFAULT" => "-",
			"VALUES" => array_merge(Array("-"=>" ", "NAME" => GetMessage("IBLOCK_FIELD_NAME")), $arProperty_LNS),
		),
		"DETAIL_ACTIVE_DATE_FORMAT" => CIBlockParameters::GetDateFormat(GetMessage("T_IBLOCK_DESC_ACTIVE_DATE_FORMAT"), "DETAIL_SETTINGS"),
		"DETAIL_FIELD_CODE" => CIBlockParameters::GetFieldCode(GetMessage("IBLOCK_FIELD"), "DETAIL_SETTINGS"),
		"DETAIL_PROPERTY_CODE" => array(
			"PARENT" => "DETAIL_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_PROPERTY"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty_LNS,
			"ADDITIONAL_VALUES" => "Y",
		),
            
                "DETAIL_SHOW_CALLBACK" => array(
			"PARENT" => "DETAIL_SETTINGS",
			"NAME" => GetMessage("T_ELEMENT_SHOW_CALLBACK"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),

		"DETAIL_DISPLAY_TOP_PAGER" => array(
			"PARENT" => "DETAIL_PAGER_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_TOP_PAGER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),

		"DETAIL_DISPLAY_BOTTOM_PAGER" => array(
			"PARENT" => "DETAIL_PAGER_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_BOTTOM_PAGER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),

		"DETAIL_PAGER_TITLE" => array(
			"PARENT" => "DETAIL_PAGER_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_TITLE"),
			"TYPE" => "STRING",
			"DEFAULT" => GetMessage("T_IBLOCK_DESC_PAGER_TITLE_PAGE"),
		),

		"DETAIL_PAGER_TEMPLATE" => array(
			"PARENT" => "DETAIL_PAGER_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_TEMPLATE"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),

		"DETAIL_PAGER_SHOW_ALL" => array(
			"PARENT" => "DETAIL_PAGER_SETTINGS",
			"NAME" => GetMessage("CP_BN_DETAIL_PAGER_SHOW_ALL"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),

		"SET_STATUS_404" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("CP_BN_SET_STATUS_404"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"SET_TITLE" => Array(),

		"INCLUDE_IBLOCK_INTO_CHAIN" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_INCLUDE_IBLOCK_INTO_CHAIN"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
            
                "INCLUDE_SUBSECTIONS" => Array(
                    "PARENT" => "ADDITIONAL_SETTINGS",
                    "NAME" => GetMessage("T_IBLOCK_DESC_INCLUDE_SUBSECTION"),
                    "TYPE" => "CHECKBOX",
                    "DEFAULT" => "N",
                ),

		"ADD_SECTIONS_CHAIN" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_ADD_SECTIONS_CHAIN"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),

		"ADD_ELEMENT_CHAIN" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_ADD_ELEMENT_CHAIN"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N"
		),
		"USE_PERMISSIONS" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_USE_PERMISSIONS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		"GROUP_PERMISSIONS" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_GROUP_PERMISSIONS"),
			"TYPE" => "LIST",
			"VALUES" => $arUGroupsEx,
			"DEFAULT" => Array(1),
			"MULTIPLE" => "Y",
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
		"CACHE_FILTER" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("BN_P_CACHE_FILTER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("CP_BN_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),



		"VISUAL_STYLE" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("VISUAL_STYLE"),
			"TYPE" => "LIST",
			"DEFAULT" => "ASC",
			"VALUES" => $arVisualStyles,
			"ADDITIONAL_VALUES" => "N",
		),

		"CUSTOM_STYLE" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("CUSTOM_STYLE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),

		"LINK_ALL_BLOCK" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("LINK_ALL_BLOCK"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),

		"ROW_ALIGN" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("ROW_ALIGN"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),

		/*
		"SHOW_GOODS_IN_LEFT_COL" => array(
			"PARENT" => "VISUAL",
			"NAME" => GetMessage("SHOW_GOODS_IN_LEFT_COL"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),

        "SHOW_FILES_IN_LEFT_COL" => array(
			"PARENT" => "VISUAL",
			"NAME" => GetMessage("SHOW_FILES_IN_LEFT_COL"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),

		"SHOW_PARTNERS_IN_LEFT_COL" => array(
			"PARENT" => "VISUAL",
			"NAME" => GetMessage("SHOW_PARTNERS_IN_LEFT_COL"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),

		"SHOW_ARTICLES_IN_LEFT_COL" => array(
			"PARENT" => "VISUAL",
			"NAME" => GetMessage("SHOW_ARTICLES_IN_LEFT_COL"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),*/
                
            "SHOW_REQUEST_BUTTON" => array (
                        "PARENT" => "REQUEST_BUTTON_SETTINGS",
			"NAME" => GetMessage("SHOW_REQUEST_BUTTON_DESC"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
                        "REFRESH" => "Y"
                ),
            
	),
    
        
);      

if ($arCurrentValues["SHOW_REQUEST_BUTTON"] == 'Y')
{
    $arComponentParameters["PARAMETERS"]["REQUEST_BUTTON_ACTION"] = array(
        "PARENT" => "REQUEST_BUTTON_SETTINGS",
        "NAME" => GetMessage("REQUEST_BUTTON_ACTION"),
        "TYPE" => "LIST",
        "VALUES" => array(
                "link" => "[link] ".GetMessage('REQUEST_BUTTON_ACTION_LINK'),
                "js" => "[js] ".GetMessage('REQUEST_BUTTON_ACTION_JS'),
        ),
        "DEFAULT" => "link",
        "REFRESH" => "Y"
    );
    
        if ($arCurrentValues["REQUEST_BUTTON_ACTION"]=='link') {
            $arComponentParameters["PARAMETERS"]["REQUEST_BUTTON_LINK"] = array(
                "PARENT" => "REQUEST_BUTTON_SETTINGS",
                "NAME" => GetMessage("REQUEST_BUTTON_LINK"),
                "TYPE" => "STRING",
                "DEFAULT" => "",
            );

            $arComponentParameters["PARAMETERS"]["REQUEST_BUTTON_TARGET"] = array(
                "PARENT" => "REQUEST_BUTTON_SETTINGS",
                "NAME" => GetMessage("REQUEST_BUTTON_TARGET"),
                "TYPE" => "LIST",
                "VALUES" => array(
                    "_self" => "[_self] ".GetMessage('REQUEST_BUTTON_TARGET_SELF'),
                    "_blank" => "[_blank] ".GetMessage('REQUEST_BUTTON_TARGET_BLANK'),
                    "_parent" => "[_parent] ".GetMessage('REQUEST_BUTTON_TARGET_PARENT'),
                    "_top" => "[_top] ".GetMessage('REQUEST_BUTTON_TARGET_TOP'),
                ),
                "DEFAULT" => "_self",
            );
        }
        
        if ($arCurrentValues["REQUEST_BUTTON_ACTION"]=='js') {
            $arComponentParameters["PARAMETERS"]["REQUEST_BUTTON_JS_CLASS"] = array(
                "PARENT" => "REQUEST_BUTTON_SETTINGS",
                "NAME" => GetMessage("REQUEST_BUTTON_JS_CLASS"),
                "TYPE" => "STRING",
                "DEFAULT" => "",
            );
        }
    
    $arComponentParameters["PARAMETERS"]["REQUEST_BUTTON_TITLE"] = array(
        "PARENT" => "REQUEST_BUTTON_SETTINGS",
        "NAME" => GetMessage("REQUEST_BUTTON_TITLE"),
        "TYPE" => "STRING",
        "DEFAULT" => "Купить",
    );
}
                
    

CIBlockParameters::AddPagerSettings($arComponentParameters, GetMessage("T_IBLOCK_DESC_PAGER_NEWS"), true, true);

if($arCurrentValues["USE_FILTER"]=="Y")
{
	$arComponentParameters["PARAMETERS"]["FILTER_NAME"] = array(
		"PARENT" => "FILTER_SETTINGS",
		"NAME" => GetMessage("T_IBLOCK_FILTER"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	);
	$arComponentParameters["PARAMETERS"]["FILTER_FIELD_CODE"] = CIBlockParameters::GetFieldCode(GetMessage("IBLOCK_FIELD"), "FILTER_SETTINGS");
	$arComponentParameters["PARAMETERS"]["FILTER_PROPERTY_CODE"] = array(
		"PARENT" => "FILTER_SETTINGS",
		"NAME" => GetMessage("T_IBLOCK_PROPERTY"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arProperty_LNS,
		"ADDITIONAL_VALUES" => "Y",
	);
}

if($arCurrentValues["USE_PERMISSIONS"]!="Y")
	unset($arComponentParameters["PARAMETERS"]["GROUP_PERMISSIONS"]);

if($arCurrentValues["USE_RSS"]=="Y")
{
	$arComponentParameters["PARAMETERS"]["NUM_NEWS"] = array(
		"PARENT" => "RSS_SETTINGS",
		"NAME" => GetMessage("T_IBLOCK_DESC_RSS_NUM_NEWS1"),
		"TYPE" => "STRING",
		"DEFAULT"=>'20',
	);
	$arComponentParameters["PARAMETERS"]["NUM_DAYS"] = array(
		"PARENT" => "RSS_SETTINGS",
		"NAME" => GetMessage("T_IBLOCK_DESC_RSS_NUM_DAYS"),
		"TYPE" => "STRING",
		"DEFAULT"=>'30',
	);
	$arComponentParameters["PARAMETERS"]["YANDEX"] = array(
		"PARENT" => "RSS_SETTINGS",
		"NAME" => GetMessage("T_IBLOCK_DESC_RSS_YANDEX"),
		"TYPE" => "CHECKBOX",
		"DEFAULT"=>"N",
	);
}
else
{
	unset($arComponentParameters["PARAMETERS"]["SEF_MODE"]["rss"]);
	unset($arComponentParameters["PARAMETERS"]["SEF_MODE"]["rss_section"]);
}

if($arCurrentValues["USE_SEARCH"]!="Y")
{
	unset($arComponentParameters["PARAMETERS"]["SEF_MODE"]["search"]);
}
/*
if($arCurrentValues["USE_RATING"]=="Y")
{
	$arComponentParameters["PARAMETERS"]["MAX_VOTE"] = array(
		"PARENT" => "RATING_SETTINGS",
		"NAME" => GetMessage("IBLOCK_MAX_VOTE"),
		"TYPE" => "STRING",
		"DEFAULT" => "5",
	);
	$arComponentParameters["PARAMETERS"]["VOTE_NAMES"] = array(
		"PARENT" => "RATING_SETTINGS",
		"NAME" => GetMessage("IBLOCK_VOTE_NAMES"),
		"TYPE" => "STRING",
		"VALUES" => array(),
		"MULTIPLE" => "Y",
		"DEFAULT" => array("1","2","3","4","5"),
		"ADDITIONAL_VALUES" => "Y",
	);
}

if(!IsModuleInstalled("forum"))
{
	unset($arComponentParameters["GROUPS"]["REVIEW_SETTINGS"]);
	unset($arComponentParameters["PARAMETERS"]["USE_REVIEW"]);
}
elseif($arCurrentValues["USE_REVIEW"]=="Y")
{
	$arForumList = array();
	if(CModule::IncludeModule("forum"))
	{
		$rsForum = CForumNew::GetList();
		while($arForum=$rsForum->Fetch())
			$arForumList[$arForum["ID"]]=$arForum["NAME"];
	}
	$arComponentParameters["PARAMETERS"]["MESSAGES_PER_PAGE"] = Array(
		"PARENT" => "REVIEW_SETTINGS",
		"NAME" => GetMessage("F_MESSAGES_PER_PAGE"),
		"TYPE" => "STRING",
		"DEFAULT" => intVal(COption::GetOptionString("forum", "MESSAGES_PER_PAGE", "10"))
	);
	$arComponentParameters["PARAMETERS"]["USE_CAPTCHA"] = Array(
		"PARENT" => "REVIEW_SETTINGS",
		"NAME" => GetMessage("F_USE_CAPTCHA"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y"
	);
	$arComponentParameters["PARAMETERS"]["REVIEW_AJAX_POST"] = Array(
		"PARENT" => "REVIEW_SETTINGS",
		"NAME" => GetMessage("F_REVIEW_AJAX_POST"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y"
	);
	$arComponentParameters["PARAMETERS"]["PATH_TO_SMILE"] = Array(
		"PARENT" => "REVIEW_SETTINGS",
		"NAME" => GetMessage("F_PATH_TO_SMILE"),
		"TYPE" => "STRING",
		"DEFAULT" => "/bitrix/images/forum/smile/",
	);
	$arComponentParameters["PARAMETERS"]["FORUM_ID"] = Array(
		"PARENT" => "REVIEW_SETTINGS",
		"NAME" => GetMessage("F_FORUM_ID"),
		"TYPE" => "LIST",
		"VALUES" => $arForumList,
		"DEFAULT" => "",
	);
	$arComponentParameters["PARAMETERS"]["URL_TEMPLATES_READ"] = Array(
		"PARENT" => "REVIEW_SETTINGS",
		"NAME" => GetMessage("F_READ_TEMPLATE"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	);
	$arComponentParameters["PARAMETERS"]["SHOW_LINK_TO_FORUM"] = Array(
		"PARENT" => "REVIEW_SETTINGS",
		"NAME" => GetMessage("F_SHOW_LINK_TO_FORUM"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	);
}*/


$arComponentParameters["PARAMETERS"]["USE_EXT_IBLOCK_SETTINGS"] = Array(
	"PARENT" => "EXT_IBLOCK_SETTINGS",
	"NAME" => GetMessage("T_IBLOCK_DESC_USE_EXT_IBLOCK_SETTINGS"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
	"REFRESH" => "Y",
);

if($arCurrentValues["USE_EXT_IBLOCK_SETTINGS"]=="Y")
{
	$arComponentParameters["PARAMETERS"]["LINK_PROPERTY_CODE"] = Array(
		"PARENT" => "EXT_IBLOCK_SETTINGS",
		"NAME" => GetMessage("IBLOCK_THIS_LINK_PROPERTY_CODE"),
		"TYPE" => "STRING",
		"DEFAULT" => "OTHER_ELEMENTS",
	);

	$arComponentParameters["PARAMETERS"]["COUNT_EXT_IBLOCK_SETTINGS"] = Array(
		"PARENT" => "EXT_IBLOCK_SETTINGS",
		"NAME" => GetMessage("T_IBLOCK_DESC_COUNT_EXT_IBLOCK_SETTINGS"),
		"TYPE" => "LIST",
		"VALUES" => array(
			1=>1,2=>2,3=>3,4=>4,5=>5,6=>6
		),
		"DEFAULT" => 1,
		"REFRESH" => "Y",
	);

	if ($arCurrentValues["COUNT_EXT_IBLOCK_SETTINGS"]<=0) $arCurrentValues["COUNT_EXT_IBLOCK_SETTINGS"] = 1;

	for ($i=0; $i<$arCurrentValues["COUNT_EXT_IBLOCK_SETTINGS"]; $i++){
		$arComponentParameters["GROUPS"]["EXT_IBLOCK_".($i+1)] = array(
			"NAME"=>GetMessage("EXT_IBLOCK_GROUP")." #".($i+1),
			"SORT"=>1500+$i*100
		);

		$arComponentParameters["PARAMETERS"]["EXT_IBLOCK_".($i+1)."_TYPE"] = array(
			"PARENT" => "EXT_IBLOCK_".($i+1),
			"NAME" => GetMessage("BN_P_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"VALUE"=>$arCurrentValues["EXT_IBLOCK_".($i+1)."_TYPE"]>0 ? "EXT_IBLOCK_".($i+1)."_TYPE" : "",
			"REFRESH" => "Y",
		);

		$arComponentParameters["PARAMETERS"]["EXT_IBLOCK_".($i+1)."_ID"] = array(
			"PARENT" => "EXT_IBLOCK_".($i+1),
			"NAME" => GetMessage("BN_P_IBLOCK"),
			"TYPE" => "LIST",
			"VALUES" => $arExtIblock[$i+1],
		);

		$arComponentParameters["PARAMETERS"]["EXT_IBLOCK_".($i+1)."_CODE"] = array(
			"PARENT" => "EXT_IBLOCK_".($i+1),
			"NAME" => GetMessage("IBLOCK_LINK_PROPERTY_CODE"),
			"TYPE" => "STRING",
			"DEFAULT" => "OTHER_ELEMENTS",
		);

		$arComponentParameters["PARAMETERS"]["EXT_IBLOCK_".($i+1)."_MAX_COUNT"] = array(
			"PARENT" => "EXT_IBLOCK_".($i+1),
			"NAME" => GetMessage("IBLOCK_MAX_ITEMS_COUNT"),
			"TYPE" => "STRING",
			"DEFAULT" => "4",
		);

		$arComponentParameters["PARAMETERS"]["EXT_IBLOCK_".($i+1)."_DISPLAY_VARIANT"] = array(
			"PARENT" => "EXT_IBLOCK_".($i+1),
			"NAME" => GetMessage("IBLOCK_DISPLAY_VARIANT"),
			"TYPE" => "LIST",
			"VALUES" =>$arDisplayModeList,
			"DEFAULT" => "version_v1",
			"REFRESH" => "Y"
		);

		$version = isset($arCurrentValues["EXT_IBLOCK_".($i+1)."_DISPLAY_VARIANT"])? $arCurrentValues["EXT_IBLOCK_".($i+1)."_DISPLAY_VARIANT"] : 'version_v1';

		$arDisplayModels = $arIBlockProjectsSettings[$version]["DISPLAY_VARIANTS"];


		$arComponentParameters["PARAMETERS"]["EXT_IBLOCK_".($i+1)."_ELEMENTS_MODEL"] = Array(
			"PARENT" => "EXT_IBLOCK_".($i+1),
			"NAME" => GetMessage("T_IBLOCK_USE_ELEMENTS_MODEL"),
			"TYPE" => "LIST",
			"VALUES" => $arDisplayModels,
			"DEFAULT" => $arIBlockProjectsSettings[$version]["DEFAULT_DISPLAY"],
			"REFRESH" => "Y"
		);

		$currentModel = isset($arCurrentValues["EXT_IBLOCK_".($i+1)."_ELEMENTS_MODEL"])? $arCurrentValues["EXT_IBLOCK_".($i+1)."_ELEMENTS_MODEL"] : $arIBlockProjectsSettings[$version]["DEFAULT_DISPLAY"];

		/*if (isset($arIBlockProjectsSettings[$version]["ADDITIONAL_SETTINGS"][$currentModel])){
			foreach ($arIBlockProjectsSettings[$version]["ADDITIONAL_SETTINGS"][$currentModel] as $cell=>$val){
				$val["PARENT"] = "EXT_IBLOCK_".($i+1);
				print_r($cell);
				$arComponentParameters["PARAMETERS"]["EXT_IBLOCK_".($i+1)."_EXTENTED_".$cell] = $val;
			}
		}*/

		$arParameters = \Alexkova\Corporate\Catalog\Element::getElementViewSettings($currentModel, false, $arCurrentValues, 'EXT_IBLOCK_'.($i+1).'_', "EXT_IBLOCK_".($i+1));

		foreach($arParameters["LIST_PARAMS"] as $cell=>$val){
			$val["PARENT"] = 'EXT_IBLOCK_'.($i+1);
			$arComponentParameters["PARAMETERS"]['EXT_IBLOCK_'.($i+1).'_'.$cell] = $val;
		}
		foreach($arParameters["ELEMENT"] as $cell=>$val){
			$val["PARENT"] = 'EXT_IBLOCK_'.($i+1);
			$arComponentParameters["PARAMETERS"]['EXT_IBLOCK_'.($i+1).'_ELEMENTDRAW_'.$cell] = $val;
		}

		$arComponentParameters["PARAMETERS"]["EXT_IBLOCK_".($i+1)."_SORT"] = array(
			"PARENT" => "EXT_IBLOCK_".($i+1),
			"NAME" => GetMessage("PROJECT_SORT_DESC"),
			"TYPE" => "STRING",
			"DEFAULT" => "500",
		);

		$arComponentParameters["PARAMETERS"]["EXT_IBLOCK_".($i+1)."_TITLE"] = array(
			"PARENT" => "EXT_IBLOCK_".($i+1),
			"NAME" => GetMessage("PROJECT_LIST_TITLE_DESC"),
			"TYPE" => "STRING",
		);

		$arComponentParameters["PARAMETERS"]["EXT_IBLOCK_".($i+1)."_GLYPHICON"] = array(
			"PARENT" => "EXT_IBLOCK_".($i+1),
			"NAME" => GetMessage("PROJECT_LIST_GLYPHICON_DESC"),
			"TYPE" => "STRING",
		);

		$arComponentParameters["PARAMETERS"]["EXT_IBLOCK_".($i+1)."_LINK_TITLE"] = array(
			"PARENT" => "EXT_IBLOCK_".($i+1),
			"NAME" => GetMessage("PROJECT_LIST_LINK_TITLE_DESC"),
			"TYPE" => "STRING",
		);


	}
}

$arComponentParameters["PARAMETERS"]["INDEX_DESC_TEXT_UP"] = Array(
        "PARENT" => "INDEX_SETTINGS",
        "NAME" => GetMessage("IBLOCK_INDEX_DESC_TEXT_UP"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N"
);
$arComponentParameters["PARAMETERS"]["INDEX_DESC_TEXT_DOWN"] = Array(
        "PARENT" => "INDEX_SETTINGS",
        "NAME" => GetMessage("IBLOCK_INDEX_DESC_TEXT_DOWN"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N"
);


$arComponentParameters["PARAMETERS"]["INDEX_VISUAL_STYLE"] = Array(
	"PARENT" => "INDEX_SETTINGS",
	"NAME" => GetMessage("IBLOCK_DISPLAY_VARIANT"),
	"TYPE"=>"LIST",
	"VALUES"=>$arVisualStyles,
	"REFRESH" => "Y",
);

if(isset($arCurrentValues["INDEX_VISUAL_STYLE"]) && strlen($arCurrentValues["INDEX_VISUAL_STYLE"])>0)
{
	$arParameters = \Alexkova\Corporate\Catalog\Element::getElementViewSettings($arCurrentValues["INDEX_VISUAL_STYLE"], false, $arCurrentValues, 'INDEX_PAGE_', 'INDEX_PAGE_');

	foreach($arParameters["LIST_PARAMS"] as $cell=>$val){
		$val["PARENT"] = 'INDEX_SETTINGS';
		$arComponentParameters["PARAMETERS"]['INDEX_PAGE_'.$cell] = $val;
	}
	foreach($arParameters["ELEMENT"] as $cell=>$val){
		$val["PARENT"] = 'INDEX_SETTINGS';
		$arComponentParameters["PARAMETERS"]['INDEX_PAGE_ELEMENTDRAW_'.$cell] = $val;
	}


}

$arComponentParameters["PARAMETERS"]["LIST_VISUAL_STYLE"] = Array(
	"PARENT" => "ELEMENT_LIST_SETTINGS",
	"NAME" => GetMessage("IBLOCK_DISPLAY_VARIANT"),
	"TYPE"=>"LIST",
	"VALUES"=>$arVisualStyles,
	"REFRESH" => "Y",
);

if(isset($arCurrentValues["LIST_VISUAL_STYLE"]) && strlen($arCurrentValues["LIST_VISUAL_STYLE"])>0)
{
	$arParameters = \Alexkova\Corporate\Catalog\Element::getElementViewSettings($arCurrentValues["LIST_VISUAL_STYLE"], false, $arCurrentValues, 'LIST_PAGE_', 'LIST_PAGE_');

	foreach($arParameters["LIST_PARAMS"] as $cell=>$val){
		$val["PARENT"] = 'ELEMENT_LIST_SETTINGS';
		$arComponentParameters["PARAMETERS"]['LIST_PAGE_'.$cell] = $val;
	}
	foreach($arParameters["ELEMENT"] as $cell=>$val){
		$val["PARENT"] = 'ELEMENT_LIST_SETTINGS';
		$arComponentParameters["PARAMETERS"]['LIST_PAGE_ELEMENTDRAW_'.$cell] = $val;
	}


}
?>
