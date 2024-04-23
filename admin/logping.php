<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$pagenum = $_GET['page'];

$found = 0;

$reccount = 0;
$pagerecstart = 0;
$rowsperpage = 50;

if($loginid != "")
{
    include("logincheck.php");
}

if ($found == 1)
{
    include ("header.php");
    include ("sidebar.php");

    if($pagenum == "")
    {
      $pagenum = 0;
      $pagerecstart = 0;
    }
    else
    {
      $pagerecstart = ($pagenum) * $rowsperpage;
    }

    echo "<p><font size=1>Tools >> View logs</font></p>";

    echo "<table border=1 class=\"fin\" spacing=0 cellspacing=0 cellpadding=0>";
    echo "<tr><th>Networking devices ping logs</th></tr>";

    echo "<tr><td>";
    echo "<table width=\"100%\" class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>id</td><td>stamp</td><td>hostname</td><td>ip</td><td>status</td><td>downspeed</td><td>upspeed</td><td>remarks</td></tr>";
      $result11 = mysql_query("SELECT idsysadpingres, timestamp, hostname, ipaddress, status, bwdownspeed, bwupspeed, remarks FROM tblsysadpingres ORDER BY timestamp DESC LIMIT $pagerecstart, $rowsperpage", $dbh);
      while($myrow11 = mysql_fetch_row($result11))
      {
	$found11 = 1;
	$idsysadpingres11 = $myrow11[0];
	$timestamp11 = $myrow11[1];
	$hostname11 = $myrow11[2];
	$ipaddress11 = $myrow11[3];
	$status11 = $myrow11[4];
	$bwdownspeed11 = $myrow11[5];
	$bwupspeed11 = $myrow11[6];
	$remarks11 = $myrow11[7];
	
	echo "<tr><td align=\"center\">$idsysadpingres11</td><td>$timestamp11</td><td>$hostname11</td><td>$ipaddress11</td>";
	echo "<td>";
	if($status11 == "down") { echo "<font color=\"red\">$status11</font>"; } else { echo "<font color=\"green\">$status11</font>"; }
	echo "</td>";
	echo "<td>$bwdownspeed11</td><td>$bwupspeed11</td><td>$remarks11</td>";
	echo "</tr>";
      }

    $pagenum0 = $pagenum - 1;
    $pagenum2 = $pagenum + 1;

    echo "<tr><td colspan=\"8\" align=\"right\">";
    if ($pagenum0 < 0) { echo "&nbsp;"; } else {
    echo "<a href=\"logping.php?loginid=$loginid&page=$pagenum0\">Back | </a>"; }

    $result22 = mysql_query("SELECT idsysadpingres FROM tblsysadpingres ORDER BY idsysadpingres DESC LIMIT 0, 1", $dbh);
    while ($myrow22 = mysql_fetch_row($result22))
    {
      $found22 = 1;
      $maxlogid = $myrow22[0];
    }

    $reccounttot = $pagerecstart + $rowsperpage;

    echo "&nbsp;<b>$pagenum2</b>&nbsp;";

    if ($reccounttot >= $maxlogid)
    {
      echo "&nbsp;";
    }
    else
    {
      echo "<a href=\"logping.php?loginid=$loginid&page=$pagenum2\"> | Next</a>";
    }
    echo "</td></tr>";

    echo "</table>";
    echo "</td></tr>"; 
    echo "</table>";

    echo "<p><a href=\"logs.php?loginid=$loginid\">Back</a></p>";

    $result = mysql_query("UPDATE tbllogin SET login_stat=1 WHERE loginid=$loginid", $dbh); 
  
    include ("footer.php");
}
else
{
    include ("logindeny.php");
}

mysql_close($dbh);

?> 
