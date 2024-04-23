<?php
	include ("addons.php");
?>
	<div class="bg-white gap-2 p-5 shadow rounded-3">
		<div class = 'mb-5'>
			<p class="text-dark fs-3 mb-0 poppins">Admin Dashboard</p>
			<p class="text-muted fs-4 poppins">Welcome <?php echo"<strong>$value->name_first $value->name_last</strong>"; ?> to Philkoei International Inc.'s Intranet Admin Access</p>
		</div>
		<div class="row">
			<div id="" class=" col-lg-4 col-12">
				<?php include('ddbirthdays.php'); ?>
			</div>
			<div id="" class=" col-lg-4 col-12">
				<?php include('ddholidays.php'); ?>
			</div>
			<div id="" class=" col-lg-4 col-12">
				<?php include('ddscheduler.php'); ?>
			</div>
		</div>
		<div class="">
			<?php include('ddmeetingrms.php'); ?>
		</div>
	</div>
