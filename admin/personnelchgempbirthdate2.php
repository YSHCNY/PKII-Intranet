<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$pid = $_GET['pid'];

$newdate = $_POST['newbirthdate'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//      include ("header.php");
//     include ("sidebar.php");

//     echo "<p><font size=1>Directory >> Manage Personnel >> Change birthdate</font></p>";

//	echo "<p><font color=green><b>Update successful!</b></font></p>";

	$result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$pid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
	  $employeeid = $myrow0[0];
	  $name_last = $myrow0[1];
	  $name_first = $myrow0[2];
	  $name_middle = $myrow0[3];
	}

//	echo "<p>Birthdate changed for: <b>$pid - $name_last, $name_first $name_middle[0]</b></p>";

	$result = mysql_query("UPDATE tblemployee SET emp_birthdate = \"$newdate\"
		WHERE employeeid=\"$pid\"", $dbh) or die ("Couldn't execute query.".mysql_error());

//	echo "emp_birthdate = $newdate<br>";
//	echo "Update Record - OK<br>";

//  echo "<p>";

//     echo "<p><a href = personneledit2.php?pid=$pid&loginid=$loginid>Back to Edit Personnel Info</a><br>";

		// create log
  	$result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
		while($myrow16 = mysql_fetch_row($result16))
		{ $adminuid=$myrow16[0]; }
		$adminlogdetails = "$loginid:$adminuid - change birthdate to $newdate of employee: $employeeid - $name_last, $name_first $name_middle";
		$result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

	// redirect
	header("Location: personneledit2.php?pid=$pid&loginid=$loginid");
	exit;


  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

//     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

