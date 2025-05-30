<?php
//
// qrymitsuppreq5.php
// fr: ./vc/mitsuppreqdtl.php

// db conn string

require '../includes/dbh.php';

	$res16query="SELECT tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.comments, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actiondetails, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.scorestamp, tblitsupportreq.scoreempid, tblitsupportreq.scoreremarks, tblitsupportreq.apprdurationdt, tblitsupportreq.apprdurationsw, tblitctgsuppreq.name AS ctgname, tblitctgsuppreq.ctgtype AS ctgtype FROM tblitsupportreq LEFT JOIN tblitctgsuppreq ON tblitsupportreq.requestctg=tblitctgsuppreq.code WHERE tblitsupportreq.iditsupportreq=$iditsupportreq LIMIT 1";
	$result16=""; $found16=0; $ctr16=0;
	$result16=$dbh->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
		$ticketnum16 = $myrow16['ticketnum'];
		$stamprequest16 = $myrow16['stamprequest'];
		$employeeid16 = $myrow16['employeeid'];
		$deptcd16 = $myrow16['deptcd'];
		$requestctg16 = $myrow16['requestctg'];
		$details16 = $myrow16['details'];
		$comments16 = $myrow16['comments'];
		$requestctr16 = $myrow16['requestctr'];
		$approvectr16 = $myrow16['approvectr'];
		$approveid16 = $myrow16['approveid'];
		$approveempid16 = $myrow16['approveempid'];
		$approvestamp16 = $myrow16['approvestamp'];
		$actionctr16 = $myrow16['actionctr'];
		$actionctg16 = $myrow16['actionctg'];
		$actiondetails16 = $myrow16['actiondetails'];
		$actionid16 = $myrow16['actionid'];
		$actionempid16 = $myrow16['actionempid'];
		$closeticketsw16 = $myrow16['closeticketsw'];
		$closestamp16 = $myrow16['closestamp'];
		$scoreval16 = $myrow16['scoreval'];
		$scorestamp16 = $myrow16['scorestamp'];
		$scoreempid16 = $myrow16['scoreempid'];
		$scoreremarks16 = $myrow16['scoreremarks'];
		$ctgname16 = $myrow16['ctgname'];
		$ctgtype16 = $myrow16['ctgtype'];
    //20240320
    $apprdurationdt16 = $myrow16['apprdurationdt'];
    $apprdurationsw16 = $myrow16['apprdurationsw'];
		} // while
	} // if

// close database
$dbh->close();
?>
