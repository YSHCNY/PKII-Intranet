

<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<div class='mainContainer'>";
     echo "<div class='container-fluid'>";
     echo "<input type='hidden' id='loginid' value='".$loginid."'/>";
     echo "<p><font size=1>Manage >> General Ledger</font></p>";
     echo '<form method="post" action="reportledger.php?loginid='.$loginid.'">';
?>
      <script type="text/javascript">
        $(function() {
          $("#exportToExcel").click(function() {
            var data='<table>' + $("#tblName").html().replace(/<a\/?[^>]+>/gi,'')+'</table>';
            $('body').prepend("<form method='post' action='exportexcel.php' style='display:none' id='ReportTableData'><input type='text' name='tableData' value='"+data+"'></form>");
            $('#ReportTableData').submit().remove();
        });
      });
      </script>
<?php
     $accountCodes = "SELECT * FROM tblfinglref where version = 2 ORDER BY glcode ASC";
     $acctResult = $dbh2->query($accountCodes);
     ?>
      <script type="text/javascript">
        $(function() {

          var placeholderIndex = $('#placeholderIndex').val();
          if(placeholderIndex == '1' || placeholderIndex == 1)
          {
            $('#fromDate').val($('#placeholderFromDate').val());
            $('#toDate').val($('#placeholderToDate').val());
            $('#glcode').val($('#placeholderGlcode').val());
          }
        });
      </script>

      <input class='btn form-control' type="date" id="fromDate" name='fromDate' placeholder="From" style='width:20%; text-align: left; border: 1px solid #ddd;' />
       <input class='btn form-control' type="date" id="toDate" name="toDate" placeholder="To"  style='width:20%; text-align: left; border: 1px solid #ddd;' />
     <select id="glcode" name="glcode" class="form-control btn" style='width:20%; text-align: left; border: 1px solid #ddd;'>
          <option value="All">All</option>
          <?php 
            while($row = $acctResult->fetch_assoc()) 
              {
                echo "<option value='".$row['glcode']."'>".$row['glcode']. ' - '.$row['glname']."</option>";
              }
          ?>
       </select>
       <input type="submit" name="submit" value="Submit" />
     </form>

     <?php 
        echo "<a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a>";
      if(isset($_POST['glcode']))
      {

            echo "<input type='hidden' id='placeholderFromDate' value='".$_POST['fromDate']."'/>";
            echo "<input type='hidden' id='placeholderToDate' value='".$_POST['toDate']."'/>";
            echo "<input type='hidden' id='placeholderGlcode' value='".$_POST['glcode']."'/>";
            echo "<input type='hidden' id='placeholderIndex' value='1'/>";
            $fromDate = $_POST['fromDate'];
            $toDate = $_POST['toDate'];

        $glcodeName = '';

    if($_POST['glcode']=="All") {

    $glcodeName = $_POST['glcode'];

    } else { //if($_POST['glcode']=="All")

    } //if-else if($_POST['glcode']=="All")

        $accountCodes = "SELECT * FROM tblfinglref where version = 2 AND glcode = '".$_POST['glcode']."'";
       $acctResult = $dbh2->query($accountCodes);

       while($row = $acctResult->fetch_assoc()) 
      {
        $glcodeName = $_POST['glcode'] . ' '. $row['glname'];
      }


     ?>
     <table id="tblName" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
      <thead>
<?php
        // title head
        echo "<tr><th colspan='8'>Philkoei International, Inc.</th></tr>";
        echo "<tr><th colspan='8'>General Ledger</th></tr>";
        echo "<tr><th colspan='8'>For the period ".date('F Y', strtotime($fromDate))." to ".date('F Y', strtotime($toDate))."</th></tr>";
?>
        <th colspan="8" style="text-align: left; font-size: 18px;">
          <?php 
            echo $glcodeName;
          ?>
        </th>
      </thead>
     <tbody>
      <td class='tblNameTD' style="padding:0;" colspan="3">
        <table style="margin-top:0 !important;" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
		<!-- disp col labels -->
		<tr><th>Date</th><th>Type</th><th>Beg.Balance</th><th>Debit</th></tr>
     <?php
     // $getWorkingPaper = "SELECT * from tblfinworkpaper where glcode = '".$_POST['glcode']."' AND year(month) = '".date('Y')."' ORDER by month ASC";
    $getWorkingPaper = "SELECT `month`, `begbalancedr` FROM `tblfinworkpaper` WHERE (`month` BETWEEN CAST('".$_POST['fromDate']."' AS DATE) AND CAST('".$_POST['toDate']."' AS DATE)) AND `glcode`='".$_POST['glcode']."' AND `glrefver`=2 ORDER BY `month` ASC;"; //20230704-brf
     $getWorkingPaperRows = $dbh2->query($getWorkingPaper);
// echo "<tr><td colspan='3'>$getWorkingPaper|".$_POST['fromDate']."|".$_POST['toDate']."</td></tr>";
      while($rowTotal = $getWorkingPaperRows->fetch_assoc()) 
        {

        $currMonth = $rowTotal['month'];

        // get Beg. Balance debit
        if(($rowTotal['begbalancedr'] != 0) && ($rowTotal['month'] == $_POST['fromDate'])) {
        // if($rowTotal['begbalancedr'] != 0) {
            echo "<tr>";
            echo "<td>".date('Y M', strtotime($currMonth))."</td><td>Beg.Balance</td><td class='text-right'>".number_format($rowTotal['begbalancedr'],2)."</td>";
            echo "<td></td></tr>";

        // compute total debit
        $totalDebitDr = $totalDebitDr + $rowTotal['begbalancedr'];
        } //if

        } //while($rowTotal = $getWorkingPaperRows->fetch_assoc())

    // 20230710 query distinct date-month coverage
    $resGLdrquery=""; $resultGLdr=""; $foundresGLdr=0;
    $resGLdrquery="SELECT DISTINCT DATE_FORMAT(`date`, '%Y-%m') AS `currmonth` FROM `tblfindisbursement` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($_POST['fromDate']))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($_POST['toDate']))."' AS DATE)) UNION SELECT DISTINCT DATE_FORMAT(`date`, '%Y-%m') AS `currmonth` FROM `tblfincashreceipt` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($_POST['fromDate']))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($_POST['toDate']))."' AS DATE)) UNION SELECT DISTINCT DATE_FORMAT(`date`, '%Y-%m') AS `currmonth` FROM `tblfinacctspayable` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($_POST['fromDate']))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($_POST['toDate']))."' AS DATE)) UNION SELECT DISTINCT DATE_FORMAT(`date`, '%Y-%m') AS `currmonth` FROM `tblfinjournal` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($_POST['fromDate']))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($_POST['toDate']))."' AS DATE))";
    $resultGLdr=$dbh2->query($resGLdrquery);
// echo "<tr><td colspan='3'>$resGLdrquery</td></tr>";
    if($resultGLdr->num_rows>0) {
        while($myrowGLdr = $resultGLdr->fetch_assoc()) {
        $foundresGLdr=1;
        $currMonth = $myrowGLdr['currmonth'];
        // get last day of the month
        $lastDateofMonth = date('Y-m-t', strtotime($currMonth));
// echo "<tr><td colspan='3'>$foundresGLdr|$currMonth|$lastDateofMonth</td></tr>";

        //
        // get Cash Disbursement debit
        $getCashDisbursementDr=""; $getCashDisbursementDrRows=""; $foundCDBdr=0; $totalCDBdr=0;
        $getCashDisbursementDr = "SELECT `date`, `debitamt` FROM `tblfindisbursement` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($currMonth))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($lastDateofMonth))."' AS DATE)) AND `glcode`='".$_POST['glcode']."' AND `debitamt`<>0 AND `glrefver`=2 ORDER BY `date` ASC;";
        $getCashDisbursementDrRows = $dbh2->query($getCashDisbursementDr);
// echo "<tr><td colspan='3'>$getCashDisbursementDr</td></tr>";
        if($getCashDisbursementDrRows->num_rows>0) {
            while($rowTotalCDBdr = $getCashDisbursementDrRows->fetch_assoc()) {
            $foundCDBdr=1;
            $totalCDBdr = $totalCDBdr + $rowTotalCDBdr['debitamt'];
            } //while
        } //if
        if($totalCDBdr != 0) {
            echo "<tr>";
            echo "<td>".date('Y M', strtotime($currMonth))."</td><td>CDB</td><td></td><td class='text-right'>".number_format($totalCDBdr, 2)."</td>";
            echo "</tr>";
        } //if

        $totalDebitCr = $totalDebitCr + $totalCDBdr;

        //
        // get Cash Receipt dr
        $getCashReceiptDr=""; $getCashReceiptDrRows=""; $foundCRBdr=0; $totalCRBdr=0;
        $getCashReceiptDr = "SELECT `date`, `debitamt` FROM `tblfincashreceipt` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($currMonth))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($lastDateofMonth))."' AS DATE)) AND `glcode`='".$_POST['glcode']."' AND `debitamt`<>0 AND `glrefver`=2 ORDER BY `date` ASC;";
        $getCashReceiptDrRows = $dbh2->query($getCashReceiptDr);
// echo "<tr><td colspan='3'>$getCashReceiptDr</td></tr>";
        if($getCashReceiptDrRows->num_rows>0) {
            while($rowTotalCRBdr = $getCashReceiptDrRows->fetch_assoc()) {
            $foundCRBdr=1;
            $totalCRBdr = $totalCRBdr + $rowTotalCRBdr['debitamt'];
            } //while
        } //if
        if($totalCRBdr != 0) {
            echo "<tr>";
            echo "<td>".date('Y M', strtotime($currMonth))."</td><td>CRB</td><td></td><td class='text-right'>".number_format($totalCRBdr, 2)."</td>";
            echo "</tr>";
        } //if

        $totalDebitCr = $totalDebitCr + $totalCRBdr;

        //
        // get Accts Payable dr
        $getAcctsPayableDr=""; $getAcctsPayableDrRows=""; $foundAPVdr=0; $totalAPVdr=0;
        $getAcctsPayableDr = "SELECT `date`, `debitamt` FROM `tblfinacctspayable` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($currMonth))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($lastDateofMonth))."' AS DATE)) AND `glcode`='".$_POST['glcode']."' AND `debitamt`<>0 AND `glrefver`=2 ORDER BY `date` ASC;";
        $getAcctsPayableDrRows = $dbh2->query($getAcctsPayableDr);
// echo "<tr><td colspan='3'>$getAcctsPayableDr</td></tr>";
        if($getAcctsPayableDrRows->num_rows>0) {
            while($rowTotalAPVdr = $getAcctsPayableDrRows->fetch_assoc()) {
            $foundAPVdr=1;
            $totalAPVdr = $totalAPVdr + $rowTotalAPVdr['debitamt'];
            } //while
        } //if
        if($totalAPVdr != 0) {
            echo "<tr>";
            echo "<td>".date('Y M', strtotime($currMonth))."</td><td>APB</td><td></td><td class='text-right'>".number_format($totalAPVdr, 2)."</td>";
            echo "</tr>";
        } //if

        $totalDebitCr = $totalDebitCr + $totalAPVdr;

        //
        // get Journal dr
        $getJournalDr=""; $getJournalDrRows=""; $foundJBdr=0; $totalJBdr=0;
        $getJournalDr = "SELECT `date`, `debitamt` FROM `tblfinjournal` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($currMonth))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($lastDateofMonth))."' AS DATE)) AND `glcode`='".$_POST['glcode']."' AND `debitamt`<>0 AND `glrefver`=2 ORDER BY `date` ASC;";
        $getJournalDrRows = $dbh2->query($getJournalDr);
// echo "<tr><td colspan='3'>$getJournalDr</td></tr>";
        if($getJournalDrRows->num_rows>0) {
            while($rowTotalJBdr = $getJournalDrRows->fetch_assoc()) {
            $foundJBdr=1;
            $totalJBdr = $totalJBdr + $rowTotalJBdr['debitamt'];
            } //while
        } //if
        if($totalJBdr != 0) {
            echo "<tr>";
            echo "<td>".date('Y M', strtotime($currMonth))."</td><td>JB</td><td></td><td class='text-right'>".number_format($totalJBdr, 2)."</td>";
            echo "</tr>";
        } //if

        $totalDebitCr = $totalDebitCr + $totalJBdr;

/*          if($rowTotal['begbalancedr'] != 0 && $rowTotal['month'] == '2018-01-01'){
            echo "<tr>";
            echo '<td>'.date('M d',strtotime($rowTotal['month'])).'</td>';
            echo '<td>Beg Balance</td>';
            echo '<td>'.number_format($rowTotal['begbalancedr'],2).'</td>';
            echo "</tr>";
          }

          if($rowTotal['cashdisbursementdr'] != 0){
            echo "<tr>";
            echo '<td>'.date('M t',strtotime($rowTotal['month'])).'</td>';
            echo '<td>CDB</td>';
            echo '<td>'.number_format($rowTotal['cashdisbursementdr'],2).'</td>';
            echo "</tr>";
          }

          if($rowTotal['cashreceiptdr'] != 0 ){
            echo "<tr>";
            echo '<td>'.date('M t',strtotime($rowTotal['month'])).'</td>';
            echo '<td>CRB</td>';
            echo '<td>'.number_format($rowTotal['cashreceiptdr'],2).'</td>';
            echo "</tr>";
          }

          if($rowTotal['journaldr'] != 0){
            echo "<tr>";
            echo '<td>'.date('M t',strtotime($rowTotal['month'])).'</td>';
            echo '<td>JB</td>';
            echo '<td>'.number_format($rowTotal['journaldr'],2).'</td>';

            if($rowTotal['trialbalancedr'] != 0){
                  echo '<td>'.number_format($rowTotal['trialbalancedr'],2).'</td>';
            }
            echo "</tr>";
            
          } */

        // reset vars
        $totalCDBdr=0; $totalCRBdr=0; $totalJBdr=0;

        // reset vars
        $currMonth=""; $lastDateofMonth="";

        } //while
    } //if

        // echo "<tr><th colspan='2' class='text-right'>Total Debit</th><th class='text-right'>".number_format($totalDebitDr, 2)."</th><th class='text-right'>".number_format($totalDebitCr, 2)."</th></tr>";
        $grandTotDebit = $totalDebitDr + $totalDebitCr;
        // echo "<tr><th colspan='2' class='text-right'>Grand Total</th><th colspan='2' class='text-left'>".number_format($grandTotDebit,2)."</th></tr>";
      ?>
      </table>
      </td>
      <td class='tblNameTD' style="padding:0;" colspan="3">
        <table style="margin-top:0 !important;" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
		<!-- disp 2nd col labels -->
		<tr><th>Date</th><th>Type</th><th>Credit</th><th>EndingBalance</th></tr>
         <?php
         // $getWorkingPaper = "SELECT * from tblfinworkpaper where glcode = '".$_POST['glcode']."' AND year(month) = '".date('Y')."' ORDER by month ASC";
            $getWorkingPaper = "SELECT `month`, `begbalancedr`, `begbalancecr`, `balancesheetdr`, `balancesheetcr` FROM `tblfinworkpaper` WHERE (`month` BETWEEN CAST('".$_POST['fromDate']."' AS DATE) AND CAST('".$_POST['toDate']."' AS DATE)) AND `glcode`='".$_POST['glcode']."' AND `glrefver`=2 ORDER BY `month` ASC;"; //20230704-brf
         $getWorkingPaperRows = $dbh2->query($getWorkingPaper);
// echo "<tr><td colspan='3'>$getWorkingPaper</td></tr>";
         $totalDebit = 0;
         $totalCredit = 0;
          while($rowTotal = $getWorkingPaperRows->fetch_assoc()) 
            {

        $currMonth = $rowTotal['month'];

        // get Beg. Balance credit
        if(($rowTotal['begbalancecr'] != 0) && ($rowTotal['month'] == $_POST['fromDate'])) {
        // if($rowTotal['begbalancecr'] != 0) {
            echo "<tr>";
            echo "<td>".date('Y M', strtotime($currMonth))."</td><td>Beg.Balance</td><td></td><td class='text-right'>".number_format($rowTotal['begbalancecr'],2)."</td>";
            echo "</tr>";

        $totalCreditCr = $totalCreditCr + $rowTotal['begbalancecr'];
        } //if

           } //while($rowTotal = $getWorkingPaperRows->fetch_assoc())

    // 20230710 query distinct date-month coverage
    $resGLcrquery=""; $resultGLcr=""; $foundresGLcr=0;
    $resGLcrquery="SELECT DISTINCT DATE_FORMAT(`date`, '%Y-%m') AS `currmonth` FROM `tblfindisbursement` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($_POST['fromDate']))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($_POST['toDate']))."' AS DATE)) UNION SELECT DISTINCT DATE_FORMAT(`date`, '%Y-%m') AS `currmonth` FROM `tblfincashreceipt` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($_POST['fromDate']))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($_POST['toDate']))."' AS DATE)) UNION SELECT DISTINCT DATE_FORMAT(`date`, '%Y-%m') AS `currmonth` FROM `tblfinacctspayable` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($_POST['fromDate']))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($_POST['toDate']))."' AS DATE)) UNION SELECT DISTINCT DATE_FORMAT(`date`, '%Y-%m') AS `currmonth` FROM `tblfinjournal` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($_POST['fromDate']))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($_POST['toDate']))."' AS DATE))";
    $resultGLcr=$dbh2->query($resGLcrquery);
// echo "<tr><td colspan='3'>$resGLcrquery</td></tr>";
    if($resultGLcr->num_rows>0) {
        while($myrowGLcr = $resultGLcr->fetch_assoc()) {
        $foundresGLcr=1;
        $currMonth = $myrowGLcr['currmonth'];
        // get last day of the month
        $lastDateofMonth = date('Y-m-t', strtotime($currMonth));
// echo "<tr><td colspan='3'>$foundresGLcr|$currMonth|$lastDateofMonth</td></tr>";

        //
        // get Cash Disbursement credit
        $getCashDisbursementCr=""; $getCashDisbursementCrRows=""; $foundCDBcr=0; $totalCDBcr=0;
        $getCashDisbursementCr = "SELECT `date`, `creditamt` FROM `tblfindisbursement` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($currMonth))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($lastDateofMonth))."' AS DATE)) AND `glcode`='".$_POST['glcode']."' AND `creditamt`<>0 AND `glrefver`=2 ORDER BY `date` ASC;";
        $getCashDisbursementCrRows = $dbh2->query($getCashDisbursementCr);
// echo "<tr><td colspan='3'>$getCashDisbursementCr</td></tr>";
        if($getCashDisbursementCrRows->num_rows>0) {
            while($rowTotalCDBcr = $getCashDisbursementCrRows->fetch_assoc()) {
            $foundCDBcr=1;
            $totalCDBcr = $totalCDBcr + $rowTotalCDBcr['creditamt'];
            } //while
        } //if
        if($totalCDBcr != 0) {
            echo "<tr>";
            echo "<td>".date('Y M', strtotime($currMonth))."</td><td>CDB</td><td class='text-right'>".number_format($totalCDBcr, 2)."</td><td></td>";
            echo "</tr>";
        } //if

        $totalCreditDr = $totalCreditDr + $totalCDBcr;

        //
        // get Cash Receipt cr
        $getCashReceiptCr=""; $getCashReceiptCrRows=""; $foundCRBcr=0; $totalCRBcr=0;
        $getCashReceiptCr = "SELECT `date`, `creditamt` FROM `tblfincashreceipt` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($currMonth))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($lastDateofMonth))."' AS DATE)) AND `glcode`='".$_POST['glcode']."' AND `creditamt`<>0 AND `glrefver`=2 ORDER BY `date` ASC;";
        $getCashReceiptCrRows = $dbh2->query($getCashReceiptCr);
// echo "<tr><td colspan='3'>$getCashReceiptCr</td></tr>";
        if($getCashReceiptCrRows->num_rows>0) {
            while($rowTotalCRBcr = $getCashReceiptCrRows->fetch_assoc()) {
            $foundCRBcr=1;
            $totalCRBcr = $totalCRBcr + $rowTotalCRBcr['creditamt'];
            } //while
        } //if
        if($totalCRBcr != 0) {
            echo "<tr>";
            echo "<td>".date('Y M', strtotime($currMonth))."</td><td>CRB</td><td class='text-right'>".number_format($totalCRBcr, 2)."</td><td></td>";
            echo "</tr>";
        } //if

        $totalCreditDr = $totalCreditDr + $totalCRBcr;

        //
        // 20230710 get Accts Payable cr
        $getAcctsPayableCr=""; $getAcctsPayableCrRows=""; $foundAPVcr=0; $totalAPVcr=0;
        $getAcctsPayableCr = "SELECT `date`, `creditamt` FROM `tblfinacctspayable` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($currMonth))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($lastDateofMonth))."' AS DATE)) AND `glcode`='".$_POST['glcode']."' AND `creditamt`<>0 AND `glrefver`=2 ORDER BY `date` ASC;";
        $getAcctsPayableCrRows = $dbh2->query($getAcctsPayableCr);
// echo "<tr><td colspan='3'>$getAcctsPayableCr</td></tr>";
        if($getAcctsPayableCrRows->num_rows>0) {
            while($rowTotalAPVcr = $getAcctsPayableCrRows->fetch_assoc()) {
            $foundAPVcr=1;
            $totalAPVcr = $totalAPVcr + $rowTotalAPVcr['creditamt'];
            } //while
        } //if
        if($totalAPVcr != 0) {
            echo "<tr>";
            echo "<td>".date('Y M', strtotime($currMonth))."</td><td>APB</td><td class='text-right'>".number_format($totalAPVcr, 2)."</td><td></td>";
            echo "</tr>";
        } //if

        $totalCreditDr = $totalCreditDr + $totalAPVcr;

        //
        // get Journal cr
        $getJournalCr=""; $getJournalCrRows=""; $foundJBcr=0; $totalJBcr=0;
        $getJournalCr = "SELECT `date`, `creditamt` FROM `tblfinjournal` WHERE (`date` BETWEEN CAST('".date('Y-m-d', strtotime($currMonth))."' AS DATE) AND CAST('".date('Y-m-d', strtotime($lastDateofMonth))."' AS DATE)) AND `glcode`='".$_POST['glcode']."' AND `creditamt`<>0 AND `glrefver`=2 ORDER BY `date` ASC;";
        $getJournalCrRows = $dbh2->query($getJournalCr);
// echo "<tr><td colspan='3'>$getJournalCr</td></tr>";
        if($getJournalCrRows->num_rows>0) {
            while($rowTotalJBcr = $getJournalCrRows->fetch_assoc()) {
            $foundJBcr=1;
            $totalJBcr = $totalJBcr + $rowTotalJBcr['creditamt'];
// echo "<tr><td colspan='3'>".$rowTotalJBcr['date']." > ".number_format($rowTotalJBcr['creditamt'],2)." > ".number_format($totalJBcr,2)."</td></tr>";
            } //while
        } //if
        if($totalJBcr != 0) {
            echo "<tr>";
            echo "<td>".date('Y M', strtotime($currMonth))."</td><td>JB</td><td class='text-right'>".number_format($totalJBcr, 2)."</td><td></td>";
            echo "</tr>";
        } //if

        $totalCreditDr = $totalCreditDr + $totalJBcr;

/*               if($rowTotal['begbalancecr'] != 0 && $rowTotal['month'] == '2018-01-01'){
                  echo "<tr>";
                  echo '<td>'.date('M d',strtotime($rowTotal['month'])).'</td>';
                  echo '<td>Beg Balance</td>';
                  echo '<td>'.number_format($rowTotal['begbalancecr'],2).'</td>';
                  echo "</tr>";
                }

                if($rowTotal['cashdisbursementcr'] != 0){
                  echo "<tr>";
                  echo '<td>'.date('M t',strtotime($rowTotal['month'])).'</td>';
                  echo '<td>CDB</td>';
                  echo '<td>'.number_format($rowTotal['cashdisbursementcr'],2).'</td>';
                  echo "</tr>";
                }

                if($rowTotal['cashreceiptcr']  != 0){
                  echo "<tr>";
                  echo '<td>'.date('M t',strtotime($rowTotal['month'])).'</td>';
                  echo '<td>CRB</td>';
                  echo '<td>'.number_format($rowTotal['cashreceiptcr'],2).'</td>';
                  echo "</tr>";
                }

                if($rowTotal['journalcr'] != 0){
                  echo "<tr>";
                  echo '<td>'.date('M t',strtotime($rowTotal['month'])).'</td>';
                  echo '<td>JB</td>';
                  echo '<td>'.number_format($rowTotal['journalcr'],2).'</td>';

                  if($rowTotal['trialbalancecr'] != 0){
                  echo '<td>'.number_format($rowTotal['trialbalancecr'],2).'</td>';
                }
                  echo "</tr>";
                } */

        // reset vars
        $totalCDBcr=0; $totalCRBcr=0; $totalJBcr=0;

        // reset vars
        $currMonth=""; $lastDateofMonth="";

        } //while
    } //if
              

        // get Beg. Balance debit of last month
            $getWorkingPaper = "SELECT `month`, `begbalancedr`, `begbalancecr`, `balancesheetdr`, `balancesheetcr` FROM `tblfinworkpaper` WHERE (`month` BETWEEN CAST('".$_POST['fromDate']."' AS DATE) AND CAST('".$_POST['toDate']."' AS DATE)) AND `glcode`='".$_POST['glcode']."' AND `glrefver`=2 ORDER BY `month` ASC;"; //20230704-brf
         $getWorkingPaperRows = $dbh2->query($getWorkingPaper);
// echo "<tr><td colspan='3'>$getWorkingPaper</td></tr>";
         $totalDebit = 0;
         $totalCredit = 0;
          while($rowTotal = $getWorkingPaperRows->fetch_assoc()) 
            {

    // echo "<tr><td colspan='4'>".date('Y-m', strtotime($_POST['toDate']))."|".date('Y-m', strtotime($rowTotal['month']))."|".$rowTotal['begbalancedr']."</td></tr>";
        if(($rowTotal['balancesheetdr'] != 0) && (date('Y-m', strtotime($rowTotal['month'])) == date('Y-m', strtotime($_POST['toDate'])))) {
        // if($rowTotal['begbalancedr'] != 0) {
            echo "<tr>";
            echo "<td>".date('Y M', strtotime($rowTotal['month']))."</td><td>End Balance</td><td></td><td class='text-right'>".number_format($rowTotal['balancesheetdr'],2)."</td>";
            echo "</tr>";

        $totalCreditCr = $totalCreditCr + $rowTotal['balancesheetdr'];
        } //if
 
            } //while($rowTotal = $getWorkingPaperRows->fetch_assoc())

        // echo "<tr><th colspan='2' class='text-right'>Total Credit</th><th class='text-right'>".number_format($totalCreditDr, 2)."</th><th class='text-right'>".number_format($totalCreditCr, 2)."</th></tr>";
        $grandTotCredit = $totalCreditDr + $totalCreditCr;
        // echo "<tr><th colspan='2' class='text-right'>Grand Total<th colspan='2' class='text-left'>".number_format($grandTotCredit,2)."</th></tr>";

        } //if(isset($_POST['glcode']))

          ?>
          </table>
          </td>
	</tr>

<!-- disp total -->
    <tr>
      <td class='tblNameTD' style="padding:0;" colspan="3">
        <table style="margin-top:0 !important;" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
<?php
        echo "<tr><th colspan='2' class='text-right'>Total Debit</th><th class='text-right'>".number_format($totalDebitDr, 2)."</th><th class='text-right'>".number_format($totalDebitCr, 2)."</th></tr>";
        $grandTotDebit = $totalDebitDr + $totalDebitCr;
        // echo "<tr><th colspan='2' class='text-right'>Grand Total</th><th colspan='2' class='text-left'>".number_format($grandTotDebit,2)."</th></tr>";
?>
		</table>
      </td>

      <td class='tblNameTD' style="padding:0;" colspan="3">
        <table style="margin-top:0 !important;" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
<?php
        echo "<tr><th colspan='2' class='text-right'>Total Credit</th><th class='text-right'>".number_format($totalCreditDr, 2)."</th><th class='text-right'>".number_format($totalCreditCr, 2)."</th></tr>";
        $grandTotCredit = $totalCreditDr + $totalCreditCr;
        // echo "<tr><th colspan='2' class='text-right'>Grand Total<th colspan='2' class='text-left'>".number_format($grandTotCredit,2)."</th></tr>";
?>
		</table>
      </td>
	</tr>
      </tbody>
      </table>

      </div>
      </div>
      <?php 
     $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
