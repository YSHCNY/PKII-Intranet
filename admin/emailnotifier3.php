<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeetype = (isset($_POST['employeetype'])) ? $_POST['employeetype'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
	include ("header.php");
    include ("sidebar.php");

    echo "<p><font size=1>Modules >> Custom pay notifier</font></p>";
     // echo "<html>";
?>
<STYLE TYPE="text/css">
<!--
TD{font-family: Helvetica; font-size: 10pt;}
--->
</STYLE>
<?php

    echo "<h2>Displaying list of $employeetype"."s"."<h2>";
	echo "<table class=\"fin2\">";
     echo "<form action=\"emailnotifier4.php?loginid=$loginid\" method=\"POST\" name=\"myform\">";
	echo "<tr><th>";
    echo "<div class='form-group'>";
     if($employeetype == "employee") {
          echo "<select class='form-control' name=\"employeeid\">";
        $resquery=""; $result="";
          $resquery="SELECT employeeid, name_first, name_last, email1 FROM tblcontact WHERE email1 != '' AND employeeid !='' AND employeeid NOT LIKE 'C%' ORDER BY name_first";
		$result=$dbh2->query($resquery);
		if($result->num_rows>0) {
			while($myrow=$result->fetch_assoc()) {
               $eid = $myrow['employeeid'];
               $name_first = $myrow['name_first'];
               $name_last = $myrow['name_last'];
               $email = $myrow['email1'];

               echo "<option value=\"$eid\">$eid $name_first $name_last / $email</option>";				
			} //while
		} //if
   
          echo "</select></div>"; 
     }

     if($employeetype == "consultant") {
          echo "<div class='form-group'><select class='form-control' name=\"employeeid\">";
        $resquery=""; $result="";
          $resquery="SELECT employeeid, name_first, name_last, email1 FROM tblcontact WHERE email1 != '' AND employeeid !='' AND employeeid LIKE 'C%' ORDER BY name_first";
		  $result=$dbh2->query($resquery);
		if($result->num_rows>0) {
			while($myrow=$result->fetch_assoc()) {
               $eid = $myrow['employeeid'];
               $name_first = $myrow['name_first'];
               $name_last = $myrow['name_last'];
               $email = $myrow['email1'];

               echo "<option value=\"$eid\">$name_first $name_last / $email</option>";				
			} //while
	    } //if
   
          echo "</select></div>";
     }
    echo "</th><th>";
     echo "<button type='submit' class='btn btn-primary'>Go</button></th>";
     echo "</form>";
	echo "</tr>";
	echo "</table>";

    echo "<p><a href=\"emailnotifier2.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

	 // echo "</html>";

     include ("footer.php");	 
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
