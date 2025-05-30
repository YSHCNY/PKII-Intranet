<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$personneltype = $_POST['personneltype'];
$employeetype = $_POST['employeetype'];
$employeeorder = $_POST['employeeorder'];
$empactivtyp = $_POST['empactivtyp'];

if($personneltype == "employees") { $empsel="selected"; $conssel=""; $allempconssel=""; }
else if($personneltype == "consultants") { $empsel=""; $conssel="selected"; $allempconssel=""; }
else if($personneltype == "all-personnels") { $empsel=""; $conssel=""; $allempconssel="selected"; }
// else if($personneltype == "") { $personneltype == "employees"; $empsel="selected"; $conssel=""; $allempconssel=""; }

if($personneltype == "employees") {
	if($employeetype == "active-employees") { $activeempsel="selected"; $inactiveempsel=""; $allempsel=""; }
	else if($employeetype == "inactive-employees") { $activeempsel=""; $inactiveempsel="selected"; $allempsel=""; }
	else if($employeetype == "all-employees") { $activeempsel=""; $inactiveempsel=""; $allempsel="selected"; }
	// else if($employeetype == "") { $activeempsel="selected"; $inactiveempsel=""; $allempsel=""; }
} else if($personneltype == "consultants") {
	if($employeetype == "active-consultants") { $activeconssel="selected"; $inactiveconssel=""; $allconssel=""; }
	else if($employeetype == "inactive-consultants") { $activeconssel=""; $inactiveconssel="selected"; $allconssel=""; }
	else if($employeetype == "all-consultants") { $activeconssel=""; $inactiveconssel=""; $allconssel="selected"; }
	// else if($employeetype == "") { $activeconssel="selected"; $inactiveconssel=""; $allconssel=""; }
} else if($personneltype == "all-personnels") {
	if($employeetype == "active-pers") { $activeperssel="selected"; $inactiveperssel=""; $allperssel=""; }
	else if($employeetype = "inactive-pers") { $activeperssel=""; $inactiveperssel="selected"; $allperssel=""; }
	else if($employeetype = "all-pers") { $activeperssel=""; $inactiveperssel=""; $allperssel="selected"; }
	else if($employeetype == "") { $activeperssel="selected"; $inactiveperssel=""; $allperssel=""; }
}

if($employeeorder == "tblcontact.employeeid") { $employeeidsel="selected"; $name_lastsel=""; $name_firstsel=""; $emp_birthdatesel=""; $date_hiredsel=""; }
else if($employeeorder == "tblcontact.name_last") { $employeeidsel=""; $name_lastsel="selected"; $name_firstsel=""; $emp_birthdatesel=""; $date_hiredsel=""; }
else if($employeeorder == "tblcontact.name_first") { $employeeidsel=""; $name_lastsel=""; $name_firstsel="selected"; $emp_birthdatesel=""; $date_hiredsel=""; }
else if($employeeorder == "tblemployee.emp_birthdate") { $employeeidsel=""; $name_lastsel=""; $name_firstsel=""; $emp_birthdatesel="selected"; $date_hiredsel=""; }
else if($employeeorder == "tblemployee.date_hired") { $employeeidsel=""; $name_lastsel=""; $name_firstsel=""; $emp_birthdatesel=""; $date_hiredsel="selected"; }
else if($employeeorder == "") { $employeeidsel=""; $name_lastsel="selected"; $name_firstsel=""; $emp_birthdatesel=""; $date_hiredsel=""; }

if($empactivtyp == "regular") {
	$empactivtypregsel="selected"; $empactivtypprobysel=""; $empactivtyptempsel="";
} else if($empactivtyp == "probationary") {
	$empactivtypregsel=""; $empactivtypprobysel="selected"; $empactivtyptempsel="";
} else if($empactivtyp == "temporary") {
	$empactivtypregsel=""; $empactivtypprobysel=""; $empactivtyptempsel="selected";
}

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> <a href=\"persrptmnu.php?loginid=$loginid\">HR Reports</a> >> List of emails</font></p>";

     echo "<table class=\"fin\" border=\"1\">";
     echo "<tr><th colspan=\"12\">List of emails</th></tr>";

     echo "<tr><td colspan=12>";

     echo "<form action=\"persrptemails.php?loginid=$loginid\" method=\"POST\" name=\"myform\">";
     echo "<table><tr>";

     echo "<td valign=bottom><font size=1>Choose personnel type</font><br>";
     echo "<select name=\"personneltype\" onchange=\"this.form.submit()\">";
		echo "<option value=\"-\">select</option>";
     echo "<option value=\"employees\" $empsel>Employees</option>";
     echo "<option value=\"consultants\" $conssel>Consultants</option>";
     echo "<option value=\"all-personnels\" $allempconssel>All Personnels</option>";
     echo "</select></td>";

		if($personneltype == "employees") {
     echo "<td valign=bottom><font size=1>Choose criteria</font><br>";
     echo "<select name=\"employeetype\" onchange=\"this.form.submit()\">";
		echo "<option value=\"-\">select</option>";
     echo "<option value=\"active-employees\" $activeempsel>Active Employees</option>";
     echo "<option value=\"inactive-employees\" $inactiveempsel>Inactive Employees</option>";
     echo "<option value=\"all-employees\" $allempsel>All Employees</option>";
     echo "</select></td>";

			if($employeetype == "active-employees") {
				echo "<td valign=\"bottom\"><font size=\"1\">active type</font><br>";
				echo "<select name=\"empactivtyp\" onchange=\"this.form.submit()\">";
				echo "<option value=\"-\">select</option>";
				echo "<option value=\"regular\" $empactivtypregsel>regular</option>";
				echo "<option value=\"probationary\"$empactivtypprobysel>probationary</option>";
				echo "<option value=\"temporary\"$empactivtyptempsel>temporary</option>";
				echo "</select></td>";
			}

		} else if($personneltype == "consultants") {
     echo "<td valign=bottom><font size=1>Choose criteria</font><br>";
     echo "<select name=\"employeetype\" onchange=\"this.form.submit()\">";
     echo "<option value=\"active-consultants\" $activeconssel>Active Consultants</option>";
     echo "<option value=\"inactive-consultants\" $inactiveconssel>Inactive Consultants</option>";
     echo "<option value=\"all-consultants\" $allconssel>All Consultants</option>";
     echo "</select></td>";
		} else if($personneltype == "all-personnels") {
     echo "<td valign=bottom><font size=1>Choose criteria</font><br>";
     echo "<select name=\"employeetype\" onchange=\"this.form.submit()\">";
     echo "<option value=\"active-pers\" $activeperssel>Active</option>";
     echo "<option value=\"inactive-pers\" $inactiveperssel>Inactive</option>";
     echo "<option value=\"all-pers\" $allperssel>All</option>";
     echo "</select></td>";
		}

     echo "<td valign=bottom><font size=1>Sort by</font><br>";
     echo "<select name=\"employeeorder\">";
     echo "<option value=\"tblcontact.employeeid\" $employeeidsel>Employee Number</option>";
     echo "<option value=\"tblcontact.name_last\" $name_lastsel>Last Name</option>";
     echo "<option value=\"tblcontact.name_first\" $name_firstsel>First Name</option>";
     echo "<option value=\"tblemployee.emp_birthdate\" $emp_birthdatesel>Birthdate</option>";
     echo "<option value=\"tblemployee.date_hired\" $date_hiredsel>DateHired</option>";
     echo "</select></td>";

     echo "<td valign=bottom><input type=submit value=Go></td>";
     echo "</tr></table>";
     echo "</form>";

     echo "</td></tr>";

		echo "<tr><th colspan=\"12\">Result | $employeetype | $empactivtyp</th></tr>";
		echo "<tr><td colspan=\"12\">";

		if($personneltype == "employees") {
			if($employeetype == "active-employees") {
				if($empactivtyp == "regular") {
				$result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' AND tblemployee.emp_status=\"R\" ORDER BY $employeeorder", $dbh);
				} else if($empactivtyp == "probationary") {
				$result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' AND tblemployee.emp_status=\"P\" ORDER BY $employeeorder", $dbh);
				} else if($empactivtyp == "temporary") {
				$result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' AND tblemployee.emp_status=\"T\" ORDER BY $employeeorder", $dbh);
				}
			} else if ($employeetype == "inactive-employees") {
				$result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'inactive' ORDER BY $employeeorder", $dbh);
			} else if ($employeetype == "all-employees") {
				$result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' ORDER BY $employeeorder", $dbh);
			} else {
				$result11 = "";
				// $result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder", $dbh);
			}
		} else if($personneltype == "consultants") {
			if($employeetype == "active-consultants") {
				$result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder", $dbh);
			} else if ($employeetype == "inactive-consultants") {
				$result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' AND tblemployee.emp_record = 'inactive' ORDER BY $employeeorder", $dbh);
			} else if ($employeetype == "all-consultants") {
				$result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' ORDER BY $employeeorder", $dbh);
			} else {
				$result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder", $dbh);
			}
		} else if($personneltype == "all-personnels") {
			if($employeetype == "active-pers") {
				$result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder", $dbh);
			} else if ($employeetype == "inactive-pers") {
				$result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.emp_record = 'inactive' ORDER BY $employeeorder", $dbh);
			} else if ($employeetype == "all-pers") {
				$result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' ORDER BY $employeeorder", $dbh);
			} else {
				$result11 = "";
				// $result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder", $dbh);
			}
		} else {

		}

		$koei = "koei";

		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$employeeid11 = $myrow11[0];
			$name_first11 = $myrow11[1];
			$name_last11 = $myrow11[2];
			$name_middle11 = $myrow11[3];
			$email111 = $myrow11[4];
			$email211 = $myrow11[5];
			if(($email111 != "") || ($email211 != "")) {
				if(preg_match('/koei/', $email111, $matches)) {
					$emailfin = $email111;
					echo "$name_first11 $name_last11 &lt;$emailfin&gt;, ";
				} else if(preg_match('/koei/', $email211, $matches)) {
					$emailfin = $email211;
					echo "$name_first11 $name_last11 &lt;$emailfin&gt;, ";
				} else {
					if($email111 != "") { $emailfin2=$email111; }
					else if($email211 != "") { $emailfin2=$email211; }
					echo "$name_first11 $name_last11 &lt;$emailfin2&gt;, ";
				}
			}
			$email111=""; $email211=""; $emailfin=""; $emailfin2="";
			}
		}

		echo "</td></tr>";

     echo "</table>"; 
   
     echo "<p><a href=persrptmnu.php?loginid=$loginid>Back to HR Reports Menu</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
