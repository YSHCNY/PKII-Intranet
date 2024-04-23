<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$groupname = (isset($_GET['groupname'])) ? $_GET['groupname'] :'';
$cutstart = (isset($_GET['cutstart'])) ? $_GET['cutstart'] :'';
$cutend = (isset($_GET['cutend'])) ? $_GET['cutend'] :'';

if($groupname == '' && $cutstart == '' && $cutend == '') {
  $groupcut = (isset($_POST['groupcut'])) ? $_POST['groupcut'] :'';
  $cutoffarray = split(",", $groupcut);
  $groupname = $cutoffarray[0];
  $cutstart = $cutoffarray[1];
  $cutend = $cutoffarray[2];
}

$srcfile = "confipaytools2.php";
$validatepw = (isset($_POST['vpw'])) ? $_POST['vpw'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     echo "<html><head>";
     echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/font-awesome.min.css\">";
     echo "<STYLE TYPE=\"text/css\">";
     echo "<!--";
     echo "p{font-family: Helvetica; font-size: 10pt;}";
     echo "B{font-family: Helvetica; font-size: 10pt;}";
     echo "TD{font-family: Helvetica; font-size: 10pt;}";
     echo "--->";
     echo "</STYLE></head><body>";

		// include required variables for accesslevel5 verification
		$res11query="SELECT DISTINCT employeeid, accesslevel FROM tblconfipaygrp WHERE groupname=\"$groupname\"";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11 = 1;
			$employeeid = $myrow11['employeeid'];
			$confiaccesslevel = $myrow11['accesslevel'];
			} // while($myrow11=$result11->fetch_assoc())
		} // if($result11->num_rows>0)

// echo "<p>vartest grpnm:$groupname, grpct:$groupcut f11:$found11, cal:$confiaccesslevel</p>";

// validate password if level 5
if($confiaccesslevel==5 && $validatepw==0) {

	$srcfile="confipaytools2.php";
	echo "<table class=\"fin\">";
	include("confipayvpw.php");
	echo "</table>";

} else {

	// start display of tools menu
     // echo "<p>For payroll group and cutoff period:<br>";
     // echo "<b>";
    // include("mcryptdec.php");
     // echo "$groupname";
    // include("mcryptenc.php");
     // echo ": $cutstart to $cutend</b></p>";

// echo "<p>vartest2 grpnm:$groupname, grpct:$groupcut f11:$found11, cal:$confiaccesslevel</p>";

// menu1 View Payroll Report
	echo "<FORM METHOD=\"POST\" ACTION=\"confipaytoolsview.php?loginid=$loginid\" TARGET=\"_blank\" name=\"confipaytoolsview\">";
	echo "<input type=\"hidden\" name=\"groupname\" value=\"$groupname\">";
	echo "<input type=\"hidden\" name=\"cutstart\" value=\"$cutstart\">";
	echo "<input type=\"hidden\" name=\"cutend\" value=\"$cutend\">";
	echo "<p><button TYPE=\"SUBMIT\" class='btn btn-primary'>View results</button></p>";
	echo "</FORM>";
/*
	echo "<FORM METHOD=POST ACTION=confipaytoolscsv.php?loginid=$loginid&groupname=$groupname&cutstart=$cutstart&cutend=$cutend TARGET='_blank'>";
	echo "<p><INPUT TYPE=SUBMIT VALUE='Export to CSV'></p>";
	echo "</FORM>";
*/
	echo "<FORM METHOD=POST ACTION=confipayrfp.php?loginid=$loginid&groupname=$groupname&cutstart=$cutstart&cutend=$cutend>";
	echo "<p><INPUT TYPE=SUBMIT VALUE='Request for Payment'></p>";
	echo "</FORM>";

	echo "<FORM METHOD=\"POST\" ACTION=\"confipaybpi.php?loginid=$loginid\" name=\"cfptbpihash\">";
	echo "<input type=\"hidden\" name=\"groupname\" value=\"$groupname\">";
	echo "<input type=\"hidden\" name=\"cutstart\" value=\"$cutstart\">";
	echo "<input type=\"hidden\" name=\"cutend\" value=\"$cutend\">";
	echo "<p><button TYPE=\"SUBMIT\" class='btn btn-primary'>Create BPI hash file</button></p>";
	echo "</FORM>";

	echo "<FORM METHOD=\"POST\" ACTION=\"confipaytoolsemail.php?loginid=$loginid\" name=\"cfptsendmail\">";
	echo "<input type=\"hidden\" name=\"groupname\" value=\"$groupname\">";
	echo "<input type=\"hidden\" name=\"cutstart\" value=\"$cutstart\">";
	echo "<input type=\"hidden\" name=\"cutend\" value=\"$cutend\">";
	echo "<p><button TYPE=\"SUBMIT\" class='btn btn-primary'>Payslip e-mail notifier</button></p>";
	echo "</FORM>";

	echo "<FORM METHOD=POST ACTION=confipaytoolsdelcutoff.php?loginid=$loginid&groupname=$groupname&cutstart=$cutstart&cutend=$cutend>";
	echo "<p><button TYPE=SUBMIT class='btn btn-danger'>Delete this cutoff period</button></p>";
	echo "</FORM>";

} // if($confiaccesslevel==5 && $validatepw==0)
//     echo "<p><a href=confipay2.php?loginid=$loginid>Back</a><br>";

     echo "</body></html>";
} else {
     include ("logindeny.php");
}

$dbh2->close();
?> 
