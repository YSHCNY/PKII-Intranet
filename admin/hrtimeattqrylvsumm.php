<?php
//
// hrtieattqrylvsumm.php
// fr: hrtimeattindivinfo.php
// req: wherevar

	$res17query="SELECT tblhrtaempleavesumm.idhrtaempleavesumm, tblhrtaempleavesumm.paygroupname, tblhrtaempleavesumm.dateannivstart, tblhrtaempleavesumm.dateannivend, tblhrtaempleavesumm.datestart, tblhrtaempleavesumm.dateend, tblhrtaempleavesumm.quota, tblhrtaempleavesumm.bal, tblhrtaempleavesumm.idhrtaleavectg, tblhrtaempleavesumm.idhrtapaygrpemplst, tblhrtaleavectg.code, tblhrtaleavectg.name, tblhrtaleavectg.quota FROM tblhrtaempleavesumm LEFT JOIN tblhrtaleavectg ON tblhrtaempleavesumm.idhrtaleavectg=tblhrtaleavectg.idhrtaleavectg WHERE $where17 ORDER BY $orderby17 LIMIT 1";
	$result17=""; $found17=0; $ctr17=0;
	$result17 = $dbh2->query($res17query);
	if($result17->num_rows>0) {
		while($myrow17 = $result17->fetch_assoc()) {
		$found17 = 1;
		$ctr17=$ctr17+1;
		$idhrtaempleavesumm17 = $myrow17['idhrtaempleavesumm'];
		$paygroupname17 = $myrow17['paygroupname'];
		$dateannivstart17 = $myrow17['dateannivstart'];
		$dateannivend17 = $myrow17['dateannivend'];
		$datestart17 = $myrow17['datestart'];
		$dateend17 = $myrow17['dateend'];
		$quota17 = $myrow17['quota'];
		$bal17 = $myrow17['bal'];
		$idhrtaleavectg17 = $myrow17['idhrtaleavectg'];
		$idhrtapaygrpemplst17 = $myrow17['idhrtapaygrpemplst'];
		$leavecd17 = $myrow17['leavecd'];
		$leavenm17 = $myrow17['leavenm'];
		$leavequota17 = $myrow17['leavequota'];
		} // while
	} // if
?>
