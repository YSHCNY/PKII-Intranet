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

     echo "<p><font size=1>Modules >> Personnel Bonus Notifier >> Create group</font></p>";

     echo "<table class='fin'>";
     echo "<tr><th colspan='5'>Create Notifier Group</th></tr>";


     echo "<tr><th colspan='5'><i>-List of Available Groups-</i></th></tr>";
	 echo "<tr><th>ctr</th><th>groupname</th><th>datecreated</th><th colspan='2'>action</th></tr>";
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
	if($accesslevel == 5) {
        $res11query = "SELECT DISTINCT groupname, datecreated FROM tblemppaybongrp";		
	} else if($accesslevel <= 4) {
	    $res11query = "SELECT DISTINCT groupname, datecreated FROM tblemppaybongrp WHERE accesslevel <= 4";
	} //if-else
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1; $ctr11++;
	echo "<tr><td>$ctr11</td><th><strong>".$myrow11['groupname']."</strong></th><td>".date('Y-M-d', strtotime($myrow11['datecreated']))."</td>";
	echo "<td class='font-italic'>edit</td>";
	echo "<div class='form-group'>";
	echo "<form action=\"emppaybongrpdel.php?loginid=$loginid\" method=\"POST\" name=\"\">";
	echo "<input type='hidden' name='groupname' value=\"".$myrow11['groupname']."\">";
	echo "<td><button class='btn btn-danger' name='btnGrpnmDel' value='1'>del</button></td>";
	echo "</form>";
	echo "</div>";
	echo "</tr>";			
		} //while
	} //if

     echo "<tr><th colspan='5'>";
	 echo "<div class='form-group'>";
     echo "<FORM METHOD=\"post\" ACTION=\"emppaybongrpadd2.php?loginid=$loginid\">";
	 echo "<h3>Please enter new group name</h3>";
     echo "<p class='text-center'>";
     echo "<INPUT class='form-control' NAME=\"groupname\" VALUE=\"$groupname\"></p>";
     echo "<button TYPE=\"SUBMIT\" class='btn btn-primary'>Submit</button>";
	 echo "</div>";
	 echo "</th></tr></table>";

     echo "<p><a href=\"emppaybon01.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
