<?php
//
// qryhrpersrequpd03.php
// fr: ../vc/mhrpersreqrecoappr.php
//
// update for recommending approver of icg

require '../includes/dbh.php';

	$res11query="UPDATE tblhrpersreq SET timestamp=\"$now\", loginid=$loginid, recoappricgempid=\"$recoappricgempid\", recoappricgdate=\"$now\", recoappricgctr=$recoapprctrfin, approveempid=\"$approveempidfin\" WHERE idhrpersreq=$idhrpersreq";
	$result11="";
	$result11=$dbh->query($res11query);
		
$dbh->close();
?>
