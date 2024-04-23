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
     echo "<head><title>PKII Admin - Projects List</title></head>";
     echo "<body>";
     echo "<h2>PKII Projects Listing</h2>";

     $result = mysql_query("SELECT projectid, proj_code, proj_fname, proj_sname, date_start, date_end, proj_desc, proj_services, companyid, projstatus, proj_remarks, contactid FROM tblproject1 WHERE projectid=$pid", $dbh);
   
     while ($myrow = mysql_fetch_row($result))
     {
         $acronym = $myrow[2];

         echo "Project Name: $myrow[1]<br>";
         echo "Acronym: $myrow[2]<br>";
         echo "From: $myrow[3]<br>";
         echo "To: $myrow[4]<br>";
         echo "Others: $myrow[5]<br>";
         echo "Desc: $myrow[6]<br>";
         echo "Services: $myrow[7]<br>";
         echo "Company ID: $myrow[8]<br>";
         echo "Status: $myrow[9]<br>";
         echo "Remarks: $myrow[10]<br>";
         echo "Contact ID: $myrow[11]<br>";
     }

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

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
