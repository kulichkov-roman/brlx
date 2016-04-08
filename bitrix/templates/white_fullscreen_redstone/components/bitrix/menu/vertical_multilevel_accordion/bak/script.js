$(document).on("click", "#accordion-multilevel-menu li", function () {
    if (event.target != this)
        return;
    $(this).children("ul").slideToggle(300);
    if ($(this).hasClass("jshover")) {
        $(this).removeClass("jshover");
    } else {
        $(this).addClass("jshover");
    }
})