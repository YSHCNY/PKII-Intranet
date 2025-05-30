<?php 
//
// mngadmmtgrmeqptndctg.php // 20220104
// fr mngcateg.php
//
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
     echo "<p><font size=1>Manage >> Categories >> Equipment needed for Meeting rooms</font></p>";

// start contents here...
  if($accesslevel >= 4) {

    echo "<table class=\"table table-striped\">";
		echo "<thead>";
    echo "<tr><th colspan=\"4\">Manage Categories - PKII C.O. Meeting rooms - List of equipments</th></tr>";
		echo "</thead>";
		echo "<tbody>";
		echo "<form action=\"mngadmmtgrmeqptndctgadd.php?loginid=$loginid\" method=\"POST\" name=\"mngadmmtgrmeqptndctgadd\">";
		echo "<tr><th colspan=\"4\">";
		echo "<table class='table'>";
		echo "<tr><th class='text-right'>code</th><td>";
		echo "<div class='form-group'><input class='form-control' name='code' placeholder='code'></div>";
		echo "</td></tr>";
		echo "<tr><th class='text-right'>name</th><td>";
		echo "<div class='form-group'><input class='form-control' name='name' placeholder='name'></div>";
		echo "</td></tr>";
		echo "<tr><th class='text-right'>description</th><td>";
		echo "<div class='form-group'><textarea rows='3' class='form-control' name='description' placeholder='description'></textarea></div>";
		echo "</td></tr>";
		echo "<tr><td colspan='2' class='text-center'><button type='submit' class='btn btn-success'>Add</button></td></tr>";
		echo "</table>";
		echo "</th></tr>";
		echo "</form>";
		echo "<tr><th>ctr</th><th>code</th><th>name</th><th>description</th><th>image</th><th colspan='2'>action</th></tr>";
		// query tblprojctgmilestone
		$res11query="SELECT idadmctgmtgrmeqptlst, code, name, `description`, remarks, filepath, filename FROM tbladmctgmtgrmeqptlst ORDER BY code ASC";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11=$ctr11+1;
			$idadmctgmtgrmeqptlst11 = $myrow11['idadmctgmtgrmeqptlst'];
			$code11 = $myrow11['code'];
			$name11 = $myrow11['name'];
			$description11 = $myrow11['description'];
			$remarks11 = $myrow11['remarks'];
			$filepath11 = $myrow11['filepath'];
			$filename11 = $myrow11['filename'];
			echo "<tr><td>$ctr11</td><td>$code11</td><td>$name11</td><td>".nl2br($description11)."</td>";
			if($filename11!='') {
			echo "<td><a href='./$filepath11/$filename11' target='_blank'>$filename11</a></td>";
			} else {
			echo "<td></td>";
			} //if-else
			echo "<td><a href='mngadmmtgrmeqptndctgedt.php?loginid=$loginid&idmrel=$idadmctgmtgrmeqptlst11' class='btn btn-warning'>Edit</a>";
			echo "&nbsp;";
			echo "<a href='mngadmmtgrmeqptndctgdel.php?loginid=$loginid&idmrel=$idadmctgmtgrmeqptlst11' class='btn btn-danger'>Del</a></td>";
			echo "</tr>";
			} // while
		} // if
		echo "</tbody>";
    echo "</table>";
  } // if($accesslevel>=4)
// end contents here...

// edit body-footer
     echo "<p><button type=\"button\" class=\"btn btn-default\" onclick=\"window.location='mngcateg.php?loginid=$loginid'\">Back</button></p>";

		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?>
