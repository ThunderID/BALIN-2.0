{!! Form::open(['url' => route('balin.dologin', ['class' => 'hollow-login'])]) !!}
    <div class="form-group">
        <label for="email" style="font-weight:400">Email</label>
        {!! Form::email('email', null, ['class' => 'form-control hollow', 'placeholder' => 'Masukkan Email', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
	    <label for="pwd" style="font-weight:400">Password</label>
	    {!! Form::password('password', ['class' => 'form-control hollow', 'placeholder' => 'Masukkan Password', 'required' => 'required']) !!}
	</div>
	{{-- <div class="checkbox">
	    <label><input type="checkbox"> Remember me</label>
	</div> --}}
	<div class="form-group">
		<a href="javascript:void(0);" class="btn-forgot t-xs hover-black" style="color:#666; margin-left:3px;">Lupa Password?</a>
	    <button type="submit" class="pull-right btn btn-black-hover-white-border-black">Sign In</button>
	</div>
	<div class="clearfix">&nbsp;</div>
	<h3 style="margin-top:3px;">Join Us</h3>
	<p class="text-light text-grey">
		Connect dengan akun Facebook Anda atau daftarkan email Anda untuk menikmati penawaran spesial dari Kami.
	</p>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<a href="javascript:void(0);" class="btn-signup btn btn-black-hover-white-border-black btn-block">
				<div class="row">
					<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 p-l-none">
						<i class="fa fa-envelope-o"></i>
					</div>
					<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 p-l-none p-r-none text-left">
						&nbsp; Mendaftar
					</div>
				</div>
			</a>
		</div>	
		<div class="hidden-lg hidden-md hidden-sm col-xs-12">
			<div class="clearfix">&nbsp;</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<a href="{{route('balin.dosso')}}" class="btn btn-black-hover-white-border-black btn-block" title="facebook">
				<div class="row">
					<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 p-l-none">
						<i class="fa fa-facebook"></i>
					</div>
					<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 p-l-none p-r-none text-left">
						&nbsp; Facebook Connect
					</div>
				</div>
			</a>
		</div>
	</div>	
	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">&nbsp;</div>
{!! Form::close() !!}