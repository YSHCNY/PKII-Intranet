<?php 

$accountCodeFrom = $_POST['accountCodeFrom'];
$accountCodeTo = $_POST['accountCodeTo'];
$returnVal = '0';

if($accountCodeFrom > $accountCodeTo){
	$returnVal = '1';
}

echo $returnVal;

?>