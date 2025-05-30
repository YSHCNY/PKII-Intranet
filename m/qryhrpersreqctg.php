<?php
//
// qryhrpersreqctg.php
// fr: ../vc/mhrpersreqadd.php
// 

require '../includes/dbh.php';

	$res15query="SELECT endorsedempid, recoappricgempid, recoapprdcgempid, approveempid FROM tblhrpersreqctg WHERE idhrpersreqapprctg<>'' ORDER BY idhrpersreqapprctg ASC LIMIT 1";
	$result15=""; $found15=0; $ctr15=0; $data="";
	$result15=$dbh->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15=$result15->fetch_assoc()) {
		$found15=1;
		$endorsedempid15 = $myrow15['endorsedempid'];
		$recoappricgempid15 = $myrow15['recoappricgempid'];
		$recoapprdcgempid15 = $myrow15['recoapprdcgempid'];
		$approveempid15 = $myrow15['approveempid'];
		} // while
	} // if
		
$dbh->close();
?>
