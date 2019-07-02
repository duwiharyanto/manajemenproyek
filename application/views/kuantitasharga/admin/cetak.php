<!DOCTYPE html>
<html>
<head>
	<title><?=strtoupper($global->headline)?></title>
</head>
<style type="text/css">
#table th,#table td {
  border: 1px solid black;
  padding: 5px;
}	
</style>
<body>
	<div class="row">
		 <div class="col-sm-12">
		 	<h3 class="box-title" align="center"><?php echo strtoupper($global->headline)?></h3>
			<div class="box box-primary box-solid">
			    <div class="box-body">
		    		<table class="table " width="100%" >		    			
		    			<tr>
		    				<th width="20%" align="left">Pekerjaan</th>
		    				<td width="80%"><?= ucwords($pekerjaan->pekerjaan_kegiatan)?></td>
		    			</tr>
		    			<tr>
		    				<th align="left">Tahun Anggaran</th>
		    				<td><?= $pekerjaan->pekerjaan_tahunanggaran?></td>
		    			</tr>
		    			<tr>
		    				<th align="left">Lokasi</th>
		    				<td><?= ucwords($pekerjaan->pekerjaan_lokasi)?></td>
		    			</tr>
		    		</table>
		    		<br>
		    		<!--TABEL TAKSIRAN-->
		    		<table class="table" width="100%">
						<tr>
							<th  align="left" class="bg-blue">Pekerjaan Persiapan Dan Prasarana Penunjang</th>
						</tr>
						<tr>
							<td>
				        	<table width="100%"   class="table table-bordered table-striped" id="table" cellpadding="0" cellspacing="0">
				                <thead>			                	
					                <tr>
					                  <th width="5%">No</th>
					                  <th width="10%">Kode</th>
					                  <th width="35%">Uraian</th>
					                  <th width="15%">Volume</th>
					                  <th width="15%">Harga Satuan</th>
					                  <th width="15%" class="text-center bg-red" >Harga Total</th>
					                </tr>
				                </thead>
				                <tbody>
				                	<?php if($taksiran):?>
					                	<?php $i=1;$hargatotal=0;foreach ($taksiran as $row):?>
						                	<tr>
						                		<td><?=$i?></td>
						                		<td><?=$row->taksiran_kode?></td>
						                		<td><?=ucwords($row->taksiran_uraian)?></td>
						                		<td><?=$row->taksiran_volume.' '.ucwords($row->satuan_kode)?></td>
						                		<td class="price"><?=duit($row->taksiran_hargasatuan)?></td>
						                		<td class="price">
													<?=duit($row->taksiran_hargasatuan)?>
						                		</td>
						                	</tr>	
						                	<?php
						                		$hargatotal+=$row->taksiran_hargasatuan;
						                	?>                	
					                	<?php $i++;endforeach;?>
				                		<tr>
				                			<td colspan="5" align="right" class="text-red"> Jumlah Total*</td>
				                			<td class="price"><?=duit($hargatotal)?></td>
				                		</tr>
				                	<?php else:?>
				                		<tr>
				                			<td colspan="7" align="center">
				                				Data tidak ditemukan
				                			</td>
				                		</tr>
				                	<?php endif;?>
				                </tbody>            		
				        	</table>								
							</td>							
						</tr>		    			
		    		</table>
		    		<!--TABEL Satuan Pekerjaan-->
		    		<table class="table" width="100%">
						<tr>
							<th  align="left" class="bg-blue">Satuan Pekerjaan</th>
						</tr>
						<tr>
							<td>
				        	<table width="100%" id="table" cellspacing="0" cellpadding="0"  class="table table-bordered table-striped" >
				                <thead>			                	
					                <tr>
					                  <th width="5%">No</th>
					                  <th width="10%">Kode</th>
					                  <th width="35%">Uraian</th>
					                  <th width="15%">Volume</th>
					                  <th width="15%">Harga Satuan</th>
					                  <th width="15%" class="text-center bg-red" >Harga Total*</th>
					                </tr>
				                </thead>
				                <tbody>
				                	<?php $hargatotalpekerjaan=0;?>
				                	<?php if($data):?>
				                		
					                	<?php $i=1;foreach ($data as $row):?>
					                		<?php $total=0;?>
						                	<tr>
						                		<td><?=$i?></td>
						                		<td><?=$row->analisapekerjaan_kode?></td>
						                		<td><?=ucwords($row->analisapekerjaan_kegiatan)?></td>
						                		<td>54,5</td>
						                		<td class="price"><?php
						                			$hargasatuan=0;
						                            $overhead=intval(intval($row->jumlah) * intval($row->analisapekerjaan_overhead)/100);
						                            $hargasatuan=$overhead+intval($row->jumlah);
						                            echo duit($hargasatuan);
						                		?></td>
						                		<td class="price">
													<?php
														$total=intval($hargasatuan)*floatval(54.5);
														echo duit(ceil($total));
													?>
						                		</td>
						                	</tr>	
						                	<?php
						                		$hargatotalpekerjaan+=$total;
						                	?>                	
					                	<?php $i++;endforeach;?>
				                		<tr>
				                			<td colspan="5" align="right" class="text-red"> Jumlah Total*</td>
				                			<td class="price"><?=duit(ceil($hargatotalpekerjaan))?></td>
				                		</tr>
				                	<?php else:?>
				                		<tr>
				                			<td colspan="6" align="center">
				                				Data satuan pekerjaan tidak ditemukan
				                			</td>
				                		</tr>
				                	<?php endif;?>			                		
				                </tbody>            		
				        	</table>								
							</td>							
						</tr>		    			
		    		</table>
		    		<table class="table" width="100%">
		    			<tr>
		    				<td width="70%"><h2>Grand Total*</h2></td>
		    				<td align="right" class="bg-red" ><h1><?= duit(ceil($hargatotalpekerjaan+$hargatotal))?></h1></td>
		    			</tr>
		    		</table>
		    		<i class="text-red">* Melalui proses pembulatan keatas</i>	
			      <table id="table3" style="padding: 10px" align="right">
			      	<tr>
			      		<td align="center"><?= ucwords($config['tempat']).', '.date('d-m-Y')?><br>dibuat oleh<br>
							<?= strtoupper($config['cv'])?>
			      			<br><br>
			      			<br><br>
			      			<b><?= ucwords($config['ttd'])?></b><br>
			      			<i>Direktur</i>
			      		</td>
			      	</tr>
			      </table>		    			    				    		
			    </div>
			</div>		 	
		 </div>
	</div>
</body>
</html>