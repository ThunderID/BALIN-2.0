<div class="row panel_form_voucher">
	<div class="col-xs-8 col-xs-offset-2 col-sm-8 col-xs-offset-2 col-md-8 col-xs-offset-2 bg-white border-1 border-solid border-grey-light">
		<div class="content_checkout">
			<div class="row ml-0 mr-0 pt-xs mt-md ">
				<div class="col-md-2 col-sm-2 border-bottom-1 border-grey-light text-grey-dark">
					<p class="mb-5">Produk</p>
				</div>
				<div class="col-md-10 col-sm-10 border-bottom-1 border-grey-light text-grey-dark">
					<div class="row">
						<div class="col-sm-2 col-md-2"></div>
						<div class="col-sm-3 col-md-3">
							<p class="text-right mr-sm mb-5">Harga</p>
						</div>
						<div class="col-sm-1 col-md-1">
							<p class="text-center mb-5">Kuantitas</p>
						</div>
						<div class="col-sm-3 col-md-3">
							<p class="text-right mb-5">Diskon</p>
						</div>
						<div class="col-md-3 col-sm-3">
							<p class="text-right mr-sm mb-5">Total</p>
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
						"item_list_discount_price"		=> (isset($item['promo_price'])&&($item['promo_price']!=0)) ? ($item['price']-$item['promo_price']) : 0,
						"item_list_total_price"			=> (isset($item['promo_price'])&&($item['promo_price']!=0)) ? ($item['promo_price']*$qty) : ($item['price']*$qty),
						"item_varians"					=> $item['varians'],
						"item_list_slug"				=> $item['slug'],
						"item_mode"						=> 'new',
					))
					<?php $total += (isset($item['promo_price'])&&($item['promo_price']!=0)) ? ($item['promo_price']*$qty) : ($item['price']*$qty); ?>
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
			<div class="row ml-0 mr-0 hidden-sm hidden-xs" id='section_checkout_order_desktop'>
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
								<span class="text-regular text-right {{ ($data['order']['data']['voucher_discount']==0) ? 'text-black' : 'text-red' }} voucher_discount" data-unique="{{ $data['order']['data']['voucher_discount'] }}">
									@if ($data['order']['data']['voucher_discount']==0)
										@money_indo($data['order']['data']['voucher_discount'])
									@else
										@money_indo_negative($data['order']['data']['voucher_discount'])
									@endif
								</span>
							</div>
						</div>
						<div class="row m-l-none m-r-none">
							<div class="col-lg-5 col-lg-offset-2 col-md-5 col-md-offset-2 col-sm-5 col-sm-offset-2 text-left">
								<h4 class="text-md">Total Pembayaran</h4>
							</div>
							<div class="col-lg-5 col-md-5 col-sm-5">
								<h4 class="text-md text-right text-bold mb-sm sub_total">
									<?php 
										$total_pembayaran = $total - $data['my_point'] - $data['order']['data']['voucher_discount'] - $data['order']['data']['unique_number'] + $data['order']['data']['shipping_cost'];
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
		<div class="row pt-md pb-md">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<a href="javascript:void(0);" class="btn btn-transaparent-border-black-hover-black btn_next" data-action="{ route('my.balin.checkout.voucher') }}" data-next="#voucher" data-now="#review" data-url="{{ route('my.balin.checkout.get', ['section' => 'voucher']) }}">Kembali</a>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
				<a href="javascript:void(0);" class="btn btn-black-hover-white-border-black btn_next" data-action="{ route('my.balin.checkout.voucher') }}" data-next="" data-now="#review" data-url="{{ route('my.balin.checkout.get', ['section' => 'shipped']) }}">Checkout</a>
			</div>
		</div>
	</div>
</div>