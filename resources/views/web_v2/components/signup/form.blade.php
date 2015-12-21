<?php
function isMobile() {
	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
?>	

{!! Form::open(['url' => '', 'class' => 'form']) !!}
	<div class="form-group">
		<label for="" style="font-weight:400">Name</label>
		{!! Form::text('name', null, ['class' => 'form-control hollow', 'placeholder' => 'Masukkan Nama', 'required']) !!}
	</div>
	<div class="form-group">
		<label for="" style="font-weight:400">Email</label>
		{!! Form::email('email', null, ['class' => 'form-control hollow', 'placeholder' => 'Masukkan Email', 'required']) !!}
	</div>
	<div class="form-group">
		<label for="" style="font-weight:400">Password</label>
		{!! Form::password('password', ['class' => 'form-control hollow', 'placeholder' => 'Masukkan Password', 'required']) !!}
	</div>
	<div class="form-group">
		<label for="" style="font-weight:400">Konfirmasi Password</label>
		{!! Form::password('password_confirmation', ['class' => 'form-control hollow', 'placeholder' => 'Masukkan Konfirmasi Password', 'required']) !!}
	</div>
	<div class="form-group">
		<label for="" style="font-weight:400">Tanggal Lahir</label>
		@if(isMobile())
			{!! Form::input('date', 'date_of_birth', null, ['class' => 'form-control hollow date-format', 'placeholder' => 'Masukkan Tanggal Lahir', 'required']) !!}
		@else
			{!! Form::text('date_of_birth', null, ['class' => 'form-control hollow date-format', 'placeholder' => 'Masukkan Tanggal Lahir', 'required']) !!}
		@endif		
	</div>
	<div class="form-group">
		<label for="" style="font-weight:400">Jenis Kelamin</label>
		{!! Form::select('gender', ['male' => 'Laki-laki', 'female' => "Perempuan"], null, ['class' => 'form-control hollow', 'placeholder' => 'Masukkan Jenis Kelamin', 'required']) !!}
	</div>
	{{-- <div class="form-group">
		<label for="" style="font-weight:400">Alamat</label>
		{!! Form::textarea('address', null, [
				'class' => 'form-control hollow', 
				'placeholder' => 'Masukkan Alamat', 
				'rows' => '3',
				'style' => 'resize:none'
		]) !!}
	</div> --}}
	@if(isset($is_invitation))
		<div class="form-group">
			<label for="" style="font-weight:400">Promo Referral</label>
			{!! Form::text('voucher', null, ['class' => 'form-control hollow', 'placeholder' => 'Masukkan Promo Referral', 'required']) !!}
		</div>
	@endif
	<div class="custome-checkbox">
		<input id="checkbox-1" class="checkbox-custom" name="term" type="checkbox" required>
		<label for="checkbox-1" class="checkbox-custom-label">Saya menyetujui <a href="#" class="link-black unstyle" data-toggle="modal" data-target="#tnc"><strong>Syarat & Ketentuan</strong></a> untuk melakukan pendaftaran.</label>
	</div>

	<div class="form-group text-right">
		<a href="#" class="hover-grey btn-cancel">Cancel</a>&nbsp;&nbsp;&nbsp;
		<button type="submit" class="btn btn-black-hover-white-border-black">Sign Up</button>
	</div>
{!! Form::close() !!}