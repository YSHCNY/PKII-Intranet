<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = (isset($_GET['eid'])) ? $_GET['eid'] :'';

$ref_no = (isset($_POST['ref_no'])) ? $_POST['ref_no'] :'';
$proj_code = (isset($_POST['proj_code'])) ? $_POST['proj_code'] :'';
// $position = (isset($_POST['position'])) ? $_POST['position'] :'';
// $durationfrom = $_POST['fromyear'] . '-' . $_POST['frommonth'] . '-' . $_POST['fromday'];
// $durationto = $_POST['toyear'] . '-' . $_POST['tomonth'] . '-' . $_POST['today'];
$datefrom = (isset($_POST['datefrom'])) ? $_POST['datefrom'] :'';
$dateto = (isset($_POST['dateto'])) ? $_POST['dateto'] :'';
$idhrpositionctg = (isset($_POST['idhrpositionctg'])) ? $_POST['idhrpositionctg'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");



//  if ($durationfrom >= $durationto)
//  {
//    echo "<p><font color=red><b>Sorry Invalid Date</b></font></p>";
//    echo "<p>Date duration field 'From' should be earlier than or not equal to the date field 'To'</p>";
//    echo "<p><a href=personnelprojassignadd.php?loginid=$loginid&eid=$employeeid>Back</a></p>";
//  }
//  else
//  {



	$res0query = "SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'";
	$result0="";
	$result0=$dbh2->query($res0query);
	if($result0->num_rows>0) {
		while($myrow0=$result0->fetch_assoc()) {
	  $name_last = $myrow0['name_last'];
	  $name_first = $myrow0['name_first'];
	  $name_middle = $myrow0['name_middle'];
		} // while($myrow0=$result0->fetch_assoc())
	} // if($result0->num_rows>0)

	$res1query = "SELECT proj_fname, proj_sname FROM tblproject1 WHERE proj_code = '$proj_code'";
	$result1="";
	$result1=$dbh2->query($res1query);
	if($result1->num_rows>0) {
		while($myrow1=$result1->fetch_assoc()) {
	  $proj_fname = $myrow1['proj_fname'];
	  $proj_sname = $myrow1['proj_sname'];
		} // while($myrow1=$result1->fetch_assoc())
	} // if($result1->num_rows>0)

  	date_default_timezone_set('Asia/Manila');
		$now = date("Y-m-d H:i:s", time());



	$resquery = "INSERT INTO tblprojassign (employeeid, projdate, ref_no, proj_code, proj_name, position, durationfrom, durationto, idhrpositionctg) VALUES ('$employeeid', '$now', '$ref_no', '$proj_code', '$proj_sname', '$position', '$datefrom', '$dateto', '$idhrpositionctg')";
	$result=$dbh2->query($resquery);




// create log
    include('datetimenow.php');
    $res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16="";
		$result16=$dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16=$result16->fetch_assoc()) {
			$adminuid=$myrow16['adminuid'];
			} // while($myrow16=$result16->fetch_assoc())
		} // if($result16->num_rows>0)
    $adminlogdetails = "$loginid:$adminloginuid - Add new project assignment record:$employeeid - $name_last, $name_first, $name_middle[0]. Details: projdate=$employeeid, projdate=$now, ref_no=$ref_no, proj_code=$proj_code, proj_name=$proj_sname, position= $idhrpositionctg, durationfrom=$datefrom, durationto=$dateto ";
    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17="";
		$result17=$dbh2->query($res17query);

//  }
$message = "New Project has been assigned!";
$_SESSION['success_message'] = $message;
?>
	<script>
			const pid = encodeURIComponent("<?php echo $employeeid; ?>");
			const loginid = encodeURIComponent("<?php echo $loginid; ?>");
			window.location.href = `personneledit2.php?pid=${pid}&loginid=${loginid}`;
		</script>

<?php
  $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
	$result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 

