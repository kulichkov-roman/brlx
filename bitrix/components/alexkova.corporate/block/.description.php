<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("IBLOCK_BLOCK_NAME"),
	"DESCRIPTION" => GetMessage("IBLOCK_BLOCK_DESCRIPTION"),
	"ICON" => "/images/news_all.gif",
	"COMPLEX" => "Y",
        "PATH" => array(
		"ID" => "corporate",
		"NAME"=> GetMessage("T_IBLOCK_DESC_BLOCK"),
	),
);

?>