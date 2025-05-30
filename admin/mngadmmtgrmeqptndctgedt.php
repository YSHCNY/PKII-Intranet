<?php 
//
// mngadmmtgrmeqptndctgedt.php //20220104
// fr mngadmmtgrmeqptndctg.php
//
include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idadmctgmtgrmeqptlst = (isset($_GET['idmrel'])) ? $_GET['idmrel'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Manage >> Categories >> PKII C.O. Meeting rooms >> Edit list of equipment needed</font></p>";

// start contents here...
  if($accesslevel >= 4) {

    echo "<table class=\"table table-striped\">";
		echo "<thead>";
    echo "<tr><th colspan=\"4\">Edit list of equipment needed for Meeting rooms</th></tr>";
		echo "</thead>";
		if($idadmctgmtgrmeqptlst!='') {
			// query tbladmctgmtgrm
			$res11qry=""; $result11=""; $found11=0;
			$res11qry="SELECT `code`, `name`, `description`, `remarks`, `filepath`, `filename` FROM tbladmctgmtgrmeqptlst WHERE idadmctgmtgrmeqptlst=$idadmctgmtgrmeqptlst LIMIT 1";
			$result11=$dbh2->query($res11qry);
			if($result11->num_rows>0) {
				while($myrow11=$result11->fetch_assoc()) {
					$found11=1;
					$code11 = $myrow11['code'];
					$name11 = $myrow11['name'];
					$description11 = $myrow11['description'];
					$remarks11 = $myrow11['remarks'];
					$filepath11 = $myrow11['filepath'];
					$filename11 = $myrow11['filename'];
				} // while
			} // if
		}
		echo "<tbody>";
		echo "<form action=\"mngadmmtgrmeqptndctgedt2.php?loginid=$loginid\" method=\"POST\" name=\"mngadmmtgrmeqptndctgedt2\">";
		echo "<input type='hidden' name='idadmctgmtgrmeqptlst' value='$idadmctgmtgrmeqptlst'>";
		echo "<tr><th colspan=\"4\">";
		echo "<table class='table'>";
		echo "<tr><th class='text-right'>code</th><td>";
		echo "<div class='form-group'><input class='form-control' name='code' placeholder='code' value='$code11' readonly></div>";
		echo "</td></tr>";
		echo "<tr><th class='text-right'>name</th><td>";
		echo "<div class='form-group'><input class='form-control' name='name' placeholder='name' value='$name11'></div>";
		echo "</td></tr>";
		echo "<tr><th class='text-right'>description</th><td>";
		echo "<div class='form-group'><textarea rows='3' class='form-control' name='description' placeholder='description'>$description11</textarea></div>";
		echo "</td></tr>";
		echo "<tr><td colspan='2' class='text-center'><button type='submit' class='btn btn-success'>Save</button></td></tr>";
		echo "</table>";
		echo "</th></tr>";
		echo "</form>";
		echo "</tbody>";
    echo "</table>";
  } // if($accesslevel>=4)
// end contents here...

// edit body-footer
     echo "<p><button type=\"button\" class=\"btn btn-default\" onclick=\"window.location='mngadmmtgrmeqptndctg.php?loginid=$loginid'\">Back</button></p>";

		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?>
