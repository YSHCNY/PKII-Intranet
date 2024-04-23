<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Add re-employment details</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Add re-employment details</b></font></td></tr>";

     if ($employeeid == '')
     {
	echo "<tr><td colspan=2><font color=red><b>Sorry. No data available</b></font></td></tr>";
     }
     else
     {

	$result = mysql_query("SELECT name_last, name_first, name_middle, position FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow = mysql_fetch_row($result))
	{
	  $found = 1;
	  $name_last = $myrow[0];
	  $name_first = $myrow[1];
	  $name_middle = $myrow[2];
	  $position = $myrow[3];
	}

	echo "<tr><td colspan=2>For: $employeeid - <b>$name_last, $name_first $name_middle[0]</b> - $position</td></tr>";

// start add new project assignment

	echo "<form action=\"personnelrehireadd2.php?loginid=$loginid&eid=$employeeid\" method=\"post\">";

	include("datetimenow.php");

	echo "<tr><td>Date Re-hired</td><td>";
	echo "<input name=\"fromyear\" size=\"4\" value=\"$yearnow\">";
   
     echo "<select name=\"frommonth\">";
     echo "<option value=\"01\">Jan</option>";
     echo "<option value=\"02\">Feb</option>";
     echo "<option value=\"03\">Mar</option>";
     echo "<option value=\"04\">Apr</option>";
     echo "<option value=\"05\">May</option>";
     echo "<option value=\"06\">Jun</option>";
     echo "<option value=\"07\">Jul</option>";
     echo "<option value=\"08\">Aug</option>";
     echo "<option value=\"09\">Sep</option>";
     echo "<option value=\"10\">Oct</option>";
     echo "<option value=\"11\">Nov</option>";
     echo "<option value=\"12\">Dec</option>";
     echo "</select>";

     echo "<select name=\"fromday\">";
     echo "<option value=\"01\">01</option>";
     echo "<option value=\"02\">02</option>";
     echo "<option value=\"03\">03</option>";
     echo "<option value=\"04\">04</option>";
     echo "<option value=\"05\">05</option>";
     echo "<option value=\"06\">06</option>";
     echo "<option value=\"07\">07</option>";
     echo "<option value=\"08\">08</option>";
     echo "<option value=\"09\">09</option>";
     echo "<option value=\"10\">10</option>";
     echo "<option value=\"11\">11</option>";
     echo "<option value=\"12\">12</option>";
     echo "<option value=\"13\">13</option>";
     echo "<option value=\"14\">14</option>";
     echo "<option value=\"15\">15</option>";
     echo "<option value=\"16\">16</option>";
     echo "<option value=\"17\">17</option>";
     echo "<option value=\"18\">18</option>";
     echo "<option value=\"19\">19</option>";
     echo "<option value=\"20\">20</option>";
     echo "<option value=\"21\">21</option>";
     echo "<option value=\"22\">22</option>";
     echo "<option value=\"23\">23</option>";
     echo "<option value=\"24\">24</option>";
     echo "<option value=\"25\">25</option>";
     echo "<option value=\"26\">26</option>";
     echo "<option value=\"27\">27</option>";
     echo "<option value=\"28\">28</option>";
     echo "<option value=\"29\">29</option>";
     echo "<option value=\"30\">30</option>";
     echo "<option value=\"31\">31</option>";
     echo "</select>";
	echo "</td></tr>";

	echo "<tr><td>Date Resigned</td><td>";
	echo "<input name=\"toyear\" size=\"4\" value=\"0000\">";
   
     echo "<select name=\"tomonth\">";
     echo "<option value=\"00\">Month</option>";
     echo "<option value=\"01\">Jan</option>";
     echo "<option value=\"02\">Feb</option>";
     echo "<option value=\"03\">Mar</option>";
     echo "<option value=\"04\">Apr</option>";
     echo "<option value=\"05\">May</option>";
     echo "<option value=\"06\">Jun</option>";
     echo "<option value=\"07\">Jul</option>";
     echo "<option value=\"08\">Aug</option>";
     echo "<option value=\"09\">Sep</option>";
     echo "<option value=\"10\">Oct</option>";
     echo "<option value=\"11\">Nov</option>";
     echo "<option value=\"12\">Dec</option>";
     echo "</select>";

     echo "<select name=\"today\">";
     echo "<option value=\"00\">Day</option>";
     echo "<option value=\"01\">01</option>";
     echo "<option value=\"02\">02</option>";
     echo "<option value=\"03\">03</option>";
     echo "<option value=\"04\">04</option>";
     echo "<option value=\"05\">05</option>";
     echo "<option value=\"06\">06</option>";
     echo "<option value=\"07\">07</option>";
     echo "<option value=\"08\">08</option>";
     echo "<option value=\"09\">09</option>";
     echo "<option value=\"10\">10</option>";
     echo "<option value=\"11\">11</option>";
     echo "<option value=\"12\">12</option>";
     echo "<option value=\"13\">13</option>";
     echo "<option value=\"14\">14</option>";
     echo "<option value=\"15\">15</option>";
     echo "<option value=\"16\">16</option>";
     echo "<option value=\"17\">17</option>";
     echo "<option value=\"18\">18</option>";
     echo "<option value=\"19\">19</option>";
     echo "<option value=\"20\">20</option>";
     echo "<option value=\"21\">21</option>";
     echo "<option value=\"22\">22</option>";
     echo "<option value=\"23\">23</option>";
     echo "<option value=\"24\">24</option>";
     echo "<option value=\"25\">25</option>";
     echo "<option value=\"26\">26</option>";
     echo "<option value=\"27\">27</option>";
     echo "<option value=\"28\">28</option>";
     echo "<option value=\"29\">29</option>";
     echo "<option value=\"30\">30</option>";
     echo "<option value=\"31\">31</option>";
     echo "</select>";
	echo "</td></tr>";

	echo "<tr><td>Remarks</td><td><textarea rows=\"3\" cols=\"30\" name=\"remarks\"></textarea></td></tr>";

	echo "<tr><td>&nbsp;</td><td><input type=\"submit\" value=\"Submit\"></td></tr>";
     }

	echo "</table>";

// end add new project assignment
 
     echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
