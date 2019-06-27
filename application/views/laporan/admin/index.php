<div id="view">
	<form action="<?= base_url($global->url.'exportexcel')?>" method="POST">
	<div class="row">
		<div class="col-sm-2">
			<div class="form-group">
				<label>Tahun Akademik</label>
				<select class="form-control selectdata" style="width:100%" name="thakademik">
					<?php foreach($thakademik AS $row):?>
						<option value="<?=$row->thakademik_kode?>"><?= $row->thakademik_kode?></option>
					<?php endforeach;?>
				</select>
			</div>
		</div>		
		<div class="col-sm-2">
			<div class="form-group">
				<label>&nbsp</label>
				<button type="button" onclick="cari();" class="btn btn-flat btn-block btn-primary"><span class="fa fa-search"></span> Cari</button>
			</div>
		</div>
		<div class="col-sm-2">
			<div class="form-group">
				<label>&nbsp</label>
				<button id="export" type='button' class="btn btn-flat btn-block btn-warning disabled"><span class="fa fa-print"></span> Cetak</button>
			</div>
		</div>		
	</div>
	<form>
	<div class="row">
		<div class="col-sm-12">
			<div id="pencarian" url="<?= base_url($global->url.'tabel')?>">
				<div class="text-center"><i class="fa fa-refresh fa-spin"></i> Loading data. Please wait...</div>
			</div>
		</div>		
	</div>
</div>
<?php include 'action.js';?>
<script type="text/javascript">
	    setTimeout(function () {
        var url=$('#tabel').attr('url');
        $("#tabel").load(url);
        //alert(url);
    }, 200); 
</script>