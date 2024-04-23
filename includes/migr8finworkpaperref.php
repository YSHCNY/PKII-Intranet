<?php
// this function will migrate current/updated records of finglrefv2 from philkoei-023 dev server to intranet.server (192.168.0.10)

// db config

// uncomment to use
// require('db23.php');
// require('db1.php');

echo "<html><head><title>migr8finworkpaperref fr-dev-to-prod maindb</title>";
?>
<STYLE TYPE="text/css">
<!--
TH{font-family: Helvetica; font-size: 10pt; font-weight: 100%;}
TD{font-family: Helvetica; font-size: 10pt;}
--->
</STYLE>
<?php
echo "</head><body>";

// initialize
$glrefver = 1;
$ctr1 = 0;
$found12 = 0;
$ctr2 = 0;

echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
echo "<tr><td></td><td colspan=\"9\">philkoei-023 dev server</td><td></td><td colspan=\"9\">intranet.server prod</td></tr>";
echo "<tr><td>count</td><td>wprefid</td><td>glcode</td><td>glrefver</td><td>status</td><td>vs</td><td>count</td><td>wprefid</td><td>glcode</td><td>glrefver</td><td>status</td><td>remarks</td></tr>";

  $count1 = 0;
  $found1 = 0;

  $result1 = mysql_query("SELECT wprefid, glcode, glrefver, status FROM tblfinworkpaperref WHERE glrefver=2 ORDER BY wprefid ASC", $db23);
  if($result1 != "") {
    while ($myrow1 = mysql_fetch_row($result1)) {
    $found1 = 1;

    $wprefid1 = $myrow1[0];
    $glcode1 = $myrow1[1];
    $glrefver1 = $myrow1[2];
    $status1 = $myrow1[3];

    $count1 = $count1 + 1;

    echo "<tr><td>$count1</td><td>$wprefid1</td><td>$glcode1</td><td>$glrefver1</td><td>$status1</td>";
    echo "<td>&nbsp;</td>";

    $count2 = 0;
    $found2 = 0;

    $result2 = mysql_query("SELECT wprefid, glcode, glrefver, status FROM tblfinworkpaperref WHERE glcode=\"$glcode1\" AND glrefver=\"$glrefver1\" AND status=\"active\"", $dbh);
    if($result2 != '') {
      while($myrow2 = mysql_fetch_row($result2)) {
        $found2 = 1;

	$wprefid2 = $myrow2[0];
	$glcode2 = $myrow2[1];
	$glrefver2 = $myrow2[2];
	$status2 = $myrow2[3];

	$count2 = $count2 + 1;

	echo "<td>$count2</td><td>$wprefid2</td><td>$glcode2</td><td>$glrefver2</td><td>$status2</td>";
	    $result3 = mysql_query("DELETE FROM tblfinworkpaperref WHERE wprefid=$wprefid2", $dbh);
	    $result4 = mysql_query("INSERT INTO tblfinworkpaperref SET glcode=\"$glcode1\", glrefver=$glrefver1, status=\"$status1\"", $dbh);
	echo "<td>asis</td>";
      }
    }

    if($found2 != 1) {
      echo "<td>$count1</td><td>$wprefid1</td><td>$glcode1</td><td>$glrefver1</td><td>$status1</td>";
	      $result5 = mysql_query("INSERT INTO tblfinworkpaperref SET glcode=\"$glcode1\", glrefver=$glrefver1, status=\"$status1\"", $dbh);
      echo "<td>insert-newrecord</td>";
    }
    echo "</tr>";
    }
  }

  echo "<tr><td colspan=\"20\"><b>ok-eof</b></td></tr>";

  echo "</table>";

echo "</body></html>";

mysql_close($db23);
?>
