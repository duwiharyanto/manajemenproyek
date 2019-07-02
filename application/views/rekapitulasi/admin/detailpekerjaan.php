	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary box-solid">
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
							<th colspan="2" align="left" class="bg-blue">Uraian Pekerjaan</th>
						</tr>
						<tr>
							<td colspan="2">
								<table class="table table-striped" width="100%">
									<tr>
										<th width="5%">No</th>
										<th width="80%">Uraian Pekerjaan</th>
										<th width="15%">Jumlah</th>
									</tr>
									<?php $i=1;$jumlah=0;foreach($rekapitulasi AS $row):?>
										<?php if($row['pekerjaan']):?>
											<tr>
												<td><?= $i?></td>
												<td><?= ucwords($row['pekerjaan'])?></td>
												<td align="right" class="price"><?= $row['jumlah']?></td>
											</tr>
											<?php
												$jumlah+=$row['jumlah'];
											?>											
										<?php endif;?>
									<?php $i++;endforeach;?>
									<tr style="background-color: black;color: white">
										<td colspan="2" align="right">Jumlah</td>
										<td class="price"><?= $jumlah?></td>
									</tr>
									<tr style="background-color: black;color: white">
										<td colspan="2" align="right">PPN 10%</td>
										<td class="price"><?php
										 	$ppn=$jumlah * 0.1;
										 	echo $ppn;
										 	?></td>
									</tr>	
									<tr style="background-color: black;color: white">
										<td colspan="2" align="right">Gran Total</td>
										<td class="price"><?php
										 	$grandtotal=$jumlah - $ppn;
										 	echo $grandtotal;
										 	?></td>
									</tr>	
									<tr style="background-color: black;color: white">
										<td colspan="2" align="right">Pembulatan</td>
										<td class="price">
											<?php
										 		echo $grandtotal;
										 	?>
										 </td>
									</tr>											
								</table>								
							</td>
						</tr>						
					</table>					
				</div>
			</div>
		</div>
	</div>
<?php
	include 'action.js';
?>