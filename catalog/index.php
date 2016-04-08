<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог");

$APPLICATION->IncludeComponent(
	"alexkova.corporate:catalog", 
	"corporate", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "1",
		"HIDE_NOT_AVAILABLE" => "N",
		"SEF_MODE" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_FILTER" => "N",
		"USE_REVIEW" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_COMPARE" => "N",
		"PRICE_CODE" => array(
			0 => "PRICE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => "",
		"SHOW_TOP_ELEMENTS" => "Y",
		"TOP_ELEMENT_COUNT" => "9",
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_ELEMENT_SORT_FIELD" => "sort",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_FIELD2" => "id",
		"TOP_ELEMENT_SORT_ORDER2" => "desc",
		"TOP_PROPERTY_CODE" => array(
			0 => "DIAMETER",
			1 => "LENGTH",
			2 => "STEEL_GRADE",
			3 => "VOLUME",
			4 => "",
		),
		"SECTION_COUNT_ELEMENTS" => "Y",
		"SECTION_TOP_DEPTH" => "2",
		"PAGE_ELEMENT_COUNT" => "8",
		"LINE_ELEMENT_COUNT" => "3",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"LIST_PROPERTY_CODE" => array(
			0 => "PRICE",
			1 => "",
		),
		"INCLUDE_SUBSECTIONS" => "Y",
		"LIST_META_KEYWORDS" => "-",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_BROWSER_TITLE" => "-",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "SPECIALOFFER",
			1 => "DIAMETER",
			2 => "LENGTH",
			3 => "CLASS_STIFFNESS",
			4 => "STEEL_GRADE",
			5 => "STUFF",
			6 => "VOLUME",
			7 => "DESCRIPTION",
			8 => "OLD_PRICE",
			9 => "THICKNESS",
			10 => "PRICE",
			11 => "ACCESSORIES",
			12 => "CML2_ARTICLE",
			13 => "PLATFORM",
			14 => "MANUFACTURER",
			15 => "MATERIAL",
			16 => "COLOR",
			17 => "MECH_KOL",
			18 => "ARB_TIME",
			19 => "CAMERA_TYPE",
			20 => "MATRIX_TYPE",
			21 => "CAMERA_POSITION",
			22 => "GLASS_CPU",
			23 => "DIAGONAL",
			24 => "ARB_CHANNEL",
			25 => "MORE_PHOTO",
			26 => "",
		),
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_BROWSER_TITLE" => "-",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"USE_ALSO_BUY" => "N",
		"USE_STORE" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"DETAIL_SHOW_MAX_QUANTITY" => "N",
		"MESS_BTN_BUY" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_COMPARE" => "Сравнение",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"DETAIL_USE_VOTE_RATING" => "N",
		"DETAIL_USE_COMMENTS" => "N",
		"DETAIL_BRAND_USE" => "N",
		"COMPARE_SCROLL_UP" => "N",
		"SHOW_DESCRIPTION_AFTER_SECTION" => "N",
		"FILTER_VIEW_MODE" => "VERTICAL",
		"TOP_VIEW_MODE" => "SECTION",
		"SECTIONS_VIEW_MODE" => "LIST",
		"SECTIONS_SHOW_PARENT_NAME" => "Y",
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_DETAIL_PICTURE_MODE" => "POPUP",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"SEF_FOLDER" => "/catalog/",
		"AJAX_OPTION_ADDITIONAL" => "",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"SHOW_REQUEST_BUTTON" => "Y",
		"REQUEST_BUTTON_ACTION" => "js",
		"REQUEST_BUTTON_JS_CLASS" => "open-answer-form",
		"REQUEST_BUTTON_TITLE" => "Купить",
		"COMPONENT_TEMPLATE" => "corporate",
		"REQUEST_BUTTON_LINK" => "",
		"REQUEST_BUTTON_TARGET" => "_self",
		"SECTIONS_HIDE_SECTION_NAME" => "N",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE_PATH#/",
			"element" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
			"compare" => "compare.php?action=#ACTION_CODE#",
		),
		"VARIABLE_ALIASES" => array(
			"compare" => array(
				"ACTION_CODE" => "action",
			),
		)
	),
	false
);

// Вся логика footer.php
$curDir = $APPLICATION->GetCurDir();

$arParseUrl = array_unique(explode("/", $curDir)); // Удаляем повторения
$arParseUrl = array_diff($arParseUrl, array(''));  // Удаляем пустые строки

$fileName = str_replace("/", "_", trim($curDir));

if (file_exists($_SERVER["DOCUMENT_ROOT"]."/include/footer_seo_text/".$fileName.".title.php")) {
	$fileExists = true;
} else {
	$fileExists = false;
}
$num = intval($_GET['PAGEN_1']);

if(isset($_GET['PAGEN_1']) && $num >= 2){
	$noIndex = true;
}

echo $fileExists ? '<header>' : '';
echo $noIndex && $fileExists ? '<!--noindex-->' : '';

$APPLICATION->IncludeComponent("bitrix:main.include", "",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => "/include/footer_seo_text/".$fileName.".title.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);

echo $noIndex && $fileExists ? '<!--/noindex-->' : '';
echo $fileExists ? '</header>' : '';
echo $fileExists ? '<div class="text">' : '';
echo $noIndex && $fileExists ? '<!--noindex-->' : '';

$APPLICATION->IncludeComponent("bitrix:main.include", "",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => "/include/footer_seo_text/".$fileName.".php",
		"EDIT_TEMPLATE" => ""
	),
	false
);

echo $noIndex && $fileExists ? '<!--/noindex-->' : '';
echo $fileExists ? '</div>' : '';

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>