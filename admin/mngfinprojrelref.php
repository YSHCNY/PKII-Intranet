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
  echo "<p><font size=1>Manage >> Accounting Modules >> Project relationships</font></p>";

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

  echo "<tr><th colspan=\"15\">Project Relationships</th></tr>";

// start contents here...

  echo "<tr><form action=\"mngfinprojrelrefadd.php?loginid=$loginid\" method=\"post\">";
  echo "<td colspan=\"15\" align=\"center\"><input type=\"submit\" value=\"Add new\"></td></form></tr>";

  echo "<tr><td colspan=\"11\" align=\"center\">";
  echo "<table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><th>count</th><th>code</th><th colspan=\"4\">name</th><th>companyid</th><th>level</th><th>seq</th><th>nkconso</th><th>codeprev</th><th>Sheet</th><th>remarks</th><th colspan=\"2\">action</th></tr>";
  $result11=""; $found11=0; $ctr11=0;
  $result11 = mysql_query("SELECT projrelrefid, code, name, companyid, level, seq, nkconso, codeprev, remarks, strvssht FROM tblprojrelref ORDER BY seq ASC", $dbh);
  if($result11 != '') {
    while($myrow11 = mysql_fetch_row($result11)) {
    $found11 = 1;
		$projrelrefid11 = $myrow11[0];
		$code11 = $myrow11[1];
		$name11 = $myrow11[2];
		$companyid11 = $myrow11[3];
		$level11 = $myrow11[4];
		$seq11 = $myrow11[5];
		$nkconso11 = $myrow11[6];
		$codeprev11 = $myrow11[7];
		$remarks11 = $myrow11[8];
		$strvssht11 = $myrow11[9];

    $ctr11 = $ctr11 + 1;

    echo "<tr><td>$ctr11</td><td>$code11</td>";
		if($level11==0) { echo "<td>$name11</td><td></td><td></td><td></td>"; }
		else if($level11==1) { echo "<td></td><td>$name11</td><td></td><td></td>"; }
		else if($level11==2) { echo "<td></td><td></td><td>$name11</td><td></td>"; }
		else if($level11==3) { echo "<td></td><td></td><td></td><td>$name11</td>"; }
		echo "<td>$companyid11</td><td>$level11</td><td>$seq11</td><td>$nkconso11</td><td>$codeprev11</td><td>$strvssht11</t><td>$remarks11</td>";
    if($accesslevel >= 4 && $accesslevel <= 5) {
			echo "<td><a href=\"mngfinprojrelrefedit.php?loginid=$loginid&prrid=$projrelrefid11\">Edit</a></td>";
      echo "<td><a href=\"mngfinprojrelrefdel.php?loginid=$loginid&prrid=$projrelrefid11\">Del</a></td></tr>";
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
