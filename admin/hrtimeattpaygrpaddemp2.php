<?php
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idtblhrtapaygrp = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';

$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
// $cflexi = (isset($_POST['cflexi'])) ? $_POST['cflexi'] :'';




// defaults
$restday = "1000001";
$projcode = "C00-001";
$activesw = 1;
$idhrtapayshiftctg = 3; // 8:00am to 5:00pm
$projassignid = 0; // 0 -> no assigned basic salary

// query pay group name based on id
$result11=""; $found11=0; $ctr11=0;
$result11 = mysql_query("SELECT paygroupname FROM tblhrtapaygrp WHERE idtblhrtapaygrp=$idtblhrtapaygrp", $dbh);
if($result11 != "") {
	while($myrow11 = mysql_fetch_row($result11)) {
	$found11 = 1;
	$paygroupname11 = $myrow11[0];
	}
}

if($found11 == 1) {

	echo "<html><pre>";
	foreach ($employeeid as $index => $value) {
		// query contactid of employeeid
	//  if (in_array($employeeid12, $cflexiIds)) {
    //         echo "notsame: $employeeid12 = $employeeid12\n";
    //     } else {
    //         echo "notsame: 0 = $employeeid12\n";
    //     }
			
	// 	foreach ($cflexi as $checkedFlexi){
	// 	if ($checkedFlexi == $value){
	// 		echo "both same look: $checkedFlexi = $value <br>";

	// 	} else {
	// 		echo "not same $checkedFlexi = $value <br>";
	// 	}
	// }


		$result12=""; $found12=0; $ctr12=0;
		$result12 = mysql_query("SELECT contactid FROM tblcontact WHERE employeeid=\"$value\" AND contact_type=\"personnel\"", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
			$found12 = 1;
			$contactid12 = $myrow12[0];
			}
		}
		// check tblhrtapaygrpemplst if employeeid exists and ignore else insert
		$result15=""; $found15=0; $ctr15=0;
		$result15 = mysql_query("SELECT idhrtapaygrpemplst FROM tblhrtapaygrpemplst WHERE idtblhrtapaygrp=$idtblhrtapaygrp AND employeeid=\"$value\"", $dbh);
		if($result15 != "") {
			while($myrow15 = mysql_fetch_row($result15)) {
			$found15 = 1;
			$idhrtapaygrpemplst15 = $myrow15[0];
			}
		}
		if($found15 == 1) {
		// echo "record exists. id:$idhrtapaygrpemplst15, empnum:$value\n";
		} else {
	
		$result14 = mysql_query("INSERT INTO tblhrtapaygrpemplst SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", lastlogin=$loginid, paygroupname=\"$paygroupname11\", employeeid=\"$value\", idtblhrtapaygrp=$idtblhrtapaygrp, contactid=$contactid12, idhrtapayshiftctg=$idhrtapayshiftctg, bankacctid=0, flexitime = 1, restday=\"$restday\", projcode=\"$projcode\", activesw=$activesw, projassignid=$projassignid", $dbh);
		// create log
  	$result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
		while($myrow16 = mysql_fetch_row($result16))
		{ $adminuid=$myrow16[0]; }
		$adminlogdetails = "$loginid:$adminuid - add member with empid:$value to paygroup: $paygroupname11 of payroll system";
		$result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
		}
	}
	echo "</pre></html>";

	// redirect back to mngdeptcd.php
	header("Location: hrtimeattpaygrpedit.php?loginid=$loginid&idpg=$idtblhrtapaygrp");
	exit;
	// echo "<a href=\"hrtimeattpaygrpedit.php?loginid=$loginid&idpg=$idtblhrtapaygrp\">back</a>\n";

}

mysql_close($dbh);
$dbh2->close();
?>
