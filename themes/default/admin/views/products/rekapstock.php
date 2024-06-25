<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<table width="100%" rules="all" border="1">
		<thead>
			<tr>
				<th width="25">No</th>
				<th width="150">Kode Barang</th>
				<th>Nama Barang</th>
				<th>Uk</th>
				<?php 
					foreach ($warehouse as $wh) {
						echo "<th>$wh->code</th>";
					}
				?>
			</tr>
		</thead>
		<tbody>
			<?php 
				$no=1;
				foreach ($rows as $r) {
					echo "<tr>
						<td>$no</td>
						<td align='center'>$r->product_code</td>
						<td>$r->product_name</td>
						<td align='center'>$r->product_size</td>";
					foreach($warehouse as $wh){
						$whHead = $wh->code;
						$whValue = $r->$whHead;
						echo "<td align='right'>".numIndo($whValue)."</td>";
					}
					$no++;
				}
			?>
		</tbody>
	</table>
</body>
</html>