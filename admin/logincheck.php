<?php

/*
$result = mysql_query("SELECT * FROM tbladminlogin WHERE adminloginid=$loginid AND adminloginstat=1", $dbh); 
while ($myrow = mysql_fetch_row($result))
{
	$found = 1;
          
	$loginid = $myrow[0];
	$username = $myrow[1];
	$loginstatus = $myrow[5];
	$level = $myrow[6];
	$accesslevel = $myrow[9];
}
*/

// 20170125 mysqli extension migration
	$res0query = "SELECT tbladminlogin.adminloginid, tbladminlogin.adminuid, tbladminlogin.adminloginstat, tbladminlogin.adminloginlevel, tbladminlogin.accesslevel, tbladminlogin.employeeid, tbladminlogin.contactid, tbladminlogin.deptscd, tblempdetails.empdepartment, tblempdetails.empposition FROM tbladminlogin LEFT JOIN tblempdetails ON tbladminlogin.employeeid=tblempdetails.employeeid WHERE tbladminlogin.adminloginid=$loginid AND tbladminlogin.adminloginstat=1";
	$result0 = $dbh2->query($res0query);
	if($result0->num_rows > 0) {
		while($myrow0 = $result0->fetch_assoc()) {
		$found = 1;        
		$loginid = $myrow0['adminloginid'];
		$username = $myrow0['adminuid'];
		$loginstatus = $myrow0['adminloginstat'];
		$level = $myrow0['adminloginlevel'];
		$accesslevel = $myrow0['accesslevel'];
		$employeeid0 = $myrow0['employeeid'];
		$contactid0 = $myrow0['contactid'];
    $deptscd0 = $myrow0['deptscd'];
		$empdepartment0 = $myrow0['empdepartment'];
		$empposition0 = $myrow0['empposition'];

	// set logged-in user to admin
	$pkintrausr="adm";

	// set user var for tblloginstatus
	$logintype=2; // 1:non-admin, 2:admin
	$disabled=0; // 0:enabled, 1:disabled
	$loginstatus=1; // 0:logged-out, 1:logged-in
	// $session=$genranchars;
		}
	}

?>
