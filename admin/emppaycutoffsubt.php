<?php
//
// emppaycutoffsubt.php crea:20200426
// fr cutoff.php
//
require_once './db1.php';
include './datetimenow.php';

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$tblsel = (isset($_GET['t'])) ? $_GET['t'] :'';
$tblsel2 = (isset($_POST['t2'])) ? $_POST['t2'] :'';
if($tblsel2!='') { $tblsel=$tblsel2; } // if

$submitsw = (isset($_POST['submit'])) ? $_POST['submit'] :'';
$action = (isset($_POST['act'])) ? $_POST['act'] :'';
if($action=='edt') {
	$idedtdel = (isset($_POST['id'])) ? $_POST['id'] :'';
} // if
$action2 = (isset($_POST['act2'])) ? $_POST['act2'] :'';

$actionedtdel = (isset($_GET['act'])) ? $_GET['act'] :'';
if($actionedtdel!='') {
	$action=$actionedtdel;
	$idedtdel = (isset($_GET['id'])) ? $_GET['id'] :'';
} // if

$found = 0;
if($loginid != "") {
    include './logincheck.php';
}
if($found==1) {
	//
	// start here
	//
if($tblsel=='nt') {
	// for non-taxable income
	$tblnm="Non-taxable income";
	$tbldb="tblemppayincomenontaxable";
	$col0_id="id"; $col1_eid="employeeid"; $col2_desc="add_desc"; $col3_dtstart="start"; $col4_dtend="end"; $col5_amt="amount";
	
} elseif($tblsel=='it') {
	// for taxable inome
	$tblnm="Taxable income";
	$tbldb="tblemppayincometaxable";
	$col0_id="id"; $col1_eid="employeeid"; $col2_desc="add_desc"; $col3_dtstart="start"; $col4_dtend="end"; $col5_amt="amount";
	
} elseif($tblsel=='od') {
	// for other deductions
	$tblnm="Other deductions";
	$tbldb="tblemppayotherdeductions";
	$col0_id="id"; $col1_eid="employeeid"; $col2_desc="ded_desc"; $col3_dtstart="start"; $col4_dtend="end"; $col5_amt="amountdeduct";

} // if-elseif

//
// views
//
    include ("header.php");
	include ("sidebar.php");
	echo "<p><font size=1>Modules >> Employees' payslip email notifier >> Manage incomes / deductions</font></p>";

if($action=='addnew') {
	if($action2=='addsave') {
		$new_employeeid = trim((isset($_POST['eid'])) ? $_POST['eid'] :'');
		$new_employeeid = htmlentities(strip_tags(stripslashes($new_employeeid)));
		$new_desc = trim((isset($_POST['desc'])) ? $_POST['desc'] :'');
		$new_desc = htmlentities(strip_tags(stripslashes($new_desc)));
		$new_dtfrom =  (isset($_POST['dtfrom'])) ? $_POST['dtfrom'] :'';
		$new_dtto =  (isset($_POST['dtto'])) ? $_POST['dtto'] :'';
		$new_amount =  (isset($_POST['amount'])) ? $_POST['amount'] :'';
		if((isset($new_employeeid)) && (isset($new_desc)) && (isset($new_dtfrom)) && (isset($new_dtto)) && (isset($new_amount))) {
			// echo "<p>$loginid, $tblsel, $action, $action2<br>$new_employeeid, $new_desc, $new_dtfrom, $new_dtto, $new_amount</p>";
			if(strtotime($new_dtfrom) <= strtotime($new_dtto)) {
				// insert query
				$res12aqry=""; $result12a=""; $found12a=0;
				$res12aqry="INSERT INTO $tbldb SET $col1_eid=\"$new_employeeid\", $col2_desc=\"$new_desc\", $col3_dtstart=\"$new_dtfrom\", $col4_dtend=\"$new_dtto\", $col5_amt=\"$new_amount\"";
				$result12a=$dbh2->query($res12aqry);
				if($result12a!='') {
					$msginfo="Insert new record successful.";
				} else {
					$msginfo="Warning: insert record error.";
				} // if-else
			} else {
				$msginfo="Warning: datefrom should be lower than dateto. Pls try again.";
			} // if-else
		} // if
		if($msginfo!='') {
			echo "<script type='text/javascript'>alert('$msginfo');</script>";
			$msginfo="";
		} // if
// echo "<p>$res12aqry</p>";
	} else {		
?>
	<div class="table">
	<table class="table table-striped">
	<thead><tr><th colspan="2"><?php echo $tblnm." add new record"; ?></th></tr></thead>
	<tbody>
	<form action='emppaycutoffsubt.php?loginid=<?php echo $loginid; ?>' method='POST' name='emppaycutoffsubt'>
	<input type="hidden" name="t2" value="<?php echo $tblsel; ?>">
	<input type="hidden" name="act" value="addnew">
	<tr><th class="text-right">name</th><td>
	<div class="form-group">
	<select class="form-control" name="eid">
<?php
    $res12qry=""; $result12=""; $found12=0; $ctr12=0;
	$res12qry="SELECT tblemployee.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblemployee LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE tblemployee.emp_record='active' AND tblcontact.contact_type='personnel' ORDER BY tblemployee.employeeid ASC";
	$result12=$dbh2->query($res12qry);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
			$found12=1;
			$ctr12=$ctr12+1;
			$employeeid12 = $myrow12['employeeid'];
			$name_last12 = $myrow12['name_last'];
			$name_first12 = $myrow12['name_first'];
			$name_middle12 = $myrow12['name_middle'];
			echo "<option value='$employeeid12'>$employeeid12 - $name_last12, $name_first12 $name_middle12[0]</option>";
		} // while
	} // if
?>
    </select>
	<div class="form-group">
	</td></tr>
	<tr><th class="text-right">description</th><td>
	<div class="form-group">
	<input type="text" class="form-control" name="desc" value="" placeholder="description">
	</div>
	</td></tr>
	<tr><th class="text-right">from</th><td>
	<div class="form-group">
	<input type="date" class="form-control" name="dtfrom" value="<?php echo $datenow; ?>">
	</div>
	</td></tr>
	<tr><th class="text-right">to</th><td>
	<div class="form-group">
	<input type="date" class="form-control" name="dtto" value="<?php echo $datenow; ?>">
	</div>
	</td></tr>
	<tr><th class="text-right">amount</th><td>
	<div class="form-group">
	<input type="currency" class="form-control" name="amount" value="0">
	</div>
	</td></tr>
	<tr><td colspan="2"><button type="submit" class="btn btn-success" name="act2" value="addsave">Save</button></td></tr>
	</form>
	</tbody>
	</table>
	</div>
<?php
	} // if-elseif

} elseif($action=='edt') {
	if($action2=='editsave') {
		if($idedtdel!='') {
		// update query
		$edt_desc = trim((isset($_POST['desc'])) ? $_POST['desc'] :'');
		$edt_desc = htmlentities(strip_tags(stripslashes($edt_desc)));
		$edt_dtstart = trim((isset($_POST['dtfrom'])) ? $_POST['dtfrom'] :'');
		$edt_dtend = trim((isset($_POST['dtto'])) ? $_POST['dtto'] :'');		
		$edt_amt = trim((isset($_POST['amount'])) ? $_POST['amount'] :'');
		$res14aqry=""; $result14a=""; $found14a=0;
		$res14aqry="UPDATE $tbldb SET $col2_desc=\"$edt_desc\", $col3_dtstart='$edt_dtstart', $col4_dtend='$edt_dtend', $col5_amt='$edt_amt' WHERE $col0_id=$idedtdel";
		$result14a=$dbh2->query($res14aqry);
		if($result14a!='') {
			$msginfo="Update record successful.";
		} else {
			$msginfo="Update record failed. Pls try again.";
		} // if
		if($msginfo!='') {
			echo "<script type='text/javascript'>alert('$msginfo');</script>";
			$msginfo="";
		} // if
		} // if
		
	} else {
		// display edit form		
	// query based on id
	$res14qry=""; $result14=""; $found14=0;
	$res14qry="SELECT $tbldb.$col1_eid, $tbldb.$col2_desc, $tbldb.$col3_dtstart, $tbldb.$col4_dtend, $tbldb.$col5_amt, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM $tbldb LEFT JOIN tblcontact ON $tbldb.$col1_eid=tblcontact.employeeid WHERE $tbldb.$col0_id=$idedtdel AND tblcontact.contact_type='personnel'";
	$result14=$dbh2->query($res14qry);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
			$found14=1;
			$edt_eid14 = $myrow14[$col1_eid];
			$edt_desc14 = $myrow14[$col2_desc];
			$edt_dtstart14 = $myrow14[$col3_dtstart];
			$edt_dtend14 = $myrow14[$col4_dtend];
			$edt_amt14 = $myrow14[$col5_amt];
			$name_last14 = $myrow14['name_last'];
			$name_first14 = $myrow14['name_first'];
			$name_middle14 = $myrow14['name_middle'];
		} // while
	} // if
	if($found14==1) {
		// display form with values
?>
	<div class="table">
	<table class="table table-striped">
	<thead><tr><th colspan="2"><?php echo $tblnm." edit record"; ?></th></tr></thead>
	<tbody>
	<form action='emppaycutoffsubt.php?loginid=<?php echo $loginid; ?>' method='POST' name='emppaycutoffsubt'>
	<input type="hidden" name="t2" value="<?php echo $tblsel; ?>">
	<input type="hidden" name="act" value="edt">
	<input type="hidden" name="id" value="<?php echo $idedtdel; ?>">
	<tr><th class="text-right">emp.no.</th><th class="text-left">
	<?php echo $edt_eid14; ?>
	</th></tr>
	<tr><th class="text-right">name</th><th class="text-left">
	<?php echo $name_last14.", ".$name_first14." ".$name_middle14[0]."."; ?>
	</th></tr>
	<tr><th class="text-right">description</th><td>
	<div class="form-group">
	<input type="text" class="form-control" name="desc" value="<?php echo $edt_desc14; ?>" placeholder="description">
	</div>
	</td></tr>
	<tr><th class="text-right">from</th><td>
	<div class="form-group">
	<input type="date" class="form-control" name="dtfrom" value="<?php echo $edt_dtstart14; ?>">
	</div>
	</td></tr>
	<tr><th class="text-right">to</th><td>
	<div class="form-group">
	<input type="date" class="form-control" name="dtto" value="<?php echo $edt_dtend14; ?>">
	</div>
	</td></tr>
	<tr><th class="text-right">amount</th><td>
	<div class="form-group">
	<input type="currency" class="form-control" name="amount" value="<?php echo $edt_amt14; ?>">
	</div>
	</td></tr>
	<tr><td colspan="2"><button type="submit" class="btn btn-success" name="act2" value="editsave">Save</button></td></tr>
	</form>
	</tbody>
	</table>
	</div>
<?php		
	} // if
	} // if-else

} elseif($action=='del') {

	// delete query
	$res12aqry=""; $result12a=""; $found12a=0;
	// $res12aqry="DELETE FROM $tbldb WHERE $col0_id=$edt_id AND $col1_eid='$edt_eid'";
	$res12aqry="DELETE FROM $tbldb WHERE $col0_id=$idedtdel";
	$result12a=$dbh2->query($res12aqry);
	if($result12a!='') {
		$msginfo="Record deleted.";
	} else {
		$msginfo="Warning: delete record failed.";
	} // if-else

	if($msginfo!='') {
		echo "<script type='text/javascript'>alert('$msginfo');</script>";
		$msginfo="";
	} // if
// echo "<p>$idedtdel, r12aq:$res12aqry</p>";

} else { //if-elseif-else($action==)	
?>
    <div class="table">
	<table class="table table-striped">
	<thead>
	<tr><th colspan="8">Manage employees payslip sub-tables</th></tr>
	</thead>
	<tbody>
	<form action="emppaycutoffsubt.php?loginid=<?php echo $loginid; ?>" method="POST" name="emppaycutoffsubt">
	<tr><td colspan="8">
	<div class="form-group">
	<select name="t2" class="form-control">
<?php
    if($tblsel=='nt') {
		$tblntsel="selected"; $tblitsel=""; $tblodsel="";
	} elseif($tblsel=='it') {
		$tblntsel=""; $tblitsel="selected"; $tblodsel="";
	} elseif($tblsel=='od') {
		$tblntsel=""; $tblitsel=""; $tblodsel="selected";
	} // if-elseif
?>
	<option value="nt" <?php echo $tblntsel; ?>>Non-taxable income</option>
	<option value="it" <?php echo $tblitsel; ?>>Taxable income</option>
	<option value="od" <?php echo $tblodsel; ?>>Other deductions</option>
	</select>
	</div>
	<div class="form-group">
	<button type="submit" class="btn btn-primary" name="submit" value="1">Submit</button>
	</div>
	</form>
	</td></tr>
<?php
if($submitsw==1 && $tblsel!='') {

	// display add button
	echo "<tr><th colspan='8'>".$tblnm."</th></tr>";
	echo "<form action='emppaycutoffsubt.php?loginid=$loginid&t=$tblsel' method='POST' name='emppaycutoffsubt'>";
	echo "<tr><td colspan='8'>";
	echo "<button type='submit' class='btn btn-primary' name='act' value='addnew'>Add new</button>";
	echo "</td></tr>";
	echo "</form>";
	
	// display column headers
	echo "<tr><th>Ctr</th><th>EmpID</th><th>Name</th><th>Desc</th><th>From</th><th>To</th><th>Amount</th><th>Action</th></tr>";
	// query table
	$res11qry=""; $result11=""; $found11=0; $ctr11=0;
	$res11qry="SELECT $tbldb.$col0_id, $tbldb.$col1_eid, $tbldb.$col2_desc, $tbldb.$col3_dtstart, $tbldb.$col4_dtend, $tbldb.$col5_amt, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM $tbldb LEFT JOIN tblcontact ON $tbldb.$col1_eid=tblcontact.employeeid WHERE tblcontact.contact_type='personnel' ORDER BY $tbldb.$col1_eid ASC, $tbldb.$col4_dtend DESC";
	$result11=$dbh2->query($res11qry);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11 = $ctr11+1;
			$col0_id11 = $myrow11[$col0_id];
			$col1_eid11 = trim($myrow11[$col1_eid]);
			$col2_desc11 = trim($myrow11[$col2_desc]);
			$col3_dtstart11 = trim($myrow11[$col3_dtstart]);
			$col4_dtend11 = trim($myrow11[$col4_dtend]);
			$col5_amt11 = $myrow11[$col5_amt];
			$name_last11 = $myrow11['name_last'];
			$name_first11 = $myrow11['name_first'];
			$name_middle11 = $myrow11['name_middle'];
			// display results
			echo "<tr>";
			echo "<td>$ctr11</td><td><strong>$col1_eid11</strong></td>";
			echo "<td><strong>$name_last11, $name_first11 $name_middle11[0].</strong></td>";
			echo "<td>$col2_desc11</td><td>".date('Y-M-d', strtotime($col3_dtstart11))."</td><td>".date('Y-M-d', strtotime($col4_dtend11))."</td><td class='text-right'>".number_format($col5_amt11, 2)."</td>";
			echo "<td>";
			echo "<a href='emppaycutoffsubt.php?loginid=$loginid&t=$tblsel&act=edt&id=$col0_id11' class='btn btn-warning btn-sm' name='act' value='edt' role='button'>Edit</a>";
			echo "&nbsp;";
			echo "<a href='emppaycutoffsubt.php?loginid=$loginid&t=$tblsel&act=del&id=$col0_id11' class='btn btn-danger btn-sm' name='act' value='del' role='button'>Del</a>";
			echo "</td>";
			echo "</tr>";
		} // while
	} // if
// echo "<p>subsw:$submitsw, tbl:$tblsel, act:$action<br>r12aq:$res12aqry</p>";	
} // if($submitsw==1 && $tblsel!='')
?>
	</tbody>
	</table>
	</div>
<?php
} //if-elseif-else($action==)

	//
	// end here
	//
	// prep back button based on prev page
	if($action!='') {
	    echo "<p><a href=\"emppaycutoffsubt.php?loginid=$loginid&t=$tblsel\" class='btn btn-default' role='button'>Back</a></p>";
	} else {
		echo "<p><a href=\"cutoff.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";	
	} // if-else

    include './footer.php';
} else {
    include './logindeny.php';
}
$dbh2->close();
?>