	$('.choice_address').on('change', function() {
		var val = $(this).val();
		action = $(this).find(':selected').attr('data-action');
		if (val == 0) {
			jQuery('#zipcode').on('input propertychange paste', function() {
				get_shipping_cost( {'zipcode' : $( "#zipcode" ).val()}, action );
			});	
			ga = get_address($(this));
			parsing_address(ga);
		}
		else {
			get_shipping_cost( {'address_id' : $( "#address_id" ).val()}, action );
			ga = get_address($(this));
			parsing_address(ga);
		}
	});

	$('button.voucher_desktop').click( function() {
		inp = $('input.voucher_desktop');
		voucher = get_voucher(inp);
		show_voucher(voucher, inp);
		count_sub_total();
	});

	$('.ch_zipcode').focusout( function() {
		val = $(this).val();
		action = $(this).attr('data-action');
		get_shipping_cost( {'zipcode' : $( "#zipcode" ).val()}, action);
	});

	function get_shipping_cost (e, action) {
		cv = parseInt($('.shipping_cost').attr('data-v'));
		$.post( action, e).done(function( data ) {
			if (cv==0) {
				$(".shipping_cost").text(data.address.cost);
			}
			$(".shipping_cost").attr('data-s', (data.address.cost.replace(/\./g, '')).substring(4));
			count_sub_total();
		});
	}

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

	function set_voucher_id (e) {
		val = e.val();
		$('.voucher_code').val(val);
	}

	function get_address (e) {
		val = e.find(':selected').attr('value');
		ga = null;

		if (val!==0) {
			act = e.find(':selected').data('action');
			$.ajax({
				url: act,
				type: 'post',
				async: false,
				dataType: 'json',
				data: {id: val},
				success: function(data) {
					ga = data.address;
				}
			});
		}
		return ga;
	}

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