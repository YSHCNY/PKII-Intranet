<?php

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrpersreq = (isset($_GET['idhpr'])) ? $_GET['idhpr'] :'';

$addreq = (isset($_POST['addreq'])) ? $_POST['addreq'] :'';
$candidate = (isset($_POST['candidate'])) ? $_POST['candidate'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

// validate again user's accesslevel
if(substr($level, -41, 1) == 1) {

	echo "<p><font size=1>Modules >> HR Personnel Request Form</font></p>";

	echo "<table width=\"100%\"><tr><td width=\"50%\">";
	// display 1st column HR Form 01
	// query tblhrpersreq
	$res15query="SELECT tblhrpersreq.requestdate, tblhrpersreq.requestedbyempid, tblhrpersreq.requestctr, tblhrpersreq.emptyp, tblhrpersreq.emptypothr, tblhrpersreq.positioncd, tblhrpersreq.deptcd, tblhrpersreq.reportstoposcd, tblhrpersreq.posfilltyp, tblhrpersreq.posfilltypempid, tblhrpersreq.posfilltypothr, tblhrpersreq.staffneeded, tblhrpersreq.jobdescresp, tblhrpersreq.jobdescduties, tblhrpersreq.dateneeded, tblhrpersreq.dateneedasap, tblhrpersreq.remarks, tblhrpersreq.endorsedate, tblhrpersreq.endorseempid, tblhrpersreq.endorsectr, tblhrpersreq.recoappricgempid, tblhrpersreq.recoappricgdate, tblhrpersreq.recoappricgctr, tblhrpersreq.recoapprdcgempid, tblhrpersreq.recoapprdcgdate, tblhrpersreq.recoapprdcgctr, tblhrpersreq.approveempid, tblhrpersreq.approvedate, tblhrpersreq.approvectr, tblhrpersreq.comments, tblhrpositionctg.name AS position FROM tblhrpersreq LEFT JOIN tblhrpositionctg ON tblhrpersreq.positioncd=tblhrpositionctg.idhrpositionctg WHERE idhrpersreq=$idhrpersreq";
	$result15=""; $ctr15=0; $found15=0;
	$result15 = $dbh2->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15 = $result15->fetch_assoc()) {
		$found15 = 1;
		$ctr15 = $ctr15 + 1;
		$requestdate15 = $myrow15['requestdate'];
		$requestedbyempid15 = $myrow15['requestedbyempid'];
		$requestctr15 = $myrow15['requestctr'];
		$emptyp15 = $myrow15['emptyp'];
		$emptypothr15 = $myrow15['emptypothr'];
		$positioncd15 = $myrow15['positioncd'];
		$deptcd15 = $myrow15['deptcd'];
		$reportstoposcd15 = $myrow15['reportstoposcd'];
		$posfilltyp15 = $myrow15['posfilltyp'];
		$posfilltypempid15 = $myrow15['posfilltypempid'];
		$posfilltypothr15 = $myrow15['posfilltypothr'];
		$staffneeded15 = $myrow15['staffneeded'];
		$jobdescresp15 = $myrow15['jobdescresp'];
		$jobdescduties15 = $myrow15['jobdescduties'];
		$dateneeded15 = $myrow15['dateneeded'];
		$dateneedasap15 = $myrow15['dateneedasap'];
		$remarks15 = $myrow15['remarks'];
		$endorsedate15 = $myrow15['endorsedate'];
		$endorseempid15 = $myrow15['endorseempid'];
		$endorsectr15 = $myrow15['endorsectr'];
		$recoappricgempid15 = $myrow15['recoappricgempid'];
		$recoappricgdate15 = $myrow15['recoappricgdate'];
		$recoappricgctr15 = $myrow15['recoappricgctr'];
		$recoapprdcgempid15 = $myrow15['recoapprdcgempid'];
		$recoapprdcgdate15 = $myrow15['recoapprdcgdate'];
		$recoapprdcgctr15 = $myrow15['recoapprdcgctr'];
		$approveempid15 = trim($myrow15['approveempid']);
		$approvedate15 = $myrow15['approvedate'];
		$approvectr15 = $myrow15['approvectr'];
		$comments15 = $myrow15['comments'];
		$position15 = strtoupper($myrow15['position']);
		} // while($myrow15=$result15->fetch_assoc())
	} // if($result15->num_rows>0)

	if($found15==1) {

	echo "<table width=\"100%\" class=\"fin\">";

	include '../vc/mhrpersreqdtl.php';

	include("./hrpersreqdtl2.php");

	//
	// comments/claritifcations
	if($pkintrausr=="noadm") {
	echo "<tr><th colspan=\"2\">comments/clarifications</th></tr>";
	echo "<form action=\"hrpersreqcomments.php?loginid=$loginid&idhpr=$idhrpersreq\" method=\"POST\" name=\"hrpersreqcomments\">";
	// query name of user
	$res18query="SELECT name_last, name_first, name_middle FROM tblcontact WHERE tblcontact.employeeid=\"$employeeid\" AND tblcontact.contact_type=\"personnel\"";
	$result18=""; $found18=0;
	$result18=$dbh2->query($res18query);
	if($result18->num_rows>0) {
		while($myrow18=$result18->fetch_assoc()) {
		$found18=1;
		$name_last18 = $myrow18['name_last'];
		$name_first18 = $myrow18['name_first'];
		$name_middle18 = $myrow18['name_middle'];
		} // while($myrow18=$result18->fetch_assoc())
	} // if($result18->num_rows>0)
	echo "<tr><td colspan=\"2\">$name_last18, $name_first18 $name_middle18[0]:<br>";
	echo "<textarea rows=\"3\" cols=\"70\" name=\"comments\"></textarea></td></tr>";
	// echo "<input type=\"hidden\" name=\"idhrpersreq\" value=\"$idhrpersreq\">";
	echo "<input type=\"hidden\" name=\"ctgactor\" value=\"$actor\">";
	echo "<input type=\"hidden\" name=\"eid\" value=\"$employeeid\">";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Submit comment\"></td></tr>";
	echo "</form>";
	} // if($pkintrausr=="noadm")
	echo "<tr><td colspan=\"2\">".nl2br($comments15)."</td></tr>";
	echo "</table>";
	} // if($found15==1)

	//
	//
	echo "</td>";
	//
	// display 2nd column Recruitment procedure
	//

	if($approvectr15>=1) {

	echo "<td width=\"50%\">";
	echo "<table width=\"100%\" class=\"fin\">";
	echo "<tr><th colspan=\"3\">RECRUITMENT PROCESS MONITORING</th></tr>";

	if($addreq==1) {

	echo "<tr><th colspan=\"3\">Add new candidate</th></tr>";
	echo "<form action=\"hrpersreqadd.php?loginid=$loginid&idhpr=$idhrpersreq\" method=\"POST\" name=\"hrpersreqadd\">";
	// row1
	echo "<tr><td colspan=\"3\" align=\"center\">";
	echo "<table class=\"fin\">";
	echo "<tr><td><font size=\"1\"><i>last name</i></font></td><td><font size=\"1\"><i>first name</i></font></td><td><font size=\"1\"><i>middle name</i></font></td></tr>";
	echo "<tr><td><input name=\"name_last\"></td><td><input name=\"name_first\"></td><td><input name=\"name_middle\"></td></tr>";
	echo "</table>";
	echo "</td></tr>";
	// row2
	echo "<tr><td colspan=\"3\" align=\"center\">";
	echo "<table class=\"fin\" width=\"100%\">";
	echo "<tr><td><font size=\"1\"><i>gender</i></font></td><td><font size=\"1\"><i>mobile number</i></font></td><td><font size=\"1\"><i>e-mail</i></td></tr>";
	echo "<tr><td>";
	echo "<select name=\"gender\">";
	echo "<option value=\"Male\">Male</option>";
	echo "<option value=\"Female\">Female</option>";
	echo "</select>";
	echo "</td><td>";
	echo "<table class=\"fin\">";
	echo "<tr><td>+<input size=\"1\" name=\"num_mobile1_cc\" value=\"63\"></td><td><input size=\"2\" name=\"num_mobile1_ac\"></td><td><input size=\"5\" name=\"num_mobile1\"></td></tr>";
	echo "<tr><td><font size=\"1\"><i>country cd</i></font></td><td><font size=\"1\"><i>area cd</i></font></td><td><font size=\"1\"><i>mobile number</i></font></td></tr>";
	echo "</table>";
	echo "</td><td><input type=\"email\" name=\"email1\"></td></tr>";
	echo "</table>";
	echo "</td></tr>";
	// row3
	echo "<tr><td colspan=\"3\" align=\"center\"><input type=\"submit\" value=\"Add\"></td></tr>";
	echo "</form>";

	} else { // if($addreq==1)

	// display add candidate button
	echo "<form action=\"hrpersreqdtl.php?loginid=$loginid&idhpr=$idhrpersreq\" method=\"POST\" name=\"hrpersreqdtl\">";
	echo "<input type=\"hidden\" name=\"addreq\" value=\"1\">";
	echo "<tr><td colspan=\"3\" align=\"center\"><input type=\"submit\" value=\"Add new candidate\"></td></tr>";
	echo "</form>";

	// query tblhrpersreqcand and display dropdown if exists
	echo "<form action=\"hrpersreqdtl.php?loginid=$loginid&idhpr=$idhrpersreq\" method=\"POST\" name=\"hrpersreqdtl\">";
	echo "<input type=\"hidden\" name=\"addreq\" value=\"0\">";
	echo "<tr><td colspan=\"3\" align=\"center\">candidates:<br>";
	echo "<select name=\"candidate\">";
	echo "<option value=''>-</option>";
	$res22query="SELECT tblhrpersreqcand.idhrpersreqcand, tblhrpersreqcand.contactid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrpersreqcand LEFT JOIN tblcontact ON tblhrpersreqcand.contactid=tblcontact.contactid WHERE tblhrpersreqcand.idhrpersreq=$idhrpersreq ORDER BY tblhrpersreqcand.timestamp ASC";
	$result22=""; $found22=0; $ctr22=0;
	$result22=$dbh2->query($res22query);
	if($result22->num_rows>0) {
		while($myrow22=$result22->fetch_assoc()) {
		$found22=1;
		$ctr22=$ctr22+1;
		$idhrpersreqcand22 = $myrow22['idhrpersreqcand'];
		$contactid22 = $myrow22['contactid'];
		$name_last22 = $myrow22['name_last'];
		$name_first22 = $myrow22['name_first'];
		$name_middle22 = $myrow22['name_middle'];
		if($idhrpersreqcand22==$candidate) { $candsel="selected"; } else { $candsel=""; }
		echo "<option value=\"$idhrpersreqcand22\" $candsel>$name_last22, $name_first22 $name_middle22[0]</option>";
		} // while($myrow22=$result22->fetch_assoc())
	} // if($result22->num_rows>0)
	echo "</select>";
	echo "<input type=\"submit\" value=\"Submit\"></td></tr>";
	echo "</form>";

	include("./hrpersreqdtl2.php");

	} // if($addreq==1)

	echo "</table></td>";

	} // if($approvectr15>=1)

	echo "</tr></table>";

} // if(substr($level, -41, 1) == 1)

	echo "<p><a href=\"hrpersreq.php?loginid=$loginid\">Back</a></p>";

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result = $dbh2->query($resquery);

     include ("footer.php");
} else {
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>