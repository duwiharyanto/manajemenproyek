<form method="POST" action="<?= base_url($global->url)?>" enctype="multipart/form-data">
	<div class="box box-warning animated bounceInRight">
		<div class="box-header with-border">
			<h3 class="box-title"><?= ucwords($global->headline)?></h3>
		</div>
		<div class="box-body">
			<div class="form-group">
				<label>Id</label>
				<input type="text" class="form-control" readonly="readonly" name="id" value="<?= $data->taksiran_id?>" />
			</div>
			<div class="form-group">
				<label>Kode</label>
				<input type="text" name="taksiran_kode" class="text-capitalize form-control" value="ditaksir"></input>
			</div>
			<div class="form-group">
				<label>Uraian Pekerjaan</label>
				<textarea required type="text" name="taksiran_uraian" class="text-capitalize form-control" rows="5"><?= $data->taksiran_uraian?></textarea>
			</div>	
			<div class="form-group">
				<label>Volume</label>
				<input required type="text" name="taksiran_volume" class="volume form-control" value="<?= $data->taksiran_volume?>"></input>
			</div>
			<div id="satuan"></div>
			<div class="form-group">
				<label>Harga Satuan</label>
				<input required type="text" name="taksiran_hargasatuan" class="price form-control" value="<?= $data->taksiran_hargasatuan?>"></input>
			</div>			
			<div class="form-group">
				<button type="submit" name="submit" value="submit" class="btn btn-flat btn-block btn-warning">Update</button>
			</div>										
		</div>		
	</div>			
</form>	
<script type="text/javascript">
	$("#satuan").load("<?= base_url('addon/addon/edit_select_satuan/'.$data->taksiran_satuan)?>")
</script>
<?php
	include 'action.php';
?>