<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$yravlbl = $_POST['yravlbl'];
$qtravlbl = $_POST['qtravlbl'];
$projrelref = $_POST['projrelref'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// edit body-header
  echo "<p><font size=1>Modules >> Vouchsers >> Manage NK-Stravis >> Add</font></p>";

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

  echo "<tr><th colspan=\"2\">Manage NK-Stravis - Add</th></tr>";

// start contents here...

  echo "<form action=\"finstrvsaadd2.php?loginid=$loginid\" method=\"post\" name=\"finstrvsaadd2\">";

	echo "<input type=\"hidden\" name=\"yravlbl\" value=\"$yravlbl\">";
	echo "<input type=\"hidden\" name=\"qtravlbl\" value=\"$qtravlbl\">";
	echo "<input type=\"hidden\" name=\"projrelref\" value=\"$projrelref\">";

	echo "<tr><th align=\"right\">transaction date</th><td>";
	// echo "<input name=\"transyear\" size=\"4\" value=\"$yearnow\">";
	echo "<select name=\"transyear\">";
		$i=$yearnow; $yrstart=$i-10;
		while ($i >= $yrstart) {
			if($i == $yravlbl) { $isel="selected"; } else { $isel=""; }
			echo "<option value=\"$i\" $isel>$i</option>";
			$i = $i - 1;
		}
	echo "</select>";
	if($qtravlbl=="1") { $monthnow="03"; }
	else if($qtravlbl=="2") { $monthnow="06"; }
	else if($qtravlbl=="3") { $monthnow="09"; }
	else if($qtravlbl=="4") { $monthnow="12"; }
	if($monthnow=="01") { $transmonth1sel="selected"; $transmonth2sel=""; $transmonth3sel=""; $transmonth4sel=""; $transmonth5sel=""; $transmonth6sel=""; $transmonth7sel=""; $transmonth8sel=""; $transmonth9sel=""; $transmonth10sel=""; $transmonth11sel=""; $transmonth12sel=""; }
	else if($monthnow=="02") { $transmonth1sel=""; $transmonth2sel="selected"; $transmonth3sel=""; $transmonth4sel=""; $transmonth5sel=""; $transmonth6sel=""; $transmonth7sel=""; $transmonth8sel=""; $transmonth9sel=""; $transmonth10sel=""; $transmonth11sel=""; $transmonth12sel=""; }
	else if($monthnow=="03") { $transmonth1sel=""; $transmonth2sel=""; $transmonth3sel="selected"; $transmonth4sel=""; $transmonth5sel=""; $transmonth6sel=""; $transmonth7sel=""; $transmonth8sel=""; $transmonth9sel=""; $transmonth10sel=""; $transmonth11sel=""; $transmonth12sel=""; }
	else if($monthnow=="04") { $transmonth1sel=""; $transmonth2sel=""; $transmonth3sel=""; $transmonth4sel="selected"; $transmonth5sel=""; $transmonth6sel=""; $transmonth7sel=""; $transmonth8sel=""; $transmonth9sel=""; $transmonth10sel=""; $transmonth11sel=""; $transmonth12sel=""; }
	else if($monthnow=="05") { $transmonth1sel=""; $transmonth2sel=""; $transmonth3sel=""; $transmonth4sel=""; $transmonth5sel="selected"; $transmonth6sel=""; $transmonth7sel=""; $transmonth8sel=""; $transmonth9sel=""; $transmonth10sel=""; $transmonth11sel=""; $transmonth12sel=""; }
	else if($monthnow=="06") { $transmonth1sel=""; $transmonth2sel=""; $transmonth3sel=""; $transmonth4sel=""; $transmonth5sel=""; $transmonth6sel="selected"; $transmonth7sel=""; $transmonth8sel=""; $transmonth9sel=""; $transmonth10sel=""; $transmonth11sel=""; $transmonth12sel=""; }
	else if($monthnow=="07") { $transmonth1sel=""; $transmonth2sel=""; $transmonth3sel=""; $transmonth4sel=""; $transmonth5sel=""; $transmonth6sel=""; $transmonth7sel="selected"; $transmonth8sel=""; $transmonth9sel=""; $transmonth10sel=""; $transmonth11sel=""; $transmonth12sel=""; }
	else if($monthnow=="08") { $transmonth1sel=""; $transmonth2sel=""; $transmonth3sel=""; $transmonth4sel=""; $transmonth5sel=""; $transmonth6sel=""; $transmonth7sel=""; $transmonth8sel="selected"; $transmonth9sel=""; $transmonth10sel=""; $transmonth11sel=""; $transmonth12sel=""; }
	else if($monthnow=="09") { $transmonth1sel=""; $transmonth2sel=""; $transmonth3sel=""; $transmonth4sel=""; $transmonth5sel=""; $transmonth6sel=""; $transmonth7sel=""; $transmonth8sel=""; $transmonth9sel="selected"; $transmonth10sel=""; $transmonth11sel=""; $transmonth12sel=""; }
	else if($monthnow=="10") { $transmonth1sel=""; $transmonth2sel=""; $transmonth3sel=""; $transmonth4sel=""; $transmonth5sel=""; $transmonth6sel=""; $transmonth7sel=""; $transmonth8sel=""; $transmonth9sel=""; $transmonth10sel="selected"; $transmonth11sel=""; $transmonth12sel=""; }
	else if($monthnow=="11") { $transmonth1sel=""; $transmonth2sel=""; $transmonth3sel=""; $transmonth4sel=""; $transmonth5sel=""; $transmonth6sel=""; $transmonth7sel=""; $transmonth8sel=""; $transmonth9sel=""; $transmonth10sel=""; $transmonth11sel="selected"; $transmonth12sel=""; }
	else if($monthnow=="12") { $transmonth1sel=""; $transmonth2sel=""; $transmonth3sel=""; $transmonth4sel=""; $transmonth5sel=""; $transmonth6sel=""; $transmonth7sel=""; $transmonth8sel=""; $transmonth9sel=""; $transmonth10sel=""; $transmonth11sel=""; $transmonth12sel="selected"; }
	echo "<select name=\"transmonth\">";
	echo "<option value=\"1\" $transmonth1sel>Jan</option>";
	echo "<option value=\"2\" $transmonth2sel>Feb</option>";
	echo "<option value=\"3\" $transmonth3sel>Mar</option>";
	echo "<option value=\"4\" $transmonth4sel>Apr</option>";
	echo "<option value=\"5\" $transmonth5sel>May</option>";
	echo "<option value=\"6\" $transmonth6sel>Jun</option>";
	echo "<option value=\"7\" $transmonth7sel>Jul</option>";
	echo "<option value=\"8\" $transmonth8sel>Aug</option>";
	echo "<option value=\"9\" $transmonth9sel>Sep</option>";
	echo "<option value=\"10\" $transmonth10sel>Oct</option>";
	echo "<option value=\"11\" $transmonth11sel>Nov</option>";
	echo "<option value=\"12\" $transmonth12sel>Dec</option>";
	echo "</select>";
	echo "</td></tr>";
	echo "<tr><th align=\"right\">sheet</th><td>";
	echo "<select name=\"frmasheet\">";
	$result14=""; $found14=0;
	$result14 = mysql_query("SELECT projrelrefid, code, name, strvssht FROM tblprojrelref WHERE nkconso=1 AND (codeprev=\"nkoei\" OR codeprev=\"nkgroup\")", $dbh);
	if($result14 != "") {
		while($myrow14 = mysql_fetch_row($result14)) {
		$found14 = 1;
		$projrelrefid14 = $myrow14[0];
		$code14 = $myrow14[1];
		$name14 = $myrow14[2];
		$strvssht14 = $myrow14[3];
		if($code14 == $projrelref) { $frmasheetsel="selected"; } else { $frmasheetsel=""; }
		echo "<option value=\"$code14\" $frmasheetsel>$strvssht14 - $name14</option>";
		}
	}
	echo "</select>";
	echo "</td></tr>";
	echo "<tr><th align=\"right\">code</th><td>";
	echo "<select name=\"acctcode\">";
	$result11=""; $found11=0;
	$result11 = mysql_query("SELECT finnkgacctrefid, code, name_e FROM tblfinnkgacctref WHERE type=\"B\" ORDER BY code ASC", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$finnkgacctrefid11 = $myrow11[0];
		$code11 = $myrow11[1];
		$name_e11 = $myrow11[2];
		echo "<option value=\"$code11\">$code11 - $name_e11</option>";
		}
	}
	echo "</select>";
	echo "</td></tr>";
	echo "<tr><th align=\"right\">transaction value</th><td><input type=\"number\" step=\".01\" name=\"transvalue\"></td></tr>";
	echo "<tr><th align=\"right\">projcode</th><td>";
	echo "<select name=\"projcode\">";
	echo "<option value=''>-</option>";
	$result12=""; $found12=0;
	$result12 = mysql_query("SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 ORDER BY proj_code DESC", $dbh);
	if($result12 != "") {
		while($myrow12 = mysql_fetch_row($result12)) {
		$found12 = 1;
		$projectid12 = $myrow12[0];
		$proj_code12 = $myrow12[1];
		$proj_fname12 = $myrow12[2];
		$proj_sname12 = $myrow12[3];
		echo "<option value=\"$proj_code12\">$proj_code12";
		if($proj_sname12 != "") { echo " - $proj_sname12"; }
		if($proj_fname12 != "") { echo " - " . substr("$proj_fname12", 0, 60) . ""; }
		echo "</option>";
		}
	}
	echo "</select>";
	echo "</td></tr>";
	echo "<tr><th align=\"right\">amount in currency</th><td>";
	echo "<input type=\"number\" step=\".01\" name=\"amtincurr\">";
	echo "<select name=\"currtyp\">";
	echo "<option value=\"PHP\">PHP - Philippine Peso</option>";
	echo "<option value=\"USD\">USD - United States Dollar</option>";
	echo "<option value=\"JPY\">JPY - Japanese Yen</option>";
	echo "</select>";
	echo "</td></tr>";
	echo "<tr><th align=\"right\">content of transaction</th><td><input name=\"transcontent\"><br>";
	echo "<font size=\"1\"><i>ex. Total, Rem. only, Acc, P/D</i></font></td></tr>";
	echo "<tr><th align=\"right\">account transaction counterparties</th><td><input name=\"accttranscounterpart\"><br>";
	echo "<font size=\"1\"><i>ex. Excluding VAT, No VAT</i></font></td></tr>";
	echo "<tr><th align=\"right\">remarks</th><td><textarea cols=\"30\" rows\"3\" name=\"remarks\"></textarea></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Add\"></td></tr>";
	echo "</form>";

// end contents here...

  echo "</table>";

// edit body-footer
     echo "<p><a href=\"finstrvsamng.php?loginid=$loginid&yravlbl=$yravlbl&qtravlbl=$qtravlbl&projrelref=$projrelref\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
