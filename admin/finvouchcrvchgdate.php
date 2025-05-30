<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$crvnumber = $_GET['crvn'];
$crvdate = $_GET['crvdt'];

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
	$result11 = mysql_query("SELECT payor FROM tblfincashreceipt WHERE cashreceiptnumber=\"$crvnumber\" AND date=\"$crvdate\"", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$payor11 = $myrow11[0];
		}
	}

  echo "<table class=\"fin\" border=\"1\">";
  echo "<tr><th colspan=\"2\">Cash Receipt - modify date</th></tr>";
	echo "<form action=\"finvouchcrvchgdate2.php?loginid=$loginid&crvn=$crvnumber&crvdt=$crvdate\" method=\"post\" name=\"form1\">";
	echo "<tr><th align=\"right\">Date</th><td><input name=\"crvdate\" value=\"$crvdate\">";
	?>
  	<a href="javascript:show_calendar('document.form1.crvdate', document.form1.crvdate.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  <?php
	echo "</td></tr>";
	echo "<tr><th align=\"right\">Cash Receipt No.</th><td><b>$crvnumber</b></td></tr>";
	echo "<tr><th align=\"right\">Received by</th><td><b>$payor11</b></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></td></tr>";
	echo "</form>";
  echo "</table>";

  echo "<p><a href=\"finvouchcrvnew.php?loginid=$loginid&crvn=$crvnumber&crvdt=$crvdate\">Back</a></p>";

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
