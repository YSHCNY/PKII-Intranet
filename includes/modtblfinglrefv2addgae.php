<?php

//
// this will modify records from tblfinglref
// and add 'GAE-' chars on all '70.xx.xxx' series of version-2
//

include("db1.php");

// initialize
$glrefver=2;
$addchars="GAE-";

// echo "<p>vartest $glrefver, $addchars</p>";

?>

<html><head><title>Modify tblfinglrefv2 and add GAE- on acct names with 70-series glcodes</title></head>
<body>
<table border="1" spacing="0" cellspacing="0" cellpadding="0">

<?

echo "<tr><td>count</td><td>id</td><td>glcode</td><td>acctname</td><td>status</td></tr>";

$result10=""; $found10=0; $count10=0;
$result10 = mysql_query("SELECT glrefid, glcode, glname FROM tblfinglref WHERE version=2 AND glcode LIKE \"70.%\" ORDER BY glcode ASC", $dbh);
if($result10 != "") {
	while($myrow10 = mysql_fetch_row($result10)) {
	$found10 = 1;
	$glrefid10 = $myrow10[0];
	$glcode10 = $myrow10[1];
	$glname10 = $myrow10[2];
	$count10 = $count10+1;

	$startchar=substr($glname10, 0, 4);

	echo "<tr><td>$count10</td><td>$glrefid10</td><td>$glcode10</td>";
	if($startchar != "GAE-") {
		$newchar = $addchars.$glname10;
		echo "<td><font color=\"green\">$newchar</font></td>";
		$result11 = mysql_query("UPDATE tblfinglref SET glname=\"$newchar\" WHERE glrefid=$glrefid10 AND version=$glrefver", $dbh);
		echo "<td><font color=\"green\">modified</font></td>";
	} else { echo "<td>$glname10</td><td>existing</td>"; }

	echo "</tr>";

	$startchar=""; $newchar="";
	}
}

//echo "<p>vartest found:$found10,$result10</p>";
?>

</table>
</body>
</html>
