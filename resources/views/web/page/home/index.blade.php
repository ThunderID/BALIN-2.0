<?php
	$content = ['0' => 'http://drive.thunder.id/file/public/4/1/2015/12/07/07/3-60.jpg', '1' => 'http://drive.thunder.id/file/public/4/1/2015/12/14/12/slimfit-modern-batik-3.jpg', '2' => 'http://drive.thunder.id/file/public/4/1/2015/12/07/10/2-30.jpg'];
?>

@extends('web.page_templates.layout')

@section('content')
	<!-- Full Page Image Background Carousel Header -->
	<div class="tp-banner-container hidden-xs hidden-sm ">
		<div class="tp-banner" >
			<ul>
				<!-- SLIDE 1-->
				@forelse($content as $key => $value)
					<li data-transition="fade" data-slotamount="5" data-masterspeed="700" data-link="#"
						<!-- MAIN IMAGE -->
						<img src="{!! $value !!}"   alt="slidebg1"  data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
					</li>
				@empty
				@endforelse
			</ul>
		</div>
	</div>
	<section class="container-fluid hidden-md hidden-lg" style="margin-top:51px">
		<div class="row">
			@forelse($content as $key => $value)
				<?php $i = 0; ?>
				<div class="col-xs-12 pl-0 pr-0 border-bottom" style="position:relative;">
					<div class="caption-mobile">
					</div>
					<a href="#">
						<img src="{!! $value !!}" class="img-responsive" style="width:100%;">
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
	@include('web.plugins.revolutionslider')
@stop