<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Monthly result</title>
	<style type="text/css">
		body{
			width: 780px;
			margin: auto;
		}
	</style>
</head>
<body>
	<?php
	$start_date = $this->input->get('start_date');
	$end_date = $this->input->get('end_date');
	$model = $this->input->get('model');
	?>
	<table width="100%">
		<tr>
			<td width="100">Start Date</td>
			<td width="15">:</td>
			<td><?= dateToIndo($start_date) ?></td>
		</tr>
		<tr>
			<td>End Date</td>
			<td>:</td>
			<td><?= dateToIndo($end_date) ?></td>
		</tr>
		<tr>
			<td>Payment Status</td>
			<td>:</td>
			<td><?= $model ?></td>
		</tr>
	</table>
	<?php 
		$sql = "SELECT * from sma_sales where `date` between ? and ? and payment_status = ? ";
		$rs = $this->db->query($sql, [$start_date, $end_date, $model])->result();
		echo $this->db->last_query();
	?>
	<table width="100%" rules="all" border="1">
		<tr>
			<th width="25">No</th>
			<th>Date</th>
			<th>reference no</th>
			<th>Customer</th>
			<th>Total</th>
		</tr>
		<?php 
			$no=1;
			foreach ($rs as $r) {
				echo "<tr>
				<td>$no</td>
				<td>".dateToIndo($r->date)."</td>
				<td>$r->reference_no</td>
				<td>$r->customer</td>
				<td align='right'>".numIndo($r->total)."</td>
				</tr>";
				$no++;
			}
		?>
	</table>
</body>
</html>