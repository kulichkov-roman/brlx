<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["ITEMS"] as &$val){
	if (is_array($val["PREVIEW_PICTURE"])){
		$tmb = CFile::ResizeImageGet($val["PREVIEW_PICTURE"]["ID"], array('width'=>100, 'height'=>100));
		$val["PICTURE"] = $tmb["src"];
	}elseif (!is_array($val["PREVIEW_PICTURE"]) && is_array($val["DETAIL_PICTURE"])){
		$tmb = CFile::ResizeImageGet($val["DETAIL_PICTURE"]["ID"], array('width'=>100, 'height'=>100));
		$val["PICTURE"] = $tmb["src"];
	}
}



?>