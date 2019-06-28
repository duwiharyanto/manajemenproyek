<!DOCTYPE>
<html>
<head>
	<title><?=strtoupper($global->headline)?></title>
</head>
<style type="text/css">
	#table th,#table td {
	  border: 1px solid black;
	  padding: 5px;
	}
	#table2 th,#table2 td {
	  border: 1px solid black;
	  padding: 5px;
	}		
</style>
<body>
<div class="box box-warning">
	<h2 align="center"><?= ucwords($global->headline)?></h2>
    <div class="box-header ">
      <h3 class="box-title"><?php echo ucwords("Tafisiran Pekerjaan")?></h3>
    </div>
    <div class="box-body table-responsive">
    	<table style="width:100%" id="table" class="table table-bordered table-striped" cellspacing="0" cellpadding="0">
            <thead>
                <tr class="bg-orange">
                  <th width="5%">id</th>
                  <th width="10%">Kode</th>
                  <th width="70%">Tafsiran</th>
                  <th width="15%">Harga</th>
                </tr>
            </thead>
            <tbody>
              <?php $subtotaltaksiran=0;?>
              <?php if($datatafsiran):?>
                <?php $i=1;$total=0;foreach ($datatafsiran as $row):?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=$row->taksiran_kode?></td>
                    <td><?=ucwords($row->taksiran_uraian)?></td>
                    <td class="price"><?="Rp " . number_format($row->taksiran_hargasatuan,0,',','.')?></td>
                </tr>  
                <?php $subtotaltaksiran+=intval($row->taksiran_hargasatuan)?>                 
                <?php $i++;endforeach;?>
                <tr style="background-color: grey">
                    <td colspan="3" align="right"> <b>Total</b></td>
                    <td colspan="1" class="price"><?="Rp " . number_format($subtotaltaksiran,0,',','.')?></td> 
                </tr>              
              <?php else:?>
                  <tr>
                    <td colspan="4" class="bg-red">Data tidak ditemukan</td>
                  </tr>                
              <?php endif;?>
            </tbody>            		
    	</table>
    </div>
</div>
<!---->
<div class="box box-primary ">
    <div class="box-header">
      <h3 class="box-title"><?php echo ucwords('Satuan Pekerjaan')?></h3>         
    </div>
    <div class="box-body table-responsive">
    	<table style="width:100%" id="table" class="table table-bordered table-striped table-hover" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="bg-blue">
                  <th width="5%">No</th>
                  <th width="10%">Kode</th>
                  <th width="25%">Analisa</th>
                  <th width="10%">Jumlah Harga</th>
                  <th width="15%">Overhead(%)</th>
                  <th width="15%">Harga Satuan</th>
                </tr>
            </thead>
            <tbody>
              <?php $subtotalpekerjaan=0;?>
              <?php if($analisapekerjaan2):?>
                <?php $i=1;foreach ($analisapekerjaan2 as $row):?>
                    <tr>
                      <td><?=$i?></td>
                      <td><?=$row->analisapekerjaan_kode?></td>
                      <td><?=ucwords($row->analisapekerjaan_kegiatan)?></td>
                      <td class="price"> <?="Rp " . number_format($row->jumlah,0,',','.')?> </td>
                      <td class="">
                        <?php 
                            $overhead=intval(intval($row->jumlah) * intval($row->analisapekerjaan_overhead)/100);
                            echo  "Rp " . number_format($overhead,0,',','.').'('.$row->analisapekerjaan_overhead ."%)";
                        ?>                         
                      </td>
                      
                      <td class="price"> 
                        <?php 
                            $overhead=intval(intval($row->jumlah) * intval($row->analisapekerjaan_overhead)/100);
                            $hargasatuan=$overhead+intval($row->jumlah);
                            echo "Rp " . number_format($hargasatuan,0,',','.');
                            $subtotalpekerjaan+=$hargasatuan;
                        ?> 
                      </td>
                    </tr> 
                                       
                <?php $i++;endforeach;?>
                <tr style="background-color: grey">
                   <td colspan="5" align="right"> <b>Total</b></td>
                   <td colspan="1" class="price"><?= "Rp " . number_format($subtotalpekerjaan,0,',','.')?></td> 
                </tr>                               
              <?php else:?>
                  <tr>
                    <td colspan="6" class="bg-red">Data tidak ditemukan</td>
                  </tr>
              <?php endif;?>
            </tbody>            		
    	</table>
      <table class="table" width="100%">
        <tr>
          <td width="40%" align="left"><h3>Grand Total</h3></td>
          <td class="price bg-red" align="right" style="font-size: 48px"><?php
           $grantotal=intval($subtotaltaksiran)+intval($subtotalpekerjaan);
           echo "Rp " . number_format($grantotal,0,',','.')
           ?></td>
        </tr>
      </table>
      <table id="table3" style="padding: 10px" align="right">
      	<tr>
      		<td align="center"><?= ucwords($config['tempat']).', '.date('d-m-Y')?><br>dibuat oleh<br><br><br>
      			<br><br>
      			<b><?= ucwords($config['ttd'])?></b><br>
      			<i>Direktur</i>
      		</td>
      	</tr>
      </table>      
    </div>
</div>
</body>
</html>