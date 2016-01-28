<div class="row">
	{!! Form::open(array('url' => route('balin.product.index', Input::all()), 'method' => 'get', 'id' => 'form1', 'class' => 'form-group searching-product' )) !!}
		<div class="col-md-9 col-lg-9 pr-0">
			{!! Form::text('name', null, ['class' => 'form-control border-0 input-search form_input_search', 'id' => 'input-search','placeholder' => 'Cari nama produk', 'required' => 'required'] ) !!}
		</div>
		<div class="col-md-2 col-lg-2 pl-0">
			<button type="submit"  class="btn btn-black-hover-white-border-black" tabindex="21">
				<i class="fa fa-search"></i>
			</button>
		</div>
	{!! Form::close() !!}
</div>