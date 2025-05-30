

<!-- <div class="row"> -->

<?php

	 
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
// var_dump($loginstat,$found0,$res0query);
		if($found0==1) { //checks if user has logged in
			header("Cache-Control: no-cache, no-store, must-revalidate");
			header("Pragma: no-cache");
			header("Expires: 0");
		// display main navigation based on selected menu

		?>

<!-- <style>
    .hair {
        z-index: 99999 !important;
        position: fixed !important;
        top: 50%;
        left: 40%;
        transform: translate(-50%, -30%);
        pointer-events: none;
        width: 200px;
        height: auto;
        opacity: 0;
        transition: opacity 1s;
    }

    @keyframes fadeOut {
        0% { opacity: 1; }
        100% { opacity: 0; display: none; }
    }
</style> -->

<!-- <img src="download.png" class="hair" id="hairImage" alt=""> -->

<script>
    // document.addEventListener("DOMContentLoaded", function () {
    //     if (!localStorage.getItem("imageDisplayed")) {
    //         let randomTime = Math.floor(Math.random() * (30000 - 5000)) + 5000; 

    //         setTimeout(() => {
    //             let image = document.getElementById("hairImage");
    //             image.style.opacity = "1"; 
                
    //             setTimeout(() => {
    //                 image.style.animation = "fadeOut 5s forwards"; 
    //                 localStorage.setItem("imageDisplayed", "true"); 
    //             }, 5000);
    //         }, randomTime);
    //     }
    // });
</script>
		



		
		<?php


		include("menu.php");
		include("indexlinks.php");
		
		
		?>
		


		<?php
	
		exit();
		
	

		} else { 
			header("Location: index.php?loginstat=denied");
    		exit();
			
		}

	} else { // if($loginstat==1)
		include("login.php"); //the loging page 
	 } // if($loginstat==1)


?>



