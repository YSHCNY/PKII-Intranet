<?php
//
// qryhrpositionctg.php
// fr: ../vc/mhrpersreqadd.php
//
require '../includes/dbh.php';

	$res11query="SELECT idhrpositionctg, code, name FROM tblhrpositionctg ORDER by idhrpositionctg ASC";
	$result11=""; $found11=0; $ctr11=0; $data="";
	$result11=$dbh->query($res11query);
	$idhrpositionctg11Arr=array();
	$code11Arr=array();
	$name11Arr=array();
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		array_push($idhrpositionctg11Arr, $myrow11['idhrpositionctg']);
		array_push($code11Arr, $myrow11['code']);
		array_push($name11Arr, $myrow11['name']);
		} // while
	} // if
		
$dbh->close();
?>
