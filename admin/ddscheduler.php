<?php
    include ("addons.php");

    $datenowplus1mo = date("Y-m-d", strtotime("+ 30 day", strtotime($datenow)));
    $datenowplus2mo = date("Y-m-d", strtotime("+ 60 day", strtotime($datenow)));

    $res014query="SELECT empdepartment FROM tblempdetails WHERE employeeid=\"$employeeid0\"";

    $result014=""; $found014=0; $ctr014=0;
    $result014 = $dbh2->query($res014query);
    if($result014->num_rows>0) {
        while($myrow014 = $result014->fetch_assoc()) {
        $found014 = 1;
        $department014 = $myrow014['empdepartment'];
        }
    }
?>
	<div class="bg-white">
		<div  class="">
			<p class="text-muted fs-4 poppins"><?php echo "<span class = 'fw-bold'>$department014</span>"; ?> Schedules</p>
		</div>
		<?php
			$res012query = "SELECT idtblscheduler, loginid, lastupdate, schedname, datefrom, dateto, details, recurring, deptcd, notifysw, notifywhen, notifywho, displaywhere FROM tblscheduler WHERE ((datefrom >= \"$datenow\" AND dateto <= \"$datenowplus2mo\") OR (DATE_FORMAT(datefrom, '%y-%m-%d') >= DATE_FORMAT('$datenow', '%m-%d') AND DATE_FORMAT(datefrom, '%m-%d') <= DATE_FORMAT('$datenowplus2mo', '%m-%d') AND recurring=1)) AND deptcd LIKE \"%$department014%\" ORDER BY DATE_FORMAT(datefrom, '%m-%d') ASC LIMIT 10";
			$result012 = ""; $found012 = 0; $ctr012 = 0;
			$result012 = $dbh2->query($res012query);
			if ($result012->num_rows > 0) {
				while ($myrow012 = $result012->fetch_assoc()) {
					$found012 = 1;
					$ctr012 = $ctr012 + 1;
					$idtblscheduler012 = $myrow012['idtblscheduler'];
					$schedname012 = $myrow012['schedname'];
					$datefrom012 = $myrow012['datefrom'];
					$dateto012 = $myrow012['dateto'];
					$details012 = $myrow012['details'];
					$recurring012 = $myrow012['recurring'];
					$deptcd012 = $myrow012['deptcd'];
					$notifysw012 = $myrow012['notifysw'];
					$notifywhen012 = $myrow012['notifywhen'];
					$notifywho012 = $myrow012['notifywho'];
					$displaywhere012 = $myrow012['displaywhere'];
					$status012 = $myrow012['status'];
					?>
					<div class="border px-3 pt-4 pb-3 rounded-4 mb-3">
						<div id="" class="text-center">
							<?php
							if ($datefrom012 == $dateto012) {
								echo "<p class = 'fw-bold fs-4 poppins'>" . date("M d, Y (D)", strtotime($datefrom012)) . "</p>";
							} else {
								echo "<p class = 'fw-bold fs-4 poppins'>" . date("M d, Y (D)", strtotime($datefrom012)) . " " . date("D Y-M-d", strtotime($dateto012)) . "</p>";
							}
								echo "<p class = 'fw-bold fs-4 poppins'>$schedname012</p>";
							?>
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

