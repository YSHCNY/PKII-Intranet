<?php 

include("db1.php");
include("datetimenow.php");

include("../includes/genranchars.php");
$genranchars = genRandomString();

$loginid = $_GET['loginid'];
$loginid0 = $_GET['stdlid'];
$username0 = $_GET['stduid'];

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

  header("Location: mngstduserchgpass.php?loginid=$loginid&stdlid=$loginid0&stduid=$username0&genranchar=$genranchars");
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
