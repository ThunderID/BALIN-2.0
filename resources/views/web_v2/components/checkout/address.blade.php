<div class="row">
	<div class="col-xs-8 col-xs-offset-2 col-sm-8 col-xs-offset-2 col-md-8 col-xs-offset-2 bg-white border-1 border-solid border-grey-light">
		<div class="row pt-md pb-sm">
			<div class="hidden-lg hidden-md hidden-sm col-xs-12">
				<span class="m-t-none m-b-md">Kirim Kepada</span>
			</div>						
			<div class="col-md-12 hidden-xs">
				<h3 class="mt-0 text-normal">Kirim Kepada</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="hollow-label text-regular" for="name">Pilih Alamat</label>
					<select class="form-control text-regular choice_address" name="address_id" id="address_id">
						<option value="0" {{ isset($data['order']['data']['shipment']['address_id']) ? '' : 'selected' }}>Tambah Alamat Baru</option>
						@foreach($data['my_address'] as $key => $value)
							<option value="{{$value['id']}}" data-action="{{ route('my.balin.checkout.shippingcost') }}" {{ ($value['id'] == $data['order']['data']['shipment']['address_id']) ? 'selected' : '' }}>{{$value['address']}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="hollow-label text-regular" for="">Nama Penerima</label>
					{!! Form::input('text', 'receiver_name', isset($data['order']['data']['shipment']['receiver_name']) ? $data['order']['data']['shipment']['receiver_name'] : Session::get('whoami')['name'], [
							'class' 	=> 'form-control text-regular ch_name',
					]) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group">
					<label class="hollow-label text-regular" for="">No. Telp</label>
					{!! Form::input('text', 'phone', isset($data['order']['data']['shipment']['address']['phone']) ? $data['order']['data']['shipment']['address']['phone'] : null, [
							'class' 		=> 'form-control text-regular ch_phone',
					]) !!}
				</div>
			</div>
		</div>
		<div class="row new-address">
			<div class="col-md-12">
				<div class="form-group">
					<label class="hollow-label text-regular" for="">Alamat</label>
					{!! Form::textarea('address', isset($data['order']['data']['shipment']['address']['address']) ? $data['order']['data']['shipment']['address']['address'] : null, [
							'class'			=> 'form-control text-regular ch_address',
							'rows'			=> '3',
							'style'     	=> 'resize:none;',
					]) !!}
				</div>
				<div class="form-group">
					<label class="hollow-label text-regular" for="">Kode Pos</label>
					{!! Form::input('number', 'zipcode', isset($data['order']['data']['shipment']['address']['zipcode']) ? $data['order']['data']['shipment']['address']['zipcode'] : null, [
							'class' 		=> 'form-control text-regular ch_zipcode',
							'id'			=> 'zipcode',
							'data-action'	=> route('my.balin.checkout.shippingcost'),
							'min'			=> '0'
					]) !!}
				</div>
			</div>
		</div> 
		<div class="row pt-xs pb-sm">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3 class="text-normal">Tambahkan Pesan Khusus</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group">
					<label class="text-regular" for="">Pesan Anda</label>
					{!! Form::textarea('note', null, [
						'class'			=> 'form-control text-regular',
						'rows'			=> '5',
						'style'			=> 'resize:none;',
						'placeholder'	=> 'Tulis pesan anda'
					] ) !!}
				</div>
			</div>
		</div>
		<div class="row pt-md pb-md">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
				<a href="javascript:void(0);" class="btn btn-black-hover-white-border-black btn_next" data-action="{{ route('my.balin.checkout.shippingcost') }}" data-next="#voucher" data-prev="#pengiriman">Simpan & Lanjutkan</a>
			</div>
		</div>
	</div>
</div>

@section('js')
	$('.btn_next').click(function(){
		next = $(this).attr('data-next');
		prev = $(this).attr('data-prev');

		$(next).removeClass('hide');
		$(prev).addClass('hide');
	});
@append