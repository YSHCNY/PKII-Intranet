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
     echo "<p><font size=1>Manage >> Categories >> Project services</font></p>";

// start contents here...
  if($accesslevel >= 4) {

    echo "<table class=\"table table-striped\">";
		echo "<thead>";
    echo "<tr><th colspan=\"4\">Manage Categories - Project services</th></tr>";
		echo "</thead>";
		echo "<tbody>";
		echo "<form action=\"mngprojctgsvcsadd.php?loginid=$loginid\" method=\"POST\" name=\"mngprojctgsvcsadd\">";
		echo "<tr><th colspan=\"4\">";
		// echo "<button type=\"submit\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#myModal\">Add new</button>";
		echo "<table class='fin'>";
		echo "<tr><th class='text-right'>code</th><td><input name='code'></td></tr>";
		echo "<tr><th class='text-right'>name</th><td><input size='50' name='name'></td></tr>";
		echo "<tr><td colspan='2' class='text-center'><button type='submit' class='btn btn-success'>Add</button></td></tr>";
		echo "</table>";
		echo "</th></tr>";
		echo "</form>";
		echo "<tr><th>ctr</th><th>code</th><th>name</th><th>sequence</th><th>action</th></tr>";
		// query tblprojctgmilestone
		$res11query="SELECT idprojctgservices, code, name, seq FROM tblprojctgservices ORDER BY seq ASC";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11=$ctr11+1;
			$idprojctgservices11 = $myrow11['idprojctgservices'];
			$code11 = $myrow11['code'];
			$name11 = $myrow11['name'];
			$seq11 = $myrow11['seq'];
			echo "<tr><td>$ctr11</td><td>$code11</td><td>$name11</td><td>$seq11</td>";
			echo "<td><a href='mngprojctgsvcsedt.php?loginid=$loginid&idsvc=$idprojctgservices11' class='btn btn-warning'>Edit</a>";
			echo "&nbsp;";
			echo "<a href='mngprojctgsvcsdel.php?loginid=$loginid&idsvc=$idprojctgservices11' class='btn btn-danger'>Del</a></td>";
			echo "</tr>";
			} // while
		} // if
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
