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
		<div class="box box-primary box-solid">
		    <div class="box-body">
	    		<table class="table " width="100%">	  
					<tr >
						<td  style="padding-bottom: 30px" colspan="2" align="center"><h3 class="box-title pull-right" ><?=strtoupper($global->headline)?></h3></td>
					</tr>	    		  			
	    			<tr >
	    				<th width="10%" align="left">Pekerjaan</th>
	    				<td width="90%"><?= ucwords($namaproyek)?></td>
	    			</tr>
	    		</table>
	    		<br>
	    		<!--TABEL TAKSIRAN-->
	    		<table  class="table" width="100%">
					<tr class="row">
						<th  align="left" class="bg-blue">1. Pekerjaan Persiapan Dan Prasarana Penunjang</th>
					</tr>
					<tr>
						<td>
			        	<table  id="table" width="100%"   class="table table-bordered table-striped" cellpadding="0" cellspacing="0">
			                <thead>			                	
				                <tr style="background-color: grey">
				                  <th width="5%">No</th>
				                  <th width="5%">id</th>
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
					                		<td><?=$row->taksiran_id?></td>
					                		<td><?=$row->taksiran_kode?></td>
					                		<td><?=ucwords($row->taksiran_uraian)?></td>
					                		<td><?=$row->taksiran_volume.' '.ucwords($row->satuan_kode)?></td>
					                		<td><?="Rp " . number_format($row->taksiran_hargasatuan,0,',','.')?></td>
					                		<td>
												<?="Rp " . number_format($row->taksiran_hargasatuan,0,',','.')?>
					                		</td>
					                	</tr>	
					                	<?php
					                		$hargatotal+=$row->taksiran_hargasatuan;
					                	?>                	
				                	<?php $i++;endforeach;?>
			                		<tr>
			                			<td colspan="6" align="right"><b>Jumlah Total</b></td>
			                			<td><?="Rp " . number_format($hargatotal,0,',','.')?></td>
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
						<th  align="left" class="bg-blue">2. Satuan Pekerjaan</th>
					</tr>
					<tr>
						<td>
			        	<table id="table" width="100%"  class="table table-bordered table-striped" cellpadding="0" cellspacing="0">
			                <thead>			                	
				                <tr style="background-color: grey">
				                  <th width="5%">No</th>
				                  <th width="5%">id</th>
				                  <th width="10%">Kode</th>
				                  <th width="40%">Uraian</th>
				                  <th width="15%">Volume</th>
				                  <th width="15%">Harga Satuan</th>
				                  <th width="15%" class="text-center bg-red" >Harga Total</th>
				                </tr>
			                </thead>
			                <tbody>
			                	<?php if($data):?>
				                	<?php $i=1;$hargatotal=0;foreach ($data as $row):?>
					                	<tr>
					                		<td><?=$i?></td>
					                		<td><?=$row->analisadetail_idhargasatuan?></td>
					                		<td><?=$row->hargasatuan_kode?></td>
					                		<td><?=ucwords($row->analisapekerjaan_kegiatan)?></td>
					                		<td>54,5</td>
					                		<td><?="Rp " . number_format($row->hargasatuan_hargasatuan,0,',','.');?></td>
					                		<td>
												<?php
													$total=intval($row->hargasatuan_hargasatuan)*54.5;
													echo "Rp " . number_format($total,0,',','.');
												?>
					                		</td>
					                	</tr>	
					                	<?php
					                		$hargatotal+=$total;
					                	?>                	
				                	<?php $i++;endforeach;?>
			                		<tr>
			                			<td colspan="6" align="right"> <b>Jumlah Total</b></td>
			                			<td class="price"><?="Rp " . number_format($hargatotal,0,',','.');?></td>
			                		</tr>
			                	<?php else:?>
			                		<tr>
			                			<td colspan="7" align="center">
			                				Data satuan pekerjaan tidak ditemukan
			                			</td>
			                		</tr>
			                	<?php endif;?>			                		
			                </tbody>            		
			        	</table>								
						</td>							
					</tr>	
				<tr>
					<td colspan="2" style="height: 40px"></td>
				</tr>
				<tr>
					<td colspan="2">
						<table id="table3" style="padding: 10px" align="right">
							<tr>
								<td align="center"><?= ucwords($config['tempat']).', '.date('d-m-Y')?><br>dibuat oleh<br><br><br>
									<br><br>
								<b><?= ucwords($config['ttd'])?></b><br>
								<i>Direktur</i>
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
</body>
</html>