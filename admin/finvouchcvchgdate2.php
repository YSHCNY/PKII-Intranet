<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$cvnumber = $_GET['cvn'];
$cvdate0 = $_GET['cvdt'];

$cvdate = $_POST['cvdate'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

//  echo "<p><font color=\"red\"><b>Modify CV record date...</b></font></p>";

  if($accesslevel >= 4 && $accesslevel <= 5)
  {

	$result11=""; $found11=0;
  $result11 = mysql_query("SELECT disbursementid, disbursementnumber, date, payee FROM tblfindisbursement WHERE disbursementnumber=\"$cvnumber\" AND date=\"$cvdate0\"", $dbh);
	if($result11 != "") {
  	while($myrow11 = mysql_fetch_row($result11)) {
    $found11 = 1;
		$disbursementid11 = $myrow11[0];
		$disbursementnumber11 = $myrow11[1];
		$date11 = $myrow11[2];
		$payee11 = $myrow11[3];

		$result12=""; $found12=0;
		$result12 = mysql_query("UPDATE tblfindisbursement SET date=\"$cvdate\" WHERE disbursementid=$disbursementid11 AND disbursementnumber=\"$cvnumber\"", $dbh);
		// echo "<p>vartest id:$disbursementid11, num:$cvnumber, dt:$date11, pyee:$payee11</p>";
		}
	}

	$result14=""; $found14=0;
	$result14 = mysql_query("SELECT disbursementtotid, disbursementnumber, date FROM tblfindisbursementtot WHERE disbursementnumber=\"$cvnumber\" AND date=\"$cvdate0\"", $dbh);
	if($result14 != "") {
		while($myrow14 = mysql_fetch_row($result14)) {
		$found14 = 1;
		$disbursementtotid14 = $myrow14[0];
		$disbursementnumber14 = $myrow14[1];
		$date14 = $myrow14[2];

		$result15=""; $found15=0;
		$result15 = mysql_query("UPDATE tblfindisbursementtot SET date=\"$cvdate\" WHERE disbursementtotid=$disbursementtotid14 AND disbursementnumber=\"$cvnumber\"", $dbh);
		}
	}

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - Modified date from:$date11 to:$cvdate of CV:$cvnumber, payee:$payee11";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
  }

  header("Location: finvouchcvnew.php?loginid=$loginid&cvn=$cvnumber&cvdate=$cvdate");
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
