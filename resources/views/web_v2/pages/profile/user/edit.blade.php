<?php
function isMobile() {
	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
?>	
<!-- SECTION FORM EDIT PROFILE -->
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-xl">
		{!! Form::open(['url' => route('balin.profile.user.update', $data['id']), 'method' => 'POST', 'class' => 'form']) !!}
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="hollow-label">Nama Lengkap</label>
						{!! Form::text('name', $data['name'], ['class' => 'form-control hollow mod_name', 'required' => 'required', 'tabindex' => '1', 'placeholder' => 'Masukkan nama lengkap'] ) !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="hollow-label">Email</label>
						{!! Form::email('email', $data['email'], ['class' => 'form-control hollow mod_email', 'tabindex' => '2', 'placeholder' => 'Masukkan email', 'disable']) !!}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="hollow-label">Tanggal Lahir</label>
						@if(isMobile())
							{!! Form::input('date','date_of_birth', Carbon::createFromFormat('Y-m-d H:i:s', $data['date_of_birth'])->format('d-m-Y'), ['class' => 'form-control hollow mod_dob date-format', 'id' => 'coba', 'tabindex' => '3', 'placeholder' => 'Masukkan tanggal lahir', 'data-date' => '01-01-1950'] ) !!}
						@else
							{!! Form::text('date_of_birth', Carbon::createFromFormat('Y-m-d H:i:s', $data['date_of_birth'])->format('d-m-Y'), ['class' => 'form-control hollow mod_dob date-format', 'id' => 'coba', 'tabindex' => '3', 'placeholder' => 'Masukkan tanggal lahir', 'data-date' => '01-01-1950'] ) !!}
						@endif
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="hollow-label">Jenis Kelamin</label>
						{!! Form::select('gender', ['male' => 'Pria', 'female' => 'Wanita'], $data['gender'], ['class' => 'form-control hollow', 'required' => 'required', 'tabindex' => '4']) !!}
					</div>  
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="hollow-label">Password</label>
						{!! Form::password('password', ['class' => 'form-control hollow', 'placeholder' => 'Masukkan password', 'tabindex' => '5']) !!}
						<span class="help-block m-b-none text-sm">* Biarkan kosong jika tidak ingin mengubah password</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="hollow-label">Konfirmasi Password</label>
						{!! Form::password('password_confirmation', ['class' => 'form-control hollow', 'placeholder' => 'Masukkan konfirmasi password', 'tabindex' => '6']) !!}
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="form-group text-right">
						<a href="#" class="btn btn-black-hover-white-border-black" data-dismiss="modal">Batal</a>
						<button type="submit" class="btn btn-black-hover-white-border-black" tabindex="7">Simpan</button>
					</div>        
				</div>        
			</div>    
		{!! Form::close() !!}
	</div>
</div>
<!-- END SECTION FORM EDIT PROFILE -->

@if(!isMobile())
	<script>

	</script>
@endif