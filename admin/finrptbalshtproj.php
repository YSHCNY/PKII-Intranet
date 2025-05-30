<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$projgrpcrit = $_POST['projgrpcrit'];
$datefrom = $_POST['datefrom'];
$dateto = $_POST['dateto'];

if($datefrom == '') { $datefrom="2014-01-01"; }
if($dateto == '') { $dateto=$datenow; }

if($nkconso == '') { $nkconso=1; }


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

<?
// start contents here

    echo "<table width=\"100%\" class=\"fin2\" border=\"1\">";
    echo "<tr>";
    echo "<form action=\"finrptbalshtproj.php?loginid=$loginid\" method=\"post\" name=\"form1\">";
    echo "<td colspan=\"2\" nowrap>";

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
		echo "</select>";

		echo "From<input type=\"date\" size=\"8\" name=\"datefrom\" value=\"$datefrom\">";
		?>
  	<a href="javascript:show_calendar('document.form1.datefrom', document.form1.datefrom.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  	<?
		echo "To<input type=\"date\" size=\"8\" name=\"dateto\" value=\"$dateto\">";
		?>
  	<a href="javascript:show_calendar('document.form1.dateto', document.form1.dateto.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  	<?

    echo "<input type=\"submit\" value=\"Submit\" id=\"myOrder1\"></td></form>";
    echo "</tr>";


	echo "<tr><td valign=\"top\">";

	if($projgrpcrit != "") {

		echo "<table id=\"ReportTable\" class=\"fin2\">";
		echo "<tr><th colspan=\"2\" align=\"left\">Philkoei International Inc.</th></tr>";
		echo "<tr><th colspan=\"2\" align=\"left\">Balance Sheet&nbsp;<a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a></th></tr>";
		echo "<tr><th colspan=\"2\" align=\"left\">Duration from ".date("Y-M-d", strtotime($datefrom))." to ".date("Y-M-d", strtotime($dateto))."</th></tr>";

	if($datefrom <= $dateto) {

    echo "<tr><td colspan=\"2\">";
		echo "<table class=\"fin\" border=\"0\">";
		echo "<tr><th colspan=\"5\">Particulars</th><th>Amount</th></tr>";

		include('finrptbalshtbs1.php');

	}

		echo "</table>";
    echo "</td></tr>";

    echo "</table>";

	echo "</td>";
	echo "<td valign=\"top\">";

echo "<table id=\"ReportTable\" class=\"fin2\">";
		echo "<tr><th colspan=\"2\" align=\"left\">Philkoei International Inc.</th></tr>";
		echo "<tr><th colspan=\"2\" align=\"left\">Income Statement&nbsp;<a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a></th></tr>";
		echo "<tr><th colspan=\"2\" align=\"left\">Duration from ".date("Y-M-d", strtotime($datefrom))." to ".date("Y-M-d", strtotime($dateto))."</th></tr>";

		if($datefrom <= $dateto) {

    echo "<tr><td colspan=\"2\">";
		echo "<table class=\"fin\" border=\"0\">";
		echo "<tr><th colspan=\"5\">Particulars</th><th>Amount</th></tr>";

		include('finrptbalshtbs2.php');

		}

		echo "</table>";
    echo "</td></tr>";

    echo "</table>";

	}
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
