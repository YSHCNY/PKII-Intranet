<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

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
		echo "<tr><th colspan=\"2\">Payroll system shift categories</th></tr>";

  if($accesslevel >= 4)
  {
		echo "<form action=\"mnghrempshiftctgadd.php?loginid=$loginid\" method=\"post\">";
    echo "<tr>";
		echo "<th colspan=\"4\">Time shift</th>";
    echo "</tr>";
    echo "<tr>";
		echo "<th align=\"right\">IN</th>";
		echo "<td>";
		echo "<table>";
		// dropdown for IN:hh
		echo "<tr><td align=\"center\">";
		echo "<select name=\"inhh\">";
		for($ih=00; $ih<=23; $ih++) {
			echo "<option value=\"$ih\">$ih</option>";
		}
		echo "</select>";
		echo "<br><font size=\"1\"><i>hour</i></font></td>";
		// divider
		echo "<td>:</td>";
		// dropdown for IN:mm
		echo "<td align=\"center\">";
		echo "<select name=\"inmm\">";
		for($im=00; $im<=59; $im++) {
			echo "<option value=\"$im\">$im</option>";
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
			echo "<option value=\"$oh\">$oh</option>";
		}
		echo "</select>";
		echo "<br><font size=\"1\"><i>hour</i></font></td>";
		// divider
		echo "<td>:</td>";
		// dropdown for OUT:mm
		echo "<td align=\"center\">";
		echo "<select name=\"outmm\">";
		for($om=00; $om<=59; $om++) {
			echo "<option value=\"$om\">$om</option>";
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
		$lunchstartdefaulthh=12;
		for($ih=00; $ih<=23; $ih++) {
			if($ih==$lunchstartdefaulthh) { $lunchstartdefsel="selected"; } else { $lunchstartdefsel=""; }
			echo "<option value=\"$ih\" $lunchstartdefsel>$ih</option>";
		}
		echo "</select>";
		echo "<br><font size=\"1\"><i>hour</i></font></td>";
		// divider
		echo "<td>:</td>";
		// dropdown for LunchStart:mm
		echo "<td align=\"center\">";
		echo "<select name=\"lunchstartmm\">";
		for($im=00; $im<=59; $im++) {
			echo "<option value=\"$im\">$im</option>";
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
                $lunchenddefaulthh=13;
		for($oh=00; $oh<=23; $oh++) {
                        if($oh==$lunchenddefaulthh) { $lunchenddefsel="selected"; } else { $lunchenddefsel=""; }
			echo "<option value=\"$oh\" $lunchenddefsel>$oh</option>";
		}
		echo "</select>";
		echo "<br><font size=\"1\"><i>hour</i></font></td>";
		// divider
		echo "<td>:</td>";
		// dropdown for LunchEnd:mm
		echo "<td align=\"center\">";
		echo "<select name=\"lunchendmm\">";
		for($om=00; $om<=59; $om++) {
			echo "<option value=\"$om\">$om</option>";
		}
		echo "</select>";
		echo "<br><font size=\"1\"><i>minute</i></font></td></tr>";
		echo "</table>";
		echo "</td>";
    echo "</tr>";
		echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Add\"></td></tr>";
		echo "</form>";

		echo "<tr><th colspan=\"2\">List of available shift categories</th></tr>";
		echo "<tr><td colspan=\"2\"><table border=\"1\">";
		echo "<tr><td colspan=\"3\">shift details</td><td colspan=\"3\">lunch break</td><td colspan=\"2\">action</td></tr>";
		$res11query = "SELECT idhrtapayshiftctg, shiftin, shiftout, lunchstart, lunchend FROM tblhrtapayshiftctg ORDER BY shiftin ASC";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$idhrtapayshiftctg11 = $myrow11['idhrtapayshiftctg'];
			$shiftin11 = $myrow11['shiftin'];
			$shiftout11 = $myrow11['shiftout'];
			$lunchstart11 = $myrow11['lunchstart'];
			$lunchend11 = $myrow11['lunchend'];
			echo "<tr><td>$shiftin11</td><td>-to-</td><td>$shiftout11</td><td>$lunchstart11</td><td>-to-</td><td>$lunchend11</td><td><a href=\"mnghrempshiftctgedit.php?loginid=$loginid&idsc=$idhrtapayshiftctg11\">edit</a></td><td><a href=\"mnghrempshiftctgdel.php?loginid=$loginid&idsc=$idhrtapayshiftctg11\">del</a></td></tr>";
			}
		}
		echo "</table></td></tr>";
  }

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"mnghrmod.php?loginid=$loginid\">Back</a></p>";

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
