<?php if(!$data AND !$taksiran):?>
	<div class="row">
		<div class="col-sm-12">
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-ban"></i> Perhatian !</h4>
					Data Tafsiran tidak ditemukan
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
		    				<td width="90%"><?= ucwords($namaproyek)?></td>
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
				                			<td colspan="6" align="right"> Jumlah Total</td>
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
						                		<td class="price"><?=$row->hargasatuan_hargasatuan?></td>
						                		<td class="price">
													<?php
														$total=intval($row->hargasatuan_hargasatuan)*54.5;
														echo $total;
													?>
						                		</td>
						                	</tr>	
						                	<?php
						                		$hargatotal+=$total;
						                	?>                	
					                	<?php $i++;endforeach;?>
				                		<tr>
				                			<td colspan="6" align="right"> Jumlah Total</td>
				                			<td class="price"><?=$hargatotal?></td>
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
			    </div>
			</div>		 	
		 </div>
	</div>
<?php endif;?>

<?php include 'action.js'; ?>