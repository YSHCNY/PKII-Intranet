<html>
<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$proj_num = $_POST['proj_num'];
$proj_code = $_POST['proj_code'];
$proj_fname = $_POST['proj_fname'];
$proj_sname = $_POST['proj_sname'];
$proj_period = $_POST['proj_period'];
$proj_desc = $_POST['proj_desc'];
$proj_services = $_POST['proj_services'];
$proj_duty = $_POST['proj_duty'];
$date_start0 = $_POST['date_start0'];
$date_end0 = $_POST['date_end0'];
$date_start = $_POST['year_start'] . "-" . $_POST['month_start'] . "-" . $_POST['day_start'];
$date_end = $_POST['year_end'] . "-" . $_POST['month_end'] . "-" . $_POST['day_end'];
$projstatus = $_POST['projstatus'];
$proj_remarks = $_POST['proj_remarks'];
$companyid = $_POST['companyid'];
$contactid = $_POST['contactid'];
$employeeid = $_POST['employeeid'];

$found = 0;
$found2 = 0;

if($loginid != "")
{
     $result = mysql_query("SELECT * FROM tbladminlogin WHERE adminloginid=$loginid AND adminloginstat=1", $dbh); 

     while ($myrow = mysql_fetch_row($result))
     {
          $found = 1;
          
          $loginid = $myrow[0];
          $username = $myrow[1];
          $loginstatus = $myrow[5];
          $level = $myrow[6];
     }
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

  $result = mysql_query("SELECT * FROM tblproject1 WHERE proj_code='$proj_code' OR proj_sname='$proj_sname'", $dbh);
  echo "Your inputs: ";
  echo "$proj_code $proj_sname<br>";

  while ($myrow = mysql_fetch_row($result))
  {    
     $found2 = 1;

     $proj_code2 = $myrow[1];
     $proj_sname2 = $myrow[3];
  }
  echo "Query result: ";
  echo "$proj_code2 $proj_sname2<br>";

  if ($found2 == 1)
  {
     echo "<p><b><font color=red>Record already exists</font></p>";

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminloginid=$loginid", $dbh); 

     echo "<p><a href=addproject.php?loginid=$loginid>Back</a></p>";

  }
  else
  {

  $result = mysql_query("INSERT INTO tblproject1 (proj_num, proj_code, proj_fname, proj_sname, proj_desc, proj_services, proj_duty, proj_period, date_start, date_end, companyid, projstatus, proj_remarks, contactid, employeeid) VALUES ('$proj_num', '$proj_code', '$proj_fname', '$proj_sname', '$proj_desc', '$proj_services', '$proj_duty', '$proj_period', '$date_start', '$date_end', '$companyid', '$projstatus', '$proj_remarks', '$contactid', '$employeeid')", $dbh);

  echo "Data inserted:<br>";
  echo "$proj_num<br>";
  echo "$proj_code<br>";
  echo "$proj_fname<br>";
  echo "$proj_sname<br>";
  echo "$proj_desc<br>";
  echo "$proj_services<br>";
  echo "$proj_duty<br>";
  echo "$proj_period<br>";
  echo "$date_start<br>";
  echo "$date_end<br>";
  echo "$companyid<br>";
  echo "$projstatus<br>";
  echo "$proj_remarks<br>";
  echo "$contactid<br>";
  echo "$employeeid<br>";
  echo "Add Record - OK<br>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

  echo "<p><a href=project2.php?loginid=$loginid>Back to Menu</a></p>";
  }

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

</html>
