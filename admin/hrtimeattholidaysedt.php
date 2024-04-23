<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrtaholidays = (isset($_GET['idhrtahld'])) ? $_GET['idhrtahld'] :'';

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
  echo "<p><font size=1>Modules >> Time and Attendance >> Holidays - edit</font></p>";

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

  echo "<tr><td colspan=\"2\">";

  if($accesslevel >= 4) {
	echo "<table class=\"fin\" border=\"0\">";
	echo "<form action=\"hrtimeattholidaysedt2.php?loginid=$loginid&idhrtahld=$idhrtaholidays\" method=\"post\" name=\"modhrtaholiedt\">";
	//
	// query holiday
	//
	$res11query=""; $result11=""; $found11=0; $ctr11=0;
	$res11query="SELECT applic_date, holidayname, holidaytype, shiftin, shiftout, remarks FROM tblhrtaholidays WHERE idhrtaholidays=$idhrtaholidays";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$ctr11 = $ctr11 + 1;
		$applic_date11 = $myrow11['applic_date'];
		$holidayname11 = $myrow11['holidayname'];
		$holidaytype11 = $myrow11['holidaytype'];
		$shiftin11 = $myrow11['shiftin'];
		$shiftout11 = $myrow11['shiftout'];
		$remarks11 = $myrow11['remarks'];
        } //while
    } //if
	//
	// edit form
	//
	echo "<tr><td colspan=\"2\" align=\"center\">";
	echo "<div class='form-group'><input type=\"date\" class='form-control' name=\"holidate\" size=\"10\" value=\"$applic_date11\"></div>";
	// get year of selected holiday
	$applicdatearr = explode("-", $applic_date11);
	$applicdateyyyy = $applicdatearr[0];
	?>
  <!-- <a href="javascript:show_calendar('document.modhrtaholiedt.holidate', document.modhrtaholiedt.holidate.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a> -->
  <?php
	echo "<div class='form-group'><input name=\"holidayname\" class='form-control' size=\"40\" value=\"$holidayname11\" placeholder='enter holiday name'></div>";
	echo "<div class='form-group'><select name=\"holitype\" class='form-control'>";
	if($holidaytype11 == "special") { $hdtypselspecial="selected"; $hdtypsellegal=""; $hdtypselshortened=""; $hdtypselall=""; $hdtypeselnone=""; }
	else if($holidaytype11 == "legal") { $hdtypselspecial=""; $hdtypsellegal="selected"; $hdtypselshortened=""; $hdtypselall=""; $hdtypeselnone=""; }
	else if($holidaytype11 == "shortened") { $hdtypselspecial=""; $hdtypsellegal=""; $hdtypselshortened="selected"; $hdtypselall=""; $hdtypeselnone=""; }
	else if($holidaytype11 == "all") { $hdtypselspecial=""; $hdtypsellegal=""; $hdtypselshortened=""; $hdtypselall="selected"; $hdtypeselnone=""; }
	else { $hdtypselspecial=""; $hdtypsellegal=""; $hdtypselshortened=""; $hdtypselall=""; $hdtypeselnone="selected"; }
	echo "<option value='' $hdtypeselnone>select type</option>";
	echo "<option value=\"special\" $hdtypselspecial>Special holiday</option>";
	echo "<option value=\"legal\" $hdtypsellegal>Legal holiday</option>";
	echo "<option value=\"shortened\" $hdtypselshortened>Shortened period</option>";
	echo "</select></div>";
	echo "<br><i>Note: for shortened period, pls fill up below...</i>";
	echo "<br>start_time:<div class='form-group'><input type=\"time\" class='form-control' name=\"starttime\" size=\"10\" value=\"$shiftin11\"></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;end_time:<div class='form-group'><input type=\"time\" class='form-control' name=\"endtime\" size=\"10\" value=\"$shiftout11\"></div>";
	echo "<br><button type=\"submit\" class='btn btn-success'>Save details</button>";
	echo "</td></tr>";
	echo "</form>";
	echo "</table>";
	}

	echo "</td></tr>";

// end contents here...

  echo "</table>";

// edit body-footer
	echo "<form action=\"hrtimeattholidays.php?loginid=$loginid\" method=\"post\" name=\"hrtimeatttimelogs\">";
	echo "<input type=\"hidden\" name=\"holidaytype\" value=\"all\">";
	echo "<input type=\"hidden\" name=\"yyyy\" value=\"$applicdateyyyy\">";
  echo "<p><button class='btn btn-default' type=\"submit\">Back</button></p>";
	echo "</form>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
