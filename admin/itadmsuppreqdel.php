<?php
// from itadmsuppreq.php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$iditsupportreq = (isset($_POST['idits'])) ? $_POST['idits'] :'';

$found = 0;
$accesslevel11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

	// update query
	$res12query="DELETE FROM tblitsupportreq WHERE iditsupportreq=$iditsupportreq";
	$result12 = $dbh2->query($res12query);
	// echo "<p>res12query:$res12query</p>";

	// display result
	echo "<h3 class='text-danger'>Support request deleted!</h3>";
  echo "<p>id:$iditsupportreq</p>";

	echo "<form method=\"POST\" action=\"itadmsuppreq.php?loginid=$loginid\" name=\"itadmsuppreq\">";
	echo "<p><button type=\"submit\" class='btn btn-light'>Back</button></p>";
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
