<?php
//
// qryhrdeptcd.php
// fr: ../vc/mhrpersreqadd.php
//
require '../includes/dbh.php';

	$res12query="SELECT code, name FROM tbldeptcd";
	$result12=""; $found12=0; $ctr12=0; $data="";
	$result12=$dbh->query($res12query);
	$code12Arr=array();
	$name12Arr=array();
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
		$found12=1;
		array_push($code12Arr, $myrow12['code']);
		array_push($name12Arr, $myrow12['name']);
		} // while
	} // if
		
$dbh->close();
?>