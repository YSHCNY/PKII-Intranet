<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$iditsr = (isset($_GET['itsr'])) ? $_GET['itsr'] :'';

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
     echo "<p><font size=1>Manage >> Categories >> IT Support requests</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

     echo "<tr><th colspan=\"5\">IT Support Requests - Edit</th></tr>";

// start contents here...
  if($accesslevel >= 4) {
	// query tblitctgsuppreq

	$res12query = "SELECT code, name, ctgtype FROM tblitctgsuppreq WHERE idtblctgsuppreq=$iditsr";
	$result12=""; $found12=0; $ctr12=0;
	$result12 = $dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12 = $result12->fetch_assoc()) {
		$found12 = 1;
		$code12 = $myrow12['code'];
		$name12 = $myrow12['name'];
		$ctgtype12 = $myrow12['ctgtype'];
		} // while($myrow12 = $result12->fetch_assoc())
	} // if($result12->num_rows>0)

	if($found12 == 1) {

	echo "<form method=\"post\" action=\"mngitsuppreqedit2.php?loginid=$loginid&itsr=$iditsr\" name=\"mngitsuppreqedit\">";
	echo "<tr><th align=\"right\">Code</th>";
		echo "<td><input name=\"itsrcd\" value=\"$code12\"></td></tr>";
		echo "<tr><th align=\"right\">Name</th>";
		echo "<td><input size=\"50\" name=\"itsrname\" value=\"$name12\"></td></tr>";
		echo "<tr><th align=\"right\">Type</th>";
		if($ctgtype12=="REQ") { $ctgtypreqsel="selected"; $ctgtypactsel=""; $ctgtypnonsel=""; } else if($ctgtype12=="ACT") { $ctgtypreqsel=""; $ctgtypactsel="selected"; $ctgtypnonsel=""; } else { $ctgtypreqsel=""; $ctgtypactsel=""; $ctgtypnonsel="selected"; }
		echo "<td>";
		echo "<select name=\"itsrtype\">";
		echo "<option value='' $ctgtypnnsel>-</option>";
		echo "<option value=\"REQ\" $ctgtypreqsel>Request</option>";
		echo "<option value=\"ACT\" $ctgtypactsel>Action</option>";
		echo "</select>";
		echo "</td></tr>";
    echo "<tr><td colspan=\"2\" align=\"center\"><input type=submit value=\"Save\"></td></tr>";
	echo "</form>";

	} // if($found12 == 1)
  } // if($accesslevel >= 4)

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"mngitsuppreq.php?loginid=$loginid\">Back</a></p>";

	$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
	$result = $dbh2->query($resquery);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

$dbh2->close();
?> 
