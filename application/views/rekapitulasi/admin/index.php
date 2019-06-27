<div id="view">
	<div class="row">
		<div class="col-sm-4">
			<div class="form-group">
				<label>Pekerjaan</label>
				<select class="form-control selectdata" id="daftarpekerjaan" style="width: 100%">
					<?php foreach($pekerjaan AS $row):?>
						<option value="<?= md5($row->pekerjaan_id)?>"><?= ucwords($row->pekerjaan_kegiatan)?></option>
					<?php endforeach;?>
				</select>				
			</div>
		</div>
		<div class="col-sm-2">
			<div class="form-group">
				<label>&nbsp</label>
				<button onclick="caripekerjaan();" id="btncari" url="<?= base_url($global->url.'cari')?>" class="btn btn-flat btn-block btn-primary"><span class="fa fa-search"></span> Cari</button>
			</div>
		</div>
		<!--
		<div class="col-sm-2">
			<div class="form-group">
				<label>&nbsp</label>
				<button  id="print" onclick="alert('cetak..')"url="<?= base_url($global->url.'cetak')?>" class="hidden btn btn-flat btn-block btn-warning"><span class="fa fa-print"></span> Cetak</button>
			</div>
		</div>
		-->
		<div class="col-sm-2">
			<div class="form-group">
				<label>&nbsp</label>
				<a  id="print" class="hidden btn btn-flat btn-block btn-warning" target="popup" onclick="cetak()"><span class="fa fa-print"></span> Cetak</a>
			</div>
		</div>					
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div id="tabelpencarian" url="<?= base_url($global->url.'tabel')?>">
				<div class="form-group">
					<div class="text-center"><i class="fa fa-refresh fa-spin"></i> Loading data. Please wait...</div>
				</div>
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
    function caripekerjaan(){
    	href='<?= base_url($global->url.'cetak/')?>';
    	idpekerjaan = $('#daftarpekerjaan').val();
    	url=$('#btncari').attr('url');
    	//alert(enkripsi);
    	$.ajax({
    		type:'POST',
    		url:url,
    		data:{id:idpekerjaan},
    		success:function(data){
    			$("#tabelpencarian").html(data);  
    			$("#print").removeClass('hidden'); 
    			$("#print").attr("url", href+idpekerjaan+'.html'); 
    			// alert(url);     
    		}
    	})
    	return false;     	
    } 
    function cetak(){
    	url=$('#print').attr('url');
		window.open(url,'name','width=800,height=600')    	
    }
 
   
</script>