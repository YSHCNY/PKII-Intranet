<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$holidaytype = trim((isset($_POST['holidaytype'])) ? $_POST['holidaytype'] :'');
$yyyy = trim((isset($_POST['yyyy'])) ? $_POST['yyyy'] :'');

if($holidaytype == "special") { $hdtypselspecial="selected"; $hdtypsellegal=""; $hdtypselshortened=""; $hdtypselall=""; $hdtypeselnone=""; }
else if($holidaytype == "legal") { $hdtypselspecial=""; $hdtypsellegal="selected"; $hdtypselshortened=""; $hdtypselall=""; $hdtypeselnone=""; }
else if($holidaytype == "shortened") { $hdtypselspecial=""; $hdtypsellegal=""; $hdtypselshortened="selected"; $hdtypselall=""; $hdtypeselnone=""; }
else if($holidaytype == "all") { $hdtypselspecial=""; $hdtypsellegal=""; $hdtypselshortened=""; $hdtypselall="selected"; $hdtypeselnone=""; }
else { $hdtypselspecial=""; $hdtypsellegal=""; $hdtypselshortened=""; $hdtypselall=""; $hdtypeselnone="selected"; }

// echo "<p>vartest typ:$holidaytype, yyyy:$yyyy</p>";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");
?>
<script language="JavaScript" src="ts_picker.js"></script>
<?php
// edit body-header
     echo "<p><font size=1>Modules >> Time and Attendance >> Holidays</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

  echo "<tr><td colspan=\"2\">";

  if($accesslevel >= 4) {
	echo "<table class=\"fin\" border=\"0\">";
	echo "<tr>";
		echo "<form action=\"hrtimeattholidays.php?loginid=$loginid\" method=\"post\" name=\"modhrtaholi\">";

		// holiday type dropdown
    echo "<td><div class='form-group'><select name=\"holidaytype\" class='form-control' onchange=\"this.form.submit()\">";
		echo "<option value='' $hdtypeselnone>select type</option>";
		echo "<option value=\"special\" $hdtypselspecial>Special holidays</option>";
		echo "<option value=\"legal\" $hdtypsellegal>Legal holidays</option>";
		echo "<option value=\"shortened\" $hdtypselshortened>Shortened periods</option>";
		echo "<option value=\"all\" $hdtypselall>ALL</option>";
		echo "</select></div></td>";

		// year available dropdown
		if($holidaytype != "") {
		echo "<td>";
		echo "<div class='form-group'><select name=\"yyyy\" class='form-control' onchange=\"this.form.submit()\">";
		if($yyyy == "") { echo "<option value=''>select year</option>"; }
		$result12=""; $found12=0;
		$result12 = mysql_query("SELECT DISTINCT DATE_FORMAT(applic_date, '%Y') as yyyy FROM tblhrtaholidays ORDER BY applic_date DESC", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
			$found12 = 1;
			$yyyy12 = $myrow12[0];
			if($yyyy12 == $yyyy) { $yyyysel="selected"; } else { $yyyysel=""; }
			echo "<option value=\"$yyyy12\" $yyyysel>$yyyy12</option>";
			}
		}
		echo "</select></div>";
		echo "</td>";
		}

		// submit button
		echo "<td>";
		echo "<button class='btn btn-primary'>Submit</button>";
    echo "</td>";

		echo "</form>";
	echo "</tr>";
	echo "</table>";
  } // endif accesslevel >= 4

  echo "</td></tr>";

	//
	// add function
	//
	echo "<form action=\"hrtimeattholidaysadd.php?loginid=$loginid\" method=\"post\" name=\"modhrtaholiadd\">";
	echo "<tr><td colspan=\"2\" align=\"center\">";
	echo "<div class='form-group'><input type=\"date\" class='form-control' name=\"holidate\" size=\"10\" value=\"$datenow\"></div>";
	?>
  <!-- <a href="javascript:show_calendar('document.modhrtaholiadd.holidate', document.modhrtaholiadd.holidate.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a> -->
  <?php
	echo "<div class='form-group'><input class='form-control' name=\"holidayname\" size=\"40\" placeholder=\"enter holiday name\"></div>";
	echo "<div class='form-group'><select class='form-control' name=\"holitype\">";
	echo "<option value=''>select type</option>";
	echo "<option value=\"special\">Special holiday</option>";
	echo "<option value=\"legal\">Legal holiday</option>";
	echo "<option value=\"shortened\">Shortened period</option>";
	echo "</select></div>";
	echo "<br><i>Note: for shortened period, pls fill up below...</i>";
	echo "<br>start_time:<div class='form-group'><input type=\"time\" class='form-control' name=\"starttime\" size=\"10\" value=\"08:00\"></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;end_time:<div class='form-group'><input type=\"time\" class='form-control' name=\"endtime\" size=\"10\" value=\"17:00\"></div>";
	echo "<br><button type='submit' class='btn btn-success'>Add new</button>";
	echo "</td></tr>";
	echo "</form>";

	//
	// display info based on selected dropdown
	//
	if($yyyy != "") {
	echo "<tr><td colspan=\"2\">";
	echo "<table width=\"100%\" class=\"fin\">";
  echo "<tr><th>date</th><th>name</th><th>type</th><th colspan='2'>action</th></tr>";
	// prepare date duration
	$applicdatefrom = $yyyy."-"."01"."-"."01";
	$applicdateto = $yyyy."-"."12"."-"."31";
	// query holidays
	$res14query=""; $result14=""; $found14=0;
	if($holidaytype == "all") {
	$res14query = "SELECT idhrtaholidays, applic_date, holidayname, holidaytype, shiftin, shiftout FROM tblhrtaholidays WHERE (applic_date>=\"$applicdatefrom\" AND applic_date<=\"$applicdateto\") ORDER BY applic_date ASC";
	} else {
	$res14query = "SELECT idhrtaholidays, applic_date, holidayname, holidaytype, shiftin, shiftout FROM tblhrtaholidays WHERE holidaytype=\"$holidaytype\" AND (applic_date>=\"$applicdatefrom\" AND applic_date<=\"$applicdateto\") ORDER BY applic_date ASC";
	}
    $result14=$dbh2->query($res14query);
    if($result14->num_rows>0) {
        while($myrow14=$result14->fetch_assoc()) {
		$found14 = 1;
		$idhrtaholidays14 = $myrow14['idhrtaholidays'];
		$applic_date14 = $myrow14['applic_date'];
		$holidayname14 = $myrow14['holidayname'];
		$holidaytype14 = $myrow14['holidaytype'];
		$shiftin14 = $myrow14['shiftin'];
		$shiftout14 = $myrow14['shiftout'];
		echo "<tr><td><font color=\"red\">".date("Y-M-d D", strtotime($applic_date14))."</font></td><td><strong>$holidayname14</strong></td>";
		if($holidaytype=="shortened") { echo "<td>$shiftin14</td><td>-to-</td><td>$shiftout14</td>"; }
		if($holidaytype=="all") { echo "<td>$holidaytype14</td>"; }
		echo "<td><a href=\"hrtimeattholidaysedt.php?loginid=$loginid&idhrtahld=$idhrtaholidays14\" class='btn btn-warning' role='button'>Edit</a></td>";
		echo "<td><a href=\"hrtimeattholidaysdel.php?loginid=$loginid&idhrtahld=$idhrtaholidays14\" class='btn btn-danger' role='button'>Del</a></td>";
		echo "</tr>";
        } //while
    } //if

	echo "</table>";
	echo "</td></tr>";
	}

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"mnghrmod.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
