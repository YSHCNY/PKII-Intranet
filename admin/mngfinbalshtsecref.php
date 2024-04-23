<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$ver = $_POST['ver'];

if ($ver == '')
{
  $result10 = mysql_query("SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"", $dbh);
  if($result10 != '')
  {
    while($myrow10 = mysql_fetch_row($result10))
    {
      $found10 = 1;
      $version10 = $myrow10[0];
    }
  }
  $ver = $version10;
}

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
  echo "<p><font size=1>Manage >> Accounting Modules >> Balance Sheet categories</font></p>";

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

  echo "<tr><th colspan=\"7\">Balance Sheet categories</th></tr>";

// start contents here...

	echo "<form action=\"mngfinbalshtsecrefadd.php?loginid=$loginid\" method=\"post\">";
  echo "<tr><td colspan=\"7\" align=\"center\">";
  echo "<input type=\"submit\" value=\"Add new\"></td></tr>";
	echo "</form>";

	echo "<tr><th>No.</th><th>Code</th><th>Name</th><th>Group</th><th>Remarks</th><th colspan=\"2\">Action</th></tr>";

	$result11=""; $found11=0; $ctr11=0;
	$result11 = mysql_query("SELECT * FROM tblfinbalshtsecref ORDER BY code ASC", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$finbalshtsecrefid11 = $myrow11[0];
		$code11 = $myrow11[3];
		$name11 = $myrow11[4];
		$group11 = $myrow11[5];
		$remarks11 = $myrow11[6];
		$ctr11 = $ctr11 + 1;

		echo "<tr><td>$ctr11</td><td>$code11</td><td>$name11</td><td>$group11</td><td>$remarks11</td>";
		// echo "<td><a href=\"mngfinbalshtsecrefedit.php?loginid=$loginid&bssrid=$finbalshtsecrefid11\">Edit</a></td>";
		echo "<td>Edit</td>";
		echo "<td><a href=\"mngfinbalshtsecrefdel.php?loginid=$loginid&bssrid=$finbalshtsecrefid11\">Del</a></td>";
		}
	}

// end contents here...

  echo "</table>";

// edit body-footer
     echo "<p><a href=\"mngfinmods.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
