<!-- SECTION INVITE -->
<div class="row ml-0 mr-0">
	<div class="col-sm-12 pl-xl pr-xl">
		<div class="row">
			<div class="col-md-12 p-md">
				<h4>Undang Teman Anda, dan Dapatkan Poin</h4>
			</div>	
		</div>
		{!! Form::open(['url' => route('my.balin.redeem.store'), 'method' => 'POST']) !!}
			{!! Form::hidden('to', Route::currentRouteName()) !!}
			<div class="row mb-sm">
				<div class="col-md-11 pl-md pr-md mb-md">
					<div class="input-group relative">
						<div class="loading-voucher text-center hide">
							{!! HTML::image('images/loading.gif', null, ['style' => 'width:20px']) !!}
						</div>
						{!! Form::hidden('from', 'my.balin.redeem.index') !!}
						{!! Form::input('text', 'referral_code', null, [
								'class' => 'form-control hollow transaction-input-voucher-code m-b-sm check-voc-ref',
								'placeholder' => 'Tambah email teman anda',
						]) !!}
						<span class="input-group-btn">
							<button type="submit" class="btn btn-black-hover-white-border-black" data-action=""><i class="fa fa-envelope-o"></i> Kirim</button>
						</span>
					</div>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>
<!-- END SECTION INVITE -->