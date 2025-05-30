<?php 

require '../includes/dbh.php';

	$result11=""; $found11=0;
	$res11query = "SELECT employeeid, contactid FROM tbllogin WHERE loginid=$loginid AND username=\"$username\" AND password=md5('$password') LIMIT 1";
	$result11=$dbh->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$employeeid11=$myrow11['employeeid'];
		$contactid11=$myrow11['contactid'];
    } // while
	} // if

$dbh->close();
?> 

	
