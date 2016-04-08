$(document).on("click", "#accordion-multilevel-menu li.parent-item", function (event) {
    if (event.target != this)
        return;
    var self = this;
    if ($(this).hasClass("jshover")) {
        $(this).children("ul").slideToggle(300, function() {
            $(self).removeClass("jshover");
            $(self).removeClass("glyphicon glyphicon-chevron-up");
            $(self).addClass("glyphicon glyphicon-chevron-down");
        });
    } else {
        $(this).children("ul").slideToggle(300);
        $(this).addClass("jshover");
        $(this).removeClass("glyphicon glyphicon-chevron-down");
        $(this).addClass("glyphicon glyphicon-chevron-up");
    }
    
    
})

$(document).ready(function() {
    $('.item-selected').closest("ul").css("display", "block");
})