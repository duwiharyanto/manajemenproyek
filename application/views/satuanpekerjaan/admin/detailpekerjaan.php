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
					<thead>
						<tr class="bg-blue">
							<td width="5%">No</td>
							<td width="10%">Kode</td>
							<td width="55%">Uraian Pekerjaan</td>
							<td width="10%">Satuan</td>
							<td width="20%">Harga Satuan</td>
						</tr>
					</thead>
					<tbody>
						<?php if($data):?>
							<?php $i=1;$grandtotal=0;foreach($data AS $row):?>
							<tr>
								<td><?=$i?></td>
								<td><?=$row->analisapekerjaan_kode?></td>
								<td><?=$row->analisapekerjaan_kegiatan?></td>
								<td><?=$row->satuan_satuan?></td>
								<td class="price"><?=$row->hargasatuan?></td>
							</tr>
							<?php $grandtotal+=$row->hargasatuan;?>								
							<?php $i++;endforeach;?>
							<tr>
								<td colspan="4" align="right">Total</td>
								<td class="bg-red"><?=duit($grandtotal);?></td>
							</tr>							
						<?php else:?>
							<tr>
								<td colspan="5">Data tidak ditemukan</td>
							</tr>
						<?php endif;?>
					</tbody>		
				</table>
				
			</div>
		</div>
	</div>
</div>	
<?php include 'action.js';?>
