@extends('admin.page_templates.layout') 

@section('content')
<!-- top section -->
	<div class="row">
		<div class="col-md-8 col-sm-4 hidden-xs">
			<a class="btn btn-default" href="{{ URL::route('admin.data.product.create') }}"> Data Baru </a>
		</div>
		<div class="hidden-lg hidden-md hidden-sm col-xs-12">
			<a class="btn btn-default btn-block" href="{{ URL::route('admin.data.product.create') }}"> Data Baru </a>
		</div>
		<div class="col-md-4 col-sm-8 col-xs-12">
			{!! Form::open(array('route' => 'admin.data.product.index', 'method' => 'get' )) !!}
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
	@include('admin.widgets.pageelements.searchResult', ['closeSearchLink' => route('admin.data.product.index') ])
	</br> 	
<!-- end of top section -->

<!-- body section -->
	<div class="row">
		<div class="col-lg-12">

<!-- product data section -->
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th class="text-center">
								No.
							</th>
							<th class="col-md-2 text-center">
								Thumbnail
							</th>
							<th class="col-md-2">
								Nama Produk
							</th>
							<th class="col-md-2 text-center">
								Harga 
							</th>
							<th class="col-md-2 text-center">
								Ukuran
							</th>
							<th class="col-md-2 text-center">
								Stok
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
										{!! HTML::image($dt['default_image'], 'default', ['class' => 'img-responsive', 'style' => 'max-width:100px;']) !!}
									</td>
									<td>
										{{ $dt['name'] }}
										<br/>
										@foreach($dt['lables'] as $lable)
							                <label class="label label-success">{{ str_replace('_', ' ', ucfirst($lable['lable'] ) )}}</label> &nbsp;
										@endforeach
									</td>
									<td class="text-right">
										@money_indo($dt['price'])
										</br>
										<a href="{{ route('admin.data.product.price.create', ['pid' => $dt['id']]) }}">Edit</a>
									</td>
									<td class="text-center">
										@foreach($dt['varians'] as $varian)
											{{ $varian['size'] }} &nbsp;
										@endforeach
										 <br/>
										<a href="{{ URL::route('admin.data.product.varian.create', ['uid' => $dt['id'] ]) }}">Tambah</a>
									</td>
									<td class="text-right">
										{{$dt['current_stock']}}
										 <br/>
										@if($dt['current_stock'] < $stock->value && count($dt->varians))
										<a href="{{ route('admin.data.transaction.create', ['type' => 'buy']) }}">Tambah</a>
										@endif
									</td>
									<td class="text-center">
										<a href="{{ route('admin.data.product.show', $dt['id']) }}"> Detail</a>,
										<a href="{{ url::route('admin.data.product.edit', $dt['id']) }}"> Edit</a>, 
										<a href="javascript:void(0);" data-backdrop="static" data-keyboard="false" data-toggle="modal" 
											data-target="#product_del"
											data-id="{{$dt['id']}}"
											data-title="Hapus Data Produk {{$dt['name']}}"
											data-action="{{ route('admin.data.product.destroy', $dt['id']) }}">
											Hapus
										</a>                                                                                      
									</td>    
								</tr>       
								<?php $ctr += 1; ?>                     
							@endforeach 
							
							@include('admin.widgets.pageElements.modalDelete', [
									'modal_id'      => 'product_del', 
									'modal_route'   => route('admin.data.product.destroy')
							])						

						@endif
						
					</tbody>
				</table>
			</div>
<!-- end of product data section -->

		</div>
	</div>
<!-- end of body section -->


@stop


<!-- next -->
<!-- get data from controller -->
<!-- tampilkan ke view -->
<!-- CRUD -->