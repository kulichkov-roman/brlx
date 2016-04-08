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

                $('.dcontainer.dark-light, .container.slider-container, .container.slider-container-color').each(function(){
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
                $(this).children('.sale-card-price-line').height($(this).children('.sale-card-price-line').height()+delta);
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

        init: function(){
            window.Corporate.Menu.resize();
            window.Corporate.resizeSaleCards();
            window.Corporate.Menu.createMobileMenu();
            window.Corporate.setAutoScroll();
            window.Corporate.setImageResponsive();
            new WOW().init();
        }
    };

    window.Corporate.Menu =  {

        lastItemWidth: 1,
        paddingAdd: 50,
        flexButtonWidth: 10,

        resize: function(){

            fullWidth = $('ul.flex-menu').width();

            if (window.outerWidth<768 && $('ul.flex-menu').css('display') != 'none') {
                return;
            }

            $('ul.flex-menu>li').each(function(){
                $(this).css('display','block');
            });


            maxWidth = $('ul.flex-menu').width()-window.Corporate.Menu.flexButtonWidth;

            allWidth = 0;
            flagFull = false;

            lastFull = false;


            $('ul.flex-menu > li > ul > li').each(function(){
                if ($(this).children( "ul").length>0){
                    $(this).children( "a").addClass('sub-item');
                }
            });

            summaryPos = 0;

            $('ul.flex-menu>li>a').each(function(){

                lastFull = $(this);

                $(this).data('pos', 0);
                $(this).data('visible', 0);
                $(this).parent().data('visible', 0);
                if (parseInt($(this).data('old'))>0){
                    $(this).parent().css('width', parseInt($(this).data('old'))+'px');
                }else{
                    $(this).data('old',$(this).parent().width());
                }
                if ($(this).is('#flex-menu-li')){
                    $(this).parent().css('width', window.Corporate.Menu.lastItemWidth+'px');
                }

                if (!$(this).is('#flex-menu-li') && !flagFull){
                    if ($(this).parent().css('display') == 'none'){
                        $(this).parent().css('display', 'block');
                    }
                    oldWidth = allWidth;
                    allWidth += $(this).width()+ window.Corporate.Menu.paddingAdd;

                    if ($(this).parent().children( "ul").length>0){
                        $(this).addClass('sub-item');
                        allWidth += window.Corporate.Menu.paddingAdd;
                    }

                    if (maxWidth<allWidth){
                        allWidth = oldWidth;
                        $(this).parent().css('display', 'none');
                        flagFull = true;
                    }else{
                        if ($(this).parent().children( "ul").length>0){
                            $(this).data('pos', $(this).width()+ window.Corporate.Menu.paddingAdd*1.3);
                        }else{
                            $(this).data('pos', $(this).width()+ window.Corporate.Menu.paddingAdd);
                        }
                        summaryPos += $(this).data('pos');
                        $(this).data('visible', 1);
                        $(this).parent().data('visible', 1);
                    }

                }else{
                    $(this).parent().css('display', 'none');
                }

            });



            if (!flagFull){
                delta = 0;
                enableWidth = allWidth;
                return;
            }else{
                enableWidth = fullWidth;
                delta = Math.round((fullWidth-allWidth-window.Corporate.Menu.flexButtonWidth)/fullWidth*100);
            }

            allWidthPercent = 0;



            $('ul.flex-menu>li>a').each(function(){



                if (!$(this).parent().is('#flex-menu-li') && $(this).data('visible') == 1){
                    elementWidth = Math.round(($(this).data('pos')/enableWidth)*100);
                    addDelta = (elementWidth/100*delta);
                    elementWidth += addDelta;

                    console.log(elementWidth);

                    $(this).parent().css('width', elementWidth+'%');
                    allWidthPercent += elementWidth;
                }

            });

            if (flagFull){
                $('#flex-menu-li').css('width', (100-allWidthPercent)+'%').css('display', 'block');
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
                lastFull.parent().css('width', elementWidth+(100-allWidthPercent)+'%');
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

    $(window).resize(function() {

        window.Corporate.Menu.resize();
        window.Corporate.resizeSaleCards();
    });

})(window);


