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
     echo "<p><font size=1>Manage >> Categories</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

     echo "<tr><th colspan=\"2\">Manage Categories</th></tr>";

// start contents here...
  if($accesslevel >= 4) {
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mngdeptcd.php?loginid=$loginid\" method=\"post\"><button type='submit' class='btn btn-primary'>Departments</button></form></td>";
    echo "<td>PKII List of Departments</td>";
    echo "</tr>";
		echo "<tr>";
    echo "<td align=\"center\"><form action=\"mngitsuppreq.php?loginid=$loginid\" method=\"post\"><button type='submit' class='btn btn-primary'>IT Support requests</button></form></td>";
    echo "<td>ITD support request categories</td>";
    echo "</tr>";
		echo "<tr>";
    echo "<td align=\"center\"><form action=\"mngitsuppreqappr.php?loginid=$loginid\" method=\"post\"><button type='submit' class='btn btn-primary'>IT Support approvers</button></form></td>";
    echo "<td>ITD support request approvers, 2 per department</td>";
    echo "</tr>";
		// added 20181030 start
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mngprojctgsvcs.php?loginid=$loginid\" method=\"post\"><button type='submit' class='btn btn-primary'>Project Services</button></form></td>";
    echo "<td>Manage project service types category</td>";
    echo "</tr>";
		// added 20181030 end
		// added 20180507 from mngfinmods.php
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mngfinprojrelref.php?loginid=$loginid\" method=\"post\"><button type='submit' class='btn btn-primary'>Project Relationships</button></form></td>";
    echo "<td>Manage project relationships</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mngprojmilestone.php?loginid=$loginid\" method=\"post\"><button type='submit' class='btn btn-primary'>Project Milestones</button></form></td>";
    echo "<td>Manage project milestones for lumpsum contracts</td>";
    echo "</tr>";
		// added 20180509
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mngprojctgpkii.php?loginid=$loginid\" method=\"post\"><button type='submit' class='btn btn-primary'>PKII Project Categories</button></form></td>";
    echo "<td>Manage PKII project categories</td>";
    echo "</tr>";
		// 20190828
    /*
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mngprojtskrolectg.php?loginid=$loginid\" method=\"post\"><button type='submit' class='btn btn-primary'>Proj Mgmt Sys Roles</button></form></td>";
    echo "<td>Manage Project Management System Role users for Team Leaders and Project Coordinators</td>";
    echo "</tr>";
    */
    // 20190919
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mngprojenrctg.php?loginid=$loginid\" method=\"post\"><button type='submit' class='btn btn-primary'>Proj E.N.R.</button></form></td>";
    echo "<td>Manage Project ENR categories</td>";
    echo "</tr>";

    // 20200608
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mngadmmtgrmctg.php?loginid=$loginid\" method=\"post\" name=\"mngadmmtgrmctg\"><button type='submit' class='btn btn-primary'>PKII C.O. Meeting rooms</button></form></td>";
    echo "<td>Manage PKII C.O. Meeting rooms categories</td>";
    echo "</tr>";

    // 20220104
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"mngadmmtgrmeqptndctg.php?loginid=$loginid\" method=\"post\" name=\"mngadmmtgrmeqptndctg\"><button type='submit' class='btn btn-primary'>Equipment needed on Meeting rooms</button></form></td>";
    echo "<td>Manage list of equipments for Meeting rooms</td>";
    echo "</tr>";

  } // if($accesslevel>=4)

// end contents here...

     echo "</table>";

// edit body-footer
		echo "<p><a href='index2.php?loginid=$loginid' class='btn btn-default'>Back</a></p>";
     // echo "<p><a href=\"index2.php?loginid=$loginid\">Back</a></p>";

		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?> 
