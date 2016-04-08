<? IncludeTemplateLangFile(__FILE__);
global $TopCompanySettings;
?>
<?if ($APPLICATION->GetCurPage(true) != $mainPage):?>
<?
$BannerTemplate = 'full-static';
$BannerActive = "Y";
$element_type = $TopCompanySettings["catalog_bottom_banner_type"];
if ($element_type == "DISABLE") $BannerActive = "N";
if ($element_type == "RESPONSIVE") $BannerTemplate = "full-responsive";
?>
<?$APPLICATION->IncludeComponent("alexkova.corporate:abmanager", $BannerTemplate, array(
		"SHOW" => "CATALOG_BOTTOM",
		"BANTYPE" => "CATALOG_BOTTOM",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "0",
		"USE_IN_LG_MODE" => "Y",
		"USE_IN_MD_MODE" => "Y",
		"USE_IN_SM_MODE" => "Y",
		"USE_IN_XS_MODE" => "N"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => $BannerActive
	)
);?><?endif;?>

		</div>



<?if ($APPLICATION->GetCurPage(true) != $mainPage):?>

		<div class="col-lg-3 col-md-3 hidden-sm hidden-xs pull-left column">
			<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"vertical_multilevel_accordion", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "4",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>




			<?$APPLICATION->IncludeComponent(
				"alexkova.corporate:buffer.content",
				"",
				array(
					"BUFFER_NAME" => "base_left_column",
					"ELEMENT" => array(
						"IMAGE" => "base_left_column",
					)
				),
				false
			);?>

			<?
			$BannerTemplate = 'full-static';
			$BannerActive = "Y";
			$element_type = $TopCompanySettings["column_banner_type"];
			if ($element_type == "DISABLE") $BannerActive = "N";
			if ($element_type == "RESPONSIVE") $BannerTemplate = "full-responsive";
			?>
			<?$APPLICATION->IncludeComponent("alexkova.corporate:abmanager", "={$BannerTemplate}", array(
	"SHOW" => "COLUMN",
		"BANTYPE" => "COLUMN",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "0",
		"USE_IN_LG_MODE" => "Y",
		"USE_IN_MD_MODE" => "Y",
		"USE_IN_SM_MODE" => "Y",
		"USE_IN_XS_MODE" => "N"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?>

			<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/left_col_content.php"
					)
			);?>
		</div>
<?endif;?>

    </div>
</div>

<?
$BannerTemplate = 'full-static';
$BannerActive = "Y";
$element_type = $TopCompanySettings["bottom_banner_type"];
if ($element_type == "DISABLE") $BannerActive = "N";
if ($element_type == "RESPONSIVE") $BannerTemplate = "full-responsive";
?>
<?$APPLICATION->IncludeComponent("alexkova.corporate:abmanager", $BannerTemplate, array(
		"SHOW" => "BOTTOM",
		"BANTYPE" => "BOTTOM",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "0",
		"USE_IN_LG_MODE" => "Y",
		"USE_IN_MD_MODE" => "Y",
		"USE_IN_SM_MODE" => "Y",
		"USE_IN_XS_MODE" => "N"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => $BannerActive
	)
);?>



<?$APPLICATION->IncludeComponent(
"alexkova.corporate:element.draw",
".default",
array(),
false
)?>


<footer>
    <div class='container link_color_dark'>
        <div class='row'>
            
                <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"footer_menu_list", 
	array(
		"IBLOCK_TYPE" => "content",
		"IBLOCKS" => array(
			0 => "#CONTENT_FOOTERLINKS_IBLOCK_ID#",
		),
		"NEWS_COUNT" => "30",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300",
		"CACHE_GROUPS" => "Y",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"IBLOCK_ID" => "9",
		"FILTER_NAME" => "",
		"PROPERTY_CODE" => array(
			0 => "LINK_URL",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_FILTER" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "News",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "footer_menu_list",
		"SET_LAST_MODIFIED" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
            <div class='col-lg-3 col-md-3 col-sm-12 col-xs-12'>
                <?$APPLICATION->IncludeComponent(
                        "bitrix:menu", 
                        "footer_menu", 
                        array(
                            "ROOT_MENU_TYPE" => "bottom",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array(
                            ),
                            "MAX_LEVEL" => "1",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left"
                        ),
                        false
                );?>
            </div>
            <div class='col-lg-3 col-md-3 col-sm-12 col-xs-12 footer-info'>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/footer_content.php"
                    )
                );?>

				<br />
				<?/*$APPLICATION->IncludeComponent(
	"bitrix:main.share", 
	"template1", 
	array(
		"HIDE" => "Y",
		"HANDLERS" => array(
			0 => "twitter",
			1 => "vk",
			2 => "facebook",
		),
		"PAGE_URL" => $APPLICATION->GetCurUri(),
		"PAGE_TITLE" => $APPLICATION->GetTitle(),
		"SHORTEN_URL_LOGIN" => "",
		"SHORTEN_URL_KEY" => "",
		"COMPONENT_TEMPLATE" => "template1"
	),
	false
);*/?>


            </div>
            
        </div>
    </div>
</footer>



<?$formFrame = new \Bitrix\Main\Page\FrameHelper("iblock_form");
$formFrame->begin();?>
<?$APPLICATION->IncludeComponent(
	"alexkova.corporate:form.iblock", 
	".default", 
	array(
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "17",
		"STATUS_NEW" => "NEW",
		"USE_CAPTCHA" => "Y",
		"USER_MESSAGE_ADD" => GetMessage('FORM_ANSWER_RESULT'),
		"RESIZE_IMAGES" => "N",
		"MODE" => "link",
		"PROPERTY_CODES" => array(
			0 => "NAME",
			1 => "78",
			2 => "79",
			3 => "80",
		),
		"NAME_FROM_PROPERTY" => "#PROPERTY_NAME#",
		"GROUPS" => array(
			0 => "2",
		),
		"MAX_FILE_SIZE" => "0",
		"EVENT_CLASS" => "open-answer-form",
		"BUTTON_TEXT" => "",
		"POPUP_TITLE" => GetMessage('SEND_MESSAGE'),
		"SEND_EVENT" => "KZNC_NEW_FORM_RESULT"
	),
	false
);?>
<?$formFrame->beginStub();
echo " ";
$formFrame->end();?>

<?$formFrame = new \Bitrix\Main\Page\FrameHelper("iblock_form_phone");
$formFrame->begin();?>
<?$APPLICATION->IncludeComponent(
	"alexkova.corporate:form.iblock", 
	".default", 
	array(
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "#FORMS_PHONE_IBLOCK_ID#",
		"STATUS_NEW" => "NEW",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_ADD" => GetMessage("FORM_ANSWER_RESULT"),
		"RESIZE_IMAGES" => "N",
		"MODE" => "link",
		"PROPERTY_CODES" => array(
			0 => "#PROPERTY_P_NAME#",
			1 => "#PROPERTY_P_PHONE#",
			2 => "#PROPERTY_P_COMMENT#",
		),
		"NAME_FROM_PROPERTY" => "#PROPERTY_P_PHONE#",
		"GROUPS" => array(
			0 => "2",
		),
		"MAX_FILE_SIZE" => "0",
		"EVENT_CLASS" => "open-answer-form-phone",
		"BUTTON_TEXT" => "",
		"POPUP_TITLE" => GetMessage("SEND_MESSAGE_PHONE"),
		"SEND_EVENT" => "KZNC_NEW_FORM_PHONE_RESULT"
	),
	false
);?>
<?$formFrame->beginStub();
echo " ";
$formFrame->end();?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter28597036 = new Ya.Metrika({id:28597036,
                    webvisor:true,
                    clickmap:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/28597036" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<script type="text/javascript" src="//cdn.callbackhunter.com/cbh.js?hunter_code=1dc1cb3bda7f6940c21f7e6a3aec30a6" charset="UTF-8"></script>
</body>


</html>