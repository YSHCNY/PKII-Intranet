<?php 

include("db1.php");

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
  echo "<p><font size=1>Manage >> Accounting Modules >> NK-Stravis Acct Codes</font></p>";

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

  echo "<tr><th colspan=\"2\">NK-Stravis Account Codes - Edit</th></tr>";

// start contents here...

	$result11=""; $found11=0; $ctr11=0;
	$result11 = mysql_query("SELECT type, code, name_j, name_e, seq, formref, sheetref, tabpos, remarks FROM tblfinnkgacctref WHERE finnkgacctrefid=$finnkgacctrefid", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$type11 = $myrow11[0];
		$code11 = $myrow11[1];
		$name_j11 = $myrow11[2];
		$name_e11 = $myrow11[3];
		$seq11 = $myrow11[4];
		$formref11 = $myrow11[5];
		$sheetref11 = $myrow11[6];
		$tabpos11 = $myrow11[7];
		$remarks11 = $myrow11[8];
		}
	}

  echo "<form action=\"mngfinnkstrvscdrefedit2.php?loginid=$loginid&nkrid=$finnkgacctrefid\" method=\"post\">";
	echo "<tr><th align=\"right\">type</th><td><input name=\"nkstrvstype\" size=\"1\" value=\"$type11\"><i>{A;B;C;0;1;2}</i></td></tr>";
	echo "<tr><th align=\"right\">code</th><td><input name=\"nkstrvscode\" size=\"6\" value=\"$code11\"></td></tr>";
	echo "<tr><th align=\"right\">acct_name(j)</th><td><input name=\"nkstrvsnamej\" value=\"$name_j11\"></td></tr>";
	echo "<tr><th align=\"right\">acct_name(e)</th><td><input name=\"nkstrvsnamee\" value=\"$name_e11\"></td></tr>";
	echo "<tr><th align=\"right\">tab_position</th><td><input type=\"number\" name=\"nkstrvstabpos\" value=\"$tabpos11\"><i>default:1</i></td></tr>";
	echo "<tr><th align=\"right\">sequence</th><td><input type=\"number\" name=\"nkstrvsseq\" size=\"4\" value=\"$seq11\"></td></tr>";
	echo "<tr><th align=\"right\">form</th><td>";
	if($formref11 != "") {
		if($formref11 == "A") { $formrefasel="selected"; $formrefbsel=""; $formrefcsel=""; }
		else if($formref11 == "B") { $formrefasel=""; $formrefbsel="selected"; $formrefcsel=""; }
		else if($formref11 == "C") { $formrefasel=""; $formrefbsel=""; $formrefcsel="selected"; }
	}
	echo "<select name=\"nkstrvsformref\">";
	echo "<option value=\"A\" $formrefasel>A</option>";
	echo "<option value=\"B\" $formrefbsel>B</option>";
	echo "<option value=\"C\" $formrefcsel>C</option>";
	echo "</select>";
	echo "</td></tr>";
	echo "<tr><th align=\"right\">sheet</th><td><input name=\"nkstrvssheetref\" size=\"3\" value=\"$sheetref11\"><br><i>{FormA:K or FormB:BS1-BS2,PL,SS,CF1-CF4 or FormC:C}</i></td></tr>";
	echo "<tr><th align=\"right\">remarks</th><td><textarea name=\"nkstrvsremarks\" rows=\"3\" cols=\"30\">$remarks11</textarea></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></td></tr>";
  echo "</form>";


// end contents here...

  echo "</table>";

// edit body-footer
     echo "<p><a href=\"mngfinnkstrvscdref.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 