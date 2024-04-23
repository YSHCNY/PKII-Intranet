<?php
//
// qryhrpersreqid.php
// fr: ../vc/mhrpersreqdtl.php
//
require '../includes/dbh.php';

	$res11query="SELECT tblhrpersreq.remarks, tblhrpersreq.jobdescresp, tblhrpersreq.jobdescduties, tblhrpersreq.idhrpersreq, tblhrpersreq.requestdate, tblhrpersreq.requestedbyempid, tblhrpersreq.requestctr, tblhrpersreq.emptyp, tblhrpersreq.emptypothr, tblhrpersreq.positioncd, tblhrpersreq.deptcd, tblhrpersreq.reportstoposcd, tblhrpersreq.posfilltyp, tblhrpersreq.posfilltypempid, tblhrpersreq.posfilltypothr, tblhrpersreq.staffneeded, tblhrpersreq.dateneeded, tblhrpersreq.dateneedasap, tblhrpersreq.endorsedate, tblhrpersreq.endorseempid, tblhrpersreq.endorsectr, tblhrpersreq.recoappricgempid, tblhrpersreq.recoappricgdate, tblhrpersreq.recoappricgctr, tblhrpersreq.recoapprdcgempid, tblhrpersreq.recoapprdcgdate, tblhrpersreq.recoapprdcgctr, tblhrpersreq.approveempid, tblhrpersreq.approvedate, tblhrpersreq.approvectr, tblhrpersreq.comments, tblhrpositionctg.name AS position FROM tblhrpersreq LEFT JOIN tblhrpositionctg ON tblhrpersreq.positioncd=tblhrpositionctg.idhrpositionctg WHERE tblhrpersreq.idhrpersreq=$idhrpersreq";
	$result11=""; $found11=0; $ctr11=0; $data="";
	$result11=$dbh->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$idhrpersreq11 = $myrow11['idhrpersreq'];
		$requestdate11 = $myrow11['requestdate'];
		$requestedbyempid11 = $myrow11['requestedbyempid'];
		$requestctr11 = $myrow11['requestctr'];
		$emptyp11 = $myrow11['emptyp'];
		$emptypothr11 = $myrow11['emptypothr'];
		$positioncd11 = $myrow11['positioncd'];
		$deptcd11 = $myrow11['deptcd'];
		$reportstoposcd11 = $myrow11['reportstoposcd'];
		$posfilltyp11 = $myrow11['posfilltyp'];
		$posfilltypempid11 = $myrow11['posfilltypempid'];
		$posfilltypothr11 = $myrow11['posfilltypothr'];
		$staffneeded11 = $myrow11['staffneeded'];
		$dateneeded11 = $myrow11['dateneeded'];
		$dateneedasap11 = $myrow11['dateneedasap'];
		$endorsedate11 = $myrow11['endorsedate'];
		$endorseempid11 = $myrow11['endorseempid'];
		$endorsectr11 = $myrow11['endorsectr'];
		$recoappricgempid11 = $myrow11['recoappricgempid'];
		$recoappricgdate11 = $myrow11['recoappricgdate'];
		$recoappricgctr11 = $myrow11['recoappricgctr'];
		$recoapprdcgempid11 = $myrow11['recoapprdcgempid'];
		$recoapprdcgdate11 = $myrow11['recoapprdcgdate'];
		$recoapprdcgctr11 = $myrow11['recoapprdcgctr'];
		$approveempid11 = $myrow11['approveempid'];
		$approvedate11 = $myrow11['approvedate'];
		$approvectr11 = $myrow11['approvectr'];
		$comments11 = $myrow11['comments'];
		$position11 = $myrow11['position'];

		$jobdescresp11 = $myrow11['jobdescresp'];
		$jobdescduties12 = $myrow11['jobdescduties'];
		$remarks11 = $myrow11['remarks'];
		} // while
	} // if
		
$dbh->close();
?>
