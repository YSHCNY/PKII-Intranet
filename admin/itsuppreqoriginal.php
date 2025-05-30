<script>
document.addEventListener("DOMContentLoaded", function() {
    var rows = document.querySelectorAll(".clickable-row");
    rows.forEach(function(row) {
        row.addEventListener("click", function() {
            window.location.href = this.dataset.href;
        });
    });
});

</script>

<style>
	th,td{
		font-family: 'Poppins', sans-serif !important;
		vertical-align: middle !important;
		text-align: center !important;
	}
    tbody tr:hover {
      cursor: pointer !important;
 
    }

	tbody tr{
		padding: 10px 5px 10px 5px !important ;

	}
	#notification{
		height: 60px;
		position: absolute;
		width: 75% !important;
	}


    .live-indicator {
    display: flex;
    align-items: center;
    font-family: Arial, sans-serif;
    font-weight: bold;
    color: gray;
    font-size: 18px;
    gap: 8px; 
}


.live-indicator .circle {
    width: 9px;
    height: 9px;
    background-color: gray;
    border-radius: 50%;
    animation: blink 1s infinite step-start;
}

</style>

<?php
session_start();

include("db1.php");
include("datetimenow.php");
include("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$yrmonthavlbl = (isset($_POST['yrmonthavlbl'])) ? $_POST['yrmonthavlbl'] :'';
$dd1ticktyp = (isset($_POST['dd1ticktyp'])) ? $_POST['dd1ticktyp'] :'';
$dd2deptcd = (isset($_POST['dd2deptcd'])) ? $_POST['dd2deptcd'] :'';
$classreqtyp = (isset($_POST['classreqtyp'])) ? $_POST['classreqtyp'] :'';

$orderbydate = (isset($_POST['orderbydate'])) ? $_POST['orderbydate'] :'';
$sortby = (isset($_POST['sortby'])) ? $_POST['sortby'] :'';

$notification = isset($_SESSION['notification']) ? $_SESSION['notification'] : '';
// Clear notification from session
unset($_SESSION['notification']);

if($yrmonthavlbl == '') {
  $selyear = $yearnow;
  $selmonth = date("F", mktime(0, 0, 0, $monthnow));
  $yrmonthavlbl = $selyear." ".$selmonth;
}
// if($dd1ticktyp=='') { $dd1ticktyp="0"; }
if($dd1ticktyp=='') { $dd1ticktyp="2"; }
if($dd2deptcd=='') { $dd2deptcd="ALL"; }
if($classreqtyp=='') { $classreqtyp=5; }

$found = 0;
$accesslevel11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
    include ("header.php");
    include ("sidebar.php");

	if ($notification) {
		echo "
			<div id='notification' class='alert alert-danger d-flex align-items-center' role='alert'>
				<h4 class='text-danger my-auto'>$notification</h4>
			</div>
		";
		echo "
			<script>
				// JavaScript code to hide the notification after 3 seconds
				document.addEventListener('DOMContentLoaded', function() {
					setTimeout(function() {
						var notification = document.getElementById('notification');
						notification.style.transition = 'opacity 1s';
						notification.style.opacity = '0';
						setTimeout(function() {
							notification.style.display = 'none';
						}, 1000); // 1000 milliseconds = 1 second
					}, 3000); // 3000 milliseconds = 3 seconds
				});
			</script>
		";
	}
?>
<div class="shadow p-5 poppins">
<div class="row px-4">
<div class="col">
	<p class="fs-3 fw-bold mb-0 poppins">Support Request</p>
    <p class=" fs-5 poppins">Tech Support Request Summary<i class = 'text-primary poppins'> (click rows to view details)</i></p>
</div>
<div class="col ">
<div class="live-indicator justify-content-end">
    <div class="circle"></div>
    <h4 class="text fw-semibold">LIVE</h4>
	<a href="itadmsuppreq.php?loginid=<?php echo $loginid; ?>" class = ''>| Start live</a>
</div>
</div>
</div>

<form class="form-inline justify-content-center align-items-center d-flex border p-5 rounded-4 my-5" method="POST" action="itsuppreqoriginal.php?loginid=<?php echo $loginid; ?>" name="itadmsuppreq">

<div class=" row row-cols-auto">

<div class = 'col-12 col-lg-auto  mx-auto'>
<p class = 'mb-0 poppins'>Year-Month</p>
<select class="form-control poppins" name="yrmonthavlbl">
<option>Year-Month</option>

<?php
  $res18query = "SELECT DISTINCT DATE_FORMAT(datecreated, '%Y %M') as yyyymonth FROM tblitsupportreq ORDER BY datecreated DESC";
	$result18=""; $found18=0; $ctr18=0;
	$result18 = $dbh2->query($res18query);
	if($result18->num_rows>0) {
		while($myrow18 = $result18->fetch_assoc()) {
		$found18 = 1;
		$ctr18 = $ctr18 + 1;
		$yyyymonth = $myrow18['yyyymonth'];
		if($yrmonthavlbl=="$yyyymonth") { $yrmonthsel="selected"; } else { $yrmonthsel=""; }
		echo "<option value=\"$yyyymonth\" $yrmonthsel>$yyyymonth</option>";
		}
	}
	?>
	</select>
	</div>
	
	<div class = 'col-12 col-lg-auto  mx-auto'>
	<p class = 'mb-0 poppins'>Ticket Type</p>
	<select class="form-control poppins" name="dd1ticktyp">
	<?php	
	if($dd1ticktyp==0) {
		$dd1ticktyp0sel="selected"; $dd1ticktyp1sel=""; $dd1ticktypallsel="";
	} else if($dd1ticktyp==1) {
		$dd1ticktyp0sel=""; $dd1ticktyp1sel="selected"; $dd1ticktypallsel="";
	} else if($dd1ticktyp==2) {
		$dd1ticktyp0sel=""; $dd1ticktyp1sel=""; $dd1ticktypallsel="selected";
	}
	?>
	<option value="0" <?php echo $dd1ticktyp0sel; ?>> OPEN</option>
	<option value="1" <?php echo $dd1ticktyp1sel; ?>> CLOSED</option>
	<option value="2" <?php echo $dd1ticktypallsel; ?>> ALL</option>
	</select>
	</div>

	

	<div class = 'col-12 col-lg-auto  mx-auto'>
	<p class = 'mb-0 poppins'>Department	</p>
	<select class="form-control poppins" name="dd2deptcd">
	<?php
	$res12query = "SELECT DISTINCT deptcd FROM tblitsupportreq";
	$result12=""; $found12=0; $ctr12=0;
	$result12 = $dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12 = $result12->fetch_assoc()) {
		$found12 = 1;
		$ctr12 = $ctr12 + 1;
		$deptcd12 = $myrow12['deptcd'];
		if($deptcd12!='') {
			if($deptcd12==$dd2deptcd) { $dd2deptcdsel="selected"; $dd2deptcdallsel=""; } else { $dd2deptcdsel=""; $dd2deptcdallsel=""; }
		echo "<option value=\"$deptcd12\" $dd2deptcdsel>$deptcd12</option>";
		}
		}
	}
	if($dd2deptcd=="ALL") { $dd2deptcdallsel="selected"; $dd2deptcdsel=""; }
	?>
	<option value="ALL" <?php echo $dd2deptcdallsel; ?>>ALL Depts</option>
	</select>
	</div>

	
	<div class = 'col-12 col-lg-auto  mx-auto'>
	<p class = 'mb-0 poppins'>Classification</p>
	<select class="form-control poppins" name="classreqtyp">
	<?php	
	if($classreqtyp==0) {
		$classreqtypsel0="selected"; $classreqtypsel1=""; $classreqtypsel2=""; $classreqtypsel3=""; $classreqtypsel5="";  $classreqtypesel7="";
	} elseif($classreqtyp==1) {
		$classreqtypsel0=""; $classreqtypsel1="selected"; $classreqtypsel2=""; $classreqtypsel3=""; $classreqtypsel5="";  $classreqtypesel7="";	
	} elseif($classreqtyp==2) {
		$classreqtypsel0=""; $classreqtypsel1=""; $classreqtypsel2="selected"; $classreqtypsel3=""; $classreqtypsel5="";  $classreqtypesel7="";
	} elseif($classreqtyp==3) {
		$classreqtypsel0=""; $classreqtypsel1=""; $classreqtypsel2=""; $classreqtypsel3="selected"; $classreqtypsel5="";  $classreqtypesel7="";
	} elseif($classreqtyp==5) {
		$classreqtypsel0=""; $classreqtypsel1=""; $classreqtypsel2=""; $classreqtypsel3=""; $classreqtypsel5="selected";  $classreqtypesel7="";
	} elseif($classreqtyp==7) {
		$classreqtypsel0=""; $classreqtypsel1=""; $classreqtypsel2=""; $classreqtypsel3=""; $classreqtypsel5=""; $classreqtypesel7="selected";
	}
	?>
	<option value="0" <?php echo $classreqtypsel0; ?>>Unclassified</option>
	<option value="1" <?php echo $classreqtypsel1; ?>>Technical</option>
	<option value="2" <?php echo $classreqtypsel2; ?>>Administrative</option>
	<option value="3" <?php echo $classreqtypsel3; ?>>Repair</option>
	<option value="5" <?php echo $classreqtypsel5; ?>>ALL</option>
	<hr>
	<option value="7" <?php echo $classreqtypesel7; ?>> Allowed duration</option>
	</select>
	</div>

	<?php
    if($orderbydate!="") {
        if($orderbydate=="REQ") {
            $orderbydatefield="tblitsupportreq.stamprequest"; 
            $reqsel="selected"; $appsel=""; $clssel=""; $dursel="";
        } else if($orderbydate=="APP") {
            $orderbydatefield="tblitsupportreq.approvestamp"; 
            $reqsel=""; $appsel="selected"; $clssel=""; $dursel="";
        } else if($orderbydate=="CLS") {
            $orderbydatefield="tblitsupportreq.closestamp"; 
            $reqsel=""; $appsel=""; $clssel="selected"; $dursel="";
        } else if($orderbydate=="DUR") {
            $orderbydatefield="tblitsupportreq.apprdurationdt"; 
            $reqsel=""; $appsel=""; $clssel=""; $dursel="selected";
        }
    } else {
        $orderbydatefield="tblitsupportreq.approvestamp"; 
        $orderbydate="APP"; $reqsel=""; $appsel="selected"; $clssel=""; $dursel="";        
    }
	?>
<!-- 
	<div class = 'col-12 col-lg-auto  mx-auto'>
	<p class = 'mb-0'>Order by Date	</p>
	<select class="form-control" name="orderbydate">
	<option value="REQ" <?php echo $reqsel; ?>>requested date</option>
	<option value="APP" <?php echo $appsel; ?>>approved date</option>
	<option value="CLS" <?php echo $clssel; ?>>closed date</option>
	<option value="DUR" <?php echo $dursel; ?>>duration date</option>
	</select>
	</div> -->

	<?php
    if($sortby!="") {
        if($sortby=="ASC") {
            $sortbyascsel="selected"; $sortbydescsel="";
        } else if($sortby=="DESC") {
            $sortbyascsel=""; $sortbydescsel="selected";
        }
    } else {
        $sortby="DESC"; $sortbyascsel=""; $sortbydescsel="selected";
    }
	?>
<!-- 
	<div class = 'col-12 col-lg-auto  mx-auto'>
	<p class = 'mb-0'>Sort by	</p>
	<select class="form-control" name="sortby">
	<option value="ASC" >ascending</option>
	<option value="DESC" >descending</option>
	</select>
	</div> -->
	

	<div class="col-12 col-lg-auto  mx-auto" style="padding: 18px 0;">
	<button type="submit" class="btn btn-info bg-primary border border-1 border-primary px-5" id="autoClickButton">Submit</button>
	</div>
	</div>

	</form>


	

	<div class="table-responsive">
	<table  style='width:100%' class = 'table-sm table-bordered table-striped  table-hover' id = 'notlive'>

	<thead>
	<tr class = 'fs-5 fw-normal text-capitalize'>

		<th>Request Date</th>
		<th>Ticket no.</th>
		<th>request type</th>
		<th>department</th>
		<th>Classification</th>
		<th>requestor</th>
		<th>approval status</th>
		<th>action taken</th>
		<th>score</th>
		<th>ticket status</th>
		<th>Duration</th>
		<th>Allowed Duration</th>
	
	</tr>

	</thead>

<tbody>
	
	<?php



	if($dd1ticktyp==2) {
		
		if($dd2deptcd=="ALL") {
			if($classreqtyp!=5) {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" AND tblitsupportreq.classreqtyp=\"$classreqtyp\" ORDER BY $orderbydatefield $sortby";				
			} else {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" ORDER BY $orderbydatefield $sortby";
			}

		} else {
			if($classreqtyp!=5) {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.deptcd=\"$dd2deptcd\" AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" AND tblitsupportreq.classreqtyp=\"$classreqtyp\" ORDER BY $orderbydatefield $sortby";			
			} else {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.deptcd=\"$dd2deptcd\" AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" ORDER BY $orderbydatefield $sortby";
			}
		}
	} else if($dd1ticktyp==0) {
		if($dd2deptcd=="ALL") {
			if($classreqtyp!=5) {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw=$dd1ticktyp AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" AND tblitsupportreq.classreqtyp=\"$classreqtyp\" ORDER BY $orderbydatefield $sortby";				
			} else {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw=$dd1ticktyp AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" ORDER BY $orderbydatefield $sortby";
			}

		} else {
			if($classreqtyp!=5) {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw=$dd1ticktyp AND tblitsupportreq.deptcd=\"$dd2deptcd\" AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" AND tblitsupportreq.classreqtyp=\"$classreqtyp\" ORDER BY $orderbydatefield $sortby";				
			} else {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw=$dd1ticktyp AND tblitsupportreq.deptcd=\"$dd2deptcd\" AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" ORDER BY $orderbydatefield $sortby";
			}

		}
	} else if($dd1ticktyp>=1) {
		if($dd2deptcd=="ALL") {
			if($classreqtyp!=5) {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw>=$dd1ticktyp AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" AND tblitsupportreq.classreqtyp=\"$classreqtyp\" ORDER BY $orderbydatefield $sortby";				
			} else {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw>=$dd1ticktyp AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" ORDER BY $orderbydatefield $sortby";
			}

		} else {
			if($classreqtyp!=5) {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw>=$dd1ticktyp AND tblitsupportreq.deptcd=\"$dd2deptcd\" AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" AND tblitsupportreq.classreqtyp=\"$classreqtyp\" ORDER BY $orderbydatefield $sortby";				
			} else {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw>=$dd1ticktyp AND tblitsupportreq.deptcd=\"$dd2deptcd\" AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" ORDER BY $orderbydatefield $sortby";				
			}

		}
	} else {
		$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq  ORDER BY tblitsupportreq.stamprequest desc";
	}


    if($orderbydate=="DUR") {
    	$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE DATE_FORMAT(tblitsupportreq.apprdurationdt, '%Y %M')=\"$yrmonthavlbl\" ORDER BY $orderbydatefield $sortby";
    }

	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);

	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$ctr11 = $ctr11 + 1;
		$iditsupportreq11 = $myrow11['iditsupportreq'];
		$ticketnum11 = $myrow11['ticketnum'];
		$stamprequest11 = $myrow11['stamprequest'];
		$employeeid11 = $myrow11['employeeid'];
		$deptcd11 = $myrow11['deptcd'];
		$requestctg11 = $myrow11['requestctg'];
		$details11 = $myrow11['details'];
		$requestctr11 = $myrow11['requestctr'];
		$approvectr11 = $myrow11['approvectr'];
		$approveid11 = $myrow11['approveid'];
		$approveempid11 = $myrow11['approveempid'];
		$approvestamp11 = $myrow11['approvestamp'];
		$actionctr11 = $myrow11['actionctr'];
		$actionctg11 = $myrow11['actionctg'];
		$actionid11 = $myrow11['actionid'];
		$actionempid11 = $myrow11['actionempid'];
		$closeticketsw11 = $myrow11['closeticketsw'];
		$closestamp11 = $myrow11['closestamp'];
		$scoreval11 = $myrow11['scoreval'];
		$classreqtyp11 = $myrow11['classreqtyp'];
		if($classreqtyp11==0) {
			$classreqtyp11fin="Unclassified";
		} elseif($classreqtyp11==1) {
			$classreqtyp11fin="Technical";
		} elseif($classreqtyp11==2) {
			$classreqtyp11fin="Administrative";
		} elseif($classreqtyp11==3) {
			$classreqtyp11fin="Repair";
		}

		$apprdurationsw11 = $myrow11['apprdurationsw'];
		$apprdurationdt11 = $myrow11['apprdurationdt'];


		echo "<tr  class='clickable-row' data-href='itadmsuppreqdtl.php?loginid=$loginid&its=$iditsupportreq11' target='_blank'>";
		echo" <td>".date("Y-M-d H:i:s", strtotime($stamprequest11))."</td>";
		if($ticketnum11==0) {
			echo "<td class = 'text-danger fw-semibold'>Unassigned</td>";
		} else {
			echo "<td class = 'text-dark'><b class='poppins'>$ticketnum11</b></td>";
		}

		echo "<td>";
		$arritsrctg = explode("|", $requestctg11);
		foreach($arritsrctg as $val => $n) {
			if($n!='') {
				$res17query="SELECT name FROM tblitctgsuppreq WHERE code=\"$n\"";
				$result17=""; $found17=0; $ctr17=0;
				$result17 = $dbh2->query($res17query);
				if($result17->num_rows>0) {
					while($myrow17 = $result17->fetch_assoc()) {
					$found17 = 1;
					$ctr17 = $ctr17 + 1;
					$ctgname17 = $myrow17['name'];
					echo "- $ctgname17<br>";
					} // while()
				} // if()
			} // if()
		} // for()
		echo "</td>";
		
		echo"<td>$deptcd11</td>";
		echo"<td>$classreqtyp11fin</td>";
		// requestor detais
		$res14query="SELECT name_last, name_first FROM tblcontact WHERE employeeid=\"$employeeid11\"";
		$result14=""; $found14=1; $ctr14=0;
		$result14 = $dbh2->query($res14query);
		if($result14->num_rows>0) {
			while($myrow14 = $result14->fetch_assoc()) {
			$found14 = 1;
			$ctr14 = $ctr14 + 1;
			$name_last14 = $myrow14['name_last'];
			$name_first14 = $myrow14['name_first'];
			} // while($myrow14 = $result14->fetch_assoc())
		} // if($result14->num_rows>0)
		echo "<td>$name_last14, $name_first14</td>";

		$requestDate = new DateTime($stamprequest11);
		$currentDate = new DateTime();
		$currentDateMinus15days = (new DateTime())->modify('-15 days');
		$output = ($requestDate >= $currentDateMinus15days);

		if($approvectr11>=1) {
			$approvestatstr="Request Approved";
			$res12query="SELECT name_last, name_first FROM tblcontact WHERE employeeid=\"$approveempid11\"";
			$result12=""; $found12=0; $ctr12=0;
			$result12 = $dbh2->query($res12query);
			if($result12->num_rows>0) {
				while($myrow12 = $result12->fetch_assoc()) {
				$found12 = 1;
				$ctr12 = $ctr12 + 1;
				$name_last12 = $myrow12['name_last'];
				$name_first12 = $myrow12['name_first'];
				}
			}
			
		echo "<td><span class='text-success fw-medium'>$approvestatstr</span><br>".date("Y-M-d H:i:s", strtotime($approvestamp11))."<br>$approverinfo</td>";

		} elseif (!$output) {
			$approvestatstr = "Request Expired";
		
		echo "<td class='text-danger fw-medium'>$approvestatstr</td>";
	
		} elseif($approvectr11==0) {
			$approvestatstr="Pending Approval";
			$res12query="SELECT name_last, name_first FROM tblcontact WHERE employeeid=\"$approveempid11\"";
			$result12=""; $found12=0; $ctr12=0;
			$result12 = $dbh2->query($res12query);
			if($result12->num_rows>0) {
				while($myrow12 = $result12->fetch_assoc()) {
				$found12 = 1;
				$ctr12 = $ctr12 + 1;
				$name_last12 = $myrow12['name_last'];
				$name_first12 = $myrow12['name_first'];
				$approverinfo = "by: $approveempid11 - $name_last12, $name_first12";
				}
			}	

		echo "<td class='fw-medium' style='color: #ff4d00;'>$approvestatstr</td>";

		}

		if($actionctr11>=1) {
			$res15query="SELECT name FROM tblitctgsuppreq WHERE ctgtype=\"ACT\" AND code=\"$actionctg11\"";
			$result15=""; $found15=0; $ctr15=0;
			$result15 = $dbh2->query($res15query);
			if($result15->num_rows>0) {
				while($myrow15 = $result15->fetch_assoc()) {
				$found15=1;
				$ctr15 = $ctr15 + 1;
				$actctgname15 = $myrow15['name'];
				}
			}

			if ($actctgname15 == "Accomplished") {
				echo "<td class='text-success fw-medium'>$actctgname15</td>";
			} elseif ($actctgname15 == "Request Denied") {
				echo "<td class='text-danger fw-medium'>$actctgname15</td>";
			} elseif ($actctgname15 == "Recommendation/Others") {
				echo "<td class='text-primary fw-medium'>$actctgname15</td>";
			} elseif ($actctgname15 == "Pending") {
				echo "<td class='fw-medium' style='color: #ff4d00;'>$actctgname15</td>";
			} else {
				echo "<td class='fw-medium'>$actctgname15</td>";
			}

		} elseif (!$output) {
		
		echo "<td class='text-danger fw-medium'>Expired</td>";
	
		} elseif($actionctr11==0) {

			echo "<td class='fw-medium' style='color: #ff4d00;'>Pending</td>";
		}

		// satisfaction rating score
		if($scoreval11!='') {
			if($scoreval11==1) {
			$scorepct="20%"; $scoreclr="red";
			} else if($scoreval11==2) {
			$scorepct="40%"; $scoreclr="orange";
			} else if($scoreval11==3) {
			$scorepct="60%"; $scoreclr="orange";
			} else if($scoreval11==4) {
			$scorepct="80%"; $scoreclr="orange";
			} else if($scoreval11==5) {
			$scorepct="100%"; $scoreclr="green";
			} // if($scoreval11==1)
		} // if($scoreval11!='')
		if($scoreval11!=0) {
		echo "<td class='fw-medium'><font color=\"$scoreclr\"><br> $scoreval11 stars  ($scorepct)</font></td>";
		} else {
		echo "<td class='text-danger fw-medium'>No Rate</td>";
		} // if($scoreval11!=0)

		// ticket status
		if($closeticketsw11==0) {
			echo "<td class='text-danger fw-medium'>OPEN</td>";
		} else if($closeticketsw11==1) {
			echo "<td><font color=\"green\">CLOSED</font><br>".date("Y-M-d H:i:s", strtotime($closestamp11))."";
			// display closer
			$res16query="SELECT name_last, name_first FROM tblcontact WHERE employeeid=\"$actionempid11\"";
			$result16=""; $found16=0; $ctr16=0;
			$result16 = $dbh2->query($res16query);
			if($result16->num_rows>0) {
				while($myrow16 = $result16->fetch_assoc()) {
				$found16 = 1;
				$ctr16 = $ctr16 + 1;
				$name_last16 = $myrow16['name_last'];
				$name_first16 = $myrow16['name_first'];
				$closerinfo = "by: $actionempid11 - $name_last16, $name_first16";
				} // while($myrow12 = $result12->fetch_assoc())
			} // if($result12->num_rows>0)
			echo "<br>$closerinfo";
			echo "</td>";
		} // if($closeticketsw11==0)
		if ($closeticketsw11 == 1 && $approvectr11 == 1) {
			$durstart = new DateTime($approvestamp11);
			$durend = new DateTime($closestamp11);
			$duration = $durend->diff($durstart);
			echo "<td>";
			echo $duration->format("%d days, %H hours, %I minutes, %S seconds");
			echo "</td>";
		} else {
			echo "<td>None</td>";
		}
		
		// if($closeticketsw11==1 && $approvectr11==1) {
		// 	$durstart = new DateTime($approvestamp11);
		// 	$durend = new DateTime($closestamp11);
		// 	$duration = $durend->diff($durstart);
		// 	echo "<td>";
		// 	if($duration->format("%d")!='') {
		// 		if($duration->format("%d")!=0) {
		// 		echo "".$duration->format("%d days, ")."";
		// 		echo "</td>";
		// 		} // if($duration->format("%d")!=0)
		// 	} // if($duration->format("%d")!='')
		// 	echo "".$duration->format("%H:%I hrs:min")."</td>";
		// } else {
		// 	echo "<td>None</td>";
		// } // if($closeticketsw15==1)

		echo "<td>";
			if($apprdurationsw11==1) {
				echo date('M d (Y)', strtotime($apprdurationdt11));
			} else {
				echo "No Approval Date";
			}
		echo "</td>";

		echo "</tr>";
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)
	echo "</tbody>";
	echo "</table>";

// end cont

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result = $dbh2->query($resquery);
     include ("footer.php");

} else {
     include ("logindeny.php");
}

?>

<div class="d-flex justify-content-end mt-5 mb-3">
	<a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
		<button class="border-0 rounded-3" style="width: 170px; height: 40px; background-color: #0a1d44;">Back</button>
	</a>
</div>
	
	</div>
	</div>

<?php

$dbh2->close();
?>

