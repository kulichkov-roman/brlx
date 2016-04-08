<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("CORPORATE_HEAD_NAME"),
	"DESCRIPTION" => GetMessage("CORPORATE_HEAD_DESCRIPTION"),
	"ICON" => "/images/icon.gif",
	"COMPLEX" => "Y",
	"SORT" => 10,
	"PATH" => array(
		"ID" => "corporate",
		"NAME"=> GetMessage("CORPORATE_SECTION_DESCRIPTION"),
	),
);

?>