<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$tabinctyp = (isset($_POST['tabinctyp'])) ? $_POST['tabinctyp'] :'';

$idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$employeeid0 = (isset($_GET['eid'])) ? $_GET['eid'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$employeeid = (isset($_POST['empid'])) ? $_POST['empid'] :'';

if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($employeeid0 != "") { $employeeid=$employeeid0; }

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
     echo "<p><font size=1>Modules >> Payroll System >> Add'l income</font></p>";

     echo "<table class=\"fin\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

  if($accesslevel >= 4) {

	echo "<tr><td colspan=\"2\">";

	// display header
	include("finpaysysaddinchdr.php");

	echo "</td></tr>";

  echo "<tr><td colspan=\"2\">";

	echo "<table class=\"fin\" border=\"0\">";
	echo "<tr><th colspan=\"3\">List</th></tr>";
	echo "<tr>";
		echo "<form action=\"finpaysysaddincl.php?loginid=$loginid\" method=\"post\" name=\"finpaysysaddincl\">";
		echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"list\">";
		// pay group name dropdown
    echo "<td><select name=\"idpaygroup\" onchange=\"this.form.submit()\">";
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
		echo "</select></td>";

		// submit button
		echo "<td>";
		echo "<input type=\"submit\">";
    echo "</td>";

		echo "</form>";
	echo "</tr>";
	echo "</table>";

  echo "</td></tr>";

	echo "<tr><td colspan=\"2\">";
	// list personnel with additional income

	echo "<table class=\"fin\">";
	if($idpaygroup != "") {
		$res12query = "SELECT DISTINCT tblhrtaempincome.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrtaempincome INNER JOIN tblcontact ON tblhrtaempincome.employeeid=tblcontact.employeeid WHERE tblhrtaempincome.idpaygroup=$idpaygroup AND tblcontact.contact_type=\"personnel\" ORDER BY tblhrtaempincome.employeeid ASC";
		$result12=""; $found12=0;
		$result12 = $dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12 = $result12->fetch_assoc()) {
			$found12 = 1;
			$employeeid12 = $myrow12['employeeid'];
			$name_last12 = $myrow12['name_last'];
			$name_first12 = $myrow12['name_first'];
			$name_middle12 = $myrow12['name_middle'];
			echo "<tr><th align=\"left\">$employeeid12</th><th colspan=\"7\" align=\"left\">$name_last12, $name_first12 $name_middle12[0]</th>";
			echo "<form action=\"finpaysysaddinca.php?loginid=$loginid\" method=\"post\" name=\"finpaysysaddinca\">";
			echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"add\">";
			echo "<input type=\"hidden\" name=\"idpaygroup\" value=\"$idpaygroup\">";
			echo "<input type=\"hidden\" name=\"empid\" value=\"$employeeid12\">";
			echo "<td><input type=\"submit\" value=\"modify\"></td>";
			echo "</form>";
			echo "</tr>";
			// list allowances of personnel
			$res14query = "SELECT name, amount, datestart, dateend, nontaxable, vatinclusive, status, schedule FROM tblhrtaempincome WHERE tblhrtaempincome.idpaygroup=$idpaygroup AND tblhrtaempincome.employeeid=\"$employeeid12\" ORDER BY tblhrtaempincome.dateend DESC";
			$result14=""; $found14=0; $ctr14=0;
			$result14 = $dbh2->query($res14query);
			if($result14->num_rows>0) {
				while($myrow14 = $result14->fetch_assoc()) {
				$found14=1;
				$name14 = $myrow14['name'];
				$amount14 = $myrow14['amount'];
				$datestart14 = $myrow14['datestart'];
				$dateend14 = $myrow14['dateend'];
				$nontaxable14 = $myrow14['nontaxable'];
				$vatinclusive14 = $myrow14['vatinclusive'];
				$status14 = $myrow14['status'];
				$schedule14 = $myrow14['schedule'];
				echo "<tr><td></td><td>$name14</td><td align=\"right\">$amount14<td><td>$datestart14 -to- $dateend14</td>";
				if($nontaxable14==1) { echo "<td>non-taxable</td>"; } else if($nontaxable14==0) { echo "<td></td>"; }
				if($vatinclusive14==1) { echo "<td>VAT incl.</td>"; } else if($vatinclusive14==0) { echo "<td></td>"; }
				echo "<td>$schedule14</td>";
				if($status14==1) { echo "<td>Active</td>"; } else if($status14==0) { echo "<td></td>"; }
				echo "</tr>";
				} // while($myrow14 = $result14->fetch_assoc())
			} // if($result14->num_rows>0)
			}
		}
	} // if($idpaygroup != "")
	echo "</table>";

	echo "</td></tr>";

  } // endif accesslevel >= 4

	//
	// display individual info based on selected dropdown personnel
	//
	$filesrc = "finpaysysaddincl";
	// include("hrtimeattincome2.php");

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"finpaysysaddinc.php?loginid=$loginid\">Back</a></p>";

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
