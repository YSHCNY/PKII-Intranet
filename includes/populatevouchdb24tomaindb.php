<?php
// this module will insert records from msaccess db.24 disbursement & journal tables to mysql.maindb.tblfindisbursement0 & tblfinjournal0

// db config
include("db24.php");

echo "<html><head><title>populatevouchdb24tomaindb</title>";
?>
<STYLE TYPE="text/css">
<!--
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

echo "<h3>module:update fr mysql.db24 to mysql.maindb...</h3>";

echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
echo "<tr><td colspan=11><b>I. Starting select query of disbursement...</b></td></tr>";
echo "<tr><td>count</td><td>disbid</td><td>voucher</td><td>date</td><td>glcode</td><td>projcode</td><td>particulars</td><td>debit</td><td>credit</td><td>dr_total</td><td>cr_total</td></tr>";

  $count1 = 0;
  $found1 = 0;

  $result1 = mysql_query("SELECT disbursementid, voucher, date, glcode, projcode, particulars, debit, credit, explanation, payee FROM disbursement WHERE disbursementid <> '' AND date LIKE '2010%' ORDER BY date ASC, voucher ASC", $db24);
  while ($myrow1 = mysql_fetch_row($result1))
  {
    $found1 = 1;

    $disbursementid1 = $myrow1[0];
    $voucher1 = $myrow1[1];
    $date1 = $myrow1[2];
    $glcode1 = $myrow1[3];
    $projcode1 = $myrow1[4];
    $particulars1 = $myrow1[5];
    $debit1 = $myrow1[6];
    $credit1 = $myrow1[7];
    $explanation1 = $myrow1[8];
    $payee1 = $myrow1[9];

    $count1 = $count1 + 1;

    $date2 = split(" ", $date1);
    $date0 = $date2[0];
    $time0 = $date2[1];

    $debit2 = substr($debit1,1);
    $credit2 = substr($credit1,1);

    echo "<tr><td>$count1</td><td>$disbursementid1</td><td>$voucher1</td><td>$date0</td><td>$glcode1</td><td>$projcode1</td><td>$particulars1</td><td align=\"right\">$debit2</td><td align=\"right\">$credit2</td><td align=\"right\">&nbsp;</td><td align=\"right\">&nbsp;</td></tr>";

    $voucher1 = "";
    $debit2 = 0;
    $credit2 = 0;
  }

  echo "<tr><td colspan=\"10\"><b>ok-eof</b></td></tr>";

  echo "</table>";

echo "</body></html>";

mysql_close($db24);
?>
