<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

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
     echo "<p><font size=1>Manage >> Categories >> IT Support approver</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

     echo "<tr><th colspan=\"5\">IT Support approvers</th></tr>";

// start contents here...

  if($accesslevel >= 4) {

		echo "<tr><td colspan=\"5\">Defined approvers per department will be visible on the IT support form.</td></tr>";
		// header
		echo "<tr><td>ctr</td><td>dept</td><td>approvers</td></tr>";

		// query tbldeptcd, provide dropdowns for 2 approvers
		echo "<form action=\"mngitsuppapprupd.php?loginid=$loginid\" method=\"post\" name=\"mngitsuppreqappr\">";
		
		$res11query = "SELECT tbldeptcd.code, tbldeptcd.name, tblitsupportapprover.iditsupportapprover, tblitsupportapprover.approver1empid, tblitsupportapprover.approver2empid, tblitsupportapprover.deptcd FROM tbldeptcd LEFT JOIN tblitsupportapprover ON tbldeptcd.code=tblitsupportapprover.deptcd";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$ctr11 = $ctr11 + 1;
			$code11 = $myrow11['code'];
			$name11 = $myrow11['name'];
			$iditsupportapprover11 = $myrow11['iditsupportapprover'];
			$approver1empid11 = $myrow11['approver1empid'];
			$approver2empid11 = $myrow11['approver2empid'];
			$deptcd11 = $myrow11['deptcd'];
			echo "<tr><td>$ctr11</td><td>$code11<br>$name11</td>";
			echo "<input type=\"hidden\" name=\"deptcd[]\" value=\"$code11\">";
			// dropdown for approver1
			echo "<td>approver1:<br>";
			// query active personnel
			echo "<select name=\"approver1empid[]\">";
			if($approver1empid11=='') { $approver1blanksel="selected"; } else { $approver1blanksel=""; }
			echo "<option value='' $approver1blanksel>-</option>";
			$res12query="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.email1, tblemployee.employeeid, tblempdetails.empdepartment, tblempdetails.empposition FROM tblemployee LEFT JOIN tblempdetails ON tblemployee.employeeid=tblempdetails.employeeid LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE tblemployee.emp_record=\"active\" AND tblemployee.employee_type=\"employee\" ORDER BY tblcontact.name_last ASC";
			$result12=""; $found12=0; $ctr12=0;
			$result12=$dbh2->query($res12query);
			if($result12->num_rows>0) {
				while($myrow12 = $result12->fetch_assoc()) {
				$found12 = 1;
				$ctr12 = $ctr12 + 1;
				$name_last12 = $myrow12['name_last'];
				$name_first12 = $myrow12['name_first'];
				$email112 = $myrow12['email1'];
				$employeeid12 = $myrow12['employeeid'];
				$empdepartment12 = $myrow12['empdepartment'];
				$empposition12 = $myrow12['empposition'];
				if($employeeid12==$approver1empid11) { $approver1empsel="selected"; } else { $approver1empsel=""; }
				echo "<option value=\"$code11-$employeeid12\" $approver1empsel>$name_last12, $name_first12 ($employeeid12) - $empposition12, $empdepartment12</option>";
				} // while($myrow12 = $result12->fetch_assoc())
			} // if($result12->num_rows>0)
			echo "</select>";
			echo "<br>approver2:<br>";
			// dropdown for approver2
			// query active personnel
			echo "<select name=\"approver2empid[]\">";
			if($approver2empid11=='') { $approver2blanksel="selected"; } else { $approver2blanksel=""; }
			echo "<option value='' $approver2blanksel>-</option>";
			$res14query="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.email1, tblemployee.employeeid, tblempdetails.empdepartment, tblempdetails.empposition FROM tblemployee LEFT JOIN tblempdetails ON tblemployee.employeeid=tblempdetails.employeeid LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE tblemployee.emp_record=\"active\" AND tblemployee.employee_type=\"employee\" ORDER BY tblcontact.name_last ASC";
			$result14=""; $found14=0; $ctr14=0;
			$result14=$dbh2->query($res14query);
			if($result14->num_rows>0) {
				while($myrow14 = $result14->fetch_assoc()) {
				$found14 = 1;
				$ctr14 = $ctr14 + 1;
				$name_last14 = $myrow14['name_last'];
				$name_first14 = $myrow14['name_first'];
				$email114 = $myrow12['email1'];
				$employeeid14 = $myrow14['employeeid'];
				$empdepartment14 = $myrow14['empdepartment'];
				$empposition14 = $myrow14['empposition'];
				if($employeeid14==$approver2empid11) { $approver2empsel="selected"; } else { $approver2empsel=""; }
				echo "<option value=\"$code11-$employeeid14\" $approver2empsel>$name_last14, $name_first14 ($employeeid14) - $empposition14, $empdepartment14</option>";
				} // while($myrow12 = $result12->fetch_assoc())
			} // if($result12->num_rows>0)
			echo "</select>";
			echo "</td>";
			echo "</tr>";
			} // while($myrow11 = $result11->fetch_assoc())
		} // if($result11->num_rows>0)
		echo "<tr><td colspan=\"5\" align=\"center\"><input type=\"submit\" value=\"Save\"></td></tr>";
		echo "</form>";
  } // if($accesslevel >= 4)

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"mngcateg.php?loginid=$loginid\">Back</a></p>";

	$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
	$result = $dbh2->query($resquery);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

$dbh2->close();
?> 
