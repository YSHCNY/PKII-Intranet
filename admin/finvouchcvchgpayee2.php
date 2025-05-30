<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$cvnumber0 = $_GET['cvn'];
$cvdate0 = $_GET['cvdt'];

// $payee = trim($_POST['payee']);

$payeesw = $_POST['payeesw'];
$payeecompanyid = $_POST['payeecompanyid'];
$payeecontactid = $_POST['payeecontactid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

//  echo "<p><font color=\"red\"><b>Modify CV number...</b></font></p>";

  if($accesslevel >= 4 && $accesslevel <= 5)
  {

	$result11=""; $found11=0;
  $result11 = mysql_query("SELECT disbursementid, disbursementnumber, date, payee FROM tblfindisbursement WHERE disbursementnumber=\"$cvnumber0\" AND date=\"$cvdate0\"", $dbh);
	if($result11 != "") {
  	while($myrow11 = mysql_fetch_row($result11)) {
    $found11 = 1;
		$disbursementid11 = $myrow11[0];
		$disbursementnumber11 = $myrow11[1];
		$date11 = $myrow11[2];
		$payee11 = $myrow11[3];

		$result12=""; $found12=0;
		// $result12 = mysql_query("UPDATE tblfindisbursement SET payee=\"$payee\" WHERE disbursementid=$disbursementid11 AND disbursementnumber=\"$cvnumber0\"", $dbh);
		if($payeesw=="company") {
		$result12 = mysql_query("UPDATE tblfindisbursement SET companyid=\"$payeecompanyid\", contactid=0 WHERE disbursementid=$disbursementid11 AND disbursementnumber=\"$cvnumber0\"", $dbh);
		} else if($payeesw=="contactperson") {
		$result12 = mysql_query("UPDATE tblfindisbursement SET companyid=0, contactid=\"$payeecontactid\" WHERE disbursementid=$disbursementid11 AND disbursementnumber=\"$cvnumber0\"", $dbh);
		}
		// echo "<p>vartest id:$disbursementid11, oldnum:$disbursementnumber11, newnum:$cvnumber pyee:$payee11</p>";
		}
	}

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Modified payee from:$payee11 to:$payee of CV:$cvnumber0, date:$cvdate0";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"from:$payee11 to compid:$payeecompanyid or contactid:$payeecontactid", $dbh);
  }

  header("Location: finvouchcvnew.php?loginid=$loginid&cvn=$cvnumber0&cvdate=$cvdate0");
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
