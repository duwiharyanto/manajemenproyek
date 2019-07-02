<?php if(!$data AND !$taksiran):?>
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
			<div class="box box-primary box-solid">
			    <div class="box-header bg-primary">
			      <h3 class="box-title">Tabel <?php echo ucwords($global->headline)?></h3>
			      <div class="box-tools pull-right">
			      	<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			      </div>      
			    </div>
			    <div class="box-body">
		    		<table class="table " width="100%">
						<tr>
							<th colspan="2" align="left" class="bg-blue">Detail Pekerjaan</th>
						</tr>		    			
		    			<tr>
		    				<th width="10%">Pekerjaan</th>
		    				<td width="90%"><?= ucwords($pekerjaan->pekerjaan_kegiatan)?></td>
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
		    		<br>
		    		<!--TABEL TAKSIRAN-->
		    		<table class="table" width="100%">
						<tr>
							<th  align="left" class="bg-blue">Pekerjaan Persiapan Dan Prasarana Penunjang</th>
						</tr>
						<tr>
							<td>
				        	<table width="100%"   class="table table-bordered table-striped" >
				                <thead>			                	
					                <tr>
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
						                		<td class="price"><?=$row->taksiran_hargasatuan?></td>
						                		<td class="price">
													<?=$row->taksiran_hargasatuan?>
						                		</td>
						                	</tr>	
						                	<?php
						                		$hargatotal+=$row->taksiran_hargasatuan;
						                	?>                	
					                	<?php $i++;endforeach;?>
				                		<tr>
				                			<td colspan="6" align="right" class="text-red"> Jumlah Total*</td>
				                			<td class="price"><?=$hargatotal?></td>
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
				        	<table width="100%"   class="table table-bordered table-striped" >
				                <thead>			                	
					                <tr>
					                  <th width="5%">No</th>
					                  <th width="5%">id</th>
					                  <th width="10%">Kode</th>
					                  <th width="35%">Uraian</th>
					                  <th width="15%">Volume*</th>
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
						                		<td><?=$row->analisapekerjaan_id?></td>
						                		<td><?=$row->analisapekerjaan_kode?></td>
						                		<td><?=ucwords($row->analisapekerjaan_kegiatan)?></td>
						                		<td><?= $row->analisapekerjaan_volume?></td>
						                		<td class="price"><?php
						                			$hargasatuan=0;
						                            $overhead=intval(intval($row->jumlah) * intval($row->analisapekerjaan_overhead)/100);
						                            $hargasatuan=$overhead+intval($row->jumlah);
						                            echo $hargasatuan;
						                		?></td>
						                		<td class="price">
													<?php
														$total=intval($hargasatuan)*floatval($row->analisapekerjaan_volume);
														echo ceil($total);
													?>
						                		</td>
						                	</tr>	
						                	<?php
						                		$hargatotalpekerjaan+=$total;
						                	?>                	
					                	<?php $i++;endforeach;?>
				                		<tr>
				                			<td colspan="6" align="right" class="text-red"> Jumlah Total*</td>
				                			<td class="price"><?=ceil($hargatotalpekerjaan)?></td>
				                		</tr>
				                	<?php else:?>
				                		<tr>
				                			<td colspan="8" align="center">
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
			    </div>
			</div>		 	
		 </div>
	</div>
<?php endif;?>

<?php include 'action.js'; ?>