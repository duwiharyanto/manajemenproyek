<div class="box box-warning">
        <div class="box-header">
          <h3 class="box-title"><?php echo ucwords("Detail Tafisiran")?></h3>
          <button class="btn btn-xs btn-success btn-flat pull-right" onclick="loaddata(<?= $pekerjaan_id?>)" id="tafsirantmbl" url="<?= base_url($global->url.'addtafsiran')?>" value="<?= $pekerjaan_id?>">Refresh <i class="fa fa-refresh"></i></button>          
          <button class="btn btn-xs btn-warning btn-flat pull-right" onclick="tambahtafsiran()" id="tafsirantmbl" url="<?= base_url($global->url.'addtafsiran')?>" value="<?= $pekerjaan_id?>">Tambah <i class="fa fa-plus"></i></button>
        </div>
        <div class="box-body table-responsive">
        	<table style="width:100%" id="" class="datatabel table table-bordered table-striped">
                <thead>
	                <tr>
	                  <th width="5%">No</th>
	                  <th width="5%">id</th>
	                  <th width="10%">Kode</th>
	                  <th width="70%">Tafsiran</th>
	                  <th width="5%" class="text-center">Aksi</th>
	                </tr>
                </thead>
                <tbody>
                	<?php $i=1;foreach ($datatafsiran as $row):?>
	                	<tr>
	                		<td><?=$i?></td>
	                		<td><?=$row->analisa_id?></td>
	                		<td><?=$row->taksiran_kode?></td>
	                		<td><?=ucwords($row->taksiran_uraian)?><br>
	                		<td class="text-center">
	                			<?php include 'button.php';?>
	                		</td>
	                	</tr>	                	
                	<?php $i++;endforeach;?>
                </tbody>            		
        	</table>
        	<p>Keterengan : <br>
        		<a href="#" class="btn btn-flat btn-xs btn-info" style="width:25px"><span class="fa fa-pencil"></span></a> : Edit<br>
        		<a href="#" class="btn btn-flat btn-xs btn-danger" style="width:25px"><span class="fa fa-trash"></span></a> : Hapus	
        	</p>
        </div>
</div>
<div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?php echo ucwords($global->headline)?></h3>
          <button class="btn btn-xs btn-primary btn-flat pull-right" data-toggle="modal" data-target="#modal-analisa">Tambah <i class="fa fa-plus"></i></button>
        </div>
        <div class="box-body table-responsive">
        	<table style="width:100%" id="" class="datatabel table table-bordered table-striped">
                <thead>
	                <tr>
	                  <th width="5%">No</th>
	                  <th width="5%">id</th>
	                  <th width="10%">Kode</th>
	                  <th width="30%">Analisa</th>
	                  <th width="10%">Overhead</th>
	                  <th width="30%">Jumlah</th>
	                  <th width="5%" class="text-center">Aksi</th>
	                </tr>
                </thead>
                <tbody>
                	<?php $i=1;foreach ($datasatuan as $row):?>
	                	<tr>
	                		<td><?=$i?></td>
	                		<td><?=$row->analisa_id?></td>
	                		<td><?=$row->analisa_kode?></td>
	                		<td><?=ucwords($row->analisa_analisa)?><br>
	                		<td><?=$row->analisa_overhead?></td>
	                		<td><?=$row->analisa_jumlah?></td>
	                		<td class="text-center">
	                			<?php include 'button.php';?>
	                		</td>
	                	</tr>	                	
                	<?php $i++;endforeach;?>
                </tbody>            		
        	</table>
        	<p>Keterengan : <br>
        		<a href="#" class="btn btn-flat btn-xs btn-info" style="width:25px"><span class="fa fa-pencil"></span></a> : Edit<br>
        		<a href="#" class="btn btn-flat btn-xs btn-danger" style="width:25px"><span class="fa fa-trash"></span></a> : Hapus	
        	</p>
        </div>
</div>
<div id="tafsiran"></div>
<div class="modal fade" id="modal-analisa">
	<div class="modal-dialog" style="min-width:80%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Add <?php echo ucwords($global->headline)?></h4>
			</div>
			<form action="<?= base_url($global->url)?>" method="POST">
			<div class="modal-body">
				<div class="form-group">
					<div class="row">
						<div class="col-sm-2">
							<label>Kode</label>
							<input required type="text" name="analisa_kode" class="text-capitalize form-control" ></input>						
						</div>
						<div class="col-sm-10">
							<label>Kegiatan</label>
							<input required type="text" class="form-control"  name="analisa_kegiatan" />						
						</div>
					</div>
				</div>
				<div style="background-color:#D2D6DE;padding:10px;margin-bottom:10px">	
					<div class="form-group">
						<div class="row">	
							<div class="col-sm-offset-10 col-sm-2">
								<div class="btn-group  pull-right">
								<button type="button" class="btn btn-xs btn-danger btn-flat" id="remove_satuan">Remove <i class="fa  fa-remove"></i></button>
								<button type="button" class="btn btn-xs btn-primary btn-flat" id="add_satuan">Tambah <i class="fa fa-plus"></i></button>
								</div>
							</div>															
						</div>
					</div>					
					<div class="satuan">

					</div>	
					<div class="pre">	
					<div class="form-group ">
						<div class="row parent" id="hello"  style="padding-top:10px">
							<div class="col-sm-4">
								<label>Satuan <span id="lbl"></span></label>
								<select class="form-control select2 selectsatuan" style="width:100%"  id="add1" name="analisis_pekerjaanid[]">
									<?php foreach($satuan AS $row):?>
									<option value="<?=$row->hargasatuan_id?>" harga="<?=$row->hargasatuan_hargasatuan?>"><?=ucwords($row->hargasatuan_uraian)?></option>
									<?php endforeach;?>
								</select>								
							</div>
							<div class="col-sm-2">
								<label>Koefisien <span id="koefisien">koe1</span></label>
								<input required type="text" class="form-control" id="inptkoefisien" name="koefisien[]" value="1">
							</div>
							<div class="col-sm-3">
								<label>Harga Satuan <span ></span></label>
								<input readonly type="text" class="form-control sat" id="inptsat">
							</div>	
							<div class="col-sm-3">
								<label>Jumlah</label>
								<input readonly type="text" class="form-control text-left jumlah hitjumlah" id="jumlah">
							</div>															
						</div>
					</div>

					</div>																
				</div>	
				<div class="form-group">
					<button type="button" class="btn btn-flat btn-md btn-primary pull-right" id="hitungjumlah">Hitung</button>
				</div>					
				<div class="form-group">
					<div class="row">
						<div class="col-sm-offset-7 col-sm-5">
							<label>Jumlah Harga</label>	<br>
							<input required type="text" class="form-control"  name="analisa_harga" />
							<label>Overhead & Profit 15%</label><br>	
							<input required type="text" class="form-control" name="analisa_overhead" />	
							<label>Harga Satuan Pekerjaan</label>
							<input required type="text" class="form-control" name="analisa_overhead" />	
						</div>
					</div>												
				</div>
				<div id="hasil"></div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary btn-block btn-flat">Save changes</button>
			</div>
			</form>

		</div>
	</div>
</div>
<?php include 'action2.php'; ?>
<?php include 'action.php'; ?>