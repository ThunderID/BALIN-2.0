<!-- SECTION REFERRAL DESKTOP -->
<div class="row hidden-xs">
	<div class="col-md-12 col-lg-12 pl-0 pr-0">
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
				<div class="col-md-1 col-lg-1">
					{{ $k+1 }}
				</div>
				<div class="col-md-3 col-lg-3">
					@datetime_indo($v['created_at'])	
				</div>
				<div class="col-md-8 col-lg-8">
					{{ $v['user']['name'] }}
				</div>
			</div>
		@empty
			<div class="row">
				<div class="col-md-12 col-lg-12">
					tidak ada referral
				</div>
			</div>
		@endforelse
		<!-- END SECTION DATA REFERRAL DESKTOP -->
	</div>
</div>
<!-- END SECTION REFERRAL DESKTOP -->

<!-- SECTION REFERRAL MOBILE, TABLET -->
<div class="row hidden-sm hidden-md hidden-lg">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h4 class="m-t-sm m-b-md"><strong>Sisa Kuota Referal Anda : 10</strong></h4>
	</div>
</div>
<div class="row hidden-sm hidden-md hidden-lg col-xs-12">
	<div class="col-xs-12">
		<!-- SECTION DATA REFERRAL MOBILE, TABLET -->
			@forelse($data['myreferrals'] as $k => $v)
				<p class="text-center"> 
					{!! (($k)+1) !!} . {{ $v['user']['name'] }} </br>
					<span class="text-regular">(@date_indo($v['created_at']))</span>
				</p>
			@empty
				<p>tidak ada referral</p>
			@endforelse
		<!-- END SECTION DATA REFERRAL MOBILE, TABLET -->
	</div>
</div>
<!-- END SECTION REFERRAL MOBILE, TABLET -->

<!-- SECTION REFERRAL PAGINATION -->
<div class="row">
	<div class="col-md-12">
        
    </div>
</div>
<!-- END SECTION REFERRAL PAGINATION -->