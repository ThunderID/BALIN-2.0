@extends('web.page_templates.layout')

@section('content')
<!-- section header user login -->
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			<p class="m-t-md user-hello">
				<strong>Halo, Mr. Balin</strong>
			</p>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
			<p class="user-hello" style="margin-top:-10px;">
				<span class="">
					<a href="#" class="link-black hover-gray unstyle">
						<strong><i class="fa fa-sign-out"></i> Logout</strong>
					</a>
				</span>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p class="m-t-md">
			Melalui halaman profile anda, anda dapat melihat aktivitas akun anda dan mengubah informasi akun. Klik link yang tersedia untuk melihat atau mengubah profil anda.
			</p>
		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
<!-- end section user login -->
<!-- section point info & referral code -->
	<div class="row point-info bg-grey-light ml-0 mr-0">
<!-- section referral code -->
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="row ">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-md">
					<h4 class="text-uppercase">Referal Code 
						<small>
							<a href="#" class="link-white hover-gold unstyle help" data-toggle="modal" data-target=".referral-user-information">
								<i class="fa fa-question-circle"></i>
							</a>
						</small>
					</h4>   
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<p class="text-uppercase text-right hidden-xs"><strong>98BIOLK</strong></p>
					<div class="clearfix hidden-xs">&nbsp;</div>
				</div>
			</div>
		</div>
<!-- end section referral code -->
<!-- section point -->
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-md">
					<h4 class="text-uppercase">Balin Point Anda 
						<small>
							<a href="#" class="link-white hover-gold unstyle help" data-toggle="modal" data-target=".point-user-information"><i class="fa fa-question-circle fa-1x"></i></a>
						</small>
					</h4>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<p class="text-right"><strong>IDR 80.000</strong></p>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<a class="link-white hover-gold unstyle text-right hidden-xs" href="#" 
						data-toggle="modal" 
						data-target=".modal-user-information" 
						data-action="#" 
						data-modal-title="History Balin Point Anda" 
						data-view="modal-lg">[ History ]</a>
					<a class="link-white hover-gold unstyle text-left hidden-sm hidden-md hidden-lg" href="#" 
						data-toggle="modal" 
						data-target=".modal-user-information" 
						data-action="#" 
						data-modal-title="History Balin Point Anda" 
						data-view="modal-lg">[ History ]</a>
						<div class="clearfix">&nbsp;</div>
				</div>
			</div>
		</div>
<!-- end section point -->
	</div>
<!-- end section point & referral code -->
	<div class="clearfix">&nbsp;</div>
<!-- section information akun -->
	<div class="row bg-grey-dark ml-0 mr-0 text-white">
		<div class="col-sm-12">
			<h4 class="text-uppercase">Informasi Akun</h4>
		</div>
	</div>
	<div class="row bg-white ml-0 mr-0">
<!-- section informtion general -->
		<div class="col-sm-6">
			<h5 class="text-grey text-uppercase mt-sm mb-md">
				Informasi Umum 
				<small>
					<a class="link-gold unstyle" href="#" data-toggle="modal" data-target=".modal-user-information" data-action="#" data-modal-title="Ubah Informasi User" data-view="modal-lg" class="balin-link">
						<i class="fa fa-pencil"></i> Ubah
					</a>
				</small>
			</h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
					Username
				</div>
				<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
					<p class="text-right hidden-xs hidden-sm">
						<strong>Mr. Balin</strong>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
					Email
				</div>
				<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
					<p class="text-right hidden-xs hidden-sm">
						<strong>cs@balin.id</strong>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
					Tanggal lahir
				</div>
				<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
					<p class="text-right hidden-xs hidden-sm">
						<strong>18-10-1970</strong>
					</p>
				</div>
			</div>
		</div>
<!-- end section information general -->
<!-- section information anggota balin -->
		<div class="col-sm-6">
			<h5 class="text-grey text-uppercase mt-sm mb-md">Keanggotaan</h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
					Kuota Invite Referal
				</div>
				<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
					<p class="text-right hidden-xs hidden-sm">
						<strong>10</strong>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
					<h4>Pemberi Referal Anda
						<small>
							<a class="link-gold unstyle" href="#" data-toggle="modal" data-target=".modal-user-information" data-action="#" data-modal-title="Pemberi Referal Anda" data-view="modal-md">[ Tambahkan ]</a>
						</small>
					</h4>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
					<p class="text-right hidden-xs hidden-sm">
						<strong>Tidak ada</strong>
					</p>
				</div>
			</div>
			<div class="row p-b-xs">
				<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
					Referal Anda 
					<small>
						<a class="link-gold unstyle" href="#" data-toggle="modal" data-target=".modal-user-information" data-action="#" data-modal-title="Lihat Referal Anda" data-view="modal-md">
							[ Lihat Daftar ]
						</a>
					</small>
				</div>
			</div>
		</div>
<!-- end section information anggota balin -->
	</div>
<!-- end section information akun -->

	<div class="clearfix">&nbsp;</div>

<!-- section information tracking order -->
	<div class="row bg-grey-dark ml-0 mr-0 text-white">
		<div class="col-sm-12">
			<h4 class="text-uppercase">Informasi Pengiriman & Tracking Order</h4>
		</div>
	</div>
	<div class="row bg-white ml-0 mr-0">
		<div class="col-sm-12">
			<p class="text-center">tidak ada order</p>
		</div>
	</div>
<!-- end section information tracking order -->

	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">&nbsp;</div>

<!-- section modal user information -->
	<div class="modal modal-user-information modal-fullscreen fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
					<h5 class="modal-title" id="exampleModalLabel">History Balance</h5>
				</div>
				<div class="modal-body mt-75 mobile-m-t-0" style="text-align:left">
					
				</div>
			</div>
		</div>
	</div>
<!-- end section modal user information -->

<!-- section sub modal  user information -->
	<div id="submodal-balance" class="modal submodal-user-information modal-fullscreen fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
					<h5 class="modal-title" id="exampleModalLabel">History Balance</h5>
				</div>
				<div class="modal-body mt-75 mobile-m-t-0" style="text-align:left">
					
				</div>
			</div>
		</div>
	</div>
<!-- end section sub modal user information -->

<!-- section modal information & function balin point -->
	<div id="" class="modal point-user-information modal-fullscreen fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
					<h5 class="modal-title text-uppercase" id="exampleModalLabel">Balin Point</h5>
				</div>
				<div class="modal-body mt-75 mobile-m-t-10" style="text-align:left">
					<p>Balin Point ini adalah voucher discount yang dapat anda gunakan untuk pembelian produk di Balin</p>
					<p>Untuk menambah jumlah Balin Point ini, ajak teman dan kerabat anda untuk melakukan registrasi di situs Balin.id dan berikan kode referal anda kepada mereka. Dengan menggunakan kode referal anda, teman anda akan mendapatkan Balin Point sebesar Rp. 50.000 dan anda akan mendapatkan Balin Point sebesar Rp. 10.000.</p>
					<p>Kode referal anda, pada mulanya hanya dapat anda berikan kepada 10 orang teman anda. Apabila teman yang menggunakan kode referal anda melakukan pembelian, anda akan mendapatkan tambahan kuota tersebut menjadi 11 dan anda akan mendapatkan Balin Point sebesar Rp. 10.000, dan demikian seterusnya tanpa ada batasnya.</p>
					<p>Semakin banyak teman yang menggunakan referal anda dan semakin sering teman yang anda referensikan melakukan pembelian, semakin besar voucher yang anda dapatkan.</p>

					<p>Balin Point tidak dapat diuangkan.</p>
				</div>
			</div>
		</div>
	</div>
<!-- end section modal information & function balin point -->

<!-- section modal information & function referral code -->
	<div id="" class="modal referral-user-information modal-fullscreen fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
					<h5 class="modal-title text-uppercase" id="exampleModalLabel">Referal Code</h5>
				</div>
				<div class="modal-body mt-75 mobile-m-t-10" style="text-align:left">
					<p>Kode referal adalah kode akun anda di Balin.id. Anda dapat mengajak teman atau kerabat anda untuk mendaftar ke situs Balin.id dan berikan kode referal anda. Dengan menggunakan kode referal anda, teman anda akan mendapatkan Balin Point sebesar Rp. 50.000 dan anda akan mendapatkan Balin Point sebesar Rp. 10.000</p>
					<p>Kode referal anda, pada mulanya hanya dapat anda berikan kepada 10 orang teman anda. Apabila teman yang menggunakan kode referal anda melakukan pembelian, anda akan mendapatkan tambahan kuota tersebut menjadi 11 dan anda akan mendapatkan Balin Point sebesar Rp. 10.000, dan demikian seterusnya tanpa ada batasnya.</p>
					<p>Semakin banyak teman yang menggunakan referal anda dan semakin sering teman yang anda referensikan melakukan pembelian, semakin besar voucher yang anda dapatkan.</p>

					<p>Balin Point tidak dapat diuangkan.</p>
				</div>
			</div>
		</div>
	</div>
<!-- end section modal information & function referaal code -->
@stop

@section('script')
	@if(Input::has('ref'))
		var event = new Event('build');
		var actions     = "{!! route('frontend.any.checked.out', ['ref' => Input::get('ref')]) !!}";
		console.log(actions);
		// Listen for the event.
		document.addEventListener('build', function (e) 
		{
			var action = actions;
			var title = "Pesanan Disimpan";
			var view_mode = '';
			parsing = '';

			$('#modal-balance').find('.modal-body').html('loading...');
			$('#modal-balance').find('.modal-title').html(title);
			$('#modal-balance').find('.modal-dialog').addClass(view_mode);
			$('#modal-balance').find('.modal-body').load(action, function() {
				if (parsing !== null && parsing !== undefined) {
					change_action($(this), parsing);
				}
			});

			$('#modal-balance').modal('show');
		}, false);

		// Dispatch the event.
		document.dispatchEvent(event);

		$('#modal-balance').on('hidden.bs.modal', function () {
			window.history.pushState('obj', 'newtitle', '/profile');
			return false;
		});
	@endif
@stop

@section('script_plugin')

@stop