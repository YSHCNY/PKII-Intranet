<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$pid = (isset($_GET['pid'])) ? $_GET['pid'] :'';

$emp_ref_num = (isset($_POST['emp_ref_num'])) ? $_POST['emp_ref_num'] :'';
$emp_birthplace = (isset($_POST['emp_birthplace'])) ? $_POST['emp_birthplace'] :'';
$emp_civilstatus = (isset($_POST['emp_civilstatus'])) ? $_POST['emp_civilstatus'] :'';
$emp_tin = (isset($_POST['emp_tin'])) ? $_POST['emp_tin'] :'';
$emp_sss = (isset($_POST['emp_sss'])) ? $_POST['emp_sss'] :'';
$emp_philhealth = (isset($_POST['emp_philhealth'])) ? $_POST['emp_philhealth'] :'';
$emp_pagibig = (isset($_POST['emp_pagibig'])) ? $_POST['emp_pagibig'] :'';
$emp_pagibig2 = (isset($_POST['emp_pagibig2'])) ? $_POST['emp_pagibig2'] :'';
$emp_gsis = (isset($_POST['emp_gsis'])) ? $_POST['emp_gsis'] :'';
$emp_skills = (isset($_POST['emp_skills'])) ? $_POST['emp_skills'] :'';
$emp_status = (isset($_POST['emp_status'])) ? $_POST['emp_status'] :'';
$emp_remarks = (isset($_POST['emp_remarks'])) ? $_POST['emp_remarks'] :'';
$employee_type = (isset($_POST['employee_type'])) ? $_POST['employee_type'] :'';
$empdepartment = (isset($_POST['empdepartment'])) ? $_POST['empdepartment'] :'';
$empposition = (isset($_POST['empposition'])) ? $_POST['empposition'] :'';
$emppositionlevel = (isset($_POST['emppositionlevel'])) ? $_POST['emppositionlevel'] :'';
$empsalarygrade = (isset($_POST['empsalarygrade'])) ? $_POST['empsalarygrade'] :'';
$emp_record = (isset($_POST['emp_record'])) ? $_POST['emp_record'] :'';
$emptaxstatus = (isset($_POST['emptaxstatus'])) ? $_POST['emptaxstatus'] :'';
$idhrpositionctg = (isset($_POST['idhrpositionctg'])) ? $_POST['idhrpositionctg'] :'';

if ($emppositionlevel == '')
{ $emppositionlevel=0; }
if ($empsalarygrade == '')
{ $empsalarygrade=0; }

$found = 0;
$found2 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Update personnel info</font></p>";

	echo "<p><font color=green><b>Update successful!</b></font></p>";

	$res0query = "SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$pid'";
	$result0="";
	$result0=$dbh2->query($res0query);
	if($result0->num_rows>0) {
		while($myrow0=$result0->fetch_assoc()) {
		$found0=1;
	  $employeeid = $myrow0['employeeid'];
	  $name_last = $myrow0['name_last'];
	  $name_first = $myrow0['name_first'];
	  $name_middle = $myrow0['name_middle'];
		} // while($myrow0=$result0->fetch_assoc())
	} // if($result0->num_rows>0)

	echo "<p>For: <b>$pid - $name_last, $name_first $name_middle[0]</b></p>";

	$resquery = "UPDATE tblemployee SET emp_ref_num = \"$emp_ref_num\", emp_birthplace = \"$emp_birthplace\", 
		emp_civilstatus = \"$emp_civilstatus\", emp_tin = \"$emp_tin\", emp_sss = \"$emp_sss\", 
		emp_philhealth = \"$emp_philhealth\", emp_pagibig = \"$emp_pagibig\", emp_pagibig2=\"$emp_pagibig2\", emp_gsis = \"$emp_gsis\", emp_skills = \"$emp_skills\", emp_status = \"$emp_status\", emp_remarks = \"$emp_remarks\", employee_type = \"$employee_type\", emp_record = \"$emp_record\", emptaxstatus = \"$emptaxstatus\" WHERE employeeid=\"$pid\"";
	$result=$dbh2->query($resquery);

	$found11 = 0;

	$res11query = "SELECT employeeid FROM tblempdetails WHERE employeeid = '$pid'";
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
	  $found11 = 1;
		} // while($myrow11=$result11->fetch_assoc())
	} // if($result11->num_rows>0)

	if($found11 == 1) {
	$res2query = "UPDATE tblempdetails SET empdepartment = '$empdepartment', empposition = '$empposition', emppositionlevel=$emppositionlevel, empsalarygrade = '$empsalarygrade', idhrpositionctg=$idhrpositionctg WHERE employeeid='$pid'";
	$result2=$dbh2->query($res2query);
	// echo "<p>sql:$res2query</p>";
	} else {
	$res22query = "INSERT INTO tblempdetails (employeeid, empdepartment, empposition, emppositionlevel, empsalarygrade, idhrpositionctg) VALUES ('$pid', '$empdepartment', '$empposition', $emppositionlevel, '$empsalarygrade', '$idhrpositionctg')";
	$result22=$dbh2->query($res22query);
	} // if($found11 == 1)

	echo "empdepartment = $empdepartment<br>";
	echo "empposition = $idhrpositionctg|$empposition<br>";
	echo "emppositionlevel = $emppositionlevel<br>";
	echo "empsalarygrade = $empsalarygrade<br>";
	echo "emp_ref_num = $emp_ref_num<br>";
	echo "emp_birthplace = $emp_birthplace<br>";
	echo "emp_civilstatus = $emp_civilstatus<br>";
	echo "emp_tin = $emp_tin<br>";
	echo "emp_sss = $emp_sss<br>";
	echo "emp_philhealth = $emp_philhealth<br>"; 
	echo "emp_pagibig = $emp_pagibig<br>";
	echo "emp_pagibig2 = $emp_pagibig2<br>";
	echo "emp_gsis = $emp_gsis<br>";
	echo "emp_skills = $emp_skills<br>";
	echo "emp_status = $emp_status<br>";
	echo "emp_remarks = $emp_remarks<br>";
	echo "employee_type = $employee_type<br>";
	echo "emp_record = $emp_record<br>";
	echo "tax_status = $emptaxstatus<br>";
	echo "Update Record - OK<br>";

  echo "<p>";

     echo "<p><a href = personneledit2.php?pid=$pid&loginid=$loginid>Back to Edit Personnel Info</a><br>";

  $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
	$result=$dbh2->query($resquery); 

     include ("footer.php");

} else {

     include("logindeny.php");

}

// mysql_close($dbh);
$dbh2->close();
?> 

