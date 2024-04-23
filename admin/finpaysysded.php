<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$employeeid0 = (isset($_GET['eid'])) ? $_GET['eid'] :'';
$tab0 = (isset($_GET['tab'])) ? $_GET['tab'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$employeeid = (isset($_POST['empid'])) ? $_POST['empid'] :'';

if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($employeeid0 != "") { $employeeid=$employeeid0; }
if($tab0!="") {
	if($tab0=="l") { $tabinctyp="list"; }
	else if($tab0=="a") { $tabinctyp="add"; }
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
     echo "<p><font size=1>Modules >> Payroll system >> Deductions</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

  if($accesslevel >= 4) {

	echo "<tr><td colspan=\"2\">";

	// insert deductions header
	include("finpaysysdedhdr.php");

	echo "</td></tr>";

  } // endif accesslevel >= 4

	//
	// display individual info based on selected dropdown personnel
	//
	$filesrc = "finpaysysded";
	// include("finpaysysded2.php");

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
