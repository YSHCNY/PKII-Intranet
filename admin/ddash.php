<?php
session_start();
	include ("./addons.php");
	
?>
   <?php

// session

	if (isset($_SESSION['success_message'])) {
	?>
		
			<div id="alertDiv" class="alert alert-success" role="alert">
		<?php echo $_SESSION['success_message']; ?>
		</div>

	<?php
		unset($_SESSION['success_message']);
	}
	?>
		<script>
   $(document).ready(function(){
            setTimeout(function(){
                $("#alertDiv").fadeOut("slow", function(){
                    $(this).remove();
                });
            }, 3000); 
        });
		</script>


<!-- error mesage -->
 <?php
	if (isset($_SESSION['error_message'])) {
	?>
		
			<div id="alertDiv" class="alert alert-danger" role="alert">
		<?php echo $_SESSION['error_message']; ?>
		</div>

	<?php
		unset($_SESSION['error_message']);
	}
	?>
		<script>
   $(document).ready(function(){
            setTimeout(function(){
                $("#alertDiv").fadeOut("slow", function(){
                    $(this).remove();
                });
            }, 3000); 
        });
		</script>


		<div class = 'shadow mb-4 p-4'>
			<p class="text-dark fs-3 mb-0 ">Admin Dashboard</p>
			<p class="text-muted fs-4 ">Welcome <?php echo"<strong>$value->name_first $value->name_last</strong>"; ?> to Philkoei International Inc.'s Intranet Admin Access.</p>
		</div>
				
<!-- statistics -->
	<div class=" row mb-5  gap-4">
			<div class = 'col p-5 border shadow rounded-3'>
				<?php include ('ongoingbar.php'); ?>
			</div>

			<div class = 'col p-5 border shadow rounded-3'>
				<?php include ('donutemp.php'); ?>
			</div>
		</div>


		<div class="row p-5 shadow border">
		<div id="" class="col-lg-4 col-12">
				<?php include('ddbirthdays.php'); ?>
			</div>
			<div id="" class="col-lg-4 col-12">
				<?php include('ddholidays.php'); ?>
			</div>
			<div id="" class=" col-lg-4 col-12">
				<?php include('ddscheduler.php'); ?>
			</div>
		
		</div>
	



	


		<div class="">
			<?php include('ddmeetingrms.php'); ?>
		</div>

