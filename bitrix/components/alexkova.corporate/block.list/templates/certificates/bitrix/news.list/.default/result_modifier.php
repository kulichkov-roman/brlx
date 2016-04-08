<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["ITEMS"] as &$val){
	if (is_array($val["PREVIEW_PICTURE"])){
		$tmb = CFile::ResizeImageGet($val["PREVIEW_PICTURE"]["ID"], array('width'=>200, 'height'=>200));
		$val["PICTURE"] = $tmb["src"];
	}elseif (!is_array($val["PREVIEW_PICTURE"]) && is_array($val["DETAIL_PICTURE"])){
		$tmb = CFile::ResizeImageGet($val["DETAIL_PICTURE"]["ID"], array('width'=>200, 'height'=>200));
		$val["PICTURE"] = $tmb["src"];
	}
        
        if (is_array($val["DETAIL_PICTURE"])){
		$val["ORIGINAL_PICTURE"] = $val["DETAIL_PICTURE"]['SRC'];
	}elseif (is_array($val["PREVIEW_PICTURE"])){
		$val["ORIGINAL_PICTURE"] = $val["PREVIEW_PICTURE"]['SRC'];
	}
}

$arResult["COUNT_ELS"] = count($arResult["ITEMS"]);

$this->__component->arResultCacheKeys[] = "COUNT_ELS";

?>