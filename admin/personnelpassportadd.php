<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = (isset($_GET['eid'])) ? $_GET['eid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}
?>

<script language="JavaScript" src="ts_picker.js"></script>  

<?php
if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Add passport no.</font></p>";

     echo "<table class=\"fin2\" border=\"1\">";
     echo "<tr><th colspan=\"2\">Add passport details</th></tr>";

     if ($employeeid == '')
     {
	echo "<tr><td colspan=\"2\"><font color=\"red\"><b>Sorry. No data available</b></font></td></tr>";
     }
     else
     {

	$resquery = "SELECT name_last, name_first, name_middle, position FROM tblcontact WHERE employeeid = \"$employeeid\" AND contact_type=\"personnel\"";
	$result = $dbh2->query($resquery);
	if($result->num_rows>0) {
		// while ($myrow = mysql_fetch_row($result)) {
		while($myrow = $result->fetch_assoc()) {
	  $found = 1;
	  $name_last = $myrow['name_last'];
	  $name_first = $myrow['name_first'];
	  $name_middle = $myrow['name_middle'];
	  $position = $myrow['position'];
		} // while($myrow = $result->fetch_assoc())
	} // if($result->num_rows>0)

	echo "<tr><th colspan=\"2\">for: $employeeid - <b>$name_last, $name_first $name_middle[0]</b> - $position</th></tr>";

// start add education

	echo "<form action=\"personnelpassportadd2.php?loginid=$loginid&eid=$employeeid\" method=\"post\" name=\"perspassportadd\">";
	echo "<tr><th align=\"right\">Passport number</th><td><input name=\"passportnum\"></td></tr>";
	echo "<tr><th align=\"right\">Issuing country</th><td>";
	echo "<select name=\"countrycd\">";
	$res18query = "SELECT cname, letter2cd FROM tblcountrycd ORDER BY cname ASC";
	$result18=""; $found18=0; $ctr18=0;
	// $result18 = mysql_query("$res18query", $dbh);
	$result18 = $dbh2->query($res18query);
	// if($result18 != "") {
	if($result18->num_rows>0) {
		// while($myrow18 = mysql_fetch_row($result18)) {
		while($myrow18 = $result18->fetch_assoc()) {
		$found18 = 1;
		$ctr18 = $ctr18 + 1;
		$cname18 = $myrow18['cname'];
		$letter2cd18 = $myrow18['letter2cd'];
		if($letter2cd18=="PH") { $letter2cdsel="selected"; } else { $letter2cdsel=""; }
		echo "<option value=\"$letter2cd18\" $letter2cdsel>$cname18 ($letter2cd18)</option>";
		} // while($myrow18 = $result18->fetch_assoc())
	} // if($result18->num_rows>0)
	echo "</select>";
	echo "</td></tr>";
	echo "<tr><th align=\"right\">Issued by</th><td><input name=\"issuedby\"></td></tr>";
	echo "<tr><th align=\"right\">Issued date</th><td><input name=\"dateissued\" value=\"$datenow\">";
	?>
  	<a href="javascript:show_calendar('document.perspassportadd.dateissued', document.perspassportadd.dateissued.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  <?php
	echo "</td></tr>";
	echo "<tr><th align=\"right\">Expiry date</th><td><input name=\"dateexpiry\" value=\"$datenow\">";
	?>
  	<a href="javascript:show_calendar('document.perspassportadd.dateexpiry', document.perspassportadd.dateexpiry.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  <?php
	echo "</td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Add passport\"></td></tr>";
	echo "</table></form>";

// end add education

     }
 
     echo "<p><a href=\"personneledit2.php?loginid=$loginid&pid=$employeeid\">Back</a><br>";

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
