<style type="text/css">
	.tabelborder {
		border:1px solid  black;
		border-collapse: collapse;
		height:30px;
	}
</style>
<table width="100%" style="border:2px solid  black;border-collapse: collapse;">
	<tr>
		<td align="center" width="100%" style="height:50px;vertical-align: middle; padding:10px">
			<h2>Username</h2>		
		</td>
	</tr>
	<tr>
		<td style="padding:10px">
			<p>Gunakan untuk melakukan login di dev.akprind.ac.id, 
			Informasi wisuda dapat download di menu panduan.
			</p>
		</td>
	</tr>
	<tr>
		<td style="padding:10px">
			<table  width="100%" class="tabelborder">
				<tr >
					<th align="center" class="tabelborder">Username</th>
					<th align="center" class="tabelborder">Password</th>
				</tr>
				<tr>
					<td align="center" class="tabelborder"><?= $user_nim?></td>
					<td align="center" class="tabelborder"><?= $user_password?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="left" style="padding:10px">
			<i>Dicetak pada : <?= date('d-m-Y')?></i>
		</td>
	</tr>
</table>