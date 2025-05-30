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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // $(document).ready(function(){
    //     $('#toggleViewSwitch').change(function(){
    //         if($(this).is(':checked')){
    //             $('#cardview').hide();
    //             $('#listview').show();
    //             $('#sliderText').text('List');
    //         } else {
    //             $('#listview').hide();
    //             $('#cardview').show();
    //             $('#sliderText').text('Card');
    //         }
    //     });
    // });
</script>
<link rel="stylesheet" href="../admin/css/ManagePers.css">
<style>

</style>
<div class="">
<!-- <div class="mb-4">
	<a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none  mainbtnclr btn">
		back
	</a>
</div> -->
<div class = 'shadow p-3 mb-3'>
    <div class="mx-5 mb-2">
        <h4 class="mb-0 pb-0">Personnel Information</h4>
		<p class = 'text-secondary'>View personnel full information</p>
    </div>

    <div class="mb-3">

        <div class="">
            <form action="personnel.php?loginid=<?php echo $loginid; ?>" method="POST">
                <div>
                    <div class="d-flex align-items-end text-center gap-2">
                        <div>
							<label  class=" h5 ">Choose a criteria</label>
                            <select name="employeetype" class = 'form-control' id="list" class="">
                                <option value="active-employees">Active Employees</option>
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
							<label  class=" h5">Sort by</label>
                            <select name="employeeorder" class = 'form-control' id="list" class="">
                                <option value="tblcontact.employeeid">Employee Number</option>
                                <option value="tblcontact.name_last" selected>Last Name</option>
                                <option value="tblcontact.name_first">First Name</option>
                                <option value="tblcontact.email1">E-mail</option>
                            </select>
                        </div>
                        <div id="inpsbmt">
							<input type="submit" value="Go" class="btn mainbtnclr text-white">
						</div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- List View -->
<div id="listview">
<!-- <h5 class=" my-4 text-danger"><Strong>Note:</Strong> Click Row to see <span class="text-info fw-semibold">More Info</span></h5> -->
<div class="bg-white p-4 shadow">
	<table class="table table-bordered table-striped table-hover" id = 'persinfdir'>
	<thead class = 'table-dark'>	
	<tr>
		<th class=""></th>
	
			<th class="">Name</th>
			<th class="">Address</th>
			<th class="">Landline</th>
			<th class="">Number</th>
			<th class="">Email</th>
		</tr>
		</thead>
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
		} else if ($employeetype == ''){
			$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.picfn FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder";

		} else {
			$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.picfn FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder";

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
	<tr onclick="window.location.href='personnelmoreinfo.php?pid=<?php echo $pid; ?>&loginid=<?php echo $loginid; ?>';" style="cursor:pointer;">
	
		<?php if($picfn!='') { ?>
			<td>
				<img src="../vc/images/<?php echo $picfn; ?>" height="50" width="50" class="">
			
			</td>
		<?php } else { ?>
			<td>
				<img src="" height="50" width="50" class="">
			</td>
		<?php } ?>

		<td class=" ">
			<h5 class=""><?php echo $namelast; ?>, <?php echo $namefirst; ?> <?php $midint = $namemiddle; echo $midint[0]; ?>. (<?php echo $employeeid; ?>)</h5>
		</td>
		<td class="">
			<h5 class="">
				<?php
					if($contact_address1!='') { echo "$contact_address1"; }
					if($contact_address2!='') { echo ",&nbsp;$contact_address2"; }
					if($contact_city!='') { echo ",&nbsp;$contact_city"; }
					if($contact_province!='') { echo ",&nbsp;$contact_province"; }
					if($contact_zipcode!='') { echo "&nbsp;$contact_zipcode"; }
					if($contact_country!='') { echo "&nbsp;$contact_country"; }
				?>
			</h5>
		</td>

		<td class=" >
			<h5 class="">
				<?php
					if($num_res1<>'') { echo "$num_res1_cc $num_res1_ac $num_res1"; }
					if(($num_res2<>'') && ($num_res1<>'')) { echo "<br>$num_res2_cc $num_res2_ac $num_res2"; }
					else if(($num_res2<>'') && ($num_res1=='')) { echo "$num_res2_cc $num_res2_ac $num_res2"; }
				?>
			</h5>
		</td>

		<td class=" >
			<h5 class="">
				<?php
					if($num_mobile1<>'') { echo "$num_mobile1_cc $num_mobile1_ac $num_mobile1"; }
					if(($num_mobile2<>'') && ($num_mobile1<>'')) { echo "<br>$num_mobile2_cc $num_mobile2_ac $num_mobile2"; }
					else if(($num_mobile2<>'') && ($num_mobile1=='')) { echo "$num_mobile2_cc $num_mobile2_ac $num_mobile2"; }
				?>
			</h5>
		</td>

		<td class=" >
			<h5 class="y ">
				<?php
					if($email1<>'') { echo "<a href=mailto:$email1>$email1</a>"; }
					if(($email2<>'') && ($email1<>'')) { echo "<br><a href=mailto:$email2>$email2</a>"; }
					else if(($email2<>'') && ($email1=='')) { echo "<a href=mailto:$email2>$email2</a>"; }
				?>
			</h5>
		</td>
	</tr>

<?php
        }
    }
?>
</table>
</div>
</div>
<!-- List View -->
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

<style>
	table th{
		white-space: nowrap;
	
	}

	thead{
		position: sticky !important;
		top: 60 !important;
		z-index: 10 !important;
	}
	th, td{
		text-align: center;
	}

	td{
		padding: 10px;
	}

	
</style>