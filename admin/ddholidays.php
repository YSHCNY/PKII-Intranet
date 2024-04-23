<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../admin/css/Info.css">
    <title>Holidays</title>
</head>
<body>
	<div class="bg-white">
		<div class="">
			<p class="text-muted fs-4 fw-bold poppins">Holidays</p>
		</div>
		<?php
		$datenowplus1mo = date("Y-m-d", strtotime("+ 30 day", strtotime($datenow)));
		?>
		<?php
		$res012query = "SELECT tblhrtaholidays.applic_date, tblhrtaholidays.holidayname, tblhrtaholidays.holidaytype FROM tblhrtaholidays WHERE (DATE(CONCAT(YEAR(CURDATE()), RIGHT(tblhrtaholidays.applic_date, 6))) BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)) AND YEAR(tblhrtaholidays.applic_date)=YEAR(CURDATE()) ORDER BY DATE_FORMAT(tblhrtaholidays.applic_date, '%Y-%m-%d') ASC";
		$result012 = "";
		$found012 = 0;
		$ctr012 = 0;
		$result012 = $dbh2->query($res012query);
		if ($result012->num_rows > 0) {
			while ($myrow012 = $result012->fetch_assoc()) {
				$found012 = 1;
				$ctr011 = $ctr011 + 1;
				$applic_date012 = $myrow012['applic_date'];
				$holidayname012 = $myrow012['holidayname'];
				$holidaytype012 = $myrow012['holidaytype'];
				?>
				<div class="border px-3 pt-4 pb-3 rounded-4 mb-3 shadow">
				<div id="" class="text-center">
					<?php if ($holidaytype012 == "special" || $holidaytype012 == "legal"): ?>
						<?php if ($applic_date012 == $datenow): ?>
							<p class = 'fs-4 text-info fw-bold poppins'><?php echo $holidayname012; ?></p>
							<p class = 'fs-4 poppins'><?php echo date("M d, Y (D)", strtotime($applic_date012)); ?></p>
						<?php else: ?>
							<p class = 'fs-4 text-info fw-bold poppins'><?php echo $holidayname012; ?></p>
							<p class = 'fs-4 poppins'><?php echo date("M d, Y (D)", strtotime($applic_date012)); ?></p>
						<?php endif; ?>
					<?php else: ?>
						<?php if ($applic_date012 == $datenow): ?>
							<p class = 'fs-4 text-info fw-bold poppins'><?php echo $holidayname012; ?></p>
							<p class = 'fs-4 poppins'><?php echo date("M d, Y (D)", strtotime($applic_date012)); ?></p>
						<?php else: ?>
							<p class = 'fs-4 text-info fw-bold poppins'><?php echo $holidayname012; ?></p>
							<p class = 'fs-4 poppins'><?php echo date("M d, Y (D)", strtotime($applic_date012)); ?></p>
						<?php endif; ?>
					<?php endif; ?>
				</div>
				</div>
				<?php
			}
		} else {
			?>
				<div class="border rounded-4 p-5 text-center shadow">
					<p class="text-danger fs-4 fw-medium poppins m-0 py-1">No Upcoming Schedules</p>
				</div>
			<?php
		}
		?>
	</div>
</body>
</html>

