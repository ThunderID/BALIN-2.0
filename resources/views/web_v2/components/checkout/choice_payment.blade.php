<div class="row ml-0 mr-0">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 bg-white border-1 border-solid border-grey-light">
		<form id="choice_payment">
			<div class="row pt-md pb-sm">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<span class="m-t-none m-b-md">Pilih Pembayaran</span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="radio">
						<label>
							{!! Form::radio('choice_payment', 1, true, ['disabled' => Session::has('paid_veritrans') ? true : '']) !!}
							Bayar menggunakan veritrans
						</label>
					</div>
					<div class="radio">
						<label>
							{!! Form::radio('choice_payment', 0, null, ['disabled' => Session::has('paid_veritrans') ? true : '']) !!}
							Transfer ke rekening kami
						</label>
					</div>
				</div>
			</div>
		</form>
		<div class="row pt-md pb-md">
			<div class="col-xs-4 col-sm-4 col-md-6 col-lg-6">
				<a href="javascript:void(0);" class="btn btn-transaparent-border-black-hover-black btn_step" 
				data-target="#sc3"  
				data-value="#sc4"
				data-param="3"
				data-type="prev"
				data-url="{{ route('my.balin.checkout.get', ['section' => 'sc3']) }}">Kembali</a>
			</div>
			<div class="col-xs-8 col-sm-8 col-md-6 col-lg-6 text-right {{ (Session::has('paid_veritrans') ? 'hide' : '') }}">
				<a href="javascript:void(0);" class="btn btn-black-hover-white-border-black btn_payment" 
				data-action="#"
				data-toggle="modal" 
				data-target=".modal-payment" 
				data-modal-title="Pembayaran" 
				data-view="modal-lg">Lanjutkan</a>
			</div>
			<div class="col-xs-8 col-sm-8 col-md-6 col-lg-6 text-right {{ (Session::has('paid_veritrans') ? '' : 'hide') }}">
				<a href="javascript:void(0);" class="btn btn-black-hover-white-border-black btn_step btn_next" 
				data-action="{{ route('my.balin.checkout.shippingcost') }}"
				data-target="#sc5"  
				data-value="#sc4"
				data-param="4"
				data-type="next"
				data-event="payment"
				data-url="{{ route('my.balin.checkout.get', ['section' => 'sc5']) }}">Lanjutkan</a>
			</div>
		</div>
	</div>
</div>