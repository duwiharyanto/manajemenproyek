<form method="POST" action="<?= base_url($global->url)?>" enctype="multipart/form-data">
	<div class="box box-primary animated bounceInRight">
		<div class="box-header with-border">
			<h3 class="box-title"><?= ucwords($global->headline)?></h3>
		</div>
		<div class="box-body">
			<div class="form-group">
				<label>Id</label>
				<input  type="text" class="form-control" readonly="readonly" value="Auto Generated"></input>
			</div>
			<div class="form-group">
				<label>Dibuat</label>
				<input required type="text" class="form-control" readonly="readonly" name="kategorisatuan_dibuat" value="<?= date('d-m-Y')?>"></input>
			</div>			
			<div class="form-group">
				<label>Kode Kategori</label>
				<input required type="text" class="form-control" name="kategorisatuan_kode"></input>
			</div>			
			<div class="form-group">
				<label>Nama Kategori</label>
				<input required type="text" class="form-control" name="kategorisatuan_nama"></input>
			</div>
			<div class="form-group">
				<label>Keterangan</label>
				<textarea class="form-control text-capitalize" rows="5" name="kategorisatuan_keterangan"></textarea>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-block btn-flat btn-primary" name="submit" value="submit">Simpan</button>
			</div>						
		</div>		
	</div>				
</form>	
<?php include 'action.js'?>