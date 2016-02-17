@extends('web_v2.page_templates.layout')

@section('content')
	<div class="row mb-md">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			<ul class="list-inline checkout-step text-light">
				<li class="text-md pt-md pb-md active" data-part="#pengiriman">Pengiriman</li>
				<li class="text-md pt-md pb-md ml-lg mr-lg" data-part="#voucher">Voucher</li>
				<li class="text-md pt-md pb-md" data-part="#review">Check & Review Pesanan</li>
			</ul>
		</div>
	</div>

	<!-- SECTION FORM CHECKOUT -->
	{!! Form::open(['url' => route('my.balin.checkout.post'), 'method' => 'POST', 'novalidate' => 'novalidate', 'class' => 'no_enter']) !!}
		{!! Form::hidden('voucher_id', (isset($data['voucher_id']) ? $data['voucher_id'] : ''), ['class' => 'voucher_code']) !!}
		{!! Form::hidden('order_id', $data['order']['data']['id']) !!}

		<div class="row mr-0 ml-0">
			<div class="col-sm-12 pt-md pb-md">
				<div id="pengiriman" class="">
					@include('web_v2.components.checkout.address')
				</div>
				<div id="voucher" class="hide">
					@include('web_v2.components.checkout.voucher')
				</div>
			</div>
		</div>

		<!-- SECTION CHECKBOX TERM & CONDITION FOR MOBILE & TABLET -->
		<div class="col-xs-12 hidden-lg hidden-md pt-sm">
			<div class="checkbox i-checks">
				<label class="text-regular"> 
					<input type="checkbox" value="1" name="term" class="" required>
					Saya menyetujui <a href="#" class="link-black unstyle vertical-baseline" data-toggle="modal" data-target="#tnc"><strong>Syarat & Ketentuan</strong></a> pembelian barang di Balin.
				</label>
			</div>
		</div>
		<!-- END SECTION CHECKBOX TERM & CONDITION FOR MOBILE & TABLET  -->

		<!-- SECTION BUTTON CHECKOUT FOR MOBILE & TABLET -->
		<div class="clearfix">&nbsp;</div>
		<div class="row p-b-md p-t-xs hidden-md hidden-lg">
			<div class="col-md-12">
				<div class="form-group text-right">
					<button type="submit" class="btn btn-black-hover-white-border-black btn-block text-lg" tabindex="7">Checkout</button>
				</div>        
			</div>        
		</div>  			
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
@stop

@section('js_plugin')
	@include('web_v2.plugins.notif')
@stop
