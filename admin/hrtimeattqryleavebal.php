<?php
//
// hrtimeattqryleavebal.php
// fr:hrtimeatttimelogupd.php
//

	$res19query="SELECT idhrtaempleavesumm, bal FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup AND idhrtaleavectg=$idhrtaleavectg18 AND (dateannivstart<=\"$cutstart\" AND dateannivend>=\"$cutstart\") AND (datestart=\"0000-00-00\" AND dateend=\"0000-00-00\") ORDER BY dateannivstart DESC LIMIT 1";
	$result19=""; $found19=0; $ctr19=0;
	$result19=$dbh2->query($res19query);
	if($result19->num_rows>0) {
		while($myrow19=$result19->fetch_assoc()) {
		$found19=1;
		$idhrtaempleavesumm19 = $myrow19['idhrtaempleavesumm'];
		$bal19 = $myrow19['bal'];
		} // while
	} // if

?>
