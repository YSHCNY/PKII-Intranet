<?php 

require('./db1.php');
require('./db24.php');
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$startsw = (isset($_POST['startsw'])) ? $_POST['startsw'] :'';
$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Manage >> HR Modules >> Sync db24 to emppayroll</font></p>";

// start contents here...
  if($accesslevel >= 4)
  {

		echo "<p><form action=\"mnghrsyncdb24.php?loginid=$loginid\" method=\"post\"><input type=\"hidden\" name=\"startsw\" value=\"1\"><input type=submit value=\"Press to start\"></form></p>";

		if($startsw == 1) {
		echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><th></th><th colspan=\"5\">att</th><th>vs</th><th colspan=\"8\">maindb</th><th>status</th></tr>";
		// display header
		echo "<tr><th>ctr</th><th>userid</th><th>checktime</th><th>checktype</th><th>verifycode</th><th>sensorid</th><th>&nbsp;</th><th>id</th><th>timestamp</th><th>loginid</th><th>userid</th><th>checktime</th><th>checktype</th><th>verifycode</th><th>sensorid</th><th></th></tr>";
		// query db24
		$result11=""; $found11=0; $ctr11=0;
		$res11query="SELECT emp_no, emp_salary, deduction, phil_ded, tax, emp_over_duration, Net_Pay, emp_date_wrk, emp_sick, emp_vacation, cut_start, cut_end, regHoliday, speHoliday, emp_late_duration, otSunday, regHolidayamt, SpeHolidayamt, otSundayamt, overamt, NigthDiffMinutes, NIgthDiffAmt, TotalTardy, OtherIncome, OtherIncomeTaxable, OtherDeduction, emp_dep, pagibig, VLused, SLUsed, PHILEMP, SS, EC, bracket, AbsentAmt FROM db24";
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch-assoc()) {
				$found11=1;
				$ctr11 = $ctr11+1;
			} // while
		} // if
		$result11 = mysql_query("SELECT USERID, CHECKTIME, CHECKTYPE, VERIFYCODE, SENSORID FROM CHECKINOUT WHERE USERID<>'' ORDER BY CHECKTIME ASC", $dbh2b);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$USERID11 = $myrow11[0];
			$CHECKTIME11 = $myrow11[1];
			$CHECKTYPE11 = $myrow11[2];
			$VERIFYCODE11 = $myrow11[3];
			$SENSORID11 = $myrow11[4];

			$ctr11 = $ctr11 + 1;

			echo "<tr><td>$ctr11</td><td>$USERID11</td><td>$CHECKTIME11</td><td>$CHECKTYPE11</td><td>$VERIFYCODE11</td><td>$SENSORID11</td>";
			echo "<td></td>";

			$result12=""; $found12=0;
			$result12 = mysql_query("SELECT hrattcheckinoutid, timestamp, loginid, att_userid, att_checktime, att_checktype, att_verifycode, att_sensorid FROM tblhrattcheckinout WHERE att_userid=$USERID11 AND att_checktime=\"$CHECKTIME11\" AND att_checktype=\"$CHECKTYPE11\"", $dbh);
			if($result12 != "") {
				while($myrow12 = mysql_fetch_row($result12)) {
				$found12 = 1;
				$hrattcheckinoutid12 = $myrow12[0];
				$timestamp12 = $myrow12[1];
				$loginid12 = $myrow12[2];
				$att_userid12 = $myrow12[3];
				$att_checktime12 = $myrow12[4];
				$att_checktype12 = $myrow12[5];
				$att_verifycode12 = $myrow12[6];
				$att_sensorid12 = $myrow12[7];
				}
			}

			if($found12 == 1) {
				echo "<td>$hrattcheckinoutid12</td><td>$timestamp12</td><td>$loginid12</td>";
				echo "<td>$att_userid12</td><td>$att_checktime12</td><td>$att_checktype12</td><td>$att_verifycode12</td><td>$att_sensorid12</td>";
				echo "<td>record exists</td>";
			} else if($found12 == 0) {
				$result14 = mysql_query("INSERT INTO tblhrattcheckinout SET timestamp=\"$now\", loginid=$loginid, att_userid=$USERID11, att_checktime=\"$CHECKTIME11\", att_checktype=\"$CHECKTYPE11\", att_verifycode=$VERIFYCODE11, att_sensorid=\"$SENSORID11\"", $dbh);
				echo "<td colspan=\"3\"></td>";
				echo "<td colspan=\"5\"></td>";
				echo "<td><font color=\"green\">inserted</font></td>";
			}

			echo "</tr>";
			}
		}
		echo "</table>";


		// check time log
	// $res12query="select * from tblhrtalvreq where loginid=$loginid, timestamp=\"$now\", datecreated=\"$now\", createdby=\"$loginid\", 
	// datelvreq='".$dateapplic."', 
	// durationfrom='".$startdate."',
	// durationto='".$enddate."',
	// daysapproved='".$daysapproved."',
	// requestorid='".$loginid."',
	// employeeid='".$requestorempid."',
	// deptcd='".$deptcd."',
	// reason='".$details."',
	// requestctr='".$requestctr."',
	// requeststamp='".$now."',
	// approvectr='".$approvectr."',
	// approvestamp='".$approvestamp."',
	// approverid='".$approverid."',
	// approverempid='".$approver."',
	// notedctr='".$notedctr."',
	// notedstamp='".$notedstamp."',
	// notedbyid='".$notedbyid."',
	// notedbyempid='".$notedbyempid."',
	// comments='".$comments."',
	// statusta=0,
	// idhrtacutoff='".$idHrCutoff."',
	// idhrtaleavectg='".$idleavectg."'";
/*
		echo "<br>";
		echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><th>ctr</th><th>userid</th><th>badgenum</th><th>name</th><th>sex</th><th>title</th><th></th><th>empid</th><th>lastname</th><th>firstname</th><th>middle</th><th>status</th></tr>";
		$result15=""; $found15=0;
		$result15 = mysql_query("SELECT USERID, Badgenumber, Name, Gender, TITLE FROM USERINFO WHERE USERID<>'' ORDER BY Badgenumber ASC", $dbh2);
		if($result15 != "") {
			while($myrow15 = mysql_fetch_row($result15)) {
			$found15 = 1;
			$USERID15 = $myrow15[0];
			$Badgenumber15 = $myrow15[1];
			$Name15 = $myrow15[2];
			$Gender15 = $myrow15[3];
			$TITLE15 = $myrow15[4];

			$ctr15 = $ctr15 + 1;

			echo "<tr><td>$ctr15</td><td>$USERID15</td><td>$Badgenumber15</td><td>$Name15</td><td>$Gender15</td><td>$TITLE15</td><td></td>";

			echo "</tr>";
			}
		}
		echo "</table>";
*/

		}

  }

// end contents here...

// edit body-footer
    echo "<p><a href=\"mnghrmod.php?loginid=$loginid\">Back</a></p>";

    $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);	 

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
$dbh24->close();
?> 
