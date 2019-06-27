<div class="modal fade" id="modal-add" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-yellow-active">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?= ucwords($global->headline)?></h4>
      </div>
      <form id="formadd" method="POST" action="javascript:void(0)" url="<?=base_url($global->url.'edit')?>" enctype="multipart/form-data">      
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
              <div class="form-group">
                <label>Id</label>
                <input type="text" name="id" placeholder="Auto Generated" readonly class="form-control" value="<?= $data->user_id ?>">
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
                <input required id="password" type="password" name="user_password" class="form-control" title="Harus diisi" value="<?= $data->user_password?>">
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
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-sm-12">           
            <div class="form-group">
              <button type="submit" value="submit" name="submit" class="btn btn-warning btn-block btn-flat">Update</button>
            </div>                            
          </div>
        </div>
      </div>
      </form> 
    </div>
  </div>
</div>
<script type="text/javascript">
  //CKEDITOR.replace('editor1');  
</script>
<?php include 'action.js'?>