<?php 

require("db1.php");
include("clsmcrypt.php");

$loginid = $_GET['loginid'];
$confipaygrpid = $_GET['cpgid'];
$employeeid = $_POST['eid'];
$groupname = $_POST['gn'];

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
     echo "<p>Personnel Payroll Details - Add new info</p>";

	// check if accesslevel 5 then decrypt
	include("mcryptdec.php");

// show selected employee

	$result = mysql_query("SELECT name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$employeeid\" AND contact_type=\"personnel\"", $dbh);

	while ($myrow = mysql_fetch_row($result))
	{
	  $found = 1;
	  $name_first = $myrow[0];
	  $name_middle = $myrow[1];
	  $name_last = $myrow[2];

	  echo "For: <b>$employeeid - $name_first $name_middle $name_last</b><br>";
	  echo "<p>";
	}

	// check again if accesslevel 5 then encrypt
	include("mcryptenc.php");

// start main salary form

	echo "<FORM METHOD=\"POST\" ACTION=\"confipaynewmain2.php?loginid=$loginid&cpgid=$confipaygrpid\" name=\"newmain2\" target=\"_self\">";
	echo "<input type=\"hidden\" name=\"eid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"gn\" value=\"$groupname\">";
	echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

	echo "<tr><td>Prof. Fee (1/2 mo.)<br>";
	echo "<INPUT NAME=\"netbasicpay\" VALUE=\"0.00\"></td>";
	echo "<td colspan=2>&nbsp;</td></tr>";

	echo "<tr><td>Project Allow. (1/2 mo.)<br>";
	echo "<input name=\"projallow\" value=\"0.00\"></td>";

	echo "<td>Per diem (1/2 mo.)<br>";
	echo "<input name=\"perdiem\" value=\"0.00\"></td>";

	echo "<td>Transportation Allow. (1/2 mo.)<br>";
	echo "<input name=\"transpoallow\" value=\"0.00\"></td></tr>";

	echo "<tr><td>Withholding Tax<br>";
	echo "<INPUT NAME=\"withholdingtax\" VALUE=\"0.00\"></td>";

	echo "<td>Withholding Tax (option 2)<br>";
	echo "<select name=\"wtaxopt2\">";
	  echo "<option value=\"0\">0%</option>";
	  echo "<option value=\"10\">10%</option>";
	  echo "<option value=\"15\">15%</option>";
	echo "</select></td>";
	echo "<td>&nbsp;</td></tr>";

	echo "<tr><td>SSS EE<br>";
	echo "<INPUT NAME=\"sssee\" VALUE=\"0.00\"></td>";
	echo "<td>SSS ER<br>";
	echo "<INPUT NAME=\"ssser\" VALUE=\"0.00\"></td>";
	echo "<td>SSS EC<br>";
	echo "<INPUT NAME=\"sssec\" VALUE=\"0.00\"></td></tr>";

	echo "<tr><td>Philhealth EE<br>";
	echo "<INPUT NAME=\"philhealthee\" VALUE=\"0.00\"></td>";
	echo "<td>Philhealth ER<br>";
	echo "<INPUT NAME=\"philhealther\" VALUE=\"0.00\"></td>";
	echo "<td>&nbsp;</td></tr>";

	echo "<tr><td>Pagibig EE<br>";
	echo "<INPUT NAME=\"pagibigee\" VALUE=\"0.00\"></td>";
	echo "<td>Pagibig ER<br>";
	echo "<INPUT NAME=\"pagibiger\" VALUE=\"0.00\"></td>";
	echo "<td>&nbsp;</td></tr>";

	echo "<tr><td>";
	echo "<INPUT TYPE=\"CHECKBOX\" NAME=\"empstatus\" CHECKED>Status</td>";
	echo "<td colspan=\"2\" align=\"center\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Save\"></td></tr>";
	echo "</table>";
	echo "</FORM>";

	echo "<p><i>//confipaynewmain.php</i></p>";

     echo "</body></html>";
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
