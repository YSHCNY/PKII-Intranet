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
	$result11 = mysql_query("SELECT payor, explanation FROM tblfincashreceipt WHERE cashreceiptnumber=\"$crvnumber\" AND date=\"$crvdate\"", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$payor11 = $myrow11[0];
		$explanation11 = $myrow11[1];
		}
	}

  echo "<table class=\"fin\" border=\"1\">";
  echo "<tr><th colspan=\"2\">Cash Receipt - modify explanation</th></tr>";
	echo "<form action=\"finvouchcrvchgexpla2.php?loginid=$loginid&crvn=$crvnumber&crvdt=$crvdate\" method=\"post\" name=\"form1\">";
	echo "<tr><th align=\"right\">Date</th><td><b>$crvdate</b></td></tr>";
	echo "<tr><th align=\"right\">C.R.V. no.</th><td><b>$crvnumber</b></td></tr>";
	echo "<tr><th align=\"right\">Received by</th><td><b>$payor11</b></td></tr>";
	echo "<tr><th align=\"right\">Explanation</th><td><textarea rows=\"4\" cols=\"60\" name=\"explanation\">$explanation11</textarea></td></tr>";
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
