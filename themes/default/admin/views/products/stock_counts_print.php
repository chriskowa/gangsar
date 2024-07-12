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
		<td>Rekap Stock Barang : <?= dateToIndo(date("Y-m-d H:i"), true, true) ?></td>
	</tr>
	<tr>
		<td>Periode : <?= date("Y") ?></td>
	</tr>
</table>
<table width="100%" rules="all" border="1">
	<thead>
		<tr>
			<th width="150">Kode Barang</th>
			<th>Nama Barang</th>
			<th width="100">UK</th>
			<th>UTAMA</th>
			<th>KCF</th>
			<th>RUSAK</th>
			<th width="100">TOTAL</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$products = $this->db->get('products')->result();
			
			$sql = "SELECT product_id, sum(quantity) quantity FROM `sma_warehouses_products` WHERE warehouse_id = 5 GROUP BY product_id";
			$rs = $this->db->query($sql)->result();

			$utama = [];
			foreach ($rs as $r) {
				$utama[$r->product_id] = $r->quantity;
			}

			$sql = "SELECT product_id, sum(quantity) quantity FROM `sma_warehouses_products` WHERE warehouse_id = 7 GROUP BY product_id";
			$rs = $this->db->query($sql)->result();

			$kfc = [];
			foreach ($rs as $r) {
				$kfc[$r->product_id] = $r->quantity;
			}

			$sql = "SELECT product_id, sum(quantity) quantity FROM `sma_warehouses_products` WHERE warehouse_id = 6 GROUP BY product_id";
			$rs = $this->db->query($sql)->result();

			$rusak = [];
			foreach ($rs as $r) {
				$rusak[$r->product_id] = $r->quantity;
			}

			$no=1;
			foreach($products as $r){
				$qtyUtama = isset($utama[$r->id]) ? numIndo($utama[$r->id],0) : 0;
				$qtyKfc = isset($kfc[$r->id]) ? numIndo($kfc[$r->id],0) : 0;
				$qtyRusak = isset($rusak[$r->id]) ? numIndo($kfc[$r->id],0) : 0;

				$totalRight = $qtyUtama + $qtyKfc + $qtyRusak;
				$totalRight = numIndo($totalRight,0);
				echo "<tr>
					<td>$r->code</td>
					<td>$r->name</td>
					<td align='center'>$r->size</td>
					<td align='center'>$qtyUtama</td>
					<td align='center'>$qtyKfc</td>
					<td align='center'>$qtyRusak</td>
					<td align='center'>$totalRight</td>
				</tr>";
				$no++;
			}
		?>
	</tbody>
</table>
</body>
</html>