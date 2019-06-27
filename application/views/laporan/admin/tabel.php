<div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Tabel <?php echo ucwords($global->headline)?></h3>
        </div>
        <div class="box-body table-responsive">
        	<table style="width:100%" id="datatabel" class="table table-bordered table-striped">
                <thead>
	                <tr>
	                  <th width="5%">No</th>
	                  <th width="10%">Tahun Akademik</th>
	                  <th width="20%">Nama</th>
	                  <th width="10%">Nim</th>
	                  <th width="45%">Judul Skripsi/TA</th>
	                  <th width="10%" class="text-center">Aksi</th>
	                </tr>
                </thead>
                <tbody>
               	<?php $i=1;foreach ($data as $row):?>
	                	<tr>
	                		<td><?=$i?></td>
	                		<td><?=ucwords($row->formulir_thakademik)?></td>
	                		<td><?=ucwords($row->formulir_nama)?></td>
	                		<td><?=$row->formulir_nim?></td>
	                		<td><?=ucwords($row->formulir_judulskripsi)?></td>
	                		<td class="text-center">
	                			<a href="<?= site_url($global->url.'detailformulir/'.md5($row->formulir_id))?>" target="_blank" class="btn btn-flat btn-xs btn-info"><span class="fa fa-eye"></span></a>
	                			<a href="<?= base_url($global->url.'downloadfoto/'.$row->formulir_foto)?>" class="btn btn-flat btn-xs btn-warning"><span class="fa fa-download"></span></a>
	                			<a href="<?= base_url($global->url.'downloadbuktibayar/'.$row->formulir_buktibayar)?>" class="btn btn-flat btn-xs btn-default"><span class="fa fa-download"></span></a>
	                		</td>
	                	</tr>	                	
                	<?php $i++;endforeach;?> 
                </tbody>            		
        	</table>
        	<p>Keterengan : <br>
        	<a href="#" class="btn btn-flat btn-xs btn-info" style="width:25px"><span class="fa fa-eye"></span></a> : Detail User<br>
        		<a href="#" class="btn btn-flat btn-xs btn-warning" style="width:25px"><span class="fa fa-download"></span></a> : Download Foto<br>
        		<a href="#" class="btn btn-flat btn-xs btn-default" style="width:25px"><span class="fa fa-download"></span></a> : Download Bukti Bayar<br>
        	</p>
        </div>
</div>
<?php include 'action.js'; ?>