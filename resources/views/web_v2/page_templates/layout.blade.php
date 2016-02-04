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
		<div class="wrapper wrapper_content @yield('wrapper_class')" style=" margin-bottom: 0px;
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

		@include('web_v2.components.alert')
		
		<!-- SECTION BOTTOM BAR FOR MOBILE HOME, PRODUCT & PROFILE -->
		@include('web_v2.components.navbar_shortcut')
		<!-- END SECTION BOTTOM BAR FOR MOBILE HOME, PRODUCT & PROFILE -->
		<div class="divider_footer"></div>
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
			@if (Session::has('msg') || $errors->any())
				$('#alert_window').modal('show');
			@endif
		</script>
	</body>
</html>