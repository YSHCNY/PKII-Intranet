<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$pid = $_GET['pid'];
$term_resign = $_GET['term_resign'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");
?>
<script language="JavaScript" src="ts_picker.js"></script>
<?php
     echo "<p><font size=1>Directory >> Manage Personnel >> Change Date Resigned</font></p>";

     echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Change Date Resigned</b></font></td></tr>";

     if ($pid == '')
     {
	echo "<tr><td colspan=2><font color=red><b>Sorry. No data available</b></font></td></tr>";
     }
     else
     {

	$result = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$pid'", $dbh);
	while ($myrow = mysql_fetch_row($result))
	{
	  $employeeid = $myrow[0];
	  $name_last = $myrow[1];
	  $name_first = $myrow[2];
	  $name_middle = $myrow[3];
	}

	echo "<tr><td colspan=2>For: <b>$employeeid - $name_last, $name_first $name_middle[0].</b></td></tr>";

	// echo "<tr><td>Date Resigned</td><td align=center>$emp_birthdate<br><font size=2><i>yyyy-mm-dd</i></font></td></tr>";
	echo "<tr><th align=\"right\">Resigned date</th><td>";

	echo "<form action=\"personnelchgempterm_resign2.php?loginid=$loginid&pid=$pid\" method=\"POST\" name=\"empchgdateresign\">";

		/*
	echo "<input name=year size=4 value=0000>";
     echo "<select name=month>";
     echo "<option value=0>00</option>";
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
     echo "<option value=0>0</option";
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
		*/
		echo "<input type=\"date\" name=\"termresign\" value=\"$term_resign\">";
		?>
		<a href="javascript:show_calendar('document.empchgdateresign.termresign', document.empchgdateresign.termresign.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
		<?php
		echo "</td></tr>";
     echo "<tr><td colspan=\"2\" align=\"center\"><input type=submit value=\"Update\"></td></tr>";
     echo "</form>";

     echo "<tr><td colspan=2><i>Note: If personnel is on active status,<br>please change date to '0000-00-00'<br>Thank you.</i></td></tr>";
     }

     echo "</table>";
 
     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     // echo "<p><a href = personneledit2.php?pid=$pid&loginid=$loginid>Back</a><br>";

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 