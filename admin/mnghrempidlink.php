<?php 

require('./db1.php');

include("datetimenow.php");

$loginid = $_GET['loginid'];

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
     echo "<p><font size=1>Manage >> HR Modules >> Link userid to EmployeeID</font></p>";

// start contents here...
  if($accesslevel >= 4)
  {

		echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><th>ctr</th><th>id</th><th>timestamp</th><th>loginid</th><th>userid</th><th>badgenum</th><th>name</th><th>empid-personnel</th></tr>";

		$result11=""; $found11=0;
		$result11 = mysql_query("SELECT hrattuserinfoid, timestamp, loginid, att_userid, att_badgenumber, att_name, att_title, att_gender, employeeid FROM tblhrattuserinfo ORDER BY att_userid DESC", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$hrattuserinfoid11 = $myrow11[0];
			$timestamp11 = $myrow11[1];
			$loginid11 = $myrow11[2];
			$att_userid11 = $myrow11[3];
			$att_badgenumber11 = $myrow11[4];
			$att_name11 = $myrow11[5];
			$att_title11 = $myrow11[6];
			$att_gender11 = $myrow11[7];
			$employeeid11 = $myrow11[8];

			$ctr11 = $ctr11+1;

			echo "<tr><td>$ctr11</td><td>$hrattuserinfoid11</td><td>$timestamp11</td><td>$loginid11</td><td>$att_userid11</td><td>$att_badgenumber11</td><td>$att_name11</td>";
			echo "<form action=\"mnghrempidlinkupd.php?loginid=$loginid&uid=$hrattuserinfoid11\" method=\"post\">";
			echo "<td nowrap><select name=\"eid\">";
			if($employeeid11 == "") { echo "<option>Select personnel</option>"; }
			$result12=""; $found12=0;
			$result12 = mysql_query("SELECT tblemployee.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblemployee INNER JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid ORDER BY tblemployee.employeeid ASC", $dbh);
			if($result12 != "") {
				while($myrow12 = mysql_fetch_row($result12)) {
				$found12 = 1;
				$employeeid12 = $myrow12[0];
				$name_last12 = $myrow12[1];
				$name_first12 = $myrow12[2];
				$name_middle12 = $myrow12[3];
				if($employeeid12 == $employeeid11) { $empidsel="selected"; } else { $empidsel=""; }
				echo "<option value=\"$employeeid12\" $empidsel>$employeeid12 - $name_last12, $name_first12 $name_middle12[0]</option>";
				}
			}
			echo "</select>";
			echo "<input type=\"submit\" value=\"Update\"></td></form>";

			echo "</tr>";

			}
		}


		echo "</table>";

  }

// end contents here...

// edit body-footer
     echo "<p><a href=\"mnghrmod.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 