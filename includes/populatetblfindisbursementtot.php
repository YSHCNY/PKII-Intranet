<?php
// this module will insert records from mysql.db24.tblfindisbursement to tblfindisbursementtot after computing the debit and credit total amounts; it will also insert the explanation field from the disbursement table

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

echo "<h3>db:mysql.db24 - compute total disbursement and insert to tblfindisbursementot incl. explanation</h3>";

echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
echo "<tr><td colspan=12><b>I. Starting select query of disbursement...</b></td></tr>";
echo "<tr><td>count</td><td>disbid</td><td>voucher</td><td>payee</td><td>date</td><td>debit</td><td>credit</td><td>debittot</td><td>credittot</td><td>status</td><td>explanation</td></tr>";

  $count1 = 0;
  $found1 = 0;

//  $result1 = mysql_query("SELECT disbursementid, disbursementnumber, disbursementtype, payee, date, debitamt, creditamt, explanation FROM tblfindisbursement WHERE disbursementid <> '' ORDER BY date ASC, disbursementnumber ASC", $db24);
	$result1 = mysql_query("SELECT disbursementid, disbursementnumber, disbursementtype, payee, date, debitamt, creditamt, explanation FROM tblfindisbursement WHERE date >= \"2012-03-01\" AND date <= \"2014-01-31\" AND disbursementnumber NOT LIKE \"%.%\" ORDER BY date ASC, disbursementnumber ASC", $db24);
  while ($myrow1 = mysql_fetch_row($result1))
  {
    $found1 = 1;

    $disbursementid1 = $myrow1[0];
    $disbursementnumber1 = $myrow1[1];
    $disbursementtype1 = $myrow1[2];
    $payee1 = $myrow1[3];
    $date1 = $myrow1[4];
    $debit1 = $myrow1[5];
    $credit1 = $myrow1[6];
    $explanation1 = $myrow1[7];

    $count1 = $count1 + 1;

    $debittot = $debittot + $debit1;
    $credittot = $credittot + $credit1;

    if ($debittot != $credittot)
    { $status="pending"; }
    else { $status="finalized"; }
    if (fnmatch("*CANCELLED*", $payee1))
    { $status="cancelled"; }

    echo "<tr><td>$count1</td><td>$disbursementid1</td><td>$disbursementnumber1</td><td>$payee1</td><td>$date1</td><td align=\"right\">$debit1</td><td align=\"right\">$credit1</td><td align=\"right\">$debittot</td><td align=\"right\">$credittot</td><td>$status</td><td>$explanation1</td></tr>";

    if($disbursementnumber1 != $disbursementnumber0)
    {
      $debittot = 0; $credittot = 0;
      $debittot = $debittot + $debit1;
      $credittot = $credittot + $credit1;
    }

    if(($status != "pending") && ($status == "finalized")) {
			//
			// check tblfindisbursementtot if disbursementnumber exists else insert row
			//
				$result3=""; $found3=0;
				$result3 = mysql_query("SELECT disbursementtotid, disbursementnumber, date FROM tblfindisbursementtot WHERE disbursementnumber=\"$disbursementnumber1\"", $db24);
				if($result3 != "") {
					while($myrow3 = mysql_fetch_row($result3)) {
					$found3 = 1;
					$disbursementtotid3 = $myrow3[0];
					$disbursementnumber3 = $myrow3[1];
					$date3 = $myrow3[2];
					}
				}
				if($found3 != 1) {
	      	echo "<tr><td colspan=\"2\"><font color=\"green\">Saving</font></td><td><font color=\"green\"><b>$disbursementnumber1</b></font></td><td>$payee1</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align=\"right\">$debittot</td><td align=\"right\">$credittot</td><td>matched</td><td>$explanation1</td></tr>";

	      	$result2 = mysql_query("INSERT INTO tblfindisbursementtot SET disbursementnumber=\"$disbursementnumber1\", date=\"$date1\", explanation=\"$explanation1\", debittot=$debittot, credittot=$credittot, status=\"pending\"", $db24);
				}
    }

    $disbursementnumber0 = $disbursementnumber1;
    $disbursementnumber1 = "";
    $debit1 = 0; $credit1 = 0;
    $debittmp = 0; $credittmp = 0;
    $status = "";
  }

  echo "<tr><td colspan=\"10\"><b>ok-eof</b></td></tr>";

  echo "</table>";

echo "</body></html>";

mysql_close($db24);
mysql_close($db1);
?>