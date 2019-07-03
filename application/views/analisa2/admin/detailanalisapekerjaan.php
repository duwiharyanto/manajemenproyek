<div class="box box-solid">
    <h3>Perhitungan masih salah</h3>
     <div class="box-body table-responsive">
        <table class="table table-striped" width="100%">
            <tr>
               <th colspan="2" class="bg-blue">Nama Pekerjaan</th> 
            </tr>
            <tr>
                <th width="20%" align="left">Pekerjaan</th>
                <td width="80%" align="left"><?= ucwords($analisapekerjaan->analisapekerjaan_kegiatan)?></td>
            </tr>
            <tr>
                <th>Kode</th>
                <td><?= $analisapekerjaan->analisapekerjaan_kode?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="form-group pull-right">
                        <label class="hidden-xs">&nbsp</label>
                        <button type="button" url="<?= base_url($global->url.'cetakdetailanalisapekerjaan/'.$analisapekerjaan_id)?>" onclick="cetak()" class="btn btn-flat  btn-warning " id="print"><i class="fa fa-print"></i> Cetak</button>
                    </div>                    
                </td>
            </tr>                
        </table>         
     </div>
</div>
<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucwords($global->headline)?></h3>
        <button class="btn btn-xs btn-warning btn-flat pull-right" onclick="tambahanalisispekerjaan()" id="analisispekerjaantmbl" url="<?= base_url($global->url.'addanalisispekerjaan')?>" value="<?= $analisapekerjaan_id?>">Tambah <i class="fa fa-plus"></i></button>
        <a href="<?= site_url($global->url)?>" class="btn btn-xs btn-danger btn-flat pull-right">Kembali <i class="fa  fa-arrow-left"></i></a>        
    </div>
        <div class="box-body table-responsive">
        	<table style="width:100%" id="" class=" table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="5%">id</th>
                        <th width="10%">Kode</th>
                        <th width="30%">Uraian</th>
                        <th width="10%">Satuan</th>
                        <th width="10%">Koefisien</th> 
                        <th width="10%">Harga</th>
                        <th width="10%">Jumlah</th>
                        <th width="5%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total=0; ?>
                    <?php if($detailanalisapekerjaan):?>
                        <?php $i=1;foreach ($detailanalisapekerjaan as $row):?>
                            <tr style="background-color: grey">
                                <td colspan="10"><?= $i.'. '.ucwords($row->kategorisatuan_nama)?></td>
                            </tr>

                            <?php if($row->data):?> 
                                <?php $subtotal=0;?> 
                                <?php $x=1;foreach ($row->data as $rows):?>
                                    <tr>
                                        <td><?=$i.'.'.$x?></td>
                                        <td><?=$rows->analisadetail_id?></td>
                                        <td><?=$rows->hargasatuan_kode?></td>
                                        <td><?=ucwords($rows->hargasatuan_uraian)?></td>
                                        <td><?=ucwords($rows->satuan_kode)?></td>
                                        <td><?=$rows->analisadetail_koefisien?></td>
                                        <td class="price"><?="Rp " . number_format($rows->hargasatuan_hargasatuan,0,',','.')?></td>
                                        <td class="">
                                            <?php
                                            $jumlah=intval($rows->hargasatuan_hargasatuan)*floatval($rows->analisadetail_koefisien);
                                            echo "Rp " . number_format($jumlah,2,',','.');
                                            ?>                                
                                        </td>
                                        <td class="text-center">
                                            <?php include 'buttondetailanalisa.php';?>
                                        </td>                                     
                                    </tr> 
                                    <?php
                                        $subtotal+=$jumlah;
                                        $total+=$jumlah;
                                    ?>                          
                                <?php $x++;endforeach;?>
                                <tr>
                                    <td colspan="7" align="right">
                                        <i>Jumlah <?= ucwords($row->kategorisatuan_nama)?></i>
                                    </td>
                                    <td class="">
                                        <?= "Rp " . number_format($subtotal,2,',','.')?>
                                    </td>
                                </tr>
                            <?php else:?>
                                <tr>
                                    <td colspan="10" align="left">Data tidak ditemukan</td>
                                </tr>
                            <?php endif;?>              	
                        <?php $i++;endforeach;?>
                    <?php else:?>
                        <tr>
                            <td colspan="10" align="left">Data tidak ditemukan</td>
                        </tr>                        
                    <?php endif;?>
                    <tr style="background-color: grey">
                        <td colspan="7" align="right">Total</td>
                        <td colspan="2" class=""><?= "Rp " . number_format($total,2,',','.')?></td>
                    </tr>
                </tbody>            		
        	</table>
      <table class="table" width="100%">
        <tr>
          <td width="60%" align="left"><h3>Grand Total</h3></td>
          <td class=" bg-red" align="right" style="font-size: 48px"><?= duit2(intval($total))?></td>
        </tr>
      </table>            
        </div>
</div>
<?php include 'action.php'; ?>
<?php include 'action2.php'; ?>
<script type="text/javascript">
    function cetak(){
        url=$('#print').attr('url');
        //alert(url);
        window.open(url,'name','width=800,height=600');        
    }
</script>