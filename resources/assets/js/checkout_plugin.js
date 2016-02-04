	/*
	*	function pilih address
	*	
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

	$('button.voucher_desktop').click( function() {
		inp = $('input.voucher_desktop');
		voucher = get_voucher(inp);
		show_voucher(voucher, inp);
		count_sub_total();
	});

	/*
	*	function check address
	*	
	*/
	$('.check_address').click( function() {
		ch_address_id	= $('.choice_address').val();
		action 			= $(this).attr('data-action');
		
		get_shipping_cost(ch_address_id, action, 1);
		
	});

	/*
	*	function get shipping cost
	*	@param id, action
	*/
	function get_shipping_cost(id, action, flag) {
		ch_name 		= $('.ch_name').val();
		ch_phone		= $('.ch_phone').val();
		ch_address 		= $('.ch_address').val();
		ch_zipcode		= $('.ch_zipcode').val();
		
		cv = parseInt($('.shipping_cost').attr('data-v'));

		if (id == 0) {
			$.ajax({
				url: action,
				type: 'post',
				dataType: 'json',
				data: {name: ch_name, phone: ch_phone, address: ch_address, zipcode: ch_zipcode},
				success: function(data) {
					if (typeof(data.type) != "undefined" && data.type !== null) {
						console.log(data.msg[0]);
					}
					else {
						$('.section_order').html(data);
						parsing_address(data.address);
					}
				}
			});
		}
		// call ajax but set address_id
		else {
			if (flag == 1){
				console.log('ada flag');
				$.ajax({
					url: action,
					type: 'post',
					dataType: 'json',
					data: {address_id: id, name: ch_name, phone: ch_phone, address: ch_address, zipcode: ch_zipcode, flagcheck: flag},
					success: function(data) {
						if (typeof(data.type) != "undefined" && data.type !== null) {
							console.log(data.msg[0]);
						}
						else {
							$('.section_order').html(data);
							parsing_address(data.address);
						}
					}
				});	
			}
			else {
				console.log('tidak ada flag');
				$.ajax({
					url: action,
					type: 'post',
					dataType: 'json',
					data: {address_id: id},
					success: function(data) {
						if (typeof(data.type) != "undefined" && data.type !== null) {
							console.log(data.msg[0]);
						}
						else {
							$('.section_order').html(data);
							parsing_address(data.address);
						}
						// if (cv==0) {
						// 	$(".shipping_cost").text(data.shipping_cost);
						// }
						// $(".shipping_cost").attr('data-s', (data.shipping_cost.replace(/\./g, '')).substring(4));
						// count_sub_total();
					}
				});	
			}
		}
	}

	/*
	*	function get voucher from ajax
	*	@param data object input code
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
				// $('.loading_voucher').addClass('hide');
				gv = data;
			}
		});

		return gv;
	}

	/*
	*	function show notif modal 
	*	@param data parsing and object input
	*/
	function show_voucher (e, p) {
		if (e.type=='success')
		{
			panel_voucher = $('.panel_form_voucher');
			//panel_voucher_device = $('.panel-form-voucher-device');
			modal_notif = $('.modal_notif');
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
				panel_voucher_device.html('<p class="m-b-none text-center">'+e.msg+'</p>');
			}, 2000);

			$('#notif_window').modal('show');
		}
		else if (e.type=='error')
		{
			setTimeout( function() {
				$('.loading_voucher').addClass('hide');
			}, 1000);
			
			modal_notif = $('.modal-notif');
			modal_notif.find('.title').children().html('');
			modal_notif.find('.content').html(e.msg);

			p.addClass('error');

			$('#notif_window').modal('show');
		}
	}

	/*
	*	function set voucher id
	*	@param input code object 
	*/
	function set_voucher_id (e) {
		val = e.val();
		$('.voucher_code').val(val);
	}

	/*
	*	function parsing address from ajax to form input
	*	@param data parsing
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
		count_sub_total();
	}

	function count_sub_total() {
		var to = $.trim($("#total").text().replace(/\./g, '')).substring(4);
		var sc = ($(".shippingcost").first().text().replace(/\./g, '')).substring(4);
		var yp = ($("#point").text().replace(/\./g, '')).substring(4);
		st = 0;
		uqnum = parseInt($('.uniquenumber').attr('data-unique'));
		to = parseInt(to);
		sc = parseInt(sc);
		yp = parseInt(yp);

		if(isNaN(sc)) {
			sc = 0;
		}
		st = ((to + sc - yp)-uqnum);
		if (st && st < 0) {
			st = 'IDR ' + 0;
		} else {	
			st = 'IDR ' + st;
		}
		// console.log(st);
		$(".subtotal").text(addCommas(st));

		function addCommas(nStr)
		{
			nStr += '';
			x = nStr.split('.');
			x1 = x[0];
			x2 = x.length > 1 ? '.' + x[1] : '';
			var rgx = /(\d+)(\d{3})/;
			while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + '.' + '$2');
			}
			return x1 + x2;
		};
	}