<div class="row">
	<div class="col-sm-12 animated bounceInRight">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?= ucwords($global->headline)?></h3>
			</div>
			<div class="box-body">
				<form id="formadd" method="POST" action="<?= base_url($global->url)?>" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Id</label>
								<input type="text" name="id" placeholder="Auto Generated" readonly class="form-control">
							</div>
							<div class="form-group">
								<label>Kode</label>
								<input required type="text" name="thakademik_kode" class="form-control" title="Harus diisi">
							</div>
							<div class="form-group">
								<label>Status</label>
								<select class="form-control selectdata" name="thakademik_status" style="width:100%">
									<option value="1">Aktif</option>
									<option value="0">Tidak Aktif</option>
								</select>
							</div>																																											 
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">							
							<div class="form-group">
								<button type="submit" value="submit" name="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
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