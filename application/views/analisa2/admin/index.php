<div id="allcontent">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-default box-solid  " id="formcari">
				<div class="box-header">
					<h3 class="box-title"><?= ucwords($global->headline)?></h3>
					<div class="box-tools pull-right hide" id="iconplus">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i  class="fa fa-plus"></i></button>
					</div>				
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-sm-5">
							<div class="form-group">
								<label>Pekerjaan</label>
								<select required class="select2 form-control" name="pekerjaan" id="pekerjaan" style="width:100%">
									<?php foreach($pekerjaan AS $row):?>
									<option value="<?= $row->pekerjaan_id?>"><?= ucwords($row->pekerjaan_pekerjaan)?></option>
									<?php endforeach;?>
								</select>
							</div>							
						</div>
						<div class="col-sm-2 col-md-2">
							<div class="form-group">
								<label class="hidden-xs">&nbsp</label>
								<button type="button" url="<?= base_url($global->url.'tabel')?>" class="btn btn-flat btn-block btn-primary" id="cari"><i class="fa fa-search"></i></button>
							</div>
						</div>
						<div class="col-sm-2 col-md-2">
							<div class="form-group">
								<label class="hidden-xs">&nbsp</label>
								<button type="button" url="<?= base_url($global->url.'cetak')?>" onclick="alert('cetak')" class="btn btn-flat btn-block btn-warning hide" id="cetak"><i class="fa fa-print"></i></button>
							</div>
						</div>						
					</div>
				</div>
			</div>
			<div class="box box-success ">
				<div class="box-header with-border">
					<h3 class="box-title">DAFTAR ANALISA PEKERJAAN</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div  id="view">
						<div class="row">
							<div class="col-sm-12">
								<div id="tabel" url="<?= base_url($global->url.'tabel')?>">
									<div class="text-center" style="margin-top:20px"><i class="fa fa-refresh fa-spin"></i> Silahkan PIlih Daftar Pekerjaan</div>
								</div>							
							</div>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>
<div class="modal fade modaltafsiran" id="tafsiran">
</div>
<div class="modal fade" id="analisapekerjaan">

</div>
<?php include 'action.php';?>
<script type="text/javascript">
	$(".select2").select2();
	setTimeout(function () {
		var url=$('#tabel').attr('url');
		$("#tabels").load(url);
	}, 200);
	$(document).ready(function(){
		// $('#pekerjaans').change(function(){
		// 	// var url=$(this).attr('url');
		// 	var id=$(this).val();
		// 	alert(id);
		// 	// $.ajax({
		// 	// 	type:'POST',
		// 	// 	url:url,
		// 	// 	data:{id:id},
		// 	// 	success:function(data){
		// 	// 		$("#view").html(data);       
		// 	// 	}
		// 	// })
		// 	return false;        
		// })
		$('#cari').click(function(){
			var url=$(this).attr('url');
			var id=$("#pekerjaan").val();
			//alert(id);
			$.ajax({
				type:'POST',
				url:url,
				data:{id:id},
				success:function(data){
					//alert(id);
					$("#tabel").html(data); 
					$("#cetak").removeClass('hide');      
				}
			})		
		})		 		
	})   	 
</script>