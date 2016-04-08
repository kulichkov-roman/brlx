$(document).ready(function() {

})

$(window).load(function() {
    ratioSet();
})

$( window ).resize(function() {
    $(".element-card").height("auto");
    $(".absolute").removeClass("absolute");
    $(".block-image").css("height", "");
    $(".block-image").css("line-height", "");
    autoResize("element-card");
    resizeGlyph();
});

function autoResize(classToResize, typeResize) {
    var cardCnt = $(classToResize).length;
    if (cardCnt > 0){
        var maxHeight = 0;
        var maxImgHeight = 0;
        var maxTitleHeight = 0;
        var maxDescHeight = 0;
        var maxBtnHeight = 0;
        
        $(classToResize).each(function(index) {
            if (typeResize == "modern_card_horizontal"){
                var paddingTop = parseInt($(this).css("padding-top"));
                var paddingBottom = parseInt($(this).css("padding-bottom"));;
                var height = parseInt($(this).height()) ;//+ paddingTop + paddingBottom;
                var titleHeight = parseInt($(this).find(".modern-card-horizontal-name").height());
                var DescHeight = parseInt($(this).find(".modern-card-horizontal-text").height());
                var btnHeight = parseInt($(this).find(".modern-card-horizontal-operation").height());
                maxTitleHeight = (maxTitleHeight < titleHeight) ? titleHeight : maxTitleHeight;
                maxDescHeight = (maxDescHeight < DescHeight) ? DescHeight : maxDescHeight;
                maxBtnHeight = (maxBtnHeight < btnHeight) ? btnHeight : maxBtnHeight;
                maxHeight = (maxHeight < height) ? height : maxHeight;
                if (index == cardCnt - 1) {
                    $(classToResize).each(function(cell) {
                        var margin = maxTitleHeight - $(this).find(".modern-card-horizontal-name").height();
                        $(this).height(maxHeight);
                    })
                }
            }
            if (typeResize == "modern_card_vertical") {
                var titleHeight = parseInt($(this).find(".modern-card-name").height());
                var DescHeight = parseInt($(this).find(".modern-card-text").height());
                var imgHeight = parseInt($(this).find(".modern-card-image").height());
                var btnHeight = parseInt($(this).find(".modern-card-buttons").height());
                maxTitleHeight = (maxTitleHeight < titleHeight) ? titleHeight : maxTitleHeight;
                maxDescHeight = (maxDescHeight < DescHeight) ? DescHeight : maxDescHeight;
                maxImgHeight = (maxImgHeight < imgHeight) ? imgHeight : maxImgHeight;
                maxBtnHeight = (maxBtnHeight < btnHeight) ? btnHeight : maxBtnHeight;
                if (index == cardCnt - 1) {
                    $(classToResize).each(function(cell) {
                        $(this).find(".modern-card-name").height(maxTitleHeight);
                        $(this).find(".modern-card-text").height(maxDescHeight);
                        $(this).find(".modern-card-image").height(maxImgHeight);
                        $(this).find(".modern-card-buttons").height(maxBtnHeight);
                    })
                }
            }
            if (typeResize == "classic_image_card") {
                var imgHeight = parseInt($(this).find(".classic-image-image").height());
                maxImgHeight = (maxImgHeight < imgHeight) ? imgHeight : maxImgHeight;
                if ($(this).hasClass("show-name-part")) {
                    var titleHeight = parseInt($(this).find(".classic-image-name").height());
                    maxTitleHeight = (maxTitleHeight < titleHeight) ? titleHeight : maxTitleHeight;
                }
                if (index == cardCnt - 1) {
                    $(classToResize).each(function(cell) {
                        if ($(this).hasClass("show-name-part")) {
                            $(this).find(".classic-image-name").height(maxTitleHeight);
                        }
                    })
                }
            }
            if (typeResize == "classic_card") {
                var titleHeight = parseInt($(this).find(".classic-card-name").height());
                var DescHeight = parseInt($(this).find(".classic-card-text").height());
                maxTitleHeight = (maxTitleHeight < titleHeight) ? titleHeight : maxTitleHeight;
                maxDescHeight = (maxDescHeight < DescHeight) ? DescHeight : maxDescHeight;
                if (index == cardCnt - 1) {
                    $(classToResize).each(function(cell) {
                        $(this).find(".classic-card-name").height(maxTitleHeight);
                        $(this).find(".classic-card-text").height(maxDescHeight);
                    })
                }
            }
            
            if (typeResize == "sale_cart") {
                
                var titleHeight = parseInt($(this).find(".sale-card-name").height());
                var btnHeight = parseInt($(this).find(".sale-card-price-line").height());
                maxTitleHeight = (maxTitleHeight < titleHeight) ? titleHeight : maxTitleHeight;
                maxBtnHeight = (maxBtnHeight < btnHeight) ? btnHeight : maxBtnHeight;
                if (index == cardCnt - 1) {
                    $(classToResize).each(function(cell) {
                        $(this).find(".sale-card-name").height(maxTitleHeight);
                        $(this).find(".sale-card-price-line").height(maxBtnHeight);
                    })
                }
            }
        });
    }

    return;
}

function alignSliderBtns() {
    $('.slider-carousel').each(function() {
        blockHeight = $(this).children(".slick-list").height() - 20;
        newHeight = blockHeight / 2 - 20;
        $(".slick-next").css("top", newHeight + "px");
        $(".slick-prev").css("top", newHeight + "px");
    })
}

$(document).ready(function() {
    $('a.fancyvideo').click(function() {
        a = this.href.replace(new RegExp("https:\\/\\/youtu.be\\/", "i"), 'http://www.youtube.com/v/');
        url = a.replace(new RegExp("watch\\?v=", "i"), 'v/');

        $.fancybox ({
            'type'              :   'iframe',
            'href'              :   url,
            'transitionIn'      :	'elastic',
            'transitionOut'     :	'elastic',
            'speedIn'           :	600,
            'speedOut'          :	200,
            'overlayShow'       :	false
        });
        return false;
    });
    
    $('a.card-element').fancybox ({
        'transitionIn'      :	'elastic',
        'transitionOut'     :	'elastic',
        'speedIn'           :	600,
        'speedOut'          :	200,
        'overlayShow'       :	false
    });
    
    resizeGlyph();
    
});

function resizeGlyph(){
    $('.modern-card-horizontal-image.img-rounded, .modern-card-horizontal-image.img-circle, .modern-card-horizontal-image.img-square').each(function(){

        if ($(this).height()<$(this).width()){
            $(this).height($(this).width());
            $(this).css('line-height',$(this).width()+'px');
        }
    });
}

function ratioSet(){
    $('.classic-image-card').each(function(){
        var dataRatio = $(this).data('ratio');
        ratio = (dataRatio) ? dataRatio/100 : 0.5;
        $(this).find('.classic-image-image').height($(this).width()*ratio);
        $(this).find('.classic-image-image').css("line-height", $(this).width()*ratio+"px");
        $(this).find('.classic-image-image img').css('max-height',$(this).width()*ratio+'px');
    });
}