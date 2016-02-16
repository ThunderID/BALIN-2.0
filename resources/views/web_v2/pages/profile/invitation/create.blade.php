<!-- SECTION INVITE -->
<div class="row ml-0 mr-0">
	<div class="col-sm-12 pl-xl pr-xl">
		<div class="row">
			<div class="col-md-12 p-md">
				<h4>Undang Teman Anda, dan Dapatkan Poin</h4>
			</div>	
		</div>
		{!! Form::open(['url' => route('my.balin.invitation.store'), 'method' => 'POST']) !!}
			{!! Form::hidden('to', Route::currentRouteName(), ['class' => 'from_route']) !!}
			<div class="row mb-sm">
				<div class="col-md-12 pl-md pr-md mb-md">
					<select name="emails" class="select_tag_email" tabindex="1" style="width:100%" multiple="true">
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pl-md pr-md mb-md">
					<button type="submit" class="btn btn-black-hover-white-border-black" data-action=""><i class="fa fa-envelope-o"></i> Kirim</button>
				</div>
			</div>
		{!! Form::close() !!}
		<div class="row mt-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<p>
					Lihat daftar teman yang sudah di undang 
					<a class="text-grey-dark hover-black text-underline" href="#" 
							data-toggle="modal" 
							data-target=".modal-sub-user-information" 
							data-action="{{ route('my.balin.invitation.index') }}" 
							data-modal-title="Daftar Undangan" 
							data-view="modal-lg">[ Klik ]</a>
				</p>
			</div>
		</div>
	</div>
</div>
<!-- END SECTION INVITE -->

@include('web_v2.plugins.select2')