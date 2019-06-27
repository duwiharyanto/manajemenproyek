<!DOCTYPE>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
	#table th,#table td {
	  border: 1px solid black;
	  padding: 5px;
	}	
</style>
<body>
<div class="row">
	<div class="col-sm-12">
		<div class="box box-primary box-solid">
			<div class="box-body">
				<table class="table table-striped" width="100%" >
					<tr>
						<td colspan="2" align="center" style="padding: 10px"><h3 class="box-title "><?= strtoupper($global->headline)?></h3></td>
					</tr>
					<tr>
						<th width="20%" align="left">Nama Pekerjaan</th>
						<td width="80%"><?= ucwords($pekerjaan->pekerjaan_kegiatan)?></td>
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
				<table  class="table table-striped" width="100%" >
					<tr>
						<td colspan="2">
							<table id="table" class="table table-striped" width="100%" cellspacing="0" cellpadding="0">
								<tr style="background-color: gray">
									<td width="5%">No</td>
									<td width="80%">Uraian Pekerjaan</td>
									<td width="15%">Jumlah</td>
								</tr>
								<?php $i=1;$jumlah=0;foreach($rekapitulasi AS $row):?>
									<tr>
										<td><?= $i?></td>
										<td><?= ucwords($row['pekerjaan'])?></td>
										<td align="right"><?=  "Rp " . number_format($row['jumlah'],0,',','.')?></td>
									</tr>
									<?php
										$jumlah+=$row['jumlah'];
									?>
								<?php $i++;endforeach;?>
								<tr >
									<td  colspan="2" align="right">Jumlah</td>
									<td align="right"><?=  "Rp " . number_format($jumlah,0,',','.');?></td>
								</tr>
								<tr >
									<td  colspan="2" align="right">PPN 10%</td>
									<td align="right"><?php
									 	$ppn=$jumlah * 0.1;
									 	echo  "Rp " . number_format($ppn,0,',','.');
									 	?></td>
								</tr>	
								<tr>
									<td  colspan="2" align="right">Gran Total</td>
									<td align="right"><?php
									 	$grandtotal=$jumlah - $ppn;
									 	echo "Rp " . number_format($grandtotal,0,',','.');
									 	?></td>
							</tr>	
							<tr>
								<td colspan="2" align="right">Pembulatan</td>
								<td align="right"><?php
								 	
								 	echo "Rp " . number_format($grandtotal,0,',','.') ;
								 	?></td>
							</tr>																											
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