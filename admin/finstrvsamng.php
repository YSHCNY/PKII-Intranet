<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$yravlbl = $_GET['yravlbl'];
$qtravlbl = $_GET['qtravlbl'];
$projrelref = $_GET['projrelref'];

if($yravlbl == '') { $yravlbl = $_POST['yravlbl']; }
if($qtravlbl == '') { $qtravlbl = $_POST['qtravlbl']; }
if($projrelref == '') { $projrelref = $_POST['projrelref']; }

$yrqtravlbl = $yravlbl."-".$qtravlbl;

if($yravlbl == '') { $yravlbl=$yearnow; }

if($qtravlbl=='') {
  $selmonth = date("n", mktime(0, 0, 0, $monthnow));
	if(($selmonth>="1") && ($selmonth<="3")) { $qtravlbl="1"; }
	else if(($selmonth>="4") && ($selmonth<="6")) { $qtravlbl="2"; }
	else if(($selmonth>="7") && ($selmonth<="9")) { $qtravlbl="3"; }
	else if(($selmonth>="10") && ($selmonth<="12")) { $qtravlbl="4"; }
  $yrqtravlbl = $yravlbl."-".$qtravlbl;
}

if($qtravlbl == 1) { $qtr1sel="selected"; $qtr2sel=""; $qtr3sel=""; $qtr4sel=""; $datestartavlbl=$yravlbl."-"."01"."-"."01"; $dateendavlbl=$yravlbl."-"."03"."-"."31"; }
else if($qtravlbl == 2) { $qtr1sel=""; $qtr2sel="selected"; $qtr3sel=""; $qtr4sel=""; $datestartavlbl=$yravlbl."-"."04"."-"."01"; $dateendavlbl=$yravlbl."-"."06"."-"."30"; }
else if($qtravlbl == 3) { $qtr1sel=""; $qtr2sel=""; $qtr3sel="selected"; $qtr4sel=""; $datestartavlbl=$yravlbl."-"."07"."-"."01"; $dateendavlbl=$yravlbl."-"."09"."-"."30"; }
else if($qtravlbl == 4) { $qtr1sel=""; $qtr2sel=""; $qtr3sel=""; $qtr4sel="selected"; $datestartavlbl=$yravlbl."-"."10"."-"."01"; $dateendavlbl=$yravlbl."-"."12"."-"."31"; }

// echo "<p>vartest $datestartavlbl - $dateendavlbl</p>";
$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}  

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// start contents here

echo "<table class=\"fin\" border=\"1\">";

?>

<tr><th colspan='2'>Manage NK-Stravis Form-A</th></tr>
<tr><td colspan='2'>

<?php
  echo "<table class=\"fin\" border=\"0\">";

	// 
	// display dropdown headers
  echo "<tr><th colspan=\"2\" align=\"center\">";

		echo "<table class=\"fin\" border=\"0\"><tr>";
    echo "<form action=\"finstrvsamng.php?loginid=$loginid\" method=\"post\" target=\"_self\" name=\"frmstrvsamng\">";

    echo "<td><select name=\"yravlbl\">";
		$i=$yearnow; $yrstart=$i-10;
		while ($i >= $yrstart) {
			if($i == $yravlbl) { $isel="selected"; } else { $isel=""; }
			echo "<option value=\"$i\" $isel>$i</option>";
			$i = $i - 1;
		}
    echo "</select></td>";

		echo "<td><select name=\"qtravlbl\">";
		echo "<option value=\"1\" $qtr1sel>1st Quarter</option>";
		echo "<option value=\"2\" $qtr2sel>2nd Quarter</option>";
		echo "<option value=\"3\" $qtr3sel>3rd Quarter</option>";
		echo "<option value=\"4\" $qtr4sel>4th Quarter</option>";
		echo "</select></td>";

		echo "<td><select name=\"projrelref\">";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("SELECT projrelrefid, code, name, strvssht FROM tblprojrelref WHERE nkconso=1 AND (codeprev=\"nkoei\" OR codeprev=\"nkgroup\") ORDER BY seq ASC", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$projrelrefid11 = $myrow11[0];
			$code11 = $myrow11[1];
			$name11 = $myrow11[2];
			$strvssht11 = $myrow11[3];
			if($code11 == $projrelref) { $projrelrefsel="selected"; } else { $projrelrefsel=""; }
			echo "<option value=\"$code11\" $projrelrefsel>$strvssht11 - $name11</option>";
			}
		}
		echo "</select></td>";

    echo "<td><input type=\"submit\" value=\"Submit\"></td>";
		echo "</form>";

		echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";

		echo "<form action=\"finstrvsaadd.php?loginid=$loginid\" method=\"post\" name=\"frmstrvsaadd\">";
		echo "<input type=\"hidden\" name=\"yravlbl\" value=\"$yravlbl\">";
		echo "<input type=\"hidden\" name=\"qtravlbl\" value=\"$qtravlbl\">";
		echo "<input type=\"hidden\" name=\"projrelref\" value=\"$projrelref\">";
		echo "<td><input type=\"submit\" value=\"Add new\"></td>";
		echo "</form>";

		echo "</tr></table>";

  echo "</th></tr>";

	echo "<tr><td colspan=\"2\">";

		echo "<table class=\"fin\" border=\"1\">";
		//
		// display header column labels
		echo "<tr><th>Code</th><th>Account Name</th><th>Transaction Value</th><th></th><th></th><th>Code</th><th>Amt in transaction currency</th><th>Currency</th><th></th><th>Content of a transaction</th><th>Account</th><th>Code</th><th></th><th>Check</th><th colspan=\"2\">Action</th></tr>";
		$result12=""; $found12=0; $ctr12=0;
		$result12 = mysql_query("SELECT DISTINCT tblfinstrvsfrma.tblfinstrvsfrmaid, tblfinstrvsfrma.transdate, tblfinstrvsfrma.projrelrefcd, tblfinstrvsfrma.acctcd, tblfinstrvsfrma.transvalue, tblfinstrvsfrma.projcode, tblfinstrvsfrma.amttranscurr, tblfinstrvsfrma.currtyp, tblfinstrvsfrma.contenttrans, tblfinstrvsfrma.transacct, tblfinstrvsfrma.code, tblfinstrvsfrma.remarks, tblfinnkgacctref.name_e, tblproject1.proj_fname, tblproject1.proj_sname, tblproject1.proj_relation0, tblproject1.proj_relation1, tblproject1.proj_relation2, tblproject1.proj_relation3, tblprojrelref.code, tblprojrelref.name, tblprojrelref.codeprev FROM tblfinstrvsfrma LEFT JOIN tblfinnkgacctref ON tblfinstrvsfrma.acctcd=tblfinnkgacctref.code LEFT JOIN tblproject1 ON tblfinstrvsfrma.projcode=tblproject1.proj_code LEFT JOIN tblprojrelref ON tblproject1.proj_relation2=tblprojrelref.code WHERE projrelrefcd=\"$projrelref\" AND (transdate>=\"$datestartavlbl\" AND transdate<=\"$dateendavlbl\")", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
			$found12=1;
			$finstrvsfrmaid12 = $myrow12[0];
			$transdate12 = $myrow12[1];
			$projrelrefcd12 = $myrow12[2];
			$acctcd12 = $myrow12[3];
			$transvalue12 = $myrow12[4];
			$projcode12 = $myrow12[5];
			$amttranscurr12 = $myrow12[6];
			$currtyp12 = $myrow12[7];
			$contenttrans12 = $myrow12[8];
			$transacct12 = $myrow12[9];
			$code12 = $myrow12[10];
			$remarks12 = $myrow12[11];
			$acctname12 = $myrow12[12];
			$proj_fname12 = $myrow12[13];
			$proj_sname12 = substr($myrow12[14], 0, 60);
			$proj_relation012 = $myrow12[15];
			$proj_relation112 = $myrow12[16];
			$proj_relation212 = $myrow12[17];
			$proj_relation312 = $myrow12[18];
			$projrelrefcode12 = $myrow12[19];
			$projrelrefname12 = $myrow12[20];
			$projrelrefcodeprev12 = $myrow12[21];
			$ctr12 = $ctr12+1;
			$transvaltot = $transvaltot + $transvalue12;

			echo "<tr><td>$acctcd12</td><td>$acctname12</td><td align=\"right\">".number_format($transvalue12, 2)."</td><td></td><td></td><td>";
			if($projrelrefcodeprev12 == "nkmain") { $projrelrefcdfin="NK TYO"; }
			else if($projrelrefcodeprev12 == "nkgroup") { $projrelrefcdfin="Project Office"; }
			echo "$projrelrefcdfin</td><td align=\"right\">".number_format($amttranscurr12, 2)."</td><td>$currtyp12</td><td></td><td>";
			if($proj_fname12 != "") { echo "$proj_fname12 - "; }
			echo "$contenttrans12</td><td>$transacct12</td><td>$code12</td><td></td><td></td>";
			echo "<form action=\"finstrvsaedit.php?loginid=$loginid&strvsid=$finstrvsfrmaid12\" method=\"post\" name=\"finstrvsaedit\">";
			echo "<input type=\"hidden\" name=\"yravlbl\" value=\"$yravlbl\">";
			echo "<input type=\"hidden\" name=\"qtravlbl\" value=\"$qtravlbl\">";
			echo "<input type=\"hidden\" name=\"projrelref\" value=\"$projrelref\">";
			echo "<td><input type=\"submit\" value=\"Edit\" style=\"font-family: sans-serif; font-size: 10px;\"></td></form>";
			echo "<form action=\"finstrvsadel.php?loginid=$loginid&strvsid=$finstrvsfrmaid12\" method=\"post\" name=\"finstrvsadel\">";
			echo "<input type=\"hidden\" name=\"yravlbl\" value=\"$yravlbl\">";
			echo "<input type=\"hidden\" name=\"qtravlbl\" value=\"$qtravlbl\">";
			echo "<input type=\"hidden\" name=\"projrelref\" value=\"$projrelref\">";
			echo "<td><input type=\"submit\" value=\"Del\" style=\"font-family: sans-serif; font-size: 10px;\"></td></form></tr>";

			// reset variables
			$projrelrefcdfin="";
			}
		}
		echo "<tr><th colspan=\"2\" align=\"right\">Total</th><th align=\"right\">".number_format($transvaltot, 2)."</th><th colspan=\"13\"></th></tr>";
		echo "</table>";

	echo "</td></tr>";

  echo "</table>";
?>

</td></tr>

<?php
echo "</table>";

echo "<p><a href=\"finvouchmain.php?loginid=$loginid\">Back</a></p>";



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
