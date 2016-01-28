<?php //dd($carts); ?>
<ul class="dropdown-menu dropdown-menu-right text-regular cart_dropdown" aria-labelledby="dLabel">
	@if (!empty($carts))
		<?php $total = 0; $i=0; ?>
		<div class="cart-content">
			<!-- SECTION CART DROPDOWN CONTENT -->
			@foreach ($carts as $k => $item)
				<?php
					$qty 			= 0;
					foreach ($item['varians'] as $key => $value) 
					{
						$qty 		= $qty + $value['quantity'];
					}
				?>

				<!-- SECTION CART DROPDOWN ITEM -->
				<li class="pb-xs {{ ($item != end($carts) ? 'border-bottom-1 border-grey-light' : '') }}">
					@include('web_v2.components.cart.cart_dropdown_item', [
						'label_id'				=> $k,
						'label_image'			=> $item['thumbnail'],
						'label_name'			=> $item['name'],
						'label_qty'				=> $item['varians'],
						'label_price'			=> ($item['discount']!=0 ? ($item['price'] - $item['discount']) : $item['price']),
						'label_total'			=> $qty*($item['discount']!=0 ? ($item['price'] - $item['discount']) : $item['price'])
					])
				</li>
				<!-- END SECTION CART DROPDOWN ITEM -->

				<?php $total += (($item['discount']!=0 ? ($item['price'] - $item['discount']) : $item['price'])*$qty); $i++; ?>
			@endforeach
		</div>
		<div class="cart-bottom">
			<li class="cart-dropdown-subtotal border-top-1 border-grey-light border-bottom-1 pt-xs">
				<div class="row">
					<div class="col-sm-12">
						<p class="text-center"><strong>SUBTOTAL <span class="ml-md">@money_indo($total)</span></strong></p>
					</div>
				</div>
			</li>  
			<li class="p-xs">
				<div class="row">
					<div class="col-xs-12 text-center" style=" ">
						<a href="{{ route('balin.cart.index') }}" class="btn btn-black-hover-white-border-black mr-sm">Lihat Cart</a>
						<a href="{{ route('balin.checkout.index') }}" class="btn btn-black-hover-white-border-black ml-sm">Checkout</a>
					</div>
				</div>
			</li> 
		</div>
	@else
		<li class=" solid text-center">
			<h4 class="pt-md pb-md mt-0 mb-0 text-md text-light">Belum ada item di Cart</h4>
		</li>
		<li class="" style="background-color: #000; color: #fff;">
			<div class="row">
				<div class="col-xs-12 text-center" style=" ">
					<h4 style="margin-bottom: 10px; font-weight: 500; font-size: 14px; letter-spacing: 0.1em;">Anda Mungkin Suka</h4>
				</div>
			</div>
		</li>

		<?php
			// FAKE DATA
			$image 									= ['http://drive.thunder.id/file/public/4/1/2015/12/06/05/paniya-long-front.jpg', 'http://drive.thunder.id/file/public/4/1/2015/12/06/05/avani-short-front.jpg', 'http://drive.thunder.id/file/public/4/1/2015/12/06/04/pavana-short-front.jpg'];
			$name 									= ['Batik Pavana Short Sleeve', 'Batik Paniya Long Sleeve', 'Batik Avani Long Sleeve'];
			$price 									= ['350000', '300000', '390000'];
			$data['thumbnail'] 						= $image[array_rand($image)];
			$data['name']							= $name[array_rand($name)];
			$data['price']							= $price[array_rand($price)];
			$data['slug']							= str_slug($data['name'], '-');
			$data['gallery']						= $image;
			$data['description']					= 'Sparkle up your charm with a dress like this. Embellished Shift Dress dari ZALORA tampil chic dengan rhinestone. Sempurna untuk tampilan evening date. <br><br>- Stretchable poliester kombinasi<br>- Blush<br>- Kerah bulat<br>- Lengan pendek<br>- Resleting belakang<br>- Aksen bordir, mesh<br>- Regular fit<br>- Unlined';

			$size_fit 								= strpos($data['name'], 'long');
			$data['size_fit']						= ($size_fit !== false) ? 'size-long' : 'size-short'; 

			for ($x=1; $x<3; $x++) 
			{
				$recomend[$x]['id']			= $x;
				$recomend[$x]['images'] 		= $image[array_rand($image)];
				$recomend[$x]['name']			= $name[array_rand($name)];
				$recomend[$x]['prices']		= $price[array_rand($price)];
				$recomend[$x]['slug']			= str_slug($recomend[$x]['name'], '-');
			}
			$recomend['data']					= $recomend;
		?>

		<!-- SECTION RECOMMENDATION PRODUCT -->
		@foreach($recomend['data'] as $k => $item)
			<li class="{{ ($item != end($recomend['data']) ? 'border-bottom-1 border-grey-light' : '') }}">
				@include('web_v2.components.cart.cart_recommendation', [
					'label_id'				=> $k,
					'label_image'			=> $item['images'],
					'label_name'			=> $item['name'],
					'label_price'			=> $item['prices'],
					//'label_qty'				=> $item['varians'],
					'label_promo'			=> 0,
					'label_slug'			=> $item['slug'],
				])
			</li>
		@endforeach
		<!-- END SECTION RECOMMENDATION PRODUCT -->
	@endif
</ul>