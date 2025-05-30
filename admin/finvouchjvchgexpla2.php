<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$journalnumber = $_GET['jvn'];
$jvdate = $_GET['jvdt'];

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
  $result11 = mysql_query("SELECT journalid, journalnumber, date FROM tblfinjournal WHERE journalnumber=\"$journalnumber\"", $dbh);
	if($result11 != "") {
  	while($myrow11 = mysql_fetch_row($result11)) {
    $found11 = 1;
		$journalid11 = $myrow11[0];
		$journalnumber11 = $myrow11[1];
		$date11 = $myrow11[2];

		$result12=""; $found12=0;
		$result12 = mysql_query("UPDATE tblfinjournal SET explanation=\"$explanation\" WHERE journalid=$journalid11 AND journalnumber=\"$journalnumber11\"", $dbh);
		// echo "<p>vartest id:$disbursementid11, num:$cvnumber, dt:$date11, pyee:$payee11</p>";
		}
	}

	$result14=""; $found14=0;
	$result14 = mysql_query("SELECT journaltotid, journalnumber, date FROM tblfinjournaltot WHERE journalnumber=\"$journalnumber\"", $dbh);
	if($result14 != "") {
		while($myrow14 = mysql_fetch_row($result14)) {
		$found14 = 1;
		$journaltotid14 = $myrow14[0];
		$journalnumber14 = $myrow14[1];
		$date14 = $myrow14[2];

		$result15=""; $found15=0;
		$result15 = mysql_query("UPDATE tblfinjournaltot SET explanation=\"$explanation\" WHERE journaltotid=$journaltotid14 AND journalnumber=\"$journalnumber14\"", $dbh);
		}
	}

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - Modified explanation to:$explanation11 of J.V. No.:$journalnumber, date:$jvdate";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
  }
	// echo "<p>vartest $adminlogdetails</p>";

  header("Location: finvouchjvnew.php?loginid=$loginid&jvn=$journalnumber&jvdate=$jvdate");
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
