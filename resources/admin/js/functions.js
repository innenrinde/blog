function set_seo(id_source, id_target) {
	$("#"+id_source).blur(function() {
		if($("#"+id_target).val().length == 0) {
			$("#"+id_target).val($(this).val());
			validate_seo(id_target);
		}
	});

	$("#"+id_target).blur(function() {
		validate_seo(id_target);
	});

	$("#"+id_source).trigger('blur');
}

function validate_seo(id_obj_seo) {
	var val = $("#"+id_obj_seo).val();

	if(/^[a-zA-Z0-9_-]{1,255}$/.test(val)) {
		$("#"+id_obj_seo).val(val);
	}
	else {
		var arr = new Array();
		for(var index=0; index<val.length; index++) {
			if(/^[a-zA-Z0-9_-]{1,255}$/.test(val[index])) {
				arr.push(val[index]);
			}
			else if(val[index] == " ") {
				arr.push("-");
			}
		}
		$("#"+id_obj_seo).val(arr.join(""));
	}
}

(function ( $ ) {
	$.fn.checkboxGrouped = function(options) {

		/**
		 * Get params
		 */
		var settings = $.extend({
		}, options);


		$("body").click(function(e) {
			var css = $(e.target).attr('class');
			if(settings.group.indexOf(css) > -1) {
				var check = $(e.target).prop('checked');

				$("." + css).prop('checked', false);
				$(e.target).prop('checked', check);
			}
		});

	}
}( jQuery ));


$( function() {
	$(this).checkboxGrouped({
		'group': [
			'main_image',
			'interview_image'
		]
	});
});