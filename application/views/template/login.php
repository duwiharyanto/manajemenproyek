<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kegiatan | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php  echo base_url();?>asset/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php  echo base_url();?>asset/fontawesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php  echo base_url();?>asset/ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php  echo base_url();?>asset/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php  echo base_url();?>asset/plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition " style="background-image: url(<?=base_url('asset/dist/img/background.jpeg')?>); width:100%;height:100%;background-size: cover;">
<div class="container" >
  <section class="content">
    <div class="row" style="margin-top:50px">
      <div class="col-sm-6 col-md-offset-3">
        <div class="login-box " style="margin-top:0px;">
          <?php if($this->session->flashdata('error')):?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-ban"></i> Perhatian !</h4>
                <?= $this->session->flashdata('error')?>
            </div>  
          <?php elseif($this->session->flashdata('success')):?>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-ban"></i> Perhatian !</h4>
                <?= $this->session->flashdata('success')?>
            </div>
          <?php elseif($param=='1'):?>   
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-ban"></i> Perhatian !</h4>
                Halaman tidak ditemukan
            </div>             
          <?php endif;?>
          <div class="login-logo" style="color:grey">
            PT. ADHIKARYA
          </div>
          <!-- /.login-logo -->
          <div class="login-box-body" style="background-color:rgba(7,48,66,0.8);height:300px;">
            <p class="login-box-msg" ><a href="<?php echo site_url()?>" style="font-size:31px;"><img src="<?=base_url('asset/dist/img/arraymotion.png')?>" class="img img-responsive img-circle text" style="display: block;margin-right: auto;margin-left: auto;" width="80px" height="80px"></a></p>
            <form action="<?php  echo base_url('Login/aksi_login');?>" method="post">
              <div class="form-group has-feedback">
                <input required type="text" class="form-control" placeholder="Username" name="username">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input required type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <div class="form-group">
                     <button type="submit" class="btn  bg-primary btn-block btn-flat">Login</button>
                  </div>
                </div>
                <!-- /.col -->
              </div>
            </form>
          </div>
          <!-- /.login-box-body -->
          <div class="login-logo" style="color:white;font-size:14px;margin-top:10px">
            Copyright <?= date('Y')?>
          </div>          
        </div>    
      </div>
    </div>
  </section>
</div>
<!-- /.login-box -->
<!-- jQuery 2.2.3 -->
<script src="<?php  echo base_url();?>asset/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php  echo base_url();?>asset/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
