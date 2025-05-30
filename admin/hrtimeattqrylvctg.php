<?php
//
// hrtimeattqrylvctg.php
// fr: hrtimeattindivinfo.php
// req: where18

	$res18query="SELECT tblhrtaleavectg.name, tblhrtaleavectg.quota FROM tblhrtaleavectg WHERE $where18 LIMIT 1";
	$result18=""; $found18=0; $ctr18=0;
	$result18=$dbh2->query($res18query);
	if($result18->num_rows>0) {
		while($myrow18=$result18->fetch_assoc()) {
		$found18=1;
		$name18 = $myrow18['name'];
		$quota18 = $myrow18['quota'];
		} // while
	} // if

?>
