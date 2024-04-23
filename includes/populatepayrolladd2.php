<?php 
include("db1.php");
// $dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
// mysql_select_db("maindb", $dbh) or die("Database Error");

$employeeid = $_POST['employeeid'];
$add_desc = trim($_POST['add_desc']);
$start = $_POST['start'];
$end = $_POST['end'];
$amount = $_POST['amount'];

$result11=""; $found11=0; $ctr11=0;
$result11 = mysql_query("SELECT employeeid, add_desc, start, end FROM tblemppayincometaxable WHERE employeeid=\"$employeeid\" AND add_desc=\"$add_desc\" AND start=\"$start\" AND end=\"$end\"", $dbh);
if($result11 != "") {
	while($myrow11 = mysql_fetch_row($result11)) {
	$found11 = 1;
	$employeeid11 = $myrow11[0];
	$add_desc11 = $myrow11[1];
	$start11 = $myrow11[2];
	$end11 = $myrow11[3];
	}
}

if($found11 != 1) {
	$result12 = mysql_query("INSERT INTO tblemppayincometaxable (employeeid, add_desc, start, end, amount) VALUES ('$employeeid', '$add_desc', '$start', '$end', $amount)", $dbh); 
} else if($found11 == 1) {
	$result12 = mysql_query("UPDATE tblemppayincometaxable SET employeeid='$employeeid', add_desc='$add_desc', start='$start', end='$end', amount=$amount WHERE employeeid=\"$employeeid11\" AND add_desc=\"$add_desc11\" AND start=\"$start11\" AND end=\"$end11\"", $dbh);
}

$id = mysql_insert_id();

//echo "$id";
echo "$employeeid - $start - $end";

mysql_close($dbh);
?> 
