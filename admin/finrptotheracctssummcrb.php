<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$yrmonthavlbl = (isset($_POST['yrmonthavlbl'])) ? $_POST['yrmonthavlbl'] :'';

// if($yrmonthavlbl == "") { $yrmonthavlbl = $yearnow." ". date("F", strtotime($monthnow)); }

if($yrmonthavlbl == "") {
	$mmcutstart="1980-01-01"; $mmcutend="1980-01-01";
} else {

	$arryyyymonth = split(" ", $yrmonthavlbl);
	$arryyyy = $arryyyymonth[0];
	$arrmonth = $arryyyymonth[1];
	$arrmm = date("m", strtotime("$arrmonth-$arryyyy"));
	$yyyymm = $arryyyy . "-" . $arrmm;
	$mmcutstart = $yyyymm . "-" . "01";
	$mmcutend = date("Y-m-t", strtotime($mmcutstart)); 

}

$found = 0;

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
    echo "<form action=\"finrptotheracctssummcrb.php?loginid=$loginid\" method=\"post\"><div class='form-inline'><div class='form-group'>";
    echo "<td colspan=\"2\">";
    echo "<select name=\"yrmonthavlbl\" class='form-control'>";
    echo "<option>Year-Month</option>";

    $result11 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfincashreceipt WHERE cashreceiptid <> '' ORDER BY date DESC", $dbh);
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

		echo "<table id=\"ReportTable\" class=\"fin2\" border=\"1\">";
		echo "<tr><th colspan=\"4\" align=\"left\">Summary of Other Accounts <a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a></th></tr>";
		echo "<tr><th colspan=\"4\" align=\"left\">Cash Receipts Book</th></tr>";
		echo "<tr><th colspan=\"4\" align=\"left\">For the month of $yrmonthavlbl</th></tr>";
		echo "<tr><th>Acct code</th><th>Particulars</th><th>Debit</th><th>Credit</th></tr>";

		$result11=""; $found11=0;
		// $result11 = mysql_query("SELECT tblfincashreceipt.cashreceiptnumber, tblfincashreceipt.payor, tblfincashreceipt.date, tblfincashreceipt.glcode FROM tblfincashreceipt WHERE (tblfincashreceipt.date >= \"$mmcutstart\" AND tblfincashreceipt.date <= \"$mmcutend\") AND ((tblfincashreceipt.glcode>=\"10.00.000\" AND tblfincashreceipt.glcode<=\"10.10.119\") OR (tblfincashreceipt.glcode>=\"10.10.121.C\" AND tblfincashreceipt.glcode<=\"10.10.122.C\") OR (tblfincashreceipt.glcode>=\"10.10.123.A\" AND tblfincashreceipt.glcode<=\"10.10.299\") OR (tblfincashreceipt.glcode>=\"10.10.350\" AND tblfincashreceipt.glcode<=\"10.10.399\") OR (tblfincashreceipt.glcode>=\"10.10.402\" AND tblfincashreceipt.glcode<=\"10.10.466\") OR (tblfincashreceipt.glcode>=\"10.20.000\" AND tblfincashreceipt.glcode<=\"50.99.999\") OR (tblfincashreceipt.glcode>=\"71.00.000\" AND tblfincashreceipt.glcode<=\"99.99.999\")) AND tblfincashreceipt.glrefver=2 GROUP BY tblfincashreceipt.glcode ORDER BY tblfincashreceipt.glcode ASC, tblfincashreceipt.cashreceiptnumber ASC", $dbh);
		// $result11 = mysql_query("SELECT tblfincashreceipt.cashreceiptnumber, tblfincashreceipt.payor, tblfincashreceipt.date, tblfincashreceipt.glcode FROM tblfincashreceipt WHERE (tblfincashreceipt.date >= \"$mmcutstart\" AND tblfincashreceipt.date <= \"$mmcutend\") AND ((tblfincashreceipt.glcode>=\"10.00.000\" AND tblfincashreceipt.glcode<=\"10.10.119\") OR (tblfincashreceipt.glcode>=\"10.10.120\" AND tblfincashreceipt.glcode<=\"10.10.121\") OR (tblfincashreceipt.glcode>=\"10.10.121.C\" AND tblfincashreceipt.glcode<=\"10.10.122.C\") OR (tblfincashreceipt.glcode>=\"10.10.123.A\" AND tblfincashreceipt.glcode<=\"10.10.299\") OR (tblfincashreceipt.glcode=\"10.10.300.A\") OR (tblfincashreceipt.glcode>=\"10.10.350\" AND tblfincashreceipt.glcode<=\"10.10.399\") OR (tblfincashreceipt.glcode=\"10.10.400\") OR (tblfincashreceipt.glcode>=\"10.10.402\" AND tblfincashreceipt.glcode<=\"10.10.466\") OR (tblfincashreceipt.glcode>=\"10.20.000\" AND tblfincashreceipt.glcode<=\"50.99.999\") OR (tblfincashreceipt.glcode>=\"71.00.000\" AND tblfincashreceipt.glcode<=\"99.99.999\")) AND tblfincashreceipt.glrefver=2 GROUP BY tblfincashreceipt.glcode ORDER BY tblfincashreceipt.glcode ASC, tblfincashreceipt.cashreceiptnumber ASC", $dbh);
		$res11query="SELECT tblfincashreceipt.cashreceiptnumber, tblfincashreceipt.payor, tblfincashreceipt.date, tblfincashreceipt.glcode FROM tblfincashreceipt WHERE (tblfincashreceipt.date >= \"$mmcutstart\" AND tblfincashreceipt.date <= \"$mmcutend\") AND ((tblfincashreceipt.glcode>=\"10.00.000\" AND tblfincashreceipt.glcode<=\"10.10.119\") OR (tblfincashreceipt.glcode>=\"10.10.120\" AND tblfincashreceipt.glcode<=\"10.10.121\") OR (tblfincashreceipt.glcode>=\"10.10.121.C\" AND tblfincashreceipt.glcode<=\"10.10.124.B\") OR (tblfincashreceipt.glcode>=\"10.10.124.D\" AND tblfincashreceipt.glcode<=\"10.10.299\") OR (tblfincashreceipt.glcode=\"10.10.300.A\") OR (tblfincashreceipt.glcode>=\"10.10.350\" AND tblfincashreceipt.glcode<=\"10.10.399\") OR (tblfincashreceipt.glcode=\"10.10.400\") OR (tblfincashreceipt.glcode>=\"10.10.402\" AND tblfincashreceipt.glcode<=\"10.10.466\") OR (tblfincashreceipt.glcode>=\"10.20.000\" AND tblfincashreceipt.glcode<=\"50.99.999\") OR (tblfincashreceipt.glcode>=\"71.00.000\" AND tblfincashreceipt.glcode<=\"99.99.999\")) AND tblfincashreceipt.glrefver=2 GROUP BY tblfincashreceipt.glcode ORDER BY tblfincashreceipt.glcode ASC, tblfincashreceipt.cashreceiptnumber ASC";
		$result11 = mysql_query("$res11query", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$cashreceiptnumber11 = $myrow11[0];
			$payor11 = $myrow11[1];
			$date11 = $myrow11[2];
			$glcode11 = $myrow11[3];

			$result11b=""; $found11b=0;
			$result11b = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode11\" AND version=2", $dbh);
			if($result11b != "") {
				while($myrow11b = mysql_fetch_row($result11b)) {
				$found11b = 1;
				$glname11b = $myrow11b[0];
				}
			}

			echo "<tr><td>$glcode11</td><td>$glname11b</td>";

			$result20=""; $found20=0;
			// $result20 = mysql_query("SELECT glcode, projcode, particulars, debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"$glcode11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND ((glcode>=\"10.00.000\" AND glcode<=\"10.10.119\") OR (glcode>=\"10.10.121.C\" AND glcode<=\"10.10.122.C\") OR (glcode>=\"10.10.123.A\" AND glcode<=\"10.10.299\") OR (glcode>=\"10.10.350\" AND glcode<=\"10.10.399\") OR (glcode>=\"10.10.402\" AND glcode<=\"10.10.466\") OR (glcode>=\"10.20.000\" AND glcode<=\"50.99.999\") OR (glcode>=\"71.00.000\" AND glcode<=\"99.99.999\")) AND glrefver=2 ORDER BY glcode ASC", $dbh);
			// $result20 = mysql_query("SELECT glcode, projcode, particulars, debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"$glcode11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND ((glcode>=\"10.00.000\" AND glcode<=\"10.10.119\") OR (glcode>=\"10.10.120\" AND glcode<=\"10.10.121\") OR (glcode>=\"10.10.121.C\" AND glcode<=\"10.10.122.C\") OR (glcode>=\"10.10.123.A\" AND glcode<=\"10.10.299\") OR (glcode=\"10.10.300.A\") OR (glcode>=\"10.10.350\" AND glcode<=\"10.10.399\") OR (glcode=\"10.10.400\") OR (glcode>=\"10.10.402\" AND glcode<=\"10.10.466\") OR (glcode>=\"10.20.000\" AND glcode<=\"50.99.999\") OR (glcode>=\"71.00.000\" AND glcode<=\"99.99.999\")) AND glrefver=2 ORDER BY glcode ASC", $dbh);
		$result20 = mysql_query("SELECT glcode, projcode, particulars, debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"$glcode11\" AND (date>=\"$mmcutstart\" AND date<=\"$mmcutend\") AND ((glcode>=\"10.00.000\" AND glcode<=\"10.10.119\") OR (glcode>=\"10.10.120\" AND glcode<=\"10.10.121\") OR (glcode>=\"10.10.121.C\" AND glcode<=\"10.10.124.B\") OR (glcode>=\"10.10.124.D\" AND glcode<=\"10.10.299\") OR (glcode=\"10.10.300.A\") OR
(glcode>=\"10.10.350\" AND glcode<=\"10.10.399\") OR (glcode=\"10.10.400\") OR (glcode>=\"10.10.402\" AND glcode<=\"10.10.466\") OR (glcode>=\"10.20.000\" AND glcode<=\"50.99.999\") OR (glcode>=\"71.00.000\" AND glcode<=\"99.99.999\")) AND glrefver=2 ORDER BY glcode ASC", $dbh);
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
				}
			}
			echo "<td align=\"right\">".number_format($debitamt20tot,2)."</td>";
			echo "<td align=\"right\">".number_format($creditamt20tot,2)."</td>";
			echo "</tr>";

			$debitamt20totfin=$debitamt20totfin+$debitamt20tot;
			$creditamt20totfin=$creditamt20totfin+$creditamt20tot;

			$debitamt11=0; $creditamt11=0; $glname11=""; $glcode11=""; $glname11b="";
			$debitamt20=0; $creditamt20=0; $debitamt20tot=0; $creditamt20tot=0;
			}
		}

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
$dbh2->close();
?>
