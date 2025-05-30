<?php 

//
// mngscheduler0.php //20200608
// fr sidebar.php
//

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$yrmonthavlbl = (isset($_POST['yrmonthavlbl'])) ? $_POST['yrmonthavlbl'] :'';
$submmtgrmcodesw = (isset($_POST['submmtgrmcdsw'])) ? $_POST['submmtgrmcdsw'] :'';
$mtgrmcodeid = (isset($_POST['mtgrmcdid'])) ? $_POST['mtgrmcdid'] :'';
$submmtgrmaddsw = (isset($_POST['submmtgrmaddsw'])) ? $_POST['submmtgrmaddsw'] :'';
$submmtgrmadd2sw = (isset($_POST['submmtgrmadd2sw'])) ? $_POST['submmtgrmadd2sw'] :'';
if($submmtgrmadd2sw=='submit') {
	// post vars
	
} //if

if($yrmonthavlbl == '') {
  $selyear = $yearnow;
  $selmonth = date("F", mktime(0, 0, 0, $monthnow));
  $yrmonthavlbl = $selyear." ".$selmonth;
} //if

$found = 0;
$accesslevel11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

	//
	// Manage scheduler
	//

	if($deptcd=='') {
		if($empdepartment0!='') {
			$deptcd=$empdepartment0;
		} // if($empdepartment0!='')
	} // if($deptcd=='')

	echo "<table class=\"table\">";

	echo "<tr><th colspan=\"2\">Meeting rooms scheduler</th></tr>";

    echo "<form action=\"mngschedulermtgrm.php?loginid=$loginid\" method=\"POST\" name=\"mngschedulermtgrm\">";
    // display dropdown
	echo "<tr><td colspan='2'>";
	echo "<div class='form-group'><select class='form-control' name=\"yrmonthavlbl\">";
    echo "<option>Year-Month</option>";
    $res11query = "SELECT DISTINCT DATE_FORMAT(datemeeting, '%Y %M') as yyyymonth FROM tbladmmtgrm ORDER BY datemeeting DESC";
    $result11=""; $found11=0; $ctr11=0;
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
      while($myrow11=$result11->fetch_assoc()) {
      $found11 = 1;
      $yyyymonth = $myrow11['yyyymonth'];
      if($yyyymonth == $yrmonthavlbl) { $yrmonthsel = "selected"; } else { $yrmonthsel = ""; }
      echo "<option value=\"$yyyymonth\" $yrmonthsel>$yyyymonth</option>";
      } // while($myrow11=$result11->fetch_assoc())
    } // if($result11->num_rows>0)
    echo "</select></div>";

    echo "<div class='form-group'><select class='form-control' name='mtgrmcdid' onchange=\"this.form.submit()\">";
	if($submmtgrmcodesw=='' || $mtgrmcodeid=='') {
		echo "<option value=''>select meeting room</option>";
	} //if
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
	if($mtgrmcodeid=='all') {
		$mtgrmcdallsel="selected"; $mtgrmcdsel="";
	} //if
	echo "<option value='all' $mtgrmcdallsel>ALL rooms</option>";
	echo "</select>";
	echo "<button type='submit' class='btn btn-primary' name='submmtgrmcdsw' value='submit'>Submit</button>";
	echo "</div>";
	echo "</td></tr>";
	echo "</form>";
	
	if($submmtgrmcodesw!='' || $mtgrmcodeid!='') {
		// query tbladmctgmtgrm
		$res11bqry=""; $result11b=""; $found11b=0;
		$res11bqry="SELECT code, name, description, remarks, filepath, filename FROM tbladmctgmtgrm WHERE idadmctgmtgrm=$mtgrmcodeid LIMIT 1";
		$result11b=$dbh2->query($res11bqry);
		if($result11b->num_rows>0) {
			while($myrow11b=$result11b->fetch_assoc()) {
				$found11b=1;
				$code11b = $myrow11b['code'];
				$name11b = $myrow11b['name'];
				$description11b = $myrow11b['description'];
				$remarks11b = $myrow11b['remarks'];
				$filepath11b = $myrow11b['filepath'];
				$filename11b = $myrow11b['filename'];

			} //while
		} //if
		if($found11b==1) {
			echo "<tr><th class='text-right'>name</th><th class='text-left'>$name11b</th></tr>";
			echo "<tr><th class='text-right'>desc</th><td>".nl2br($description11b)."</td></tr>";
		} //if
		
	} //if

	// display add button
	if($mtgrmcodeid!='') {
		if($submmtgrmaddsw=='' && $mtgrmcodeid!='all') {
	echo "<tr><td colspan='2'>";
	echo "<form action=\"mngschedulermtgrm.php?loginid=$loginid\" method=\"post\" name=\"mngschedmtgrmadd\">";
	echo "<input type='hidden' name='submmtgrmcdsw' value='$submmtgrmcodesw'>";
	echo "<input type='hidden' name='mtgrmcdid' value='$mtgrmcodeid'>";
	echo "<button type='submit' class='btn btn-primary' name='submmtgrmaddsw' value='submit'>Add new schedule</button>";
	echo "</form>";
	echo "</td></tr>";
	    } //if
	} //if

	
	if($submmtgrmaddsw=='submit') {
	echo "<form action=\"mngschedmtgrmadd.php?loginid=$loginid\" method=\"post\" name=\"mngschedmtgrmadd\">";
	echo "<input type='hidden' name='submmtgrmcdsw' value='$submmtgrmcodesw'>";
	echo "<input type='hidden' name='mtgrmcdid' value='$mtgrmcodeid'>";
	echo "<input type='hidden' name='submmtgrmaddsw' value='$submmtgrmaddsw'>";
	echo "<input type='hidden' name='idadmctgmtgrm' value='$mtgrmcodeid'>";
	echo "<tr><th colspan='2'>Add/reserve schedule</th></tr>";
	// meeting room selected
	// echo "<tr><th class='text-right'>meeting room</th><th class='text-left'>$name11b</td></tr>";
	// date
	echo "<tr><th class='text-right'>date</th><td><div class='form-group'><input type='date' class='form-control' name='dtmtg' value='$datenow'></div></td></tr>";
	// time duration
	echo "<tr><th class='text-right'>duration</th><td>";
	echo "<table border=0 spacing=0 cellspacing=0 cellpadding=0>";
	echo "<tr><th class='text-right'>from</th><td><div class='form-group'><input type='time' class='form-control' name='timestart' value='08:00:00'></div></td></tr>";
	echo "<tr><th class='text-right'>to</th><td><div class='form-group'><input type='time' class='form-control' name='timestop' value='09:00:00'></div></td></tr>";
	echo "</table>";
	echo "</td></tr>";
	// project, query tblproject1 order by desc
	echo "<tr><th class='text-right'>project</th><td>";
	echo "<div class='form-group'><select class='form-control' name='projcode'>";
	echo "<option value=''>-</option>";
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
			echo "<option value='$proj_code12'>$proj_code12 - ";
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
	echo "<tr><th class='text-right'>topic</th><td><div class='form-group'><input type='text' class='form-control' name='topic' placeholder='topic or title here'></div></td></tr>";

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

    echo "<div class=\"input-group\">";
    echo "<input type=\"checkbox\" id=\"mtgrmeqptlst\" name=\"mtgrmeqptlst[]\" value=\"$code15\" />";
    echo "<label class=\"checkbox-inline\" aria-describedby=\"$idadmctgmtgrmeqptlst15\" id=\"$idadmctgmtgrmeqptlst15\" for=\"mtgrmeqptlst\">$name15</label>";
    echo "</div>";

        } //while
    } //if
    // echo "<br>$res15query";
    echo "</td></tr>";

	echo "<tr><th class='text-right'>add'l notes</th><td><div class='form-group'><textarea rows='4' class='form-control' name='notes' placeholder='additional notes here'></textarea></div></td></tr>";	
	echo "<tr><td></td><td>";
	echo "<button type='submit' class='btn btn-success' name='submmtgrmadd2sw' value='submit'>Add new schedule</button>";
	echo "</td></tr>";
	echo "</form>";
	} //if

	echo "</table>";
// echo "<p>vartst cdsw:$submmtgrmcodesw, cdid:$mtgrmcodeid, f11b:$found11b</p>";

if($mtgrmcodeid!='') {
    if($submmtgrmaddsw=='') {
		echo "<table class='table table-striped'>";
		echo "<thead>";
		echo "<tr><th>ctr</th><th>date</th><th>duration</th><th>meeting rm</th><th>project</th><th>topic</th><th>eqpt need</th><th colspan='2'>action</th></tr>";
		echo "</thead><tbody>";
		// display list of entries based on meeting room
		$res14qry=""; $result14=""; $found14=0; $ctr14=0;
		if($mtgrmcodeid=='all') {
		$res14qry="SELECT tbladmmtgrm.idadmmtgrm, tbladmmtgrm.topic, tbladmmtgrm.projcode, tbladmmtgrm.notes, tbladmmtgrm.datemeeting, tbladmmtgrm.timedurfrom, tbladmmtgrm.timedurto, tbladmmtgrm.fk_admctgmtgrm, tbladmmtgrm.eqptlst, tbladmctgmtgrm.code, tbladmctgmtgrm.name FROM tbladmmtgrm LEFT JOIN tbladmctgmtgrm ON tbladmmtgrm.fk_admctgmtgrm=tbladmctgmtgrm.idadmctgmtgrm WHERE DATE_FORMAT(tbladmmtgrm.datemeeting, '%Y %M') = \"$yrmonthavlbl\" ORDER BY tbladmmtgrm.datemeeting DESC, tbladmmtgrm.timedurfrom DESC";
		} else {
		$res14qry="SELECT tbladmmtgrm.idadmmtgrm, tbladmmtgrm.topic, tbladmmtgrm.projcode, tbladmmtgrm.notes, tbladmmtgrm.datemeeting, tbladmmtgrm.timedurfrom, tbladmmtgrm.timedurto, tbladmmtgrm.fk_admctgmtgrm, tbladmmtgrm.eqptlst, tbladmctgmtgrm.code, tbladmctgmtgrm.name FROM tbladmmtgrm LEFT JOIN tbladmctgmtgrm ON tbladmmtgrm.fk_admctgmtgrm=tbladmctgmtgrm.idadmctgmtgrm WHERE tbladmmtgrm.fk_admctgmtgrm=$mtgrmcodeid AND DATE_FORMAT(tbladmmtgrm.datemeeting, '%Y %M') = \"$yrmonthavlbl\" ORDER BY tbladmmtgrm.datemeeting DESC, tbladmmtgrm.timedurfrom DESC";			
		} //if-else
		$result14=$dbh2->query($res14qry);
		if($result14->num_rows>0) {
			while($myrow14=$result14->fetch_assoc()) {
				$found14=1;
				$ctr14++;
				$idadmmtgrm14 = $myrow14['idadmmtgrm'];
				$topic14 = $myrow14['topic'];
				$projcode14 = $myrow14['projcode'];
				$notes14 = $myrow14['notes'];
				$datemeeting14 = $myrow14['datemeeting'];
				$timedurfrom14 = $myrow14['timedurfrom'];
				$timedurto14 = $myrow14['timedurto'];
				$fk_admctgmtgrm14 = $myrow14['fk_admctgmtgrm'];
    $eqptlst14 = $myrow14['eqptlst'];
				$code14 = $myrow14['code'];
				$name14 = $myrow14['name'];
				// query projname
				$res14bqry=""; $result14b=""; $found14b=0;
				if($projcode14!='') {
				$res14bqry="SELECT proj_sname, proj_fname FROM tblproject1 WHERE proj_code=\"$projcode14\"";
				$result14b=$dbh2->query($res14bqry);
				if($result14b->num_rows>0) {
					while($myrow14b=$result14b->fetch_assoc()) {
						$found14b=1;
				$proj_sname14b = $myrow14b['proj_sname'];
				$proj_fname14b = $myrow14b['proj_fname'];
				if($proj_sname14b=='') {
					$projnamefin="".substr($proj_fname14b, 0, 30)."";
				} else {
					$projnamefin=$proj_sname14b;
				} //if-else						
					} //while
				} //if
				} //if
				echo "<tr>";
				echo "<td>$ctr14</td><td>".date('D Y-M-d', strtotime($datemeeting14))."</td><td>".date('g:ia', strtotime($timedurfrom14))." to ".date('g:ia', strtotime($timedurto14))."</td><td>$name14</td><td>$projnamefin</td><td>$topic14</td>";

    //20220104 display column for list of eqpt needed
echo "<td>";
    $res16query=""; $result16=""; $found16=0; $ctr16=0;
    $res16query="SELECT idadmctgmtgrmeqptlst, code, name FROM tbladmctgmtgrmeqptlst WHERE code<>''";
    $result16=$dbh2->query($res16query);
    if($result16->num_rows>0) {
        while($myrow16=$result16->fetch_assoc()) {
        $found16=1;
        $idadmctgmtgrmeqptlst16 = $myrow16['idadmctgmtgrmeqptlst'];
        $code16 = $myrow16['code'];
        $name16 = $myrow16['name'];
        if(preg_match("/$code16/", "$eqptlst14")) {
        echo "$name16<br>";
        } //if
        } //while
    } //if
echo "</td>";

				echo "<form action=\"mngschedmtgrmedt.php?loginid=$loginid\" method=\"POST\" name=\"mngschedmtgrmedt\">";
				echo "<input type='hidden' name='submmtgrmcdsw' value='$submmtgrmcodesw'>";
				echo "<input type='hidden' name='mtgrmcdid' value='$mtgrmcodeid'>";
				echo "<input type='hidden' name='idadmschedmtg' value='$idadmmtgrm14'>";
				echo "<td><button type='submit' class='btn btn-warning btn-sm' name='submswadmschedmtgedt' value='submit'>edit</button></td>";
				echo "</form>";
				echo "<form action=\"mngschedmtgrmdel.php?loginid=$loginid\" method=\"POST\" name=\"mngschedmtgrmedt\">";
				echo "<input type='hidden' name='submmtgrmcdsw' value='$submmtgrmcodesw'>";
				echo "<input type='hidden' name='mtgrmcdid' value='$mtgrmcodeid'>";
				echo "<input type='hidden' name='idadmschedmtg' value='$idadmmtgrm14'>";
				echo "<td><button type='submit' class='btn btn-danger btn-sm' name='submswadmschedmtgdel' value='submit'>del</button></td>";
				echo "</form>";
				echo "</tr>";
				// reset vars
				$projnamefin="";

			} //while
		} //if
		echo "</tbody>";
		echo "</table>";
	} //if
} //if
	echo "<p><a href=\"mngscheduler0.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

// end contents here
		$resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
