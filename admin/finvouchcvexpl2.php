<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$disbursementtotid = $_GET['dtid'];

$explanation = $_POST['explanation'];

$found = 0;
$found11 = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

// update template
  if($accesslevel >= 3)
  {
    $result11 = mysql_query("SELECT disbursementtotid FROM tblfindisbursementtot WHERE disbursementtotid=$disbursementtotid", $dbh);
      while($myrow11 = mysql_fetch_row($result11))
      {
	$found11 = 1;
	$disbursementtotid11 = $myrow11[0];
      }

    if($found11 == 1)
    {
      $result12 = mysql_query("UPDATE tblfindisbursementtot SET
	explanation=\"$explanation\"
      WHERE disbursementtotid = $disbursementtotid", $dbh);
    }

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Add explanation to Check Voucher with disbursementtotid: $disbursementtotid";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

// redirect back to previous page
  header("Location: finvouchcvexpl.php?loginid=$loginid");
  exit;

  }

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

//     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
