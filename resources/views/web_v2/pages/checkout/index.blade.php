@extends('web_v2.page_templates.layout')

@section('content')
	<!-- SECTION FORM CHECKOUT -->
	{!! Form::open(['url' => route('my.balin.checkout.post'), 'method' => 'POST', 'novalidate' => 'novalidate', 'class' => 'no_enter']) !!}
		{!! Form::hidden('voucher_id', '', ['class' => 'voucher_code']) !!}
		{!! Form::hidden('order_id', $data['order']['data']['id']) !!}
		<div class="row">
			@if ($data['carts'])
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			@else
				<div class="col-xs-12 col-sm-12 col-md-12">
			@endif

				<!-- SECTION PRODUCT IN CART -->
				<div class="row ml-0 mr-0 border-1 border-solid border-grey-light pt-xs hidden-xs">
					<div class="col-md-2 col-sm-2 hidden-xs">
						<p class="">Produk</p>
					</div>
					<div class="col-md-10 col-sm-10 hidden-xs">
						<div class="row">
							<div class="col-sm-2 col-md-2"></div>
							<div class="col-sm-3 col-md-3">
								<p class="text-right mr-sm">Harga</p>
							</div>
							<div class="col-sm-1 col-md-1">
								<p class="text-center">Kuantitas</p>
							</div>
							<div class="col-sm-3 col-md-3">
								<p class="text-right">Diskon</p>
							</div>
							<div class="col-md-3 col-sm-3">
								<p class="text-right mr-sm">Total</p>
							</div>
						</div>
					</div>
				</div>

				@if ($data['carts'])
					<?php $total = 0; ?>
					@foreach ($data['carts'] as $k => $item)
						<?php
							$qty 			= 0;
							foreach ($item['varians'] as $key => $value) 
							{
								$qty 		= $qty + $value['quantity'];
							}
						?>

						<!-- SECTION ITEM LIST PRODUCT CHECKOUT -->
						@include('web_v2.components.checkout.item_list_checkout', array(
							"item_list_id"					=> $k,
							"item_list_image"				=> $item['thumbnail'],
							"item_list_name" 				=> $item['name'],
							"item_list_qty"					=> $qty,
							"item_list_normal_price"		=> $item['price'],
							"item_list_size"				=> $item['varians'],
							"item_list_discount_price"		=> $item['discount'],
							"item_list_total_price"			=> (($item['price']-$item['discount'])*$qty),
							"item_varians"					=> $item['varians'],
							"item_list_slug"				=> $item['slug'],
							"item_mode"						=> 'new',
						))
						<?php $total += (($item['price']-$item['discount'])*$qty); ?>
						<!-- END SECTION ITEM LIST PRODUCT CHECKOUT -->
					@endforeach
				@else
					<div class="row chart">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h4 class="text-center">Tidak ada item di cart</h4>
						</div>
					</div>
				@endif
				<!-- END SECTION PRODUCT IN CART -->

				<!-- SECTION INFO TOTAL PRODUCT & TOTAL PEMBAYARAN FOR DESKTOP -->
				<div class="row border-right-1 border-left-1 border-bottom-1 border-grey-light ml-0 mr-0 hidden-sm hidden-xs ">
					@if ($data['carts'])
						<div class="col-lg-12 col-md-12 checkout-bottom panel-subtotal" id="panel-subtotal-normal">
							<div class="row mt-sm">
								<div class="col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2 text-left text-left border-bottom">
									<span class="text-regular">Subtotal</span>
								</div>
								<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right border-bottom">
									<span class="text-regular text-right" id="total">@money_indo($total)</span>
								</div>
							</div>
							<div class="row m-l-none m-r-none">
								<div class="col-lg-5 col-lg-offset-2 col-md-5 col-md-offset-2 col-sm-5 col-sm-offset-2 text-left">
									<span class="text-regular">Point Anda</span>
								</div>
								<div class="col-lg-5 col-md-5 col-sm-5 text-right">
									<span class="text-regular text-right" id="point">@money_indo($data['my_point'])</span>
								</div>	
							</div>
							<div class="row m-l-none m-r-none">
								<div class="col-lg-5 col-lg-offset-2 col-md-5 col-md-offset-2 col-sm-5 col-sm-offset-2 text-left">
									<span class="text-regular">Biaya Pengiriman</span>
								</div>
								<div class="col-lg-5 col-md-5 col-sm-5 text-right">
									<span class="text-regular text-right shipping_cost" data-s="0" data-v="0">@money_indo($data['order']['data']['shipping_cost'])</span>
								</div>	
							</div>
							<div class="row m-l-none m-r-none">
								<div class="col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2 text-left border-bottom">
									<span class="text-regular">
										Potongan Voucher
									</span>
								</div>
								<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right border-bottom">
									<span class="text-regular text-right text-red voucher_discount" data-unique="{{ $data['order']['data']['voucher_discount'] }}">@money_indo_negative($data['order']['data']['voucher_discount'])</span>
								</div>
							</div>
							<div class="row m-l-none m-r-none">
								<div class="col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2 text-left border-bottom">
									<span class="text-regular">
										Pengenal Pembayaran <a href="#" class="link-grey hover-black" data-toggle="modal" data-target=".modal-unique-number"><i class="fa fa-question-circle"></i></a>
									</span>
								</div>
								<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right border-bottom">
									<span class="text-regular text-right text-red unique_number" data-unique="{{ $data['order']['data']['unique_number'] }}">@money_indo_negative($data['order']['data']['unique_number'])</span>
								</div>
							</div>
							<div class="row m-l-none m-r-none">
								<div class="col-lg-5 col-lg-offset-2 col-md-5 col-md-offset-2 col-sm-5 col-sm-offset-2 text-left">
									<h4 class="text-md">Total Pembayaran</h4>
								</div>
								<div class="col-lg-5 col-md-5 col-sm-5">
									<h4 class="text-md text-right text-bold mb-sm sub_total">
										<?php 
											$total_pembayaran = $total - $data['my_point'] - $data['order']['data']['unique_number'];
										?>
										@if ($total_pembayaran && $total_pembayaran < 0)
											@money_indo(0)
										@else
											@money_indo($total_pembayaran)
										@endif
									</h4>
								</div>	
							</div>
						</div>
					@endif
				</div>
				<!-- END SECTION INFO TOTAL PRODUCT & TOTAL PEMBAYARAN  FOR DESKTOP -->
			</div>

			@if ($data['carts'])
				<!-- SECTION FORM DETAIL INFORMATION SHIPPING -->
				<div class="hidden-md hidden-lg clearfix">&nbsp;</div>
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<div class="row mr-0 ml-0 mb-md pt-lg pb-lg border-1 border-solid border-grey-light bg-white panel_form_voucher">
						<div class="col-md-12 mb-sm">
							<span class="text-lg voucher-title">Punya Promo Code ?</span>
						</div>	
						<div class="col-md-12 mb-xs">
							<span class="text-regular text-grey">Jika anda punya kode voucher, masukkan kode voucher anda dapatkan hadiahnya.</span>
							<div class="input-group mt-xs" style="position:relative">
								<div class="text-center hide loading loading_voucher">
									{!! HTML::image('images/loading.gif', null, []) !!}
								</div>
								{!! Form::input('text', 'voucher', null, [
									'class' => 'form-control hollow transaction-input-voucher-code m-b-sm text-regular voucher_desktop',
									'placeholder' => 'Voucher code',
									'data-action' => route('my.balin.checkout.voucher')
								]) !!}
								<span class="input-group-btn">
									<button type="button" class="btn btn-black-hover-white-border-black voucher_desktop" data-action="{{ route('my.balin.checkout.voucher') }}">Gunakan</button>
								</span>
							</div>
						</div>
					</div>
					<div class="row mr-0 ml-0 pt-sm border-left-1 border-right-1 border-bottom-1 border-grey-light bg-white">
						<div class="col-xs-12 col-sm-12 col-md-12" >
							<div class="row mt-sm mb-sm">
								<div class="m-t-sm hidden-lg hidden-md hidden-sm col-xs-12">
									<span class="m-t-none m-b-md text-lg">Alamat Pengiriman</span>
								</div>						
								<div class="col-md-12 hidden-xs">
									<span class="text-lg">Alamat Pengiriman</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="hollow-label text-regular" for="name">Pilih Alamat</label>
										<select class="form-control text-regular choice_address" name="address_id" id="address_id">
											<option value="0" selected>Tambah Alamat Baru</option>
											@foreach($data['my_address'] as $key => $value)
												<option value="{{$value['id']}}" data-action="{{ route('balin.checkout.shippingcost.get') }}">{{$value['address']}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="hollow-label text-regular" for="">Nama Penerima</label>
										{!! Form::input('text', 'receiver_name', Session::get('user_me')['name'], [
												'class' 	=> 'form-control text-regular ch_name',
										]) !!}
									</div>
								</div>
							</div>
							<div class="row new-address">
								<div class="col-md-12">
									<div class="form-group">
										<label class="hollow-label text-regular" for="">Alamat</label>
										{!! Form::textarea('address', null, [
												'class'			=> 'form-control text-regular ch_address',
												'rows'			=> '2',
												'style'     	=> 'resize:none;',
										]) !!}
									</div>
									<div class="form-group">
										<label class="hollow-label text-regular" for="">Kode Pos</label>
										{!! Form::input('number', 'zipcode', null, [
												'class' 		=> 'form-control text-regular ch_zipcode',
												'id'			=> 'zipcode',
												'data-action'	=> route('balin.checkout.shippingcost.get'),
												'min'			=> '0'
										]) !!}
									</div>
									<div class="form-group">
										<label class="hollow-label text-regular" for="">No. Telp</label>
										{!! Form::input('text', 'phone', null, [
												'class' 		=> 'form-control text-regular ch_phone',
										]) !!}
									</div>
								</div>
							</div>
							<div class="row hidden-xs hidden-sm">
								<div class="col-md-12">
									<div class="checkbox i-checks">
										<label class="text-regular"> 
											<input type="checkbox" value="1" name="term" required> Saya menyetujui <a href="#" class="link-black unstyle" data-toggle="modal" data-target="#tnc"><strong>Syarat & Ketentuan</strong></a> pembelian barang di Balin.
										</label>
									</div>
								</div>
							</div>
							<div class="clearfix">&nbsp;</div>
							<div class="row">
								<div class="col-md-12 hidden-xs hidden-sm">
									<div class="form-group text-right">
										<button type="submit" class="btn btn-black-hover-white-border-black" tabindex="7">Checkout</button>
									</div>        
								</div>        
							</div>  
						</div>
					</div>
				</div>
				<div class="clearfix hidden-xs">&nbsp;</div>
				<!-- END SECTION FORM DETAIL INFORMATION SHIPPING -->
			@endif
		</div>

		<!-- SECTION INFO TOTAL PRODUCT & TOAL PEMBAYARAN FOR MOBILE & TABLET -->
		@if ($data['carts'])
			<div class="row border-1 border-solid border-grey-light ml-0 mr-0 mt-sm hidden-md hidden-lg">
				<div class="col-lg-12 col-md-12 checkout-bottom panel-subtotal" id="panel-subtotal-normal">
					<div class="row mt-sm">
						<div class="col-xs-7 col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2 text-left text-left border-bottom">
							<span class="text-regular">Subtotal</span>
						</div>
						<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right border-bottom">
							<span class="text-regular text-right" id="total">@money_indo($total)</span>
						</div>
					</div>
					<div class="row m-l-none m-r-none">
						<div class="col-xs-7 col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2 text-left">
							<span class="text-regular">Balin Point Anda</span>
						</div>
						<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right">
							<span class="text-regular text-right" id="point">@money_indo(900000)</span>
						</div>	
					</div>
					<div class="row m-l-none m-r-none">
						<div class="col-xs-7 col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2 text-left">
							<span class="text-regular">Biaya Pengiriman</span>
						</div>
						<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right">
							<span class="text-regular text-right shipping_cost" data-s="0" data-v="0">@money_indo(12000)</span>
						</div>	
					</div>
					<div class="row m-l-none m-r-none">
						<div class="col-xs-7 col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2 text-left border-bottom">
							<span class="text-regular">
								Pengenal Pembayaran <a href="#" class="link-grey hover-black" data-toggle="modal" data-target=".modal-unique-number"><i class="fa fa-question-circle"></i></a>
							</span>
						</div>
						<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right border-bottom">
							<span class="text-regular text-right text-red unique_number" data-unique="{{ '112' }}">@money_indo_negative(112)</span>
						</div>
					</div>
					<div class="row m-l-none m-r-none">
						<div class="col-xs-7 col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2 text-left">
							<h4 class="text-md">Total Pembayaran</h4>
						</div>
						<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
							<h4 class="text-md text-right text-bold mb-sm sub_total">
								<?php $total_pembayaran = -200; ?>
								@if ($total_pembayaran && $total_pembayaran < 0)
									@money_indo(0)
								@else
									@money_indo($total_pembayaran)
								@endif
							</h4>
						</div>	
					</div>
				</div>
			</div>
		@endif
		<!-- END SECTION INFO TOTAL PRODUCT & TOTAL PEMBAYARAN FOR MOBILE & TABLET -->

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
		</div>
		<!-- END SECTION BUTTON CHECKOUT FOR MOBILE & TABLET -->
	{!! Form::close() !!}


	<!-- Term and Condition -->
	<div id="tnc" class="modal modal-left modal-fullscreen fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
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
<div id="modal-balance" class="modal modal-unique-number modal-fullscreen fade user-page" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
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
	@include('web_v2.plugins.notif', ['data' => ['title' => 'Terima Kasih', 'content' => 'Produk telah ditambahkan di cart']])
@stop
