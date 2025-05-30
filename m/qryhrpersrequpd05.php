<?php
//
// qryhrpersrequpd05.php
// fr: ../vc/mhrpersreqcomments.php
//

require '../includes/dbh.php';

	$res11query="UPDATE tblhrpersreq SET timestamp=\"$now\", loginid=$loginid, comments=\"$commentsfin\" WHERE idhrpersreq=$idhrpersreq";
	$result11="";
	$result11=$dbh->query($res11query);
		
$dbh->close();
?>
