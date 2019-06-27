<form method="POST" action="<?= base_url($global->url)?>" enctype="multipart/form-data">
	<div class="box box-primary animated bounceInRight">
		<div class="box-header with-border">
			<h3 class="box-title"><?= ucwords($global->headline)?></h3>
		</div>
		<div class="box-body">
			<div class="form-group">
				<label>Id</label>
				<input type="text" class="form-control" readonly="readonly" value="Auto Generated" />
			</div>
			<div class="form-group">
				<label>Tahun Anggaran</label>
				<input required type="text" name="pekerjaan_tahunanggaran" class="text-capitalize form-control" ></input>
			</div>
			<div class="form-group">
				<label>Kegiatan</label>
				<textarea required type="text" name="pekerjaan_kegiatan" class="text-capitalize form-control" rows="5"></textarea>
			</div>
			<div class="form-group">
				<label>Pekerjaan</label>
				<textarea required type="text" name="pekerjaan_pekerjaan" class="text-capitalize form-control" rows="5"></textarea>
			</div>
			<div class="form-group">
				<label>Lokasi</label>
				<textarea required type="text" name="pekerjaan_lokasi" class="text-capitalize form-control" rows="2"></textarea>
			</div>									
			<div class="form-group">
				<button type="submit" name="submit" value="submit" class="btn btn-flat btn-block btn-primary">Simpan</button>
			</div>										
		</div>		
	</div>			
</form>
<?php
	include 'action.js';
?>