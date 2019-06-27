<div class="btn-group">
	<?php if($global->detail==true):?>
		<a href="#" id="<?=$row->satuan_id?>" url="<?= base_url($global->url.'detail')?>" class="detail btn btn-flat btn-xs btn-success"><span class="fa fa-eye"></span></a>
	<?php endif;?>
	<?php if($global->edit==true):?>	
		<button  url="<?= base_url($global->url.'edit')?>" onclick="modaledit(<?=$row->satuan_id?>)" class="edit btn btn-flat btn-xs btn-warning"><span class="fa fa-pencil"></span></button>
	<?php endif;?>
	<?php if($global->delete==true):?>	
		<a href="#" url="<?=base_url($global->url.'hapus/'.$row->satuan_id)?>"  id="<?=$row->satuan_id?>" class="hapus btn btn-flat btn-xs btn-danger"><span class="fa fa-trash"></span></a>
	<?php endif;?>
</div>