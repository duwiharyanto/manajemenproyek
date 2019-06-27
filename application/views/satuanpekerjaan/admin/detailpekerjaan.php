<?php if(!$data):?>
	<div class="row">
		<div class="col-sm-12">
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-ban"></i> Perhatian !</h4>
					Data tidak ditemukan
			</div>			
		</div>
	</div>
<?php else:?>
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-success box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Satuan Pekerjaan</h3>

					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">
					<table class="table table-striped" width="100%" >
						<tr>
							<th colspan="2" align="left" class="bg-blue">Detail Pekerjaan</th>
						</tr>
						<tr>
							<th width="20%">Nama Pekerjaan</th>
							<td width="80%"><?= ucwords($pekerjaan->pekerjaan_kegiatan)?></td>
						</tr>
						<tr>
							<th>Tahun Anggaran</th>
							<td><?= $pekerjaan->pekerjaan_tahunanggaran?></td>
						</tr>
						<tr>
							<th>Lokasi</th>
							<td><?= ucwords($pekerjaan->pekerjaan_lokasi)?></td>
						</tr>						
					</table>
					<hr>
					<table class="table table-striped" width="100%">
						<tr>
							<th colspan="2" align="left" class="bg-orange">Analisa Pekerjaan</th>
						</tr>
						<tr>
							<th width="20%">Kode</th>
							<td width="80%">TS002 </td>
						</tr>
						<tr>
							<th >Nama Pekerjaan</th>
							<td >Test 2 </td>
						</tr>						
						<tr>
							<th>Overhead</th>
							<td>15</td>
						</tr>
						<tr>
							<td colspan="2">
								<table class="table table-bordered" width="100%">
									<tr style="background-color: black;color: white">
										<td width="5%">No</td>
										<td width="15%">Kode</td>
										<td width="30%">Satuan</td>
										<td width="25%">Uraian</td>
										<td width="25%">Nominal</td>
									</tr>
									<?php $i=1;foreach($data AS $row):?>
										<tr>
											<td><?= $i?></td>
											<td><?= $row->analisapekerjaan_kode?></td>
											<td><?= $row->satuan_kode?></td>
											<td><?= $row->hargasatuan_uraian?></td>
											<td class="price"><?= $row->hargasatuan_hargasatuan?></td>
										</tr>
									<?php $i++;endforeach;?>
								</table>								
							</td>
						</tr>						
					</table>					
				</div>
			</div>
		</div>
	</div>	
<?php endif;?>
<?php include 'action.js';?>
