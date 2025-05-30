<?php 

require("db1.php");
include("clsmcrypt.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$groupname = (isset($_POST['groupname'])) ? $_POST['groupname'] :'';
$cutstart = (isset($_POST['cutstart'])) ? $_POST['cutstart'] :'';
$cutend = (isset($_POST['cutend'])) ? $_POST['cutend'] :'';

$cutoffstring = date("Y-M-d", strtotime($cutstart))."&nbsp;-to-&nbsp;".date("Y-M-d", strtotime($cutend));

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header2.php");
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
		// check groupname's accesslevel
		$result19=""; $found19=0; $ctr19=0;
		$res19query="SELECT accesslevel FROM tblconfipaygrp WHERE groupname=\"$groupname\" LIMIT 1";
		$result19 = $dbh2->query($res19query);
		if($result19->num_rows>0) {
			while($myrow19 = $result19->fetch_assoc()) {
			$found19 = 1;
			$confiaccesslevel = $myrow19['accesslevel'];
			}
		}

		if($confiaccesslevel==5 && $accesslevel==5) {
		include("mcryptdec.php");
		$grpnm1 = $groupname;
		include("mcryptenc.php");
		} else if($confiaccesslevel<=4) {
		$grpnm1 = $groupname;
		}

	//
	// main table for export
	//
	echo "<table id=\"ReportTable\" class=\"fin\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	echo "<tr><td colspan=\"2\">";
	echo "<a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a>";
	echo "</td></tr><tr><td colspan=\"2\">";

     echo "<table class=\"fin\" border=1 spacing=1>";
		echo "<tr><td colspan=\"19\">";
		echo "<b>PHILKOEI INTERNATIONAL, INC.</b>";
		echo "</td></tr>";
		echo "<tr><td colspan=\"19\">";
     echo "<b>Payroll Summary - $grpnm1</b>";
		echo "</td></tr>";
     // echo "<b>$cutstart -to- $cutend</b><br>";
		echo "<tr><td colspan=\"19\">";
		echo "<b>$cutoffstring</b>";
		echo "</td></tr>";

     echo "<tr><th>EmpID</th><th>Alias</th><th>Name</th><th>AcctNo.</th><th>NetPay</th><th>Prof.Fee</th><th>Absent</th><th>NetBasicPay</th><th>VATrate</th><th>NetofVAT</th><th>OtherIncome</th><th>OtherIncome VATrate</th><th>OtherIncome NetofVAT</th><th>NonTaxableIncome</th><th>GrossPay</th><th>WithholdingTax</th><th>SSS</th><th>Philhealth</th><th>PagIBIG</th><th>OtherDeductions</th><th>TotalDeductions</th></tr>";

     $resquery = "SELECT tblconfipayroll.confipayrollid, tblconfipayroll.employeeid, tblconfipayroll.groupname, tblconfipayroll.accesslevel, tblconfipayroll.cutstart, tblconfipayroll.cutend, tblconfipayroll.netbasicpay, tblconfipayroll.daysabsent, tblconfipayroll.daysabsentamt, tblconfipayroll.netbasicpay2, tblconfipayroll.vatrate, tblconfipayroll.netofvat, tblconfipayroll.otherincome, tblconfipayroll.otherincvatrate, tblconfipayroll.otherincnetofvat, tblconfipayroll.otherincomenontaxable, tblconfipayroll.grosspay, tblconfipayroll.withholdingtax, tblconfipayroll.sssee,  tblconfipayroll.ssser, tblconfipayroll.philhealthee, tblconfipayroll.philhealther, tblconfipayroll.pagibiger, tblconfipayroll.pagibigee, tblconfipayroll.otherdeductions, tblconfipayroll.totaldeductions, tblconfipayroll.netpay FROM tblconfipayroll WHERE tblconfipayroll.groupname=\"$groupname\" AND tblconfipayroll.cutstart=\"$cutstart\" AND tblconfipayroll.cutend=\"$cutend\"";
    $result=$dbh2->query($resquery);
    if($result->num_rows>0) {
        while($myrow=$result->fetch_assoc()) {

	$found = 1;
	$confipayrollid = $myrow['confipayrollid'];
	$employeeid = $myrow['employeeid'];
	$groupname= $myrow['groupname'];
	$confiaccesslevel = $myrow['accesslevel'];
	$cutstart = $myrow['cutstart'];
	$cutend = $myrow['cutend'];
	$netbasicpay = $myrow['netbasicpay'];
	$daysabsent = $myrow['daysabsent'];
	$daysabsentamt = $myrow['daysabsentamt'];
	$netbasicpay2 = $myrow['netbasicpay2'];
	$vatrate = $myrow['vatrate'];
	$netofvat = $myrow['netofvat'];
	$otherincome = $myrow['otherincome'];
	$otherincvatrate = $myrow['otherincvatrate'];
	$otherincnetofvat = $myrow['otherincnetofvat'];
	$otherincomenontaxable = $myrow['otherincomenontaxable'];
	$grosspay = $myrow['grosspay'];
	$withholdingtax = $myrow['withholdingtax'];
	$sssee = $myrow['sssee'];
	$ssser = $myrow['ssser'];
	$philhealthee = $myrow['philhealthee'];
	$philhealther = $myrow['philhealther'];
	$pagibiger = $myrow['pagibiger'];
	$pagibigee = $myrow['pagibigee'];
	$otherdeductions = $myrow['otherdeductions'];
	$totaldeductions = $myrow['totaldeductions'];
	$netpay = $myrow['netpay'];

	// 20180515
	// check if empalias exists, else disp full name
	$res11query="SELECT empalias FROM tblconfipaymeminfo WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\" LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$empalias = $myrow11['empalias'];
		} // while
	} // if

	if($confiaccesslevel==5 && $accesslevel==5) {
	include("mcryptdec.php");
	$empid1=$employeeid;
	$empaliasfin=$empalias;
	include("mcryptenc.php");
	} else if($confiaccesslevel<=4) {
	$empid1=$employeeid;
	}

	$result12=""; $found12=0; $ctr12=0;
	$res12query="SELECT name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$empid1\" AND contact_type=\"personnel\" LIMIT 1";
	$result12 = $dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12 = $result12->fetch_assoc()) {
		$found12 = 1;
		$name_first12 = $myrow12['name_first'];
		$name_middle12 = $myrow12['name_middle'];
		$name_last12 = $myrow12['name_last'];
		}
	}

			$res3query="SELECT employeeid, bank_name, acct_num, acct_type FROM tblbankacct WHERE employeeid=\"$empid1\" AND payrolldflt=1 AND bank_name LIKE \"%BPI%\" LIMIT 1";
		$result3=$dbh2->query($res3query);
			if($result3->num_rows>0) {
			while($myrow3 = $result3->fetch_assoc()) {
				$found3 = 1;
				$bank_name = $myrow3['bank_name'];
				$acct_num = str_replace("-", "", $myrow3['acct_num']);
				$acct_num = str_replace(" ", "", $acct_num);
			} // while($myrow3 = $result3->fetch_assoc())
			} // if($result3->num_rows>0)

	echo "<tr><td>$empid1</td>";
	if($empalias!='') {
	echo "<td>$empaliasfin</td>";
	} else {
	echo "<td>$name_last12, $name_first12 $name_middle12[0]</td>";
	} // if

	echo "<td>$name_last12, $name_first12 $name_middle12[0]</td><td>$acct_num</td><th align=right>".number_format($netpay, 2)."</th><td align=right>".number_format($netbasicpay, 2)."</td><td align=right>".number_format($daysabsentamt, 2)."</td><td align=right>".number_format($netbasicpay2, 2)."</td><td align=right>".number_format($vatrate, 2)."</td><td align=right>".number_format($netofvat, 2)."</td><td align=right>".number_format($otherincome, 2)."</td><td align=\"right\">".number_format($otherincvatrate, 2)."</td><td align=\"right\">".number_format($otherincnetofvat, 2)."</td><td align=\"right\">".number_format($otherincomenontaxable, 2)."</td><td align=right>".number_format($grosspay, 2)."</td><td align=right>".number_format($withholdingtax, 2)."</td><td align=right>".number_format($sssee, 2)."</td><td align=right>".number_format($philhealthee, 2)."</td><td align=right>".number_format($pagibigee, 2)."</td><td align=right>".number_format($otherdeductions, 2)."</td><td align=right>".number_format($totaldeductions, 2)."</tr>";

        } //while
    } //if

     $res11query = "SELECT confipaycutoffid, datecreated, confipaygrpid, groupname, cutstart, cutend, totalnetbasic, totaldaysabsentamt, totalnetbasicpay2, totalnetofvat, totalincome, totalincnetofvat, totalincomenontax, totalgross, totalwtax, totalsssee, totalssser, totalsssecer, totalsssec, totalsss, totalphilhealthee, totalphilhealther, totalphilhealth, totalpagibigee, totalpagibiger, totalpagibig, totalotherdeductions, totaldeductions, totalnetpay FROM tblconfipayrolltotal WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\" LIMIT 1";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {

	$found11 = 1;
	$totalnetbasic = $myrow11['totalnetbasic'];
	$totaldaysabsentamt = $myrow11['totaldaysabsentamt'];
	$totalnetbasicpay2 = $myrow11['totalnetbasicpay2'];
	$totalnetofvat = $myrow11['totalnetofvat'];
	$totalincome = $myrow11['totalincome'];
	$totalincnetofvat = $myrow11['totalincnetofvat'];
	$totalincomenontax = $myrow11['totalincomenontax'];
	$totalgross = $myrow11['totalgross'];
	$totalwtax = $myrow11['totalwtax'];
	$totalsssee = $myrow11['totalsssee'];
	$totalssser = $myrow11['totalssser'];
	$totalsssecer = $myrow11['totalsssecer'];
	$totalsssec = $myrow11['totalsssec'];
	$totalsss = $myrow11['totalsss'];
	$totalphilhealthee = $myrow11['totalphilhealthee'];
	$totalphilhealther = $myrow11['totalphilhealther'];
	$totalphilhealth = $myrow11['totalphilhealth'];
	$totalpagibigee = $myrow11['totalpagibigee'];
	$totalpagibiger = $myrow11['totalpagibiger'];
	$totalpagibig = $myrow11['totalpagibig'];
	$totalotherdeductions = $myrow11['totalotherdeductions'];
	$totaldeductions2 = $myrow11['totaldeductions2'];
	$totalnetpay = $myrow11['totalnetpay'];

        } //while
    } //if

     echo "<tr><td>&nbsp;</td><th align=right>Total</th><th align=right>".number_format($totalnetbasic, 2)."</th><td align=right></td><th align=right>".number_format($totalnetpay, 2)."</th><th align=right>".number_format($totalnetbasicpay2, 2)."</th><td>".number_format($totaldaysabsentamt, 2)."</td><th align=right>".number_format($totalnetofvat, 2)."</th><td align=right>".number_format($totalincome, 2)."</td><td>&nbsp;</td><td align=right>".number_format($totalincnetofvat, 2)."</td><td align=right>".number_format($totalincomenontax, 2)."</td><th align=right>".number_format($totalgross, 2)."</th><td align=right>".number_format($totalwtax, 2)."</td><td align=right>".number_format($totalsssee, 2)."</td><td align=right>".number_format($totalphilhealthee, 2)."</td><td align=right>".number_format($totalpagibigee, 2)."</td><td align=right>".number_format($totalotherdeductions, 2)."</td><td align=right>".number_format($totaldeductions2, 2)."</td></tr>";

     echo "</table>";

     echo "<p><p><br>";


// start additional income summary here taxable


     echo "<table class=\"fin\" border=1 spacing=1>";
		echo "<tr><td colspan=\"4\">";
     echo "<b>PHILKOEI INTERNATIONAL INC.</b>";
		echo "</td></tr>";
		echo "<tr><td colspan=\"4\">";
     echo "<b>Other Income - $grpnm1</b>";
		echo "</td></tr>";
     // echo "<b>$cutstart -to- $cutend</b><br>";
		echo "<tr><td colspan=\"4\">";
		echo "<b>$cutoffstring</b>";
		echo "</td></tr>";
     echo "<tr><th>EmpID</th><th>Name</th><th>OtherIncomeType</th><th>Amount</th>";

     $res4query = "SELECT tblconfipayrolladd.confipayrolladdid, tblconfipayrolladd.employeeid, tblconfipayrolladd.groupname, tblconfipayrolladd.cutstart, tblconfipayrolladd.cutend, tblconfipayrolladd.nameadd, tblconfipayrolladd.addamount, tblconfipayrolladd.nontaxable, tblconfipayrolladd.confipaygrpid, tblconfipaygrp.accesslevel FROM tblconfipayrolladd LEFT JOIN tblconfipaygrp ON tblconfipayrolladd.confipaygrpid=tblconfipaygrp.confipaygrpid WHERE tblconfipayrolladd.groupname=\"$groupname\" AND tblconfipayrolladd.cutstart=\"$cutstart\" AND tblconfipayrolladd.cutend=\"$cutend\" AND tblconfipayrolladd.nontaxable!=\"yes\"";
    $result4=$dbh2->query($res4query);
    if($result4->num_rows>0) {
        while($myrow4=$result4->fetch_assoc()) {

	$found4 = 1;
	$confipayrolladdid = $myrow4['confipayrolladdid'];
	$employeeid = $myrow4['employeeid'];
	$groupname = $myrow4['groupname'];
	$cutstart = $myrow4['cutstart'];
	$cutend = $myrow4['cutend'];
	$nameadd = $myrow4['nameadd'];
	$addamount = $myrow4['addamount'];
	$nontaxable = $myrow4['nontaxable'];
	$confipaygrpid = $myrow4['confipaygrpid'];
	$confiaccesslevel = $myrow4['accesslevel'];

	// 20180515
	// check if empalias exists, else disp full name
	$result11=""; $found11=0; $ctr11=0;
	$res11query="SELECT empalias FROM tblconfipaymeminfo WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\" LIMIT 1";
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$empalias = $myrow11['empalias'];
		} // while
	} // if

	if($confiaccesslevel==5 && $accesslevel==5) {
	include("mcryptdec.php");
	$empid1 = $employeeid;
	$empaliasfin = $empalias;
	include("mcryptenc.php");
	} else if($confiaccesslevel<=4) {
	$empid1 = $employeeid;
	}

	$res41query = "SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$empid1\"";
    $result41=$dbh2->query($res41query);
    if($result41->num_rows>0) {
        while($myrow41=$result41->fetch_assoc()) {

		$found41 = 1;
		$employeeid2 = $myrow41['employeeid'];
		$name_first = $myrow41['name_first'];
		$name_middle = $myrow41['name_middle'];
		$name_last = $myrow41['name_last'];

		echo "<tr><td>$empid1</td>";
		if($empalias!='') {
		echo "<td>$empaliasfin</td>";
		} else {
		echo "<td>$name_last, $name_first $name_middle[0]</td>";
		} // if
		echo "<td>$nameadd</td><th align=right>".number_format($addamount, 2)."</th></tr>";

        } //while
    } //if

        } //while
    } //if

	$res42query = "SELECT totalincome FROM tblconfipayrolltotal WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\" LIMIT 1";
    $result42=$dbh2->query($res42query);
    if($result42->num_rows>0) {
        while($myrow42=$result42->fetch_assoc()) {
		$found42 = 1;
		$totalincome = $myrow42['totalincome'];

		echo "<tr><td align=right colspan=2>&nbsp;</td><th align=right>Total</th><th align=right>".number_format($totalincome, 2)."</th></tr>";
        } //while
    } //if

     echo "</table>";

     echo "<p><p><br>";

// start additional income summary here nontaxable

     echo "<table class=\"fin\" border=1 spacing=1>";
		echo "<tr><td colspan=\"5\">";
     echo "<b>PHILKOEI INTERNATIONAL INC.</b>";
		echo "</td></tr>";
		echo "<tr><td colspan=\"5\">";
     echo "<b>Non-Taxable Income - $grpnm1</b>";
		echo "</td></tr>";
     // echo "<b>$cutstart -to- $cutend</b><br>";
		echo "<tr><td colspan=\"5\">";
		echo "<b>$cutoffstring</b>";
		echo "</td></tr>";
     echo "<tr><th>EmpID</th><th>Name</th><th>OtherIncomeType</th><th>Amount</th><th>NonTaxable</th></tr>";

     $res5query = "SELECT confipayrolladdid, employeeid, nameadd, addamount, nontaxable FROM tblconfipayrolladd WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\" AND  nontaxable=\"yes\"";
    $result5=$dbh2->query($res5query);
    if($result5->num_rows>0) {
        while($myrow5=$result5->fetch_assoc()) {

	$found5 = 1;
	$confipayrolladdid = $myrow5['configpayrolladdid'];
	$employeeid = $myrow5['employeeid'];
	$nameadd = $myrow5['nameadd'];
	$addamount = $myrow5['addamount'];
	$nontaxable = $myrow5['nontaxable'];

	// 20180515
	// check if empalias exists, else disp full name
	$result11=""; $found11=0; $ctr11=0;
	$res11query="SELECT empalias FROM tblconfipaymeminfo WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\" LIMIT 1";
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$empalias = $myrow11['empalias'];
		} // while
	} // if

	if($confiaccesslevel==5 && $accesslevel==5) {
	include("mcryptdec.php");
	$empid1 = $employeeid;
	$empaliasfin = $empalias;
	include("mcryptenc.php");
	} else if($confiaccesslevel<=4) {
	$empid1 = $employeeid;
	}

	$res51query = "SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$empid1\"";
    $result51=$dbh2->query($res51query);
    if($result51->num_rows>0) {
        while($myrow51=$result51->fetch_assoc()) {

		$found51 = 1;
		$employeeid2 = $myrow51['employeeid'];
		$name_first = $myrow51['name_first'];
		$name_middle = $myrow51['name_middle'];
		$name_last = $myrow51['name_last'];

		echo "<tr><td>$empid1</td>";
		if($empalias!='') {
		echo "<td>$empaliasfin</td>";
		} else {
		echo "<td>$name_last, $name_first $name_middle[0]</td>";
		} // if
		echo "<td>$nameadd</td><th align=right>".number_format($addamount, 2)."</th><td>$nontaxable</td></tr>";

        } //while
    } //if

        } //while
    } //if

	$res52query = "SELECT totalincomenontax FROM tblconfipayrolltotal WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\" LIMIT 1";
    $result52=$dbh2->query($res52query);
    if($result52->num_rows>0) {
        while($myrow52=$result52->fetch_assoc()) {

		$found52 = 1;
		$totalincomenontax = $myrow52['totalincomenontax'];

		echo "<tr><td align=right colspan=2>&nbsp;</td><th align=right>Total</th><th align=right>".number_format($totalincomenontax, 2)."</th></tr>";
        } //while
    } //if

	echo "</table>";

     // echo "</table>";

     echo "<p><p><br>";

// start withholding tax summary here

     echo "<table class=\"fin\" border=1 spacing=1>";
		echo "<tr><td colspan=\"4\">";
     echo "<b>PHILKOEI INTERNATIONAL, INC.</b>";
		echo "</td></tr>";
		echo "<tr><td colspan=\"4\">";
     echo "<b>Withholding Tax - $grpnm1</b>";
		echo "</td></tr>";
     // echo "<b>$cutstart -to- $cutend</b><br>";
		echo "<tr><td colspan=\"4\">";
		echo "<b>$cutoffstring</b>";
		echo "</td></tr>";
     echo "<tr><th>EmpID</th><th>Name</th><th>GrossPay</th><th>WithholdingTax</th></tr>";

     $res6query = "SELECT tblconfipayroll.employeeid, tblconfipayroll.grosspay, tblconfipayroll.withholdingtax, tblconfipayroll.accesslevel FROM tblconfipayroll WHERE tblconfipayroll.groupname=\"$groupname\" AND tblconfipayroll.cutstart=\"$cutstart\" AND tblconfipayroll.cutend=\"$cutend\"";
    $result6=$dbh2->query($res6query);
    if($result6->num_rows>0) {
        while($myrow6=$result6->fetch_assoc()) {

	$found6 = 1;
	$employeeid = $myrow6['employeeid'];
	$grosspay = $myrow6['grosspay'];
	$withholdingtax = $myrow6['withholdingtax'];
	$confiaccesslevel = $myrow6['accesslevel'];

	// 20180515
	// check if empalias exists, else disp full name
	$res11query="SELECT empalias FROM tblconfipaymeminfo WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\" LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$empalias = $myrow11['empalias'];
		} // while
	} // if

	if($confiaccesslevel==5 && $accesslevel==5) {
	include("mcryptdec.php");
	$empid1 = $employeeid;
	$empaliasfin=$empalias;
	include("mcryptenc.php");
	} else if($confiaccesslevel<=4) {
	$empid1 = $employeeid;
	}

	$result14=""; $found14=0; $ctr14=0;
	$res14query="SELECT name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$empid1\" AND contact_type=\"personnel\" LIMIT 1";
	$result14 = $dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14 = $result14->fetch_assoc()) {
		$found14 = 1;
		$name_first14 = $myrow14['name_first'];
		$name_middle14 = $myrow14['name_middle'];
		$name_last14 = $myrow14['name_last'];
		} //while
	} //if

	echo "<tr><td>$empid1</td>";
	if($empalias!='') {
	echo "<td>$empaliasfin</td>";
	} else {
	echo "<td>$name_last14, $name_first14 $name_middle14[0]</td>";
	} // if
	echo "<td align=right>".number_format($grosspay, 2)."</td><th align=right>".number_format($withholdingtax, 2)."</th></tr>";

        } //while
    } //if

     $res61query = "SELECT totalgross, totalwtax FROM tblconfipayrolltotal WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\" LIMIT 1";
    $result61=$dbh2->query($res61query);
    if($result61->num_rows>0) {
        while($myrow61=$result61->fetch_assoc()) {

	$found61 = 1;
	$totalgross = $myrow61['totalgross'];
	$totalwtax = $myrow61['totalwtax'];

	echo "<tr><th align=right colspan=2>Total</th><th align=right>".number_format($totalgross, 2)."</th><th align=right>".number_format($totalwtax, 2)."</th></tr>";
        } //while
    } //if

     echo "</table>";

     echo "<p><p><br>";

// start sss summary here

     echo "<table class=\"fin\" border=1 spacing=1>";
		echo "<tr><td colspan=\"7\">";
     echo "<b>PHILKOEI INTERNATIONAL, INC.</b>";
		echo "</td></tr>";
		echo "<tr><td colspan=\"7\">";
     echo "<b>SSS Contribution - $grpnm1</b>";
		echo "</td></tr>";
     // echo "<b>$cutstart -to- $cutend</b><br>";
		echo "<tr><td colspan=\"7\">";
		echo "<b>$cutoffstring</b>";
		echo "</td></tr>";
     echo "<tr><th>EmpID</th><th>Name</th><th>EE</th><th>ER</th><th>EC-ER</th><th>Total+EC</th><th>TotalContribution</th></tr>";

     $res7query = "SELECT tblconfipayroll.employeeid, tblconfipayroll.sssee, tblconfipayroll.ssser, tblconfipayroll.sssec, tblconfipayroll.ssstotalec, tblconfipayroll.ssstotal, tblconfipayroll.accesslevel FROM tblconfipayroll WHERE tblconfipayroll.groupname=\"$groupname\" AND tblconfipayroll.cutstart=\"$cutstart\" AND tblconfipayroll.cutend=\"$cutend\"";
    $result7=$dbh2->query($res7query);
    if($result7->num_rows>0) {
        while($myrow7=$result7->fetch_assoc()) {

	$found7 = 1;
	$employeeid = $myrow7['employeeid'];
	$sssee = $myrow7['sssee'];
	$ssser = $myrow7['ssser'];
	$sssec = $myrow7['sssec'];
	$ssstotalec = $myrow7['ssstotalec'];
	$ssstotal = $myrow7['ssstotal'];
  $confiaccesslevel = $myrow7['accesslevel'];

	// 20180515
	// check if empalias exists, else disp full name
	$res11query="SELECT empalias FROM tblconfipaymeminfo WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\" LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$empalias = $myrow11['empalias'];
		} // while
	} // if

	if($confiaccesslevel==5 && $accesslevel==5) {
	include("mcryptdec.php");
	$empid1 = $employeeid;
	$empaliasfin=$empalias;
	include("mcryptenc.php");
	} else if($confiaccesslevel<=4) {
	$empid1 = $employeeid;
	}

	$result15=""; $found15=0; $ctr15=0;
	$res15query="SELECT name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$empid1\" AND contact_type=\"personnel\"";
	$result15 = $dbh2->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15 = $result15->fetch_assoc()) {
		$found15 = 1;
		$name_first = $myrow15['name_first'];
		$name_middle = $myrow15['name_middle'];
		$name_last = $myrow15['name_last'];
		} //while
	} //if

	if($sssee != 0) {
	  echo "<tr><td>$empid1</td>";
		if($empalias!='') {
		echo "<td>$empaliasfin</td>";
		} else {
		echo "<td>$name_last, $name_first $name_middle</td>";
		} // if
		echo "<td align=right>".number_format($sssee, 2)."<td align=right>".number_format($ssser, 2)."</td><td align=right>".number_format($sssec, 2)."</td><th align=right>".number_format($ssstotalec, 2)."</th><th align=right>".number_format($ssstotal, 2)."</th></tr>";
	}
	$found7 = 0;

        } //while
    } //if

     $res71query = "SELECT totalsssee, totalssser, totalsssecer, totalsssec, totalsss FROM tblconfipayrolltotal WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\"";
    $result71=$dbh2->query($res71query);
    if($result71->num_rows>0) {
        while($myrow71=$result71->fetch_assoc()) {

	$found71 = 1;
	$totalsssee = $myrow71['totalsssee'];
	$totalssser = $myrow71['totalssser'];
	$totalsssecer = $myrow71['totalsssecer'];
	$totalsssec = $myrow71['totalsssec'];
	$totalsss = $myrow71['totalsss'];

	echo "<tr><td>&nbsp;</td><th align=right>Total</th><th align=right>".number_format($totalsssee, 2)."</th><th align=right>".number_format($totalssser, 2)."</th><th align=right>".number_format($totalsssecer, 2)."</th><th align=right>".number_format($totalsssec, 2)."</th><th align=right>".number_format($totalsss, 2)."</th></tr>";
        } //while
    } //if

     echo "</table>";

     echo "<p><p><br>";

// start philhealth summary here

     echo "<table class=\"fin\" border=1 spacing=1>";
		echo "<tr><td colspan=\"5\">";
     echo "<b>PHILKOEI INTERNATIONAL, INC.</b>";
		echo "</td></tr>";
		echo "<tr><td colspan=\"5\">";
     echo "<b>Philhealth Contribution - $grpnm1</b>";
		echo "</td></tr>";
     // echo "<b>$cutstart -to- $cutend</b><br>";
		echo "<tr><td colspan=\"5\">";
		echo "<b>$cutoffstring</b>";
		echo "</td></tr>";
     echo "<tr><th>EmpID</th><th>Name</th><th>EE</th><th>ER</th><th>TotalPremium</th></tr>";

     $res8query = "SELECT tblconfipayroll.employeeid, tblconfipayroll.philhealthee, tblconfipayroll.philhealther, tblconfipayroll.philhealthtotal, tblconfipayroll.accesslevel FROM tblconfipayroll WHERE tblconfipayroll.groupname=\"$groupname\" AND tblconfipayroll.cutstart=\"$cutstart\" AND tblconfipayroll.cutend=\"$cutend\"";
    $result8=$dbh2->query($res8query);
    if($result8->num_rows>0) {
        while($myrow8=$result8->fetch_assoc()) {

	$found8 = 1;
	$employeeid = $myrow8['employeeid'];
	$philhealthee = $myrow8['philhealthee'];
	$philhealther = $myrow8['philhealther'];
	$philhealthtotal = $myrow8['philhealthtotal'];
	$confiaccesslevel = $myrow8['accesslevel'];

	// 20180515
	// check if empalias exists, else disp full name
	$result11=""; $found11=0; $ctr11=0;
	$res11query="SELECT empalias FROM tblconfipaymeminfo WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\" LIMIT 1";
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$empalias = $myrow11['empalias'];
		} // while
	} // if

	if($confiaccesslevel==5 && $accesslevel==5) {
	include("mcryptdec.php");
	$empid1 = $employeeid;
	$empaliasfin = $empalias;
	include("mcryptenc.php");
	} else if($confiaccesslevel<=4) {
	$empid1 = $employeeid;
	}

	$result16=""; $found16=0; $ctr16=0;
	$res16query="SELECT name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$empid1\" AND contact_type=\"personnel\"";
	$result16 = $dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16 = $result16->fetch_assoc()) {
		$found16 = 1;
		$name_first = $myrow16['name_first'];
		$name_middle = $myrow16['name_middle'];
		$name_last = $myrow16['name_last'];
		} //while
	} //if

	if($philhealthee != 0) {
	  echo "<tr><td>$empid1</td>";
		if($empalias!='') {
		echo "<td>$empaliasfin</td>";
		} else {
		echo "<td>$name_last, $name_first $name_middle[0]</td>";
		} // if
		echo "<td align=right>".number_format($philhealthee, 2)."<td align=right>".number_format($philhealther, 2)."</td><th align=right>".number_format($philhealthtotal, 2)."</th></tr>";
	}
	$found8 = 0; $empid1=""; $employeeid=""; $empalias=""; $empaliasfin="";

        } //while
    } //if

     $res81query = "SELECT totalphilhealthee, totalphilhealther, totalphilhealth FROM tblconfipayrolltotal WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\" LIMIT 1";
    $result81=$dbh2->query($res81query);
    if($result81->num_rows>0) {
        while($myrow81=$result81->fetch_assoc()) {

	$found81 = 1;
	$totalphilhealthee = $myrow81['totalphilhealthee'];
	$totalphilhealther = $myrow81['totalphilhealther'];
	$totalphilhealth = $myrow81['totalphilhealth'];

	echo "<tr><td>&nbsp;</td><th align=right>Total</th><th align=right>".number_format($totalphilhealthee, 2)."</th><th align=right>".number_format($totalphilhealther, 2)."</th><th align=right>".number_format($totalphilhealth, 2)."</th></tr>";
        } //while
    } //if

     echo "</table>";

     echo "<p><p><br>";

// start pagibig summary here

     echo "<table class=\"fin\" border=1 spacing=1>";
		echo "<tr><td colspan=\"5\">";
     echo "<b>PHILKOEI INTERNATIONAL, INC.</b>";
		echo "</td></tr>";
		echo "<tr><td colspan=\"5\">";
     echo "<b>Pag-IBIG Contribution - $grpnm1</b>";
		echo "</td></tr>";
     // echo "<b>$cutstart -to- $cutend</b><br>";
		echo "<tr><td colspan=\"5\">";
		echo "<b>$cutoffstring</b>";
		echo "</td></tr>";
     echo "<tr><th>EmpID</th><th>Name</th><th>EE</th><th>ER</th><th>Total</th></tr>";

     $res9query = "SELECT tblconfipayroll.employeeid, tblconfipayroll.pagibigee, tblconfipayroll.pagibiger, tblconfipayroll.pagibigtotal, tblconfipayroll.accesslevel FROM tblconfipayroll WHERE tblconfipayroll.groupname=\"$groupname\" AND tblconfipayroll.cutstart=\"$cutstart\" AND tblconfipayroll.cutend=\"$cutend\"";
    $result9=$dbh2->query($res9query);
    if($result9->num_rows>0) {
        while($myrow9=$result9->fetch_assoc()) {

	$found9 = 1;
	$employeeid = $myrow9['employeeid'];
	$pagibigee = $myrow9['pagibigee'];
	$pagibiger = $myrow9['pagibiger'];
	$pagibigtotal = $myrow9['pagibigtotal'];
    if($pagibigtotal==0 && ($pagibigee!=0 || $pagibiger!=0)) { 
    $pagibigtotal = $pagibigee + $pagibiger;
    } //if
	$confiaccesslevel = $myrow9['accesslevel'];

	// 20180515
	// check if empalias exists, else disp full name
	$res11query="SELECT empalias FROM tblconfipaymeminfo WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\" LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$empalias = $myrow11['empalias'];
		} // while
	} // if

	if($confiaccesslevel==5 && $accesslevel==5) {
	include("mcryptdec.php");
	$empid1 = $employeeid;
	$empaliasfin = $empalias;
	include("mcryptenc.php");
	} else if($confiaccesslevel<=4) {
	$empid1 = $employeeid;
	}

	$result17=""; $found17=0; $ctr17=0;
	$res17query="SELECT name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$empid1\" AND contact_type=\"personnel\"";
	$result17 = $dbh2->query($res17query);
   if($result17->num_rows>0) {
        while($myrow17=$result17->fetch_assoc()) {
		$found17 = 1;
		$name_first = $myrow17['name_first'];
		$name_middle = $myrow17['name_middle'];
		$name_last = $myrow17['name_last'];
        } //while
    } //if

	if($pagibigee != 0) {
	  echo "<tr><td>$empid1</td>";
		if($empalias!='') {
		echo "<td>$empaliasfin</td>";
		} else {
		echo "<td>$name_last, $name_first $name_middle[0]</td>";
		} // if
		echo "<td align=right>".number_format($pagibigee, 2)."<td align=right>".number_format($pagibiger, 2)."</td><th align=right>".number_format($pagibigtotal, 2)."</th></tr>";
	}
	$found9 = 0;

        } //while
    } //if

     $res91query = "SELECT totalpagibigee, totalpagibiger, totalpagibig FROM tblconfipayrolltotal WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\" LIMIT 1";
    $result91=$dbh2->query($res91query);
    if($result91->num_rows>0) {
        while($myrow91=$result91->fetch_assoc()) {
	$found91 = 1;
	$totalpagibigee = $myrow91['totalpagibigee'];
	$totalpagibiger = $myrow91['totalpagibiger'];
	$totalpagibig = $myrow91['totalpagibig'];

	echo "<tr><td>&nbsp;</td><th align=right>Total</th><th align=right>".number_format($totalpagibigee, 2)."</th><th align=right>".number_format($totalpagibiger, 2)."</th><th align=right>".number_format($totalpagibig, 2)."</th></tr>";
        } //while
    } //if

     echo "</table>";

     echo "<p><p><br>";


// start other deductions summary here

     echo "<table class=\"fin\" border=1 spacing=1>";
		echo "<tr><td colspan=\"4\">";
     echo "<b>PHILKOEI INTERNATIONAL, INC.</b>";
		echo "</td></tr>";
		echo "<tr><td colspan=\"4\">";
     echo "<b>Other Deductions - $grpnm1</b>";
		echo "</td></tr>";
     // echo "<b>$cutstart -to- $cutend</b><br>";
		echo "<tr><td colspan=\"4\">";
		echo "<b>$cutoffstring</b>";
		echo "</td></tr>";
     echo "<tr><th>EmpID</th><th>Name</th><th>TypeOfDeduction</th><th>Amount</th></tr>";

    // $result2 = mysql_query("SELECT tblconfipayrolldeduct.confipayrolldeductid, tblconfipayrolldeduct.employeeid, tblconfipayrolldeduct.namededuct, tblconfipayrolldeduct.deductamount FROM tblconfipayrolldeduct WHERE tblconfipayrolldeduct.groupname=\"$groupname\" AND tblconfipayrolldeduct.cutstart=\"$cutstart\" AND tblconfipayrolldeduct.cutend=\"$cutend\"", $dbh);
		// $result2 = mysql_query("SELECT confipayrollid, otherdeductions, employeeid FROM tblconfipayroll WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\"", $dbh);
    $res2query="SELECT confipayrolldeductid, employeeid, namededuct, deductamount FROM tblconfipayrolldeduct WHERE `groupname` = '$groupname' AND `cutstart` = '$cutstart' AND `cutend` = '$cutend'";
    $result2=$dbh2->query($res2query);

    if($result2->num_rows>0) {
        while($myrow2=$result2->fetch_assoc()) {
        $found2 = 1;
        $confipayrolldeductid = $myrow2['confipayrolldeductid'];
        $employeeid = $myrow2['employeeid'];
        $namededuct = $myrow2['namededuct'];
        $deductamount = $myrow2['deductamount'];

	// 20180515
	// check if empalias exists, else disp full name
	$res11query="SELECT empalias FROM tblconfipaymeminfo WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\" LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$empalias = $myrow11['empalias'];
		} // while
	} // if

	if($confiaccesslevel==5 && $accesslevel==5) {
	include("mcryptdec.php");
	$empid1 = $employeeid;
	$empaliasfin = $empalias;
	include("mcryptenc.php");
	} else if($confiaccesslevel<=4) {
	$empid1 = $employeeid;
	}

	$result18=""; $found18=0; $ctr18=0;
	$res18query="SELECT name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$empid1\" AND contact_type=\"personnel\"";
    $result18=$dbh2->query($res18query);
    if($result18->num_rows>0) {
        while($myrow18=$result18->fetch_assoc()) {
		$found18 = 1;
		$name_first = $myrow18['name_first'];
		$name_middle = $myrow18['name_middle'];
		$name_last = $myrow18['name_last'];
        } //while
    } //if

	echo "<tr><td>$empid1</td>";
	if($empalias!='') {
	echo "<td>$empaliasfin</td>";
	} else {
	echo "<td>$name_last, $name_first $name_middle[0]</td>";
	} // if
	echo "<td>$namededuct</td><th align=right>".number_format($deductamount, 2)."</th></tr>";

        } //while
    } //if

	// query total other deductions
	$res21query = "SELECT totalotherdeductions FROM tblconfipayrolltotal WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\" LIMIT 1";
    $result21=$dbh2->query($res21query);
    if($result21->num_rows>0) {
        while($myrow21=$result21->fetch_assoc()) {
		$found21 = 1;
		$totalotherdeductions = $myrow21['totalotherdeductions'];

		echo "<tr><td align=right colspan=2>&nbsp;</td><th align=right>Total</th><th align=right>".number_format($totalotherdeductions, 2)."</th></tr>";
        } //while
    } //if

     echo "</table>";


     echo "<p><p><br>";


// start absent summary here

     echo "<table class=\"fin\" border=1 spacing=1>";
		echo "<tr><td colspan=\"4\">";
     echo "<b>PHILKOEI INTERNATIONAL, INC.</b>";
		echo "</td></tr>";
		echo "<tr><td colspan=\"4\">";
     echo "<b>Absences - $grpnm1</b>";
		echo "</td></tr>";
     // echo "<b>$cutstart -to- $cutend</b><br>";
		echo "<tr><td colspan=\"4\">";
		echo "<b>$cutoffstring</b>";
		echo "</td></tr>";
     echo "<tr><th>EmpID</th><th>Name</th><th>DaysAbsent</th><th>Amount</th></tr>";

     $res2query = "SELECT tblconfipayroll.employeeid, tblconfipayroll.daysabsent, tblconfipayroll.daysabsentamt FROM tblconfipayroll WHERE tblconfipayroll.groupname=\"$groupname\" AND tblconfipayroll.cutstart=\"$cutstart\" AND tblconfipayroll.cutend=\"$cutend\"";
    $result2=$dbh2->query($res2query);
    if($result2->num_rows>0) {
        while($myrow2=$result2->fetch_assoc()) {
	$found2 = 1;
	$employeeid = $myrow2['employeeid'];
	$daysabsent = $myrow2['daysabsent'];
	$daysabsentamt = $myrow2['daysabsentamt'];

	// 20180515
	// check if empalias exists, else disp full name
	$res11query="SELECT empalias FROM tblconfipaymeminfo WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\" LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$empalias = $myrow11['empalias'];
		} // while
	} // if

	if($confiaccesslevel==5 && $accesslevel==5) {
	include("mcryptdec.php");
	$empid1 = $employeeid;
	$empaliasfin = $empalias;
	include("mcryptenc.php");
	} else if($confiaccesslevel<=4) {
	$empid1 = $employeeid;
	}

	$res20query="SELECT name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$empid1\" AND contact_type=\"personnel\"";
	$result20=""; $found20=0; $ctr20=0;
	$result20 = $dbh2->query($res20query);
	if($result20->num_rows>0) {
		while($myrow20 = $result20->fetch_assoc()) {
		$found20 = 1;
		$name_first = $myrow20['name_first'];
		$name_middle = $myrow20['name_middle'];
		$name_last = $myrow20['name_last'];
		} //while
	} //if

	if($daysabsent!=0 && $daysabsentamt!=0) {
	echo "<tr><td>$empid1</td>";
	if($empalias!='') {
	echo "<td>$empaliasfin</td>";
	} else {
	echo "<td>$name_last, $name_first $name_middle[0]</td>";
	} // if
	echo "<td>$daysabsent</td><th align=right>".number_format($daysabsentamt, 2)."</th></tr>";
	}
        } //while
    } //if

	$res21query = "SELECT totaldaysabsentamt FROM tblconfipayrolltotal WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\" LIMIT 1";
    $result21=$dbh2->query($res21query);
    if($result21->num_rows>0) {
        while($myrow21=$result21->fetch_assoc()) {
		$found21 = 1;
		$totaldaysabsentamt = $myrow21['totaldaysabsentamt'];

		echo "<tr><td align=right colspan=2>&nbsp;</td><th align=right>Total</th><th align=right>".number_format($totaldaysabsentamt, 2)."</th></tr>";
        } //while
    } //if

     echo "</table>";

     echo "<p><p><br>";

// start list of projects

     echo "<table class=\"fin\" border=1 spacing=1>";
		echo "<tr><td colspan=\"4\">";
     echo "<b>PHILKOEI INTERNATIONAL, INC.</b>";
		echo "</td></tr>";
		echo "<tr><td colspan=\"4\">";
     echo "<b>List of Projects - $grpnm1</b>";
		echo "</td></tr>";
     // echo "<b>$cutstart -to- $cutend</b><br>";
		echo "<tr><td colspan=\"4\">";
		echo "<b>$cutoffstring</b>";
		echo "</td></tr>";
     echo "<tr><th>EmpID</th><th>Name</th><th>Projects</th><th>Remarks</th></tr>";

    $res2query="SELECT tblconfipayrollproj.proj_code, tblconfipayrollproj.proj_name, tblconfipayrollproj.details FROM tblconfipayrollproj WHERE tblconfipayrollproj.groupname=\"$groupname\" AND tblconfipayrollproj.cutstart=\"$cutstart\" AND tblconfipayrollproj.cutend=\"$cutend\" ORDER BY tblcontact.employeeid ASC";
    $result2=$dbh2->query($res2query);
    if($result2->num_rows>0) {
        while($myrow2=$result2->fetch_assoc()) {
	$found2 = 1;
	$proj_code = $myrow2['proj_code'];
	$proj_name = $myrow2['proj_name'];
	$details = $myrow2['details'];

	// 20180515
	// check if empalias exists, else disp full name
	$res11query="SELECT empalias FROM tblconfipaymeminfo WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\" LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$empalias = $myrow11['empalias'];
		} // while
	} // if

	if($confiaccesslevel==5 && $accesslevel==5) {
	include("mcryptdec.php");
	$empid1 = $employeeid;
	$empaliasfin = $empalias;
	include("mcryptenc.php");
	} else if($confiaccesslevel<=4) {
	$empid1 = $employeeid;
	}

	echo "<tr><td>$empid1</td>";
	if($empalias!='') {
	echo "<td>$empaliasfin</td>";
	} else {
	echo "<td>$name_last, $name_first $name_middle[0]</td>";
	} // if
	echo "<td>$proj_name</td><td align=right>$details</td></tr>";

        } //while
    } //if

     echo "</table>";

	// close main table
	echo "</td></tr></table>";

//     echo "<p><a href=confipay2.php?loginid=$loginid>Back</a><br>";
     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
