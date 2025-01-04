$(document).ready(function ($) {
    /* search form */
    $("a[href='#search']").click(function() {
        //$(this).parent().addClass("search-form-show");
        $(".search-form").addClass("search-form-show");

        //console.log($(this).parent().find("#key")); //.focus();
        //$(this).parent().find("#key").focus();
        $("#key").focus();
        return false;
    });

    /* hide search form */
    $('body').click(function(e) {
        if(!$(e.target).is('#key')) {
            $(".search-form").removeClass("search-form-show");
        }
    });
});