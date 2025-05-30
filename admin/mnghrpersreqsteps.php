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
     echo "<p><font size=1>Manage >> HR Modules >> Personnel Requisition >> Recruitment Steps</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

     echo "<tr><th colspan=\"2\">Personnel Recruitment Steps</th></tr>";

// start contents here...
  if($accesslevel >= 4) {

		echo "<form action=\"mnghrpersreqstepsupd.php?loginid=$loginid\" method=\"POST\" name=\"mnghrpersreqstepsupd\">";

		for($s=1; $s<=10; $s++) {
			$sfin="S".$s;
			// echo "<tr><td colspan=\"2\">sfin:$sfin</td></tr>";
			echo "<input type=\"hidden\" name=\"code[]\" value=\"$sfin\">";
		// query tblhrpersreqstepsctg and loop steps 1-10
		$res11query="SELECT name, remarks FROM tblhrpersreqstepsctg WHERE code=\"$sfin\" ORDER BY code ASC LIMIT 1";
		$result11=""; $found11=0; $ctr11=0;
		$name11=""; $remarks11="";
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$name11 = $myrow11['name'];
			$remarks11 = $myrow11['remarks'];
			} // while($myrow11=$result->fetch_assoc())
		} // if($result11->num_rows>0)
			echo "<tr><th>$sfin</th><td><input size=\"50\" name=\"name[]\" value=\"$name11\"></td></tr>";
		} // for($s=0, $s<=10, $s++)

		echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Update\"></td></tr>";
		echo "</form>";

  } // if($accesslevel >= 4)

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"mnghrmod.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");

} else {

     include("logindeny.php");

}

$dbh2->close();
?>
