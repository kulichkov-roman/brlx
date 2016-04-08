<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>
<ul class="container full-width catalog-index">
	<?
	foreach ($arResult['SECTIONS'] as &$arSection)
	{
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

	if ($intCurrentDepth < $arSection['RELATIVE_DEPTH_LEVEL'])
	{
		if (0 < $intCurrentDepth)
			echo "\n",str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']),'<ul>';
	}
	elseif ($intCurrentDepth == $arSection['RELATIVE_DEPTH_LEVEL'])
	{
		if (!$boolFirst)
			echo '</li>';
	}
	else
	{
		while ($intCurrentDepth > $arSection['RELATIVE_DEPTH_LEVEL'])
		{
			$addTxt = "";
			if ($intCurrentDepth == 2){$addTxt = "</div><div class='clear'></div>";}
			echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>'.$addTxt,"\n",str_repeat("\t", $intCurrentDepth-1);
			$intCurrentDepth--;
		}
		echo str_repeat("\t", $intCurrentDepth-1),'</li>';
	}

	echo (!$boolFirst ? "\n" : ''),str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']);
	$addClass = '';
	if ($arSection['DEPTH_LEVEL'] == 1){
		$addClass = "col-lg-6 col-md-6 col-sm-12 col-xs-12 catalog-cart wow fadeIn";
	}

	?><li class="<?=$addClass?>" id="<?=$this->GetEditAreaId($arSection['ID']);?>">

		<?if ($arSection['DEPTH_LEVEL'] == 1):?>
		<div class="catalog-image">
			<?
			$img = SITE_TEMPLATE_PATH.'/images/no-image.png';

			if (is_array($arSection["PICTURE"])){
				$img = \Alexkova\Corporate\Catalog\Image::getResizeImage($arSection["PICTURE"]["ID"], 140);
			}
			?>
			<img src="<?=$img?>"></div><div class="catalog-content">

			<?endif;?>


			<a href="<? echo $arSection["SECTION_PAGE_URL"]; ?>">

				<? echo $arSection["NAME"];?><?
				if ($arParams["COUNT_ELEMENTS"])
				{
					?> <span>(<? echo $arSection["ELEMENT_CNT"]; ?>)</span><?
				}
				?></a>

			<?if ($arSection['DEPTH_LEVEL'] == 1 && strlen($arSection["DESCRIPTION"])>0):?>
				<div class="catalog-section-description">
					<?=$arSection["DESCRIPTION"]?>
				</div><br />
			<?endif;?>

			<?

			$intCurrentDepth = $arSection['RELATIVE_DEPTH_LEVEL'];
			$boolFirst = false;
			}

			while ($intCurrentDepth > 1)
			{
				echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
				$intCurrentDepth--;
			}
			if ($intCurrentDepth > 0)
			{
				echo '</div></li>',"\n";
			}
			?>
</ul>

