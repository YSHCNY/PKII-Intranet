<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$crvnumber0 = $_GET['crvn'];
$crvdate0 = $_GET['crvdt'];

$crvnumber = trim($_POST['crvnumber']);

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

	// check first if new crv no. exists and exit
	$result10=""; $found10=0;
	$result10 = mysql_query("SELECT cashreceiptid, date FROM tblfincashreceipt WHERE cashreceiptnumber=\"$crvnumber\"", $dbh);
	if($result10 != "") {
		while($myrow10 = mysql_fetch_row($result10)) {
		$found10 = 1;
		$cashreceiptid10 = $myrow10[0];
		$date10 = $myrow10[1];
		}
	}
	if($found10 == "1") {

		header("Location: finvouchcrvchgnumerr.php?loginid=$loginid&crvn=$crvnumber0&crvdt=$crvdate0");
		exit;

	} else if($found10 == "0") {

	// start modify new CRV number
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
		$result12 = mysql_query("UPDATE tblfincashreceipt SET cashreceiptnumber=\"$crvnumber\" WHERE cashreceiptid=$cashreceiptid11 AND cashreceiptnumber=\"$crvnumber0\"", $dbh);
		// echo "<p>vartest id:$disbursementid11, oldnum:$disbursementnumber11, newnum:$cvnumber pyee:$payee11</p>";
		}
	}

	$result14=""; $found14=0;
	$result14 = mysql_query("SELECT cashreceipttotid, cashreceiptnumber, date FROM tblfincashreceipttot WHERE cashreceiptnumber=\"$crvnumber0\" AND date=\"$crvdate0\"", $dbh);
	if($result14 != "") {
		while($myrow14 = mysql_fetch_row($result14)) {
		$found14 = 1;
		$cashreceipttotid14 = $myrow14[0];
		$cashreceiptnumber14 = $myrow14[1];
		$date14 = $myrow14[2];

		$result15=""; $found15=0;
		$result15 = mysql_query("UPDATE tblfincashreceipttot SET cashreceiptnumber=\"$crvnumber\" WHERE cashreceipttotid=$cashreceipttotid14 AND cashreceiptnumber=\"$crvnumber0\"", $dbh);

		}
	}

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Modified CRV number of Cash Receipt from:$crvnumber0 to:$crvnumber, date:$crvdate0, rcvd_by:$payor11";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  header("Location: finvouchcrvnew.php?loginid=$loginid&crvn=$crvnumber&crvdate=$crvdate0");
  exit;

	}

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
