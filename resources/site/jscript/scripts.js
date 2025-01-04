
(function ($) {
	"use strict";


	jQuery(window).ready(function() {

		jQuery(".close-alert-block").click(function(){
			jQuery(this).parent().animate({
				paddingTop: "0px",
				paddingBottom: "0px",
				marginBottom: "0px",
				height: "0px",
				opacity: "0"
			}, 200);
			return false;
		});

		jQuery(".widget .photo-gallery-list .gallery-navi a").click(function(){
			var thisel = jQuery(this),
				imageel = thisel.parent().siblings(".gallery-change").children("a.active");
			if(thisel.attr("href") == "#gal-left") {
				imageel.parent().find("img").removeClass("bounceInLeft").removeClass("bounceOutRight").removeClass("bounceInRight").removeClass("bounceOutLeft");
				imageel.prev().addClass("active").children("img").addClass("animated bounceInLeft").parent().siblings("a.active").removeClass("active").children("img").addClass("animated bounceOutRight");
			}else
			if(thisel.attr("href") == "#gal-right") {
				imageel.parent().find("img").removeClass("bounceInLeft").removeClass("bounceOutRight").removeClass("bounceInRight").removeClass("bounceOutLeft");
				imageel.next().addClass("active").children("img").addClass("animated bounceInRight").parent().siblings("a.active").removeClass("active").children("img").addClass("animated bounceOutLeft");
			}
			return false;
		});

		jQuery(".featured-slide-list .slide-navi a").click(function(){
			var thisel = jQuery(this),
				imageel = thisel.parent().siblings(".slide-change").children("a.active");
			if(thisel.attr("href") == "#slide-left") {
				imageel.parent().find("img").removeClass("bounceInLeft").removeClass("bounceOutRight").removeClass("bounceInRight").removeClass("bounceOutLeft");
				imageel.prev().addClass("active").children("img").addClass("animated bounceInLeft").parent().siblings("a.active").removeClass("active").children("img").addClass("animated bounceOutRight");
			}else
			if(thisel.attr("href") == "#slide-right") {
				imageel.parent().find("img").removeClass("bounceInLeft").removeClass("bounceOutRight").removeClass("bounceInRight").removeClass("bounceOutLeft");
				imageel.next().addClass("active").children("img").addClass("animated bounceInRight").parent().siblings("a.active").removeClass("active").children("img").addClass("animated bounceOutLeft");
			}
			return false;
		});




		jQuery(".short-tabs").each(function(){
			var thisel = jQuery(this);
			thisel.children("ul").children("li").eq(0).addClass("active");
			thisel.children("div").eq(0).addClass("active");
		})

		jQuery(".short-tabs > ul > li a").click(function () {
			var thisel = jQuery(this).parent();
			thisel.siblings(".active").removeClass("active");
			thisel.addClass("active");
			thisel.parent().siblings("div.active").removeClass("active");
			thisel.parent().siblings("div").eq(thisel.index()).addClass("active");
			return false;
		});

		// Accordion blocks
		jQuery(".accordion > div > a").click(function () {
			var thisel = jQuery(this).parent();
			if (thisel.hasClass("active")) {
				thisel.removeClass("active").children("div").animate({
					"height": "toggle",
					"opacity": "toggle",
					"padding-top": "toggle"
				}, 300);
				return false;
			}
			// thisel.siblings("div").removeClass("active");
			thisel.siblings("div").each(function () {
				var tz = jQuery(this);
				if (tz.hasClass("active")) {
					tz.removeClass("active").children("div").animate({
						"height": "toggle",
						"opacity": "toggle",
						"padding-top": "toggle"
					}, 300);
				}
			});
			// thisel.addClass("active");
			thisel.addClass("active").children("div").animate({
				"height": "toggle",
				"opacity": "toggle",
				"padding-top": "toggle"
			}, 300);
			return false;
		});


		jQuery(".photo-gallery-grid .image-overlay-icons").each(function(){
			var thisel = jQuery(this);
			thisel.parent().append("<div class='inner-frame' style='box-shadow: inset 0 0 0 5px "+thisel.data("color")+";'></div>")
			thisel.find("a").css("background", thisel.data("color"));
		});

		jQuery(".lightbox").click(function () {
			var thisel = jQuery(this);
			thisel.css('overflow', 'hidden');
			jQuery("body").css('overflow', 'auto');
			thisel.find(".lightcontent").fadeOut('fast');
			thisel.fadeOut('slow');
		}).children().click(function (e) {
			return false;
		});

		// comments form validation
		$("#frm_comment").validate({
			rules: {
				name_surname: {
					required: true,
					minlength: 2
				},
				email: {
					required: true,
					email: true
				},
				phone: {
					required: true,
					digits: true,
					minlength: 6
				},
				message: {
					required: true,
					minlength: 25
				}
			},
			messages: {
				name_surname: "Numele este obligatoriu",
				email: "Alege o adresă de e-mail validă",
				phone: "Introdu un număr valid de telefon (doar cifre fără spații)",
				message: "Mesajul este obligatoriu (cel puțin 25 de caractere)",
			}
		});

		$("#btn_comment").click(function() {
			$("#frm_comment_mess").html('');
            if($("#frm_comment").valid()) {
            	var btn = $(this);
            	btn.val('Se trimite mesajul...');

                var form_data = $("#frm_comment").serialize();
                var action_data = $("#frm_comment").attr('action');
                $.ajax({
						url: action_data,
						type: "POST",
						data: form_data,
						success: function(response) {
							console.log('sssssssssssssssssssssss');
							console.log(response);
							if(parseInt(response) == 1) {
								$("#frm_comment_mess").html('<div class="success_msg">Mesajul a fost trimis cu succes!</div>');
								$("#frm_comment").trigger('reset');
							}
							else {
								$("#frm_comment_mess").html('<div class="error_msg">Am întâmpinat o eroare la trimiterea mesajului. Încearcă mai târziu.</div>');
							}
							btn.val('Trimite');
						},
					    error: function(response) {
							$("#frm_comment_mess").html('<div class="success_msg">Reîncărcați pagina pentru a putea trimite un nou mesaj!</div>');
							btn.val('Trimite');
						}
				  });
            }
		});

	});


})(jQuery);

function lightboxclose() {
	jQuery(".lightbox").css('overflow', 'hidden');
	jQuery(".lightbox .lightcontent").fadeOut('fast');
	jQuery(".lightbox").fadeOut('slow');
	jQuery("body").css('overflow', 'auto');
}
