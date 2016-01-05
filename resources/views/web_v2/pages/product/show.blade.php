@extends('web_v2.page_templates.layout')

@section('content')
	<div class="row">
		<!-- SECTION IMAGE SLIDER PRODUCT -->
		<div class="hidden-xs col-sm-2 col-md-1 col-lg-1 text-center pr-0">
			@if (isset($data['data']) && !empty($data['data']))
				@foreach($data['data']['gallery'] as $value)
					<img src="{{ $value }}" class="img-responsive border-1 border-solid border-grey-light mb-xs" style="width: 65%">
				@endforeach
			@endif
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
			{!! HTML::image($data['thumbnail'], null, ['class' => 'img-responsive border-1 border-solid border-grey-light mb-md text-center']) !!}
		</div>
		<!-- END SECTION IMAGE SLIDER PRODUCT -->

		<!-- SECTION INFO DETAIL PRODUCT -->
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pl-lg">
			<!-- SECTION DESCRIPTION PRODUCT -->
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h3 class="mt-0">{{ $data['name'] }}</h3>
					<h4 class="text-light mt-sm">@money_indo($data['price'])</h4>
					<h4 class="mt-xl">DESKRIPSI</h4>
					<p class="text-superlight">{!! $data['description'] !!}</p>
				</div>
			</div>
			<!-- END SECTION DESCRTIPION PRODUCT -->

			<!-- SECTION SIZE & FIT -->
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h4 class="mt-xl">UKURAN & FIT</h4>
					{!! HTML::image('images/'.$data['size_fit'].'.png', null, ['class' => 'img-responsive']) !!}
				</div>
			</div>
			<!-- END SECTION SIZE & FIT -->

			<!-- SECTION SIZE CHOICE -->
			<div class="row mb-xxl">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h4 class="mt-xl mb-xxl">PILIH UKURAN</h4>
					<div class="row mt-xl mb-xl">
						{!! Form::open() !!}
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<div class="qty text-center">
									<p>15</p>
									<input type="hidden" name="" class="form-control pvarians" value="">
									<input type="number" name="" class="form-control qty-size" 
									value="0" 
									data-stock="" 
									data-id="" 
									data-price=""
									data-discount=""
									data-total=""
									data-name="" 
									data-oldValue="" 
									data-toggle="tooltip" 
									data-placement="right" >

									<button type="button" class="btn btn-control minus" data-type="minus" data-field="">
										<i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-control plus" data-type="plus" 
									data-field="">
										<i class="fa fa-plus"></i>
									</button>
								</div>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<div class="qty text-center">
									<p>15&frac12;</p>
									<input type="hidden" name="" class="form-control pvarians" value="">
									<input type="number" name="" class="form-control qty-size" 
									value="0" 
									data-stock="" 
									data-id="" 
									data-price=""
									data-discount=""
									data-total=""
									data-name="" 
									data-oldValue="" 
									data-toggle="tooltip" 
									data-placement="right" >

									<button type="button" class="btn btn-control minus" data-type="minus" data-field="">
										<i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-control plus" data-type="plus" 
									data-field="">
										<i class="fa fa-plus"></i>
									</button>
								</div>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<div class="qty text-center">
									<p>16</p>
									<input type="hidden" name="" class="form-control pvarians" value="">
									<input type="number" name="" class="form-control qty-size" 
									value="0" 
									data-stock="" 
									data-id="" 
									data-price=""
									data-discount=""
									data-total=""
									data-name="" 
									data-oldValue="" 
									data-toggle="tooltip" 
									data-placement="right" >

									<button type="button" class="btn btn-control minus" data-type="minus" data-field="">
										<i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-control plus" data-type="plus" 
									data-field="">
										<i class="fa fa-plus"></i>
									</button>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<!-- END SECTION SIZE CHOICE -->

			<!-- SECTION TOTAL PRICE -->
			<div class="row border-top-1 border-bottom-1 border-right-0 border-left-0 border-solid mt-xl ml-0 mr-0">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<h4>TOTAL</h4>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
					<h4>@money_indo('300000')</h4>
				</div>
			</div>
			<!-- END SECTION TOTAL PRICE -->

			<!-- SECTION BUTTON ADD TO CART -->
			<div class="row mt-sm mb-md">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
					<a href="#" class="btn btn-black-hover-white-border-black">ADD TO CART</a>
				</div>
			</div>
			<!-- END SECTION BUTTON ADD TO CART -->
		</div>
		<!-- END SECTION INFO DETAIL PRODUCT -->
	</div>

	<!-- SECTION RELATED PRODUCT -->
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-xxl mb-md">
			<h4>PRODUK LAINNYA</h4>
		</div>
		@include('web_v2.component.product.card_product',[
			'datas' => $related['data'],
			'col'	=> 'col-xs-12 col-sm-3 col-md-3 col-lg-3'
		])
	</div>
	<!-- END SECTION RELATED PRODUCT ->

	<div class="clearfix">&nbsp;</div>
@stop

@section('js')
@stop