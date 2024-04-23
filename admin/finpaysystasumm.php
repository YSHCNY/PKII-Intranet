<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$idcutoff0 = (isset($_GET['idct'])) ? $_GET['idct'] :'';
$disptyp0 = (isset($_GET['dtyp'])) ? $_GET['dtyp'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$idcutoff = (isset($_POST['idcutoff'])) ? $_POST['idcutoff'] :'';
$disptyp = (isset($_POST['disptyp'])) ? $_POST['disptyp'] :'';

if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($idcutoff0 != "") { $idcutoff=$idcutoff0; }
if($disptyp0 != "") { $disptyp=$disptyp0; }

// echo "<p>vartest idpg:$idpaygroup, idct:$idcutoff, dtyp:$disptyp</p>";

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
     echo "<p><font size=1>Modules >> Payroll system >> T&A summary</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

  echo "<tr><td colspan=\"2\">";

  if($accesslevel >= 3) {
	echo "<table class=\"fin\" border=\"0\">";
	echo "<tr>";
		echo "<form action=\"finpaysystasumm.php?loginid=$loginid\" method=\"post\" name=\"finpaysystasumm\">";

		// pay group name dropdown
    echo "<td><select name=\"idpaygroup\" onchange=\"this.form.submit()\">";
		if($idpaygroup == "") {
		echo "<option value=''>select paygroup</option>";
		}
		$res11query="SELECT idtblhrtapaygrp, paygroupname FROM tblhrtapaygrp ORDER BY timestamp DESC";
		$result11=""; $found11=0; $ctr11=0;
		/*
		$result11 = mysql_query("", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
		*/
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$idtblhrtapaygrp11 = $myrow11['idtblhrtapaygrp'];
			$paygroupname11 = $myrow11['paygroupname'];
			if($idtblhrtapaygrp11 == $idpaygroup) { $idpaygrpsel="selected"; } else { $idpaygrpsel=""; }
			echo "<option value=\"$idtblhrtapaygrp11\" $idpaygrpsel>$paygroupname11</option>";
			}
		}
		echo "</select></td>";

		// cut-off period dropdown
		echo "<td><select name=\"idcutoff\" onchange=\"this.form.submit()\">";
		if($idcutoff == "") {
		echo "<option value=''>select cutoff</option>";
		}
		$res15query="SELECT idhrtacutoff, cutstart, cutend, paygroupname, remarks FROM tblhrtacutoff WHERE idhrtapaygrp=$idpaygroup ORDER BY cutstart DESC";
		$result15=""; $found15=0; $ctr15=0;
		/*
		$result15 = mysql_query("", $dbh);
		if($result15 != "") {
			while($myrow15 = mysql_fetch_row($result15)) {
		*/
		$result15 = $dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15 = $result15->fetch_assoc()) {
			$found15 = 1;
			$idhrtacutoff15 = $myrow15['idhrtacutoff'];
			$cutstart15 = $myrow15['cutstart'];
			$cutend15 = $myrow15['cutend'];
			$paygroupname15 = $myrow15['paygroupname'];
			$remarks15 = $myrow15['remarks'];
			$ctr15 = $ctr15 + 1;
			if($idhrtacutoff15 == $idcutoff) { $idcutoffsel="selected"; } else { $idcutoffsel=""; }
			echo "<option value=\"$idhrtacutoff15\" $idcutoffsel>$cutstart15-to-$cutend15</option>";
			}
		}
		echo "</select></td>";

		// display type
		echo "<td><select name=\"disptyp\" onchange=\"this.form.submit()\">";
		if($disptyp == "") { echo "<option value=''>display type</option>"; }
		else if($disptyp == "summary") { $disptypsummsel="selected"; $disptypdtldsel=""; }
		else if($disptyp == "detailed") { $disptypsummsel=""; $disptypdtldsel="selected"; }
		echo "<option value=\"summary\" $disptypsummsel>summary</option>";
		echo "<option value=\"detailed\" $disptypdtldsel>detailed</option>";
		echo "</select></td>";

		// submit button
		echo "<td>";
		echo "<input type=\"submit\">";
    echo "</td>";

		echo "</form>";
	echo "</tr>";
	echo "</table>";
  } // endif accesslevel >= 4

  echo "</td></tr>";

	//
	// display individual info based on selected dropdown personnel
	//
	include("hrtimeattsumm2.php");

// end contents here...

     echo "</table>";

// edit body-footer

     echo "<p><a href=\"finpaysys.php?loginid=$loginid\">Back</a></p>";


     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid"; 
		$result = $dbh2->query($resquery);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
