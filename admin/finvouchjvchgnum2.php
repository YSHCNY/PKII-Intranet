<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$jvnumber0 = $_GET['jvn'];
$jvdate0 = $_GET['jvdt'];

$jvnumber = trim($_POST['jvnumber']);

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
	$result10 = mysql_query("SELECT journalid, date FROM tblfinjournal WHERE journalnumber=\"$jvnumber\"", $dbh);
	if($result10 != "") {
		while($myrow10 = mysql_fetch_row($result10)) {
		$found10 = 1;
		$journalid10 = $myrow10[0];
		$date10 = $myrow10[1];
		}
	}
	if($found10 == "1") {

		header("Location: finvouchjvchgnumerr.php?loginid=$loginid&jvn=$jvnumber0&jvdt=$jvdate0");
		exit;

	} else if($found10 == "0") {

	// start modify new CRV number
	$result11=""; $found11=0;
  $result11 = mysql_query("SELECT journalid, journalnumber, date FROM tblfinjournal WHERE journalnumber=\"$jvnumber0\" AND date=\"$jvdate0\"", $dbh);
	if($result11 != "") {
  	while($myrow11 = mysql_fetch_row($result11)) {
    $found11 = 1;
		$journalid11 = $myrow11[0];
		$journalnumber11 = $myrow11[1];
		$date11 = $myrow11[2];

		$result12=""; $found12=0;
		$result12 = mysql_query("UPDATE tblfinjournal SET journalnumber=\"$jvnumber\" WHERE journalid=$journalid11 AND journalnumber=\"$jvnumber0\"", $dbh);
		// echo "<p>vartest id:$disbursementid11, oldnum:$disbursementnumber11, newnum:$cvnumber pyee:$payee11</p>";
		}
	}

	$result14=""; $found14=0;
	$result14 = mysql_query("SELECT journaltotid, journalnumber, date FROM tblfinjournaltot WHERE journalnumber=\"$jvnumber0\" AND date=\"$jvdate0\"", $dbh);
	if($result14 != "") {
		while($myrow14 = mysql_fetch_row($result14)) {
		$found14 = 1;
		$journaltotid14 = $myrow14[0];
		$journalnumber14 = $myrow14[1];
		$date14 = $myrow14[2];

		$result15=""; $found15=0;
		$result15 = mysql_query("UPDATE tblfinjournaltot SET journalnumber=\"$jvnumber\" WHERE journaltotid=$journaltotid14 AND journalnumber=\"$jvnumber0\"", $dbh);

		}
	}

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Modified JV number of Journal Voucher from:$jvnumber0 to:$jvnumber, date:$jvdate0";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  header("Location: finvouchjvnew.php?loginid=$loginid&jvn=$jvnumber&jvdate=$jvdate0");
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
