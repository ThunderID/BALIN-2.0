@extends('web_v2.page_templates.layout')

@section('content')
<!-- SECTION MENU CATEGORIES, FILTERS, SORT BY, & SEARCH DESKTOP -->
	<div class="row hidden-xs hidden-sm">
		<div class="col-md-12 col-lg-12">
			<div class="row bg-color2 ml-0 mr-0">
				<!-- SECTION MENU CATEGORIES, FILTER & SORT BY -->
				<div class="col-md-9 col-lg-9">
					<ul class="list-inline p-sm mb-0">
						<li>
							<a role="button" id="collapse1" class="menu-accordion" href="#collapseOne"
								data-toggle="collapse"  aria-expanded="false" aria-controls="collapseOne">
								KATEGORI <i class="fa fa-chevron-circle-down pull-right"></i>
							</a>									
						</li>						
						<li>
							<a role="button" id="collapse2" class="menu-accordion" href="#collapseTwo"
							data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
								FILTER <i class="fa fa-chevron-circle-down pull-right"></i>
							</a>
						</li>
						<li>
							<a role="button" id="collapse4" class="menu-accordion" href="#collapseFour"
								data-toggle="collapse" aria-expanded="false" aria-controls="collapseFour">
								URUTKAN <i class="fa fa-chevron-circle-down pull-right"></i>
							</a>
						</li>
					</ul>
				</div>
				<!-- END SECTION MENU CATEGORIES, FILTER & SORT BY -->

				<!-- SECTION FORM SEARCHING -->
				<div class="col-md-3 col-lg-3">
					<div class="row mt-xs">
						{!! Form::open(array('url' => route('balin.product.index', Input::all()), 'method' => 'get', 'id' => 'form1', 'class' => 'form-group' )) !!}
							<div class="col-md-9 col-lg-9 pr-0">
								{!! Form::text('name', null, ['class' => 'form-control hollow search inp-search', 'id' => 'input-search','placeholder' => 'Cari nama produk', 'required' => 'required'] ) !!}
							</div>
							<div class="col-md-2 col-lg-2 pl-0">
								<button type="submit"  class="btn btn-black-hover-white-border-black" tabindex="21">
									<i class="fa fa-search"></i>
								</button>
							</div>
						{!! Form::close() !!}
					</div>
				</div>																								
				<!-- END SECTION FORM SEARCHING -->
			</div>
			<!-- SECTION SUBMENU IN CATEGORIES -->
			<div class="row collapse collapse-category ml-0 mr-0" id="collapseOne" data-collapse="collapse1" aria-expanded="true">
				<div class="col-md-12 col-lg-12 bg-color2">
					<!-- SECTION LIST CATEGORIES DESKTOP -->
					<ul class="list-inline p-sm mb-0">
						<li>Batik Aqni</li>
					</ul>
					<!-- END SECTION LIST CATEGORIES DESKTOP -->
				</div>						
			</div>
			<!-- END SECTION SUBMENU IN CATEGORIES -->

			<!-- SECTION SUBMENU IN FILTERS -->
			<div class="row collapse collapse-category ml-0 mr-0" id="collapseTwo" data-collapse="collapse2" aria-expanded="true">
				<div class="col-md-12 col-lg-12 bg-color2">
					<div class="row p-sm">
						<!-- SECTION LIST FILTERS DESKTOP -->
						<ul class="list-inline p-sm mb-0">
							<li>Lengan Panjang</li>									
						</ul>					
						<!-- END SECTION LIST FILTERS DESKTOP -->
					</div>						
				</div>						
			</div>
			<!-- END SECTION SUBMENU IN FILTERS -->

			<!-- SECTION SUBMENU IN SORT BY -->
			<div class="row collapse collapse-category ml-0 mr-0" id="collapseFour" data-collapse="collapse4" aria-expanded="true">
				<div class="col-md-12 col-lg-12 bg-grey-dark">
					<!-- SECTION LIST SORTBY DESKTOP -->
					<div class="row p-sm">
						<div class="col-md-3 col-lg-3 pt-xs pb-xs">
							<a @if(Input::get('sort')=='name-asc') class="active" @endif href="#" class="hover-black text-white">Nama Produk A-Z</a>
						</div>
						<div class="col-md-3 col-lg-3 pt-xs pb-xs">
							<a @if(Input::get('sort')=='name-desc') class="active" @endif href="#" class="hover-black text-white">Nama Produk Z-A</a>
						</div>

						<div class="col-md-3 col-lg-3 pt-xs pb-xs">
							<a @if(Input::get('sort')=='price-asc') class="active" @endif href="#" class="hover-black text-white">Harga Produk Termurah</a>
						</div>
						<div class="col-md-3 col-lg-3 pt-xs pb-xs">
							<a @if(Input::get('sort')=='price-desc') class="active" @endif href="#" class="hover-black text-white">Harga Produk Termahal</a>
						</div>

						<div class="col-md-3 col-lg-3 pt-xs pb-xs">
							<a @if(Input::get('sort')=='date-desc') class="active" @endif href="#" class="hover-black text-white">Produk Terbaru</a>
						</div>
						<div class="col-md-3 col-lg-3 pt-xs pb-xs">
							<a @if(Input::get('sort')=='date-asc') class="active" @endif href="#" class="hover-black text-white">Produk Terlama</a>
						</div>																			
					</div>			
					<!-- END SECTION LIST SORT BY DESKTOP -->
				</div>						
			</div>
			<!-- END SECTION SUBMENU IN SORT BY -->					
		</div>
	</div>
<!-- END SECTION MENU CATEGORIES, FILTERS, SORT BY & SEARCH DESKTOP -->

<!-- SECTION MENU CATEGORIES, FILTERS, SORT BY & SEARCH MOBILE & TABLET -->
	<div class="row hidden-md hidden-lg">
		<div class="col-xs-12 col-sm-12">
			<ul class="list-unstyled bg-grey-light">
				<li class="p-sm">
					<a href="#" class="" data-toggle="modal" data-target="#modalCategory" style="display:block">									
						KATEGORI <i class="fa fa-chevron-circle-right pull-right"></i>
					</a>						    
				</li>
				<li class="p-sm">
					<a href="#" class="" data-toggle="modal" data-target="#modalTag" style="display:block">									
						FILTER <i class="fa fa-chevron-circle-right pull-right"></i>
					</a>
				</li>
				<li class="p-sm">
					<a href="#" class="" data-toggle="modal" data-target="#modalSort" style="display:block">
						URUTKAN <i class="fa fa-chevron-circle-right pull-right"></i>
					</a>
				</li>
				<li class="p-sm">
					<a href="#" class="" data-toggle="modal" data-target="#modalSearch" style="display:block">
						CARI <i class="fa fa-search pull-right"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>

	<!-- SECTION MODAL SUBMENU IN CATEGORY MOBILE & TABLET -->
	<div id="modalCategory" class="modal modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog modal-sm dialog-mobile">
			<div class="modal-content">
				<div class="modal-header modal-filter-title">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel">Pilih Kategori</h4>
				</div>
				<div class="modal-body ribbon-menu ribbon-menu-mobile">
					<ul class="list-inline m-b-none">
						<!-- SECTION LIST CATEGORY MOBILE & TABLET -->
						@forelse ($category as $cat)
							<div class="col-xs-12">
								<li><a @if(Input::has('category') && Input::get('category')==$cat['slug']) class="active" @endif href="{{ route('balin.product.index', array_merge(Input::all())) }}">{{ $cat->name }}</a></li>
							</div>
						@empty
							<div class="col-xs-12 col-sm-12">
								<li>
									<a href="#">Batik Aqni</a>
								</li>
							</div>
						@endforelse
						<!-- END SECTION LIST CATEGORY MOBILE & TABLET  -->
					</ul>						      		
				</div>
			</div>
		</div>
	</div>
	<!-- END SECTION MODAL SUBMENU IN CATEGORY MOBILE & TABLET -->

	<!-- SECTION MODAL SUBMENU IN FITLERS MOBILE & TABLET -->
	<div id="modalTag" class="modal modal-center" tabindex="-1" role="dialog" aria-labelledbytag="mySmallModalLabel">
		<div class="modal-dialog modal-sm dialog-mobile">
			<div class="modal-content">
				<div class="modal-header modal-filter-title">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel">Filter</h4>
				</div>
				<div class="modal-body ribbon-menu p-t-0">
					@forelse ($tag_types as $tag_type)
						@if($tag_type->category_id == 0)
							<ul class="list-inline m-b-none">
								<div class="col-xs-12 m-t-xs">
									<p class="ribbon-mobile-title"><span>{{ strtoupper($tag_type->name) }}</span></p>
								</div>
							</ul>	
							<!-- SECTION LIST TAGS MOBILE & TABLET  -->
							@foreach ($all_tags as $tag)
								@if ($tag_type->id == $tag->category_id)
									<ul class="list-inline m-b-none">
										<div class="col-xs-12">
											<li><a class='{{ $filters->where("value", $tag->slug)->count() ? "active": ""}}' href='{{ route("balin.product.index", ["page" => $page] + array_except($current_tag, [$tag_type->slug]) + [$tag_type->slug => $tag->slug]) }}' class=''>{{ $tag->name }}</a></li>
										</div>
									</ul>
								@endif
							@endforeach
							<!-- END SECTION LIST TAGS MOBILE & TABLET  -->
						@endif
					@empty
						<ul class="list-inline">
							<div class="col-xs-12 m-t-xs">
								<p class="ribbon-mobile-title"><span>Warna</span></p>
							</div>
						</ul>	
					@endforelse
				</div>
			</div>
		</div>
	</div>		
	<!-- END SECTION MODAL SUBMENU IN FILTERS MOBILE & TABLET -->

	<!-- SECTION MODAL SUBMENU IN SORT BY MOBILE & TABLET -->
	<div id="modalSort" class="modal modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog modal-sm dialog-mobile">
			<div class="modal-content">
				<div class="modal-header modal-filter-title">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel">Urutkan</h4>
				</div>
				<div class="modal-body ribbon-menu">
					<!-- SECTION LIST SORT BY MOBILE & TABLET -->
					<ul class="list-inline">
						<div class="col-xs-12">
							<li> <a @if(Input::get('sort')=='name-asc') class="active" @endif href="{{ route('balin.product.index', array_merge(Input::all())) }}">Nama Produk A-Z</a></li>
						</div>
						<div class="col-xs-12">
							<li> <a @if(Input::get('sort')=='name-desc') class="active" @endif href="{{ route('balin.product.index', array_merge(Input::all())) }}">Nama Produk Z-A</a></li>
						</div>
						<div class="col-xs-12">
							<li> <a @if(Input::get('sort')=='price-asc') class="active" @endif href="{{ route('balin.product.index', array_merge(Input::all())) }}">Harga Produk Termurah</a></li>
						</div>
						<div class="col-xs-12">
							<li> <a @if(Input::get('sort')=='price-desc') class="active" @endif href="{{ route('balin.product.index', array_merge(Input::all())) }}">Harga Produk Termahal</a></li>
						</div>
						<div class="col-xs-12">
							<li> <a @if(Input::get('sort')=='date-desc') class="active" @endif href="{{ route('balin.product.index', array_merge(Input::all())) }}">Produk Terbaru</a></li>
						</div>
						<div class="col-xs-12">
							<li> <a @if(Input::get('sort')=='date-asc') class="active" @endif href="{{ route('balin.product.index', array_merge(Input::all())) }}">Produk Terlama</a></li>
						</div>																
					</ul>				
					<!-- END SECTION LIST SORT BY MOBILE & TABLET -->		      		
				</div>
			</div>
		</div>
	</div>
	<!-- END SECTION MODAL SUBMENU IN SORT BY MOBILE & TABLET -->

	<!-- SECTION MODAL SEARCH MOBILE & TABLET -->
	<div id="modalSearch" class="modal modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog modal-sm dialog-mobile">
			<div class="modal-content">
				<div class="modal-header modal-filter-title">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel">Cari</h4>
				</div>
				<div class="modal-body">
					<div class="row">
					{!! Form::open(array('url' => route('balin.product.index', Input::all()), 'method' => 'get', 'id' => 'form2', 'class' => 'form-group' )) !!}
						<div class="col-xs-9 pr-0">
							{!! Form::text('name', null, ['class' => 'form-control hollow', 'style' => 'border-right:0;','placeholder' => 'Cari nama produk', 'required' => 'required']) !!}
						</div>
						<div class="col-xs-3 pl-0">
							<button type="submit" tabindex="21" class="btn btn-black-hover-white-border-black">
								<i class="fa fa-search"></i>&nbsp;
							</button>
						</div>
					{!! Form::close() !!}					      		
					</div>
				</div>
			</div>
		</div>
	</div>	
	<!-- END SECTION MODAL SEARCH MOBILE & TABLET -->

<!-- END SECTION MENU CATEGORIES, FILTERS, SORT BY & SEARCH MOBILE & TABLET -->
	<div class="clearfix">&nbsp;</div>
	<div class="row">
		@forelse($data as $value)
			<div class="col-sm-4 col-md-3">
				ada
			</div>
		@empty
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-md text-center">
				<h3 class="m-b-none">Coming Soon</h3><br><h4>Please stay tuned to be the first to know when our product is ready</h4>
			</div>
		@endforelse
	</div>

	<div class="row">
		<div class="col-md-12 hollow-pagination" style="text-align:right;">
			<div class="mt-5">
				
			</div>						
		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
@stop

@section('js')
@stop