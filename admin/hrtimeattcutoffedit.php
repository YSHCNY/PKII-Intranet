<?php 

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrtapaygrp = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$idhrtacutoff = (isset($_GET['idct'])) ? $_GET['idct'] :'';

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

  if($accesslevel >= 4) {
	echo "<table class=\"fin\" border=\"0\">";
	echo "<tr>";

		// echo "<form action=\"hrtimeattcutoffedit.php?loginid=$loginid&idpg=$idhrtapaygrp&idct=$idhrtacutoff\" method=\"post\" name=\"modhrtacutoff\">";
		// paygroupname dropdown list
		echo "<td colspan=\"4\">";
		echo "<select name=\"idhrtapaygrp\" onchange=\"this.form.submit()\">";
		if($idhrtapaygrp == "") { echo "<option value=''>select paygroup</option>"; }
		$res11query=""; $result11=""; $found11=0; $ctr11=0;
		$res11query="SELECT idtblhrtapaygrp, paygroupname FROM tblhrtapaygrp";
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11 = 1;
			$idtblhrtapaygrp11 = $myrow11['idtblhrtapaygrp'];
			$paygroupname11 = $myrow11['paygroupname'];
			if($idtblhrtapaygrp11 == $idhrtapaygrp) { $idhrtapgsel="selected"; } else { $idhrtapgsel=""; }
			echo "<option value=\"$idtblhrtapaygrp11\" $idhrtapgsel>$paygroupname11</option>";
				
			} //while
		} //if

		echo "</select>";

		echo "<select name=\"idhrtacutoff\" onchange=\"this.form.submit()\">";
		if($idhrtacutoff == "") { echo "<option value=''>select cutoff</option>"; }
		$res12select=""; $result12=""; $found12=0; $ctr12=0;
		$res12select="SELECT idhrtacutoff, cutstart, cutend FROM tblhrtacutoff WHERE idhrtacutoff=$idhrtacutoff AND idhrtapaygrp=$idhrtapaygrp ORDER BY cutstart DESC";
		$result12=$dbh2->query($res12select);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
			$found12 = 1;
			$idhrtacutoff12 = $myrow12['idhrtacutoff'];
			$cutstart12 = $myrow12['cutstart'];
			$cutend12 = $myrow12['cutend'];
			if($idhrtacutoff12 == $idhrtacutoff) { $idctsel="selected"; } else { $idctsel=""; }
			echo "<option value=\"$idhrtacutoff12\">$cutstart12-to-$cutend12</option>";
				
			} //while
		} //if

		echo "</select>";

		// echo "<input type=\"submit\">";
		// echo "<button type=\"submit\" class=\"btn btn-primary\">Submit</button>";
		echo "</td>";
		// echo "</form>";
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
	echo "<thead><tr><th>ctr</th><th>empID</th><th>name</th></tr></thead>";
	echo "<tbody>";
	// query tblhrtaemptimelog
	// $res14select="SELECT DISTINCT tblhrtaemptimelog.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrtaemptimelog INNER JOIN tblcontact ON tblhrtaemptimelog.employeeid=tblcontact.employeeid WHERE tblhrtaemptimelog.idcutoff=$idhrtacutoff AND tblhrtaemptimelog.idpaygroup=$idhrtapaygrp AND tblcontact.contact_type=\"personnel\" ORDER BY tblhrtaemptimelog.employeeid ASC";
	$res14select=""; $result14=""; $found14=0; $ctr14=0;
	$res14select="SELECT DISTINCT tblhrtaemptimelog.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrtaemptimelog INNER JOIN tblcontact ON tblhrtaemptimelog.employeeid=tblcontact.employeeid WHERE tblhrtaemptimelog.idcutoff=$idhrtacutoff AND tblhrtaemptimelog.idpaygroup=$idhrtapaygrp AND tblcontact.contact_type=\"personnel\" ORDER BY tblcontact.name_last ASC, tblcontact.name_first ASC";
	$result14=$dbh2->query($res14select);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$found14 = 1; $ctr14++;
		$employeeid14 = $myrow14['employeeid'];
		$namelast14 = $myrow14['name_last'];
		$namefirst14 = $myrow14['name_first'];
		$namemiddle14 = $myrow14['name_middle'];
		echo "<tr>";
		echo "<td>$ctr14</td>";
		echo "<td>";
		// echo "<input type=\"checkbox\" name=\"employeeid\" value=\"$employeeid14\" checked>&nbsp;$employeeid14";
		echo "$employeeid14";
		echo "</td>";
		echo "<td>$namelast14, $namefirst14 $namemiddle14[0]</td>";
		echo "</tr>";
			
		} //while
	} //if

	// echo "<tr><td colspan=\"2\">";
	// echo "<input type=\"submit\">";
	// echo "<button type=\"submit\" class=\"btn btn-success\">Save</button>";
	// echo "</td></tr>";
	echo "</tbody>";
	echo "</table>";
	echo "</td></tr>";
	}

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><button type=\"button\" class=\"btn btn-default\"><a href=\"hrtimeattcutoff.php?loginid=$loginid&idpg=$idhrtapaygrp\">Back</a></button></p>";
$idhrtapaygrp0 = $_GET[''];

     $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);	

     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
