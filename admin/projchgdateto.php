<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$pid = $_GET['pid'];
$date_end = $_GET['pdto'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Manage >> Projects >> Change date end</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Change Project's date end</b></font></td></tr>";

     if ($pid == '')
     {
	echo "<tr><td colspan=2><font color=red><b>Sorry. No data available</b></font></td></tr>";
     }
     else
     {

	$result1 = mysql_query("SELECT projectid, proj_sname, date_start, date_end FROM tblproject1 WHERE projectid='$pid'", $dbh);
	while ($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
//	  $pid = $myrow1[0];
	  $proj_sname = $myrow1[1];
	  $date_start = $myrow1[2];
	  $date_end = $myrow1[3];
	}

	echo "<tr><td colspan=2>For project: <b>$proj_sname</b></br>";

	echo "<tr><td>Current end date</td><td align=center>$date_end<br><font size=1><i>YYYY-MM-DD</i></font></td></tr>";
	echo "<tr><td>New end date</td><td>";

	echo "<form action=projchgdateto2.php?loginid=$loginid&pid=$pid method=POST>";

	echo "<input name=year size=4 value=2010>";
   
     echo "<select name=\"month\">";
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

     echo "<select name=\"day\">";
     echo "<option value=\"00\">Day</option>";
     echo "<option value=\"01\">1</option>";
     echo "<option value=\"02\">2</option>";
     echo "<option value=\"03\">3</option>";
     echo "<option value=\"04\">4</option>";
     echo "<option value=\"05\">5</option>";
     echo "<option value=\"06\">6</option>";
     echo "<option value=\"07\">7</option>";
     echo "<option value=\"08\">8</option>";
     echo "<option value=\"09\">9</option>";
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

     echo "</select></td></tr>";
     echo "<tr><td></td><td><input type=\"submit\" value=\"Update\"></td></tr>";
     echo "</form>";

     }

     echo "</table>";

     echo "<p><a href = editproj.php?loginid=$loginid&pid=$pid>Back</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 