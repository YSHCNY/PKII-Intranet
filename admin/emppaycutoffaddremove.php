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
	echo "<p><font size=1>Modules >> Employees' payslip email notifier >> Custom cutoff >> add/remove employee no.</font></p>";
?>
    <div class="table">
	<table class="table">
	<form action="emppaycutoffaddremove.php?loginid=<?php echo $loginid; ?>" method="POST" name="emppaycutoffaddremove">
    <thead><tr><th colspan="3">Choose cutoff period</th>
	</tr></thead>
	<tbody>
<?php
    echo "<tr><td colspan='3'>";
    echo "<div class='form-group'><select name='cutoff'>";
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
			} else {
				$cutfinsel="";
			} // if-else
    echo "<option value='$cutfin11' $cutfinsel>$cutstart11-to-$cutend11</option>";
		} // while
	} // if
	echo "</select></div>";
	echo "<button type='submit' class='btn btn-primary' name='submit' value=1>Submit</button>";
	echo "</td></tr>";
	// var_dump($res11qry);
?>
</form>
<?php
	if($submit==1) {
		
		// cutoff selection
        echo "<tr><th colspan='3'>Choose from the list below:</th></tr>";
		echo "<form action='emppaycutoffaddremove.php?loginid=$loginid' method='POST' name='emppaycutoffaddremove'>";
		echo "<input type='hidden' name='cutoff' value='$cutoff'>";
		// query tblcontact tblemployee tblemppayroll and display list of employees with checkbox
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
				} else {
					$f12asel="";
				} // if-else
			echo "<tr><td><input type='checkbox' name='empid[]' value='$employeeid12' $f12asel></td>";
			if($f12asel!='') {
			echo "<td><strong>$employeeid12</strong></td><td><strong>$name_last12, $name_first12 $name_middle12[0].</strong>";
			} else {
			echo "<td>$employeeid12</td><td>$name_last12, $name_first12 $name_middle12[0].";
			} // if-else
			echo "</td></tr>";
			} // while
		} // if
		echo "<tr><td colspan='3'><button type='submit' class='btn btn-success' name='submit' value='2'>Save</button></td></tr>";
		echo "</form>";
		
	} elseif($submit==2) {
		
	    // add/remove personnel
		echo "<tr><th colspan='3'>Preparing and saving list of personnel for $cutstart -to- $cutend</th></tr>";
		echo "<tr><td colspan='3'>";
		$empids = (isset($_POST['empid'])) ? $_POST['empid'] :'';

		// verify checked employeeid
		foreach($empids as $value) {
			// query tblemppayroll based on cutoff and compare employeeid's
			$res14qry=""; $result14=""; $found14=0;
			$res14qry="SELECT employeeid FROM tblemppayroll WHERE cut_start='$cutstart' AND cut_end='$cutend' AND employeeid='$value' ORDER BY employeeid ASC";
		// echo "$res14qry<br>";
			$result14=$dbh2->query($res14qry);
			if($result14->num_rows>0) {
				while($myrow14=$result14->fetch_assoc()) {
					$found14=1;
					$employeeid14 = $myrow14['employeeid'];
				} // while
			} // if
			if($found14==0) {
				// insert query new employeeid.
				$res14aqry=""; $result14a=""; $found14a=0;
				$res14aqry="SELECT ref_no, proj_code, proj_name, salary, salarycurrency, salarytype, ecola1, durationfrom, durationto FROM tblprojassign WHERE employeeid='$value' AND salary<>0 ORDER BY durationfrom DESC LIMIT 1";
				$result14a=$dbh2->query($res14aqry);
				if($result14a->num_rows>0) {
					while($myrow14a=$result14a->fetch_assoc()) {
						$found14a=1;
						$ref_no14a = $myrow14a['ref_no'];
						$proj_code14a = $myrow14a['proj_code'];
						$proj_name14a = $myrow14a['proj_name'];
						$salary14a = $myrow14a['salary'];
						$salarycurrency14a = $myrow14a['salarycurrency'];
						$salarytype14a = $myrow14a['salarytype'];
						$ecola114a = $myrow14a['ecola1'];
						$durationfrom14a = $myrow14a['durationfrom'];
						$durationto14a = $myrow14a['durationto'];
					} // while
				} // if
				if($found14a==1) {
					if($salarytype14a=='daily') {
						$salary14a = $salary14a*26;
					} elseif($salarytype14a=='weekly') {
						$salary14a = $salary14a*4;
					} // if
					if($ecola114a=='') {
						$ecola114a=0;
					} // if
				} else {
					$salary14a=0; $proj_name14a=''; $ecola114a=0;
				} // if
				$res14bqry="";
				$res14bqry="INSERT INTO tblemppayroll SET employeeid='$value', emp_salary=$salary14a, deduction=0, phil_ded=0, tax=0, emp_over_duration=0, net_pay=0, emp_date_wrk=0, emp_sick='', emp_vacation='', cut_start='$cutstart', cut_end='$cutend', regholiday=0, speholiday=0, emp_late_duration=0, otsunday=0, regholidayamt=0, speholidayamt=0, otsundayamt=0, overamt=0, nightdiffminutes=0, nightdiffamt=0, totaltardy=0, otherincome=0, otherincometaxable=0, otherdeduction=0, emp_dep='$proj_name14a', pagibig=0, vlused=0, slused=0, philemp=0, ss=0, ec=0, bracket=0, absentamt=0";
				$result14b="";
				$result14b=$dbh2->query($res14bqry);
				if(mysqli_insert_id($dbh2)!='') {
					// insert record success
					echo "$value > <font color='green'>new. record inserted.</font><br>";
				} else {
					// insert record error
					echo "$value > <font color='red'>new. record insert error.</font><br>";
				} // if-else(mysqli_insert_id)
				
				if($ecola114a!=0) {
                    // insert ecola as employment benefits in tblemppayincomenontaxable
					// set last day of year based on durationfrom
					$durationtoyyyy = date('Y', strtotime($yearnow));
					$durationto = $durationtoyyyy."-12-31";
					$res14cqry="";
					$res14cqry="INSERT INTO tblemppayincomenontaxable SET employeeid='$value', add_desc='Employment Benefits', start='$durationfrom14a', end='$durationto', amount=$ecola114a";
					$result14c=""; $found14c=0;
					$result14c=$dbh2->query($res14cqry);
					/* if(mysqli_insert_id($dbh2)!='') {
						// insert record success
					echo "$value > <font color='green'>ecola record inserted.</font><br>";
					} else {
						// insert record error
					echo "$value > <font color='red'>ecola record insert error.</font><br>";
					} // if-else(mysqli_insert_id) */
				} // if

			} // if($found14==0)
			// echo "$value f14:$found14<br>f14a:$found14a $res14aqry<br>$res14bqry<br>$res14cqry<br>";
			$employeeid14=''; $res14aqry=''; $res14bqry=''; $res14cqry='';
		} // foreach

        // determine unchecked employeeid
        $res14qry="";
		$res14qry="SELECT employeeid FROM tblemppayroll WHERE cut_start='$cutstart' AND cut_end='$cutend' ORDER BY employeeid ASC";
		// echo "$res14qry<br>";
		$result14=""; $found14=0;
		$result14=$dbh2->query($res14qry);
		if($result14->num_rows>0) {
			while($myrow14=$result14->fetch_assoc()) {
				$found14=1;
				$employeeid14 = $myrow14['employeeid'];
				if (in_array($employeeid14, $empids) == false) {
					// delete query
					$res14aqry="";
					$res14aqry="DELETE FROM tblemppayroll WHERE employeeid='$employeeid14' AND cut_start='$cutstart' AND cut_end='$cutend'";
					$result14a="";
					$result14a=$dbh2->query($res14aqry);
					if($result14a!='') {
						// delete record
					echo $employeeid14."<font color='green'> > deleting record.</font><br>";
					} else {
						// error in deleting record.
					echo $employeeid14."<font color='red'> > error in deleting record.</font><br>";
					} // if-else
				} // if
			// echo "$res14aqry<br>";
				$employeeid14=''; $res14aqry='';
			} // while
		} // if

		echo "</td></tr>";
		
		// insert logs
		$adminlogdetails = "$loginid:$username - add-remove personnel thru empID for cutoff $cutstart -to- $cutend in employees payslip > custom cutoff";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$username\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);
		
	} // if-else($submit==1)
?>
	</tbody>
	</table>
	</div>
<?php
    echo "<p><a href=\"cutoff.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";
    include ("footer.php");
} else {
     include ("logindeny.php");
}
$dbh2->close();
?>