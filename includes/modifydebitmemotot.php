<?php
// this script will query records from mysql.maindb.tblfindisbursement of all disbursementnumber LIKE '2011%' and update with 'DM-' included on disbursementnumber and replace the type from check to debit memo

// db config
require('db1.php');

echo "<html><head><title>modify debit memo records</title>";
?>
<STYLE TYPE="text/css">
<!--
TD{font-family: Helvetica; font-size: 10pt;}
--->
</STYLE>
<?php
echo "</head><body>";

// initialize
$ctr1 = 0;

echo "<h3>maindb.tblfindisbursementtot - add DM to affected disbursementnumber and change type from check to debit memo</h3>";

echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
echo "<tr><td colspan=12><b>Display query of affected disbursementnumber from tblfindisbursementtot vs corrected values</b></td></tr>";
echo "<tr><td>count</td><td>disbid</td><td><b>disbnum</b></td><td>date</td><td>type</td><td>payee</td><td>debittot</td><td>credittot</td><td><i>vs</i></td><td>newdisbnum</td><td>date</td><td>newtype</td></tr>";

  $count1 = 0;
  $found1 = 0;

  $result1 = mysql_query("SELECT disbursementtotid, disbursementnumber, date, debittot, credittot, status FROM tblfindisbursementtot WHERE disbursementnumber LIKE '2011%' ORDER BY date ASC, disbursementnumber ASC", $dbh);
  while ($myrow1 = mysql_fetch_row($result1))
  {
    $found1 = 1;

    $disbursementtotid1 = $myrow1[0];
    $disbursementnumber1 = $myrow1[1];
    $date1 = $myrow1[2];
    $debittot1 = $myrow1[3];
    $credittot1 = $myrow1[4];
    $status1 = $myrow1[5];

    $count1 = $count1 + 1;

// display affected records
    echo "<tr><td>$count1</td><td>$disbursementtotid1</td><td><b>$disbursementnumber1</b></td><td>$date1</td><td>$debittot1</td><td>$credittot1</td><td>$status1</td>";

// break
    echo "<td><i>vs</i></td>";

// prepare modified values
    $newdisbursementnumber = "DM-" . $disbursementnumber1;
    $newdisbursementtype = "Debit Memo";

// display modified values
    echo "<td><b>$newdisbursementnumber</b></td><td>$date1</td></tr>";

// update tblfindisbursement table

    $result2 = mysql_query("UPDATE tblfindisbursementtot SET disbursementnumber=\"$newdisbursementnumber\" WHERE disbursementtotid=$disbursementtotid1", $dbh);
  }

  echo "<tr><td colspan=\"12\"><b>ok-eof saved $count1 records</b></td></tr>";

  echo "</table>";

echo "</body></html>";

mysql_close($db1);
?>
