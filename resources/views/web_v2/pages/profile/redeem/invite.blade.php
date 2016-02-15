<!-- SECTION INVITE -->
<div class="row ml-0 mr-0">
	<div class="col-sm-12 pl-xl pr-xl">
		<div class="row">
			<div class="col-md-12 p-md">
				<h4>Undang Teman Anda, dan Dapatkan Poin</h4>
			</div>	
		</div>
		{!! Form::open(['url' => route('my.balin.invite.post'), 'method' => 'POST']) !!}
			{!! Form::hidden('to', Route::currentRouteName()) !!}
			<div class="row mb-sm">
				<div class="col-md-12 pl-md pr-md mb-md">
					 {!! Form::text('email[]', null, [
                                'class'         => 'select_tag_email', 
                                'tabindex'      => '1', 
                                'id'            => '',
                                'placeholder'   => 'Tambah email',
                                'style'         => 'width:100%'
                    ]) !!}
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pl-md pr-md mb-md">
					<button type="submit" class="btn btn-black-hover-white-border-black" data-action=""><i class="fa fa-envelope-o"></i> Kirim</button>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>
<!-- END SECTION INVITE -->

@include('web_v2.plugins.select2')

<script type="text/javascript">
</script>