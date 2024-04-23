<?php

include("db1.php");
include("datetimenow.php");

$loginid = 1;

$found = 1;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

// start contents here...

	// prepare router ip addresses
	$ipaddr1 = "192.168.0.1";
	$ipaddr2 = "192.168.0.2";
	$ipaddr3 = "192.168.0.3";
	$ipaddr200 = "192.168.0.200";

	$message = "================= WAN devices =================";

	// generate WAN logs
	$res11query="SELECT tblsysadping.ipaddress, tblsysadping.hostname, 
  (SELECT tblsysadpingres.timestamp
   FROM tblsysadpingres
   WHERE tblsysadpingres.ipaddress = tblsysadping.ipaddress
   ORDER BY tblsysadpingres.timestamp DESC
   LIMIT 1
  ) AS Latest_Action, 
	(SELECT tblsysadpingres.status
	FROM tblsysadpingres
	WHERE tblsysadpingres.ipaddress = tblsysadping.ipaddress
	ORDER BY tblsysadpingres.timestamp DESC
   LIMIT 1
  ) AS Latest_Result
FROM tblsysadping
WHERE tblsysadping.type='router'
GROUP BY tblsysadping.ipaddress
HAVING Latest_Action IS NOT NULL
ORDER BY tblsysadping.ipaddress ASC";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$ipaddress11 = $myrow11['ipaddress'];
		$hostname11 = $myrow11['hostname'];
		$timestamp11 = $myrow11['Latest_Action'];
		$status11 = strtoupper($myrow11['Latest_Result']);
		$message = $message."\n"."on $timestamp11, status of $hostname11 with ip:$ipaddress11 is $status11.\n";
		} // while($myrow11=$result11->fetch_assoc())
	} // if($result11->num_rows>0)

	/*
	$res16query="SELECT idsysadpingres, timestamp, hostname, ipaddress, status, bwdownspeed, bwupspeed, remarks FROM tblsysadpingres WHERE ipaddress=\"$ipaddr2\" ORDER BY timestamp DESC LIMIT 1";
	$result16=""; $found16=0; $ctr16=0;
	$result16=$dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
		$found16 = 1;
		$idsysadpingres16 = $myrow16['idsysadpingres'];
		$timestamp16 = $myrow16['timestamp'];
		$hostname16 = $myrow16['hostname'];
		$ipaddress16 = $myrow16['ipaddress'];
		$status16 = $myrow16['status'];
		$bwdownspeed16 = $myrow16['bwdownspeed'];
		$bwupspeed16 = $myrow16['bwupspeed'];
		$remarks16 = $myrow16['remarks'];		
		} // while($myrow16=$result16->fetch_assoc())
	}  // if($result16->num_rows>0)

	$res12query="SELECT idsysadpingres, timestamp, hostname, ipaddress, status, bwdownspeed, bwupspeed, remarks FROM tblsysadpingres WHERE ipaddress=\"$ipaddr3\" ORDER BY timestamp DESC LIMIT 1";
	$result12=""; $found12=0; $ctr12=0;
	$result12=$dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
		$found12 = 1;
		$idsysadpingres12 = $myrow12['idsysadpingres'];
		$timestamp12 = $myrow12['timestamp'];
		$hostname12 = $myrow12['hostname'];
		$ipaddress12 = $myrow12['ipaddress'];
		$status12 = $myrow12['status'];
		$bwdownspeed12 = $myrow12['bwdownspeed'];
		$bwupspeed12 = $myrow12['bwupspeed'];
		$remarks12 = $myrow12['remarks'];
		} // while($myrow12=$result12->fetch_assoc())
	} // if($result12->num_rows>0)

	$res14query="SELECT idsysadpingres, timestamp, hostname, ipaddress, status, bwdownspeed, bwupspeed, remarks FROM tblsysadpingres WHERE ipaddress=\"$ipaddr200\" ORDER BY timestamp DESC LIMIT 1";
	$result14=""; $found14=0; $ctr14=0;
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$found14 = 1;
		$idsysadpingres14 = $myrow14['idsysadpingres'];
		$timestamp14 = $myrow14['timestamp'];
		$hostname14 = $myrow14['hostname'];
		$ipaddress14 = $myrow14['ipaddress'];
		$status14 = $myrow14['status'];
		$bwdownspeed14 = $myrow14['bwdownspeed'];
		$bwupspeed14 = $myrow14['bwupspeed'];
		$remarks14 = $myrow14['remarks'];
		} // while($myrow14=$result14->fetch_assoc())
	} // if($result14->num_rows>0)
	*/

	// prepare email message
	// $message = $message."\n"."on $timestamp16, status of $hostname16 with ip:$ipaddress16 is $status16.\n";
	// $message = $message."\n"."on $timestamp12, status of $hostname12 with ip:$ipaddress12 is $status12.\n";
	// $message = $message."\n"."on $timestamp14, status of $hostname14 with ip:$ipaddress14 is $status14.\n";

	$message = $message."\n"."================= Servers and other devices =================";

	// generate other LAN devices incl servers
	$type1 = "server"; $type2 = "others";
	// $res15select="SELECT DISTINCT ipaddress, hostname, timestamp, status, bwdownspeed, bwupspeed, remarks FROM tblsysadpingres WHERE type=\"$type1\" OR type=\"$type2\" GROUP BY ipaddress ORDER BY timestamp DESC";
	// $res15select="SELECT ipaddress, hostname, MAX(timestamp), status, bwdownspeed, bwupspeed, remarks FROM tblsysadpingres WHERE type=\"$type1\" OR type=\"$type2\" GROUP BY ipaddress ORDER BY MAX(timestamp) DESC";
	// $res15query = "SELECT DISTINCT ipaddress, hostname FROM tblsysadpingres WHERE type=\"$type1\" OR type=\"$type2\" ORDER BY timestamp DESC";
	$res15query="SELECT tblsysadping.ipaddress, tblsysadping.hostname, 
  (SELECT tblsysadpingres.timestamp
   FROM tblsysadpingres
   WHERE tblsysadpingres.ipaddress = tblsysadping.ipaddress
   ORDER BY tblsysadpingres.timestamp DESC
   LIMIT 1
  ) AS Latest_Action, 
	(SELECT tblsysadpingres.status
	FROM tblsysadpingres
	WHERE tblsysadpingres.ipaddress = tblsysadping.ipaddress
	ORDER BY tblsysadpingres.timestamp DESC
   LIMIT 1
  ) AS Latest_Result
FROM tblsysadping
WHERE tblsysadping.type<>'router'
GROUP BY tblsysadping.ipaddress
HAVING Latest_Action IS NOT NULL
ORDER BY tblsysadping.ipaddress ASC";
	$result15=""; $found15=0; $ctr15=0;
	$result15=$dbh2->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15=$result15->fetch_assoc()) {
		$found15 = 1;
		$ipaddress15 = $myrow15['ipaddress'];
		$hostname15 = $myrow15['hostname'];
		$timestamp15 = $myrow15['Latest_Action'];
		$status15 = strtoupper($myrow15['Latest_Result']);

		$message = $message."\n"."on $timestamp15, status of $hostname15 with ip:$ipaddress15 is $status15.\n";

		// reset variables
		$timestamp15b=""; $hostname15=""; $ipaddress15=""; $status15b="";

		} // while($myrow15=$result15->fetch_assoc())
	} // if($result15->num_rows>0)

	$to = "support@philkoei.com.ph";
	$from = "noreply@philkoei.com.ph";
	$subject = "PKII WAN status";

	// send email
	$ok = mail("$to", "$subject", "$message", "From: $from");

// end contents here...

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result=$dbh2->query($resquery); 

} else {
     include("logindeny.php");
}

$dbh2->close();
?>
