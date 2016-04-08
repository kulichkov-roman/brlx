<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("TOPCOMPANY_ELEMENT_DRAW_NAME"),
	"DESCRIPTION" => GetMessage("TOPCOMPANY_ELEMENT_DRAW_DESCRIPTION"),
	"ICON" => "/images/icon.gif",
	"COMPLEX" => "Y",
	"SORT" => 10,
	"PATH" => array(
		"ID" => "corporate",
		"NAME"=> GetMessage("TOPCOMPANY_ELEMENT_DRAW_DESCRIPTION"),
	),
);

?>