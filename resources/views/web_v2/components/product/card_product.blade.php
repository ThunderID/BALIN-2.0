<!-- SECTION CARD PRODUCT -->
@if (count($datas['data']['count']) > 0)
	@forelse($datas['data']['data'] as $value)
		<div class="{{ isset($col) ? $col : 'col-xs-12 col-sm-4 col-md-3 col-lg-3' }}">
			<div class="thumbnail">
				<img src="{{ (!empty($value['thumbnail']) ? $value['thumbnail'] : 'http://drive.thunder.id/file/public/4/1/2015/12/06/05/avani-short-front.jpg') }}" class="img-responsive" style="{{ isset($style_thumbnail) ? $style_thumbnail : '' }}">
				<div class="caption text-center">
					<h4 class="{{ isset($text) ? $text : '' }}">{{ (!empty($value['name']) ? $value['name'] : '') }}</h4>
					<p>@money_indo(($value['promo_price']!=0 ? $value['promo_price'] : $value['price']))</p>
				</div>
				<a href="{{ route('balin.product.show', (!empty($value['slug']) ? $value['slug'] : $value['id'])) }}" class="btn btn-primary btn-block text-uppercase">Detail</a>
			</div>
		</div>
	@empty
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-md text-center">
			<h3 class="m-b-none">Coming Soon</h3><br><h4>Please stay tuned to be the first to know when our product is ready</h4>
		</div>	
	@endforelse
@else
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-md text-center">
		<h3 class="m-b-none">Coming Soon</h3><br><h4>Please stay tuned to be the first to know when our product is ready</h4>
	</div>
@endif
<!-- END SECTION CARD PRODUCT -->