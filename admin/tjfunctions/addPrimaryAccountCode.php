<?php 
$created_by = $_POST['loginid'];
$action = $_POST['actionId'];
$acctcode = $_POST['accountCode'];
$acctname = $_POST['accountName'];

include("../db1.php");


	if($action == 0){
		$result = mysql_query("INSERT INTO tblfinprojinprimary SET loginid=\"$created_by\",createdby=\"$created_by\", account_code=\"$acctcode\", account_name=\"$acctname\", status='1'", $dbh);
	}
	else{
		$result = mysql_query("UPDATE tblfinprojinprimary SET account_code = '".$acctcode."', account_name='".$acctname."' WHERE projinprim_id = ".$action, $dbh);
	}

	echo "2";
mysql_close($dbh);



?>