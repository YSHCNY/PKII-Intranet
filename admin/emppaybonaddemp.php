<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$groupname = $_GET['groupname'];

$datecreated = date("Y-m-d");

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     echo "<html><head><STYLE TYPE=\"text/css\">";
     echo "<!--";
     echo "p{font-family: Helvetica; font-size: 10pt;}";
     echo "B{font-family: Helvetica; font-size: 10pt;}";
     echo "TD{font-family: Helvetica; font-size: 10pt;}";
     echo "--->";
     echo "</STYLE></head>";

		echo "<table>";
		echo "<tr><td>";
		echo "<form action=\"emppaybonaddemp2.php?loginid=$loginid&groupname=$groupname\" method=\"POST\" name=\"emppaybonaddemp\">";
		echo "<select name=\"employeeid\">";
		echo "<option value=''>choose personnel</option>";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("SELECT tblemployee.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblemployee INNER JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE tblcontact.contact_type=\"personnel\" ORDER BY tblcontact.name_last ASC, tblcontact.name_first ASC, tblcontact.employeeid ASC", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$employeeid11 = $myrow11[0];
			$name_last11 = $myrow11[1];
			$name_first11 = $myrow11[2];
			$name_middle11 = $myrow11[3];
			echo "<option value=\"$employeeid11\">$name_last11, $name_first11 $name_middle11[0] ($employeeid11)</option>";
			}
		}
		echo "</select>";
		echo "<input type=\"submit\">";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";

     echo "<p><a href=\"emppayboninfo1.php?loginid=$loginid&groupname=$groupname\">Back</a></p>";
     echo "</html>";
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);

function UploadFile()
{
     $target = "transfers/"; 
     $target = $target . basename( $_FILES['uploaded']['name']) ; 
     $ok=1; 

     //This is our size condition 
     // if ($uploaded_size > 350000) 
     //{ 
     //     echo "Your file is too large.<br>"; 
     //     $ok=0; 
     //} 

     //This is our limit file type condition 
     if ($uploaded_type =="text/php") 
     { 
          echo "No PHP files<br>"; 
          $ok=0; 
     } 

     //Here we check that $ok was not set to 0 by an error 
     if ($ok==0) 
     { 
          echo "<font color=red>Sorry your file was not uploaded. Please try again.</font>"; 
     } 

     //If everything is ok we try to upload it 
     else 
     { 
          if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
          { 
               echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded";
          } 
          else 
          { 
               echo "<font color=red>Sorry, there was a problem uploading your file. Please try again.</font>"; 
          }
     }

     echo "<br>";
} 
?> 
