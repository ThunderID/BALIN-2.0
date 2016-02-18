@extends('web_v2.page_templates.layout')

@section('content')
	{{-- <div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			<div id="checkout-step">
			    <h2>Pengiriman</h2>
			    <section>
			        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut nulla nunc. Maecenas arcu sem, hendrerit a tempor quis, 
			            sagittis accumsan tellus. In hac habitasse platea dictumst. Donec a semper dui. Nunc eget quam libero. Nam at felis metus. 
			            Nam tellus dolor, tristique ac tempus nec, iaculis quis nisi.</p>
			    </section>

			    <h2>Kode Voucher</h2>
			    <section>
			        <p>Donec mi sapien, hendrerit nec egestas a, rutrum vitae dolor. Nullam venenatis diam ac ligula elementum pellentesque. 
			            In lobortis sollicitudin felis non eleifend. Morbi tristique tellus est, sed tempor elit. Morbi varius, nulla quis condimentum 
			            dictum, nisi elit condimentum magna, nec venenatis urna quam in nisi. Integer hendrerit sapien a diam adipiscing consectetur. 
			            In euismod augue ullamcorper leo dignissim quis elementum arcu porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
			            Vestibulum leo velit, blandit ac tempor nec, ultrices id diam. Donec metus lacus, rhoncus sagittis iaculis nec, malesuada a diam. 
			            Donec non pulvinar urna. Aliquam id velit lacus.</p>
			    </section>

			    <h2>Check & Review Pesanan</h2>
			    <section>
			        <p>Morbi ornare tellus at elit ultrices id dignissim lorem elementum. Sed eget nisl at justo condimentum dapibus. Fusce eros justo, 
			            pellentesque non euismod ac, rutrum sed quam. Ut non mi tortor. Vestibulum eleifend varius ullamcorper. Aliquam erat volutpat. 
			            Donec diam massa, porta vel dictum sit amet, iaculis ac massa. Sed elementum dui commodo lectus sollicitudin in auctor mauris 
			            venenatis.</p>
			    </section>
			</div>
		</div>
	</div> --}}


	<div class="row mb-md ml-0 mr-0">
		<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 text-center">
			<div class="step-checkout text-light row">
				<div class="col-xs-3 col-sm-3 col-md-3" data-section="#sc1">
					<span>Pengiriman</span>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3" data-section="#sc2">
					<span>Kode Voucher</span>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3" data-section="#sc3">
					<span>Bingkisan Tambahan</span>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3" data-section="#sc4">
					<span>Check & Review Pesanan</span>
				</div>
			</div>
		</div>
	</div>

	<!-- SECTION FORM CHECKOUT -->
	{!! Form::open(['url' => route('my.balin.checkout.post'), 'method' => 'POST','class' => 'no_enter', 'id' => 'checkout-form']) !!}
		{!! Form::hidden('voucher_id', (isset($data['voucher_id']) ? $data['voucher_id'] : ''), ['class' => 'voucher_code']) !!}
		{!! Form::hidden('order_id', $data['order']['data']['id']) !!}

		<div class="row pb-md">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<ul id="" class="list-unstyled">
					<li id="sc1" class="hide">
						<a href="#"></a>
						<div>
							<fieldset>
								@include('web_v2.components.checkout.address')
							</fieldset>
						</div>
					</li>
					<li id="sc2" class="hide">
						<a href="#"></a>
						<div>
							<fieldset>
								@include('web_v2.components.checkout.voucher')
							</fieldset>
						</div>
					</li>
					<li id="sc3" class="hide">
						<a href="#"></a>
						<div>
							<fieldset>
								@include('web_v2.components.checkout.accessories')
							</fieldset>
						</div>
					</li>
					<li id="sc4" class="hide">
						<a href="#"></a>
						<div>
							<fieldset>
								@include('web_v2.components.checkout.review')
							</fieldset>
						</div>
					</li>
				</ul>
			</div>
		</div>

		{{-- <div class="row mr-0 ml-0">
			<div class="col-sm-12 pt-md pb-md">
				<div id="shipped" class="hide">
					
				</div>
				<div id="voucher" class="hide">
					@include('web_v2.components.checkout.voucher')
				</div>
				<div id="review" class="hide">
					@include('web_v2.components.checkout.review')
				</div>
			</div>
		</div> --}}

		<!-- SECTION CHECKBOX TERM & CONDITION FOR MOBILE & TABLET -->
		{{-- <div class="col-xs-12 hidden-lg hidden-md pt-sm">
			<div class="checkbox i-checks">
				<label class="text-regular"> 
					<input type="checkbox" value="1" name="term" class="" required>
					Saya menyetujui <a href="#" class="link-black unstyle vertical-baseline" data-toggle="modal" data-target="#tnc"><strong>Syarat & Ketentuan</strong></a> pembelian barang di Balin.
				</label>
			</div>
		</div> --}}
		<!-- END SECTION CHECKBOX TERM & CONDITION FOR MOBILE & TABLET  -->

		<!-- SECTION BUTTON CHECKOUT FOR MOBILE & TABLET -->
		{{-- <div class="clearfix">&nbsp;</div>
		<div class="row p-b-md p-t-xs hidden-md hidden-lg">
			<div class="col-md-12">
				<div class="form-group text-right">
					<button type="submit" class="btn btn-black-hover-white-border-black btn-block text-lg" tabindex="7">Checkout</button>
				</div>        
			</div>        
		</div>  --}} 			
		<!-- END SECTION BUTTON CHECKOUT FOR MOBILE & TABLET -->
	{!! Form::close() !!}


	<!-- Term and Condition -->
	<div id="tnc" class="modal modal-left fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center" id="exampleModalLabel">Syarat & Ketentuan</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12" style="color: #000">
							
						</div>
					</div>
					<div class="row m-t-md">
						<div class="col-md-12">
							<button type="button" class="btn-hollow hollow-black-border" data-dismiss="modal" aria-label="Close">Tutup</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	

<!-- Modal Balance -->
<div id="modal-balance" class="modal modal-unique-number fade user-page" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
				<h5 class="modal-title" id="exampleModalLabel">Pengenal Pembayaran </h5>
			</div>
			<div class="modal-body mt-75 mobile-m-t-0" style="text-align:left">
				Pengenal Pembayaran adalah kode atau angka yang kami gunakan untuk mempermudah bagian finance (keuangan) kami dalam mengenali dana pembayaran yang masuk ke rekening kami. 
				Berbeda dengan toko online lainnya dimana kode seperti ini biasanya akan menambah jumlah pembayaran pelanggan, angka yang kami gunakan selalu minus, sehingga nilai pembayaran yang baru selalu lebih kecil dari nilai yang sebelumnya. Dengan demikian, para pelanggan kami tidak akan merasa dirugikan sepeserpun. 
				Saat ini, Pengenal Pembayaran ini hanya berlaku untuk metode pembayaran transfer saja.
			</div>
		</div>
	</div>
</div>

@stop

@section('js')
	$(".modal-fullscreen").on('show.bs.modal', function () {
		setTimeout( function() {
			$(".modal-backdrop").addClass("modal-backdrop-fullscreen");
		}, 0);
	});
	$(".modal-fullscreen").on('hidden.bs.modal', function () {
		$(".modal-backdrop").addClass("modal-backdrop-fullscreen");
	});

	@if (Input::get('section'))
		$( document ).ready(function() {
		    $('#{!! Input::get('section') !!}').removeClass('hide');
		    $('.step-checkout').find('div[data-section="#{!! Input::get('section') !!}"]').addClass('active');
		});
	@else
		$( document ).ready(function() {
		    $('#sc1').removeClass('hide');
		    $('.step-checkout').find('div[data-section="#sc1"]').addClass('active');
		});
	@endif

	$('.btn_accessories').click(function(){
		sub = $(this).parent().parent().find('.gift-value');
		sub_check = $(this).attr('data-check');
		flag = $(this).parent().parent().find('.extension_flag');

		if (sub_check==1) {
			$(sub).addClass('hide');
			$(this).attr('data-check', 0);
			$(this).text('Pilih');
			flag.val('0');
		}
		else {
			$(sub).removeClass('hide');
			$(this).attr('data-check', 1);
			$(this).text('Batal');
			flag.val('1');
		}
	});
@stop

@section('js_plugin')
	@include('web_v2.plugins.notif')

@stop
