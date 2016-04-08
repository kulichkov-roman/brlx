<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("alexkova.rklite"))
	return;

$rsBanType = CKuznica_rklite::GetTypeList(array("ID"=>"ASC"),array("ACTIVE"=>"Y"));
$arBanType = array("-" => GetMessage("BANTYPE_DEFAULT"));
while($arr=$rsBanType->Fetch())
	$arBanType[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];

$arMode = array(
	"SINGLE" => GetMessage("SINGLE_MODE"),
	"MULTIPLE" => GetMessage("MULTIPLE_MODE"),
);

$arComponentParameters = array(
	"GROUPS" => array(),
	"PARAMETERS" => array(
		"BANTYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("BANTYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arBanType,
			"DEFAULT" => "",
			"ADDITIONAL_VALUES"=>"N"
		),
		"MODE"=>array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("MODE"),
			"TYPE" => "LIST",
			"VALUES" => $arMode,
			"REFRESH" => "Y"
		),
		"HIDE_WIDTH_HEIGHT"=>array(
			"PARENT" => "ADDITIONAL",
			"NAME" => GetMessage("HIDE_WIDTH_HEIGHT"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N"
		),
		"ADD_NOFOLLOW"=>array(
			"PARENT" => "ADDITIONAL",
			"NAME" => GetMessage("RKLITE_ADD_NOFOLLOW"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N"
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>0),
	),
);
if($arCurrentValues["MODE"] == "MULTIPLE")
	$arComponentParameters["PARAMETERS"]["CNT"] = array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("CNT"),
		"TYPE" => "STRING",
		"DEFAULT" => "3"
	);
?>