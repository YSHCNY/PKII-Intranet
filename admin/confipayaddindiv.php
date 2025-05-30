<?php 

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$groupname0 = (isset($_GET['gn'])) ? $_GET['gn'] :'';
$groupname = (isset($_POST['groupname'])) ? $_POST['groupname'] :'';

$datecreated = date("Y-m-d");

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     echo "<html><head><STYLE TYPE=\"text/css\">";
     echo "<!--";
     echo "p{font-family: Helvetica; font-size: 10pt;}";
     echo "B{font-family: Helvetica; font-size: 10pt;}";
     echo "TD{font-family: Helvetica; font-size: 10pt;}";
     echo "--->";
     echo "</STYLE></head>";

		echo "<table>";
		echo "<tr><td>";
		echo "<form action=\"confipayaddindiv2.php?loginid=$loginid&gn=$groupname\" method=\"POST\" name=\"confipayaddindiv2\">";
		echo "<input type=\"hidden\" name=\"groupname\" value=\"$groupname\">";
		echo "<select name=\"confiempid\">";
		echo "<option value=''>choose personnel</option>";
		$res11query="SELECT tblemployee.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblemployee INNER JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE tblcontact.contact_type=\"personnel\" ORDER BY tblcontact.name_last ASC, tblcontact.name_first ASC, tblcontact.employeeid ASC";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11 = 1;
			$employeeid11 = $myrow11['employeeid'];
			$name_last11 = $myrow11['name_last'];
			$name_first11 = $myrow11['name_first'];
			$name_middle11 = $myrow11['name_middle'];
			echo "<option value=\"$employeeid11\">$name_last11, $name_first11 $name_middle11[0] ($employeeid11)</option>";
			} // while
		} // if
		echo "</select>";
		echo "<input type=\"submit\" value=\"Submit\">";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";

     echo "<p><a href=\"confipay2.php?loginid=$loginid&gn=$groupname\">Back</a></p>";
     echo "</html>";

} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();

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
