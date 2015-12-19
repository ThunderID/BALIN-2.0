<?php
	$price = null;
	$labels = [];
?>

@extends('admin.page_templates.layout') 

@section('content')
{!! Form::open(['url' => route('admin.product.store'), 'method' => 'POST']) !!}
<!-- top section -->
	<div class="row">
		<div class="col-md-12">
			<h4 class="sub-header">
				Produk
			</h4>
		</div>
	</div>
<!-- end of top section -->

<!-- body section -->
<!-- produk section -->
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="name">Nama Produk</label>
				{!! Form::text('name', $data['name'], [
							'class'         => 'form-control', 
							'tabindex'      => '1', 
							'placeholder'   => 'Masukkan nama produk'
				]) !!}
			</div>  
		</div> 
		<div class="col-md-6">
			<div class="form-group">
				<label for="upc">UPC</label>
				{!! Form::text('upc', $data['upc'], [
							'class'         => 'form-control', 
							'placeholder'   => 'Masukkan kode UPC',
							'tabindex'      => '2', 
				]) !!}
			</div>
		</div>
		<?php
			if(is_null($data))
			{
				$product['description'] = null;
				$product['fit'] 		= null;
			}
			else
			{
				$product 				= json_decode($data['description'], true);
			}
		?>
		<div class="col-md-12">
			<div class="form-group">
				<label for="description">Deskripsi</label>
				{!! Form::textarea('description', $product['description'], [
							'class'         => 'summernote form-control', 
							'placeholder'   => 'Masukkan deskripsi',
							'rows'          => '1',
							'tabindex'      => '3',
							'style'         => 'resize:none;',
				]) !!}
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="fit">Ukuran & Fit</label>
				{!! Form::textarea('fit', $product['fit'], [
							'class'         => 'summernote form-control', 
							'placeholder'   => 'Masukkan ukuran',
							'rows'          => '1',
							'tabindex'      => '4',
							'style'         => 'resize:none;',
				]) !!}
			</div>
		</div>				
	</div>	
<!-- end produk section -->

<!-- filter section -->
	<div class="clearfix">&nbsp;</div>
	<div class="row">
		<div class="col-md-12">
			<h4 class="sub-header">
				Filter
			</h4>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="category">Kategori</label>
				{!! Form::text('category', null, [
							'class'         => 'select-category', 
							'tabindex'      => '5',
							'id'            => 'find_category',
							'style'         => 'width:100%',
				]) !!}
			</div>  
		</div> 
		<div class="col-md-12">
			<div class="form-group">
				<label for="tag">Tag</label>
				{!! Form::text('tag', null, [
							'class'         => 'select-tag', 
							'tabindex'      => '6',
							'id'            => 'find_tag',
							'style'         => 'width:100%',
				]) !!}
			</div>  
		</div> 
	</div>
<!-- end of filter section -->

<!-- price secgion -->
	<div class="clearfix">&nbsp;</div>
	<div class="row">
		<div class="col-md-12">
			<h4 class="sub-header">
				Harga
			</h4>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="category">Harga</label>
				{!! Form::text('price', $price['price'], [
							'class'        		=> 'form-control money', 
							'tabindex'     		=> '7', 
							'placeholder'  		=> 'harga',
				]) !!}
			</div>  
		</div>  
		<div class="col-md-4">
			<div class="form-group">
				<label for="category">Harga Promo</label>
				{!! Form::text('promo_price', $price['promo_price'], [
							'class'         => 'form-control money', 
							'tabindex'      => '8', 
							'placeholder'   => '(kosongkan bila tidak ada promo)'
				]) !!}
			</div>  
		</div> 		
		<div class="col-md-4">
			<div class="form-group">
				<label for="category">Mulai</label>
				{!! Form::text('started_at', $price['$date'], [
							'class'         => 'form-control date-time-format',
							'tabindex'      => '9', 
							'placeholder'   => 'Isikan tanggal dan waktu mulai'
				]) !!}
			</div>  
		</div> 
		<div class="col-md-12">
			<div class="form-group">
				<label for="label">Label</label>
				{!! Form::text('label', null, [
							'class'         => 'select-label', 
							'tabindex'      => '10',
							'id'            => 'find_label',
							'style'         => 'width:100%',
				]) !!}
			</div>  
		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
<!-- end of price section -->

<!-- micro template section	 -->
	<div class="hidden">
		<div id="tmplt">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="thumbnail" class="text-capitalize">URL Image (320 X 463 px)</label>
						{!! Form::text('thumbnail[]', null, [
									'class'         => 'form-control input-image-thumbnail', 
									'tabindex'      => '11',
									'placeholder'   => 'Masukkan url image thumbnail',
						]) !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="logo" class="text-capitalize">URL Image (320 X 463 px)</label>
						{!! Form::text('image_xs[]', null, [
									'class'         => 'form-control input-image-xs', 
									'tabindex'      => '11',
									'placeholder'   => 'Masukkan url image xs',
						]) !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="logo" class="text-capitalize">URL Image (320 X 463 px)</label>
						{!! Form::text('image_sm[]', null, [
									'class'         => 'form-control input-image-sm', 
									'tabindex'      => '11',
									'placeholder'   => 'Masukkan url image sm',
						]) !!}
					</div>
				</div>											
				<div class="col-md-4">
					<div class="form-group">
						<label for="logo" class="text-capitalize">URL Image (772 X 1043 px)</label>
						{!! Form::text('image_md[]', null, [
									'class'         => 'form-control input-image-md', 
									'tabindex'      => '11',
									'placeholder'   => 'Masukkan url image md',
						]) !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="logo" class="text-capitalize">URL Image (992 X 1434 px)</label>
						{!! Form::text('image_lg[]', null, [
									'class'         => 'form-control input-image-lg', 
									'tabindex'      => '11',
									'placeholder'   => 'Masukkan url image lg',
						]) !!}							
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">					
						<label for="default" class="text-capitalize">Default</label>
						<select name="default[]" class="form-control default" tabindex="11">
					        <option value="0" selected="selected">False</option>
					        <option value="1" >True</option>
						</select>							
					</div>						
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<a href="javascript:;" class="btn btn-sm btn-default m-t-mds btn-add-image pull-left">
							<i class="fa fa-plus"></i>
						</a>
					</div>
				</div>					
			</div>
			<div class="clearfix">&nbsp;</div>
		</div>
	</div>
<!-- end of micro template section		 -->


<!-- image section -->
	<div class="clearfix">&nbsp;</div>
	<div class="row">
		<div class="col-md-12">
			<h4 class="sub-header">
				Gambar
			</h4>
		</div>
	</div>
	<div id="template-image">
	</div>	
<!-- end of image section -->

<!-- submit section-->		
	<div class="clearfix">&nbsp;</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group text-right">
				<a href="{{ URL::route('admin.product.index') }}" class="btn btn-md btn-default" tabindex="20">Batal</a>
				<button type="submit" class="btn btn-md btn-primary" tabindex="18">Simpan</button>
			</div>        
		</div>        
	</div> 
<!-- end of submit section-->

<!-- end of body section -->
{!! Form::close() !!}   
@stop

@section('script')
	$( document ).ready(function() {
		template_add_image($('.base'));
	});
@stop

@section('script_plugin')
	@include('admin.plugins.select2')
	@include('admin.plugins.summernote')
	@include('admin.plugins.input-mask')
	@include('admin.plugins.microtemplate')
@stop