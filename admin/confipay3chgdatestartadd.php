<?php 

require("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$groupname = $_GET['gn'];
$confipayaddid = $_GET['addid'];
$startadd = $_GET['startadd'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     echo "<html>";
     echo "<h2>Change Start Date of Additional Income</h2>";

     echo "<p><a href = confipay3.php?eid=$employeeid&loginid=$loginid>Back</a><br>";

     if ($employeeid == '')
     {
	echo "<p><font color=red><b>Sorry. No data available</b></font></p>";
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

	echo "<p>For: <b>$employeeid - $name_last, $name_first $name_middle[0].</b><br>";

	$result1 = mysql_query("SELECT tblconfipaymemadd.confipayaddid, tblconfipaymemadd.employeeid, tblconfipaymemadd.nameadd, tblconfipaymemadd.startadd FROM tblconfipaymemadd WHERE tblconfipaymemadd.employeeid='$employeeid'", $dbh);

	while ($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $confipayaddid = $myrow1[0];
//          $employeeid = $myrow1[1];
	  $nameadd = $myrow1[2];
	  $startadd = $myrow1[3];
	}

	echo "Add'l. Income Name: <b>$nameadd</b></p>";

	echo "<table border=1 spacing=0><tr><td>Start Date</td><td align=center>$startadd<br><font size=1><i>yyyy-mm-dd</i></font></td></tr>";
	echo "<tr><td>New Date</td><td>";

	echo "<form action=\"confipay3chgdatestartadd2.php?loginid=$loginid&pid=$employeeid&addid=$confipayaddid&gn=$groupname\" method=\"POST\">";

	echo "<input name=year size=4 value=2010>";
   
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
     echo "<tr><td>&nbsp</td><td><input type=submit value='Update'></td></tr>";
     echo "</form></table>";

     }
 
     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     echo "<p>";
     echo "<p><a href=\"confipay3.php?eid=$employeeid&loginid=$loginid&gn=$groupname\">Back</a><br>";

     echo "</html>";
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
