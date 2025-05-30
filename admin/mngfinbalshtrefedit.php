<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$finbalshtrefid = $_GET['bsid'];

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
  echo "<p><font size=1>Manage >> Accounting Modules</font></p>";

// start contents here...

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

  echo "<tr><th colspan=\"2\">Balance Sheet Account Codes - edit</th></tr>";

  echo "<form action=\"mngfinbalshtrefedit2.php?loginid=$loginid&bsid=$finbalshtrefid\" method=\"post\">";

	$result10=""; $found10=0;
	$result10 = mysql_query("SELECT tabpos, acctname, glcodefr, glcodeto, glrefver, seq, visible, section, normbal, sectotal, remarks FROM tblfinbalshtref WHERE finbalshtrefid=$finbalshtrefid", $dbh);
	if($result10 != "") {
		while($myrow10 = mysql_fetch_row($result10)) {
		$found10=1;
		$tabpos10 = $myrow10[0];
		$acctname10 = $myrow10[1];
		$glcodefr10 = $myrow10[2];
		$glcodeto10 = $myrow10[3];
		$glrefver10 = $myrow10[4];
		$seq10 = $myrow10[5];
		$visible10 = $myrow10[6];
		$section10 = $myrow10[7];
		$normbal10 = $myrow10[8];
		$sectotal10 = $myrow10[9];
		$remarks10 = $myrow10[10];
		$ver = $glrefver10;
		}
	}

  echo "<tr><th align=\"right\">Tab position</th><td>";
	if($tabpos10 == 1) { $tabpos1sel="selected"; $tabpos2sel=""; $tabpos3sel=""; $tabpos4sel=""; $tabpos5sel=""; }
	else if($tabpos10 == 2) { $tabpos1sel=""; $tabpos2sel="selected"; $tabpos3sel=""; $tabpos4sel=""; $tabpos5sel=""; }
	else if($tabpos10 == 3) { $tabpos1sel=""; $tabpos2sel=""; $tabpos3sel="selected"; $tabpos4sel=""; $tabpos5sel=""; }
	else if($tabpos10 == 4) { $tabpos1sel=""; $tabpos2sel=""; $tabpos3sel=""; $tabpos4sel="selected"; $tabpos5sel=""; }
	else if($tabpos10 == 5) { $tabpos1sel=""; $tabpos2sel=""; $tabpos3sel=""; $tabpos4sel=""; $tabpos5sel="selected"; }
	echo "<select name=\"tabpos\">";
	echo "<option value=\"1\" $tabpos1sel>1</option>";
	echo "<option value=\"2\" $tabpos2sel>2</option>";
	echo "<option value=\"3\" $tabpos3sel>3</option>";
	echo "<option value=\"4\" $tabpos4sel>4</option>";
	echo "<option value=\"5\" $tabpos5sel>5</option>";
	echo "</select>";
	echo "</td></tr>";
  echo "<tr><th align=\"right\">Acct name</th><td><input name=\"acctname\" size=\"50\" value=\"$acctname10\"></td></tr>";

  echo "<tr><th align=\"right\">Sequence order</th><td><input name=\"seq\" type=\"number\" min=\"01\" max=\"2000\" value=\"$seq10\" size=\"5\"></td></tr>";

  echo "<tr><th align=\"right\">GL Code from</th><td>";
  echo "<select name=\"glcodefr\">";
	echo "<option value=''>-</option>";
  $result11 = mysql_query("SELECT tblfinglref.glrefid, tblfinglref.glcode, tblfinglref.glname FROM tblfinglref LEFT JOIN tblfinworkpaperref ON tblfinglref.glcode = tblfinworkpaperref.glcode WHERE tblfinglref.version=$ver ORDER BY tblfinglref.glcode ASC", $dbh);
  if($result11 != '')
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $glrefid11 = $myrow11[0];
      $glcode11 = $myrow11[1];
      $glname11 = $myrow11[2];
			if($glcodefr10 == $glcode11) { $glcodefrsel="selected"; } else { $glcodefrsel=""; }
      echo "<option value=\"$glcode11\" $glcodefrsel>$glcode11 - $glname11</option>";
    }
  }
  echo "</select><br><font size=\"1\"><i>Note: if the account name has only 1 GL code, please input same GL Codes on both fields</i></font></td></tr>";

  echo "<tr><th align=\"right\">GL Code to</th><td>";
  echo "<select name=\"glcodeto\">";
	echo "<option value=''>-</option>";
  $result12 = mysql_query("SELECT tblfinglref.glrefid, tblfinglref.glcode, tblfinglref.glname FROM tblfinglref LEFT JOIN tblfinworkpaperref ON tblfinglref.glcode = tblfinworkpaperref.glcode WHERE tblfinglref.version=$ver ORDER BY tblfinglref.glcode ASC", $dbh);
  if($result12 != '')
  {
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $glrefid12 = $myrow12[0];
      $glcode12 = $myrow12[1];
      $glname12 = $myrow12[2];
			if($glcodeto10 == $glcode12) { $glcodetosel="selected"; } else { $glcodetosel=""; }
      echo "<option value=\"$glcode12\" $glcodetosel>$glcode12 - $glname12</option>";
    }
  }
  echo "</select><br><font size=\"1\"><i>Note: if the account name has only 1 GL code, please input same GL Codes on both fields</i></font></td></tr>";

	echo "<tr><th align=\"right\">section</th><td>";
	echo "<select name=\"section\">";
	$result14=""; $found14=0;
	$result14 = mysql_query("SELECT code, name FROM tblfinbalshtsecref ORDER BY code ASC", $dbh);
	if($result14 != "") {
		while($myrow14 = mysql_fetch_row($result14)) {
		$found14 = 1;
		$code14 = $myrow14[0];
		$name14 = $myrow14[1];
		if($name14 == $section10) { $sectionsel="selected"; } else { $sectionsel=""; }
		echo "<option value=\"$code14\" $sectionsel>$name14</option>";
		}
	}
	echo "</select>";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">normal balance</th><td>";
	if($normbal10 == "dr") { $normbaldrsel="selected"; $normbalcrsel=""; }
	else if($normbal10 == "cr") { $normbaldrsel=""; $normbalcrsel="selected"; }
	else { $normbaldrsel="selected"; $normbalcrsel=""; }
	echo "<select name=\"normbal\">";
	echo "<option value=\"dr\" $normbaldrsel>debit</option>";
	echo "<option value=\"cr\" $normbalcrsel>credit</option>";
	echo "</select>";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">section total</th><td>";
	echo "<select name=\"sectotal\">";
	if($sectotal10 == 0) { $sectot0sel="selected"; $sectot1sel=""; }
	else if($sectotal10 == 1) { $sectot0sel=""; $sectot1sel="selected"; }
	echo "<option value=\"0\" $sectot0sel>Off</option>";
	echo "<option value=\"1\" $sectot1sel>On</option>";
	echo "</select>";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">visible</th><td>";
	if($visible10=="on") { $visiblechk="checked"; } else { $visiblechk=""; }
	echo "<input type=\"checkbox\" name=\"visible\" $visiblechk>";
	echo "</td></tr>";

  echo "<input type=\"hidden\" name=\"glrefver\" value=\"$ver\">";
  echo "<td align=\"center\" colspan=\"2\"><input type=\"submit\"></td></form></tr>";

  echo "</table>";

// end contents here...


// edit body-footer
     echo "<p><a href=\"mngfinbalshtref.php?loginid=$loginid&ver=$ver\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
