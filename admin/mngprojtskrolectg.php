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
     echo "<p><font size=1>Manage >> Categories >> Project Mgmt System role users</font></p>";

// start contents here...
  if($accesslevel >= 4) {

    echo "<table class=\"table table-striped\">";
		echo "<thead>";
    echo "<tr><th colspan=\"5\">Manage Categories - Project Mgmt System - Role users</th></tr>";
		echo "</thead>";
		echo "<tbody>";

	// query tblproject1 and provide dropdown

	// query distinct employeeid from projassign based on selected projcode

	// select employeeid for team leader

	// select employeeid for project coordinator

		echo "<tr><th colspan=\"5\">";
		echo "<form action=\"mngprojmilestoneadd.php?loginid=$loginid\" method=\"POST\" name=\"mngprojmilestoneadd\">";
		echo "<tr><th class=\"text-right\">code</th><td><input size=\"10\" name=\"code\"></td></tr>";		
		echo "<tr><th class=\"text-right\">name</th><td><input size=\"50\" name=\"name\"></td></tr>";
		// query tblprojctgmilestone
		$res12query="SELECT seq FROM tblprojctgmilestone ORDER BY seq DESC LIMIT 1";
		$result12=""; $found12=0; $ctr12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
			$found12=1;
			$seq12 = $myrow12['seq'];
			} // while
		} // if
		if($found12==1) {
		$seqval=$seq12+10;
		} else {
		$seqval=10;
		} // if-else
		echo "<tr><th class=\"text-right\">seq</th><td><input type=\"number\" min=\"1\" max=\"200\" name=\"seq\" value='$seqval'></td></tr>";		
		echo "<tr><th></th><td>";
		echo "<button type='submit' class='btn btn-success'>Add new</button>";
		echo "</td></tr>";
		// echo "<button type=\"submit\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#myModal\">Add new</button>";
		echo "</form>";
		echo "</th></tr>";

		echo "<tr><th colspan='5'><table class='fin'>";
		echo "<tr><th>ctr</th><th>code</th><th>name</th><th>seq</th><th>action</th></tr>";
		// query tblprojctgmilestone
		$res11query="SELECT idprojctgmilestone, code, name, seq FROM tblprojctgmilestone ORDER BY seq ASC";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11=$ctr11+1;
			$idprojctgmilestone11 = $myrow11['idprojctgmilestone'];
			$code11 = $myrow11['code'];
			$name11 = $myrow11['name'];
			$seq11 = $myrow11['seq'];
			echo "<tr><td>$ctr11</td><td>$code11</td><td>$name11</td><td>$seq11</td><td>";
			echo "<a href='mngprojmilestoneedt.php?loginid=$loginid&idpms=$idprojctgmilestone11' class='btn btn-warning'>Edit</a>";
			echo "&nbsp;";
			echo "<a href='mngprojmilestonedel.php?loginid=$loginid&idpms=$idprojctgmilestone11' class='btn btn-danger'>Del</a>";
			echo "</td></tr>";
			} // while
		} // if
		echo "</table></th></tr>";
		echo "</tbody>";
    echo "</table>";
  } // if($accesslevel>=4)
// end contents here...

// edit body-footer
     echo "<p><button type=\"button\" class=\"btn btn-primary\" onclick=\"window.location='mngcateg.php?loginid=$loginid'\">Back</button></p>";

		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?>