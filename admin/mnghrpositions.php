<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Manage >> HR Modules >> Job positions</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...
		echo "<tr><th colspan=\"2\">Manage Job Positions</th></tr>";

  if($accesslevel >= 4) {
		echo "<form action=\"mnghrpositionsadd.php?loginid=$loginid\" method=\"post\" name=\"mnghrpositionsadd\">";
    echo "<tr><th align=\"right\">position code</th><td><input name=\"code\"></td></tr>";
    echo "<tr><th align=\"right\">position name</th><td><input size=\"40\" name=\"name\"></td></tr>";
		echo "<tr><th align=\"right\">department</th><td>";
		echo "<select name=\"deptcd\">";
		echo "<option value=''>-</option>";
		$res11query="SELECT iddeptcd, code, name FROM tbldeptcd";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$iddeptcd11 = $myrow11['iddeptcd'];
			$code11 = $myrow11['code'];
			$name11 = $myrow11['name'];
			echo "<option value=\"$code11\">$name11</option>";
			} // while($myrow11=$result11->fetch_assoc())
		} // if($result11->num_rows>0)
		echo "</select>";
		echo "</td></tr>";
		echo "<tr><th align=\"right\">position level</th><td><input type=\"number\" min=\"0\" max=\"5\" name=\"positionlevel\" value=\"0\"></td></tr>";
		echo "<tr><th align=\"right\">salary grade</th><td><input type=\"number\" min=\"0\" max=\"12\" name=\"salarygrade\" value=\"0\"></td></tr>";
		echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Add\"></td></tr>";
		echo "</form>";

		echo "<tr><th colspan=\"2\">List of job positions</th></tr>";
		echo "<tr><td colspan=\"2\"><table width=\"100%\" class=\"fin\" border=\"1\">";
		echo "<tr><th>count</th><th>code</th><th>name</th><th>dept</th><th>pos.level</th><th>sal.grade</th><th colspan=\"2\">action</th></tr>";
		$res12query="SELECT idhrpositionctg, code, name, deptcd, salarygrade, positionlevel FROM tblhrpositionctg ORDER BY name ASC";
		$result12=""; $found12=0; $ctr12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
			$found12=1;
			$ctr12 = $ctr12+1;
			$idhrpositionctg12 = $myrow12['idhrpositionctg'];
			$code12 = $myrow12['code'];
			$name12 = $myrow12['name'];
			$deptcd12 = $myrow12['deptcd'];
			$salarygrade12 = $myrow12['salarygrade'];
			$positionlevel12 = $myrow12['positionlevel'];
			echo "<tr><td>$ctr12</td><td>$code12</td><td>$name12</td><td>$deptcd12</td><td>$positionlevel12</td><td>$salarygrade12</td>";
			echo "<td><a href=\"mnghrpositionsdel.php?loginid=$loginid&idp=$idhrpositionctg12\">del</a></td>";
			echo "<td><a href=\"mnghrpositionsedt.php?loginid=$loginid&idp=$idhrpositionctg12\">edit</a></td>";
			} // while($myrow12=$result12->fetch_assoc())
		} // if($result12->num_rows>0)
		echo "</table></td></tr>";
  }

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"mnghrmod.php?loginid=$loginid\">Back</a></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?> 
