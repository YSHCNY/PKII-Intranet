<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$projassignid = $_GET['prjid'];
$proj_code = $_GET['prjcd'];

$new_proj_code = $_POST['proj_code'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit Project Assignment >> Change project code/name</font></p>";

	echo "<p><font color=green><b>Update successful!</b></font></p>";

	$result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
//	  $employeeid = $myrow0[0];
	  $name_last = $myrow0[1];
	  $name_first = $myrow0[2];
	  $name_middle = $myrow0[3];
	}

	$result1 = mysql_query("SELECT proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code = '$new_proj_code'", $dbh);
	while ($myrow1 = mysql_fetch_row($result1))
	{
	  $proj_code1 = $myrow1[0];
	  $proj_fname = $myrow1[1];
	  $proj_sname = $myrow1[2];
	}

	echo "<p>Project code/name changed for: <b>$employeeid - $name_last, $name_first $name_middle[0]</b></p>";

	$result = mysql_query("UPDATE tblprojassign SET proj_code = '$new_proj_code', proj_name = '$proj_sname'
		WHERE employeeid='$employeeid' AND projassignid = $projassignid", $dbh) or die ("Couldn't execute query.".mysql_error());

	echo "proj_code = $proj_code1<br>";
	echo "acronym = $proj_sname<br>";
	echo "proj_name = $proj_fname<br>";
	echo "Update Record - OK<br>";

     echo "<p><a href = personnelprojassignedit.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid>Back to Edit Project Assignment</a><br>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

