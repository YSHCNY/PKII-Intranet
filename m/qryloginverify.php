<?php
//
// fr: ../views/loginverify.php
// ../models/qrylogin2.php
require("../includes/dbh.php");

	// set user var for tblloginstatus
	$logintype=1; // 1:non-admin, 2:admin
	$disabled=0; // 0:enabled, 1:disabled
	$loginstatus=1; // 0:logged-out, 1:logged-in

	// start query verification
	// $res0query="SELECT tbllogin.username, tbllogin.employeeid, tblcontact.contactid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.email1, tblcontact.picfn, tblloginstatus.idloginstatus, tblempdetails.empdepartment, tblempdetails.empposition, tblempdetails.idhrpositionctg, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade FROM tbllogin LEFT JOIN tblloginstatus ON tbllogin.loginid=tblloginstatus.loginid LEFT JOIN tblempdetails ON tbllogin.employeeid=tblempdetails.employeeid LEFT JOIN tblcontact ON tbllogin.employeeid=tblcontact.employeeid WHERE tbllogin.loginid=$loginid AND tblloginstatus.session = \"$session\"  AND tblloginstatus.logintype=$logintype AND tblloginstatus.disabled=$disabled AND tblloginstatus.status=$loginstatus AND tbllogin.login_status=$loginstatus AND tblcontact.contact_type=\"personnel\" LIMIT 1";

	$res0query="SELECT tbllogin.username, 
	tbllogin.employeeid,

	tblcontact.contactid, 
	tblcontact.name_last, 
	tblcontact.name_first, 
	tblcontact.name_middle, 
	tblcontact.email1, 
	tblcontact.picfn, 

	tblloginstatus.idloginstatus, 

	tblempdetails.empdepartment, 
	tblempdetails.empposition, 
	tblempdetails.idhrpositionctg, 
	tblempdetails.emppositionlevel, 
	tblempdetails.empsalarygrade 
	
	FROM tbllogin 
	LEFT JOIN tblloginstatus ON tbllogin.loginid=tblloginstatus.loginid 
	LEFT JOIN tblempdetails ON tbllogin.employeeid=tblempdetails.employeeid 
	LEFT JOIN tblcontact ON tbllogin.employeeid=tblcontact.employeeid 
	WHERE tbllogin.loginid=$loginid 
	AND tblloginstatus.logintype=$logintype 
	AND tblloginstatus.disabled=$disabled 
	AND tblloginstatus.status=$loginstatus 
	AND tbllogin.login_status=$loginstatus 
	AND tblcontact.contact_type=\"personnel\" 
	LIMIT 1";

	$result0=""; $found0=0;
	$result0=$dbh->query($res0query);
	if($result0->num_rows>0) {
		while($myrow0=$result0->fetch_assoc()) {
			session_start();

			$_SESSION['username'] = $myrow0['username'];
			$_SESSION['employeeid'] = $myrow0['employeeid'];
			$_SESSION['contactid'] = $myrow0['contactid'];
			$_SESSION['name_last'] = $myrow0['name_last'];
			$_SESSION['name_first'] = $myrow0['name_first'];
			$_SESSION['name_middle'] = $myrow0['name_middle'];
			$_SESSION['email1'] = $myrow0['email1'];
			$_SESSION['picfn'] = $myrow0['picfn'];
			$_SESSION['idloginstatus'] = $myrow0['idloginstatus'];
			$_SESSION['empdepartment'] = $myrow0['empdepartment'];
			$_SESSION['empposition'] = $myrow0['empposition'];
			$_SESSION['idhrpositionctg'] = $myrow0['idhrpositionctg'];
			$_SESSION['emppositionlevel'] = $myrow0['emppositionlevel'];
			$_SESSION['empsalarygrade'] = $myrow0['empsalarygrade'];
			
		$found0=1;
		$username0 = $myrow0['username'];
		$employeeid0 = $myrow0['employeeid'];
		$contactid0 = $myrow0['contactid'];
		$name_last0 = $myrow0['name_last'];
		$name_first0 = $myrow0['name_first'];
		$name_middle0 = $myrow0['name_middle'];
		$email10 = $myrow0['email1'];
		$picfn0 = $myrow0['picfn'];
		$idloginstatus0 = $myrow0['idloginstatus'];
		$empdepartment0 = $myrow0['empdepartment'];
		$empposition0 = $myrow0['empposition'];
		$idhrpositionctg0 = $myrow0['idhrpositionctg'];
		$emppositionlevel0 = $myrow0['emppositionlevel'];
		$empsalarygrade0 = $myrow0['empsalarygrade'];



	


		
		} // while
	} // if

// close db conn
$dbh->close();
?>
