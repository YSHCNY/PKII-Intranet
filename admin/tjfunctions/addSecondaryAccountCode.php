<?php 
$created_by = $_POST['loginid'];
$action = $_POST['actionId'];
$acctcode_from = $_POST['accountCodeFrom'];
$acctcode_to = $_POST['accountCodeTo'];
$acctname = $_POST['accountName'];
$primaryid = $_POST['primprojid'];

include("../db1.php");

	$returnVal = '0';
	if($acctcode_from > $acctcode_to){
		$returnVal = '1';
	}
	else{
		if($action == 0){
		$result = mysql_query("INSERT INTO tblfinprojinsecondary SET login_id=\"$created_by\", acctcode_to='".$acctcode_to."', acctcode_from=\"$acctcode_from\", secondary_account_name=\"$acctname\", status='1' , fk_projinprimary_id=".$primaryid, $dbh);
		}
		else{
			$result = mysql_query("UPDATE tblfinprojinsecondary SET acctcode_to='".$acctcode_to."', acctcode_from=\"$acctcode_from\", secondary_account_name=\"$acctname\", status='1' , fk_projinprimary_id=".$primaryid." WHERE projinsecondary_id = ".$action, $dbh);
		}
	}

	echo $returnVal;

mysql_close($dbh);



?>