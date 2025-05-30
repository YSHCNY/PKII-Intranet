<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$jvnumber = $_GET['jvn'];
$jvdate = $_GET['jvdt'];

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

  echo "<table class=\"fin\" border=\"1\">";
  echo "<tr><th colspan=\"2\">Journal Voucher - modify date</th></tr>";
	echo "<form action=\"finvouchjvchgdate2.php?loginid=$loginid&jvn=$jvnumber&jvdt=$jvdate\" method=\"post\" name=\"form1\">";
	echo "<tr><th align=\"right\">Date</th><td><input name=\"jvdate\" value=\"$jvdate\">";
	?>
  	<a href="javascript:show_calendar('document.form1.jvdate', document.form1.jvdate.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  <?php
	echo "</td></tr>";
	echo "<tr><th align=\"right\">Journal Voucher No.</th><td><b>$jvnumber</b></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></td></tr>";
	echo "</form>";
  echo "</table>";

  echo "<p><a href=\"finvouchcrvnew.php?loginid=$loginid&jvn=$jvnumber&jvdt=$jvdate\">Back</a></p>";

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
