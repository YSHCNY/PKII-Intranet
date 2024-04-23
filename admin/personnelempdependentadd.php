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

     echo "<p><font size=1>Directory >> Manage Personnel >> Add new dependent</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Add new dependent</b></font></td></tr>";

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

	echo "<tr><td colspan=2>For: $employeeid - <b>$name_last, $name_first $name_middle[0]</b> - $position</td>";

// start add dependent

	echo "<form action=personnelempdependentadd2.php?loginid=$loginid&eid=$employeeid method=post>";

	echo "<tr><td>Name</td><td>";
	echo "<table border=0 spacing=0><tr><td><input name=dependentfirst></td>";
	echo "<td><input name=dependentmiddle></td><td><input name=dependentlast></td></tr>";
	echo "<tr><td><font size=1><i>First*</i></font></td><td><font size=1><i>Middle</i></font></td><td><font size=1><i>Last</i></font></td></tr></table></td></tr>";

	echo "<tr><td>Birthdate</td><td>";
echo "<input name=year size=4 value=1970>";
   
     echo "<select name=month>";
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

     echo "<select name=day>";
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
	echo "</td></tr>";

	echo "<tr><td>Relationship</td><td><input name=dependentrelation></td></tr>";

	echo "<tr><td></td><td><input type=submit value='Add New Dependent'></td></tr>";

     }

     echo "</table>";

// end add dependent

     echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
