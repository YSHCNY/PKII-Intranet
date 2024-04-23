<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$tmpemployeeid = $_GET['eid'];
$tmpname_last = $_GET['nl'];
$tmpname_first = $_GET['nf'];
$tmpname_middle = $_GET['nm'];
$tmpemployee_type = $_GET['pt'];

$postemployeeid = $_POST['employeeid'];
$postname_last = $_POST['name_last'];
$postname_first = $_POST['name_first'];
$postname_middle = $_POST['name_middle'];
$postpersonnel_type = $_POST['personnel_type'];

if($postemployeeid!='') {
	$tmpemployeeid = $postemployeeid;
	$tmpname_last = $postname_last;
	$tmpname_first = $postname_first;
	$tmpname_middle = $postname_middle;
	$tmpemployee_type = $postpersonnel_type;
}

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Add new personnel</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Add new personnel</b></font></td></tr>";

// start initial personnel details form

	echo "<form action=personneladd2.php?loginid=$loginid method=post>";

	echo "<tr><td>Employee No.</td><td><input name=employeeid value=$tmpemployeeid></td></tr>";

	echo "<tr><td>Employee Name</td>";
	echo "<td><table border=0 spacing=1><tr><td><input name=\"name_last\" value=\"$tmpname_last\"></td><td><input name=\"name_first\" value=\"$tmpname_first\"></td><td><input name=\"name_middle\" value=\"$tmpname_middle\"></td></tr>";
	echo "<tr><td><font size=1>LastName</font></td><td><font size=1>FirstName</font></td><td><font size=1>MiddleName</font></td></tr></table></td></tr>";

	if ($tmpemployee_type == 'employee')
	{
	  $employeeselected = 'selected';
	}
	else if ($tmpemployee_type == 'consultant')
	{
	  $consultantselected = 'selected';
	}
	else if ($tmpemployee_type == 'others')
	{
	  $othersselected = 'selected';
	}
	else
	{
	  $select = 'selected';
	}

	echo "<tr><td>Personnel Type</td><td><select name=personnel_type>";
	echo "<option value=select $select>Select</option>";
	echo "<option value=employee $employeeselected>Employee</option>";
	echo "<option value=consultant $consultantselected>Consultant</option>";
	echo "</select></td></tr>";

	echo "<tr><td></td><td><input type=submit value='Submit'></td></tr>";
	echo "</table></form>";

// end initial personnel details form

     echo "<p><a href=personneledit.php?loginid=$loginid>Back</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
