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
	$result11 = mysql_query("SELECT payee FROM tblfindisbursement WHERE disbursementnumber=\"$cvnumber\" AND date=\"$cvdate\"", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$payee11 = $myrow11[0];
		}
	}

  echo "<table class=\"fin\" border=\"1\">";
  echo "<tr><th colspan=\"2\">Check Voucher - modify date</th></tr>";
	echo "<form action=\"finvouchcvchgdate2.php?loginid=$loginid&cvn=$cvnumber&cvdt=$cvdate\" method=\"post\" name=\"form1\">";
	echo "<tr><th align=\"right\">Date</th><td><input name=\"cvdate\" value=\"$cvdate\">";
	?>
  	<a href="javascript:show_calendar('document.form1.cvdate', document.form1.cvdate.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  <?php
	echo "</td></tr>";
	echo "<tr><th align=\"right\">Voucher no.</th><td><b>$cvnumber</b></td></tr>";
	echo "<tr><th align=\"right\">Payee</th><td><b>$payee11</b></td></tr>";
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
