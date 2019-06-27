<?php 
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    header ("Content-type: application/vnd-ms-excel");
    header ("Content-Disposition: attachment; filename=".$nama_file.".xls");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<table border="1" width="100%">
	<thead>
		<tr>
			<th colspan="16" style="font-size:24px" align="left"><?= ucwords($headline)?></th>
		</tr>
		<tr>
		 	<th>Nama</th>
		 	<th>NIM</th>
		 	<th>Jurusan/Program Studi/Fakultas</th>
		 	<th>Tempat/Tanggal Lahir</th>
			<th>Agama</th>
			<th>Tahun Masuk/Tahun lulus</th>	 
			<th>Judul Skripsi/Tugas Akhir</th>
			<th>Alamat Jogja</th>
			<th>Dosen Pembimbing 1</th>
			<th>Dosen Pembimbing 2</th>
			<th>Nama Orang Tua/Wali</th>
			<th>Alamat Asal</th>
			<th>Alamat Email</th>
			<th>No. Telp</th>
			<th>Sudah bekerja di</th>
			<th>Alamat Kantor</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data AS $row){?>
			<tr>
				<td><?php echo  ucwords($row->formulir_nama)?></td>
				<td><?php echo  $row->formulir_nim?></td>
				<td><?php echo  ucwords($row->formulir_jurusan)?></td>
				<td><?php echo  ucwords($row->formulir_tempatlahir).'/'.date('d-m-Y',strtotime($row->formulir_tgllahir))?></td>
				<td><?php echo  ucwords($row->formulir_agama)?></td>
				<td><?php echo  $row->formulir_tahunmasuk.'/'.$row->formulir_tahunlulus?></td>
				<td><?php echo  ucwords($row->formulir_judulskripsi)?></td>
				<td><?php echo  ucwords($row->formulir_alamatyogya)?></td>
				<td><?php echo  ucwords($row->formulir_dosbim1)?></td>
				<td><?php echo  ucwords($row->formulir_dosbim2)?></td>
				<td><?php echo  ucwords($row->formulir_namaorangtua)?></td>
				<td><?php echo  ucwords($row->formulir_alamatasal)?></td>
				<td><?php echo  $row->formulir_email?></td>
				<td><?php echo  $row->formulir_notelp?></td>
				<td><?php echo  ucwords($row->formulir_perusahaan)?></td>
				<td><?php echo  ucwords($row->formulir_alamatkantor)?></td>
			</tr>
		<?php };?>
	</tbody>
</table>
</body>
</html>