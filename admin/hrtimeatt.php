<?php 

include("db1.php");
include("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

?>
<style>

#TA{
        font-size: 3rem !important;
    }

    .btn:hover{
        background-color: rgb(74, 97, 145) !important;
        color: white !important;
    }

    .active {
        background-color: rgb(54, 68, 99) !important;
        color: white !important;
    }
</style>

<div id="ta-div" class=" shadow p-5">
	<div class = 'mx-5 mb-5'>
		<h4 class ='pb-0 mb-0' >Time & Attendance</h4>
		<p class="text-secondary mt-0">Manage employees and paygroup's time and attendace</p>
	</div>
	<div class="row">
<?php

if($accesslevel >= 3) {
	?>
	<div id="hov" class="col text-center">
			<form action="hrtimeattpaygrp.php?loginid=<?php echo $loginid; ?>&act=pygrp" method="post" name="modhrtapaygrp" class="m-0">
				<button type="submit" class="btn p-5 <?php echo $pygrp;?> ">
					<i id="TA" class=" bi bi-people "></i>
					<h5 class="">Pay Group</h5>
				</button>
			</form>
		</div>
	<?php
	}
	
	
	if($accesslevel >= 4) {
	?>
		
	
	
		<div id="hov" class="col text-center">
			<form action="hrtimeattindivinfo.php?loginid=<?php echo $loginid; ?>&act=indiv" method="post" name="modhrtaindivinfo" class="m-0">
				<button type="submit" class="btn p-5  <?php echo $indiv;?>">
					<i id="TA" class=" bi bi-person "></i>
					<h5 class="">Individual Info</h5>
				</button>
			</form>
		</div>
		<div id="hov" class="col text-center">
			<form action="finpaysysded.php?loginid=<?php echo $loginid; ?>&frm=talm&act=talms" method="post" name="modhrtaincome" class="m-0">
				<button type="submit" class="btn p-5 <?php echo $talms;?> ">
				<i id="TA" class=" bi bi-journal-minus"></i>
					<h5 class="">Income Deductions</h5>
				</button>
			</form>
		</div>
	
		<div id="hov" class="col text-center">
			<form action="hrtimeattincome.php?loginid=<?php echo $loginid; ?>&act=income" method="post" name="modhrtaincome" class="m-0">
				<button type="submit" class="btn p-5 <?php echo $income;?> ">
					<i id="TA" class=" bi bi-cash-coin "></i>
					<h5 class="">Add'l Income</h5>
				</button>
			</form>
		</div>
	
	
	<?php
	}
	
	if($accesslevel >= 3) {
	?>
		<div id="hov" class="col text-center">
			<form action="hrtimeattcutoff.php?loginid=<?php echo $loginid; ?>&act=cutoff" method="post" name="modhrtacutoff" class="m-0">
				<button type="submit" class="btn p-5 <?php echo $cutoff; ?>">
					<i id="TA" class=" bi bi-receipt-cutoff "></i>	
					<h5 class="">Cut-off Period</h5>
				</button>
			</form>
		</div>
		<div id="hov" class="col text-center">
			<form action="hrtimeattcutleave.php?loginid=<?php echo $loginid; ?>&act=lvact" method="post" name="hrtimeattcutleave" class="m-0">
				<button type="submit" class="btn p-5 <?php echo $lvact; ?> ">
					<i id="TA" class=" bi bi-box-arrow-right "></i>
					<h5 class="">Leave Entries</h5>
				</button>
			</form>
		</div>
		<div id="hov" class="col text-center">
			<form action="hrtimeatttimelogs.php?loginid=<?php echo $loginid; ?>&act=timelogs" method="post" name="modhrtatimelogs" class="m-0">
				<button type="submit" class="btn p-5 <?php echo $timelogs; ?> ">
					<i id="TA" class=" bi bi-calendar-check "></i>
					<h5 class="">Time Logs</h5>
				</button>
			</form>
		</div>
		<div id="hov" class="col text-center">
			<form action="hrtimeattsumm.php?loginid=<?php echo $loginid; ?>&act=summ" method="post" name="modhrtasummary" class="m-0">
				<button type="submit" class="btn p-5 <?php echo $summ; ?> ">
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
	


<!-- <div class="d-flex justify-content-end pt-5">
	<a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
		<button class="border-0 rounded-3" style="width: 170px; height: 40px; background-color: #0a1d44;">Back</button>
	</a>
</div> -->

<?php
$result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?>