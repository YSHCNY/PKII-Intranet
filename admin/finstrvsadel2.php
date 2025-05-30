<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$finstrvsfrmaid = $_GET['strvsid'];

$yravlbl = $_POST['yravlbl'];
$qtravlbl = $_POST['qtravlbl'];
$projrelref = $_POST['projrelref'];

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

  $result12 = mysql_query("DELETE FROM tblfinstrvsfrma WHERE tblfinstrvsfrmaid=$finstrvsfrmaid", $dbh);


// create log
    // include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - NK-Stravis Form-A item DELETED with id:$finstrvsfrmaid";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  header("Location: finstrvsamng.php?loginid=$loginid&yravlbl=$yravlbl&qtravlbl=$qtravlbl&projrelref=$projrelref");
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
