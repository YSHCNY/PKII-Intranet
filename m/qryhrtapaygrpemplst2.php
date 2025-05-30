<?php
//
// qryhrtapaygrpemplst.php
// fr: ../vc/motlvfrm.php
//

require '../includes/dbh.php';

	$res11query="SELECT idhrtapaygrpemplst, paygroupname, idtblhrtapaygrp, contactid, idhrtapayshiftctg, restday, projcode, projchgtyp, allowotdflt, allowotbfidflt FROM tblhrtapaygrpemplst WHERE employeeid=\"$employeeid0\" AND activesw=1 ORDER BY timestamp DESC LIMIT 1";
	$result11=""; $found11=0;
	$result11=$dbh->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$idhrtapaygrpemplst11 = $myrow11['idhrtapaygrpemplst'];
		$paygroupname11 = $myrow11['paygroupname'];
		$idtblhrtapaygrp11 = $myrow11['idtblhrtapaygrp'];
		$contactid11 = $myrow11['contactid'];
		$idhrtapayshiftctg11 = $myrow11['idhrtapayshiftctg'];
		$restday11 = $myrow11['restday'];
		$projcode11 = $myrow11['projcode'];
		$projchgtyp11 = $myrow11['projchgtyp'];
		$allowotdflt11 = $myrow11['allowotdflt'];
		$allowotbfidflt11 = $myrow11['allowotbfidflt'];
		} // while
	} // if
		
$dbh->close();
?>
