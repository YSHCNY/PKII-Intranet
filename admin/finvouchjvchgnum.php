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


if ($found == 1)
{
	include ("header.php");
  include ("sidebar.php");

// start contents here

  echo "<table class=\"fin\" border=\"1\">";
  echo "<tr><th colspan=\"2\">Journal Voucher - modify J.V. number</th></tr>";
	echo "<form action=\"finvouchjvchgnum2.php?loginid=$loginid&jvn=$jvnumber&jvdt=$jvdate\" method=\"post\" name=\"form1\">";
	echo "<tr><th align=\"right\">Date</th><td>$jvdate</td></tr>";
	echo "<tr><th align=\"right\">J.V. no.</th><td><input name=\"jvnumber\" value=\"$jvnumber\"></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></td></tr>";
	echo "</form>";
  echo "</table>";

  echo "<p><a href=\"finvouchjvnew.php?loginid=$loginid&jvn=$jvnumber&jvdt=$jvdate\">Back</a></p>";

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
