<?php
//
// qryhrtapaygrpemplst.php
// fr: ../vc/motlvfrm.php
//

require '../includes/dbh.php';

	$res11query="SELECT idhrtapaygrpemplst, idtblhrtapaygrp, idhrtapayshiftctg, activesw FROM tblhrtapaygrpemplst WHERE employeeid=\"$employeeid0\" ORDER BY timestamp DESC LIMIT 1";
	$result11=""; $activesw11=''; $found11=0;
	$result11=$dbh->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11=1;
		$idhrtapaygrpemplst11 = $myrow11['idhrtapaygrpemplst'];
		$idtblhrtapaygrp11 = $myrow11['idtblhrtapaygrp'];
		$idhrtapayshiftctg11 = $myrow11['idhrtapayshiftctg'];
		$activesw11 = $myrow11['activesw'];
		} // while
	} // if
		
$dbh->close();
?>
