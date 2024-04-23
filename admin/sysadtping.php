<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$hosttype = $_POST['hosttype'];

$found = 0;
$found11 = 0;
$count11 = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Tools >> SysAd Tools >> Ping Hosts</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=7><font color=white><b>Ping Hosts</b></font></td></tr>";

// start contents here...

  echo "<tr><td bgcolor=\"yellow\"><i>Count</i></td><td bgcolor=\"yellow\"><i>HostName</i></td><td bgcolor=\"yellow\"><i>IP Address</i></td><td bgcolor=\"yellow\"><i>Type</i></td><td bgcolor=\"yellow\"><i>Description</i></td><td bgcolor=\"yellow\"><i>Status</i></td></tr>";

  $result11 = mysql_query("SELECT sysadpingid, hostname, ipaddress, description, type FROM tblsysadping WHERE type = '$hosttype' ORDER BY ipaddress ASC", $dbh);
  while ($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $count11 = $count11 + 1;
    $ipaddress11 = '';
    $result = 0;
		$statusdown = "";

		$sysadpingid11 = $myrow11[0];
    $hostname11 = $myrow11[1];
    $ipaddress11 = $myrow11[2];
    $description11 = $myrow11[3];
    $type11 = $myrow11[4];

    echo "<tr><td>$count11</td><td>$hostname11</td><td>$ipaddress11</td><td>$description11</td><td>$type11</td>";

    $command = "ping -c2 $ipaddress11";
    exec($command,$result,$rval);

    if(count($result) <= 0)
    {
      echo "<td><font color=red>Sorry no response from server</font></td>";
      exit;
    }

    echo "<td>";
    for ($i = 0; $i < count($result); $i++)
    {
      $regs = array();
      if(ereg("Unreachable", "$result[$i]",$regs))
      {
				$statusdown = "down";
        echo "<font color=red>Inactive</font><br>";
      }
      else
      {
        echo "<font color=green>$result[$i]</font><br>";
      }
    }
		echo "</td>";

	if($statusdown == "down") { $status="down"; } else { $status="up"; }

	$res12select = "INSERT INTO tblsysadpingres SET timestamp=\"$now\", loginid=$loginid, hostname=\"$hostname11\", ipaddress=\"$ipaddress11\", type=\"$type11\" status=\"$status\", idsysadping=$sysadpingid11";
	$result12="";
	$result12 = mysql_query("$res12select", $dbh);

	// echo "<td>$res12select</td>";
	// reset variables
	$statusdown=""; $res12select="";

    echo "</tr>";

  }

// end contents here...

     echo "</table></td></tr></table>";

// edit body-footer
     echo "<p><a href=sysadtools.php?loginid=$loginid>Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
