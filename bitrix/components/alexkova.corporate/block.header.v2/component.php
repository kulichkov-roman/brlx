<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$module_id = 'alexkova.corporate';
if (!CModule::IncludeModule($module_id)) return ;
$arResult = array();

$pageTemplate = 'version_v1';

if (strlen(trim($pageTemplate))>0){
    $this->IncludeComponentTemplate($pageTemplate);
}
?>