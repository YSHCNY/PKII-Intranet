<?php
//
// qryhrpersrequpd01.php
// fr: ../vc/mhrpersreqreendorse.php
//

require '../includes/dbh.php';

	$res11query="UPDATE tblhrpersreq SET timestamp=\"$now\", loginid=$loginid, requestctr=$requestctr WHERE idhrpersreq=$idhrpersreq";
	$result11="";
	$result11=$dbh->query($res11query);
		
$dbh->close();
?>
