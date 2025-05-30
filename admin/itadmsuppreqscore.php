<?php
// from itadmsuppreq.php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$iditsupportreq = (isset($_POST['its'])) ? $_POST['its'] :'';
$scoreempid = (isset($_POST['scoreempid'])) ? $_POST['scoreempid'] :'';
$scoreval = (isset($_POST['scoreval'])) ? $_POST['scoreval'] :'';
$scorestamp = (isset($_POST['scorestamp'])) ? $_POST['scorestamp'] :'';
$scoreremarks = (isset($_POST['scoreremarks'])) ? $_POST['scoreremarks'] :'';

$found = 0;
$accesslevel11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

	if($scoreval!='') {

	// update query
	$res12query="UPDATE tblitsupportreq SET scoreval=\"$scoreval\", scorestamp=\"$scorestamp\", scoreempid=\"$scoreempid\", scoreremarks=\"$scoreremarks\" WHERE iditsupportreq=$iditsupportreq";
	$result12 = $dbh2->query($res12query);
	// echo "<p>res12query:$res12query</p>";

	// display result
	echo "<p><font color=\"green\">its:$iditsupportreq, EmpID:$scoreempid, Score:$scoreval, stamp:$scorestamp</font></p>";

	} // if($scoreval!='')

	echo "<form method=\"POST\" action=\"itadmsuppreqdtl.php?loginid=$loginid&its=$iditsupportreq\" name=\"itadmsuppreqdtl\">";
	echo "<p><input type=\"submit\" value=\"Back\"></p>";
	echo "</form>";

	// redirect
	//header("Location: itsuppreq.php?loginid=$loginid");
	// exit;

	// echo "<p><a href=\"itadmsuppreq.php?loginid=$loginid\">back</a></p>";

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result = $dbh2->query($resquery);
     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
