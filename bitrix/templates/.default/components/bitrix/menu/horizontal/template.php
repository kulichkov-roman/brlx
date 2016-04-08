<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>

<?
if(!function_exists('buildTree')){
	function buildTree(array $dataset)
	{
		$tree = array();
		/* Most datasets in the wild are enumerative arrays and we need associative array
		where the same ID used for addressing parents is used. We make associative
		array on the fly */
		$references = array();
		foreach($dataset as $id => & $node)
		{
			// Add the node to our associative array using it's ID as key
			$references[$node['ID']] = & $node;
			// Add empty placeholder for children
			$node['CHILDREN'] = array();
			// It it's a root node, we add it directly to the tree
			if (is_null($node['PARENT_ID']))
			{
				$tree[$node['ID']] = & $node;
			}
			else
			{
				// It was not a root node, add this node as a reference in the parent.
				$references[$node['PARENT_ID']]['CHILDREN'][$node['ID']] = & $node;
			}
		}
		return $tree;
	}
}
$arParentIds = array();
foreach($arResult as $key => $arItem){
	$arItem["ID"] = $key;
	if($arItem["IS_PARENT"]){
		$arParentIds[$arItem["DEPTH_LEVEL"]] = $key;
	}
	if($arItem["DEPTH_LEVEL"]>1){
		$arItem["PARENT_ID"] = $arParentIds[$arItem["DEPTH_LEVEL"] - 1];
	}
	$arResult[$key] = $arItem;
}
$arTreeResult = buildTree($arResult);
?>
<?if (!empty($arTreeResult)){?>
	<??>
	<ul class="flex-menu top-menu hidden-sm hidden-xs">
		<?
		$index = 0;
		foreach($arTreeResult as $key => $arItem){?>
			<li class="<?=$index == 0 ? 'first selected' : '';?><?=$arItem["CHILDREN"] ? 'main-menu__item_has_submenu': '';?>">
				<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
				<?if($arItem["CHILDREN"]){?>
					<div class="main-menu__submenu">
						<ul class="main-menu__list main-menu__list_level_1">
							<?foreach($arItem["CHILDREN"] as $arChildrenChunkDL1){?>
								<li class="main-menu__item <?=$arChildrenChunkDL1["CHILDREN"] ? 'main-menu__item_has_submenu' : '';?>">
									<a href="<?=$arChildrenChunkDL1["LINK"]?>" class="main-menu__link"><?=$arChildrenChunkDL1['TEXT']?></a>
									<?if($arChildrenChunkDL1["CHILDREN"]){?>
										<ul class="main-menu__list main-menu__list_level_2">
											<?foreach($arChildrenChunkDL1["CHILDREN"] as $arChildrenChunkDL2){?>
												<li class="main-menu__item">
                                                       <a href="<?=$arChildrenChunkDL2['LINK']?>" class="main-menu__link"><?=$arChildrenChunkDL2['TEXT']?></a>
                                                   </li>
											<?}?>
										</ul>
									<?}?>
								</li>
							<?}?>
						</ul>
					</div>
				<?}?>
			</li>
			<?
			$index++;
		}
		?>
		<li class="other last" id="flex-menu-li">
               &nbsp;
           </li>
           <div class="clearfix"></div>
	</ul>
<?}?>
