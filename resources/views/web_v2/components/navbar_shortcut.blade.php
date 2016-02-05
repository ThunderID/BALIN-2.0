<div class="navbar navbar-default navbar-fixed-bottom navbar_shortcut hidden-lg hidden-md hidden-sm col-xs-12 border-top-1 border-grey" role="navigation">
	<div class="nav navbar-nav text-center mt-0 mb-0">
		<div onclick="location.href='{{ URL::route('balin.home.index') }}';" class="col-xs-{{ (Session::has('whoami')) ? "3" : "4" }} text-center border-right-1 border-grey pt-xs pb-xs cursor-pointer">
			{!! HTML::image('images/home.png', 'image' ,['style' => 'height:35px; width:25px; margin: 0 auto;', 'class' => 'pt-5 pb-5']) !!}
			<p class="text-sm mb-0">Home</p>
		</div>
		<div onclick="location.href='{{ URL::route('balin.product.index') }}';" class="col-xs-{{ (Session::has('whoami')) ? "3" : "4" }} text-center border-right-1 border-grey pt-xs pb-xs cursor-pointer">
			{!! HTML::image('images/product.png', 'image' ,['style' => 'height:35px; width:25px; margin: 0 auto;', 'class' => 'pt-5 pb-5']) !!}
			<p class="text-sm mb-0">Produk</p>
		</div>
		@if (Session::has('whoami'))
			<div onclick="location.href='{{ URL::route('my.balin.profile') }}';" class="col-xs-3 text-center border-right-1 border-grey pt-xs pb-xs cursor-pointer">
				{!! HTML::image('images/profile.png', 'image', ['style' => 'height:35px; width:25px; margin: 0 auto;', 'class' => 'pt-5 pb-5']) !!}
				<p class="text-sm mb-0">Profile</p>
			</div>
		@endif
		@if (Session::has('whoami'))
			<div onclick="location.href='{{ URL::route('balin.get.logout') }}';" class="col-xs-3 text-center pt-xs pb-xs cursor-pointer">
				{!! HTML::image('images/sign-out.png', 'image' ,['style' => 'height:35px; width:25px; margin: 0 auto;', 'class' => 'pt-5 pb-5']) !!}
		@else
			<div onclick="location.href='{{ URL::route('balin.get.login') }}';" class="col-xs-4 text-center pt-xs pb-xs cursor-pointer">
				{!! HTML::image('images/sign-in.png', 'image' ,['style' => 'height:35px; width:25px; margin: 0 auto;', 'class' => 'pt-5 pb-5']) !!}
		@endif
			<p class="text-sm mb-0">{{ (Session::has('whoami')) ? "Log Out":"Sign In" }}</p>
		</div>		
	</div>
</div>