<?php
//
// vpersinfo.php
// fr: vc/index.php
//page 21
?>
<?php 


include '../includes/dbh.php';

$loginid = $_GET['loginid'];
$proj_code = $_GET['prjcd'];

$found = 0;
?>
	<div class="row">
		<div class="col-md-12"><h3>PKII Projects Listing</h3></div>
	</div>

	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
<table class="table">

<tbody>
<?php 
	echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=21\" method=\"POST\" name=\"vprojects\">";
	?>
	
<?php
	// query tblemployee, tblcontact
	include("../m/qryproj2.php");
	



     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=6><font color=white><b>PKII Projects Listing</b></font></td></tr>";


	 echo "<tr><td class = '$maintext'>Project Code</td><td class = '$maintext'>$proj_code</td></tr>";
     echo "<tr><td class = '$maintext'>Acronym</td><td class = '$maintext'><b>$proj_sname</b></td></tr>";
     echo "<tr><td class = '$maintext'>Project Name</td><td class = '$maintext'><b>$proj_fname</b></td></tr>";
     echo "<tr><td class = '$maintext'>Description</td><td class = '$maintext'>$proj_desc</td></tr>";
     echo "<tr><td class = '$maintext'>&nbsp</td><td class = '$maintext'>&nbsp</td></tr>";
     echo "<tr><td class = '$maintext'>Status</td><td class = '$maintext'>$projstatus</td></tr>";
     echo "<tr><td class = '$maintext'>Date Started</td><td class = '$maintext'>$date_start</td></tr>";
     echo "<tr><td class = '$maintext'>Date Finished</td><td class = '$maintext'>$date_end</td></tr>";
     echo "<tr><td class = '$maintext'>&nbsp</td><td class = '$maintext'>&nbsp</td></tr>";
     echo "<tr><td class = '$maintext'>Services</td><td class = '$maintext'>$proj_services</td></tr>";
     echo "<tr><td class = '$maintext'>Remarks</td><td class = '$maintext'>$projremarks</td></tr>";
     echo "<tr><td class = '$maintext'>&nbsp</td><td>&nbsp</td></tr>";

	if($employeeid != "") {
		 echo "<tr><td>Assigned Personnel</td>";
	}
	if($found3 == 1) {
     echo "<td><b>$name_first $name_last</b> - <a href=mailto:$email>$email</a></td></tr>";
		} else if($found3 == 0) {
			echo "<td></td></tr>";
		}

     echo "<tr><td valign=top>Personnel involved</td>";
     echo "<td>";
	
	?>