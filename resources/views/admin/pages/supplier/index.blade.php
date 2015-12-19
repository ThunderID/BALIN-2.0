@extends('admin.page_templates.layout') 

@section('content')
<!-- top section -->
	<div class="row">
		<div class="col-md-8 col-sm-4 hidden-xs">
			<a class="btn btn-default" href="{{ URL::route('admin.supplier.create') }}"> Data Baru </a>
		</div>
		<div class="hidden-lg hidden-md hidden-sm col-xs-12">
			<a class="btn btn-default btn-block" href="{{ URL::route('admin.supplier.create') }}"> Data Baru </a>
		</div>
		<div class="col-md-4 col-sm-8 col-xs-12">
			{!! Form::open(array('route' => 'admin.supplier.index', 'method' => 'get' )) !!}
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
	@include('admin.widgets.pageelements.searchResult', ['closeSearchLink' => route('admin.supplier.index') ])
	</br> 	
<!-- end of top section -->

<!-- body section -->
	<div class="row">
		<div class="col-lg-12">

<!-- data stock section -->
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center text-left col-md-3">Nama</th>
							<th class="text-center text-left col-md-2">Telepon</th>
							<th class="text-center text-left col-md-2">Kode Pos</th>
							<th class="text-center text-left col-md-3">Alamat</th>
							<th class="text-center">Kontrol</th>
						</tr>
					</thead>
					<tbody>
						@if(count($data) == 0)
							<tr>
								<td colspan="6" class="text-center">
									Tidak ada data
								</td>
							</tr>
						@else                                                                 
							<?php
								$nop = ($data->currentPage() - 1) * 15;
								$ctr = 1 + $nop;
							?> 
							@foreach($data as $dt)
							<?php $address =  $dt['address'];?>
							<tr>
								<td class="text-center">{{$ctr}}</td>
								<td class="text-left">{{$dt['name']}}</td>
								<td class="text-center">{{$address['phone']}}</td>
								<td class="text-center">{{$address['zipcode']}}</td>
								<td class="text-center">{{$address['address']}}</td>
								<td class="text-center">
									<a href="{{ URL::route('backend.data.supplier.show', ['id' => $dt['id']]) }}"> Detail</a>, 
									<a href="{{ URL::route('backend.data.supplier.edit', ['id' => $dt['id']]) }}"> Edit</a>, 
									<a href="#" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#supplier_del"
										data-id="{{ $dt['id'] }}"
										data-ti
										tle="Hapus Data Supplier {{$dt['name']}}"
										data-action="{{ route('backend.data.supplier.destroy', $dt->id) }}">
										Hapus
									</a>  
								</td>    
							</tr>       
							<?php $ctr += 1; ?>                     
							@endforeach 
							@include('widgets.pageelements.formmodaldelete', [
									'modal_id'      => 'supplier_del', 
									'modal_route'   => route('backend.data.supplier.destroy', 0)
							])
						@endif
					</tbody>
				</table> 
			</div>   
<!-- end of data stock section -->

		</div>
	</div>
<!-- end of body section -->
@stop