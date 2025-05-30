<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
$groupname = (isset($_POST['groupname'])) ? $_POST['groupname'] :'';
$grpaccesslevel = (isset($_POST['grpaccesslevel'])) ? $_POST['grpaccesslevel'] :'';
$member = (isset($_POST['member'])) ? $_POST['member'] :'';
$name_first = (isset($_POST['name_first'])) ? $_POST['name_first'] :'';
$name_middle = (isset($_POST['name_middle'])) ? $_POST['name_middle'] :'';
$name_last = (isset($_POST['name_last'])) ? $_POST['name_last'] :'';
$email1 = (isset($_POST['email1'])) ? $_POST['email1'] :'';

$found = 0;
$exist = 0;
$datecreated = date("Y-m-d");


if ($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><b>Creating Group Members</b></p>";

     foreach ($member as $val) {
	// $result0 = mysql_query("", $dbh);
	$res0query=""; $result0="";
	$res0query="SELECT tblemployee.employeeid, tblcontact.name_first, tblcontact.name_middle, tblcontact.name_last, tblcontact.email1 FROM tblemployee LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE tblemployee.employeeid='$val' AND tblemployee.emp_record='active'";
	$result0=$dbh2->query($res0query);
	if($result0->num_rows>0) {
		while($myrow0=$result0->fetch_assoc()) {
	  echo "Updating:$groupname - ".$myrow0['employeeid']." - name:".$myrow0['name_first']." ".$myrow0['name_middle']." ".$myrow0['name_last']." - ".$myrow0['email1']." - datecreated:".$datecreated." - status:active<br>";
		} //while
	} //if

	// $result1 = mysql_query("", $dbh);
	$res1query=""; $result1="";
	$res1query="INSERT INTO tblemppaybongrp (employeeid, groupname, datecreated, status, accesslevel) VALUES (\"$val\", \"$groupname\", \"$datecreated\", \"active\", $grpaccesslevel)";
	$result1=$dbh2->query($res1query);
	
	// $result2 = mysql_query("", $dbh);
	$res2query=""; $result2="";
	$res2query="INSERT INTO tblemppaybonus (employeeid, groupname, date, grossamt, taxdeduct, otherdeduct, netamt) VALUES (\"$val\", \"$groupname\", \"$datecreated\", 0, 0, 0, 0)";
	$result2=$dbh2->query($res2query);
	
     } //foreach
	 
     echo "<p>Finished updating...<br>";
     echo "<p><a href=\"emppaybon01.php?loginid=$loginid\" class='btn btn-default' role='button'>Back to Bonus Notifier Menu</a></p>";

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
