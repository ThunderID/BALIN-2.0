@extends('web_v2.page_templates.layout')

@section('content')
{{-- Desktop and Tablet Section --}}
<div class="hidden-xs">
	<section class="container home">
		<div class="row pt-xl pb-xl">

			{{-- Woman --}}
			<div class="col-md-6 col-sm-6 pr-md">
				<div class="row">
					<div class="col-md-12 pt-sm pl-lg" style="height: 400px; background-size:cover; background-image: url('{!! $data['banners']['left_banner']['image_lg'] !!}');">
						<div class="col-md-4 col-sm-6">
							<h2 class="heading text-left pt-sm pb-sm">
								Wanita
							</h2>
							<?php $image_left = json_decode($data['banners']['left_banner']['value'], true);?>
							<a href="{{$image_left['button']['banner_button_url']}}" class="btn btn-black-hover-white-border-black">Lihat Koleksi</a>
						</div>
						<div class="col-md-8 col-sm-6">
						</div>
					</div>
				</div>
			</div>

			{{-- Man --}}
			<div class="col-md-6 col-sm-6 pl-md">
				<div class="row">
					<div class="col-md-12 pt-sm pl-lg" style="height: 400px; background-size:cover; background-image: url('{!! $data['banners']['right_banner']['image_lg'] !!}');">
						<div class="col-md-8 col-sm-6">
						</div>
						<div class="col-md-4 col-sm-6 text-right">
							<h2 class="heading pt-sm pb-sm">Pria</h2>
							<?php $image_right = json_decode($data['banners']['left_banner']['value'], true);?>
							<a href="{{$image_right['button']['banner_button_url']}}" class="btn btn-black-hover-white-border-black">Lihat Koleksi</a>
						</div>
					</div>
				</div>
			</div>

			{{-- Shoes --}}
			<div class="col-md-12 col-sm-12 pt-md">
				<div class="row" style="height: 225px; background-size:cover; background-image: url('{{ $data['banners']['full_banner']['image_lg'] }}');">
					<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 pt-xl text-center slide-bottom"  data-plugin-options='{"reverse":false}'>
						<h4 class="heading">Hadir Dengan Produk Terbaik Kami</h4>
						<h2 class="heading m-t-none pb-md">Balin Batik</h2>
						<a href="{{$image_left['button']['banner_button_url']}}" class="btn btn-banner btn-black-hover-white-border-black">Wanita</a>
						<a href="{{$image_right['button']['banner_button_url']}}" class="btn btn-banner btn-black-hover-white-border-black">Pria</a>
					</div>
				</div>
			</div>

		</div>
	</section>
	<div class="background-white mt-md">
		<section class="container">
			<div class="row">

				<div class="row pt-xs">
					<div class="col-md-12 col-sm-12 text-center">
						<h2 class="slide-left" data-plugin-options='{"reverse":false}'>Produk Terbaik Dari Kami</h2>

						<div class="slide-right" data-plugin-options='{"reverse":false}'>
							<a href="#batik_woman" class="home-tab t-sm" aria-controls="batik_woman" role="tab" data-toggle="tab" data-tab-id="batik_woman">Batik Wanita</a>
							&nbsp;|&nbsp;
							<a href="#all" class="home-tab t-sm home-tab-active" aria-controls="all" role="tab" data-toggle="tab" data-tab-id="all">Semua Produk</a>
							&nbsp;|&nbsp;
							<a href="#batik_man" class="home-tab t-sm" aria-controls="batik_man" role="tab" data-toggle="tab" data-tab-id="batik_man">Batik Pria</a>
						</div>
					</div>
				</div>	

				<div class="tab-content mt-lg mb-xl">
					<div role="tabpanel" class="tab-pane in" id="batik_woman">
						<div class="row">
							@foreach($data['batik_wanita']['data']['data'] as $key => $dt)
								@if($key == (count($data['batik_wanita']['data']['data']) - 1))
									<div class="hidden-sm col-md-3 card-animate">
										@include('web_v2.components.product.home_card', [
											'value' => $dt
										])
									</div>
								@else
									<div class="col-sm-4 col-md-3 card-animate">
										@include('web_v2.components.product.home_card', [
											'value' => $dt
										])
									</div>
								@endif
							@endforeach
						</div>
						<div class="row slide-bottom" data-plugin-options='{"offset":50 ,"distance":10}'>
							<div class="col-md-12 col-sm-12">
								<div class="col-md-12 col-sm-12 col-xs-12 pt-md mb-sm text-center" style="height: 150px; background-color:#FFF;">
									<!-- <h2 class="heading m-t-none">Suka Produk Kami? </h2> -->
									<a href="#" class="mt-lg btn btn-lg btn-white-border-black-hover-black">Lihat Semua Koleksi</a>
								</div>
							</div>					
						</div>				
					</div>

					<div role="tabpanel" class="tab-pane in active" id="all">
						<div class="row">
							@foreach($data['all']['data']['data'] as $key => $dt)
								@if($key == (count($data['all']['data']['data']) - 1))
									<div class="hidden-sm col-md-3 card-animate">
										@include('web_v2.components.product.home_card', [
											'value' => $dt
										])
									</div>
								@else
									<div class="col-sm-4 col-md-3 card-animate">
										@include('web_v2.components.product.home_card', [
											'value' => $dt
										])
									</div>
								@endif
							@endforeach
						</div>
						<div class="row slide-bottom" data-plugin-options='{"offset":50 ,"distance":10}'>
							<div class="col-md-12 col-sm-12">
								<div class="col-md-12 col-sm-12 col-xs-12 pt-md mb-sm text-center" style="height: 150px; background-color:#FFF;">
									<!-- <h2 class="heading m-t-none">Suka Produk Kami? </h2> -->
									<a href="#" class="mt-lg btn btn-lg btn-white-border-black-hover-black">Lihat Semua Koleksi</a>
								</div>
							</div>					
						</div>
					</div>

					<div role="tabpanel" class="tab-pane in" id="batik_man">
						<div class="row">
							@foreach($data['batik_pria']['data']['data'] as $key => $dt)
								@if($key == (count($data['batik_pria']['data']['data']) - 1))
									<div class="hidden-sm col-md-3 card-animate">
										@include('web_v2.components.product.home_card', [
											'value' => $dt
										])
									</div>
								@else
									<div class="col-sm-4 col-md-3 card-animate">
										@include('web_v2.components.product.home_card', [
											'value' => $dt
										])
									</div>
								@endif
							@endforeach
						</div>
						<div class="row slide-bottom" data-plugin-options='{"offset":50 ,"distance":10}'>
							<div class="col-md-12 col-sm-12">
								<div class="col-md-12 col-sm-12 col-xs-12 pt-md mb-sm text-center" style="height: 150px; background-color:#FFF;">
									<!-- <h2 class="heading m-t-none">Suka Produk Kami? </h2> -->
									<a href="#" class="mt-lg btn btn-lg btn-white-border-black-hover-black">Lihat Semua Koleksi</a>
								</div>
							</div>					
						</div>				
					</div>
				</div>

			</div>
		</section>
	</div>
</div>

{{-- Mobile --}}
<div class="hidden-lg hidden-md hidden-sm">
	<section class="container home">
		<div class="row">
			<div class="col-xs-12">

				{{-- Woman --}}
				<div class="row">
					<div class="col-xs-12 pt-sm pl-xl" style="height: 275px; background-size:cover; background-image: url('{{ asset('images/asset-woman.jpg') }}');">
						<h2 class="heading text-left pt-sm pb-sm">Wanita</h2>
						<a href="#" class="btn btn-black-hover-white-border-black">Lihat Koleksi</a>
					</div>
				</div>

				{{-- Man --}}
				<div class="row">
					<div class="col-xs-12 pt-sm pr-xl" style="height: 275px; background-size:cover; background-image: url('{{ asset('images/asset-man.jpg') }}');">
						<h2 class="heading text-right pt-sm pb-sm">Pria</h2>
						<a href="#" class="btn btn-black-hover-white-border-black pull-right">Lihat Koleksi</a>
					</div>
				</div>

				{{-- Shoes --}}
				<div class="row">
					<div class="col-xs-12" style="height: 275px; background-size:cover; background-image: url('{{ asset('images/asset-new.png') }}');">
						<div class="row">
							<div class="col-xs-12 mt-md pt-xl text-center">
								<h4 class="heading slide-left" data-plugin-options='{"distance":5, "reverse": false}'>
									<span style="background: rgba(255,255,255,0.7);">
										&nbsp;Memperkenalkan Produk Terbaru Kami&nbsp;
									</span>
								</h4>
								<h2 class="heading mt-md pb-md slide-right" data-plugin-options='{"distance":5, "reverse": false}'>
									<span style="background: rgba(255,255,255,0.7);">
										&nbsp;Balin Shoes&nbsp;
									</span>
								</h2>
								<a href="#" class="btn btn-banner btn-black-hover-white-border-black text-center">Wanita</a>
								<a href="#" class="btn btn-banner btn-black-hover-white-border-black text-center">Pria</a>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<div class="background-white pt-md">
		<section class="container">

			<div class="row pt-xl pb-sm">
				<div class="col-md-12 col-sm-12 text-center">

					<div class="slide-top pt-md" data-plugin-options='{"distance":20, "reverse": false}'>
						<a href="#m_all" class="home-tab t-sm home-tab-active" aria-controls="all" role="tab" data-toggle="tab" data-tab-id="all">SEMUA PRODUK</a>
					</div>
					<div class="slide-top pt-md" data-plugin-options='{"distance":20, "reverse": false}'>
						<a href="#m_batik_woman" class="home-tab t-sm" aria-controls="batik_woman" role="tab" data-toggle="tab" data-tab-id="batik_woman">BATIK WANITA</a>
					</div>
					<div class="slide-top pt-md" data-plugin-options='{"distance":20, "reverse": false}'>
						<a href="#m_batik_man" class="home-tab t-sm" aria-controls="batik_man" role="tab" data-toggle="tab" data-tab-id="batik_man">BATIK PRIA</a>
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">

					<div class="tab-content mt-lg mb-xl">

						<div role="tabpanel" class="tab-pane in" id="m_batik_woman">
							<div class="row">
								@foreach($data['batik_wanita']['data']['data'] as $key => $dt)
									@if($key < (count($data['batik_wanita']['data']['data']) - 1))
										<div class="col-xs-12">
											@include('web_v2.components.product.home_card', [
												'value' => $dt
											])
										</div>
									@endif
								@endforeach
							</div>
							<div class="row slide-bottom" data-plugin-options='{"offset":20 ,"distance":20, "reverse":false}'>
								<div class="col-xs-12">
									<div class="col-xs-12 p-t-xl m-b-sm text-center" style="height: 110px; background-color:#FFF;">
										<!-- <h2 class="heading m-t-none">Suka Produk Kami? </h2> -->
										<a href="#" class="mt-lg btn btn-lg btn-white-border-black-hover-black">Lihat Semua Koleksi</a>
									</div>
								</div>					
							</div>				
						</div>

						<div role="tabpanel" class="tab-pane in active" id="m_all">
							<div class="row">
								@foreach($data['all']['data']['data'] as $key => $dt)
									@if($key < (count($data['all']['data']['data']) - 1))
										<div class="col-xs-12">
											@include('web_v2.components.product.home_card', [
												'value' => $dt
											])
										</div>
									@endif
								@endforeach
							</div>
							<div class="row slide-bottom" data-plugin-options='{"offset":20 ,"distance":20, "reverse":false}'>
								<div class="col-xs-12">
									<div class="col-xs-12 p-t-xl m-b-sm text-center" style="height: 110px; background-color:#FFF;">
										<!-- <h2 class="heading m-t-none">Suka Produk Kami? </h2> -->
										<a href="#" class="mt-lg btn btn-lg btn-white-border-black-hover-black">Lihat Semua Koleksi</a>
									</div>
								</div>					
							</div>
						</div>

						<div role="tabpanel" class="tab-pane in" id="m_batik_man">
							<div class="row">
								@foreach($data['batik_pria']['data']['data'] as $key => $dt)
									@if($key < (count($data['batik_pria']['data']['data']) - 1))
										<div class="col-xs-12">
											@include('web_v2.components.product.home_card', [
												'value' => $dt
											])
										</div>
									@endif
								@endforeach
							</div>
							<div class="row slide-bottom" data-plugin-options='{"offset":20 ,"distance":20, "reverse":false}'>
								<div class="col-xs-12">
									<div class="col-xs-12 p-t-xl m-b-sm text-center" style="height: 110px; background-color:#FFF;">
										<!-- <h2 class="heading m-t-none">Suka Produk Kami? </h2> -->
										<a href="#" class="mt-lg btn btn-lg btn-white-border-black-hover-black">Lihat Semua Koleksi</a>
									</div>
								</div>					
							</div>				
						</div>

					</div>

				</div>
			</div>

		</section>
	</div>
</div>
@stop

@section('js_plugin')
	@include('web_v2.plugins.fadeThis')
@stop

@section('js')
	$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {		
		$('.home-tab').removeClass('home-tab-active');
		$(this).addClass('home-tab-active');

		animateCard($(this).data('tab-id'));
		$(window).scrollTop($(window).scrollTop()+1);
		$(window).scrollTop($(window).scrollTop()-1);
	})

	function animateCard(e){
		var delay = 0;

		$('#' + e).find('.card-animate').css('opacity',0);
		$('#' + e).find('.card-animate').each(function() {
		    $(this).delay(delay).animate({
		        opacity:1
		    },750);
		    delay += 250;
		});	
	};  
@stop