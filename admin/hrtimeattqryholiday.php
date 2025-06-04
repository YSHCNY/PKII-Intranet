<?php
//
// hrtimeattqryholiday.php
// fr: hrtimeatttimelogs.php, hrtimeattcutleave.php
//
		$res21query = "SELECT idhrtaholidays, holidayname, holidaytype, shiftin, shiftout FROM tblhrtaholidays WHERE applic_date=\"$cutstartfin\" AND (holidaytype=\"special\" OR holidaytype=\"legal\" OR holidaytype=\"shortened\" OR holidaytype=\"city\")";
		$result21=""; $found21=0; $ctr21=0;
		// echo $res21query ;
		$result21 = $dbh2->query($res21query);
		if($result21->num_rows>0) {
			while($myrow21 = $result21->fetch_assoc()) {
			$found21 = 1;
			$idhrtaholidays21 = $myrow21['idhrtaholidays'];
			$holidayname21 = $myrow21['holidayname'];
			$holidaytype21 = $myrow21['holidaytype'];
			$shiftin21 = $myrow21['shiftin'];
			$shiftout21 = $myrow21['shiftout'];
			} // while($myrow21 = $result21->fetch_assoc())
		} // if($result21->num_rows>0)
?>
