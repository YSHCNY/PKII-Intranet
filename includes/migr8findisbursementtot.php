<?php
// this function will migrate current/updated records of finglrefv2 from philkoei-023 dev server to intranet.server (192.168.0.10)

// db config

// uncomment to use
// require('db23.php');
// require('db1.php');

echo "<html><head><title>migr8findisbursementtot fr-dev-to-prod maindb</title>";
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
echo "<tr><td>count</td><td>disbursementnum</td><td>date</td><td>debit</td><td>credit</td><td>vs</td><td>count</td><td>disbursementnum</td><td>date</td><td>debit</td><td>credit</td><td><status</td></tr>";

  $count1 = 0;
  $found1 = 0;

  $result1 = mysql_query("SELECT disbursementtotid, disbursementnumber, date, explanation, debittot, credittot, status FROM tblfindisbursementtot WHERE date>\"2011-11-30\" ORDER BY date ASC", $db23);
  if($result1 != "") {
    while ($myrow1 = mysql_fetch_row($result1)) {
    $found1 = 1;

    $disbursementtotid1 = $myrow1[0];
    $disbursementnumber1 = $myrow1[1];
    $date1 = $myrow1[2];
    $explanation1 = $myrow1[3];
    $debittot1 = $myrow1[4];
    $credittot1 = $myrow1[5];
    $status1 = $myrow1[6];

    $count1 = $count1 + 1;

    echo "<tr><td>$count1</td><td>$disbursementnumber1</td><td>$date1</td><td>$debittot1</td><td>$credittot1</td>";
    echo "<td>&nbsp;</td>";

    $count2 = 0;
    $found2 = 0;

    $result2 = mysql_query("SELECT disbursementtotid, disbursementnumber, date, explanation, debittot, credittot, status FROM tblfindisbursementtot WHERE disbursementnumber=\"$disbursementnumber1\" AND date=\"$date1\"", $dbh);
    if($result2 != '') {
      while($myrow2 = mysql_fetch_row($result2)) {
        $found2 = 1;

	$disbursementtotid2 = $myrow2[0];
	$disbursementnumber2 = $myrow2[1];
	$date2 = $myrow2[2];
	$explanation2 = $myrow2[3];
	$debittot2 = $myrow2[4];
	$credittot2 = $myrow2[5];
	$status2 = $myrow2[6];

	$count2 = $count2 + 1;

	echo "<td>$count2</td<td>$disbursementnumber2</td><td>$date2</td><td>$debittot2</td><td>$credittot2</td>";
//	    $result3 = mysql_query("DELETE FROM tblfindisbursementtot WHERE disbursementtotid=$disbursementtotid2", $dbh);
//	    $result4 = mysql_query("INSERT INTO tblfindisbursementtot SET disbursementnumber=\"$disbursementnumber1\", date=\"$date1\", explanation=\"$explanation1\", debitamt=$debittot1, creditamt=$credittot1, status=\"$status1\"", $dbh);
	echo "<td>asis</td>";
      }
    }

    if($found2 != 1) {
      echo "<td>$count1</td><td>$disbursementnumber1</td><td>$date1</td><td>$debittot1</td><td>$credittot1</td>";
	      $result5 = mysql_query("INSERT INTO tblfindisbursementtot SET disbursementnumber=\"$disbursementnumber1\", date=\"$date1\", explanation=\"$explanation1\", debittot=$debittot1, credittot=$credittot1, status=\"$status1\"", $dbh);
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
