<div class="box box-solid animated fadeIn">
        <div class="box-header bg-primary" style="color:white">
         	<h3 class="box-title">Tabel <?php echo ucwords($global->headline) ?></h3>
        </div>
        <div class="box-body table-responsive">
        	<table style="width:100%" id="datatabel" class="table table-bordered table-striped">
        		<thead>
        			<tr>
        				<th width="5%">No</th>
        				<th width="5%">Param</th>
        				<th width="20%">Id User</th>
        				<th width="15%">Tanggal</th>
        				<th width="25%">Keterangan</th>
        				<th width="10%" class="text-center">Aksi</th>
        			</tr>
        		</thead>
                <tbody>
                	<?php $i = 1;foreach ($data as $row): ?>
	                	<tr>
	                		<td><?=$i?></td>
	                		<td><?=$row->log_id?></td>
							<td><?=$row->user_nama?></td>
	                		<td><?=date('d-m-Y H:i:s',strtotime($row->log_date))?><br>
	                		<td><?=$row->log_keterangan?></td>
	                		<td class="text-center">
	                			<?php include 'button.php';?>
	                		</td>
	                	</tr>
                	<?php $i++;endforeach;?>
                </tbody>
        	</table>
        </div>
</div>
<?php include 'action.js';?>