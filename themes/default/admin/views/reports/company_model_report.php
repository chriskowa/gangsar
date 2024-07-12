<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Company Model Report</title>
	<style type="text/css">
		body{
			margin: auto;
			width: 780px;
		}
	</style>
</head>
<body>
	<?php

		$months = get_bulan_all();

		$year = date("Y");
		$sql = "SELECT yearmonth, sum(terbayar) terbayar
		from
		(SELECT DATE_FORMAT(`date`,'%Y-%m') yearmonth, SUM(`paid`) terbayar 
		FROM `sma_purchases` 
		WHERE DATE_FORMAT(`date`,'%Y') = $year
		AND `payment_status` = 'paid'
		GROUP BY DATE_FORMAT(`date`,'%Y-%m')
		union
		SELECT DATE_FORMAT(`date`,'%Y-%m') yearmonth, SUM(`amount`) terbayar 
		FROM `sma_expenses` 
		WHERE DATE_FORMAT(`date`,'%Y') = $year
		GROUP BY DATE_FORMAT(`date`,'%Y-%m')) a
		GROUP BY yearmonth";

		$rs = $this->db->query($sql);

		$yearMonthDataPurhcase = [];
		foreach ($rs->result() as $r) {
			$yearMonthDataPurhcase[$r->yearmonth] = $r->terbayar;
		}

		$sql = "SELECT DATE_FORMAT(`date`,'%Y-%m') yearmonth, SUM(`grand_total`) terbayar  from sma_sales
		WHERE payment_status = 'paid'
		and DATE_FORMAT(`date`,'%Y') = $year
		GROUP BY DATE_FORMAT(`date`,'%Y-%m')";

		$rs = $this->db->query($sql);

		$yearMonthDataSales = [];
		foreach ($rs->result() as $r) {
			$yearMonthDataSales[$r->yearmonth] = $r->terbayar;
		}

		$saldoAwal = $this->db->where(['tahun'=>$year])->get('saldo_awal')->row();
	?>
	<p>
		<center><h2>REKAP <?= date("Y") ?></h2></center>
	</p>
	<table rules="all" border="1" width="100%" cellpadding="2" cellspacing="2">
		<tr bgcolor="#ccceee">
			<th>BULAN</th>
			<th width="200">DEBET</th>
			<th width="200">KREDIT</th>
			<th>SALDO</th>
		</tr>
		<tr>
			<td>Saldo Awal</td>
			<td colspan="3" align="right"><?= numIndo($saldoAwal->amount,0) ?></td>
		</tr>
		<?php
			$sa = $saldoAwal->amount;
			$totalPurchase = $totalSales = 0;
			foreach ($months as $key => $value) {
				$purchase = @$yearMonthDataPurhcase[$year.'-'.$key];
				$purchaseTerbayar = numIndo($purchase,0);
				$totalPurchase += $purchase;

				$sales = @$yearMonthDataSales[$year.'-'.$key];
				$salesTerbayar = numIndo($sales,0);
				$totalSales += $sales;

				$saldo = (@$sales - @$purchase) + $sa;

				echo "<tr><td>$value</td><td align='right'>$salesTerbayar</td><td align='right'>$purchaseTerbayar</td><td align='right'>".numIndo($saldo,0)."</td></tr>";

				$sa = $saldo;
			}
		?>
		<tfoot>
			<tr>
				<th>TOTAL</th>
				<th align="right"><?= numIndo($totalSales,0) ?></th>
				<th align="right"><?= numIndo($totalPurchase,0) ?></th>
				<th align="right"><?= numIndo($sa,0) ?></th>
			</tr>
		</tfoot>
	</table>
</body>
</html>