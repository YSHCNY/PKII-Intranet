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

echo "<h3>maindb.tblfindisbursement - add DM to affected disbursementnumber and change type from check to debit memo</h3>";

echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
echo "<tr><td colspan=12><b>Display query of affected disbursementnumber from tblfindisbursement vs corrected values</b></td></tr>";
echo "<tr><td>count</td><td>disbid</td><td><b>disbnum</b></td><td>date</td><td>type</td><td>payee</td><td>debit</td><td>credit</td><td><i>vs</i></td><td>newdisbnum</td><td>date</td><td>newtype</td></tr>";

  $count1 = 0;
  $found1 = 0;

  $result1 = mysql_query("SELECT disbursementid, disbursementnumber, disbursementtype, payee, date, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber LIKE '2011%' ORDER BY date ASC, disbursementnumber ASC", $dbh);
  while ($myrow1 = mysql_fetch_row($result1))
  {
    $found1 = 1;

    $disbursementid1 = $myrow1[0];
    $disbursementnumber1 = $myrow1[1];
    $disbursementtype1 = $myrow1[2];
    $payee1 = $myrow1[3];
    $date1 = $myrow1[4];
    $debitamt1 = $myrow1[5];
    $creditamt1 = $myrow1[6];

    $count1 = $count1 + 1;

// display affected records
    echo "<tr><td>$count1</td><td>$disbursementid1</td><td><b>$disbursementnumber1</b></td><td>$date1</td><td><b>$disbursementtype1</b></td><td>$payee1</td><td>$debitamt1</td><td>$creditamt1</td>";

// break
    echo "<td><i>vs</i></td>";

// prepare modified values
    $newdisbursementnumber = "DM-" . $disbursementnumber1;
    $newdisbursementtype = "Debit Memo";

// display modified values
    echo "<td><b>$newdisbursementnumber</b></td><td>$date1</td><td><b>$newdisbursementtype</b></td></tr>";

// update tblfindisbursement table

    $result2 = mysql_query("UPDATE tblfindisbursement SET disbursementnumber=\"$newdisbursementnumber\", disbursementtype=\"$newdisbursementtype\" WHERE disbursementid=$disbursementid1", $dbh);
  }

  echo "<tr><td colspan=\"12\"><b>ok-eof saved $count1 records</b></td></tr>";

  echo "</table>";

echo "</body></html>";

mysql_close($db1);
?>
