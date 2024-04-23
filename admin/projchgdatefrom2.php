<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$pid = $_GET['pid'];

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

     echo "<p><font size=1>Manage >> Projects >> Change date start</font></p>";

	$result1 = mysql_query("SELECT projectid, proj_sname, date_start, date_end FROM tblproject1 WHERE projectid='$pid'", $dbh);
	while ($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
//	  $projectid = $myrow1[0];
	  $proj_sname = $myrow1[1];
	  $date_start = $myrow1[2];
	  $date_end = $myrow1[3];
	}

  if ($found1 == 1)
  {

	echo "<p><font color=green><b>Update successful!</b></font></p>";

	$result = mysql_query("UPDATE tblproject1 SET date_start = '$newdate'
		WHERE projectid='$pid'", $dbh) or die ("Couldn't execute query.".mysql_error());

	echo "date_start = $newdate<br>";
	echo "Update Record - OK<br>";

     echo "<p><a href = editproj.php?loginid=$loginid&pid=$pid>Back to Edit Project</a><br>";

  }
  else
  {
    echo "<p><font color=red>Sorry, no projectid found.</font></p>";
    echo "<p><a href=project2.php?loginid=$loginid>Back to Manage Projects</a><br>";
  }

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

