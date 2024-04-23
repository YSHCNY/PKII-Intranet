<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Manage >> Categories >> IT Support requests</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

     echo "<tr><th colspan=\"6\">IT Support Requests</th></tr>";

// start contents here...
  if($accesslevel >= 4) {
		echo "<form action=\"mngitsuppreqadd.php?loginid=$loginid\" method=\"post\" name=\"form1\">";
		echo "<tr><th colspan=\"2\" align=\"right\">Code</th>";
		echo "<td colspan=\"4\"><input name=\"itsrcd\"></td></tr>";
		echo "<tr><th colspan=\"2\" align=\"right\">Name</th>";
		echo "<td colspan=\"4\"><input size=\"50\" name=\"itsrname\"></td></tr>";
		echo "<tr><th colspan=\"2\" align=\"right\">Type</th>";
		echo "<td colspan=\"4\">";
		echo "<select name=\"itsrtype\">";
		echo "<option value=''>-</option>";
		echo "<option value=\"REQ\">Request</option>";
		echo "<option value=\"ACT\">Action</option>";
		echo "</select>";
		echo "</td></tr>";
    echo "<tr><td colspan=\"6\" align=\"center\"><input type=submit value=\"Add\"></td></tr>";
		echo "</form>";
		echo "<tr><th colspan=\"6\">List</th></tr>";
		$res11query = "SELECT idtblctgsuppreq, code, name, ctgtype FROM tblitctgsuppreq";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$ctr11 = $ctr11 + 1;
			$idtblctgsuppreq11 = $myrow11['idtblctgsuppreq'];
			$code11 = $myrow11['code'];
			$name11 = $myrow11['name'];
			$ctgtype11 = $myrow11['ctgtype'];
			echo "<tr><td>$ctr11</td><td>$code11</td><td>$name11</td><td>$ctgtype11</td>";
			echo "<td><a href=\"mngitsuppreqedit.php?loginid=$loginid&itsr=$idtblctgsuppreq11\">Edit</a></td>";
			echo "<td><a href=\"mngitsuppreqdel.php?loginid=$loginid&itsr=$idtblctgsuppreq11\">Del</a></td>";
			echo "</tr>";
			} // while($myrow11 = $result11->fetch_assoc())
		} // if($result11->num_rows>0)
  } // if($accesslevel >= 4)

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"mngcateg.php?loginid=$loginid\">Back</a></p>";

	$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
	$result = $dbh2->query($resquery);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

$dbh2->close();
?> 
