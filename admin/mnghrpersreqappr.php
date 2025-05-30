<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Manage >> HR Modules >> Personnel Requisition Approvers</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

     echo "<tr><th colspan=\"2\">Personnel Requisition Approvers</th></tr>";

// start contents here...
  if($accesslevel >= 4) {

		// query tblhrpersreqctg
		$res10query="SELECT endorsedempid, recoappricgempid, recoapprdcgempid, approveempid FROM tblhrpersreqctg WHERE idhrpersreqapprctg!='' ORDER BY idhrpersreqapprctg ASC LIMIT 1";
		$result10=""; $found10=0; $ctr10=0;
		$result10=$dbh2->query($res10query);
		if($result10->num_rows>0) {
			while($myrow10=$result10->fetch_assoc()) {
			$found10=1;
			$endorsedempid10 = $myrow10['endorsedempid'];
			$recoappricgempid10 = $myrow10['recoappricgempid'];
			$recoapprdcgempid10 = $myrow10['recoapprdcgempid'];
			$approveempid10 = $myrow10['approveempid'];
			} // while($myrow10=$result10->fetch_assoc())
		} // if($result10->num_rows>0)

		echo "<form action=\"mnghrpersreqapprupd.php?loginid=$loginid\" method=\"POST\" name=\"mnghrpersreqapprupd\">";

    echo "<tr>";
		echo "<th align=\"right\">Endorsed by</th><td>";
		echo "<select name=\"endorsedempid\">";
		echo "<option value=''>-</option>";
		$res11query="SELECT tblemployee.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblempdetails.empdepartment, tblempdetails.empposition FROM tblemployee LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid LEFT JOIN tblempdetails ON tblemployee.employeeid=tblempdetails.employeeid WHERE tblemployee.emp_record=\"active\" AND tblemployee.employee_type=\"employee\" ORDER BY tblcontact.name_last";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11 = 1;
			$employeeid11 = $myrow11['employeeid'];
			$name_last11 = strtoupper($myrow11['name_last']);
			$name_first11 = $myrow11['name_first'];
			$name_middle11 = $myrow11['name_middle'];
			$empdepartment11 = $myrow11['empdepartment'];
			$empposition11 = $myrow11['empposition'];
			if($employeeid11==$endorsedempid10) { $endorsedempsel="selected"; } else { $endorsedempsel=""; }
			echo "<option value=\"$employeeid11\" $endorsedempsel>$name_last11, $name_first11 $name_middle11[0] ($employeeid11) - $empposition11</option>";
			} // while($myrow11=$result11->fetch_assoc())
		} // if($result11->num_rows>0)
		echo "</select>";
		echo "</td></tr>";

		echo "<tr>";
		echo "<th align=\"right\">Recommending approval for ICG</th><td>";
		echo "<select name=\"recoappricgempid\">";
		echo "<option value=''>-</option>";
		$res12query="SELECT tblemployee.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblempdetails.empdepartment, tblempdetails.empposition FROM tblemployee LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid LEFT JOIN tblempdetails ON tblemployee.employeeid=tblempdetails.employeeid WHERE tblemployee.emp_record=\"active\" AND tblemployee.employee_type=\"employee\" ORDER BY tblcontact.name_last";
		$result12=""; $found12=0; $ctr12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
			$found12 = 1;
			$employeeid12 = $myrow12['employeeid'];
			$name_last12 = strtoupper($myrow12['name_last']);
			$name_first12 = $myrow12['name_first'];
			$name_middle12 = $myrow12['name_middle'];
			$empdepartment12 = $myrow12['empdepartment'];
			$empposition12 = $myrow12['empposition'];
			if($employeeid12==$recoappricgempid10) { $recoappricgempsel="selected"; } else { $recoappricgempsel=""; }
			echo "<option value=\"$employeeid12\" $recoappricgempsel>$name_last12, $name_first12 $name_middle12[0] ($employeeid12) - $empposition12</option>";
			} // while($myrow11=$result11->fetch_assoc())
		} // if($result11->num_rows>0)
		echo "</select>";
		echo "</td></tr>";

		echo "<tr>";
		echo "<th align=\"right\">Recommending approval for DCG</th><td>";
		echo "<select name=\"recoapprdcgempid\">";
		echo "<option value=''>-</option>";
		$res14query="SELECT tblemployee.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblempdetails.empdepartment, tblempdetails.empposition FROM tblemployee LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid LEFT JOIN tblempdetails ON tblemployee.employeeid=tblempdetails.employeeid WHERE tblemployee.emp_record=\"active\" AND tblemployee.employee_type=\"employee\" ORDER BY tblcontact.name_last";
		$result14=""; $found14=0; $ctr14=0;
		$result14=$dbh2->query($res14query);
		if($result14->num_rows>0) {
			while($myrow14=$result14->fetch_assoc()) {
			$found14 = 1;
			$employeeid14 = $myrow14['employeeid'];
			$name_last14 = strtoupper($myrow14['name_last']);
			$name_first14 = $myrow14['name_first'];
			$name_middle14 = $myrow14['name_middle'];
			$empdepartment14 = $myrow14['empdepartment'];
			$empposition14 = $myrow14['empposition'];
			if($employeeid14==$recoapprdcgempid10) { $recoapprdcgempsel="selected"; } else { $recoapprdcgempsel=""; }
			echo "<option value=\"$employeeid14\" $recoapprdcgempsel>$name_last14, $name_first14 $name_middle14[0] ($employeeid14) - $empposition14</option>";
			} // while($myrow11=$result11->fetch_assoc())
		} // if($result11->num_rows>0)
		echo "</select>";
		echo "</td></tr>";

		echo "<tr>";
		echo "<th align=\"right\">Approved by</th><td>";
		echo "<select name=\"approveempid\">";
		echo "<option value=''>-</option>";
		$res15query="SELECT tblemployee.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblempdetails.empdepartment, tblempdetails.empposition FROM tblemployee LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid LEFT JOIN tblempdetails ON tblemployee.employeeid=tblempdetails.employeeid WHERE tblemployee.emp_record=\"active\" AND tblemployee.employee_type=\"employee\" ORDER BY tblcontact.name_last";
		$result15=""; $found15=0; $ctr15=0;
		$result15=$dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15=$result15->fetch_assoc()) {
			$found15 = 1;
			$employeeid15 = $myrow15['employeeid'];
			$name_last15 = strtoupper($myrow15['name_last']);
			$name_first15 = $myrow15['name_first'];
			$name_middle15 = $myrow15['name_middle'];
			$empdepartment15 = $myrow15['empdepartment'];
			$empposition15 = $myrow15['empposition'];
			if($employeeid15==$approveempid10) { $approveempsel="selected"; } else { $approveempsel=""; }
			echo "<option value=\"$employeeid15\" $approveempsel>$name_last15, $name_first15 $name_middle15[0] ($employeeid15) - $empposition15</option>";
			} // while($myrow15=$result15->fetch_assoc())
		} // if($result15->num_rows>0)
		echo "</select>";
		echo "</td></tr>";

		echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Update\"></td></tr>";
		echo "</form>";

  }

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"mnghrmod.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");

} else {

     include("logindeny.php");

}

$dbh2->close();
?>
