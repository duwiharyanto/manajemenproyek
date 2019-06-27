<div class="row">
	<div class="col-sm-12 animated bounceInRight">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?=ucwords($global->headline)?></h3>
				<button class="btn btn-xs btn-flat btn-danger pull-right" onclick="loaddata()">Kembali</button>
			</div>
			<div class="box-body">
				<form id="formadd" method="POST" url="<?=base_url($global->url.'add')?>" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Id</label>
								<input type="text" name="id" placeholder="Auto Generated" readonly class="form-control">
							</div>
							<div class="form-group">
								<label>Nama</label>
								<input required type="text" name="user_nama" class="form-control" title="Harus diisi">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input required type="text" name="user_username" class="form-control" title="Harus diisi">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input required type="password" name="user_password" class="form-control" title="Harus diisi">
							</div>
							<div class="form-group">
								<label>Status</label>
								<select class="form-control selectdata" name="user_level" style="width:100%">
									<option value="1">Admin</option>
									<option value="2" selected>User</option>
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