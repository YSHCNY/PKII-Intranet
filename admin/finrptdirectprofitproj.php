<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$disptyp = $_POST['disptyp'];
$projcd = (isset($_POST['projcd'])) ? $_POST['projcd'] :'';
$projgrpcrit = $_POST['projgrpcrit'];
$datefrom = $_POST['datefrom'];
$dateto = $_POST['dateto'];

if($datefrom == '') { $datefrom="2014-01-01"; }
if($dateto == '') { $dateto=$datenow; }

if($nkconso == '') { $nkconso=1; }

// echo "<p>vartest projgrpcrit:$projgrpcrit duration:$datefrom-to-$dateto</p>";

$found = 0;

$secsubtotarr = array();

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");
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

    echo "<table width=\"100%\" class=\"fin2\" border=\"1\">";
    echo "<tr>";
    echo "<form action=\"finrptdirectprofitproj.php?loginid=$loginid\" method=\"post\" name=\"form1\">";
    echo "<td colspan=\"2\" nowrap>";

		// display dropdown for display type (disptyp)
		echo "<select name=\"disptyp\" onchange=\"this.form.submit()\">";
		if($disptyp=='') {
		echo "<option value=''>display type</option>";
		} // if
		if($disptyp=="indiv") {
			$dispindiv="selected"; $dispgroup="";
		} else if($disptyp=="group") {
			$dispindiv=""; $dispgroup="selected";
		} // if
		echo "<option value=\"indiv\" $dispindiv>Individual projects</option>";
		echo "<option value=\"group\" $dispgroup>Project group/criteria</option>";
		echo "</select>";

		if($disptyp=="indiv") {
		// display individual projects
		// echo "<select name=\"projcd\" onchange=\"this.form.submit()\">";
		echo "<select name=\"projcd\">";
		if($projcd=='') {
		echo "<option value=''>choose project</option>";
		} // if
		$res12query="SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code!='' ORDER BY proj_code DESC";
		$result12=""; $found12=0; $ctr12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
			$found12=1;
			$ctr12=$ctr12+1;
			$projectid12 = $myrow12['projectid'];
			$proj_code12 = $myrow12['proj_code'];
			$proj_fname12 = $myrow12['proj_fname'];
			$proj_sname12 = $myrow12['proj_sname'];
			$proj_fname2 = substr("$proj_fname12", 0, 50);
			if($projcd==$proj_code12) { $projcdsel="selected"; } else { $projcdsel=""; } // if
			echo "<option value=\"$proj_code12\" $projcdsel>$proj_code12 - $proj_sname12 - $proj_fname2</option>";
			} // while
		} // if
		echo "</select>";

		} else if($disptyp=="group") {

		// display project group or criterias
		// echo "<select name=\"projgrpcrit\" onchange=\"this.form.submit()\">";
		echo "<select name=\"projgrpcrit\">";
		if($projgrpcrit == "") {
		echo "<option value='' $projgrpcritnone>select project group</option>";
		}
		$result10=""; $found10=0; $ctr10=0;
		$result10 = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE codeprev=\"nkmain\"", $dbh);
		if($result10 != "") {
			while($myrow10 = mysql_fetch_row($result10)) {
			$projrelrefid10 = $myrow10[0];
			$code10 = $myrow10[1];
			$name10 = $myrow10[2];
			if($code10 == $projgrpcrit) { $cdnkmainsel="selected"; } else { $cdnkmainsel=""; }
			echo "<option value=\"$code10\" $cdnkmainsel>"."===&nbsp;".$name10."&nbsp;==="."</option>";
			}
		}
		$result10b=""; $found10b=0; $ctr10b=0;
		$result10b = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE codeprev=\"$code10\" AND nkconso=$nkconso", $dbh);
		if($result10b != "") {
			while($myrow10b = mysql_fetch_row($result10b)) {
			$projrelrefid10b = $myrow10b[0];
			$code10b = $myrow10b[1];
			$name10b = $myrow10b[2];
			if($code10b == $projgrpcrit) { $cdnkmain2sel="selected"; } else { $cdnkmain2sel=""; }
			echo "<option value=\"$code10b\" $cdnkmain2sel>".">>>&nbsp;".$name10b."</option>";
			}
		}
		$result10c=""; $found10c=0; $ctr10c=0;
		$result10c = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE code=\"nkgroup\"", $dbh);
		if($result10c != "") {
			while($myrow10c = mysql_fetch_row($result10c)) {
			$projrelrefid10c = $myrow10c[0];
			$code10c = $myrow10c[1];
			$name10c = $myrow10c[2];
			if($code10c == $projgrpcrit) { $cdnkgrpsel="selected"; } else { $cdnkgrpsel=""; }
			echo "<option value=\"$code10c\" $cdnkgrpsel>"."===&nbsp;".$name10c."&nbsp;==="."</option>";
			}
		}
		$result10d=""; $found10d=0; $ctr10d=0;
		$result10d = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE codeprev=\"$code10c\" AND nkconso=$nkconso", $dbh);
		if($result10d != "") {
			while($myrow10d = mysql_fetch_row($result10d)) {
			$projrelrefid10d = $myrow10d[0];
			$code10d = $myrow10d[1];
			$name10d = $myrow10d[2];
			if($code10d == $projgrpcrit) { $cdnkgrp2sel="selected"; } else { $cdnkgrp2sel=""; }
			echo "<option value=\"$code10d\" $cdnkgrp2sel>".">>>&nbsp;".$name10d."</option>";
			}
		}
		$result10e=""; $found10e=0; $ctr10e=0;
		$result10e = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE code=\"others\"", $dbh);
		if($result10e != "") {
			while($myrow10e = mysql_fetch_row($result10e)) {
			$projrelrefid10e = $myrow10e[0];
			$code10e = $myrow10e[1];
			$name10e = $myrow10e[2];
			if($code10e == $projgrpcrit) { $cdothersel="selected"; } else { $cdothersel=""; }
			echo "<option value=\"$code10e\" $cdothersel>"."===&nbsp;".$name10e."&nbsp;==="."</option>";
			}
		}
		$result10f=""; $found10f=0; $ctr10f=0;
		$result10f = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE codeprev=\"$code10e\"", $dbh);
		if($result10f != "") {
			while($myrow10f = mysql_fetch_row($result10f)) {
			$projrelrefid10f = $myrow10f[0];
			$code10f = $myrow10f[1];
			$name10f = $myrow10f[2];
			if($code10f == $projgrpcrit) { $cdother2sel="selected"; } else { $cdother2sel=""; }
			echo "<option value=\"$code10f\" $cdother2sel>".">>>&nbsp;".$name10f."</option>";
			}
		}
		if($projgrpcrit=="ALL") { $cdallsel="selected"; } else { $cdallsel=""; }
		echo "<option value=\"ALL\" $cdallsel>===&nbsp;ALL Projects&nbsp;===</option>";
		echo "</select>";

		} // if


		echo "From<input type=\"date\" size=\"8\" name=\"datefrom\" value=\"$datefrom\">";
		?>
  	<a href="javascript:show_calendar('document.form1.datefrom', document.form1.datefrom.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  	<?php
		echo "To<input type=\"date\" size=\"8\" name=\"dateto\" value=\"$dateto\">";
		?>
  	<a href="javascript:show_calendar('document.form1.dateto', document.form1.dateto.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  	<?php

    echo "<input type=\"submit\" value=\"Submit\" id=\"myOrder1\"></td></form>";
    echo "</tr>";


	echo "<tr><td colspan=\"2\">";


		echo "<table id=\"ReportTable\" class=\"fin2\">";
		echo "<tr><th colspan=\"2\" align=\"left\">Statement of Direct Profit/Loss for Each Project&nbsp;<a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a></th></tr>";
		echo "<tr><th colspan=\"2\" align=\"left\">Duration from ".date("Y-M-d", strtotime($datefrom))." to ".date("Y-M-d", strtotime($dateto))."</th></tr>";

	if($datefrom <= $dateto) {

    echo "<tr><td colspan=\"2\">";
		echo "<table class=\"fin\" border=\"1\">";
		// echo "<tr><td colspan=15>projcd:$projcd,grpcrit:$projgrpcrit<br>res11:$result11</td></tr>";
		echo "<tr><th>Count</th><th>ProjectCode</th><th>ProjectName</th><th>ProjectRelations</th><th>Client</th><th>SalesAmount</th><th>MarginalCost</th><th>MarginalProfit</th><th>%</th><th>PersonnelCost</th><th>DirectProfit</th><th>%</th><th>Country</th><th>JobType</th><th>Division</th></tr>";

		$result11=""; $found11=0; $ctr11=0;
	if($projcd != "") {
		$res11query = "SELECT tblproject1.projectid, tblproject1.proj_num, tblproject1.proj_code, tblproject1.proj_fname, tblproject1.proj_sname, tblproject1.proj_desc, tblproject1.proj_services, tblproject1.proj_period, tblproject1.proj_duty, tblproject1.companyid, tblproject1.date_start, tblproject1.date_end, tblproject1.projstatus, tblproject1.proj_remarks, tblproject1.contactid, tblproject1.employeeid, tblproject1.sw_nk, tblproject1.sw_jica, tblproject1.sw_icg, tblproject1.proj_relation0, tblproject1.proj_relation1, tblproject1.proj_relation2, tblproject1.proj_relation3, tblproject1.proj_class, tblproject1.countrycd, tblproject1.jobtypcd, tblproject1.divisioncd FROM tblproject1 WHERE tblproject1.proj_code=\"$projcd\"";
		$result11 = mysql_query("$res11query", $dbh);

	} else if($projgrpcrit != "") {

		if($projgrpcrit=="nkoei") {
		$res11query="SELECT tblproject1.projectid, tblproject1.proj_num, tblproject1.proj_code, tblproject1.proj_fname, tblproject1.proj_sname, tblproject1.proj_desc, tblproject1.proj_services, tblproject1.proj_period, tblproject1.proj_duty, tblproject1.companyid, tblproject1.date_start, tblproject1.date_end, tblproject1.projstatus, tblproject1.proj_remarks, tblproject1.contactid, tblproject1.employeeid, tblproject1.sw_nk, tblproject1.sw_jica, tblproject1.sw_icg, tblproject1.proj_relation0, tblproject1.proj_relation1, tblproject1.proj_relation2, tblproject1.proj_relation3, tblproject1.proj_class, tblproject1.countrycd, tblproject1.jobtypcd, tblproject1.divisioncd FROM tblproject1 WHERE tblproject1.proj_relation2=\"nkoei\" ORDER BY tblproject1.proj_code DESC";
		$result11 = mysql_query("$res11query", $dbh);
		} else if( preg_match( '/^nkm.*/', $projgrpcrit)) {
		$result11 = mysql_query("SELECT tblproject1.projectid, tblproject1.proj_num, tblproject1.proj_code, tblproject1.proj_fname, tblproject1.proj_sname, tblproject1.proj_desc, tblproject1.proj_services, tblproject1.proj_period, tblproject1.proj_duty, tblproject1.companyid, tblproject1.date_start, tblproject1.date_end, tblproject1.projstatus, tblproject1.proj_remarks, tblproject1.contactid, tblproject1.employeeid, tblproject1.sw_nk, tblproject1.sw_jica, tblproject1.sw_icg, tblproject1.proj_relation0, tblproject1.proj_relation1, tblproject1.proj_relation2, tblproject1.proj_relation3, tblproject1.proj_class, tblproject1.countrycd, tblproject1.jobtypcd, tblproject1.divisioncd FROM tblproject1 WHERE tblproject1.proj_relation1=\"nkmain\" AND tblproject1.proj_relation3=\"$projgrpcrit\" ORDER BY tblproject1.proj_code DESC", $dbh);
		} else if($projgrpcrit=="nkgroup") {
		$result11 = mysql_query("SELECT tblproject1.projectid, tblproject1.proj_num, tblproject1.proj_code, tblproject1.proj_fname, tblproject1.proj_sname, tblproject1.proj_desc, tblproject1.proj_services, tblproject1.proj_period, tblproject1.proj_duty, tblproject1.companyid, tblproject1.date_start, tblproject1.date_end, tblproject1.projstatus, tblproject1.proj_remarks, tblproject1.contactid, tblproject1.employeeid, tblproject1.sw_nk, tblproject1.sw_jica, tblproject1.sw_icg, tblproject1.proj_relation0, tblproject1.proj_relation1, tblproject1.proj_relation2, tblproject1.proj_relation3, tblproject1.proj_class, tblproject1.countrycd, tblproject1.jobtypcd, tblproject1.divisioncd FROM tblproject1 WHERE tblproject1.proj_relation1=\"nkgroup\" ORDER BY tblproject1.proj_code DESC", $dbh);
		} else if( preg_match( '/^nkg.*/', $projgrpcrit)) {
		$result11 = mysql_query("SELECT tblproject1.projectid, tblproject1.proj_num, tblproject1.proj_code, tblproject1.proj_fname, tblproject1.proj_sname, tblproject1.proj_desc, tblproject1.proj_services, tblproject1.proj_period, tblproject1.proj_duty, tblproject1.companyid, tblproject1.date_start, tblproject1.date_end, tblproject1.projstatus, tblproject1.proj_remarks, tblproject1.contactid, tblproject1.employeeid, tblproject1.sw_nk, tblproject1.sw_jica, tblproject1.sw_icg, tblproject1.proj_relation0, tblproject1.proj_relation1, tblproject1.proj_relation2, tblproject1.proj_relation3, tblproject1.proj_class, tblproject1.countrycd, tblproject1.jobtypcd, tblproject1.divisioncd FROM tblproject1 WHERE tblproject1.proj_relation1=\"nkgroup\" AND tblproject1.proj_relation2=\"$projgrpcrit\" ORDER BY tblproject1.proj_code DESC", $dbh);
		} else if($projgrpcrit=="others") {
		$result11 = mysql_query("SELECT tblproject1.projectid, tblproject1.proj_num, tblproject1.proj_code, tblproject1.proj_fname, tblproject1.proj_sname, tblproject1.proj_desc, tblproject1.proj_services, tblproject1.proj_period, tblproject1.proj_duty, tblproject1.companyid, tblproject1.date_start, tblproject1.date_end, tblproject1.projstatus, tblproject1.proj_remarks, tblproject1.contactid, tblproject1.employeeid, tblproject1.sw_nk, tblproject1.sw_jica, tblproject1.sw_icg, tblproject1.proj_relation0, tblproject1.proj_relation1, tblproject1.proj_relation2, tblproject1.proj_relation3, tblproject1.proj_class, tblproject1.countrycd, tblproject1.jobtypcd, tblproject1.divisioncd FROM tblproject1 WHERE tblproject1.proj_relation0=\"others\" ORDER BY tblproject1.proj_code DESC", $dbh);
		} else if( preg_match( '/^oth.*/', $projgrpcrit)) {
		$result11 = mysql_query("SELECT tblproject1.projectid, tblproject1.proj_num, tblproject1.proj_code, tblproject1.proj_fname, tblproject1.proj_sname, tblproject1.proj_desc, tblproject1.proj_services, tblproject1.proj_period, tblproject1.proj_duty, tblproject1.companyid, tblproject1.date_start, tblproject1.date_end, tblproject1.projstatus, tblproject1.proj_remarks, tblproject1.contactid, tblproject1.employeeid, tblproject1.sw_nk, tblproject1.sw_jica, tblproject1.sw_icg, tblproject1.proj_relation0, tblproject1.proj_relation1, tblproject1.proj_relation2, tblproject1.proj_relation3, tblproject1.proj_class, tblproject1.countrycd, tblproject1.jobtypcd, tblproject1.divisioncd FROM tblproject1 WHERE tblproject1.proj_relation0=\"others\" AND tblproject1.proj_relation1=\"$projgrpcrit\" ORDER BY tblproject1.proj_code DESC", $dbh);
		} else if($projgrpcrit=="ALL") {
		$result11 = mysql_query("SELECT tblproject1.projectid, tblproject1.proj_num, tblproject1.proj_code, tblproject1.proj_fname, tblproject1.proj_sname, tblproject1.proj_desc, tblproject1.proj_services, tblproject1.proj_period, tblproject1.proj_duty, tblproject1.companyid, tblproject1.date_start, tblproject1.date_end, tblproject1.projstatus, tblproject1.proj_remarks, tblproject1.contactid, tblproject1.employeeid, tblproject1.sw_nk, tblproject1.sw_jica, tblproject1.sw_icg, tblproject1.proj_relation0, tblproject1.proj_relation1, tblproject1.proj_relation2, tblproject1.proj_relation3, tblproject1.proj_class, tblproject1.countrycd, tblproject1.jobtypcd, tblproject1.divisioncd FROM tblproject1 ORDER BY tblproject1.proj_code DESC", $dbh);
		} // if
	} // if
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$projectid11 = $myrow11[0];
			$proj_num11 = $myrow11[1];
			$proj_code11 = $myrow11[2];
			$proj_fname11 = $myrow11[3];
			$proj_sname11 = $myrow11[4];
			$proj_desc11 = $myrow11[5];
			$proj_services11 = $myrow11[6];
			$proj_period11 = $myrow11[7];
			$proj_duty11 = $myrow11[8];
			$companyid11 = $myrow11[9];
			$date_start11 = $myrow11[10];
			$date_end11 = $myrow11[11];
			$projstatus11 = $myrow11[12];
			$proj_remarks11 = $myrow11[13];
			$contactid11 = $myrow11[14];
			$employeeid11 = $myrow11[15];
			$sw_nk11 = $myrow11[16];
			$sw_jica11 = $myrow11[17];
			$sw_icg11 = $myrow11[18];
			$proj_relation011 = $myrow11[19];
			$proj_relation111 = $myrow11[20];
			$proj_relation211 = $myrow11[21];
			$proj_relation311 = $myrow11[22];
			$proj_class11 = $myrow11[23];
			$countrycd11 = $myrow11[24];
			$jobtypcd11 = $myrow11[25];
			$divisioncd11 = $myrow11[26];

			$ctr11 = $ctr11 + 1;

			// generate sales amount
			$result14=""; $found14=0; $ctr14=0;
			$result14 = mysql_query("SELECT journalid, journalnumber, date, debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$proj_code11\" AND (date>=\"$datefrom\" AND date<=\"$dateto\") AND (glcode>=\"10.10.300\" AND glcode<=\"10.10.305.1\")", $dbh);
			if($result14 != "") {
				while($myrow14 = mysql_fetch_row($result14)) {
				$found14 = 1;
				$journalid14 = $myrow14[0];
				$journalnumber14 = $myrow14[1];
				$date14 = $myrow14[2];
				$debitamt14 = $myrow14[3];
				$creditamt14 = $myrow14[4];
				$salesamtdebitamt = $salesamtdebitamt + $debitamt14;
				$salesamtcreditamt = $salesamtcreditamt + $creditamt14;
				}
			}
			$salesamtdebittot = $salesamtdebittot + $salesamtdebitamt;
			$salesamtcredittot = $salesamtcredittot + $salesamtcreditamt;

			// generate marginal cost
			$result15=""; $found15=0; $ctr15=0;
			$result15 = mysql_query("SELECT disbursementid, disbursementnumber, date, debitamt, creditamt FROM tblfindisbursement WHERE projcode=\"$proj_code11\" AND (date>=\"$datefrom\" AND date<=\"$dateto\") AND ((glcode>=\"60.20.000\" AND glcode<=\"60.99.999\") OR (glcode>=\"70.20.000\" AND glcode<=\"70.99.999\"))", $dbh);
			if($result15 != "") {
				while($myrow15 = mysql_fetch_row($result15)) {
				$found15 = 1;
				$disbursementid15 = $myrow15[0];
				$disbursementnumber15 = $myrow15[1];
				$date15 = $myrow15[2];
				$debitamt15 = $myrow15[3];
				$creditamt15 = $myrow15[4];
				$marginalcostdebitamt = $marginalcostdebitamt + $debitamt15;
				$marginalcostcreditamt = $marginalcostcreditamt + $creditamt15;
				}
			}
			$result15b=""; $found15b=0; $ctr15b=0;
			$result15b = mysql_query("SELECT journalid, journalnumber, date, debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$proj_code11\" AND (date>=\"$datefrom\" AND date<=\"$dateto\") AND ((glcode>=\"60.20.000\" AND glcode<=\"60.99.999\") OR (glcode>=\"70.20.000\" AND glcode<=\"70.99.999\"))", $dbh);
			if($result15b != "") {
				while($myrow15b = mysql_fetch_row($result15b)) {
				$found15b = 1;
				$journalid15b = $myrow15b[0];
				$journalnumber15b = $myrow15b[1];
				$date15b = $myrow15b[2];
				$debitamt15b = $myrow15b[3];
				$creditamt15b = $myrow15b[4];
				$marginalcostdebitamt = $marginalcostdebitamt + $debitamt15b;
				$marginalcostcreditamt = $marginalcostcreditamt + $creditamt15b;
				}
			}
			// $marginalcostdebittot = $marginalcostdebittot + $marginalcostdebitamt;
			// $marginalcostcredittot = $marginalcostcredittot + $marginalcostcreditamt;
			$marginalcost = $marginalcostdebitamt - $marginalcostcreditamt;
			$marginalcosttot = $marginalcosttot + $marginalcost;
			// echo "<td align=\"right\">".number_format($marginalcostdebitamt, 2)."|$marginalcostcreditamt</td>";
			// echo "<td align=\"right\">$marginalcostdebitamt|$marginalcostcreditamt<br>".number_format($marginalcost, 2)."</td>";

			// compute marginal profit
			// $marginalprofit = $salesamtdebitamt - $marginalcostdebitamt;
			$marginalprofit = $salesamtdebitamt - $marginalcost;
			$marginalprofittot = $marginalprofittot + $marginalprofit;

			// compute personnel cost
			$result16=""; $found16=0; $ctr16=0;
			$result16 = mysql_query("SELECT disbursementid, disbursementnumber, date, debitamt, creditamt FROM tblfindisbursement WHERE projcode=\"$proj_code11\" AND (date>=\"$datefrom\" AND date<=\"$dateto\") AND ((glcode>=\"60.10.000\" AND glcode<=\"60.15.102\") OR (glcode>=\"70.10.000\" AND glcode<=\"70.15.102\"))", $dbh);
			if($result16 != "") {
				while($myrow16 = mysql_fetch_row($result16)) {
				$found16 = 1;
				$disbursementid16 = $myrow16[0];
				$disbursementnumber16 = $myrow16[1];
				$date16 = $myrow16[2];
				$debitamt16 = $myrow16[3];
				$creditamt16 = $myrow16[4];
				$personnelcostdebitamt = $personnelcostdebitamt + $debitamt16;
				$personnelcostcreditamt = $personnelcostcreditamt + $creditamt16;
				}
			}
			$result16b=""; $found16b=0; $ctr16b=0;
			$result16b = mysql_query("SELECT journalid, journalnumber, date, debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$proj_code11\" AND (date>=\"$datefrom\" AND date<=\"$dateto\") AND ((glcode>=\"60.10.000\" AND glcode<=\"60.15.102\") OR (glcode>=\"70.10.000\" AND glcode<=\"70.15.102\"))", $dbh);
			if($result16b != "") {
				while($myrow16b = mysql_fetch_row($result16b)) {
				$found16b = 1;
				$disbursementid16b = $myrow16b[0];
				$disbursementnumber16b = $myrow16b[1];
				$date16b = $myrow16b[2];
				$debitamt16b = $myrow16b[3];
				$creditamt16b = $myrow16b[4];
				$personnelcostdebitamt = $personnelcostdebitamt + $debitamt16b;
				$personnelcostcreditamt = $personnelcostcreditamt + $creditamt16b;
				}
			}
			// $personnelcostdebittot = $personnelcostdebittot + $personnelcostdebitamt;
			// $personnelcostcredittot = $personnelcostcredittot + $personnelcostcreditamt;
			$personnelcost = $personnelcostdebitamt - $personnelcostcreditamt;
			$personnelcosttot = $personnelcosttot + $personnelcost;
			// echo "<td align=\"right\">".number_format($personnelcostdebitamt, 2)."|$personnelcreditamt</td>";
			// echo "<td align=\"right\">$personnelcostdebitamt|$personnelcostcreditamt<br>".number_format($personnelcost, 2)."</td>";

			// compute direct profit
			// $directprofit = $marginalprofit - $personnelcostdebitamt;
			$directprofit = $marginalprofit - $personnelcost;
			$directprofittot = $directprofittot + $directprofit;

			// query country name
			$result17=""; $found17=0; $ctr17=0;
			$result17 = mysql_query("SELECT cname FROM tblcountrycd WHERE letter2cd=\"$countrycd11\"", $dbh);
			if($result17 != "") {
				while($myrow17 = mysql_fetch_row($result17)) {
				$found17 = 1;
				$cname17 = $myrow17[0];
				}
			}

			// query job type name
			$result18=""; $found18=0; $ctr18=0;
			$result18 = mysql_query("SELECT name_j, name_e FROM tblprojjobtypref WHERE code=\"$jobtypcd11\"", $dbh);
			if($result18 != "") {
				while($myrow18 = mysql_fetch_row($result18)) {
				$found18 = 1;
				$name_j18 = $myrow18[0];
				$name_e18 = $myrow18[1];
				}
			}

			// query division code name
			$result19=""; $found19=0; $ctr19=0;
			$result19 = mysql_query("SELECT name_j, name_e FROM tblprojdivisionref WHERE code=\"$divisioncd11\"", $dbh);
			if($result19 != "") {
				while($myrow19 = mysql_fetch_row($result19)) {
				$found19 = 1;
				$name_j19 = $myrow19[0];
				$name_e19 = $myrow19[1];
				}
			}

			//
			// display records here...
			//
		if($salesamtdebitamt!=0 || $marginalcost!=0 || $marginalprofit!=0 || $personnelcost!=0 || $directprofit!=0 || $salesamtdebitamt!=0) {
			echo "<tr><td align=\"right\">$ctr11</td><td><a href=\"finrptdirectprofitprojdetails.php?loginid=$loginid&prjcd=$proj_code11&fr=$datefrom&to=$dateto\" target=\"_blank\">$proj_code11</a></td>";
			// display project name
			if($proj_sname11 != "") { echo "<td><a href=\"finrptdirectprofitprojdetails.php?loginid=$loginid&prjcd=$proj_code11&fr=$datefrom&to=$dateto\" target=\"_blank\">$proj_sname11</a></td>"; }
			else { echo "<td><a href=\"finrptdirectprofitprojdetails.php?loginid=$loginid&prjcd=$proj_code11&fr=$datefrom&to=$dateto\" target=\"_blank\">".substr($proj_fname11, 0 ,50)."</a></td>"; }
			// display project relationship
			echo "<td>";
		if(($proj_relation011 != "") || ($proj_relation011 != "-")) {
			if(($proj_relation111 != "") || ($proj_relation111 != "-")) {
				$result6=""; $found6=0;
				$result6 = mysql_query("SELECT name FROM tblprojrelref WHERE code=\"$proj_relation111\" AND level=1", $dbh);
				if($result6 != "") {
					while($myrow6 = mysql_fetch_row($result6)) {
					$found6 = 1;
					$name6 = $myrow6[0];
					}
				}
				if($proj_relation011 == "others") { echo ucwords($proj_relation011) . " - $name6"; }

				if(($proj_relation211 != "") || ($proj_relation211 != "-")) {
					$result7=""; $found7=0;
					$result7 = mysql_query("SELECT name FROM tblprojrelref WHERE code=\"$proj_relation211\" AND level=2 LIMIT 1", $dbh);
					if($result7 != "") {
						while($myrow7 = mysql_fetch_row($result7)) {

						$found7=1;
						$name7 = $myrow7[0];
						echo "$name7";
						}
					}

					if(($proj_relation311 != "") || ($proj_relation311 != "-")) {
						$result8=""; $found8=0;
						$result8 = mysql_query("SELECT name FROM tblprojrelref WHERE code=\"$proj_relation311\" AND level=3 LIMIT 1", $dbh);
						if($result8 != "") {
							while($myrow8 = mysql_fetch_row($result8)) {
							$found8 = 1;
							$name8 = $myrow8[0];
							echo " - $name8";
							}
						}
					}
				}
			}
		}
			echo "</td>";
			// display client
			echo "<td>";
		if((($companyid11!="") || ($companyid11!=0)) && (($contactid11=="") || ($contactid11==0))) {
			$result11a=""; $found11a=0; $ctr11a=0;
			$result11a = mysql_query("SELECT company, branch FROM tblcompany WHERE companyid=$companyid11", $dbh);
			if($result11a != "") {
				while($myrow11a = mysql_fetch_row($result11a)) {
				$found11a = 1;
				$company11a = $myrow11a[0];
				$branch11a = $myrow11a[1];
				}
			}
			$company11afin = $company11a;
			if($branch11a!="") { $company11afin = $company11a . " - " . $branch11a; }
			echo "$company11afin";
		}
		if((($contactid11!="") || ($contactid11!=0)) && (($companyid11=="") || ($companyid11==0))) {
			$result11b=""; $found11b=0; $ctr11b=0;
			$result11b = mysql_query("SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid11", $dbh);
			if($result11b != "") {
				while($myrow11b = mysql_fetch_row($result11b)) { 
				$found11b = 1;
				$companyid11b = $myrow11b[0];
				$employeeid11b = $myrow11b[1];
				$name_last11b = $myrow11b[2];
				$name_first11b = $myrow11b[3];
				$name_middle11b = $myrow11b[4];
				}
			}
			$contactname11bfin = $name_first11b;
			if($name_middle11b != "") { $contactname11bfin = $contactname11bfin . "&nbsp;" . $name_middle11b[0] . "."; }
			if($name_last11b != "") { $contactname11bfin = $contactname11bfin . "&nbsp;" . $name_last11b; }
			echo "$contactname11bfin";
		}
		if((($companyid11=="") && ($contactid11=="")) || (($companyid11==0) && ($contactid11==0))) {
			echo "";
		}
			echo "</td>";
			// display sales amount
			if($salesamtdebitamt != 0) {
			echo "<td align=\"right\">".number_format($salesamtdebitamt, 2)."</td>";
			} else { echo "<td></td>"; }
			// display marginal cost
			if($marginalcost != 0) {
			echo "<td align=\"right\">".number_format($marginalcost, 2)."</td>";
			} else { echo "<td></td>"; }
			// display marginal profit
			if($marginalprofit != 0) {
			echo "<td align=\"right\">".number_format($marginalprofit, 2)."</td>";
			} else { echo "<td></td>"; }
			// compute and display marginal profit percentage
			if($salesamtdebitamt != 0) {
			$marginalprofitpercentage = ($marginalprofit / $salesamtdebitamt) * 100;
			echo "<td align=\"right\">".number_format($marginalprofitpercentage, 2)."%</td>";
			} else { echo "<td></td>"; }
			// display personnel cost
			if($personnelcost != 0) {
			echo "<td align=\"right\">".number_format($personnelcost, 2)."</td>";
			} else { echo "<td></td>"; }
			// display direct profit
			if($directprofit != 0) {
			echo "<td align=\"right\">".number_format($directprofit, 2)."</td>";
			} else { echo "<td></td>"; }
			// compute and display direct profit percentage
			if($salesamtdebitamt != 0) {
			$directprofitpercentage = ($directprofit / $salesamtdebitamt) * 100;
			echo "<td align=\"right\">".number_format($directprofitpercentage, 2)."%</td>";
			} else { echo "<td></td>"; }
			// display country
			if($cname17 != "") { echo "<td>$cname17</td>"; } else { echo "<td>$countrycd17</td>"; }
			// display job type
			if($name_e18 != "") { echo "<td>$name_e18</td>"; } else { echo "<td>$jobtypcd11</td>"; }
			// display division code
			if($name_e19 != "") { echo "<td>$name_e19</td>"; } else { echo "<td>$divisioncd11</td>"; }
			echo "</tr>";
		}

			// reset variables
			$salesamtdebitamt=0; $salesamtcreditamt=0;
			$marginalcostdebitamt=0; $marginalcostcreditamt=0;
			$personnelcostdebitamt=0; $personnelcostcreditamt=0;
			$company11a=""; $branch11a=""; $company11afin="";
			$employeeid11b=""; $name_last11b=""; $name_first11b=""; $name_middle11b=""; $contactname11bfin="";
			$cname17=""; $name_j18=""; $name_e18=""; $name_j19=""; $name_e19="";
			} // while
		} // if

		echo "<tr><th colspan=\"5\">Total</th><th>".number_format($salesamtdebittot, 2)."</th><th>".number_format($marginalcosttot, 2)."</th><th>".number_format($marginalprofittot, 2)."</th><th></th><th>".number_format($personnelcosttot, 2)."</th><th>".number_format($directprofittot, 2)."</th><th colspan=\"4\"></th></tr>";
	// echo "<tr><td colspan=\"14\">f11:$found11,res11qry:$res11query</td></tr>";
		echo "</table>";
    echo "</td></tr>";
	} // if

    echo "</table>";

	echo "</td></tr>";
	echo "</table>";

    echo "<p><a href=\"finrptmnu.php?loginid=$loginid\">Back</a></p>";

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>