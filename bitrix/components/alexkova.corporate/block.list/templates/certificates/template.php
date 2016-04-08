<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

    <?$this->setFrameMode(true);
//echo "<pre>"; print_r($arParams); echo "</pre>";

$arParams["ELEMENT"] = \Alexkova\Corporate\Catalog\Element::prepareParams($arParams, '');


		if ($arParams["CUSTOM_STYLE"] == "Y")
            $arParams["PROPERTY_CODE"][] = "CUSTOM_STYLE";
        if ($arParams["ADD_ELEMENT_CLASS"] == "Y")
            $arParams["PROPERTY_CODE"][] = "ADD_CLASS";
		$arParams["FIELD_CODE"][] = "DETAIL_PICTURE";
		$arParams["ADD_SECTIONS_CHAIN"] = "N";
		$arParams["INCLUDE_IBLOCK_INTO_CHAIN"] = "N";

$arParams["PROPERTY_CODE"][] = "LIST_BUTTONS";
    ?>
    <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "",
            $arParams,
            $component
    );?>

    