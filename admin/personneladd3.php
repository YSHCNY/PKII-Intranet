<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$contactid = trim($_POST['contactid']);
$newemployeeid = trim($_POST['newemployeeid']);
$name_last = trim($_POST['name_last']);
$name_first = trim($_POST['name_first']);
$name_middle = trim($_POST['name_middle']);
$personnel_type = $_POST['personnel_type'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Add new personnel</font></p>";

	// check employeeid first if exists before updating
	$result5=""; $found5=0; $ctr5=0;
	$result5sel="SELECT name_first, name_last, personnel_type FROM WHERE employeeid=\"$newemployeeid\"";
	$result5 = mysql_query("$result5sel", $dbh);
	if($result5 != "") {
		while($myrow5 = mysql_fetch_row($result5)) {
		$found5 = 1;
		$name_first5 = $myrow5[0];
		$name_last5 = $myrow5[1];
		$personnel_type5 = $myrow5[2];
		}
	}

	if($found5 == 1) {

		echo "<p><font color=\"red\">Sorry, employee number <b>$newemployeeid</b> already on database and assigned to <b>$name_last5, $name_first5 - $personnel_type5</b></font></p>";
		echo "<p><a href=\"personneladd.php?loginid=$loginid&eid=$newemployeeid&nl=$name_last&nf=$name_first&nm=$name_middle&pt=$personnel_type\">back</a></p>";

	} else {

	$result2 = mysql_query("UPDATE tblcontact SET employeeid=\"$newemployeeid\", name_last=\"$name_last\", name_first=\"$name_first\", name_middle=\"$name_middle\", contact_type=\"personnel\" WHERE contactid=$contactid", $dbh);

	$datenow = date('Y-m-d');

	$result3 = mysql_query("INSERT INTO tblemployee (employeeid, date, employee_type, term_resign, emp_record) VALUES ('$newemployeeid', '$datenow', '$personnel_type', '0000-00-00', \"active\")", $dbh);

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Add new personnel: $newemployeeid - $name_last, $name_first $name_middle - $personnel_type";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

	echo "<p><font color=green><b>New personnel record saved.</b></font></p>";
	echo "employeeid: $employeeid<br>";
	echo "name: $name_last, $name_first $name_middle<br>";
	echo "personneltype: $personnel_type<br>";
	echo "date: $datenow<br></p>";

	echo "<p>Click <a href=personneledit2.php?loginid=$loginid&pid=$newemployeeid><b>here</b></a> to enter more information to currently saved personnel</p>";

	}

	echo "<p><a href=personneledit.php?loginid=$loginid>Back to Manage Personnel</a><br>";


     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
