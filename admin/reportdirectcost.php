<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$fromDate = date('Y-m-d',strtotime($_POST['fromDate']));
$d = new DateTime($fromDate);

$toDate = date('Y-m-d',strtotime($_POST['toDate']));
$lastMonth =$d->modify('first day of last month');
$workingPaperDate = $lastMonth->format('Y-m-d');
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
     echo "<p><font size=1>Manage >> Finance Reports >> Statement of Direct Cost</font></p>";
     echo '<form method="post" action="reportdirectcost.php?loginid='.$loginid.'">';
     ?>

      <input class='btn form-control' type="text" id="fromDate" name='fromDate' placeholder="from"  style='width:30%; text-align: left; border: 1px solid #ddd;' />
       <input class='btn form-control' type="text" id="toDate" name="toDate" placeholder="To"  style='width:30%; text-align: left; border: 1px solid #ddd;' />
       <button type="submit" class="btn btnConfirm btn-default" id="btnConfirm">Submit</button>
       </form>

     <!-- <table id="tblName" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'> -->

     <table id="ReportTable" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
      <thead>
        <th><a href='#' id='exportToExcel'><img src='./images/sheet.gif'></a>&nbsp;Ref. Number</th>
        <th>Date</th>
        <th>Particulars</th>
        <th>Beginning Balance</th>
        <th>Debit</th>
        <th>Credit</th>
        <th>Ending Balance</th>

      </thead>
     <tbody>
     <?php 
     if (isset($_POST["fromDate"]))
     {
     $accountCodes = "SELECT * FROM tblfinglref where version = 2 AND glname LIKE '%DC%'";
     $acctResult = $dbh2->query($accountCodes);
    
     $grandTotalCredit = 0;
     $grandTotalDebit = 0;
     $beginningBalanceDebit = 0;
     $beginningBalanceCredit = 0;

        $getWorkingPaper = "SELECT * from tblfinworkpaper where glcode = '60.00.000' AND month = '".$workingPaperDate."'";
        $getWorkingPaperRows = $dbh2->query($getWorkingPaper);


        while($rowTotal = $getWorkingPaperRows->fetch_assoc()) 
          {
            $beginningBalance = $rowTotal['trialbalancedr'];
          }


     while($row = $acctResult->fetch_assoc()) 
      {
        $sumDisbursementDebit = 0;
        $sumDisbursementCredit = 0;
        $sumCashReceiptDebit = 0;
        $sumCashReceiptCredit = 0;
        $sumJournalDebit = 0;
        $sumJournalCredit = 0;
        $totalSubDebit = 0;
        $totalSubCredit = 0;
        

        echo "<tr>";
        echo "<td colspan='9'><h2 style='font-size:20; font-weight:700;'>".$row['glcode'] ." - ".$row['glname']."<b/><h2></td>";
        echo "</tr>";

        //disbursement
        $subDisbursement = "SELECT * FROM tblfindisbursement WHERE date BETWEEN '".$fromDate."' AND '".$toDate."' AND glcode = '".$row['glcode']."'";
        $subDisbursementResult = $dbh2->query($subDisbursement);
        while($rowDisbursement = $subDisbursementResult->fetch_assoc()) 
        {

          echo "<tr>";
            echo "<td>".$rowDisbursement['disbursementnumber'] ."</td>";
            echo "<td>".$rowDisbursement['date'] ."</td>";
            echo "<td>".str_replace("'", "", $rowDisbursement['particulars']).' - '.str_replace("'", "", $rowDisbursement['explanation'])."</td>";

            if($beginningBalance < 0){echo "<td align='right'>(".number_format(abs($beginningBalance),2) .")</td>";}
            else{echo "<td align='right'>".number_format($beginningBalance,2) ."</td>";}
            echo "<td align='right'>".number_format($rowDisbursement['debitamt'],2) ."</td>";
            echo "<td align='right'>".number_format($rowDisbursement['creditamt'],2) ."</td>";
            $beginningBalance += $rowDisbursement['debitamt'];
            $beginningBalance -= $rowDisbursement['creditamt'];
            if($beginningBalance < 0){echo "<td align='right'>(".number_format(abs($beginningBalance),2) .")</td>";}
            else{echo "<td align='right'>".number_format($beginningBalance,2) ."</td>";}

          echo "</tr>";
          $sumDisbursementDebit = $sumDisbursementDebit + $rowDisbursement['debitamt'];
          $sumDisbursementCredit = $sumDisbursementCredit + $rowDisbursement['creditamt'];
        }
        //enddisbursement

        //cashreceipt

        $subCashReceipt = "SELECT * FROM tblfincashreceipt WHERE date BETWEEN '".$fromDate."' AND '".$toDate."' AND glcode = '".$row['glcode']."'";
        $subCashReceiptResult = $dbh2->query($subCashReceipt);

        while($rowCashReceipt = $subCashReceiptResult->fetch_assoc()) 
        {
          echo "<tr>";
            echo "<td>".$rowCashReceipt['cashreceiptnumber'] ."</td>";
            echo "<td>".$rowCashReceipt['date'] ."</td>";
            echo "<td>".$rowCashReceipt['particulars'] .' - '.$rowCashReceipt['explanation'] ."</td>";
            if($beginningBalance < 0){echo "<td align='right'>(".number_format(abs($beginningBalance),2) .")</td>";}
            else{echo "<td align='right'>".number_format($beginningBalance,2) ."</td>";}
            echo "<td align='right'>".number_format($rowCashReceipt['debitamt'],2) ."</td>";
            echo "<td align='right'>".number_format($rowCashReceipt['creditamt'],2) ."</td>";
            $beginningBalance += $rowCashReceipt['debitamt'];
            $beginningBalance -= $rowCashReceipt['creditamt'];
            if($beginningBalance < 0){echo "<td align='right'>(".number_format(abs($beginningBalance),2) .")</td>";}
            else{echo "<td align='right'>".number_format($beginningBalance,2) ."</td>";}
          echo "</tr>";
          $sumCashReceiptDebit = $sumCashReceiptDebit + $rowCashReceipt['debitamt'];
          $sumCashReceiptCredit = $sumCashReceiptCredit + $rowCashReceipt['creditamt'];
        }

          //endcashreceipt
          //JV
          $subJournal = "SELECT * FROM tblfinjournal WHERE date BETWEEN '".$fromDate."' AND '".$toDate."' AND glcode = '".$row['glcode']."'";
        $subJournalResult = $dbh2->query($subJournal);

        while($rowJournal = $subJournalResult->fetch_assoc()) 
        {
          echo "<tr>";
            echo "<td>".$rowJournal['journalnumber'] ."</td>";
            echo "<td>".$rowJournal['date'] ."</td>";
            echo "<td>".$rowJournal['particulars'] .' - '.$rowJournal['explanation'] ."</td>";
             if($beginningBalance < 0){echo "<td align='right'>(".number_format(abs($beginningBalance),2) .")</td>";}
            else{echo "<td align='right'>".number_format($beginningBalance,2) ."</td>";}
            echo "<td align='right'>".number_format($rowJournal['debitamt'],2) ."</td>";
            echo "<td align='right'>".number_format($rowJournal['creditamt'],2) ."</td>";
            $beginningBalance += $rowJournal['debitamt'];
            $beginningBalance -= $rowJournal['creditamt'];
            if($beginningBalance < 0){echo "<td align='right'>(".number_format(abs($beginningBalance),2) .")</td>";}
            else{echo "<td align='right'>".number_format($beginningBalance,2) ."</td>";}

          echo "</tr>";
          $sumJournalDebit = $sumJournalDebit + $rowJournal['debitamt'];
          $sumJournalCredit = $sumJournalCredit + $rowJournal['creditamt'];
        }

          //END JV
          $allTotalDebit = $sumCashReceiptDebit+$sumDisbursementDebit+$sumJournalDebit;
          $allTotalCredit = $sumCashReceiptCredit+$sumDisbursementCredit+$sumJournalCredit;
          echo "<tr>";
            echo "<td colspan='4'><h3 style='font-size:18px; font-weight:700;'>TOTAL: DEBIT/CREDIT</h3></td>";
            echo "<td colspan='1' align='right'><h3 style='font-size:18px; font-weight:700;'>".number_format($allTotalDebit,2)."</h3></td>";
            echo "<td colspan='1' align='right'><h3 style='font-size:18px; font-weight:700;'>".number_format($allTotalCredit,2)."</h3></td>";
						echo "<td colspan='1'></td>";
          echo "</tr>";
          $grandTotalDebit = $allTotalDebit;
          $grandTotalCredit = $allTotalCredit;
          $pinakaTotalDebit += $allTotalDebit;
          $pinakaTotalCredit += $allTotalCredit;
      }


       echo "<tr>";
       echo "<td colspan='4'><h3 style='font-size:18px; font-weight:700;'>GRAND TOTAL: DEBIT/CREDIT</h3></td>";
       echo "<td colspan='1' align='right'><h3 style='font-size:18px; font-weight:700;'>".number_format($pinakaTotalDebit,2)."</h3></td>";
       echo "<td colspan='1' align='right'><h3 style='font-size:18px; font-weight:700;'>".number_format($pinakaTotalCredit,2)."</h3></td>";
			echo "<td colspan='1'></td>";
       echo "</tr>";
      }

      ?>
      </tbody>
      </table>
      <script>
        $(document).ready(function(){
            $('#fromDate').datepicker();
            $('#toDate').datepicker();
        });
      </script>
      </div>
      </div>
      <?php

    echo "<p><a href=\"finrptmnu.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

     $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 