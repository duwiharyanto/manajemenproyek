<div class="row">
	<div class="col-sm-12 animated bounceInRight">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title"><?= ucwords($global->headline)?></h3>
				<button class="btn btn-xs btn-flat btn-danger pull-right" onclick="loaddata()">Kembali</button>
			</div>
			<div class="box-body">
				<form id="formadd" method="POST" url="<?= base_url($global->url.'edit')?>" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Id</label>
								<input type="text" name="id" placeholder="Auto Generated" readonly class="form-control" value="<?= $data->user_id?>">
							</div>
							<div class="form-group">
								<label>Nama</label>
								<input required type="text" name="user_nama" class="form-control" title="Harus diisi" value="<?= $data->user_nama?>">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input required type="text" name="user_username" class="form-control" title="Harus diisi" value="<?= $data->user_username?>">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input required type="password" name="user_password" class="form-control" title="Harus diisi" value="<?= $data->user_password?>">
							</div>
							<div class="form-group">
								<label>Status</label>
								<select class="form-control selectdata" name="user_level" style="width:100%">
									<option value="1" <?= $data->user_level=1? 'selected':''?>>Admin</option>
									<option value="2" <?= $data->user_level=2? 'selected':''?>>User</option>
								</select>
							</div>															 
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">							
							<div class="form-group">
								<button type="submit" value="submit" name="submit" class="btn btn-warning btn-block btn-flat">Update</button>
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