	$('ul.nav li.dropdown').hover(function() {        
		$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(300);
	}, function() {
		$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(300);
	});

/* SECTION PLUGIN I-CHECK */
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square',
		radioClass: 'iradio_square',
		increaseArea: '20%' 
	});
/* END SECTION PLUGIN I-CHECK */

/* SECTION COLLAPSE PRODUCT CATEGORY, FILTER */
	$('.menu_accordion').click(function(){
		$('.collapse_category').collapse("hide");
	});

	$('.form_input_search').click(function(){
		$('.collapse_category').collapse("hide");
		$('.menu_accordion').removeClass('active');
	});

	$('.collapse_category').on('show.bs.collapse', function(e){
		$('.menu_accordion').removeClass('active');
		$('#' + $(this).data('collapse')).addClass('active');
	});

	$('.collapse_category').on('hide.bs.collapse', function(e){
		$('.menu_accordion').removeClass('active');
	});
/* END SECTION COLLAPSE PRODUCT CATEGORY, FILTER */

/* SECTION INPUT MASK */
	$(".money").inputmask({ rightAlign: false, alias: "numeric", prefix: 'IDR ', radixPoint: '', placeholder: "", autoGroup: !0, digitsOptional: !1, groupSeparator: '.', groupSize: 3, repeat: 15 });              
	$(".money_right").inputmask({ rightAlign: true, alias: "numeric", prefix: 'IDR ', radixPoint: '', placeholder: "", autoGroup: !0, digitsOptional: !1, groupSeparator: '.', groupSize: 3, repeat: 15 });              
	$(".date_time_format").inputmask({
		mask: "d-m-y h:s",
		placeholder: "dd-mm-yyyy hh:mm",
		alias: "datetime",
	}); 
	$(".date_format").inputmask({
		mask: "d-m-y",
		placeholder: "dd-mm-yyyy",
		alias: "date",
	});
/* END SECTION INPUT MASK */

/* CHECK OFFSET FOR DIVIDER FOOTER & NAVBAR SHORTCUT */
	function checkOffset() {
		var wh=$(document).scrollTop()+window.innerHeight;
		var dh=$('.divider_footer').offset().top;
		if (wh<dh) {
			$('.navbar_shortcut').fadeIn();
		} else {
			$('.navbar_shortcut').fadeOut();
		}
	}
	$(document).ready(checkOffset);
	$(document).scroll(checkOffset);
/* END CHECK OFFSET FOR DIVIDER FOOTER & NAVBAR SHORTCUT */