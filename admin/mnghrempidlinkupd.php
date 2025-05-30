<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$hrattuserinfoid = $_GET['uid'];

$employeeid = $_POST['eid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

//  echo "<p><font color=\"red\"><b>Link biometrics userid to maindb's employeeid...</b></font></p>";

  if($accesslevel >= 4 && $accesslevel <= 5)
  {

	$result11 = mysql_query("UPDATE tblhrattuserinfo SET employeeid=\"$employeeid\" WHERE hrattuserinfoid=$hrattuserinfoid", $dbh);

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - Linked biometrics userid to employeeid:$employeeid with hrattuserinfoid:$hrattuserinfoid";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
  }
	// echo "<p>vartest $adminlogdetails</p>";

  header("Location: mnghrempidlink.php?loginid=$loginid");
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
