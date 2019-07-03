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
							<label>Koefisien </label>
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
						<input required type="text" class="form-control" name="analisa_total" />	
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
<?php include 'action.php';?>
<?php include 'action2.php';?>