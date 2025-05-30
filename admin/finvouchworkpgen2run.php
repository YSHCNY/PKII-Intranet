


<?php 

include("db1.php");
include("datetimenow.php");
include("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$wpgendate = (isset($_GET['gd'])) ? $_GET['gd'] :'';

$wpacctcd0 = (isset($_POST['wpacctcd'])) ? $_POST['wpacctcd'] :'';
$debitamt0 = (isset($_POST['debitamt'])) ? $_POST['debitamt'] :'';
$creditamt0 = (isset($_POST['creditamt'])) ? $_POST['creditamt'] :'';

$cutarrwpgendate = explode("-", $wpgendate);
$wpgenyear = $cutarrwpgendate[0];
$wpgenmonth = $cutarrwpgendate[1];

$wpgencutstart = $wpgendate."-"."01";
$wpgencutend = date('Y-m-t', strtotime("$wpgenyear-$wpgenmonth-01")); //20230529

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

$status = "active";

$found = 0;

if($loginid != "")
{
  include("logincheck.php");
}  

if ($found == 1) {
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
  include ("sidebarforTAL.php");




if($glrefver == 1) {

?>


</div>
<h4>PKII Working Paper for <?php echo $wpgendate2; ?></h4>
<div class = 'p-5 ms-5'>
<table class="table table-bordered table-hover">

  <tr>
    <th colspan="2" class = 'fs-4'>Beginning Balance</th>
    <th colspan="2" class = 'fs-4'>Account</th>
    <th colspan="2" class = 'fs-4'>Cash Disbursement</th>
    <th colspan="2" class = 'fs-4'>Cash Receipt</th>
    <th colspan="2" class = 'fs-4'>Journal Book</th>
    <th colspan="2" class = 'fs-4'>Trial Balance</th>
    <th colspan="2" class = 'fs-4'>Balance Sheet</th>
    <th colspan="2" class = 'fs-4'>Income Statement</th>
  </tr>
  <tr>

    <th class = 'fs-4'>Code</th>
    <th class = 'fs-4'>Name</th>
    <th class = 'fs-4'>Debit</th>
    <th class = 'fs-4'>Credit</th>
    <th class = 'fs-4'>Debit</th>
    <th class = 'fs-4'>Credit</th>
    <th class = 'fs-4'>Debit</th>
    <th class = 'fs-4'>Credit</th>
    <th class = 'fs-4'>Debit</th>
    <th class = 'fs-4'>Credit</th>
    <th class = 'fs-4'>Debit</th>
    <th class = 'fs-4'>Credit</th>
    <th class = 'fs-4'>Debit</th>
    <th class = 'fs-4'>Credit</th>
    <th class = 'fs-4'>Debit</th>
    <th class = 'fs-4'>Credit</th>
  </tr>

<?php
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
    echo "<tr><td>$glcode</td>";
    $result11 = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode\" AND version=$glrefver", $dbh);
    if($result11 != "")
    {
      while($myrow11 = mysql_fetch_row($result11))
      {
	$found11 = 1;
	$glname11 = $myrow11[0];
      }
    }
    echo "<td>$glname11</td><td >$begbalancedr</td><td >$begbalancecr</td>";

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
    echo "<td >$cashdisbursementdr</td><td >$cashdisbursementcr</td>";

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
    echo "<td >$acctspayabledr</td><td >$acctspayablecr</td>";

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
    echo "<td >$cashreceiptdr</td><td >$cashreceiptcr</td>";

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
    echo "<td >$journaldr</td><td >$journalcr</td>";

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
    echo "<td >$trialbalancedrval</td><td >$trialbalancecrval</td>";

    // compute balance sheet
    if($glcode>="10.10.101" && $glcode<="30.90.999")
    {
      if($glcode!="20.10.214")
      {
	$balancesheetdr = $trialbalancedrval;
	$balancesheetcr = $trialbalancecrval;
	$balancesheetdrtot = $balancesheetdrtot + $balancesheetdr;	
	$balancesheetcrtot = $balancesheetcrtot + $balancesheetcr;
	echo "<td >$balancesheetdr</td><td >$balancesheetcr</td>";
      }
    }
    else { echo "<td>-</td><td>-</td>"; }

    // compute income statement
    if($glcode>="40.10.000" && $glcode<="70.00.000")
    {
      $incomestatementdr = $trialbalancedrval;
      $incomestatementcr = $trialbalancecrval;
      echo "<td >$incomestatementdr</td><td >$incomestatementcr</td>";
    }
    else if($glcode=="20.10.214")
    {
      $incomestatementdr = $trialbalancedrval;
      $incomestatementcr = $trialbalancecrval;
      echo "<td >$incomestatementdr</td><td >$incomestatementcr</td>";
    }
    else { echo "<td>-</td><td>-</td>"; }
    $incomestatementdrtot = $incomestatementdrtot + $incomestatementdr;
    $incomestatementcrtot = $incomestatementcrtot + $incomestatementcr;
    echo "</tr>";

    if($begbalancedr>0 || $begbalancecr>0 || $cashdisbursementdr>0 || $cashdisbursementcr>0 || $cashreceiptdr>0 || $cashreceiptcr>0 || $journaldr>0 || $journalcr>0 || $trialbalancedrval>0 || $trialbalancecrval>0 || $balancesheetdr>0 || $balancesheetcr>0 || $incomestatementdr>0 || $incomestatementcr>0) {
    $result12 = mysql_query("INSERT INTO tblfinworkpaper SET month=\"$wpgencutstart\", glcode=\"$glcode\", glrefver=$glrefver, begbalancedr='$begbalancedr', begbalancecr='$begbalancecr', cashdisbursementdr='$cashdisbursementdr', cashdisbursementcr='$cashdisbursementcr', cashreceiptdr='$cashreceiptdr', cashreceiptcr='$cashreceiptcr', journaldr='$journaldr', journalcr='$journalcr', trialbalancedr='$trialbalancedrval', trialbalancecr='$trialbalancecrval', balancesheetdr='$balancesheetdr', balancesheetcr='$balancesheetcr', incomestatementdr='$incomestatementdr', incomestatementcr='$incomestatementcr'", $dbh);
    }
  }
  echo "<tr><th></th><th></th><th align=\"center\">Total</th><th >".number_format($begbalancedrtot,2)."</th><th >".number_format($begbalancecrtot,2)."</th><th >".number_format($cashdisbursementdrtot,2)."</th><th >".number_format($cashdisbursementcrtot,2)."</th><th >".number_format($cashreceiptdrtot,2)."</th><th >".number_format($cashreceiptcrtot,2)."</th><th >".number_format($journaldrtot,2)."</th><th >".number_format($journalcrtot,2)."</th><th >".number_format($trialbalancedrtot,2)."</th><th >".number_format($trialbalancecrtot,2)."</th><td >".number_format($balancesheetdrtot,2)."</td><td >".number_format($balancesheetcrtot,2)."</td><td >".number_format($incomestatementdrtot,2)."</td><td >".number_format($incomestatementcrtot,2)."</td></tr>";

  echo "<tr><td colspan=\"13\"></td>";
  if($balancesheetdrtot > $balancesheetcrtot)
  {
    $balancesheetdrdiff = $balancesheetdrtot - $balancesheetcrtot;
    echo "<td></td><th >".number_format($balancesheetdrdiff,2)."</th>";
  }
  else
  {
    $balancesheetcrdiff = $balancesheetcrtot - $balancesheetdrtot;
    echo "<th >".number_format($balancesheetcrdiff,2)."</th><td></td>";
  }

  if($incomestatementdrtot > $incomestatementcrtot)
  {
    $incomestatementdrdiff = $incomestatementdrtot - $incomestatementcrtot;
    echo "<td></td><th >".number_format($incomestatementdrdiff,2)."</th>";
  }
  else
  {

    $incomestatementcrdiff = $incomestatementcrtot - $incomestatementdrtot;
    echo "<th >".number_format($incomestatementcrdiff,2)."</th><td></td>";
  }
  echo "</tr>";

  echo "<tr><td colspan=\"13\"></td>";
  if($balancesheetcrdiff != "")
  {
    $balancesheetdrgrandtot = $balancesheetdrtot + $balancesheetcrdiff;
    $balancesheetcrgrandtot = $balancesheetcrtot;
    echo "<th >".number_format($balancesheetdrgrandtot,2)."</th><th >".number_format($balancesheetcrgrandtot,2)."</th>";
  }
  else if($balancesheetdrdiff != "")
  {
    $balancesheetcrgrandtot = $balancesheetcrtot + $balancesheetdrdiff;
    $balancesheetdrgrandtot = $balancesheetdrtot;
    echo "<th >".number_format($balancesheetdrgrandtot,2)."</th><th >".number_format($balancesheetcrgrandtot,2)."</th>";
  }
  if($incomestatementcrdiff != "")
  {
    $incomestatementdrgrandtot = $incomestatementdrtot + $incomestatementcrdiff;
    $incomestatementcrgrandtot = $incomestatementcrtot;
    echo "<th >".number_format($incomestatementdrgrandtot,2)."</th><th >".number_format($incomestatementcrgrandtot,2)."</th>";
  }
  else if($incomestatementdrdiff != "")
  {
    $incomestatementcrgrandtot = $incomestatementcrtot + $incomestatementdrdiff;
    $incomestatementdrgrandtot = $incomestatementdrtot;
    echo "<th >".number_format($incomestatementdrgrandtot,2)."</th><th >".number_format($incomestatementcrgrandtot,2)."</th>";
  }
  echo "</tr>";

  $result14 = mysql_query("INSERT INTO tblfinworkpapertot SET month=\"$wpgencutstart\", begbalancedr=$begbalancedrtot, begbalancecr=$begbalancecrtot, cashdisbursementdr=$cashdisbursementdrtot, cashdisbursementcr=$cashdisbursementcrtot, cashreceiptdr=$cashreceiptdrtot, cashreceiptcr=$cashreceiptcrtot, journaldr=$journaldrtot, journalcr=$journalcrtot, trialbalancedr=$trialbalancedrtot, trialbalancecr=$trialbalancecrtot, balancesheetdr=$balancesheetdrtot, balancesheetcr=$balancesheetcrtot, incomestatementdr=$incomestatementdrtot, incomestatementcr=$incomestatementcrtot, balancesheetdrdiff=$balancesheetdrdiff, balancesheetcrdiff=$balancesheetcrdiff, incomestatementdrdiff=$incomestatementdrdiff, incomestatementcrdiff=$incomestatementcrdiff, balancesheetdrgrandtot=$balancesheetdrgrandtot, balancesheetcrgrandtot=$balancesheetcrgrandtot, incomestatementdrgrandtot=$incomestatementdrgrandtot, incomestatementcrgrandtot=$incomestatementcrgrandtot, status=\"$status\", remarks=''", $dbh);
}

else if($glrefver == 2) {

?>
</table>
</div>


<div class="w-100  my-5 d-flex justify-content-center align-items-center gap-3">
    <h2 class=" text-black fw-semibold m-0">PKII Working Paper for <?php echo date('F (Y)', strtotime($wpgendate2)); ?></h2>
    <a href="#" id="exportToExcel">
      <i class="bi bi-file-earmark-arrow-down-fill fs-1"></i>
    </a>
</div>

<div class = 'p-5 ms-5 '>
<table class="table table-bordered table-hover" id="ReportTable">

  <tr>

    <th colspan="2" class="fs-4">Account</th>
    <th colspan="2" class="fs-4">Beginning Balance</th>
    <th colspan="2" class="fs-4">Cash Disbursement</th>
    <th colspan="2" class="fs-4">Accts Payable</th>
    <th colspan="2" class="fs-4">Cash Receipt</th>
    <th colspan="2" class="fs-4">Journal Book</th>
    <th colspan="2" class="fs-4">Trial Balance</th>
    <th colspan="2" class="fs-4">Balance Sheet</th>
    <th colspan="2" class="fs-4">Income Statement</th>
  </tr>
  <tr>

    <th class="fs-4">Code</th>
    <th class="fs-4">Name</th>
    <th class="fs-4">Debit</th>
    <th class="fs-4">Credit</th> <!-- beg balance -->
    <th class="fs-4">Debit</th>
    <th class="fs-4">Credit</th> <!-- cash disbursement -->
    <th class="fs-4">Debit</th>
    <th class="fs-4">Credit</th> <!-- accts payable -->
    <th class="fs-4">Debit</th>
    <th class="fs-4">Credit</th> <!-- cash receipts -->
    <th class="fs-4">Debit</th>
    <th class="fs-4">Credit</th> <!-- journal -->
    <th class="fs-4">Debit</th>
    <th class="fs-4">Credit</th> <!-- trial balance -->
    <th class="fs-4">Debit</th>
    <th class="fs-4">Credit</th> <!-- balance sheet -->
    <th class="fs-4">Debit</th>
    <th class="fs-4">Credit</th> <!-- income statement -->
  </tr>

<?php
    $begbalancedrtot=0; $begbalancecrtot=0; $cashdisbursementdrtot=0; $cashdisbursementcrtot=0; $cashreceiptdrtot=0; $cashreceiptcrtot=0; $journaldrtot=0; $journalcrtot=0; $trialbalancedrtot=0; $trialbalancecrtot=0; $balancesheetdrtot=0; $balancesheetcrtot=0; $incomestatementdrtot=0; $incomestatementcrtot=0; $balancesheetdrdiff=0; $balancesheetcrdiff=0; $incomestatementdrdiff=0; $incomestatementcrdiff=0; $balancesheetdrgrandtot=0; $balancesheetcrgrandtot=0; $incomestatementdrgrandtot=0; $incomestatementcrgrandtot=0;
    $acctspayabledrtot=0; $acctspayablecrtot=0;

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
    ?>
    <tr>

      <td class=" "><?php echo $wpacctcd; ?></td>
    <?php
		$result10=""; $found10=0; $count10=0;
		$result10 = mysql_query("SELECT tblfinworkpaperref.wpacctname FROM tblfinworkpaperref WHERE tblfinworkpaperref.wpacctcd=\"$wpacctcd\" AND tblfinworkpaperref.glrefver=$glrefver", $dbh);
		if($result10 != "") {
			while($myrow10 = mysql_fetch_row($result10)) {
			$found10 = 1;
			$wpacctname10 = $myrow10[0];
			}
		}
    ?>
      <td class=" "><?php echo $wpacctname10; ?></td>
      <td class=" "><?php echo number_format($begbalancedr, 2); ?></td>
      <td class=" "><?php echo number_format($begbalancecr, 2); ?></td>
    <?php
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
    ?>
      <td class=" "><?php echo number_format($cashdisbursementdr, 2); ?></td>
      <td class=" "><?php echo number_format($cashdisbursementcr, 2); ?></td>
    <?php
    $res33query=""; $result33=""; $found33=0; $ctr33=0; $debitamt33=0; $creditamt33=0;
    $res33query="SELECT tblfinworkpaperref.glcode, tblfinacctspayable.debitamt, tblfinacctspayable.creditamt FROM tblfinworkpaperref LEFT JOIN tblfinacctspayable ON tblfinworkpaperref.glcode=tblfinacctspayable.glcode WHERE tblfinworkpaperref.wpacctcd=\"$wpacctcd\" AND tblfinacctspayable.date BETWEEN CAST(\"$wpgencutstart\" AS DATE) AND CAST(\"$wpgencutend\" AS DATE) AND tblfinacctspayable.glrefver=$glrefver ORDER BY tblfinworkpaperref.seq ASC";
    // $res33query="SELECT tblfinworkpaperref.glcode, tblfinacctspayable.acctspayablenumber, tblfinacctspayable.date, tblfinacctspayable.debitamt, tblfinacctspayable.creditamt FROM tblfinworkpaperref LEFT JOIN tblfinacctspayable ON tblfinworkpaperref.glcode=tblfinacctspayable.glcode WHERE tblfinworkpaperref.wpacctcd=\"$wpacctcd\" AND tblfinacctspayable.date BETWEEN CAST(\"$wpgencutstart\" AS DATE) AND CAST(\"$wpgencutend\" AS DATE) ORDER BY tblfinacctspayable.date DESC";
    $result33=$dbh2->query($res33query);
    if($result33->num_rows>0) {
        while($myrow33=$result33->fetch_assoc()) {
				$found33 = 1;
				$glcode33 = $myrow33['glcode'];
				$debitamt33 = $myrow33['debitamt'];
				$creditamt33 = $myrow33['creditamt'];
				$acctspayabledr = $acctspayabledr + $debitamt33;
				$acctspayablecr = $acctspayablecr + $creditamt33;
        }
    }
    $acctspayabledrtot = $acctspayabledrtot + $acctspayabledr;
    $acctspayablecrtot = $acctspayablecrtot + $acctspayablecr;
    ?>
      <td class=" "><?php echo number_format($acctspayabledr, 2); ?></td>
      <td class=" "><?php echo number_format($acctspayablecr, 2); ?></td>
    <?php
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
    ?>
      <td class=" "><?php echo number_format($cashreceiptdr, 2); ?></td>
      <td class=" "><?php echo number_format($cashreceiptcr, 2); ?></td>
    <?php
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
    ?>
      <td class=' '><?= number_format($journaldr, 2) ?></td>
      <td class=' '><?= number_format($journalcr, 2) ?></td>
    <?php    
    $trialbalancedrval = + ($begbalancedr - $begbalancecr) + ($cashdisbursementdr - $cashdisbursementcr) + ($acctspayabledr - $acctspayablecr) + ($cashreceiptdr - $cashreceiptcr) + ($journaldr - $journalcr);

    $trialbalancecrval = 0;

    if($trialbalancedrval < 0) {
      $trialbalancedrval = 0;
      $trialbalancecrval = - $begbalancedr - $cashdisbursementdr - $acctspayabledr - $cashreceiptdr - $journaldr + $begbalancecr + $cashdisbursementcr + $acctspayablecr + $cashreceiptcr + $journalcr;
    }

    $trialbalancedrtot = $trialbalancedrtot + $trialbalancedrval;
    $trialbalancecrtot = $trialbalancecrtot + $trialbalancecrval;
    ?>
      <td class=' '><?= number_format($trialbalancedrval, 2) ?></td>
      <td class=' '><?= number_format($trialbalancecrval, 2) ?></td>
    <?php
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

    ?>
      <td class=' '><?= number_format($balancesheetdr, 2) ?></td>
      <td class=' '><?= number_format($balancesheetcr, 2) ?></td>
    <?php

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

    ?>
      <td class=' '><?= number_format($incomestatementdr, 2) ?></td>
      <td class=' '><?= number_format($incomestatementcr, 2) ?></td>
    </tr>
    <?php

    if($begbalancedr>0 || $begbalancecr>0 || $cashdisbursementdr>0 || $cashdisbursementcr>0 || $acctspayabledr>0 || $acctspayablecr>0 || $cashreceiptdr>0 || $cashreceiptcr>0 || $journaldr>0 || $journalcr>0 || $trialbalancedrval>0 || $trialbalancecrval>0 || $balancesheetdr>0 || $balancesheetcr>0 || $incomestatementdr>0 || $incomestatementcr>0) { 
    $res12query=""; $result12=""; $found12=0;
      $res12query="INSERT INTO tblfinworkpaper SET month=\"$wpgencutstart\", glcode=\"$wpacctcd\", glrefver=$glrefver, begbalancedr='$begbalancedr', begbalancecr='$begbalancecr', cashdisbursementdr='$cashdisbursementdr', cashdisbursementcr='$cashdisbursementcr', cashreceiptdr='$cashreceiptdr', cashreceiptcr='$cashreceiptcr', journaldr='$journaldr', journalcr='$journalcr', trialbalancedr='$trialbalancedrval', trialbalancecr='$trialbalancecrval', balancesheetdr='$balancesheetdr', balancesheetcr='$balancesheetcr', incomestatementdr='$incomestatementdr', incomestatementcr='$incomestatementcr', acctpayabledr='$acctspayabledr', acctpayablecr='$acctspayablecr'";
    $result12=$dbh2->query($res12query);
    }
  }

  ?>
  <tr>
      <th></th>

      <th>Total</th>
      <th ><?= number_format($begbalancedrtot, 2) ?></th>
      <th ><?= number_format($begbalancecrtot, 2) ?></th>
      <th ><?= number_format($cashdisbursementdrtot, 2) ?></th>
      <th ><?= number_format($cashdisbursementcrtot, 2) ?></th>
      <th ><?= number_format($acctspayabledrtot, 2) ?></th>
      <th ><?= number_format($acctspayablecrtot, 2) ?></th>
      <th ><?= number_format($cashreceiptdrtot, 2) ?></th>
      <th ><?= number_format($cashreceiptcrtot, 2) ?></th>
      <th ><?= number_format($journaldrtot, 2) ?></th>
      <th ><?= number_format($journalcrtot, 2) ?></th>
      <th ><?= number_format($trialbalancedrtot, 2) ?></th>
      <th ><?= number_format($trialbalancecrtot, 2) ?></th>
      <th ><?= number_format($balancesheetdrtot, 2) ?></th>
      <th ><?= number_format($balancesheetcrtot, 2) ?></th>
      <th ><?= number_format($incomestatementdrtot, 2) ?></th>
      <th ><?= number_format($incomestatementcrtot, 2) ?></th>
  </tr>
  <?php

  echo "<tr>";
echo "<th colspan = '16'></th>";  
  if($balancesheetdrtot > $balancesheetcrtot) {
    $balancesheetdrdiff = $balancesheetdrtot - $balancesheetcrtot;
//    echo "<th >".number_format($balancesheetdrdiff,2)."</th><td></td>";
    echo "<th >".number_format($balancesheetdrdiff,2)."</th>";
  } else {
    $balancesheetcrdiff = $balancesheetcrtot - $balancesheetdrtot;
//    echo "<td></td><th >".number_format($balancesheetcrdiff,2)."</th>";
    echo "<th >".number_format($balancesheetcrdiff,2)."</th>";
	}

  if($incomestatementdrtot > $incomestatementcrtot) {
    $incomestatementdrdiff = $incomestatementdrtot - $incomestatementcrtot;
//     echo "<th >".number_format($incomestatementdrdiff,2)."</th><td></td>";
    echo "><th >".number_format($incomestatementdrdiff,2)."</th>";
	} else {
    $incomestatementcrdiff = $incomestatementcrtot - $incomestatementdrtot;
//     echo "<td></td><th >".number_format($incomestatementcrdiff,2)."</th>";
    echo "<th >".number_format($incomestatementcrdiff,2)."</th>";
  }
  echo "</tr>";

  echo "<tr>";
  if($balancesheetdrdiff != "") {
    $balancesheetdrgrandtot = $balancesheetdrtot - $balancesheetdrdiff;
    $balancesheetcrgrandtot = $balancesheetcrtot;
    echo "<th >".number_format($balancesheetdrgrandtot,2)."</th><th >".number_format($balancesheetcrgrandtot,2)."</th>";
  } else if($balancesheetcrdiff != "") {
    $balancesheetcrgrandtot = $balancesheetcrtot - $balancesheetcrdiff;
    $balancesheetdrgrandtot = $balancesheetdrtot;
    echo "<th >".number_format($balancesheetdrgrandtot,2)."</th><th >".number_format($balancesheetcrgrandtot,2)."</th>";
  }
	// 20190410
	if($balancesheetdrtot > $balancesheetcrtot) {

	} else {

	} // if-else

  if($incomestatementdrdiff != "") {
    $incomestatementdrgrandtot = $incomestatementdrtot - $incomestatementdrdiff;
    $incomestatementcrgrandtot = $incomestatementcrtot;
    echo "<th >".number_format($incomestatementdrgrandtot,2)."</th><th >".number_format($incomestatementcrgrandtot,2)."</th>";
  } else if($incomestatementcrdiff != "") {
    $incomestatementcrgrandtot = $incomestatementcrtot - $incomestatementcrdiff;
    $incomestatementdrgrandtot = $incomestatementdrtot;
    echo "<th >".number_format($incomestatementdrgrandtot,2)."</th><th >".number_format($incomestatementcrgrandtot,2)."</th>";
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

?>
  </table>
  </div>


  <div class="d-flex justify-content-end mt-4">
    <button class="border border-1 rounded-3" style="width: 12.5%; height: 40px; background-color: #0a1d44;">
        <a href="finvouchworkpgen2a.php?loginid=<?php echo $loginid ?>" class="text-white text-decoration-none  fw-medium fs-4">Back</a>
    </button>
  </div>
<?php

  $resquery="UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
  $result=$dbh2->query($resquery);	 

  include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>


<style>
  table{
    position: relative !important;
  }
 table th{

	position: sticky !important;
	background-color: #d1d1d1 !important;
	z-index: 2;
	text-align: center !important;
	font-weight: bolder !important;
	flex: 1; 
	white-space: nowrap;
   
  }

  table tr:first-child th {
    top: 5.9rem !important; 
}

table tr:nth-child(2) th {
    top: 9.8rem !important; 
}

  td{
    text-align: center;
  }
</style>