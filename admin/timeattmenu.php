<?php
include("db1.php");
include("addons.php");
$active = $_GET['act'];

?>

<style>
    /* #ta-div{
     height: 240px;
	} */
	

    #TA{
        font-size: 3rem !important;
    }

  

 
    

	/* @media (max-width: 767px) {
		#ta-div{
     		height: 100%;
		}
		.btn{
			padding: 4% !important;
		}
	} */
</style>

<?php
    if ($active == 'lvact'){
        $lvact = 'btn-success';
    } else {
        $lvact = '';
    }


    if ($active == 'pygrp'){
        $pygrp = 'btn-success';
    } else {
        $pygrp = '';
    }


    if ($active == 'indiv'){
        $indiv = 'btn-success';
    } else {
        $indiv = '';
    }

    if ($active == 'talms'){
        $talms = 'btn-success';
    } else {
        $talms = '';
    }


    if ($active == 'income'){
        $income = 'btn-success';
    } else {
        $income = '';
    }

    if ($active == 'cutoff'){
        $cutoff = 'btn-success';
    } else {
        $cutoff = '';
    }

    if ($active == 'timelogs'){
        $timelogs = 'btn-success';
    } else {
        $timelogs = '';
    }
    
    if ($active == 'summ'){
        $summ = 'btn-success';
    } else {
        $summ = '';
    }

    

?>
<div id="ta-div" class=" shadow-sm p-5">
	<div class = 'mx-5 mb-5'>
		<h4 class ='pb-0 mb-0' >Time & Attendance</h4>
		<p class="text-secondary mt-0">Manage employees and paygroup's time and attendace</p>
	</div>
	<div class="d-flex align-items-center border-bottom">
<?php

if($accesslevel >= 3) {
?>
<div class="border ">
		<form action="hrtimeattpaygrp.php?loginid=<?php echo $loginid; ?>&act=pygrp" method="post" name="modhrtapaygrp" class="m-0">
			<button type="submit" class="btn rounded-0 px-5 py-3  <?php echo $pygrp;?> ">
				<i id="TA" class=" bi bi-people "></i>
				<h5 class="">Paygroup</h5>
			</button>
		</form>
	</div>
<?php
}


if($accesslevel >= 4) {
?>
	


	<div class="border ">
		<form action="hrtimeattindivinfo.php?loginid=<?php echo $loginid; ?>&act=indiv" method="post" name="modhrtaindivinfo" class="m-0">
			<button type="submit" class="btn rounded-0 px-5 py-3   <?php echo $indiv;?>">
				<i id="TA" class=" bi bi-person "></i>
				<h5 class="">Individual Info</h5>
			</button>
		</form>
	</div>
	<div class="border ">
		<form action="finpaysysded.php?loginid=<?php echo $loginid; ?>&frm=talm&act=talms" method="post" name="modhrtaincome" class="m-0">
			<button type="submit" class="btn rounded-0 px-5 py-3  <?php echo $talms;?> ">
			<i id="TA" class=" bi bi-journal-minus"></i>
				<h5 class="">Deductions</h5>
			</button>
		</form>
	</div>

	<div class="border ">
		<form action="hrtimeattincome.php?loginid=<?php echo $loginid; ?>&act=income" method="post" name="modhrtaincome" class="m-0">
			<button type="submit" class="btn rounded-0 px-5 py-3  <?php echo $income;?> ">
				<i id="TA" class=" bi bi-cash-coin "></i>
				<h5 class="">Additional</h5>
			</button>
		</form>
	</div>


<?php
}

if($accesslevel >= 3) {
?>
	<div class="border ">
		<form action="hrtimeattcutoff.php?loginid=<?php echo $loginid; ?>&act=cutoff" method="post" name="modhrtacutoff" class="m-0">
			<button type="submit" class="btn rounded-0 px-5 py-3  <?php echo $cutoff; ?>">
				<i id="TA" class=" bi bi-receipt-cutoff "></i>	
				<h5 class="">Cut-off Period</h5>
			</button>
		</form>
	</div>
	<div class="border ">
		<form action="hrtimeattcutleave.php?loginid=<?php echo $loginid; ?>&act=lvact" method="post" name="hrtimeattcutleave" class="m-0">
			<button type="submit" class="btn rounded-0 px-5 py-3  <?php echo $lvact; ?> ">
				<i id="TA" class=" bi bi-box-arrow-right "></i>
				<h5 class="">Leave Entries</h5>
			</button>
		</form>
	</div>
	<div class="border ">
		<form action="hrtimeatttimelogs.php?loginid=<?php echo $loginid; ?>&act=timelogs" method="post" name="modhrtatimelogs" class="m-0">
			<button type="submit" class="btn rounded-0 px-5 py-3  <?php echo $timelogs; ?> ">
				<i id="TA" class=" bi bi-calendar-check "></i>
				<h5 class="">Time Logs</h5>
			</button>
		</form>
	</div>
	<div class="border ">
		<form action="hrtimeattsumm.php?loginid=<?php echo $loginid; ?>&act=summ" method="post" name="modhrtasummary" class="m-0">
			<button type="submit" class="btn rounded-0 px-5 py-3  <?php echo $summ; ?> ">
				<i id="TA" class=" bi bi-card-checklist "></i>
				<h5 class="">Summary</h5>
			</button>
		</form>
	</div>
<?php
}
?>
</div>
</div>
