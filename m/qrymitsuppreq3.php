<?php
//
// qrymitsuppreq.php
// fr: ./vc/mitsuppreq.php & ./vc/mitsuppreqadd.php

// db conn string

require '../includes/dbh.php';

	if($n!='') {
	$res14query="SELECT idtblctgsuppreq, code, name FROM tblitctgsuppreq WHERE code=\"$n\"";
	} else {
	$res14query="SELECT idtblctgsuppreq, code, name FROM tblitctgsuppreq WHERE ctgtype=\"REQ\"";
	} // if
	$result14=""; $found14=0; $ctr14=0;
	$result14=$dbh->query($res14query);
	$idctgsuppreq14Arr=array();
	$code14Arr=array();
	$name14Arr=array();
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		array_push($idctgsuppreq14Arr, $myrow14['idtblctgsuppreq']);
		array_push($code14Arr, $myrow14['code']);
		array_push($name14Arr, $myrow14['name']);
		} // while
	} // if

// close database
$dbh->close();
?>