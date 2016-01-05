<div class="row mt-xs">
	{!! Form::open(array('url' => route('balin.product.index', Input::all()), 'method' => 'get', 'id' => 'form1', 'class' => 'form-group' )) !!}
		<div class="col-md-9 col-lg-9 pr-0">
			{!! Form::text('name', null, ['class' => 'form-control hollow border-0 search inp-search', 'id' => 'input-search','placeholder' => 'Cari nama produk', 'required' => 'required'] ) !!}
		</div>
		<div class="col-md-2 col-lg-2 pl-0">
			<button type="submit"  class="btn btn-black-hover-white-border-black" tabindex="21">
				<i class="fa fa-search"></i>
			</button>
		</div>
	{!! Form::close() !!}
</div>