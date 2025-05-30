<?php
//
// qryhrpersrequpd04.php
// fr: ../vc/mhrpersreqrecoappr.php
//
// update for approver

require '../includes/dbh.php';

	$res11query="UPDATE tblhrpersreq SET timestamp=\"$now\", loginid=$loginid, approveempid=\"$actorempid\", approvectr=$approvectrfin, approvedate=\"$now\" WHERE idhrpersreq=$idhrpersreq";
	$result11="";
	$result11=$dbh->query($res11query);
		
$dbh->close();
?>
