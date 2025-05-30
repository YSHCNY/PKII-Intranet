<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$employeeid10 = $_GET['eid'];
$groupname10 = $_GET['gn'];
$confipaymemprojid10 = $_GET['cmpid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

// delete record
  $result12 = mysql_query("DELETE FROM tblconfipaymemproj WHERE employeeid=\"$employeeid10\" AND groupname=\"$groupname10\" AND confipaymemprojid=$confipaymemprojid10", $dbh);

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Delete project in Custom Payroll personnel info with details: cmpid:$confipaymemprojid10 empnum:$employeeid10 group:$groupname10";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  header("Location: confipay3.php?loginid=$loginid&eid=$employeeid10&gn=$groupname10");
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

