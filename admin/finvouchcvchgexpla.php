<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$cvnumber = $_GET['cvn'];
$cvdate = $_GET['cvdt'];

$found = 0;

if($loginid != "")
{
	include("logincheck.php");
}
?>

<script language="JavaScript" src="ts_picker.js"></script>  

<?php
if ($found == 1)
{
	include ("header.php");
  include ("sidebar.php");

// start contents here

	$result11=""; $found11=0;
	$result11 = mysql_query("SELECT payee, explanation FROM tblfindisbursement WHERE disbursementnumber=\"$cvnumber\" AND date=\"$cvdate\"", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$payee11 = $myrow11[0];
		$explanation11 = $myrow11[1];
		}
	}

	if($explanation11 == "") {
		// get explanation from tblfindisbursementtot table
		$result12=""; $found12=0;
		$result12 = mysql_query("SELECT explanation FROM tblfindisbursementtot WHERE disbursementnumber=\"$cvnumber\"", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
			$found12=1;
			$explanation12 = $myrow12[0];
			}
		}
	}

	if($explanation12 != "") { $explanationfin=$explanation12; } else if($explanation11 != "") { $explanationfin=$explanation11; }

  echo "<table class=\"fin\" border=\"1\">";
  echo "<tr><th colspan=\"2\">Check Voucher - modify explanation</th></tr>";
	echo "<form action=\"finvouchcvchgexpla2.php?loginid=$loginid&cvn=$cvnumber&cvdt=$cvdate\" method=\"post\" name=\"form1\">";
	echo "<tr><th align=\"right\">Date</th><td><b>$cvdate</b></td></tr>";
	echo "<tr><th align=\"right\">Voucher no.</th><td><b>$cvnumber</b></td></tr>";
	echo "<tr><th align=\"right\">Payee</th><td><b>$payee11</b></td></tr>";
	echo "<tr><th align=\"right\">Explanation</th><td><textarea rows=\"4\" cols=\"60\" name=\"explanation\">$explanationfin</textarea></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></td></tr>";
	echo "</form>";
  echo "</table>";

  echo "<p><a href=\"finvouchcvnew.php?loginid=$loginid&cvn=$cvnumber&cvdt=$cvdate\">Back</a></p>";

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>