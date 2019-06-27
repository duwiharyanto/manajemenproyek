<div class="form-group">
	<label>Satuan</label>
	<select class="selectdata form-control" name="satuan" style="width: 100%">
		<?php foreach($data AS $row):?>
			<option value="<?= $row->satuan_id?>"><?=ucwords($row->satuan_kode." - ".$row->satuan_satuan)?></option>
		<?php endforeach;?>
	</select>	
</div>
<?php include 'action.php'?>