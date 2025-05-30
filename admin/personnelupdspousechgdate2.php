<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];

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

     echo "<p><font size=1>Directory >> Manage Personnel >> Change spouse's birthdate</font></p>";

	echo "<p><font color=green><b>Update successful!</b></font></p>";

	$result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
//	  $employeeid = $myrow0[0];
	  $name_last = $myrow0[1];
	  $name_first = $myrow0[2];
	  $name_middle = $myrow0[3];
	}

	$result1 = mysql_query("SELECT * FROM tblempspouse WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow1 = mysql_fetch_row($result1))
	{
	  $empspouseid = $myrow1[0];
//	  $employeeid = $myrow1[1];
	  $empspousectr = $myrow1[2];
	  $empspouselast = $myrow1[3];
	  $empspousefirst = $myrow1[4];
	  $empspousemiddle = $myrow1[5];
	}

	echo "<p>Spouse' birthdate changed for: <b>$employeeid - $name_last, $name_first $name_middle[0]</b><br>";
	echo "Spouse' Name: <b>$empspousefirst $empspousemiddle $empspouselast</b></p>";

	$result = mysql_query("UPDATE tblempspouse SET empspousebirthdate = '$newdate'
		WHERE employeeid='$employeeid'", $dbh) or die ("Couldn't execute query.".mysql_error());

	echo "empspousebirthdate = $newdate<br>";
	echo "Update Record - OK<br>";

     echo "<p><a href = personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel Info</a></p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

