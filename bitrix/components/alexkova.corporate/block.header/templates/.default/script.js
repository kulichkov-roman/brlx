(function (window) {

    window.Corporate = {

        setDarkMode: function(color, inversion, fullscreen){

            if (color != 'false')
                $('.dcontainer.dark-light').each(function(){
                    if (!$(this).is('.light-transparent') && !$(this).is('.dark-transparent')){
                        $(this).css('background-color', color);
                    }
                });

            if (inversion == true) {
                    $('.dcontainer.dark-light, .container.slider-container, .container.slider-container-color').each(function(){
                        $('.dcontainer.dark-light, .container.slider-container, .container.slider-container-color').addClass('inversion');
                });
            }

            if (fullscreen == true) {

                $('.dcontainer, .container.slider-container, .container.slider-container-color').each(function(){
                    if (!$(this).is('.full-screen-block')){
                        $(this).addClass('full-screen');;
                    }
                });
            };

        },

        setAutoScroll: function(){
            $(document).on("click", ".jscroll", function () {
                var target = $(this).data('scroll');
                var pos = parseInt($(target).offset().top) - 50;
                $('html, body').animate({scrollTop: pos + 'px'}, 500);
                return false;
            });
        },

        setImageResponsive: function(){
            $('.element-detail img').addClass('img-responsive');
        },

        resizeSaleCards: function(){
            maxSize = 0;
            $('.sale-card').each(function(){
                if ($(this).height() > maxSize){
                    maxSize = $(this).height()
                }
            });
            $('.sale-card').each(function(){
                delta = maxSize-$(this).height();
//                $(this).children('.sale-card-price-line').height($(this).children('.sale-card-price-line').height()+delta);
            });
        },

        showAjaxShadow: function(element, idArea, localeShadow){

            if (localeShadow == true){
                $(element).addClass('ajax-shadow');
                $(element).addClass('ajax-shadow-r');
            }
            else{
                if ($('div').is('#'+idArea)){

                }
                else
                {
                    $('<div id="'+idArea+'" class="ajax-shadow"></div>').appendTo('body');
                }

                $('#'+idArea).show();
                $('#'+idArea).width($(element).width());
                $('#'+idArea).height($(element).height());
                $('#'+idArea).css('top', $(element).offset().top+'px');
                $('#'+idArea).css('left', $(element).offset().left+'px');
            }

        },

        closeAjaxShadow: function(idArea, localShadow){
            if (localShadow == true){
                $(idArea).removeClass('ajax-shadow-r');
                $(idArea).removeClass('ajax-shadow');
            }
            else{
                $('#'+idArea).hide();
            }
        },

        setPriceCents: function(){

            $('.emarket-format-price').each(function(){
                price = $(this).html();
                newPrice = price.replace(/(\.\d\d)/g, '<sup>$1</sup>');
                newPrice = newPrice.replace(/(\.)/g, '');
                $(this).html(newPrice);
            });
        },

        toggleContent: function(){
            $(document).on(
                'click',
                '.content-slide-button',
                function(){



                    parentItem = $(this).data('slide');

                    if ($(this).data('state') == "up"){
                        $(parentItem).data('oldheight', $(parentItem).css('height'));

                        $(parentItem).css('height', 'auto');
                        $(this).data('state', 'down');
                        $(this).html($(this).data('slideup'));
                    }else{

                        $(parentItem).css('height', $(parentItem).data('oldheight'));
                        $(this).data('state', 'up');
                        $(this).html($(this).data('slidedown'));

                    }

                }
            );
        },

        resizeRK: function(){
			// top banner
			rkWidth = $('.prm_top.rk-fullwidth .rk-fullwidth-canvas img').width();
			tWidth = $('.prm_top.rk-fullwidth').width();
			if (rkWidth>0 && rkWidth>tWidth){
                    rkWidth = Math.round((rkWidth-tWidth)/2);
                    $rkWidth = $('.prm_top.rk-fullwidth .rk-fullwidth-canvas').css('margin-left', '-'+rkWidth+'px');
			}
			
			rkWidth = $('.prm_bottom.rk-fullwidth .rk-fullwidth-canvas img').width();
			tWidth = $('.prm_bottom.rk-fullwidth').width();
			if (rkWidth>0 && rkWidth>tWidth){
                    rkWidth = Math.round((rkWidth-tWidth)/2);
                    $rkWidth = $('.prm_bottom.rk-fullwidth .rk-fullwidth-canvas').css('margin-left', '-'+rkWidth+'px');
			}
			
        },

        init: function(){
            window.Corporate.Menu.resize();
            window.Corporate.resizeSaleCards();
            window.Corporate.Menu.createMobileMenu();
            window.Corporate.setAutoScroll();
            window.Corporate.setImageResponsive();
            window.Corporate.resizeRK();
            //new WOW().init();

            $(window).resize(function() {
                window.Corporate.Menu.resize();
                window.Corporate.resizeSaleCards();
                window.Corporate.resizeRK();
            });

            $(document).on(
                'mouseover',
                'ul.flex-menu.compound > li',
                function() {
                    window.Corporate.Menu.resizeSubmenu($(this));
                });

            $(document).on(
                'mouseover',
                'ul.flex-menu.compound > li li',
                function() {
                    window.Corporate.Menu.resizeSubmenu($(this), true);
                });
        }
    };

    window.Corporate.Menu =  {

        flexButtonWidth: 50,

        resize: function(){

            $('ul.flex-menu').css('width', '100%');
            fullWidth = $('ul.flex-menu').width();
            
            var tWirth = window.outerWidth;            
            if(tWirth==0)
                tWirth =screen.width;

            if (tWirth<768 && $('ul.flex-menu').css('display') != 'none') {
                return;
            }

            $('ul.flex-menu>li').each(function(){
                $(this).css('display','block');
            });
            $('#flex-menu-li').css('display','none');


            maxWidth = $('ul.flex-menu').width()-window.Corporate.Menu.flexButtonWidth-30;

            allWidth = 0;
            flagFull = false;

            lastFull = false;


            $('ul.flex-menu > li > ul > li').each(function(){
                if ($(this).children( "ul").length>0){
                    $(this).children( "a").addClass('sub-item');
                }
            });


            $('ul.flex-menu>li>a').each(function(){

                lastFull = $(this);

                $(this).data('visible', 1);
                $(this).parent().data('visible', 1);

                if ($(this).is('#flex-menu-li')){
                    $(this).parent().css('width', window.Corporate.Menu.lastItemWidth+'px');
                }

                if (!$(this).is('#flex-menu-li') && !flagFull){
                    if ($(this).parent().css('display') == 'none'){
                        $(this).parent().css('display', 'block');
                    }


                    oldWidth = allWidth;
                    paddingAdd = 0;

                    if ($(this).parent().children( "ul").length>0){
                        $(this).addClass('sub-item');
                    }

                    paddingAdd = parseInt($(this).css('padding-left'))+parseInt($(this).css('padding-right'));
                    allWidth += $(this).width()+ paddingAdd+2;

                    if (maxWidth<allWidth){
                        allWidth = oldWidth;
                        $(this).parent().css('display', 'none');
                        flagFull = true;
                        $(this).data('visible', 0);
                        $(this).parent().data('visible', 0);
                    }
                }else{
                    $(this).parent().css('display', 'none');
                    $(this).data('visible', 0);
                    $(this).parent().data('visible', 0);
                }

            });



            if (!flagFull){
                delta = 0;
                if ($('ul.flex-menu').hasClass('compound')){
                    $('ul.flex-menu').css({
                        'width':(allWidth)+'px',
                        'float': 'right'
                    });
                    lastFull.parent().addClass('last');
                }
                $('ul.flex-menu').css('overflow','visible');
                return;
            }else{
                enableWidth = maxWidth - window.Corporate.Menu.flexButtonWidth;
            }

            if (flagFull){
                $('#flex-menu-li').css('width', window.Corporate.Menu.flexButtonWidth+'px').css('display', 'block');
                $('#flex-menu-li').html('');
                addHTML = '<a href="#">&nbsp;</a>';
                strAddUL = '<ul>';

                $('ul.flex-menu>li').each(function(){

                    if (
                        !$(this).is('.other')
                            && $(this).data('visible') == 0){

                        strAddUL += '<li class="l-2">'+$(this).children('a').get(0).outerHTML+'</li>';
                    }
                });

                strAddUL += '</ul>';
                $('#flex-menu-li').html(addHTML+strAddUL);
            }else{
                $('#flex-menu-li').css('display', 'none');
                lastFull.parent().addClass("last");
            }


            if ($('ul.flex-menu').hasClass('compound')){
                $('ul.flex-menu').css({
                    'width':allWidth+40+window.Corporate.Menu.flexButtonWidth+'px',
                    'float': 'right'
                });
            }

            $('ul.flex-menu').css('overflow','visible');

            if ($('ul.flex-menu').hasClass('compound')){
                $('ul.flex-menu').css({
                    'width':'auto',
                    'height': 'auto'
                });
            }


        },

        resizeSubmenu: function(target, innerMode){

            if (target.children("ul").length>0){
                element = target.children("ul");
                maxRight = $("ul.flex-menu").offset().left+$("ul.flex-menu").width();
                offsetRight = element.width()+element.offset().left;
                if (maxRight<offsetRight){
                    /*console.log(
                        element.offset().left
                            + " "
                            + element.width()
                            + " "
                            + (element.width()+element.offset().left)
                            + " "
                            + maxRight
                    );*/

                    if (innerMode == true){
                        newW = (target.children("ul").width());
                    }else
                    {
                        newW = (target.width());
                    }

                    element.css({
                        'left': "-"+newW+'px'
                        //'width':'100%'
                    });

                  /*  element.children("li").each(function(){

                        if ($(this).children("ul").length >0)
                            $(this).children("ul").each(function(){
                                $(this).css({
                                    'left': "-"+$(this).width()+'px',
                                    'width':'100%'
                                })
                            });

                    });*/
                }

            }
        },

        createMobileMenu: function(){
                addHTML='<div id="mobile-menu-content">';

            identity = 0;
            submenyHTML = "";
                $('ul.flex-menu>li').each(function(){
                    identity++;
                    if ($(this).data('nomobile') != 1 && !$(this).is('#flex-menu-li')){
                        addNode = false;
                        submenyHTML += '<div data-main="1" data-active="0" data-item="'+identity+'">';
                        submenyHTML += $(this).children( "a").get(0).outerHTML;
                        submenyHTML += '</div>';

                        if ($(this).children( "ul").length>0){
                            addNode = true;
                            submenyHTML += '<div class="submenu_item" data-parent="'+identity+'">';
                            $(this).children( "ul").children("li").children('a').each(function(){

                                submenyHTML += $(this).get(0).outerHTML;

                            });
                            submenyHTML += '</div>';
                        }
                    }
                });

                addHTML +=submenyHTML+'</div><div class="clearfix"></div>';

                $('#mobile-menu-body').html(addHTML);
                $('#mobile-menu-body div.submenu_item').each(function(){
                    $('#mobile-menu-body div[data-item='+$(this).data('parent')+']').children('a').addClass('sub-item');
                    $('#mobile-menu-body div[data-item='+$(this).data('parent')+']').children('a').closest('div').addClass('sub-item-wrap glyphicon glyphicon-chevron-right');
                });
                this.initMobileMenuEvents();
        },

       initMobileMenuEvents: function(){
            $(document).on(
                'click',
                '#menuitem',
                function(){

                    if ($('#mobile-menu-content').css('display') == 'none'){
                        $('#mobile-menu-content').slideDown(200);
                       // if ($('#search-line').css('display') != 'none')
                       //     $('#search-line').slideUp(200);
                    }else{
                        $('#mobile-menu-content').slideUp(200);
                    }
                }
            );

           /*$(document).on(
               'click',
               '#searchitem',
               function(){
                    console.log($('#search-line'));
                   if ($('#search-line').css('display') == 'none'){
                       $('#search-line').slideDown(200);
                       if ($('#mobile-menu-content').css('display') != 'none')
                            $('#mobile-menu-content').slideUp(200);

                   }else{
                       $('#search-line').slideUp(200);
                   }
               }
           );*/

            $(document).on(
                'click',
                '#mobile-menu-content > div.sub-item-wrap',
                function(){
                    if ($(event.target).closest(".sub-item").length) {
                        location.href=$(event.target).closest(".sub-item").attr('href');
                    } else {
                        nItem = $(this).data('item');

                        $("div [data-parent="+nItem+"]").slideToggle(300,function() {
                            if ($(this).prev().hasClass("glyphicon-chevron-right")) {
                                $(this).prev().removeClass("glyphicon-chevron-right").addClass("glyphicon-chevron-down");
                            } else {
                                $(this).prev().removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-right");
                            }
                        });
                        
                        event.stopPropagation();
                        return false;
                    }
                }
            );
       }




    }

    $(document).ready(function(){
        window.Corporate.init();
    });


})(window);

$(document).ready(function() {

    // main menu submenu
    
    $('ul.top-menu > li').each(function() {
        
        if($(this).hasClass('main-menu__item_has_submenu')) {
            $(this).children('a').on('click', function(e) {
                e.preventDefault();
                
                if (!$(this).closest('li').hasClass('main-menu__item_state_open')) {
                    $(this)
                        .siblings('.main-menu__submenu')
                        .slideDown()
                        .closest('li')
                        .addClass('main-menu__item_state_open');
                } else {
                    $(this)
                        .siblings('.main-menu__submenu')
                        .slideUp()
                        .closest('li')
                        .removeClass('main-menu__item_state_open');
                }
                
                $(document).on('click', function(e) {
                    
                    if($(e.target).closest('.main-menu__submenu').length || $(e.target).closest('li.main-menu__item_state_open').length) {
                        return;
                    }
                    
                    $('.main-menu__submenu')
                        .slideUp()
                        .closest('.main-menu__item_state_open')
                        .removeClass('main-menu__item_state_open');
                });
                
            });
        }
        
    });
    
    $('.main-menu__list_level_1 > .main-menu__item').each(function() {
        
        if($(this).hasClass('main-menu__item_has_submenu')) {
            $(this).children('.main-menu__link').on('click', function(e) {
                e.preventDefault();
                
                if (!$(this).closest('.main-menu__item').hasClass('main-menu__item_state_open')) {
                    $(this)
                        .siblings('.main-menu__list')
                        .slideDown()
                        .closest('.main-menu__item')
                        .addClass('main-menu__item_state_open');
                } else {
                    $(this)
                        .siblings('.main-menu__list')
                        .slideUp()
                        .closest('.main-menu__item')
                        .removeClass('main-menu__item_state_open');
                }
                
            });
        }
        
    });
    
});