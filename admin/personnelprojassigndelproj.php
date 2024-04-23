<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$projassignid = $_GET['prjid'];
$idprojcdassign = $_GET['idprjcdasgn'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}  

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

// start contents here

	// query details
	$result5=""; $found5=0; $ctr5=0;
	$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE idprojcdassign=$idprojcdassign AND empid=\"$employeeid\"", $dbh);
	if($result5 != "") {
		while($myrow5 = mysql_fetch_row($result5)) {
		$found5 = 1;
		$projectid5 = $myrow5[0];
		$projcode5 = $myrow5[1];
		$projname5 = $myrow5[2];
		}
	}

	// delete query
  $result12 = mysql_query("DELETE FROM tblprojcdassign WHERE idprojcdassign=$idprojcdassign", $dbh);


	// create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - delete project:$projcode5-$projname5 for empid:$employeeid and projassignid:$projassignid";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  header("Location: personnelprojassignedit.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid");
  exit;

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

//     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>
