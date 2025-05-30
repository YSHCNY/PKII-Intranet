<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$empdependentid = $_GET['did'];

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

     echo "<p><font size=1>Directory >> Manage Personnel >> Change dependent's birthdate</font></p>";

	echo "<p><font color=green><b>Update successful!</b></font></p>";

	$result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
//	  $employeeid = $myrow0[0];
	  $name_last = $myrow0[1];
	  $name_first = $myrow0[2];
	  $name_middle = $myrow0[3];
	}

	$result2 = mysql_query("SELECT * FROM tblempdependent WHERE employeeid = '$employeeid' AND empdependentid = $empdependentid", $dbh);
	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $found2 = 1;
	  $empdependentid = $myrow2[0];
//	  $employeeid = $myrow2[1];
	  $empdependentctr = $myrow2[2];
	  $dependentlast = $myrow2[3];
	  $dependentfirst = $myrow2[4];
	  $dependentmiddle = $myrow2[5];
	  $dependentbirthdate = $myrow2[6];
	  $dependentrelation = $myrow2[7];
	}

	echo "<p>Dependent's birthdate changed for: <b>$employeeid - $name_last, $name_first $name_middle[0]</b><br>";
	echo "Dependent's Name: <b>$dependentfirst $dependentmiddle $dependentlast</b></p>";

	$result = mysql_query("UPDATE tblempdependent SET dependentbirthdate = '$newdate'
		WHERE employeeid='$employeeid' AND empdependentid=$empdependentid", $dbh) or die ("Couldn't execute query.".mysql_error());

	echo "dependentbirthdate = $newdate<br>";
	echo "Update Record - OK<br>";

     echo "<p><a href = personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel Info</a><br>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

