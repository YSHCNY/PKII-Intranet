<?php
//
// qryempdetails.php
// fr: ../vc/menu.php
//
require '../includes/dbh.php';

	$res11query="SELECT empdetailsid, empdepartment, empposition, emppositionlevel, empsalarygrade, idhrpositionctg FROM tblempdetails WHERE employeeid=\"$employeeid0\"";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$empdetailsid11 = $myrow11['empdetailsid'];
		$empdepartment11 = $myrow11['empdepartment'];
		$empposition11 = $myrow11['empposition'];
		$emppositionlevel11 = $myrow11['emppositionlevel'];
		$empsalarygrade11 = $myrow11['empsalarygrade'];
		$idhrpositionctg11 = $myrow11['idhrpositionctg'];
		} // while
	} // if
		
$dbh->close();
?> 
