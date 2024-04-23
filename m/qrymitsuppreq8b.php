<?php
//
// qrymitsuppreq8b.php
// fr: ./vc/mitsuppreqdtl.php & ./vc/mitsuppreqadd.php

// db conn string

require '../includes/dbh.php';

	$res18bquery="SELECT tblitsupportapprover.iditsupportapprover, tblitsupportapprover.approver1empid, tblitsupportapprover.approver2empid FROM tblitsupportapprover WHERE tblitsupportapprover.deptcd=\"$deptcd16\" LIMIT 1";
	$result18b=""; $found18b=0; $ctr18b=0;
	$result18b=$dbh->query($res18bquery);
	if($result18b->num_rows>0) {
		while($myrow18b=$result18b->fetch_assoc()) {
		$iditsupportapprover18b = $myrow18b['iditsupprtapprover'];
		$approver1empid18b = $myrow18b['approver1empid'];
		$approver2empid18b = $myrow18b['approver2empid'];
		} // while
	} // if

// close database
$dbh->close();
?>
