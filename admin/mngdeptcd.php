<?php 

include("db1.php");

$loginid = $_GET['loginid'];

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
     echo "<p><font size=1>Manage >> Categories >> Departments</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

     echo "<tr><th colspan=\"4\">PKII Departments</th></tr>";

// start contents here...
  if($accesslevel >= 4)
  {
		echo "<form action=\"mngdeptadd.php?loginid=$loginid\" method=\"post\" name=\"form1\">";
		echo "<tr><th align=\"right\">Code</th>";
		echo "<td colspan=\"3\"><input name=\"deptcd\"></td></tr>";
		echo "<tr><th align=\"right\">Name</th>";
		echo "<td colspan=\"3\"><input name=\"deptname\"></td></tr>";
		echo "<tr><th align=\"right\">Remarks</th>";
		echo "<td colspan=\"3\"><textarea cols=\"30\" rows=\"2\" name=\"deptremarks\"></textarea></td></tr>";
    echo "<tr><td colspan=\"4\" align=\"center\"><input type=submit value=\"Add Department\"></td></tr>";
		echo "</form>";
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
			echo "<tr><td>$code11</td><td>$name11</td>";
			echo "<td><a href=\"mngdeptedit.php?loginid=$loginid&idd=$iddeptcd11\">Edit</a></td>";
			echo "<td><a href=\"mngdeptdel.php?loginid=$loginid&idd=$iddeptcd11\">Del</a></td>";
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