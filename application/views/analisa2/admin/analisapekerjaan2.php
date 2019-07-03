<div class="modal-dialog" style="min-width:80%">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add <?php echo ucwords($global->headline)?></h4>
		</div>
		<form onsubmit="simpananalisa()" url="<?= base_url($global->url.'simpananalisa')?>" id="analisa" method="POST">
		<div class="modal-body">
			<div class="form-group">
				<label>Kegiatan</label>
				<input type="text" readonly="readonly"class="form-control" value="<?=ucwords($pekerjaan->pekerjaan_kegiatan)?>"></input>	
				<input type="text" readonly="readonly"  name="pekerjaan_id" class="hide form-control" value="<?=$pekerjaan->pekerjaan_id?>"></input>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<div class="form-group">
							<label>Kode</label>
							<input required type="text" name="analisa_kode" class="text-capitalize form-control" ></input>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label>Satuan</label>
							<select class="form-control select2 " name="analisapekerjaan_idsatuan" style="width: 100%">
								<option selected="selected" disabled="disabled">Pilih Satuan</option>
								<?php foreach($satuan AS $row):?>
									<option value="<?=$row->satuan_id?>"><?= $row->satuan_kode?></option>
								<?php endforeach;?>
							</select>
							
						</div>
					</div>	
					<div class="col-sm-3">
						<div class="form-group">
							<label>Overhead & Profit</label><br>
							<div class="input-group">	
							<input required type="text" class="form-control" name="analisa_overhead" />
							<span class="input-group-addon">%</span>
							</div>
						</div>
					</div>				
					<div class="col-sm-3">
						<div class="form-group">
							<label>Volume Pekerjaan</label>
							<input required type="text" name="analisapekerjaan_volume" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Kegiatan</label>
				<textarea required type="text" class="form-control"  name="analisa_kegiatan" rows="6"></textarea>	
			</div>	
			<div id="hasil"></div>						
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary btn-block btn-flat">Save changes</button>
		</div>
		</form>

	</div>
</div>
<?php include 'action.php';?>
<?php include 'action2.php';?>