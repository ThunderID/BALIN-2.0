<div class="row mr-0 ml-0 mb-md pt-lg pb-lg border-1 border-solid border-grey-light bg-white panel_form_voucher">
	@if (!isset($data['order']['data']['voucher']))
		<div class="col-md-12 mb-sm">
			<span class="text-lg voucher-title">Punya Promo Code ?</span>
		</div>	
		<div class="col-md-12 mb-xs">
			<span class="text-regular">Jika anda punya kode voucher, masukkan kode voucher anda dapatkan hadiahnya.</span>
			<div class="input-group mt-xs" style="position:relative">
				<div class="text-center hide loading loading_voucher">
					{!! HTML::image('images/loading.gif', null, []) !!}
				</div>
				{!! Form::input('text', 'voucher', null, [
					'class' => 'form-control hollow transaction-input-voucher-code m-b-sm text-regular voucher_desktop',
					'placeholder' => 'Voucher code',
					'data-action' => route('my.balin.checkout.voucher')
				]) !!}
				<span class="input-group-btn">
					<button type="button" class="btn btn-black-hover-white-border-black voucher_desktop" data-action="{{ route('my.balin.checkout.voucher') }}">Gunakan</button>
				</span>
			</div>
		</div>
	@else
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p>
				@if ($data['order']['data']['voucher']['type'] == 'free_shipping_cost')
					Selamat! Anda mendapat potongan : gratis biaya pengiriman.
				@elseif ($data['order']['data']['voucher']['type'] == 'debit_point')
					Selamat! Anda mendapat bonus balin point sebesar {{ $data['order']['data']['voucher']['value'] }} (Balin Point akan ditambahkan jika pesanan sudah dibayar)
				@endif
			</p>
		</div>
	@endif
</div>