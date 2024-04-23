<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$yrmonthavlbl = (isset($_POST['yrmonthavlbl'])) ? $_POST['yrmonthavlbl'] :'';

// if($yrmonthavlbl == "") { $yrmonthavlbl = $yearnow." ". date("F", strtotime($monthnow)); }

if($yrmonthavlbl == "") {
	// $mmcutstart="1980-01-01"; $mmcutend="1980-01-01";
	$yrmoavchsel="selected";
} else {
	$yrmoavchsel="";
	$arryyyymonth = split(" ", $yrmonthavlbl);
	$arryyyy = $arryyyymonth[0];
	$arrmonth = $arryyyymonth[1];
	// $arrmm = date('m', strtotime($arrmonth));
	if($arrmonth=='January') { $arrmm="01"; }
	else if($arrmonth=='February') { $arrmm="02"; }
	else if($arrmonth=='March') { $arrmm="03"; }
	else if($arrmonth=='April') { $arrmm="04"; }
	else if($arrmonth=='May') { $arrmm="05"; }
	else if($arrmonth=='June') { $arrmm="06"; }
	else if($arrmonth=='July') { $arrmm="07"; }
	else if($arrmonth=='August') { $arrmm="08"; }
	else if($arrmonth=='September') { $arrmm="09"; }
	else if($arrmonth=='October') { $arrmm="10"; }
	else if($arrmonth=='November') { $arrmm="11"; }
	else if($arrmonth=='December') { $arrmm="12"; }
	$yyyymm = $arryyyy . "-" . $arrmm;
	$mmcutstart = $yyyymm . "-" . "01";
	$mmcutend = date("Y-m-t", strtotime($mmcutstart)); 

}

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
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
// start contents here

    echo "<table class=\"fin2\" border=\"1\">";
    echo "<tr>";
    echo "<form action=\"finrptcshdisbbk.php?loginid=$loginid\" method=\"post\" name=\"finrptcshdisbbk\"><div class='form-inline'><div class='form-group'>";
    echo "<td colspan=\"2\">";
    echo "<select name=\"yrmonthavlbl\" class='form-control'>";
    echo "<option value='' $yrmoavchsel>Year-Month</option>";

    $result11 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfindisbursement WHERE disbursementid <> '' ORDER BY date DESC", $dbh);
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $yyyymonth = $myrow11[0];

      if($yrmonthavlbl == "$yyyymonth") { $yrmonthsel = "selected"; }
      else { $yrmonthsel = ""; }

      echo "<option value=\"$yyyymonth\" $yrmonthsel>$yyyymonth</option>";
    }
    echo "</select>";

    echo "<button type=\"submit\" class='btn btn-primary'>Submit</button></td></div></div></form>";
    echo "</tr>";
		echo "</table>";

		echo "<table id=\"ReportTable\" class=\"fin2\">";
		echo "<tr><th colspan=\"2\" align=\"left\">Philkoei International Inc.</th></tr>";
		echo "<tr><th colspan=\"2\" align=\"left\">Cash Disbursement Book <a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a></th></tr>";
		echo "<tr><th colspan=\"2\" align=\"left\">For the month of $yrmonthavlbl </th></tr>";
    echo "<tr><td colspan=\"2\">";
    echo "<table width=\"100%\" class=\"fin2\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><th colspan=\"4\"></th><th colspan=\"2\">Cash in Bank-BPI</th><th colspan=\"2\">Mizuho-USD$</th><th colspan=\"3\">Advances to Client</th><th></th><th colspan=\"2\">Advances for Liquidation</th><th colspan=\"3\">Gen. & Adm. Expense</th><th colspan=\"3\">Direct Cost</th><th colspan=\"3\">Other Accounts</th></tr>";
    echo "<tr><th>Date</th><th>Ref</th><th>Payee</th><th>Particulars</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th><th>Project</th><th>Debit</th><th>Credit</th><th>InputVAT</th><th>Debit</th><th>Credit</th><th>AcctName</th><th>Debit</th><th>Credit</th><th>AcctName</th><th>Debit</th><th>Credit</th><th>AcctName</th><th>Debit</th><th>Credit</th></tr>";

		$result11=""; $found11=0;
		$result11 = mysql_query("SELECT tblfindisbursement.disbursementnumber, tblfindisbursement.payee, tblfindisbursement.date, tblfindisbursement.glcode, tblfindisbursement.glrefver, tblfindisbursement.projcode, tblfindisbursement.particulars, tblfindisbursement.debitamt, tblfindisbursement.creditamt, tblfindisbursement.companyid, tblfindisbursement.contactid, tblfindisbursementtot.explanation FROM tblfindisbursement LEFT JOIN tblfindisbursementtot ON tblfindisbursement.disbursementnumber=tblfindisbursementtot.disbursementnumber WHERE (tblfindisbursement.date >= \"$mmcutstart\" AND tblfindisbursement.date <= \"$mmcutend\") GROUP BY tblfindisbursement.disbursementnumber ORDER BY tblfindisbursement.date ASC, tblfindisbursement.disbursementnumber ASC", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$disbursementnumber11 = $myrow11[0];
			$payee11 = $myrow11[1];
			$date11 = $myrow11[2];
			$glcode11 = $myrow11[3];
			$glrefver11 = $myrow11[4];
			$projcode11 = $myrow11[5];
			$particulars11 = $myrow11[6];
			$debitamt11 = $myrow11[7];
			$creditamt11 = $myrow11[8];
			$companyid11 = $myrow11[9];
			$contactid11 = $myrow11[10];
			$explanation11 = $myrow11[11];
			$explanationfin = str_replace("'", "", $explanation11);

			echo "<tr>";
			echo "<td>".date("d-M-y", strtotime($date11))."</td><td>$disbursementnumber11</td><td>";
			// echo "$payee11";
		if((($companyid11!="") || ($companyid11!=0)) && (($contactid11=="") || ($contactid11==0))) {
			$result15a=""; $found15a=0; $ctr15a=0;
			$result15a = mysql_query("SELECT company, branch FROM tblcompany WHERE companyid=$companyid11", $dbh);
			if($result15a != "") {
				while($myrow15a = mysql_fetch_row($result15a)) {
				$found15a = 1;
				$company15a = $myrow15a[0];
				$branch15a = $myrow15a[1];
				}
			}
			$company15afin = str_replace("'", "", $company15a);
			if($branch15a!="") { $company15afin = $company15a . " - " . $branch15a; }
			echo "$company15afin";
		}
		if((($contactid11!="") || ($contactid11!=0)) && (($companyid11=="") || ($companyid11==0))) {
			$result15b=""; $found15b=0; $ctr15b=0;
			$result15b = mysql_query("SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid11", $dbh);
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
			$contactname15bfin = str_replace("'", "", $name_first15b);
			if($name_middle15b != "") { $contactname15bfin = $contactname15bfin . " " . mysql_real_escape_string($name_middle15b[0]) . "."; }
			if($name_last15b != "") { $contactname15bfin = $contactname15bfin . " " . mysql_real_escape_string($name_last15b); }
        // $contactname15bfin = utf8_decode($contactname15bfin);
			echo "$contactname15bfin";
		}
		if((($companyid11=="") && ($contactid11=="")) || (($companyid11==0) && ($contactid11==0))) {
			echo "$payee11";
		}

			echo "</td><td>$explanationfin</td>";

			// cash in bank - debit side
			echo "<td align=\"right\">";
			$result12=""; $found12=0;
			$result12 = mysql_query("SELECT glcode, projcode, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND (glcode>=\"10.10.121.A\" AND glcode<=\"10.10.121.B\") AND glrefver=2", $dbh);
			if($result12 != "") {
				while($myrow12 = mysql_fetch_row($result12)) {
				$found12 = 1;
				$glcode12 = $myrow12[0];
				$projcode12 = $myrow12[1];
				$debitamt12 = $myrow12[2];
				$creditamt12 = $myrow12[3];
				$debitamt12tot = $debitamt12tot + $debitamt12;
				// $creditamt12tot = $creditamt12tot + $creditamt12;
				echo "".number_format($debitamt12, 2)."<br>";
				}
			}
			echo "</td>";

			// cash in bank - credit side
			echo "<td align=\"right\">";
			$result12b=""; $found12b=0;
			$result12b = mysql_query("SELECT glcode, projcode, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND (glcode>=\"10.10.121.A\" AND glcode<=\"10.10.121.B\") AND glrefver=2", $dbh);
			if($result12b != "") {
				while($myrow12b = mysql_fetch_row($result12b)) {
				$found12b = 1;
				$glcode12b = $myrow12b[0];
				$projcode12b = $myrow12b[1];
				$debitamt12b = $myrow12b[2];
				$creditamt12b = $myrow12b[3];
				// $debitamt12tot = $debitamt12tot + $debitamt12b;
				$creditamt12tot = $creditamt12tot + $creditamt12b;
				echo "".number_format($creditamt12b, 2)."<br>";
				}
			}
			echo "</td>";

			// mizuho usd - debit side
			echo "<td align=\"right\">";
			$result14=""; $found14=0;
			$result14 = mysql_query("SELECT glcode, projcode, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND glcode=\"10.10.124.C\" AND glrefver=2", $dbh);
			if($result14 != "") {
				while($myrow14 = mysql_fetch_row($result14)) {
				$found14 = 1;
				$glcode14 = $myrow14[0];
				$projcode14 = $myrow14[1];
				$debitamt14 = $myrow14[2];
				$creditamt14 = $myrow14[3];
				$debitamt14tot = $debitamt14tot + $debitamt14;
				// $creditamt14tot = $creditamt14tot + $creditamt14;
				echo "".number_format($debitamt14, 2)."<br>";
				// echo "".number_format($creditamt14,2)."<br>";
				}
			}
			echo "</td>";

			// mizuho usd - credit side
			echo "<td align=\"right\">";
			$result14b=""; $found14b=0;
			$result14b = mysql_query("SELECT glcode, projcode, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND glcode=\"10.10.124.C\" AND glrefver=2", $dbh);
			if($result14b != "") {
				while($myrow14b = mysql_fetch_row($result14b)) {
				$found14b = 1;
				$glcode14b = $myrow14b[0];
				$projcode14b = $myrow14b[1];
				$debitamt14b = $myrow14b[2];
				$creditamt14b = $myrow14b[3];
				// $debitamt14tot = $debitamt14tot + $debitamt14b;
				$creditamt14tot = $creditamt14tot + $creditamt14b;
				// echo "".number_format($debitamt14b, 2)."<br>";
				echo "".number_format($creditamt14b,2)."<br>";
				}
			}
			echo "</td>";

			// advances to client
			echo "<td colspan=\"3\">";
			echo "<table width=\"100%\" class=\"fin2\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			$result15=""; $found15=0;
			$result15 = mysql_query("SELECT glcode, projcode, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND glcode=\"10.10.404\" AND glrefver=2", $dbh);
			if($result15 != "") {
				while($myrow15 = mysql_fetch_row($result15)) {
				$found15 = 1;
				$glcode15 = $myrow15[0];
				$projcode15 = $myrow15[1];
				$debitamt15 = $myrow15[2];
				$creditamt15 = $myrow15[3];
				$debitamt15tot = $debitamt15tot + $debitamt15;
				$creditamt15tot = $creditamt15tot + $creditamt15;
			echo "<tr>";
			if($projcode15 != "" || $projcode15 != "-") {
		$result19=""; $found19=0;
    $result19 = mysql_query("SELECT proj_fname, proj_sname FROM tblproject1 WHERE proj_code=\"$projcode15\"", $dbh);
    while($myrow19 = mysql_fetch_row($result19))
    {
      $found19 = 1;
      $proj_fname19 = $myrow19[0];
      $proj_sname19 = $myrow19[1];
    }
    if($proj_sname19 == '')
    {
      $proj_sname19 =  substr($proj_fname19, 0, 35);
    }
			echo "<td>$proj_sname19</td>";
			} else { echo "<td></td>"; }
			// clear proj_sname19 value
			$proj_sname19="";
			echo "<td align=\"right\">";
				echo "".number_format($debitamt15, 2)."";
			echo "</td>";
			echo "<td align=\"right\">";
				echo "".number_format($creditamt15,2)."";
			echo "</td>";
			echo "</tr>";
				}
			}
			echo "</td>";
			echo "</table>";
			echo "</td>";

			// Input VAT
			echo "<td align=\"right\">";
			$result16=""; $found16=0;
			$result16 = mysql_query("SELECT glcode, projcode, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND glcode=\"10.10.467\" AND glrefver=2", $dbh);
			if($result16 != "") {
				while($myrow16 = mysql_fetch_row($result16)) {
				$found16 = 1;
				$glcode16 = $myrow16[0];
				$projcode16 = $myrow16[1];
				$debitamt16 = $myrow16[2];
				$creditamt16 = $myrow16[3];
				$creditamt16 = 0 - $creditamt16;
				$debitamt16tot = $debitamt16tot + $debitamt16;
				$creditamt16tot = $creditamt16tot + $creditamt16;
				// if($debitamt16 != 0) { echo "".number_format($debitamt16, 2)."<br>"; }
				// else if($creditamt16 != 0) { echo "".number_format($creditamt16, 2)."<br>"; }
				// echo "".number_format($creditamt16,2)."<br>";
				$amt16 = $debitamt16+$creditamt16;
				echo "".number_format($amt16, 2)."<br>";
				}
			}
			echo "</td>";
			$amt16tot = $debitamt16tot+$creditamt16tot;

			// Advances for Liquidation - debit side
			echo "<td align=\"right\">";
			$result17=""; $found17=0;
			$result17 = mysql_query("SELECT glcode, projcode, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND glcode=\"10.10.401\" AND glrefver=2", $dbh);
			if($result17 != "") {
				while($myrow17 = mysql_fetch_row($result17)) {
				$found17 = 1;
				$glcode17 = $myrow17[0];
				$projcode17 = $myrow17[1];
				$debitamt17 = $myrow17[2];
				$creditamt17 = $myrow17[3];
				$debitamt17tot = $debitamt17tot + $debitamt17;
				// $creditamt17tot = $creditamt17tot + $creditamt17;
				echo "".number_format($debitamt17, 2)."<br>";
				// echo "".number_format($creditamt17,2)."<br>";
				}
			}
			echo "</td>";

			// Advances for Liquidation - credit side
			echo "<td align=\"right\">";
			$result17b=""; $found17b=0;
			$result17b = mysql_query("SELECT glcode, projcode, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND glcode=\"10.10.401\" AND glrefver=2", $dbh);
			if($result17b != "") {
				while($myrow17b = mysql_fetch_row($result17b)) {
				$found17b = 1;
				$glcode17b = $myrow17b[0];
				$projcode17b = $myrow17b[1];
				$debitamt17b = $myrow17b[2];
				$creditamt17b = $myrow17b[3];
				// $debitamt17tot = $debitamt17tot + $debitamt17b;
				$creditamt17tot = $creditamt17tot + $creditamt17b;
				// echo "".number_format($debitamt17b, 2)."<br>";
				echo "".number_format($creditamt17b,2)."<br>";
				}
			}
			echo "</td>";

			// GAE
			echo "<td colspan=\"3\" align=\"right\">";
			echo "<table width=\"100%\" class=\"fin2\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			$result18=""; $found18=0;
			$result18 = mysql_query("SELECT glcode, projcode, particulars, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND (glcode>=\"70.00.000\" AND glcode<=\"70.99.999\") AND glrefver=2", $dbh);
			if($result18 != "") {
				while($myrow18 = mysql_fetch_row($result18)) {
				$found18 = 1;
				$glcode18 = $myrow18[0];
				$projcode18 = $myrow18[1];
				$particulars18 = $myrow18[2];
				$debitamt18 = $myrow18[3];
				$creditamt18 = $myrow18[4];
				$debitamt18tot = $debitamt18tot + $debitamt18;
				$creditamt18tot = $creditamt18tot + $creditamt18;
				echo "<tr>";
				echo "<td>".str_replace("'", "", $particulars18)."</td><td align=\"right\">".number_format($debitamt18, 2)."</td>";
				echo "<td align=\"right\">".number_format($creditamt18, 2)."</td>";
				echo "</tr>";
				}
			}
			echo "</table>";
			echo "</td>";

			// DC
			echo "<td colspan=\"3\" align=\"right\">";
			echo "<table width=\"100%\" class=\"fin2\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			$result19=""; $found19=0;
			$result19 = mysql_query("SELECT glcode, projcode, particulars, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND (glcode>=\"60.00.000\" AND glcode<=\"60.99.999\") AND glrefver=2", $dbh);
			if($result19 != "") {
				while($myrow19 = mysql_fetch_row($result19)) {
				$found19 = 1;
				$glcode19 = $myrow19[0];
				$projcode19 = $myrow19[1];
				$particulars19 = $myrow19[2];
				$debitamt19 = $myrow19[3];
				$creditamt19 = $myrow19[4];
				$debitamt19tot = $debitamt19tot + $debitamt19;
				$creditamt19tot = $creditamt19tot + $creditamt19;
				echo "<tr>";
				echo "<td>".str_replace("'", "", $particulars19)."</td><td align=\"right\">".number_format($debitamt19, 2)."</td>";
				echo "<td align=\"right\">".number_format($creditamt19, 2)."</td>";
				echo "</tr>";
				}
			}
			echo "</table>";
			echo "</td>";

			// Other Accounts
			echo "<td colspan=\"3\" align=\"right\">";
			echo "<table width=\"100%\" class=\"fin2\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			$result20=""; $found20=0;
			$result20 = mysql_query("SELECT glcode, projcode, particulars, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND ((glcode>=\"10.00.000\" AND glcode<=\"10.10.119\") OR (glcode>=\"10.10.120\" AND glcode<=\"10.10.121\") OR (glcode>=\"10.10.121.C\" AND glcode<=\"10.10.124.B\") OR (glcode>=\"10.10.124.D\" AND glcode<=\"10.10.400\") OR (glcode>=\"10.10.402\" AND glcode<=\"10.10.403\") OR (glcode>=\"10.10.405\" AND glcode<=\"10.10.466\") OR (glcode>=\"10.20.000\" AND glcode<=\"50.99.999\") OR (glcode>=\"71.00.000\" AND glcode<=\"99.99.999\")) AND glrefver=2 ORDER BY glcode ASC", $dbh);
			if($result20 != "") {
				while($myrow20 = mysql_fetch_row($result20)) {
				$found20 = 1;
				$glcode20 = $myrow20[0];
				$projcode20 = $myrow20[1];
				$particulars20 = $myrow20[2];
				$debitamt20 = $myrow20[3];
				$creditamt20 = $myrow20[4];
				$debitamt20tot = $debitamt20tot + $debitamt20;
				$creditamt20tot = $creditamt20tot + $creditamt20;
				echo "<tr>";
				echo "<td>".str_replace("'", "", $particulars20)."</td><td align=\"right\">".number_format($debitamt20, 2)."</td>";
				echo "<td align=\"right\">".number_format($creditamt20, 2)."</td>";
				echo "</tr>";
				}
			}

			echo "</table>";
			echo "</td>";

			// echo "<th>AcctName</th><th>Others-dr</th><th>Others-cr</th>";
			echo "</tr>";
			}
		}
			$debitgrandtot = $debitamt12tot+$debitamt14tot+$debitamt15tot+$debitamt16tot+$debitamt17tot+$debitamt18tot+$debitamt19tot+$debitamt20tot;
			$creditgrandtot = $creditamt12tot+$creditamt14tot+$creditamt15tot+$creditamt16tot+$creditamt17tot+$creditamt18tot+$creditamt19tot+$creditamt20tot;


    echo "<tr><th colspan=\"4\" align=\"right\">Total</th><th align=\"right\">".number_format($debitamt12tot, 2)."</th><th align=\"right\">".number_format($creditamt12tot, 2).
"</th>";
		echo "<th align=\"right\">".number_format($debitamt14tot, 2)."</th><th align=\"right\">".number_format($creditamt14tot, 2).
"</th>";
		echo "<th></th><th align=\"right\">".number_format($debitamt15tot, 2)."</th><th align=\"right\">".number_format($creditamt15tot, 2).
"</th>";
		echo "<th align=\"right\">".number_format($amt16tot, 2)."</th>";
		// echo "<th align=\"right\">$amt16tot|$amt16totfin</th>";
		echo "<th align=\"right\">".number_format($debitamt17tot, 2)."</th><th align=\"right\">".number_format($creditamt17tot, 2).
"</th>";
		echo "<th></th><th align=\"right\">".number_format($debitamt18tot, 2)."</th><th align=\"right\">".number_format($creditamt18tot, 2).
"</th>";
		echo "<th></th><th align=\"right\">".number_format($debitamt19tot, 2)."</th><th align=\"right\">".number_format($creditamt19tot, 2).
"</th>";
		echo "<th></th><th align=\"right\">".number_format($debitamt20tot, 2)."</th><th align=\"right\">".number_format($creditamt20tot, 2).
"</th>";
		echo "</tr>";

		echo "<tr><th colspan=\"4\" align=\"right\">Grand-total</th>";
		echo "<th align=\"right\">".number_format($debitgrandtot, 2)."</th>";
		echo "<th align=\"right\">".number_format($creditgrandtot, 2)."</th>";
		echo "<td colspan=\"17\"></td></tr>";

    echo "</table>";
    echo "</td></tr>";
    echo "</table>";

    echo "<p><a href=\"finrptmnu.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery);; 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
