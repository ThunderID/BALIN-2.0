@extends('admin.page_templates.layout') 

@section('content')
<!-- top section -->
	<div class="row">
		<div class="col-md-8 col-sm-4 hidden-xs">
			<a class="btn btn-default" href="{{ URL::route('admin.data.stock.create') }}"> Data Baru </a>
		</div>
		<div class="hidden-lg hidden-md hidden-sm col-xs-12">
			<a class="btn btn-default btn-block" href="{{ URL::route('admin.data.stock.create') }}"> Data Baru </a>
		</div>
		<div class="col-md-4 col-sm-8 col-xs-12">
			{!! Form::open(array('route' => 'admin.data.stock.index', 'method' => 'get' )) !!}
			<div class="row">
				<div class="col-md-2 col-sm-3 hidden-xs">
				</div>
				<div class="col-md-7 col-sm-6 col-xs-8" style="padding-right:2px;">
					{!! Form::input('text', 'q', Null , [
								'class'         => 'form-control',
								'placeholder'   => 'Cari nama produk',
								'required'      => 'required',
													]) !!}                                          
				</div>
				<div class="col-md-3 col-sm-3 col-xs-4" style="padding-left:2px;">
					<button type="submit" class="btn btn-default pull-right btn-block">Cari</button>
				</div>
			</div>
			{!! Form::close() !!}
		</div>            
	</div>
	@include('admin.widgets.pageelements.searchResult', ['closeSearchLink' => route('admin.data.stock.index') ])
	</br> 	
<!-- end of top section -->

<!-- body section -->
	<div class="row">
		<div class="col-lg-12">

<!-- data stock section -->

<!-- end of data stock section -->

		</div>
	</div>
<!-- end of body section -->
@stop