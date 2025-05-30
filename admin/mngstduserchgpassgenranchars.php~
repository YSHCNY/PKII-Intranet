<?php 

include("db1.php");
include("datetimenow.php");

include("../includes/genranchars.php");
$genranchars = genRandomString();

$loginid = $_GET['loginid'];
$adminloginid0 = $_GET['admid'];
$adminuid0 = $_GET['admuid'];

$found = 0;
$accesslevel11 = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     // include ("header.php");
     // include ("sidebar.php");

// start contents here

  header("Location: mngadmuserchgpass.php?loginid=$loginid&admid=$adminloginid0&admuid=$adminuid0&genranchar=$genranchars");
  exit;


// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     // include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>
