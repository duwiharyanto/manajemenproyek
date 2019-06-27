<form method="POST" action="<?= base_url($global->url)?>" enctype="multipart/form-data">
	<div class="box box-warning animated bounceInRight">
		<div class="box-header with-border">
			<h3 class="box-title"><?= ucwords($global->headline)?></h3>
		</div>
		<div class="box-body">
			<div class="form-group">
				<label>Id</label>
				<input type="text" class="form-control" readonly="readonly"  name="id" value="<?= $data->satuan_id?>" />
			</div>
			<div class="form-group">
				<label>Satuan Nama</label>
				<input required type="text" class="text-capitalize form-control" name="satuan_satuan" value="<?= $data->satuan_satuan?>"/>
			</div>
			<div class="form-group">
				<label>Satuan Kode</label>
				<input required type="text" class="form-control" name="satuan_kode" value="<?= $data->satuan_kode?>"/>
			</div>
			<div class="form-group">
				<label >Status</label>
				<select class="form-group selectdata" style="width:100%" name="satuan_status">
					<option value="1" <?= $data->satuan_status==1? 'selected':''?>>Aktif</option>
					<option value="0" <?= $data->satuan_status==0? 'selected':''?>>Non Aktif</option>
				</select>
			</div>	
			<div class="form-group">
				<button type="submit" name="submit" value="submit" class="btn btn-flat btn-block btn-warning">Update</button>
			</div>										
		</div>		
	</div>			
</form>	
<?php
	include 'action.js';
?>