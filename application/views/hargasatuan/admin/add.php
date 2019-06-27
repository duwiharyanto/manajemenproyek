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
				<label>Kategori</label>
				<select class="form-group selectdata" style="width: 100%" name="hargasatuan_idkategori">
					<?php foreach($kategori AS $row):?>
						<option value="<?=$row->kategorisatuan_id?>"><?= $row->kategorisatuan_kode.' - '.$row->kategorisatuan_nama?></option>
					<?php endforeach;?>
				</select>
			</div>
			<div class="form-group">
				<label>Kode</label>
				<input required type="text" class="form-control" name="hargasatuan_kode" />
			</div>
			<div class="form-group">
				<label>Uraian</label>
				<input required type="text" class="form-control" name="hargasatuan_uraian" />
			</div>
			<div class="form-group">
				<label>Harga Satuan</label>
				<input required type="text" class="price form-control" name="hargasatuan_hargasatuan">
			</div>
			<div id="satuan"></div>
			<div class="form-group">
				<label>Keterangan</label>
				<textarea type="text" class="form-control" name="hargasatuan_keterangan" rows="5"></textarea>
			</div>		
			<div class="form-group">
				<button type="submit" name="submit" value="submit" class="btn btn-flat btn-block btn-primary">Simpan</button>
			</div>										
		</div>		
	</div>			
</form>	
<script type="text/javascript">
	$("#satuan").load("<?= base_url('addon/addon/select_satuan')?>")
</script>	
<?php
	include 'action.js';
?>