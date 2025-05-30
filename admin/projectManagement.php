<?php 
include("db1.php");
$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$found = 0;

$yyyymonthCR = (isset($_POST['yyyymonthCR'])) ? $_POST['yyyymonthCR'] :'';
// $yyyymonthCV = (isset($_POST['yyyymonthCV'])) ? $_POST['yyyymonthCV'] :'';
if($yyyymonthCR=="") { $yyyymonthCR="total"; }

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

    if(isset($_GET['pid'])) {
    	$projectId = $_GET['pid'];
		$resquery = "SELECT * from tblproject1 WHERE projectid=".$projectId;
    }

    if(isset($_GET['projcode'])) {
    	$projectId = $_GET['projcode'];
		$resquery = "SELECT * from tblproject1 WHERE proj_code='".$projectId."'";
		$contractid = $_GET['contractid'];
    }
		
	$result = $dbh2->query($resquery);

	$projname = '';
	$projcode = '';
	$datestart = '';
	$services = '';
	$projclass = '';

	while($myrow = $result->fetch_assoc()) {
		$projname = $myrow['proj_fname'];
		$projcode = $myrow['proj_code'];
		$datestart = $myrow['date_start'];
		$services = $myrow['proj_sname'];
		$projclass = $myrow['proj_class'];
	} 
	$people = "SELECT * FROM tblprojassign INNER JOIN tblcontact ON tblprojassign.employeeid=tblcontact.employeeid WHERE tblprojassign.proj_name='".$services."' GROUP BY tblcontact.name_last ORDER BY tblcontact.name_last ASC ";
	$peopleresult = $dbh2->query($people);
?>

<div id="projectDetails" class="projectDetailsContainer">
	<div id="projectDetails" class="projectDetailsWrapper">
		<div class="firstRow">
			<div class="col-md-7">
				<h3><?php echo $projcode.' - '.$projname; ?></h3>
				<h5 id='projacro'><?php echo $services; ?></h5>
				<div class="col-md-6">
					<h5>Date Started: <?php echo date('F d, Y', strtotime($datestart)); ?></h5>
				</div>
				<div class="col-md-6">
					<h5>Project Class: <?php echo $projclass; ?></h5>
				</div>
				<div class="firstRowColumn">
					<h3>People</h3>
					<?php 
						while($myrowpeople = $peopleresult->fetch_assoc()) {
							echo "<div class='col-md-6'>";
							echo '<h5>'.$myrowpeople['name_first'].' '.$myrowpeople['name_last'].'</h5>' ;
							echo "</div>";	
						} 
					?>
				</div>
				<div style="clear: both;"></div>

				<div class="secondRowColumn">
					<div class="col-md-6 no-padding-right">
						<h3>Payables</h3>
						<!-- <div id="leftPayment" class="col-md-6 borderGray">
							<h4>Due</h4>
							<h5>PHP 29,350.00</h5>
						</div>
						<div id="rightPayment" class="col-md-6 borderGray">
							<h4>Overdue</h4>
							<h5>PHP 12,500.00</h5>
						</div> -->
<?php
    echo "<div id='leftPayable' class='col-md-6 borderGray'><h4>Total";
    // echo "<form action=\"projectManagement.php?pid=$projectId&loginid=$loginid\" method=\"POST\" name=\"projectManagement\"><div class='form-group'>";
    // echo "<select class='form-control' name=\"yyyymonthAP\">";
    // echo "<option value=\"total\">Total</option>";
    /* $res11query=""; $result11=""; $found11=0; $ctr11=0;
    $res11query="SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfincashreceipt WHERE cashreceiptid<>'' AND  `projcode`='$projcode' ORDER BY date DESC;";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11=1;
        $ctr11++;
        $yyyymonth11=$myrow11['yyyymonth'];
        if($yyyymonthCR==$yyyymonth11) { 
            $yyyymonthsel="selected";
        } else { 
            $yyyymonthsel=""; 
        } //if-else
        echo "<option value=\"$yyyymonth11\" $yyyymonthsel>".date("Y M", strtotime($yyyymonth11))."</option>";
        } //while
    } //if */
    // echo "</select>";
    // echo "<button type=\"submit\" class=\"btn btn-primary btn-sm\" name=\"selectyyyymo\" value=\"1\">Select</button>";
    // echo "</div></form>";
    echo "</h4>";
    echo "</div>";

    echo "<div id='rightPayable' class='col-md-6 borderGray'>";
    // set fixed var:
    $yyyymonthAP="total";
    if($yyyymonthAP!="") {
        if($yyyymonthAP!="total") {
        // set dates 1st and last day of month
        $yyyymmday1 = date("Y-m-01", strtotime($yyyymonthAP));
        $yyyymmdaylast = date("Y-m-t", strtotime($yyyymonthAP));
        // query tblfincashreceipt for the month
        $res12cquery=""; $result12c=""; $found12c=0; $ctr12c=0; $debittotAP=0; $credittotAP=0;
        $res12cquery="SELECT `acctspayableid`, `debitamt`, `creditamt` FROM `tblfinacctspayable` WHERE `projcode`=\"$projcode\" AND (`date` BETWEEN \"$yyyymmday1\" AND \"$yyyymmdaylast\") ORDER BY `date` ASC";

        } else {
        // query tblfincashreceipt for the month
        $res12cquery=""; $result12c=""; $found12c=0; $ctr12c=0; $debittotAP=0; $credittotAP=0;
        $res12cquery="SELECT `acctspayableid`, `debitamt`, `creditamt` FROM `tblfinacctspayable` WHERE `projcode`=\"$projcode\" ORDER BY `date` ASC";

        } //if-else
        // echo "<h5>$yyyymonth|".date("Y-m", strtotime($yyyymonth))."|$yyyymmday1|$yyyymmdaylast</h5>";
        $result12c=$dbh2->query($res12cquery);
        if($result12c->num_rows>0) {
            while($myrow12c=$result12c->fetch_assoc()) {
            $found12c=1; $ctr12c++;
            $acctspayableid12c = $myrow12c['cashreceiptid'];
            $debitamt12c = $myrow12c['debitamt'];
            $creditamt12c = $myrow12c['creditamt'];
            $debittotAP = $debittotAP + $debitamt12c;
            $credittotAP = $credittotAP + $creditamt12c;
            } //while
        } //if
        if($credittotAP!=0) { 
            echo "<h5>PHP&nbsp;".number_format($credittotAP)."</h5>"; 
        } else if($debittotAP!=0) { 
            echo "<h5>PHP&nbsp;".number_format($debittotAP)."</h5>"; 
        } else { 
            echo "<h5>PHP 0.00</h5>"; 
        } //if-else
    } else {
        echo "<h5>PHP 0.00</h5>";
    } //if-else
    echo "</div>";
?>
					</div>
				</div>

				<div class="secondRowColumn">
					<div class="col-md-6 no-padding-right">
						<!-- <h3>Invoices</h3> -->
                                                <h3>Payments Received</h3>
						<!-- <div id="leftInvoice" class="col-md-6 borderGray">
							<h4>Due</h4>
							<h5>PHP 29,350.00</h5>
						</div>
						<div id="rightInvoice" class="col-md-6 borderGray">
							<h4>Overdue</h4>
							<h5>PHP 12,500.00</h5>
						</div> -->
<?php
    echo "<div id='leftInvoice' class='col-md-6 borderGray'><h4>";
    echo "<form action=\"projectManagement.php?pid=$projectId&loginid=$loginid\" method=\"POST\" name=\"projectManagement\"><div class='form-group'>";
    echo "<select class='form-control' name=\"yyyymonthCR\">";
    echo "<option value=\"total\">Total</option>";
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
    $res11query="SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfincashreceipt WHERE cashreceiptid<>'' AND  `projcode`='$projcode' ORDER BY date DESC;";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11=1;
        $ctr11++;
        $yyyymonth11=$myrow11['yyyymonth'];
        if($yyyymonthCR==$yyyymonth11) { 
            $yyyymonthsel="selected";
        } else { 
            $yyyymonthsel=""; 
        } //if-else
        echo "<option value=\"$yyyymonth11\" $yyyymonthsel>".date("Y M", strtotime($yyyymonth11))."</option>";
        } //while
    } //if
    echo "</select>";
    echo "<button type=\"submit\" class=\"btn btn-primary btn-sm\" name=\"selectyyyymo\" value=\"1\">Select</button>";
    echo "</div></form>";
    echo "</h4>";
    echo "</div>";

    echo "<div id='rightInvoice' class='col-md-6 borderGray'>";
    if($yyyymonthCR!="") {
        if($yyyymonthCR!="total") {
        // set dates 1st and last day of month
        $yyyymmday1 = date("Y-m-01", strtotime($yyyymonthCR));
        $yyyymmdaylast = date("Y-m-t", strtotime($yyyymonthCR));
        // query tblfincashreceipt for the month
        $res12query=""; $result12=""; $found12=0; $ctr12=0; $debittotCR=0; $credittotCR=0;
        $res12query="SELECT `cashreceiptid`, `debitamt`, `creditamt` FROM `tblfincashreceipt` WHERE `projcode`=\"$projcode\" AND `glcode` LIKE \"10.10.3%\" AND (`date` BETWEEN \"$yyyymmday1\" AND \"$yyyymmdaylast\") ORDER BY `date` ASC";

        } else {
        // query tblfincashreceipt for the month
        $res12query=""; $result12=""; $found12=0; $ctr12=0; $debittotCR=0; $credittotCR=0;
        $res12query="SELECT `cashreceiptid`, `debitamt`, `creditamt` FROM `tblfincashreceipt` WHERE `projcode`=\"$projcode\" AND `glcode` LIKE \"10.10.3%\" ORDER BY `date` ASC";

        } //if-else
        // echo "<h5>$yyyymonth|".date("Y-m", strtotime($yyyymonth))."|$yyyymmday1|$yyyymmdaylast</h5>";
        $result12=$dbh2->query($res12query);
        if($result12->num_rows>0) {
            while($myrow12=$result12->fetch_assoc()) {
            $found12=1; $ctr12++;
            $cashreceiptid12 = $myrow12['cashreceiptid'];
            $debitamt12 = $myrow12['debitamt'];
            $creditamt12 = $myrow12['creditamt'];
            $debittotCR = $debittotCR + $debitamt12;
            $credittotCR = $credittotCR + $creditamt12;
            } //while
        } //if
        if($credittotCR!=0) { echo "<h5>PHP&nbsp;".number_format($credittotCR)."</h5>"; } else {
            if($debittotCR!=0) { echo "<h5>PHP&nbsp;".number_format($debittotCR)."</h5>"; }
        } //if-else
    } else {
        echo "<h5>PHP 0.00</h5>";
    } //if-else
    echo "</div>";

?>
					</div>
				</div>

<!-- insert disbursed amount here but replace with total transactions -->
				<div class="secondRowColumn">
					<div class="col-md-6 no-padding-left">
						<!-- <h3>Disbursed Amount</h3> -->
                                                <h3>Total Transactions</h3>
						<!-- <div id="leftPayment" class="col-md-6 borderGray">
							<h4>Today</h4>
							<h5>PHP 0.00</h5>
						</div>  -->
						<!-- <div id="rightPayment" class="col-md-6 borderGray"> -->
							<!-- <h4>This Month</h4> -->
							<!-- <h5>PHP 26,500.00</h5> -->
						<!-- </div> -->
<?php
    // query total transactions from tblfindisbursement, tblfincashreceipt and tblfinjournal
      $totalDisbursmentDebit = 0;
      $totalDisbursmentCredit = 0;
      $totalJournalDebit = 0;
      $totalJournalCredit = 0;
      $totalCashReceiptDebit = 0;
      $totalCashReceiptCredit = 0;

        $subDisbursement = "SELECT SUM(debitamt) as gtotaldebit, SUM(creditamt) as gtotalcredit FROM tblfindisbursement WHERE projcode = '".$projcode."'";
        $subDisbursementResult = $dbh2->query($subDisbursement);
        while($rowDisbursement = $subDisbursementResult->fetch_assoc()) 
        {
          $totalDisbursmentDebit = $rowDisbursement['gtotaldebit'];
          $totalDisbursmentCredit = $rowDisbursement['gtotalcredit'];
        }

        $subJournal = "SELECT SUM(debitamt) as gtotaldebit, SUM(creditamt) as gtotalcredit FROM tblfinjournal WHERE projcode = '".$projcode."'";
        $subJournalResult = $dbh2->query($subJournal);
        while($rowJournal = $subJournalResult->fetch_assoc()) 
        {
          $totalJournalDebit = $rowJournal['gtotaldebit'];
          $totalJournalCredit = $rowJournal['gtotalcredit'];
        }

         $subCashReceipt = "SELECT SUM(debitamt) as gtotaldebit, SUM(creditamt) as gtotalcredit FROM tblfincashreceipt WHERE projcode = '".$projcode."'";
        $subCashReceiptResult = $dbh2->query($subCashReceipt);
        while($rowCashReceipt = $subCashReceiptResult->fetch_assoc()) 
        {
          $totalCashReceiptDebit = $rowCashReceipt['gtotaldebit'];
          $totalCashReceiptCredit = $rowCashReceipt['gtotalcredit'];
        }


    echo "<div id='leftPayment' class='col-md-6 borderGray'><h4>Debit";
    // echo "<form action=\"projectManagement.php?pid=$projectId&loginid=$loginid\" method=\"POST\" name=\"projectManagement\"><div class='form-group'>";
    // echo "<select class='form-control' name=\"yyyymonthCV\">";
    // echo "<option value=\"total\">Total</option>";
    /* $res11query=""; $result11=""; $found11=0; $ctr11=0;
    $res11query="SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfindisbursement WHERE disbursementid<>'' AND  `projcode`='$projcode' ORDER BY date DESC;";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11=1;
        $ctr11++;
        $yyyymonth11=$myrow11['yyyymonth'];
        if($yyyymonthCV==$yyyymonth11) { 
            $yyyymonthsel="selected";
        } else { 
            $yyyymonthsel=""; 
        } //if-else
        echo "<option value=\"$yyyymonth11\" $yyyymonthsel>".date("Y M", strtotime($yyyymonth11))."</option>";
        } //while
    } //if */
    // echo "</select>";
    // echo "<button type=\"submit\" class=\"btn btn-primary btn-sm\" name=\"invselyyyymo\" value=\"1\">Select</button>";
    // echo "</div></form>";
    echo "</h4>";
    echo "</div>";

    echo "<div id='rightPayment' class='col-md-6 borderGray'>";
/*
    // set fixed var
    $yyyymonthCV="total";
    if($yyyymonthCV!="") {
        if($yyyymonthCV!="total") {
        // set dates 1st and last day of month
        $yyyymmday1 = date("Y-m-01", strtotime($yyyymonthCV));
        $yyyymmdaylast = date("Y-m-t", strtotime($yyyymonthCV));
        // query tblfincashreceipt for the month
        $res12bquery=""; $result12b=""; $found12b=0; $ctr12b=0; $debittotCV=0; $credittotCV=0;
        $res12bquery="SELECT `disbursementid`, `debitamt`, `creditamt` FROM `tblfindisbursement` WHERE `projcode`=\"$projcode\" AND (`date` BETWEEN \"$yyyymmday1\" AND \"$yyyymmdaylast\") ORDER BY `date` ASC";

        } else {
        // query tblfincashreceipt for the month
        $res12bquery=""; $result12b=""; $found12b=0; $ctr12b=0; $debittotCV=0; $credittotCV=0;
        $res12bquery="SELECT `disbursementid`, `debitamt`, `creditamt` FROM `tblfindisbursement` WHERE `projcode`=\"$projcode\" ORDER BY `date` ASC";

        } //if-else
        // echo "<h5>$yyyymonth|".date("Y-m", strtotime($yyyymonth))."|$yyyymmday1|$yyyymmdaylast</h5>";
        $result12b=$dbh2->query($res12bquery);
        if($result12b->num_rows>0) {
            while($myrow12b=$result12b->fetch_assoc()) {
            $found12b=1; $ctr12b++;

            $disbursementid12b = $myrow12b['disbursementid'];
            $debitamt12b = $myrow12b['debitamt'];
            $creditamt12b = $myrow12b['creditamt'];
            $debittotCV = $debittotCV + $debitamt12b;
            $credittotCV = $credittotCV + $creditamt12b;
            } //while
        } //if
        if($credittotCV!=0) { echo "<h5>PHP&nbsp;".number_format($credittotCV)."</h5>"; } else {
            if($debittotCV!=0) { echo "<h5>PHP&nbsp;".number_format($debittotCV)."</h5>"; }
        } //if-else
    } else {
        echo "<h5>PHP 0.00</h5>";
    } //if-else
*/
    echo "<h5>PHP&nbsp;".number_format($totalDisbursmentDebit+ $totalCashReceiptDebit+ $totalJournalDebit)."</h5>";
    echo "</div>";

?>
					</div>
				</div>

				<div class="secondRowColumn">
					<div class="col-md-6 no-padding-right">
						<!-- <h3>Invoices</h3> -->
                                                <!-- <h3>Payments Received</h3> -->
<h3>&nbsp;</h3>
						<!-- <div id="leftInvoice" class="col-md-6 borderGray">
							<h4>Due</h4>
							<h5>PHP 29,350.00</h5>
						</div>
						<div id="rightInvoice" class="col-md-6 borderGray">
							<h4>Overdue</h4>
							<h5>PHP 12,500.00</h5>
						</div> -->
<?php
    echo "<div id='leftPayment' class='col-md-6 borderGray'><h4>Credit";
/*
    echo "<form action=\"projectManagement.php?pid=$projectId&loginid=$loginid\" method=\"POST\" name=\"projectManagement\"><div class='form-group'>";
    echo "<select class='form-control' name=\"yyyymonthCR\">";
    echo "<option value=\"total\">Total</option>";
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
    $res11query="SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfincashreceipt WHERE cashreceiptid<>'' AND  `projcode`='$projcode' ORDER BY date DESC;";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11=1;
        $ctr11++;
        $yyyymonth11=$myrow11['yyyymonth'];
        if($yyyymonthCR==$yyyymonth11) { 
            $yyyymonthsel="selected";
        } else { 
            $yyyymonthsel=""; 
        } //if-else
        echo "<option value=\"$yyyymonth11\" $yyyymonthsel>".date("Y M", strtotime($yyyymonth11))."</option>";
        } //while
    } //if
    // echo "</select>";
    // echo "<button type=\"submit\" class=\"btn btn-primary btn-sm\" name=\"selectyyyymo\" value=\"1\">Select</button>";
    echo "</div></form>";
*/
    echo "</h4>";
    echo "</div>";

    echo "<div id='rightPayment' class='col-md-6 borderGray'>";
/*
    if($yyyymonthCR!="") {
        if($yyyymonthCR!="total") {
        // set dates 1st and last day of month
        $yyyymmday1 = date("Y-m-01", strtotime($yyyymonthCR));
        $yyyymmdaylast = date("Y-m-t", strtotime($yyyymonthCR));
        // query tblfincashreceipt for the month
        $res12query=""; $result12=""; $found12=0; $ctr12=0; $debittotCR=0; $credittotCR=0;
        $res12query="SELECT `cashreceiptid`, `debitamt`, `creditamt` FROM `tblfincashreceipt` WHERE `projcode`=\"$projcode\" AND `glcode` LIKE \"10.10.3%\" AND (`date` BETWEEN \"$yyyymmday1\" AND \"$yyyymmdaylast\") ORDER BY `date` ASC";

        } else {
        // query tblfincashreceipt for the month
        $res12query=""; $result12=""; $found12=0; $ctr12=0; $debittotCR=0; $credittotCR=0;
        $res12query="SELECT `cashreceiptid`, `debitamt`, `creditamt` FROM `tblfincashreceipt` WHERE `projcode`=\"$projcode\" AND `glcode` LIKE \"10.10.3%\" ORDER BY `date` ASC";

        } //if-else
        // echo "<h5>$yyyymonth|".date("Y-m", strtotime($yyyymonth))."|$yyyymmday1|$yyyymmdaylast</h5>";
        $result12=$dbh2->query($res12query);
        if($result12->num_rows>0) {
            while($myrow12=$result12->fetch_assoc()) {
            $found12=1; $ctr12++;
            $cashreceiptid12 = $myrow12['cashreceiptid'];
            $debitamt12 = $myrow12['debitamt'];
            $creditamt12 = $myrow12['creditamt'];
            $debittotCR = $debittotCR + $debitamt12;
            $credittotCR = $credittotCR + $creditamt12;
            } //while
        } //if
        if($credittotCR!=0) { echo "<h5>PHP&nbsp;".number_format($credittotCR)."</h5>"; } else {
            if($debittotCR!=0) { echo "<h5>PHP&nbsp;".number_format($debittotCR)."</h5>"; }
        } //if-else
    } else {
        echo "<h5>PHP 0.00</h5>";
    } //if-else
*/
    echo "<h5>PHP&nbsp;".number_format($totalDisbursmentCredit+ $totalCashReceiptCredit+ $totalJournalCredit)."</h5>";
    echo "</div>";

?>
					</div>
				</div>

			</div>
<?php // echo "<p>$yyyymonthCR|$yyyymonthCV|$res12bquery</p>"; ?>
			<div class="col-md-5">
				<div id='commentSection'>
					<h4>Comments</h4>
					<div id="line"></div>
					<div id="messagecontainer">
						<div id="messageDiv" class="messageDiv">
							
						</div>
					</div>
					<div id="messagesubmit">
						<div class="col-md-9">
							<textarea placeholder="Comment Here...." id="commentTextArea" class="form-control"></textarea>
						</div>
						<div class="col-md-3">
							<button type="button" id="btnSubmit" class="btn btn-success">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div style="clear: both;"></div>
		<div class="secondRow">
			<div id="graphContainer">
			</div>
<center><i><h5>Note: Graph simulation only, still under construction</h5><i></center>
	</div>
		<div class="thirdRow">
			<?php 
			echo '<a class="btn btn-info" >View All Invoices</a>';
			echo '<a href="projectreports.php?pid='.$projectId.'&loginid='.$_GET['loginid'].'" class="btn btn-info" target="_blank">View All Reports</a>';
			echo "<form action='projbilldtls.php?loginid=".$_GET['loginid']."' method='POST' id='contractForm' name='projbilldtls'>";
			echo "<input type='hidden' name='contractid' value='$contractid'>";
			echo "<input type='hidden' name='projcode' value='$projcode'>";
			echo "<button type='submit' class='btn btn-info'>View Contract</button>";
			echo "</form>";
			?>
		</div>
	</div>	
</div>

<link rel="stylesheet" type="text/css" href="tjaddons/projectmanagement.css">
<script src="tjaddons/charts.js"></script>
<script src="tjaddons/projectmanagement.js"></script>

<?php

echo "<p><a href='./projbilling.php?loginid=$loginid' class='btn btn-default' role='button'>back</a></p>";

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
