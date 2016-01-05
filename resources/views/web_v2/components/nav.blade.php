<nav class="navbar navbar-inverse navbar-fixed-top m-b-none" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed link-grey hover-white" aria-expanded="false" 
					data-toggle="collapse" aria-controls="#bs-example-navbar-collapse-1" data-target="#bs-example-navbar-collapse-1" 
					style="color:#fff; border-radius:0; border: none">
				<i class="fa fa-bars fa-lg"></i>
			</button>
			<a href="#" class="hidden-sm hidden-md hidden-lg ico-cart link-grey hover-white" style="color: #fff;
			    position: absolute;
			    right: 80px;
			    top: 16px;
			    text-decoration:none;">
				<i class="fa fa-shopping-cart fa-lg"></i>
				<span class="m-l-xs">
					{{ count(Session::get('baskets')) }}
				</span>
			</a>
			<a class="navbar-brand" href="#">
				{!! HTML::image('images/logo-transparent-small.png', null, ['class' => 'img-responsive']) !!}
			</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="{{ route('balin.home.index') }}">Home</a>
				</li>
				<li>
					<a href="{{ route('balin.product.index') }}">Produk</a>
				</li>
				{{-- <li>
					<a href="" data-scroll>Why Join</a>
				</li> --}}
				@if (!Auth::user())
					<li >
						<a href="{{ route('balin.redeem.index') }}">Referal &amp; Point
							<span class="badge badge-hollow"><i class="fa fa-exclamation"></i></span>
						</a>
					</li>
				@endif
				@if (!Auth::user())
					<li >
						<a href="#" data-scroll>Sign In</a>
					</li>
				@endif
				<!-- <li > -->
					<!-- <a href="" data-scroll>About Us</a> -->
				<!-- </li> -->
				<!-- <li>
					<a href="" data-scroll>Contact Us</a>
				</li> -->
				@if (Auth::user())
					<li class=" dropdown hidden-xs">
						<a href="javascript:void(0);" class="dropdown-toggle">Akun Anda <span class="caret"></span></a>
						@include('widgets.frontend.top_menu.user_dropdown')
					</li> 
					<li class="dropdown hidden-sm hidden-md hidden-lg">
						<a href="" class="dropdown-toggle">Akun Anda</a>
					</li> 
					<li class="hidden-sm hidden-md hidden-lg">
						<a href="">Log out</a>
					</li>
				@endif
				<li class="dropdown dropdown-cart">
					<a href="javascript:void(0);" class="dropdown-toggle ico-cart text-white pt-xs mt-5">
						<i class="fa fa-shopping-bag fa-lg vertical-baseline"></i>
						<strong class="text-regular">{{ count(Session::get('baskets')) }}</strong>
					</a>
					{{-- @include('widgets.frontend.top_menu.cart_dropdown') --}}
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
</nav>