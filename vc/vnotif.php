<?php
//
// vnotif.php
//
?>
	
	<div class="<?php echo $bgclass; ?> p-5 ">
	<div class="p-5 m-5">
	<h1 class=" text-white fw-bold text-center mt-5 pt-5"><?php echo $header; ?></h1>
	<h3 class = 'px-5  text-center text-white'><?php echo $h4txtdisp; ?></h3></div>

			<!-- <h4 class="<?php //echo $clstxtclr; ?>"><?php //echo $h4txtdisp; ?></h4> -->

	

			<div class="flex text-center mx-auto justify-content-center pb-5 mb-5 align-items-center">
			<?php echo "<form action=\"$frmact\" method=\"$frmmtd\" name=\"$frmnm\">"; ?>
			<button type="<?php echo $btntyp; ?>" class="<?php echo $btncls; ?>"><?php echo $btnnm; ?></button>
			<?php echo "</form>"; ?>
			</div>
			</div>
	</div>
