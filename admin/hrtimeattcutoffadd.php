<?php
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idhrtapaygrp = (isset($_POST['idhrtapaygrp'])) ? $_POST['idhrtapaygrp'] :'';
$cutstart = (isset($_POST['cutstart'])) ? $_POST['cutstart'] :'';
$cutend = (isset($_POST['cutend'])) ? $_POST['cutend'] :'';
$remarks = (isset($_POST['remarks'])) ? $_POST['remarks'] :'';

$cutstartori = $cutstart;

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

	// check if existing in tblhrtapaycutoff
	$res11qry=""; $result11=""; $found11=0; $ctr11=0;
	$res11qry="SELECT idhrtacutoff, status FROM tblhrtacutoff WHERE idhrtapaygrp=\"$idhrtapaygrp\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\"";
	$result11 = $dbh2->query($res11qry);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$idhrtacutoff11 = $myrow11['idhrtacutoff'];
		$status11 = $myrow11['status'];
		} // while
	} // if

	if($found11 == 1) {
		echo "<p><strong><font color=\"red\">Sorry, cutoff exists. Please try again.</font></strong></p>";
		if($status11==0) {
			echo "<p><strong>An inactive or deleted cut-off is detected. Would you like to restore its records?</strong></p>";
			echo "<p>";
			echo "<button type=\"button\" class=\"btn btn-success\"><a href=\"hrtimeattcutrestor.php?loginid=$loginid&idpg=$idhrtapaygrp&idct=$idhrtacutoff11\">Yes</a></button>&nbsp;&nbsp;<button type=\"button\" class=\"btn btn-danger\"><a href=\"hrtimeattcutoff.php?loginid=$loginid&idpg=$idhrtapaygrp\">No</a></button>";
			echo "</p>";
		}
		echo "<p><a href=\"hrtimeattcutoff.php?loginid=$loginid&idct=$idhrtacutoff11\">back</a></p>";

	} else {

		// query paygroupname
		$result12=""; $found12=0; $ctr12=0;
		$result12 = mysql_query("SELECT paygroupname FROM tblhrtapaygrp WHERE idtblhrtapaygrp=$idhrtapaygrp", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
			$found12 = 1;
			$paygroupname12 = $myrow12[0];
			}
		} // end if($result12 != "")

		// insert into tblhrtacutoff
		$res14query="INSERT INTO tblhrtacutoff SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", lastupdate=$loginid, cutstart=\"$cutstart\", cutend=\"$cutend\", paygroupname=\"$paygroupname12\", idhrtapaygrp=$idhrtapaygrp, remarks=\"$remarks\"";
		$result14 = mysql_query("$res14query", $dbh);
		$idcutoff = mysql_insert_id();

		// query tblhrtapaygrpemplst
		$res15select="SELECT idhrtapaygrpemplst, employeeid, idhrtapayshiftctg, restday, projcode, projchgtyp, allowotdflt, allowotbfidflt FROM tblhrtapaygrpemplst WHERE idtblhrtapaygrp=$idhrtapaygrp AND activesw=1 ORDER BY employeeid ASC";
		$result15=""; $found15=0; $ctr15=0;
		$result15 = mysql_query("$res15select", $dbh);
		if($result15 != "") {
			while($myrow15 = mysql_fetch_row($result15)) {
			$found15 = 1;
			$idhrtapaygrpemplst15 = $myrow15[0];
			$employeeid15 = $myrow15[1];
			$idhrtapayshiftctg15 = $myrow15[2];
			$restday15 = $myrow15[3];
			$projcode15 = $myrow15[4];
			$projchgtyp15 = $myrow15[5];
			$allowotdflt15 = $myrow15[6];
			$allowotbfidflt15 = $myrow15[7];

			if($restday15 != "") {
			$restdaysunval = substr("$restday15", 0, 1);
			$restdaymonval = substr("$restday15", 1, 1);
			$restdaytueval = substr("$restday15", 2, 1);
			$restdaywedval = substr("$restday15", 3, 1);
			$restdaythuval = substr("$restday15", 4, 1);
			$restdayfrival = substr("$restday15", 5, 1);
			$restdaysatval = substr("$restday15", 6, 1);
			if($restdaysunval == 1) { $restdaysunfin="Sun"; } else { $restdaysunfin=""; }
			if($restdaymonval == 1) { $restdaymonfin="Mon"; } else { $restdaymonfin=""; } 
			if($restdaytueval == 1) { $restdaytuefin="Tue"; } else { $restdaytuefin=""; }
			if($restdaywedval == 1) { $restdaywedfin="Wed"; } else { $restdaywedfin=""; }
			if($restdaythuval == 1) { $restdaythufin="Thu"; } else { $restdaythufin=""; }
			if($restdayfrival == 1) { $restdayfrifin="Fri"; } else { $restdayfrifin=""; }
			if($restdaysatval == 1) { $restdaysatfin="Sat"; } else { $restdaysatfin=""; }
			}

			// echo "<p>$idhrtapaygrpemplst15, $employeeid15, $idhrtapayshiftctg15<br>$res14query<br>";

			// loop through cutoff
			while(strtotime($cutstart) <= strtotime($cutend)) {
			// query biometrics records
			$res19select="SELECT tblhrattcheckinout.hrattcheckinoutid, tblhrattcheckinout.att_checktime, tblhrattcheckinout.att_userid FROM tblhrattcheckinout LEFT JOIN tblhrattuserinfo ON tblhrattcheckinout.att_userid=tblhrattuserinfo.att_userid WHERE tblhrattuserinfo.employeeid=\"$employeeid15\" AND (tblhrattcheckinout.att_checktime>=\"$cutstart 00:00:00\" AND tblhrattcheckinout.att_checktime<=\"$cutstart 23:59:59\") AND tblhrattcheckinout.att_checktype=\"I\" ORDER BY tblhrattcheckinout.att_checktime ASC LIMIT 1";
			$result19=""; $found19=0; $ctr19=0;
			$result19 = mysql_query("$res19select", $dbh);
			if($result19 != "") {
				while($myrow19 = mysql_fetch_row($result19)) {
				$found19 = 1;
				$hrattcheckinoutid19 = $myrow19[0];
				$att_checktime19 = date("G:i", strtotime($myrow19[1]));
				$att_userid19 = $myrow19[2];
				}
			}
			$res20select="SELECT tblhrattcheckinout.hrattcheckinoutid, tblhrattcheckinout.att_checktime, tblhrattcheckinout.att_userid FROM tblhrattcheckinout LEFT JOIN tblhrattuserinfo ON tblhrattcheckinout.att_userid=tblhrattuserinfo.att_userid WHERE tblhrattuserinfo.employeeid=\"$employeeid15\" AND (tblhrattcheckinout.att_checktime>=\"$cutstart 00:00:00\" AND tblhrattcheckinout.att_checktime<=\"$cutstart 23:59:59\") AND tblhrattcheckinout.att_checktype=\"o\" ORDER BY tblhrattcheckinout.att_checktime DESC LIMIT 1";
			$result20=""; $found20=0; $ctr20=0;
			$result20 = mysql_query("$res20select", $dbh);
			if($result20 != "") {
				while($myrow20 = mysql_fetch_row($result20)) {
				$found20 = 1;
				$hrattcheckinoutid20 = $myrow20[0];
				$att_checktime20 = date("G:i", strtotime($myrow20[1]));
				$att_userid20 = $myrow20[2];
				}
			}
			// query tblhrtapayshiftctg
			$res18select="SELECT idhrtapayshiftctg, shiftin, shiftout FROM tblhrtapayshiftctg WHERE idhrtapayshiftctg=$idhrtapayshiftctg15";
			$result18=""; $found18=0; $ctr18=0;
			$result18 = mysql_query("$res18select", $dbh);
			if($result18 != "") {
				while($myrow18 = mysql_fetch_row($result18)) {
				$found18 = 1;
				$idhrtapayshigtctg18 = $myrow18[0];
				$shiftin18 = $myrow18[1];
				$shiftout18 = $myrow18[2];
				}
			} // end if($result18 != "")

		// check for holidays
		$result21=""; $found21=0; $ctr21=0;
		$result21 = mysql_query("SELECT idhrtaholidays, holidayname, holidaytype, shiftin, shiftout FROM tblhrtaholidays WHERE applic_date=\"$cutstart\" AND (holidaytype=\"special\" OR holidaytype=\"legal\" OR holidaytype=\"shortened\")", $dbh);
		if($result21 != "") {
			while($myrow21 = mysql_fetch_row($result21)) {
			$found21 = 1;
			$idhrtaholidays21 = $myrow21[0];
			$holidayname21 = $myrow21[1];
			$holidaytype21 = $myrow21[2];
			$shiftin21 = $myrow21[3];
			$shiftout21 = $myrow21[4];
			}
		}

			// check for rest day
			$dateday=date("D", strtotime($cutstart));
			$restdaysw=0;
			if("$restdaysunfin"=="$dateday") { $restdaysw=1;
			} else if("$restdaymonfin"=="$dateday") { $restdaysw=1;
			} else if("$restdaytuefin"=="$dateday") { $restdaysw=1;
			} else if("$restdaywedfin"=="$dateday") { $restdaysw=1;
			} else if("$restdaythufin"=="$dateday") { $restdaysw=1;
			} else if("$restdayfrifin"=="$dateday") { $restdaysw=1;
			} else if("$restdaysatfin"=="$dateday") { $restdaysw=1;
			} else {
			$restdaysw=0;
			} // if

			if($found19 == 1) {
			$timein = $cutstart." ".$att_checktime19;
			} else if($found18 == 1) {
			// prepare timein timeout
			// $timein = $cutstart." ".$shiftin18;
			$timein = $cutstart." "."00:00:00";
			} else {
			$timein = $cutstart." "."00:00:00";
			} // end if($found19 == 1)

			if($found20 == 1) {
			$timeout = $cutstart." ".$att_checktime20;
			} else if($found18 == 1) {
				if($found19==1) {
					$timeout = $cutstart." ".$shiftout18;
				} else {
					$timeout = $cutstart." "."00:00:00";
				} // if
			} else {
				if($found19==1) {
					$timeout = $cutstart." ".$shiftout18;
				} else {
					$timeout = $cutstart." "."00:00:00";
				} // if
			}

			if($projchgtyp15=='daily' && $projcode15!='') { $projcharge="$projcode15"; } else { $projcharge=''; }
			// insert query into tblhrtaemptimelog
			$res15binsert="INSERT INTO tblhrtaemptimelog SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", lastupdate=$loginid, employeeid=\"$employeeid15\", idpaygroup=$idhrtapaygrp, idcutoff=$idcutoff, cutstart=\"$cutstartori\", cutend=\"$cutend\", logdate=\"$cutstart\", timein=\"$timein\", timeout=\"$timeout\", otbeforeinsw=$allowotbfidflt15, otafteroutsw=$allowotdflt15, restdaysw=$restdaysw, nextdaysw=0, mealallowsw=0, leaveduration=0, totaltime=0, otval=0, utval=0, otutval=0, nightdiffval=0, projcharge=\"$projcharge\"";
			$result15b="";
			$result15b = mysql_query("$res15binsert", $dbh);

			// echo "$res15binsert|$dateday<br>";

			// increment date
			$cutstart = date("Y-m-d", strtotime("+1 day", strtotime($cutstart)));

			} // end while(strtotime($cutstart) <= strtotime($cutend))

			// echo "</p>";
			// reset variable
			$cutstart = $cutstartori;

			}
		} // end if($result15 != "")



		// create log
  	$result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
		while($myrow16 = mysql_fetch_row($result16))
		{ $adminuid=$myrow16[0]; }
		$adminlogdetails = "$loginid:$adminuid - add new cutoff for payroll system paygroupid:$idhrtapaygrp, paygroupname:$paygroupname12, $cutstart-to-$cutend";
		$result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

	// redirect
	header("Location: hrtimeattcutoff.php?loginid=$loginid&idpg=$idhrtapaygrp");
	exit;
	// echo "<p><a href=\"hrtimeattcutoff.php?loginid=$loginid&idpg=$idhrtapaygrp\">back</a></p>";
	}

// echo "<p>vartest in:$timein out:$timeout</p>";

} else {
     include ("logindeny.php");
}
mysql_close($dbh);
$dbh2->close();
?>
