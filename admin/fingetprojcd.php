<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$projcode = $_GET['prjid'];

// start contents here

	$result11=""; $found11=0;
	$result11 = mysql_query("", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11=1;
		
		}
	}

// end contents here

mysql_close($dbh);
?>

