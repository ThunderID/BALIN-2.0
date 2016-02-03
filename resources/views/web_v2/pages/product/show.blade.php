<?php 
	// dd($data['product']['data']); 
?>
@extends('web_v2.page_templates.layout')

@section('content')
	<div class="row">
		<!-- SECTION IMAGE SLIDER PRODUCT -->
		<div class="hidden-xs col-sm-2 col-md-1 col-lg-1 text-center pr-0">
			@forelse($data['product']['data']['data'][0]['images'] as $img)
				<img src="{{ $img['thumbnail'] }}" class="img-responsive border-1 border-solid border-grey-light mb-xs" style="width: 65%">
			@empty
			@endforelse
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<img src="{{ isset($data['product']['data']['data'][0]['thumbnail']) ? $data['product']['data']['data'][0]['thumbnail'] : 'http://drive.thunder.id/file/public/4/1/2015/12/06/05/avani-short-front.jpg' }}" class="img-responsive border-1 border-solid border-grey-light mb-md text-center">
		</div>
		<!-- END SECTION IMAGE SLIDER PRODUCT -->

		<!-- SECTION INFO DETAIL PRODUCT -->
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pl-lg">
			<!-- SECTION DESCRIPTION PRODUCT -->
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h3 class="mt-0">{{ $data['product']['data']['data'][0]['name'] }}</h3>
					<h4 class="text-light mt-sm">@money_indo($data['product']['data']['data'][0]['price'])</h4>
					<h4 class="mt-xl">DESKRIPSI</h4>
					<?php  $description = isset($data['product']['data']['data'][0]['description']) ? json_decode($data['product']['data']['data'][0]['description'], true) : ['description' => '', 'fit' => '']; ?>
					<p class="text-superlight">{!! $description['description'] !!}</p>
				</div>
			</div>
			<!-- END SECTION DESCRTIPION PRODUCT -->

			<!-- SECTION SIZE & FIT -->
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h4 class="mt-xl">UKURAN & FIT</h4>
					{!! $description['fit'] !!}
					<?php 
						// HTML::image('images/'.$data['product']['data']['data'][0]['size_fit'].'.png', null, ['class' => 'img-responsive']) 
					?>
				</div>
			</div>
			<!-- END SECTION SIZE & FIT -->

			<!-- SECTION FORM ADD TO CART -->
			{!! Form::open(['url' => route('balin.cart.store', $data['product']['data']['data'][0]['slug']), 'class' => 'form_addtocart']) !!}
				{!! Form::hidden('slug', $data['product']['data']['data'][0]['slug'], ['class' => 'slug_form']) !!}
				{!! Form::hidden('name', $data['product']['data']['data'][0]['name'], ['class' => 'name_form']) !!}
				<!-- SECTION SIZE CHOICE -->
				<div class="row mb-xxl">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h4 class="mt-xl mb-xl">PILIH UKURAN</h4>
						<div class="clearfix mt-0 mb-0">&nbsp;</div>
						<div class="row pb-xl">
							@foreach($data['product']['data']['data'][0]['varians'] as $k => $v)
								@if (($k % 3 == 0)&&($k!=0))
									</div>
									<div class="row mt-xl pt-xl pb-xl">
								@endif
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<div class="qty text-center">
										<p>
											@if (strpos($v['size'], '.')==true)
												<?php $frac = explode('.', $v['size']); ?>
												{{ $frac[0].' &frac12;'}}
											@else
												{{ $v['size'] }}
											@endif
										</p>
										<input type="hidden" name="varianids[{{ $v['id'] }}]" class="form-control pvarians" value="{{ $v['id'] }}">
										<input type="number" name="qty[{{ $v['id'] }}]" class="form-control qty-size pqty input_number" min="0" 
										max="{{ (20>=$v['current_stock'] ) ? $v['current_stock'] : '20' }}"
										value="0" 
										data-stock="{{ $v['current_stock'] }}" 
										data-id="{{ $v['id'] }}" 
										data-price="{{ isset($data['product']['data']['data'][0]['price']) ? $data['product']['data']['data'][0]['price'] : 239000 }}"
										data-discount="{{ isset($data['product']['data']['data'][0]['promo_price']) ? $data['product']['data']['data'][0]['promo_price'] : 0 }}"
										data-total="0"
										data-name="qty-{{ strtolower($v['size']) }}[1]" 
										data-oldValue="" 
										data-toggle="tooltip" 
										data-placement="right" 
										data-page="product">

										<button type="button" class="btn btn-control btn_number minus" data-type="minus" data-field="qty-{{ strtolower($v['size']) }}[1]" data-page="product" disabled>&ndash;</button>
										<button type="button" class="btn btn-control btn_number plus" data-type="plus" data-field="qty-{{ strtolower($v['size']) }}[1]" data-page="product">&#43;</button>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
				<!-- END SECTION SIZE CHOICE -->
				<div class="clearfix">&nbsp;</div>
				<!-- SECTION TOTAL PRICE -->
				<div class="row border-top-1 border-bottom-1 border-right-0 border-left-0 border-solid mt-xl ml-0 mr-0">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<h4>TOTAL</h4>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
						<h4 class="price_all_product">@money_indo($data['product']['data']['data'][0]['price'])</h4>
					</div>
				</div>
				<!-- END SECTION TOTAL PRICE -->

				<!-- SECTION BUTTON ADD TO CART -->
				<div class="row mt-sm mb-md">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
						<a href="javascript:void(0);" class="btn btn-black-hover-white-border-black addto_cart">ADD TO CART</a>
					</div>
				</div>
				<!-- END SECTION BUTTON ADD TO CART -->
			{!! Form::close() !!}
			<!-- END SECTION FORM ADD TO CART -->
		</div>
		<!-- END SECTION INFO DETAIL PRODUCT -->
	</div>

	<!-- SECTION RELATED PRODUCT -->
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-xxl mb-md">
			<h4>PRODUK LAINNYA</h4>
		</div>
		@include('web_v2.components.product.card_product',[
			'datas' 			=> $data['related'],
			'col'				=> 'col-xs-12 col-sm-6 col-md-3 col-lg-3',
			'text'				=> 'text-md',
			'style_thumbnail' 	=> 'width:80%'
		])
	</div>
	<!-- END SECTION RELATED PRODUCT -->

	<div class="clearfix">&nbsp;</div>
@stop

@section('js_plugin')
	@include('web_v2.plugins.notif', ['data' => ['title' => 'Terima Kasih', 'content' => 'Produk telah ditambahkan di cart']])
@stop

@section('js')
	data_action1 = '{{ route('balin.cart.store', $data['product']['data']['data'][0]['slug']) }}';
	data_action2 = '{{ route('balin.cart.list') }}';
@stop