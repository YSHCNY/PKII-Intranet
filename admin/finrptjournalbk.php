<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$yrmonthavlbl = (isset($_POST['yrmonthavlbl'])) ? $_POST['yrmonthavlbl'] :'';

// if($yrmonthavlbl == "") { $yrmonthavlbl = $yearnow." ". date("F", strtotime($monthnow)); }

if($yrmonthavlbl == "") {
	$mmcutstart="1980-01-01"; $mmcutend="1980-01-01";
} else {

	$arryyyymonth = split(' ', $yrmonthavlbl);
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

<style>
	th, td{
		padding: 10px 5px 10px 5px !important;
	}
</style>

<div class="container p-5">
<?php
// start contents here
echo"<div class = 'mb-5 mt-2'>";
echo "<p class='fs-3 fw-bold mb-0'>Philkoei International, Inc.</p>";
echo "<p class='fs-4 text-muted'><i>Journal Book</i></p>";

echo "</div>";


    echo "<form class=\"d-flex gap-3\" ptjournalbk.php?loginid=$loginid\" method=\"post\">";

    echo "<select name=\"yrmonthavlbl\" class='form-control'>";
    echo "<option>Year-Month</option>";

    $res11query=""; $result11=""; $found11=0;
    $res11query = "SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfinjournal WHERE journalid <> '' ORDER BY date DESC";
    $result11=$dbh2->query($res11query);;
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
      $found11 = 1;
      $yyyymonth = $myrow11['yyyymonth'];

      if($yrmonthavlbl == "$yyyymonth") { $yrmonthsel = "selected"; }
      else { $yrmonthsel = ""; }

      echo "<option value=\"$yyyymonth\" >$yyyymonth</option>"; //$yrmonthsel
        } //while
    } //if

    echo "</select>";

    echo "<button type=\"submit\" class='btn btn-primary'>Submit</button></td>";
	echo "<a href = '#' id = 'exportToExcel' class='btn btn-success'>Excel</a></td>";
	echo "</form>";
	
	echo "<p class='text-start mt-5 mb-2 '>Displaying Entries from <span class = 'fw-bold'> $yrmonthavlbl</span></p>";
		echo "<table id=\"ReportTable\" class=\"table-bordered table-striped \">";
		echo "<tr><th colspan='2'>Philkoei International, Inc.</th></tr>";
                echo "<tr><th colspan='2' class='fs-4 text-muted'><i>Journal Book</i></th></tr>";
                echo "<tr><th colspan='2'>For the month of $yrmonthavlbl</th></tr>";
    echo "<tr><td colspan=\"2\">";
    echo "<table width=\"100%\" class=\"table-striped table-hover\" >";
		echo "<tr><th colspan=\"3\"></th><th colspan=\"2\">Advances for Liquidation</th><th colspan=\"3\">AR Trade</th><th colspan=\"3\">Income</th><th colspan=\"2\">InputVAT</th><th colspan=\"3\">Advances to Client</th><th colspan=\"3\">Gen. & Adm. Expense</th><th colspan=\"3\">Direct Cost</th><th colspan=\"3\">Other Accounts</th></tr>";
    echo "<tr><th>Date</th><th>Ref</th><th>Particulars</th><th>Debit</th><th>Credit</th><th>Project</th><th>Debit</th><th>Credit</th><th>Project</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th><th>Project</th><th>Debit</th><th>Credit</th><th>AcctName</th><th>Debit</th><th>Credit</th><th>AcctName</th><th>Debit</th><th>Credit</th><th>AcctName</th><th>Debit</th><th>Credit</th></tr>";

		$res11query=""; $result11=""; $found11=0;
		$res11query = "SELECT journalnumber, date, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt, explanation FROM tblfinjournal WHERE (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") GROUP BY journalnumber ORDER BY date ASC, journalnumber ASC";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
			$found11 = 1;
			$journalnumber11 = $myrow11['journalnumber'];
			$date11 = $myrow11['date'];
			$glcode11 = $myrow11['glcode'];
			$glrefver11 = $myrow11['glrefver'];
			$glnamedetails11 = $myrow11['glnamedetails'];
			$projcode11 = $myrow11['projcode'];
			$particulars11 = $myrow11['particulars'];
			$debitamt11 = $myrow11['debitamt'];
			$creditamt11 = $myrow11['creditamt'];
			$explanation11 = $myrow11['explanation'];
			$explanationfin = str_replace("'", "", $explanation11);

			echo "<tr>";
			echo "<td>".date("d-M-y", strtotime($date11))."</td><td>$journalnumber11</td><td>".str_replace("'", "", $explanationfin)."</td>";

			// Advances for Liquidation - Debit
			echo "<td align=\"right\">";
        // new table for AdvFLiqdn Debit side only
        echo "<table width=\"100%\" class=\"table-striped\" >";
			$res12query=""; $result12=""; $found12=0;
			$res12query = "SELECT glcode, projcode, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND glcode=\"10.10.401\" AND glrefver=2";
      $result12=$dbh2->query($res12query);
      if($result12->num_rows>0) {
          while($myrow12=$result12->fetch_assoc()) {
				$found12 = 1;
				$glcode12 = $myrow12['glcode'];
				$projcode12 = $myrow12['projcode'];
				$debitamt12 = $myrow12['debitamt'];
				$creditamt12 = $myrow12['creditamt'];
				$debitamt12tot = $debitamt12tot + $debitamt12;
				// $creditamt12tot = $creditamt12tot + $creditamt12;
				echo "<tr><td align=\"right\">".number_format($debitamt12, 2)."</td></tr>";
          } //while
      } //if

        echo "</table>";
			echo "</td>";

			// Advances for Liquidation - Credit
			echo "<td align=\"right\">";
        // new table for AdvFLiqdn Crebit side only
        echo "<table width=\"100%\" class=\"table-striped\" >";
			$res12bquery=""; $result12b=""; $found12b=0;
			$res12bquery = "SELECT glcode, projcode, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND glcode=\"10.10.401\" AND glrefver=2";
      $result12b=$dbh2->query($res12bquery);
      if($result12b->num_rows>0) {
          while($myrow12b=$result12b->fetch_assoc()) {
				$found12b = 1;
				$glcode12b = $myrow12b['glcode'];
				$projcode12b = $myrow12b['projcode'];
				$debitamt12b = $myrow12b['debitamt'];
				$creditamt12b = $myrow12b['creditamt'];
				// $debitamt12tot = $debitamt12tot + $debitamt12b;
				$creditamt12tot = $creditamt12tot + $creditamt12b;
				echo "<tr><td align=\"right\">".number_format($creditamt12b, 2)."</td></tr>";
          } //while
      } //if
        echo "</table>";
			echo "</td>";

			// AR Trade
			echo "<td colspan=\"3\">";
			echo "<table width=\"100%\" class=\"table-striped\" >";
			$res14query=""; $result14=""; $found14=0;
			// $result14 = mysql_query("SELECT glcode, projcode, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND (glcode>=\"10.10.300\" AND glcode<=\"10.10.305.1\") AND glrefver=2", $dbh);
			$res14query = "SELECT glcode, projcode, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND ((glcode=\"10.10.300\") OR (glcode>=\"10.10.301.1\" AND glcode<=\"10.10.305.1\")) AND glrefver=2";
      $result14=$dbh2->query($res14query);
      if($result14->num_rows>0) {
          while($myrow14=$result14->fetch_assoc()) {
        $found14 = 1;
				$glcode14 = $myrow14['glcode'];
				$projcode14 = $myrow14['projcode'];
				$debitamt14 = $myrow14['debitamt'];
				$creditamt14 = $myrow14['creditamt'];
				$debitamt14tot = $debitamt14tot + $debitamt14;
				$creditamt14tot = $creditamt14tot + $creditamt14;
				// echo "".number_format($debitamt14, 2)."<br>";
				// echo "".number_format($creditamt14,2)."<br>";
			echo "<tr>";
			if($projcode14 != "" || $projcode14 != "-") {
		$res19query=""; $result19=""; $found19=0;
    $res19query = "SELECT proj_fname, proj_sname FROM tblproject1 WHERE proj_code=\"$projcode14\"";
    $result19=$dbh2->query($res19query);
    if($result19->num_rows>0) {
        while($myrow19=$result19->fetch_assoc()) {
      $found19 = 1;
      $proj_fname19 = $myrow19['proj_fname'];
      $proj_sname19 = $myrow19['proj_sname'];
        } //while
    } //if
    if($proj_sname19 == '')
    {
      $proj_sname19 =  substr($proj_fname19, 0, 35);
    }
			echo "<td>".str_replace("'", "", $proj_sname19)."</td>";
			} else { echo "<td></td>"; }
			// clear proj_sname19 value
			$proj_sname19=""; $proj_fname19="";
			echo "<td align=\"right\">";
				echo "".number_format($debitamt14, 2)."";
			echo "</td>";
			echo "<td align=\"right\">";
				echo "".number_format($creditamt14,2)."";
			echo "</td>";
			echo "</tr>";
          } //while
      } //if

			echo "</table>";
			echo "</td>";
			/*
			echo "<td align=\"right\">";
			$result14b=""; $found14b=0;
			$result14b = mysql_query("SELECT glcode, projcode, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND (glcode>=\"10.10.300\" AND glcode<=\"10.10.305.1\") AND glrefver=2", $dbh);
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
			*/

			// Income
			echo "<td colspan=\"3\">";
			echo "<table width=\"100%\" class=\"table-striped\" >";
			$res15query=""; $result15=""; $found15=0;
			$res15query = "SELECT glcode, projcode, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND glcode=\"40.10.000\" AND glrefver=2";
      $result15=$dbh2->query($res15query);
      if($result15->num_rows>0) {
          while($myrow15=$result15->fetch_assoc()) {
				$found15 = 1;
				$glcode15 = $myrow15['glcode'];
				$projcode15 = $myrow15['projcode'];
				$debitamt15 = $myrow15['debitamt'];
				$creditamt15 = $myrow15['creditamt'];
				$debitamt15tot = $debitamt15tot + $debitamt15;
				$creditamt15tot = $creditamt15tot + $creditamt15;
				// echo "".number_format($debitamt15, 2)."<br>";
				// echo "".number_format($creditamt15,2)."<br>"; 
			echo "<tr>";
		$res19query=""; $result19=""; $found19=0;
    $res19query="SELECT proj_fname, proj_sname FROM tblproject1 WHERE proj_code=\"$projcode15\"";
    $result19=$dbh2->query($res19query);
    if($result19->num_rows>0) {
        while($myrow19=$result19->fetch_assoc()) {
      $found19 = 1;
      $proj_fname19 = $myrow19['proj_fname'];
      $proj_sname19 = $myrow19['proj_sname'];
        } //while
    } //if
    if($proj_sname19 == '')
    {
      $proj_sname19 =  substr($proj_fname19, 0, 35);
    }
	    if($proj_sname19!="") {
			echo "<td>".str_replace("'", "", $proj_sname19)."</td>";
		} else {
			echo "<td></td>";
		} //if-else
			// clear proj_sname19 value
			$proj_sname19=""; $proj_fname19="";
			echo "<td align=\"right\">";
				echo "".number_format($debitamt15, 2)."";
			echo "</td>";
			echo "<td align=\"right\">";
				echo "".number_format($creditamt15,2)."";
			echo "</td>";
			echo "</tr>";
          } //while
      } //if

			echo "</table>";
			echo "</td>";
			/*
			echo "<td align=\"right\">";
			$result15b=""; $found15b=0;
			$result15b = mysql_query("SELECT glcode, projcode, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND glcode=\"40.10.000\" AND glrefver=2", $dbh);
			if($result15b != "") {
				while($myrow15b = mysql_fetch_row($result15b)) {
				$found15b = 1;
				$glcode15b = $myrow15b[0];
				$projcode15b = $myrow15b[1];
				$debitamt15b = $myrow15b[2];
				$creditamt15b = $myrow15b[3];
				// $debitamt15tot = $debitamt15tot + $debitamt15b;
				$creditamt15tot = $creditamt15tot + $creditamt15b;
				// echo "".number_format($debitamt15b, 2)."<br>";
				echo "".number_format($creditamt15b,2)."<br>";
				}
			}
			echo "</td>";
			*/

			// Input VAT
			echo "<td colspan=\"2\">";
			echo "<table width=\"100%\" class=\"table-striped\" >";
			$res16query=""; $result16=""; $found16=0;
			$res16query = "SELECT glcode, projcode, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND glcode=\"10.10.467\" AND glrefver=2";
      $result16=$dbh2->query($res16query);
      if($result16->num_rows>0) {
          while($myrow16=$result16->fetch_assoc()) {
				$found16 = 1;
				$glcode16 = $myrow16['glcode'];
				$projcode16 = $myrow16['projcode'];
				$debitamt16 = $myrow16['debitamt'];
				$creditamt16 = $myrow16['creditamt'];
				// $creditamt16 = 0 - $creditamt16;
				$debitamt16tot = $debitamt16tot + $debitamt16;
				$creditamt16tot = $creditamt16tot + $creditamt16;
				// if($debitamt16 != 0) { echo "".number_format($debitamt16, 2)."<br>"; }
				// else if($creditamt16 != 0) { echo "".number_format($creditamt16, 2)."<br>"; }
				// echo "".number_format($creditamt16,2)."<br>";
				// $amt16 = $debitamt16+$creditamt16;
				// echo "".number_format($amt16, 2)."<br>";
				echo "<tr><td align=\"right\">".number_format($debitamt16, 2)."</td>";
				echo "<td align=\"right\">".number_format($creditamt16, 2)."</td></tr>";
          } //while
      } //if

			echo "</table>";
			echo "</td>";
			// $amt16tot = $debitamt16tot+$creditamt16tot;

			// advances to client
			/*
			echo "<td align=\"right\">";
			$result17=""; $found17=0;
			$result17 = mysql_query("SELECT glcode, projcode, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND glcode=\"10.10.404\" AND glrefver=2", $dbh);
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

			echo "<td align=\"right\">";
			$result17b=""; $found17b=0;
			$result17b = mysql_query("SELECT glcode, projcode, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND glcode=\"10.10.404\" AND glrefver=2", $dbh);
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
			*/
			echo "<td colspan=\"3\">";
			echo "<table width=\"100%\" class=\"table-striped\" >";
			$res17query=""; $result17=""; $found17=0;
			$res17query = "SELECT glcode, projcode, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND glcode=\"10.10.404\" AND glrefver=2";
      $result17=$dbh2->query($res17query);
      if($result17->num_rows>0) {
          while($myrow17=$result17->fetch_assoc()) {
				$found17 = 1;
				$glcode17 = $myrow17['glcode'];
				$projcode17 = $myrow17['projcode'];
				$debitamt17 = $myrow17['debitamt'];
				$creditamt17 = $myrow17['creditamt'];
				$debitamt17tot = $debitamt17tot + $debitamt17;
				$creditamt17tot = $creditamt17tot + $creditamt17;
			echo "<tr>";
			if($projcode17 != "" || $projcode17 != "-") {
		$res19query=""; $result19=""; $found19=0;
    $res19query = "SELECT proj_fname, proj_sname FROM tblproject1 WHERE proj_code=\"$projcode17\"";
    $result19=$dbh2->query($res19query);
    if($result19->num_rows>0) {
        while($myrow19=$result19->fetch_assoc()) {
      $found19 = 1;
      $proj_fname19 = $myrow19['proj_fname'];
      $proj_sname19 = $myrow19['proj_sname'];
        } //while
    } //if
    if($proj_sname19 == '')
    {
      $proj_sname19 =  substr($proj_fname19, 0, 35);
    }
			echo "<td>".str_replace("'", "", $proj_sname19)."</td>";
			} else { echo "<td></td>"; }
			// clear proj_sname19 value
			$proj_sname19=""; $proj_fname19="";
			echo "<td align=\"right\">";
				echo "".number_format($debitamt17, 2)."";
			echo "</td>";
			echo "<td align=\"right\">";
				echo "".number_format($creditamt17,2)."";
			echo "</td>";
			echo "</tr>";

          } //while
      } //if

			echo "</table>";
			echo "</td>";

			echo "<td colspan=\"3\" align=\"right\">";
			echo "<table width=\"100%\" class=\"table-striped\" >";
			$res18query=""; $result18=""; $found18=0;
			$res18query = "SELECT glcode, projcode, particulars, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND (glcode>=\"70.00.000\" AND glcode<=\"70.99.999\") AND glrefver=2";
      $result18=$dbh2->query($res18query);
      if($result18->num_rows>0) {
          while($myrow18=$result18->fetch_assoc()) {
				$found18 = 1;
				$glcode18 = $myrow18['glcode'];
				$projcode18 = $myrow18['projcode'];
				$particulars18 = $myrow18['particulars'];
				$particulars18fin = str_replace("'", "", $particulars18);
				$debitamt18 = $myrow18['debitamt'];
				$creditamt18 = $myrow18['creditamt'];
				$debitamt18tot = $debitamt18tot + $debitamt18;
				$creditamt18tot = $creditamt18tot + $creditamt18;
				echo "<tr>";
				echo "<td>".str_replace("'", "", $particulars18fin)."</td><td align=\"right\">".number_format($debitamt18, 2)."</td>";
				echo "<td align=\"right\">".number_format($creditamt18, 2)."</td>";
				echo "</tr>";

          } //while
      } //if

			echo "</table>";
			echo "</td>";

			echo "<td colspan=\"3\" align=\"right\">";
			echo "<table width=\"100%\" class=\"table-striped\" >";
			$res19query=""; $result19=""; $found19=0;
			$res19query = "SELECT glcode, projcode, particulars, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND (glcode>=\"60.00.000\" AND glcode<=\"60.99.999\") AND glrefver=2";
      $result19=$dbh2->query($res19query);
      if($result19->num_rows>0) {
          while($myrow19=$result19->fetch_assoc()) {
				$found19 = 1;
				$glcode19 = $myrow19['glcode'];
				$projcode19 = $myrow19['projcode'];
				$particulars19 = $myrow19['particulars'];
				$particulars19fin = str_replace("'", "", $particulars19);
				$debitamt19 = $myrow19['debitamt'];
				$creditamt19 = $myrow19['creditamt'];
				$debitamt19tot = $debitamt19tot + $debitamt19;
				$creditamt19tot = $creditamt19tot + $creditamt19;
				echo "<tr>";
				echo "<td>".str_replace("'", "", $particulars19fin)."</td><td align=\"right\">".number_format($debitamt19, 2)."</td>";
				echo "<td align=\"right\">".number_format($creditamt19, 2)."</td>";
				echo "</tr>";

          } //while
      } //if

			echo "</table>";
			echo "</td>";

			echo "<td colspan=\"3\" align=\"right\">";
			echo "<table width=\"100%\" class=\"table-striped\" >";
			$res20query=""; $result20=""; $found20=0;
			// $result20 = mysql_query("SELECT glcode, projcode, particulars, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND ((glcode>=\"10.00.000\" AND glcode<=\"10.10.299\") OR (glcode>=\"10.10.350\" AND glcode<=\"10.10.399\") OR (glcode>=\"10.10.402\" AND glcode<=\"10.10.403\") OR (glcode>=\"10.10.405\" AND glcode<=\"10.10.466\") OR (glcode>=\"10.10.468\" AND glcode<=\"30.99.999\") OR (glcode>=\"40.10.100\" AND glcode<=\"50.99.999\") OR (glcode>=\"71.00.000\" AND glcode<=\"99.99.999\")) AND glrefver=2 ORDER BY glcode ASC", $dbh);
			$res20query = "SELECT glcode, projcode, particulars, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND ((glcode>=\"10.00.000\" AND glcode<=\"10.10.299\") OR (glcode=\"10.10.300.A\") OR (glcode>=\"10.10.350\" AND glcode<=\"10.10.399\") OR (glcode=\"10.10.400\") OR (glcode>=\"10.10.402\" AND glcode<=\"10.10.403\") OR (glcode>=\"10.10.405\" AND glcode<\"10.10.467\") OR (glcode>=\"10.10.468\" AND glcode<=\"30.99.999\") OR (glcode=\"40.00.000\") OR (glcode>=\"40.10.100\" AND glcode<=\"50.99.999\") OR (glcode>=\"71.00.000\" AND glcode<=\"99.99.999\")) AND glrefver=2 ORDER BY glcode ASC";
      $result20=$dbh2->query($res20query);
      if($result20->num_rows>0) {
          while($myrow20=$result20->fetch_assoc()) {
				$found20 = 1;
				$glcode20 = $myrow20['glcode'];
				$projcode20 = $myrow20['projcode'];
				$particulars20 = $myrow20['particulars'];
				$particulars20fin = str_replace("'", "", $particulars20);
				$debitamt20 = $myrow20['debitamt'];
				$creditamt20 = $myrow20['creditamt'];
				$debitamt20tot = $debitamt20tot + $debitamt20;
				$creditamt20tot = $creditamt20tot + $creditamt20;
				echo "<tr>";
				echo "<td>".str_replace("'", "", $particulars20fin)."</td><td align=\"right\">".number_format($debitamt20, 2)."</td>";
				echo "<td align=\"right\">".number_format($creditamt20, 2)."</td>";
				echo "</tr>";
          } //while
      } //if

			echo "</table>";
			echo "</td>";

			// echo "<th>AcctName</th><th>Others-dr</th><th>Others-cr</th>";
			echo "</tr>";
			//reset variables
			$res19query="";
        } //while
    } //if

		// compute for grand-total
		$debitgrandtot = $debitamt12tot+$debitamt14tot+$debitamt15tot+$debitamt16tot+$debitamt17tot+$debitamt18tot+$debitamt19tot+$debitamt20tot;
		$creditgrandtot = $creditamt12tot+$creditamt14tot+$creditamt15tot+$creditamt16tot+$creditamt17tot+$creditamt18tot+$creditamt19tot+$creditamt20tot;

		// display totals
    echo "<tr><th colspan=\"3\" align=\"right\">Total</th><th align=\"right\">".number_format($debitamt12tot, 2)."</th><th align=\"right\">".number_format($creditamt12tot, 2).
"</th>";
		echo "<th></th><th align=\"right\">".number_format($debitamt14tot, 2)."</th><th align=\"right\">".number_format($creditamt14tot, 2).
"</th>";
		echo "<th></th><th align=\"right\">".number_format($debitamt15tot, 2)."</th><th align=\"right\">".number_format($creditamt15tot, 2).
"</th>";
		// echo "<th align=\"right\">".number_format($amt16tot, 2)."</th>";
		// echo "<th align=\"right\">$amt16tot|$amt16totfin</th>";
		echo "<th align=\"right\">".number_format($debitamt16tot, 2)."</th>";
		echo "<th align=\"right\">".number_format($creditamt16tot, 2)."</th>";
		echo "<th></th><th align=\"right\">".number_format($debitamt17tot, 2)."</th><th align=\"right\">".number_format($creditamt17tot, 2).
"</th>";
		echo "<th></th><th align=\"right\">".number_format($debitamt18tot, 2)."</th><th align=\"right\">".number_format($creditamt18tot, 2).
"</th>";
		echo "<th></th><th align=\"right\">".number_format($debitamt19tot, 2)."</th><th align=\"right\">".number_format($creditamt19tot, 2).
"</th>";
		echo "<th></th><th align=\"right\">".number_format($debitamt20tot, 2)."</th><th align=\"right\">".number_format($creditamt20tot, 2).
"</th>";
		echo "</tr>";

		// display grand-total
    echo "<tr><th colspan=\"3\" align=\"right\">Grand-total</th><th align=\"right\">".number_format($debitgrandtot, 2)."</th><th align=\"right\">".number_format($creditgrandtot, 2)."</th><td colspan=\"20\"></td></tr>";
	
    echo "</table>";
    echo "</td></tr>";
    echo "</table>";
	echo "</div>";
 
	echo "<p><a href=\"finrptmnu.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";
// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
