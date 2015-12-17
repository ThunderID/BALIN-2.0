@extends('web.page_templates.layout')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="hidden-xs hidden-sm col-md-7 col-lg-7">&nbsp;</div>
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
				<div class="row panel panel-default p-xs m-t-n-xs">
					<div class="col-md-12">
						<div class="signin" style="@if (Session::has('msg-from')) @if (Session::get('msg-from')=='login') display:block; @else display:none; @endif @else display:block; @endif">
							<h3>Sign In</h3>
							@include('web.components.login.form')
						</div>
						<div class="signup" style="@if (Session::has('msg-from') && Session::get('msg-from')=='signup') display:block; @else display:none; @endif">
							<h3>Sign Up</h3>
							@if (Session::has('msg-from') && Session::get('msg-from')=='sign-up')
								@include('widgets.alerts')
							@endif
							@include('web.components.signup.form')
						</div>
						<div class="forgot" style="display:none">
							<h3>Reset Password</h3>
							<div class="clearfix">&nbsp;</div>
						</div>
					</div>	
					<div class="clearfix">&nbsp;</div>
				</div>                        
			</div>
		</div>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>

		<!-- Term and Condition -->
		<div id="tnc" class="modal modal-left modal-fullscreen fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center" id="exampleModalLabel">Syarat & Ketentuan</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12" style="color: #222; font-weight: 300">

							</div>
						</div>
						<div class="row m-t-md">
							<div class="col-md-12">
								<button type="button" class="btn-hollow hollow-black-border" data-dismiss="modal" aria-label="Close">Tutup</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>
@stop

@section('js')
	$('.btn-signup').click( function() {
		$('.signup').show();
		$('.signin').hide();
		$('.forgot').hide();
	});
	$('.btn-cancel').click( function() {
		$('.signup').hide();
		$('.forgot').hide();
		$('.signin').show();
	});
	$('.btn-forgot').click( function() {
		$('.signup').hide();
		$('.signin').hide();
		$('.forgot').show();
	});	
@stop

@section('wrapper_class')
	bg-login-page
@stop

@section('script_plugin')

@stop