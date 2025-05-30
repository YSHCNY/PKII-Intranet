<?php 

include("db1.php");
include("datetimenow.php");

// $loginid = $_GET['loginid'];
$loginid=1;
$found = 1;

$hosttype1 = "server";
$hosttype2 = "others";

$found11 = 0;
$count11 = 0;
$result = 0;
$statusdown = "";
$status = "";
$remarks = "";


if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{

// start contents here...

	$res11select="SELECT sysadpingid, hostname, ipaddress, description, type FROM tblsysadping WHERE type=\"$hosttype1\" OR type=\"$hosttype2\" ORDER BY ipaddress ASC";
	$result11=""; $found11=0; $ctr11=0;
  $result11 = mysql_query("$res11select", $dbh);
	if($result11 != "") {
	  while ($myrow11 = mysql_fetch_row($result11)) {
    $found11 = 1;
    $count11 = $count11 + 1;
		$sysadpingid11 = $myrow11[0];
    $hostname11 = $myrow11[1];
		$ipaddress11 = $myrow11[2];
    $description11 = $myrow11[3];
		$type11 = $myrow11[4];

		// execute command
    $command = "ping -c2 $ipaddress11";
    exec($command,$result,$rval);

    if(count($result) <= 0) {
      // echo "<td><font color=red>Sorry no response from server</font></td>";
      exit;
    }

    for ($i = 0; $i < count($result); $i++) {
      $regs = array();
      if(ereg("Unreachable", "$result[$i]",$regs)) {
				$statusdown = "DOWN";
      }
    }

	if($statusdown == "DOWN") { $status="DOWN"; } else { $status="UP"; }

	// send email notification if status is down
	if($status == "down") {
		$from = "noreply@philkoei.com.ph";
		$to = "support@philkoei.com.ph";
		$subject = "PKII Network Device > down";
		$message = "Warning: on $now the intranet server has detected that $hostname11 with ip:$ipaddress11 is DOWN";
		$remarks =  $message;

		$ok = mail("$to", "$subject", "$message", "From: $from");
	}

	$res12select = "INSERT INTO tblsysadpingres SET timestamp=\"$now\", loginid=$loginid, hostname=\"$hostname11\", ipaddress=\"$ipaddress11\", type=\"$type11\", status=\"$status\", remarks=\"$remarks\", idsysadping=$sysadpingid11";
	$result12="";
	$result12 = mysql_query("$res12select", $dbh);

	// echo "<td>$res12select</td>";
	// reset variables
	$statusdown=""; $res12select=""; $status=""; $ok=""; $result=""; $remarks="";

		}
  }

// end contents here...


     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
