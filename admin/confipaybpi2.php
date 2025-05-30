<?php 

require("db1.php");
include("clsmcrypt.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$groupname = (isset($_POST['groupname'])) ? $_POST['groupname'] :'';
$cutstart = (isset($_POST['cutstart'])) ? $_POST['cutstart'] :'';
$cutend = (isset($_POST['cutend'])) ? $_POST['cutend'] : '';

$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeeid'] :'';
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

$found = 0;

$counter = 0;
$counter2 = 0;
$totacctnum = 0;
$grandtotnetpay = 0;
$grandtothh = 0;

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
     echo "<html><head><STYLE TYPE=\"text/css\">";
     echo "<!--";
     echo "p{font-family: Helvetica; font-size: 10pt;}";
     echo "B{font-family: Helvetica; font-size: 10pt;}";
     echo "TD{font-family: Helvetica; font-size: 10pt;}";
     echo "--->";
     echo "</STYLE></head><body>";

     echo "<b>BPI Payroll File Process</b>";
     echo "<p>For payroll group and cutoff period:<br>";
     echo "<b>$groupname: $cutstart to $cutend</b></p>";

	$resquery = "SELECT totalnetpay FROM tblconfipayrolltotal WHERE groupname = '$groupname' AND cutstart = '$cutstart' AND cutend = '$cutend'";
	$result = $dbh2->query($resquery);
	if($result->num_rows>0) {
		while ($myrow = $result->fetch_assoc()) {
		$found = 1;
		$totalnetpay = $myrow['totalnetpay'];
		}
	}
	
	$res8query="SELECT count(tblconfipayroll.employeeid) AS empidcount FROM tblconfipayroll LEFT JOIN tblconfipaymeminfo ON tblconfipayroll.employeeid=tblconfipaymeminfo.employeeid WHERE tblconfipayroll.groupname=\"$groupname\" AND tblconfipaymeminfo.groupname=\"$groupname\" AND tblconfipayroll.cutstart=\"$cutstart\" AND tblconfipayroll.cutend=\"$cutend\"";
	$found8=0; $ctr8=0;
	$result8=$dbh2->query($res8query);
	if($result8->num_rows>0) {
		while($myrow8=$result8->fetch_assoc()) {
			$found8=1;
			$ctr8=$ctr8+1;
			$empidcount=$myrow8['empidcount'];
		}
	}
	/*
	 echo "<form action=\"bpibzlnk.php?loginid=$loginid\" method=\"POST\" name=\"bpibizlinkfileexport\">";
	echo "<input type=\"hidden\" name=\"groupname\" value=\"$groupname\">";
	echo "<input type=\"hidden\" name=\"cutstart\" value=\"$cutstart\">";
	echo "<input type=\"hidden\" name=\"cutend\" value=\"$cutend\">";
	echo "<input type=\"hidden\" name=\"payrolldate\" value=\"$payrolldate\">";
	echo "<input type=\"hidden\" name=\"payrolltime\" value=\"$payrolltime\">";
	 echo "<p><input type=\"submit\" value=\"Export to BPI BizLink xls format\"></p>";
	 echo "</form>";
	 */
	
	 echo "<table id=\"ReportTable\" border=\"1\" spacing=\"1\">";
	 
	 // display header
	 echo "<tr><td><a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a>$headerrecid</td>";
	 echo "<td>Payroll Date</td><td>".date('F j, Y', mktime(0, 0, 0, $month, $day, $year))."</td>";
	 echo "<td>Payroll Time</td><td>$payrolltime</td>";
	 echo "<td>Total Amount</td><td>$totalnetpay</td>";
	 echo "<td>Total Count</td><td>$empidcount</td>";
	 echo "<td>Funding Account</td><td>$compacctnumber</td></tr>";
	 
	 // display looped detail records
	$res2query = "SELECT tblconfipayroll.employeeid, tblconfipayroll.groupname, tblconfipayroll.cutstart, tblconfipayroll.cutend, tblconfipayroll.accesslevel, tblconfipaymeminfo.empalias FROM tblconfipayroll LEFT JOIN tblconfipaymeminfo ON tblconfipayroll.employeeid=tblconfipaymeminfo.employeeid WHERE tblconfipayroll.groupname=\"$groupname\" AND tblconfipaymeminfo.groupname=\"$groupname\" AND tblconfipayroll.cutstart=\"$cutstart\" AND tblconfipayroll.cutend=\"$cutend\"";
	$result2 = $dbh2->query($res2query);
	if($result2->num_rows>0) {
		while ($myrow2 = $result2->fetch_assoc()) {
		$found2 = 1;
		$employeeid = $myrow2['employeeid'];
		$groupname = $myrow2['groupname'];
		$cutstart = $myrow2['cutstart'];
		$cutend = $myrow2['cutend'];
		$confiaccesslevel = $myrow2['accesslevel'];
		$empalias = $myrow2['empalias'];

		if($confiaccesslevel==5 && $accesslevel==5) {
		include("mcryptdec.php");
		$empID = $employeeid;
		include("mcryptenc.php");
		} else if($confiaccesslevel<=4) {
		$empID = $employeeid;
		}
		$res3query = "SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$empID\"";
		$result3 = $dbh2->query($res3query);
		if($result3->num_rows>0) {
			while ($myrow3 = $result3->fetch_assoc()) {
			$found3 = 1;
			$name_first = $myrow3['name_first'];
			$name_middle = $myrow3['name_middle'];
			$name_last = $myrow3['name_last'];

			$res4query="SELECT employeeid, bank_name, acct_num, acct_type FROM tblbankacct WHERE employeeid=\"$empID\" AND payrolldflt=1 AND bank_name LIKE \"%BPI%\" LIMIT 1";
			$result4 = $dbh2->query($res4query);
			if($result4->num_rows>0) {
				while ($myrow4 = $result4->fetch_assoc()) {
				$found4 = 1;
				$bank_name = $myrow4['bank_name'];
				$acct_num = str_replace("-", "", $myrow4['acct_num']);
				$acct_num = str_replace(" ", "", $acct_num);
				$acct_type = $myrow4['acct_type'];

				include("bpihashfnc.php");

				$res5query = "SELECT netpay FROM tblconfipayroll WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\"";
				$result5 = $dbh2->query($res5query);
				if($result5->num_rows>0) {
					while ($myrow5 = $result5->fetch_assoc()) {
					$found5 = 1;
					$netpay = $myrow5['netpay'];
					} // while
				} // if($result5)
				
				echo "<tr><td>$detailrecid</td>";
				echo "<td>$name_first $name_last</td>";
				// echo "<td>$acct_num</td>";
				echo "<td>$acctnumfin</td>";
				echo "<td>$netpay</td>";
				echo "<td></td><td></td><td></td><td></td><td></td><td></td><td></td>";
				echo "</tr>";
				
				} // while
			} // if($result4)
			
			} // while
		} // if($result3)
		
		} // while
	} // if($result2)
		
	 echo "</table>";
	 
	 echo "<hr>";
	 
	echo "<form action=confipaybpicsv.php?loginid=$loginid&groupname=$groupname&cutstart=$cutstart&cutend=$cutend&companycode=$companycode&batchnumber=$batchnumber&payrolldate=$payrolldate method=POST>";
	echo "<table border=0 spacing=1><tr><td><input type=submit value='Export to CSV'></td></form>";

	echo "<form action=\"confipaybpitxt.php?loginid=$loginid\" method=\"POST\" name=\"cfptbpitxt\">";
	echo "<input type=\"hidden\" name=\"groupname\" value=\"$groupname\">";
	echo "<input type=\"hidden\" name=\"cutstart\" value=\"$cutstart\">";
	echo "<input type=\"hidden\" name=\"cutend\" value=\"$cutend\">";
	echo "<input type=\"hidden\" name=\"companycode\" value=\"$companycode\">";
	echo "<input type=\"hidden\" name=\"batchnumber\" value=\"$batchnumber\">";
	echo "<input type=\"hidden\" name=\"payrolldate\" value=\"$payrolldate\">";

	echo "<td><input type=\"submit\" value=\"Export to BPI txt format\"></td></tr></table></form>";

     echo "Summary Table:<br>";

	echo "<table border=1 spacing=1>";
	echo "<tr><td colspan=9 align=center>PHILKOEI INTERNATIONAL, INC.</td></tr>";
	echo "<tr><td colspan=2>&nbsp;</td><td>Company Code</td><td colspan=4>$companycode</td><td>Payroll Date</td><td>";
	echo date("F j, Y", mktime(0, 0, 0, $month, $day, $year));
	echo "</td></tr>";
	echo "<tr><td colspan=2>&nbsp;</td><td>Account Number</td><td colspan=4>$compacctnumber</td></td><td>Ceiling Amount</td><td align=right>";
	echo number_format($ceilingamt, 2, '.', ',');
	echo "</td></tr>";
	echo "<tr><td colspan=2>&nbsp;</td><td>Batch Number</td><td colspan=4>$batchnumber</td><td>Total Payroll Amount</td>";

	echo "<td align=right>";
	echo number_format($totalnetpay, 2, '.', ',');
	echo "</td></tr>";

	echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>Name</td><td colspan=4>Account Number</td><td>Net Pay</td><td>Horizontal Hash</td></tr>";

	$res2query = "SELECT tblconfipayroll.employeeid, tblconfipayroll.groupname, tblconfipayroll.cutstart, tblconfipayroll.cutend, tblconfipayroll.accesslevel, tblconfipaymeminfo.empalias FROM tblconfipayroll LEFT JOIN tblconfipaymeminfo ON tblconfipayroll.employeeid=tblconfipaymeminfo.employeeid WHERE tblconfipayroll.groupname=\"$groupname\" AND tblconfipaymeminfo.groupname=\"$groupname\" AND tblconfipayroll.cutstart=\"$cutstart\" AND tblconfipayroll.cutend=\"$cutend\"";
	$result2 = $dbh2->query($res2query);
	if($result2->num_rows>0) {
		while ($myrow2 = $result2->fetch_assoc()) {
		$found2 = 1;
		$employeeid = $myrow2['employeeid'];
		$groupname = $myrow2['groupname'];
		$cutstart = $myrow2['cutstart'];
		$cutend = $myrow2['cutend'];
		$confiaccesslevel = $myrow2['accesslevel'];
		$empalias = $myrow2['empalias'];

		if($confiaccesslevel==5 && $accesslevel==5) {
		include("mcryptdec.php");
		$empID = $employeeid;
		include("mcryptenc.php");
		} else if($confiaccesslevel<=4) {
		$empID = $employeeid;
		}
		$res3query = "SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$empID\"";
		$result3 = $dbh2->query($res3query);
		if($result3->num_rows>0) {
			while ($myrow3 = $result3->fetch_assoc()) {
			$found3 = 1;
			$name_first = $myrow3['name_first'];
			$name_middle = $myrow3['name_middle'];
			$name_last = $myrow3['name_last'];

			// $res4query = "SELECT employeeid, bank_name, acct_num, acct_type FROM tblbankacct WHERE employeeid=\"$empID\" AND bank_name LIKE \"%BPI%\" AND (((bank_branch LIKE \"%Ayala%\" OR bank_branch='') OR (acct_type=\"Current\" OR acct_type=\"Savings\")) OR payrolldflt=1) ORDER BY bankacctid ASC LIMIT 1";
		// $res4query = "SELECT employeeid, bank_name, acct_num, acct_type FROM tblbankacct WHERE employeeid=\"$empID\" AND bank_name LIKE \"%BPI%\" AND payrolldflt=1 ORDER BY bankacctid ASC LIMIT 1;";
			$res4query="SELECT employeeid, bank_name, acct_num, acct_type FROM tblbankacct WHERE employeeid=\"$empID\" AND payrolldflt=1 AND bank_name LIKE \"%BPI%\" LIMIT 1";
			$result4 = $dbh2->query($res4query);
			if($result4->num_rows>0) {
				while ($myrow4 = $result4->fetch_assoc()) {
				$found4 = 1;
				$bank_name = $myrow4['bank_name'];
				$acct_num = str_replace("-", "", $myrow4['acct_num']);
				$acct_num = str_replace(" ", "", $acct_num);
				$acct_type = $myrow4['acct_type'];

				$res5query = "SELECT netpay FROM tblconfipayroll WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\"";
				$result5 = $dbh2->query($res5query);
				if($result5->num_rows>0) {
					while ($myrow5 = $result5->fetch_assoc()) {
					$found5 = 1;
					$netpay = $myrow5['netpay'];

				include("bpihashfnc.php");

					echo "<tr><td>$counter</td><td>$acctnumfin</td>";
			if($confiaccesslevel==5 && $accesslevel==5) {
			include("mcryptdec.php");
				if($empalias!="") {
					echo "<td>$empalias</td>";
				} else {
					echo "<td>$name_last, $name_first $name_middle</td>";
				} // if($empalias!="")
			include("mcryptenc.php");
			} else if($confiaccesslevel<=4) {
					echo "<td>$name_last, $name_first $name_middle</td>";
			} // if($confiaccesslevel==5 && $accesslevel==5)
					echo "<td>$acct_num04</td><td>$hh56</td><td>$hh78</td><td>$hh910</td><td align=right>";
					echo number_format($netpay, 2, '.', ',');
					echo "</td><td align=right>";
					echo number_format($tothhnetpay, 2, '.', '');
					echo "</td></tr>";
					} // while ($myrow5 = $result5->fetch_assoc())
				} // if($result5->num_rows>0)

			$totacctnum = $totacctnum + $acctnumfin;
			$grandtotnetpay = $grandtotnetpay + $netpay;
			$grandtothh = $grandtothh + $tothhnetpay;

			} // while ($myrow4 = $result4->fetch_assoc())
		} // if($result4->num_rows>0)

			} // while ($myrow3 = $result3->fetch_assoc())
		} // if($result3->num_rows>0)

		} // while ($myrow2 = $result2->fetch_assoc())
	} // if($result2->num_rows>0)

	echo "<tr><td>&nbsp;</td><td>$totacctnum</td><td>Hash Totals</td><td colspan=4 align=right>$totacctnum</td><td align=right>";
	echo number_format($grandtotnetpay, 2, '.', ',');
	echo "</td><td align=right>";
	echo number_format($grandtothh, 2, '.', '');
	echo "</td></tr>";
	echo "<tr><td colspan=2>&nbsp;</td><td>Record Count</td><td>$counter</td><td colspan=5>&nbsp;</td></tr>";

	echo "<tr><td colspan=2>&nbsp;</td><td>Prepared:</td><td colspan=4>Checked:</td><td>Noted:</td><td>Approved:</td></tr>";
	echo "<tr><td colspan=2>&nbsp;</td><td>$preparedname</td><td colspan=4>$checkedname</td><td>$notedname</td><td>$approvedname</td></tr>";
	echo "<tr><td colspan=2>&nbsp;</td><td>$preparedpos</td><td colspan=4>$checkedpos</td><td>$notedpos</td><td>$approvedpos</td></tr>";

	echo "</table>";

//     echo "<p><a href=confipay2.php?loginid=$loginid>Back</a><br>";

	$batchnumber2 = $batchnumber + 1;

	$res6query = "UPDATE tblbpipayrollfilespec SET headerrecid=\"$headerrecid\", batchnumber=$batchnumber2, companycode=$companycode, headerrectype=$headerrectype, compacctnumber=$compacctnumber, presofficecode=$presofficecode, payrollidentifier=$payrollidentifier, detailrecid=\"$detailrecid\", detailrectype=$detailrectype, trailerrecid=\"$trailerrecid\", trailerrectype=$trailerrectype, preparedname=\"$preparedname\", preparedpos=\"$preparedpos\", checkedname=\"$checkedname\", checkedpos=\"$checkedpos\", notedname=\"$notedname\", notedpos=\"$notedpos\", approvedname=\"$approvedname\", approvedpos=\"$approvedpos\" WHERE bpipayrollfilespecid=1";
	$result6 = $dbh2->query($res6query);

	$res7query = "SELECT groupname, cutstart, cutend FROM tblbpipayrollfileresult WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\"";
	$found7 = 0;
	$result7 = $dbh2->query($result7);
	if($result7->num_rows>0) {
		while ($myrow7 = $result7->fetch_assoc()) {
		$found7 = 1;
		$groupname = $myrow7['groupname'];
		$cutstart = $myrow7['cutstart'];
		$cutend = $myrow7['cutend'];
		} // while ($myrow7 = $result7->fetch_assoc())
	} // if($result7->num_rows>0)

	if($found7 == 1) {
		$res71query = "UPDATE tblbpipayrollfileresult SET payrolldate=\"$payrolldate\", batchnumber=$batchnumber, companycode=$companycode, compacctnumber=$compacctnumber, ceilingamount=$ceilingamt, totalnetpay=$grandtotnetpay, acctnumhashtot=$totacctnum, transactamthashtot=$grandtotnetpay, grandhorizhashtot=$grandtothh, recordcount=$counter WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\"";
		$result71 = $dbh2->query($res71query);
	} else if($found7 == 0) {
		$res72query = "INSERT INTO tblbpipayrollfileresult (groupname, cutstart, cutend, payrolldate, batchnumber, companycode, compacctnumber, ceilingamount, totalnetpay, acctnumhashtot, transactamthashtot, grandhorizhashtot, recordcount) VALUES (\"$groupname\", \"$cutstart\", \"$cutend\", \"$payrolldate\", $batchnumber, $companycode, $compacctnumber, $ceilingamt, $grandtotnetpay, $totacctnum, $grandtotnetpay, $grandtothh, $counter)";
		$result72 = $dbh2->query($res72query);
	}

	// echo "<p>vartest totalnetpay=$grandtotnetpay, acctnumhashtot=$totacctnum, transactamthashtot=$grandtotnetpay, grandhorizhashtot=$grandtothh</p>";

	echo "</body></html>";
}
else
{
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
