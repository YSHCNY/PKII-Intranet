

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
     echo "<p><font size=1>Manage >> Finance Reports >> Others</font></p>";

     echo '<form method="post" action="reportothers.php?loginid='.$loginid.'">';
     echo "<select name='yrmonthavlbl'>";
    echo "<option>Year-Month</option>";

    $res11query = "SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfinjournal WHERE journalid <> '' ORDER BY date DESC";
    $result11="";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
      while($myrow11=$result11->fetch_assoc()) {
      $found11 = 1;
      $yyyymonth = $myrow11['yyyymonth'];
      echo "<option value=\"$yyyymonth\">$yyyymonth</option>";
      } // if($result11->num_rows>0)
    } // while($myrow11=$result11->fetch_assoc())
    echo "</select>";
     ?>

     
       <select id="glcode" name="glcode" class="form-control btn" style='width:20%; text-align: left; border: 1px solid #ddd;'>
          <option value="10.10.404">10.10.404 - Advances to Clients</option>
          <option value="10.10.300">10.10.300 - Accounts Receivable Trade</option>
          <option value="20.30.100">20.30.100 - Output Vat</option>
          <option value="10.10.440">10.10.440 - Work In Progress</option>
          <option value="10.10.401">10.10.401 - Advances for Liquidition</option>
          <option value="20.10.230">20.10.230 - Advances from Client</option>
          <option value="10.10.404">10.10.404 - Advances to Clients</option>
          <option value="20.10.200">20.10.200 - Accounts Payable Others</option>
          <option value="10.10.350">10.10.350 - Accounts Receivables Others</option>
          <option value="10.10.352.1">10.10.352.1 - A.R.O VAT</option>
          <option value="50.10.100">50.10.100 - FOREX</option>
          <option value="50.10.300">50.10.300 - Interest Income from Investments</option>
          <option value="10.10.465">10.10.465 - Prepaid Tax EVAT</option>
          <option value="10.10.466">10.10.466 - Prepaid Tax EWT</option>
          <option value="50.00.000">50.00.000 - Other Income</option>
       </select>
       <button type="submit" class="btn btnConfirm btn-default" id="btnConfirm">Submit</button>
       </form>

     <!-- <table id="tblName" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'> -->
     <table id="ReportTable" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
      <thead>
        <th><a href='#' id='exportToExcel'><img src='./images/sheet.gif'></a>&nbsp;Ref. Number</th>
        <th>Name</th>
        <th>Book</th>
        <th>Debit</th>
        <th>Credit</th>
        <th>Balance Debit</th>
        <th>Balance Credit</th>

      </thead>
     <tbody>
     <?php 
      if(isset($_POST['glcode'])){

        $glcodeselected = (isset($_POST['glcode'])) ? $_POST['glcode'] :'';

     $grandTotalCredit = 0;
     $grandTotalDebit = 0;
     $grandTotal = 0;
     $yearMonth = (isset($_POST['yrmonthavlbl'])) ? $_POST['yrmonthavlbl'] :'';
     $month = date('Y', strtotime($yearMonth));
     $yyyymm = date('Y-m', strtotime($yearMonth));
        $sumDisbursementDebit = 0;
        $sumDisbursementCredit = 0;
        $sumCashReceiptDebit = 0;
        $sumCashReceiptCredit = 0;
        $sumJournalDebit = 0;
        $sumJournalCredit = 0;
        $totalSubDebit = 0;
        $totalSubCredit = 0;

        //disbursement
        // $subDisbursement = "SELECT * FROM tblfindisbursement WHERE date like '%2017%' AND glcode = '10.10.121.A' ORDER by projcode";
        $subDisbursement = "SELECT * FROM tblfindisbursement WHERE date like '%$yyyymm%' AND glcode = '$glcodeselected' ORDER by projcode DESC";
        $subDisbursementResult = $dbh2->query($subDisbursement);
        while($rowDisbursement = $subDisbursementResult->fetch_assoc()) 
        {
          $sumDisbursementDebit = $sumDisbursementDebit + $rowDisbursement['debitamt'];
          $sumDisbursementCredit = $sumDisbursementCredit + $rowDisbursement['creditamt'];
          $totalSubDebit = $sumDisbursementDebit;
          $totalSubCredit = $sumDisbursementCredit;
          $grandTotal = $grandTotal + $sumDisbursementCredit - $sumDisbursementDebit;
          
          echo "<tr>";
            echo "<td>".$rowDisbursement['disbursementnumber'] ."</td>";
            echo "<td>".str_replace("'", "", $rowDisbursement['particulars'])." - ".str_replace("'", "", $rowDisbursement['explanation'])."</td>";
            echo "<td>Disbursement Book</td>";
            echo "<td class='text-right'>".number_format($rowDisbursement['debitamt'],2) ."</td>";
            echo "<td class='text-right'>".number_format($rowDisbursement['creditamt'],2) ."</td>";
            echo "<td class='text-right'>".number_format($totalSubDebit,2) ."</td>";
            echo "<td class='text-right'>".number_format($totalSubCredit,2) ."</td>";
          echo "</tr>";
         
        }
        //enddisbursement

        //acctspayable
        // $subAcctsPayable = "SELECT * FROM tblfinacctspayable WHERE date like '%2017%' AND glcode = '10.10.121.A' ORDER by projcode";
        $subAcctsPayable = "SELECT tblfinacctspayable.acctspayablenumber, tblfinacctspayable.particulars, tblfinacctspayable.debitamt, tblfinacctspayable.creditamt, tblfinacctspayabletot.explanation FROM tblfinacctspayable LEFT JOIN tblfinacctspayabletot ON tblfinacctspayable.acctspayablenumber=tblfinacctspayabletot.acctspayablenumber WHERE tblfinacctspayable.date like '%$yyyymm%' AND tblfinacctspayable.glcode = '$glcodeselected' ORDER by tblfinacctspayable.projcode DESC";
        $subAcctsPayableResult = $dbh2->query($subAcctsPayable);

        while($rowAcctsPayable = $subAcctsPayableResult->fetch_assoc()) 
        {
          $sumDisbursementDebit = $sumDisbursementDebit + $rowAcctsPayable['debitamt'];
          $sumDisbursementCredit = $sumDisbursementCredit + $rowAcctsPayable['creditamt'];
          $totalSubDebit = $sumDisbursementDebit;
          $totalSubCredit = $sumDisbursementCredit;
          $grandTotal = $grandTotal + $sumDisbursementCredit - $sumDisbursementDebit;
          echo "<tr>";
            echo "<td>".$rowAcctsPayable['acctspayablenumber'] ."</td>";
            echo "<td>".str_replace("'", "", $rowAcctsPayable['particulars']) ." - ".str_replace("'", "", $rowAcctsPayable['explanation']) ."</td>";
            echo "<td>Accts Payable Book</td>";
            echo "<td class='text-right'>".number_format($rowAcctsPayable['debitamt'],2) ."</td>";
            echo "<td class='text-right'>".number_format($rowAcctsPayable['creditamt'],2) ."</td>";
            echo "<td class='text-right'>".number_format($totalSubDebit,2) ."</td>";
            echo "<td class='text-right'>".number_format($totalSubCredit,2) ."</td>";
          echo "</tr>";
        }
        //acctspayable

        //cashreceipt
        // $subCashReceipt = "SELECT * FROM tblfincashreceipt WHERE date like '%2017%' AND glcode = '10.10.121.A' ORDER by projcode";
        $subCashReceipt = "SELECT * FROM tblfincashreceipt WHERE date like '%$yyyymm%' AND glcode = '$glcodeselected' ORDER by projcode DESC";
        $subCashReceiptResult = $dbh2->query($subCashReceipt);

        while($rowCashReceipt = $subCashReceiptResult->fetch_assoc()) 
        {
          $sumDisbursementDebit = $sumDisbursementDebit + $rowCashReceipt['debitamt'];
          $sumDisbursementCredit = $sumDisbursementCredit + $rowCashReceipt['creditamt'];
          $totalSubDebit = $sumDisbursementDebit;
          $totalSubCredit = $sumDisbursementCredit;
          $grandTotal = $grandTotal + $sumDisbursementCredit - $sumDisbursementDebit;
          echo "<tr>";
            echo "<td>".$rowCashReceipt['cashreceiptnumber'] ."</td>";
            echo "<td>".str_replace("'", "", $rowCashReceipt['particulars']) ." - ".str_replace("'", "", $rowCashReceipt['explanation']) ."</td>";
            echo "<td>Cash Receipt Book</td>";
            echo "<td class='text-right'>".number_format($rowCashReceipt['debitamt'],2) ."</td>";
            echo "<td class='text-right'>".number_format($rowCashReceipt['creditamt'],2) ."</td>";
            echo "<td class='text-right'>".number_format($totalSubDebit,2) ."</td>";
            echo "<td class='text-right'>".number_format($totalSubCredit,2) ."</td>";
          echo "</tr>";
        }
        //endcashreceipt

        //JV Start
        // $subJournal = "SELECT * FROM tblfinjournal WHERE date like '%2017%' AND glcode = '10.10.121.A' ORDER by projcode";
        $subJournal = "SELECT * FROM tblfinjournal WHERE date like '%$yyyymm%' AND glcode = '$glcodeselected' ORDER by projcode DESC";
        $subJournalResult = $dbh2->query($subJournal);

        while($rowJournal = $subJournalResult->fetch_assoc()) 
        {
          $sumDisbursementDebit = $sumDisbursementDebit + $rowJournal['debitamt'];
          $sumDisbursementCredit = $sumDisbursementCredit + $rowJournal['creditamt'];
          $totalSubDebit = $sumDisbursementDebit;
          $totalSubCredit = $sumDisbursementCredit;
          $grandTotal = $grandTotal + $sumDisbursementCredit - $sumDisbursementDebit;
          echo "<tr>";
            echo "<td>".$rowJournal['journalnumber'] ."</td>";
            echo "<td>".str_replace("'", "", $rowJournal['particulars']) ." - ".str_replace("'", "", $rowJournal['explanation']) ."</td>";
            echo "<td>Journal Voucher Book</td>";
            echo "<td class='text-right'>".number_format($rowJournal['debitamt'],2) ."</td>";
            echo "<td class='text-right'>".number_format($rowJournal['creditamt'],2) ."</td>";
            echo "<td class='text-right'>".number_format($totalSubDebit,2) ."</td>";
            echo "<td class='text-right'>".number_format($totalSubCredit,2) ."</td>";
          echo "</tr>";
        }


        // $subAcctP = "SELECT * FROM tblfinacctspayable WHERE date like '%2017%' AND glcode = '10.10.121.A' ORDER by projcode";
        // $subAcctPresult = $dbh2->query($subAcctP);
        // while($rowAcctP = $subAcctPresult->fetch_assoc()) 
        // {
        //   $sumDisbursementDebit = $sumDisbursementDebit + $rowAcctP['debitamt'];
        //   $sumDisbursementCredit = $sumDisbursementCredit + $rowAcctP['creditamt'];
        //   $totalSubDebit = $sumDisbursementDebit;
        //   $totalSubCredit = $sumDisbursementCredit;
        //   $grandTotal = $grandTotal + $sumDisbursementCredit - $sumDisbursementDebit;
          
        //   echo "<tr>";
        //     echo "<td>".$rowAcctP['acctspayablenumber'] ."</td>";
        //     echo "<td>".$rowAcctP['particulars'] ." ". $rowAcctP['explanation'] ."</td>";
        //     echo "<td>Accounts Payable</td>";
        //     echo "<td>".number_format($rowAcctP['debitamt'],2) ."</td>";
        //     echo "<td>".number_format($rowAcctP['creditamt'],2) ."</td>";
        //     echo "<td>".number_format($totalSubDebit,2) ."</td>";
        //     echo "<td>".number_format($totalSubCredit,2) ."</td>";
        //   echo "</tr>";
         
        // }


        echo '<h2>'.number_format((11989954.97 - $totalSubCredit) + $totalSubDebit , 2).'</h2>';

        //JV End
     }
      ?>
      </tbody>
      </table>
      <script>
        $(document).ready(function(){
            
        });
      </script>
      </div>
      </div>
      <?php 

    echo "<p><a href=\"finrptmnu.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 