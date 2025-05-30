<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];

$found = 0;
$found0 = 0;
$found1 = 0;
$found2 = 0;
$found3 = 0;
$found4 = 0;
$found5 = 0;
$found6 = 0;
$found7 = 0;
$found8 = 0;
$found9 = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit Personnel Info >> Delete Record</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue><font color=white><b>Delete Personnel Record Successful!</b></font></td></tr>";
     echo "<tr><td>";

  $result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
  while ($myrow0 = mysql_fetch_row($result0))
  {
	$found0 = 1;
//	$employeeid = $myrow0[0];
	$name_last = $myrow0[1];
	$name_first = $myrow0[2];
	$name_middle = $myrow0[3];
  }

  if ($found0 == 1)
  {

// start del record from tblcontact
	$result01 = mysql_query("DELETE FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	echo "employeeid: $employeeid from maindb.tblcontact deleted.<br>";
// end del record from tblcontact


// start del record from tblemployee
	$result1 = mysql_query("SELECT employeeid FROM tblemployee WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $employeeid_tblemployee = $myrow1[0];
	}
	if ($found1 == 1)
	{
	  $result11 = mysql_query("DELETE FROM tblemployee WHERE employeeid = '$employeeid'", $dbh);
	  echo "employeeid:$employeeid = $employeeid_tblemployee from maindb.tblempployee deleted.<br>";
	}
	else
	{
	  echo "<font color=red>no record for $employeeid - $name_last, $name_first on maindb.tblempployee</font><br>";
	}



// end del record from tblemployee

// start del record from tblempdetails
	$result8 = mysql_query("SELECT empdetailsid, employeeid, empposition FROM tblempdetails WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow8 = mysql_fetch_row($result8))
	{
	  $found8 = 1;
	  $empdetailsid = $myrow8[0];
	  $employeeid_tblemployee = $myrow8[1];
	  $empposition = $myrow8[2];
	}
	if ($found8 == 1)
	{
	  $result81 = mysql_query("DELETE FROM tblempdetails WHERE empdetailsid = $empdetailsid AND employeeid = '$employeeid'", $dbh);
	  echo "employeeid:$employeeid = $employeeid_tblemployee $empposition from maindb.tblempployee deleted.<br>";
	}
	else
	{
	  echo "<font color=red>no record for $employeeid - $name_last, $name_first on maindb.tblempployee</font><br>";
	}

  $adminlogdetails = "$loginid:$adminloginuid - Deleted Details:$employeeid - $name_last, $name_first, $empposition.";
  
// end del record from tblempdetails

// start del record from tblempsalary
	$result9 = mysql_query("SELECT empsalaryid, employeeid FROM tblempsalary WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow9 = mysql_fetch_row($result9))
	{
	  $found9 = 1;
	  $empsalaryid = $myrow9[0];
	  $employeeid_tblempsalary = $myrow9[1];
	}
	if ($found9 == 1)
	{
	  $result91 = mysql_query("DELETE FROM tblempsalary WHERE empsalaryid = $empsalaryid AND employeeid = '$employeeid'", $dbh);
	  echo "empsalaryid:$empsalaryid for $employeeid = $employeeid_tblempsalary from maindb.tblempsalary deleted.<br>";
	}
	else
	{
	  echo "<font color=red>no record for $employeeid - $name_last, $name_first on maindb.tblempsalary</font><br>";
	}
// end del record from tblsalary

// start del record from tblprojassign
	$result2 = mysql_query("SELECT projassignid, employeeid, proj_name FROM tblprojassign WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $found2 = 1;
	  $projassignid = $myrow2[0];
	  $employeeid_tblprojassign = $myrow2[1];
	  $proj_name = $myrow2[2];

	  if ($found2 == 1)
	  {
		$result21 = mysql_query("DELETE FROM tblprojassign WHERE employeeid = '$employeeid' AND projassignid = $projassignid", $dbh);
		echo "projassignid:$projassignid of $employeeid = $employeeid_tblprojassign $proj_name from maindb.tblprojassign deleted.<br>";
	  }
	  else
	  {
		echo "<font color=red>no record for $employeeid - $name_last, $name_first on maindb.tblprojassign<br>";
	  }
	}
// end del record from tblprojassign

// start del record from tblbankacct
	$result3 = mysql_query("SELECT bankacctid, employeeid, bank_name, acct_num FROM tblbankacct WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow3 = mysql_fetch_row($result3))
	{
	  $found3 = 1;
	  $bankacctid = $myrow3[0];
	  $employeeid_tblbankacct = $myrow3[1];
	  $bank_name = $myrow3[2];
	  $acct_num = $myrow3[3];

	  if ($found3 == 1)
	  {
		$result31 = mysql_query("DELETE FROM tblbankacct WHERE employeeid = '$employeeid' AND bankacctid = $bankacctid", $dbh);
		echo "bankacctid:$bankacctid of $employeeid = $employeeid_tblbankacct $bank_name $acct_num from maindb.tblbankacct deleted.<br>";
	  }
	  else
	  {
		echo "<font color=red>no record for $employeeid - $name_last, $name_first on maindb.tblbankacct<br>";
	  }
	}
// end del record from tblbankacct

// start del record from tblempeducation
	$result4 = mysql_query("SELECT empeducationid, employeeid, coursegraduated, schoolgraduated FROM tblempeducation WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow4 = mysql_fetch_row($result4))
	{
	  $found4 = 1;
	  $empeducationid = $myrow4[0];
	  $employeeid_tblempeducation = $myrow4[1];
	  $coursegraduated = $myrow4[2];
	  $schoolgraduated = $myrow4[3];

	  if ($found4 == 1)
	  {
		$result41 = mysql_query("DELETE FROM tblempeducation WHERE employeeid = '$employeeid' AND empeducationid = $empeducationid", $dbh);
		echo "empeducationid:$empeducationid of $employeeid = $employeeid_tblempeducation $schoolgraduated $coursegraduated from maindb.tblempeducation deleted.<br>";
	  }
	  else
	  {
		echo "<font color=red>no record for $employeeid - $name_last, $name_first on maindb.tblempeducation<br>";
	  }
	}
// end del record from tblempeducation

// start del record from tblempspouse
	$result5 = mysql_query("SELECT empspouseid, employeeid, empspousefirst FROM tblempspouse WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow5 = mysql_fetch_row($result5))
	{
	  $found5 = 1;
	  $empspouseid = $myrow5[0];
	  $employeeid_tblempspouse = $myrow5[1];
	  $empspousefirst = $myrow5[2];
	}
	if ($found5 == 1)
	{
	  $result51 = mysql_query("DELETE FROM tblempspouse WHERE employeeid = '$employeeid' AND empspouseid = $empspouseid", $dbh);
	  echo "empspouseid:$empspouseid for $employeeid = $employeeid_tblemployee $empspousefirst from maindb.tblempspouse deleted.<br>";
	}
	else
	{
	  echo "<font color=red>no record for $employeeid - $name_last, $name_first on maindb.tblempspouse</font><br>";
	}
// end del record from tblempspouse

// start del record from tblempdependent
	$result6 = mysql_query("SELECT * FROM tblempdependent WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow6 = mysql_fetch_row($result6))
	{
	  $found6 = 1;
	  $empdependentid = $myrow6[0];
//	  $employeeid = $myrow6[1];
	  $empdependentctr = $myrow6[2];
	  $dependentlast = $myrow6[3];
	  $dependentfirst = $myrow6[4];
	  $dependentmiddle = $myrow6[5];
	  $dependentbirthdate = $myrow6[6];
	  $dependentrelation = $myrow6[7];

	  if ($found6 == 1)
	  {
		$result61 = mysql_query("DELETE FROM tblempdependent WHERE employeeid = '$employeeid' AND empdependentid = $empdependentid", $dbh);
		echo "employeeid:$employeeid - $empdependentid $dependentfirst from maindb.tblempdependent deleted.<br>";
	  }
	  else
	  {
		echo "<font color=red>no record for $employeeid - $name_last, $name_first on maindb.tblempdependent<br>";
	  }
	}
// end del record from tblempdependent

// start del record from tblempemergency
	$result7 = mysql_query("SELECT contactid, emergempid, name_first FROM tblcontact WHERE emergempid = '$employeeid'", $dbh);
	while ($myrow7 = mysql_fetch_row($result7))
	{
	  $found7 = 1;
	  $contactid = $myrow7[0];
	  $emergempid = $myrow7[1];
	  $name_first = $myrow7[2];
	}
	if ($found7 == 1)
	{
	  $result71 = mysql_query("DELETE FROM tblcontact WHERE tblcontact = $contactid AND emergempid = $employeeid", $dbh);
	  echo "emergency contactid:$contactid for $employeeid = $emergempid $name_first from maindb.tblcontact deleted.<br>";
	}
	else
	{
	  echo "<font color=red>no record for $employeeid - $name_last, $name_first on maindb.tblcontact for emergency</font><br>";
	}
// end del record from tblempemergency

// start del record from tblprojassign0

// end del record from tblprojassign0

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Deleted record details of:$employeeid - $name_last, $name_first $name_middle[0].";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);


	echo "Database record for: <b>$employeeid - $name_last, $name_first $name_middle[0] cleared.</b>";
	echo "</td></tr></table>";
  }
  else
  {
	echo "<p><font color=red><b>sorry. no such record on maindb.tblcontact.</b></font></p>";
  }

	echo "<p><a href=personneledit.php?loginid=$loginid>Back to Manage Personnel</a></p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

