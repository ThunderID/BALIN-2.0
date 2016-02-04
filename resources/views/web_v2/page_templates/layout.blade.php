<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<link rel="shortcut icon" href="{{ url('images/favicon.ico') }} "/>
		{!! HTML::style(elixir('css/balin.css')) !!}

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		{!! HTML::style('https://fonts.googleapis.com/css?family=Roboto:400,300,500,700') !!}

		@if(isset($page_subtitle))
			<title>{{$page_subtitle}} - {{$page_title}}</title>
		@else
			<title>BALIN.ID</title>
		@endif

		@if(isset($metas))
			@foreach ($metas as $k => $v)
				<meta name="{{$k}}" content="{{strip_tags($v)}}">
			@endforeach
		@endif
		
		@yield('css')
	</head>
	<body class="@yield('body_class')" style="background-color: #f5f5f5;">
		<!-- SECTION NAVBAR -->
		@include('web_v2.components.nav')
		<!-- END SECTION NAVBAR -->

		<!--SECTION WRAPPER -->
		<div class="wrapper @yield('wrapper_class')" style=" margin-bottom: 0px;
			{{ (Route::currentRouteName()!='balin.home.index') ? 'margin-top:51px;' : 'margin-top:0px;' }}  ">
			<section class="{{ (Route::currentRouteName()!='balin.home.index') ? 'container' : '' }}">
				@if (Route::currentRouteName()!='balin.home.index')
					<!-- SECTION BREADCRUMB -->
					@if(isset($breadcrumb))
						@include('web_v2.components.breadcrumb')
					@endif
					<!-- END SECTION BREADCRUMB -->
				@endif

				<!-- SECTION CONTENT -->
				@yield('content')
				<!-- END SECTION CONTENT -->
			</section>
		</div>
		<!-- END SECTION WRAPPER -->

		<!-- SECTION BOTTOM BAR FOR MOBILE HOME, PRODUCT & PROFILE -->
		<div class="navbar navbar-default navbar-fixed-bottom navbar hidden-lg hidden-md hidden-sm col-xs-12 border-top-1 border-grey" role="navigation">
			<div class="nav navbar-nav text-center mt-0 mb-0">
				<div onclick="location.href='{{ URL::route('balin.home.index') }}';" class="col-xs-{{ (Session::has('whoami')) ? "3" : "4" }} text-center border-right-1 border-grey pt-xs pb-xs">
					{!! HTML::image('images/home.png', 'image' ,['style' => 'height:37px; width:25px; margin: 0 auto;', 'class' => 'pt-5 pb-5']) !!}
					<p class="text-sm">Home</p>
				</div>
				<div onclick="location.href='{{ URL::route('balin.product.index') }}';" class="col-xs-{{ (Session::has('whoami')) ? "3" : "4" }} text-center border-right-1 border-grey pt-xs pb-xs" style="height:75px;">
					{!! HTML::image('images/product.png', 'image' ,['style' => 'height:37px; width:25px; margin: 0 auto;', 'class' => 'pt-5 pb-5']) !!}
					<p class="text-sm">Produk</p>
				</div>
				@if (Session::has('whoami'))
					<div onclick="location.href='{{ URL::route('balin.profile') }}';" class="col-xs-3 text-center border-right-1 border-grey pt-xs pb-xs" style="height:75px;">
						{!! HTML::image('images/profile.png', 'image', ['style' => 'height:37px; width:25px; margin: 0 auto;', 'class' => 'pt-5 pb-5']) !!}
						<p class="text-sm">Profile</p>
					</div>
				@endif
				@if (Session::has('whoami'))
					<div onclick="location.href='{{ URL::route('balin.get.logout') }}';" class="col-xs-3 text-center pt-xs pb-xs" style="height:75px;">
						{!! HTML::image('images/sign-out.png', 'image' ,['style' => 'height:37px; width:25px; margin: 0 auto;', 'class' => 'pt-5 pb-5']) !!}
				@else
					<div onclick="location.href='{{ URL::route('balin.get.login') }}';" class="col-xs-4 text-center pt-xs pb-xs" style="height:75px;">
						{!! HTML::image('images/sign-in.png', 'image' ,['style' => 'height:37px; width:25px; margin: 0 auto;', 'class' => 'pt-5 pb-5']) !!}
				@endif
					<p class="text-sm">{{ (Session::has('whoami')) ? "Log Out":"Sign In" }}</p>
				</div>		
			</div>
		</div>
		<!-- END SECTION BOTTOM BAR FOR MOBILE HOME, PRODUCT & PROFILE -->

		@if (Route::currentRouteName()!='balin.home.index')
			<!-- SECTION FOOTER  -->
			@include('web_v2.components.footer')
			<!-- END SECTION FOOTER -->
		@endif
			
		<!-- CSS -->
		{!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css') !!}
		<!-- JS -->
		{!! HTML::script(elixir('js/balin.js')) !!}

		@yield('js_plugin')
		<script type="text/javascript">
			@yield('js')
		</script>
	</body>
</html>