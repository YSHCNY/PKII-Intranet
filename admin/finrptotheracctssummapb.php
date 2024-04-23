<?php 
//
// 20210201 finrptotheracctssummapb.php
//
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$yrmonthavlbl = (isset($_POST['yrmonthavlbl'])) ? $_POST['yrmonthavlbl'] :'';

// if($yrmonthavlbl == "") { $yrmonthavlbl = $yearnow." ". date("F", strtotime($monthnow)); }

if($yrmonthavlbl == "") {
	$mmcutstart="$yearnow-01-01"; $mmcutend="1980-01-01";
} else {

	$arryyyymonth = split(" ", $yrmonthavlbl);
	$arryyyy = $arryyyymonth[0];
	$arrmonth = $arryyyymonth[1];
	$arrmm = date("m", strtotime("$arrmonth-$arryyyy"));
	$yyyymm = $arryyyy . "-" . $arrmm;
	$mmcutstart = $yyyymm . "-" . "01";
	$mmcutend = date("Y-m-t", strtotime($mmcutstart)); 

}

// echo "<p>vartest arryyyy:$arryyyy, arrmonth:$arrmonth, arrmm:$arrmm, yyyymm:$yyyymm</p>";

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
    echo "<form action=\"finrptotheracctssummapb.php?loginid=$loginid\" method=\"post\"><div class='form-inline'>";
    echo "<td colspan=\"2\">";
    echo "<div class='form-group'><select class='form-control' name=\"yrmonthavlbl\">";
    echo "<option>Year-Month</option>";

	$res11query=""; $result11=""; $found11=0; $ctr11=0;
    $res11query = "SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfinacctspayable WHERE acctspayableid <> '' ORDER BY date DESC";
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
      $found11 = 1;
      $yyyymonth = $myrow11['yyyymonth'];

      if($yrmonthavlbl == "$yyyymonth") { $yrmonthsel = "selected"; }
      else { $yrmonthsel = ""; }

      echo "<option value=\"$yyyymonth\" $yrmonthsel>$yyyymonth</option>";			
		}
	}
    echo "</select>";

    echo "<button class='btn btn-primary' type=\"submit\">Submit</button></div></td></div></form>";
    echo "</tr>";
		echo "</table>";

		echo "<table id=\"ReportTable\" class=\"fin2\" border=\"1\">";
		echo "<tr><th colspan=\"4\" align=\"left\">Summary of Other Accounts <a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a></th></tr>";
		echo "<tr><th colspan=\"4\" align=\"left\">Accounts Payable Book</th></tr>";
		echo "<tr><th colspan=\"4\" align=\"left\">For the month of $yrmonthavlbl</th></tr>";
		echo "<tr><th colspan=\"2\">Particulars</th><th>Debit</th><th>Credit</th></tr>";

		$result11=""; $found11=0;
		$res11query = "SELECT tblfinacctspayable.acctspayablenumber, tblfinacctspayable.payee, tblfinacctspayable.date, tblfinacctspayable.glcode, tblfinacctspayable.glrefver, tblfinacctspayable.projcode, tblfinacctspayable.particulars, tblfinacctspayable.debitamt, tblfinacctspayable.creditamt, tblfinacctspayable.company_id, tblfinacctspayable.contact_id FROM tblfinacctspayable WHERE (tblfinacctspayable.date >= \"$mmcutstart\" AND tblfinacctspayable.date <= \"$mmcutend\") AND ((tblfinacctspayable.glcode>=\"10.00.000\" AND tblfinacctspayable.glcode<=\"10.10.119\") OR (tblfinacctspayable.glcode>=\"10.10.120\" AND tblfinacctspayable.glcode<=\"10.10.121\") OR (tblfinacctspayable.glcode>=\"10.10.121.C\" AND tblfinacctspayable.glcode<=\"10.10.124.B\") OR (tblfinacctspayable.glcode>=\"10.10.124.D\" AND tblfinacctspayable.glcode<=\"10.10.400\") OR (tblfinacctspayable.glcode>=\"10.10.402\" AND tblfinacctspayable.glcode<=\"10.10.403\") OR (tblfinacctspayable.glcode>=\"10.10.405\" AND tblfinacctspayable.glcode<=\"10.10.466\") OR (tblfinacctspayable.glcode>=\"10.20.000\" AND tblfinacctspayable.glcode<=\"10.40.999\") OR (tblfinacctspayable.glcode>=\"20.10.200\" AND tblfinacctspayable.glcode<=\"50.99.999\") OR (tblfinacctspayable.glcode>=\"71.00.000\" AND tblfinacctspayable.glcode<=\"99.99.999\")) AND tblfinacctspayable.glrefver=2 GROUP BY tblfinacctspayable.glcode ORDER BY tblfinacctspayable.glcode ASC, tblfinacctspayable.acctspayablenumber ASC";
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11 = 1;
			$disbursementnumber11 = $myrow11['acctspayablenumber'];
			$payee11 = $myrow11['payee'];
			$date11 = $myrow11['date'];
			$glcode11 = $myrow11['glcode'];
			$glrefver11 = $myrow11['glrefver'];
			$projcode11 = $myrow11['projcode'];
			$particulars11 = $myrow11['particulars'];
			$debitamt11 = $myrow11['debitamt'];
			$creditamt11 = $myrow11['creditamt'];
			$company_id11 = $myrow11['company_id'];
			$contact_id11 = $myrow11['contact_id'];

			$result11b=""; $found11b=0;
			$result11b = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode11\" AND version=2", $dbh);
			if($result11b != "") {
				while($myrow11b = mysql_fetch_row($result11b)) {
				$found11b = 1;
				$glname11b = $myrow11b[0];
				}
			}

			$debitamt11tot = $debitamt11tot + $debitamt11;
			$creditamt11tot = $creditamt11tot + $creditamt11;

			echo "<tr><td>$glcode11</td><td>$glname11b</td>";

			$result20=""; $found20=0;
			$result20 = mysql_query("SELECT glcode, projcode, particulars, debitamt, creditamt FROM tblfinacctspayable WHERE glcode=\"$glcode11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND ((glcode>=\"10.00.000\" AND glcode<=\"10.10.119\") OR (glcode>=\"10.10.120\" AND glcode<=\"10.10.121\") OR (glcode>=\"10.10.121.C\" AND glcode<=\"10.10.124.B\") OR (glcode>=\"10.10.124.D\" AND glcode<=\"10.10.400\") OR (glcode>=\"10.10.402\" AND glcode<=\"10.10.403\") OR (glcode>=\"10.10.405\" AND glcode<=\"10.10.466\") OR (glcode>=\"10.20.000\" AND glcode<=\"50.99.999\") OR (glcode>=\"71.00.000\" AND glcode<=\"99.99.999\")) AND glrefver=2 ORDER BY glcode ASC", $dbh);
			if($result20 != "") {
				while($myrow20 = mysql_fetch_row($result20)) {
				$found20 = 1;
				$glcode20 = $myrow20[0];
				$projcode20 = $myrow20[1];
				$particulars20 = $myrow20[2];
				$debitamt20 = $myrow20[3];
				$creditamt20 = $myrow20[4];
				$debitamt20tot = $debitamt20tot + $debitamt20;
				// $creditamt20tot = $creditamt20tot + $creditamt20;
				// echo "<td align=\"right\">".number_format($debitamt20, 2)."</td>";
				// echo "<td align=\"right\">".number_format($creditamt20, 2)."</td>";
				}
			}
			echo "<td align=\"right\">".number_format($debitamt20tot, 2)."</td>";

			$result20b=""; $found20b=0;
			$result20b = mysql_query("SELECT glcode, projcode, particulars, debitamt, creditamt FROM tblfinacctspayable WHERE glcode=\"$glcode11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND ((glcode>=\"10.00.000\" AND glcode<=\"10.10.119\") OR (glcode>=\"10.10.120\" AND glcode<=\"10.10.121\") OR (glcode>=\"10.10.121.C\" AND glcode<=\"10.10.124.B\") OR (glcode>=\"10.10.124.D\" AND glcode<=\"10.10.400\") OR (glcode>=\"10.10.402\" AND glcode<=\"10.10.403\") OR (glcode>=\"10.10.405\" AND glcode<=\"10.10.466\") OR (glcode>=\"10.20.000\" AND glcode<=\"50.99.999\") OR (glcode>=\"71.00.000\" AND glcode<=\"99.99.999\")) AND glrefver=2 ORDER BY glcode ASC", $dbh);
			if($result20b != "") {
				while($myrow20b = mysql_fetch_row($result20b)) {
				$found20b = 1;
				$glcode20b = $myrow20b[0];
				$projcode20b = $myrow20b[1];
				$particulars20b = $myrow20b[2];
				$debitamt20b = $myrow20b[3];
				$creditamt20b = $myrow20b[4];
				// $debitamt20btot = $debitamt20btot + $debitamt20b;
				$creditamt20btot = $creditamt20btot + $creditamt20b;
				// echo "<td align=\"right\">".number_format($debitamt20, 2)."</td>";
				// echo "<td align=\"right\">".number_format($creditamt20, 2)."</td>";
				}
			}
			echo "<td align=\"right\">".number_format($creditamt20btot, 2)."</td>";
			echo "</tr>";

			$debitamt20totfin=$debitamt20totfin+$debitamt20tot;
			$creditamt20totfin=$creditamt20totfin+$creditamt20btot;

			$debitamt11=0; $creditamt11=0; $glname11=""; $glcode11="";
			$debitamt20=0; $creditamt20b=0; $debitamt20tot=0; $creditamt20btot=0;
				
			} //while
		} //if

    echo "<tr><th colspan=\"2\">Total</th><th align=\"right\">".number_format($debitamt20totfin, 2)."</th><th align=\"right\">".number_format($creditamt20totfin, 2).
"</th>";
		echo "</tr>";
	
    echo "</table>";

    echo "<p><a href=\"finrptmnu.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close;
?>
