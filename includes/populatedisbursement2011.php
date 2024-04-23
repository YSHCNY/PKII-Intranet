<?php
// this module will insert records from msaccess db.24 disbursement & journal tables to mysql.maindb.tblfindisbursement0 & tblfinjournal0

// db config
require('db24.php');

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
echo "<tr><td colspan=12><b>I. Starting select query of disbursement...</b></td></tr>";
echo "<tr><td>count</td><td>disbid</td><td>voucher</td><td>date</td><td>payee</td><td>glcode</td><td>projcode</td><td>particulars</td><td>debit</td><td>credit</td><td>type</td><td>explanation</td></tr>";

  $count1 = 0;
  $found1 = 0;

  $result1 = mysql_query("SELECT disbursementid, voucher, date, glcode, projcode, particulars, debit, credit, explanation, payee FROM disbursement WHERE disbursementid <> '' AND date LIKE '2011%' ORDER BY date ASC, voucher ASC", $db24);
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

// remove P sign in value
    $debit2 = substr($debit1,1);
    $credit2 = substr($credit1,1);
// convert from string to double
    $debit3 = floatval($debit2);
    $credit3 = floatval($credit2);

    if (fnmatch("*DM*",$voucher1))
    { $vouchertype="Debit Memo"; }
    else { $vouchertype="Check"; }

    echo "<tr><td>$count1</td><td>$disbursementid1</td><td>$voucher1</td><td>$date0</td><td>$payee1</td><td>$glcode1</td><td>$projcode1</td><td>$particulars1</td><td align=\"right\">$debit3</td><td align=\"right\">$credit3</td><td>$vouchertype</td><td align=\"right\">$explanation1</td></tr>";

    $result2 = mysql_query("INSERT INTO tblfindisbursement SET disbursementnumber=\"$voucher1\", disbursementtype=\"$vouchertype\", payee=\"$payee1\", date=\"$date0\", glcode=\"$glcode1\", glrefver=1, projcode=\"$projcode1\", particulars=\"$particulars1\", debitamt=$debit3, creditamt=$credit3, explanation=\"$explanation1\"", $db24);

//    $result2 = mysql_query("INSERT INTO tblfindisbursement (disbursementnumber, disbursementtype, payee, date, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt) VALUES ('$voucher1', '$vouchertype', '$payee1', '$date0', '$glcode1', 1, '', '$projcode1', '$particulars1', $debit3, $credit3)", $db1);

    $voucher1 = ""; $vouchertype = "";
    $payee1 = ""; $date1 = ""; $glcode1 = ""; $projcode1 = ""; $particulars1 = "";
    $debit1 = ""; $credit1 = "";
    $debit2 = ""; $credit2 = "";
    $debit3 = 0; $credit3 = 0;
  }

  echo "<tr><td colspan=\"10\"><b>ok-eof</b></td></tr>";

  echo "</table>";

echo "</body></html>";

mysql_close($db24);
?>
