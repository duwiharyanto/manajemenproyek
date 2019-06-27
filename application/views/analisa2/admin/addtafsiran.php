
<div class="modal-dialog" style="min-width:80%">
	<div class="modal-content">
		<div class="modal-header bg-primary" style="color:white">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add <?php echo ucwords($global->headline)?></h4>
		</div>
		<form onsubmit="simpantafsiran()" url="<?= base_url($global->url.'simpantafsiran')?>" id="formtafsiran" method="POST">
		<div class="modal-body">		
				<div class="form-group">
					<div class="row">
						<div class="col-sm-9">
							<label>Pekerjaan</label>
							<input type="text" readonly="readonly"class="form-control" value="<?=ucwords($pekerjaan->pekerjaan_kegiatan)?>"></input>	
							<input type="text" readonly="readonly"  name="pekerjaan_id" class="hide form-control" value="<?=$pekerjaan->pekerjaan_id?>"></input>																
						</div>								
						<div class="col-sm-3">
							<div class="btn-group  pull-right">
							<button type="button" class="btn btn-xs btn-danger btn-flat" id="remove_tafsiran">Remove <i class="fa  fa-remove"></i></button>
							<button type="button" class="btn btn-xs btn-primary btn-flat" id="add_tafsiran">Tambah <i class="fa fa-plus"></i></button>
							</div>
						</div>															
					</div>
				</div>			
				<div class="tafsiran">
				</div>	
				<div class="formtafsiran">	
					<div class="form-group ">
						<div class="row parent" id="taksiran_remove" style="padding-top:10px">
							<div class="col-sm-9">
								<div class="form-group">							
									<label>Satuan <span id="lbl"></span></label>
									<select class="form-control select2 selecttaksiran" style="width:100%"  id="taksiranadd1" name="analisis_taksiranid[]">
										<?php foreach($tafsiran AS $row):?>
										<option value="<?=$row->taksiran_id?>" harga="<?=$row->taksiran_hargasatuan?>"><?=ucwords($row->taksiran_uraian)?></option>
										<?php endforeach;?>
									</select>
								</div>								
							</div>							
							<div class="col-sm-3">
								<label>Harga<span ></span></label>
								<input readonly type="text" class="form-control harga" id="taksiran_harga">
							</div>																
						</div>
					</div>
				<!--PRE-->
				</div>				
				<div class="form-group">
					<button type="submit" class="btn btn-flat btn-block btn-primary">Simpan</button>
					<button type="button" class="tutup btn btn-flat btn-block btn-danger">Tutup</button>
				</div>				
		</div>
		</form>
	</div>
</div>
<!---->
<?php include 'action2.php'; ?>
<?php include 'action.php'; ?>