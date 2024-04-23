<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = $_GET['loginid'];
$employeetype = $_POST['employeetype'];

$found = 0;

$found = 0;

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
     echo "<html>";
     echo "<head><title>PKII Admin - Directory List</title></head>";
     echo "<body>";
     echo "<h2>PKII Directory Listing</h2>";

     echo "<form action=directory.php?loginid=$loginid method=POST>";
     echo "<select name=employeetype>";
     echo "<option value=select selected>select</option>";
     echo "<option value=active-employees>Active Employees</option>";
     echo "<option value=inactive-employees>Inactive Employees</option>";
     echo "<option value=active-consultants>Active Consultants</option>";
     echo "<option value=inactive-consultants>Inactive Consultants</option>";
     echo "<option value=active-employees-consultants>Active Employees & Consultants</option>";
     echo "<option value=inactive-employees-consultants>Inactive Employees & Consultants</option>";
     echo "<option value=all-personnel>ALL</option>";
     echo "</select>";
     echo "<input type=submit value=Go>";
     echo "</form>";

     if($employeetype == 'active-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.num_res1, tblcontact.num_mobile1, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.term_resign = '0000-00-00' ORDER BY tblcontact.name_last", $dbh);
     }
     else if($employeetype == 'inactive-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.num_res1, tblcontact.num_mobile1, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.term_resign != '0000-00-00' ORDER BY tblcontact.name_last", $dbh);
     }
     else if($employeetype == 'active-consultants')
     {
	$result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.num_res1, tblcontact.num_mobile1, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' AND tblemployee.term_resign = '0000-00-00' ORDER BY tblcontact.name_last", $dbh);
     }
     else if($employeetype == 'inactive-consultants')
     {
	$result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.num_res1, tblcontact.num_mobile1, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' AND tblemployee.term_resign != '0000-00-00' ORDER BY tblcontact.name_last", $dbh);
     }
     else if($employeetype == 'all-personnel')
     {
	$result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.num_res1, tblcontact.num_mobile1, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' ORDER BY tblcontact.name_last", $dbh);
     }
     else if($employeetype == 'active-employees-consultants')
     {
	$result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.num_res1, tblcontact.num_mobile1, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.term_resign = '0000-00-00' ORDER BY tblcontact.name_last", $dbh);
     }
     else if($employeetype == 'inactive-employees-consultants')
     {
	$result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.num_res1, tblcontact.num_mobile1, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.term_resign != '0000-00-00' ORDER BY tblcontact.name_last", $dbh);
     }

     echo "<table border=1>";
     echo "Displaying list: <b>$employeetype</b><br>";
     echo "<tr bgcolor=yellow><td>Count</td><td>EmpID</td><td>LastName</td><td>FirstName</td><td>M.I.</td><td>Address</td><td>Landline</td><td>Mobile1</td><td>Mobile2</td><td>Email1</td><td>Email2</td><td>Action</td></tr>";

     $count = 0;

     while ($myrow = mysql_fetch_row($result))
     {
	$count = $count + 1;
	$pid = $myrow[0];
	$employeeid = $pid;
	$namefirst = $myrow[1];
	$namelast = $myrow[2];
	$namemiddle = $myrow[3];
	$email1 = $myrow[4];
	$email2 = $myrow[5];
	$address1 = $myrow[6];
	$landline1 = $myrow[7];
	$mobile1 = $myrow[8];
	$mobile2 = $myrow[9];

	echo "<tr><td>$count</td><td>$employeeid</td><td>$namelast</td><td>$namefirst</td>";

	$midint = $namemiddle;
	echo "<td>" . $midint[0] . "</td>";

	echo "<td>$address1</td><td>$landline1</td><td>$mobile1</td><td>$mobile2</td>";

	echo "<td><a href=mailto:$email1>$email1</a></td>";
	echo "<td><a href=mailto:$email2>$email2</a></td>";
	echo "<td><a href = moreinfoemp.php?pid=$pid&loginid=$loginid target=_blank>More Info</a></td></tr>";
     }

     echo "</table>"; 
   
     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 
  
     echo "<p><a href=admlogin.php?loginid=$loginid>Back</a><br>";

     echo "</html>";
}
else
{
     echo "<html>";
     
     echo "You are not logged in<br>";
     echo "<a href=login.htm>Login</a><br>";

     echo "</html>";
}

mysql_close($dbh);
?> 
