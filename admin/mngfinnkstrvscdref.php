<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$nksform = $_POST['nksform'];

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

  echo "<tr><th colspan=\"14\">NK-Stravis Account Codes</th></tr>";

// start contents here...

	if($accesslevel >= 3 && $accesslevel <= 5) {
  echo "<tr><td colspan=\"14\" align=\"center\">";
		echo "<table>";
		echo "<tr>";
		echo "<form action=\"mngfinnkstrvscdref.php?loginid=$loginid\" method=\"post\">";
		echo "<td><select name=\"nksform\">";
		if($nksform == "A") { $nksfrmasel="selected"; $nksfrmbsel=""; $nksfrmallsel=""; }
		else if($nksform == "B") { $nksfrmasel=""; $nksfrmbsel="selected"; $nksfrmallsel=""; }
		else if($nksform == "ALL") { $nksfrmasel=""; $nksfrmbsel=""; $nksfrmallsel="selected"; }
		if($nksform == '') {
		echo "<option value=''>select form</option>";
		}
		echo "<option value=\"A\" $nksfrmasel>Form A</option>";
		echo "<option value=\"B\" $nksfrmbsel>Form B</option>";
		echo "<option value=\"ALL\" $nksfrmallsel>ALL</option>";
		echo "</select>";
		echo "<input type=\"submit\"></td></form>";
		echo "<form action=\"mngfinnkstrvscdrefadd.php?loginid=$loginid\" method=\"post\">";
		echo "<td><input type=\"submit\" value=\"Add new\"></td></form></tr>";
		echo "</table>";
	echo "</td></tr>";
	}

  echo "<tr><td colspan=\"11\" align=\"center\">";
  echo "<table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><th>count</th><th>code</th><th>acctname_j</th><th>acctname_e</th><th>type</th><th>seq</th><th>form-sheet ref</th><th>tabpos</th><th>remarks</th><th colspan=\"2\">action</th></tr>";

  $result11=""; $found11=0; $ctr11=0;
	if($nksform != "") {
		if($nksform == "ALL") {
			$result11 = mysql_query("SELECT finnkgacctrefid, type, code, name_j, name_e, seq, formref, sheetref, tabpos, remarks FROM tblfinnkgacctref ORDER BY finnkgacctrefid ASC", $dbh);
		} else {
			$result11 = mysql_query("SELECT finnkgacctrefid, type, code, name_j, name_e, seq, formref, sheetref, tabpos, remarks FROM tblfinnkgacctref WHERE formref=\"$nksform\" ORDER BY finnkgacctrefid ASC", $dbh);
		}
	}
  if($result11 != '') {
    while($myrow11 = mysql_fetch_row($result11)) {
    $found11 = 1;
		$finnkgacctrefid11 = $myrow11[0];
		$type11 = $myrow11[1];
		$code11 = $myrow11[2];
		$name_j11 = $myrow11[3];
		$name_e11 = $myrow11[4];
		$seq11 = $myrow11[5];
		$formref11 = $myrow11[6];
		$sheetref11 = $myrow11[7];
		$tabpos11 = $myrow11[8];
		$remarks11 = $myrow11[9];

    $ctr11 = $ctr11 + 1;

    echo "<tr><td align=\"right\">$ctr11</td><td>$code11</td>";
		echo "<td>$name_j11</td><td>$name_e11</td><td>$type11</td><td align=\"right\">$seq11</td><td align=\"center\">$formref11-$sheetref11</td><td>$tabpos11</td><td>$remarks11</td>";
    if($accesslevel >= 4 && $accesslevel <= 5) {
			echo "<td><a href=\"mngfinnkstrvscdrefedit.php?loginid=$loginid&nkrid=$finnkgacctrefid11\">Edit</a></td>";
      echo "<td><a href=\"mngfinnkstrvscdrefdel.php?loginid=$loginid&nkrid=$finnkgacctrefid11\">Del</a></td></tr>";
    }
    }
  }
  echo "</table>";

// end contents here...

  echo "</td></tr></table>";

// edit body-footer
     echo "<p><a href=\"mngfinmods.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 