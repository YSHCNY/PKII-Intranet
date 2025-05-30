<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$iddeptcd = $_GET['idd'];

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
     echo "<p><font size=1>Manage >> Categories >> Departments - Edit</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

     echo "<tr><th colspan=\"4\">PKII Departments - Edit</th></tr>";

// start contents here...
  if($accesslevel >= 4)
  {

	$result11=""; $found11=0; $ctr11=0;
	$result11 = mysql_query("SELECT code, name, remarks FROM tbldeptcd WHERE iddeptcd=$iddeptcd", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$code11 = $myrow11[0];
		$name11 = $myrow11[1];
		$remarks11 = $myrow11[2];
		}
	}
		echo "<form action=\"mngdeptedit2.php?loginid=$loginid&idd=$iddeptcd\" method=\"post\">";
		echo "<tr><th align=\"right\">Code</th>";
		echo "<td colspan=\"3\"><input name=\"deptcd\" value=\"$code11\"></td></tr>";
		echo "<tr><th align=\"right\">Name</th>";
		echo "<td colspan=\"3\"><input name=\"deptname\" value=\"$name11\"></td></tr>";
		echo "<tr><th align=\"right\">Remarks</th>";
		echo "<td colspan=\"3\"><textarea cols=\"30\" rows=\"2\" name=\"deptremarks\">$remarks11</textarea></td></tr>";
    echo "<tr><td colspan=\"4\" align=\"center\"><input type=submit value=\"Save\"></td></tr>";
		echo "<tr><th colspan=\"4\">List</th></tr>";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("SELECT iddeptcd, code, name, remarks FROM tbldeptcd", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$iddeptcd11 = $myrow11[0];
			$code11 = $myrow11[1];
			$name11 = $myrow11[2];
			$remarks11 = $myrow11[3];
			echo "<tr><td>$code11</td><td colspan=\"3\">$name11</td>";
			// echo "<td><a href=\"mngdeptedit.php?loginid=$loginid&idd=$iddeptcd11\">Edit</a></td>";
			// echo "<td><a href=\"mngdeptdel.php?loginid=$loginid&idd=$iddeptcd11\">Del</a></td>";
			echo "</tr>";
			}
		}
  }

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"mngcateg.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
