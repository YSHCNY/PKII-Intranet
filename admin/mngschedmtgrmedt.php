<?php
//
// mngschedmtgrmedt.php //20200609
// fr mngschedulermtgrm.php
//

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$submmtgrmcodesw = (isset($_POST['submmtgrmcdsw'])) ? $_POST['submmtgrmcdsw'] :'';
$mtgrmcodeid = (isset($_POST['mtgrmcdid'])) ? $_POST['mtgrmcdid'] :'';
$idadmmtgrm = (isset($_POST['idadmschedmtg'])) ? $_POST['idadmschedmtg'] :'';
$submswadmschedmtgedt = (isset($_POST['submswadmschedmtgedt'])) ? $_POST['submswadmschedmtgedt'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

	//
	// Manage meeting room scheduler >> Edit
	//
	if($submswadmschedmtgedt=='submit' && $idadmmtgrm!='') {
		// query tbladmmtgrm
		$res10qry=""; $result10=""; $found10=0;
		$res10qry="SELECT topic, projcode, notes, datemeeting, timedurfrom, timedurto, fk_admctgmtgrm, eqptlst FROM tbladmmtgrm WHERE idadmmtgrm=$idadmmtgrm";
		$result10=$dbh2->query($res10qry);
		if($result10->num_rows>0) {
			while($myrow10=$result10->fetch_assoc()) {
				$found10=1;
				$topic10 = $myrow10['topic'];
				$projcode10 = $myrow10['projcode'];
				$notes10 = $myrow10['notes'];
				$datemeeting10 = $myrow10['datemeeting'];
				$timedurfrom10 = $myrow10['timedurfrom'];
				$timedurto10 = $myrow10['timedurto'];
				$fk_admctgmtgrm10 = $myrow10['fk_admctgmtgrm'];
    $eqptlst10 = $myrow10['eqptlst'];

				// break date and time of duration
				$timefromarr0 = split(' ', $timedurfrom10);
				$timefromarr0tm = $timefromarr0[1];
				$timefromarr = split(':', $timefromarr0tm);
				$timefromarrhh = $timefromarr[0];
				$timefromarrmm = $timefromarr[1];
				$timefromarrss = $timefromarr[2];
				$timefrom = "" . $timefromarrhh . ":" . $timefromarrmm . ":" . $timefromarrss ."";
				$timetoarr0 = split(' ', $timedurto10);
				$timetoarr0tm = $timetoarr0[1];
				$timetoarr = split(':', $timetoarr0tm);
				$timetoarrhh = $timetoarr[0];
				$timetoarrmm = $timetoarr[1];
				$timetoarrss = $timetoarr[2];
				$timeto = "" . $timetoarrhh . ":" . $timetoarrmm . ":" . $timetoarrss ."";
			} //while
		} //if
	echo "<form action=\"mngschedmtgrmedt2.php?loginid=$loginid\" method=\"post\" name=\"mngschedmtgrmedt2\">";
	echo "<input type='hidden' name='submmtgrmcdsw' value='$submmtgrmcodesw'>";
	// echo "<input type='hidden' name='mtgrmcdid' value='$mtgrmcodeid'>";
	echo "<input type='hidden' name='submmtgrmaddsw' value='$submmtgrmaddsw'>";
	echo "<input type='hidden' name='idadmmtgrm' value='$idadmmtgrm'>";
	echo "<table class='table'>";
	echo "<tr><th colspan='2'>Edit meeting room schedule</th></tr>";
	// meeting room selected
	echo "<tr><th class='text-right'>meeting room</th><td class='text-left'>";
	// echo "$name11b";
	echo "<div class='form-group'><select class='form-control' name=\"mtgrmcdid\">";
	// query tbladmctgmtgrm
	$res11qry=""; $result11=""; $found11=0; $ctr11=0;
	$res11qry="SELECT idadmctgmtgrm, name FROM tbladmctgmtgrm ORDER BY code ASC";
	$result11=$dbh2->query($res11qry);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11++;
			$idadmctgmtgrm11 = $myrow11['idadmctgmtgrm'];
			$name11 = $myrow11['name'];
			if($idadmctgmtgrm11==$mtgrmcodeid) {
				$mtgrmcdsel="selected";
			} else { $mtgrmcdsel=""; }
			echo "<option value='$idadmctgmtgrm11' $mtgrmcdsel>$name11</option>";
		} //while
	} //if
	echo "</select></div>";

	echo "</td></tr>";
	// date
	echo "<tr><th class='text-right'>date</th><td><div class='form-group'><input type='date' class='form-control' name='dtmtg' value='$datemeeting10'></div></td></tr>";
	// time duration
	echo "<tr><th class='text-right'>duration</th><td>";
	echo "<table border=0 spacing=0 cellspacing=0 cellpadding=0>";
	echo "<tr><th class='text-right'>from</th><td><div class='form-group'><input type='time' class='form-control' name='timestart' value='$timefrom'></div></td></tr>";
	echo "<tr><th class='text-right'>to</th><td><div class='form-group'><input type='time' class='form-control' name='timestop' value='$timeto'></div></td></tr>";
	echo "</table>";
	echo "</td></tr>";
	// project, query tblproject1 order by desc
	echo "<tr><th class='text-right'>project</th><td>";
	echo "<div class='form-group'><select class='form-control' name='projcode'>";
	if($projcode10=='') {
		$projcdsel="selected";
	echo "<option value='' $projcdsel>-</option>";		
	} else {
	echo "<option value=''>-</option>";				
	}
	$res12qry=""; $result12=""; $found12=0; $ctr12=0;
	$res12qry="SELECT DISTINCT proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projstatus='On-Going' ORDER BY proj_code DESC";
	$result12=$dbh2->query($res12qry);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
			$found12=1;
			$ctr12++;
			$proj_code12 = $myrow12['proj_code'];
			$proj_fname12 = $myrow12['proj_fname'];
			$proj_sname12 = $myrow12['proj_sname'];
			if($proj_code12==$projcode10) {
				$projcdsel="selected"; 
			} else {
				$projcdsel="";
			}
			echo "<option value='$proj_code12' $projcdsel>$proj_code12 - ";
			if($proj_sname12!='') { 
			echo "$proj_sname12";
			} else {
				echo "".substr($proj_fname12, 0, 40)."";
			} //if-else
			echo "</option>";

		} //while
	} //if

	echo "</select></div>";
	echo "</td></tr>";
	// topic
	echo "<tr><th class='text-right'>topic</th><td><div class='form-group'><input type='text' class='form-control' name='topic' placeholder='topic or title here' value=\"$topic10\"></div></td></tr>";

//20220104 insert Equipment needed checklist
    echo "<tr><th class='text-right'>equipment needed</th><td>";
    $res15query=""; $result15=""; $found15=0; $ctr15=0;
    $res15query="SELECT idadmctgmtgrmeqptlst, code, name, description FROM tbladmctgmtgrmeqptlst WHERE code<>'' ORDER BY code ASC";
    $result15=$dbh2->query($res15query);
    if($result15->num_rows>0) {
        while($myrow15=$result15->fetch_assoc()) {
        $found15=1;
        $idadmctgmtgreqptlst15 = $myrow15['idadmctgmtgrmeqptlst'];
        $code15 = $myrow15['code'];
        $name15 = $myrow15['name'];
        $description15 = $myrow15['description'];

    if(preg_match("/$code15/", "$eqptlst10")) {
    echo "<div class=\"input-group\">";
    echo "<input type=\"checkbox\" id=\"mtgrmeqptlst\" name=\"mtgrmeqptlst[]\" value=\"$code15\" checked readonly />";
    echo "<label class=\"checkbox-inline\" aria-describedby=\"$idadmctgmtgrmeqptlst15\" id=\"$idadmctgmtgrmeqptlst15\" for=\"mtgrmeqptlst\">$name15</label>";
    echo "</div>";
    } else {
    echo "<div class=\"input-group\">";
    echo "<input type=\"checkbox\" id=\"mtgrmeqptlst\" name=\"mtgrmeqptlst[]\" value=\"$code15\" />";
    echo "<label class=\"checkbox-inline\" aria-describedby=\"$idadmctgmtgrmeqptlst15\" id=\"$idadmctgmtgrmeqptlst15\" for=\"mtgrmeqptlst\">$name15</label>";
    echo "</div>";
    } //if-else

        } //while
    } //if
    // echo "<br>$res15query";
    echo "</td></tr>";
	echo "<tr><th class='text-right'>add'l notes</th><td><div class='form-group'><textarea rows='4' class='form-control' name='notes' placeholder='additional notes here'>$notes10</textarea></div></td></tr>";	
	echo "<tr><td></td><td>";
	echo "<button type='submit' class='btn btn-success' name='submmtgrmedt2sw' value='submit'>Save schedule</button>";
	echo "</td></tr>";
	echo "</form>";
	echo "</table>";

	} //if

    echo "<form action=\"mngschedulermtgrm.php?loginid=$loginid\" method=\"POST\" name=\"mngschedulermtgrm\">";
	echo "<input type='hidden' name='submmtgrmcdsw' value='$submmtgrmcodesw'>";
	echo "<input type='hidden' name='mtgrmcdid' value='$mtgrmcodeid'>";
	echo "<p><button type='submit' class='btn btn-default'>Back</button></p>";
	echo "</form>";

// end contents here
		$resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

// db close
$dbh2->close();
?>
