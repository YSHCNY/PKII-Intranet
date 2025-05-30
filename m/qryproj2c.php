<?php
//
// qryproj2.php
// fr: ../vc/vprojmore.php
//
require '../includes/dbh.php';

	$res14query="SELECT DISTINCT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_middle, tblcontact.name_last, tblcontact.email1 FROM tblcontact JOIN tblprojassign ON tblcontact.employeeid = tblprojassign.employeeid WHERE tblprojassign.proj_code='$projcode'";
	$result14=""; $found14=0; $ctr14=0; $data="";
	$result14=$dbh->query($res14query);
	$employeeid14Arr=array();
	$name_first14Arr=array();
	$name_middle14Arr=array();
	$name_last14Arr=array();
	$email114Arr=array();
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$found14=1;
		array_push($employeeid14Arr, $myrow14['employeeid']);
		array_push($name_first14Arr, $myrow14['name_first']);
		array_push($name_middle14Arr, $myrow14['name_middle']);
		array_push($name_last14Arr, $myrow14['name_last']);
		array_push($email114Arr, $myrow14['email1']);
		} // while
	} // if
		
$dbh->close();
?>
