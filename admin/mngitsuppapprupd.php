<?php
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$deptcd = (isset($_POST['deptcd'])) ? $_POST['deptcd'] :'';
$approver1empid = (isset($_POST['approver1empid'])) ? $_POST['approver1empid'] :'';
$approver2empid = (isset($_POST['approver2empid'])) ? $_POST['approver2empid'] :'';

// echo "<p>dept:$deptcd, appr1:$approver1empid, appr2:$approver2empid</p>";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{

	// echo "<html>";
	// echo "<pre>";

	//
	// start array loop
	//
	foreach($deptcd as $val => $n) {
		// echo "<p>val:$val, n:$n, dept:".$deptcd[$val].", appr1:".$approver1empid[$val].", appr2:".$approver2empid[$val]."<br>";

		// split
		$arrappr1emp = split("-", $approver1empid[$val]);
		$appr1empdept = $arrappr1emp[0];
		$appr1empid = $arrappr1emp[1];
		$arrappr2emp = split("-", $approver2empid[$val]);
		$appr2empdept = $arrappr2emp[0];
		$appr2empid = $arrappr2emp[1];
		// echo ", dept1:$appr1empdept, emp1:$appr1empid, dept2:$appr2empdept, emp2:$appr2empid";

		// query tblitctgsuppreq
		$res11query="SELECT iditsupportapprover FROM tblitsupportapprover WHERE deptcd=\"$n\"";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$ctr11 = $ctr11 + 1;
			$iditsupportapprover11 = $myrow11['iditsupportapprover'];
			} // while($myrow11 = $result11->fetch_assoc())
		} // if($result11->num_rows>0)
		if($found11==1) {
			$res12query="UPDATE tblitsupportapprover SET timestamp=\"$now\", loginid=$loginid, approver1empid=\"$appr1empid\", approver2empid=\"$appr2empid\" WHERE deptcd=\"$n\"";
		} else if($found11==0) {
			$res12query="INSERT INTO tblitsupportapprover SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=$loginid, approver1empid=\"$appr1empid\", approver2empid=\"$appr2empid\", deptcd=\"$n\"";
		} // if($found11==1)
		$result12 = $dbh2->query($res12query);
		// echo "<br>f11:$found11, res12:$res12query";

		// echo "</p>";

		// reset variables
		$appr1empid=""; $appr2empid="";
	} // foreach($deptcd as $val => $n)

		$adminlogdetails = "$loginid:$username - updated Manage categories > IT support request approvers";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	// redirect
	header("Location: mngitsuppreqappr.php?loginid=$loginid");
	exit;
	// echo "</pre>";
	// echo "<p><a href=\"mngitsuppreqappr.php?loginid=$loginid\">back</a></p>";
	// echo "</html>";
	
}
else
{
     include ("logindeny.php");
}

$dbh2->close();
?>
