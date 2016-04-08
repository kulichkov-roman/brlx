<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arParams["SLIDER"] == "Y") {?>
<div class="slider-carousel">
<?}?>
<?
    

    foreach ($arResult["SECTIONS"] as $cell => $arSection):?>
    <?
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    

        <div class="col-lg-4 col-md-4">
        <?

		$template = "glyph_links";

		$elementParams = array(
			"TYPE_CARD" => "white",
			"TYPE_IMG" => "image",
			"SHOW_DESCRIPTION" => "Y",
			"IMAGE_BORDER" => "img-square",
			"IMAGE_SIZE_HEIGHT" => "100",
			"IMAGE_MAX_WIDTH" => "50",
			"CARD_ALIGN" => "center",
			"CARD_BORDER" => "Y",
			"SHOW_ELEMENT_BUTTONS" => "N",
			"GLYPH"=>array("GLYPH_CLASS" => "glyphicon-download"),
			"SLIDER" => "N",
			"VERTICAL_SLIDER_MODE" => "N",

			"NAME" => $arSection["NAME"],
			"IMAGE" => $arSection["PICTURE"]["SRC"],
			"TEXT" => $arSection["DESCRIPTION"],
			"LINK" => $arSection["SECTION_PAGE_URL"]
		);



        $arElementDrawParams = array(
            "DISPLAY_VARIANT" => $template,
            "ELEMENT" => $elementParams,
            "LINK_ALL_BLOCK" => $arParams["LINK_ALL_BLOCK"],
        );
        if ($arParams["ADD_ELEMENT_CLASS"] == "Y" && $arSection["PROPERTIES"]["ADD_CLASS"]["VALUE"] != "")
            $arElementDrawParams["CLASS_NAME"] = $arSection["PROPERTIES"]["ADD_CLASS"]["VALUE"];
        ?>
            <?
            $APPLICATION->IncludeComponent(
                    "alexkova.corporate:element.draw",
                    ".default",
                    $arElementDrawParams,
                    false,
                    array("HIDE_ICONS"=>"Y")
                    );
            ?>
        </div>

<? endforeach; ?>
