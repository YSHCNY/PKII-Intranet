<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = (isset($_GET['eid'])) ? $_GET['eid'] :'';
$projassignid = (isset($_GET['pid'])) ? $_GET['pid'] :'';

$ref_no = (isset($_POST['ref_no'])) ? $_POST['ref_no'] :'';
$position = (isset($_POST['position'])) ? $_POST['position'] :'';
$salary = (isset($_POST['salary'])) ? $_POST['salary'] :'';
$salarycurrency = (isset($_POST['salarycurrency'])) ? $_POST['salarycurrency'] :'';
$salarytype = (isset($_POST['salarytype'])) ? $_POST['salarytype'] :'';
$allow_inc = (isset($_POST['allow_inc'])) ? $_POST['allow_inc'] :'';
$allow_inc_currency = (isset($_POST['allow_inc_currency'])) ? $_POST['allow_inc_currency'] :'';
$allow_inc_paytype = (isset($_POST['allow_inc_paytype'])) ? $_POST['allow_inc_paytype'] :'';
$allow_proj = (isset($_POST['allow_proj'])) ? $_POST['allow_proj'] :'';
$allow_proj_currency = (isset($_POST['allow_proj_currency'])) ? $_POST['allow_proj_currency'] :'';
$allow_proj_paytype = (isset($_POST['allow_proj_paytype'])) ? $_POST['allow_proj_paytype'] :'';
$allow_field = (isset($_POST['allow_field'])) ? $_POST['allow_field'] :'';
$allow_field_currency = (isset($_POST['allow_field_currency'])) ? $_POST['allow_field_currency'] :'';
$allow_field_paytype = (isset($_POST['allow_field_paytype'])) ? $_POST['allow_field_paytype'] :'';
$allow_accomm = (isset($_POST['allow_accomm'])) ? $_POST['allow_accomm'] :'';
$allow_accomm_currency = (isset($_POST['allow_accomm_currency'])) ? $_POST['allow_accomm_currency'] :'';
$allow_accomm_paytype = (isset($_POST['allow_accomm_paytype'])) ? $_POST['allow_accomm_paytype'] :'';
$allow_transpo = (isset($_POST['allow_transpo'])) ? $_POST['allow_transpo'] :'';
$allow_transpo_currency = (isset($_POST['allow_transpo_currency'])) ? $_POST['allow_transpo_currency'] :'';
$allow_transpo_paytype = (isset($_POST['allow_transpo_paytype'])) ? $_POST['allow_transpo_paytype'] :'';
$allow_comm = (isset($_POST['allow_comm'])) ? $_POST['allow_comm'] :'';
$allow_comm_currency = (isset($_POST['allow_comm_currency'])) ? $_POST['allow_comm_currency'] :'';
$allow_comm_paytype = (isset($_POST['allow_comm_paytype'])) ? $_POST['allow_comm_paytype'] :'';
$perdiem = (isset($_POST['perdiem'])) ? $_POST['perdiem'] :'';
$perdiem_currency = (isset($_POST['perdiem_currency'])) ? $_POST['perdiem_currency'] :'';
$ecola1 = (isset($_POST['ecola1'])) ? $_POST['ecola1'] :'';
$ecola1_currency = (isset($_POST['ecola1_currency'])) ? $_POST['ecola1_currency'] :'';
$ecola2 = (isset($_POST['ecola2'])) ? $_POST['ecola2'] :'';
$ecola2_currency = (isset($_POST['ecola2_currency'])) ? $_POST['ecola2_currency'] :'';

$durationfrom = $_POST['duration1from'];
$durationto = $_POST['duration1to'];

$durationfrom2 = $_POST['duration2from'];
$durationto2 = $_POST['duration2to'];




$termresign = $_POST['termresign'];



$durationtotal = (isset($_POST['durationtotal'])) ? $_POST['durationtotal'] :'';
$durationtotprop = (isset($_POST['durationtotprop'])) ? $_POST['durationtotprop'] :'';
$duration2total = (isset($_POST['duration2total'])) ? $_POST['duration2total'] :'';
$duration2totprop = (isset($_POST['duration2totprop'])) ? $_POST['duration2totprop'] :'';
$durationprojassigntot = (isset($_POST['durationprojassigntot'])) ? $_POST['durationprojassigntot'] :'';
$durationprojassigntotprop = (isset($_POST['durationprojassigntotprop'])) ? $_POST['durationprojassigntotprop'] :'';
// $term_resign = $_POST['term_resign'];
$remarks = (isset($_POST['remarks'])) ? $_POST['remarks'] :'';
$remarks2 = (isset($_POST['remarks2'])) ? $_POST['remarks2'] :'';
$net_of_tax = (isset($_POST['net_of_tax'])) ? $_POST['net_of_tax'] :'';
$idhrpositionctg = (isset($_POST['idhrpositionctg'])) ? $_POST['idhrpositionctg'] :'';

//20190507
$allow_fixed = (isset($_POST['allow_fixed'])) ? $_POST['allow_fixed'] :'';
$allow_fixed_currency = (isset($_POST['allow_fixed_currency'])) ? $_POST['allow_fixed_currency'] :'';
$allow_fixed_paytype = (isset($_POST['allow_fixed_paytype'])) ? $_POST['allow_fixed_paytype'] :'';

$target_path0 = "./uploads/projassign";
$filename = basename( $_FILES['uploadedfile']['name'] );
$filename1 = str_replace(' ', '_', $filename);
if($filename1 != "") { $filenamefin = $employeeid."_".$filename1; }

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit Project Assignment >> Update project assignment</font></p>";

	echo "<p><font color=green><b>Project assignment updated!</b></font></p>";

  $resquery = "SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'";
	$result="";
	$result=$dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
	$found = 1;
	$name_last = $myrow['name_last'];
	$name_first = $myrow['name_first'];
	$name_middle = $myrow['name_middle'];
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)
  echo "For: $employeeid - $name_last, $name_first $name_middle[0]</p>";

  if($filename1 != "") {

    $res2query = "UPDATE tblprojassign SET ref_no = '$ref_no', position = '$position', salary = '$salary', salarycurrency = '$salarycurrency', salarytype = '$salarytype', allow_inc = '$allow_inc', allow_inc_currency = '$allow_inc_currency', allow_inc_paytype = '$allow_inc_paytype', allow_proj = '$allow_proj', allow_proj_currency = '$allow_proj_currency', allow_proj_paytype = '$allow_proj_paytype', allow_field = '$allow_field', allow_field_currency = '$allow_field_currency', allow_field_paytype = '$allow_field_paytype', allow_accomm = '$allow_accomm', allow_accomm_currency = '$allow_accomm_currency', allow_accomm_paytype = '$allow_accomm_paytype', allow_transpo = '$allow_transpo', allow_transpo_currency = '$allow_transpo_currency', allow_transpo_paytype = '$allow_transpo_paytype', allow_comm = '$allow_comm', allow_comm_currency = '$allow_comm_currency', allow_comm_paytype = '$allow_comm_paytype', perdiem = '$perdiem', perdiem_currency = '$perdiem_currency', ecola1 = '$ecola1', ecola1_currency = '$ecola1_currency', ecola2 = '$ecola2', ecola2_currency = '$ecola2_currency', durationtotal = '$durationtotal', durationtotprop = '$durationtotprop', duration2total = '$duration2total', duration2totprop = '$duration2totprop', durationprojassigntot = '$durationprojassigntot', durationprojassigntotprop = '$durationprojassigntotprop', remarks = '$remarks', remarks2 = '$remarks2', net_of_tax = '$net_of_tax', filepath=\"$target_path0\", filename=\"$filenamefin\", idhrpositionctg=$idhrpositionctg, allow_fixed='$allow_fixed', allow_fixed_currency='$allow_fixed_currency', allow_fixed_paytype='$allow_fixed_paytype', durationfrom = '$durationfrom', durationto='$durationto', durationfrom2 = '$durationfrom2', durationto2='$durationto2', term_resign = '$termresign' WHERE employeeid='$employeeid' AND projassignid = $projassignid";
	$result=$dbh2->query($res2query);

  // start file upload if exists  
  $target_path = $target_path0 . "/" . $filename1;
  if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    $imagefile = $target_path0 . "/" . $filename1;    
    $newimagefile = $target_path0 . "/" . $filenamefin;    
    rename($imagefile, $newimagefile);    
    echo "$target_path0\n"; 
  } else {
    echo "There was an error uploading the file, please try again!<br>";
  } // if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))

  } else {

    $res2query = "UPDATE tblprojassign SET ref_no = '$ref_no', position = '$position', salary = '$salary', salarycurrency = '$salarycurrency', salarytype = '$salarytype', allow_inc = '$allow_inc', allow_inc_currency = '$allow_inc_currency', allow_inc_paytype = '$allow_inc_paytype', allow_proj = '$allow_proj', allow_proj_currency = '$allow_proj_currency', allow_proj_paytype = '$allow_proj_paytype', allow_field = '$allow_field', allow_field_currency = '$allow_field_currency', allow_field_paytype = '$allow_field_paytype', allow_accomm = '$allow_accomm', allow_accomm_currency = '$allow_accomm_currency', allow_accomm_paytype = '$allow_accomm_paytype', allow_transpo = '$allow_transpo', allow_transpo_currency = '$allow_transpo_currency', allow_transpo_paytype = '$allow_transpo_paytype', allow_comm = '$allow_comm', allow_comm_currency = '$allow_comm_currency', allow_comm_paytype = '$allow_comm_paytype', perdiem = '$perdiem', perdiem_currency = '$perdiem_currency', ecola1 = '$ecola1', ecola1_currency = '$ecola1_currency', ecola2 = '$ecola2', ecola2_currency = '$ecola2_currency', durationtotal = '$durationtotal', durationtotprop = '$durationtotprop', duration2total = '$duration2total', duration2totprop = '$duration2totprop', durationprojassigntot = '$durationprojassigntot', durationprojassigntotprop = '$durationprojassigntotprop', remarks = '$remarks', remarks2 = '$remarks2', net_of_tax = '$net_of_tax', idhrpositionctg=$idhrpositionctg, allow_fixed='$allow_fixed', allow_fixed_currency='$allow_fixed_currency', allow_fixed_paytype='$allow_fixed_paytype', durationfrom = '$durationfrom', durationto='$durationto', durationfrom2 = '$durationfrom2', durationto2='$durationto2', term_resign = '$termresign' WHERE employeeid='$employeeid' AND projassignid = $projassignid";
	$result=$dbh2->query($res2query);

  } // if($filename1 != "")

//   echo "Details:<br>";
//   echo "ref_no = $ref_no<br>";
//   echo "position = $idhrpositionctg|$position<br>";
//   echo "salary = $salary $salarycurrency $salarytype $net_of_tax<br>";

// // 20190507
// 	echo "fixed = $allow_fixed $allow_fixed_currency $allow_fixed_paytype<br>";

//   echo "allow_inc = $allow_inc $allow_inc_currency $allow_inc_paytype<br>";
//   echo "allow_proj = $allow_proj $allow_proj_currency $allow_proj_paytype<br>";
//   echo "allow_field = $allow_field $allow_field_currency $allow_field_paytype<br>";
//   echo "allow_accomm = $allow_accomm $allow_accomm_currency $allow_accomm_paytype<br>";
//   echo "allow_transpo = $allow_transpo $allow_transpo_currency $allow_transpo_paytype<br>";
//   echo "allow_comm = $allow_comm $allow_comm_currency $allow_comm_paytype<br>";
//   echo "perdiem = $perdiem $perdiem_currency<br>";
//   echo "ecola1 = $ecola1 $ecola1_currency<br>";
//   echo "ecola2 = $ecola2 $ecola2_currency<br>";
//   echo "durationtotal = $durationtotal $durationtotprop<br>";
//   echo "duration2total = $duration2total $duration2totprop<br>";
// echo"durationfrom = $durationfrom<br>";
// echo"durationto = $durationto<br>";
// echo"durationfrom2 = $durationfrom2<br>";
// echo"durationto2 = $durationto2<br>";

//   echo "durationprojassigntot = $durationprojassigntot $durationprojassigntotprop<br>";
//   echo "term_resign = $termresign<br>";
//   echo "remarks = $remarks<br>";
//   echo "remarks2 = $remarks2<br>";
//   echo "file = $newimagefile<br>";
//   echo "Update Record - OK<br>";

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
    $adminlogdetails = "$loginid:$adminloginuid - Modified project assignment record for $employeeid - $name_last, $name_first, $name_middle[0]. Details: ref_no=$ref_no, proj_code=$proj_code, proj_name=$proj_sname, position=$idhrpositionctg";
    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17="";
		$result17=$dbh2->query($res17query);


  // echo "<p><a href=personnelprojassignedit.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid>Back to Edit Personnel Info</a></p>";

  $message = "Project Assignment Updated Added!";
  $_SESSION['success_message'] = $message;
?>

<script>
			const employeeid = encodeURIComponent("<?php echo $employeeid; ?>");
			const loginid = encodeURIComponent("<?php echo $loginid; ?>");
			const projassignid = encodeURIComponent("<?php echo $projassignid; ?>");

			window.location.href = `personnelprojassignedit.php?loginid=${loginid}&eid=${employeeid}&prjid=${projassignid}`;
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

