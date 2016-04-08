<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!$arResult["BANNERS"]) return false;?>
	<?foreach($arResult["BANNERS"] as $banner):?>
		<div style="display: none;" class="kznc-popupad-fancybox-banner" id="kznc-popupad-fancybox-banner<?=$banner["ID"]?>">
			<?=$banner["HTML"]?>
		</div>
	<?endforeach;?>
<script type="text/javascript">
	var kzncPopup = {
		protectTime: parseInt(<?=$arResult['OPTIONS']['PROTECT_TIME']?>),
		delayTime: parseInt(<?=$arResult['OPTIONS']['DELAY']?>),
		banners: [],
		showBanners: function() {
			for(var key in this.banners) {
				var banner = this.banners[key];
				this.showBanner(banner);
			}
		},
		showBanner: function(banner){
			var bannerDelay = banner.INFO.SHOW_TIMER;
			var delayTimeFinal;
			if(bannerDelay)
				delayTimeFinal = parseInt(bannerDelay);
			else
				delayTimeFinal = this.delayTime;
			setTimeout(function(){
					if(banner.INFO.SHOW_TYPE == 'icon'){
						kzncPopup.showBannerIcon(banner);
					}else{
						kzncPopup.showBannerFancy(banner);
					}
				},
				delayTimeFinal*1000
			);
		},
		showBannerIcon: function(banner){
			var iconParent = $('body');
			if(banner.INFO.ICON_SHOW_IMAGE == "Y")
			{
				iconParent.append("" +
					"<div " +
						"id='kznc_popup_icon_"+banner.ID+"' " +
						"style='" + kzncPopup.getIconStyle(banner) + "'" +
					">" +
						"<img " +
							"onclick='kzncPopup.open(" +banner.ID+ ");return false;' " +
							"width='100%' " +
							"height='100%' " +
							"style='cursor: pointer;' " +
							"src='" + banner.INFO.ICON_FILE.SRC +"'" +
						" />" +
					"</div>");
			}
			else
			{
				var href = banner.URL;
					var target = '';
					var title = '';
					if(banner.INFO.TARGET)
						target = " target='" + banner.INFO.TARGET + "' ";
					if(banner.INFO.TITLE)
						title = " title='" + banner.INFO.TITLE + "' ";
					var bannerStr = "" +
						"<div " +
							"id='kznc_popup_icon_"+banner.ID+"' " +
							"style='" + kzncPopup.getIconStyle(banner) + "'" +
						">";
					if(href){
						bannerStr += "<a href='"+href+"' "+target+title+">";
					}
					bannerStr += "" +
						"<img " +
								"width='100%' " +
								"height='100%' " +
								"style='cursor: pointer;' " +
								"src='" + banner.INFO.ICON_FILE.SRC +"'" +
							" />";
					if(href){
						bannerStr += "</a>";
					}
					bannerStr += "</div>";
					iconParent.append(bannerStr);
			}

			$('#kznc_popup_icon_' + banner.ID).fadeIn(200);
			var bannerProtectTime = parseInt(banner.INFO.SHOW_PER_TIME);
			if(bannerProtectTime)
				kzncPopup.setCookie('KZNC_BANER_ID_SHOWN_' + banner.ID,
					'1',{expires: bannerProtectTime,path:'/'});
		},
		showBannerFancy: function(banner){
			kzncPopup.open(banner.ID);
			//protect
			if (this.protectTime){
				kzncPopup.setCookie('KZNC_PROTECT_BANER_SHOW_TIME','1',{expires: this.protectTime,path:'/'});
			}
			var bannerProtectTime = parseInt(banner.INFO.SHOW_PER_TIME);
			if(bannerProtectTime)
				kzncPopup.setCookie('KZNC_BANER_ID_SHOWN_' + banner.ID,
					'1',{expires: bannerProtectTime,path:'/'});
		},
		getIconStyle: function(banner){
			var place = banner.INFO.ICON_PLACE;
			var m1 = parseInt(banner.INFO.ICON_MARGIN1);
			var m2 = parseInt(banner.INFO.ICON_MARGIN2);
			var m1u = banner.INFO.ICON_MARGIN1_UNIT;
			var m2u = banner.INFO.ICON_MARGIN2_UNIT;
			if(!m1) m1 = 0;
			if(!m2) m2 = 0;
			if(!m1u || (m1u !='px' && m1u!='pc')) m1u = 'px';
			if(!m2u || (m2u !='px' && m2u!='pc')) m2u = 'px';
			if(m1u == 'pc') m1u = '%';
			if(m2u == 'pc') m2u = '%';
			if(!place) place = 'lt';

			var position;
			switch (place){
				case 'lt':
					position = "top:"+m1+m1u+"; left:"+m2+m2u+";";
					break;
				case 'lb':
					position = "bottom:"+m1+m1u+"; left:"+m2+m2u+";";
					break;
				case 'bl':
					position = "bottom:"+m2+m2u+"; left:"+m1+m1u+";";
					break;
				case 'br':
					position = "bottom:"+m2+m2u+"; right:"+m1+m1u+";";
					break;
				case 'rt':
					position = "top:"+m1+m1u+"; right:"+m2+m2u+";";
					break;
				case 'rb':
					position = "bottom:"+m1+m1u+"; right:"+m2+m2u+";";
					break;
			};
			var positionType = 'absolute';
			if(banner.INFO.ICON_FIXED == 'Y')
				positionType = 'fixed';
			var blockWidth = parseInt(banner.INFO.ICON_WIDTH);
			var blockHeight = parseInt(banner.INFO.ICON_HEIGHT);
			var blockZIndex = parseInt(banner.INFO.ICON_Z_INDEX);

			if(!blockZIndex)
				blockZIndex = '100';
			if(blockWidth)
				blockWidth = 'width:' + blockWidth + 'px;';
			else
				blockWidth = '';
			if(blockHeight)
				blockHeight = 'height:' + blockHeight + 'px;';
			else
				blockHeight = '';
			if(!blockWidth && !blockHeight){blockWidth = 'width:80px;'; blockHeight = 'height: 80px;';}

			return "display:none;z-index: " + blockZIndex + "; " + blockWidth + blockHeight + "position:"+positionType+"; " + position;
		},
		open: function(id){
			var showBanner = $('#kznc-popupad-fancybox-banner' + id);
			$.fancybox(showBanner.html(),{
				padding : 0,
				scrolling: 'no'
			});
		},
		getCookie: function (name) {
			var matches = document.cookie.match(new RegExp(
				"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
			));
			return matches ? decodeURIComponent(matches[1]) : undefined;
		},
		setCookie: function (name, value, options) {
			options = options || {};

			var expires = options.expires;

			if (typeof expires == "number" && expires) {
				var d = new Date();
				d.setTime(d.getTime() + expires*1000);
				expires = options.expires = d;
			}
			if (expires && expires.toUTCString) {
				options.expires = expires.toUTCString();
			}

			value = encodeURIComponent(value);

			var updatedCookie = name + "=" + value;

			for(var propName in options) {
				updatedCookie += "; " + propName;
				var propValue = options[propName];
				if (propValue !== true) {
					updatedCookie += "=" + propValue;
				}
			}

		document.cookie = updatedCookie;
	}


	};
	$(document).ready(function() {
		<?foreach($arResult["BANNERS"] as $banner):
			if($banner["INFO"]["SHOW_TYPE"] == "icon"){
				if(!$banner["INFO"]["ICON_FILE"])
					continue;
				else
					$banner["INFO"]["ICON_FILE"] = CFile::GetFileArray($banner["INFO"]["ICON_FILE"]);
			}
			?>
			kzncPopup.banners.push(<?= CUtil::PhpToJSObject($banner);?>);
		<?endforeach;?>
		kzncPopup.showBanners();
	});
</script>
