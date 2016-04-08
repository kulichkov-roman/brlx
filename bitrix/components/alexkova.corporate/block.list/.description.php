<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("TOPCOMPANY_BLOCK_LIST_NAME"),
	"DESCRIPTION" => GetMessage("TOPCOMPANY_BLOCK_LIST_DESCRIPTION"),
	"ICON" => "/images/news_list.gif",
	"COMPLEX" => "Y",
	"SORT" => 10,
	"PATH" => array(
		"ID" => "corporate",
		"NAME"=> GetMessage("TOPCOMPANY_BLOCK_LIST_DESCRIPTION"),
	),
);

?>