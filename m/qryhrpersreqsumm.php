<?php
//
// qryhrpersreqsumm.php
// fr: ../vc/mhrpersreq.php
//
require '../includes/dbh.php';

	$res11query="SELECT tblhrpersreq.idhrpersreq, tblhrpersreq.requestdate, tblhrpersreq.requestedbyempid, tblhrpersreq.requestctr, tblhrpersreq.emptyp, tblhrpersreq.emptypothr, tblhrpersreq.positioncd, tblhrpersreq.deptcd, tblhrpersreq.reportstoposcd, tblhrpersreq.posfilltyp, tblhrpersreq.posfilltypempid, tblhrpersreq.posfilltypothr, tblhrpersreq.staffneeded, tblhrpersreq.dateneeded, tblhrpersreq.dateneedasap, tblhrpersreq.endorsedate, tblhrpersreq.endorseempid, tblhrpersreq.endorsectr, tblhrpersreq.recoappricgempid, tblhrpersreq.recoappricgdate, tblhrpersreq.recoappricgctr, tblhrpersreq.recoapprdcgempid, tblhrpersreq.recoapprdcgdate, tblhrpersreq.recoapprdcgctr, tblhrpersreq.approveempid, tblhrpersreq.approvedate, tblhrpersreq.approvectr, tblhrpositionctg.name AS position FROM tblhrpersreq LEFT JOIN tblhrpositionctg ON tblhrpersreq.positioncd=tblhrpositionctg.idhrpositionctg ORDER BY tblhrpersreq.requestdate DESC";
	$result11=""; $found11=0; $ctr11=0; $data="";
	$result11=$dbh->query($res11query);
	$idhrpersreq11Arr=array();
	$requestdate11Arr=array();
	$requestedbyempid11Arr=array();
	$requestctr11Arr=array();
	$emptyp11Arr=array();
	$emptypothr11Arr=array();
	$positioncd11Arr=array();
	$deptcd11Arr=array();
	$reportstoposcd11Arr=array();
	$posfilltyp11Arr=array();
	$posfilltypempid11Arr=array();
	$posfilltypothr11Arr=array();
	$staffneeded11Arr=array();
	$dateneeded11Arr=array();
	$dateneedasap11Arr=array();
	$endorsedate11Arr=array();
	$endorseempid11Arr=array();
	$endorsectr11Arr=array();
	$recoappricgempid11Arr=array();
	$recoappricgdate11Arr=array();
	$recoappricgctr11Arr=array();
	$recoapprdcgempid11Arr=array();
	$recoapprdcgdate11Arr=array();
	$recoapprdcgctr11Arr=array();
	$approveempid11Arr=array();
	$approvedate11Arr=array();
	$approvectr11Arr=array();
	$position11Arr=array();
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		array_push($idhrpersreq11Arr, $myrow11['idhrpersreq']);
		array_push($requestdate11Arr, $myrow11['requestdate']);
		array_push($requestedbyempid11Arr, $myrow11['requestedbyempid']);
		array_push($requestctr11Arr, $myrow11['requestctr']);
		array_push($emptyp11Arr, $myrow11['emptyp']);
		array_push($emptypothr11Arr, $myrow11['emptypothr']);
		array_push($positioncd11Arr, $myrow11['positioncd']);
		array_push($deptcd11Arr, $myrow11['deptcd']);
		array_push($reportstoposcd11Arr, $myrow11['reportstoposcd']);
		array_push($posfilltyp11Arr, $myrow11['posfilltyp']);
		array_push($posfilltypempid11Arr, $myrow11['posfilltypempid']);
		array_push($posfilltypothr11Arr, $myrow11['posfilltypothr']);
		array_push($staffneeded11Arr, $myrow11['staffneeded']);
		array_push($dateneeded11Arr, $myrow11['dateneeded']);
		array_push($dateneedasap11Arr, $myrow11['dateneedasap']);
		array_push($endorsedate11Arr, $myrow11['endorsedate']);
		array_push($endorseempid11Arr, $myrow11['endorseempid']);
		array_push($endorsectr11Arr, $myrow11['endorsectr']);
		array_push($recoappricgempid11Arr, $myrow11['recoappricgempid']);
		array_push($recoappricgdate11Arr, $myrow11['recoappricgdate']);
		array_push($recoappricgctr11Arr, $myrow11['recoappricgctr']);
		array_push($recoapprdcgempid11Arr, $myrow11['recoapprdcgempid']);
		array_push($recoapprdcgdate11Arr, $myrow11['recoapprdcgdate']);
		array_push($recoapprdcgctr11Arr, $myrow11['recoapprdcgctr']);
		array_push($approveempid11Arr, $myrow11['approveempid']);
		array_push($approvedate11Arr, $myrow11['approvedate']);
		array_push($approvectr11Arr, $myrow11['approvectr']);
		array_push($position11Arr, $myrow11['position']);
		} // while
	} // if
		
$dbh->close();
?>
