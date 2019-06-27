<div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Tabel <?php echo ucwords($global->headline)?></h3>
        </div>
        <div class="box-body table-responsive">
        	<table style="width:100%" id="datatabel" class="table table-bordered table-striped">
                <thead>
	                <tr>
	                  <th width="5%">No</th>
	                  <th width="5%">id</th>
	                  <th width="10%">Kode</th>
	                  <th width="20%">Uraian</th>
	                  <th width="10%">Volume</th>
	                  <th width="10%">Satuan</th>
	                  <th width="30%">Harga Satuan</th>
	                  <th width="5%" class="text-center">Aksi</th>
	                </tr>
                </thead>
                <tbody>
                	<?php $i=1;foreach ($data as $row):?>
	                	<tr>
	                		<td><?=$i?></td>
	                		<td><?=$row->taksiran_id?></td>
	                		<td><?=ucwords($row->taksiran_kode)?></td>
	                		<td><?=ucwords($row->taksiran_uraian)?><br>
	                		<td class="volume"><?=$row->taksiran_volume?></td>
	                		<td><?=$row->satuan_kode?></td>
	                		<td class="price"><?=$row->taksiran_hargasatuan?></td>
	                		<td class="text-center">
	                			<?php include 'button.php';?>
	                		</td>
	                	</tr>	                	
                	<?php $i++;endforeach;?>
                </tbody>            		
        	</table>
        	<p>Keterengan : <br>
        		<a href="#" class="btn btn-flat btn-xs btn-info" style="width:25px"><span class="fa fa-pencil"></span></a> : Edit<br>
        		<a href="#" class="btn btn-flat btn-xs btn-danger" style="width:25px"><span class="fa fa-trash"></span></a> : Hapus	
        	</p>
        </div>
</div>
<?php include 'action.js'; ?>