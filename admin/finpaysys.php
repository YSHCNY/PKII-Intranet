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
     echo "<p><font size=1>Modules >> Payroll System</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

  echo "<tr><td colspan=\"2\">";
	echo "<table class=\"fin\" border=\"0\">";
	echo "<tr><th colspan=\"6\">Payroll System V2</th></tr>";
	echo "<tr>";

  if($accesslevel >= 3) {
    echo "<td>";
		echo "<form action=\"finpaysystasumm.php?loginid=$loginid\" method=\"post\" name=\"finpaysystasumm\">";
		echo "<input type=\"submit\" value=\"T&A Summary\">";
		echo "</form>";
    echo "</td>";
    echo "<td>";
		echo "<form action=\"finpaysysempinfo.php?loginid=$loginid\" method=\"post\" name=\"finpaysysempinfo\">";
		echo "<input type=\"submit\" value=\"Indiv.Info / Proj.Pct\">";
		echo "</form>";
    echo "</td>";
    echo "<td>";
		echo "<form action=\"finpaysysaddinc.php?loginid=$loginid\" method=\"post\" name=\"finpaysysaddinc\">";
		echo "<input type=\"submit\" value=\"Add'l income\">";
		echo "</form>";
    echo "</td>";
    echo "<td>";
		echo "<form action=\"finpaysysded.php?loginid=$loginid\" method=\"post\" name=\"finpaysysded\">";
		echo "<input type=\"submit\" value=\"Deductions\">";
		echo "</form>";
    echo "</td>";
  }

  if($accesslevel >= 4) {
    echo "<td>";
		echo "<form action=\"finpaysyscompute.php?loginid=$loginid\" method=\"post\" name=\"finpaysyscompute\">";
		echo "<input type=\"submit\" value=\"Process payroll\">";
		echo "</form>";
    echo "</td>";
    echo "<td>";
		echo "<form action=\"finpaysyspost.php?loginid=$loginid\" method=\"post\" name=\"finpaysyspost\">";
		echo "<input type=\"submit\" value=\"Post-process tools\">";
		echo "</form>";
    echo "</td>";
  }

	echo "</tr>";
	echo "</table>";
  echo "</td></tr>";

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"index2.php?loginid=$loginid\">Back</a></p>";

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
