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

<tr><th colspan='2'>Stravis Form-A Generate</th></tr>
<tr><td colspan='2'>

<?php
  echo "<table class=\"fin\" border=\"1\">";

	// 
	// display dropdown headers
  echo "<tr><th colspan=\"2\" align=\"center\">";

		echo "<table class=\"fin\" border=\"0\"><tr>";
    echo "<form action=\"finstrvsalst.php?loginid=$loginid\" method=\"post\" target=\"_self\" name=\"finstrvsalst\">";

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

    echo "<td><input type=\"submit\" value=\"Generate\"></td>";
		echo "</form>";

		echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";

		echo "<form action=\"finstrvsalst.php?loginid=$loginid\" method=\"post\" name=\"frmstrvsalst\">";
		echo "<input type=\"hidden\" name=\"yravlbl\" value=\"$yravlbl\">";
		echo "<input type=\"hidden\" name=\"qtravlbl\" value=\"$qtravlbl\">";
		echo "<input type=\"hidden\" name=\"projrelref\" value=\"$projrelref\">";
		echo "<td><input type=\"submit\" value=\"List\"></td>";
		echo "</form>";

		echo "</tr></table>";


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
