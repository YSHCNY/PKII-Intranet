<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];

$cutoffdate = $year . "-" . $month . "-" . $day;

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Modules >> Project Assignments >> List of Expiring Contracts</font></p>";

echo "<table border=0 spacing=0 cellspacing=0 cellpadding=0><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=13><font color=white><b>List of Expiring Contracts</b></font></td></tr>";

// start contents here...

     echo "<tr><td colspan=13>";
     echo "<table border=0 spacing=0><tr>";
     echo "<form action=projassignexpiring.php?loginid=$loginid method=POST>";

     echo "<tr><td>Assign cutoff date</td>";
   
     echo "<td><input name=year size=4 value=2010></td>";

     echo "<td><select name=month>";
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
     echo "</select></td>";

     echo "<td><select name=day>";
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
     echo "</select></td></tr>";

     echo "<tr><td>&nbsp;</td><td colspan=3 align=center><input type=submit value='Generate'>";
     echo "</form></td></tr></table>";

     echo "</td></tr>";

     echo "<tr><td>";

	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblprojassign.remarks, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE tblprojassign.durationto <= \"$cutoffdate\" AND tblprojassign.remarks = '' ORDER BY tblprojassign.durationto DESC", $dbh);

	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Remarks</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid = $myrow1[2];
	  $proj_code = $myrow1[3];
	  $proj_name = $myrow1[4];
	  $position = $myrow1[5];
	  $durationfrom = $myrow1[6];
	  $durationto = $myrow1[7];
	  $term_resign = $myrow1[8];
	  $remarks = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td><td>$proj_code</td><td>$proj_name</td><td>$position</td><td>$durationfrom</td><td>$durationto</td><td><input size=30 name=remarks value=\"$remarks\"></td>";
	echo "<form action=projassignindupda.php?loginid=$loginid&pr0id=$projassignid&eid=$employeeid12 method=post><td><input type=submit value=\"Update\"></td></form></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.remarks, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE tblprojassign0.durationto <> '0000-00-00' AND tblprojassign0.durationto <= \"$cutoffdate\" AND tblprojassign0.remarks = '' ORDER BY tblprojassign0.durationto DESC", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $proj_code12 = $myrow12[3];
	  $proj_name12 = $myrow12[4];
	  $position12 = $myrow12[5];
	  $durationfrom12 = $myrow12[6];
	  $durationto12 = $myrow12[7];
	  $term_resign12 = $myrow12[8];
	  $remarks12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td><td>$proj_code12</td><td>$proj_name12</td><td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><input size=30 name=remarks12 value=\"$remarks12\"></td>";
	echo "<form action=projassignindupdb.php?loginid=$loginid&pr0id=$projectassign0id&eid=$employeeid12 method=post><td><input type=submit value=\"Update\"></td></form></tr>";
	}

     echo "<tr><td colspan=13>";
     echo "<table border=0 spacing=0><tr>";
     echo "<form action=projassignexp.php?loginid=$loginid method=post><td align=center><input type=submit value=\"Save Results\"></td></form>";
     echo "<form action=projassignemail.php?loginid=$loginid method=post><td align=center><input type=submit value=\"Send Email\"</td></form>";
     echo "</tr></table>";
     echo "</td></tr>";

     echo "</td></tr>";

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=admlogin.php?loginid=$loginid>Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
