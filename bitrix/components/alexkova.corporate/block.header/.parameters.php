<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


if(!CModule::IncludeModule("iblock"))
	return;

if(!CModule::IncludeModule("alexkova.corporate"))
	return;

use Alexkova\Corporate\Catalog\Element;
use Alexkova\Corporate\Skin;

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

$arMode = array(
	"version_v1"=>GetMessage("V1_HEAD_MODE"),
	"version_v2"=>GetMessage("V2_HEAD_MODE"),
	"version_v3"=>GetMessage("V3_HEAD_MODE"),
);

$arMenuMode = array(
	"menu_version_v1"=>GetMessage("V1_MODE"),
	"menu_version_v2"=>GetMessage("V2_MODE"),
	"menu_version_v3"=>GetMessage("V3_MODE"),
	"menu_version_v4"=>GetMessage("V4_MODE")
);

/*$arModeSettings = array(
	'version_v1' => array(
		"ADDITIONAL_PARAMS"=>array(
			"PARAMS"=>array(
				"ALL_DISPLAY_MENU_VARIANT"=>array(
					"PARENT" => "ALL_PAGE",
					"NAME" => GetMessage("DISPLAY_VARIANT_MODE"),
					"TYPE" => "LIST",
					"VALUES" => $arMenuMode,
					"DEFAULT" => "menu_version_v1",
				),
			"EXTENTED_PARAMS"=>array(

			)
		)
	)
));*/

$arThemes = \Alexkova\Corporate\Skin::getSkins();
$arThemes["user_theme"] = GetMessage('USER_THEME');

$arVisualStyles = \Alexkova\Corporate\Catalog\Element::getElementViews();

$arSlider = array("slick" => GetMessage("SLICK_SLIDER"), "revolution" => GetMessage("REVOLUTION_SLIDER"));

$arComponentParameters = array(
	"GROUPS" => array(
		"MAIN_PAGE"=>array('NAME'=>GetMessage("MAIN_PAGE")),
		"ALL_PAGE"=>array('NAME'=>GetMessage("ALL_PAGE")),
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

		"NOT_SHOW_SLIDER" => array(
			"PARENT" => "SLIDER",
			"NAME" => GetMessage("NOT_SHOW_SLIDER_BLOCKS"),
			"TYPE" => "CHECKBOX"
		),
            
                "TYPE_SLIDER" => array(
			"PARENT" => "SLIDER",
			"NAME" => GetMessage("TYPE_SLIDER"),
			"TYPE" => "LIST",
                        'VALUES' => $arSlider,
                        "REFRESH" => "Y"
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
            
           

		"HEAD_THEME" => array(
			"PARENT" => "MAIN_PAGE",
			"NAME" => GetMessage("HEAD_THEME"),
			"TYPE" => "LIST",
			"VALUES" => $arThemes,
			"DEFAULT" => "",
			"REFRESH" => "Y"
		),
		"ALL_HEAD_THEME" => array(
			"PARENT" => "ALL_PAGE",
			"NAME" => GetMessage("HEAD_THEME"),
			"TYPE" => "LIST",
			"VALUES" => $arThemes,
			"DEFAULT" => "",
			"REFRESH" => "Y"
		),


		"DISPLAY_HEAD_VARIANT"=>array(
			"PARENT" => "MAIN_PAGE",
			"NAME" => GetMessage("DISPLAY_HEAD_VARIANT_MODE"),
			"TYPE" => "LIST",
			"VALUES" => $arMode,
			"DEFAULT" => "version_v1",
		),

		"ALL_DISPLAY_HEAD_VARIANT"=>array(
			"PARENT" => "ALL_PAGE",
			"NAME" => GetMessage("DISPLAY_HEAD_VARIANT_MODE"),
			"TYPE" => "LIST",
			"VALUES" => $arMode,
			"DEFAULT" => "version_v1",
		),

		"NOT_SHOW_IBLOCK" => array(
			"PARENT" => "MAIN_BLOCKS",
			"NAME" => GetMessage("NOT_SHOW_IBLOCK"),
			"TYPE" => "CHECKBOX"
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

if(isset($arCurrentValues['TYPE_SLIDER']) && $arCurrentValues['TYPE_SLIDER']=="revolution") {
    $arComponentParameters["PARAMETERS"]["SLIDER_HEIGHT"] = array(
        "PARENT" => "SLIDER",
        "NAME" => GetMessage("SLIDER_HEIGHT"),
        "TYPE" => "TEXT",
        "DEFAULT" => ""
    );
}

if(isset($arCurrentValues['TYPE_SLIDER']) && $arCurrentValues['TYPE_SLIDER']=="slick") {
    $arComponentParameters["PARAMETERS"]["SLIDER_SPEED"] = array(
        "PARENT" => "SLIDER",
        "NAME" => GetMessage("SLIDER_SPEED"),
        "TYPE" => "TEXT",
        "DEFAULT" => "1500"
    );
    
    $arComponentParameters["PARAMETERS"]["SLIDER_AUTOPLAY"] = array(
        "PARENT" => "SLIDER",
        "NAME" => GetMessage("SLIDER_AUTOPLAY"),
        "TYPE" => "CHECKBOX",
    );
         
    $arComponentParameters["PARAMETERS"]["SLIDER_AUTOPLAY_SPEED"] = array(
        "PARENT" => "SLIDER",
        "NAME" => GetMessage("SLIDER_AUTOPLAY_SPEED"),
        "TYPE" => "TEXT",
        "DEFAULT" => "3000"
    );
              
    $arComponentParameters["PARAMETERS"]["SLIDER_NAVIGATION_BUTTONS"] = array(
        "PARENT" => "SLIDER",
        "NAME" => GetMessage("SLIDER_NAVIGATION_BUTTONS"),
        "TYPE" => "CHECKBOX",
    );
                   
    $arComponentParameters["PARAMETERS"]["SLIDER_FADE"] = array(
        "PARENT" => "SLIDER",
        "NAME" => GetMessage("SLIDER_FADE"),
        "TYPE" => "CHECKBOX",
    );
};

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

if (isset($arCurrentValues["HEAD_THEME"]) && strlen($arCurrentValues["HEAD_THEME"])>0){
	$arCurrentTheme = \Alexkova\Corporate\Skin::getSkinSettings($arCurrentValues["HEAD_THEME"]);
	$tmpMenu = $arMenuMode;
	if (count($arCurrentTheme["SETTINGS"]["MENU_VERSIONS"])>0){
		$tmpMenu = array();
		foreach ($arMenuMode as $cell=>$val){
			if (in_array($cell, $arCurrentTheme["SETTINGS"]["MENU_VERSIONS"]))
				$tmpMenu[$cell] = $val;
		}

	}
	$arComponentParameters["PARAMETERS"]["DISPLAY_MENU_VARIANT"] = array(
		"PARENT" => "MAIN_PAGE",
		"NAME" => GetMessage("DISPLAY_VARIANT_MODE"),
		"TYPE" => "LIST",
		"VALUES" => $tmpMenu,
		"DEFAULT" => "version_v1"
	);
}

if (isset($arCurrentValues["ALL_HEAD_THEME"]) && strlen($arCurrentValues["ALL_HEAD_THEME"])>0){
	$arCurrentTheme = \Alexkova\Corporate\Skin::getSkinSettings($arCurrentValues["ALL_HEAD_THEME"]);
	$tmpMenu = $arMenuMode;
	if (count($arCurrentTheme["SETTINGS"]["MENU_VERSIONS"])>0){
		foreach ($arMenuMode as $cell=>$val){
			if (in_array($cell, $arCurrentTheme["SETTINGS"]["MENU_VERSIONS"]))
				$tmpMenu[$cell] = $val;
		}
	}
	$arComponentParameters["PARAMETERS"]["ALL_DISPLAY_MENU_VARIANT"] = array(
		"PARENT" => "ALL_PAGE",
		"NAME" => GetMessage("DISPLAY_VARIANT_MODE"),
		"TYPE" => "LIST",
		"VALUES" => $tmpMenu,
		"DEFAULT" => "version_v1"
	);
}

if (isset($arCurrentValues["HEAD_THEME"]) && $arCurrentValues["HEAD_THEME"] == 'user_theme'){

	$arComponentParameters["PARAMETERS"]["DARK_MODE"] = array(
		"PARENT" => "MAIN_PAGE",
		"NAME" => GetMessage("DARK_MODE"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "FFFFFF"
	);

	$arComponentParameters["PARAMETERS"]["DARK_MODE_TRANSPARENT"] = array(
		"PARENT" => "MAIN_PAGE",
		"NAME" => GetMessage("DARK_MODE_TRANSPARENT"),
		"TYPE" => "STRING",
		"DEFAULT" => "0"
	);

	$arComponentParameters["PARAMETERS"]["DARK_MODE_INVERSION"] = array(
		"PARENT" => "MAIN_PAGE",
		"NAME" => GetMessage("DARK_MODE_INVERSION"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N"
	);

	$arComponentParameters["PARAMETERS"]["FULL_SCREEN_MODE"] = array(
		"PARENT" => "MAIN_PAGE",
		"NAME" => GetMessage("FULL_SCREEN_MODE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N"
	);
}

if (isset($arCurrentValues["ALL_HEAD_THEME"]) && $arCurrentValues["ALL_HEAD_THEME"] == 'user_theme'){

	$arComponentParameters["PARAMETERS"]["ALL_DARK_MODE"] = array(
		"PARENT" => "ALL_PAGE",
		"NAME" => GetMessage("DARK_MODE"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "FFFFFF"
	);

	$arComponentParameters["PARAMETERS"]["ALL_DARK_MODE_TRANSPARENT"] = array(
		"PARENT" => "ALL_PAGE",
		"NAME" => GetMessage("DARK_MODE_TRANSPARENT"),
		"TYPE" => "STRING",
		"DEFAULT" => "0"
	);

	$arComponentParameters["PARAMETERS"]["ALL_DARK_MODE_INVERSION"] = array(
		"PARENT" => "ALL_PAGE",
		"NAME" => GetMessage("DARK_MODE_INVERSION"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N"
	);

	$arComponentParameters["PARAMETERS"]["ALL_FULL_SCREEN_MODE"] = array(
		"PARENT" => "ALL_PAGE",
		"NAME" => GetMessage("FULL_SCREEN_MODE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N"
	);
}

?>