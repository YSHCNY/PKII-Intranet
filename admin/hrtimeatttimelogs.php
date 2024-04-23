<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$idcutoff0 = (isset($_GET['idct'])) ? $_GET['idct'] :'';
$employeeid0 = (isset($_GET['eid'])) ? $_GET['eid'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$idcutoff =  (isset($_POST['idcutoff'])) ? $_POST['idcutoff'] :'';
$employeeid = (isset($_POST['empid'])) ? $_POST['empid'] :'';

if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($idcutoff0 != "") { $idcutoff=$idcutoff0; }
if($employeeid0 != "") { $employeeid=$employeeid0; }

// echo "<p>vartest idpg:$idpaygroup, empid:$employeeid</p>";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}
// echo "<p>vartest idpg:$idpaygroup, empid:$employeeid</p>";

if($found == 1) {
?>
<script type="text/javascript" language="JavaScript">
function toggle(source) {
  checkboxesnf = document.getElementsByName('nofindings[]');
  for(var i=0, n=checkboxesnf.length; i<n; i++) {
    checkboxesnf[i].checked = source.checked;
  }
}



/* function enableDisableAll() {
	// var myStringArray = ["Hello","World"];
	var cbm = [];
	var checkboxManual = [];
	var timetotal = [];
	var otutval = [];
	var nightdiffval = [];
	var arrayLength = cbm.length;
	var i2;
	for (i2 = 0; i2 < arrayLength; i2++) {
    // alert(myStringArray[i]);
		cbm = document.getElementById('checkboxManual').checked;
	  document.getElementById('timetotal').disabled = !cbm;
	  document.getElementById('otutval').disabled = !cbm;
	  document.getElementById('nightdiffval').disabled = !cbm;
    //Do something
	}
	// cbm = document.getElementById('checkboxManual').checked;
  // document.getElementById('timetotal').disabled = !cbm;
  // document.getElementById('valotut').disabled = !cbm;
  // document.getElementById('valnightdiff').disabled = !cbm;
} */

// function toggle(checkboxmanID, inputfieldsID) {
//      var checkboxman = document.getElementById('checkboxmanID');
//      var inputfields = document.getElementById('inputfieldsID');
//      updateToggle = checkboxman.checked ? toggle.disabled=false : toggle.disabled=true;
// }

/* function active()
{
	var checkboxManual = [];
	var timetotal = [];
	var otutval = [];
	var nightdiffval = [];
	// checkboxman = document.getElementById('checkboxManual[]');
	// for(var i=0, n=document.getElementById('checkboxManual[]').length; i<n; i++) {
  if(document.getElementById('checkboxManual').checked) {
     document.getElementById('timetotal').disabled=false;
     document.getElementById('otutval').disabled=false;
     document.getElementById('nightdiffval').disabled=false;
  } else {
     document.getElementById('timetotal').disabled=true;
     document.getElementById('otutval').disabled=true;
     document.getElementById('nightdiffval').disabled=true;
	}
	// }
} */
</script>
<?php
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Modules >> Time and Attendance >> Time log</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

  echo "<tr><td colspan=\"2\">";

  if($accesslevel >= 3)
  {
	echo "<table class=\"fin\" border=\"0\">";
	echo "<tr>";
		echo "<form action=\"hrtimeatttimelogs.php?loginid=$loginid\" method=\"post\" name=\"modhrtatimelog\">";

		// pay group name dropdown
    echo "<td><select name=\"idpaygroup\" onchange=\"this.form.submit()\">";
		if($idpaygroup == "") {
		echo "<option value=''>select paygroup</option>";
		}
		$res11query = "SELECT idtblhrtapaygrp, paygroupname FROM tblhrtapaygrp ORDER BY timestamp DESC";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$idtblhrtapaygrp11 = $myrow11['idtblhrtapaygrp'];
			$paygroupname11 = $myrow11['paygroupname'];
			if($idtblhrtapaygrp11 == $idpaygroup) { $idpaygrpsel="selected"; } else { $idpaygrpsel=""; }
			echo "<option value=\"$idtblhrtapaygrp11\" $idpaygrpsel>$paygroupname11</option>";
			}
		}
		echo "</select></td>";

		// cut-off period dropdown
		echo "<td><select name=\"idcutoff\" onchange=\"this.form.submit()\">";
		if($idcutoff == "") {
		echo "<option value=''>select cutoff</option>";
		}
		$res15query = "SELECT idhrtacutoff, cutstart, cutend, paygroupname, remarks FROM tblhrtacutoff WHERE idhrtapaygrp=$idpaygroup AND status=1 ORDER BY cutstart DESC";
		$result15=""; $found15=0; $ctr15=0;
		$result15 = $dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15 = $result15->fetch_assoc()) {
			$found15 = 1;
			$idhrtacutoff15 = $myrow15['idhrtacutoff'];
			$cutstart15 = $myrow15['cutstart'];
			$cutend15 = $myrow15['cutend'];
			$paygroupname15 = $myrow15['paygroupname'];
			$remarks15 = $myrow15['remarks'];
			$ctr15 = $ctr15 + 1;
			if($idhrtacutoff15 == $idcutoff) { $idcutoffsel="selected"; } else { $idcutoffsel=""; }
			echo "<option value=\"$idhrtacutoff15\" $idcutoffsel>$cutstart15-to-$cutend15</option>";
			}
		}
		echo "</select></td>";

		// individual personnel dropdown
		if($idpaygroup != "" && $idcutoff != "") {
		echo "<td>";
		echo "<select name=\"empid\" onchange=\"this.form.submit()\">";
		echo "<option value=''>select personnel</option>";
		$res12query="SELECT DISTINCT tblhrtaemptimelog.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrtaemptimelog LEFT JOIN tblcontact ON tblhrtaemptimelog.employeeid=tblcontact.employeeid WHERE tblhrtaemptimelog.idcutoff=$idcutoff AND tblhrtaemptimelog.idpaygroup=$idpaygroup AND tblcontact.contact_type=\"personnel\" ORDER BY tblhrtaemptimelog.employeeid ASC";
		$result12=""; $found12=0;
		$result12 = $dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12 = $result12->fetch_assoc()) {
			$found12 = 1;
			$employeeid12 = $myrow12['employeeid'];
			$name_last12 = $myrow12['name_last'];
			$name_first12 = $myrow12['name_first'];
			$name_middle12 = $myrow12['name_middle'];
			if($employeeid12 == $employeeid) { $empidsel="selected"; } else { $empidsel=""; }
			echo "<option value=\"$employeeid12\" $empidsel>$employeeid12 - $name_last12, $name_first12 $name_middle12[0]</option>";
			}
		}
		echo "</select>";
		echo "</td>";
		} // if($idpaygroup != "" && $idcutoff != "")

		// submit button
		echo "<td>";
		// echo "<input type=\"submit\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\">Submit</button>";
    echo "</td>";

		echo "</form>";
	echo "</tr>";
	echo "</table>";
  } // endif accesslevel >= 4

  echo "</td></tr>";

	//
	// display individual info based on selected dropdown personnel
	//
	if($employeeid != "") {

	// query tblemppaycutoff for processed cutoff if exists, provide warning and redirect button to summary page of TA
	$res17query="SELECT idemppaycutoff FROM tblemppaycutoff WHERE idhrtapaygrp=$idpaygroup AND idhrtacutoff=$idcutoff";
	$result17=""; $found17=0; $ctr17=0;
	$result17=$dbh2->query($res17query);
	if($result17->num_rows>0) {
		while($myrow17=$result17->fetch_assoc()) {
		$found17=1;
		$idemppaycutoff=$myrow17['idemppaycutoff'];
		} // while
	} // if

	//
	if($found17==1) {

	// redirect button
	echo "<form action=\"hrtimeattsumm.php?loginid=$loginid\" method=\"POST\" name=\"hrtimattsumm.php\">";
	$disptyp="summary";
	echo "<input type=\"hidden\" name=\"idpaygroup\" value=\"$idpaygroup\">";
	echo "<input type=\"hidden\" name=\"idcutoff\" value=\"$idcutoff\">";
	echo "<input type=\"hidden\" name=\"disptyp\" value=\"$disptyp\">";
	echo "<tr><td colspan=\"2\">";
	echo "<h3 class='text-danger'>This cut-off period is already processed. Please click the 'Show summary' button for you to be redirected.</h3>";
	echo "<p><button type=\"submit\" class=\"btn btn-primary\">Show summary</button></p>";
	echo "</td></tr>";
	echo "</form>";

	//
	} else {
	// continue display time logs

	echo "<tr><td colspan=\"2\">";
	echo "<table id='tbltimelogs' width=\"100%\" class=\"fin\">";
	// query cutstart and cutend
	$res16query = "SELECT cutstart, cutend FROM tblhrtacutoff WHERE idhrtacutoff=$idcutoff";
	$result16=""; $found16=0; $ctr16=0;
	$result16 = $dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16 = $result16->fetch_assoc()) {
		$found16 = 1;
		$cutstart16 = $myrow16['cutstart'];
		$cutend16 = $myrow16['cutend'];
		$cutstart = $cutstart16;
		$cutend = $cutend16;
		} // while($myrow16 = $result16->fetch_assoc())
	} // if($result16->num_rows>0)
	// query personnel
	$res14query = "SELECT tblhrtapaygrpemplst.idhrtapaygrpemplst, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblhrtapayshiftctg.shiftin, tblhrtapayshiftctg.shiftout, tblhrtapaygrpemplst.restday, tblhrtapaygrpemplst.allowotdflt FROM tblhrtapaygrpemplst LEFT JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid LEFT JOIN tblhrtapayshiftctg ON tblhrtapaygrpemplst.idhrtapayshiftctg=tblhrtapayshiftctg.idhrtapayshiftctg WHERE tblhrtapaygrpemplst.employeeid=\"$employeeid\" AND tblcontact.contact_type=\"personnel\"";
	$result14=""; $found14=0;
	$result14 = $dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14 = $result14->fetch_assoc()) {
		$found14 = 1;
		$idhrtapaygrpemplst14 = $myrow14['idhrtapaygrpemplst'];
		$name_last14 = $myrow14['name_last'];
		$name_first14 = $myrow14['name_first'];
		$name_middle14 = $myrow14['name_middle'];
		$shiftin14 = $myrow14['shiftin'];
		$shiftout14 = $myrow14['shiftout'];
		$restday14 = $myrow14['restday'];
		$allowotdflt14 = $myrow14['allowotdflt'];
		} // while($myrow14 = $result14->fetch_assoc())
	} // if($result14->num_rows>0)
	echo "<tr>";
	echo "<th colspan=\"19\">Details for $employeeid&nbsp;-&nbsp;".strtoupper($name_last14).",&nbsp;".strtoupper($name_first14)."&nbsp;".strtoupper($name_middle14)."</th>";
	echo "</tr>";

	echo "<form action=\"hrtimeatttimelogupd2.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff\" method=\"post\" id=\"modhrtatimelogUpd\" name=\"modhrtatimelogupd\">";
	echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"idhrtapaygrpemplst\" value=\"$idhrtapaygrpemplst14\">";

	// display labels
	echo "<tr><th colspan=\"2\">date</th><th>day type</th><th>pref. time</th><th colspan=\"3\">time in</th><th>allow OT before preferred timein</th><th colspan=\"3\">time out</th><th>total time</th><th>allow OT</th><th>next day</th><th>meal allowance</th><th>leave type</th><th>leave duration</th>";
	// query projchgtyp if daily then display column header
	$res24query = "SELECT tblhrtapaygrpemplst.projchgtyp FROM tblhrtapaygrpemplst LEFT JOIN tblhrtaemptimelog ON  tblhrtapaygrpemplst.employeeid=tblhrtaemptimelog.employeeid WHERE tblhrtapaygrpemplst.employeeid=\"$employeeid\" AND tblhrtaemptimelog.idpaygroup=$idpaygroup";
	$result24=""; $found24=0; $ctr24=0;
	$result24 = $dbh2->query($res24query);
	if($result24->num_rows>0) {
		while($myrow24 = $result24->fetch_assoc()) {
		$found24 = 1;
		$projchgtyp24 = $myrow24['projchgtyp'];
		} // while($myrow24 = $result24->fetch_assoc())
	} // if($result24->num_rows>0)
	if($projchgtyp24 == "daily") {
	echo "<th>project charge</th>";
	} // if($projchgtyp24 == "daily")
	// echo "<th>project charge</th>";

	echo "<th>manual</th>";
	echo "<th>Overtime</th>";
	echo "<th>Undertime</th>";
	echo "<th>ot/(ut)</th><th>nightdiff</th>";
	echo "<th>No findings<br><input type=\"checkbox\" name=\"nofindings\" onClick=\"toggle(this)\">All</th>";
	echo "<th>remarks</th></tr>";

	// generate dates
	while(strtotime($cutstart16) <= strtotime($cutend16)) {
		echo "<input type=\"hidden\" name=\"cutstart[]\" value=\"$cutstart16\">";

		// query emptimelog details if exists
		// $res20query = "SELECT tblhrtaemptimelog.idhrtaemptimelog, tblhrtaemptimelog.cutstart, tblhrtaemptimelog.cutend, tblhrtaemptimelog.timein, tblhrtaemptimelog.timeout, tblhrtaemptimelog.otbeforeinsw, tblhrtaemptimelog.otafteroutsw, tblhrtaemptimelog.restdaysw, tblhrtaemptimelog.nextdaysw, tblhrtaemptimelog.mealallowsw, tblhrtaemptimelog.leavetype, tblhrtaemptimelog.leaveduration, tblhrtaemptimelog.manualcompsw, tblhrtaemptimelog.totaltime, tblhrtaemptimelog.otval, tblhrtaemptimelog.utval, tblhrtaemptimelog.otutval, tblhrtaemptimelog.nightdiffval, tblhrtaemptimelog.nootsw, tblhrtaemptimelog.noutsw, tblhrtaemptimelog.projcharge, tblhrtaemptimelog.projpercent, tblhrtaemptimelog.remarks, tblhrtaemptimelog.nofindings, tblhrtapaygrpemplst.idhrtapayshiftctg, tblhrtapaygrpemplst.projcode, tblhrtapaygrpemplst.projchgtyp, tblhrtapayshiftctg.shiftin, tblhrtapayshiftctg.shiftout FROM tblhrtaemptimelog INNER JOIN tblhrtapaygrpemplst ON tblhrtaemptimelog.employeeid=tblhrtapaygrpemplst.employeeid INNER JOIN tblhrtapayshiftctg ON tblhrtapaygrpemplst.idtblhrtapaygrp=tblhrtapayshiftctg.idhrtapayshiftctg WHERE tblhrtaemptimelog.employeeid=\"$employeeid\" AND tblhrtaemptimelog.idpaygroup=$idpaygroup AND tblhrtaemptimelog.idcutoff=$idcutoff AND tblhrtaemptimelog.logdate=\"$cutstart16\"";
		$res20query = "SELECT tblhrtaemptimelog.idhrtaemptimelog, tblhrtaemptimelog.idpaygroup, tblhrtaemptimelog.cutstart, tblhrtaemptimelog.cutend, tblhrtaemptimelog.timein, tblhrtaemptimelog.timeout, tblhrtaemptimelog.otbeforeinsw, tblhrtaemptimelog.otafteroutsw, tblhrtaemptimelog.restdaysw, tblhrtaemptimelog.nextdaysw, tblhrtaemptimelog.mealallowsw, tblhrtaemptimelog.leavetype, tblhrtaemptimelog.leaveduration, tblhrtaemptimelog.manualcompsw, tblhrtaemptimelog.totaltime, tblhrtaemptimelog.otval, tblhrtaemptimelog.utval, tblhrtaemptimelog.otutval, tblhrtaemptimelog.nightdiffval, tblhrtaemptimelog.nootsw, tblhrtaemptimelog.noutsw, tblhrtaemptimelog.projcharge, tblhrtaemptimelog.projpercent, tblhrtaemptimelog.remarks, tblhrtaemptimelog.nofindings, tblhrtapaygrpemplst.idhrtapayshiftctg, tblhrtapaygrpemplst.projcode, tblhrtapaygrpemplst.projchgtyp FROM tblhrtaemptimelog LEFT JOIN tblhrtapaygrpemplst ON tblhrtaemptimelog.employeeid=tblhrtapaygrpemplst.employeeid WHERE tblhrtaemptimelog.employeeid=\"$employeeid\" AND tblhrtapaygrpemplst.idtblhrtapaygrp=$idpaygroup AND tblhrtaemptimelog.idcutoff=$idcutoff AND tblhrtaemptimelog.logdate=\"$cutstart16\"";
		$result20=""; $found20=0; $ctr20=0;
		$result20 = $dbh2->query($res20query);
		if($result20->num_rows>0) {
			while($myrow20 = $result20->fetch_assoc()) {
			$found20 = 1;
			$idhrtaemptimelog20 = $myrow20['idhrtaemptimelog'];
			$idpaygroup20 = $myrow20['idpaygroup'];
			$cutstart20 = $myrow20['cutstart'];
			$cutend20 = $myrow20['cutend'];
			$timein20 = $myrow20['timein'];
			$timeout20 = $myrow20['timeout'];
			$otbeforeinsw20 = $myrow20['otbeforeinsw'];
			$otafteroutsw20 = $myrow20['otafteroutsw'];
			$restdaysw20 = $myrow20['restdaysw'];
			$nextdaysw20 = $myrow20['nextdaysw'];
			$mealallowsw20 = $myrow20['mealallowsw'];
			$leavtype20 = $myrow20['leavetype'];
			$leaveduration20 = $myrow20['leaveduration'];
			$manualcompsw20 = $myrow20['manualcompsw'];
			$totaltime20 = $myrow20['totaltime'];
			$otval20 = $myrow20['otval'];
			$utval20 = $myrow20['utval'];
			$otutval20 = $myrow20['otutval'];
			$nightdiffval20 = $myrow20['nightdiffval'];
			$nootsw20 = $myrow20['nootsw'];
			$noutsw20 = $myrow20['noutsw'];
			$projcharge20 = $myrow20['projcharge'];
			$projpercent20 = $myrow20['projpercent'];
			$remarks20 = $myrow20['remarks'];
			$nofindings20 = $myrow20['nofindings'];
			$idhrtapayshiftctg20 = $myrow20['idhrtapayshiftctg'];
			$projcode20 = $myrow20['projcode'];
			$projchgtyp20 = $myrow20['projchgtyp'];
			// $shiftin20 = $myrow20['shiftin'];
			// $shiftout20 = $myrow20['shiftout'];
			echo "<input type=\"hidden\" name=\"idhtlog[]\" value=\"$idhrtaemptimelog20\">";
			} // while($myrow20 = $result20->fetch_assoc())
		} // if($result20->num_rows>0)



		// query preferred time shift
		if($idhrtapayshiftctg20!='') {
		$res20bquery="SELECT shiftin, shiftout FROM tblhrtapayshiftctg WHERE idhrtapayshiftctg=$idhrtapayshiftctg20";
		$result20b=""; $found20b=1; $ctr20b=0;
		$result20b=$dbh2->query($res20bquery);
		if($result20b->num_rows>0) {
			while($myrow20b=$result20b->fetch_assoc()) {
			$found20b=1;
			$shiftin20=$myrow20b['shiftin'];
			$shiftout20=$myrow20b['shiftout'];
			} // while
		} // if
		} else { // if($idhrtapayshiftctg20!='')
		$shiftin20="";
		$shiftout20="";
		} // if($idhrtapayshiftctg20!='')

		// below lines for testing only
		// echo "<tr><td colspan=\"19\">";
		// echo "res20qry:$res20query";
		// echo "<br>";
		// echo "res20bqry:$idhrtapayshiftctg20|$res20bquery";
		// echo "</td></tr>";

		echo "<tr>";
		// check for holidays
		$cutstartfin=$cutstart16;
		include './hrtimeattqryholiday.php';
	
		$dateval=date("Y-M-d", strtotime($cutstart16));
		$datevalue1=date("Y-m-d 00:00:00", strtotime($cutstart16));
		$dateday=date("D", strtotime($cutstart16));

		$leave = 0;
		$leavedate1001 = '';
		$leavetype1001 = '';
		$otreqdate = '';
		$resquery1001 = "SELECT * FROM tblhrtalvreq LEFT JOIN tblhrtaleavectg ON tblhrtalvreq.idhrtaleavectg = tblhrtaleavectg.idhrtaleavectg WHERE employeeid = '".$employeeid."' AND '".$datevalue1."' BETWEEN durationfrom AND durationto AND statusta = 3";
		$result1001 = $dbh2->query($resquery1001);
		if($result1001->num_rows>0) {
			while($myrow1001 = $result1001->fetch_assoc()) {
				$leavetype1001 = $myrow1001['name'];
				$leavedate1001 = $dateval;
			}
		}

		$resquery1002 = "SELECT * FROM tblhrtaotreq WHERE employeeid = '".$employeeid."' AND dateotreq = '".$datevalue1."' AND statusta = 3";
		$result1002 = $dbh2->query($resquery1002);
		if($result1002->num_rows>0) {
			while($myrow1002 = $result1002->fetch_assoc()) {
				$otreqdate = $dateval;
			}
		}



		if($found21 == 1 || $dateday == "Sun") {
			if($holidaytype21 != "shortened") {
				echo "<td><font color=\"red\">$dateval</font></td><td align=\"center\"><font color=\"red\">$dateday</font></td>";
			} else {
				echo "<td>$dateval</td><td align=\"center\">$dateday</td>";
			}
		} else {
		echo "<td>$dateval</td><td align=\"center\">$dateday</td>";
		} // if($found21 == 1 || $dateday == "Sun")

		// rest day
		include './hrtimeattqryrestday.php';
		
		// display day type
		if($found21 == 1) {
				echo "<td><font color=\"red\">$holidayname21<br>$holidaytype21&nbsp;holiday</font></td>";
			echo "<input type=\"hidden\" name=\"restdaysw[]\" value=\"0\">";
		} else if($dateday==$restdaysunfin || $dateday==$restdaymonfin || $dateday==$restdaytuefin || $dateday==$restdaywedfin || $dateday==$restdaythufin || $dateday==$restdayfrifin || $dateday==$restdaysatfin) {
			echo "<td>rest&nbsp;day</td>";
			echo "<input type=\"hidden\" name=\"restdaysw[]\" value=\"1\">";
		} else {
			echo "<td>regular&nbsp;day</td>";
			echo "<input type=\"hidden\" name=\"restdaysw[]\" value=\"0\">";
		}

		// display preferred time-in
		if($idhrtapayshiftctg20!="") {
		echo "<td>".date('g:i', strtotime($shiftin20))."</td>";
		} else { echo "<td><font color=\"red\"><i>not_set</i></font></td>"; }


		//
		// timeshift1
		//

		if($found20 == 1) {

			$shiftin1arr = explode(":", date("G:i", strtotime($timein20)));
			$shiftout1arr = explode(":", date("G:i", strtotime($timeout20)));

		} else if($found20 == 0) {

		// query office biometrics time log
		$res22query = "SELECT tblhrattcheckinout.hrattcheckinoutid, tblhrattcheckinout.att_checktime, tblhrattcheckinout.att_userid FROM tblhrattcheckinout LEFT JOIN tblhrattuserinfo ON tblhrattcheckinout.att_userid=tblhrattuserinfo.att_userid WHERE tblhrattuserinfo.employeeid=\"$employeeid\" AND (tblhrattcheckinout.att_checktime>=\"$cutstart16 00:00:00\" AND tblhrattcheckinout.att_checktime<=\"$cutstart16 23:59:59\") AND tblhrattcheckinout.att_checktype=\"I\" ORDER BY tblhrattcheckinout.att_checktime ASC LIMIT 1";
		$result22=""; $found22=0; $ctr22=0;
		$result22 = $dbh2->query($res22query);
		if($result22->num_rows>0) {
			while($myrow22 = $result22->fetch_assoc()) {
			$found22 = 1;
			$hrattcheckinoutid22 = $myrow22['hrattcheckinoutid'];
			$att_checktime22 = date("G:i", strtotime($myrow22['att_checktime']));
			$att_userid22 = $myrow22['att_userid'];
			}
		}
		if($found22 == 1) {
		// split or explode shift category
		$shiftin1arr = explode(":", $att_checktime22);
		} else {
			if($holidaytype21 == "shortened") {
			// split or explode shift category
			$shiftin1arr = explode(":", $shiftin21);
			} else {
				if($dateday==$restdaysunfin || $dateday==$restdaymonfin || $dateday==$restdaytuefin || $dateday==$restdaywedfin || $dateday==$restdaythufin || $dateday==$restdayfrifin || $dateday==$restdaysatfin) {
				// split or explode shift category
				$shiftin1arr = explode(":", "00:00");
				} else {
				// split or explode shift category
				$shiftin1arr = explode(":", $shiftin14);
				}
			} // if($holidaytype21 == "shortened")
		} // if($found22 == 1)
		$res23query = "SELECT tblhrattcheckinout.hrattcheckinoutid, tblhrattcheckinout.att_checktime, tblhrattcheckinout.att_userid FROM tblhrattcheckinout LEFT JOIN tblhrattuserinfo ON tblhrattcheckinout.att_userid=tblhrattuserinfo.att_userid WHERE tblhrattuserinfo.employeeid=\"$employeeid\" AND (tblhrattcheckinout.att_checktime>=\"$cutstart16 00:00:00\" AND tblhrattcheckinout.att_checktime<=\"$cutstart16 23:59:59\") AND tblhrattcheckinout.att_checktype=\"o\" ORDER BY tblhrattcheckinout.att_checktime DESC LIMIT 1";
		$result23=""; $found23=0; $ctr23=0;
		$result23 = $dbh2->query($res23query);
		if($result23->num_rows>0) {
			while($myrow23 = $result23->fetch_assoc()) {
			$found23 = 1;
			$hrattcheckinoutid23 = $myrow23['hrattcheckinoutid'];
			$att_checktime23 = date("G:i", strtotime($myrow23['att_checktime']));
			$att_userid23 = $myrow23['att_userid'];
			}
		}
		if($found23 == 1) {
		// split or explode shift category
		$shiftout1arr = explode(":", $att_checktime23);
		} else {
			if($holidaytype21 == "shortened") {
			// split or explode shift category
			$shiftout1arr = explode(":", $shiftout21);
			}
			if($dateday==$restdaysunfin || $dateday==$restdaymonfin || $dateday==$restdaytuefin || $dateday==$restdaywedfin || $dateday==$restdaythufin || $dateday==$restdayfrifin || $dateday==$restdaysatfin) {
			// split or explode shift category
			$restdayout = "00:00";
			$shiftout1arr = explode(":", $restdayout);
			}
			if($shiftout1arr == "") {
			// split or explode shift category
			$shiftout1arr = explode(":", $shiftout14);
			}
		} // end if($found23 == 1)

		} // end if($found20 == 1)

		$shiftin1hh = sprintf("%02d", $shiftin1arr[0]);
		$shiftin1mm = sprintf("%02d", $shiftin1arr[1]);
		$shiftout1hh = sprintf("%02d", $shiftout1arr[0]);
		$shiftout1mm = sprintf("%02d", $shiftout1arr[1]);

		// timein
		// echo "<td><input type=\"time\" name=\"time_in1_hh[]\" size=\"2\" value=\"$shiftin1hh\"></td><td>:</td><td><input type=\"time\" name=\"time_in1_mm[]\" size=\"2\" value=\"$shiftin1mm\">";
		echo "<td><input name=\"time_in1_hh[]\" size=\"2\" value=\"$shiftin1hh\"></td><td>:</td><td><input name=\"time_in1_mm[]\" size=\"2\" value=\"$shiftin1mm\">";
		// echo "f20:$found20|f21:$found21|f22:$found22,attchktm22:$att_checktime22|f23:$found23,attchktm23:$att_checktime23,$restdayout";
		echo "</td>";

		// allow OT before preferred timein
		echo "<td><select name=\"otbeforeinsw[]\">";
		if($found20 == 1) {
			if($otbeforeinsw20 == "0") { $otbin0sel="selected"; $otbin1sel=""; }
			else if($otbeforeinsw20 == "1") { $otbin1sel="selected"; $otbin0sel=""; }
		} else {
			$otbin0sel="selected"; $otbin1sel="";
		} // end if($found20 == 1)
		echo "<option value=\"0\" $otbin0sel>no</option>";
		echo "<option value=\"1\" $otbin1sel>yes</option>";
		echo "</select></td>";

		// divider
		// echo "&nbsp;&nbsp;&nbsp;";

		// timeout
		// echo "<td><input type=\"time\" name=\"time_out1_hh[]\" size=\"2\" value=\"$shiftout1hh\"></td><td>:</td><td><input type=\"time\" name=\"time_out1_mm[]\" size=\"2\" value=\"$shiftout1mm\"></td>";
		echo "<td><input name=\"time_out1_hh[]\" size=\"2\" value=\"$shiftout1hh\"></td><td>:</td><td><input name=\"time_out1_mm[]\" size=\"2\" value=\"$shiftout1mm\"></td>";
		if($totaltime20 == "") { $totaltime20=0; }
		echo "<td><input size=\"5\" id=\"timetotal\" name=\"totaltime[]\" value=\"$totaltime20\"></td>";

		// allow OT after timeout




		echo "<td><select name=\"otafteroutsw[]\">";
		

		if($otreqdate == $dateval){
 			$otaout1sel="selected"; $otaout0sel="";
		}
		else{
			if($found20 == 1) {
			if($otafteroutsw20 == "0") { $otaout0sel="selected"; $otaout1sel=""; }
			else if($otafteroutsw20 == "1") { $otaout1sel="selected"; $otaout0sel=""; }
			} else {
				if($allowotdflt14==1) { $otaout0sel=""; $otaout1sel="selected"; } else if($allowotdflt14==0) { $otaout0sel="selected"; $otaout1sel=""; }
			} // if($found20 == 1)
		}
		echo "<option value=\"0\" $otaout0sel>no</option>";
		echo "<option value=\"1\" $otaout1sel>yes</option>";
		echo "</select></td>";

		// display next day checkbox
		echo "<td align=\"center\">";
		// echo "<input type=\"hidden\" name=\"nextday0[]\" value=\"0\" />";
		// echo "<input type=\"checkbox\" name=\"nextday1[]\" value=\"1\" /><br>next day";
		if($found20 == 1) {
			if($nextdaysw20 == "1") { $nxtdayyessel="selected"; $nxtdaynosel=""; }
			else if($nextdaysw20 == "0") { $nxtdayyessel=""; $nxtdaynosel="selected"; }
		} else { $nxtdayyessel=""; $nxtdaynosel="selected"; }
		echo "<select name=\"nextday[]\">";
		echo "<option value=\"0\" $nxtdaynosel>no</option>";
		echo "<option value=\"1\" $nxtdayyessel>yes</option>";
		echo "</select>";
		echo "</td>";

		/*
		//
		// timeshift2
		//

		$shiftin2hh = sprintf("%02d", "0");
		$shiftin2mm = sprintf("%02d", "0");
		$shiftout2hh = sprintf("%02d", "0");
		$shiftout2mm = sprintf("%02d", "0");

		// display timein timeout
		echo "<td><input type=\"time\" name=\"time_in2_hh[]\" size=\"2\" value=\"$shiftin2hh\"></td><td>:</td><td><input type=\"time\" name=\"time_in2_mm[]\" size=\"2\" value=\"$shiftin2mm\"></td>";
		echo "&nbsp;&nbsp;&nbsp;";
		echo "<td><input type=\"time\" name=\"time_out2_hh[]\" size=\"2\" value=\"$shiftout2hh\"></td><td>:</td><td><input type=\"time\" name=\"time_out2_mm[]\" size=\"2\" value=\"$shiftout2mm\"></td>";

		// display next day checkbox
		echo "<td align=\"center\">";
		echo "<input type=\"checkbox\" name=\"nextday2\"><br>next day";
		echo "</td>";
		*/

		// meal allowance checkbox
		echo "<td align=\"center\">";
		// echo "<input type=\"hidden\" name=\"mealallow0[]\" value=\"0\" />";
		// echo "<input type=\"checkbox\" name=\"mealallow1[]\" value=\"1\" /><br>meal<br>allowance";
		if($found20 == 1) {
			if($mealallowsw20 == 1) { $mealallowyessel="selected"; $mealallownosel=""; }
			else if($mealallowsw20 == 0 || $mealallowsw20 == "") { $mealallowyessel=""; $mealallownosel="selected"; }
		} else { $mealallowyessel=""; $mealallownosel="selected"; }
		echo "<select name=\"mealallow[]\">";
		echo "<option value=\"0\" $mealallownosel>0</option>";
		echo "<option value=\"1\" $mealallowyessel>1</option>";
		echo "<option value=\"2\" $mealallowyessel>2</option>";
		echo "<option value=\"3\" $mealallowyessel>3</option>";
		echo "</select>";
		echo "</td>";
		

		// check gender
		$res25query = "SELECT contact_gender FROM tblcontact WHERE employeeid=\"$employeeid\" AND contact_type=\"personnel\"";
		$result25=""; $found25=0; $ctr25=0;
		$result25 = $dbh2->query($res25query);
		if($result25->num_rows>0) {
			while($myrow25 = $result25->fetch_assoc()) {
			$found25 = 1;
			$contact_gender25 = $myrow25['contact_gender'];
			} // while($myrow25 = $result25->fetch_assoc())
		} // if($result25->num_rows>0)

		//
		// query tblhrtaempleavechglog
		$res27query="SELECT idhrtaempleavechglog, leavename, leaveduration, idhrtaleavectg FROM tblhrtaempleavechglog WHERE employeeid=\"$employeeid\" AND idhrtacutoff=$idcutoff AND leavedate=\"$cutstart16\"";
		$result27=""; $found27=0; $ctr27=0;
		$result27=$dbh2->query($res27query);
		if($result27->num_rows>0) {
			while($myrow27=$result27->fetch_assoc()) {
			$found27=1;
			$idhrtaempleavechglog27 = $myrow27['idhrtaempleavechglog'];
			$leavename27 = $myrow27['leavename'];
			$leaveduration27 = $myrow27['leaveduration'];
			$idhrtaleavectg27 = $myrow27['idhrtaleavectg'];
			} // while
		} // if

		//
		// display leavename
		if($found27==1) {
		
		//
		echo "<td>$leavename27</td>";
		echo "<input type=\"hidden\" name=\"leaveid[]\" value=\"$idhrtaempleavechglog27\">";
		echo "<input type=\"hidden\" name=\"leavecd[]\" value=''>";
		//
		} else {

		// leave type dropdown
		echo "<td><select name=\"leavecd[]\">";
		if($leavtype20 == "") { $leavetypnasel="selected"; } else { $leavetypenasel=""; }
		echo "<option value='' $leavetypnasel>n/a</option>";
		$res26query = "SELECT idhrtaleavectg, code, name, quota FROM tblhrtaleavectg";
		$result26=""; $found26=0; $ctr26=0;
		$result26 = $dbh2->query($res26query);
		if($result26->num_rows>0) {
			while($myrow26 = $result26->fetch_assoc()) {
			$found26 = 1;
			$idhrtaleavectg26 = $myrow26['idhrtaleavectg'];
			$code26 = $myrow26['code'];
			$name26 = $myrow26['name'];
			$quota26 = $myrow26['quota'];
			if($code26 == $leavtype20) { $leavtypsel="selected"; } else { $leavtypsel=""; }
			if($contact_gender25 == "Male") {
				if($code26 == "paternity") { echo "<option value=\"$code26\" $leavtypsel>$name26</option>"; }
			} else if($contact_gender25 == "Female") {
				if($code26 == "maternityn" || $code26 == "maternityc") { echo "<option value=\"$code26\" $leavtypsel>$name26</option>"; }
			}
			if($code26 == "paternity" || $code26 == "maternityn" || $code26 == "maternityc" || $code26 == "sick" || $code26 == "vacation" || $code26 == "special") {
			} else {
				echo "<option value=\"$code26\" $leavtypsel>$name26</option>";
			}
			} // while($myrow26 = $result26->fetch_assoc())
		} // if($result26->num_rows>0)
		echo "</select></td>";
		echo "<input type=\"hidden\" name=\"leaveid[]\" value=0>";
		//
		} // if-else

		//
		// display leaveduration
		if($found27==1) {

		echo "<td>$leaveduration27</td>";
		//
		} else {

		//
		// leave day duration

		if($leavedate1001 == $dateval){
			$leavedur1sel="selected"; $leavedur5asel=""; $leavedur5psel=""; $leavedurnonesel="";
		}
		else{
 			$leavedur1sel=""; $leavedur5asel=""; $leavedur5psel=""; $leavedurnonesel="selected";
 			if($found20 == 1) {
			if($leaveduration20 == "1.00") { $leavedur1sel="selected"; $leavedur5asel=""; $leavedur5psel=""; $leavedurnonesel=""; }
				else if($leaveduration20 == "0.50a") { $leavedur1sel=""; $leavedur5asel="selected"; $leavedur5psel=""; $leavedurnonesel=""; }
				else if($leaveduration20 == "0.50p") { $leavedur1sel=""; $leavedur5asel=""; $leavedur5psel="selected"; $leavedurnonesel=""; }
				else if($leaveduration20 == "") { $leavedur1sel=""; $leavedur5asel=""; $leavedur5psel; $leavedurnonesel="selected"; }
			} else { $leavedur1sel=""; $leavedur5asel=""; $leavedur5psel=""; $leavedurnonesel="selected"; }
		}

		
		echo "<td><select name=\"leavedaydur[]\">";
		echo "<option value=\"0.00\" $leavedurnonesel>n/a</option>";
		echo "<option value=\"1.00\" $leavedur1sel>1.0 day</option>";
		echo "<option value=\"0.50a\" $leavedur5asel>0.5 day (am)</option>";
		echo "<option value=\"0.50p\" $leavedur5psel>0.5 day (pm)</option>";
		echo "</select></td>";
		

		//
		} // if-else

		// updated 20161106
		if($projchgtyp20 == "daily") {
		// updated 20161102
		// project charging
		$res26query="SELECT DISTINCT tblproject1.proj_code, tblproject1.proj_sname, tblproject1.proj_fname FROM tblproject1 WHERE ((tblproject1.proj_code>=\"C00-001\" AND tblproject1.proj_code<=\"C00-002\") OR tblproject1.proj_code>=\"C2008-01\") ORDER BY tblproject1.proj_code DESC";
		$result26=""; $found26=0; $ctr26=0;
		$result26 = $dbh2->query($res26query);
		echo "<td><select class='projectChargeSelect' name=\"projcharge[]\">";
		if($result26->num_rows>0) {
			while($myrow26 = $result26->fetch_assoc()) {
			$found26 = 1;
			$proj_code26 = $myrow26['proj_code'];
			$proj_name26 = $myrow26['proj_sname'];
			$proj_fname26 = $myrow26['proj_fname'];
			if($projcharge20 == "") {
				if($proj_code26 == "C00-001") { $projcdsel="selected"; } else { $projcdsel=""; }
			} else {
				if($proj_code26 == $projcharge20) { $projcdsel="selected"; } else { $projcdsel=""; }
			} // end if($projcode14 == "")
			echo "<option value=\"$proj_code26\" $projcdsel>$proj_code26 - ";
			if($proj_name26 != "") {
			echo "$proj_name26";
			} else {
			echo "".substr($proj_fname26, 0, 30)."";
			}
			echo "</option>";
			}
		}
		echo "<select></td>";
		} // if($projchgtyp20 == "daily") {

		// 20170621 start checkbox for manual entry of values
		if($manualcompsw20==1) {
		$checkboxmanval="checked"; $tottimedisval=""; $nightdiffdisval=""; $otutdisval="";
		$otvalman=$otval20; $utvalman=$utval20; $otutvalman=$otutval20; $nightdiffvalman=$nightdiffval20;
		} else if($manualcompsw20==0) {
		$checkboxmanval=""; $tottimedisval="disabled"; $nightdiffdisval="disabled"; $otutdisval="disabled";
		}
		// echo "<td><input type=\"checkbox\" id=\"checkboxManual\" name=\"checkboxman[]\" onclick=\"active();\" value=\"$cutstart16\" $checkboxmanval></td>";
                echo "<td><input type=\"checkbox\" name=\"checkboxman[]\"  value=\"$cutstart16\" $checkboxmanval></td>";
		// 20170703 note: enable below and disable above if js function works
		// echo "<td><input type=\"checkbox\" name=\"checkboxman[]\" value=\"$cutstart16\" id=\"checkboxManual\" onclick=\"enableDisableAll();\" $checkboxmanval></td>";

		//
		// total time
		
		// 20170703 note: enable below and disable above if js function works
		// echo "<td><input size=\"5\" type=\"text\" id=\"timetotal\" name=\"totaltime[]\" placeholder=\"totaltime\" value=\"$totaltime20\" $tottimedisval></td>";

    // chk 1st if record exists based on id
    if($found20==1) {
    $otvalfin=$otval20;

    } else { //if($found20==1)

		//
		// ut/ot
		if($otafteroutsw20 == 0) {
			if($totaltime20 > 0 && $totaltime20 < 8){
				if($utval20 == 0){
					$utval20 = $totaltime20 - 8;
				}
				else{
					$utval20 = $utval20;
				}	
			}
			else{
				$utval20 = 0;
			}

			$otutval20 = 0;

		}


		else{
			if($dateday == "Sun" || $dateday == "Sat") {
				$otval = $totaltime20;
				$utval20 = 0;
			} else {
				$utval20 = 0;
				if($totaltime20 > 8){
					if($otval == 0){
						$otval = $totaltime20 - 8;
					}
					else{
						$otval = $otval;
					}	
				}

			} // if($found21 == 1 || $dateday == "Sun"
		}
		if($otutval20 == 0){
			$otutval20 = $otval + $utval20;
		}
		else{
			$otutval20 = $otutval20;
		}

		// echo "<input type=\"hidden\" name=\"otval[]\" value=\"$otval20\">";
		// echo "<input type=\"hidden\" name=\"utval[]\" value=\"$utval20\">";
		if($manualcompsw20==1) {
		$otval=$otvalman;	
		} // if

    // set final vars
    $otvalfin=$otval;

    } //if($found20==1) 

		echo "<td>";
		// echo "<input size=\"5\" id=\"valot\" name=\"otval[]\" value=\"$otvalfin\">";
		echo "<input size=\"5\" name=\"otval[]\" value=\"$otvalfin\">";
		echo "</td>";

		if($manualcompsw20==1) {
		$utval20=$utvalman;	
		} // if
		if($utval20 < 0){
			echo "<td>";
			echo "<input style='color:red' size=\"5\" id=\"valut\" name=\"utval[]\" value=\"$utval20\">";
			echo "</td>";
		} else {
			echo "<td>";
			echo "<input size=\"5\" id=\"valut\" name=\"utval[]\" value=\"$utval20\">";
			echo "</td>";
		} // if-else
		if($manualcompsw20==1) {
		$otutval20=$otutvalman;	
		} // if
		if($otutval20 < 0){
			echo "<td><input style='color:red' size=\"5\" id=\"valotut\" name=\"otutval[]\" value=\"$otutval20\"></td>";
		} else {
			echo "<td><input size=\"5\" id=\"valotut\" name=\"otutval[]\" value=\"$otutval20\"></td>";
		} // if-else
		// 20170703 note: enable below and disable above if js function works
		// echo "<td><input size=\"5\" type=\"text\" id=\"otutval\" name=\"otutval[]\" placeholder=\"Otutval\" value=\"$otutval20\" $otutdisval></td>";

		//
		// nightdiff
		if($nightdiffval20 == "") { $nightdiffval20=0; }
		if($otafteroutsw20 == 0) {
			$nightdiffval20 = 0;
		} else {
			$nightdiffval20 = $nightdiffval20;
		} // if-else
		if($manualcompsw20==1) {
		$nightdiffval20=$nightdiffvalman;	
		} // if
		echo "<td><input size=\"5\" id=\"valnightdiff\" name=\"nightdiffval[]\" value=\"$nightdiffval20\"></td>";
		// 20170703 note: enable below and disable above if js function works
		// echo "<td><input size=\"5\" type=\"text\" id=\"nightdiffval\" name=\"nightdiffval[]\" placeholder=\"Nightdiffval\" value=\"$nightdiffval20\" $nightdiffdisval></td>";

		// 20170621 end checkbox for manual entry of values

		//
		// no findings
		if($nofindings20==1) { $nofindingssel="checked"; } else { $nofindingssel=""; }
		echo "<td><input type=\"checkbox\" name=\"nofindings[]\" value=\"$cutstart16\" $nofindingssel></td>";

		//
		// remarks
		echo "<td><textarea placeholder='remarks' name=\"remarks[]\" value=\"$remarks20\" rows='3'></textarea></td>";

		// increment date
		$cutstart16 = date("Y-m-d", strtotime("+1 day", strtotime($cutstart16)));
		echo "</tr>";

		// compute subtotals
		$totaltimesubtot = $totaltimesubtot + $totaltime20;
		$utvalsubtot = $utvalsubtot + $utval20;
		$otvalsubtot = $otvalsubtot + $otvalfin;
		$otutvalsubtot = $otutvalsubtot + $otutval20;

		$nightdiffvalsubtot = $nightdiffvalsubtot + $nightdiffval20;

	// test display of subtotals, pls comment on prod env

		// reset variables
		$dateval=""; $dateday=""; $holidaytype21=""; $contact_gender=""; $restdayfin=""; $otutval="";
		$otbin0sel=""; $otbin1sel="";
		$otaout0sel=""; $otaout1sel="";
		$nxtdayyessel=""; $nxtdaynosel="";
		$mealallowyessel=""; $mealallownosel="";
		$leavtypsel="";
		$leavedur1sel=""; $leavedur5sel=""; $leavedurnonesel="";
		$leavedur1sel=""; $leavedur5asel=""; $leavedur5psel=""; $leavedurnonesel="";
	}

	// display subtotals
	echo "<tr>";
	// if($projchgtyp24=='daily') {
		echo "<th>&nbsp;</th>";
	// }
	echo "<th colspan=\"10\" align=\"right\">Sub-total</th>";
	echo "<th colspan='8' align=\"right\">".number_format($totaltimesubtot, 2)."</th>";
	echo "<th align=\"right\">".number_format($otvalsubtot, 2)."</th>";
	if($utvalsubtot < 0){
		echo "<th align=\"right\"><span style='color:red'>".number_format($utvalsubtot, 2)."</span></th>";
	}
	else{
		echo "<th align=\"right\">".number_format($utvalsubtot, 2)."</th>";
	}
	if($otutvalsubtot < 0){
		echo "<th align=\"right\"><span style='color:red'>".number_format($otutvalsubtot, 2)."</span></th>";
	}
	else{
		echo "<th align=\"right\">".number_format($otutvalsubtot, 2)."</th>";
	}

	echo "<th align=\"right\">".number_format($nightdiffvalsubtot, 2)."</th>";
	echo "</tr>";

	// reset subtotal variables

	echo "<tr><td colspan=\"19\" align=\"center\">";
	// echo "<input type=\"submit\" value=\"Save\">";
	echo "<button type=\"submit\" class=\"btn btn-success\">Save</button>";
	echo "</td></tr>";
	echo "</form>";
	echo "</table>";
	echo "</td></tr>";

	} // if-else

	} // if($employeeid!='')

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><button type=\"button\" class=\"btn btn-default\"><a href=\"hrtimeatt.php?loginid=$loginid\">Back</a></button></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>

<script type="text/javascript">
	$(document).ready(function(){
		$('.projectChargeSelect').chosen();
	});
</script>

<style type="text/css">
	#tbltimelogs tr:hover {
		background: #efefef;
	}



</style>
