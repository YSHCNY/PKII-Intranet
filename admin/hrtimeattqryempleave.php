<?php
//
// hrtimeattqryempleave.php
// fr: hrtimeatttimelogupd.php
// req: $idcutoff, $employeeid, $leavedate

	$res18query="SELECT tblhrtaempleavechglog.idhrtaempleavechglog, tblhrtaempleavechglog.idhrtaleavectg, tblhrtaempleavechglog.leavename, tblhrtaempleavechglog.leaveduration FROM tblhrtaempleavechglog WHERE tblhrtaempleavechglog.idhrtacutoff=$idcutoff AND tblhrtaempleavechglog.employeeid=\"$employeeid\" AND tblhrtaempleavechglog.leavedate=\"$leavedate\"";
	$result18=""; $found18=0; $ctr18=0;
	$result18=$dbh2->query($res18query);
	if($result18->num_rows>0) {
		while($myrow18=$result18->fetch_assoc()) {
		$found18=1;
		$idhrtaempleavechglog18 = $myrow18['idhrtaempleavechglog'];
		$idhrtaleavectg18 = $myrow18['idhrtaleavectg'];
		$leavename18 = $myrow18['leavename'];
		$leaveduration18 = $myrow18['leaveduration'];
		} // while
	} // if
?>
