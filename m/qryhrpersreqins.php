<?php
//
// qryhrpersreqins.php
// fr: ../vc/mhrpersreqadd2.php
//

require '../includes/dbh.php';

	$res11query="INSERT INTO tblhrpersreq SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=$loginid, requestdate=\"$requestdate\", requestedbyempid=\"$requestorempid\", requestctr=$requestctr, emptyp=\"$emptyp\", emptypothr=\"$emptypothr\", positioncd=\"$positioncd\", deptcd=\"$deptcd\", reportstoposcd=\"$reportstoposcd\", posfilltyp=\"$posfilltyp\", posfilltypempid=\"$posfillempid\", posfilltypothr=\"$posfillothr\", staffneeded=$staffneeded, jobdescresp=\"$jobdescresp\", jobdescduties=\"$jobdescduties\", dateneeded=\"$dateneededfin\", dateneedasap=\"$dateneedtyp\", remarks=\"$remarks\", endorsedate=\"$endorsedate\", endorseempid=\"$endorseempid\", endorsectr=$endorsectr, recoappricgempid=\"$recoappricgempid\", recoappricgdate=\"$recoappricgdate\", recoappricgctr=$recoappricgctr, recoapprdcgempid=\"$recoapprdcgempid\", recoapprdcgdate=\"$recoapprdcgdate\", recoapprdcgctr=$recoapprdcgctr, approveempid=\"$approveempid\", approvedate=\"$approvedate\", approvectr=$approvectr, comments=\"$comments\"";
	$result11="";
	$result11=$dbh->query($res11query);

	// get insert id
	$idhrpersreq = mysqli_insert_id();
		
$dbh->close();
?>