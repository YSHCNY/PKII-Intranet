	<?php
	//
	// fr: ../views/loginverify.php
	// ../models/qrylogin.php
	require("../includes/dbh.php");
	session_start(); //new
	$res0query="SELECT loginid FROM tbllogin WHERE username=\"$username\" AND password=md5(\"$password\") LIMIT 1";
	$result0=""; $found0=0; $ctr0=0;
	$result0=$dbh->query($res0query);
	if($result0->num_rows>0) {
		while($myrow0=$result0->fetch_assoc()) {
		$found0=1;
		$loginid0 = $myrow0['loginid'];
		$_SESSION['loginid'] = $loginid0; 
		} // while
	} // if
	// echo "<p>f0:$found0, loginid0:$loginid0<br>r0q:$res0query</p>";
	// close db conn
	$dbh->close();

	?>
