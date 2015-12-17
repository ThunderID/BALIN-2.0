<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse" style="height:300px;">
		<ul class="nav" id="side-menu">
			<li class="nav-header">
				{!! HTML::image('Balin/admin/image/logo.png') !!}
			</li>
			<li class="{{ ($nav_active=='dashboard')?"active":"" }}">
				<a href="{{ route('admin.home.dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
			</li>
			<li class="{{ ($nav_active=='barang')?"active":"" }}">
				<a href="#"><i class="fa fa-archive"></i> <span class="nav-label">Barang</span></a>
				<ul class="nav nav-second-level">
					<li class="{{ ($subnav_active=='produk')?"active":"" }}">
						<a href="{{ route('admin.data.product.index') }}"><i class="fa fa-cubes"></i> <span class="nav-label">Produk</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Stok</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Harga</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Kategori</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Tag</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Label</span></a>
					</li>	
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Supplier</span></a>
					</li>										
				</ul>
			</li>
			<li class="{{ ($nav_active=='data')?"active":"" }}">
				<a href="#"><i class="fa fa-archive"></i> <span class="nav-label">Toko</span></a>
				<ul class="nav nav-second-level">
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Penjualan</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Nota Bayar</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Packing</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Resi Pengiriman</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Transaksi Selesai</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Kurir</span></a>
					</li>					
				</ul>
			</li>
			<li class="{{ ($nav_active=='data')?"active":"" }}">
				<a href="#"><i class="fa fa-archive"></i> <span class="nav-label">Laporan</span></a>
				<ul class="nav nav-second-level">
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Finance</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Inventory</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Marketing</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Customer</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">System</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Internal (HR)</span></a>
					</li>					
				</ul>
			</li>	
			<li class="{{ ($nav_active=='data')?"active":"" }}">
				<a href="#"><i class="fa fa-archive"></i> <span class="nav-label">Konfigurasi</span></a>
				<ul class="nav nav-second-level">
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Administrasi</span></a>
					</li>
					<li class="{{ ($subnav_active=='store')?"active":"" }}">
						<a href=""><i class="fa fa-home"></i> <span class="nav-label">Website</span></a>
						<ul class="nav nav-third-level">
							<li><a href="#">General</a></li>
							<li><a href="#">Halaman Utama</a></li>
							<li><a href="#">Tentang Kami</a></li>
							<li><a href="#">Syarat & Ketentuan</a></li>
							<li><a href="#">Mengapa Bergabung</a></li>
						</ul>
					</li>				
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Policy</span></a>
					</li>
				</ul>
			</li>					
			<li class="{{ ($nav_active=='data')?"active":"" }}">
				<a href="#"><i class="fa fa-archive"></i> <span class="nav-label">Customer</span></a>
				<ul class="nav nav-second-level">
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Data Customer</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Point</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Referral</span></a>
					</li>					
				</ul>
			</li>
			<li class="{{ ($nav_active=='data')?"active":"" }}">
				<a href="#"><i class="fa fa-archive"></i> <span class="nav-label">Promosi</span></a>
				<ul class="nav nav-second-level">
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Voucher</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Event</span></a>
					</li>
					<li class="{{ ($subnav_active=='products')?"active":"" }}">
						<a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Diskon</span></a>
					</li>					
				</ul>
			</li>			
		</ul>
	</div>
</nav>