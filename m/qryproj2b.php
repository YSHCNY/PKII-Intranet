<?php
//
// qryproj2.php
// fr: ../vc/vprojmore.php
//
require '../includes/dbh.php';

	$res12query="SELECT name_first, name_middle, name_last, email1 FROM tblcontact WHERE employeeid ='$employeeid11' LIMIT 1";
	$result12=""; $found12=0; $ctr12=0; $data="";
	$result12=$dbh->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
		$found12=1;
		$name_first12 = $myrow12['name_first'];
		$name_middle12 = $myrow12['name_middle'];
		$name_last12 = $myrow12['name_last'];
		$email112 = $myrow12['email1'];
		} // while
	} // if
		
$dbh->close();
?> 
