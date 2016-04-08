<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$eventClass = $arParams["EVENT_CLASS"]?$arParams["EVENT_CLASS"]:'';
?>
<?if($arParams["BUTTON_TEXT"]):?>
	<a class="<?=$eventClass?>" href="javascript:void (0);"><?=$arParams["BUTTON_TEXT"]?></a>
<?endif;?>
<?
ob_start();
?>
<script>
	BX.ready(function(){
		window.Corporate.openForm = function (params) {
			var formId = parseInt(params.id);
			if(!formId)
				return false;
			if(!BX('ajaxFormContainer_' + formId))
				document.body.appendChild(BX.create('div', {props:{
					id: 'ajaxFormContainer_' + formId,
					className: 'ajax-form-container'
				}}));
			var w = parseInt(params.width);
			var h = parseInt(params.height);
			if(!w) w = 600;
			if(!h) h = 400;
			var popupParams =  {
				autoHide: false,
				offsetLeft: 0,
				offsetTop: 0,
				overlay : true,
				draggable: {restrict:true},
				closeByEsc: true,
				closeIcon: { right : "12px", top : "8px"},
				content: BX('ajaxFormContainer_'+formId),
				events: {
					onPopupClose : function(popupWindow){
						popupWindow.destroy();
						window.Corporate.activePopup = null;
					}
				}
			};
			if(params.title)
				popupParams.titleBar = {content: BX.create("span", {html: "<div>"+params.title+"</div>"})};
			window.Corporate.showAjaxShadow('body',"iblockFormContainerShadow" + formId);

			BX.ajax({
				url:'<?=$this->__component->getPath()?>/ajax/form.php',
				data: {FORM_ID: formId, first: 'Y', TARGET_URL: '<?=$GLOBALS["APPLICATION"]->GetCurPage();?>'},
				method: 'POST',
				async: true,
				onsuccess: function(data){
					window.Corporate.closeAjaxShadow("iblockFormContainerShadow" + formId);
					BX('ajaxFormContainer_' + formId).innerHTML = data;
					var formPopup = BX.PopupWindowManager.create("formPopup"+formId, null, popupParams);
					formPopup.show();
					window.Corporate.activePopup = formPopup;
				}
			});

		};
		window.Corporate.showFormSuccess = function(formId, data){
			this.activePopup.close();
			var successPopup = BX.PopupWindowManager.create("popupSuccess"+formId, null, {
				autoHide: true,
				offsetLeft: 0,
				offsetTop: 0,
				overlay : true,
				draggable: {restrict:true},
				closeByEsc: true,
				closeIcon: { right : "12px", top : "8px"},
				content: '<div class="popup-success">' + data.substr(7) + '</div>'
			});
			setTimeout(function(){successPopup.show()}, 100);
		};

		window.Corporate.formRefresh = function (formId) {
			window.Corporate.showAjaxShadow("#ajaxFormContainer_" + formId,"ajaxFormContainerShadow" + formId);
			BX.ajax.submit(BX("iblockForm" + formId),function(data){
				window.Corporate.closeAjaxShadow("ajaxFormContainerShadow" + formId);
				data = data.replace(/<div[^>]+>/gi, '');//strip_tags
				data.substr(0,7);
				if(data.substr(0,7) === 'success')
				{
					window.Corporate.showFormSuccess(formId,data)
					return false;
				}
				BX('ajaxFormContainer_' + formId).innerHTML = data;
			});
			return false;
		};
//		window.Corporate.getFormPopupButtons = function (formId) {
//			return [
//				new BX.PopupWindowButton({
//					text: "<?//=GetMessage('IBLOCK_FORM_SUBMIT')?>//" ,
//					className: "popup-window-button-accept"
//				}),
//				new BX.PopupWindowButton({
//					text: "<?//=GetMessage('IBLOCK_FORM_CLOSE')?>//" ,
//					className: "webform-button-link-cancel" ,
//					events: {click: function(){
//						this.popupWindow.close();
//					}}
//				})
//			];
//		};
	});
</script>
<?
$GLOBALS["APPLICATION"]->AddHeadString(ob_get_clean(),true);
ob_start();
?>
<script>
	BX.ready(function () {
		BX.bindDelegate(
			document.body, 'click', {className:'<?=$eventClass?>'},
			function(e){
				if(!e) e = window.event;
				window.Corporate.openForm({
					title: '<?=$arParams["POPUP_TITLE"]?>',
					id: '<?=$arParams["IBLOCK_ID"]?>'
				});
				return BX.PreventDefault(e);
			}
		);
	})
</script>
<?
$GLOBALS["APPLICATION"]->AddHeadString(ob_get_clean(),true);
