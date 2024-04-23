<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idtblfinpaydeduct = (isset($_GET['fpdid'])) ? $_GET['fpdid'] :'';
$filesrc = (isset($_GET['fsrc'])) ? $_GET['fsrc'] :'';
$idpaygroup = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';

$tab = (isset($_GET['tab'])) ? $_GET['tab'] :'';

if($tab!="") {
	if($tab=="l") { $tabinctyp="list"; }
	else if($tab=="a") { $tabinctyp="add"; }
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

	// query tblfinpaydeduct
	$res11query = "SELECT tblfinpaydeduct.employeeid, tblfinpaydeduct.deductname, tblfinpaydeduct.deductamount, tblfinpaydeduct.deducttotal, tblfinpaydeduct.deductbalance, tblfinpaydeduct.datestart, tblfinpaydeduct.dateend, tblfinpaydeduct.status, tblfinpaydeduct.schedule, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblfinpaydeduct LEFT JOIN tblcontact ON tblfinpaydeduct.employeeid=tblcontact.employeeid WHERE tblfinpaydeduct.idtblfinpaydeduct=$idtblfinpaydeduct AND tblfinpaydeduct.idpaygroup=$idpaygroup AND tblcontact.contact_type=\"personnel\"";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$employeeid = $myrow11['employeeid'];
		$deductname = $myrow11['deductname'];
		$deductamount = $myrow11['deductamount'];
		$deducttotal = $myrow11['deducttotal'];
		$deductbalance = $myrow11['deductbalance'];
		$datestart = $myrow11['datestart'];
		$dateend = $myrow11['dateend'];
		$status = $myrow11['status'];
		$schedule = $myrow11['schedule'];
		$name_last = $myrow11['name_last'];
		$name_first = $myrow11['name_first'];
		$name_middle = $myrow11['name_middle'];
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)

  echo "<tr><td colspan=\"2\">";

	if($employeeid != "") {
	echo "<tr><td colspan=\"2\">";
	echo "<table width=\"100%\" class=\"fin\">";

	echo "<tr><th colspan=\"2\">Details of deductions for personnel:<br>$employeeid - ".strtoupper($name_last).",&nbsp;".strtoupper($name_first)."&nbsp;".strtoupper($name_middle)."</th></tr>";

	echo "<tr><td colspan=\"2\" align=\"center\">";

	// add income screen
	echo "<table class=\"fin\">";
	echo "<form action=\"finpaysysdededt2.php?loginid=$loginid&fpdid=$idtblfinpaydeduct\" method=\"post\" name=\"finpaysysdedadd\">";
	echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"idpaygroup\" value=\"$idpaygroup\">";
	echo "<input type=\"hidden\" name=\"filesrc\" value=\"$filesrc\">";
	echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"$tabinctyp\">";
	echo "<tr><td>";
	echo "Name&nbsp;<input name=\"deductname\" size=\"30\" value=\"$deductname\">";
	echo "</td>";
	echo "<td>";
	echo "</td>";
	echo "<td>";
	echo "</td>";
	echo "</tr>";
	echo "<tr><td>";
	echo "Total&nbsp;amount&nbsp;<input type=\"currency\" name=\"deducttotal\" size=\"10\" value=\"$deducttotal\">";
	echo "</td>";
	echo "<td>";
	echo "Amount&nbsp;for&nbsp;deduction&nbsp;<input type=\"currency\" name=\"deductamount\" size=\"10\" value=\"$deductamount\">";
	echo "</td>";
	echo "<td>";
	echo "Balance&nbsp;<input type=\"currency\" name=\"deductbalance\" size=\"10\" value=\"$deductbalance\">";
	echo "</td>";
	echo "</tr>";
	echo "<tr><td>";
echo "<input type=\"date\" name=\"datestart\" size=\"10\" value=\"$datestart\">";
		?>
	  <a href="javascript:show_calendar('document.finpaysysdededt.datestart', document.finpaysysdededt.datestart.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
	  <?php
	echo "From";
	echo "<br>";
	echo "<input type=\"date\" name=\"dateend\" size=\"10\" value=\"$dateend\">";
		?>
	  <a href="javascript:show_calendar('document.finpaysysdededt.dateend', document.finpaysysdededt.dateend.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
	  <?php
	echo "To";
	echo "</td>";

	if($schedule=="15th") { $schedsel15="selected"; $schedsel30=""; $schedselall=""; }
	else if($schedule=="30th") { $schedsel15=""; $schedsel30="selected"; $schedselall=""; }
	else if($schedule=="all") { $schedsel15=""; $schedsel30=""; $schedselall="selected"; }
	echo "<td>";
	echo "Schedule&nbsp;<select name=\"schedule\">";
	echo "<option value=\"all\" $schedselall>all</option>";
	echo "<option value=\"15th\" $schedsel15>15th only</option>";
	echo "<option value=\"30th\" $schedsel30>30th only</option>";
	echo "</select>";
	echo "</td>";

	if($status==1) { $stat1sel="checked"; }
	else if($status==0) { $stat1sel=""; }
	echo "<td>";
	echo "<input type=\"checkbox\" name=\"status\" $stat1sel>Active status";
	echo "</td>";
	echo "</tr>";
	echo "<tr><td colspan=\"3\" align=\"center\">";
	echo "<input type=\"submit\" value=\"Update\">";
	echo "</td></tr";
	echo "</form>";
	echo "</table>";

	echo "</td></tr>";

	echo "</table>";

	echo "</td></tr>";
	} // if($employeeid!="")
	
	echo "</td></tr>";

  } // endif accesslevel >= 4

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"$filesrc.php?loginid=$loginid&idpg=$idpaygroup&eid=$employeeid&tab=$tab\">Back</a></p>";

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
