

<?php
//
// logout.php
// fr:index.php

$loginid = $_GET['lid'];
// $session = $_GET['sess'];

// if($loginid!='' && $session!='') {
	if($loginid!='') {
	// verify login
	// check loginid and session is valid
	include '../m/qryloginverify.php';

	if($found0==1) {	

	$usrip=$_SERVER['REMOTE_ADDR'];
	$usrosbrowserver=$_SERVER['HTTP_USER_AGENT'];

	// update tbllogin and tblloginstatus
	$logdetails="$username0 has logged-out on $now using $usrip and $usrosbrowserver.";
	
	include '../m/qrylogout.php';


	$logdetails="";
	

	// display header
	include './header.php';
?>

	<!-- <div class="wrapper">
<div id="container1" style="position:relative; display:block; clear:both; border:0; padding:0; text-indent:0; margin:0 auto; text-align:center;">
<div class="form-group">
			<img src="img/pkiilogo1.png">
</div>
<div class="form-group">
      <h3 class="form-signin-heading"><font color="red">Logged-out</font></h3>
</div>

<div class="form-group">
	<?php //echo "<button type=\"submit\" class=\"btn btn-lg btn-primary btn-block\" name=\"Back to Login\" onclick=\"javascript:window.location='./index.php'\">Login</button>"; ?>
</div>

</div> 
  </div> <div class="wrapper"> -->

<?php
	// display footer
	include './footer.php';

	} // if

} // if
?>

