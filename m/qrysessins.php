<?php
//
// qrysessins.php
// fr: ../vc/mhrpersreqadd2.php
//

require '../includes/dbh.php';

	$res12query="INSERT INTO tblsession SET timestamp=\"$now\", loginid=$loginid, sesschars=\"".genRandomString()."\", loginpath=\"$prevpath\", employeeid=\"$approver\", remarks=\"HR personnel request form for endorsement to:$endorseempid requested by:$requestorempid position:$positioncd id:$idhrpersreq\"";
	$result12="";
	$result12=$dbh->query($res12query);

	// get idsession
	$idsession = mysqli_insert_id();
		
$dbh->close();
?>
