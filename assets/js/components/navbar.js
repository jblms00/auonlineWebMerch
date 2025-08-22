$(document).ready(function () {
    var $navbar = $("#navbar");

    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 20) {
            $navbar.addClass("backdrop");
        } else {
            $navbar.removeClass("backdrop");
        }
    });
});
