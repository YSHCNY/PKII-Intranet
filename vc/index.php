

<!-- <div class="row"> -->

<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
	
	 
	// display header
	include("header.php");

	// temp var replace with $_POST['loginstat']
	$loginstat = $_POST['loginstat'];
	$loginstat=0;
	$loginstat = (isset($_GET['lst'])) ? $_GET['lst'] :'';
	$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
	$session = trim((isset($_GET['sess'])) ? $_GET['sess'] :'');
	$page = trim((isset($_GET['p'])) ? $_GET['p'] :'');

//   get page source (from what page?) if exists
  	$pgsrc = (isset($_GET['ps'])) ? $_GET['ps'] :'';

	if($loginstat=='') { $loginstat=0; }

	// check if logged-in else display login form
	if($loginstat==1) {
		// $_SESSION['username'] = $username; 
		// $_SESSION['employeeid'] = $employeeid; 
		// check loginid and session is valid
		include("../m/qryloginverify.php");

		if($found0==1) { //checks if user has logged in
			header("Cache-Control: no-cache, no-store, must-revalidate");
			header("Pragma: no-cache");
			header("Expires: 0");
		// display main navigation based on selected menu
		include("menu.php");
		include("indexlinks.php");
		
	
		exit();
		
	

		} else { 
			header("Location: index.php?loginstat=denied");
    		exit();
			
		}

	} else { // if($loginstat==1)
		include("login.php"); //the loging page 
	 } // if($loginstat==1)


?>



