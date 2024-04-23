<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$wpgendate = (isset($_GET['gd'])) ? $_GET['gd'] :'';

// $glcode0 = $_POST['glcode'];
$wpacctcd0 = (isset($_POST['wpacctcd'])) ? $_POST['wpacctcd'] :'';
$debitamt0 = (isset($_POST['debitamt'])) ? $_POST['debitamt'] :'';
$creditamt0 = (isset($_POST['creditamt'])) ? $_POST['creditamt'] :'';

$cutarrwpgendate = explode("-", $wpgendate);
$wpgenyear = $cutarrwpgendate[0];
$wpgenmonth = $cutarrwpgendate[1];

$wpgencutstart = $wpgendate."-"."01";
$wpgencutend = date('Y-m-t', strtotime("$wpgenyear-$wpgenmonth-01")); //20230529
// $wpgencutend = $wpgenyear."-".($wpgenmonth+1)."-"."01";
// $wpgencutend = date("Y-m-d", strtotime('-1 day', $wpgencutend));
// $wpgencutend = date("Y-m-d", strtotime("$wpgencutend"));

$wpgendate2 = date("Y-M", strtotime("$wpgendate"));

$result11 = mysql_query("SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"", $dbh);
if($result11 != '')
{
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $version11 = $myrow11[0];
  }
}
$glrefver = $version11;
// echo "vartest cutstart:glver:$glrefver, wpdt:$wpgendate, start:$wpgencutstart, end:$wpgencutend, wpyr:$wpgenyear, wpmo:$wpgenmonth<br>";

$status = "active";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}  

if ($found == 1)
{
?>

<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript">
	$(function() {
		$("#exportToExcel").click(function() {
			var data='<table>' + $("#ReportTable").html().replace(/<a\/?[^>]+>/gi,'')+'</table>';
			$('body').prepend("<form method='post' action='exportexcel.php' style='display:none' id='ReportTableData'><input type='text' name='tableData' value='"+data+"'></form>");
			$('#ReportTableData').submit().remove();
	});
});
</script>

<?php
     include ("header.php");
     include ("sidebar.php");

// start contents here

if($glrefver == 1)
{
// insert header
echo "<table class=\"fin\" border=\"1\">";

echo "<tr><th colspan=\"19\" align=\"left\">PKII Working Paper for $wpgendate2</th></tr>";

    echo "<tr><th>&nbsp;</th><th colspan=\"2\" align=\"center\">Account</th><th colspan=\"2\" align=\"center\">Beginning Balance</th><th colspan=\"2\" align=\"center\">Cash Disbursement</th><th colspan=\"2\" align=\"center\">Cash Receipt</th><th colspan=\"2\" align=\"center\">Journal Book</th><th colspan=\"2\" align=\"center\">Trial Balance</th><th colspan=\"2\" align=\"center\">Balance Sheet</th><th colspan=\"2\" align=\"center\">Income Statement</th></tr>";
    echo "<tr><th align=\"center\">Count</th><th align=\"center\">AcctCode</th><th align=\"center\">AcctName</th><th align=\"center\">Debit</th><th align=\"center\">Credit</th><th align=\"center\">Debit</th><th align=\"center\">Credit</th><th align=\"center\">Debit</th><th align=\"center\">Credit</th><th align=\"center\">Debit</th><th align=\"center\">Credit</th><th align=\"center\">Debit</th><th align=\"center\">Credit</th><th align=\"center\">Debit</th><th align=\"center\">Credit</th><th align=\"center\">Debit</th><th align=\"center\">Credit</th></tr>";

	// initialize
  $begbalancedrtot=0; $begbalancecrtot=0; $cashdisbursementdrtot=0; $cashdisbursementcrtot=0; $cashreceiptdrtot=0; $cashreceiptcrtot=0; $journaldrtot=0; $journalcrtot=0; $trialbalancedrtot=0; $trialbalancecrtot=0; $balancesheetdrtot=0; $balancesheetcrtot=0; $incomestatementdrtot=0; $incomestatementcrtot=0; $balancesheetdrdiff=0; $balancesheetcrdiff=0; $incomestatementdrdiff=0; $incomestatementcrdiff=0; $balancesheetdrgrandtot=0; $balancesheetcrgrandtot=0; $incomestatementdrgrandtot=0; $incomestatementcrgrandtot=0;
    $acctspayabledrtot=0; $acctspayablecrtot=0;

//
// insert queries for version=1
//
  for ($i = 0; $i < count($glcode0) && $i < count($debitamt0) && $i < count($creditamt0); ++$i)
  {
    $begbalancedr=0; $begbalancecr=0;
    $cashdisbursementdr=0; $cashdisbursementcr=0;
    $cashreceiptdr=0; $cashreceiptcr=0;
    $journaldr=0; $journalcr=0;
    $trialbalancedr=0; $trialbalancecr=0;
    $balancesheetdr=0; $balancesheetcr=0;
    $incomestatementdr=0; $incomestatementcr=0;
    $acctspayabledr=0; $acctspayablecr=0;

    $glcode = $glcode0[$i];
    $begbalancedr = $debitamt0[$i];
    $begbalancecr = $creditamt0[$i];

    $begbalancedrtot = $begbalancedrtot + $begbalancedr;
    $begbalancecrtot = $begbalancecrtot + $begbalancecr;

    $count = $count + 1;
    echo "<tr><td align=\"center\">$count</td><td>$glcode</td>";
    $result11 = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode\" AND version=$glrefver", $dbh);
    if($result11 != "")
    {
      while($myrow11 = mysql_fetch_row($result11))
      {
	$found11 = 1;
	$glname11 = $myrow11[0];
      }
    }
    echo "<td>$glname11</td><td align=\"right\">$begbalancedr</td><td align=\"right\">$begbalancecr</td>";

    // compute cash disb
    $result12 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"$glcode\" AND date>=\"$wpgencutstart\" AND date<\"$wpgencutend\"", $dbh);
    if($result12 != "") {
      while($myrow12 = mysql_fetch_row($result12))
      {
	$found12 = 1;
	$debitamt12 = $myrow12[0];
	$creditamt12 = $myrow12[1];
	$cashdisbursementdr = $cashdisbursementdr + $debitamt12;
	$cashdisbursementcr = $cashdisbursementcr + $creditamt12;
      }
    }
    if($glcode == "10.10.400") {
      $result24 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE date>=\"$wpgencutstart\" AND date<\"$wpgencutend\" AND glcode>=\"10.10.401\" AND glcode<=\"10.10.423\"", $dbh);
      if($result24 != '') {
        while($myrow24 = mysql_fetch_row($result24)) {
        $found24 = 1;
        $debitamt24 = $myrow24[0];
        $creditamt24 = $myrow24[1];
	if($glcode != "10.10.400-1") {
	  $cashdisbursementdr = $cashdisbursementdr + $debitamt24;
	  $cashdisbursementcr = $cashdisbursementcr + $creditamt24; }
        }
      }
    }
    if($glcode == "10.10.500") {
      $result24 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE date>=\"$wpgencutstart\" AND date<\"$wpgencutend\" AND glcode>=\"10.10.500\" AND glcode<=\"10.10.505\"", $dbh);
      if($result24 != '') {
        while($myrow24 = mysql_fetch_row($result24)) {
        $found24 = 1;
        $debitamt24 = $myrow24[0];
        $creditamt24 = $myrow24[1];
        $cashdisbursementdr = $cashdisbursementdr + $debitamt24;
        $cashdisbursementcr = $cashdisbursementcr + $creditamt24;
        }
      }
    }
    if($glcode == "60.00.000") {
      $result18 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE date>=\"$wpgencutstart\" AND date<\"$wpgencutend\" AND glcode LIKE \"60.%\"", $dbh);
      if($result18 != '') {
	while ($myrow18 = mysql_fetch_row($result18)) {
	  $found18 = 1;
	  $debitamt18 = $myrow18[0];
	  $creditamt18 = $myrow18[1];
	  $cashdisbursementdr = $cashdisbursementdr + $debitamt18;
	  $cashdisbursementcr = $cashdisbursementcr + $creditamt18;
	}
      }
    }
    else if($glcode == "70.00.000") {
      $result19 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE date>=\"$wpgencutstart\" AND date<\"$wpgencutend\" AND glcode LIKE \"70.%\"", $dbh);
      if($result19 != '') {
	while ($myrow19 = mysql_fetch_row($result19)) {
	  $found19 = 1;
	  $debitamt19 = $myrow19[0];
	  $creditamt19 = $myrow19[1];
	  $cashdisbursementdr = $cashdisbursementdr + $debitamt19;
	  $cashdisbursementcr = $cashdisbursementcr + $creditamt19;
	}
      }
    }
    $cashdisbursementdrtot = $cashdisbursementdrtot + $cashdisbursementdr;
    $cashdisbursementcrtot = $cashdisbursementcrtot + $cashdisbursementcr;
    echo "<td align=\"right\">$cashdisbursementdr</td><td align=\"right\">$cashdisbursementcr</td>";

    // compute accts payable // 20210215
    $res28query=""; $result28=""; $found28=0; $ctr28=0;
    $res28query="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE glcode=\"$glcode\" AND date BETWEEN CAST(\"$wpgencutstart\" AS DATE) AND CAST(\"$wpgencutend\", AS DATE)";
    $result28=$dbh2->query($res28query);
    if($result28->num_rows>0) {
        while($myrow28=$result28->fetch_assoc()) {
        $found28 = 1;
        $debitamt28 = $myrow28['debitamt'];
        $creditamt28 = $myrow28['creditamt'];
        $acctspayabledr = $acctspayabledr + $debitamt28;
        $acctspayablecr = $acctspayablecr + $creditamt28;
        } //while
    } //if
    if($glcode == "10.10.400") {
        $res29query=""; $result29=""; $found29=0; $ctr29=0;
        $res29query="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE date BETWEEN CAST(\"$wpgencutstart\" AS DATE) AND CAST(\"$wpgencutend\" AS DATE) AND (glcode>=\"10.10.401\" AND glcode<=\"10.10.423\")";
        $result29=$dbh2->query($res29query);
        if($result29->num_rows>0) {
            while($myrow29=$result29->fetch_assoc()) {
            $found29 = 1;
            $debitamt29 = $myrow29['debitamt'];
            $creditamt29 = $myrow29['creditamt'];
            if($glcode != "10.10.400-1") {
                $acctspayabledr = $acctspayabledr + $debitamt29;
                $acctspayablecr = $acctspayablecr + $creditamt29;
            } //if
            } //while
        } //if
    } //if
    if($glcode == "10.10.500") {
        $res30query=""; $result30=""; $found30=0;
        $res30query="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE date BETWEEN CAST(\"$wpgencutstart\" AS DATE) AND CAST(\"$wpgencutend\" AS DATE) AND (glcode>=\"10.10.500\" AND glcode<=\"10.10.505\")";
        $result30=$dbh2->query($res30query);
        if($result30->num_rows>0) {
            while($myrow30=$result30->fetch_assoc()) {
            $found30 = 1;
            $debitamt30 = $myrow30['debitamt'];
            $creditamt30 = $myrow30['creditamt'];
            $acctspayabledr = $acctspayabledr + $debitamt30;
            $acctspayablecr = $acctspayablecr + $creditamt30;            
            } //while
        } //if
    } //if
    if($glcode == "60.00.000") {
        $res31query=""; $result31=""; $found31=0; $ctr31=0;
        $res31query="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE date BETWEEN CAST(\"$wpgencutstart\" AS DATE) AND CAST(\"$wpgencutend\" AS DATE) AND glcode LIKE \"60.%\"";
        $result31=$dbh2->query($res31query);
        if($result31->num_rows>0) {
            while($myrow31=$result31->fetch_assoc()) {
            $found31 = 1;
            $debitamt31 = $myrow31['debitamt'];
            $creditamt31 = $myrow31['creditamt'];
            $acctspayabledr = $acctspayabledr + $debitamt31;
            $acctspayablecr = $acctspayablecr + $creditamt31;
            } //while
        } //if
    } //if
    if($glcode == "70.00.000") {
        $res32query=""; $result32=""; $found32=0; $ctr32=0;
        $res32query="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE date BETWEEN (CAST\"$wpgencutstart\" AS DATE) AND CAST(\"$wpgencutend\" AS DATE) AND glcode LIKE \"70.%\"";
        $result32=$dbh2->query($res32query);
        if($result32->num_rows>0) {
            while($myrow32=$result32->fetch_assoc()) {
            $found32 = 1;
            $debitamt32 = $myrow32['debitamt'];
            $creditamt32 = $myrow32['creditamt'];
            $acctspayabledr = $acctspayabledr + $debitamt32;
            $acctspayablecr = $acctspayablecr + $creditamt32;
            } //while
        } //if
    } //if
    $acctspayabledrtot = $acctspayabledrtot + $acctspayabledr;
    $acctspayablecrtot = $acctspayablecrtot + $acctspayablecr;
    echo "<td align=\"right\">$acctspayabledr</td><td align=\"right\">$acctspayablecr</td>";

    // compute cash receipt
    $result14 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"$glcode\" AND date>=\"$wpgencutstart\" AND date<\"$wpgencutend\"", $dbh);
    if($result14 != "")
    {
      while($myrow14 = mysql_fetch_row($result14))
      {
	$found14 = 1;
	$debitamt14 = $myrow14[0];
	$creditamt14 = $myrow14[1];
	$cashreceiptdr = $cashreceiptdr + $debitamt14;
	$cashreceiptcr = $cashreceiptcr + $creditamt14;
      }
    }
    if($glcode == "10.10.400") {
      $result25 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE date>=\"$wpgencutstart\" AND date<\"$wpgencutend\" AND glcode>=\"10.10.401\" AND glcode<=\"10.10.423\"", $dbh);
      if($result25 != '') {
        while($myrow25 = mysql_fetch_row($result25)) {
        $found25 = 1;
        $debitamt25 = $myrow25[0];
        $creditamt25 = $myrow25[1];
        $cashreceiptdr = $cashreceiptdr + $debitamt25;
        $cashreceiptcr = $cashreceiptcr + $creditamt25;
        }
      }
    }
    if($glcode == "10.10.500") {
      $result25 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE date>=\"$wpgencutstart\" AND date<\"$wpgencutend\" AND glcode>=\"10.10.500\" AND glcode<=\"10.10.505\"", $dbh);

      if($result25 != '') {
        while($myrow25 = mysql_fetch_row($result25)) {
        $found25 = 1;
        $debitamt25 = $myrow25[0];
        $creditamt25 = $myrow25[1];
        $cashreceiptdr = $cashreceiptdr + $debitamt25;
        $cashreceiptcr = $cashreceiptcr + $creditamt25;
        }
      }
    }
    if($glcode == "60.00.000") {
      $result20 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE date>=\"$wpgencutstart\" AND date<\"$wpgencutend\" AND glcode LIKE \"60.%\"", $dbh);
      if($result20 != '') {
	while ($myrow20 = mysql_fetch_row($result20)) {
	  $found20 = 1;
	  $debitamt20 = $myrow20[0];
	  $creditamt20 = $myrow20[1];
	  $cashreceiptdr = $cashreceiptdr + $debitamt20;
	  $cashreceiptcr = $cashreceiptcr + $creditamt20;
	}
      }
    }
    else if($glcode == "70.00.000") {
      $result21 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE date>=\"$wpgencutstart\" AND date<\"$wpgencutend\" AND glcode LIKE \"70.%\"", $dbh);
      if($result21 != '') {
	while ($myrow21 = mysql_fetch_row($result21)) {
	  $found21 = 1;
	  $debitamt21 = $myrow21[0];
	  $creditamt21 = $myrow21[1];
	  $cashreceiptdr = $cashreceiptdr + $debitamt21;
	  $cashreceiptcr = $cashreceiptcr + $creditamt21;
	}
      }
    }
    $cashreceiptdrtot = $cashreceiptdrtot + $cashreceiptdr;
    $cashreceiptcrtot = $cashreceiptcrtot + $cashreceiptcr;
    echo "<td align=\"right\">$cashreceiptdr</td><td align=\"right\">$cashreceiptcr</td>";

    // compute journal
    $result15 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"$glcode\" AND date>=\"$wpgencutstart\" AND date<\"$wpgencutend\"", $dbh);
    if($result15 != "")
    {
      while($myrow15 = mysql_fetch_row($result15))
      {
	$found15 = 1;
	$debitamt15 = $myrow15[0];
	$creditamt15 = $myrow15[1];
	$journaldr = $journaldr + $debitamt15;
	$journalcr = $journalcr + $creditamt15;
      }
    }
    if($glcode == "10.10.400") {
      $result26 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE date>=\"$wpgencutstart\" AND date<\"$wpgencutend\" AND glcode>=\"10.10.401\" AND glcode<=\"10.10.423\"", $dbh);
      if($result26 != '') {
        while($myrow26 = mysql_fetch_row($result26)) {
        $found26 = 1;
        $debitamt26 = $myrow26[0];
        $creditamt26 = $myrow26[1];
        $journaldr = $journaldr + $debitamt26;
        $journalcr = $journalcr + $creditamt26;
        }
      }
    }
    if($glcode == "10.10.500") {
      $result27 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE date>=\"$wpgencutstart\" AND date<\"$wpgencutend\" AND glcode>=\"10.10.500\" AND glcode<=\"10.10.505\"", $dbh);
      if($result27 != '') {
        while($myrow27 = mysql_fetch_row($result27)) {
        $found27 = 1;
        $debitamt27 = $myrow27[0];
        $creditamt27 = $myrow27[1];
        $journaldr = $journaldr + $debitamt27;
        $journalcr = $journalcr + $creditamt27;
        }
      }
    }
    if($glcode == "60.00.000") {
      $result22 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE date>=\"$wpgencutstart\" AND date<\"$wpgencutend\" AND glcode LIKE \"60.%\"", $dbh);
      if($result22 != '') {
	while ($myrow22 = mysql_fetch_row($result22)) {
	  $found22 = 1;
	  $debitamt22 = $myrow22[0];
	  $creditamt22 = $myrow22[1];
	  $journaldr = $journaldr + $debitamt22;
	  $journalcr = $journalcr + $creditamt22;
	}
      }
    }
    else if($glcode == "70.00.000") {
      $result23 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE date>=\"$wpgencutstart\" AND date<\"$wpgencutend\" AND glcode LIKE \"70.%\"", $dbh);
      if($result23 != '') {
	while ($myrow23 = mysql_fetch_row($result23)) {
	  $found23 = 1;
	  $debitamt23 = $myrow23[0];
	  $creditamt23 = $myrow23[1];
	  $journaldr = $journaldr + $debitamt23;
	  $journalcr = $journalcr + $creditamt23;
	}
      }
    }
    $journaldrtot = $journaldrtot + $journaldr;
    $journalcrtot = $journalcrtot + $journalcr;
    echo "<td align=\"right\">$journaldr</td><td align=\"right\">$journalcr</td>";

    // compute trial balance
    // $trialbalancedrval = $begbalancedr - $begbalancecr + $cashdisbursementdr - $cashdisbursementcr + $cashreceiptdr - $cashreceiptcr + $journaldr - $journalcr;
    $trialbalancedrval = ($begbalancedr + $cashdisbursementdr + $acctspayabledr + $cashreceiptdr + $journaldr)
- ($begbalancecr + $cashdisbursementcr + $acctspayablecr + $cashreceiptcr + $journalcr);
    $trialbalancecrval = 0;
    if($trialbalancedrval < 0) {
      $trialbalancedrval = 0;
      // $trialbalancecrval = - $begbalancedr + $begbalancecr - $cashdisbursementdr + $cashdisbursementcr - $cashreceiptdr + $cashreceiptcr - $journaldr + $journalcr;
      $trialbalancecrval = - ($begbalancecr + $cashdisbursementcr + $acctspayablecr + $cashreceiptcr + $journalcr) - ($begbalancedr + $cashdisbursementdr + $acctspayabledr + $cashreceiptdr + $journaldr);
    } else {
      $trialbalancecrval = ($begbalancecr + $cashdisbursementcr + $acctspayablecr + $cashreceiptcr + $journalcr) - ($begbalancedr + $cashdisbursementdr + $acctspayabledr + $cashreceiptdr + $journaldr);
    } //if-else
    $trialbalancedrtot = $trialbalancedrtot + $trialbalancedrval;
    $trialbalancecrtot = $trialbalancecrtot + $trialbalancecrval;
    echo "<td align=\"right\">$trialbalancedrval</td><td align=\"right\">$trialbalancecrval</td>";

    // compute balance sheet
    if($glcode>="10.10.101" && $glcode<="30.90.999")
    {
      if($glcode!="20.10.214")
      {
	$balancesheetdr = $trialbalancedrval;
	$balancesheetcr = $trialbalancecrval;
	$balancesheetdrtot = $balancesheetdrtot + $balancesheetdr;	
	$balancesheetcrtot = $balancesheetcrtot + $balancesheetcr;
	echo "<td align=\"right\">$balancesheetdr</td><td align=\"right\">$balancesheetcr</td>";
      }
    }
    else { echo "<td>-</td><td>-</td>"; }

    // compute income statement
    if($glcode>="40.10.000" && $glcode<="70.00.000")
    {
      $incomestatementdr = $trialbalancedrval;
      $incomestatementcr = $trialbalancecrval;
      echo "<td align=\"right\">$incomestatementdr</td><td align=\"right\">$incomestatementcr</td>";
    }
    else if($glcode=="20.10.214")
    {
      $incomestatementdr = $trialbalancedrval;
      $incomestatementcr = $trialbalancecrval;
      echo "<td align=\"right\">$incomestatementdr</td><td align=\"right\">$incomestatementcr</td>";
    }
    else { echo "<td>-</td><td>-</td>"; }
    $incomestatementdrtot = $incomestatementdrtot + $incomestatementdr;
    $incomestatementcrtot = $incomestatementcrtot + $incomestatementcr;
    echo "</tr>";

    if($begbalancedr>0 || $begbalancecr>0 || $cashdisbursementdr>0 || $cashdisbursementcr>0 || $cashreceiptdr>0 || $cashreceiptcr>0 || $journaldr>0 || $journalcr>0 || $trialbalancedrval>0 || $trialbalancecrval>0 || $balancesheetdr>0 || $balancesheetcr>0 || $incomestatementdr>0 || $incomestatementcr>0) {
    $result12 = mysql_query("INSERT INTO tblfinworkpaper SET month=\"$wpgencutstart\", glcode=\"$glcode\", glrefver=$glrefver, begbalancedr='$begbalancedr', begbalancecr='$begbalancecr', cashdisbursementdr='$cashdisbursementdr', cashdisbursementcr='$cashdisbursementcr', cashreceiptdr='$cashreceiptdr', cashreceiptcr='$cashreceiptcr', journaldr='$journaldr', journalcr='$journalcr', trialbalancedr='$trialbalancedrval', trialbalancecr='$trialbalancecrval', balancesheetdr='$balancesheetdr', balancesheetcr='$balancesheetcr', incomestatementdr='$incomestatementdr', incomestatementcr='$incomestatementcr'", $dbh);
    }
  }
  echo "<tr><th></th><th></th><th align=\"center\">Total</th><th align=\"right\">".number_format($begbalancedrtot,2)."</th><th align=\"right\">".number_format($begbalancecrtot,2)."</th><th align=\"right\">".number_format($cashdisbursementdrtot,2)."</th><th align=\"right\">".number_format($cashdisbursementcrtot,2)."</th><th align=\"right\">".number_format($cashreceiptdrtot,2)."</th><th align=\"right\">".number_format($cashreceiptcrtot,2)."</th><th align=\"right\">".number_format($journaldrtot,2)."</th><th align=\"right\">".number_format($journalcrtot,2)."</th><th align=\"right\">".number_format($trialbalancedrtot,2)."</th><th align=\"right\">".number_format($trialbalancecrtot,2)."</th><td align=\"right\">".number_format($balancesheetdrtot,2)."</td><td align=\"right\">".number_format($balancesheetcrtot,2)."</td><td align=\"right\">".number_format($incomestatementdrtot,2)."</td><td align=\"right\">".number_format($incomestatementcrtot,2)."</td></tr>";

  echo "<tr><td colspan=\"13\"></td>";
  if($balancesheetdrtot > $balancesheetcrtot)
  {
    $balancesheetdrdiff = $balancesheetdrtot - $balancesheetcrtot;
    echo "<td></td><th align=\"right\">".number_format($balancesheetdrdiff,2)."</th>";
  }
  else
  {
    $balancesheetcrdiff = $balancesheetcrtot - $balancesheetdrtot;
    echo "<th align=\"right\">".number_format($balancesheetcrdiff,2)."</th><td></td>";
  }

  if($incomestatementdrtot > $incomestatementcrtot)
  {
    $incomestatementdrdiff = $incomestatementdrtot - $incomestatementcrtot;
    echo "<td></td><th align=\"right\">".number_format($incomestatementdrdiff,2)."</th>";
  }
  else
  {

    $incomestatementcrdiff = $incomestatementcrtot - $incomestatementdrtot;
    echo "<th align=\"right\">".number_format($incomestatementcrdiff,2)."</th><td></td>";
  }
  echo "</tr>";

  echo "<tr><td colspan=\"13\"></td>";
  if($balancesheetcrdiff != "")
  {
    $balancesheetdrgrandtot = $balancesheetdrtot + $balancesheetcrdiff;
    $balancesheetcrgrandtot = $balancesheetcrtot;
    echo "<th align=\"right\">".number_format($balancesheetdrgrandtot,2)."</th><th align=\"right\">".number_format($balancesheetcrgrandtot,2)."</th>";
  }
  else if($balancesheetdrdiff != "")
  {
    $balancesheetcrgrandtot = $balancesheetcrtot + $balancesheetdrdiff;
    $balancesheetdrgrandtot = $balancesheetdrtot;
    echo "<th align=\"right\">".number_format($balancesheetdrgrandtot,2)."</th><th align=\"right\">".number_format($balancesheetcrgrandtot,2)."</th>";
  }
  if($incomestatementcrdiff != "")
  {
    $incomestatementdrgrandtot = $incomestatementdrtot + $incomestatementcrdiff;
    $incomestatementcrgrandtot = $incomestatementcrtot;
    echo "<th align=\"right\">".number_format($incomestatementdrgrandtot,2)."</th><th align=\"right\">".number_format($incomestatementcrgrandtot,2)."</th>";
  }
  else if($incomestatementdrdiff != "")
  {
    $incomestatementcrgrandtot = $incomestatementcrtot + $incomestatementdrdiff;
    $incomestatementdrgrandtot = $incomestatementdrtot;
    echo "<th align=\"right\">".number_format($incomestatementdrgrandtot,2)."</th><th align=\"right\">".number_format($incomestatementcrgrandtot,2)."</th>";
  }
  echo "</tr>";

  $result14 = mysql_query("INSERT INTO tblfinworkpapertot SET month=\"$wpgencutstart\", begbalancedr=$begbalancedrtot, begbalancecr=$begbalancecrtot, cashdisbursementdr=$cashdisbursementdrtot, cashdisbursementcr=$cashdisbursementcrtot, cashreceiptdr=$cashreceiptdrtot, cashreceiptcr=$cashreceiptcrtot, journaldr=$journaldrtot, journalcr=$journalcrtot, trialbalancedr=$trialbalancedrtot, trialbalancecr=$trialbalancecrtot, balancesheetdr=$balancesheetdrtot, balancesheetcr=$balancesheetcrtot, incomestatementdr=$incomestatementdrtot, incomestatementcr=$incomestatementcrtot, balancesheetdrdiff=$balancesheetdrdiff, balancesheetcrdiff=$balancesheetcrdiff, incomestatementdrdiff=$incomestatementdrdiff, incomestatementcrdiff=$incomestatementcrdiff, balancesheetdrgrandtot=$balancesheetdrgrandtot, balancesheetcrgrandtot=$balancesheetcrgrandtot, incomestatementdrgrandtot=$incomestatementdrgrandtot, incomestatementcrgrandtot=$incomestatementcrgrandtot, status=\"$status\", remarks=''", $dbh);
}


else if($glrefver == 2) {

// insert header
echo "<table class=\"fin\" border=\"1\" id=\"ReportTable\">";

echo "<tr><th colspan=\"19\" align=\"left\">PKII Working Paper for $wpgendate2&nbsp;<a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a>";
// echo "<br>$wpgencutstart - $wpgencutend";
echo "</th></tr>";

    echo "<tr><th>&nbsp;</th><th colspan=\"2\" align=\"center\">Account</th>";
    echo "<th colspan=\"2\" align=\"center\">Beginning Balance</th>";
    echo "<th colspan=\"2\" align=\"center\">Cash Disbursement</th>";
    echo "<th colspan=\"2\" align=\"center\">Accts Payable</th>";
    echo "<th colspan=\"2\" align=\"center\">Cash Receipt</th>";
    echo "<th colspan=\"2\" align=\"center\">Journal Book</th>";
    echo "<th colspan=\"2\" align=\"center\">Trial Balance</th>";
    echo "<th colspan=\"2\" align=\"center\">Balance Sheet</th>";
    echo "<th colspan=\"2\" align=\"center\">Income Statement</th></tr>";

    echo "<tr><th align=\"center\">Count</th><th align=\"center\">AcctCode</th><th align=\"center\">AcctName</th>";
    echo "<th align=\"center\">Debit</th><th align=\"center\">Credit</th>"; // beg balance
    echo "<th align=\"center\">Debit</th><th align=\"center\">Credit</th>"; // cash disbursement
    echo "<th align=\"center\">Debit</th><th align=\"center\">Credit</th>"; // accts payable
    echo "<th align=\"center\">Debit</th><th align=\"center\">Credit</th>"; // cash receipts
    echo "<th align=\"center\">Debit</th><th align=\"center\">Credit</th>"; // journal
    echo "<th align=\"center\">Debit</th><th align=\"center\">Credit</th>"; // trial balance
    echo "<th align=\"center\">Debit</th><th align=\"center\">Credit</th>"; // balance sheet
    echo "<th align=\"center\">Debit</th><th align=\"center\">Credit</th></tr>"; // income statement

	// initialize
  $begbalancedrtot=0; $begbalancecrtot=0; $cashdisbursementdrtot=0; $cashdisbursementcrtot=0; $cashreceiptdrtot=0; $cashreceiptcrtot=0; $journaldrtot=0; $journalcrtot=0; $trialbalancedrtot=0; $trialbalancecrtot=0; $balancesheetdrtot=0; $balancesheetcrtot=0; $incomestatementdrtot=0; $incomestatementcrtot=0; $balancesheetdrdiff=0; $balancesheetcrdiff=0; $incomestatementdrdiff=0; $incomestatementcrdiff=0; $balancesheetdrgrandtot=0; $balancesheetcrgrandtot=0; $incomestatementdrgrandtot=0; $incomestatementcrgrandtot=0;
    $acctspayabledrtot=0; $acctspayablecrtot=0;

//
// insert queries here for glrefver=2
//
  for ($i = 0; $i < count($wpacctcd0) && $i < count($debitamt0) && $i < count($creditamt0); ++$i) {
    $begbalancedr=0; $begbalancecr=0;
    $cashdisbursementdr=0; $cashdisbursementcr=0;
    $cashreceiptdr=0; $cashreceiptcr=0;
    $journaldr=0; $journalcr=0;
    $trialbalancedr=0; $trialbalancecr=0;
    $balancesheetdr=0; $balancesheetcr=0;
    $incomestatementdr=0; $incomestatementcr=0;
    $acctspayabledr=0; $acctspayablecr=0;

    // $glcode = $glcode0[$i];
		$wpacctcd = $wpacctcd0[$i];
    $begbalancedr = $debitamt0[$i];
    $begbalancecr = $creditamt0[$i];

    $begbalancedrtot = $begbalancedrtot + $begbalancedr;
    $begbalancecrtot = $begbalancecrtot + $begbalancecr;

    $count = $count + 1;
    echo "<tr><td align=\"center\">$count</td><td>$wpacctcd</td>";

		// query wpacctname
		$result10=""; $found10=0; $count10=0;
		$result10 = mysql_query("SELECT tblfinworkpaperref.wpacctname FROM tblfinworkpaperref WHERE tblfinworkpaperref.wpacctcd=\"$wpacctcd\" AND tblfinworkpaperref.glrefver=$glrefver", $dbh);
		if($result10 != "") {
			while($myrow10 = mysql_fetch_row($result10)) {
			$found10 = 1;
			$wpacctname10 = $myrow10[0];
			}
		}
    echo "<td>$wpacctname10</td><td align=\"right\">".number_format($begbalancedr,2)."</td><td align=\"right\">".number_format($begbalancecr,2)."</td>";

    // compute cash disb
    $result12 = mysql_query("SELECT tblfinworkpaperref.glcode, tblfindisbursement.debitamt, tblfindisbursement.creditamt FROM tblfinworkpaperref LEFT JOIN tblfindisbursement ON tblfinworkpaperref.glcode=tblfindisbursement.glcode WHERE tblfinworkpaperref.wpacctcd=\"$wpacctcd\" AND tblfindisbursement.date BETWEEN CAST(\"$wpgencutstart\" AS DATE) AND CAST(\"$wpgencutend\" AS DATE) AND tblfindisbursement.glrefver=$glrefver ORDER BY tblfinworkpaperref.seq ASC", $dbh);
    if($result12 != "") {
      while($myrow12 = mysql_fetch_row($result12)) {
				$found12 = 1;
				$glcode12 = $myrow12[0];
				$debitamt12 = $myrow12[1];
				$creditamt12 = $myrow12[2];
				$cashdisbursementdr = $cashdisbursementdr + $debitamt12;
				$cashdisbursementcr = $cashdisbursementcr + $creditamt12;
      }
    }
    $cashdisbursementdrtot = $cashdisbursementdrtot + $cashdisbursementdr;
    $cashdisbursementcrtot = $cashdisbursementcrtot + $cashdisbursementcr;
    echo "<td align=\"right\">".number_format($cashdisbursementdr,2)."</td><td align=\"right\">".number_format($cashdisbursementcr,2)."</td>";

    // compute accts payable // 20210215
    $res33query=""; $result33=""; $found33=0; $ctr33=0; $debitamt33=0; $creditamt33=0;
    $res33query="SELECT tblfinworkpaperref.glcode, tblfinacctspayable.debitamt, tblfinacctspayable.creditamt FROM tblfinworkpaperref LEFT JOIN tblfinacctspayable ON tblfinworkpaperref.glcode=tblfinacctspayable.glcode WHERE tblfinworkpaperref.wpacctcd=\"$wpacctcd\" AND tblfinacctspayable.date BETWEEN CAST(\"$wpgencutstart\" AS DATE) AND CAST(\"$wpgencutend\" AS DATE) AND tblfinacctspayable.glrefver=$glrefver ORDER BY tblfinworkpaperref.seq ASC";
    // $res33query="SELECT tblfinworkpaperref.glcode, tblfinacctspayable.acctspayablenumber, tblfinacctspayable.date, tblfinacctspayable.debitamt, tblfinacctspayable.creditamt FROM tblfinworkpaperref LEFT JOIN tblfinacctspayable ON tblfinworkpaperref.glcode=tblfinacctspayable.glcode WHERE tblfinworkpaperref.wpacctcd=\"$wpacctcd\" AND tblfinacctspayable.date BETWEEN CAST(\"$wpgencutstart\" AS DATE) AND CAST(\"$wpgencutend\" AS DATE) ORDER BY tblfinacctspayable.date DESC";
    $result33=$dbh2->query($res33query);
    if($result33->num_rows>0) {
        while($myrow33=$result33->fetch_assoc()) {
				$found33 = 1;
				$glcode33 = $myrow33['glcode'];
//         $acctspayablenumber33 = $myrow33['acctspayablenumber'];
//         $date33 = $myrow33['date'];
				$debitamt33 = $myrow33['debitamt'];
				$creditamt33 = $myrow33['creditamt'];
// echo $wpacctcd.",".$acctspayablenumber33.",".$date33.",".$creditamt33.",";
				$acctspayabledr = $acctspayabledr + $debitamt33;
				$acctspayablecr = $acctspayablecr + $creditamt33;
// echo $acctspayablecr."<br>";
        } //while
    } //if
    $acctspayabledrtot = $acctspayabledrtot + $acctspayabledr;
    $acctspayablecrtot = $acctspayablecrtot + $acctspayablecr;
    echo "<td align=\"right\">".number_format($acctspayabledr,2)."</td><td align=\"right\">".number_format($acctspayablecr,2)."</td>";

		// compute cash receipt
    $result27 = mysql_query("SELECT tblfinworkpaperref.glcode, tblfincashreceipt.debitamt, tblfincashreceipt.creditamt FROM tblfinworkpaperref LEFT JOIN tblfincashreceipt ON tblfinworkpaperref.glcode=tblfincashreceipt.glcode WHERE tblfinworkpaperref.wpacctcd=\"$wpacctcd\" AND tblfincashreceipt.date BETWEEN CAST(\"$wpgencutstart\" AS DATE) AND CAST(\"$wpgencutend\" AS DATE) AND tblfincashreceipt.glrefver=$glrefver ORDER BY tblfinworkpaperref.seq ASC", $dbh);
    if($result27 != "") {
      while($myrow27 = mysql_fetch_row($result27)) {
				$found27 = 1;
				$glcode27 = $myrow27[0];
				$debitamt27 = $myrow27[1];
				$creditamt27 = $myrow27[2];
				$cashreceiptdr = $cashreceiptdr + $debitamt27;
				$cashreceiptcr = $cashreceiptcr + $creditamt27;
      }
    }
    $cashreceiptdrtot = $cashreceiptdrtot + $cashreceiptdr;
    $cashreceiptcrtot = $cashreceiptcrtot + $cashreceiptcr;
    echo "<td align=\"right\">".number_format($cashreceiptdr,2)."</td><td align=\"right\">".number_format($cashreceiptcr,2)."</td>";

		// compute journal
    $result34 = mysql_query("SELECT tblfinworkpaperref.glcode, tblfinjournal.debitamt, tblfinjournal.creditamt FROM tblfinworkpaperref LEFT JOIN tblfinjournal ON tblfinworkpaperref.glcode=tblfinjournal.glcode WHERE tblfinworkpaperref.wpacctcd=\"$wpacctcd\" AND tblfinjournal.date BETWEEN CAST(\"$wpgencutstart\" AS DATE) AND CAST(\"$wpgencutend\" AS DATE) AND tblfinjournal.glrefver=$glrefver ORDER BY tblfinworkpaperref.seq ASC", $dbh);
    if($result34 != "") {
      while($myrow34 = mysql_fetch_row($result34)) {
				$found34 = 1;
				$glcode34 = $myrow34[0];
				$debitamt34 = $myrow34[1];
				$creditamt34 = $myrow34[2];
				$journaldr = $journaldr + $debitamt34;
				$journalcr = $journalcr + $creditamt34;
      }
    }
    $journaldrtot = $journaldrtot + $journaldr;
    $journalcrtot = $journalcrtot + $journalcr;
    echo "<td align=\"right\">".number_format($journaldr,2)."</td><td align=\"right\">".number_format($journalcr,2)."</td>";

    // compute trial balance
    $trialbalancedrval = + ($begbalancedr - $begbalancecr) + ($cashdisbursementdr - $cashdisbursementcr) + ($acctspayabledr - $acctspayablecr) + ($cashreceiptdr - $cashreceiptcr) + ($journaldr - $journalcr);

    $trialbalancecrval = 0;

    if($trialbalancedrval < 0) {
      $trialbalancedrval = 0;
      $trialbalancecrval = - $begbalancedr - $cashdisbursementdr - $acctspayabledr - $cashreceiptdr - $journaldr + $begbalancecr + $cashdisbursementcr + $acctspayablecr + $cashreceiptcr + $journalcr;
    }

    $trialbalancedrtot = $trialbalancedrtot + $trialbalancedrval;
    $trialbalancecrtot = $trialbalancecrtot + $trialbalancecrval;
    echo "<td align=\"right\">".number_format($trialbalancedrval,2)."</td><td align=\"right\">".number_format($trialbalancecrval,2)."</td>";

		// compute balance sheet
		$result9=""; $found9=0;
		$result9 = mysql_query("SELECT tblfinworkpaperref.glcode FROM tblfinworkpaperref WHERE tblfinworkpaperref.wpacctcd=\"$wpacctcd\" AND tblfinworkpaperref.glrefver=$glrefver", $dbh);
		if($result9 != "") {
			while($myrow9 = mysql_fetch_row($result9)) {
			$found9 = 1;
			$glcode9 = $myrow9[0];

    if(($glcode9>="10.10.100") && ($glcode9<="30.90.999")) {
      if($glcode9!="20.10.208") {
				$balancesheetdr = $trialbalancedrval;
				$balancesheetcr = $trialbalancecrval;
      }
    }

			}
		}
				$balancesheetdrtot = $balancesheetdrtot + $balancesheetdr;	
				$balancesheetcrtot = $balancesheetcrtot + $balancesheetcr;

		echo "<td align=\"right\">".number_format($balancesheetdr,2)."</td><td align=\"right\">".number_format($balancesheetcr,2)."</td>";
    // else { echo "<td>-</td><td>-</td>"; }

    // compute income statement
		$result9=""; $found9=0;
		$result9 = mysql_query("SELECT tblfinworkpaperref.glcode FROM tblfinworkpaperref WHERE tblfinworkpaperref.wpacctcd=\"$wpacctcd\" AND tblfinworkpaperref.glrefver=$glrefver", $dbh);
		if($result9 != "") {
			while($myrow9 = mysql_fetch_row($result9)) {
			$found9 = 1;
			$glcode9 = $myrow9[0];

    if($glcode9>="40.10.000" && $glcode9<="90.00.000")
    {
      $incomestatementdr = $trialbalancedrval;
      $incomestatementcr = $trialbalancecrval;
    }
    if($glcode9=="20.10.208")
    {
      $incomestatementdr = $trialbalancedrval;
      $incomestatementcr = $trialbalancecrval;
    }

			}
		}
    $incomestatementdrtot = $incomestatementdrtot + $incomestatementdr;
    $incomestatementcrtot = $incomestatementcrtot + $incomestatementcr;

    echo "<td align=\"right\">".number_format($incomestatementdr,2)."</td><td align=\"right\">".number_format($incomestatementcr,2)."</td>";

    echo "</tr>";

    if($begbalancedr>0 || $begbalancecr>0 || $cashdisbursementdr>0 || $cashdisbursementcr>0 || $acctspayabledr>0 || $acctspayablecr>0 || $cashreceiptdr>0 || $cashreceiptcr>0 || $journaldr>0 || $journalcr>0 || $trialbalancedrval>0 || $trialbalancecrval>0 || $balancesheetdr>0 || $balancesheetcr>0 || $incomestatementdr>0 || $incomestatementcr>0) { 
    $res12query=""; $result12=""; $found12=0;
      $res12query="INSERT INTO tblfinworkpaper SET month=\"$wpgencutstart\", glcode=\"$wpacctcd\", glrefver=$glrefver, begbalancedr='$begbalancedr', begbalancecr='$begbalancecr', cashdisbursementdr='$cashdisbursementdr', cashdisbursementcr='$cashdisbursementcr', cashreceiptdr='$cashreceiptdr', cashreceiptcr='$cashreceiptcr', journaldr='$journaldr', journalcr='$journalcr', trialbalancedr='$trialbalancedrval', trialbalancecr='$trialbalancecrval', balancesheetdr='$balancesheetdr', balancesheetcr='$balancesheetcr', incomestatementdr='$incomestatementdr', incomestatementcr='$incomestatementcr', acctpayabledr='$acctspayabledr', acctpayablecr='$acctspayablecr'";
    $result12=$dbh2->query($res12query);
    }
  }
  echo "<tr><th></th><th></th><th align=\"center\">Total</th><th align=\"right\">".number_format($begbalancedrtot,2)."</th><th align=\"right\">".number_format($begbalancecrtot,2)."</th>";
  echo "<th align=\"right\">".number_format($cashdisbursementdrtot,2)."</th><th align=\"right\">".number_format($cashdisbursementcrtot,2)."</th>";
  echo "<th align=\"right\">".number_format($acctspayabledrtot,2)."</th><th align=\"right\">".number_format($acctspayablecrtot,2)."</th>";
  echo "<th align=\"right\">".number_format($cashreceiptdrtot,2)."</th><th align=\"right\">".number_format($cashreceiptcrtot,2)."</th><th align=\"right\">".number_format($journaldrtot,2)."</th><th align=\"right\">".number_format($journalcrtot,2)."</th><th align=\"right\">".number_format($trialbalancedrtot,2)."</th><th align=\"right\">".number_format($trialbalancecrtot,2)."</th><td align=\"right\">".number_format($balancesheetdrtot,2)."</td><td align=\"right\">".number_format($balancesheetcrtot,2)."</td><td align=\"right\">".number_format($incomestatementdrtot,2)."</td><td align=\"right\">".number_format($incomestatementcrtot,2)."</td></tr>";

  echo "<tr><td colspan=\"15\"></td>";
  if($balancesheetdrtot > $balancesheetcrtot) {
    $balancesheetdrdiff = $balancesheetdrtot - $balancesheetcrtot;
//    echo "<th align=\"right\">".number_format($balancesheetdrdiff,2)."</th><td></td>";
    echo "<td></td><th align=\"right\">".number_format($balancesheetdrdiff,2)."</th>";
  } else {
    $balancesheetcrdiff = $balancesheetcrtot - $balancesheetdrtot;
//    echo "<td></td><th align=\"right\">".number_format($balancesheetcrdiff,2)."</th>";
    echo "<th align=\"right\">".number_format($balancesheetcrdiff,2)."</th><td></td>";
	}

  if($incomestatementdrtot > $incomestatementcrtot) {
    $incomestatementdrdiff = $incomestatementdrtot - $incomestatementcrtot;
//     echo "<th align=\"right\">".number_format($incomestatementdrdiff,2)."</th><td></td>";
    echo "<td></td><th align=\"right\">".number_format($incomestatementdrdiff,2)."</th>";
	} else {
    $incomestatementcrdiff = $incomestatementcrtot - $incomestatementdrtot;
//     echo "<td></td><th align=\"right\">".number_format($incomestatementcrdiff,2)."</th>";
    echo "<th align=\"right\">".number_format($incomestatementcrdiff,2)."</th><td></td>";
  }
  echo "</tr>";

  echo "<tr><td colspan=\"15\"></td>";
  if($balancesheetdrdiff != "") {
    $balancesheetdrgrandtot = $balancesheetdrtot - $balancesheetdrdiff;
    $balancesheetcrgrandtot = $balancesheetcrtot;
    echo "<th align=\"right\">".number_format($balancesheetdrgrandtot,2)."</th><th align=\"right\">".number_format($balancesheetcrgrandtot,2)."</th>";
  } else if($balancesheetcrdiff != "") {
    $balancesheetcrgrandtot = $balancesheetcrtot - $balancesheetcrdiff;
    $balancesheetdrgrandtot = $balancesheetdrtot;
    echo "<th align=\"right\">".number_format($balancesheetdrgrandtot,2)."</th><th align=\"right\">".number_format($balancesheetcrgrandtot,2)."</th>";
  }
	// 20190410
	if($balancesheetdrtot > $balancesheetcrtot) {

	} else {

	} // if-else

  if($incomestatementdrdiff != "") {
    $incomestatementdrgrandtot = $incomestatementdrtot - $incomestatementdrdiff;
    $incomestatementcrgrandtot = $incomestatementcrtot;
    echo "<th align=\"right\">".number_format($incomestatementdrgrandtot,2)."</th><th align=\"right\">".number_format($incomestatementcrgrandtot,2)."</th>";
  } else if($incomestatementcrdiff != "") {
    $incomestatementcrgrandtot = $incomestatementcrtot - $incomestatementcrdiff;
    $incomestatementdrgrandtot = $incomestatementdrtot;
    echo "<th align=\"right\">".number_format($incomestatementdrgrandtot,2)."</th><th align=\"right\">".number_format($incomestatementcrgrandtot,2)."</th>";
  }
  echo "</tr>";

  $res14query=""; $result14=""; $found14=0;
  $res14query="INSERT INTO tblfinworkpapertot SET month=\"$wpgencutstart\", begbalancedr=$begbalancedrtot, begbalancecr=$begbalancecrtot, cashdisbursementdr=$cashdisbursementdrtot, cashdisbursementcr=$cashdisbursementcrtot, cashreceiptdr=$cashreceiptdrtot, cashreceiptcr=$cashreceiptcrtot, journaldr=$journaldrtot, journalcr=$journalcrtot, trialbalancedr=$trialbalancedrtot, trialbalancecr=$trialbalancecrtot, balancesheetdr=$balancesheetdrtot, balancesheetcr=$balancesheetcrtot, incomestatementdr=$incomestatementdrtot, incomestatementcr=$incomestatementcrtot, balancesheetdrdiff=$balancesheetdrdiff, balancesheetcrdiff=$balancesheetcrdiff, incomestatementdrdiff=$incomestatementdrdiff, incomestatementcrdiff=$incomestatementcrdiff, balancesheetdrgrandtot=$balancesheetdrgrandtot, balancesheetcrgrandtot=$balancesheetcrgrandtot, incomestatementdrgrandtot=$incomestatementdrgrandtot, incomestatementcrgrandtot=$incomestatementcrgrandtot, status=\"$status\", remarks='', acctpayabledrtot=$acctspayabledrtot, acctpayablecrtot=$acctspayablecrtot";
  $result14=$dbh2->query($res14query);
}

//
// create log
//
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Generate working paper: $wpgendate";
    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
	$result17=$dbh2->query($res17query);

echo "</table>";

echo "<br><p><a href=\"finvouchmain.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

// end contents here

     $resquery="UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery);	 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
