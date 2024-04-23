<?php 

include("db1.php");

$loginid = $_GET['loginid'];

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

  echo "<tr><th colspan=\"6\">GAE (NK) Ref Codes</th></tr>";

// start contents here...

  echo "<tr><form action=\"mngfinnkgaecdrefadd.php?loginid=$loginid\" method=\"post\">";
  echo "<td colspan=\"6\" align=\"center\"><input type=\"submit\" value=\"Add new\"></td></form></tr>";

  echo "<tr><td colspan=\"6\" align=\"center\">";
  echo "<table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><th>Count</th><th>NK_GAE_AcctCode</th><th>NK_GAE_AcctName</th><th>SeqOrder</th><th colspan=\"2\">Action</th></tr>";
  $result12=""; $found12=0; $ctr12=0;
  $result12 = mysql_query("SELECT idgaenkref, gaenkcd, gaenkacctname, seq FROM tblfingaenkref ORDER BY seq ASC", $dbh);
  if($result12 != '') {
    while($myrow12 = mysql_fetch_row($result12)) {
      $found12 = 1;
			$idgaenkref12 = $myrow12[0];
			$gaenkcd12 = $myrow12[1];
			$gaenkacctname12 = $myrow12[2];
			$seq12 = $myrow12[3];

      $ctr12 = $ctr12 + 1;

      echo "<tr><td align=\"right\">$ctr12</td><td>$gaenkcd12</td><td>$gaenkacctname12</td><td align=\"right\">$seq12</td>";
			// echo "<td>$remarks12</td>";
      if($accesslevel >= 4 && $accesslevel <= 5)
      {
				echo "<td><a href=\"mngfinnkgaecdrefedit.php?loginid=$loginid&ngid=$idgaenkref12\">Edit</a></td>";
        echo "<td><a href=\"mngfinnkgaecdrefdel.php?loginid=$loginid&ngid=$idgaenkref12\">Del</a></td></tr>";
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
