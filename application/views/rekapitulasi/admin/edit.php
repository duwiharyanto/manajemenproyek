<form method="POST" action="<?= base_url($global->url)?>" enctype="multipart/form-data">
	<div class="box box-warning animated bounceInRight">
		<div class="box-header with-border">
			<h3 class="box-title"><?= ucwords($global->headline)?></h3>
		</div>
		<div class="box-body">
			<div class="form-group">
				<label>Id</label>
				<input type="text" class="form-control" readonly="readonly" name="id" value="<?= $data->pekerjaan_id?>" />
			</div>
			<div class="form-group">
				<label>Tahun Anggaran</label>
				<input required type="text" name="pekerjaan_tahunanggaran" class="text-capitalize form-control" value="<?=$data->pekerjaan_tahunanggaran?>"></input>
			</div>
			<div class="form-group">
				<label>Kegiatan</label>
				<textarea required type="text" name="pekerjaan_kegiatan" class="text-capitalize form-control"  rows="5"><?=$data->pekerjaan_kegiatan?></textarea>
			</div>
			<div class="form-group">
				<label>Pekerjaan</label>
				<textarea required type="text" name="pekerjaan_pekerjaan" class="text-capitalize form-control" rows="5"><?=$data->pekerjaan_pekerjaan?></textarea>
			</div>
			<div class="form-group">
				<label>Lokasi</label>
				<textarea required type="text" name="pekerjaan_lokasi" class="text-capitalize form-control" rows="2"><?=$data->pekerjaan_lokasi?></textarea>
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
	include 'action.js';
?>