<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rekap Stock Barang</title>
</head>
<body>
<table width="100%">
	<tr>
		<td>Rekap Stock Barang : </td>
	</tr>
	<tr>
		<td>Periode : <?= date("Y") ?></td>
	</tr>
</table>
<table width="100%" rules="all" border="1">
	<thead>
		<tr>
			<th rowspan="2" width="150">Kode Barang</th>
			<th rowspan="2">Nama Barang</th>
			<th rowspan="2" width="100">UK</th>
			<th colspan="2">UTAMA</th>
			<th colspan="2">KCF</th>
			<th rowspan="2" width="100">TOTAL</th>
		</tr>
		<tr>
			<th width="100">OK</th>
			<th width="100">Rusak</th>
			<th width="100">OK</th>
			<th width="100">Rusak</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$products = $this->db->get('products')->result();
			$no=1;
			foreach($products as $r){
				echo "<tr>
					<td>$r->code</td>
					<td>$r->name</td>
					<td align='center'>$r->size</td>
				</tr>";
				$no++;
			}
		?>
	</tbody>
</table>
</body>
</html>