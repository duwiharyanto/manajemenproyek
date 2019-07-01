<div class="box box-primary animated fadeIn">
        <div class="box-header bg-primary" style="color:white">
          <h3 class="box-title">Tabel <?php echo ucwords($global->headline) ?></h3>
        </div>
        <div class="box-body table-responsive">
        	<table style="width:100%" id="datatabel" class="table table-bordered table-striped">
                <thead>
	                <tr>
	                  <th width="5%">No</th>
										<th width="15%">Nama</th>
	                  <th width="15%">Username</th>
	                  <th width="15%">Password</th>
	                  <th width="10%">Level</th>
	                  <th width="15%">Tersimpan</th>
	                  <th width="10%">Log</th>
	                  <th width="10%" class="text-center">Aksi</th>
	                </tr>
                </thead>
                <tbody>
                	<?php $i = 1;foreach ($data as $row): ?>
	                	<tr>
	                		<td><?=$i?></td>
	                		<td><?=$row->user_nama?></td>
							<td><?=$row->user_username?></td>
	                		<td><?=$row->user_password?><br>
	                		<td><?=$row->user_level?></td>
	                		<td><?=$row->user_tersimpan?></td>
	                		<td><?= $row->log ? ucwords($row->log):'not found'?>
	                			<br>
	                			<?= $row->log ? date('d-m-Y H:i:s',strtotime($row->tanggallog)):''?>
	                		</td>
	                		<td class="text-center">
	                			<?php include 'button.php';?>
	                		</td>
	                	</tr>
                	<?php $i++;endforeach;?>
                </tbody>
        	</table>
        	<p>Keterengan : <br>
        		<a href="#" class="btn btn-flat btn-xs btn-warning" style="width:25px"><span class="fa fa-eye"></span></a> : Detail<br>
        		<a href="#" class="btn btn-flat btn-xs btn-info" style="width:25px"><span class="fa fa-pencil"></span></a> : Edit<br>
        		<a href="#" class="btn btn-flat btn-xs btn-danger" style="width:25px"><span class="fa fa-trash"></span></a> : Hapus
        	</p>
        </div>
</div>
<?php include 'action.js';?>