<nav class="navbar navbar-inverse navbar-fixed-top m-b-none" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed link-grey hover-white text-white" aria-expanded="false" 
					data-toggle="collapse" aria-controls="#bs-example-navbar-collapse-1" data-target="#bs-example-navbar-collapse-1">
				<i class="fa fa-bars fa-lg"></i>
			</button>
			<a href="{{ (Session::has('carts')) ? route('balin.cart.index') : '#' }}" class="navbar-toggle border-0 ico_cart" style="color: #fff;
			    ">
				<i class="fa fa-shopping-bag fa-lg vertical-baseline"></i>
				<span class="ml-xs">
					{{ count(Session::get('carts')) }}
				</span>
			</a>
			<a class="navbar-brand" href="{{ route('balin.home.index') }}">
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
				@if (Session::has('whoami'))
					<li >
						<a href="{{ route('my.balin.redeem.index') }}">Referal &amp; Point
							<span class="badge badge-hollow bg-red text-white"><i class="fa fa-exclamation"></i></span>
						</a>
					</li>
				@endif
				@if (!Session::has('whoami'))
					<li >
						<a href="{{ route('balin.get.login') }}">Sign In</a>
					</li>
				@endif
				<!-- <li > -->
					<!-- <a href="" data-scroll>About Us</a> -->
				<!-- </li> -->
				<!-- <li>
					<a href="" data-scroll>Contact Us</a>
				</li> -->
				@if (Session::has('whoami'))
					<li class="dropdown hidden-xs hidden-sm">
						<a href="javascript:void(0);" class="dropdown-toggle">Akun Anda <span class="caret"></span></a>
						<ul class="dropdown-menu dropdown-menu-right dropdown-user user_dropdown" style="margin-top: 1px">
							<li class="p-xs">
								<a href="{{ route('my.balin.profile') }}" class="dropdown-toggle">Profile</a>
							</li> 
							<li class="p-xs">
								<a href="{{ route('balin.get.logout') }}">Log out</a>
							</li>
						</ul>
					</li> 
					<li class="dropdown hidden-md hidden-lg">
						<a href="{{ route('my.balin.profile') }}" class="dropdown-toggle">Profile</a>
					</li> 
					<li class="hidden-md hidden-lg">
						<a href="{{ route('balin.get.logout') }}">Log out</a>
					</li>
				@endif
				<li class="dropdown dropdown-cart  hidden-xs hidden-sm text-light">
					<a href="javascript:void(0);" class="dropdown-toggle text-white pt-xs mt-5 ico_cart">
						<i class="fa fa-shopping-bag fa-lg vertical-baseline"></i>
						<span class="text-regular"><strong>{{ count(Session::get('carts')) }}</strong></span>
					</a>
					@include('web_v2.components.cart.cart_dropdown', ['carts' => Session::get('carts')]) 
				</li>
				<li class="info-point pull-right mt-sm ml-xl pl-xl mr-xl pr-md hidden-xs hidden-sm">
					<span class="p-xs pl-md pr-md text-white border-left-1 border-top-1 border-bottom-1 border-grey text-regular text-uppercase">Jumlah Point</span>
					<span class="p-xs pl-md pr-md mlm-5 text-white border-1 border-solid border-grey bg-grey-light text-black text-regular">
						@money_indo(Session::has('whoami') ? Session::get('whoami')['total_point'] : '0')
					</span>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
</nav>