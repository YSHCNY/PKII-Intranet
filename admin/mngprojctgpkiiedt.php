<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idprojctgpkii = (isset($_POST['idprojctgpkii'])) ? $_POST['idprojctgpkii'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Manage >> Categories >> PKII project categories >> Edit item</font></p>";

// start contents here...
  if($accesslevel >= 4) {
		if($idprojctgpkii!='') {

		// query record for editing
		$res11query="SELECT code, name, seq, remarks FROM tblprojctgpkii WHERE idprojctgpkii=$idprojctgpkii";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11 = 1;
			$code11 = $myrow11['code'];
			$name11 = $myrow11['name'];
			$seq11 = $myrow11['seq'];
			$remarks11 = $myrow11['remarks'];
			} // while
		} // if

		if($found11==1) {
    echo "<table class=\"table table-striped\">";
		echo "<thead>";
    echo "<tr><th colspan=\"2\">Manage Categories - PKII Project Categories - Edit item</th></tr>";
		echo "</thead>";
		echo "<tbody>";
		echo "<form action=\"mngprojctgpkiiedt2.php?loginid=$loginid\" method=\"POST\" name=\"mngprojctgpkiiedt2\">";
		echo "<input type=\"hidden\" name=\"idprojctgpkii\" value=\"$idprojctgpkii\">";
		echo "<tr><th class=\"text-right\">code</th><td><input size=\"10\" name=\"code\" value=\"$code11\"></td></tr>";		
		echo "<tr><th class=\"text-right\">name</th><td><input size=\"80\" name=\"name\" value=\"$name11\"></td></tr>";		
		echo "<tr><th class=\"text-right\">seq</th>";
		echo "<td><input type=\"number\" min=\"1\" max=\"1000\" name=\"seq\" value=\"$seq11\"></td></tr>";		
		echo "<tr><th></th><td>";
		echo "<button type=\"submit\" class=\"btn btn-success\">Update</button>";
		echo "</td></tr>";
		echo "</form>";
		echo "</table>";
		} // if

		} // if
  } // if($accesslevel>=4)
// end contents here...

// edit body-footer
     echo "<p><button type=\"button\" class=\"btn btn-primary\" onclick=\"window.location='mngprojctgpkii.php?loginid=$loginid'\">Back</button></p>";

		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?>
