
<!--Main Navigation-->
    
    	<!-- Top menu -->
		
 

	<?php
  session_start();

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
	<?php


?>

<style>
	.navbar{
		z-index: 2!important;
		position: sticky !important;
		top: 0 !important;
	}


</style>
				<?php
// icons



$burger = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
</svg>';

$homeicon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"  width="16" class = "mb-1" height="16">>
  <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
  <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
</svg>
';

$newsicon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"  width="16" class = "mb-1" height="16">
  <path fill-rule="evenodd" d="M4.125 3C3.089 3 2.25 3.84 2.25 4.875V18a3 3 0 0 0 3 3h15a3 3 0 0 1-3-3V4.875C17.25 3.839 16.41 3 15.375 3H4.125ZM12 9.75a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H12Zm-.75-2.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5H12a.75.75 0 0 1-.75-.75ZM6 12.75a.75.75 0 0 0 0 1.5h7.5a.75.75 0 0 0 0-1.5H6Zm-.75 3.75a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5H6a.75.75 0 0 1-.75-.75ZM6 6.75a.75.75 0 0 0-.75.75v3c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75v-3A.75.75 0 0 0 9 6.75H6Z" clip-rule="evenodd" />
  <path d="M18.75 6.75h1.875c.621 0 1.125.504 1.125 1.125V18a1.5 1.5 0 0 1-3 0V6.75Z" />
</svg>';

$intrafeedicon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-workspace mb-1" viewBox="0 0 16 16">
  <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
  <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.4 5.4 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2z"/>
</svg>';

$personalicon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" class = "mb-1" height="16">
  <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
</svg>
';

$directoryicon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" class = "mb-1" height="16">
  <path d="M11.644 1.59a.75.75 0 0 1 .712 0l9.75 5.25a.75.75 0 0 1 0 1.32l-9.75 5.25a.75.75 0 0 1-.712 0l-9.75-5.25a.75.75 0 0 1 0-1.32l9.75-5.25Z" />
  <path d="m3.265 10.602 7.668 4.129a2.25 2.25 0 0 0 2.134 0l7.668-4.13 1.37.739a.75.75 0 0 1 0 1.32l-9.75 5.25a.75.75 0 0 1-.71 0l-9.75-5.25a.75.75 0 0 1 0-1.32l1.37-.738Z" />
  <path d="m10.933 19.231-7.668-4.13-1.37.739a.75.75 0 0 0 0 1.32l9.75 5.25c.221.12.489.12.71 0l9.75-5.25a.75.75 0 0 0 0-1.32l-1.37-.738-7.668 4.13a2.25 2.25 0 0 1-2.134-.001Z" />
</svg>
';

$modulesicon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" class = "mb-1" height="16">
  <path d="M19.5 21a3 3 0 0 0 3-3v-4.5a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h15ZM1.5 10.146V6a3 3 0 0 1 3-3h5.379a2.25 2.25 0 0 1 1.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 0 1 3 3v1.146A4.483 4.483 0 0 0 19.5 9h-15a4.483 4.483 0 0 0-3 1.146Z" />
</svg>
';

        ?>
<nav class="navbar navbar-expand-lg pt-2  menunav">
  <div class="container-fluid">
    <!-- Offcanvas toggle button (for md and below) -->
    <button class="navbar-toggler bg-white  d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
      aria-controls="offcanvasNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <?php echo "<span class = 'text-dark'>$burger</span>";?>
    </button>

    <!-- Brand Logo -->
     <div class="cssanimation rollFromLeft">
    <a class="navbar-brand" href="<?php echo "index.php?lst=1&lid=$loginid&sess=$session"?>">
      <img src="img/PKII-LOGO.png" alt="Bootstrap" width="60" height="26">
    </a></div>

    <!-- Offcanvas for md and below -->
    <div class="offcanvas offcanvas-start d-lg-none menunav" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title text-white"  id="offcanvasNavbarLabel">Intranet Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav nav-underline gap-3 p-4">
          <li class="text-capitalize nav-item ">
            <?php echo "<a class=\"nav-link text-white   \" href=\"index.php?lst=1&lid=$loginid&sess=$session\"> $homeicon Home </a>";?>
          </li>
          <li class="text-capitalize nav-item ">
            <?php echo "<a class=\"nav-link text-white  \" href=\"index.php?lst=1&lid=$loginid&sess=$session&p=43&title=Intra%20Feed%20\">$intrafeedicon Intra Feed </a>";?>
          </li>

          <li class="text-capitalize nav-item ">
          <?php echo "<a class=\"nav-link text-white  \" href=\"index.php?lst=1&lid=$loginid&sess=$session&p=42&title=Intra%News%20\">$newsicon News </a>";?>
        </li>


          <!-- Other Menu Items Here -->

          <li class="dropdown nav-item ">
								<a href="#" class="   nav-link text-white  dropdown-toggle"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $personalicon ?> Personal</a>
								<ul class="dropdown-menu text-start <?php echo $mainbg?>  ">
									<li class="text-capitalize "><?php echo "<a class='dropdown-item $maintext' href=\"{$_SERVER['PHP_SELF']}?lst=1&lid=$loginid&sess=$session&p=11&title=My%20Info&load=1\">My Info</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=12&title=My%20Time%20Log&load=1\">My Time Log</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=44&title=My%20Event%20Planner\">My Event Planner</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=14&title=My%20Activity%20Log&load=1\">My Activity Log</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=15&title=My%20Payslip&load=1\">My Payslip</a>"; ?></li>
								</ul>
							</li>
							<li class="dropdown nav-item ">
								<a  href="#" class="dropdown-toggle text-white nav-link    " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $directoryicon ?> Directory</a>
								<ul class="dropdown-menu text-start <?php echo $mainbg?>  ">
									<li class="text-capitalize <?php echo $Mainbg?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=21&title=Projects\">Projects</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=22&title=Personnels\">Personnel</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=23&title=Business%20Contracts\">Business Contacts</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=24&title=Guides%20and%20Policies\">Guides and Policies</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=25&title=Training%20Materials\">Training Materials</a>"; ?></li>
								</ul>
							</li>


              <li class="dropdown nav-item ">
								<a href="#" class="dropdown-toggle text-white nav-link    " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" ><?php echo $modulesicon ?>Modules</a>
								<ul class="dropdown-menu text-start <?php echo $mainbg?> ">
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=31&title=Files%20Uploader\">File(s) Uploader</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=32title=E-Mail%20Notifier\">E-Mail Notifier</a>"; ?></li>
									<?php if ($emppositionlevel0 >= 3) { ?>
										<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=33&title=Supplies%Request\">Supplies Request</a>"; ?></li>
									<?php } ?>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=34&title=IT%20Support%20Request\">IT Support Request</a>"; ?></li>
									<?php if ($emppositionlevel0 >= 3) { ?>
										<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=35&title=HR%20Request\">HR Personnel Request</a>"; ?></li>

									<?php } ?>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=36&title=OT%20Leave%20Form\">O.T & Leave Form</a>"; ?></li>
									<?php //if (($found11 == 1 && $activesw11 == 1) || $found10 == 1) {
										//if ($empdepartment0 == 'ITD' || $empdepartment0 == 'FIN' || $empdepartment0 == 'HRD') { ?>
										<?php //}
									//} ?>
								</ul>
							</li>




        </ul>
      </div>
    </div>

    <!-- Expandable Navbar for lg and above -->
    <div class=" d-lg-block d-none  " id="navbarSupportedContent">
      <ul class="navbar-nav nav-underline">
        <li class="text-capitalize nav-item mx-2">
          <?php echo "<a class=\"nav-link text-white  px-2\" href=\"index.php?lst=1&lid=$loginid&sess=$session\"> $homeicon Home </a>";?>
        </li>
        <li class="text-capitalize nav-item mx-2">
          <?php echo "<a class=\"nav-link text-white  px-2\" href=\"index.php?lst=1&lid=$loginid&sess=$session&p=43&title=Intra%20Feed%20\">$intrafeedicon Intra Feed </a>";?>
        </li>

        <li class="text-capitalize nav-item mx-2">
          <?php echo "<a class=\"nav-link text-white  px-2\" href=\"index.php?lst=1&lid=$loginid&sess=$session&p=42&title=Intra%20News%20\">$newsicon News </a>";?>
        </li>


               
			

              
        <!-- Other Menu Items Here -->

        <li class="dropdown nav-item mx-2">
								<a href="#" class="   nav-link text-white px-2 dropdown-toggle"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $personalicon ?> Personal</a>
								<ul class="dropdown-menu text-start  <?php echo $mainbg?>  ">
									<li class="text-capitalize "><?php echo "<a class='dropdown-item $maintext' href=\"{$_SERVER['PHP_SELF']}?lst=1&lid=$loginid&sess=$session&p=11&title=My%20Info&load=1\">My Info</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=12&title=My%20Time%20Log&load=1\">My Time Log</a>"; ?></li>
                  <li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=44&title=My%20Event%20Planner\">My Event Planner</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=14&title=My%20Activity%20Log&load=1\">My Activity Log</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=15&title=My%20Payslip&load=1\">My Payslip</a>"; ?></li>
								</ul>
							</li>

							<li class="dropdown nav-item mx-2">
								<a  href="#" class="dropdown-toggle text-white nav-link  px-2  " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $directoryicon ?> Directory</a>
								<ul class="dropdown-menu text-start <?php echo $mainbg?>  ">
									<li class="text-capitalize <?php echo $mainbg?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=21&title=Projects\">Projects</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=22&title=Personnels\">Personnel</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=23&title=Business%20Contracts\">Business Contacts</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=24&title=Guides%20and%20Policies\">Guides and Policies</a>"; ?></li>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=25&title=Training%20Materials\">Training Materials</a>"; ?></li>
								</ul>
							</li>


              <li class="dropdown nav-item mx-2">
								<a href="#" class="dropdown-toggle text-white nav-link  px-2  " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" ><?php echo $modulesicon ?>Modules</a>
								<ul class="dropdown-menu text-start <?php echo $mainbg?> ">
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=31&title=Files%20Uploader\">File(s) Uploader</a>"; ?></li>
                  <li class="text-capitalize <?php echo $maintext?>"><?php echo "<a  class='dropdown-item $maintext' href='' data-toggle='modal' data-target='#emailmodal' > Email</a>"; ?></li> 
                   
								
									<?php if ($emppositionlevel0 >= 3) { ?>
										<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=33&title=Supplies%Request\">Supplies Request</a>"; ?></li>
									<?php } ?>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=34&title=IT%20Support%20Request\">IT Support Request</a>"; ?></li>
									<?php if ($emppositionlevel0 >= 3) { ?>
										<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=35&title=HR%20Request\">HR Personnel Request</a>"; ?></li>

									<?php } ?>
									<li class="text-capitalize <?php echo $maintext?>"><?php echo "<a class='dropdown-item $maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=36&title=OT%20Leave%20Form\">O.T & Leave Form</a>"; ?></li>
									<?php //if (($found11 == 1 && $activesw11 == 1) || $found10 == 1) {
										//if ($empdepartment0 == 'ITD' || $empdepartment0 == 'FIN' || $empdepartment0 == 'HRD') { ?>
										<?php //}
									//} ?>
								</ul>
							</li>
              
      </ul>
    </div>


    <div class="text-end  d-lg-block d-none">
      <ul class="nav">
        <?php if ($picfn0 != '') {
          $picfnfin = "<img height='20' width='20' class='img-circle' src='$pathavatar/$picfn0' id='picfnfin'/>";
        } else {
          $picfnfin = "<img height='20' width='20' class='img-circle' src='./img/nopp.png' id='picfnfin' />";
        } ?>
        <li class="dropdown nav-item mx-2">
          <button class="dropdown-toggle <?php echo $maintext ?> shadow rounded text-white px-3 py-2 avatar nav-link " data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <?php echo "$picfnfin "; ?><span class='fs-5'><?php echo "$name_first0&nbsp;$name_last0&nbsp;" ?></span>
          </button>
          <ul class="dropdown-menu text-start <?php echo $mainbg?> ">
            <li><?php echo "<a class = '$maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=41\">Change password</a>"; ?></li>
            <li><?php echo "<a class = '$maintext' href=\"logout.php?lst=1&lid=$loginid&sess=$session&pn\">Logout</a>"; ?></li>

            <li><hr class="dropdown-divider"></li>
            <li>
            <form action="../admin/admlogin.php" class = 'text-center' method="post">
              <input type="hidden" name = 'username' value = "<?php echo $_SESSION['fetchun'];?>">
              <input type="hidden" name = 'password' value = "<?php echo $_SESSION['fetchpass'];?>">

             <button class = '<?php echo $maintext ?> btn btn-primary' type= 'submit'>Log in to Admin</button>

              </form>
            </li>

          </ul>
        </li>

      </ul>

    </div>




    <div class="text-end  d-lg-none d-block">
      <ul class="nav">
        <?php if ($picfn0 != '') {
          $picfnfin = "<img height='20' width='20' class='img-circle' src='$pathavatar/$picfn0' id='picfnfin'/>";
        } else {
          $picfnfin = "<img height='20' width='20' class='img-circle' src='./img/nopp.png' id='picfnfin' />";
        } ?>

<div class="btn-group dropstart">
  <button type="button" class="btn avatar dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
  <?php echo "$picfnfin "; ?>
  </button>
  <ul class="dropdown-menu text-start <?php echo $mainbg?> ">
            <li><?php echo "<a class = '$maintext' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=41\">Change password</a>"; ?></li>
            <li><?php echo "<a class = '$maintext' href=\"logout.php?lst=1&lid=$loginid&sess=$session&pn\">Logout</a>"; ?></li>

            <li><hr class="dropdown-divider"></li>
            <li>
            <form action="../admin/admlogin.php"  class = 'text-center' method="post">
              <input type="hidden" name = 'username' value = "<?php echo $_SESSION['fetchun'];?>">
              <input type="hidden" name = 'password' value = "<?php echo $_SESSION['fetchpass'];?>">

             <button class = '<?php echo $maintext ?> btn btn-primary' type= 'submit'>Log in to Admin</button>

              </form>
            </li>

          </ul>
</div>


       

      </ul>

    </div>


  </div>
</nav>






				<?php
session_start();


$darkMode = isset($_SESSION['drkmd']) && $_SESSION['drkmd'] == 1;
?>






		<?php $picshrdpst = "<img alt='User Image' class='img-fluid rounded-circle border ' style='max-width: 50px; height: 50px; object-fit: cover;' src='$pathavatar/$picfn0' id='picfnfin' />";?>
    
    
	 
<style>
.avatar:hover{
  box-shadow: 0 0 1px rgba(0, 0, 0, 0.63) !important;
  


}

.avatar{
  background-color: #4a4a4a !important;
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.63) !important;
  transition: .2s ease-in-out;

}
/* .navbar {
  transition: background-color 0.3s ease;
  box-shadow: 0 5px 8px rgba(0, 0, 0, 0.2);
}

.navbar.scrolled {
  background-color: #031741 !important; 
  border-bottom: 1px solid white !important;
  
} */



/* .navbar.scrolled .textnavA {
    color: white !important;
    border-bottom: 3px solid #031741;
}

.navbar.scrolled .textnavA:hover,
.navbar.scrolled .textnavA:focus,
.navbar.scrolled .textnavA:active {
    background-color: white !important;
    color: #031741 !important;
    border-bottom: 3px solid #031741;
}


.textnavA {
    color: #031741 !important;
    margin: 1px 3rem 1px 3rem !important;
    transition: 0.3s !important;
    background-color: transparent !important;
    border-bottom: 3px solid white;
}

.textnavA:hover,
.textnavA:focus,
.textnavA:active {
    background-color: white !important;
    color: #031741 !important;
    border-bottom: 3px solid #031741;
    transition: 0.3s !important;
} */



</style>
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







<!-- Modal -->
<div class="modal fade " id="staticBackdropActlog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  ">
    <div class="modal-content ">
      <div class="modal-header mx-auto ">
        <h5 class="modal-title border-0"  id="staticBackdropLabel">Activity Log</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body" >
       <?php
      
       
       include 'mactivitylogfrm.php'; ?>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
