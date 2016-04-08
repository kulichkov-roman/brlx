<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


if(!CModule::IncludeModule("iblock"))
	return;

if(!CModule::IncludeModule("alexkova.corporate"))
	return;

use Alexkova\Corporate\Catalog\Element;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arIBlockSlider=array();
$rsIBlockSlider = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_SLIDER_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlockSlider->Fetch())
{
	$arIBlockSlider[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}



$arVisualStyles = \Alexkova\Corporate\Catalog\Element::getElementViews();

$arHead = array(
	"head_v1"=>GetMessage("V1_HEAD"),
        "head_v2"=>GetMessage("V2_HEAD"),
        "head_v3"=>GetMessage("V3_HEAD"),
);

$arMenu = array(
	"version_v1_1"=>GetMessage("V1_1_MENU"),
        "version_v1_2"=>GetMessage("V1_2_MENU"),
        "version_v1_3"=>GetMessage("V1_3_MENU"),
	"version_v2_1"=>GetMessage("V2_1_MENU"),
        "version_v2_2"=>GetMessage("V2_2_MENU"),
        "version_v2_3"=>GetMessage("V2_3_MENU"),
);


    $arComponentParameters = array(
	"GROUPS" => array(
                "HEAD_BLOCKS"=>array('NAME'=>GetMessage("HEAD_BLOCKS")),
                "MENU_BLOCKS"=>array('NAME'=>GetMessage("MENU_BLOCKS")),
		"SLIDER"=>array('NAME'=>GetMessage("SLIDER_BLOCKS")),
		"MAIN_BLOCKS"=>array('NAME'=>GetMessage("MAIN_BLOCKS")),
	),
	"PARAMETERS" => array(
		/*"SHOW_AUTHORIZE"=>array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SHOW_AUTHORIZE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y"
		),*/
            
                "DISPLAY_HEAD_VARIANT" => array(
                    "PARENT" => "HEAD_BLOCKS",
                    "NAME" => GetMessage("HEAD_BLOCKS"),
                    "TYPE" => "LIST",
                    "VALUES" => $arHead,
                    "DEFAULT" => "head_v1",
                ),
            
                "DISPLAY_MENU_VARIANT" => array(
                    "PARENT" => "MENU_BLOCKS",
                    "NAME" => GetMessage("DISPLAY_VARIANT_MODE"),
                    "TYPE" => "LIST",
                    "VALUES" => $arMenu,
                    "DEFAULT" => "version_v1",
                ),
            
                "FIXED_MENU" => array(
                    "PARENT" => "MENU_BLOCKS",
                    "NAME" => GetMessage("FIXED_MENU"),
                    "TYPE" => "CHECKBOX",
                    "DEFAULT" => "Y",
                ),
            
                /*"DISPLAY_MENU_STYLE" => array(
                    "PARENT" => "MENU_BLOCKS",
                    "NAME" => GetMessage("DISPLAY_MENU_STYLE"),
                    "TYPE" => "LIST",
                    "VALUES" => $arStyleMenu,
                    "DEFAULT" => "",
                ),*/
            
                "NOT_SHOW_SLIDER" => array(
			"PARENT" => "SLIDER",
			"NAME" => GetMessage("NOT_SHOW_SLIDER_BLOCKS"),
			"TYPE" => "CHECKBOX"
		),

		"IBLOCK_SLIDER_TYPE" => array(
			"PARENT" => "SLIDER",
			"NAME" => GetMessage("BN_P_IBLOCK_SLIDER_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),

		"IBLOCK_SLIDER_ID" => array(
			"PARENT" => "SLIDER",
			"NAME" => GetMessage("BN_P_IBLOCK_SLIDER_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockSlider,
		),
            
                "SLIDER_FUUL_SCREEN" => array(
			"PARENT" => "SLIDER",
			"NAME" => GetMessage("SLIDER_FUUL_SCREEN"),
			"TYPE" => "CHECKBOX",
		),
            
                "SLIDER_SPEED" => array(
			"PARENT" => "SLIDER",
			"NAME" => GetMessage("SLIDER_SPEED"),
			"TYPE" => "TEXT",
                        "DEFAULT" => "1500"
		),
            
                "SLIDER_AUTOPLAY" => array(
			"PARENT" => "SLIDER",
			"NAME" => GetMessage("SLIDER_AUTOPLAY"),
			"TYPE" => "CHECKBOX",
		),
            
                "SLIDER_AUTOPLAY_SPEED" => array(
			"PARENT" => "SLIDER",
			"NAME" => GetMessage("SLIDER_AUTOPLAY_SPEED"),
			"TYPE" => "TEXT",
                        "DEFAULT" => "3000"
		),
            
                "SLIDER_NAVIGATION_BUTTONS" => array(
			"PARENT" => "SLIDER",
			"NAME" => GetMessage("SLIDER_NAVIGATION_BUTTONS"),
			"TYPE" => "CHECKBOX",
		),
            
                "SLIDER_FADE" => array(
			"PARENT" => "SLIDER",
			"NAME" => GetMessage("SLIDER_FADE"),
			"TYPE" => "CHECKBOX",
		),

		"IBLOCK_TYPE" => array(
			"PARENT" => "MAIN_BLOCKS",
			"NAME" => GetMessage("BN_P_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),

		"IBLOCK_ID" => array(
			"PARENT" => "MAIN_BLOCKS",
			"NAME" => GetMessage("BN_P_IBLOCK"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
		),

		"VISUAL_STYLE" => array(
			"PARENT" => "MAIN_BLOCKS",
			"NAME" => GetMessage("VISUAL_STYLE"),
			"TYPE" => "LIST",
			"VALUES" => $arVisualStyles,
			"REFRESH" => "Y",
		),


		"CACHE_TIME"  =>  Array("DEFAULT"=>3600)
	),

);

if(isset($arCurrentValues["VISUAL_STYLE"]) && strlen($arCurrentValues["VISUAL_STYLE"])>0)
{
	$arParameters = \Alexkova\Corporate\Catalog\Element::getElementViewSettings($arCurrentValues["VISUAL_STYLE"], false, $arCurrentValues);

	$arComponentParameters["PARAMETERS"]["NEWS_COUNT"] = array(
		"PARENT" => "MAIN_BLOCKS",
		"NAME" => GetMessage("NEWS_COUNT"),
		"TYPE" => "STRING",
		"DEFAULT" => "4"
	);

	foreach($arParameters["LIST_PARAMS"] as $cell=>$val){
		$val["PARENT"] = 'MAIN_BLOCKS';
		$arComponentParameters["PARAMETERS"][$cell] = $val;
	}
	foreach($arParameters["ELEMENT"] as $cell=>$val){
		$val["PARENT"] = 'MAIN_BLOCKS';
		$arComponentParameters["PARAMETERS"]["ELEMENTDRAW_".$cell] = $val;
	}


}

?>