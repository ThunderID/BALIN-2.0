<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>CMS - BALIN.ID</title>

		<!-- Custom CSS -->
	   {!! HTML::style(elixir('css/dashboard.css')) !!}
	   <link rel="shortcut icon" href="{{ url('Balin/web/image/favicon.ico') }} "/>
	</head>

	<body>
		<div id="wrapper">
			@include('admin.widgets.pageElements.nav')
			
			<div id="page-wrapper" class="white-bg dashbard-1">
				<div class="row border-bottom">
					@include('admin.widgets.pageElements.topbar')
				</div>
				<div class="row  border-bottom white-bg dashboard-header">
					<div class="col-lg-10">
					@include('admin.widgets.pageElements.pageTitle')
		            @include('admin.widgets.pageElements.breadcrumb')
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="wrapper wrapper-content">
							@include('admin.widgets.pageElements.alertbox')
							@yield('content')
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- cdn -->
		{!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css') !!}
		
		<!-- jQuery -->
	   	{!! HTML::script(elixir('js/dashboard.js')) !!}

		<script type="text/javascript">
			$(function () {
			   $('#side-menu').metisMenu();
			});

			@yield('script')
			@yield('scriptDelete')
		</script>
		
		@yield('script_plugin')
	</body>
</html>
