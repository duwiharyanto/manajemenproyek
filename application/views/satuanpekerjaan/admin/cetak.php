<!DOCTYPE >
<html>
<head>
	<title><?=strtoupper($global->headline)?></title>
</head>
<style type="text/css">
	#table th,#table td {
	  border: 1px solid black;
	  padding: 5px;
	}
	#table2 th,#table2 td {
	  border: 1px solid black;
	  padding: 5px;
	}		
</style>
<body>
<div class="row">
	<div class="col-sm-12">
		<div class="box box-success box-solid">

			<div class="box-body">
				<table class="table table-striped" width="100%" >
					<tr >
						<td  style="padding-bottom: 30px" colspan="2" align="center"><h3 class="box-title pull-right" ><?=strtoupper($global->headline)?></h3></td>
					</tr>
					<tr>
						<th width="20%" align="left">Nama Pekerjaan</th>
						<td width="80%" ><?= ucwords($pekerjaan->pekerjaan_kegiatan)?></td>
					</tr>
					<tr>
						<th align="left">Tahun Anggaran</th>
						<td><?= $pekerjaan->pekerjaan_tahunanggaran?></td>
					</tr>
					<tr>
						<th align="left">Lokasi</th>
						<td><?= ucwords($pekerjaan->pekerjaan_lokasi)?></td>
					</tr>						
				</table>
				<hr>
				<table class="table table-striped" width="100%">
					<tr>
						<th width="20%" align="left">Kode</th>
						<td width="80%">TS002 </td>
					</tr>
					<tr>
						<th align="left">Nama Pekerjaan</th>
						<td >Test 2 </td>
					</tr>						
					<tr>
						<th align="left">Overhead</th>
						<td>15</td>
					</tr>
					<tr>
						<td colspan="2">
							<table id="table" class="table table-bordered" width="100%" cellpadding="0" cellspacing="0">
								<tr style="background-color: grey;">
									<th width="5%">No</th>
									<th width="15%">Kode</th>
									<th width="30%">Satuan</th>
									<th width="25%">Uraian</th>
									<th width="25%">Nominal</th>
								</tr>
								<?php if($data):?>
									<?php $i=1;foreach($data AS $row):?>
										<tr>
											<td><?= $i?></td>
											<td><?= $row->analisapekerjaan_kode?></td>
											<td><?= $row->satuan_kode?></td>
											<td><?= $row->hargasatuan_uraian?></td>
											<td><?= $row->hargasatuan_hargasatuan?></td>
										</tr>
									<?php $i++;endforeach;?>									
								<?php else:?>
									<tr>
										<td colspan="5" align="center">Data tidak ditemukan</td>
									</tr>
								<?php endif;?>
							</table>								
						</td>
					</tr>
					<tr>
						<td colspan="2" style="height: 40px"></td>
					</tr>
					<tr>
						<td colspan="2">
							<table id="table3" style="padding: 10px" align="right">
								<tr>
									<td align="center"><?= ucwords($config['tempat']).', '.date('d-m-Y')?><br>dibuat oleh<br><br><br>
										<br><br>
									<b><?= ucwords($config['ttd'])?></b><br>
									<i>Direktur</i>
									</td>
								</tr>
							</table>
						</td>
					</tr>						
				</table>					
			</div>
		</div>
	</div>
</div>
</body>
</html>