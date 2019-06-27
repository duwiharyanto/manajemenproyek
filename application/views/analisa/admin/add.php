<form method="POST" action="<?= base_url($global->url)?>" enctype="multipart/form-data">
	<div class="box box-primary animated bounceInRight">
		<div class="box-header with-border">
			<h3 class="box-title"><?= ucwords($global->headline)?></h3>
		</div>
		<div class="box-body">
			<div class="form-group">
				<label>Id</label>
				<input type="text" class="form-control" readonly="readonly" value="Auto Generated" />
			</div>
			<div class="form-group">
				<label>Pekerjaan</label>
				<select class="form-control selectdata" style="width:100%" name="analisis_pekerjaanid">
				</select>
			</div>	
			<div class="tampil_analisis">
				
			</div>	
			<div class="analisis">				
			<div class="box box-default box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Rincian</h3>
					<div class="box-tools pull-right">
						<div class="btn-group">
						<button type="button" class="btn btn-xs btn-danger btn-flat remove_analisis" style="color:white">Remove <i class="fa  fa-remove"></i></button>
						<button type="button" class="btn btn-xs btn-flat btn-primary add_analisis" style="color:white">Tambah <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>
				<div class="box-body">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-2">
								<label>Kode</label>
								<input required type="text" name="analisa_kode" class="text-capitalize form-control" ></input>						
							</div>
							<div class="col-sm-10">
								<label>Kegiatan</label>
								<input required type="text" class="form-control"  name="analisa_kegiatan" />						
							</div>
						</div>
					</div>
					<div style="background-color:#D2D6DE;padding:10px;margin-bottom:10px">	
						<div class="form-group">
							<div class="row">	
								<div class="col-sm-offset-10 col-sm-2">
									<div class="btn-group  pull-right">
									<button type="button" class="hide btn btn-xs btn-danger btn-flat" id="remove_satuan">Remove <i class="fa  fa-remove"></i></button>
									<button type="button" class="btn btn-xs btn-primary btn-flat" id="add_satuan">Tambah <i class="fa fa-plus"></i></button>
									</div>
								</div>															
							</div>
						</div>
						<div class="satuan">

						</div>	
						<div class="form-group">
							<div class="row" style="padding-top:10px">
								<div class="col-sm-2">
									<label>Satuan</label>
									<select class="form-control select2" style="width:100%" name="analisis_pekerjaanid">
										<option>Heloo</option>
									</select>									
								</div>
								<div class="col-sm-2">
									<label>Koefisien</label>
									<input required type="text" class="form-control" name="koefisien[]">
								</div>
								<div class="col-sm-3">
									<label>Harga Satuan</label>
									<input type="text" class="form-control">
								</div>	
								<div class="col-sm-5">
									<label>Jumlah</label>
									<input type="text" class="form-control text-left">
								</div>															
							</div>
						</div>											
						<div class="pre hide">								
							<div class="form-group">
								<div class="row" style="padding-top:10px">
									<div class="col-sm-2">
										<label>Satuan</label>
										<select class="form-control select2" style="width:100%" name="analisis_pekerjaanid">
											<option>Heloo</option>
										</select>									
									</div>
									<div class="col-sm-2">
										<label>Koefisien</label>
										<input required type="text" class="form-control" name="koefisien[]">
									</div>
									<div class="col-sm-3">
										<label>Harga Satuan</label>
										<input type="text" class="form-control">
									</div>	
									<div class="col-sm-4">
										<label>Jumlah</label>
										<input type="text" class="form-control text-left">
									</div>
									<div class="col-sm-1">
										<label>&nbsp</label>
										<button type="button" class="btn btn-danger btn-flat remove_satuan btn-block"><i class="fa  fa-remove"></i></button>
									</div>															
								</div>
							</div>
						</div>												
					</div>						
					<div class="form-group">
						<div class="row">
							<div class="col-sm-offset-7 col-sm-5">
								<label>Jumlah Harga</label>	<br>
								<input required type="text" class="form-control"  name="analisa_harga" />
								<label>Overhead & Profit 15%</label><br>	
								<input required type="text" class="form-control" name="analisa_overhead" />	
								<label>Harga Satuan Pekerjaan</label>
								<input required type="text" class="form-control" name="analisa_overhead" />																										
							</div>
						</div>												
					</div>
				</div>
			</div>	
			</div>								
			<div class="form-group">
				<button type="submit" name="submit" value="submit" class="btn btn-flat btn-block btn-primary">Simpan</button>
			</div>										
		</div>		
	</div>			
</form>
<script type="text/javascript">
	$(document).ready(function() {
		$(".select2").select2();
		$("#add_satuan").click(function() {
			$(".select2").select2().select2('destroy');
			pre=$(".pre").html();
			$(".satuan").prepend(pre);
			$(".select2").select2();
			//$('.btn').removeClass('hide');
			//alert(pre);
		})
		$("body").on("click",".remove_satuan",function(){ 
			$(this).parents(".form-group").remove();
		});
		i=1;
		$(".add_analisis").click(function() {
			$(".select2").select2().select2('destroy');
			pre=$(".analisis").html();
			$(".tampil_analisis").prepend(pre);
			$(".select2").select2();
			$
			i++;
			//$('.btn').removeClass('hide');
			//alert(pre);
		})		
	});	
</script>
<?php
include 'action.php';
?>