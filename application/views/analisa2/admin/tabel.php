<p class="help-block text-red ">Silahkan refresh untuk cek data</p>
<div class="form-group">

  <button class="btn btn-xs btn-success btn-flat " onclick="loaddata(<?= $pekerjaan_id?>)" id="tafsirantmbl" url="<?= base_url($global->url.'addtafsiran')?>" value="<?= $pekerjaan_id?>">Refresh <i class="fa fa-refresh"></i></button> 
</div>
<div class="box box-warning">
    <div class="box-header ">
      <h3 class="box-title"><?php echo ucwords("Detail Tafisiran")?></h3>
      <button class="btn btn-xs btn-warning btn-flat pull-right" onclick="tambahtafsiran()" id="tafsirantmbl" url="<?= base_url($global->url.'addtafsiran')?>" value="<?= $pekerjaan_id?>">Tambah <i class="fa fa-plus"></i></button>
    </div>
    <div class="box-body table-responsive">
    	<table style="width:100%" id="" class="table table-bordered table-striped">
            <thead>
                <tr class="bg-orange">
                  <th width="5%">No</th>
                  <th width="5%">id</th>
                  <th width="10%">Kode</th>
                  <th width="50%">Tafsiran</th>
                  <th width="20%">Harga</th>
                  <th width="5%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
              <?php $subtotaltaksiran=0;?>
              <?php if($datatafsiran):?>
                <?php $i=1;$total=0;foreach ($datatafsiran as $row):?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=$row->analisa_id?></td>
                    <td><?=$row->taksiran_kode?></td>
                    <td><?=ucwords($row->taksiran_uraian)?></td>
                    <td class="price"><?=$row->taksiran_hargasatuan?></td>
                    <td class="text-center">
                        <?php include 'button.php';?>
                    </td>
                </tr>  
                <?php $subtotaltaksiran+=intval($row->taksiran_hargasatuan)?>                 
                <?php $i++;endforeach;?>
                <tr style="background-color: grey">
                    <td colspan="4" align="right"> <b>Total</b></td>
                    <td colspan="2" class="price"><?= $subtotaltaksiran?></td> 
                </tr>              
              <?php else:?>
                  <tr>
                    <td colspan="8" class="bg-red">Data tidak ditemukan</td>
                  </tr>                
              <?php endif;?>
            </tbody>            		
    	</table>
    </div>
</div>
<!---->
<div class="box box-primary ">
    <div class="box-header">
      <h3 class="box-title"><?php echo ucwords($global->headline)?></h3>
      <button class="btn btn-xs btn-success btn-flat pull-right " onclick="analisapekerjaan2()" id="analisapekerjaantmbl2" url="<?= base_url($global->url.'addanalisapekerjaan2')?>" value="<?= $pekerjaan_id?>">Tambah <i class="fa fa-plus"></i></button>           
      <button class="btn btn-xs btn-primary btn-flat pull-right hide" onclick="analisapekerjaan()" id="analisapekerjaantmbl" url="<?= base_url($global->url.'addanalisapekerjaan')?>" value="<?= $pekerjaan_id?>">Tambah <i class="fa fa-plus"></i></button>          
    </div>
    <div class="box-body table-responsive">
    	<table style="width:100%" id="" class="table table-bordered table-striped table-hover">
            <thead>
                <tr class="bg-blue">
                  <th width="5%">No</th>
                  <th width="5%">id</th>
                  <th width="10%">Kode</th>
                  <th width="25%">Analisa</th>
                  <th width="10%">Vol</th>
                  <th width="10%">Jumlah Harga</th>
                  <th width="10%">Overhead(%)</th>
                  <th width="10%">Harga Satuan</th>
                  <th width="10%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
              <?php $subtotalpekerjaan=0;?>
              <?php if($analisapekerjaan2):?>
                <?php $i=1;foreach ($analisapekerjaan2 as $row):?>
                    <tr>
                      <td><?=$i?></td>
                      <td><?=$row->analisapekerjaan_id?></td>
                      <td class="<?= !$row->countdt ? 'bg-red':''?>"><?=$row->analisapekerjaan_kode?></td>
                      <td><a href="javascript:void(0)" onclick="detailanalisapekerjaan(<?=$row->analisapekerjaan_id?>)" url="<?= base_url($global->url.'detailanalisapekerjaan')?>" class="detailanalisapekerjaan"><?=ucwords($row->analisapekerjaan_kegiatan)?></a><br>
                      <td class=""> <?=$row->analisapekerjaan_volume?> </td>
                      <td class="price"> <?=$row->jumlah?> </td>
                      <td class="">
                        <?php 
                            $overhead=intval(intval($row->jumlah) * intval($row->analisapekerjaan_overhead)/100);
                            echo  "Rp " . number_format($overhead,0,',','.').'('.$row->analisapekerjaan_overhead ."%)";
                        ?>                         
                      </td>
                      <td class=""> 
                        <?php 
                            $overhead=intval(intval($row->jumlah) * intval($row->analisapekerjaan_overhead)/100);
                            $hargasatuan=$overhead+intval($row->jumlah);
                            echo duit2($hargasatuan);
                            $subtotalpekerjaan+=$hargasatuan;
                        ?> 
                      </td>
                      <td class="text-center">
                        <?php include 'buttonanalisapekerjaan.php';?>
                      </td>
                    </tr>             
                <?php $i++;endforeach;?>
                <tr style="background-color: grey">
                   <td colspan="7" align="right"> <b>Total</b></td>
                   <td colspan="2" class=""><?= duit2($subtotalpekerjaan)?></td> 
                </tr>                               
              <?php else:?>
                  <tr>
                    <td colspan="8" class="bg-red">Data tidak ditemukan</td>
                  </tr>
              <?php endif;?>
            </tbody>            		
    	</table>
      <table class="table" width="100%">
        <tr>
          <td width="60%" align="left"><h3>Grand Total</h3></td>
          <td class="price bg-red" align="right" style="font-size: 48px"><?= intval($subtotaltaksiran)+intval($subtotalpekerjaan)?></td>
        </tr>
      </table>
    </div>
</div>
<?php include 'action.php'; ?>
<?php include 'action2.php'; ?>
