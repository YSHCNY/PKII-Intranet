<?php
//
// emppaycutoffcrea.php // 20200424
// fr cutoff.php
//
require_once("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$submit = (isset($_POST['submit'])) ? $_POST['submit'] :'';

$msginfo="";

$found = 0;
if($loginid != "") {
    include("logincheck.php");
}
if($found == 1) {
	if($submit==1) {
		$act = (isset($_POST['act'])) ? $_POST['act'] :'';
		
	if($act=='add') {
		$cutstart = (isset($_POST['cutstart'])) ? $_POST['cutstart'] :'';
		$cutend = (isset($_POST['cutend'])) ? $_POST['cutend'] :'';
		if($cutstart!='' && $cutend!='') {
			if(strtotime($cutend) > strtotime($cutstart)) {
				// query tblemppayroll if exists, else proceed
				echo "".date('Y-M-d', strtotime($cutstart))." -to- ".date('Y-M-d', strtotime($cutend))."";
				$res12qry="";
				$res12qry="SELECT emppayrollid FROM tblemppayroll WHERE cut_start='$cutstart' AND cut_end='$cutend'";
				$result12=""; $found12=0;
				$result12=$dbh2->query($res12qry);
				if($result12->num_rows>0) {
					while($myrow12=$result12->fetch_assoc()) {
						$found12=1;
						$emppayrollid12 = $myrow12['emppayrollid'];
					} // while
				} // if
				if($found12==1 && $emppayrollid12!='') {
					$msginfo="Warning: Cut-off period exists. Pls try again.";
				} else {
					// continue and query active personnel checkbox with empID from previous cutoff
					$res14qry="";
					$res14qry="SELECT cut_start, cut_end FROM tblemppayroll WHERE cut_start<'$cutstart' ORDER BY cut_start DESC LIMIT 1";
					$result14=""; $found14=0; $ctr14=0;
					$result14=$dbh2->query($res14qry);
					if($result14->num_rows>0) {
						while($myrow14=$result14->fetch_assoc()) {
							$found14=1;
							$ctr14=$ctr14+1;
							$cut_start14 = $myrow14['cut_start'];
							$cut_end14 = $myrow14['cut_end'];
						} // while
					} // if
					if($found14==1) {
						// query employee nos. based on last cutoff
						echo "<p>querying and inserting records from previous cutoff ".$cut_start14." -to- ".$cut_end14." ...</p>";
						$res15qry="";
						$res15qry="SELECT DISTINCT tblemppayroll.employeeid, tblemppayroll.emp_salary, tblemppayroll.emp_dep, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblemppayroll LEFT JOIN tblcontact ON tblemppayroll.employeeid=tblcontact.employeeid WHERE tblemppayroll.cut_start='$cut_start14' AND tblemppayroll.cut_end='$cut_end14' AND tblcontact.contact_type='personnel' ORDER BY tblemppayroll.employeeid ASC";
						$result15=""; $found15=0; $ctr15=0;
						$result15=$dbh2->query($res15qry);
						if($result15->num_rows>0) {
							while($myrow15=$result15->fetch_assoc()) {
								$found15=1;
								$ctr15=$ctr15+1;
								$employeeid15 = trim($myrow15['employeeid']);
								$emp_salary15 = $myrow15['emp_salary'];
								$emp_dep15 = trim($myrow15['emp_dep']);
								$name_last15 = $myrow15['name_last'];
								$name_first15 = $myrow15['name_first'];
								$name_middle15 = $myrow15['name_middle'];
								// echo "f15:".$found15.", ctr:".$ctr15." | eid:".$employeeid15.", dep:".$emp_dep15."";
								if($emp_salary15=='') { $emp_salary15=0; }
								if($employeeid15!='') {
									// insert query
									$res16query="";
									$res16query="INSERT INTO tblemppayroll SET employeeid='$employeeid15', emp_salary=$emp_salary15, deduction=0, phil_ded=0, tax=0, emp_over_duration=0, net_pay=0, emp_date_wrk=0, emp_sick='', emp_vacation='', cut_start='$cutstart', cut_end='$cutend', regholiday=0, speholiday=0, emp_late_duration=0, otsunday=0, regholidayamt=0, speholidayamt=0, otsundayamt=0, overamt=0, nightdiffminutes=0, nightdiffamt=0, totaltardy=0, otherincome=0, otherincometaxable=0, otherdeduction=0, emp_dep='$emp_dep15', pagibig=0, vlused=0, slused=0, philemp=0, ss=0, ec=0, bracket=0, absentamt=0";
									$result16=""; $found16=0;
									$result16=$dbh2->query($res16query);
									echo "".$ctr15." ".$employeeid15." | ".$name_last15.", ".$name_first15." ".$name_middle15[0]." | ".$emp_salary15.", ".$emp_dep15." - ";
									if(mysqli_insert_id($dbh2)!='') {
									echo "<font color='green'>inserted.</font>";
									} else {
									echo "<font color='red'>insert error.</font>";
									} // if-else
									echo "<br>";
								// echo $res16query."<br>";
								$idinserted="";
								} // if
							} // while
						} // if
						echo "<br><strong>Finished - eof.</strong>";
						$msginfo="Finished inserting records. Pls click back button.";
						
						// insert logs
						$adminlogdetails = "$loginid:$username - add new cutoff $cutstart -to- $cutend in employees payslip > custom cutoff";
						$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$username\", adminlogdetails=\"$adminlogdetails\"";
						$result17 = $dbh2->query($res17query);
						
						echo "<p><a href=\"cutoff.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";
					} // if
					// echo "<p>f14:$found14, cut14:$cut_start14-to-$cut_end14, f15:$found15<br>r14q:$res14qry<br>r15q:$res15qry</p>";
				} // if-else
			} else {
				$msginfo="Warning: Date_start should be lower than date_end. Pls try again.";
				
			} // if
		} // if
		if($msginfo!='') {
			// popup alert
			echo "<script type='text/javascript'>alert('$msginfo');</script>";
			$msginfo="";
			// header redirect
			// exit(header("Location: ./cutoff.php?loginid=$loginid"));
			exit(header('Refresh: 1, url = cutoff.php?loginid='.$loginid.''));
		} // if
		
	} elseif($act=='del') {
		
		$cutstart = (isset($_POST['cutstart'])) ? $_POST['cutstart'] :'';
		$cutend = (isset($_POST['cutend'])) ? $_POST['cutend'] :'';
		$act2 = (isset($_POST['act2'])) ? $_POST['act2'] :'';
// echo "<p>$submit, $act, $cutstart, $cutend, $act2</p>";
		if($act2=='del2') {
			if($cutstart!='' && $cutend!='') {
			// delete query
			$res12qry="";
			$res12qry="DELETE FROM tblemppayroll WHERE cut_start='$cutstart' AND cut_end='$cutend'";
			$result12=""; $found12=0;
			$result12=$dbh2->query($res12qry);

				$msginfo="Delete successful for cutoff $cutstart -to- $cutend.";
				
				// insert logs
				$adminlogdetails = "$loginid:$username - deleted cutoff $cutstart -to- $cutend in employees payslip > custom cutoff";
				$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$username\", adminlogdetails=\"$adminlogdetails\"";
				$result17 = $dbh2->query($res17query);
			} // if
			if($msginfo!='') {
			echo "<script type='text/javascript'>alert('$msginfo');</script>";
			} // if
			exit(header('Refresh: 1, url = cutoff.php?loginid='.$loginid.''));		
			
		} else {
			// ask confirmation

include './headsm.php'; ?>
        <div class="table">
		<table class="table">
		<thead><tr><th colspan="2"><font color="red">Deleting payroll cut-off period</font></th></tr></thead>
		<tbody class="col-xs-4">
		<tr><td colspan="2" class="text-center"><p><?php echo date('Y-M-d', strtotime($cutstart)); ?> -to- <?php echo date('Y-M-d', strtotime($cutend)); ?></p></td></tr>
		<tr><td colspan="2" class="text-center text-danger"><h3>Are you sure?</h3></td></tr>
		<tr>
		<form action="emppaycutoffcrea.php?loginid=<?php echo $loginid; ?>" method="POST" name="emppaycutoffcreadel2">
		<input type="hidden" name="act" value="del">
		<input type="hidden" name="act2" value="del2">
    <?php echo "<input type='hidden' name='cutstart' value='$cutstart'>"; ?>
    <?php echo "<input type='hidden' name='cutend' value='$cutend'>"; ?>
		<td class="text-right"><button type="submit" class="btn btn-success" name="submit" value="1">Yes</button></td>
		</form>
		<form action="emppaycutoffcrea.php?loginid=<?php echo $loginid; ?>" method="POST" name="emppaycutoffcrea">
		<td class="text-left"><button type="submit" class="btn btn-danger" name="submit" value=0>No</button></td>
		</form>
		</tr>
		</tbody>
		</table>
		</div>
<?php
include './footsm.php';

		}
	} // if-else($act=='add')

	} else { // if($submit==1)
		
    include ("header.php");
	include ("sidebar.php");
	echo "<p><font size=1>Modules >> Employees' payslip email notifier >> Create cutoff period</font></p>";
?>
    <div class="table">
	<table class="table">
	<form action="emppaycutoffcrea.php?loginid=<?php echo $loginid; ?>" method="POST" name="emppaycutoffcrea">
	<input type="hidden" name="act" value="add">
    <thead><tr><th colspan="3">Create employees payslip custom cutoff period</th>
	</tr></thead>
	<tbody>
	<tr>
	<td>Start_date&nbsp;<input type="date" class="form-group" name="cutstart" value="<?php echo $datenow; ?>"></td>
	<td>End_date&nbsp;<input type="date" class="form-group" name="cutend" value="<?php echo $datenow; ?>"></td>
	<td>&nbsp;<button type="submit" class="btn btn-success" name="submit" value="1">Submit</button></td>
	</tr>
    </form>	
	<tr><th colspan="3">List of created cutoff periods</th></tr>
	<tr><td colspan="3">
<?php
	// query tblemppayroll
	$res11qry="";
	$res11qry="SELECT DISTINCT cut_start, cut_end FROM tblemppayroll ORDER BY cut_start DESC";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11qry);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11=$ctr11+1;
			$emppayrollid11 = $myrow11['emppayrollid'];
			$cutstart11 = $myrow11['cut_start'];
			$cutend11 = $myrow11['cut_end'];
?>
<form action="emppaycutoffcrea.php?loginid=<?php echo $loginid; ?>" method="POST" name="emppaycutoffcreadel">
	<input type="hidden" name="act" value="del">
<?php
    echo "<input type='hidden' name='cutstart' value='$cutstart11'>";
    echo "<input type='hidden' name='cutend' value='$cutend11'>";
			echo "<tr><td>".date('Y-M-d', strtotime($cutstart11))."</td><td>".date('Y-M-d', strtotime($cutend11))."</td><td><button type='submit' class='btn btn-danger btn-sm' name='submit' value=1>del</button></td></tr>";
?>
</form>
<?php
		} // while
	} // if
	// var_dump($res11qry);
?>
	</td></tr>
	</tbody>
	</table>
	</div>
<?php
	} // if-else($submit==1)
	// var_dump($submit, $act, $cutstart, $cutend);
    echo "<p><a href=\"cutoff.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";
    include ("footer.php");
} else {
     include ("logindeny.php");
}
$dbh2->close();
?>