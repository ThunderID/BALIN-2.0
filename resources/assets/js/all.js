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
