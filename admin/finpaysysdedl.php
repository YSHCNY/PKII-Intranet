<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$employeeid0 = (isset($_GET['eid'])) ? $_GET['eid'] :'';
$tab0 = (isset($_GET['tab'])) ? $_GET['tab'] :'';

$tabinctyp = (isset($_POST['tabinctyp'])) ? $_POST['tabinctyp'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$employeeid = (isset($_POST['empid'])) ? $_POST['empid'] :'';

if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($employeeid0 != "") { $employeeid=$employeeid0; }
if($tab0 != "") {
	if($tab0=="l") { $tabinctyp="list"; }
	else if($tab0=="a") { $tabinctyp="add"; }
}
if($tabinctyp != "") {
	if($tabinctyp=="list") { $tab0="l"; }
	else if($tabinctyp=="add") { $tab0="a"; }
}

// echo "<p>vartest idpg:$idpaygroup, empid:$employeeid</p>";

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
<script language="JavaScript" src="ts_picker.js"></script>
<?php
// edit body-header


// start contents here...

  if($accesslevel >= 4) {


	// insert deductions header
	include("finpaysysdedhdr.php");





		echo "<form action=\"finpaysysdedl.php?loginid=$loginid\" method=\"post\" name=\"finpaysysdedl\">";
		echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"list\">";

		// pay group name dropdown
    echo "<select name=\"idpaygroup\" onchange=\"this.form.submit()\">";
		echo "<option value=''>select paygroup</option>";
		$res11query = "SELECT idtblhrtapaygrp, paygroupname FROM tblhrtapaygrp ORDER BY timestamp DESC";
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
		echo "</select>";

		// submit button
	
		echo "<input type=\"submit\">";


		echo "</form>";


  } // endif accesslevel >= 4

	//
	// display individual info based on selected dropdown personnel
	//
	if($idpaygroup=="") {
	$filesrc = "finpaysysded";
	} else {
	$filesrc = "finpaysysdedl"; $tab="l";
	}
	include("finpaysysdedl2.php");

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"$filesrc.php?loginid=$loginid&tab=$tab\">Back</a></p>";

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
