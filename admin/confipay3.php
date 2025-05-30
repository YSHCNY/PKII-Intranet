<?php 

require("db1.php");
include("datetimenow.php");
include("clsmcrypt.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$eid = (isset($_GET['eid'])) ? $_GET['eid'] :'';
// $gn = $_GET['gn'];
$groupname = (isset($_POST['groupname'])) ? $_POST['groupname'] :'';
$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';

$validatepw = (isset($_POST['vpw'])) ? $_POST['vpw'] :'';

if($eid!="") { $employeeid=$eid; }
$gn=null;
if($gn!="") { $groupname=$gn; }

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
?>
	<script language="JavaScript" src="ts_picker.js"></script>
	<html><head><STYLE TYPE="text/css">
	<!--
		Table {
			background:#D3E4E5;
			border:1px solid gray;
			border-collapse:collapse;
			font:normal 12px verdana, arial, helvetica, sans-serif;
		}
		TH {
			font-family: Helvetica; font-size: 10pt; font-weight: bold;
		}
	  TD {
	    font-family: Helvetica; font-size: 10pt
	  }
	  body {
	    font-family: verdana, arial, sans-serif
	  }
	  h1 {
	    font-size: 120%
	  color: brown
	  }
	  a {
	    text-decoration: none
	  }
	  p {
	    font-size: 90%
	  }
	--->
	</STYLE></head>
	<body>
<?php
     echo "<table class=\"fin\" width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";

	// check first for accesslevel
	$res16query="SELECT confipaygrpid, accesslevel FROM tblconfipaygrp WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\"";
	$result16=""; $found16=0; $ctr16=0;
	/*
	$result16 = mysql_query("$res16query", $dbh);
	if($result16 != "") {
		while($myrow16 = mysql_fetch_row($result16)) {
	*/
	$result16 = $dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16 = $result16->fetch_assoc()) {
		$found16 = 1;
		$confipaygrpid16 = $myrow16['confipaygrpid'];
		$confiaccesslevel = $myrow16['accesslevel'];
		}
	}

	// echo "<tr><td colspan=\"4\">test vpw:$validatepw, calvl:$confiaccesslevel</td></tr>";

// validate password if level 5
if($confiaccesslevel==5 && $validatepw==0) {
	$srcfile="confipay3.php";
	include("confipayvpw.php");
} else {
//     echo "<tr><td bgcolor=blue colspan=4><font color=white><b>Personnel Payroll Details</b></font></td></tr>";

// start main salary details

	// check if record exists in confipaymeminfo
		$found=0;
     $resquery="SELECT tblconfipaymeminfo.employeeid, tblconfipaymeminfo.empalias, tblconfipaymeminfo.netbasicpay, tblconfipaymeminfo.projallow, tblconfipaymeminfo.perdiem, tblconfipaymeminfo.transpoallow, tblconfipaymeminfo.vatstatus, tblconfipaymeminfo.wtaxstatus, tblconfipaymeminfo.exemptstatus, tblconfipaymeminfo.withholdingtax, tblconfipaymeminfo.wtaxopt2, tblconfipaymeminfo.wtaxmode, tblconfipaymeminfo.sssstatus, tblconfipaymeminfo.sssee, tblconfipaymeminfo.ssser, tblconfipaymeminfo.sssec, tblconfipaymeminfo.sssmode, tblconfipaymeminfo.philhealthstatus, tblconfipaymeminfo.philhealthee, tblconfipaymeminfo.philhealther, tblconfipaymeminfo.philhealthmode, tblconfipaymeminfo.pagibigee, tblconfipaymeminfo.pagibiger, tblconfipaymeminfo.pagibigmode, tblconfipaymeminfo.empstatus, tblconfipaymeminfo.confipaygrpid, tblconfipaymeminfo.pagibigee2, tblconfipaymeminfo.pagibiger2, tblconfipaymeminfo.pagibigman1, tblconfipaymeminfo.pagibigman2 FROM tblconfipaymeminfo WHERE tblconfipaymeminfo.employeeid=\"$employeeid\" AND tblconfipaymeminfo.groupname = \"$groupname\" ORDER BY tblconfipaymeminfo.employeeid ASC";
	/*
  if($result != "") {
		while($myrow = mysql_fetch_row($result)) {
	*/
	$result = $dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow = $result->fetch_assoc()) {
		$found = 1;
    $employeeid = $myrow['employeeid'];
		$empalias = $myrow['empalias'];
    $netbasicpay = $myrow['netbasicpay'];
		$projallow = $myrow['projallow'];
		$perdiem = $myrow['perdiem'];
		$transpoallow = $myrow['transpoallow'];
		$vatstatus = $myrow['vatstatus'];
		$wtaxstatus = $myrow['wtaxstatus'];
		$exemptstatus = $myrow['exemptstatus'];
    $withholdingtax = $myrow['withholdingtax'];
		$wtaxopt2 = $myrow['wtaxopt2'];
		$wtaxmode = $myrow['wtaxmode'];
		$sssstatus = $myrow['sssstatus'];
    $sssee = $myrow['sssee'];
    $ssser = $myrow['ssser'];
		$sssec = $myrow['sssec'];
		$sssmode = $myrow['sssmode'];
		$philhealthstatus = $myrow['philhealthstatus'];
    $philhealthee = $myrow['philhealthee'];
    $philhealther = $myrow['philhealther'];
		$philhealthmode = $myrow['philhealthmode'];
    $pagibigee = $myrow['pagibigee'];
    $pagibiger = $myrow['pagibiger'];
		$pagibigmode = $myrow['pagibigmode'];
    $empstatus = $myrow['empstatus'];
		$confipaygrpid = $myrow['confipaygrpid'];
		$pagibigee2 = $myrow['pagibigee2'];
		$pagibiger2 = $myrow['pagibiger2'];
		$pagibigman1 = $myrow['pagibigman1'];
		$pagibigman2 = $myrow['pagibigman2'];
		}
	}

	if($found==1) {

	// check accesslevel if 5 and decrypt
	include("mcryptdec.php");

	$res12query="SELECT name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$employeeid\" AND contact_type=\"personnel\"";
	$result12=""; $found12=0; $ctr12=0;
	/*
	$result12 = mysql_query("$res12query", $dbh);
	if($result12 != "") {
		while($myrow12 = mysql_fetch_row($result12)) {
	*/
	$result12 = $dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12 = $result12->fetch_assoc()) {
		$found12 = 1;
		$name_first12 = $myrow12['name_first'];
		$name_middle12 = $myrow12['name_middle'];
		$name_last12 = $myrow12['name_last'];
		}
	}
	// 20180814 display name w/ delete button
	echo "<form action=\"confipaydelindiv.php?loginid=$loginid&cpgid=$confipaygrpid16\" method=\"POST\" name=\"confipaydelindiv\">";
	echo "<tr><th colspan=\"4\">";
	if($empalias!="") {
	echo "*** - $empalias";
	echo "<input type=\"hidden\" name=\"confipayempalias\" value=\"$empalias\">";
	} else {
	echo "$employeeid - $name_first12 $name_middle12 $name_last12";
	} // if
	echo "<input type=\"hidden\" name=\"confipayemployeeid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"confipaygrpid\" value=\"$confipaygrpid16\">";
	// echo "|cal:$confiaccesslevel|cgpgid:$confipaygrpid16<br>$res16query";
	echo "<br><input type=\"submit\" value=\"Delete this personnel from this pay group\" />";
	echo "</th></tr>";
	echo "</form>";

	include("mcryptenc.php");


//
// form1: main payroll info
        echo "<tr><th colspan=\"4\">MAIN PAYROLL DETAILS</th></tr>";
	echo "<FORM METHOD=\"POST\" ACTION=\"confipay3a.php?loginid=$loginid&cpgid=$confipaygrpid\">";
	echo "<input type=\"hidden\" name=\"eid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"gn\" value=\"$groupname\">";

	if($confiaccesslevel==5 && $accesslevel==5) {
	include("mcryptdec.php");
	echo "<tr><th colspan=\"4\">Alias:<input name=\"empalias\" value=\"$empalias\"></th></tr>";
	include("mcryptenc.php");
	}

	echo "<tr><td>Prof. Fee (1/2 mo.)<br>";
	echo "<INPUT NAME=netbasicpay VALUE=$netbasicpay size=\"10\"><br>";

	if($vatstatus == "on") { $vatstatuscheck = "checked"; }
	else if($vatstatus == "off") { $vatstatuscheck = ""; }
        echo "<input type=\"checkbox\" name=\"vatstatus\" $vatstatuscheck>VAT Inclusive</input></td>";

	echo "<td>Project Allow. (1/2 mo.)<br>";
	echo "<input name=\"projallow\" value=\"$projallow\" size=\"10\"></td>";

	echo "<td>Per diem (1/2 mo.)<br>";
	echo "<input name=\"perdiem\" value=\"$perdiem\" size=\"10\"></td>";

	echo "<td>Transportation Allow. (1/2 mo.)<br>";
	echo "<input name=\"transpoallow\" value=\"$transpoallow\" size=\"10\"></td></tr>";

	echo "<tr><th colspan=\"4\"><br>Withholding Tax</th></tr>";
	if($wtaxmode == "auto") { $autochecked = "checked"; }
	else if($wtaxmode == "manual") { $manualchecked = "checked"; }
	else if($wtaxmode == "percent") { $percentchecked = "checked"; }
	else { $autochecked = "checked"; }
	echo "<tr><td><input type=\"radio\" name=\"wtaxmode\" value=\"auto\" $autochecked>Auto Compute</td>";
	echo "<td colspan=\"2\" align=\"center\"><input type=\"radio\" name=\"wtaxmode\" value=\"manual\" $manualchecked>Manual</td>";
	echo "<td><input type=\"radio\" name=\"wtaxmode\" value=\"percent\" $percentchecked>By Percentage</td></tr>";

	echo "<tr><td>&nbsp;</td>";
	/*
	echo "<tr><td>Withholding Tax<br>";
	if($wtaxstatus == 'on')
	{
	  echo "<INPUT TYPE=CHECKBOX NAME=wtaxstatus CHECKED>AutoCompute<br>";
	}
	else
	{
          echo "<INPUT TYPE=CHECKBOX NAME=wtaxstatus>AutoCompute<br>";
	}
	echo "</td>";
	*/

	echo "<td>Exemption Status<br><select name=exemptstatus>";
	if($exemptstatus == 'Z' or $exemptstatus == '')
	{
	  echo "<option value='Z' selected='selected'>Z</option>";
	  echo "<option value='S/ME'>S/ME</option>";
	  echo "<option value='ME1/S1'>ME1/S1</option>";
	  echo "<option value='ME2/S2'>ME2/S2</option>";
	  echo "<option value='ME3/S3'>ME3/S3</option>";
	  echo "<option value='ME4/S4'>ME4/S4</option>";
	}
	else if($exemptstatus == 'S/ME')
	{
	  echo "<option value='Z'>Z</option>";
	  echo "<option value='S/ME' selected='selected'>S/ME</option>";
	  echo "<option value='ME1/S1'>ME1/S1</option>";
	  echo "<option value='ME2/S2'>ME2/S2</option>";
	  echo "<option value='ME3/S3'>ME3/S3</option>";
	  echo "<option value='ME4/S4'>ME4/S4</option>";
	}
	else if($exemptstatus == 'ME1/S1')
	{
	  echo "<option value='Z'>Z</option>";
	  echo "<option value='S/ME'>S/ME</option>";
	  echo "<option value='ME1/S1' selected='selected'>ME1/S1</option>";
	  echo "<option value='ME2/S2'>ME2/S2</option>";
	  echo "<option value='ME3/S3'>ME3/S3</option>";
	  echo "<option value='ME4/S4'>ME4/S4</option>";
	}
	else if($exemptstatus == 'ME2/S2')
	{
	  echo "<option value='Z'>Z</option>";
	  echo "<option value='S/ME'>S/ME</option>";
	  echo "<option value='ME1/S1'>ME1/S1</option>";
	  echo "<option value='ME2/S2' selected='selected'>ME2/S2</option>";
	  echo "<option value='ME3/S3'>ME3/S3</option>";
	  echo "<option value='ME4/S4'>ME4/S4</option>";
	}
	else if($exemptstatus == 'ME3/S3')
	{
	  echo "<option value='Z'>Z</option>";
	  echo "<option value='S/ME'>S/ME</option>";
	  echo "<option value='ME1/S1'>ME1/S1</option>";
	  echo "<option value='ME2/S2'>ME2/S2</option>";
	  echo "<option value='ME3/S3' selected='selected'>ME3/S3</option>";
	  echo "<option value='ME4/S4'>ME4/S4</option>";
	}
	else if($exemptstatus == 'ME4/S4')
	{
	  echo "<option value='Z'>Z</option>";
	  echo "<option value='S/ME'>S/ME</option>";
	  echo "<option value='ME1/S1'>ME1/S1</option>";
	  echo "<option value='ME2/S2'>ME2/S2</option>";
	  echo "<option value='ME3/S3'>ME3/S3</option>";
	  echo "<option value='ME4/S4' selected='selected'>ME4/S4</option>";
	}

	echo "</td><td valign=bottom>Withholding Tax<br><INPUT NAME=withholdingtax VALUE=$withholdingtax  size=\"10\"></td>";

	echo "<td>Withholding Tax (option 2)<br>";
	if($wtaxopt2 == 10) { $tenpercent = "selected"; }
	else if($wtaxopt2 == 15) { $fifteenpercent = "selected"; }
	else { $noneselected = "selected"; }
	echo "<select name=\"wtaxopt2\">";
	  echo "<option value=\"10\" $tenpercent>10%</option>";
	  echo "<option value=\"15\" $fifteenpercent>15%</option>";
	echo "</select>";
	echo "</td></tr>";

	echo "<tr><th colspan=\"4\"><br>SSS</th></tr>";
	if($sssmode == "auto") { $autochecked = "checked"; $manualchecked=""; $offchecked=""; }
	else if($sssmode == "manual") { $autochecked=""; $manualchecked = "checked"; $offchecked=""; }
	else if($sssmode == "off") { $autochecked=""; $manualchecked=""; $offchecked = "checked"; }
	else { $offchecked = "checked"; }
	echo "<tr><td><input type=\"radio\" name=\"sssmode\" value=\"auto\" $autochecked>Auto Compute</td>";
	echo "<td colspan=\"2\" align=\"center\"><input type=\"radio\" name=\"sssmode\" value=\"manual\" $manualchecked>Manual</td>";
	echo "<td><input type=\"radio\" name=\"sssmode\" value=\"off\" $offchecked>Off</td></tr>";

	echo "<tr><td>&nbsp;</td>";
	/*
	echo "<tr><td>SSS<br>";
	if($sssstatus == 'on')
	{
	  echo "<INPUT TYPE=CHECKBOX NAME=sssstatus CHECKED>AutoCompute<br>";
	}
	else
	{
          echo "<INPUT TYPE=CHECKBOX NAME=sssstatus>AutoCompute<br>";
	}
	echo "</td>";
	*/

	echo "<td>SSS EE<br>";
	echo "<INPUT NAME=sssee VALUE=$sssee size=\"10\"></td>";
	echo "<td>SSS ER<br>";
	echo "<INPUT NAME=ssser VALUE=$ssser size=\"10\"></td>";
	echo "<td>SSS EC<br>";
	echo "<INPUT NAME=sssec VALUE=$sssec size=\"10\"></td></tr>";

	echo "<tr><th colspan=\"4\"><br>Philhealth</th></tr>";
	if($philhealthmode == "auto") { $autochecked = "checked"; $manualchecked = ""; $offchecked=""; }
	else if($philhealthmode == "manual") { $manualchecked = "checked"; $autochecked=""; $offchecked=""; }
	else if($philhealthmode == "off") { $offchecked = "checked"; $autochecked=""; $manualchecked=""; }
	else { $offchecked = "checked"; }
	echo "<tr><td><input type=\"radio\" name=\"philhealthmode\" value=\"auto\" $autochecked>Auto Compute</td>";
	echo "<td colspan=\"2\" align=\"center\"><input type=\"radio\" name=\"philhealthmode\" value=\"manual\" $manualchecked>Manual</td>";
	echo "<td><input type=\"radio\" name=\"philhealthmode\" value=\"off\" $offchecked>Off</td></tr>";

	echo "<tr><td>&nbsp;</td>";
	/*
	echo "<tr><td>Philhealth<br>";
	if($philhealthstatus == 'on')
	{
	  echo "<INPUT TYPE=CHECKBOX NAME=philhealthstatus CHECKED>AutoCompute<br>";
	}
	else
	{
          echo "<INPUT TYPE=CHECKBOX NAME=philhealthstatus>AutoCompute<br>";
	}
	echo "</td>";
	*/

	echo "<td>Philhealth EE<br>";
	echo "<INPUT NAME=philhealthee VALUE=$philhealthee size=\"10\"></td>";
	echo "<td>Philhealth ER<br>";
	echo "<INPUT NAME=philhealther VALUE=$philhealther size=\"10\"></td>";
	echo "<td colspan=2>&nbsp;</td></tr>";

	echo "<tr><th colspan=\"4\"><br>Pag-IBIG</td></tr>";
	if($pagibigmode == "manual") { $manualchecked = "checked"; $offchecked=""; }
	else if($pagibigmode == "off") { $offchecked = "checked"; $manualchecked=""; }
	echo "<td>&nbsp;</td><td colspan=\"2\" align=\"center\"><input type=\"radio\" name=\"pagibigmode\" value=\"manual\" $manualchecked>Manual</td>";
	echo "<td><input type=\"radio\" name=\"pagibigmode\" value=\"off\" $offchecked>Off</td></tr>";

	echo "<tr><td></td>";
	if($pagibigman1==1) { $pagibigman1sel="checked"; } else { $pagibigman1sel=""; }
	echo "<td><input type=\"checkbox\" name=\"pagibigman1\" $pagibigman1sel>Compute 1st half (1-15)</td>";
	if($pagibigman2==1) { $pagibigman2sel="checked"; } else { $pagibigman2sel=""; }
	echo "<td><input type=\"checkbox\" name=\"pagibigman2\" $pagibigman2sel>Compute 2nd half (16-31)</td>";
	echo "<td></td></tr>";

	echo "<tr><td align=\"right\"></td><td><b>EE</b> - 1st half<br>";
	echo "<INPUT NAME=pagibigee VALUE=$pagibigee size=\"10\"></td>";
	echo "<td><b>EE</b> - 2nd half<br>";
	echo "<INPUT NAME=\"pagibigee2\" VALUE=\"$pagibigee2\" size=\"10\">";
	echo "<td>&nbsp;</td></tr>";

	echo "<tr><td align=\"right\"></td><td><b>ER</b> - 1st half<br>";
	echo "<INPUT NAME=pagibiger VALUE=$pagibiger size=\"10\"></td></td>";
	echo "<td><b>ER</b> - 2nd half<br>";
	echo "<INPUT NAME=\"pagibiger2\" VALUE=\"$pagibiger2\" size=\"10\"></td>";
	echo "<td>&nbsp;</td></tr>";

	echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";

	echo "<tr><td>";
	if($empstatus == 'active')
	{
	  echo "<INPUT TYPE=\"CHECKBOX\" NAME=\"empstatus\" CHECKED=ON>Active<br>";
	}
	else
	{
          echo "<INPUT TYPE=\"CHECKBOX\" NAME=\"empstatus\">Active<br>";
	}
	echo "</td>";
	echo "<td colspan=\"3\" align=\"center\"><INPUT TYPE=SUBMIT VALUE=Update></td></tr>";
	echo "</FORM>";

  } else { // if($found==1)

	include("mcryptdec.php");

	$res2query="SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$employeeid\"";
	// while ($myrow2 = mysql_fetch_row($result2)) {
	$result2=""; $found2=0; $ctr2=0;
	$result2 = $dbh2->query($res2query);
	if($result1->num_rows>0) {
		while($myrow1 = $result1->fetch_assoc()) {
	  $found2 = 1;
	  $employeeid = $myrow2['employeeid'];
	  $name_first = $myrow2['name_first'];
	  $name_middle = $myrow2['name_middle'];
	  $name_last = $myrow2['name_last'];
    } // while($myrow1 = $result1->fetch_assoc())
	} // if($result1->num_rows>0)

	  echo "<tr><th>$employeeid - $name_first $name_middle $name_last</th></tr>";

	include("mcryptenc.php");

	// query confipaygrpid
	$res14query="SELECT confipaygrpid FROM tblconfipaygrp WHERE groupname=\"$groupname\" AND employeeid=\"$employeeid\"";
	$result14=""; $found14=0; $ctr14=0;
	/*
	$result14 = mysql_query("$res14query", $dbh);
	if($result14 != "") {
		while($myrow14 = mysql_fetch_row($result14)) {
	*/
	$result14 = $dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14 = $result14->fetch_assoc()) {
		$found14 = 1;
		$confipaygrpid = $myrow14['confipaygrpid'];
		}
	}

	  echo "<tr><td align=\"center\"><FORM METHOD=\"POST\" ACTION=\"confipaynewmain.php?loginid=$loginid&cpgid=$confipaygrpid\">";
		echo "<input type=\"hidden\" name=\"eid\" value=\"$employeeid\">";
		echo "<input type=\"hidden\" name=\"gn\" value=\"$groupname\">";
	  echo "<INPUT TYPE=\"SUBMIT\" VALUE=\"Add Salary Details\"><br>";
	  echo "</FORM></td></tr>";

	} // if($found==1)



//
// form2: addition or other income
	echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
     echo "<tr><th colspan=\"4\"><i>OTHER INCOME</i></th></tr>";

	echo "<tr><td colspan=\"4\" align=\"center\"><FORM METHOD=\"POST\" ACTION=\"confipaynewadd.php?loginid=$loginid&cpgid=$confipaygrpid\">";
	echo "<input type=\"hidden\" name=\"eid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"gn\" value=\"$groupname\">"; 
	echo "<INPUT TYPE=\"SUBMIT\" VALUE=\"Add New Additional Income\">";
	echo "</FORM></td></tr>";

		$resquery="SELECT tblconfipaymemadd.confipayaddid, tblconfipaymemadd.employeeid, tblconfipaymemadd.nameadd, tblconfipaymemadd.addtotalamount, tblconfipaymemadd.addamount, tblconfipaymemadd.addbalamount, tblconfipaymemadd.startadd, tblconfipaymemadd.endadd, tblconfipaymemadd.nontaxable, tblconfipaymemadd.statusadd, tblconfipaymemadd.addincomevatincl FROM tblconfipaymemadd WHERE tblconfipaymemadd.employeeid=\"$employeeid\" AND tblconfipaymemadd.groupname=\"$groupname\"";
     // while ($myrow = mysql_fetch_row($result)) {
		$result=""; $found=0; $ctr=0;
		$result = $dbh2->query($resquery);
		if($result->num_rows>0) {
			while($myrow = $result->fetch_assoc()) {
	$found = 1;
	$confipayaddid = $myrow['confipayaddid'];
        $employeeid = $myrow['employeeid'];
	$nameadd = $myrow['nameadd'];
//	$addtotalamount = $myrow[3];
	$addamount = $myrow['addamount'];
//	$addbalamount = $myrow[5];
	$startadd = $myrow['startadd'];
	$endadd = $myrow['endadd'];
	$nontaxable = $myrow['nontaxable'];
	$statusadd = $myrow['statusadd'];
	$addincomevatincl = $myrow['addincomevatincl'];

	$cutoffstart = split("-", $startadd);
	$yearstart = $cutoffstart[0];
	$monthstart = $cutoffstart[1];
	$daystart = $cutoffstart[2];

	$cutoffend = split("-", $endadd);
	$yearend = $cutoffend[0];
	$monthend = $cutoffend[1];
	$dayend = $cutoffend[2];

	echo "<FORM METHOD=\"POST\" ACTION=\"confipay3b.php?loginid=$loginid&cpgid=$confipaygrpid&addid=$confipayaddid\" name=\"frmcfpmemadd\">";
	echo "<input type=\"hidden\" name=\"eid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"gn\" value=\"$groupname\">";

	echo "<tr><td>Name<br><INPUT NAME=nameadd VALUE=$nameadd></td><td>Amount<br><INPUT NAME=addamount VALUE=$addamount size=\"10\"></td>";
	echo "<td>DateStart<br>";
	// modified 20161130
	// echo "$startadd <a href=\"confipay3chgdatestartadd.php?loginid=$loginid&eid=$employeeid&addid=$confipayaddid&gn=$groupname&startadd=$startadd\">Change</a><br>";
	echo "<input type=\"date\" size=\"8\" name=\"cfpmaddstart\" value=\"$startadd\">";
	?>
  	<a href="javascript:show_calendar('document.frmcfpmemadd.cfpmaddstart', document.frmcfpmemadd.cfpmaddstart.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  <?php
	echo "<br><font size=2><i>yyyy-mm-dd</i></font></td>";

	echo "<td>DateEnd<br>";
	// modified 20161130
	// echo "$endadd <a href=\"confipay3chgdateendadd.php?loginid=$loginid&eid=$employeeid&addid=$confipayaddid&gn=$groupname&endadd=$endadd\">Change</a><br>";
	echo "<input type=\"date\" size=\"8\" name=\"cfpmaddend\" value=\"$endadd\">";
	?>
  	<a href="javascript:show_calendar('document.frmcfpmemadd.cfpmaddend', document.frmcfpmemadd.cfpmaddend.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  <?php
	echo "<br><font size=2><i>yyyy-mm-dd</i></font></td></tr>";

	echo "<tr><td>";

	if($nontaxable == 'yes') {
	  echo "<INPUT TYPE=CHECKBOX NAME=nontaxable CHECKED>Non-taxable";
	} else {
	  echo "<INPUT TYPE=CHECKBOX NAME=nontaxable>Non-taxable";
	  echo "&nbsp;";
	  if($addincomevatincl == 'yes') {
	    echo "<INPUT TYPE=\"checkbox\" NAME=\"addincomevatincl\" CHECKED>VAT Incl.";
	  } else {
	    echo "<INPUT TYPE=\"checkbox\" NAME=\"addincomevatincl\">VAT Incl.";
	  } // if($addincomevatincl == 'yes')
	} // if($nontaxable == 'yes')

	echo "</td><td>";

	if($statusadd == 'active') {
		echo "<INPUT TYPE=CHECKBOX NAME=statusadd CHECKED>Active";
	} else {
		echo "<INPUT TYPE=CHECKBOX NAME=statusadd>Active";
	} // if($statusadd == 'active')
	echo "</td>";

	echo "<td><INPUT TYPE=\"SUBMIT\" VALUE=\"Update\"></td>";
	echo "</FORM>";

	echo "<FORM METHOD=\"POST\" ACTION=\"confipaydeladd.php?loginid=$loginid&eid=$employeeid&gn=$groupname&addid=$confipayaddid\">";
	echo "<td><INPUT TYPE=\"SUBMIT\" VALUE=\"Remove\"></td>";
	echo "</tr>";
	echo "</FORM>";
   } // while($myrow = $result->fetch_assoc())
	} // if($result->num_rows>0)


//
// form3: deductions
	echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
     echo "<tr><th colspan=4><i>DEDUCTIONS</i></th></tr>";

	echo "<tr><td colspan=4 align=\"center\"><FORM METHOD=\"POST\" ACTION=\"confipaynewdeduct.php?loginid=$loginid&cpgid=$confipaygrpid\" name=\"frmcfpdeduct\">";
	echo "<input type=\"hidden\" name=\"eid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"gn\" value=\"$groupname\">"; 
	echo "<INPUT TYPE=\"SUBMIT\" VALUE=\"Add New Deduction\">";
	echo "</FORM></td></tr>";

  $res15query="SELECT confipaydeductid, timestamp, loginid, employeeid, groupname, namededuct, deducttotalamount, deductamount, deductbalamount, startdeduct, enddeduct, statusdeduct, confipaygrpid FROM tblconfipaymemdeduct WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\"";
	$result15=""; $found15=0; $ctr15=0;
	/*
	$result15 = mysql_query("$res15query", $dbh);
	if($result15 != "") {
		while($myrow15 = mysql_fetch_row($result15)) {
	*/
	$result15 = $dbh2->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15 = $result15->fetch_assoc()) {
		$found15=1;
		$confipaydeductid15 = $myrow15['confipaydeductid'];
		$timestamp15 = $myrow15['timestamp'];
		$loginid15 = $myrow15['loginid'];
		$employeeid15 = $myrow15['employeeid'];
		$groupname15 = $myrow15['groupname'];
		$namededuct15 = $myrow15['namededuct'];
		$deducttotalamount15 = $myrow15['deducttotalamount'];
		$deductamount15 = $myrow15['deductamount'];
		$deductbalamount15 = $myrow15['deductbalamount'];
		$startdeduct15 = $myrow15['startdeduct'];
		$enddeduct15 = $myrow15['enddeduct'];
		$statusdeduct15 = $myrow15['statusdeduct'];
		$confipaygrpid15 = $myrow15['confipaygrpid'];

	echo "<FORM METHOD=\"POST\" ACTION=\"confipay3c.php?loginid=$loginid&deductid=$confipaydeductid15\" name=\"frmconfipay3c\">";
	echo "<input type=\"hidden\" name=\"cpgid\" value=\"$confipaygrpid15\">";
	echo "<input type=\"hidden\" name=\"eid\" value=\"$employeeid15\">";
	echo "<input type=\"hidden\" name=\"gn\" value=\"$groupname15\">";

	echo "<tr><td>Name<br><INPUT NAME=\"namededuct\" VALUE=\"$namededuct15\"></td><td>Total<br><INPUT NAME=\"deducttotalamount\" VALUE=\"$deducttotalamount15\" size=\"10\"></td><td>Amount<br><INPUT NAME=\"deductamount\" VALUE=\"$deductamount15\" size=\"10\"></td><td>Balance<br><INPUT NAME=\"deductbalamount\" VALUE=\"$deductbalamount15\" size=\"10\"></td></tr>";

	echo "<tr><td></td>";
	/*
	if($deducttaxable == "yes")
	{
	  echo "<input type=\"checkbox\" name=\"deducttaxable\" checked>Taxable";
	}
	else
	{
	  echo "<input type=\"checkbox\" name=\"deducttaxable\">Taxable";
	}
        echo "</td>";
	*/

	echo "<td>";
	if($statusdeduct15 == 'active')
	{
          echo "<INPUT TYPE=CHECKBOX NAME=statusdeduct CHECKED>Active";
	}
	else
	{
          echo "<INPUT TYPE=CHECKBOX NAME=statusdeduct>Active";
	}
	echo "</td><td>";
	echo "<INPUT TYPE=\"SUBMIT\" VALUE=\"Update\"></td>";
	echo "</FORM>";

	echo "<FORM METHOD=\"POST\" ACTION=\"confipaydeldeduct.php?loginid=$loginid&eid=$employeeid15&gn=$groupname15&deductid=$confipaydeductid15\">";
	echo "<td><INPUT TYPE=\"SUBMIT\" VALUE=\"Remove\"></td>";
	echo "</tr>";
	echo "</FORM>";

		} // while($myrow15 = $result15->fetch_assoc())
	} // if($result15->num_rows>0)


//
// form5: projects involvement
    echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
    echo "<tr><th colspan=\"4\"><i>ACTIVE PROJECTS</i></th></tr>";

    // add project to list
    echo "<form name=\"projselection\" method=\"post\" action=\"confipaymemprojadd.php?loginid=$loginid&cpgid=$confipaygrpid>";
		echo "<input type=\"hidden\" name=\"eid\" value=\"$employeeid\">";
		echo "<input type=\"hidden\" name=\"gn\" value=\"$groupname\">";

		include("mcryptdec.php");

    echo "<tr><td colspan=\"4\">";
    echo "<select name=\"projassignid\">";
		/*
    $result10 = mysql_query("SELECT projassignid, ref_no, proj_code, proj_name, position, durationfrom, durationto, durationfrom2, durationto2, term_resign FROM tblprojassign WHERE employeeid=\"$employeeid\" ORDER BY durationfrom ASC, durationfrom2 ASC", $dbh);
    if($result10 != '') {
      while ($myrow10 = mysql_fetch_row($result10)) {
		*/
		$res10query="SELECT projassignid, ref_no, proj_code, proj_name, position, durationfrom, durationto, durationfrom2, durationto2, term_resign FROM tblprojassign WHERE employeeid=\"$employeeid\" ORDER BY durationfrom ASC, durationfrom2 ASC";
		$result10=""; $found10=0; $ctr10=0;
		$result10 = $dbh2->query($res10query);
		if($result10->num_rows>0) {
			while($myrow10 = $result10->fetch_assoc()) {
      $found10 = 1;
      $projassignid = $myrow10['projassignid'];
      $ref_no = $myrow10['ref_no'];
      $proj_code = $myrow10['proj_code'];
      $proj_name = $myrow10['proj_name'];
      $position = $myrow10['position'];
      $durationfrom = $myrow10['durationfrom'];
      $durationto = $myrow10['durationto'];
      $durationfrom2 = $myrow10['durationfrom2'];
      $durationto2 = $myrow10['durationto2'];
      $term_resign = $myrow10['term_resign'];
      echo "<option value=\"$projassignid\">$proj_code $proj_name $position $durationfrom-$durationto</option>";
      $found10 = 0;
      }
    }
    echo "</select><input type=\"submit\" value=\"Add\"></td></tr>";
    echo "</form>";

// form6: man-months computation
    echo "<tr><td colspan=\"4\">";

    // display saved projects
    echo "<table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>Project</td><td>Position</td><td>From</td><td>To</td><td>Total</td><td>Paid</td><td>Requested</td><td>Balance</td><td>ContractAmt</td><td>AmtPaid</td><td>AmtRequested</td><td>AmtBal</td><td>Details</td><td colspan=\"2\">Action</td></tr>";

		include("mcryptenc.php");

    echo "<FORM METHOD=\"POST\" ACTION=\"confipay3projects.php?loginid=$loginid&cpgid=$confipaygrpid>";
		echo "<input type=\"hidden\" name=\"eid\" value=\"$employeeid\">";
		echo "<input type=\"hidden\" name=\"gn\" value=\"$groupname\">";

	/*
    $result11 = mysql_query("SELECT confipaymemprojid, proj_code, proj_name, position, durationfrom, durationto, durationfrom2, durationto2, manmonths, manmonthscurr, manmonthsreq, manmonthsbal, lumpsum, lumpsumcurr, lumpsumreq, lumpsumbal, amount, current, requested, balance, details FROM tblconfipaymemproj WHERE (employeeid=\"$employeeid\" AND groupname=\"$groupname\") OR confipaygrpid=$confipaygrpid11", $dbh);
    while($myrow11 = mysql_fetch_row($result11)) {
	*/
	$res11query="SELECT confipaymemprojid, proj_code, proj_name, position, durationfrom, durationto, durationfrom2, durationto2, manmonths, manmonthscurr, manmonthsreq, manmonthsbal, lumpsum, lumpsumcurr, lumpsumreq, lumpsumbal, amount, current, requested, balance, details FROM tblconfipaymemproj WHERE (employeeid=\"$employeeid\" AND groupname=\"$groupname\") OR confipaygrpid=$confipaygrpid11";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
	$found11 = 1;
	$confipaymemprojid11 = $myrow11['confipaymemprojid'];
	$proj_code11 = $myrow11['proj_code'];
	$proj_name11 = $myrow11['proj_name'];
	$position11 = $myrow11['position'];
	$durationfrom11 = $myrow11['durationfrom'];
	$durationto11 = $myrow11['durationto'];
	$durationfrom211 = $myrow11['durationfrom2'];
	$durationto211 = $myrow11['durationto2'];
	$manmonths11 = $myrow11['manmonths'];
	$manmonthscurr11 = $myrow11['manmonthscurr'];
	$manmonthsreq11 = $myrow11['manmonthsreq'];
	$manmonthsbal11 = $myrow11['manmonthsbal'];
	$lumpsum11 = $myrow11['lumpsum'];
	$lumpsumcurr11 = $myrow11['lumsumcurr'];
	$lumpsumreq11 = $myrow11['lumpsumreq'];
	$lumpsumbal11 = $myrow11['lumsumbal'];
	$amount11 = $myrow11['amount'];
	$current11 = $myrow11['current'];
	$requested11 = $myrow11['requested'];
	$balance11 = $myrow11['balance'];
	$details11 = $myrow11['details'];

      echo "<tr><input type=\"hidden\" name=\"confipaymemprojid[]\" value=\"$confipaymemprojid11\" checked=\"checked\">";
      if($proj_name11 != '') { echo "<td>$proj_name11</td>"; }
      else { echo "<td>$proj_code11</td>"; }
      echo "<td>$position11</td>";
      echo "<td>$durationfrom11";
      if($durationfrom211 != '0000-00-00') { echo "<br>$durationfrom211"; }
      echo "</td><td>$durationto11";
      if($durationto211 != '0000-00-00') { echo "<br>$durationto211"; }
      echo "</td>";
      echo "<td>man-months<input name=\"manmonths[]\" value=\"$manmonths11\" size=\"3\"><br>lumpssum<input name=\"lumpsum[]\" value=\"$lumpsum11\" size=\"3\"></td>";
      echo "<td>man-months<input name=\"manmonthscurr[]\" value=\"$manmonthscurr11\" size=\"3\"><br>lumpsum<input name=\"lumpsumcurr[]\" value=\"$lumpsumcurr11\" size=\"3\"></td>";
      echo "<td>man-months<input name=\"manmonthsreq[]\" value=\"$manmonthsreq11\" size=\"3\"><br>lumpsum<input name=\"lumpsumreq[]\" value=\"$lumpsumreq11\" size=\"3\"></td>";
      echo "<td>man-months<input name=\"manmonthsbal[]\" value=\"$manmonthsbal11\" size=\"3\"><br>lumpsum<input name=\"lumpsumbal[]\" value=\"$lumpsumbal11\" size=\"3\"></td>";
      echo "<td><input name=\"amount[]\" value=\"$amount11\" size=\"5\"></td><td><input name=\"current[]\" value=\"$current11\"size=\"5\"></td><td><input name=\"requested[]\" value=\"$requested11\"size=\"5\"></td><td><input name=\"balance[]\" value=\"$balance11\"size=\"5\"></td>";
      echo "<td><input name=\"details[]\" value=\"$details11\"></td>";
      echo "<td><a href=\"confipaymemprojdel.php?loginid=$loginid&cmpid=$confipaymemprojid11\">Del</a></td></tr>";

      $found11 = 0;
    } // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)

    echo "</table>";
    echo "</td></tr>";
    echo "<tr><td colspan=\"4\" align=\"center\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Update\"></td></tr>";
		echo "</form>";

} // if($confiaccesslevel==5 && $accesslevel==5)

     echo "</table>";


?>
     </body></html>
<?php
}
else
{
     include("logindeny.php");
}

//mysql_close($dbh);
$dbh2->close();
?> 
