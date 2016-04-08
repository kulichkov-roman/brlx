<?
AddEventHandler("main", "OnEpilog", "Redirect404", 1);

function Redirect404() {
	if(defined('ERROR_404') && ERROR_404=='Y' || CHTTP::GetLastStatus() == "404 Not Found"){
		GLOBAL $APPLICATION;
		$APPLICATION->RestartBuffer();
		require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php';
		require $_SERVER['DOCUMENT_ROOT'].'/404.php';
		require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php';
	}
}

?>