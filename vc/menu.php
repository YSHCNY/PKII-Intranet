
<!--Main Navigation-->
    
    	<!-- Top menu -->
		

	<?php
	$loginstat = urlencode($loginstat); // Ensure special characters are properly encoded
	$loginid = urlencode($loginid); // Ensure special characters are properly encoded
	$session = urlencode($session); // Ensure special characters are properly encoded

	// if(isset($_SESSION['username']) && isset($_SESSION['employeeid']) ) {
	// 	$username = $_SESSION['username']; // Retrieve the username from the session
	// 	$empid = $_SESSION['employeeid'];
	// } else {
	// 	// Redirect the user to the login page if not logged in
	// 	header("Location: index.php");
	// 	exit();
	// }
	?>
	


<nav class="navbar navbar-expand-md fs-5 bg-white navbar-fixed-top mb-5 shadow-lg p-5"  role="navigation">
			
			<div class="container">
			
					
				
			<div class="">
							<img src="img/newlogo.png" width = '200' height = '40' class="mb-3" alt="">
						</div>
						<div class = ' ms-3 py-4 mb-3 px-1 rounded-4'></div>
					
						<div class="">
						<button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#top-navbar-1" aria-controls="top-navbar-1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
						</div>
				
		
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse " id="top-navbar-1">
					<ul class="nav navbar-nav float-none float-md-end">
											
					
							<li class="text-capitalize nav-item">
								<?php echo "<a class=\"fs-5 textnavA\" href=\"index.php?lst=1&lid=$loginid&sess=$session\">Home </a>";?>
							</li>
							<li class="dropdown nav-item">
								<a href="#" class="fs-5 textnavA nav-link dropdown-toggle"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Personal</a>
								<ul class="dropdown-menu dmla px-5 py-3">
									<li class="text-capitalize"><?php echo "<a href=\"{$_SERVER['PHP_SELF']}?lst=1&lid=$loginid&sess=$session&p=11\">My Info</a>"; ?></li>
									<li class="text-capitalize"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=12\">My Time Log</a>"; ?></li>
									<li class="text-capitalize"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=14\">My Activity Log</a>"; ?></li>
									<li class="text-capitalize"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=15\">My Payslip</a>"; ?></li>
								</ul>
							</li>
							<li class="dropdown nav-item">
								<a href="#" class="dropdown-toggle fs-5 textnavA" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Directory</a>
								<ul class="dropdown-menu dmla px-5 py-3">
									<li class="text-capitalize"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=21\">Projects</a>"; ?></li>
									<li class="text-capitalize"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=22\">Personnel</a>"; ?></li>
									<li class="text-capitalize"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=23\">Business Contacts</a>"; ?></li>
									<li class="text-capitalize"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=24\">Guides and Policies</a>"; ?></li>
									<li class="text-capitalize"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=25\">Training Materials</a>"; ?></li>
								</ul>
							</li>
							<li class="dropdown nav-item">
								<a href="#" class="dropdown-toggle fs-5 textnavA" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Modules</a>
								<ul class="dropdown-menu dmla px-5 py-3">
									<li class="text-capitalize"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=31\">File(s) Uploader</a>"; ?></li>
									<li class="text-capitalize"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=32\">E-Mail Notifier</a>"; ?></li>
									<?php if ($emppositionlevel0 >= 3) { ?>
										<li class="text-capitalize"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=33\">Supplies Request</a>"; ?></li>
									<?php } ?>
									<li class="text-capitalize"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=34\">IT Support Request</a>"; ?></li>
									<?php if ($emppositionlevel0 >= 3) { ?>
										<li class="text-capitalize"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=35\">HR Personnel Request</a>"; ?></li>
										
										<li class="text-capitalize"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=36\">O.T & Leave Form</a>"; ?></li>

									<?php } ?>
									<?php //if (($found11 == 1 && $activesw11 == 1) || $found10 == 1) {
										//if ($empdepartment0 == 'ITD' || $empdepartment0 == 'FIN' || $empdepartment0 == 'HRD') { ?>
										<?php //}
									//} ?>
								</ul>
							</li>
							<?php if ($picfn0 != '') {
								$picfnfin = "<img height='20' class='img-circle'  src='$pathavatar/$picfn0' id='picfnfin'/>";
							} else {
								$picfnfin = "<img height='20' class='img-circle' src='$pathavatar/default.gif' id='picfnfin' />";
							} ?>
							<li class="dropdown nav-item ">
								<a href="#" class="dropdown-toggle textnavA" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo "$picfnfin"; ?></a>
								<ul class="dropdown-menu">
									<li class="text-secondary ms-3 nav-item"><?php echo "$name_first0&nbsp;$name_last0&nbsp;" ?></li>
									<li><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=41\">Change password</a>"; ?></li>
									<li><?php echo "<a href=\"logout.php?lst=1&lid=$loginid&sess=$session&pn\">Logout</a>"; ?></li>
								</ul>
							</li>
						</ul>

				</div>
			</div>
		</nav>




		
    
       <br><br><br>
	 

	   <script>
		window.addEventListener('scroll', function() {
    var navbar = document.getElementById('navbar');
    if (window.scrollY > 0) {
        navbar.classList.add('scrolled');
        navbar.classList.add('bg-scrolled');
    } else {
        navbar.classList.remove('scrolled');
        navbar.classList.remove('bg-scrolled');
    }
});
	   </script>