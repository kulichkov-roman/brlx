<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$formId = intval($_REQUEST["FORM_ID"]);
$params = unserialize($_SESSION["ALEXKOVA.CORPORATE"]["FORMS_PARAM"][$formId]);
if(!$_REQUEST["strIMessage"] && (!$formId || !is_array($params) || empty($params)))
	die("Error form id");
$params["AJAX"] = 'Y';
$params["FIRST"] = htmlspecialcharsbx($_REQUEST["first"]);
if ($_REQUEST["TARGET_URL"])
	$params["TARGET_URL"] = htmlspecialcharsbx($_REQUEST["TARGET_URL"]);
?>
<?$APPLICATION->IncludeComponent(
	"alexkova.corporate:iblock.element.add.form",
	"",
	$params,
	false
);?>