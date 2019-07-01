<div class="btn-group">
	<?php if($global->detail==true):?>
		<a href="#" id="<?=$row->log_id?>" url="<?= base_url($global->url.'detail')?>" class="detail btn btn-flat btn-xs btn-warning"><span class="fa fa-eye"></span></a>
	<?php endif;?>
	<?php if($global->edit==true):?>	
		<button   id="<?=$row->log_id?>" url="<?= base_url($global->url.'edit')?>" class="edit btn btn-flat btn-xs btn-primary"><span class="fa fa-pencil"></span></button>
		<button   id="<?=$row->log_id?>" url="<?= base_url($global->url.'modaledit')?>" class="modaledit btn btn-flat btn-xs btn-warning"><span class="fa fa-pencil"></span></button>		
	<?php endif;?>
	<?php if($global->delete==true):?>	
		<a href="#" url="<?=base_url($global->url.'hapus')?>"  id="<?=$row->log_id?>" class="hapus btn btn-flat btn-xs btn-danger"><span class="fa fa-trash"></span></a>
	<?php endif;?>
	<?php if($global->print==true):?>	
		<a id="<?=$row->log_id?>" href="<?= site_url($global->url.'cetak/'.md5($row->log_id))?>" target="_blank" class="btn btn-flat btn-xs btn-default"><span class="fa fa-print"></span></a>
	<?php endif;?>	
</div>