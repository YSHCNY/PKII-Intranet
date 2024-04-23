<?php 

include("db1.php");

include ("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$pid = (isset($_GET['pid'])) ? $_GET['pid'] :'';

$employeetype = (isset($_POST['employeetype'])) ? $_POST['employeetype'] :'';
$employeeorder = (isset($_POST['employeeorder'])) ? $_POST['employeeorder'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");
?>

<link rel="stylesheet" href="../admin/css/ManPer.css">

<div class="poppins">
    <div class="w-100 text-center mb-5">
        <h2 class="text-black fw-semibold">Manage Personnel Information</h2>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-5">
		<div>
			<h5>
				Displaying list: <strong><?php echo $employeetype; ?></strong> in <strong><?php echo $employeeorder; ?></strong> order.<br>
			</h5>
		</div>
        <div class="d-flex justify-content-end px-3">
            <form action="personnel.php?loginid=<?php echo $loginid; ?>" method="POST">
                <div>
                    <div class="d-flex align-items-end gap-2">
                        <div>
							<font size="1" class="fw-bold">Choose a criteria</font><br>
                            <select name="employeetype" id="list">
                                <option value="ative employees">Active Employees</option>
                                <option value="active-consultants">Active Consultants</option>
                                <option value="active-employees-consultants" selected>Active Employees & Consultants</option>
                                <hr>
                                <option value="inactive-employees">Inactive Employees</option>
                                <option value="inactive-consultants">Inactive Consultants</option>
                                <option value="inactive-employees-consultants">Inactive Employees & Consultants</option>
                                <hr>
                                <option value="all-employees">All Employees</option>
                                <option value="all-consultants">All Consultants</option>
                                <option value="all-personnel">ALL</option>
                            </select>
                        </div>
                        <div>
							<font size="1" class="fw-bold">Sort by</font><br>
                            <select name="employeeorder" id="list">
                                <option value="tblcontact.employeeid">Employee Number</option>
                                <option value="tblcontact.name_last" selected>Last Name</option>
                                <option value="tblcontact.name_first">First Name</option>
                                <option value="tblcontact.email1">E-mail</option>
                            </select>
                        </div>
                        <div id="inpsbmt">
							<input type="submit" value="Go" class="poppins">
						</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
	<h5 class="text-center my-4"><Strong>Note:</Strong> Click Cards to see <span class="text-info fw-semibold">More Info</span></h5>
	<div class="w-100 d-flex justify-content-center flex-wrap flex-row gap-5 px-5">
	<?php
		$count = 0;

		if($employeetype == 'active-employees') {
			$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.picfn FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder";
		} else if($employeetype == 'inactive-employees') {
			$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.picfn FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'inactive' ORDER BY $employeeorder";
		} else if($employeetype == 'all-employees') {
			$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.picfn FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' ORDER BY $employeeorder";
		} else if($employeetype == 'active-consultants') {
			$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.picfn FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder";
		} else if($employeetype == 'inactive-consultants') {
			$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.picfn FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' AND tblemployee.emp_record = 'inactive' ORDER BY $employeeorder";
		} else if($employeetype == 'all-consultants') {
			$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.picfn FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' ORDER BY $employeeorder";
		} else if($employeetype == 'all-personnel') {
			$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.picfn FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' ORDER BY $employeeorder";
		} else if($employeetype == 'active-employees-consultants') {
			$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.picfn FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder";
		} else if($employeetype == 'inactive-employees-consultants') {
			$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.picfn FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.emp_record = 'inactive' ORDER BY $employeeorder";
		}

		$result="";
		$result=$dbh2->query($resquery);
		if($result->num_rows>0) {
			while($myrow=$result->fetch_assoc()) {
				$count = $count + 1;
				$pid = $myrow['employeeid'];
				$employeeid = $pid;
				$namefirst = $myrow['name_first'];
				$namelast = $myrow['name_last'];
				$namemiddle = $myrow['name_middle'];
				$email1 = $myrow['email1'];
				$email2 = $myrow['email2'];
				$contact_address1 = $myrow['contact_address1'];
				$contact_address2 = $myrow['contact_address2'];
				$contact_city = $myrow['contact_city'];
				$contact_province = $myrow['contact_province'];
				$contact_zipcode = $myrow['contact_zipcode'];
				$contact_country = $myrow['contact_country'];
				$num_res1_cc = $myrow['num_res1_cc'];
				$num_res1_ac = $myrow['num_res1_ac'];
				$num_res1 = $myrow['num_res1'];
				$num_res2_cc = $myrow['num_res2_cc'];
				$num_res2_ac = $myrow['num_res2_ac'];
				$num_res2 = $myrow['num_res2'];
				$num_mobile1_cc = $myrow['num_mobile1_cc'];
				$num_mobile1_ac = $myrow['num_mobile1_ac'];
				$num_mobile1 = $myrow['num_mobile1'];
				$num_mobile2_cc = $myrow['num_mobile2_cc'];
				$num_mobile2_ac = $myrow['num_mobile2_ac'];
				$num_mobile2 = $myrow['num_mobile2'];
				$picfn = $myrow['picfn'];
	?>
<div id="cards" class="p-2">
	<a href="personnelmoreinfo.php?pid=<?php echo $pid; ?>&loginid=<?php echo $loginid; ?>" target="_blank">
		<div>
			<h5 class="m-0 fw-bold text-black"><?php echo $count; ?></h5>
		</div>
		<?php if($picfn!='') { ?>
			<div class="text-center mb-4">
				<img src="images/<?php echo $picfn; ?>" height="100" width="100" class="rounded-4 border border-2 border-dark shadow">
			</div>
		<?php } else { ?>
			<div class="text-center mb-3">
				<img src="" height="100" width="100" class="rounded-4 border border-1 border-dark shadow">
			</div>
		<?php } ?>
		<div class="text-center">
			<h5 class="my-2 text-black"><?php echo $employeeid; ?></h5>
		</div>
		<div class="text-center">
			<h5 class="my-2 text-black"><?php echo $namelast; ?>, <?php echo $namefirst; ?> <?php $midint = $namemiddle; echo $midint[0]; ?>.</h5>
		</div>
		<div class="text-center">
			<h5 class="my-2 text-black">
				<?php
					if($contact_address1!='') { echo "$contact_address1"; }
					if($contact_address2!='') { echo ",&nbsp;$contact_address2"; }
					if($contact_city!='') { echo ",&nbsp;$contact_city"; }
					if($contact_province!='') { echo ",&nbsp;$contact_province"; }
					if($contact_zipcode!='') { echo "&nbsp;$contact_zipcode"; }
					if($contact_country!='') { echo "&nbsp;$contact_country"; }
				?>
			</h5>
		</div>

		<div class="text-center">
			<h5 class="my-2 text-black">
				<?php
					if($num_res1<>'') { echo "$num_res1_cc $num_res1_ac $num_res1"; }
					if(($num_res2<>'') && ($num_res1<>'')) { echo "<br>$num_res2_cc $num_res2_ac $num_res2"; }
					else if(($num_res2<>'') && ($num_res1=='')) { echo "$num_res2_cc $num_res2_ac $num_res2"; }
				?>
			</h5>
		</div>

		<div class="text-center">
			<h5 class="my-2 text-black">
				<?php
					if($num_mobile1<>'') { echo "$num_mobile1_cc $num_mobile1_ac $num_mobile1"; }
					if(($num_mobile2<>'') && ($num_mobile1<>'')) { echo "<br>$num_mobile2_cc $num_mobile2_ac $num_mobile2"; }
					else if(($num_mobile2<>'') && ($num_mobile1=='')) { echo "$num_mobile2_cc $num_mobile2_ac $num_mobile2"; }
				?>
			</h5>
		</div>

		<div class="text-center">
			<h5 class="my-2 text-primary">
				<?php
					if($email1<>'') { echo "<a href=mailto:$email1>$email1</a>"; }
					if(($email2<>'') && ($email1<>'')) { echo "<br><a href=mailto:$email2>$email2</a>"; }
					else if(($email2<>'') && ($email1=='')) { echo "<a href=mailto:$email2>$email2</a>"; }
				?>
			</h5>
		</div>
	</a>
</div>

<?php
        }
    }
?>
</div>
</div>

	<div class="d-flex justify-content-end px-5 pt-5">
        <button class="border-0 rounded-3" style="width: 12.5%; height: 40px; background-color: #0a1d44;">
            <a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">Back</a>
        </button>
    </div>

<?php
$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
$result=$dbh2->query($resquery);

include ("footer.php");

} else {

include("logindeny.php");

}

$dbh2->close();
?>