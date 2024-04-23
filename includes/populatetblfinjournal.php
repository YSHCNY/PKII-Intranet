<?php
// this module will propagate records from mysql.db24.journal to mysql.db24.tblfinjournal

// db config
require('db24.php');

echo "<html><head><title>populate journal fr db24 to maindb</title>";
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

echo "<h3>module:insert fr mysql.db24.journal to mysql.db24.journal</h3>";

echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
echo "<tr><td colspan=12><b>I. Starting select query of disbursement...</b></td></tr>";
echo "<tr><td>count</td><td>journalid</td><td>voucher</td><td>date</td><td>glcode</td><td>projcode</td><td>particulars</td><td>debit</td><td>credit</td><td>explanation</td><td>action</td></tr>";

  $count1 = 0;
  $found1 = 0;

  $result1 = mysql_query("SELECT journalid, voucher, date, glcode, projcode, particulars, debit, credit, explanation FROM journal WHERE journalid <> '' ORDER BY date ASC, voucher ASC", $db24);
  while ($myrow1 = mysql_fetch_row($result1))
  {
    $found1 = 1;

    $journalid1 = $myrow1[0];
    $voucher1 = $myrow1[1];
    $date1 = $myrow1[2];
    $glcode1 = $myrow1[3];
    $projcode1 = $myrow1[4];
    $particulars1 = $myrow1[5];
    $debit1 = $myrow1[6];
    $credit1 = $myrow1[7];
    $explanation1 = $myrow1[8];

    $count1 = $count1 + 1;

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

//
// allow only dates from 2012-mar-01 to 2014-jan-31
//
	if(($datenew >= "2012-03-13" || $datenew >= "2012-3-13") && ($datenew <= "2014-01-31" || $datenew <= "2014-1-31")) {
		$result3=""; $found3=0;
		$result3 = mysql_query("SELECT journalid, journalnumber, date, glcode, projcode, particulars, debitamt, creditamt, explanation FROM tblfinjournal WHERE journalnumber=\"$voucher1\" AND glcode=\"$glcode1\" AND debitamt=\"$debit3\" AND creditamt=\"$credit3\"", $db24);
		if($result3 != "") {
			while($myrow3 = mysql_fetch_row($result3)) {
			$found3 = 1;
			$journalid3 = $myrow3[0];
			$journalnumber3 = $myrow3[1];
			$date3 = $myrow3[2];
			$glcode3 = $myrow3[3];
			$projcode3 = $myrow3[4];
			$particulars3 = $myrow3[5];
			$debitamt3 = $myrow3[6];
			$creditamt3 = $myrow3[7];
			$explanation3 = $myrow3[8];
			}
		}

		if($found3 == 1) {

    	echo "<tr><td>$count1</td><td>$journalid1</td><td>$voucher1|$journalnumber3</td><td>$date3</td><td>$glcode1</td><td>$projcode1</td><td>".nl2br($particulars1)."</td><td align=\"right\">$debit3</td><td align=\"right\">$credit3</td><td>".nl2br($explanation1)."</td><td>exists</td></tr>";

		} else if($found3 == 0) {

    	echo "<tr><td>$count1</td><td>$journalid1</td><td>$voucher1</td><td>$datenew</td><td>$glcode1</td><td>$projcode1</td><td>".nl2br($particulars1)."</td><td align=\"right\">$debit3</td><td align=\"right\">$credit3</td><td>".nl2br($explanation1)."</td><td><font color=\"green\">new-inserted</font></td></tr>";

    	$result2 = mysql_query("INSERT INTO tblfinjournal SET journalnumber=\"$voucher1\", date=\"$datenew\", glcode=\"$glcode1\", glrefver=1, projcode=\"$projcode1\", particulars=\"$particulars1\", debitamt=$debit3, creditamt=$credit3, explanation=\"$explanation1\"", $db24);

		}

	}		

    $voucher1 = "";
    $date1 = ""; $glcode1 = ""; $projcode1 = ""; $particulars1 = "";
    $debit1 = ""; $credit1 = "";
    $debit2 = ""; $credit2 = "";
    $debit3 = 0; $credit3 = 0;

		$journalnumber3 = "";
		$date3=""; $glcode3=""; $projcode3=""; $particular3="";
		$debitamt3=0; $creditamt3=0;
		$explanation3="";
  }

  echo "<tr><td colspan=\"12\"><b>ok-eof</b></td></tr>";

  echo "</table>";

echo "</body></html>";

mysql_close($db24);
?>
