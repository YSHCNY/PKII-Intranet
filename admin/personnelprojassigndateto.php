<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$projassignid = $_GET['prjid'];
$term_resign = $_GET['trmresig'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit Project Assignment >> Change term_resign date</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Change Term_Resign Date</b></font></td></tr>";

     if ($employeeid == '')
     {
	echo "<tr><td colspan=2><font color=red><b>Sorry. No data available</b></font></td></tr>";
     }
     else
     {

	$result = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow = mysql_fetch_row($result))
	{
//	  $employeeid = $myrow[0];
	  $name_last = $myrow[1];
	  $name_first = $myrow[2];
	  $name_middle = $myrow[3];
	}

	echo "<tr><td colspan=2>For: <b>$employeeid - $name_last, $name_first $name_middle[0].</b></td></tr>";

	echo "<tr><td>Current Date (To)</td><td align=center>$durationto<br><font size=1><i>YYYY-MM-DD</i></font></td></tr>";
	echo "<tr><td>New Date (To)</td><td>";

	echo "<form action=personnelprojassigndateto2.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid method=POST>";

	echo "<input name=year size=4 value=2010>";
   
     echo "<select name=month>";
     echo "<option value=00>Month</option>";
     echo "<option value=01>Jan</option>";
     echo "<option value=02>Feb</option>";
     echo "<option value=03>Mar</option>";
     echo "<option value=04>Apr</option>";
     echo "<option value=05>May</option>";
     echo "<option value=06>Jun</option>";
     echo "<option value=07>Jul</option>";
     echo "<option value=08>Aug</option>";
     echo "<option value=09>Sep</option>";
     echo "<option value=10>Oct</option>";
     echo "<option value=11>Nov</option>";
     echo "<option value=12>Dec</option>";
     echo "</select>";

     echo "<select name=day>";
     echo "<option value=00>Day</option>";
     echo "<option value=01>01</option>";
     echo "<option value=02>02</option>";
     echo "<option value=03>03</option>";
     echo "<option value=04>04</option>";
     echo "<option value=05>05</option>";
     echo "<option value=06>06</option>";
     echo "<option value=07>07</option>";
     echo "<option value=08>08</option>";
     echo "<option value=09>09</option>";
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

     echo "</select></td>";
     echo "<tr><td></td><td><input type=submit value='Update'></td></tr>";
     echo "</form>";

     }

     echo "</table>";
 
     echo "<p><a href = personnelprojassignedit.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid>Back</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
