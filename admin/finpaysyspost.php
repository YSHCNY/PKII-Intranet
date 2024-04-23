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
     echo "<p><font size=1>Modules >> Payroll System >> Post-process tools</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

  echo "<tr><td colspan=\"2\">";
	echo "<table class=\"fin\" border=\"0\">";
	echo "<tr><th colspan=\"5\">Payroll System Post-process Tools</th></tr>";
	echo "<tr>";

  if($accesslevel >= 4) {
    echo "<td>";
		echo "<form action=\"finpaysystasumm.php?loginid=$loginid\" method=\"post\" name=\"finpaysystasumm\">";
		echo "<input type=\"submit\" value=\"View results\">";
		echo "</form>";
    echo "</td>";
    echo "<td>";
		echo "<form action=\"finpaysysaddinc.php?loginid=$loginid\" method=\"post\" name=\"finpaysysaddinc\">";
		echo "<input type=\"submit\" value=\"Request for payment\">";
		echo "</form>";
    echo "</td>";
    echo "<td>";
		echo "<form action=\"finpaysysded.php?loginid=$loginid\" method=\"post\" name=\"finpaysysded\">";
		echo "<input type=\"submit\" value=\"BPI hash\">";
		echo "</form>";
    echo "</td>";
    echo "<td>";
		echo "<form action=\"finpaysyscompute.php?loginid=$loginid\" method=\"post\" name=\"finpaysyscompute\">";
		echo "<input type=\"submit\" value=\"Payslip notifier\">";
		echo "</form>";
    echo "</td>";
    echo "<td>";
		echo "<form action=\"finpaysyspost.php?loginid=$loginid\" method=\"post\" name=\"finpaysyspost\">";
		echo "<input type=\"submit\" value=\"Delete this cut-off\">";
		echo "</form>";
    echo "</td>";
  }

	echo "</tr>";
	echo "</table>";
  echo "</td></tr>";

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"finpaysys.php?loginid=$loginid\">Back</a></p>";

		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
