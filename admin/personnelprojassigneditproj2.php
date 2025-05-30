<?php 

include("db1.php");
include('datetimenow.php');

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$projassignid = $_GET['prjid'];
$idprojcdassign = $_GET['idprjcdasgn'];

$projectid = $_POST['projectid'];
$duration = $_POST['duration'];
$durationprop = $_POST['durationprop'];

if($duration == '' || $duration == 0) { $duration=0; }

// echo "<p>vartest lid:$loginid, eid:$employeeid, prjasgnid:$projassignid, prjid:$projectid</p>";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
		// include ("header.php");
		// include ("sidebar.php");

	$result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$employeeid\"", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
//	  $employeeid = $myrow0[0];
	  $name_last = $myrow0[1];
	  $name_first = $myrow0[2];
	  $name_middle = $myrow0[3];
	}

	$result1 = mysql_query("SELECT proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid=$projectid", $dbh);
	while ($myrow1 = mysql_fetch_row($result1))
	{
	  $proj_code1 = $myrow1[0];
	  $proj_fname = $myrow1[1];
	  $proj_sname = $myrow1[2];
	}

	$result = mysql_query("UPDATE tblprojcdassign SET timestamp=\"$now\", loginid=$loginid, projcode=\"$proj_code1\", projname=\"$proj_sname\", projectid=$projectid, duration=$duration, durationprop=\"$durationprop\" WHERE idprojcdassign=$idprojcdassign AND empid=\"$employeeid\"", $dbh) or die ("Couldn't execute query.".mysql_error());

// create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - Modified project:$projectid-$proj_code1 in project assignment id:$projassignid for $employeeid-$name_last, $name_first $name_middle[0], duration:$duration $durationprop";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  header("Location: personnelprojassignedit.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid");
  exit;
	// echo "<p><a href=\"personnelprojassignedit.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid\">back</a></p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

		// include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

