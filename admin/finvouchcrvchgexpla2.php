<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$crvnumber = $_GET['crvn'];
$crvdate = $_GET['crvdt'];

$explanation = $_POST['explanation'];
$explanation = mysql_real_escape_string($explanation);

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
  $result11 = mysql_query("SELECT cashreceiptid, cashreceiptnumber, date, payor FROM tblfincashreceipt WHERE cashreceiptnumber=\"$crvnumber\"", $dbh);
	if($result11 != "") {
  	while($myrow11 = mysql_fetch_row($result11)) {
    $found11 = 1;
		$cashreceiptid11 = $myrow11[0];
		$cashreceiptnumber11 = $myrow11[1];
		$date11 = $myrow11[2];
		$payor11 = $myrow11[3];

		$result12=""; $found12=0;
		$result12 = mysql_query("UPDATE tblfincashreceipt SET explanation=\"$explanation\" WHERE cashreceiptid=$cashreceiptid11 AND cashreceiptnumber=\"$crvnumber\"", $dbh);
		// echo "<p>vartest id:$disbursementid11, num:$cvnumber, dt:$date11, pyee:$payee11</p>";
		}
	}

	$result14=""; $found14=0;
	$result14 = mysql_query("SELECT cashreceipttotid, cashreceiptnumber, date FROM tblfincashreceipttot WHERE cashreceiptnumber=\"$crvnumber\"", $dbh);
	if($result14 != "") {
		while($myrow14 = mysql_fetch_row($result14)) {
		$found14 = 1;
		$cashreceipttotid14 = $myrow14[0];
		$cashreceiptnumber14 = $myrow14[1];
		$date14 = $myrow14[2];

		$result15=""; $found15=0;
		$result15 = mysql_query("UPDATE tblfincashreceipttot SET explanation=\"$explanation\" WHERE cashreceipttotid=$cashreceipttotid14 AND cashreceiptnumber=\"$crvnumber\"", $dbh);
		}
	}

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - Modified explanation to:$explanation11 of C.R.V. No.:$crvnumber, rcvd_by:$payor11, date:$crvdate";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
  }
	// echo "<p>vartest $adminlogdetails</p>";

  header("Location: finvouchcrvnew.php?loginid=$loginid&crvn=$crvnumber&crvdate=$crvdate");
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
