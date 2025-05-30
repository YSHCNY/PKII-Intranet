<?php
//
// mactivitylogqrywfhtimelog.php
// fr: mactivitylog.php ln:249
//
		// prep date for activity log query
		$arrcutdate = explode(" ", $cutstart);
		$arrcutdate0 = $arrcutdate[0];
		
		// compute first total man-hrs per day
		$timevaldlyactlog=0;
require '../includes/dbh.php';
		$res17qry=""; $result17=""; $found17=0; $ctr17=0;
		$res17qry="SELECT hractlogid, timestart, timeend FROM tblhractlog WHERE date='$arrcutdate0' AND employeeid='$employeeid0'";
		$result17=$dbh->query($res17qry);
		if($result17->num_rows>0) {
			while($myrow17=$result17->fetch_assoc()) {
				$found17=1;
				$ctr17++;
				$hractlogid17 = $myrow17['hractlogid'];
				$timestart17 = $myrow17['timestart'];
				$timeend17 = $myrow17['timeend'];
				$timedur17=0;
				if($timestart17!='' && $timeend17!='') {
					if($timestart17!='0000-00-00 00:00:00' && $timeend17!='0000-00-00 00:00:00') {
					$timedur17 = (strtotime($timeend17) - strtotime($timestart17))/3600;
		$timevaldlyactlog = number_format(($timevaldlyactlog + $timedur17), 2);
		// echo "<p>$arrcutdate0 $ctr17 $hractlogid17 $timestart17 $timeend17 $timedur17 > $timevaldlyactlog<br></p>";
					} //if
				} //if
			} //while
		} //if
?>
