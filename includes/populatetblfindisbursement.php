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
echo "<tr><td>count</td><td>disbid</td><td>voucher</td><td>date</td><td>payee</td><td>glcode</td><td>projcode</td><td>particulars</td><td>debit</td><td>credit</td><td>type</td><td>explanation</td><td>action</td></tr>";

  $count1 = 0;
  $found1 = 0;

  $result1 = mysql_query("SELECT disbursementid, voucher, date, glcode, projcode, particulars, debit, credit, explanation, payee FROM disbursement WHERE disbursementid <> '' ORDER BY date ASC, voucher ASC", $db24);
  while ($myrow1 = mysql_fetch_row($result1))
  {
    $found1 = 1;

    $disbursementid1 = $myrow1[0];
    $voucher1 = trim($myrow1[1]);
    $date1 = $myrow1[2];
    $glcode1 = $myrow1[3];
    $projcode1 = $myrow1[4];
    $particulars1 = $myrow1[5];
    $debit1 = $myrow1[6];
    $credit1 = $myrow1[7];
    $explanation1 = $myrow1[8];
    $payee1 = $myrow1[9];

    $count1 = $count1 + 1;

// get only date and modify format
    $date2 = split(" ", $date1);
    $date0 = $date2[0];
    $time0 = $date2[1];

		$arrdate0 = split("/", $date0);
    $arrdate0mm = $arrdate0[0];
    $arrdate0dd = $arrdate0[1];
    $arrdate0yyyy = $arrdate0[2];

		$datenew = $arrdate0yyyy."-".$arrdate0mm."-".$arrdate0dd;

// remove P sign in value
    $debit2 = substr($debit1,3);
    $credit2 = substr($credit1,3);
// convert from string to double
    $debit3 = floatval($debit2);
    $credit3 = floatval($credit2);

    if (fnmatch("*DM*",$voucher1))
    { $vouchertype="Debit Memo"; }
    else { $vouchertype="Check"; }

//
// allow only dates from 2012-03-13 to 2014-01-31
//
	if(($datenew >= "2012-03-13" || $datenew >= "2012-3-13") && ($datenew <= "2014-01-31" || $datenew <= "2014-1-31"))
	{

		$result5=""; $found5=0;
		$result5 = mysql_query("SELECT disbursementid, disbursementnumber, disbursementtype, payee, date, glcode, projcode, particulars, debitamt, creditamt, explanation FROM tblfindisbursement WHERE disbursementnumber=\"$voucher1\" AND date=\"$datenew\" AND debitamt=$debit3 AND creditamt=$credit3 AND disbursementnumber NOT LIKE \"%.%\"", $db24);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$disbursementid5 = $myrow5[0];
			$disbursementnumber5 = $myrow5[1];
			$disbursementtype5 = $myrow5[2];
			$payee5 = $myrow5[3];
			$date5 = $myrow5[4];
			$glcode5 = $myrow5[5];
			$projcode5 = $myrow5[6];
			$particulars5 = $myrow5[7];
			$debitamt5 = $myrow5[8];
			$creditamt5 = $myrow5[9];
			$explanation5 = $myrow5[10];

		if (fnmatch("*DM*",$disbursementnumber5))
    { $vouchertype5="Debit Memo"; }
    else { $vouchertype5="Check"; }

			}
		}

		if($found5 == 1) {

    echo "<tr><td>$count1</td><td>$disbursementid5</td><td>$disbursementnumber5</td><td>$date5</td><td>$payee5</td><td>$glcode5</td><td>$projcode5</td><td>".nl2br($particulars5)."</td><td align=\"right\">$debitamt5</td><td align=\"right\">$creditamt5</td><td>$vouchertype5</td><td>".nl2br($explanation5)."</td><td><b>Exists</b></td></tr>";

		} else if($found5 == 0) {

    echo "<tr><td>$count1</td><td>$disbursementid1|$disbursementid5</td><td>$voucher1|$disbursementnumber5</td><td>$datenew|$date5</td><td>$payee1|$payee5</td><td>$glcode1|$glcode5</td><td>$projcode1|$projcode5</td><td>".nl2br($particulars1)."</td><td align=\"right\">$debit3</td><td align=\"right\">$credit3</td><td>$vouchertype</td><td>".nl2br($explanation1)."</td><td><font color=\"green\"><b>New - inserted</b></font></td></tr>";

    $result2 = mysql_query("INSERT INTO tblfindisbursement SET disbursementnumber=\"$voucher1\", disbursementtype=\"$vouchertype\", payee=\"$payee1\", date=\"$datenew\", glcode=\"$glcode1\", glrefver=1, projcode=\"$projcode1\", particulars=\"$particulars1\", debitamt=$debit3, creditamt=$credit3, explanation=\"$explanation1\"", $db24);

		}


    $voucher1 = ""; $vouchertype = "";
    $payee1 = ""; $date1 = ""; $glcode1 = ""; $projcode1 = ""; $particulars1 = "";
    $debit1 = ""; $credit1 = "";
    $debit2 = ""; $credit2 = "";
    $debit3 = 0; $credit3 = 0;

    $disbursementnumber5 = ""; $vouchertype5 = "";
    $payee5 = ""; $date5 = ""; $glcode5=""; $projcode5=""; $particulars5=""; $explanation5="";
    $debitamt5 = 0; $creditamt5 = 0;
	}

  }

  echo "<tr><td colspan=\"10\"><b>ok-eof</b></td></tr>";

  echo "</table>";

echo "</body></html>";

mysql_close($db24);
?>
