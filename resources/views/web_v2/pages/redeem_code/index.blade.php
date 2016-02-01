<?php
// dd($data);
?>
@extends('web_v2.page_templates.layout')

@section('content')

	<div class="clearfix">&nbsp;</div>

<!-- SECTION FORM INPUT REFERRAL CODE -->
	<div class="row bg-grey-light ml-0 mr-0">
		<div class="col-sm-12 header-info p-lg" id="panel-voucher-normal">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<div class="row m-md">
						<div class="col-md-12">
							<h4 class="m-t-sm">Punya Referal Code ?</h4>
						</div>	
					</div>
					{!! Form::open(['url' => route('balin.redeem.store')]) !!}
						<div class="row m-md">
							<div class="col-md-12">
								<div class="input-group" style="position:relative">
									<div class="loading-voucher text-center hide">
										{!! HTML::image('images/loading.gif', null, ['style' => 'width:20px']) !!}
									</div>
									{!! Form::hidden('from', 'balin.redeem.index') !!}
									{!! Form::input('text', 'referral_code', null, [
											'class' => 'form-control hollow transaction-input-voucher-code m-b-sm check-voc-ref',
											'placeholder' => 'Masukkan referral code anda',
											'data-action' => ''
									]) !!}
									<span class="input-group-btn">
										<button type="submit" class="btn btn-black-hover-white-border-black" data-action="">Gunakan</button>
									</span>
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
<!-- END SECTION FORM INPUT REFERRAL CODE -->
	
	<div class="clearfix">&nbsp;</div>

<!-- SECTION REFERRAL CODE & BALIN POINT -->
	<div class="row bg-grey-light ml-0 mr-0">
<!-- SECTION REFERAAL CODE -->
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-md">
					<h4 class="">Referal Code 
						<small>
							<a href="#" class="hover-gold unstyle help" 
								data-toggle="modal" 
								data-target=".modal-referral-code">
								<i class="fa fa-question-circle"></i>
							</a>
						</small>
					</h4>	
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<p class="text-right"><strong>{{ $data['me']['data']['code_referral'] }}</strong></p>
				</div>
			</div>
		</div>
<!-- END SECTION REFERRAL CODE -->
<!-- SECTION BALIN POINT -->
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-md">
					<h4 class="">Balin Point Anda 
						<small>
							<a href="#" class="link-white hover-gold unstyle help" 
								data-toggle="modal" 
								data-target=".modal-balin-point">
								<i class="fa fa-question-circle fa-1x"></i>
							</a>
						</small>
					</h4>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<p class="text-right"><strong>@money_indo($data['me']['data']['total_point'])</strong></p>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-md">
					<a class="hover-gold hidden-xs" href="#" 
						data-toggle="modal" 
						data-target=".modal-user-information" 
						data-modal-title="History Balin Point Anda">[ History ]</a>
				</div>
			</div>
		</div>
<!-- END SECTION BALIN POINT -->
	</div>
<!-- END SECTION REFERRAL CODE & BALIN POINT -->


	<div class="clearfix mb-xxl">&nbsp;</div>
	<div class="clearfix mb-xxl">&nbsp;</div>

<!-- SECTION MODAL FULLSCREEN -->
	<div id="modal-balance" class="modal modal-user-information modal-fullscreen fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-backdrop="static" data-keyboard="false">
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
<!-- END SECTION MODAL FULLSCREEN -->

<!-- SECTION SUBMODAL FULLSCREEN -->
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
<!-- END SECTION SUBMODAL FULLSCREEN -->

<!-- SECTION MODAL BALIN POINT -->
	<div id="" class="modal modal-balin-point modal-fullscreen fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
		       		<h5 class="modal-title" id="exampleModalLabel">Balin Point</h5>
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
<!-- END SECTION MODAL BALIN POINT -->

<!-- SECTION MODAL REFERRAL CODE -->
	<div id="" class="modal modal-referral-code modal-fullscreen fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
		       		<h5 class="modal-title" id="exampleModalLabel">Referal Code</h5>
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
<!-- END SECTION MODAL REFERRAL CODE -->
@stop

@section('script')
	
@stop

@section('script_plugin')
	
@stop