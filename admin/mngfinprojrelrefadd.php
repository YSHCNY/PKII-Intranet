<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
  echo "<p><font size=1>Manage >> Accounting Modules >> Project relationships >> Add new</font></p>";

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

  echo "<tr><th colspan=\"2\">Project Relationships - Add new</th></tr>";

// start contents here...

  echo "<form action=\"mngfinprojrelrefadd2.php?loginid=$loginid\" method=\"post\" name=\"mngfinprojrelrefadd2\">";
	// echo "<tr><th align=\"right\">id</th><td>$projrelrefid</td></tr>";
	echo "<tr><th align=\"right\">code</th><td><input name=\"code\"></td></tr>";
	// echo "<tr><th align=\"right\">name</th><td><input name=\"name\"></td></tr>";
	echo "<tr><th align=\"right\">company name</th><td>";
	// echo "<input name=\"companyid\" value=\"$companyid11\">";
	// radio1 company dropdown
	echo "<input type=\"radio\" name=\"companytyp\" value=\"dropdown\" checked>";
	echo "<select name=\"companyid\">";
	echo "<option value=''>Select company name</option>";
	// query tblcompany
	$res11query="SELECT companyid, company FROM tblcompany WHERE company<>'' ORDER BY company ASC";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$ctr11 = $ctr11+1;
		$companyid11 = $myrow11['companyid'];
		$company11 = $myrow11['company'];
		echo "<option value=\"$companyid11\">$company11</option>";
		} // while
	} // if
	echo "</select>";
	echo "<br>";
	// radio2 input field
	echo "<input type=\"radio\" name=\"companytyp\" value=\"manual\">";
	echo "<input size=\"60\" name=\"companynamemanual\">";
	echo "</td></tr>";
	echo "<tr><th align=\"right\">level</th><td><input type=\"number\" min=\"0\" max=\"3\" name=\"tablevel\"></td></tr>";
	echo "<tr><th align=\"right\">sequence</th><td><input type=\"number\" min=\"10\" max=\"1000\" step=\"1\" name=\"seq\"></td></tr>";
	echo "<tr><th align=\"right\">nkconsolidated</th><td><input type=\"number\" min=\"0\" max=\"1\" name=\"nkconso\"></td></tr>";
	echo "<tr><th align=\"right\">coderef</th><td><input name=\"codeprev\"></td></tr>";
	echo "<tr><th align=\"right\">frmsheet</th><td><input name=\"strvssht\"></td></tr>";
	echo "<tr><th align=\"right\">remarks</th><td><textarea cols=\"30\" rows\"3\" name=\"remarks\"></textarea></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Add\"></td></tr>";
	echo "</form>";

// end contents here...

  echo "</table>";

// edit body-footer
     echo "<p><a href=\"mngfinprojrelref.php?loginid=$loginid\">Back</a></p>";

     $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid"; 
		$result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?>
