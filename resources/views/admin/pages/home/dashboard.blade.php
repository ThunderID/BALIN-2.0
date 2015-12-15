@extends('admin.page_templates.layout') 

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h3>Pekerjaan Hari Ini</h3>
		</div>
	</div>
	<div class="row clearfix">
		&nbsp;
	</div>
	<div class="row">
		<div class="col-md-12">
			<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a href="#barang" aria-controls="barang" role="tab" data-toggle="tab">Barang (10)</a>
					</li>
					<li role="presentation">
						<a href="#toko" aria-controls="toko" role="tab" data-toggle="tab">Toko (20)</a>
					</li>
					 <li role="presentation">
						<a href="#laporan" aria-controls="tab" role="tab" data-toggle="tab">Laporan (0)</a>
					</li>
					<li role="presentation">
						<a href="#konfigurasi" aria-controls="tab" role="tab" data-toggle="tab">Konfigurasi (0)</a>
					</li>
					<li role="presentation">
						<a href="#customer" aria-controls="tab" role="tab" data-toggle="tab">Customer (1)</a>
					</li>
					<li role="presentation">
						<a href="#promosi" aria-controls="tab" role="tab" data-toggle="tab">Promosi (1)</a>
					</li>                    
				</ul>
			
				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="barang">
						<div class="panel-group" id="accordionBarang" style="margin-top:5px;">
							
							<div class="panel panel-default dahboard-list">
								<a data-toggle="collapse" data-parent="#accordionBarang" href="#collapse1">
									<div class="panel-heading">
										<h4 class="panel-title">
											Re-Stok Produk (8)
										</h4>
									</div>
								</a>
								<div id="collapse1" class="panel-collapse collapse in">
		                            <table class="table table-bordered table-hover table-striped">
		                                <tbody>
		                                    @for ($i = 1; $i <= 8; $i++)
		                                    <tr>
		                                        <td class="col-xs-1" style="padding-left: 25px !important;">
		                                            {{ $i }}
		                                        </td>
		                                        <td>
		                                            HEM BATIK SEMI SUTERA (SKU : FG7128H)
		                                        </td>
		                                        <td class="col-xs-1"><a href="#">Kerjakan</a></td>
		                                    </tr>
		                                    @endfor                                    
		                                </tbody>
		                            </table> 
								</div>
							</div>

							<div class="panel panel-default dahboard-list">
								<a data-toggle="collapse" data-parent="#accordionBarang" href="#collapse2">
									<div class="panel-heading">
										<h4 class="panel-title">
											Update Harga (1)
										</h4>
									</div>
								</a>
								<div id="collapse2" class="panel-collapse collapse">
		                            <table class="table table-bordered table-hover table-striped">
		                                <tbody>
		                                    <tr>
		                                        <td class="col-xs-1" style="padding-left: 25px !important;">
		                                            1
		                                        </td>
		                                        <td>
		                                            HEM BATIK SEMI SUTERA (SKU : FG7128H)
		                                        </td>
		                                        <td class="col-xs-1"><a href="#">Kerjakan</a></td>
		                                    </tr>
		                                </tbody>
	                                </table>
								</div>
							</div>

							<div class="panel panel-default dahboard-list">
								<a data-toggle="collapse" data-parent="#accordionBarang" href="#collapse3">
									<div class="panel-heading">
										<h4 class="panel-title">
												Entri Produk Baru (1)
										</h4>
									</div>
								</a>
								<div id="collapse3" class="panel-collapse collapse">
		                            <table class="table table-bordered table-hover table-striped">
		                                <tbody>
		                                    <tr>
		                                        <td class="col-xs-1" style="padding-left: 25px !important;">
		                                            1
		                                        </td>
		                                        <td>
		                                            HEM BATIK SEMI SUTERA (SKU : FG7128H)
		                                        </td>
		                                        <td class="col-xs-1"><a href="#">Kerjakan</a></td>
		                                    </tr>
		                                </tbody>
	                                </table>
								</div>
							</div>
						</div>
					</div>

					<div role="tabpanel" class="tab-pane active" id="toko">
						<div class="panel-group" id="accordionToko" style="margin-top:5px;">
						</div>
					</div>

					<div role="tabpanel" class="tab-pane active" id="laporan">
						<div class="panel-group" id="accordionLaporan" style="margin-top:5px;">
						</div>
					</div>

					<div role="tabpanel" class="tab-pane active" id="konfigurasi">
						<div class="panel-group" id="accordionKonfigurasi" style="margin-top:5px;">
						</div>
					</div>

					<div role="tabpanel" class="tab-pane active" id="customer">
						<div class="panel-group" id="accordionCustomer" style="margin-top:5px;">
						</div>
					</div>

					<div role="tabpanel" class="tab-pane active" id="promosi">
						<div class="panel-group" id="accordionPromosi" style="margin-top:5px;">
						</div>
					</div>					

				</div>
			</div>
		</div>
	</div>
@stop