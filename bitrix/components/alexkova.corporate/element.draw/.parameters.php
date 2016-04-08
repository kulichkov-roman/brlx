<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


if(!CModule::IncludeModule("iblock"))
	return;

$arMode = array(
	"classic_small"=>GetMessage("CLASSIC_SMALL_MODE"),
	"background_small"=>GetMessage("BACKGROUND_SMALL_MODE"),
	"flat_small"=>GetMessage("FLAT_SMALL_MODE"),
        "classic"=>GetMessage("CLASSIC_MODE"),
	"background"=>GetMessage("BACKGROUND_MODE"),
	"flat"=>GetMessage("FLAT_MODE"),
        "classic_with_image"=>GetMessage("CLASSIC_WITH_IMAGE_MODE"),
	"background_with_image"=>GetMessage("BACKGROUND_WITH_IMAGE_MODE"),
	"flat_with_image"=>GetMessage("FLAT_WITH_IMAGE_MODE"),
        "classic_brand"=>GetMessage("CLASSIC_BRAND_MODE"),
	"background_brand"=>GetMessage("BACKGROUND_BRAND_MODE"),
	"flat_brand"=>GetMessage("FLAT_BRAND_MODE"),
        "list_border"=>GetMessage("LIST_BORDER_MODE"),
        "list_marked"=>GetMessage("LIST_MARKED_MODE"),
        "brand_small"=>GetMessage("BRAND_SMALL_MODE"),
        "list_date"=>GetMessage("LIST_DATE_MODE"),
);

$arComponentParameters = array(
	"GROUPS" => array(

	),
	"PARAMETERS" => array(
		"DISPLAY_VARIANT"=>array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("DISPLAY_VARIANT_MODE"),
			"TYPE" => "LIST",
			"VALUES" => $arMode,
		),
                "ELEMENT[NAME]"=>array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("ELEMENT_NAME"),
			"TYPE" => "STRING",
		),
                "ELEMENT[TEXT]"=>array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("ELEMENT_TEXT"),
			"TYPE" => "STRING",
		),
                "ELEMENT[IMAGE]"=>array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("ELEMENT_IMAGE"),
			"TYPE" => "STRING",
		),
                "ELEMENT[LINK]"=>array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("ELEMENT_LINK"),
			"TYPE" => "STRING",
		),
                "ELEMENT[DATE]"=>array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("ELEMENT_DATE"),
			"TYPE" => "STRING",
		),
                "CLASS_NAME"=>array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CLASS_NAME"),
			"TYPE" => "STRING",
		),
                "CUSTOM_TYPE"=>array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CUSTOM_TYPE"),
			"TYPE" => "STRING",
		),
                "LINK_ALL_BLOCK"=>array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("LINK_ALL_BLOCK"),
			"TYPE" => "CHECKBOX",
		),
	),

);

?>