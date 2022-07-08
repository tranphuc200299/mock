"use strict";

(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //back to top scroll
    $(".button-up-top").click(function() {
        $("html, body").animate({scrollTop: 0}, 0);
    });
    //back to top header
    $(window).scroll(function() {
        if ($(this).scrollTop() > 400) {
            $('.sticky-menu').fadeIn();
            $(".button-up-top").fadeIn();
        } else {
            $('.sticky-menu').fadeOut();
            $(".button-up-top").fadeOut();
        }
    });
}());
