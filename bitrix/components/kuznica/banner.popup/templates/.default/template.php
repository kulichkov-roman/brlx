<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!$arResult["BANNERS"]) return false;?>

<?foreach($arResult["BANNERS"] as $banner):?>
	<div style="display: none;" class="kznc-popupad-fancybox-banner" id="kznc-popupad-fancybox-banner<?=$banner["ID"]?>">
		<?=$banner["HTML"]?>
	</div>
	<?break;?>
<?endforeach;?>
<script type="text/javascript">
	var protectTime = parseInt(<?=$arResult['OPTIONS']['PROTECT_TIME']?>);
	var delayTime = parseInt(<?=$arResult['OPTIONS']['DELAY']?>);
	var kzncPopup = {
		showBanner: function(banner){
			var bannerDelay = parseInt(banner.INFO.SHOW_TIMER);
			var delayTimeFinal = delayTime;
			if(bannerDelay)
				delayTimeFinal = bannerDelay;
			setTimeout(function(){
					kzncPopup.open(banner.ID);
					//protect
					if (protectTime){
						kzncPopup.setCookie('KZNC_PROTECT_BANER_SHOW_TIME','1',{expires: protectTime,path:'/'});
					}
					var bannerProtectTime = parseInt(banner.INFO.SHOW_PER_TIME);
					if(bannerProtectTime)
						kzncPopup.setCookie('KZNC_BANER_ID_SHOWN_' + banner.ID,
							'1',{expires: bannerProtectTime,path:'/'});
				},
				delayTimeFinal*1000
			);
		},
		open: function(id){
			var showBanner = $('#kznc-popupad-fancybox-banner' + id);
			$.fancybox.open(showBanner.html(),{
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
		<?
		$banner = $arResult["BANNERS"][0];
		$banner["INFO"] = unserialize($banner["~INFO"]);
		?>
		kzncPopup.showBanner(<?= CUtil::PhpToJSObject($banner);?>);
	});
</script>
