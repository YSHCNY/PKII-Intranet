<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
$groupname = (isset($_POST['groupname'])) ? $_POST['groupname'] :'';

$grpaccesslevel = (isset($_POST['grpaccesslevel'])) ? $_POST['grpaccesslevel'] :'';
$listby = (isset($_POST['listby'])) ? $_POST['listby'] :'';

// echo "<p>vartest grp:$groupname, acclev:$accesslevel, list:$listby</p>";

$datecreated = date("Y-m-d");

$found = 0;
$exist = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> Personnel Bonus Notifier >> Create group</font></p>";

     echo "<table class='fin'>";
     echo "<tr><th colspan=\"6\">Creating Group</b></th></tr>";

// check if groupname is existing
     // $result = mysql_query("SELECT DISTINCT groupname, datecreated FROM tblemppaybongrp WHERE groupname='$groupname'", $dbh);
    $resquery=""; $result="";
    $resquery="SELECT DISTINCT groupname, datecreated FROM tblemppaybongrp WHERE groupname=\"$groupname\"";
	$result=$dbh2->query($resquery);

//     if ($myrow = mysql_fetch_row($result))
//     {
//	$exist = 1;
//	echo "<b><font color=red>Groupname $myrow[0] exists.</font></b><br>";
//	echo "<p>Please enter another name.</p>";
//     }
//     elseif ($groupname == '')
//     {
//	echo "<b><font color=red>You have entered a blank groupname.</font></b><br>";
//	echo "<p>Please enter another name.</p>";
//     }
//     else
//     {

// display personnel list and get members 
	$exist = 0;

    echo "<tr><td colspan='6'>";
	echo "<form class='form-inline' action=\"emppaybongrpadd2.php?loginid=$loginid\" method=\"POST\">";
	
    echo "<div class='form-group'>";
	echo "<div class='align-top'>";
	echo "<label for=\"Choose groupname\">Groupname</label>";
	echo "<input type=\"text\" name=\"groupname\" value=\"$groupname\" readonly>";
	echo "</div>";
	echo "</div>";

    if($grpaccesslevel=='3') {
		$acclev3="selected"; $acclev5="";
	} else if($grpaccesslevel=='5') {
		$acclev3=""; $acclev5="selected";		
	} //if=else
	echo "<div class='form-group'>";
	echo "<label for=\"whatAccesslevel\">Access level</label>";
	echo "<div class=\"text-center\">";
	echo "<select name=\"grpaccesslevel\">";
	echo "<option value='3' $acclev3>3</option>";
	if($accesslevel>=5) {
	echo "<option value='5' $acclev5>5</option>";		
	} //if
	echo "</select>";
	echo "</div>";
	echo "<br><i>Note:<br>Accesslevel:3 - All personnel group<br>Accesslevel:5 - Confidential group</i>";
	echo "</div>";

    if($listby=='activeemployees') {
		$activeempsel="selected"; $activeconssel=""; $activeallsel=""; $activenonesel="";
	} else if($listby=='activeconsultants') {
		$activeempsel=""; $activeconssel="selected"; $activeallsel=""; $activenonesel="";		
	} else if($listby=='activeall') {
		$activeempsel=""; $activeconssel=""; $activeallsel="selected"; $activenonesel="";				
	} else {
		$activeempsel=""; $activeconssel=""; $activeallsel=""; $activenonesel="selected";						
	} //if-else
    echo "<div class='form-group'>";
	echo "<label for=\"whatListtype\">List by</label>";
	echo "<select name=\"listby\">";
	echo "<option value='' $activenonesel>-</option>";
	echo "<option value=\"activeemployees\" $activeempsel>Active Employees</option>";
	echo "<option value=\"activeconsultants\" $activeconssel>Active Consultants</option>";
	echo "<option value=\"activeall\" $activeallsel>All Active Employees/Consultants</option>";
	echo "</select>";
	echo "</div>";
	
	echo "<div class='form-group'>";
	echo "<button type=\"submit\" class=\"btn btn-primary\">Submit</button>";
	echo "</div>";
	echo "</form>";
	echo "</td></tr>";
	

	// $result2 = mysql_query("SELECT employeeid, name_first, name_middle, name_last, email1 FROM tblcontact WHERE employeeid<>'' ORDER BY name_last", $dbh);

if($groupname!='' && $grpaccesslevel!='' && $listby!='') {
	
	echo "<form class='form-inline' action=\"emppaybongrpadd3.php?loginid=$loginid\" method=\"POST\">";
	echo "<input type='hidden' name='groupname' value='$groupname'>";
	echo "<input type='hidden' name='grpaccesslevel' value='$grpaccesslevel'>";
	echo "<input type='hidden' name='listby' value='$listby'>";

	echo "<tr><th colspan='6'>Please select members for this group:|$accesslevel|$grpaccesslevel</th></tr>";
	echo "<tr><th>Select</th><th>EmployeeID</th><th>Last</th><th>First</th><th>Middle</th><th>email</th></tr>";
	

    $res2query=""; $result2=""; $found2=0;
	
	if($listby=='activeemployees') {
        // $res2query="SELECT employeeid, name_first, name_middle, name_last, email1 FROM tblcontact WHERE employeeid<>'' ORDER BY name_last";
		$res2query="SELECT DISTINCT `tblemployee`.`employeeid`, `tblcontact`.`name_last`, `tblcontact`.`name_first`, `tblcontact`.`name_middle`, `tblcontact`.`email1` FROM `tblemployee` LEFT JOIN `tblcontact` ON `tblemployee`.`employeeid`=`tblcontact`.`employeeid` WHERE `tblemployee`.`employee_type` = 'employee' AND `tblemployee`.`emp_record` = 'active' ORDER BY `tblcontact`.`name_last` ASC, `tblcontact`.`name_first` ASC";
	} else if($listby=='activeconsultants') {
		$res2query="SELECT DISTINCT `tblemployee`.`employeeid`, `tblcontact`.`name_last`, `tblcontact`.`name_first`, `tblcontact`.`name_middle`, `tblcontact`.`email1` FROM `tblemployee` LEFT JOIN `tblcontact` ON `tblemployee`.`employeeid`=`tblcontact`.`employeeid` WHERE `tblemployee`.`employee_type` = 'consultant' AND `tblemployee`.`emp_record` = 'active' ORDER BY `tblcontact`.`name_last` ASC, `tblcontact`.`name_first` ASC";
	} else if($listby=='activeall') {
		$res2query="SELECT DISTINCT `tblemployee`.`employeeid`, `tblcontact`.`name_last`, `tblcontact`.`name_first`, `tblcontact`.`name_middle`, `tblcontact`.`email1` FROM `tblemployee` LEFT JOIN `tblcontact` ON `tblemployee`.`employeeid`=`tblcontact`.`employeeid` WHERE `tblemployee`.`emp_record` = 'active' ORDER BY `tblcontact`.`name_last` ASC, `tblcontact`.`name_first` ASC";
	} else {
		$res2query="";
	} //if-else
		
	$result2=$dbh2->query($res2query);
	if($result2->num_rows>0) {
		while($myrow2=$result2->fetch_assoc()) {
			$found2=1;
	  $employeeid = $myrow2['employeeid'];
	  $name_first = $myrow2['name_first'];
	  $name_middle = $myrow2['name_middle'];
	  $name_last = $myrow2['name_last'];
	  $email1 = $myrow2['email1'];
	  echo "<tr>";
	  echo "<td><input type=\"checkbox\" name=\"member[]\" value=\"$employeeid\"></td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle</td><td>$email1</td>";
	  echo "</tr>";
		} //while
	} //if
	echo "</table><br>";
	echo "<button TYPE=\"SUBMIT\" class='btn btn-primary'>Save</button>";
	echo "</form>";
} //if($groupname!='' && $accesslevel!='' && $listby!='')

     echo "<p><a href=\"emppaybongrpadd.php?loginid=$loginid\" class=\"btn btn-default\" role=\"button\">Back</a></p>";
     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
