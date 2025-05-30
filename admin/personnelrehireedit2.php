<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$emprehiredid14 = $_GET['rhid'];

$daterehired = $_POST['daterehire'];
$dateresigned = $_POST['dateresigned'];
/*
$daterehired = $_POST['fromyear'] . '-' . $_POST['frommonth'] . '-' . $_POST['fromday'];
$dateresigned = $_POST['toyear'] . '-' . $_POST['tomonth'] . '-' . $_POST['today'];
*/
$remarks = $_POST['remarks'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

//     echo "<p><font size=1>Directory >> Manage Personnel >> Edit re-employment details</font></p>";

//  if ($durationfrom >= $durationto)
//  {
//    echo "<p><font color=red><b>Sorry Invalid Date</b></font></p>";
//    echo "<p>Date duration field 'From' should be earlier than or not equal to the date field 'To'</p>";
//    echo "<p><a href=personnelprojassignadd.php?loginid=$loginid&eid=$employeeid>Back</a></p>";
//  }
//  else
//  {

//	echo "<p><font color=green><b>Edit re-employment details successful!</b></font></p>";

	$result0 = mysql_query("SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
	  $name_last = $myrow0[0];
	  $name_first = $myrow0[1];
	  $name_middle = $myrow0[2];
	}

//	echo "<p>For: <b>$employeeid - $name_last, $name_first $name_middle[0]</b><br>";
//	echo "Re-employment details: $daterehired -to- $dateresigned<br>";

	$result = mysql_query("UPDATE tblemprehire SET daterehired=\"$daterehired\", dateresigned=\"$dateresigned\", remarks=\"$remarks\" WHERE employeeid=\"$employeeid\" AND emprehireid=$emprehiredid14", $dbh) or die ("Couldn't execute query.".mysql_error());

//	echo "empid = $employeeid<br>";
//	echo "daterehired = $daterehired<br>";
//	echo "dateresigned = $dateresigned<br>";
//	echo "remarks = $remarks<br>";
//	echo "Update Record - OK<br>";

//     echo "<p><a href = personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel Info</a><br>";

//  }

		// create log
  	$result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
		while($myrow16 = mysql_fetch_row($result16))
		{ $adminuid=$myrow16[0]; }
		$adminlogdetails = "$loginid:$adminuid - change date re-hire and resigned date $daterehired-to-$dateresigned for employee: $employeeid - $name_last, $name_first $name_middle";
		$result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

	// redirect
	header("Location: personneledit2.php?loginid=$loginid&pid=$employeeid");
	exit;

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

//     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

