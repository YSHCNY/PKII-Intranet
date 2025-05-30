<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$projassignid = $_GET['prjid'];

$year = $_POST['year'];
$month = $_POST['month'];
$day = $_POST['day'];

$newdate = "$year-$month-$day";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit Project Assignment >> Change date_from project duration</font></p>";

	echo "<p><font color=green><b>Update successfull!</b></font></p>";

	$result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
//	  $employeeid = $myrow0[0];
	  $name_last = $myrow0[1];
	  $name_first = $myrow0[2];
	  $name_middle = $myrow0[3];
	}

	echo "<p>Duration2 start date changed for: <b>$employeeid - $name_last, $name_first $name_middle[0]</b></p>";

	$result = mysql_query("UPDATE tblprojassign SET durationfrom2 = '$newdate'
		WHERE employeeid='$employeeid' AND projassignid = '$projassignid'", $dbh) or die ("Couldn't execute query.".mysql_error());

	echo "durationfrom2 = $newdate<br>";
	echo "Update Record - OK<br>";

     echo "<p><a href = personnelprojassignedit.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid>Back to Edit Project Assignment</a><br>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

