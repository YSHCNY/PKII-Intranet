<?php 

require("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$idhrtapaygrp = $_GET['idpg'];
$idhrtacutoff = $_GET['idct'];

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");
?>
<script language="JavaScript" src="ts_picker.js"></script>
<?php
// edit body-header
     echo "<p><font size=1>Modules >> Time and Attendance >> Cut-off period</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

		 echo "<tr><th colspan=\"2\">Define cut-off period</th></tr>";

// start contents here...

  echo "<tr><td colspan=\"2\">";

  if($accesslevel >= 4)
  {
	echo "<table class=\"fin\" border=\"0\">";
	echo "<tr>";

		echo "<form action=\"hrtimeattcutoffedit.php?loginid=$loginid&idpg=$idhrtapaygrp&idct=$idhrtacutoff\" method=\"post\" name=\"modhrtacutoff\">";
		// paygroupname dropdown list
		echo "<td colspan=\"4\">";
		echo "<select name=\"idhrtapaygrp\" onchange=\"this.form.submit()\">";
		if($idhrtapaygrp == "") { echo "<option value=''>select paygroup</option>"; }
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("SELECT idtblhrtapaygrp, paygroupname FROM tblhrtapaygrp", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$idtblhrtapaygrp11 = $myrow11[0];
			$paygroupname11 = $myrow11[1];
			if($idtblhrtapaygrp11 == $idhrtapaygrp) { $idhrtapgsel="selected"; } else { $idhrtapgsel=""; }
			echo "<option value=\"$idtblhrtapaygrp11\" $idhrtapgsel>$paygroupname11</option>";
			}
		}
		echo "</select>";

		echo "<select name=\"idhrtacutoff\" onchange=\"this.form.submit()\">";
		if($idhrtacutoff == "") { echo "<option value=''>select cutoff</option>"; }
		$res12select="SELECT idhrtacutoff, cutstart, cutend FROM tblhrtacutoff WHERE idhrtacutoff=$idhrtacutoff AND idhrtapaygrp=$idhrtapaygrp ORDER BY cutstart DESC";
		$result12=""; $found12=0; $ctr12=0;
		$result12 = mysql_query("$res12select", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
			$found12 = 1;
			$idhrtacutoff12 = $myrow12[0];
			$cutstart12 = $myrow12[1];
			$cutend12 = $myrow12[2];
			if($idhrtacutoff12 == $idhrtacutoff) { $idctsel="selected"; } else { $idctsel=""; }
			echo "<option value=\"$idhrtacutoff12\">$cutstart12-to-$cutend12</option>";
			}
		}
		echo "</select>";

		// echo "<input type=\"submit\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\">Submit</button>";
		echo "</td>";
		echo "</form>";
		echo "</tr>";

	echo "</table>";
  } // endif accesslevel >= 4

  echo "</td></tr>";

	//
	// list employees
	//
	if($idhrtacutoff != "") {
	echo "<tr><td colspan=\"2\">";
	echo "<table width=\"100%\" class=\"fin\">";
	// query tblhrtaemptimelog
	$res14select="SELECT DISTINCT tblhrtaemptimelog.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrtaemptimelog INNER JOIN tblcontact ON tblhrtaemptimelog.employeeid=tblcontact.employeeid WHERE tblhrtaemptimelog.idcutoff=$idhrtacutoff AND tblhrtaemptimelog.idpaygroup=$idhrtapaygrp AND tblcontact.contact_type=\"personnel\" ORDER BY tblhrtaemptimelog.employeeid ASC";
	$result14=""; $found14=0; $ctr14=0;
	$result14 = mysql_query("$res14select", $dbh);
	if($result14 != "") {
		while($myrow14 = mysql_fetch_row($result14)) {
		$found14 = 1;
		$employeeid14 = $myrow14[0];
		$namelast14 = $myrow14[1];
		$namefirst14 = $myrow14[2];
		$namemiddle14 = $myrow14[3];
		echo "<tr>";
		echo "<td><input type=\"checkbox\" name=\"employeeid\" value=\"$employeeid14\" checked>&nbsp;$employeeid14</td>";
		echo "<td>$namelast14, $namefirst14 $namemiddle14[0]</td>";
		echo "</tr>";
		}
	}
	echo "<tr><td colspan=\"2\">";
	// echo "<input type=\"submit\">";
	echo "<button type=\"submit\" class=\"btn btn-success\">Save</button>";
	echo "</td></tr>";
	echo "</table>";
	echo "</td></tr>";
	}

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><button type=\"button\" class=\"btn btn-default\"><a href=\"hrtimeattcutoff.php?loginid=$loginid&idpg=$idhrtapaygrp\">Back</a></button></p>";
$idhrtapaygrp0 = $_GET[''];

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
