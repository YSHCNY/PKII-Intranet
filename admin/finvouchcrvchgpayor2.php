<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$crvnumber0 = $_GET['crvn'];
$crvdate0 = $_GET['crvdt'];

// $payor = trim($_POST['payor']);

$payorsw = $_POST['payorsw'];
$payorcompanyid = $_POST['payorcompanyid'];
$payorcontactid = $_POST['payorcontactid'];

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
  $result11 = mysql_query("SELECT cashreceiptid, cashreceiptnumber, date, payor FROM tblfincashreceipt WHERE cashreceiptnumber=\"$crvnumber0\" AND date=\"$crvdate0\"", $dbh);
	if($result11 != "") {
  	while($myrow11 = mysql_fetch_row($result11)) {
    $found11 = 1;
		$cashreceiptid11 = $myrow11[0];
		$cashreceiptnumber11 = $myrow11[1];
		$date11 = $myrow11[2];
		$payor11 = $myrow11[3];

		$result12=""; $found12=0;
		// $result12 = mysql_query("UPDATE tblfincashreceipt SET payor=\"$payor\" WHERE cashreceiptid=$cashreceiptid11 AND cashreceiptnumber=\"$crvnumber0\"", $dbh);
		if($payorsw=="company") {
		$result12 = mysql_query("UPDATE tblfincashreceipt SET companyid=\"$payorcompanyid\", contactid=0 WHERE cashreceiptid=$cashreceiptid11 AND cashreceiptnumber=\"$crvnumber0\"", $dbh);
		} else if($payorsw=="contactperson") {
		$result12 = mysql_query("UPDATE tblfincashreceipt SET companyid=0, contactid=\"$payorcontactid\" WHERE cashreceiptid=$cashreceiptid11 AND cashreceiptnumber=\"$crvnumber0\"", $dbh);
		}
		// echo "<p>vartest id:$cashreceiptid11 crnum:$cashreceiptnumber11 payor:$payor11 sw:$payorsw compid:$payorcompanyid contactid:$payorcontactid</p>";
		}
	}

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Modified Payor or Received_by of C.R.V. No.$crvnumber0 with date:$crvdate0 from:$payor11 to compid:$payorcompanyid or contactid:$payorcontactid";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
  }

  header("Location: finvouchcrvnew.php?loginid=$loginid&crvn=$crvnumber0&crvdate=$crvdate0");
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