<?php

//
// this will populate single accounts of working paper
// from multiple gl codes
//

include("db1.php");
/*
// initialize - income
$wpacctcd="40.00.000";
$wpacctname="Income";
$glcodefr="40.00.000";
$glcodeto="40.10.240";
$glrefver=2;
$status="active";

// initialize - direct costs
$wpacctcd="60.00.000";
$wpacctname="Direct Costs";
$glcodefr="60.00.000";
$glcodeto="60.80.104";
$glrefver=2;
$status="active";
*/

// initialize - gae
$wpacctcd="70.00.000";
$wpacctname="General and Administrative Expenses";
$glcodefr="70.00.000";
$glcodeto="70.80.104";
$glrefver=2;
$status="active";

?>

<html><head><title>Populate WorkingPapercodes from GLCode</title></head>
<body>
<table border="1" spacing="0" cellspacing="0" cellpadding="0">

<?php
//get latest sequence number
$result0 = mysql_query("SELECT seq FROM tblfinworkpaperref ORDER BY seq ASC", $dbh);
if($result0 != "") {
  while($myrow0 = mysql_fetch_row($result0)) {
  $found0 = 1;
  $seq0 = $myrow0[0];
  }
}

//generate and insert into table
$result1 = mysql_query("SELECT glcode, glname FROM tblfinglref WHERE version=2 AND glcode>=\"$glcodefr\" AND glcode<=\"$glcodeto\" ORDER BY glcode ASC", $dbh);
if($result1 != "") {
  while($myrow1 = mysql_fetch_row($result1)) {
  $found1 = 1;
	$glcode1 = $myrow1[0];
  $glname1 = $myrow1[1];
	$ctr1 = $ctr1 + 1;
	$seq0 = $seq0 + 1;
	echo "<tr>";
  echo "<td>$ctr1</td><td>$wpacctcd</td><td>$wpacctname</td><td>$glcode1</td><td>$seq0</td><td>$status</td>";
  echo "</tr>";

  // insert query here
  $result2 = mysql_query("INSERT INTO tblfinworkpaperref SET wpacctcd=\"$wpacctcd\", wpacctname=\"$wpacctname\", glcode=\"$glcode1\", glrefver=$glrefver, seq=$seq0, status=\"active\"", $dbh);

  }
}

?>

</table>
</body>
</html>
