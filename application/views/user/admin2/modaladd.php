<div class="modal fade" id="adddata">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary" style="color:white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <div class="modal-body">
        <form id="formadd" method="POST" url="<?=base_url($global->url.'add')?>" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-12">
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
<?php include 'action.js';?>