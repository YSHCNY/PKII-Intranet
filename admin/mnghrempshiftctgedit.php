<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrtapayshiftctg = (isset($_GET['idsc'])) ? $_GET['idsc'] :'';

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Manage >> HR Modules >> Payroll system - shift categories</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...
		echo "<tr><th colspan=\"2\">Payroll system - edit shift category</th></tr>";

  if($accesslevel >= 4)
  {
		$res11query = "SELECT shiftin, shiftout, lunchstart, lunchend FROM tblhrtapayshiftctg WHERE idhrtapayshiftctg=$idhrtapayshiftctg";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$shiftin11 = $myrow11['shiftin'];
			$shiftout11 = $myrow11['shiftout'];
			$lunchstart11 = $myrow11['lunchstart'];
			$lunchend11 = $myrow11['lunchend'];
			}
		}

		$shiftinarr = explode(":", $shiftin11);
		$shiftinhh = $shiftinarr[0];
		$shiftinmm = $shiftinarr[1];
		$shiftoutarr = explode(":", $shiftout11);
		$shiftouthh = $shiftoutarr[0];
		$shiftoutmm = $shiftoutarr[1];

		$lunchstartarr = explode(":", $lunchstart11);
		$lunchstarthh = $lunchstartarr[0];
		$lunchstartmm = $lunchstartarr[1];
		$lunchendarr = explode(":", $lunchend11);
		$lunchendhh = $lunchendarr[0];
		$lunchendmm = $lunchendarr[1];

		echo "<form action=\"mnghrempshiftctgedit2.php?loginid=$loginid&idsc=$idhrtapayshiftctg\" method=\"post\">";
    echo "<tr>";
		echo "<th align=\"right\">IN</th>";
		echo "<td>";
		echo "<table>";
		// dropdown for IN:hh
		echo "<tr><td align=\"center\">";
		echo "<select name=\"inhh\">";
		for($ih=00; $ih<=23; $ih++) {
			if($ih == $shiftinhh) { $shiftinhhsel="selected"; } else { $shiftinhhsel=""; }
			echo "<option value=\"$ih\" $shiftinhhsel>$ih</option>";
		}
		echo "</select>";
		echo "<br><font size=\"1\"><i>hour</i></font></td>";
		// divider
		echo "<td>:</td>";
		// dropdown for IN:mm
		echo "<td align=\"center\">";
		echo "<select name=\"inmm\">";
		for($im=00; $im<=59; $im++) {
			if($im == $shiftinmm) { $shiftinmmsel="selected"; } else { $shiftinmmsel=""; }
			echo "<option value=\"$im\" $shiftinmmsel>$im</option>";
		}
		echo "</select>";
		echo "<br><font size=\"1\"><i>minute</i></font></td></tr>";
		echo "</table>";
		echo "</td>";
    echo "</tr>";
    echo "<tr>";
		echo "<th align=\"right\">OUT</th>";
		echo "<td>";
		echo "<table>";
		// dropdown for OUT:hh
		echo "<tr><td align=\"center\">";
		echo "<select name=\"outhh\">";
		for($oh=00; $oh<=23; $oh++) {
			if($oh == $shiftouthh) { $shiftouthhsel="selected"; } else { $shiftouthhsel=""; }
			echo "<option value=\"$oh\" $shiftouthhsel>$oh</option>";
		}
		echo "</select>";
		echo "<br><font size=\"1\"><i>hour</i></font></td>";
		// divider
		echo "<td>:</td>";
		// dropdown for OUT:mm
		echo "<td align=\"center\">";
		echo "<select name=\"outmm\">";
		for($om=00; $om<=59; $om++) {
			if($om == $shiftoutmm) { $shiftoutmmsel="selected"; } else { $shiftoutmmsel=""; }
			echo "<option value=\"$om\" $shiftoutmmsel>$om</option>";
		}
		echo "</select>";
		echo "<br><font size=\"1\"><i>minute</i></font></td></tr>";
		echo "</table>";
		echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th colspan=\"4\">Lunch break</th>";
    echo "</tr>";
    echo "<tr>";
		echo "<th align=\"right\">Start</th>";
		echo "<td>";
		echo "<table>";
		// dropdown for LunchStart:hh
		echo "<tr><td align=\"center\">";
		echo "<select name=\"lunchstarthh\">";
		if($lunchstarthh=='') { echo "<option value=''>-</option>"; }
		for($lsh=00; $lsh<=23; $lsh++) {
			if($lsh==$lunchstarthh) { $lunchstarthhsel="selected"; } else { $lunchstarthhsel=""; }
			echo "<option value=\"$lsh\" $lunchstarthhsel>$lsh</option>";
		}
		echo "</select>";
		echo "<br><font size=\"1\"><i>hour</i></font></td>";
		// divider
		echo "<td>:</td>";
		// dropdown for LunchStart:mm
		echo "<td align=\"center\">";
		echo "<select name=\"lunchstartmm\">";
		if($lunchstartmm=='') { echo "<option value=''>-</option>"; }
		for($lsm=00; $lsm<=59; $lsm++) {
			if($lsm==$lunchstartmm) { $lunchstartmmsel="selected"; } else { $lunchstartmmsel=""; }
			echo "<option value=\"$lsm\" $lunchstartmmsel>$lsm</option>";
		}
		echo "</select>";
		echo "<br><font size=\"1\"><i>minute</i></font></td></tr>";
		echo "</table>";
		echo "</td>";
    echo "</tr>";
    echo "<tr>";
		echo "<th align=\"right\">End</th>";
		echo "<td>";
		echo "<table>";
		// dropdown for LunchEnd:hh
		echo "<tr><td align=\"center\">";
		echo "<select name=\"lunchendhh\">";
		if($lunchendhh=='') { echo "<option value=''>-</option>"; }
		for($leh=00; $leh<=23; $leh++) {
			if($leh==$lunchendhh) { $lunchendhhsel="selected"; } else { $lunchendhhsel=""; }
			echo "<option value=\"$leh\" $lunchendhhsel>$leh</option>";
		}
		echo "</select>";
		echo "<br><font size=\"1\"><i>hour</i></font></td>";
		// divider
		echo "<td>:</td>";
		// dropdown for LunchEnd:mm
		echo "<td align=\"center\">";
		echo "<select name=\"lunchendmm\">";
		if($lunchendmm=='') { echo "<option value=''>-</option"; }
		for($lem=00; $lem<=59; $lem++) {
			if($lem==$lunchendmm) { $lunchendmmsel="selected"; } else { $lunchendmmsel=""; }
			echo "<option value=\"$lem\" $lunchendmmsel>$lem</option>";
		}
		echo "</select>";
		echo "<br><font size=\"1\"><i>minute</i></font></td></tr>";
		echo "</table>";
		echo "</td>";
    echo "</tr>";
		echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Update\"></td></tr>";
		echo "</form>";
  }

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"mnghrempshiftctg.php?loginid=$loginid\">Back</a></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
