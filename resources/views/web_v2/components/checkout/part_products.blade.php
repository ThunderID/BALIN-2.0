<?php 
// dd($data['order']); 
?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
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
					<div class="row">
						<div class="col-lg-5 col-lg-offset-2 col-md-5 col-md-offset-2 col-sm-5 col-sm-offset-2 text-left">
							<span class="text-regular">Point Anda</span>
						</div>
						<div class="col-lg-5 col-md-5 col-sm-5 text-right">
							<span class="text-regular text-right" id="point">@money_indo($data['order']['user']['total_point'])</span>
						</div>	
					</div>
					<div class="row">
						<div class="col-lg-5 col-lg-offset-2 col-md-5 col-md-offset-2 col-sm-5 col-sm-offset-2 text-left">
							<span class="text-regular">Biaya Pengiriman</span>
						</div>
						<div class="col-lg-5 col-md-5 col-sm-5 text-right">
							<span class="text-regular text-right shipping_cost" data-s="0" data-v="0">@money_indo($data['order']['shipping_cost'])</span>
						</div>	
					</div>
					<div class="row">
						<div class="col-lg-5 col-lg-offset-2 col-md-5 col-md-offset-2 col-sm-5 col-sm-offset-2 text-left">
							<span class="text-regular">Potongan Voucher</span>
						</div>
						<div class="col-lg-5 col-md-5 col-sm-5 text-right">
							<span class="text-regular text-right potongan_voucher">@money_indo($data['order']['voucher_discount'])</span>
						</div>	
					</div>
					<div class="row">
						<div class="col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2 text-left border-bottom">
							<span class="text-regular">
								Pengenal Pembayaran <a href="#" class="link-grey hover-black" data-toggle="modal" data-target=".modal-unique-number"><i class="fa fa-question-circle"></i></a>
							</span>
						</div>
						<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right border-bottom">
							<span class="text-regular text-right text-red unique_number" data-unique="{{ $data['order']['unique_number'] }}">@money_indo_negative($data['order']['unique_number'])</span>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-5 col-lg-offset-2 col-md-5 col-md-offset-2 col-sm-5 col-sm-offset-2 text-left">
							<h4 class="text-md">Total Pembayaran</h4>
						</div>
						<div class="col-lg-5 col-md-5 col-sm-5">
							<h4 class="text-md text-right text-bold mb-sm sub_total">
								<?php 
									$total_pembayaran = $total - $data['order']['user']['total_point'] - $data['order']['unique_number'];
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
			<div class="row">
				<div class="col-xs-7 col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2 text-left">
					<span class="text-regular">Point Anda</span>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right">
					<span class="text-regular text-right" id="point">@money_indo($data['order']['user']['total_point'])</span>
				</div>	
			</div>
			<div class="row">
				<div class="col-xs-7 col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2 text-left">
					<span class="text-regular">Biaya Pengiriman</span>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right">
					<span class="text-regular text-right shipping_cost" data-s="0" data-v="0">@money_indo($data['order']['shipping_cost'])</span>
				</div>	
			</div>
			<div class="row">
				<div class="col-xs-7 col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2 text-left">
					<span class="text-regular">Potongan Voucher</span>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right">
					<span class="text-regular text-right potongan_voucher">@money_indo($data['order']['voucher_discount'])</span>
				</div>	
			</div>
			<div class="row">
				<div class="col-xs-7 col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2 text-left border-bottom">
					<span class="text-regular">
						Pengenal Pembayaran <a href="#" class="link-grey hover-black" data-toggle="modal" data-target=".modal-unique-number"><i class="fa fa-question-circle"></i></a>
					</span>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right border-bottom">
					<span class="text-regular text-right text-red unique_number" data-unique="{{ $data['order']['unique_number'] }}">@money_indo_negative($data['order']['unique_number'])</span>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-7 col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2 text-left">
					<h4 class="text-md">Total Pembayaran</h4>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
					<h4 class="text-md text-right text-bold mb-sm sub_total">
						<?php 
							$total_pembayaran = $total - $data['order']['user']['total_point'] - $data['order']['unique_number'];
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
	</div>
@endif