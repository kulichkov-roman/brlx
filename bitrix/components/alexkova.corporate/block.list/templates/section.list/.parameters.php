<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


$arTemplateParameters = Array(
	'SHOW_SUBSECTION' => array(
		'PARENT' => 'BASE',
		'NAME' => GetMessage('SHOW_SUBSECTION_DESC'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
		'REFRESH' => 'Y'
	),

        'SECTION_CODE' => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("SECTION_CODE_DESC"),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),

        'SECTION_ID' => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("SECTION_ID_DESC"),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        )
);
?>