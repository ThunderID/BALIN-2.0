	/**
	 * [function pilih address]
	 */
	$('.choice_address').on('change', function() {
		var val = $(this).val();
		action = $(this).find(':selected').attr('data-action');
		if (val == 0) {
		}
		else {
			get_shipping_cost(val, action, 0);
		}
	});

	/*
	* 	function get voucher form input
	*/
	// $('button.voucher_desktop').click( function() {
	// 	inp = $('input.voucher_desktop');
	// 	voucher = get_voucher(inp);
	// 	show_voucher(voucher, inp);
	// 	reload_view(voucher, 'desktop');
	// 	reload_view(voucher, 'mobile');
	// });
	function check_voucher() {
		inp = $('input.voucher_desktop');
		voucher = get_voucher(inp);
		check_voucher = show_voucher(voucher, inp);
		reload_view(voucher, 'desktop');
		reload_view(voucher, 'mobile');

		return check_voucher;
	}

	/**
	 * [function check address to parsin function get shipping cost]
	 * 
	 * @param  e {element button step}
	 * @return check {false/true jika ada error}
	 */
	function check_address(e) {
		ch_address_id	= $(e).val();
		action 			= $(e).attr('data-action');
		
		check 			= get_shipping_cost(ch_address_id, action, 1);
		return check;
	}

	/**
	 * [function get shipping cost]
	 * 
	 * @param 	id 		{jika id address tidak ada}
	 * @param 	action 	{url yang akan dituju}
	 * @param 	flag 	{jika address sudah ada 0 merupakan tidak ada perubahan data, 1 ada perubahan data}
	 * @return 	error 	{false/true}
	 */
	function get_shipping_cost(id, action, flag) {
		ch_name 		= $('.ch_name').val();
		ch_phone		= $('.ch_phone').val();
		ch_address 		= $('.ch_address').val();
		ch_zipcode		= $('.ch_zipcode').val();
		modal_alert		= $('#alert_window');
		error 			= false;
		
		cv = parseInt($('.shipping_cost').attr('data-v'));

		// call ajax add address new
		if (id == 0) {
			$.ajax({
				url: action,
				type: 'post',
				dataType: 'json',
				async: false,
				data: {name: ch_name, phone: ch_phone, address: ch_address, zipcode: ch_zipcode},
				success: function(data) {
					if (typeof(data.type) != "undefined" && data.type !== null) {
						error = true;

						modal_alert.find('.content').html(data.msg);
						$('#alert_window').modal('show');

						setTimeout( function() {
							$('#alert_window').modal('hide');
						}, 1500);
					}
					else {
						reload_view(data, 'desktop');
						reload_view(data, 'mobile');
						parsing_address(data.address);
					}
				}
			});
		}
		// address sudah ada
		else {
			// address sudah ada tapi ubah data address
			if (flag == 1){
				$.ajax({
					url: action,
					type: 'post',
					dataType: 'json',
					async: false,
					data: {address_id: id, name: ch_name, phone: ch_phone, address: ch_address, zipcode: ch_zipcode, flagcheck: flag},
					success: function(data) {
						if (typeof(data.type) != "undefined" && data.type !== null) {
							error = true;

							modal_alert.find('.content').html(data.msg);
							$('#alert_window').modal('show');

							setTimeout( function() {
								$('#alert_window').modal('hide');
							}, 1500);
						}
						else {
							reload_view(data, 'desktop');
							reload_view(data, 'mobile');
							parsing_address(data.address);
						}
					}
				});	
			}
			// address sudah ada tapi ambil data dari select address
			else {
				$.ajax({
					url: action,
					type: 'post',
					dataType: 'json',
					async: false,
					data: {address_id: id},
					success: function(data) {
						if (typeof(data.type) != "undefined" && data.type !== null) {
							error = true;

							modal_alert.find('.content').html(data.msg);
							$('#alert_window').modal('show');

							setTimeout( function() {
								$('#alert_window').modal('hide');
							}, 1500);
						}
						else {
							reload_view(data, 'desktop');
							reload_view(data, 'mobile');
							parsing_address(data.address);
						}
					}
				});	
			}
		}

		return error;
	}

	/**
	 * [function reload view page section review pesanan]
	 * 
	 * @param  param {element parsing from json}
	 * @param  type {desktop/mobile}
	 */
	function reload_view(param, type){
		$.ajax({
			url: param.action,
			data: {model : type },
			success: function(result) {
				tmp_div = $('#section_checkout_order_'+ type);
				tmp_div.html(result);
			}
		});
	}

	/**
	 * [function get ajax voucher]
	 * 
	 * @param  e {element input kode voucher}
	 * @return gv {return dari json}
	 */
	function get_voucher (e) {
		value = e.val();
		action = e.attr('data-action');
		gv = '';
		$.ajax({
			url: action,
			type: 'post',
			dataType: 'json', 
			async: false,
			data: {voucher: value},
			beforeSend: function() {
				$('.loading_voucher').removeClass('hide');
			},
			success: function(data) {
				gv = data;
			}
		});
		return gv;
	}

	/**
	 * [function show voucher modal]
	 * 
	 * @param  e {data dari json}
	 * @param  p {elemet input dari kode voucher}
	 */
	function show_voucher (e, p) {
			if (e.type=='success')
			{
				error = false;
				panel_voucher = $('.panel_form_voucher');
				modal_notif = $('.modal-notif');
				modal_notif.find('.title').children().html('');
				modal_notif.find('.content').html(e.msg);

				set_voucher_id(p);

				if (e.discount==true) {
					$('.shipping_cost').text('IDR 0');
					$('.shipping_cost').attr('data-s', 0);
					$('.shipping_cost').attr('data-v', 1);
				}

				setTimeout( function() {
					$('.loading_voucher').addClass('hide');
					panel_voucher.html('<p class="pl-sm pr-sm mb-0">'+e.msg+'</p>');
				}, 2000);

				$('#notif_window').modal('show');
			}
			else if (e.type=='error')
			{
				error = true;
				setTimeout( function() {
					$('.loading_voucher').addClass('hide');
				}, 1000);
				
				msg = '';
				$.each(e.msg, function (index, value) {
					msg += '<p class="mb-5"> - '+ value +'</p>';
				});

				modal_notif = $('#alert_window');
				modal_notif.find('.content').html(msg);

				p.addClass('error');

				modal_notif.modal('show');

				setTimeout( function() {
					modal_notif.modal('hide');
				}, 1500);
			}

			return error;
		}

	/*
	*	function set voucher id
	*	@param input code object 
	*/
	function set_voucher_id (e) {
		val = e.val();
		$('.voucher_code').val(val);
	}

	/**
	 * [function parsing address to input form]
	 * 
	 * @param  e {hasil data respon dari json}
	 */
	function parsing_address (e) {
		ch_name = $('.ch_name');
		ch_address = $('.ch_address');
		ch_zipcode = $('.ch_zipcode');
		ch_phone = $('.ch_phone');

		if (typeof e !== 'undefined' && e != null) {
			ch_name.val(e.receiver_name);
			ch_address.val(e.address);
			ch_zipcode.val(e.zipcode);
			ch_phone.val(e.phone);
		} else {
			ch_name.val('');
			ch_address.val('');
			ch_zipcode.val('');
			ch_phone.val('');
		}
	}

	function add_gift() {
		extension_id = [];
		extension_price = [];
		extension_value = [];
		extension_flag = [];

		$('.extension_id').each( function() {
			extension_id.push($(this).val());
		});

		$('.extension_price').each( function() {
			extension_price.push($(this).val());
		});

		$('.extension_value').each( function() {
			extension_value.push($(this).val());
		});

		$('.extension_flag').each(function() {
			extension_flag.push($(this).val());
		});

		

		console.log(extension_id);
		console.log(extension_price);
		console.log(extension_value);
		console.log(extension_flag);
	}

	// function count_sub_total() {
	// 	var to = $.trim($("#total").text().replace(/\./g, '')).substring(4);
	// 	var sc = ($(".shippingcost").first().text().replace(/\./g, '')).substring(4);
	// 	var yp = ($("#point").text().replace(/\./g, '')).substring(4);
	// 	st = 0;
	// 	uqnum = parseInt($('.uniquenumber').attr('data-unique'));
	// 	to = parseInt(to);
	// 	sc = parseInt(sc);
	// 	yp = parseInt(yp);

	// 	if(isNaN(sc)) {
	// 		sc = 0;
	// 	}
	// 	st = ((to + sc - yp)-uqnum);
	// 	if (st && st < 0) {
	// 		st = 'IDR ' + 0;
	// 	} else {	
	// 		st = 'IDR ' + st;
	// 	}
	// 	// console.log(st);
	// 	$(".subtotal").text(addCommas(st));

	// 	function addCommas(nStr)
	// 	{
	// 		nStr += '';
	// 		x = nStr.split('.');
	// 		x1 = x[0];
	// 		x2 = x.length > 1 ? '.' + x[1] : '';
	// 		var rgx = /(\d+)(\d{3})/;
	// 		while (rgx.test(x1)) {
	// 			x1 = x1.replace(rgx, '$1' + '.' + '$2');
	// 		}
	// 		return x1 + x2;
	// 	};
	// }

	/*
	* jquery validate form
	*/
	var current = 0;
	$('label.required').append('&nbsp;<strong>*</strong>&nbsp;');
	$.validator.addMethod("page_required", function(value, element) {
		var $element = $(element)
		function match(index) {
			return current == index && $(element).parents("#sc" + (index + 1)).length;
		}
		if (match(0) || match(1) || match(2)) {
			return !this.optional(element);
		}
		return "dependency-mismatch";
	}, $.validator.messages.required)

	var v = $("#checkout-form").validate({
		errorClass: "warning",
		onkeyup: false,
		onfocusout: false
	});

	/**
	 * [event button step click]
	 * 
	 * @var target section yang akan dituju
	 * @var value section saat ini
	 * @var param nomor section yang akan dituju
	 * @var to_ajax ajax yg akan dipanggil
	 * @var type tipe dari button prev/next
	 * @var section nama section untuk lempar ke url
	 */
	$('.btn_step').click(function() {
		target = $(this).attr('data-target');
		param = $(this).attr('data-param');
		value = $(this).attr('data-value');
		type = $(this).attr('data-type');
		to_ajax = $(this).attr('data-event');
		section = $(this).attr('data-url');

		if (type=='next') {
			// jika form semua valid terisi
			if (v.form()) {
				current = param;
				get_check = check_ajax_choice(to_ajax, $(this));
				if (get_check!=true) {
					show_section(target, value);
					window.history.pushState("", "", section);
				}
			}
		} 
		else {
			current = param;
			show_section(target, value);
			window.history.pushState("", "", section);
		}
	});

	/**
	 * [function check ajax yang akan dipanggil]
	 * 
	 * @param  ajax {check nama ajax yang akan dipanggil}
	 * @param  e {element button}
	 * @return {return false/true }
	 */
	function check_ajax_choice(ajax, e) {
		param_check = false;
		if (ajax=='address') {
			param_check = check_address(e);
		}
		else if (ajax=='voucher') {
			input_voucher = $('.voucher_desktop').val();
			if (typeof(input_voucher) != "undefined" && input_voucher !== null) {
				// param_check = check_voucher();
				
			}
		}
		else if (ajax=='gift') {
			add_gift();
		}
		else if (ajax=='submit') {

		}
		return param_check;
	}

	/**
	 * [function show/hide section yang aktif]
	 * 
	 * @param  next {section yang akan dituju}
	 * @param  now {section saat ini}
	 */
	function show_section(next, now) {
		$(now).addClass('hide');
		$(next).removeClass('hide');

		$('.step-checkout').find('div[data-section="' +next+ '"]').addClass('active');
		$('.step-checkout').find('div[data-section="' +now+ '"]').removeClass('active');
	}