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
            if($('ul.flex-menu').is('.menu-level2'))
                window.Corporate.Menu.resizeLevel2();
            window.Corporate.Menu.resizeWidth();
            window.Corporate.resizeSaleCards();
            window.Corporate.Menu.createMobileMenu();
            window.Corporate.Menu.fixed();
            window.Corporate.Menu.searchForm();
            window.Corporate.setAutoScroll();
            window.Corporate.setImageResponsive();
            window.Corporate.resizeRK();
            new WOW().init();

            $(window).resize(function() {
                window.Corporate.Menu.resize();
                if($('ul.flex-menu').is('.menu-level2'))
                    window.Corporate.Menu.resizeLevel2();
                window.Corporate.Menu.resizeWidth();
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
        fixedTop: 0,
        fixedHeight: 0,

        
        searchForm: function(){
            $("ul.flex-menu > li .glyphicon-search").parents("a").on('click', function(){
                e = $('#search-line').parents(".dcontainer").find(".dcontainer");
                
                if(!$('ul.flex-menu').is('.menu-level2')) {
                    if(e.is(":visible"))
                        e.fadeOut();
                    else
                        e.fadeIn(); 
                }
                else {
                    m = $('.dcontainer-search-form').parents(".dcontainer").find("> .container");
                    if(e.is(":visible")) {
                       e.css("display", "none");
                       m.css("display", "block");
                    }
                    else {
                       m.css("display", "none");
                       e.css("display", "block");
                    }
                }

                return false;
                
            });
            
            $("#search-line .big_search").on('click', function(){
                e = $('#search-line').parents(".dcontainer").find(".dcontainer");
                m = $('.dcontainer-search-form').parents(".dcontainer").find("> .container");
                e.css("display", "none");
                m.css("display", "block");
                return false;
            }); 
        },
        
        showMenu: function() {
            var menu = $('.top-menu-v2');

            //if(menu.data("visibility") != "1") {
                menu.css("visibility", "visible");
                menu.data("visibility", "1");
           // }
        },
        
        resizeWidth: function() {
            fullWidth = $('ul.flex-menu').width();
            fullLiWidth = 0;
            p1 = 0;
            i = 0;
            j = 0;
            
            $('ul.flex-menu > li:visible').each(function(){
                
                if($(this).is(".other") || $(this).is(".li-visible"))
                    ++j;
                else {
                    ++i;
                    fullLiWidth += $(this).width();
                }
            });
            
            p1 = fullWidth/100;
            width = (fullWidth-fullLiWidth-100)/i;
            
            $('ul.flex-menu > li:visible').each(function(){
                w = 0;
                if(!$(this).is(".other") && !$(this).is(".li-visible")) {
                    w = Math.floor(($(this).width()+width)/p1);
                    w = Math.floor(($(this).width()+width));
                    fullLiWidth += $(this).width(w+"px");
                }
            });
            
            window.Corporate.Menu.showMenu();
            
        },
        
        fixed: function(){

            fixedElement = $('ul.flex-menu').parents(".dcontainer");
            
            if( fixedElement.data("fixed") != "Y" )
                return;

            fixedElementSearch = $('#search-line').parents(".dcontainer");
            
            fixedTop = fixedElement.offset().top; 
            
            fixedElement.on('affix.bs.affix', function () {
                $(this).css({"box-shadow": "0 1px 5px rgba(0, 0, 0, 0.136)"});
            });
            
            fixedElement.on('affix-top.bs.affix', function () {
                $(this).css({"box-shadow": "none"});
            });
            
            var windowHeight = $(window).height();
            var bodyHeight = $(document).height();
            
            if(bodyHeight>(950+fixedElement.height())) {
                fixedElement.affix({
                    offset: {
                        top: function(e) {
                            e.css({"top": "-2px", "z-index": "99"});
                            return fixedTop;
                        }
                    }
                });
            }
            
        },
     
        resizeLevel2: function() {

            stock = 100; 
            line = $('ul.flex-menu > .selected > ul');
            fullWidth = $('ul.flex-menu').width()-stock;
            
            var tWirth = window.outerWidth;            
            if(tWirth==0)
                tWirth =screen.width;
            
            if (tWirth<768 && $('ul.flex-menu').css('display') != 'none') {
                return;
            }
            
            allWidth = 0;
            displayWidth = 0;
            flagFull = false;
            e = 0;
            
            line.find('>li').each(function(){
                allWidth += $(this).width();
                if(fullWidth>allWidth) {
                    ++e;
                    displayWidth += $(this).width();
                }
            });
                        
            line.find('>li:lt(' + (e) + ')').css("display", "block");
            
            if(fullWidth<allWidth)
                flagFull = true;
            
            if(displayWidth!=0) {
                $('ul.flex-menu').height(81);
                //$('.dcontainer-search-form').css("top", "-81px");
            }
            
            if (flagFull){
                line.find(".level2").remove();
                addHTML = '<li class="level2"><a href="#"><span class="glyphicon glyphicon-option-horizontal"></span></a>';
                strAddUL = '<ul>';

                line.find('>li:gt(' + (e-1) + ')').each(function(){
                    
                    $(this).css("display", "none");
                    strAddUL += '<li class="l-2">'+$(this).children('a').get(0).outerHTML+'</li>';
                });

                strAddUL += '</ul></li>';
                $('ul.flex-menu > .selected > ul').append(addHTML+strAddUL);
                leve2Width = $('.level2 > ul').width();

                if((displayWidth+leve2Width)>(fullWidth+stock))
                    $('.level2 > ul').css("left", (fullWidth-displayWidth-leve2Width+stock)+"px");
            }
        },

        resize: function(){

            $('ul.flex-menu').css('width', '100%');
            fullWidth = $('ul.flex-menu').width();
            
            var tWirth = window.outerWidth;            
            if(tWirth==0)
                tWirth =screen.width;
            
            if (tWirth <768 && $('ul.flex-menu').css('display') != 'none') {
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
                //alert($(this).children( "ul").length);
                if ($(this).children( "ul").length>0){
                    $(this).children( "a").addClass('sub-item'); // внутренние
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
                        $(this).addClass('sub-item'); // первое добавление
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
                addHTML = '<a href="#"><span class="glyphicon glyphicon-option-horizontal"></span></a>';
                strAddUL = '<ul>';

                $('ul.flex-menu>li').each(function(){

                    if (
                        !$(this).is('.other')
                            && !$(this).is('.li-visible')
                            && $(this).data('visible') == 0){

                        strAddUL += '<li class="l-2">'+$(this).children('a').get(0).outerHTML+'</li>';
                    }
                });
                
                $('.li-visible').css('display', 'inline-block');

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
                    if ($(this).data('nomobile') != 1 && !$(this).is('#flex-menu-li') && !$(this).is('.li-visible')){
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
                });
                this.initMobileMenuEvents();
                $('#mobile-menu-body div').each(function(){
                    if($(this).data("parent")!=undefined)
                        $(this).find("span").remove();
                });
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
                '#mobile-menu-content > div > a.sub-item',
                function(){
                    if ($(this).parent().is('div.submenu_item')) return;
                    console.log($(this).parent());
                    console.log($(this));
                    nItem = $(this).parent().data('item');
                    console.log($(this).data('show'));

                    if ($(this).data('show') == 1){
                        var element = this;
                        $("div [data-parent="+nItem+"]").slideUp(200, function(){
                            pItem = $("div [data-item="+nItem+"]").children('a');
                            pItem.data('show', 0);
                            pItem.removeClass('hover');
                        });
                    }else{
                        $("div [data-parent="+nItem+"]").slideDown(200, function(){
                            pItem = $("div [data-item="+nItem+"]").children('a');
                            pItem.data('show', 1);
                            pItem.addClass('hover');
                        });
                    }

                    return false;
                }
            );
       }


    }

    $(document).ready(function(){
        window.Corporate.init();
    });


})(window);


