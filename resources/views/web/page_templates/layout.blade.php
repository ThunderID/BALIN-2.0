<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		{!! HTML::style(elixir('css/balin.css')) !!}

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		{!! HTML::style('https://fonts.googleapis.com/css?family=Roboto:400,300,500,700') !!}

		@yield('css')
	</head>
	<body class="@yield('body_class')">
		<header class="page-header" style="">
			@include('web.components.nav')
		</header>
		<section class="container">
			@yield('content')
		</section>

		<div class="container"></div>
		@include('web.components.footer')
			
		<!-- CSS -->
		{!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css') !!}

		{{-- JS --}}
		{!! HTML::script(elixir('js/balin.js')) !!}

		@yield('js')
	</body>
</html>