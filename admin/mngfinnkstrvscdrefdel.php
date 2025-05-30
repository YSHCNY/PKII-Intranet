<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$finnkgacctrefid = $_GET['nkrid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// edit body-header
  echo "<p><font size=1>Modules >> Vouchsers >> Manage NK-Stravis Form-A >> Delete item</font></p>";

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

  echo "<tr><th colspan=\"2\">Manage NK-Stravis Account Code - Delete item</th></tr>";

// start contents here...

	$result10=""; $found10=0;
	$result10 = mysql_query("SELECT type, code, name_j, name_e, seq, formref, sheetref, tabpos, remarks FROM tblfinnkgacctref WHERE finnkgacctrefid=$finnkgacctrefid", $dbh);
	if($result10 != "") {
		while($myrow10 = mysql_fetch_row($result10)) {
		$found10 = 1;
		$type10 = $myrow10[0];
		$code10 = $myrow10[1];
		$name_j10 = $myrow10[2];
		$name_e10 = $myrow10[3];
		$seq10 = $myrow10[4];
		$formref10 = $myrow10[5];
		$sheetref10 = $myrow10[6];
		$tabpos10 = $myrow10[7];
		$remarks10 = $myrow10[8];
		}
	}

	echo "<tr><th colspan=\"2\">Deleting Form-A item<br><font color=\"red\"><b>Are you sure?</b></font></th></tr>";
	echo "<tr><td colspan=\"2\">Code:$code10<br>Name:$name_j10 $name_e10<br>formsheet:$formref10-$sheetref10</td></tr>";
	echo "<tr><form action=\"mngfinnkstrvscdrefdel2.php?loginid=$loginid&nkrid=$finnkgacctrefid\" method=\"post\" name=\"mngfinnkstrvscdrefdel2\">";
	echo "<td align=\"center\"><input type=\"submit\" value=\"Yes\"></td></form>";
	echo "<form action=\"mngfinnkstrvscdref.php?loginid=$loginid\" method=\"post\" name=\"mngfinnkstrvscdref\">";
	echo "<td align=\"center\"><input type=\"submit\" value=\"No\"></td></form></tr>";

// end contents here...

  echo "</table>";

// edit body-footer
     // echo "<p><a href=\"finstrvsamng.php?loginid=$loginid&yravlbl=$yravlbl&qtravlbl=$qtravlbl&projrelref=$projrelrefcd10\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
