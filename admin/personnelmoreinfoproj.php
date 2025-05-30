<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$projassignid = $_GET['prjid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     // include ("sidebar.php");

     // echo "<p><font size=1>Directory >> Manage Personnel >> Edit Project Assignment</font></p>";

     echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th colspan=\"2\" align=\"center\">Personnel Project Info</th></tr>";

     if ($employeeid == '')
     {
	echo "<tr><th colspan=\"2\"><font color=red>Sorry. No data available</font></th></tr>";
     }
     else
     {

	$result = mysql_query("SELECT name_last, name_first, name_middle, position FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow = mysql_fetch_row($result))
	{
	  $found = 1;
	  $name_last = $myrow[0];
	  $name_first = $myrow[1];
	  $name_middle = $myrow[2];
	  $position = $myrow[3];
	}

	echo "<tr><th colspan=\"2\">For: $employeeid - $name_last, $name_first $name_middle[0] - $position</th></tr>";

// start project assignments

	$result3 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.projdate, tblprojassign.ref_no, tblprojassign.employeeid, tblprojassign.employeeid0, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.empprojctr, tblprojassign.position, tblprojassign.salary, tblprojassign.salarycurrency, tblprojassign.salarytype, tblprojassign.allow_inc, tblprojassign.allow_inc_currency, tblprojassign.allow_inc_paytype, tblprojassign.allow_proj, tblprojassign.allow_proj_currency, tblprojassign.allow_proj_paytype, tblprojassign.ecola1, tblprojassign.ecola1_currency, tblprojassign.ecola2, tblprojassign.ecola2_currency, tblprojassign.allow_field_currency, tblprojassign.allow_field_paytype, tblprojassign.allow_field, tblprojassign.allow_accomm, tblprojassign.allow_accomm_currency, tblprojassign.allow_accomm_paytype, tblprojassign.allow_transpo, tblprojassign.allow_transpo_currency, tblprojassign.allow_transpo_paytype, tblprojassign.allow_comm, tblprojassign.allow_comm_currency, tblprojassign.allow_comm_paytype, tblprojassign.perdiem, tblprojassign.perdiem_currency, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.durationtotal, tblprojassign.durationtotprop, tblprojassign.durationfrom2, tblprojassign.durationto2, tblprojassign.duration2total, tblprojassign.duration2totprop, tblprojassign.durationprojassigntot, tblprojassign.durationprojassigntotprop, tblprojassign.term_resign, tblprojassign.remarks, tblprojassign.remarks2, tblprojassign.net_of_tax, tblprojassign.filepath, tblprojassign.filename FROM tblprojassign WHERE employeeid = '$employeeid' AND projassignid = $projassignid", $dbh);

	while ($myrow3 = mysql_fetch_row($result3))
	{
	  $found3 = 1;
	  $projassignid = $myrow3[0];
	  $projdate = $myrow3[1];
	  $ref_no = $myrow3[2];
	  $employeeid = $myrow3[3];
	  $currempid = $myrow3[4];
	  $proj_code = $myrow3[5];
	  $proj_name = $myrow3[6];
	  $empprojctr = $myrow3[7];
	  $position = $myrow3[8];
	  $salary = $myrow3[9];
	  $salarycurrency = $myrow3[10];
	  $salarytype = $myrow3[11];
	  $allow_inc = $myrow3[12];
	  $allow_inc_currency = $myrow3[13];
	  $allow_inc_paytype = $myrow3[14];
	  $allow_proj = $myrow3[15];
	  $allow_proj_currency = $myrow3[16];
	  $allow_proj_paytype = $myrow3[17];
	  $ecola1 = $myrow3[18];
	  $ecola1_currency = $myrow3[19];
	  $ecola2 = $myrow3[20];
	  $ecola2_currency = $myrow3[21];
	  $allow_field_currency = $myrow3[22];
	  $allow_field_paytype = $myrow3[23];
	  $allow_field = $myrow3[24];
	  $allow_accomm = $myrow3[25];
	  $allow_accomm_currency = $myrow3[26];
	  $allow_accomm_paytype = $myrow3[27];
	  $allow_transpo = $myrow3[28];
	  $allow_transpo_currency = $myrow3[29];
	  $allow_transpo_paytype = $myrow3[30];
	  $allow_comm = $myrow3[31];
	  $allow_comm_currency = $myrow3[32];
	  $allow_comm_paytype = $myrow3[33];
	  $perdiem = $myrow3[34];
	  $perdiem_currency = $myrow3[35];
	  $durationfrom = $myrow3[36];
	  $durationto = $myrow3[37];
	  $durationtotal = $myrow3[38];
	  $durationtotprop = $myrow3[39];
	  $durationfrom2 = $myrow3[40];
	  $durationto2 = $myrow3[41];
	  $duration2total = $myrow3[42];
	  $duration2totprop = $myrow3[43];
	  $durationprojassigntot = $myrow3[44];
	  $durationprojassigntotprop = $myrow3[45];
	  $term_resign = $myrow3[46];
	  $remarks = $myrow3[47];
	  $remarks2 = $myrow3[48];
	  $net_of_tax = $myrow3[49];
	  $filepath3 = $myrow3[50];
	  $filename3 = $myrow3[51];
	}

	// echo "<form  enctype=\"multipart/form-data\" action=\"personnelprojassignedit2.php?loginid=$loginid&eid=$employeeid&pid=$projassignid\" method=\"post\" name=\"form1\">";

	echo "<tr><th align=\"right\">Date</th><td>";
	if ($projdate == '') {
		echo "Blank"; }
	else {
		echo "".date("Y-M-d", strtotime($projdate))."";
	}
	echo "</td><tr><th align=\"right\">Contract Reference No.</th><td>$ref_no</td></tr>";

	$result4 = mysql_query("SELECT proj_fname, proj_sname FROM tblproject1 WHERE proj_code = '$proj_code'", $dbh);
	while ($myrow4 = mysql_fetch_row($result4))
	{
	  $found4 = 1;
	  $proj_fname = $myrow4[0];
	  $proj_sname = $myrow4[1];
	}

	echo "<tr><th align=\"right\">Project(s)</th><td>";
	echo "<table width=\"100%\" class=\"fin2\">";
	echo "<tr><th colspan=\"2\">For single projects only...</th></tr>";
	echo "<tr><th align=\"left\">Project Code</th><td align=\"left\">$proj_code</td></tr>";
	echo "<tr><th align=\"left\">Proj. Acronym</th><td align=\"left\">$proj_name</td></tr>";
	echo "<tr><th align=\"left\">Proj. Name</th><td align=\"left\">$proj_fname</td></tr>";
	// echo "<tr><th colspan=2 align=center><a href=\"personnelprojassignchgproj.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&prjcd=$proj_code\">change project name</a></th></tr>";
	echo "</table>";
	echo "<center>or</center>";
	echo "<table width=\"100%\" class=\"fin2\">";
	echo "<tr><th colspan=\"2\">For multiple projects...</th></tr>";
	$result5=""; $found5=0; $ctr5=0;
	$result5 = mysql_query("SELECT idprojcdassign, projectid, projcode, projname, duration, durationprop FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5 != "") {
		while($myrow5 = mysql_fetch_row($result5)) {
		$found5 = 1;
		$idprojcdassign5 = $myrow5[0];
		$projectid5 = $myrow5[1];
		$projcode5 = $myrow5[2];
		$projname5 = $myrow5[3];
		$duration5 = $myrow5[4];
		$durationprop5 = $myrow5[5];
		echo "<tr><td>$projcode5&nbsp;-&nbsp;$projname5</td>";
		if(($duration5 != 0) || ($duration5 != '')) {
			echo "<td>$duration5&nbsp;$durationprop5</td>";
		} else { echo "<td></td>"; }
		// echo "<td><a href=\"personnelprojassigneditproj.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&idprjcdasgn=$idprojcdassign5\"><font size=\"1\">Edit</font></a></td>";
		// echo "<td><a href=\"personnelprojassigndelproj.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&idprjcdasgn=$idprojcdassign5\"><font size=\"1\">Del</font></a></td>";
		echo "</tr>";
		}
	}
	// echo "<tr><th colspan=\"2\"><a href=\"personnelprojassignaddproj.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid\">add project</a></th></tr>";
	echo "</table>";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">Position</th><td>$position</td></tr>";

	if($accesslevel >= 5) {
//	start salary rate details
	echo "<tr><th align=\"right\">Salary Rate</th>";
	if($salary != 0) {
	echo "<td>".number_format($salary, 2)."&nbsp;$salarycurrency&nbsp;$salarytype&nbsp;";
	if ($net_of_tax == 'on') { $netoftaxon = checked; echo "Net of Tax"; }
	echo "</td>";
	} else {
	echo "<td></td>";
	}
	echo "</tr>";
//	end salary rate details
//	start income allowance details
	echo "<tr><th align=\"right\">Incentive Allowance</th>";
	if($allow_inc != 0) {
	echo "<td>".number_format($allow_inc, 2)."&nbsp;$allow_inc_currency&nbsp;$allow_inc_paytype";
	} else {
	echo "<td></td>";
	}
	echo "</tr>";
//	end income allowance details
//	start project allowance details
	echo "<tr><th align=\"right\">Project Allowance</th>";
	if($allow_proj != 0) {
	echo "<td>".number_format($allow_proj, 2)."&nbsp;$allow_proj_currency&nbsp;$allow_proj_paytype</td>";
	} else {
	echo "<td></td>";
	}
	echo "</tr>";
//	end project allowance details
//	start field allowance details
	echo "<tr><th align=\"right\">Field Allowance</th>";
	if($allow_field != 0) {
	echo "<td>".number_format($allow_field, 2)."&nbsp;$allow_field_currency&nbsp;$allow_field_paytype</td>";
	} else {
	echo "<td></td>";
	}
	echo "</tr>";
//	end field allowance details
//	start accommodation allowance details
	echo "<tr><th align=\"right\">Accommodation Allowance</th>";
	if($allow_accomm != 0) {
	echo "<td>".number_format($allow_accomm, 2)."&nbsp;$allow_accomm_currency&nbsp;$allow_accomm_paytype</td>";
	} else {
	echo "<td></td>";
	}
	echo "</tr>";
//	end accommodation allowance details
//	start transportation allowance details
	echo "<tr><th align=\"right\">Transportation Allowance</th>";
	if($allow_transpo != 0) {
	echo "<td>".number_format($allow_transpo, 2)."&nbsp;$allow_transpo_currency&nbsp;$allow_transpo_paytype</td>";
	} else {
	echo "<td></td>";
	}
	echo "</tr>";
//	end transportation allowance details
//	start communication allowance details
	echo "<tr><th align=\"right\">Communication Allowance</th>";
	if($allow_comm != 0) {
	echo "<td>".number_format($allow_comm, 2)."&nbsp;$allow_comm_currency&nbsp;$allow_comm_paytype</td>";
	} else {
	echo "<td></td>";
	}
	echo "</tr>";
//	end communication allowance details
//	start perdiem details
	echo "<tr><th align=\"right\">Per diem</th>";
	if($perdiem != 0) {
	echo "<td>".number_format($perdiem, 2)."&nbsp;$perdiem_currency</td>";
	} else {
	echo "<td></td>";
	}
	echo "</tr>";
//	end perdiem details
//	start ecola1
	echo "<tr><th align=\"right\">ecola1</th>";
	if($ecola1 != 0) {
	echo "<td>".number_format($ecola1, 2)."&nbsp;$ecola1_currency</td>";
	} else {
	echo "<td></td";
	}
	echo "</tr>";
//	end ecola1
//	start ecola2
	echo "<tr><th align=\"right\">ecola2</th>";
	if($ecola2 != 0) {
	echo "<td>".number_format($ecola2, 2)."&nbsp;$ecola2_currency</td>";
	} else {
	echo "<td></td>";
	}
	echo "</tr>";
//	end ecola2
	} else { // if($accesslevel >= 5)
//	start salary rate details
	echo "<tr><th align=\"right\">Salary Rate</th>";
	echo "<td></td>";
	echo "</tr>";
//	end salary rate details
//	start income allowance details
	echo "<tr><th align=\"right\">Incentive Allowance</th>";
	echo "<td></td>";
	echo "</tr>";
//	end income allowance details
//	start project allowance details
	echo "<tr><th align=\"right\">Project Allowance</th>";
	echo "<td></td>";
	echo "</tr>";
//	end project allowance details
//	start field allowance details
	echo "<tr><th align=\"right\">Field Allowance</th>";
	echo "<td></td>";
	echo "</tr>";
//	end field allowance details
//	start accommodation allowance details
	echo "<tr><th align=\"right\">Accommodation Allowance</th>";
	echo "<td></td>";
	echo "</tr>";
//	end accommodation allowance details
//	start transportation allowance details
	echo "<tr><th align=\"right\">Transportation Allowance</th>";
	echo "<td></td>";
	echo "</tr>";
//	end transportation allowance details
//	start communication allowance details
	echo "<tr><th align=\"right\">Communication Allowance</th>";
	echo "<td></td>";
	echo "</tr>";
//	end communication allowance details
//	start perdiem details
	echo "<tr><th align=\"right\">Per diem</th>";
	echo "<td></td>";
	echo "</tr>";
//	end perdiem details
//	start ecola1
	echo "<tr><th align=\"right\">ecola1</th>";
	echo "<td></td>";
	echo "</tr>";
//	end ecola1
//	start ecola2
	echo "<tr><th align=\"right\">ecola2</th>";
	echo "<td></td>";
	echo "</tr>";
//	end ecola2
	} // if($accesslevel >= 5)

//	start durations

	echo "<tr><th align=\"right\">Duration1</th>";
	echo "<td><table border=0 spacing=0 cellspacing=1 cellpadding=0>";
	echo "<tr><td><font size=1><i>From</i></font></td><td>&nbsp;</td>";
	if($durationfrom != '') {
	echo "<td>".date("Y-M-d", strtotime($durationfrom))."&nbsp;</td>";
	} else {
	echo "<td></td>";
	}
	// echo "<td><a href=personnelprojassigndatefrom.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&datefr=$durationfrom>Change</a></td>";
	echo "<td></td>";
	echo "<td rowspan=2>&nbsp;</td>";
	echo "<td rowspan=2 valign=top>$durationtotal&nbsp;$durationtotprop</td></tr>";
	echo "<tr><td><font size=1><i>To</i></font></td><td>&nbsp;</td>";
	if($durationto != '') {
	echo "<td>".date("Y-M-d", strtotime($durationto))."</td>";
	} else {
	echo "<td></td>";
	}
	// echo "<td><a href=personnelprojassigndateto.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&dateto=$durationto>Change</a></td>";
	echo "<td></td></tr>";
	echo "</table></td></tr>";

	echo "<tr><th align=\"right\">Duration2</th>";
	echo "<td><table border=0 spacing=0 cellspacing=1 cellpadding=0>";
	echo "<tr><td><font size=1><i>From</i></font></td><td>&nbsp;</td>";
	if($durationfrom2 != '') {
	echo "<td>".date("Y-M-d", strtotime($durationfrom2))."&nbsp;</td>";
	}	else {
	echo "<td></td>";
	}
	// echo "<td><a href=personnelprojassigndate2from.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&datefr2=$durationfrom2>Change</a></td>";
	echo "<td></td>";
	echo "<td rowspan=2>&nbsp;</td>";
	echo "<td rowspan=2 valign=top>$duration2total&nbsp;$duration2totprop</td></tr>";
	echo "<tr><td><font size=1><i>To</i></font></td><td>&nbsp;</td>";
	if($durationto2 != '') {
	echo "<td>".date("Y-M-d", strtotime($durationto2))."&nbsp;</td>";
	} else {
	echo "<td></td>";
	}
	echo "</table></td></tr>";

	echo "<tr><th align=\"right\">Total Duration</th>";
	echo "<td>$durationprojassigntot&nbsp;&nbsp;$durationprojassigntotprop</td></tr>";

//	end durations

	echo "<tr><th align=\"right\">Term_Resign</th>";
	if($term_resign != '') {
	echo "<td>".date("Y-M-d", strtotime($term_resign))."</td>";
	} else {
	echo "<td></td>";
	}
	echo "</tr>";

	echo "<tr><th align=\"right\">Remarks</th><td>$remarks</td></tr>";
	echo "<tr><th align=\"right\">Remarks2</th><td>$remarks2</td></tr>";

	echo "<tr>";
	echo "<th align=\"right\">Attachment</th><td>";
	if($filename3 != "") {
		// echo "<a href=\"$filepath3/$filename3\" target=\"_blank\">$filename3</a>&nbsp;&nbsp;&nbsp;<i><a href=\"persprojassigndelfile.php?loginid=$loginid&eid=$employeeid&pid=$projassignid\">Remove</a></i><br>";    
    echo "<a href=\"$filepath3/$filename3\" target=\"_blank\">$filename3</a><br>";
    }
    // echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"20000000\" />";
    // echo "<input name=\"uploadedfile\" type=\"file\" />";
	echo "</td>";
	echo "</tr>";

	// echo "<tr><td>&nbsp</td><td><input type=submit value='Update Project Assignment'></td></tr>";

	echo "</table>";

// end project assignments

     }
 
     // echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back</a><br>";
	echo "<p><FORM><INPUT TYPE='BUTTON' VALUE='Close Window' onClick='window.close()'></FORM></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
