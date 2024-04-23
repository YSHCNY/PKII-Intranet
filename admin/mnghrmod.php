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
     echo "<p><font size=1>Manage >> HR Modules</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

     echo "<tr><th colspan=\"2\">HR Modules</th></tr>";

// start contents here...
  if($accesslevel >= 4) {
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mnghrofctimelogsync.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" class=\"btn btn-primary\" value=\"Sync time log\"></form></td>";
    echo "<td>Upload/sync office time log of biometrics to intranet's maindb</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mnghruseridsync.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" class=\"btn btn-primary\" value=\"Sync userid\"></form></td>";
    echo "<td>Upload/sync userid of biometrics to intranet's maindb</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mnghrempidlink.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" class=\"btn btn-primary\" value=\"Link EmployeeID\"></form></td>";
    echo "<td>Link EmployeeID to Fingerprint Biometrics ID</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mnghrpositions.php?loginid=$loginid\" method=\"post\" name=\"mnghrpositions\"><input type=\"submit\" class=\"btn btn-primary\" value=\"Job Positions\"></form></td>";
    echo "<td>Manage job positions for employee profiles and project deployments</td>";
    echo "</tr>";

    echo "<tr><th colspan=\"2\">Time & attendance</th></tr>";
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mnghrempshiftctg.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" class=\"btn btn-primary\" value=\"Shifts category\"></form></td>";
    echo "<td>Manage different shifts category for payroll system computation</td>";
    echo "</tr>";
		echo "<tr>";
		echo "<td align=\"center\"><form action=\"hrtimeattholidays.php?loginid=$loginid\" method=\"post\" name=\"modhrtaholidays\">";
		echo "<input type=\"submit\" class=\"btn btn-primary\" value=\"Holidays\">";
		echo "</form>";
		echo "</td>";
		echo "<td>Manage holidays and shortened periods for time & attendance and payroll system</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td align=\"center\"><form action=\"hrtimeattleave.php?loginid=$loginid\" method=\"post\" name=\"modhrtaleave\">";
		echo "<input type=\"submit\" class=\"btn btn-primary\" value=\"Leave category\">";
		echo "</form>";
		echo "</td>";
		echo "<td>Manage type of leaves including quotas</td>";
		echo "</tr>";

		// added 20161113
    echo "<tr><th colspan=\"2\">Government benefits tables</th></tr>";
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mnghrbnftssscontrib.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" class=\"btn btn-primary\" value=\"SSS contributions\"></form></td>";
    echo "<td>Manage SSS contributions table</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mnghrbnftphlhealth.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" class=\"btn btn-primary\" value=\"Philhealth contributions\"></form></td>";
    echo "<td>Manage Philhealth contributions table</td>";
    echo "</tr>";

		// added 20171023
    echo "<tr><th colspan=\"2\">Personnel requisition form</th></tr>";
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mnghrpersreqappr.php?loginid=$loginid\" method=\"post\" name=\"mnghrpersreqappr\"><input type=\"submit\" class=\"btn btn-primary\" value=\"Personnel Requisition Approvers\"></form></td>";
    echo "<td>Manage approvers of personnel requisition form</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mnghrpersreqsteps.php?loginid=$loginid\" method=\"post\" name=\"mnghrpersreqsteps\"><input type=\"submit\" class=\"btn btn-primary\" value=\"Recruitment steps\"></form></td>";
    echo "<td>Manage titles of recruitment/hiring steps (1-10)</td>";
    echo "</tr>";

  }

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"index2.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");

} else {

     include("logindeny.php");

}

$dbh2->close();
?> 
