<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$ver = $_GET['ver'];

if ($ver == '')
{
  $result10 = mysql_query("SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"", $dbh);
  if($result10 != '')
  {
    while($myrow10 = mysql_fetch_row($result10))
    {
      $found10 = 1;
      $version10 = $myrow10[0];
    }
  }
  $ver = $version10;
}

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

  echo "<tr><th colspan=\"2\">Balance Sheet Account Codes - add new</th></tr>";

  echo "<form action=\"mngfinbalshtrefadd2.php?loginid=$loginid&ver=$ver\" method=\"post\">";

  echo "<tr><th align=\"right\">Tab position</th><td>";
	// echo "<input name=\"tabpos\" size=\"1\">";
	echo "<select name=\"tabpos\">";
	echo "<option value=\"1\">1</option>";
	echo "<option value=\"2\">2</option>";
	echo "<option value=\"3\">3</option>";
	echo "<option value=\"4\">4</option>";
	echo "<option value=\"5\">5</option>";
	echo "</select>";
	echo "</td></tr>";
  echo "<tr><th align=\"right\">Acct name</th><td><input name=\"acctname\" size=\"50\"></td></tr>";

  // get next sequence number first and display
  $found15=0; $result15=""; $seq15="";
  $result15 = mysql_query("SELECT seq FROM tblfinbalshtref ORDER BY seq ASC", $dbh);
  if($result15 != "") {
    while($myrow15 = mysql_fetch_row($result15)) {
    $found15 = 1;
    $seq15 = $myrow15[0];
    }
  }
  if($seq15 != "") { $seqfin=$seq15+10; } else { $seqfin=10; }
  echo "<tr><th align=\"right\">Sequence order</th><td><input name=\"seq\" type=\"number\" min=\"01\" max=\"2000\" value=\"$seqfin\" size=\"5\"></td></tr>";

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
      echo "<option value=\"$glcode11\">$glcode11 - $glname11</option>";
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
      echo "<option value=\"$glcode12\">$glcode12 - $glname12</option>";
    }
  }
  echo "</select><br><font size=\"1\"><i>Note: if the account name has only 1 GL code, please input same GL Codes on both fields</i></font></td></tr>";

	echo "<tr><th align=\"right\">Section</th><td>";
	echo "<select name=\"section\">";
	$result14=""; $found14=0;
	$result14 = mysql_query("SELECT code, name FROM tblfinbalshtsecref ORDER BY code ASC", $dbh);
	if($result14 != "") {
		while($myrow14 = mysql_fetch_row($result14)) {
		$found14 = 1;
		$code14 = $myrow14[0];
		$name14 = $myrow14[1];
		echo "<option value=\"$code14\">$name14</option>";
		}
	}
	echo "</select>";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">normal balance</th><td>";
	echo "<select name=\"normbal\">";
	echo "<option value=\"dr\" selected>debit</option>";
	echo "<option value=\"cr\">credit</option>";
	echo "</select>";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">Section Total</th><td>";
	echo "<select name=\"sectotal\">";
	echo "<option value=\"0\" selected>Off</option>";
	echo "<option value=\"1\">On</option>";
	echo "</select>";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">visible</th><td>";
	echo "<input type=\"checkbox\" name=\"visible\">";
	echo "</td></tr>";

  echo "<input type=\"hidden\" name=\"glrefver\" value=\"$ver\">";
  echo "<td align=\"center\" colspan=\"2\"><input type=\"submit\" value=\"Add\"></td></form></tr>";

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
