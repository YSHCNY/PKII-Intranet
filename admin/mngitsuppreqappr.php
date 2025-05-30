<?php 

include("db1.php");
include("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

    //  echo "<p><font size=1>Manage >> Categories >> IT Support approver</font></p>";
?>

    <div class="poppins shadow p-5 rounded">
    	<div class="mb-4">
			<h3 class="m-0">IT Support Approvers</h3>
			<p class="poppins">Defined approvers per department will be visible on the IT support form.</p>
		</div>

<?php
  if($accesslevel >= 4) {

	?>
		<form action="mngitsuppapprupd.php?loginid=<?= $loginid ?>" method="post" name="mngitsuppreqappr">
		<div class="d-flex flex-wrap justify-content-between">
	<?php
		$res11query = "SELECT tbldeptcd.code, tbldeptcd.name, tblitsupportapprover.iditsupportapprover, tblitsupportapprover.approver1empid, tblitsupportapprover.approver2empid, tblitsupportapprover.approver3empid, tblitsupportapprover.deptcd FROM tbldeptcd LEFT JOIN tblitsupportapprover ON tbldeptcd.code=tblitsupportapprover.deptcd";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$ctr11 = $ctr11 + 1;
			$code11 = $myrow11['code'];
			$name11 = $myrow11['name'];
			$iditsupportapprover11 = $myrow11['iditsupportapprover'];
			$approver1empid11 = $myrow11['approver1empid'];
			$approver2empid11 = $myrow11['approver2empid'];
			$approver3empid11 = $myrow11['approver3empid'];
			$deptcd11 = $myrow11['deptcd'];
			?>

			<div class="shadow border rounded mb-5 p-5" style="width: 49%;">
				<input type="hidden" name="deptcd[]" value="<?=$code11?>">
				<h4 class="mt-0 mb-3"><?= "$code11 -" . " $name11" ?></h4>

				<div class="d-flex flex-column mb-2">
					<label class="fw-medium m-0">Approver 1</label>
					<select name="approver1empid[]" class="border border-1 border-secondary rounded" style="height: 30px;">
					<?php
					// Approver 1
					if($approver1empid11=='') { $approver1blanksel="selected"; } else { $approver1blanksel=""; }
					echo "<option value='' $approver1blanksel>-</option>";
					$res12query="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.email1, tblemployee.employeeid, tblempdetails.empdepartment, tblempdetails.empposition FROM tblemployee LEFT JOIN tblempdetails ON tblemployee.employeeid=tblempdetails.employeeid LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE tblemployee.emp_record=\"active\" AND tblemployee.employee_type=\"employee\" ORDER BY tblcontact.name_last ASC";
					$result12=""; $found12=0; $ctr12=0;
					$result12=$dbh2->query($res12query);
					if($result12->num_rows>0) {
						while($myrow12 = $result12->fetch_assoc()) {
						$found12 = 1;
						$ctr12 = $ctr12 + 1;
						$name_last12 = $myrow12['name_last'];
						$name_first12 = $myrow12['name_first'];
						$email112 = $myrow12['email1'];
						$employeeid12 = $myrow12['employeeid'];
						$empdepartment12 = $myrow12['empdepartment'];
						$empposition12 = $myrow12['empposition'];
						if($employeeid12==$approver1empid11) { $approver1empsel="selected"; } else { $approver1empsel=""; }
						echo "<option value=\"$code11-$employeeid12\" $approver1empsel>$name_last12, $name_first12 ($employeeid12) - $empposition12, $empdepartment12</option>";
						}
					}
					?>
					</select>
				</div>

				<div class="d-flex flex-column mb-2">
					<label class="fw-medium m-0">Approver 2</label>
					<select name="approver2empid[]" class="border border-1 border-secondary rounded" style="height: 30px;">
					<?php
					// Approver 2
					if($approver2empid11=='') { $approver2blanksel="selected"; } else { $approver2blanksel=""; }
					echo "<option value='' $approver2blanksel>-</option>";
					$res14query="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.email1, tblemployee.employeeid, tblempdetails.empdepartment, tblempdetails.empposition FROM tblemployee LEFT JOIN tblempdetails ON tblemployee.employeeid=tblempdetails.employeeid LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE tblemployee.emp_record=\"active\" AND tblemployee.employee_type=\"employee\" ORDER BY tblcontact.name_last ASC";
					$result14=""; $found14=0; $ctr14=0;
					$result14=$dbh2->query($res14query);
					if($result14->num_rows>0) {
						while($myrow14 = $result14->fetch_assoc()) {
						$found14 = 1;
						$ctr14 = $ctr14 + 1;
						$name_last14 = $myrow14['name_last'];
						$name_first14 = $myrow14['name_first'];
						$email114 = $myrow12['email1'];
						$employeeid14 = $myrow14['employeeid'];
						$empdepartment14 = $myrow14['empdepartment'];
						$empposition14 = $myrow14['empposition'];
						if($employeeid14==$approver2empid11) { $approver2empsel="selected"; } else { $approver2empsel=""; }
						echo "<option value=\"$code11-$employeeid14\" $approver2empsel>$name_last14, $name_first14 ($employeeid14) - $empposition14, $empdepartment14</option>";
						}
					}
					?>
					</select>
				</div>

				<div class="d-flex flex-column mb-2">
					<label class="fw-medium m-0">Approver 3</label>
					<select name="approver3empid[]" class="border border-1 border-secondary rounded" style="height: 30px;">
					<?php
					// Approver 3
					if($approver3empid11=='') { $approver3blanksel="selected"; } else { $approver3blanksel=""; }
					echo "<option value='' $approver3blanksel>-</option>";
					$res15query="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.email1, tblemployee.employeeid, tblempdetails.empdepartment, tblempdetails.empposition FROM tblemployee LEFT JOIN tblempdetails ON tblemployee.employeeid=tblempdetails.employeeid LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE tblemployee.emp_record=\"active\" AND tblemployee.employee_type=\"employee\" ORDER BY tblcontact.name_last ASC";
					$result15=""; $found15=0; $ctr15=0;
					$result15=$dbh2->query($res15query);
					if($result15->num_rows>0) {
						while($myrow15 = $result15->fetch_assoc()) {
						$found15 = 1;
						$ctr15 = $ctr15 + 1;
						$name_last15 = $myrow15['name_last'];
						$name_first15 = $myrow15['name_first'];
						$email115 = $myrow15['email1'];
						$employeeid15 = $myrow15['employeeid'];
						$empdepartment15 = $myrow15['empdepartment'];
						$empposition15 = $myrow15['empposition'];
						if($employeeid15 == $approver3empid11) { $approver3empsel="selected"; } else { $approver3empsel=""; }
						echo "<option value=\"$code11-$employeeid15\" $approver3empsel>$name_last15, $name_first15 ($employeeid15) - $empposition15, $empdepartment15</option>";
						}
					}
					?>
					</select>
				</div>
			</div>
<?php
			}
		}
?>
		</div>
		<div class="text-center mt-3">
			<input type="submit" value="Save Changes" class="btn bg-success text-white fw-medium" style="width: 200px; height: 37px;">
		</div>
		</form>
<?php
  } // if($accesslevel >= 4)
?>

    </div>

<div class="d-flex justify-content-end mt-5">
	<a href="<?php echo 'mngcateg.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
		<button class="border-0 rounded-3" style="width: 170px; height: 40px; background-color: #0a1d44;">Back</button>
	</a>
</div>
<?php
	$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
	$result = $dbh2->query($resquery);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

$dbh2->close();
?> 
