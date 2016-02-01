<?php 
	// dd($data['point']); 
?>
<!-- SECTION POINT DESKTOP -->
<div class="hidden-xs hidden-sm">
	<div class="row mb-sm">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4 class="text-light">Balin Point Anda Sekarang <span class="text-bold"> @money_indo($data['me']['total_point'])</span></h4>
		</div>
	</div>
	<div class="row bg-black text-white mr-0 ml-0">
		<div class="col-md-12 col-sm-12">
			<div class="row m-t-n">
				<div class="col-sm-3">
					<h5>Tanggal</h5>
				</div>
				<div class="col-sm-2 ">
					<h5 class="p-r-sm">Saldo</h5>
				</div>
				<div class="col-sm-3">
					<h5>Expired</h5>
				</div>
				<div class="col-sm-4">
					<h5>Info</h5>
				</div>
			</div>
		</div>
	</div>
	<div class="row mr-0 ml-0">
		<div class="col-md-12 col-lg-12 border-1 border-black">
			@forelse($data['point']['data'] as $k => $v)
				<div class="row">
					<div class="col-md-3 col-lg-3">
						<p>@datetime_indo($v['created_at'])</p>
					</div>
					<div class="col-md-2">
						<p>{{ $v['amount'] }}</p>
					</div>
					<div class="col-md-3">
						<p>@datetime_indo($v['expired_at'])</p>
					</div>
					<div class="col-md-4">
						<p>{{ $v['notes'] }}</p>
					</div>
				</div>
			@empty
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<p class="text-center"> Tidak ada data </p>
					</div>
				</div>
			@endforelse
		</div>
	</div>
</div>
<!-- END SECTION POINT DESKTOP -->
<!-- SECTION POINT MOBILE, TABLET -->
<div class="hidden-md hidden-lg">
	<div class="row m-md">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4 class="text-center">Balin Point Anda Sekarang <span> IDR 80.000</span></h4>
		</div>
	</div>
	<div class="row m-md">
		<div class=" col-xs-12">
			<div class="row m-t-n" style="letter-spacing: 0.1em;">
				<div class="col-xs-12 text-center">
					<p style="font-size:12px; margin-bottom: 5px;"></p>
					<p style="font-size:16px; margin-bottom: 2px; color:red;"><span>(-)</span> IDR 80.000</p>
					<p style="font-size:9px; margin-bottom: 0px;">Poin Anda sekarang</p>
					<p style="margin-top: 0px; margin-bottom: 0px;">
						<i>Expired</i>
					</p>
					<h4 style="font-size:16px; margin-top: 4px; margin-bottom: 5px">Berhasil Berkurang</h4>
					<p style="font-size:9px;">expired on</br> <span style="font-size:10px;">12 Dec 2015</span></p>
				</div>
			</div>
		</div>
	</div>
</div>