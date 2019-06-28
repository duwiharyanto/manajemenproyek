<!DOCTYPE>
<html>
<head>
    <title></title>
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
<h2 align="center"><?php echo ucwords($global->headline)?></h2>
<div class="box box-solid">
     <div class="box-body table-responsive">
        <table class="table table-striped" width="100%">
            <tr>
                <th width="20%" align="left">Pekerjaan</th>
                <td width="80%" align="left"><?= $analisapekerjaan->analisapekerjaan_kegiatan?></td>
            </tr>
            <tr>
                <th align="left">Kode</th>
                <td><?= $analisapekerjaan->analisapekerjaan_kode?></td>
            </tr>               
        </table>         
     </div>
</div>
<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucwords('Daftar detail pekerjaan')?></h3>       
    </div>
        <div class="box-body table-responsive">
            <table style="width:100%" id="table" class=" table table-bordered table-striped" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Kode</th>
                        <th width="30%">Uraian</th>
                        <th width="10%">Satuan</th>
                        <th width="10%">Koefisien</th> 
                        <th width="10%">Harga</th>
                        <th width="10%">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total=0; ?>
                    <?php if($detailanalisapekerjaan):?>
                        <?php $i=1;foreach ($detailanalisapekerjaan as $row):?>
                            <tr style="background-color: grey">
                                <td colspan="7"><?= $i.'. '.ucwords($row->kategorisatuan_nama)?></td>
                            </tr>

                            <?php if($row->data):?> 
                                <?php $subtotal=0;?> 
                                <?php $x=1;foreach ($row->data as $rows):?>
                                    <tr>
                                        <td><?=$i.'.'.$x?></td>
                                        <td><?=$rows->hargasatuan_kode?></td>
                                        <td><?=ucwords($rows->hargasatuan_uraian)?></td>
                                        <td><?=ucwords($rows->satuan_kode)?></td>
                                        <td><?=ucwords($rows->analisadetail_koefisien)?></td>
                                        <td class="price"><?="Rp " . number_format($rows->hargasatuan_hargasatuan,0,',','.')?></td>
                                        <td class="price">
                                            <?php
                                            $jumlah=intval($rows->hargasatuan_hargasatuan)*intval($rows->analisadetail_koefisien);
                                            echo "Rp " . number_format($jumlah,0,',','.');
                                            ?>                                
                                        </td>                                    
                                    </tr> 
                                    <?php
                                        $subtotal+=$jumlah;
                                        $total+=$jumlah;
                                    ?>                          
                                <?php $x++;endforeach;?>
                                <tr>
                                    <td colspan="6" align="right">
                                        <i>Jumlah <?= ucwords($row->kategorisatuan_nama)?></i>
                                    </td>
                                    <td class="price">
                                        <?= "Rp " . number_format($subtotal,0,',','.')?>
                                    </td>
                                </tr>
                            <?php else:?>
                                <tr>
                                    <td colspan="7" align="left">Data tidak ditemukan</td>
                                </tr>
                            <?php endif;?>                  
                        <?php $i++;endforeach;?>
                    <?php else:?>
                        <tr>
                            <td colspan="7" align="left">Data tidak ditemukan</td>
                        </tr>                        
                    <?php endif;?>
                    <tr style="background-color: grey">
                        <td colspan="5" align="right">Total</td>
                        <td colspan="2" class="price"><?= "Rp " . number_format($total,0,',','.')?></td>
                    </tr>
                </tbody>                    
            </table>
            <table class="table" width="100%">
                <tr>
                    <td width="50%" align="left"><h3>Grand Total</h3></td>
                    <td class="price bg-red" align="right" style="font-size: 48px"><?= "Rp " . number_format(intval($total),0,',','.')?></td>
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
<script type="text/javascript">
    function cetak(){
        url=$('#print').attr('url');
        alert(url);
        //window.open(url,'name','width=800,height=600');        
    }
</script>
</body>
</html>