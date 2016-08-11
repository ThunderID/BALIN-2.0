<?php
	function isMobile() {
		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}
?>	

{!! Form::open(['url' => (isset($data['code'])) ? route('balin.invitation.post', $data['code']) : route('balin.post.signup'), 'class' => 'form']) !!}
	<div class="form-group">
		<label for="" style="font-weight:400">Name</label>
		{!! Form::text('name', null, ['class' => 'form-control hollow', 'placeholder' => 'Masukkan Nama', 'required', 'tabindex' => 1]) !!}
	</div>
	<div class="form-group">
		<label for="" style="font-weight:400">Email</label>
		{!! Form::email('email', null, ['class' => 'form-control hollow', 'placeholder' => 'Masukkan Email', 'required', 'tabindex' => 2]) !!}
	</div>
	<div class="form-group">
		<label for="" style="font-weight:400">Password</label>
		{!! Form::password('password', ['class' => 'form-control hollow', 'placeholder' => 'Masukkan Password', 'required', 'tabindex' => 3]) !!}
	</div>
	<div class="form-group">
		<label for="" style="font-weight:400">Konfirmasi Password</label>
		{!! Form::password('password_confirmation', ['class' => 'form-control hollow', 'placeholder' => 'Masukkan Konfirmasi Password', 'required', 'tabindex' => 4]) !!}
	</div>
	<div class="form-group">
		<label for="" style="font-weight:400">Tanggal Lahir</label>
		@if (isMobile())
			{!! Form::input('date', 'date_of_birth', null, ['class' => 'form-control hollow date_format', 'placeholder' => 'Masukkan Tanggal Lahir (dd-mm-yyyy)', 'required', 'tabindex' => 5]) !!}
		@else
			{!! Form::text('date_of_birth', null, ['class' => 'form-control hollow date_format', 'placeholder' => 'Masukkan Tanggal Lahir (dd-mm-yyyy)', 'required', 'tabindex' => 5]) !!}
		@endif		
	</div>
	<div class="form-group">
		<label for="" style="font-weight:400">Jenis Kelamin</label>
		{!! Form::select('gender', ['male' => 'Laki-laki', 'female' => "Perempuan"], null, ['class' => 'form-control hollow', 'placeholder' => 'Masukkan Jenis Kelamin', 'required', 'tabindex' => 6]) !!}
	</div>
	@if (isset($is_invitation))
		<div class="form-group">
			<label for="" style="font-weight:400">Promo Referral</label>
			{!! Form::text('voucher', null, ['class' => 'form-control hollow', 'placeholder' => 'Masukkan Promo Referral', 'required', 'tabindex' => 7]) !!}
		</div>
	@endif
	<div class="checkbox i-checks">
		<input type="checkbox" value="1" name="term" class="" required tabindex="8">
		<label class=""> 
			Saya menyetujui <a href="javascript:void(0);" class="link-black unstyle" data-toggle="modal" data-target="#tnc"><strong>Syarat & Ketentuan</strong></a> untuk melakukan pendaftaran.
		</label>
	</div>
	<div class="form-group text-right">
		<a href="#" class="hover-grey btn-cancel" tabindex="10">Cancel</a>&nbsp;&nbsp;&nbsp;
		<button type="submit" class="btn btn-black-hover-white-border-black" tabindex="9">Sign Up</button>
	</div>
{!! Form::close() !!}