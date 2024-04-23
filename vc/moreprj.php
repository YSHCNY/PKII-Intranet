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


	 echo "<tr><td>Project Code</td><td>$proj_code</td></tr>";
     echo "<tr><td>Acronym</td><td><b>$proj_sname</b></td></tr>";
     echo "<tr><td>Project Name</td><td><b>$proj_fname</b></td></tr>";
     echo "<tr><td>Description</td><td>$proj_desc</td></tr>";
     echo "<tr><td>&nbsp</td><td>&nbsp</td></tr>";
     echo "<tr><td>Status</td><td>$projstatus</td></tr>";
     echo "<tr><td>Date Started</td><td>$date_start</td></tr>";
     echo "<tr><td>Date Finished</td><td>$date_end</td></tr>";
     echo "<tr><td>&nbsp</td><td>&nbsp</td></tr>";
     echo "<tr><td>Services</td><td>$proj_services</td></tr>";
     echo "<tr><td>Remarks</td><td>$projremarks</td></tr>";
     echo "<tr><td>&nbsp</td><td>&nbsp</td></tr>";

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