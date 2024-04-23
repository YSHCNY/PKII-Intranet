<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$proj_code = $_GET['prjcd'];
$datefrom = $_GET['fr'];
$dateto = $_GET['to'];

if($datefrom == '') { $datefrom="2014-01-01"; }
if($dateto == '') { $dateto=$datenow; }

if($nkconso == '') { $nkconso=1; }

// echo "<p>vartest projcd:$proj_code duration:$datefrom-to-$dateto</p>";

$found = 0;

$secsubtotarr = array();

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header2.php");
     // include ("sidebar.php");
?>

<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script language="JavaScript" src="ts_picker.js"></script>
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
// start contents here

	if($proj_code != "") {

		echo "<table id=\"ReportTable\" class=\"fin\" border=\"1\">";
		echo "<tr><th colspan=\"23\" align=\"left\">Breakdown from Statement of Direct Profit/Loss for Each Project&nbsp;<a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a></th></tr>";

		// query proj_code details
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("SELECT projectid, proj_fname, proj_sname, companyid, contactid, proj_relation0, proj_relation1, proj_relation2, proj_relation3, proj_class, countrycd, jobtypcd, divisioncd FROM tblproject1 WHERE proj_code=\"$proj_code\" LIMIT 1", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$projectid11 = $myrow11[0];
			$proj_fname11 = $myrow11[1];
			$proj_sname11 = $myrow11[2];
			$companyid11 = $myrow11[3];
			$contactid11 = $myrow11[4];
			$proj_relation011 = $myrow11[5];
			$proj_relation111 = $myrow11[6];
			$proj_relation211 = $myrow11[7];
			$proj_relation311 = $myrow11[8];
			$proj_class11 = $myrow11[9];
			$countrycd11 = $myrow11[10];
			$jobtypcd11 = $myrow11[11];
			$divisioncd11 = $myrow11[12];
			}
		}
		echo "<tr><th colspan=\"23\" align=\"left\">$proj_code";
		if($proj_sname11 != "") { echo "&nbsp;-&nbsp;$proj_sname11"; }
		echo "&nbsp;"."-"."&nbsp;$proj_fname11</th></tr>";
		echo "<tr><th colspan=\"23\" align=\"left\">Duration from ".date("Y-M-d", strtotime($datefrom))." to ".date("Y-M-d", strtotime($dateto))."</th></tr>";

	if($datefrom <= $dateto) {

		echo "<tr><th colspan=\"5\">Sales Amount</th><th colspan=\"7\">Marginal Cost</th><th>Marginal Profit</th><th>%</th><th colspan=\"7\">Personnel Cost</th><th>Direct Profit</th><th>%</th></tr>";

		//
		// sales amount
		//
		echo "<tr><td colspan=\"5\">";
		echo "<table class=\"fin\" border=\"1\">";
		echo "<tr><th>date</th><th>voucher#</th><th>code</th><th>particulars</th><th>amount</th></tr>";
		// generate sales amount
		$result14=""; $found14=0; $ctr14=0;
		$result14 = mysql_query("SELECT journalid, journalnumber, date, glcode, glnamedetails, particulars, debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$proj_code\" AND (date>=\"$datefrom\" AND date<=\"$dateto\") AND (glcode>=\"10.10.300\" AND glcode<=\"10.10.305.1\") ORDER BY date ASC", $dbh);
		if($result14 != "") {
			while($myrow14 = mysql_fetch_row($result14)) {
			$found14 = 1;
			$journalid14 = $myrow14[0];
			$journalnumber14 = $myrow14[1];
			$date14 = $myrow14[2];
			$glcode14 = $myrow14[3];
			$glnamedetails14 = $myrow14[4];
			$particulars14 = $myrow14[5];
			$debitamt14 = $myrow14[6];
			$creditamt14 = $myrow14[7];
			$salesamtdebitamt = $salesamtdebitamt + $debitamt14;
			$salesamtcreditamt = $salesamtcreditamt + $creditamt14;
			echo "<tr><td>".date("Y-M-d", strtotime($date14))."</td><td>$journalnumber14</td><td>$glcode14</td><td>$particulars14</td><td align=\"right\">".number_format($debitamt14, 2)."</td></tr>";
			}
		}
		echo "</table>";
		echo "</td>";

		//
		// marginal cost
		//
		echo "<td colspan=\"7\">";
		echo "<table class=\"fin\" border=\"1\">";
		echo "<tr><th>date</th><th>voucher#</th><th>payee</th><th>code</th><th>particulars</th><th>debit amt</th><th>credit amt</th></tr>";
		// generate marginal cost
		$result15=""; $found15=0; $ctr15=0;
		$result15 = mysql_query("SELECT disbursementid, disbursementnumber, disbursementtype, date, glcode, glnamedetails, particulars, debitamt, creditamt, companyid, contactid, payee FROM tblfindisbursement WHERE projcode=\"$proj_code\" AND (date>=\"$datefrom\" AND date<=\"$dateto\") AND ((glcode>=\"60.20.000\" AND glcode<=\"60.99.999\") OR (glcode>=\"70.20.000\" AND glcode<=\"70.99.999\")) ORDER BY date ASC", $dbh);
		if($result15 != "") {
			while($myrow15 = mysql_fetch_row($result15)) {
			$found15 = 1;
			$disbursementid15 = $myrow15[0];
			$disbursementnumber15 = $myrow15[1];
			$disbursementtype15 = $myrow15[2];
			$date15 = $myrow15[3];
			$glcode15 = $myrow15[4];
			$glnamedetails15 = $myrow15[5];
			$particulars15 = $myrow15[6];
			$debitamt15 = $myrow15[7];
			$creditamt15 = $myrow15[8];
			$companyid15 = $myrow15[9];
			$contactid15 = $myrow15[10];
			$payee15 = $myrow15[11];
			$marginalcostdebitamt = $marginalcostdebitamt + $debitamt15;
			$marginalcostcreditamt = $marginalcostcreditamt + $creditamt15;
			echo "<tr><td>".date("Y-M-d", strtotime($date15))."</td><td>$disbursementnumber15</td>";
			echo "<td>";
		if((($companyid15!="") || ($companyid15!=0)) && (($contactid15=="") || ($contactid15==0))) {
			$result15a=""; $found15a=0; $ctr15a=0;
			$result15a = mysql_query("SELECT company, branch FROM tblcompany WHERE companyid=$companyid15", $dbh);
			if($result15a != "") {
				while($myrow15a = mysql_fetch_row($result15a)) {
				$found15a = 1;
				$company15a = $myrow15a[0];
				$branch15a = $myrow15a[1];
				}
			}
			$company15afin = $company15a;
			if($branch15a!="") { $company15afin = $company15a . " - " . $branch15a; }
			echo "$company15afin";
		}
		if((($contactid15!="") || ($contactid15!=0)) && (($companyid15=="") || ($companyid15==0))) {
			$result15b=""; $found15b=0; $ctr15b=0;
			$result15b = mysql_query("SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid15", $dbh);
			if($result15b != "") {
				while($myrow15b = mysql_fetch_row($result15b)) { 
				$found15b = 1;
				$companyid15b = $myrow15b[0];
				$employeeid15b = $myrow15b[1];
				$name_last15b = $myrow15b[2];
				$name_first15b = $myrow15b[3];
				$name_middle15b = $myrow15b[4];
				}
			}
			$contactname15bfin = $name_first15b;
			if($name_middle15b != "") { $contactname15bfin = $contactname15bfin . "&nbsp;" . $name_middle15b[0] . "."; }
			if($name_last15b != "") { $contactname15bfin = $contactname15bfin . "&nbsp;" . $name_last15b; }
			echo "$contactname15bfin";
		}
		if((($companyid15=="") && ($contactid15=="")) || (($companyid15==0) && ($contactid15==0))) {
			echo "$payee15";
		}
			echo "</td>";
			echo "<td>$glcode15</td><td>$particulars15</td><td align=\"right\">".number_format($debitamt15, 2)."</td><td align=\"right\">".number_format($creditamt15, 2)."</td></tr>";
			}
		}
		$result15b=""; $found15b=0; $ctr15b=0;
		$result15b = mysql_query("SELECT journalid, journalnumber, date, glcode, glnamedetails, particulars, debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$proj_code\" AND (date>=\"$datefrom\" AND date<=\"$dateto\") AND ((glcode>=\"60.20.000\" AND glcode<=\"60.99.999\") OR (glcode>=\"70.20.000\" AND glcode<=\"70.99.999\")) ORDER BY date ASC", $dbh);
		if($result15b != "") {
			while($myrow15b = mysql_fetch_row($result15b)) {
			$found15b = 1;
			$journalid15b = $myrow15b[0];
			$journalnumber15b = $myrow15b[1];
			$date15b = $myrow15b[2];
			$glcode15b = $myrow15b[3];
			$glnamedetails15b = $myrow15b[4];
			$particulars15b = $myrow15b[5];
			$debitamt15b = $myrow15b[6];
			$creditamt15b = $myrow15b[7];
			$marginalcostdebitamt = $marginalcostdebitamt + $debitamt15b;
			$marginalcostcreditamt = $marginalcostcreditamt + $creditamt15b;
			echo "<tr><td>".date("Y-M-d", strtotime($date15b))."</td><td>$journalnumber15b</td><td></td><td>$glcode15b</td><td>$particulars15b</td><td align=\"right\">".number_format($debitamt15b, 2)."</td><td align=\"right\">".number_format($creditamt15b, 2)."</td></tr>";
			}
		}
		echo "</table>";
		echo "</td>";

		//
		// marginal profit
		//
		echo "<td>";
		echo "</td>";

		//
		// marginal profit percentage
		//
		echo "<td>";
		echo "</td>";

		//
		// personnel cost
		//
		echo "<td colspan=\"7\">";
		echo "<table class=\"fin\" border=\"1\">";
		echo "<tr><th>date</th><th>voucher#</th><th>payee</th><th>code</th><th>particulars</th><th>debit amt</th><th>credit amt</th></tr>";
		// compute personnel cost
		$result16=""; $found16=0; $ctr16=0;
		$result16 = mysql_query("SELECT disbursementid, disbursementnumber, disbursementtype, date, glcode, glnamedetails, particulars, debitamt, creditamt, companyid, contactid, payee FROM tblfindisbursement WHERE projcode=\"$proj_code\" AND (date>=\"$datefrom\" AND date<=\"$dateto\") AND ((glcode>=\"60.10.000\" AND glcode<=\"60.15.102\") OR (glcode>=\"70.10.000\" AND glcode<=\"70.15.102\")) ORDER BY date ASC", $dbh);
		if($result16 != "") {
			while($myrow16 = mysql_fetch_row($result16)) {
			$found16 = 1;
			$disbursementid16 = $myrow16[0];
			$disbursementnumber16 = $myrow16[1];
			$disbursementtype16 = $myrow16[2];
			$date16 = $myrow16[3];
			$glcode16 = $myrow16[4];
			$glnamedetails16 = $myrow16[5];
			$particulars16 = $myrow16[6];
			$debitamt16 = $myrow16[7];
			$creditamt16 = $myrow16[8];
			$companyid16 = $myrow16[9];
			$contactid16 = $myrow16[10];
			$payee16 = $myrow16[11];
			$personnelcostdebitamt = $personnelcostdebitamt + $debitamt16;
			$personnelcostcreditamt = $personnelcostcreditamt + $creditamt16;
			echo "<tr><td>".date("Y-M-d", strtotime($date16))."</td><td>$disbursementnumber16</td>";
			echo "<td>";
		if((($companyid16!="") || ($companyid16!=0)) && (($contactid16=="") || ($contactid16==0))) {
			$result16a=""; $found16a=0; $ctr16a=0;
			$result16a = mysql_query("SELECT company, branch FROM tblcompany WHERE companyid=$companyid16", $dbh);
			if($result16a != "") {
				while($myrow16a = mysql_fetch_row($result16a)) {
				$found16a = 1;
				$company16a = $myrow16a[0];
				$branch16a = $myrow16a[1];
				}
			}
			$company16afin = $company16a;
			if($branch16a!="") { $company16afin = $company16a . " - " . $branch16a; }
			echo "$company16afin";
		}
		if((($contactid16!="") || ($contactid16!=0)) && (($companyid16=="") || ($companyid16==0))) {
			$result16b=""; $found16b=0; $ctr16b=0;
			$result16b = mysql_query("SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid16", $dbh);
			if($result16b != "") {
				while($myrow16b = mysql_fetch_row($result16b)) { 
				$found16b = 1;
				$companyid16b = $myrow16b[0];
				$employeeid16b = $myrow16b[1];
				$name_last16b = $myrow16b[2];
				$name_first16b = $myrow16b[3];
				$name_middle16b = $myrow16b[4];
				}
			}
			$contactname16bfin = $name_first16b;
			if($name_middle16b != "") { $contactname16bfin = $contactname16bfin . "&nbsp;" . $name_middle16b[0] . "."; }
			if($name_last16b != "") { $contactname16bfin = $contactname16bfin . "&nbsp;" . $name_last16b; }
			echo "$contactname16bfin";
		}
		if((($companyid16=="") && ($contactid16=="")) || (($companyid16==0) && ($contactid16==0))) {
			echo "$payee16";
		}
			echo "</td>";
			echo "<td>$glcode16</td><td>$particulars16</td><td align=\"right\">".number_format($debitamt16, 2)."</td><td align=\"right\">".number_format($creditamt16, 2)."</td></tr>";
			}
		}
		echo "</table>";
		// echo "<br>";
		echo "<table class=\"fin\" border=\"1\">";
		$result16b=""; $found16b=0; $ctr16b=0;
		$result16b = mysql_query("SELECT journalid, journalnumber, date, glcode, glnamedetails, particulars, debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$proj_code\" AND (date>=\"$datefrom\" AND date<=\"$dateto\") AND ((glcode>=\"60.10.000\" AND glcode<=\"60.15.102\") OR (glcode>=\"70.10.000\" AND glcode<=\"70.15.102\")) ORDER BY date ASC", $dbh);
		if($result16b != "") {
			while($myrow16b = mysql_fetch_row($result16b)) {
			$found16b = 1;
			$journalid16b = $myrow16b[0];
			$journalnumber16b = $myrow16b[1];
			$date16b = $myrow16b[2];
			$glcode16b = $myrow16b[3];
			$glnamedetails16b = $myrow16b[4];
			$particulars16b = $myrow16b[5];
			$debitamt16b = $myrow16b[6];
			$creditamt16b = $myrow16b[7];
			$personnelcostdebitamt = $personnelcostdebitamt + $debitamt16b;
			$personnelcostcreditamt = $personnelcostcreditamt + $creditamt16b;
			echo "<tr><td>".date("Y-M-d", strtotime($date16b))."</td><td>$journalnumber16b</td><td></td><td>$glcode16b</td><td>$particulars16b</td><td align=\"right\">".number_format($debitamt16b, 2)."</td><td align=\"right\">".number_format($creditamt16b, 2)."</td></tr>";
			}
		}
		echo "</table>";
		echo "</td>";

		//
		// direct profit
		//
		echo "<td>";
		echo "</td>";

		//
		// direct profit percentage
		//
		echo "<td>";
		echo "</td>";

		echo "</tr>";

		//
		// display totals
		//
		// sales amount total
		echo "<tr><th colspan=\"5\"></th>";
		// marginal cost total
		echo "<th colspan=\"5\" align=\"right\">Sub-total</th><th align=\"right\">".number_format($marginalcostdebitamt, 2)."</th><th align=\"right\">".number_format($marginalcostcreditamt, 2)."</th>";
		// marginal profit total and percentage
		echo "<th align=\"right\"></th><th align=\"right\"></th>";
		// personnel cost total
		echo "<th colspan=\"5\" align=\"right\">Sub-total</th><th align=\"right\">".number_format($personnelcostdebitamt, 2)."</th><th align=\"right\">".number_format($personnelcostcreditamt, 2)."</th>";
		// direct profit total and percentage
		echo "<th align=\"right\"></th><th align=\"right\"></th>";
		echo "</tr>";

		$marginalcosttot = $marginalcostdebitamt - $marginalcostcreditamt;
		$personnelcosttot = $personnelcostdebitamt - $personnelcostcreditamt;

		$marginalprofit = $salesamtdebitamt - $marginalcosttot;
		$marginalprofitpercentage = ($marginalprofit / $salesamtdebitamt) * 100;

		$directprofit = $marginalprofit - $personnelcosttot;
		$directprofitpercentage = ($directprofit / $salesamtdebitamt) * 100;

		// sales amount total
		echo "<tr><th colspan=\"4\" align=\"right\">Sales Amount Total</th><th align=\"right\">".number_format($salesamtdebitamt, 2)."</th>";
		// marginal cost total
		echo "<th colspan=\"5\" align=\"right\">Marginal Cost Total</th><th colspan=\"2\">".number_format($marginalcosttot, 2)."</th>";
		// marginal profit total and percentage
		echo "<th align=\"right\">".number_format($marginalprofit, 2)."</th><th>".number_format($marginalprofitpercentage, 2)."%"."</th>";
		// personnel cost total
		echo "<th colspan=\"5\" align=\"right\">Personnel Cost Total</th><th colspan=\"2\">".number_format($personnelcosttot, 2)."</th>";
		// direct profit total and percentage
		echo "<th align=\"right\">".number_format($directprofit, 2)."</th><th>".number_format($directprofitpercentage, 2)."%"."</th></tr>";
		}

    echo "</table>";
	}

    echo "<p><center><input type=\"button\" value=\"Close this window\" onclick=\"self.close()\"></center></p>";

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer2.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
?>
