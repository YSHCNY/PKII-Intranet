<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$rdsel = $_POST['rdsel'];

$yrmonthavlbl = $_POST['yrmonthavlbl'];
$schedule = $_POST['schedule'];
$quarterly = $_POST['quarterly'];
$yrquarterly = $_POST['yrquarterly'];
$yravlbl = $_POST['yravlbl'];

if($schedule=="") {
	$schedordnone="selected"; $schedordmonth=""; $schedordquarter=""; $schedordannual="";
	$cutstart=""; $cutend="";
} else if($schedule=="monthly") {
	$schedordnone=""; $schedordmonth="selected"; $schedordquarter=""; $schedordannual="";
	if($yrmonthavlbl == "") {
		$cutstart=$yearnow . "-" . date("m", strtotime($datenow)) . "-" . "01";
		$cutend=date("Y-m-t", strtotime($cutstart));
		$yrmonthavlbl = date("Y F", strtotime($datenow));
	} else {
		$arryyyymonth = split(" ", $yrmonthavlbl);
		$arryyyy = $arryyyymonth[0];
		$arrmonth = $arryyyymonth[1];
		$arrmm = date("m", strtotime($arrmonth));
		$yyyymm = $arryyyy . "-" . $arrmm;
		$cutstart = $yyyymm . "-" . "01";
		$cutend = date("Y-m-t", strtotime($cutstart)); 
	}
} else if($schedule=="quarterly") {
	$schedordnone=""; $schedordmonth=""; $schedordquarter="selected"; $schedordannual="";
	if($quarterly == "1q") {
		$q1sel="selected"; $q2sel=""; $q3sel=""; $q4sel="";
		$cutstart = $yrquarterly."-"."01"."-"."01";
		$cutend = $yrquarterly."-"."03"."-"."31";
	} else if($quarterly == "2q") {
		$q1sel=""; $q2sel="selected"; $q3sel=""; $q4sel="";
		$cutstart = $yrquarterly."-"."04"."-"."01";
		$cutend = $yrquarterly."-"."06"."-"."30";
	} else if($quarterly == "3q") {
		$q1sel=""; $q2sel=""; $q3sel="selected"; $q4sel="";
		$cutstart = $yrquarterly."-"."07"."-"."01";
		$cutend = $yrquarterly."-"."09"."-"."30";
	} else if($quarterly == "4q") {
		$q1sel=""; $q2sel=""; $q3sel=""; $q4sel="selected";
		$cutstart = $yrquarterly."-"."10"."-"."01";
		$cutend = $yrquarterly."-"."12"."-"."31";
	}
} else if($schedule=="annually") {
	$schedordnone=""; $schedordmonth=""; $schedordquarter=""; $schedordannual="selected";
	if($yravlbl == "") {
	  $yravlbl=$yearnow;
		$cutstart=$yearnow."-"."01"."-"."01";
		$cutend=$yearnow."-"."12"."-"."31";
	} else {
		$cutstart=$yravlbl."-"."01"."-"."01";
		$cutend=$yravlbl."-"."12"."-"."31";
	}
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

<?
// start contents here

    echo "<table class=\"fin2\" border=\"1\">";
    echo "<tr>";
    echo "<form action=\"finrptincstmtcomp.php?loginid=$loginid\" method=\"post\" name=\"form1\">";
    echo "<td colspan=\"2\">";

		// display schedule options
		echo "<select name=\"schedule\" onchange=\"this.form.submit()\">";
		echo "<option value='' $schedordnone>Select</option>";
		echo "<option value=\"monthly\" $schedordmonth>Monthly</option>";
		echo "<option value=\"quarterly\" $schedordquarter>Quarterly</option>";
		echo "<option value=\"annually\" $schedordannual>Annually</option>";
		echo "</select>";

	if($schedule=="monthly") {
		// if schedule is monthly
    echo "<select name=\"yrmonthavlbl\">";
    echo "<option>Year-Month</option>";

    // $result11 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfinjournal WHERE journalid <> '' ORDER BY date DESC", $dbh);
		$result11=""; $found11=0;
		$result11 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM
			(SELECT DISTINCT date FROM tblfindisbursement
				UNION
			SELECT DISTINCT date FROM tblfincashreceipt
				UNION
			SELECT DISTINCT date from tblfinjournal)
			t ORDER BY date DESC", $dbh);
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $yyyymonth = $myrow11[0];

      if($yrmonthavlbl == "$yyyymonth") { $yrmonthsel = "selected"; }
      else { $yrmonthsel = ""; }

      echo "<option value=\"$yyyymonth\" $yrmonthsel>$yyyymonth</option>";
    }
    echo "</select>";
	} else if($schedule=="quarterly") {
		// if schedule is quarterly
		echo "<select name=\"quarterly\">";
		echo "<option value=\"1q\" $q1sel>1st quarter</option>";
		echo "<option value=\"2q\" $q2sel>2nd quarter</option>";
		echo "<option value=\"3q\" $q3sel>3rd quarter</option>";
		echo "<option value=\"4q\" $q4sel>4th quarter</option>";
		echo "</select>";
		echo "<select name=\"yrquarterly\">";
		$result14=""; $found14=0;
		$result14 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y') as yyyy FROM
			(SELECT DISTINCT date FROM tblfindisbursement
				UNION
			SELECT DISTINCT date FROM tblfincashreceipt
				UNION
			SELECT DISTINCT date from tblfinjournal)
			t ORDER BY date DESC", $dbh);
		if($result14 != "") {
			while($myrow14 = mysql_fetch_row($result14)) {
			$found14 = 1;
			$yyyy14 = $myrow14[0];
			if($yrquarterly == "$yyyy14") { $yrquartersel="selected"; } else { $yrquartersel=""; }
			echo "<option value=\"$yyyy14\" $yrquartersel>$yyyy14</option>";
			}
		}
		echo "</select>";
	} else if($schedule=="annually") {
		// if schedule is annually
		echo "<select name=\"yravlbl\">";
		if($yravlbl=="") { echo "<option>Select year</option>"; }
		// query years available
		$result12=""; $found12=0;
		$result12 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y') as yyyy FROM
			(SELECT DISTINCT date FROM tblfindisbursement
				UNION
			SELECT DISTINCT date FROM tblfincashreceipt
				UNION
			SELECT DISTINCT date from tblfinjournal)
			t ORDER BY date DESC", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
			$found12 = 1;
      $yyyy12 = $myrow12[0];
      if($yravlbl == "$yyyy12") { $yrsel = "selected"; }
      else { $yrsel = ""; }
      echo "<option value=\"$yyyy12\" $yrsel>$yyyy12</option>";			
			}
		}
		echo "</select>";
	}

    echo "<input type=\"submit\" value=\"Submit\" id=\"myOrder1\"></td></form>";
    echo "</tr>";
		echo "</table>";

		echo "<table id=\"ReportTable\" class=\"fin2\">";
		echo "<tr><th colspan=\"2\" align=\"left\">Philkoei International Inc.</th></tr>";
		echo "<tr><th colspan=\"2\" align=\"left\">Income Statement&nbsp;<a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a></th></tr>";
		echo "<tr><th colspan=\"2\" align=\"left\">";
		if($schedule=="monthly") {
			echo "$yrmonthavlbl";
		} else if($schedule=="quarterly") {
			if($quarterly=="1q") { echo "$yrquarterly 1st quarter"; }
			else if($quarterly=="2q") { echo "$yrquarterly 2nd quarter"; }
			else if($quarterly=="3q") { echo "$yrquarterly 3rd quarter"; }
			else if($quarterly=="4q") { echo "$yrquarterly 4th quarter"; }
		} else if($schedule=="annually") {
			echo "$yravlbl";
		}
		echo "</th></tr>";
    echo "<tr><td colspan=\"2\">";
		echo "<table class=\"fin\" border=\"0\">";
		echo "<tr><th colspan=\"5\">Particulars</th><th>Amount</th></tr>";
		

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
?>
