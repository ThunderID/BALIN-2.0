@extends('web_v2.page_templates.layout')

@section('content')
	<!-- SECTION MENU CATEGORIES, FILTERS, SORT BY, & SEARCH DESKTOP -->
	<div class="row hidden-xs hidden-sm">
		<div class="col-md-12 col-lg-12">
			<div class="row ml-0 mr-0 border-2 border-solid">
				<!-- SECTION MENU CATEGORIES, FILTER & SORT BY -->
				<div class="col-md-9 col-lg-9 filter-product pl-5">
					@include('web_v2.components.product.menu_product.filter_desktop')
				</div>
				<!-- END SECTION MENU CATEGORIES, FILTER & SORT BY -->

				<!-- SECTION FORM SEARCHING -->
				<div class="col-md-3 col-lg-3">
					@include('web_v2.components.product.menu_product.searching_desktop')
				</div>																								
				<!-- END SECTION FORM SEARCHING -->
			</div>
			<!-- SECTION SUBMENU IN CATEGORIES -->
			<div class="row collapse collapse_category ml-0 mr-0" id="collapseOne" data-collapse="collapse1" aria-expanded="true">
				<div class="col-md-12 col-lg-12 bg-color2">
					<div class="row category">
						<!-- SECTION LIST CATEGORIES DESKTOP -->
						<ul class="list-inline">
							@foreach ($data['category'][0] as $k => $v)
								<div class="col-md-3 col-sm-4 pl-0">
									<li class="mr-lg p-sm ml-5 @if(Input::get('category')==$v['slug']) active @endif">
										<a href="{{ route('balin.product.index', array_merge(Input::all(), ['category' => $v['slug']])) }}">{{ $v['name'] }}</a>
									</li>
								</div>
							@endforeach
						</ul>
						<!-- END SECTION LIST CATEGORIES DESKTOP -->
					</div>
				</div>						
			</div>
			<!-- END SECTION SUBMENU IN CATEGORIES -->

			<!-- SECTION SUBMENU IN FILTERS -->
			<div class="row collapse collapse_category ml-0 mr-0" id="collapseTwo" data-collapse="collapse2" aria-expanded="true">
				<div class="col-md-12 col-lg-12 bg-color2">
					<div class="row subtags">
						<!-- SECTION LIST FILTERS DESKTOP -->
						<ul class="list-inline">
							@foreach ($data['tag'][0] as $k => $v)
								@if ($v['category_id'] == 0)
									<div class="col-sm-12 col-md-12 mt-sm ml-sm">
										<span class="text-grey">{{ $v['name'] }}</span>
									</div>
								@endif

								@foreach ($data['tag'][0] as $k2 => $v2)
									@if ($v['category_id'] == $v2['id'])
										<div class="col-md-3 col-sm-4 pl-0">
											<li class="mr-lg p-sm ml-5 @if(Input::get('tag')==$v['slug']) active @endif">
												<a href="{{ route('balin.product.index', array_merge(Input::all(), ['tag' => $v['slug']])) }}">{{ $v['name'] }}</a>
											</li>
										</div>
									@endif
								@endforeach
							@endforeach
						</ul>					
						<!-- END SECTION LIST FILTERS DESKTOP -->			
					</div>
				</div>						
			</div>
			<!-- END SECTION SUBMENU IN FILTERS -->

			<!-- SECTION SUBMENU IN SORT BY -->
			<div class="row collapse collapse_category ml-0 mr-0" id="collapseFour" data-collapse="collapse4" aria-expanded="true">
				<div class="col-md-12 col-lg-12 bg-color2">
					<!-- SECTION LIST SORTBY DESKTOP -->
					<div class="row sort">
						<ul class="list-inline">
							<div class="col-md-3 col-lg-3 pl-0">
								<li class="mr-lg p-sm ml-5 @if(Input::get('sort')=='name-asc') active @endif">
									<a href="{{ route('balin.product.index', array_merge(Input::all(), ['sort' => 'name-asc'])) }}" class="hover-black">Nama Produk A-Z</a>
								</li>
							</div>
							<div class="col-md-3 col-lg-3 pl-0">
								<li class="mr-lg p-sm ml-5 @if(Input::get('sort')=='name-desc') active @endif">
									<a href="{{ route('balin.product.index', array_merge(Input::all(), ['sort' => 'name-desc'])) }}" class="hover-black">Nama Produk Z-A</a>
								</li>
							</div>
							<div class="col-md-3 col-lg-3 pl-0">
								<li class="mr-lg p-sm ml-5 @if(Input::get('sort')=='price-asc') active @endif">
									<a href="{{ route('balin.product.index', array_merge(Input::all(), ['sort' => 'price-asc'])) }}" class="hover-black">Harga Produk Termurah</a>
								</li>
							</div>
							<div class="col-md-3 col-lg-3 pl-0">
								<li class="mr-lg p-sm ml-5 @if(Input::get('sort')=='price-desc') active @endif">
									<a href="{{ route('balin.product.index', array_merge(Input::all(), ['sort' => 'price-desc'])) }}" class="hover-black">Harga Produk Termahal</a>
								</li>
							</div>
							<div class="col-md-3 col-lg-3 pl-0">
								<li class="mr-lg p-sm ml-5 @if(Input::get('sort')=='newest-desc') active @endif">
									<a href="{{ route('balin.product.index', array_merge(Input::all(), ['sort' => 'newest-desc'])) }}" class="hover-black">Produk Terbaru</a>
								</li>
							</div>
							<div class="col-md-3 col-lg-3 pl-0">
								<li class="mr-lg p-sm ml-5 @if(Input::get('sort')=='newest-asc') active @endif">
									<a href="{{ route('balin.product.index', array_merge(Input::all(), ['sort' => 'newest-asc'])) }}" class="hover-black">Produk Terlama</a>
								</li>
							</div>																			
							
						</ul>
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
			@include('web_v2.components.product.menu_product.filter_searching_mobile_tablet')
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

	<!-- SECTION DISPLAY FILTER -->
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 m-b-md">
			@include('web_v2.components.search_result', ['searchresult' => $searchResult])
		</div>
	</div>
	<!-- END SECTION DISPLAY FILTER -->

	<div class="clearfix">&nbsp;</div>

	<!-- SECTION PRODUCT CARD -->
	<div class="row">
		@include('web_v2.components.product.card_product', [
			'datas' => $data['product']
		])
	</div>
	<!-- END SECTION PRODUCT CART -->

	<div class="row">
		<div class="col-md-12 hollow-pagination text-right">
			<div class="mt-5">
			{!! $paging->appends(Input::all())->render() !!}
			</div>						
		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
@stop

@section('js')
@stop