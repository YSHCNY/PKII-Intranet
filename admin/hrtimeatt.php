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
     echo "<p><font size=1>Modules >> Time and Attendance</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

  echo "<tr><td colspan=\"2\">";
	echo "<table class=\"fin\" border=\"0\">";
	echo "<tr>";

  if($accesslevel >= 4) {
    echo "<td>";
		echo "<form action=\"hrtimeattpaygrp.php?loginid=$loginid\" method=\"post\" name=\"modhrtapaygrp\">";
		// echo "<input type=\"submit\" value=\"Pay group\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\">Pay group</button>";
		echo "</form>";
    echo "</td>";
    echo "<td>";
		echo "<form action=\"hrtimeattindivinfo.php?loginid=$loginid\" method=\"post\" name=\"modhrtaindivinfo\">";
		// echo "<input type=\"submit\" value=\"Individual info\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\">Individual info</button>";
		echo "</form>";
    echo "</td>";
    echo "<td>";
		echo "<form action=\"hrtimeattincome.php?loginid=$loginid\" method=\"post\" name=\"modhrtaincome\">";
		// echo "<input type=\"submit\" value=\"Add'l income\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\">Add'l income</button>";
		echo "</form>";
    echo "</td>";
  } // if

  if($accesslevel >= 3) {
		// define cutoff button
    echo "<td>";
		echo "<form action=\"hrtimeattcutoff.php?loginid=$loginid\" method=\"post\" name=\"modhrtacutoff\">";
		// echo "<input type=\"submit\" value=\"Cut-off period\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\">Cut-off period</button>";
		echo "</form>";
    echo "</td>";
    echo "<td>";
		echo "<form action=\"hrtimeattcutleave.php?loginid=$loginid\" method=\"post\" name=\"hrtimeattcutleave\">";
		// echo "<input type=\"submit\" value=\"Leave entries\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\">Leave entries</button>";
		echo "</form>";
    echo "</td>";
		// leave entries
    echo "<td>";
		echo "<form action=\"hrtimeatttimelogs.php?loginid=$loginid\" method=\"post\" name=\"modhrtatimelogs\">";
		// echo "<input type=\"submit\" value=\"Time logs\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\">Time logs</button>";
		echo "</form>";
    echo "</td>";
		// cutoff summaries
    echo "<td>";
		echo "<form action=\"hrtimeattsumm.php?loginid=$loginid\" method=\"post\" name=\"modhrtasummary\">";
		// echo "<input type=\"submit\" value=\"Summary\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\">Summary</button>";
		echo "</form>";
    echo "</td>";
  } // if

	echo "</tr>";
	echo "</table>";
  echo "</td></tr>";

// end contents here...

     echo "</table>";

// edit body-footer
     // echo "<p><a href=\"index2.php?loginid=$loginid\">Back</a></p>";
	 echo "<p><button type=\"button\" class=\"btn btn-default\"><a href=\"index2.php?loginid=$loginid\">Back</a></button></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
