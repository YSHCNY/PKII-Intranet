<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$ver = $_POST['ver'];

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

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

  echo "<tr><th colspan=\"15\">Balance Sheet Account Codes Preparation</th></tr>";

// start contents here...

  echo "<tr><form action=\"mngfinbalshtrefadd.php?loginid=$loginid&ver=$ver\" method=\"post\">";
  echo "<td colspan=\"17\" align=\"center\"><input type=\"submit\" value=\"Add new\"></td></form></tr>";

  echo "<tr><td colspan=\"11\" align=\"center\">";
  echo "<table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><th>Count</th><th>Pos</th><th colspan=\"5\">AcctName</th><th>GLCodeFr</th><th>GLCodeTo</th><th>SeqOrder</th><th>Ver</th><th>Visible</th><th>Section</th><th>Section Total</th><th>Normal Balance</th>";
  if($accesslevel >= 4) {
		echo "<th colspan=\"2\">Action</th>";
	}
	echo "</tr>";
  $result12=""; $found12=0;
  $result12 = mysql_query("SELECT tblfinbalshtref.finbalshtrefid, tblfinbalshtref.tabpos, tblfinbalshtref.acctname, tblfinbalshtref.glcodefr, tblfinbalshtref.glcodeto, tblfinbalshtref.visible, tblfinbalshtref.glrefver, tblfinbalshtref.seq, tblfinbalshtref.section, tblfinbalshtref.sectotal,  tblfinbalshtref.normbal, tblfinbalshtsecref.name FROM tblfinbalshtref INNER JOIN tblfinbalshtsecref ON tblfinbalshtref.section=tblfinbalshtsecref.code WHERE tblfinbalshtref.glrefver=$ver ORDER BY tblfinbalshtref.seq ASC, tblfinbalshtref.glcodefr ASC, tblfinbalshtref.glcodeto ASC", $dbh);
  if($result12 != '')
  {
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $finbalshtrefid12 = $myrow12[0];
			$tabpos12 = $myrow12[1];
			$acctname12 = $myrow12[2];
			$glcodefr12 = $myrow12[3];
			$glcodeto12 = $myrow12[4];
			$visible12 = $myrow12[5];
			$glrefver12 = $myrow12[6];
			$seq12 = $myrow12[7];
			$section12 = $myrow12[8];
			$sectotal12 = $myrow12[9];
			$normbal12 = $myrow12[10];
			$name12 = $myrow12[11];

      $count12 = $count12 + 1;

      echo "<tr><td>$count12</td><td>$tabpos12</td>";
			if($tabpos12 == "1") { echo "<td>$acctname12</td><td colspan=\"4\"></td>"; }
			else if($tabpos12 == "2") { echo "<td></td><td>$acctname12</td><td colspan=\"3\"></td>"; }
			else if($tabpos12 == "3") { echo "<td colspan=\"2\"></td><td>$acctname12</td><td colspan=\"2\"></td>"; }
			else if($tabpos12 == "4") { echo "<td colspan=\"3\"></td><td>$acctname12</td><td></td>"; }
			else if($tabpos12 == "5") { echo "<td colspan=\"4\"></td><td>$acctname12</td>"; }
			echo "<td>$glcodefr12</td><td>$glcodeto12</td><td>$seq12</td><td>$glrefver12</td><td>$visible12</td><td>$name12</td><td>$sectotal12</td><td>$normbal12</td>";
      if($accesslevel >= 4) {
				echo "<td><a href=\"mngfinbalshtrefedit.php?loginid=$loginid&bsid=$finbalshtrefid12\">Edit</a></td>";
        echo "<td><a href=\"mngfinbalshtrefdel.php?loginid=$loginid&bsid=$finbalshtrefid12\">Del</a></td>";
      }
			echo "</tr>";
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