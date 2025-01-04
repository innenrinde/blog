$(document).ready(function ($) {

    /* top menu */
    $(".sandwich").click(function() {
        var menu = $(".menu");
        if(menu.hasClass('menu-multi')) {
            menu.slideUp();
            menu.removeClass('menu-multi');
        }
        else {
            menu.slideDown();
            menu.addClass('menu-multi');
        }
    });

    /* lazy loading images */
    $("img.lazy").lazyload({
        effect : "fadeIn",
        threshold: 300
    });

    /* bring to top */
    $("a[href='#top']").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });
});

/* stiky menu */
$(window).scroll(function() {
    if ($(this).scrollTop() > 50){
        $('header').addClass("sticky");
    }
    else{
        $('header').removeClass("sticky");
    }
});
