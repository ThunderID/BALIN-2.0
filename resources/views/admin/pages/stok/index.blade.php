@extends('admin.page_templates.layout') 

@section('content')
<!-- top section -->
	<div class="row">
		<div class="col-md-8 col-sm-4 hidden-xs">
			<a class="btn btn-default" href="{{ URL::route('admin.stock.create') }}"> Data Baru </a>
		</div>
		<div class="hidden-lg hidden-md hidden-sm col-xs-12">
			<a class="btn btn-default btn-block" href="{{ URL::route('admin.stock.create') }}"> Data Baru </a>
		</div>
		<div class="col-md-4 col-sm-8 col-xs-12">
			{!! Form::open(array('route' => 'admin.stock.index', 'method' => 'get' )) !!}
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
	@include('admin.widgets.pageelements.searchResult', ['closeSearchLink' => route('admin.stock.index') ])
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
							<th class="text-center">
								No.
							</th>
							<th class="col-md-2">
								SKU
							</th>							
							<th class="col-md-5">
								Nama Produk
							</th>
							<th class="col-md-2 text-center">
								Stok Saat Ini
							</th>
							<th class="col-md-2 text-center">
								Terjual Bulan Ini
							</th>
							<th class="text-center">
								Kontrol
							</th>							
						</tr>
					</thead>
					<tbody>
						@if(count($data) == 0)
							<tr>
								<td colspan="7" class="text-center">
									Tidak ada data
								</td>
							</tr>
						@else                                                                 
							<?php
								$nop = ($data->currentPage() - 1) * 15;
								$ctr = 1 + $nop;
							?> 
							@foreach($data as $dt)
								<tr>
									<td class="text-center">
										{{ $ctr }}
									</td>
									<td>
										{{ $dt['sku'] }}
									</td>
									<td class="text-right">
										{{ $dt['name'] }}
									</td>
									<td class="text-center">
										{{ $dt['current_stock'] }}
									</td>
									<td class="text-right">
										{{ $dt['stock_out_this_month'] }}
									</td>
									<td class="text-center">
										<a href="{{ route('admin.stock.show', $dt['id']) }}"> Detail</a>,
										<a href="{{ url::route('admin.stock.edit', $dt['id']) }}"> Edit</a>, 
										<a href="javascript:void(0);" data-backdrop="static" data-keyboard="false" data-toggle="modal" 
											data-target="#stock_del"
											data-id="{{$dt['id']}}"
											data-title="Hapus Data Produk {{$dt['name']}}"
											data-action="{{ route('admin.stock.destroy', $dt['id']) }}">
											Hapus
										</a>                                                                                      
									</td>    
								</tr>       
								<?php $ctr += 1; ?>                     
							@endforeach 
							
							@include('admin.widgets.pageElements.modalDelete', [
									'modal_id'      => 'stock_del', 
									'modal_route'   => route('admin.stock.destroy')
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