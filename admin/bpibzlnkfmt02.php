<?php
require_once("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$cutstart = (isset($_POST['cutstart'])) ? $_POST['cutstart'] :'';
$cutend = (isset($_POST['cutend'])) ? $_POST['cutend'] :'';

// $employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeeid'] :'';
$year = (isset($_POST['year'])) ? $_POST['year'] :'';
$month = (isset($_POST['month'])) ? $_POST['month'] :'';
$day = (isset($_POST['day'])) ? $_POST['day'] :'';
$payrolldate = "$year-$month-$day";

$headerrecid = (isset($_POST['headerrecid'])) ? $_POST['headerrecid'] :'';
$batchnumber = (isset($_POST['batchnumber'])) ? $_POST['batchnumber'] :'';
$companycode = (isset($_POST['companycode'])) ? $_POST['companycode'] :'';
$headerrectype = (isset($_POST['headerrectype'])) ? $_POST['headerrectype'] :'';
$compacctnumber = (isset($_POST['compacctnumber'])) ? $_POST['compacctnumber'] :'';
$ceilingamt = (isset($_POST['ceilingamt'])) ? $_POST['ceilingamt'] :'';
$presofficecode = (isset($_POST['presofficecode'])) ? $_POST['presofficecode'] :'';
$payrollidentifier = (isset($_POST['payrollidentifier'])) ? $_POST['payrollidentifier'] :'';
$detailrecid = (isset($_POST['detailrecid'])) ? $_POST['detailrecid'] :'';
$detailrectype = (isset($_POST['detailrectype'])) ? $_POST['detailrectype'] :'';
$trailerrecid = (isset($_POST['trailerrecid'])) ? $_POST['trailerrecid'] :'';
$trailerrectype = (isset($_POST['trailerrectype'])) ? $_POST['trailerrectype'] :'';
$preparedname = (isset($_POST['preparedname'])) ? $_POST['preparedname'] :'';
$preparedpos = (isset($_POST['preparedpos'])) ? $_POST['preparedpos'] :'';
$checkedname = (isset($_POST['checkedname'])) ? $_POST['checkedname'] :'';
$checkedpos = (isset($_POST['checkedpos'])) ? $_POST['checkedpos'] :'';
$notedname = (isset($_POST['notedname'])) ? $_POST['notedname'] :'';
$notedpos = (isset($_POST['notedpos'])) ? $_POST['notedpos'] :'';
$approvedname = (isset($_POST['approvedname'])) ? $_POST['approvedname'] :'';
$approvedpos = (isset($_POST['approvedpos'])) ? $_POST['approvedpos'] :'';

// 20190413
$paytimehh = $_POST['paytimehh'];
$paytimemm = $_POST['paytimemm'];
$paytimeampm = $_POST['paytimeampm'];
$payrolltime = "$paytimehh".":"."$paytimemm"."$paytimeampm";

// prep variables
$totalnetpay=0; $totnetpay2=0;

$found = 0;

if($loginid != "") {
	include("logincheck.php");
}

if($found == 1) {
    include ("header.php");
    include ("sidebar.php");
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
    echo "<p><font size=1>Modules >> Employees' payslip email notifier >> BPI BizLink File</font></p>";

    echo "<h2>BPI Payroll File Process</h2>";
    echo "<p>For payroll group and cutoff period:<br>";
    echo "<b>$cutstart to $cutend</b></p>";
	
	// query and compute for totalnetpay
	$res11query="SELECT emppayrollid, employeeid, net_pay FROM tblemppayroll WHERE cut_start=\"$cutstart\" AND cut_end=\"$cutend\"";
	$result11=""; $found11=0; $ctr11=0; $tot_net_pay=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11=$ctr11+1;
			$emppayrollid11 = $myrow11['emppayrollid'];
			$employeeid11 = $myrow11['employeeid'];
			$net_pay11 = $myrow11['net_pay'];
			$totalnetpay = $totalnetpay + $net_pay11;
		} // while
	} // if

	// query and count total empid
	$res12query="SELECT count(emppayrollid) AS empidcount FROM tblemppayroll WHERE cut_start=\"$cutstart\" AND cut_end=\"$cutend\"";
	$result12=""; $found12=0; $ctr12=0;
	$result12=$dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
			$found12=1;
			$empidcount12=$myrow12['empidcount'];
		}
	}
	
	echo "<table id=\"ReportTable\" border=\"1\" spacing=\"1\">";
	 
	// display header
	echo "<tr><td><a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a>$headerrecid</td>";
	echo "<td>Payroll Date</td><td>".date('F j, Y', mktime(0, 0, 0, $month, $day, $year))."</td>";
	echo "<td>Payroll Time</td><td>$payrolltime</td>";
	echo "<td>Total Amount</td><td>$totalnetpay</td>";
	echo "<td>Total Count</td><td>$empidcount12</td>";
	echo "<td>Funding Account</td><td>$compacctnumber</td></tr>";

	// display looped detail records
	$res14query="SELECT emppayrollid, employeeid, net_pay FROM tblemppayroll WHERE cut_start=\"$cutstart\" AND cut_end=\"$cutend\"";
	$result14=""; $found14=0; $ctr14=0;
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
			$found14=1;
			$ctr14=$ctr14+1;
			$emppayrollid14 = $myrow14['emppayrollid'];
			$employeeid14 = $myrow14['employeeid'];
			$net_pay14 = $myrow14['net_pay'];
			// query full name of emplooyee
		$res3query = "SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$employeeid14\"";
		$result3 = $dbh2->query($res3query);
		if($result3->num_rows>0) {
			while ($myrow3 = $result3->fetch_assoc()) {
			$found3 = 1;
			$name_first = $myrow3['name_first'];
			$name_middle = $myrow3['name_middle'];
			$name_last = $myrow3['name_last'];
			} // while
		} // if($result3)
			// query bank account
		$res141query="SELECT acct_num, acct_type FROM tblbankacct WHERE employeeid=\"$employeeid14\" AND payrolldflt=1";
		$result141=$dbh2->query($res141query);
		if($result141->num_rows>0) {
			while($myrow141=$result141->fetch_assoc()) {
		$acct_num = str_replace("-", "", $myrow141['acct_num']);
		$acct_num = str_replace(" ", "", $acct_num);
		$acct_type = $myrow141['acct_type'];			
			} // while
		} // if

			include("bpihashfnc.php");

			echo "<tr><td>$detailrecid</td>";
			echo "<td>$name_first $name_last</td>";
			// echo "<td>$acct_num</td>";
			echo "<td>$acctnumfin</td>";
			echo "<td align=\"right\">".number_format($net_pay14, 2)."</td>";
			echo "<td></td><td></td><td></td><td></td><td></td><td></td><td></td>";
			echo "</tr>";
      // compute again for total net pay
      $totnetpay2 = $totnetpay2 + $net_pay14;
      // reset variables
      $acctnumfin=''; $net_pay14=0;
			} // while
	} // if($result14)

  echo "<tr><td colspan=\"3\" align=\"right\">Total</td><td align=\"right\">".number_format($totnetpay2, 2)."</td><td colspan=\"7\"></td></tr>";
  if($totalnetpay!=$totnetpay2) {
  echo "<tr><th colspan=\"11\"><font color=\"red\">Warning: Total net pay does not equal to generated individual net pays. Please check first before exporting to BPI file format.</font></th></tr>";
  } // if
	echo "</table>";

	 include ("footer.php");
} else {
    include ("logindeny.php");
}

$dbh2->close();
?>
