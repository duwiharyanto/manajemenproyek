<div class="btn-group">
	<a href="javascript:void(0)" id=""  onclick="detailanalisapekerjaan(<?=$row->analisapekerjaan_id?>)" url="<?= base_url($global->url.'detailanalisapekerjaan')?>" class="detailanalisapekerjaan btn btn-flat btn-xs btn-success"><span class="fa fa-eye"></span></a>		
	<?php if($global->detail==true):?>
		<a href="javascript:void(0)" id="<?=$row->analisapekerjaan_id?>" url="<?= base_url($global->url.'detail')?>" class="detail btn btn-flat btn-xs btn-success"><span class="fa fa-eye"></span></a>
	<?php endif;?>
	<?php if($global->edit==true):?>	
		<button   id="<?=$row->analisapekerjaan_id?>" url="<?= base_url($global->url.'edit')?>" class="edit btn btn-flat btn-xs btn-warning"><span class="fa fa-pencil"></span></button>
	<?php endif;?>
	<?php if($global->delete==true):?>	
		<a href="javascript:void(0)" url="<?=base_url($global->url.'hapusanalisa')?>"  id="<?= $row->analisapekerjaan_id?>" idpekerjaan='<?= $row->analisapekerjaan_idpekerjaan?>' class="hapus_ btn btn-flat btn-xs btn-danger"><span class="fa fa-trash"></span></a>
	<?php endif;?>
</div>