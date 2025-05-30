<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = $_GET['loginid'];
$pid = $_GET['pid'];

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
     echo "<head><title>PKII Admin - Personnel Information</title></head>";
     echo "<body>";
     echo "<h2>Personnel Information</h2>";

     echo "vartest pid:$pid loginid:$loginid<br>";

     if ($pid == '')
     {
	echo "<p><font color=red><b>Sorry. No data available</b></font></p>";
     }
     else
     {
	$result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.picture, tblcontact.position, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1, tblcontact.num_res2, tblcontact.num_mobile1, tblcontact.num_mobile2, tblcontact.num_mobile3, tblcontact.email1, tblcontact.email2, tblcontact.url, tblcontact.remarks_contact, tblemployee.emp_ref_num, tblemployee.date, tblemployee.date_hired, tblemployee.date_expired, tblemployee.emp_birthdate, tblemployee.emp_birthplace, tblemployee.emp_civilstatus, tblemployee.empeducationid, tblemployee.emp_num1, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.emp_insuranceid, tblemployee.emp_emergencyid, tblemployee.emp_skills, tblemployee.emp_status, tblemployee.emp_remarks, tblemployee.employee_type FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.employeeid='$pid'", $dbh);
   
	while ($myrow = mysql_fetch_row($result))
	{
	  $pid = $myrow[0];
	  echo "<table border=0 spacing=1>";
	  echo "<tr><td>Employee No.</td><td>$myrow[0]</td></tr>";
	  echo "<tr><td>Name</td><td><b>$myrow[2] $myrow[3] $myrow[1]</b></td></tr>";
//         echo "<tr><td>Position</td><td>$myrow[6]";
	  echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	  echo "<tr><td>Sex</td><td>$myrow[4]";
	  echo "<tr><td>Address</td><td>$myrow[7]</td></tr>";
	  echo "<tr><td>Landline(s)</td><td>$myrow[13]</td></tr>";
	  echo "<tr><td>&nbsp;</td><td>$myrow[14]</td></tr>";
         echo "<tr><td>Mobile(s)</td><td>$myrow[15]</td></tr>";
         echo "<tr><td>&nbsp;</td><td>$myrow[16]</td></tr>";
         echo "<tr><td>&nbsp;</td><td>$myrow[17]</td></tr>";
         echo "<tr><td>Email(s)</td><td><a href=mailto:'$myrow[18]'>$myrow[18]</a></td></tr>";
         echo "<tr><td>&nbsp;</td><td><a href=mailto:'$myrow[19]'>$myrow[19]</a></td></tr>";
         echo "<tr><td>Website</td><td>$myrow[20]</td></tr>";
         echo "<tr><td>Remarks</td><td>$myrow[21]</td></tr>";
         echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
         echo "<tr><td>Employee Ref#</td><td>$myrow[22]</td></tr>";
         echo "<tr><td>Date Hired</td><td>$myrow[23]</td></tr>";
         echo "<tr><td>Date Expired</td><td>$myrow[24]</td></tr>";
         echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
         echo "<tr><td>Birthdate</td><td>$myrow[25]</td></tr>";
         echo "<tr><td>Birthplace</td><td>$myrow[26]</td></tr>";
         echo "<tr><td>Civil Status</td><td>$myrow[27]</td></tr>";
         echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
         echo "<tr><td>BIR TIN</td><td>$myrow[30]</td></tr>";
         echo "<tr><td>SSS</td><td>$myrow[31]</td></tr>";
         echo "<tr><td>Philhealth</td><td>$myrow[32]</td></tr>";
         echo "<tr><td>Pag-IBIG</td><td>$myrow[33]</td></tr>";
         echo "<tr><td>GSIS</td><td>$myrow[34]</td></tr>";
         echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
         echo "<tr><td>Insurance details</td><td>&nbsp;</td></tr>";
         echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
         echo "<tr><td>Emergency contact details</td><td>&nbsp;</td></tr>";
         echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
         echo "<tr><td>Skills</td><td>$myrow[37]</td></tr>";
         echo "<tr><td>Employee Status</td><td>$myrow[38]</td></tr>";
         echo "<tr><td>Remarks</td><td>$myrow[39]</td></tr>";
         echo "<tr><td>Type</td><td>$myrow[40]</td></tr>";

//	Start Education background
	echo "<tr><td colspan=2>&nbsp;</td></tr>";
	echo "<tr valign=top><td colspan=2><i>Educational background</i></td></tr>";
	$result4 = mysql_query("SELECT employeeid, empeducationctr, coursegraduated, yeargraduated, schoolgraduated, schooladdress FROM tblempeducation WHERE employeeid='$pid'", $dbh);
	while ($myrow4 = mysql_fetch_row($result4))
	{
	  echo "<tr><td>Course</td><td>$myrow4[2]</td></tr>";
	  echo "<tr><td>Year graduated</td><td>$myrow4[3]</td></tr>";
	  echo "<tr><td>School/University</td><td>$myrow4[4]</td></tr>";
	  echo "<tr><td>Address</td><td>$myrow4[5]</td></tr>";
	}
//	End Education background

//	Start Employment details
	echo "<tr><td colspan=2>&nbsp;</td></tr>";
	echo "<tr valign=top><td colspan=2><i>Employment Details</i></td></tr>";
	$result3 = mysql_query("SELECT employeeid, empdepartment, empposition, emppositionlevel, empsalarygrade, empregularship FROM tblempdetails WHERE employeeid='$pid'", $dbh);
	while ($myrow3 = mysql_fetch_row($result3))
	{
	  echo "<tr><td>Position</td><td>$myrow3[2]</td></tr>";
	  echo "<tr><td>Department</td><td>$myrow3[1]</td></tr>";
	  echo "<tr><td>Position Level</td><td>$myrow3[3]</td></tr>";
	  echo "<tr><td>Salary grade</td><td>$myrow3[4]</td></tr>";
	}
//	End Employement details

//	Start Display project(s) involvement
	echo "<tr><td colspan=2>&nbsp;</td></tr>";
	echo "<tr valign=top><td><i>Project(s) Involvment</i></td><td>";
     $result2 = mysql_query("SELECT employeeid, projectid, proj_name, empprojctr, position, salary, allow_inc, allow_proj, ecola1, ecola2, field_allow, perdiem, durationfrom, durationto, durationtotal, term_resign, remarks FROM tblprojassign WHERE employeeid='$pid'", $dbh); 
	while ($myrow2 = mysql_fetch_row($result2))
	{
          echo "$myrow2[2] - $myrow2[12] -to- $myrow2[13]<br>";
	}
        echo "</td></tr>";
//	End Display project(2) involvement

//	Start List of Dependents
	echo "<tr><td colspan=2>&nbsp;</td></tr>";
	echo "<tr valign=top><td colspan=2><i>List of Dependents</i></td></tr>";
	echo "<tr><td>&nbsp;</td><td>";
	$result5 = mysql_query("SELECT employeeid, empdependentctr, dependentlast, dependentfirst, dependentmiddle, dependentbirthdate, dependentrelation FROM tblempdependent WHERE employeeid='$pid'", $dbh);
	while ($myrow5 = mysql_fetch_row($result5))
	{
	  echo "$myrow5[3] - $myrow5[5] - $myrow5[6]<br>";
	}
	echo "</td></tr>";
//	End List of Dependents

//	Start Emergency contact details
//	need to join with tblcontact.contactid
//	echo "<tr><td colspan=2>&nbsp;</td></tr>";
//	echo "<tr valign=top><td colspan=2><i>Emergency Contact Details</i></td></tr>";
//	echo "<tr><td>&nbsp;</td><td>";
//	$result6 = mysql_query("SELECT * FROM tblempdependent WHERE employeeid='$pid'", $dbh);
//	while ($myrow6 = mysql_fetch_row($result6))
//	{
//	  echo "$myrow6[3] - $myrow6[5] - $myrow6[6]<br>";
//	}
//	echo "</td></tr>";
//	End Emergency contact details

	  echo "</table>";
	}

     }
 
     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     echo "<p>";
     echo "<p><FORM><INPUT TYPE='BUTTON' VALUE='Close Window' onClick='window.close()'></FORM></p>";

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
