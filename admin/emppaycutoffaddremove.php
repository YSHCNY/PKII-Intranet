<?php
//
// emppaycutoffcrea.php // 20200424
// fr cutoff.php
//
require_once("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$submit = (isset($_POST['submit'])) ? $_POST['submit'] :'';
$cutoff = (isset($_POST['cutoff'])) ? $_POST['cutoff'] :'';
$cutoffURL = (isset($_POST['thisurl'])) ? $_POST['thisurl'] :'';


if($cutoff!='') {
	$cutarr = split(':', $cutoff);
	$cutstart = $cutarr[0];
	$cutend = $cutarr[1];
} // if

$msginfo="";

$found = 0;
if($loginid != "") {
    include("logincheck.php");
}
if($found == 1) {

	
    //
	// view
	//
    include ("header.php");
	include ("sidebar.php");

	// echo "<p><font size=1>Modules >> Employees' payslip email notifier >> Custom cutoff >> add/remove employee no.</font></p>";
?>
	<div class = 'text-end my-4'>
	<a href="cutoff.php?loginid=<?php echo $loginid; ?>" class = 'mainbtnclr btn text-white'>Back</a>
	</div>

    <div class="bg-white shadow px-5 py-3 m-3">
	<h3 class = 'mb-0'>Manage Personnel</h3>
	<p class = 'text-secondary'>Add or remove personel from a specific cutoff</p>
	<form action="emppaycutoffaddremove.php?ctoff=<?php echo $cutoff ?>&loginid=<?php echo $loginid; ?>" method="POST" name="emppaycutoffaddremove">
    
	
<?php
	echo "$cutoffURL";
	echo "<div class = 'border row mb-5 mt-3 p-4 text-end'>";
	echo "<div class = 'col-2 text-center'><h5>Choose cutoff period:</h5></div>";
    echo "<div class = 'col ' ><select class='form-control ' name='cutoff'>";
	echo "<option  value = '' selected disabled>Select Date</option>";
	// query tblemppayroll
	$res11qry="";
	$res11qry="SELECT DISTINCT cut_start, cut_end FROM tblemppayroll ORDER BY cut_start DESC";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11qry);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11=$ctr11+1;
			$cutstart11 = $myrow11['cut_start'];
			$cutend11 = $myrow11['cut_end'];
			$cutfin11 = "$cutstart11:$cutend11";
			if($cutfin11==$cutoff) {
				$cutfinsel="selected";
				

			} else if ($cutoffURL != ''){
				if ($cutoffURL == $cutoff){
					$cutfin11=$cutoffURL;
				$cutfinsel="selected";

				} else {
					$cutfin11 = $cutfin11;
				}


			}else  {
				$cutfinsel="";
				$cutfin11 = $cutfin11;

			} // if-else
    echo "<option  value='$cutfin11' $cutfinsel>$cutstart11-to-$cutend11 </option>";
		} // while
	} // if





	echo "</select></div>";

	echo "<div class = 'col'><button type='submit' class='btn text-white mainbtnclr' name='submit' value=1>Submit</button></div>";
	echo "</div>";
	// var_dump($res11qry);
?>
</form>
<?php

	if($submit==1 && $cutoff != '') {
		
		// cutoff selection
        // echo "<p colspan='3'>Choose from the list below:</p>";
		echo "<form action='emppaycutoffins.php?loginid=$loginid' method='POST' name='emppaycutoffaddremove'>";
		echo "<input type='hidden' name='cutoff' value='$cutoff'>";
		// query tblcontact tblemployee tblemppayroll and display list of employees with checkbox

		?>
		<table width = '100%' id = 'personelcutie' class = 'table table-bordered table-hover mt-5'>
			<thead>
				<tr >
					<th class = '' >
						Choose personel 
					</th>
					<th class = ''>Employee ID</th>
					<th class = ''>Personel</th>
				</tr>
			</thead>
			<tbody>
				
				
		

<?php
		$res12qry="";
		$res12qry="SELECT tblemployee.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblemployee LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE (tblemployee.employee_type='employee' OR tblemployee.employee_type='consultant') AND tblemployee.emp_record='active' AND tblcontact.contact_type='personnel' ORDER BY tblemployee.employeeid ASC";
		$result12=""; $found12=0; $ctr12=0;
		$result12=$dbh2->query($res12qry);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
				$found12=1;
				$ctr12=$ctr12+1;
				$employeeid12 = $myrow12['employeeid'];
				$name_last12 = $myrow12['name_last'];
				$name_first12 = $myrow12['name_first'];
				$name_middle12 = $myrow12['name_middle'];
				// query tblemppayroll based on cutoff and match employeeid12
				$res12aqry="";
				$res12aqry="SELECT emppayrollid FROM tblemppayroll WHERE employeeid='$employeeid12' AND cut_start='$cutstart' AND cut_end='$cutend'";
				$result12a=""; $found12a=0;
				$result12a=$dbh2->query($res12aqry);
				if($result12a->num_rows>0) {
					while($myrow12a=$result12a->fetch_assoc()) {
						$found12a=1;
						$emppayrollid12a = $myrow12a['emppayrollid'];
					} // while
				} // if
				if($found12a==1) {
					$f12asel="checked=checked";
					$bgthis = 'info'; 
				} else {
					$bgthis = 'bg-white'; 

					$f12asel="";
				} // if-else
			echo "	<tr class = '$bgthis'><td class = ''><input type='checkbox' class = '' name='empid[]' value='$employeeid12' $f12asel></td>";
			echo "<input type='hidden' name='cutstart' value='$cutstart'>";
			echo "<input type='hidden' name='cutend' value='$cutend'>";
			if($f12asel!='') {
			echo "<td class = ''><strong>$employeeid12</strong></td><td class = ''><strong>$name_last12, $name_first12 $name_middle12[0].</strong></td>";
			} else {
			echo "<td class = ''> $employeeid12</td><td class = ''>$name_last12, $name_first12 $name_middle12[0].</td> ";
			} // if-else

			} // while
		} // if
		echo "</tr></form>";

		?>
		
			</tbody>
		</table>
		<?php
		

		echo "<div id = 'stickythis' class = 'bg-white shadow p-4 text-end'><button type='submit' class='btn text-white bg-success mx-2 ' name='submit' value='2'>Save Personnel to Cutoff</button></div>";

		
	} 
?>

<?php
    include ("footer.php");
} else {
     include ("logindeny.php");
}
$dbh2->close();
?>

<style>
#stickythis{
	position: sticky !important;
	z-index: 999 !important;
	bottom: 30;
}
</style>