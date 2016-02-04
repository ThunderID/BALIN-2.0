@extends('web_v2.page_templates.layout')

@section('content')
	<!-- Full Page Image Background Carousel Header -->
	<div class="tp-banner-container hidden-xs hidden-sm ">
		<div class="tp-banner" >
			<ul>
				<!-- SLIDE 1-->
				@forelse($balin['sliders'] as $key => $value)
					<?php 
						$slider = json_decode($value['value'], 200);
					?>
					<li data-transition="fade" data-slotamount="5" data-masterspeed="700" data-link="{{ isset($slider['button']['slider_button_url']) ? $slider['button']['slider_button_url'] : '#' }}"
						<!-- MAIN IMAGE -->
						<img src="{!! $value['image']['image_lg'] !!}"   alt="slidebg1"  data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
					</li>
				@empty
				@endforelse
			</ul>
		</div>
	</div>
	<section class="container-fluid hidden-md hidden-lg" style="margin-top:51px">
		<div class="row">
			@forelse($balin['sliders'] as $key => $value)
				<?php 
					$slider = json_decode($value['value'], 200);
				?>
				<div class="col-xs-12 pl-0 pr-0 border-bottom" style="position:relative;">
					<div class="caption-mobile">
					</div>
					<a href="{{ isset($slider['button']['slider_button_url']) ? $slider['button']['slider_button_url'] : '#' }}">
						<img src="{!! $value['image']['image_lg'] !!}" class="img-responsive" style="width:100%;">
					</a>
				</div>
			@empty
			@endforelse
		</div>			
	</section>
@stop

@section('script')

@stop

@section('js_plugin')
	@include('web_v2.plugins.revolutionslider')
@stop