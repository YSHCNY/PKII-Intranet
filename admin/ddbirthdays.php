<?php
	include ("addons.php");
	$currentMonth = date('F');
	$birthmonth = $currentMonth;	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link rel="stylesheet" href="../admin/css/Info.css"> -->
	<title>Birthdays</title>
</head>
<body>
	<div class="bg-white">
		<div class="">
			<p class="text-muted fs-4 poppins"><span class = 'fw-bold'><?php echo"$birthmonth"; ?></span> Birthday Celebrants</p>
		</div>
		<?php
		$datenowplus1mo = date("Y-m-d", strtotime("+30 day", strtotime($datenow)));
		$res011query = "SELECT tblemployee.emp_birthdate, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblemployee LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE (DATE(CONCAT(YEAR(CURDATE()), RIGHT(tblemployee.emp_birthdate, 6))) BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)) AND tblemployee.emp_record='active' AND tblemployee.employee_type='employee' ORDER BY DATE_FORMAT(tblemployee.emp_birthdate, '%m-%d') LIMIT 7";
		$result011 = "";
		$found011 = 0;
		$ctr011 = 0;
		$result011 = $dbh2->query($res011query);
		if ($result011->num_rows > 0) {
			while ($myrow011 = $result011->fetch_assoc()) {
				$found011 = 1;
				$ctr011 = $ctr011 + 1;
				$birthdate011 = $myrow011['emp_birthdate'];
				$employeeid011 = $myrow011['employeeid'];
				$name_last011 = $myrow011['name_last'];
				$name_first011 = $myrow011['name_first'];
				if ($birthdate011 == $datenow) {
					?>
					<div class = 'bg-danger'>
						<p class = 'text-white fs-4 shadow poppins'><?php echo "$name_first011 $name_last011 - " . date("M-d", strtotime($birthdate011)); ?></p>
					</div>
					<?php
				} else {
					?>
					<div>
						<div  class="border px-3 pt-4 pb-3 rounded-4 mb-3 shadow">
							<div class="text-center">
								<p class = 'fs-4 text-primary fw-bold poppins'><?php echo "$name_first011 $name_last011"; ?></p>
								<p class = 'fs-4 poppins'><?php echo date("D M-d", strtotime($birthdate011)); ?></p>
							</div>
						</div>
					</div>
					<?php
				}
			}
		} else {
			?>
			<div id="content" class="d-flex justify-content-center align-items-center shadow">
				<p class="text-danger fs-4 fw-medium poppins m-0 py-1">No Upcoming Birthdays</p>
			</div>
			<?php
		}
		?>
	</div>
</body>
</html>
