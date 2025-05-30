<?php 

require("db1.php");
include("datetimenow.php");
include("clsmcrypt.php");

$loginid = $_GET['loginid'];
$confipaygrpid = $_GET['cpgid'];
$employeeid = $_POST['eid'];
$groupname = $_POST['gn'];

$found = 0;

// echo "<p>vartest cpgid:$confipaygrpid, eid:$employeeid, gn:$groupname</p>";

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
?>
	<script language="JavaScript" src="ts_picker.js"></script>
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
     echo "<p><b>Other Additional Income - Add new info</b></p>";

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

	  echo "For: <b>$employeeid - $name_first $name_middle $name_last</b><br>";
	  echo "<p>";
	}

	include("mcryptenc.php");

// start additional income form

	echo "<FORM METHOD=\"POST\" ACTION=\"confipaynewadd2.php?loginid=$loginid&cpgid=$confipaygrpid\" name=\"frmcfpmnewadd\">";
	echo "<input type=\"hidden\" name=\"eid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"gn\" value=\"$groupname\">";
	echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";

	echo "<tr><td>Name<br><INPUT NAME=nameadd VALUE='EnterTextHere'></td><td>Amount<br><INPUT NAME=addamount VALUE=0  size=\"10\"></td>";

	// modified 20161130 to date_picker
	echo "<td>DateStart<br>";
	/*
	echo "<select name=monthstart>";
	echo "<option value=1>Jan</option>";
	echo "<option value=2>Feb</option>";
	echo "<option value=3>Mar</option>";
	echo "<option value=4>Apr</option>";
	echo "<option value=5>May</option>";
	echo "<option value=6>Jun</option>";
	echo "<option value=7>Jul</option>";
	echo "<option value=8>Aug</option>";
	echo "<option value=9>Sep</option>";
	echo "<option value=10>Oct</option>";
	echo "<option value=11>Nov</option>";
	echo "<option value=12>Dec</option>";
	echo "</select>";
	echo "<select name=daystart>";
	echo "<option value=1>1</option>";
	echo "<option value=2>2</option>";
	echo "<option value=3>3</option>";
	echo "<option value=4>4</option>";
	echo "<option value=5>5</option>";
	echo "<option value=6>6</option>";
	echo "<option value=7>7</option>";
	echo "<option value=8>8</option>";
	echo "<option value=9>9</option>";
	echo "<option value=10>10</option>";
	echo "<option value=11>11</option>";
	echo "<option value=12>12</option>";
	echo "<option value=13>13</option>";
	echo "<option value=14>14</option>";
	echo "<option value=15>15</option>";
	echo "<option value=16>16</option>";
	echo "<option value=17>17</option>";
	echo "<option value=18>18</option>";
	echo "<option value=19>19</option>";
	echo "<option value=20>20</option>";
	echo "<option value=21>21</option>";
	echo "<option value=22>22</option>";
	echo "<option value=23>23</option>";
	echo "<option value=24>24</option>";
	echo "<option value=25>25</option>";
	echo "<option value=26>26</option>";
	echo "<option value=27>27</option>";
	echo "<option value=28>28</option>";
	echo "<option value=29>29</option>";
	echo "<option value=30>30</option>";
	echo "<option value=31>31</option>";
	echo "</select>";
	echo "<input name=yearstart size=4 value=\"$yearnow\">";
	*/
	echo "<input type=\"date\" size=\"8\" name=\"cfpmemaddstart\" value=\"$datenow\">";
	?>
  	<a href="javascript:show_calendar('document.frmcfpmnewadd.cfpmemaddstart', document.frmcfpmnewadd.cfpmemaddstart.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
	<?php
	echo "</td>";

	echo "<td>DateEnd<br>";
	/*
	echo "<select name=monthend>";
	echo "<option value=1>Jan</option>";
	echo "<option value=2>Feb</option>";
	echo "<option value=3>Mar</option>";
	echo "<option value=4>Apr</option>";
	echo "<option value=5>May</option>";
	echo "<option value=6>Jun</option>";
	echo "<option value=7>Jul</option>";
	echo "<option value=8>Aug</option>";
	echo "<option value=9>Sep</option>";
	echo "<option value=10>Oct</option>";
	echo "<option value=11>Nov</option>";
	echo "<option value=12>Dec</option>";
	echo "</select>";
	echo "<select name=dayend>";
	echo "<option value=1>1</option>";
	echo "<option value=2>2</option>";
	echo "<option value=3>3</option>";
	echo "<option value=4>4</option>";
	echo "<option value=5>5</option>";
	echo "<option value=6>6</option>";
	echo "<option value=7>7</option>";
	echo "<option value=8>8</option>";
	echo "<option value=9>9</option>";
	echo "<option value=10>10</option>";
	echo "<option value=11>11</option>";
	echo "<option value=12>12</option>";
	echo "<option value=13>13</option>";
	echo "<option value=14>14</option>";
	echo "<option value=15>15</option>";
	echo "<option value=16>16</option>";
	echo "<option value=17>17</option>";
	echo "<option value=18>18</option>";
	echo "<option value=19>19</option>";
	echo "<option value=20>20</option>";
	echo "<option value=21>21</option>";
	echo "<option value=22>22</option>";
	echo "<option value=23>23</option>";
	echo "<option value=24>24</option>";
	echo "<option value=25>25</option>";
	echo "<option value=26>26</option>";
	echo "<option value=27>27</option>";
	echo "<option value=28>28</option>";
	echo "<option value=29>29</option>";
	echo "<option value=30>30</option>";
	echo "<option value=31>31</option>";
	echo "</select>";
	echo "<input name=yearend size=4 value=\"$yearnow\">";
	*/
	echo "<input type=\"date\" size=\"8\" name=\"cfpmemaddend\" value=\"$datenow\">";
	?>
  	<a href="javascript:show_calendar('document.frmcfpmnewadd.cfpmemaddend', document.frmcfpmnewadd.cfpmemaddend.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
	<?php
	echo "</td></tr>";

	echo "<tr><td><INPUT TYPE=CHECKBOX NAME=nontaxable>NonTaxable</td><td>";
	echo "<INPUT TYPE=CHECKBOX NAME=statusadd CHECKED>Status";
	echo "</td><td>";
	echo "<INPUT TYPE=SUBMIT VALUE=Save></td><td>&nbsp;</td>";
	echo "</tr></table>";
	echo "</FORM>";

     echo "</body></html>";
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
