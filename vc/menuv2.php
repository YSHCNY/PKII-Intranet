
<!--Main Navigation-->
    
    	<!-- Top menu -->
		

        <?php
		session_start();
	?>

		<nav class="navbar navbar-inverse bg-white navbar-expand-lg navbar-fixed-top mb-5 shadow-lg"  role="navigation">
			<div class="container-fluid  ">
				<div class="row">
					<div class="col ms-lg-5">
						<div class="text-end">
							<img src="img/newlogo.png" class=" img-fluid w-50  m-5 " alt="">
						</div>
					</div>

					<div class="col">
						<div class="text-end">
						<button class="navbar-toggler  m-5" type="button" data-bs-toggle="collapse" data-bs-target="#top-navbar-1" aria-controls="top-navbar-1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
						</div>
					</div>
				</div>
		
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="top-navbar-1">
					<ul class="nav navbar-nav">
					
				
	<ul class="nav navbar-nav text-center">
	<li class = "">
					<a class="m-1 textnavA" href="./">Home</a>
				
				</li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle m-1 textnavA" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Personal Details</a>
          <ul class="dropdown-menu dmla">
            <li class = ""><a href="./info">My Info</a></li>
            <li class = ""><?php echo "<a href=\"#\">My Time Log</a>"; ?></li>
            <li class = ""><?php echo "<a href=\"#\">My Activity Log</a>"; ?></li>
            <li class = ""><?php echo "<a href=\"#\">My Payslip Summary</a>"; ?></li>
          </ul>
        </li>
		<li class="dropdown">
          <a href="#" class="dropdown-toggle m-1 textnavA" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Directory</a>
         <ul class="dropdown-menu dmla">
            <li class = ""><?php echo "<a href=\"#\">Projects</a>"; ?></li>
            <li class = ""><?php echo "<a href=\"#\">Personnel</a>"; ?></li>
            <li class = ""><?php echo "<a href=\"#\">Business Contacts</a>"; ?></li>
            <li class = ""><?php echo "<a href=\"#\">Guides and Policies</a>"; ?></li>
			<li class = ""><?php echo "<a href=\"#\">Training Materials</a>"; ?></li>
          </ul>
        </li>
		<li class="dropdown">
          <a href="#" class="dropdown-toggle m-1 textnavA" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Modules</a>
          <ul class="dropdown-menu dmla">
            <li class = ""><?php echo "<a href=\"#\">File(s) Uploader</a>"; ?></li>
            <li class = ""><?php echo "<a href=\"#\">E-Mail Notifier</a>"; ?></li>
<?php
	if($emppositionlevel0>=3) {
?>
            <li class = ""><?php echo "<a href=\"#\">Supplies Request</a>"; ?></li>
<?php
	} // if
?>
            <li class = ""><?php echo "<a href=\"#\">IT Support Request</a>"; ?></li>
<?php
	if($emppositionlevel0>=3) {
?>
            <li class = ""><?php echo "<a href=\"#\">HR Personnel Request</a>"; ?></li>
<?php
	} // if

	// start OT/Leave Form
	// query tblhrtapaygrpemplst
	include '../m/qryhrtapaygrpemplst.php';
	// if($activesw11==1) {
	// query approver
	include '../m/qryitapprover.php';

	if(($found11==1 && $activesw11==1) || $found10==1) {
		if($empdepartment0 == 'ITD' || $empdepartment0 == 'FIN' || $empdepartment0 == 'HRD') {
?>
		<li><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=36\">O.T./Leave Form</a>"; ?></li>
<?php
	// } // if
?>
<!--
		<li><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=37\">C.A./Liquidation Form</a>"; ?></li>
-->

		<?php 
		} // if($empdepartment0 == 'ITD')
	} // if($found11==1 && $activesw11==1)
		?>

<!-- 20230320 add new dropdown PKII-CPD -->
<!--            <li><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=38\">PKII-CPD</a>"; ?></li> -->

          </ul>
        </li>	
<?php
	if($picfn0!='') {
		$picfnfin="<img height='25' class='img-circle'  src='$pathavatar/$picfn0' id='picfnfin'/>";
	} else {
		$picfnfin="<img height='25' class='img-circle' src='$pathavatar/default.gif' id='picfnfin' />";
	} // if
?>
	<li class="dropdown">
          <a href="#" class="dropdown-toggle m-1 textnavA" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo "$picfnfin"; ?></a>
          <ul class="dropdown-menu">
<!-- <li><?php echo "f11:$found11,actv:$activesw11,f10:$found10"; ?></li> -->
<li class="text-secondary ms-3"><?php echo "$name_first0&nbsp;$name_last0&nbsp;" ?></li>
            <li><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=41\">Change password</a>"; ?></li>
		        <li> <li><?php echo "<a href=\"../m/qrylogout.php\">Logout</a>"; ?></li>    
					<?php //echo "<a href=\"logout.php?lst=1&lid=$loginid&sess=$session&pn\">Logout</a>"; ?></li>            
          </ul>
        </li>


		<!-- <li>
      <ul class="nav navbar-nav navbar-right">
        <li><?php //echo "<a href=\"logout.php?lst=1&lid=$loginid&sess=$session&pn\">Logout</a>"; ?></li>
      </ul>
		</li> -->
						
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