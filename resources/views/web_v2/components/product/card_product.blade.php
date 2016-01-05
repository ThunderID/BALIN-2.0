@if (count($datas['data']) > 0)
	@forelse($datas['data'] as $value)
		<div class="{{ isset($col) ? $col : 'col-xs-12 col-sm-4 col-md-3 col-lg-3' }}">
			<div class="thumbnail">
				<img src="{{ (!empty($value['thumbnail']) ? $value['thumbnail'] : '') }}" class="img-responsive" alt="">
				<div class="caption">
					<h4 class="text-uppercase">{{ (!empty($value['name']) ? $value['name'] : '') }}</h4>
					<p>@money_indo((!empty($value['prices']) ? $value['prices'] : '0'))</p>
				</div>
				<a href="{{ route('balin.product.show', (!empty($value['slug']) ? $value['id'] : $value['id'])) }}" class="btn btn-primary btn-block text-uppercase">Detail</a>
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