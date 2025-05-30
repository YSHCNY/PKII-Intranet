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

  echo "<tr><th colspan=\"8\">Working Paper Account Codes</th></tr>";

// start contents here...

  echo "<tr><td colspan=\"8\">Displaying Chart of Accts Ver.<b>$ver</b></td></tr>";

  echo "<tr><form action=\"mngfinwprefadd.php?loginid=$loginid&ver=$ver\" method=\"post\">";
  echo "<td colspan=\"8\" align=\"center\"><input type=\"submit\" value=\"Add new\"></td></form></tr>";

  echo "<tr><td colspan=\"8\" align=\"center\">";
  echo "<table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><th>Count</th><th>WPAcctCode</th><th>WPAcctName</th><th>SeqOrder</th><th>GLCode</th><th>GLName</th><th>Ver</th><th>Status</th><th colspan=\"2\">Action</th></tr>";
  $result12=""; $found12=0;
  $result12 = mysql_query("SELECT wprefid, wpacctcd, wpacctname, glcode, glrefver, seq, status FROM tblfinworkpaperref WHERE glrefver=$ver ORDER BY seq ASC, wpacctcd ASC, glcode ASC", $dbh);
  if($result12 != '')
  {
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $wprefid12 = $myrow12[0];
      $wpacctcd12 = $myrow12[1];
      $wpacctname12 = $myrow12[2];
      $glcode12 = $myrow12[3];
      $glrefver12 = $myrow12[4];
      $seq12 = $myrow12[5];
      $status12 = $myrow12[6];

      $count1 = $count1 + 1;

      $result14 = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode12\" AND version=$ver", $dbh);
      if($result14 != '')
      {
	while($myrow14 = mysql_fetch_row($result14))
	{
	  $found14 = 1;
	  $glname14 = $myrow14[0];
	}
      }

      echo "<tr><td>$count1</td><td>$wpacctcd12</td><td>$wpacctname12</td><td>$seq12</td><td>$glcode12</td><td>$glname14</td><td>$glrefver12</td><td>$status12</td>";
      if($accesslevel >= 4 && $accesslevel <= 5)
      {
				echo "<td><a href=\"mngfinwprefedit.php?loginid=$loginid&wpid=$wprefid12\">Edit</a></td>";
        echo "<td><a href=\"mngfinwprefdel.php?loginid=$loginid&wpid=$wprefid12\">Del</a></td></tr>";
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
