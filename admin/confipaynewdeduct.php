<?php 

require("db1.php");
include("datetimenow.php");
include("clsmcrypt.php");
// $dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
// mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = $_GET['loginid'];
$confipaygrpid = $_GET['cpgid'];
$employeeid = $_POST['eid'];
$groupname = $_POST['gn'];

// echo "<p>vartest cpgid:$confipaygrpid, eid:$employeeid, gn:$groupname</p>";

$found = 0;

if($loginid != "")
{
	include("logincheck.php");
}

if ($found == 1)
{
?>
	<html><head><STYLE TYPE="text/css">
	<!--
		Table {
			background:#D3E4E5;
			border:1px solid gray;
			border-collapse:collapse;
			font:normal 12px verdana, arial, helvetica, sans-serif;
		}
		TH {
			font-family: Helvetica; font-size: 10pt; font-weight: bold;
		}
	  TD {
	    font-family: Helvetica; font-size: 10pt
	  }
	  body {
	    font-family: Helvetica; font-size: 10pt
	  }
	  h1 {
	    font-size: 120%
	  }
	  h2 {
	    font-size: 100%
	  }
	  a {
	    text-decoration: none
	  }
	  p {
	    font-family: Helvetica; font-size: 10pt
	  }
	--->
	</STYLE></head>
	<body>
<?php
     echo "<p>Other Deductions - Add new info</p>";

// show selected employee

		include("mcryptdec.php");
	$result = mysql_query("SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$employeeid\" AND contact_type=\"personnel\"", $dbh);
	while ($myrow = mysql_fetch_row($result))
	{
	  $found = 1;
	  $employeeid = $myrow[0];
	  $name_first = $myrow[1];
	  $name_middle = $myrow[2];
	  $name_last = $myrow[3];
	  echo "<p>For: <b>$employeeid - $name_first $name_middle $name_last</b></p>";
	}
		include("mcryptenc.php");

// start other deductions form

	echo "<FORM METHOD=\"POST\" ACTION=\"confipaynewdeduct2.php?loginid=$loginid&cpgid=$confipaygrpid\" name=\"cfpdeduct2\">";
	echo "<input type=\"hidden\" name=\"eid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"gn\" value=\"$groupname\">";
	echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";

	echo "<tr><td>Name<br><INPUT NAME=\"namededuct\" VALUE=\"EnterTextHere\"></td><td>Amount<br><INPUT NAME=\"deductamount\" VALUE=\"0\" size=\"10\"></td><td>Total<br><INPUT NAME=\"deducttotalamount\" VALUE=\"0\" size=\"10\"></td><td>Balance<br><INPUT NAME=\"deductbalamount\" VALUE=\"0\" size=\"10\"></td></tr>";

	echo "<tr><td>";
	echo "<INPUT TYPE=CHECKBOX NAME=\"statusdeduct\" CHECKED>Status";
	echo "</td><td>";
	echo "<INPUT TYPE=\"SUBMIT\" VALUE=\"Save\"></td><td>&nbsp;</td><td>&nbsp;</td>";
	echo "</tr></table>";
	echo "</FORM>";

     echo "</body></html>";
}
else
{
     echo "<html>";
     
     echo "You are not logged in<br>";
     echo "<a href=login.htm>Login</a><br>";

     echo "</html>";
}

mysql_close($dbh);
?> 
