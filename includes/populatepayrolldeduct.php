<?php 
include("db1.php");
// $dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
// mysql_select_db("maindb", $dbh) or die("Database Error");

$employeeid = $_POST['employeeid'];
$ded_desc = trim($_POST['ded_desc']);
$start = $_POST['start'];
$end = $_POST['end'];
$amount = $_POST['amount'];
$amountdeduct = $_POST['amountdeduct'];
$balance = $_POST['balance'];

$result11=""; $found11=0; $ctr11=0;
$result11 = mysql_query("SELECT employeeid, ded_desc, start, end FROM tblemppayotherdeductions WHERE employeeid=\"$employeeid\" AND ded_desc=\"$ded_desc\" AND start=\"$start\" AND end=\"$end\"", $dbh);
if($result11 != "") {
	while($myrow11 = mysql_fetch_row($result11)) {
	$found11 = 1;
	$employeeid11 = $myrow11[0];
	$ded_desc11 = $myrow11[1];
	$start11 = $myrow11[2];
	$end11 = $myrow11[3];
	}
}

if($found11 != 1) {
	$result12 = mysql_query("INSERT INTO tblemppayotherdeductions (employeeid, ded_desc, start, end, amount, amountdeduct, balance) VALUES ('$employeeid', '$ded_desc', '$start', '$end', $amount, $amountdeduct, $balance)", $dbh); 
} else if($found11 == 1) {
	$result12 = mysql_query("UPDATE tblemppayotherdeductions SET employeeid='$employeeid', ded_desc='$ded_desc', start='$start', end='$end', amount=$amount, amountdeduct=$amountdeduct, balance=$balance WHERE employeeid=\"$employeeid11\", ded_desc=\"$ded_desc11\", start=\"$start11\", end=\"$end11\"", $dbh);
}

$id = mysql_insert_id();

//echo "$id";
echo "$employeeid - $ded_desc - $start11 - $end11";

mysql_close($dbh);
?> 
