<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

define ('MP_MODULE_ID','alexkova.corporate');
define("PATH_TO_404", "/404.php");

IncludeTemplateLangFile(__FILE__);
if (!CModule::IncludeModule(MP_MODULE_ID)) return;

global $TopCompanySettings;
$TopCompanySettings = array(
	"top_banner_type" => "FIXED",
	"bottom_banner_type" => "FIXED",
	"column_banner_type" => "RESPONSIVE",
	"catalog_top_banner_type" => "FIXED",
	"catalog_bottom_banner_type" => "FIXED",
	"mobile_menu_text" => "TOP COMPANY",
	"column_type" => "TYPE_1"
);

foreach ($TopCompanySettings as $cell=>$val){
	$TopCompanySettings[$cell]  = COption::GetOptionString(MP_MODULE_ID, $cell, $val);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?$APPLICATION->ShowTitle('title',false);?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
                
		<?
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery-1.10.2.min.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/fancybox/jquery.fancybox.pack.js');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/js/fancybox/jquery.fancybox.css');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/slick/slick.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/bootstrap.min.js');

        $APPLICATION->SetAdditionalCSS('http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/bootstrap.min.css');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/bootstrap-theme.min.css');

        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/js/slick/slick.css', true);
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/colors/color_redstone.css', true);
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/responsive.css', true);
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/animate.css', true);
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.themepunch.plugins.min.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.themepunch.revolution.min.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/wow.min.js');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/addon/nocorns.css', true);

		$APPLICATION->ShowHead();
		?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61679636-1', 'auto');
  ga('send', 'pageview');

</script>
	</head>
	<body>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>

<?$APPLICATION->IncludeComponent(
	"alexkova.corporate:block.header", 
	".default", 
	array(
		"DISPLAY_VARIANT" => "version_v1",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"DISPLAY_MOBILE_TITLE" => "TOP COMPANY",
		"DARK_MODE" => "#FFFFFF",
		"DARK_MODE_TRANSPARENT" => "100",
		"DARK_MODE_DEACTIVATE" => "N",
		"DARK_MODE_INVERSION" => "N",
		"ALL_DISPLAY_VARIANT" => "version_v1",
		"ALL_DARK_MODE" => "#000000",
		"ALL_DARK_MODE_TRANSPARENT" => "80",
		"ALL_DARK_MODE_INVERSION" => "Y",
		"FULL_SCREEN_MODE" => "Y",
		"ALL_FULL_SCREEN_MODE" => "N",
		"DISPLAY_HEAD_VARIANT" => "version_v1",
		"DISPLAY_MENU_VARIANT" => "menu_version_v1",
		"ALL_DISPLAY_HEAD_VARIANT" => "version_v1",
		"ALL_DISPLAY_MENU_VARIANT" => "menu_version_v1",
		"SLIDER_WITHOUT_HEADER" => "Y",
		"SLIDER_FULLSCREEN" => "N",
		"SHOW_AUTHORIZE" => "Y",
		"DISPLAY_HEAD_TEMPLATE" => "N",
		"ALL_DISPLAY_HEAD_TEMPLATE" => "N",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "4",
		"VISUAL_STYLE" => "modern_card_vertical",
		"ADD_ELEMENT_CLASS" => "Y",
		"LG_CNT" => "3",
		"MD_CNT" => "4",
		"SM_CNT" => "6",
		"XS_CNT" => "12",
		"SLIDER" => "Y",
		"VERTICAL_SLIDER_MODE" => "N",
		"ELEMENTDRAW_LINK_ALL_BLOCK" => "N",
		"NEWS_COUNT" => "6",
		"HEAD_THEME" => "white_fullscreen",
		"ALL_HEAD_THEME" => "white_fullscreen",
		"ELEMENTDRAW_TYPE_CARD" => "dark",
		"ELEMENTDRAW_TYPE_IMG" => "glyph",
		"ELEMENTDRAW_IMAGE_BORDER" => "img-none",
		"ELEMENTDRAW_IMAGE_SIZE_HEIGHT" => "70",
		"ELEMENTDRAW_IMAGE_MAX_WIDTH" => "40",
		"ELEMENTDRAW_CARD_ALIGN" => "center",
		"ELEMENTDRAW_CARD_BORDER" => "Y",
		"ELEMENTDRAW_GLYPH_EXTENTED_GLYPH_CLASS" => "glyphicon-file",
		"ELEMENTDRAW_GLYPH_EXTENTED_GLYPH_TYPE" => "glyph-transparent",
		"ELEMENTDRAW_GLYPH_EXTENTED_BORDER_COLOR" => "glyph-border-dark",
		"ELEMENTDRAW_GLYPH_EXTENTED_GLYPH_BORDER_COLOR" => "glyph-border-white ",
		"ELEMENTDRAW_SHOW_DESCRIPTION" => "Y",
		"ELEMENTDRAW_GLYPH_GLYPH_FONT_SIZE" => "127",
		"ELEMENTDRAW_IMAGE_SIZE_WIDTH" => "40",
		"SHOW_ELEMENT_URL" => "N",
		"SHOW_ELEMENT_URL_TITLE" => "",
		"ELEMENTDRAW_SHOW_ELEMENT_BUTTONS" => "N",
		"ELEMENTDRAW_IMAGE_COLOR" => "image-white",
		"ELEMENTDRAW_BORDER_COLOR" => "border-transparent",
		"ELEMENTDRAW_HIDE_LINKS" => "N",
		"ELEMENTDRAW_FANCYBOX_TYPE" => "N",
		"ELEMENTDRAW_LINE" => "Y",
		"ELEMENTDRAW_LINK_TITLE" => "",
		"ELEMENTDRAW_START_DATE" => "",
		"ELEMENTDRAW_FINISH_DATE" => "",
		"ELEMENTDRAW_SHOW_NAME" => "show-name-part",
		"ELEMENTDRAW_GLYPH_EXTENTED_FONT_SIZE" => "127",
		"ELEMENTDRAW_ACTION_TYPE" => "Y",
		"AUTORESIZE_CART" => "Y",
		"HIDE_SLIDER_ARROWS" => "Y",
		"HIDE_MOBILE_SLIDER_ARROWS" => "N",
		"IBLOCK_SLIDER_TYPE" => "content",
		"IBLOCK_SLIDER_ID" => "3",
		"COMPONENT_TEMPLATE" => ".default",
		"NOT_SHOW_SLIDER" => "N",
		"TYPE_SLIDER" => "revolution",
		"NOT_SHOW_IBLOCK" => "N",
		"ELEMENTDRAW_SHOW_ELEMENT_URL" => "N",
		"SLIDER_SPEED" => "1500",
		"SLIDER_AUTOPLAY" => "N",
		"SLIDER_AUTOPLAY_SPEED" => "3000",
		"SLIDER_NAVIGATION_BUTTONS" => "N",
		"SLIDER_FADE" => "N",
		"SLIDER_HEIGHT" => ""
	),
	false
);?>

<?$mainPage = str_replace("//","/", SITE_DIR.'/index.php');?>
<div class="dcontainer <?=$addContentClass?>">
<div class="container content">
    <div class="row">
		<?if ($APPLICATION->GetCurPage(true) == $mainPage):?>
			<div class="col-lg-12">
		<?else:?>
	<?
	$constMain = 'pull-right';
	if (isset($TopCompanySettings['column_type']) && $TopCompanySettings['column_type']!='TYPE_2')
		$constMain = 'pull-right';
	else
		$constMain = 'pull-left';
	?>
	<div class="col-lg-12">
	<?/*?><div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 <?=$constMain?>"><?*/?>

	<?

	?>

	<h1><?$APPLICATION->ShowTitle('h1', false);?></h1>
		<?endif;?>

<?if ($APPLICATION->GetCurPage(true) != $mainPage):?>
	<?
				$BannerTemplate = 'full-static';
				$BannerActive = "Y";
				$element_type = $TopCompanySettings["catalog_top_banner_type"];
				if ($element_type == "DISABLE") $BannerActive = "N";
				if ($element_type == "RESPONSIVE") $BannerTemplate = "full-responsive";

				?>
				<?$APPLICATION->IncludeComponent("alexkova.corporate:abmanager", "={$BannerTemplate}", array(
		"SHOW" => "CATALOG_TOP",
		"BANTYPE" => "CATALOG_TOP",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "0",
		"USE_IN_LG_MODE" => "Y",
		"USE_IN_MD_MODE" => "Y",
		"USE_IN_SM_MODE" => "Y",
		"USE_IN_XS_MODE" => "N"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?><?endif;?>