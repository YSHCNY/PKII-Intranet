<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeetype = $_POST['employeetype'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     echo "<html>";
?>
<STYLE TYPE="text/css">
<!--
TD{font-family: Helvetica; font-size: 10pt;}
--->
</STYLE>
<?php
     echo "<form action=emailnotifier4.php?loginid=$loginid method=POST name=myform>";
    
     if($employeetype == "employee")
     {
          echo "<select name=employeeid>";

          $result = mysql_query("SELECT employeeid, name_first, name_last, email1 FROM tblcontact WHERE email1 != '' AND employeeid !='' AND employeeid NOT LIKE 'C%' ORDER BY name_first", $dbh);

          while ($myrow = mysql_fetch_row($result))
          {    
               $eid = $myrow[0];
               $name_first = $myrow[1];
               $name_last = $myrow[2];
               $email = $myrow[3];

               echo "<option value=$eid>$eid $name_first $name_last / $email</option>";
          }
   
          echo "</select>"; 
     }

     if($employeetype == "consultant")
     {
          echo "<select name=employeeid>";

          $result = mysql_query("SELECT employeeid, name_first, name_last, email1 FROM tblcontact WHERE email1 != '' AND employeeid !='' AND employeeid LIKE 'C%' ORDER BY name_first", $dbh);

          while ($myrow = mysql_fetch_row($result))
          {    
               $eid = $myrow[0];
               $name_first = $myrow[1];
               $name_last = $myrow[2];
               $email = $myrow[3];

               echo "<option value=$eid>$name_first $name_last / $email</option>";
          }
   
          echo "</select>";
     }

     echo "<input type=submit value=Go>";
     echo "</form></html>";
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
