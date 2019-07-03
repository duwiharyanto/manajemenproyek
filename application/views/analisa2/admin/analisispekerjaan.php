<div class="modal-dialog" style="min-width:80%">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?php echo ucwords($global->headline)?></h4>
		</div>
		<form onsubmit="simpandetailanalisa()" url="<?= base_url($global->url.'simpandetailanalisa')?>" id="detailanalisa" method="POST">
		<div class="modal-body">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label>Kode</label>
						<input required readonly type="text" name="analisa_kode" class="text-capitalize form-control" value="<?=$analisapekerjaan->analisapekerjaan_kode?>"></input>	
						<input required readonly type="text" name="analisadetail_idpekerjaan" class="text-capitalize form-control hide" value="<?=$analisapekerjaan->analisapekerjaan_id?>"></input>
					</div>
					<div class="col-sm-10">
						<label>Kegiatan</label>
						<input required readonly type="text" class="form-control"  name="analisa_kegiatan" value="<?=$analisapekerjaan->analisapekerjaan_kegiatan?>" />						
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
								<option selected="selected" disabled="disabled">Pilih Satuan</option>
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
						<div class="form-group">
							<label>Jumlah Harga</label>	<br>
							<input required type="text" class="form-control"  name="analisa_harga" />								
						</div>
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