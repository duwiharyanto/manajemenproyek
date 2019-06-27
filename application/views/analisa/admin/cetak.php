<table width="100%">
	<tr>
		<td colspan="2" align="center">
			<h2 >FORMULIR PENDAFTARAN WISUDA</h2><br><br>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="left">
			<p >
			Kepada Yth :<br>
			Ketua Panitia Wisuda<br>
			Institut Sains & Teknologi AKPRIND Yogyakarta
			<br><br>
			Dengan hormat,<br>
			Bersama ini kami mohon didaftar sebagai peserta wisuda Institut Sains & Teknologi AKPRIND Yogyakarta
			</p>			
		</td>
	</tr>
	<tr>
		<td width="35%">Nama</td>
		<td width="65%">: <?= ucwords($formulir_nama)?></td>
	</tr>
	<tr>
		<td>Nomor Mahasiswa</td>
		<td>: <?= $formulir_nim?></td>
	</tr>
	<tr>
		<td>Jurusan/Fakultas</td>
		<td>: <?= $formulir_jurusan?></td>
	</tr>	
	<tr>
		<td>Tempat/Tanggal Lahir</td>
		<td>: <?= ucwords($formulir_tempatlahir).', '.date('d-m-Y',strtotime($formulir_tgllahir))?></td>
	</tr>
	<tr>
		<td>Agama</td>
		<td>: <?= $formulir_agama?></td>
	</tr>
	<tr>
		<td>Tahun Masuk/Lulus</td>
		<td>
			<table width="100%" cellspacing="0px" cellpadding="0">
				<tr>
					<td width="20%">
					: <?= $formulir_tahunmasuk.'/'.$formulir_tahunlulus?>
					</td>
					<td width="10%">IPK</td>
					<td width="70%">
						: <?= $formulir_ipk?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>Judul Skripsi/TA</td>
		<td>: <?= ucwords($formulir_judulskripsi)?></td>
	</tr>			
	<tr>
		<td>Dosen Pembimbing I</td>
		<td>: <?= $formulir_dosbim1 ?></td>
	</tr>
	<tr>
		<td>Dosen Pembimbing II</td>
		<td>: <?= $formulir_dosbim2 ?></td>
	</tr>		
	<tr>
		<td>Nama Orang Tua/Wali</td>
		<td>: <?= ucwords($formulir_namaorangtua)?></td>
	</tr>
	<tr>
		<td>Alamat di Yogyakarta</td>
		<td>: <?= ucwords($formulir_alamatyogya)?></td>
	</tr>
	<tr>
		<td>Alamat Asal</td>
		<td>: <?= ucwords($formulir_alamatasal)?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td>: <?= ucwords($formulir_email)?></td>
	</tr>
	<tr>
		<td>No. Telp</td>
		<td>: <?= ucwords($formulir_notelp)?></td>
	</tr>
	<tr>
		<td>Apabila Sudah Bekerja, Kerja di</td>
		<td>: <?= ucwords($formulir_perusahaan)?></td>
	</tr>
	<tr>
		<td>Alamat Tempat Kerja</td>
		<td>: <?= ucwords($formulir_alamatkantor)?></td>
	</tr>
	<tr>
		<td colspan="2">
			<table width="100%" ellspacing="0px" cellpadding="0">
				<tr>
					<td width="70%">
						Mengetahui :<br>
						Ketua/Sekretaris Jurusan
						<br><br><br><br><br><br>
						________________________
					</td>
					<td width="30%" >
						Yogyakarta, <?=date('d-m-Y')?><br>
						Pemohon,
						<br><br><br><br><br><br>
						________________________			
					</td>					
				</tr>			
			</table>			
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<b>Berkas Pendukung :</b><br>
			<ul>
				<li><?= !empty($formulir_foto)? 'Foto sudah diupload':'Foto belum diupload'?></li>
				<li><?= !empty($formulir_buktibayar)? 'Kwitansi pembayaran sudah diupload':'Kwitansi pembayaran belum diupload'?></li>
			</ul>
		</td>
	</tr>
	<tr>
		<td colspan="2" >
			<b >Lampiran Foto :</b><br>
			<img  src="<?= base_url('upload/foto/'.$formulir_foto)?>" width="160px" height="160px">
		</td>
	</tr>												
</table>