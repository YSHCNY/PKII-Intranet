<?php
//
// qryhrdeptcd.php
// fr: ../vc/mhrpersreqadd.php
//
require '../includes/dbh.php';

	$res14query="SELECT tblemployee.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblempdetails.empdepartment, tblempdetails.empposition FROM tblemployee LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid LEFT JOIN tblempdetails ON tblemployee.employeeid=tblempdetails.employeeid WHERE tblemployee.employee_type=\"employee\" AND tblemployee.emp_record=\"active\" ORDER by tblcontact.name_last ASC";
	$result14=""; $found14=0; $ctr14=0; $data="";
	$result14=$dbh->query($res14query);
	$employeeid14Arr=array();
	$name_last14Arr=array();
	$name_first14Arr=array();
	$name_middle14Arr=array();
	$empdepartment14Arr=array();
	$empposition14Arr=array();
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$found14=1;
		array_push($employeeid14Arr, $myrow14['employeeid']);
		array_push($name_last14Arr, strtoupper($myrow14['name_last']));
		array_push($name_first14Arr, $myrow14['name_first']);
		array_push($name_middle14Arr, $myrow14['name_middle']);
		array_push($empdepartment14Arr, $myrow14['empdepartment']);
		array_push($empposition14Arr, $myrow14['empposition']);
		} // while
	} // if
		
$dbh->close();
?>
