(function (window) {

    var stopSlideNext = false;
    var stopTabNext = false;
    var currentImage = 0;
    var stopTabNext = false;



    function setNewActiveTab(tabId){

        if (!stopTabNext){
            stopTabNext = true;

            $('.emarket-tabs > li').removeClass('active');
            $('#'+tabId).addClass('active');
            $('.emarket-detail-area-container').css('display', 'none');
            $('#'+tabId+'-tab').css('display', 'block');
            stopTabNext = false;
        }

    }

    function prevPhoto(){
        if (!stopSlideNext){
            stopSlideNext = true;

            if (currentImage == 0){
                currentImage = countPhoto-1;
            }
            else{
                currentImage = currentImage-1;
            }
            setActivePhoto('i'+currentImage);
        }
    }

    function nextPhoto(){

        if (!stopSlideNext){
            stopSlideNext = true;

            if (currentImage > (countPhoto-1)){
                currentImage = 0;
            }
            else{
                currentImage = (currentImage+1);
            }
            setActivePhoto('i'+currentImage);
        }
    }

    function setActivePhoto(item){

        changePhoto = item;

        currentPhoto = parseInt(item.replace('i',''));

        $('#c_photos .photo').removeClass('active');
        $('#c_photos img[data-item='+changePhoto+']').parent().parent().addClass('active');

        $('#emarket_big_photo .inslider').each(function(){
                if ($(this).data('state') == 'show'){
                    $(this).data('state', 'hide');
                    $(this).hide(200, function(){
                        $('#'+changePhoto).show(200, function(){
                            $('#'+changePhoto).data('state', 'show');
                            stopSlideNext = false;
                        });
                    })
                }
            }
        )
    }

    $(document).ready(function(){

        $('#emarket_big_photo > a').fancybox();
        $('.emarket-offers-ico > a').fancybox();

        $(document).on(
            'click',
            '#c_photos .photo',
            function(){

                if (!stopSlideNext){
                    stopSlideNext = true;

                    changePhoto = $(this).children('.photo-wrap').children('img').data('item');
                    setActivePhoto(changePhoto);
                }
            }
        );

        $(document).on(
            'click',
            '#c_bigphotos_prev',
            function(){
                prevPhoto();
            }
        );

        $(document).on(
            'click',
            '#c_bigphotos_next',
            function(){
                nextPhoto();
            }
        );

        $(document).on(
            'click',
            '#c_bigphotos_zoom',
            function(){
                $('#i'+currentImage).trigger('click');
            }
        );

        $(document).on(
            'click',
            '.emarket-tabs > li',
            function(){
                tabId = $(this).attr('id');

                    if (!stopTabNext){
                        stopTabNext = true;

                        $('.emarket-tabs > li').removeClass('active');
                        $('#'+tabId).addClass('active');
                        $('.emarket-detail-area-container').css('display', 'none');
                        $('#'+tabId+'-tab').css('display', 'block');
                        stopTabNext = false;
                    }
            }
        );


        $("#").trigger('click');

    });

})(window);