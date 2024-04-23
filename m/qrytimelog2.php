<?php 

include '../includes/dbh.php';

// start contents here
// list available year-month of timelog data
		
		echo "<select name=\"monsel\" class = 'rounded-3 border-0 px-3 py-2 mx-2'>";
		$res12query="SELECT DISTINCT DATE_FORMAT(att_checktime, '%Y-%m' ) AS yyyymm FROM `tblhrattcheckinout` WHERE att_userid=$att_userid0 ORDER BY att_checktime DESC";
		$result12=""; $found12=0;
		$result12=$dbh->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
			$found12 = 1;
			$yyyymm12 = $myrow12['yyyymm'];
			if($yyyymm12 == $yyyymm) { $yyyymmsel="selected"; } else { $yyyymmsel=""; }
			echo "<option value=\"$yyyymm12\" $yyyymmsel>".date("Y-M", strtotime($yyyymm12))."</option>";
			} // while($myrow12=$result12->fetch_assoc())
		} // if($result12->num_rows>0)
		echo "</select>";
		  
	// generate time log
		
			
	
$dbh->close();
?>
