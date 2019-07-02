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
				<br>
				<table id="table" class="table table-striped" width="100%" cellpadding="0" cellspacing="0">
					<thead>
						<tr class="bg-blue">
							<td width="5%">No</td>
							<td width="10%">Kode</td>
							<td width="55%">Uraian Pekerjaan</td>
							<td width="10%">Satuan</td>
							<td width="20%">Harga Satuan</td>
						</tr>
					</thead>
					<tbody>
						<?php if($data):?>
							<?php $i=1;$grandtotal=0;foreach($data AS $row):?>
							<tr>
								<td><?=$i?></td>
								<td><?=$row->analisapekerjaan_kode?></td>
								<td><?=$row->analisapekerjaan_kegiatan?></td>
								<td><?=$row->satuan_satuan?></td>
								<td class="price"><?=duit($row->hargasatuan)?></td>
							</tr>
							<?php $grandtotal+=$row->hargasatuan;?>								
							<?php $i++;endforeach;?>
							<tr>
								<td colspan="4" align="right">Total</td>
								<td class="bg-red"><?=duit($grandtotal);?></td>
							</tr>							
						<?php else:?>
							<tr>
								<td colspan="5">Data tidak ditemukan</td>
							</tr>
						<?php endif;?>
					</tbody>		
				</table>
	            <table id="table3" style="padding: 10px" align="right">
	                <tr>
	                    <td align="center"><?= ucwords($config['tempat']).', '.date('d-m-Y')?><br>dibuat oleh<br>
							<?= strtoupper($config['cv'])?>
	                    	<br><br>
	                        <br><br>
	                        <b><?= ucwords($config['ttd'])?></b><br>
	                        <i>Direktur</i>
	                    </td>
	                </tr>
	            </table> 									
			</div>
		</div>
	</div>
</div>
</body>
</html>