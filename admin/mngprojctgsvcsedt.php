<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idprojctgservices = (isset($_GET['idsvc'])) ? $_GET['idsvc'] :'';

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
if($idprojctgservices!='') {

  if($accesslevel >= 4) {

    echo "<table class=\"table table-striped\">";
		echo "<thead>";
    echo "<tr><th colspan=\"4\">Manage Categories - Project services - Edit</th></tr>";
		echo "</thead>";
		// query tblprojctgmilestone
		$res11query="SELECT code, name FROM tblprojctgservices WHERE idprojctgservices=$idprojctgservices";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11=$ctr11+1;
			$code11 = $myrow11['code'];
			$name11 = $myrow11['name'];
			} // while
		} // if
		if($found11==1) {
		echo "<tbody>";
		echo "<form action=\"mngprojctgsvcsedt2.php?loginid=$loginid\" method=\"POST\" name=\"mngprojctgsvcsadd\">";
		echo "<input type='hidden' name='idpcsvcs' value='$idprojctgservices'>";
		echo "<tr><th colspan=\"4\">";
		echo "<table class='fin'>";
		echo "<tr><th class='text-right'>code</th><td><input name='code' value='$code11' readonly></td></tr>";
		echo "<tr><th class='text-right'>name</th><td><input size='50' name='name' value='$name11'></td></tr>";
		echo "<tr><td colspan='2' class='text-center'><button type='submit' class='btn btn-success'>Save</button></td></tr>";
		echo "</table>";
		echo "</th></tr>";
		echo "</form>";
		echo "</tbody>";
    echo "</table>";
		} // if
  } // if($accesslevel>=4)

} // if

// end contents here...

// edit body-footer
     echo "<p><button type=\"button\" class=\"btn btn-primary\" onclick=\"window.location='mngprojctgsvcs.php?loginid=$loginid'\">Back</button></p>";

		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?>
