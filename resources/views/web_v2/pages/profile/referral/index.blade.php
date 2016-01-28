<!-- SECTION REFERRAL DESKTOP -->
<div class="row hidden-xs hidden-sm">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pl-0 pr-0">
		<h4 class="mt-0 mb-sm"><strong>Sisa Kuota Referal Anda : {{ $data['quota_referral'] }}</strong></h4>
	</div>
	<div class="col-md-12 col-sm-12">
		<div class="row mt-5 bg-black text-white">
			<div class="col-sm-1">
				<h5>No</h5>
			</div>
			<div class="col-sm-3">
				<h5>Tanggal</h5>
			</div>
			<div class="col-sm-8">
				<h5>Referal Anda</h5>
			</div>
		</div>
		<!-- SECTION DATA REFERRAL DESKTOP -->
		@forelse($data['myreferrals'] as $k => $v)
			<div class="row mt-xs mb-xs">
				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
					{{ $k+1 }}
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					{{ Carbon::parse($v['created_at'])->format('d-m-Y | H:i:s') }}	
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					{{ $v['user']['name'] }}
				</div>
			</div>
			@empty
			@endforelse
		</div>
		<!-- END SECTION DATA REFERRAL DESKTOP -->
	</div>
</div>
<!-- END SECTION REFERRAL DESKTOP -->

<!-- SECTION REFERRAL MOBILE, TABLET -->
<div class="row hidden-md hidden-lg">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h4 class="m-t-sm m-b-md"><strong>Sisa Kuota Referal Anda : 10</strong></h4>
	</div>
</div>
<div class="hidden-lg hidden-md hidden-sm col-xs-12">
	<div class="row m-t-n" style="letter-spacing: 0.1em;">
		<div class="row m-t-lg">
			<div class="col-xs-12">
				<p class="text-center"> Tidak ada data </p>
			</div>
		</div>
	</div>
</div>
<!-- END SECTION REFERRAL MOBILE, TABLET -->

<!-- SECTION REFERRAL PAGINATION -->
<div class="col-md-12" style="text-align:center;">
	<div class="row">
        
    </div>
</div>
<!-- END SECTION REFERRAL PAGINATION -->