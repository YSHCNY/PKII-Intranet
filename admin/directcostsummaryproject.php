<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$fromDate = date('Y-m-d',strtotime($_POST['fromDate']));
$d = new DateTime($fromDate);

$toDate = date('Y-m-d',strtotime($_POST['toDate']));
$lastMonth =$d->modify('first day of last month');
$workingPaperDate = $lastMonth->format('Y-m-d');
// $projectCode = $_POST['projectCode'];
$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");
?>
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

// edit body-header
     echo "<div class='mainContainer'>";
     echo "<div class='container-fluid'>";
     echo "<input type='hidden' id='loginid' value='".$loginid."'/>";
     echo "<p><font size=1>Manage >> Direct Cost Summary</font></p>";
     echo '<form method="post" action="directcostsummaryproject.php?loginid='.$loginid.'">';
     ?>

      <input class='btn form-control' type="text" id="fromDate" name='fromDate' placeholder="from"  style='width:20%; text-align: left; border: 1px solid #ddd;' />
       <input class='btn form-control' type="text" id="toDate" name="toDate" placeholder="To"  style='width:20%; text-align: left; border: 1px solid #ddd;' />
       <button type="submit" class="btn btnConfirm btn-default" id="btnConfirm">Submit</button>
       </form>

    <?php 

    echo "<table id=\"ReportTable\" class=\"fin2\">";
    echo "<tr><th colspan=\"2\" align=\"left\">Philkoei International Inc.</th></tr>";
    // echo "<tr><th colspan=\"2\" align=\"left\">General and Administrative Expenses&nbsp;<a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a></th></tr>";
    echo "<tr><th colspan=\"2\" align=\"left\">Direct Cost Summary Per Project&nbsp;<a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a></th></tr>";
    echo "<tr><th colspan=\"2\" align=\"left\">Duration from ".date("Y-M-d", strtotime($fromDate))." to ".date("Y-M-d", strtotime($toDate))."</th></tr>";

    echo "<tr><td colspan=\"2\">";

    echo "<table width=\"100%\" class=\"fin\" border=\"1\">";
    echo "<tr><th colspan='4'></th><th colspan='1'>Balance</th><th colspan='2'>Cash Disbursement Book</th><th colspan='2'>Accts Payable Book</th><th colspan='2'>Cash Receipt Book</th><th colspan='2'>Journal Book</th><th>Balance</th><th>THIS MONTH</th></tr>";
    echo "<tr><th>Count</th><th>Proj Code</th><th>Proj Short Name</th><th>Proj Full Name</th><th>Beginning Balance</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th><th>Ending Balance</th><th></th></tr>";

  if(isset($_POST['fromDate'])) {

      $found11 = 1;
      $gaename11 = $myrow11[1];
      $glcodefr11 = '60.00.000';
      $glcodeto11 = '69.99.999';

      $getYear = date('Y', strtotime($fromDate));
      $beginningFrom = date('Y-m-d', strtotime($getYear.'-01-01'));


      $projectArray = [];

      $query12 = "SELECT projcode FROM tblfindisbursement WHERE (date>=\"$beginningFrom\" AND date<=\"$toDate\") AND (glcode>=\"$glcodefr11\" AND glcode<=\"$glcodeto11\") GROUP BY projcode ORDER BY projcode DESC";
      $query16 = "SELECT projcode FROM tblfinacctspayable WHERE date BETWEEN CAST(\"$beginningFrom\" AS DATE) AND CAST(\"$toDate\" AS DATE) AND (glcode>=\"$glcodefr11\" AND glcode<=\"$glcodeto11\") GROUP BY projcode ORDER BY projcode DESC";
      $query14 = "SELECT projcode FROM tblfincashreceipt WHERE (date>=\"$beginningFrom\" AND date<=\"$toDate\") AND (glcode>=\"$glcodefr11\" AND glcode<=\"$glcodeto11\") GROUP BY projcode ORDER BY projcode DESC";
      $query15 = "SELECT projcode FROM tblfinjournal WHERE (date>=\"$beginningFrom\" AND date<=\"$toDate\") AND (glcode>=\"$glcodefr11\" AND glcode<=\"$glcodeto11\") GROUP BY projcode ORDER BY projcode DESC";

      $result12 = mysql_query($query12, $dbh);
        if($result12 != "") {
          while($myrow12 = mysql_fetch_row($result12)) {
            array_push($projectArray, $myrow12[0]);
          }
        }

        $result16=""; $found16=0; $ctr16=0;
        $result16=$dbh2->query($query16);
        if($result16->num_rows>0) {
            while($myrow16=$result16->fetch_assoc()) {
            array_push($projectArray, $myrow16['projcode']);
            } //while
        } //if

      $result14=""; $found14=0; $ctr14=0;
      $result14 = mysql_query($query14, $dbh);
        if($result14 != "") {
          while($myrow14 = mysql_fetch_row($result14)) {
            array_push($projectArray, $myrow14[0]);
          }
        }

      $result15=""; $found15=0; $ctr15=0;
      $result15 = mysql_query($query15, $dbh);
        if($result15 != "") {
          while($myrow15 = mysql_fetch_row($result15)) {
            array_push($projectArray, $myrow15[0]);
          }
        }

      $finalProjectArray = array_unique($projectArray);

      foreach ($finalProjectArray as $projcodes) {
        // var_dump($projcodes);
        $ctr11 = $ctr11 + 1;
        $res26query="SELECT * FROM tblproject1 WHERE tblproject1.proj_code ='".$projcodes."' ";
        $result26=""; $found26=0; $ctr26=0;
        $result26 = $dbh2->query($res26query);
          if($result26->num_rows>0) {
            while($myrow26 = $result26->fetch_assoc()) {
            $gaename11 = $myrow26['proj_sname'];
            $projcd11 = $myrow26['proj_code'];
            $projfullname11 = $myrow26['proj_fname'];
            if($gaename11 == '' || $gaename11 == null){
              $gaename11 = $myrow26['proj_fname'];
            }
            $gaename11 = str_replace("'", "", $gaename11);
            $projfullname11 = str_replace("'", "", $projfullname11);
          }
        }

        echo "<tr><td>$ctr11</td><td>$projcd11</td><td>$gaename11</td><td>$projfullname11</td>";

        //GET BEGINNING BALANCE
        if(strpos($fromDate,  '-07-01') !== false ){
          $beginningBalance = 0;
        }
        else{
          $getYear = date('Y', strtotime($fromDate));
          $beginningFrom = date('Y-m-d', strtotime($getYear.'-01-01'));
          $beginningTo = date('Y-m-d', strtotime($fromDate.'-1 days'));
          

        $result12=""; $found12=0; $ctr12=0;
          $query12 = "SELECT disbursementid, disbursementnumber, debitamt, creditamt FROM tblfindisbursement WHERE (date>=\"$beginningFrom\" AND date<=\"$beginningTo\") AND (glcode>=\"$glcodefr11\" AND glcode<=\"$glcodeto11\") AND projcode = '".$projcodes."' ORDER BY date ASC";
          $query16 = "SELECT acctspayableid, acctspayablenumber, debitamt, creditamt FROM tblfinacctspayable WHERE date BETWEEN CAST(\"$beginningFrom\" AS DATE) AND CAST(\"$beginningTo\" AS DATE) AND (glcode>=\"$glcodefr11\" AND glcode<=\"$glcodeto11\") AND projcode = '".$projcodes."' ORDER BY date ASC";
          $query14 = "SELECT cashreceiptid, cashreceiptnumber, debitamt, creditamt FROM tblfincashreceipt WHERE (date>=\"$beginningFrom\" AND date<=\"$beginningTo\") AND (glcode>=\"$glcodefr11\" AND glcode<=\"$glcodeto11\") AND projcode = '".$projcodes."' ORDER BY date ASC";
          $query15 = "SELECT journalid, journalnumber, debitamt, creditamt FROM tblfinjournal WHERE (date>=\"$beginningFrom\" AND date<=\"$beginningTo\") AND (glcode>=\"$glcodefr11\" AND glcode<=\"$glcodeto11\") AND projcode = '".$projcodes."' ORDER BY journalid ASC";

        $result12 = mysql_query($query12, $dbh);
        if($result12 != "") {
          while($myrow12 = mysql_fetch_row($result12)) {
          $found12 = 1;
          $disbursementid12 = $myrow12[0];
          $disbursementnumber12 = $myrow12[1];
          $debitamt12 = $myrow12[2];
          $creditamt12 = $myrow12[3];
          $ctr12 = $ctr12 + 1;

          $disbursementdebit = $disbursementdebit + $debitamt12;
          $disbursementcredit = $disbursementcredit + $creditamt12;
          // echo "disbno:$disbursementnumber12 | $glcodefr11b-to-$glcodeto11b || disbdebitamt:$debitamt12 | disbdebitsub:$disbursementdebit || disbcreditamt:$creditamt12 | disbcreditsub:$disbursementcredit<br>";
          }
        }

        $result16=""; $found16=0; $ctr16=0;
        $result16=$dbh2->query($query16);
        if($result16->num_rows>0) {
            while($myrow16=$result16->fetch_assoc()) {
            $found16=1;
            $ctr16++;
            $acctspayableid16 = $myrow16['acctspayableid'];
            $acctspayablenumber16 = $myrow16['acctspayablenumber'];
            $debitamt16 = $myrow16['debitamt'];
            $creditamt16 = $myrow16['creditamt'];
            $acctspayabledebit = $acctspayabledebit + $debitamt16;
            $acctspayablecredit = $acctspayablecredit + $creditamt16;
            } //while
        } //if

        $result14=""; $found14=0; $ctr14=0;
        $result14 = mysql_query($query14, $dbh);
        if($result14 != "") {
          while($myrow14 = mysql_fetch_row($result14)) {
          $found14 = 1;
          $cashreceiptid14 = $myrow14[0];
          $cashreceiptnumber14 = $myrow14[1];
          $debitamt14 = $myrow14[2];
          $creditamt14 = $myrow14[3];
          $ctr14 = $ctr14 + 1;
  
          $cashreceiptdebit = $cashreceiptdebit + $debitamt14;
          $cashreceiptcredit = $cashreceiptcredit + $creditamt14;
          // echo "cshrcptno:$cashreceiptnumber14 | $glcodefr11b-to-$glcodeto11b || cshrdebitamt:$debitamt14 | cshrdebitsub:$cashreceiptdebit || cshrcreditamt:$creditamt14 | cshrcreditsub:$cashreceiptcredit<br>";
          }
        }

        $result15=""; $found15=0; $ctr15=0;
        $result15 = mysql_query($query15, $dbh);
        if($result15 != "") {
          while($myrow15 = mysql_fetch_row($result15)) {
          $found15 = 1;
          $journalid15 = $myrow15[0];
          $journalnumber15 = $myrow15[1];
          $debitamt15 = $myrow15[2];
          $creditamt15 = $myrow15[3];
          $ctr15 = $ctr15 + 1;

          $journaldebit = $journaldebit + $debitamt15;
          $journalcredit = $journalcredit + $creditamt15;
          // echo "id:$journalid15 jrnlno:$journalnumber15 | $glcodefr11-to-$glcodeto11 || jrnldebitamt:$debitamt15 | jrnldebitsub:$journaldebit || jrnlcreditamt:$creditamt15 | jrnlcreditsub:$journalcredit<br>";
          }
        }

        // compute total debit and credit
        $debitamt = $disbursementdebit + $acctspayabledebit + $cashreceiptdebit + $journaldebit;
        $creditamt = $disbursementcredit + $acctspayablecredit + $cashreceiptcredit + $journalcredit;

        }

        $beginningBalance = $debitamt - $creditamt;

        $debitamt=0; $creditamt=0;
        $disbursementdebit=0; $disbursementcredit=0;
        $cashreceiptdebit=0; $cashreceiptcredit=0;
        $journaldebit=0; $journalcredit=0;
        $acctspayabledebit=0; $acctspayablecredit=0;

        //END BEGINNING BALANCE

          $query12 = "SELECT disbursementid, disbursementnumber, debitamt, creditamt FROM tblfindisbursement WHERE (date>=\"$fromDate\" AND date<=\"$toDate\") AND (glcode>=\"$glcodefr11\" AND glcode<=\"$glcodeto11\") AND projcode = '".$projcodes."' ORDER BY date ASC";
          $query16 = "SELECT acctspayableid, acctspayablenumber, debitamt, creditamt FROM tblfinacctspayable WHERE date BETWEEN CAST(\"$fromDate\" AS DATE) AND CAST(\"$toDate\" AS DATE) AND (glcode>=\"$glcodefr11\" AND glcode<=\"$glcodeto11\") AND projcode = '".$projcodes."' ORDER BY date ASC";
          $query14 = "SELECT cashreceiptid, cashreceiptnumber, debitamt, creditamt FROM tblfincashreceipt WHERE (date>=\"$fromDate\" AND date<=\"$toDate\") AND (glcode>=\"$glcodefr11\" AND glcode<=\"$glcodeto11\") AND projcode = '".$projcodes."' ORDER BY date ASC";
          $query15 = "SELECT journalid, journalnumber, debitamt, creditamt FROM tblfinjournal WHERE (date>=\"$fromDate\" AND date<=\"$toDate\") AND (glcode>=\"$glcodefr11\" AND glcode<=\"$glcodeto11\") AND projcode = '".$projcodes."' ORDER BY journalid ASC";
        
        // var_dump($query12);

        $result12=""; $found12=0; $ctr12=0;
        $result12 = mysql_query($query12, $dbh);
        if($result12 != "") {
          while($myrow12 = mysql_fetch_row($result12)) {
          $found12 = 1;
          $disbursementid12 = $myrow12[0];
          $disbursementnumber12 = $myrow12[1];
          $debitamt12 = $myrow12[2];
          $creditamt12 = $myrow12[3];
          $ctr12 = $ctr12 + 1;

          $disbursementdebit = $disbursementdebit + $debitamt12;
          $disbursementcredit = $disbursementcredit + $creditamt12;
          // echo "disbno:$disbursementnumber12 | $glcodefr11b-to-$glcodeto11b || disbdebitamt:$debitamt12 | disbdebitsub:$disbursementdebit || disbcreditamt:$creditamt12 | disbcreditsub:$disbursementcredit<br>";
          }
        }

        $result16=""; $found16=0; $ctr16=0;
        $result16=$dbh2->query($query16);
        if($result16->num_rows>0) {
            while($myrow16=$result16->fetch_assoc()) {
            $found16=1;
            $ctr16++;
            $acctspayableid16 = $myrow16['acctspayableid'];
            $acctspayablenumber16 = $myrow16['acctspayablenumber'];
            $debitamt16 = $myrow16['debitamt'];
            $creditamt16 = $myrow16['creditamt'];
            $acctspayabledebit = $acctspayabledebit + $debitamt16;
            $acctspayablecredit = $acctspayablecredit + $creditamt16;
            } //while
        } //if

        $result14=""; $found14=0; $ctr14=0;
        $result14 = mysql_query($query14, $dbh);
        if($result14 != "") {
          while($myrow14 = mysql_fetch_row($result14)) {
          $found14 = 1;
          $cashreceiptid14 = $myrow14[0];
          $cashreceiptnumber14 = $myrow14[1];
          $debitamt14 = $myrow14[2];
          $creditamt14 = $myrow14[3];
          $ctr14 = $ctr14 + 1;
  
          $cashreceiptdebit = $cashreceiptdebit + $debitamt14;
          $cashreceiptcredit = $cashreceiptcredit + $creditamt14;
          // echo "cshrcptno:$cashreceiptnumber14 | $glcodefr11b-to-$glcodeto11b || cshrdebitamt:$debitamt14 | cshrdebitsub:$cashreceiptdebit || cshrcreditamt:$creditamt14 | cshrcreditsub:$cashreceiptcredit<br>";
          }
        }

        $result15=""; $found15=0; $ctr15=0;
        $result15 = mysql_query($query15, $dbh);
        if($result15 != "") {
          while($myrow15 = mysql_fetch_row($result15)) {
          $found15 = 1;
          $journalid15 = $myrow15[0];
          $journalnumber15 = $myrow15[1];
          $debitamt15 = $myrow15[2];
          $creditamt15 = $myrow15[3];
          $ctr15 = $ctr15 + 1;

          $journaldebit = $journaldebit + $debitamt15;
          $journalcredit = $journalcredit + $creditamt15;
          // echo "id:$journalid15 jrnlno:$journalnumber15 | $glcodefr11-to-$glcodeto11 || jrnldebitamt:$debitamt15 | jrnldebitsub:$journaldebit || jrnlcreditamt:$creditamt15 | jrnlcreditsub:$journalcredit<br>";
          }
        }

        // compute total debit and credit
        $debitamt = $disbursementdebit + $acctspayabledebit + $cashreceiptdebit + $journaldebit;
        $creditamt = $disbursementcredit + $acctspayablecredit + $cashreceiptcredit + $journalcredit;

        // compute total of disb, cshrcpt & jrnl
        $disbdrtot = $disbdrtot+$disbursementdebit;
        $disbcrtot = $disbcrtot+$disbursementcredit;
        $apvdrtot = $apvdrtot+$acctspayabledebit;
        $apvcrtot = $apvcrtot+$acctspayablecredit;
        $cshrcptdrtot = $cshrcptdrtot+$cashreceiptdebit;
        $cshrcptcrtot = $cshrcptcrtot+$cashreceiptcredit;
        $jrnldrtot = $jrnldrtot+$journaldebit;
        $jrnlcrtot = $jrnlcrtot+$journalcredit;
        $endingBalance = $beginningBalance + $debitamt - $creditamt;
        $thisMonth = $debitamt - $creditamt;

        if($beginningBalance < 0){
              echo "<td align='right'><span style='color:red'>(".number_format($beginningBalance * -1,2).")</span></td>";
            }else{
              echo "<td align='right'>".number_format($beginningBalance,2)."</td>";
            }
            echo "<td align='right'>".number_format($disbursementdebit,2)."</td>";
            echo "<td align='right'>".number_format($disbursementcredit,2)."</td>";
            echo "<td align='right'>".number_format($acctspayabledebit,2)."</td>";
            echo "<td align='right'>".number_format($acctspayablecredit,2)."</td>";
            echo "<td align='right'>".number_format($cashreceiptdebit,2)."</td>";
            echo "<td align='right'>".number_format($cashreceiptcredit,2)."</td>";
            echo "<td align='right'>".number_format($journaldebit,2)."</td>";
            echo "<td align='right'>".number_format($journalcredit,2)."</td>";
          if($endingBalance < 0){
            echo "<td align=\"right\"><span style='color:red'>(".number_format($endingBalance * -1, 2).")</span></td>";
          } else{
            echo "<td align=\"right\">".number_format($endingBalance, 2)."</td>";
          }
          if($thisMonth < 0){
            echo "<td align=\"right\"><span style='color:red'>(".number_format($thisMonth * -1, 2).")</span></td>";
          } else{
            echo "<td align=\"right\">".number_format($thisMonth, 2)." </td>";
          }
          echo "</tr>";

           // compute grand total
      $debittot = $debittot + $debitamt;
      // $debittot = $disbdrtot + $cshrcptdrtot + $jrnldrtot;
      $credittot = $credittot + $creditamt;
      $beginningBalanceTot = $beginningBalanceTot + $beginningBalance;
      $endingBalanceTot = $endingBalanceTot + $endingBalance;
      $thisMonthTot = $thisMonthTot + $thisMonth;
      // $credittot = $disbcrtot + $cshrcptcrtot + $jrnlcrtot;

      // reset variables
      $debitamt=0; $creditamt=0;
      $disbursementdebit=0; $disbursementcredit=0;
      $cashreceiptdebit=0; $cashreceiptcredit=0;
      $disbursementcredit111= 0;
      $disbursementdebit111= 0;
      $cashreceiptcredit111= 0;
      $cashreceiptdebit111= 0;
      $journalcredit111= 0;
      $journaldebit111= 0;
      $journaldebit=0; $journalcredit=0; $beginningBalance = 0; $endingBalance =0; $thisMonth = 0;
      $debitamtbeg =0; $creditamtbeg =0;
        $acctspayabledebit=0; $acctspayablecredit=0;

      }

     


    echo "<tr><th colspan=\"4\">TOTAL</th>";
    if($beginningBalanceTot<0) {
    echo "<th class='text-right'><span style='color:red'>(".number_format($beginningBalanceTot, 2).")</span></th>";
    } else {
    echo "<th class='text-right'>".number_format($beginningBalanceTot, 2)."</th>";
    } //if-else

    if($$disbdrtot<0) {
    echo "<th class='text-right'><span style='color:red'>(".number_format($disbdrtot, 2).")</span></th>";
    } else {
    echo "<th class='text-right'>".number_format($disbdrtot, 2)."</th>";
    } //if-else
    if($disbcrtot<0) {
    echo "<th class='text-right'><span style='color:red'>(".number_format($disbcrtot, 2).")</span></th>";
    } else {
    echo "<th class='text-right'>".number_format($disbcrtot, 2)."</th>";
    } //if-else

    if($apvdrtot<0) {
    echo "<th class='text-right'><span style='color:red'>(".number_format($apvdrtot, 2).")</span></th>";
    } else {
    echo "<th class='text-right'>".number_format($apvdrtot, 2)."</th>";
    } //if-else
    if($apvcrtot<0) {
    echo "<th class='text-right'><span style='color:red'>(".number_format($apvcrtot, 2).")</span></th>";
    } else {
    echo "<th class='text-right'>".number_format($apvcrtot, 2)."</th>";
    } //if-else

    if($cshrcptdrtot<0) {
    echo "<th class='text-right'><span style='color:red'>(".number_format($cshrcptdrtot, 2).")</span></th>";
    } else {
    echo "<th class='text-right'>".number_format($cshrcptdrtot, 2)."</th>";
    } //if-else
    if($cshrcptcrtot<0) {
    echo "<th class='text-right'><span style='color:red'>(".number_format($cshrcptcrtot, 2).")</span></th>";
    } else {
    echo "<th class='text-right'>".number_format($cshrcptcrtot, 2)."</th>";
    } //if-else

    if($jrnldrtot<0) {
    echo "<th class='text-right'><span style='color:red'>(".number_format($jrnldrtot, 2).")</span></th>";
    } else {
    echo "<th class='text-right'>".number_format($jrnldrtot, 2)."</th>";
    } //if-else
    if($jrnlcrtot<0) {
    echo "<th class='text-right'><span style='color:red'>(".number_format($jrnlcrtot, 2).")</span></th>";
    } else {
    echo "<th class='text-right'>".number_format($jrnlcrtot, 2)."</th>";
    } //if-else

    if($endingBalanceTot<0) {
    echo "<th class='text-right'><span style='color:red'>(".number_format($endingBalanceTot, 2).")</span></th>";
    } else {
    echo "<th class='text-right'>".number_format($endingBalanceTot, 2)."</th>";
    } //if-else

    if($thisMonthTot<0) {
    echo "<th class='text-right'><span style='color:red'>(".number_format($thisMonthTot, 2).")</span></th>";
    } else {
    echo "<th class='text-right'>".number_format($thisMonthTot, 2)."</th>";
    } //if-else

    echo "</tr>";

}
    echo "</table>";
    echo "</td></tr>";

    echo "</table>";


    ?>
      </div>
      </div>
      <script>
        $(document).ready(function(){
            $('#fromDate').datepicker();
            $('#toDate').datepicker();
            $('.projectChargeSelect').chosen();
        });
      </script>
      <?php 
     $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result=$dbh2->query($resquery);

  echo "<br><p><a href=\"./finrptmnu.php?loginid=$loginid\" class='btn btn-default' role='button'>back</a></p>";

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 