<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idprojctgenr = (isset($_GET['idpce'])) ? $_GET['idpce'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Manage >> Categories >> Project ENR</font></p>";

// start contents here...
if($idprojctgenr!='') {

  if($accesslevel >= 4) {

    echo "<table class=\"table table-striped\">";
		echo "<thead>";
    echo "<tr><th colspan=\"4\">Manage Categories - Project ENR - Edit</th></tr>";
		echo "</thead>";
		// query tblprojctgmilestone
		$res11query="SELECT code, name_e, name_j, seq, remarks FROM tblprojctgenr WHERE idprojctgenr=$idprojctgenr";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11=$ctr11+1;
			$code11 = $myrow11['code'];
			$name_e11 = $myrow11['name_e'];
			$name_j11 = $myrow11['name_j'];
			$seq11 = $myrow11['seq'];
			$remarks11 = $myrow11['remarks'];
			} // while
		} // if
		if($found11==1) {
		echo "<tbody>";
		echo "<form action=\"mngprojctgenredt2.php?loginid=$loginid\" method=\"POST\" name=\"mngprojctgenredt2\">";
		echo "<input type='hidden' name='idpce' value='$idprojctgenr'>";
		echo "<tr><th colspan=\"4\">";
		echo "<table class='fin'>";
		echo "<tr><th class='text-right'>code</th><td><input name='code' value='$code11' readonly></td></tr>";
		echo "<tr><th class='text-right'>name (ENG)</th><td><input size='50' name='name_e' value='$name_e11'></td></tr>";
		echo "<tr><th class='text-right'>name (JAP)</th><td><input size='50' name='name_j' value='$name_j11'></td></tr>";
		echo "<tr><th class=\"text-right\">seq</th><td><input type=\"number\" min=\"1\" max=\"1000\" name=\"seq\" value='$seq11'></td></tr>";
		echo "<tr><th class=\"text-right\">remarks</th><td><textarea rows='3' cols='50' name='remarks'>$remarks11</textarea></td></tr>";
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
     echo "<p><button type=\"button\" class=\"btn btn-primary\" onclick=\"window.location='mngprojenrctg.php?loginid=$loginid'\">Back</button></p>";

		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?>