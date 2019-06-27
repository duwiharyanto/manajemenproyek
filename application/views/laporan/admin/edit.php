<div class="row">
	<div class="col-sm-12 animated bounceInRight">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title"><?= ucwords($global->headline)?></h3>
			</div>
			<div class="box-body">
				<form id="formadd" method="POST" action="<?= base_url($global->url.'/edit')?>" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Id</label>
								<input type="text" name="id" value="<?= $data->thakademik_id?>" readonly class="form-control">
							</div>
							<div class="form-group">
								<label>Kode</label>
								<input required type="text" name="thakademik_kode" value="<?= $data->thakademik_kode?>" class="form-control" title="Harus diisi">
							</div>
							<div class="form-group">
								<label>Status</label>
								<select class="form-control selectdata" name="thakademik_status" style="width:100%">
									<option value="1" <?= $data->thakademik_status==1 ? 'selected':''?>>Aktif</option>
									<option value="0" <?= $data->thakademik_status==0 ? 'selected':''?>>Tidak Aktif</option>
								</select>
							</div>																																											 
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group hide">
								<label>Foto</label>
								<input type="file" name="fileupload">
								<p class="help-block">Ukuran maksimal 5mb, jpg atau png</p>
							</div>							
							<div class="form-group">
								<button type="submit" value="submit" name="submit" class="btn btn-warning btn-block btn-flat">Simpan</button>
							</div>														
						</div>
					</div>
				</form>		
			</div>
		</div>		
	</div>	
</div>
<script type="text/javascript">
	//CKEDITOR.replace('editor1');
</script>
<?php include 'action.js'?>