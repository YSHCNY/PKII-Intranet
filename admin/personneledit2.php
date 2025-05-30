<?php 
session_start();
include("db1.php");
include ("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$pid = (isset($_GET['pid'])) ? $_GET['pid'] :'';
$employeeid = $pid;

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
     include ("header.php");
     include ("sidebar.php");
?>

    <!-- select search cdn -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



<style>
	.highlight {
        background-color: #00fff3;
		border-radius: 3px;
	}
	td{
	padding: 1.5em 1em 1.5em 1em !important;	
	}

	th{
		color: gray !important;
	}

	input, textarea, select{
		border: 1px solid gray !important;
	}

	.navs{
		position: sticky !important;
		top: 7rem !important;
		z-index: 2 !important;
		
	}

</style>
<div class=" ms-4 mb-4">
		<a href="<?php echo 'personneledit.php?loginid=' . $loginid ?>" class="text-white mainbtnclr btn">
		Back
		</a>
	</div>
<?php

include 'pereditmodals.php';
     echo "<div id = 'fulfo' class ='shadow border mb-4 ms-4 px-4 py-2'><h4 class = 'mb-0 pb-0'>Personnel Information</h4><p>Manage Personnel details</p>";
	
	 echo "</div>";
	 ?>
	 <div  class = ' d-lg-block d-none navs ms-4 my-4 py-4 px-3 border border-dark bg-white  gap-5 shadow text-center'>
	 	
		<a class = 'p-3 maintitle' href = '#fulfo'>Employment Details</a>
			<a class = 'p-3 maintitle' href = '#proc'>Projects & Contract</a>
			<a class = 'p-3 maintitle' href = '#contd'>Contact Details</a>
			<a class = 'p-3 maintitle' href = '#findet'>Finance Details</a>
			<a class = 'p-3 maintitle' href = '#othdet'>More Details</a>
			<a class = 'p-3 maintitle' href = '#emerg'>Emergency Contact</a>
</div>
<?php
	 echo "<div class='d-flex justify-content-center'>";
	

	

     echo "<div class=\"\">";

    $res0query = "SELECT name_last, name_first, name_middle, picfn, picpath FROM tblcontact WHERE employeeid=\"$pid\"";
		$result0=$dbh2->query($res0query);
		if($result0->num_rows>0) {
			while($myrow0 = $result0->fetch_assoc()) {
			$name_last = $myrow0['name_last'];
			$name_first = $myrow0['name_first'];
			$name_middle = $myrow0['name_middle'];
			$picfn = $myrow0['picfn'];
			$picpath = $myrow0['picpath'];
			} // while($myrow0 = $result0->fetch_assoc())
		} // if($result0->num_rows>0)

     echo "<div class = 'border shadow p-5 h-50 mx-4'>";
  
     if($picfn != "") {

     echo "<div class = 'text-center '><img src=\"../vc/images/$picfn\"   width=\"300\" class = 'img-fluid'></div>";
    
	} else {
		echo "<div class = 'text-center '><img src=\"pictures/blnkimg.jpg\" width=\"300\" class = 'img-fluid'></div>";

	}
	
	// onclick=\"popupwindow('$loginid', '$pid')\"
	 echo "<div class = 'text-center'><h4>$name_last, $name_first $name_middle</h4></div>";
     echo "<div class = 'text-center'><button type=\"button\" class='btn w-100 btn-info mx-1 my-2' data-toggle='modal' data-target='#perimg' >Upload Image</button></div>";
     echo "<form action=\"personneldel.php?loginid=$loginid&eid=$employeeid\" class = 'text-center' method=\"post\" name=\"personneldel\">"; 
	echo "<button type=\"submit\" class='btn w-100 btn-danger mx-1 my-2'>Delete record</button></form>"; 
	echo " </div></div>"; 



	 
	if($pid == '') {
	echo "<p><font color=\"red\"><b>Sorry. No data available</b></font></p>";
	} else {

// start employment details form
	$res2query = "SELECT tblemployee.emp_ref_num, tblemployee.date, tblemployee.date_hired, tblemployee.date_expired, tblemployee.emp_birthdate, tblemployee.emp_birthplace, tblemployee.emp_civilstatus, tblemployee.emp_num, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_pagibig2, tblemployee.emp_gsis, tblemployee.emp_skills, tblemployee.emp_status, tblemployee.emp_remarks, tblemployee.employee_type, tblemployee.term_resign, tblemployee.emp_record, tblemployee.emptaxstatus, tblemployee.regularizationdt FROM tblemployee WHERE tblemployee.employeeid='$employeeid'";
	$result2=""; $found2=0; $ctr2=0;
	$result2=$dbh2->query($res2query);
	if($result2->num_rows>0) {
		while($myrow2=$result2->fetch_assoc()) {
		$found2 = 1;
	  $emp_ref_num = $myrow2['emp_ref_num'];
	  $date = $myrow2['date'];
	  $date_hired = $myrow2['date_hired'];
	  $date_expired = $myrow2['date_expired'];
	  $emp_birthdate = $myrow2['emp_birthdate'];
	  $emp_birthplace = $myrow2['emp_birthplace'];
	  $emp_civilstatus = $myrow2['emp_civilstatus'];
	  $emp_num = $myrow2['emp_num'];
	  $emp_tin = $myrow2['emp_tin'];
	  $emp_sss = $myrow2['emp_sss'];
	  $emp_philhealth = $myrow2['emp_philhealth'];
	  $emp_pagibig = $myrow2['emp_pagibig'];
		$emp_pagibig2 = $myrow2['emp_pagibig2'];
	  $emp_gsis = $myrow2['emp_gsis'];
	  $emp_skills = $myrow2['emp_skills'];
	  $emp_status = $myrow2['emp_status'];
	  $emp_remarks = $myrow2['emp_remarks'];
	  $employee_type = $myrow2['employee_type'];
	  $term_resign = $myrow2['term_resign'];
	  $emp_record = $myrow2['emp_record'];
		$emptaxstatus = $myrow2['emptaxstatus'];
            $regularizationdt = $myrow2['regularizationdt'];
		} // while($myrow2=$result2->fetch_assoc())
	} // if($result2->num_rows>0)

// start insert tblempdetails
	$res8query = "SELECT empdetailsid, empdepartment, empposition, emppositionlevel, empsalarygrade, idhrpositionctg FROM tblempdetails WHERE employeeid = '$employeeid'";
	$result8=""; $found8=0; $ctr8=0;
	$result8=$dbh2->query($res8query);
	if($result8->num_rows>0) {
		while($myrow8=$result8->fetch_assoc()) {
	  $empdetailsid = $myrow8['empdetailsid'];
	  $empdepartment = $myrow8['empdepartment'];
	  $empposition = $myrow8['empposition'];
	  $emppositionlevel = $myrow8['emppositionlevel'];
	  $empsalarygrade = $myrow8['empsalarygrade'];
		$idhrpositionctg = $myrow8['idhrpositionctg'];
		} // while($myrow8=$result8->fetch_assoc())
	} // if($result8->num_rows>0)
// end insert tblempdetails

     echo "<table width=\"100%\"  class = 'table   table-hover border shadow'>";
	echo "";

// 	echo "<form action=personnelchgempid.php?pid=$pid&loginid=$loginid method=post name=\"personnelchgempid\">";
// 	echo "<tr><td align=\"right\"><h5><b>Employee ID number </b></h5> </td><td align=\"\"><div class = 'd-inline-flex'><b><h4>$employeeid</h4></b>&ensp; &ensp; &ensp;&ensp;&ensp;&ensp;";
// 	echo "<input type=\"submit\" class = 'btn bg-transparent text-primary border-none' value=\"Change\"></div></td>";
//   echo "</div>"; // <div class='form-group'>
//   echo "</form>";




	echo "<form action=\"personnelupdemployment.php?pid=$pid&loginid=$loginid\" method=\"post\" name=\"personnelupdemployment\">";
  echo "<div class='form-group'>";
	echo "<tr><td align=\"right\"><h5><b>Employee ID number </b></h5> </td><td align=\"\"><input class = 'form-control' value = '$employeeid' name = 'empidedt' ></td></tr>";

	echo "<tr><td align=\"right\"><h5><b>Reference Number</b></h5></td>
	<td align=\"center\"><input class = 'form-control' placeholder = 'reference numbere here..' name=emp_ref_num value=$emp_ref_num></td></tr>";

	echo "<tr><td align=\"right\"><h5><b>Position</b></h5></td><td>";
	if($idhrpositionctg==0) {
	echo "$empposition";
	} // if($idhrpositionctg==0)
	echo "<select class = 'form-select h5 '  name=\"idhrpositionctg\">";
	echo "<option value='0'>select job position</option>";
	$res18query="SELECT idhrpositionctg, code, name, deptcd FROM tblhrpositionctg ORDER BY name ASC";
	$result18=""; $found18=0; $ctr18=0;
	$result18=$dbh2->query($res18query);
	if($result18->num_rows>0) {
		while($myrow18=$result18->fetch_assoc()) {
		$found18=1;
		$idhrpositionctg18 = $myrow18['idhrpositionctg'];
		$code18 = $myrow18['code'];
		$name18 = $myrow18['name'];
		$deptcd18 = $myrow18['deptcd'];
		if($idhrpositionctg18==$idhrpositionctg) { $idhrposctgsel="selected"; } else { $idhrposctgsel=""; }
		echo "<option value=\"$idhrpositionctg18\" $idhrposctgsel>$name18</option>";
		} // while($myrow18=$result18->fetch_assoc())
	} // if($result18->num_rows>0)
	echo "</select>";
	
	echo "</td></tr>";

	
	echo "<tr><td align=\"right\"><h5><b>Department</h5></b></td><td>";
		echo "<select class = 'form-select h5 '  name=\"empdepartment\">";
		echo "<option value=''>select deptcd</option>";
		$res15query = "SELECT code, name FROM tbldeptcd";
		$result15=""; $found15=0;
		$result15 = $dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15=$result15->fetch_assoc()) {
			$found15 = 1;
			$deptcode15 = $myrow15['code'];
			$deptname15 = $myrow15['name'];
			if($deptcode15 == $empdepartment) { $deptcdsel="selected"; } else { $deptcdsel=""; }
			echo "<option value=\"$deptcode15\" $deptcdsel>$deptcode15 - $deptname15</option>";
			} // while($myrow15=$result15->fetch_assoc())
		} // if($result15->num_rows>0)
		echo "</select>";
	echo "</td></tr>";


	// position level
	echo "<tr><td align=\"right\"><h5><b>Position Level</h5></b></td>";
	echo "<td><input type=\"number\" min=\"0\" max=\"5\" name=\"emppositionlevel\" value=\"$emppositionlevel\" class='form-control'></td></tr>";

	// Salary Grade
	echo "<tr><td align=\"right\"><h5><b>Salary Grade</h5></b></td>";
	echo "<td><input type=\"number\" min=\"0\" max=\"12\" name=\"empsalarygrade\" value=\"$empsalarygrade\" class='form-control'></td></tr>";

	// birth date
	echo "<tr><td align=\"right\"><h5><b>Date of Birth</h5></b></td>";
	echo "<td><input value = '$emp_birthdate' type='date' name='newdate' class ='form-control'></td></tr>";


	echo "<tr><td align=\"right\"><h5><b>Place of Birth</h5></b></td>";
	echo "<td><input class ='form-control' name=emp_birthplace value=\"$emp_birthplace\"></td></tr>";

	echo "<tr><td align=\"right\"><h5><b>Civil Status</h5></b></td>";
	if ($emp_civilstatus == 'Single') {
	  $singleselected = 'selected';
	} else if ($emp_civilstatus == 'Married') {
	  $marriedselected = 'selected';
	} else if ($emp_civilstatus == 'Separated') {
	  $separatedselected = 'selected';
	} else if ($emp_civilstatus == 'Divorced') {
	  $divorcedselected = 'selected';
	} else if ($emp_civilstatus == 'Annulled') {
	  $annulledselected = 'selected';
	} else if ($emp_civilstatus == 'Widow') {
	  $swidowselected = 'selected';
	} else if ($emp_civilstatus == 'Widower') {
	  $widowerselected = 'selected';
	} else {
	  $select == 'selected';
	}
	echo "<td><select class = 'form-select h5' name=\"emp_civilstatus\">";
	echo "<option value=\"Select\" $select>Select</option>";
	echo "<option value=\"Single\" $singleselected>Single</option>";
	echo "<option value=\"Married\" $marriedselected>Married</option>";
	echo "<option value=\"Separated\" $separatedselected>Separated</option>";
	echo "<option value=\"Divorced\" $divorcedselected>Divorced</option>";
	echo "<option value=\"Annulled\" $annulledselected>Annulled</option>";
	echo "<option value=\"Widow\" $widowselected>Widow</option>";
	echo "<option value=\"Widower\" $widowerselected>Widower</option>";
	echo "</select></td></tr>";

	echo "<tr><td align=\"right\"><h5><b>Tax Identification No.</h5></b></td><td><input class = 'form-control' name=emp_tin value=$emp_tin></td></tr>";
	echo "<tr><td align=\"right\"><h5><b>Tax exempt status</h5></b></td><td>";
	echo "<select class = 'form-select ' name=\"emptaxstatus\">";
	if($emptaxstatus == "") { echo "<option>select</option>"; }
	$res16query = "SELECT id, taxcode FROM tblwtaxexempt";
	$result16=""; $found16=0; $ctr16=0;
	$result16=$dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
		$found16 = 1;
		$id16 = $myrow16['id'];
		$taxcode16 = $myrow16['taxcode'];
		if($taxcode16 == $emptaxstatus) { $emptaxstatsel="selected"; } else { $emptaxstatsel=""; }
		echo "<option value=\"$taxcode16\" $emptaxstatsel>$taxcode16</option>";
		} // while($myrow16=$result16->fetch_assoc())
	} // if($result16->num_rows>0)
	echo "</select>";
	echo "</td>";
	echo "<tr><td align=\"right\"><h5><b>SSS Number</h5></b></td><td><input name=\"emp_sss\" placeholder = 'SSS number here...' class = 'form-control' value=\"$emp_sss\"></td></tr>";
	echo "<tr><td align=\"right\"><h5><b>Philhealth</h5></b></td><td><input name=\"emp_philhealth\" placeholder = 'Philhealth number here...' class = 'form-control' value=\"$emp_philhealth\"></td></tr>";
	echo "<tr><td align=\"right\"><h5><b>Pag-IBIG</h5></b></td><td><input name=\"emp_pagibig\" placeholder = 'Pag-IBIG number here...' class = 'form-control' value=\"$emp_pagibig\"></td></tr>";
	echo "<tr><td align=\"right\"><h5><b>Pag-IBIG2</h5></b></td><td><input name=\"emp_pagibig2\"  placeholder = 'Pag-IBIG 2 number here...' class = 'form-control' value=\"$emp_pagibig2\"></td></tr>";
	echo "<tr><td align=\"right\"><h5><b>GSIS</h5></b></td><td><input name=\"emp_gsis\" placeholder = 'GSIS number here...' class = 'form-control' value=\"$emp_gsis\"></td></tr>";
	echo "<tr><td align=\"right\"><h5><b>Skills</h5></b></td><td><textarea name=\"emp_skills\" placeholder = 'Skills here...' class = 'form-control'  cols=\"50\">$emp_skills</textarea></td></tr>";
	
	if($employee_type == 'employee') {
	  echo "<tr><td align=\"right\"><h5><b>Employment Status</h5></b></td>";
	  if($emp_status == 'R') {
	    $r_selected = 'selected';
	  } else if($emp_status == 'P') {
	    $p_selected = 'selected';
	  } else if($emp_status == 'T') {
	    $t_selected = 'selected';
	  } else if($emp_status == 'I') {
        $i_selected = 'selected';
	  } else {
	    $select = 'selected';
    } //if-else
	  echo "<td><select class = 'form-select' name=\"emp_status\">";
	  echo "<option value=\"select\" $select>Select</option>";
	  echo "<option value=\"R\" $r_selected>Regular</option>";
	  echo "<option value=\"P\" $p_selected>Probationary</option>";
	  echo "<option value=\"T\" $t_selected>Temporary</option>";
	  echo "<option value=\"I\" $i_selected>Intern</option>";
	  echo "</select></td></tr>";
	}

	echo "<tr><td align=\"right\"><h5><b>Remarks</h5></b></td><td><textarea placeholder = 'Remarks here...' class = 'form-control' name=\"emp_remarks\">$emp_remarks</textarea></td></tr>";
	echo "<tr><td align=\"right\"><h5><b>Employee Type</h5></b></td>";
	if($employee_type == 'employee') {
	  $employeeselected = 'selected';
	} else if($employee_type == 'consultant') {
	  $consultantselected = 'selected';
	} else if($employee_type == 'others') {
	  $othersselected = 'selected';
	} else {
	  $select = 'selected';
	}
	echo "<td><select class = 'form-select' name=\"employee_type\">";
	echo "<option value=\"select\" $select>Select</option>";
	echo "<option value=\"employee\" $employeeselected>Employee</option>";
	echo "<option value=\"consultant\" $consultantselected>Consultant</option>";
	echo "<option value=\"others\" $othersselected>Others</option>";
	echo "</select></td></tr>";

	echo "<tr><td align=\"right\"><h5><b>Date Hired</h5></b></td><td><input type= 'date' class = 'form-control' name = 'datehired' value = '$date_hired'></td></tr>";
	if($term_resign == "0000-00-00") {
	echo "<tr><td align=\"right\"><h5><b>Date Resigned</h5></b></td><td> <input name = 'resigndate' value = '$term_resign' class = 'form-control' type='date'></input></td></tr>";
	} else {
	echo "<tr><td align=\"right\"><h5><b>Date Resigned</h5></b></td><td> <input name = 'resigndate' value = '$term_resign' class = 'form-control' type='date'></input></td></tr>";
	}

    // 20240610 Regularization date
      
		echo"<tr><td align=\"right\"><h5><b>Regularization Date</h5></b></td><td> <input name = 'regularizationdt' value = '$regularizationdt' class = 'form-control' type='date'></input></td></tr>";
       

// check if personnel has reemployment data
	$res12query = "SELECT daterehired, dateresigned, remarks FROM tblemprehire WHERE employeeid=\"$employeeid\" ORDER BY daterehired DESC";
	$result12=""; $found12=0; $ctr12=0;
	$result12=$dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
	  $found12 = 1;
	  $daterehired12 = $myrow12['daterehired'];
	  $dateresigned12 = $myrow12['dateresigned'];
	  $remarks12 = $myrow12['remarks'];
		} // while($myrow12=$result12->fetch_assoc())
	} // if($result12->num_rows>0)
	if( $found12 == 1){
	  echo "<tr><td>Re-hired or Re-employed</td>";
	
	  echo "<td class='font-italic'>From</td><td class='font-italic'>To</td><td class='font-italic'>Remarks</td><td colspan=\"2\" class='font-italic'>Action</td></tr>";
	  $res14query = "SELECT emprehireid, daterehired, dateresigned, remarks FROM tblemprehire WHERE employeeid=\"$employeeid\" ORDER BY daterehired DESC";
		$result14=""; $found14=0; $ctr14=0;
		$result14=$dbh2->query($res14query);
		if($result14->num_rows>0) {
			while($myrow14=$result14->fetch_assoc()) {
	    $found14 = 1;
	    $emprehireid14 = $myrow14['emprehireid'];
	    $daterehired14 = $myrow14['daterehired'];
	    $dateresigned14 = $myrow14['dateresigned'];
	    $remarks14 = $myrow14['remarks'];
	    echo "<tr><td>".date("Y-M-d", strtotime($daterehired14))."</td>";
			$dtresignyyyy=substr($dateresigned14,0,4);
			if($dtresignyyyy=="0000") {
			echo "<td>$dateresigned14</td><td>$remarks14</td><td><a href=\"personnelrehiredel.php?loginid=$loginid&eid=$employeeid&rhid=$emprehireid14\" class='btn btn-danger btn-sm' role='button'>Del</a></td><td><a href=\"personnelrehireedit.php?loginid=$loginid&eid=$employeeid&rhid=$emprehireid14\" class='btn btn-warning btn-sm' role='button'>Edit</a></td></tr>";
			} else {
			echo "<td>".date("Y-M-d", strtotime($dateresigned14))."</td><td>$remarks14</td><td><a href=\"personnelrehiredel.php?loginid=$loginid&eid=$employeeid&rhid=$emprehireid14\" class='btn btn-danger btn-sm' role='button'>Del</a></td><td><a href=\"personnelrehireedit.php?loginid=$loginid&eid=$employeeid&rhid=$emprehireid14\" class='btn btn-warning btn-sm' role='button'>Edit</a></td></tr>";
			} // if($dtresignyyyy=="0000")
			} // while($myrow14=$result14->fetch_assoc())
		} // if($result14->num_rows>0)
        echo "<tr><td colspan='5'><a href=\"personnelrehireadd.php?loginid=$loginid&eid=$employeeid\"><font size=\"1\" class='btn btn-info btn-sm' role='button'>Add re-hire/re-employment details</font></a></td></tr>";

	  echo "</td></tr>";
	}
// link to add re-employment data
//	echo "<tr><td>&nbsp;</td><td></td></tr>";

// emp_record status/type
	echo "<tr><td align=\"right\"><h5><b>Record Status</h5></b></th>";
	if($emp_record == 'inactive') { $inactiveselected='selected'; }
	else if($emp_record == 'active') { $activeselected='selected'; }
	echo "<td><select class = 'form-select' name=\"emp_record\">";
	echo "<option value=\"active\" $activeselected>Active</option>";
	echo "<option value=\"inactive\" $inactiveselected>Inactive</option>";
	echo "</select></td></tr>";

	echo "<tr><td colspan = '2' align = 'center'><button type=\"submit\" class='btn bg-success text-white'>Update Employment Details</button></td></tr>";
	echo "</table>";
	
  echo "</div>"; // <div class='form-group'>
echo "<div id = 'proc'></div>";

  echo "</form>";






//   [][[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]



// start project assignments

	$empprojctr = 0;
	
	echo "<div  class = 'mt-5 text-center'><h1 class = 'text-uppercase my-4' style  ='color: #cccccc !important'>Projects & Contracts</h1></div>";

	echo "<div class = 'shadow border mb-4 p-4'>";
	echo "<h4 class = 'mx-3 fw-bold'>Projects & Contracts</h4>";
	echo "<div class = 'text-end mb-5   px-4 '><button type = 'button'  class='btn  bg-primary text-white' role='button' data-toggle='modal' data-target='#projassadd'>Add project +</button></div>";
// href=\"personnelprojassignadd.php?loginid=$loginid&eid=$employeeid\"
     echo "<table id='persproj' width = '100%' class = 'table table-bordered table-striped table-hover border'>";
	 echo "<thead>";
	echo "<tr class = 'text-secondary'>";
	
	echo "<th>Reference Number</th>";
	echo "<th>Project Code</th>";
	echo "<th>Position</th>";
	echo "<th>From</th>";
	echo "<th>To</th>";
	echo "<th>File</th>";
	echo "<th>Action</th>";
	echo "</tr>";
	echo "</thead>";
	$res3query = "SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.filepath, tblprojassign.filename, tblprojassign.idhrpositionctg, tblproject1.proj_fname, tblproject1.proj_sname FROM tblprojassign LEFT JOIN tblproject1 ON tblprojassign.proj_code=tblproject1.proj_code WHERE tblprojassign.employeeid = '$pid' ORDER BY tblprojassign.durationfrom DESC";
	$result3=""; $found3=0; $ctr3=0;
	$result3=$dbh2->query($res3query);
	if($result3->num_rows>0) {
		while($myrow3=$result3->fetch_assoc()) {
	  $found3 = 1;
	  $projassignid = $myrow3['projassignid'];
	  $ref_no = $myrow3['ref_no'];
	  $proj_code = $myrow3['proj_code'];
	  $proj_name = $myrow3['proj_name'];
	  $position = $myrow3['position'];
	  $durationfrom = $myrow3['durationfrom'];
	  $durationto = $myrow3['durationto'];
	  $filepath3 = $myrow3['filepath'];
	  $filename3 = $myrow3['filename'];
		$idhrpositionctg3 = $myrow3['idhrpositionctg'];
		$proj_fname3 = $myrow3['proj_fname'];
		$proj_sname3 = $myrow3['proj_sname'];

	  $empprojctr = $empprojctr + 1;

	  echo "<tr><td class=''>$ref_no</td>";
		// modified 20180405
		echo "<td colspan=\"\">";
		if($proj_code=='Select Pro') {
		echo "";
		} else {
		echo "$proj_code - ";
		} // if
		if($proj_sname3 != '') {
			echo "$proj_sname3";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "$projfnamefin";
		} else if($proj_name != '') {
			echo "$proj_name";
		}
		echo "<br>";
	// check if tblprojcdassign has related records
	$res5aquery = "SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$pid\"";
	$result5a=""; $found5a=0; $ctr5a=0;
	$result5a=$dbh2->query($res5aquery);
	if($result5a->num_rows>0) {
		while($myrow5a=$result5a->fetch_assoc()) {
		$found5a=1;
		$projectid5a = $myrow5a['projectid'];
		$projcode5a = $myrow5a['projcode'];
		$projname5a = $myrow5a['projname'];
		echo "$projcode5a - $projname5a<br>";
		} // while($myrow5a=$result5a->fetch_assoc())
	} // if($result5a=num_rows>0)
	echo "</td>";

	// 20171018 query tblhrpositionctg
	$res19query="SELECT idhrpositionctg, code, name, deptcd FROM tblhrpositionctg WHERE idhrpositionctg=$idhrpositionctg3";
	$result19=""; $found19=0;
	$result19=$dbh2->query($res19query);
	if($result19->num_rows>0) {
		while($myrow19=$result19->fetch_assoc()) {
		$found19 = 1;
		$idhrpositionctg19 = $myrow19['idhrpositionctg'];
		$code19 = $myrow19['code'];
		$name19 = $myrow19['name'];
		$deptcd19 = $myrow19['deptcd'];
		if($idhrpositionctg19==$idhrpositionctg3) { $idhrposctgsel="selected"; } else { $idhrposctgsel=""; }
		} // while($myrow19=$result19->fetch_assoc())
	} // if($result19->num_rows>0)
	if($found19==1 && $idhrpositionctg19!=0) {
		echo "<td class=''>$name19</td>";
	} else {
		echo "<td class=''>$position</td>";
	} // if($found19==1)
		$durfromyr=substr($durationfrom,0,4);
		$durtoyr=substr($durationto,0,4);
		if($durfromyr=="0000") {
			echo "<td class=''></td>";
		} else {
			echo "<td class=''>".date("Y-M-d", strtotime($durationfrom))."</td>";
		} // if($durfromyr=="0000")
		if($durtoyr=="0000") {
			echo "<td class=''></td>";
		} else {
			echo "<td class=''>".date("Y-M-d", strtotime($durationto))."</td>";
		} // if($durtoyr=="0000")

		if($filename3 != "") {
	    echo "<td class=''><a href=\"./$filepath3/$filename3\" target=\"_blank\"><font size='1'>$filename3</font></a></td>";
	  } else { echo "<td></td>"; }

	  echo "<td class=''><a href=\"personnelprojassignedit.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid\" class='btn text-white bg-warning mx-1' role='button'>Edit</a>";
	  echo "<a href=\"personnelprojassigndel.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid\" class='btn text-white bg-danger mx-1' role='button'>Delete</a></td></tr>";
	  // echo "<tr><td colspan='10'>$res3query</td></tr>";
		} // while($myrow3=$result3->fetch_assoc())
	} // if($result3->num_rows>0)


	echo "<tbody>";

	echo "</tbody>";
	echo "</table>";

	echo "</div>";
// end project assignments

// start tmp.project assignments

	$empprojctr = 0;
	echo "<div class = 'shadow border mb-5 p-4'>";

	echo "<div class = 'mb-4'><h4 class = 'fw-bold mx-3'>Temporary Project Assignment(s)</h4></div>";

     echo "<table width = '100%' id= 'tmpprojass' class = 'table table-bordered table-striped table-hover border'>";
	 echo "<thead>";
	echo "<tr class = 'text-secondary'>";
	echo "<th>Reference Number</th>";
	echo "<th>Project Code</th>";
	echo "<th>Position</th>";
	echo "<th>From</th>";
	echo "<th>To</th>";
	echo "<th>File</th>";
	echo "<th>Action</th>";
	echo "</tr>";
	echo "</thead>";

	echo "<tbody>";

	$res9query = "SELECT projectassign0id, ref_no, proj_code, proj_name, position, durationfrom, durationto FROM tblprojassign0 WHERE employeeid1 = '$pid' ORDER BY durationto DESC";
	$result9=""; $found9=0; $ctr9=0;
	$result9=$dbh2->query($res9query);
	if($result9->num_rows>0) {
		while($myrow9=$result9->fetch_assoc()) {
	  $found9 = 1;
	  $projectassign0id = $myrow9['projectassign0id'];
	  $ref_no = $myrow9['ref_no'];
	  $proj_code = $myrow9['proj_code'];
	  $proj_name = $myrow9['proj_name'];
	  $position = $myrow9['position'];
	  $durationfrom = $myrow9['durationfrom'];
	  $durationto = $myrow9['durationto'];
	  $empprojctr = $empprojctr + 1;
	  echo "<tr>";
	   echo "<td>$ref_no</td>";
	   echo "<td>$proj_name</td>";
	   echo "<td>$position</td>";
	   echo "<td>$durationfrom</td>";
	   echo "<td>$durationto</td>";
	  echo "<td><a href=\"personneltmpprojassignupd.php?loginid=$loginid&eid=$employeeid&prjid=$projectassign0id\" class='btn bg-success text-white' role='button'>Propagate</a>";
	  echo "<a href=\"personneltmpprojassignedit.php?loginid=$loginid&eid=$employeeid&prjid=$projectassign0id\" class='btn bg-warning text-white' role='button'>Edit</a></td></tr>";
		} // while($myrow9=$result9->fetch_assoc())
	} // if($result9->num_rows>0)

	echo "</tbody>";
	echo "</table>";
echo "<div id = 'contd'></div>";

	echo "</div>";

// end tmp.project assignments

// start contact details form

	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.picture, tblcontact.position, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.num_mobile3_cc, tblcontact.num_mobile3_ac, tblcontact.num_mobile3, tblcontact.email1, tblcontact.email2, tblcontact.email3, tblcontact.url, tblcontact.remarks_contact FROM tblcontact WHERE tblcontact.employeeid='$pid'";
	$result=""; $found=0; $ctr=0;
	$result=$dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
	  $pid = $myrow['employeeid'];
	  $employeeid = $pid;
	  $name_last = $myrow['name_last'];
	  $name_first = $myrow['name_first'];
	  $name_middle = $myrow['name_middle'];
	  $contact_gender = $myrow['contact_gender'];
	  $picture = $myrow['picture'];
	  $position = $myrow['position'];
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
	  $num_mobile3_cc = $myrow['num_mobile3_cc'];
	  $num_mobile3_ac = $myrow['num_mobile3_ac'];
	  $num_mobile3 = $myrow['num_mobile3'];
	  $email1 = $myrow['email1'];
	  $email2 = $myrow['email2'];
	  $email3 = $myrow['email3'];
	  $url = $myrow['url'];
	  $remarks_contact = $myrow['remarks_contact'];
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)

	echo "<div class = 'mt-5 text-center'><h1 class = 'text-uppercase my-4' style  ='color: #cccccc !important'>CONTACT DETAILS</h1></div>";


	echo "<form action=\"personnelupdcontact.php?pid=$pid&loginid=$loginid\" class = 'shadow border p-4' method=\"post\" name=\"personnelupdcontact\">";
     echo "<table class=\" table table-hover table-striped table-bordered\" >";

	echo "<tr><td align=\"right\"><h5><b>Employee Number</b></h5></td><td><h4>$employeeid</h4></td></tr>";

	echo "<tr><td align=\"right\"><h5><b>Employee Name</b></h5></td>";
	
//         echo "<tr><td>Position</td><td>$myrow[6]";
?>

	<td>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Last name</label>
      <input type="text"  class="form-control" name = 'name_last' value = '<?php echo $name_last ?>' id="validationDefault01" placeholder="Last name" >
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">First name</label>
      <input type="text" class="form-control"  name = 'name_first' value = '<?php echo $name_first ?>' id="validationDefault02" placeholder="First name" >
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefaultUsername">Middle Name</label>
      <input type="text" class="form-control"  name = 'name_middle' value = '<?php echo $name_middle ?>' id="validationDefault02" placeholder="Middle name" >
    
    </div>
  </div>
  </td>
  </tr>

<?php

	echo "<tr><td align=\"right\">Sex</td>";
	if ($contact_gender == 'Male') {
	  $maleselected = 'selected';
	} else if ($contact_gender == 'Female') {
	  $femaleselected = 'selected';
	} else {
	  $select = 'selected';
	}
	echo "<td><select class = 'form-select' name=\"contact_gender\">";
	echo "<option value=\"select\" $select>Select</option>";
	echo "<option value=\"Male\" $maleselected>Male</option>";
	echo "<option value=\"Female\" $femaleselected>Female</option>";
	echo "</select></td></tr>";

	echo "<tr><td align=\"right\"><h5><b>Address Line 1</b></h5></td><td><textarea name=\"contact_address1\" placeholder = 'Address Line here...' class = 'form-control'>$contact_address1</textarea></td></tr>";
	echo "<tr><td align=\"right\"><h5><b>Address Line 2</b></h5></td><td><textarea name=\"contact_address2\" placeholder = 'Address Line here...' class = 'form-control'>$contact_address2</textarea></td></tr>";
	echo "<tr><td align=\"right\"><h5><b>City</b></h5></td><td><input name=\"contact_city\" placeholder = 'City name here...' class = 'form-control'value=\"$contact_city\"></td></tr>";
	echo "<tr><td align=\"right\"><h5><b>Province</b></h5></td><td><input placeholder = 'Province name here...' class = 'form-control' name=\"contact_province\" value=\"$contact_province\"></td></tr>";
	echo "<tr><td align=\"right\"><h5><b>Zip Code</b></h5></td><td><input placeholder = 'Zip code here...' class = 'form-control' name=\"contact_zipcode\" value=\"$contact_zipcode\"></td></tr>";
	echo "<tr><td align=\"right\"><h5><b>Country</b></h5></td><td><input placeholder = 'Country name here...' class = 'form-control' name=\"contact_country\" value=\"$contact_country\"></td></tr>";
	echo "<tr><td align=\"right\"><h5><b>Landline 1</b></h5></td>";

	?>

	<td>
  <div class="form-row">
    <div class="col-md-2 mb-3">
      <label for="validationDefault01">Country</label>
    <input type="text"  class="form-control" name = 'num_res1_cc' value = '<?php echo $num_res1_cc ?>' id="validationDefault01" placeholder="00" >
    </div>
    <div class="col-md-2 mb-3">
      <label for="validationDefault02">Area</label>
      <input type="text" class="form-control"  name = 'num_res1_ac' value = '<?php echo $num_res1_ac ?>' id="validationDefault02" placeholder="00" >
    </div>
    <div class="col-md-8 mb-3">
      <label for="validationDefaultUsername">PhoneNumber</label>
      <input type="text" class="form-control"  name = 'num_res1' value = '<?php echo $num_res1 ?>' id="validationDefault02" placeholder="00" >
    
    </div>
  </div>
  </td>
  </tr>

<?php

echo "<tr><td align=\"right\"><h5><b>Landline 2</b></h5></td>";

?>

<td>
<div class="form-row">
<div class="col-md-2 mb-3">
  <label for="validationDefault01">Country</label>
<input type="text"  class="form-control" name = 'num_res2_cc' value = '<?php echo $num_res2_cc ?>' id="validationDefault01" placeholder="00" >
</div>
<div class="col-md-2 mb-3">
  <label for="validationDefault02">Area</label>
  <input type="text" class="form-control"  name = 'num_res2_ac' value = '<?php echo $num_res2_ac ?>' id="validationDefault02" placeholder="00" >
</div>
<div class="col-md-8 mb-3">
  <label for="validationDefaultUsername">PhoneNumber</label>
  <input type="text" class="form-control"  name = 'num_res2' value = '<?php echo $num_res2 ?>' id="validationDefault02" placeholder="00" >

</div>
</div>
</td>
</tr>

<?php


echo "<tr><td align=\"right\"><h5><b>Mobile 1</b></h5></td>";

?>

<td>
<div class="form-row">
<div class="col-md-2 mb-3">
  <label for="validationDefault01">Country</label>
<input type="text"  class="form-control" name = 'num_mobile1_cc' value = '<?php echo $num_mobile1_cc ?>' id="validationDefault01" placeholder="00" >
</div>
<div class="col-md-2 mb-3">
  <label for="validationDefault02">Area</label>
  <input type="text" class="form-control"  name = 'num_mobile1_ac' value = '<?php echo $num_mobile1_ac ?>' id="validationDefault02" placeholder="00" >
</div>
<div class="col-md-8 mb-3">
  <label for="validationDefaultUsername">PhoneNumber</label>
  <input type="text" class="form-control"  name = 'num_mobile1' value = '<?php echo $num_mobile1 ?>' id="validationDefault02" placeholder="00" >

</div>
</div>
</td>
</tr>

<?php


echo "<tr><td align=\"right\"><h5><b>Mobile 2</b></h5></td>";

?>

<td>
<div class="form-row">
<div class="col-md-2 mb-3">
  <label for="validationDefault01">Country</label>
<input type="text"  class="form-control" name = 'num_mobile2_cc' value = '<?php echo $num_mobile2_cc ?>' id="validationDefault01" placeholder="00" >
</div>
<div class="col-md-2 mb-3">
  <label for="validationDefault02">Area</label>
  <input type="text" class="form-control"  name = 'num_mobile2_ac' value = '<?php echo $num_mobile2_ac ?>' id="validationDefault02" placeholder="00" >
</div>
<div class="col-md-8 mb-3">
  <label for="validationDefaultUsername">PhoneNumber</label>
  <input type="text" class="form-control"  name = 'num_mobile2' value = '<?php echo $num_mobile2 ?>' id="validationDefault02" placeholder="00" >

</div>
</div>
</td>
</tr>

<?php




echo "<tr><td align=\"right\"><h5><b>Mobile 3</b></h5></td>";

?>

<td>
<div class="form-row">
<div class="col-md-2 mb-3">
  <label for="validationDefault01">Country</label>
<input type="text"  class="form-control" name = 'num_mobile3_cc' value = '<?php echo $num_mobile3_cc ?>' id="validationDefault01" placeholder="00" >
</div>
<div class="col-md-2 mb-3">
  <label for="validationDefault02">Area</label>
  <input type="text" class="form-control"  name = 'num_mobile3_ac' value = '<?php echo $num_mobile3_ac ?>' id="validationDefault02" placeholder="00" >
</div>
<div class="col-md-8 mb-3">
  <label for="validationDefaultUsername">PhoneNumber</label>
  <input type="text" class="form-control"  name = 'num_mobile3' value = '<?php echo $num_mobile3 ?>' id="validationDefault02" placeholder="00" >

</div>
</div>
</td>
</tr>

<?php





	echo "<tr><td align=\"right\"><h5><b>Email 1</b></h5></td><td><input class = 'form-control' placeholder ='Email here..' name=\"email1\" value=\"$email1\"></td></tr>";
        echo "<tr><td align=\"right\"><h5><b>Email 2</b></h5></td><td><input class = 'form-control' placeholder ='Email here..' name=\"email2\" value=\"$email2\"></td></tr>";
        echo "<tr><td align=\"right\"><h5><b>Email 3</b></h5></td><td><input class = 'form-control' placeholder ='Email here..' name=\"email3\" value=\"$email3\"></td></tr>";

        echo "<tr><td align=\"right\"><h5><b>Website Link</b></h5></td><td><input placeholder = 'www.employeeslink.com' class = 'form-control' name=\"url\" value=\"$url\"></td></tr>";
        echo "<tr><td align=\"right\"><h5><b>Remarks</b></h5></td><td><textarea name=\"remarks_contact\" class = 'form-control' placeholder = 'Remarks here...' value=\"$remarks_contact\" >$remarks_contact</textarea></td></tr>";


	echo "</table>
	<div class = 'text-end'>
	<button type=\"submit\" class='btn text-white bg-success'>Update Contact Details</button>
	</div>
<div id = 'findet'></div>
	
	</form>";
// end contact details form

// start bank account details
echo "<div  class = 'mt-5 text-center'><h1 class = 'text-uppercase my-4' style  ='color: #cccccc !important'>FINANCE DETAILS</h1></div>";

echo "<div class = 'shadow border px-5 py-3 my-5'>";
echo "<h4 class = 'fw-bold' >Bank Account Details</h4>";
echo "<div class = 'text-end mb-3'><button data-toggle='modal' data-target='#bnkadd' type ='button' class='btn bg-primary text-white' role='button'>Add Bank Account +</button></div>";
// href=\"personnelbankacctadd.php?loginid=$loginid&eid=$employeeid\"
     echo "<table class = 'table table-hover table-bordered border table-striped'>";
	echo "<thead><tr>
	<th>Bank Name</th>
	<th>Branch</th>
	<th>Account Number</th>
	<th>Type</th>
	<th>Currency</th>
	<th>Account Name</th>
	<th>Payroll Account</th>
	<th>Action</th>
	</tr></thead>";

	echo"<tbody>";
	$res6query = "SELECT bankacctid, bankid, contactid, bank_name, bank_branch, acct_name, acct_num, acct_type, acct_currency, bankacctremarks, payrolldflt FROM tblbankacct WHERE employeeid = '$employeeid'";
	$result6=""; $found6=0; $ctr6=0;
	$result6=$dbh2->query($res6query);
	if($result6->num_rows>0) {
		while($myrow6=$result6->fetch_assoc()) {
	  $bankacctid = $myrow6['bankacctid'];
	  $bankid = $myrow6['bankid'];
	  $contactid = $myrow6['contactid'];
	  $bank_name = $myrow6['bank_name'];
	  $bank_branch = $myrow6['bank_branch'];
	  $acct_name = $myrow6['acct_name'];
	  $acct_num = $myrow6['acct_num'];
	  $acct_type = $myrow6['acct_type'];
	  $acct_currency = $myrow6['acct_currency'];
	  $bankacctremarks = $myrow6['bankacctremarks'];
		$payrolldflt = $myrow6['payrolldflt'];
	  echo "<tr><td>$bank_name</td><td>$bank_branch</td><td>$acct_num</td><td>$acct_type</td><td>$acct_currency</td><td>$acct_name</td>";
		if($payrolldflt==1) { $payrolldfltsel="Yes"; } else if($payrolldflt==0) { $payrolldfltsel=""; }
		echo "<td align=\"center\">$payrolldfltsel</td>";
		echo "<td><a href=\"personnelbankacctedit.php?loginid=$loginid&eid=$employeeid&bid=$bankacctid\" class='btn mx-1  bg-warning text-white' role='button'>Edit</a><a href=\"personnelbankacctdel.php?loginid=$loginid&eid=$employeeid&bid=$bankacctid\" class='btn mx-1 bg-danger text-white' role='button'>Delete</a> </td></tr>";
		} // while($myrow6=$result6->fetch_assoc())
	} // if($result6->num_rows>0)

	echo "
	
	</tbody>
	</table></div>";

// end bank account details

// start insurance details
echo "<div class = 'shadow border px-5 py-3 my-5'>";
echo "<h4 class = 'fw-bold' class = 'fw-bold'>Insurance Details</h4>";
echo "<div class = 'text-end mb-3'><button  data-toggle='modal' data-target='#aip' type ='button' class='btn bg-primary text-white' role='button'>Add Insurance Policy +</button></div>";
	echo "<table class = 'table table-hover table-bordered border table-striped'>";
	echo "<thead><tr>";
	echo "<th align=center>InsuranceName</th>
	<th align=center>Group Policy#</th>
	<th align=center>Employe Policy#</th>
	<th align=center>From</th>
	<th align=center>To</th>
	<th align=center>Location</th>
	<th align=center>Action</th>

	</tr</thead>
	<tbody>";
	$res11query = "SELECT insuranceempid, policynum, insurancename, emppolicynum, durationfrom, durationto, location FROM tblinsuranceemp WHERE employeeid=\"$pid\" ORDER BY durationto DESC, durationfrom DESC";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
	  $insuranceempid = $myrow11['insuranceempid'];
	  $policynum = $myrow11['policynum'];
	  $insurancename = $myrow11['insurancename'];
	  $emppolicynum = $myrow11['emppolicynum'];
	  $durationfrom = $myrow11['durationfrom'];
	  $durationto = $myrow11['durationto'];
	  $location = $myrow11['location'];
	  echo "<tr>
	  <td>$insurancename</td>
	  <td>$policynum</td>
	  <td>$emppolicynum</td>
	  <td>$durationfrom</td>
	  <td>$durationto</td>
	  <td>$location</td>
	  <td><a href=\"personnelinsureempedit.php?loginid=$loginid&eid=$pid&ieid=$insuranceempid\" class='btn bg-warning text-white mx-1' role='button'>Edit</a><a href=\"personnelinsureempdel.php?loginid=$loginid&eid=$pid&ieid=$insuranceempid\" class='btn bg-danger text-white mx-1' role='button'>Delete</a></td></tr>";
		} // while($myrow11=$result11->fetch_assoc())
	} // if($result11->num_rows>0)
	echo "</tr></tbody>";
	echo "</table>";
echo "<div id = 'othdet'></div>";

	echo "</div>";
// end insurance details


echo "<div  class = 'mt-5 text-center'><h1 class = 'text-uppercase my-4' style  ='color: #cccccc !important'>OTHER DETAILS</h1></div>";


// start prof license details
echo "<div class = 'shadow border px-5 py-3 my-5'>";
echo "<h4 class = 'fw-bold'>Professional Details</h4>";
echo "<div class = 'text-end mb-3'><button  data-toggle='modal' data-target='#apl' type ='button' class='btn bg-primary text-white' role='button'>Add Professional License +</button></div>";
	echo "<table class = 'table table-hover table-bordered border table-striped'>";

	echo "<thead><tr>
	<th>Regulatory Board</th>
	<th>Profession</th>
	<th>License Number</th>
	<th>Date</th>
	<th>Action</th>
	</tr></thead>
	<tbody>";
	$res10query = "SELECT empproflicenseid, regulatoryboard, profession, licensenumber, licensedate FROM tblempproflicense WHERE employeeid='$pid'";
	$result10=""; $found10=0; $ctr10=0;
	$result10=$dbh2->query($res10query);
	if($result10->num_rows>0) {
		while($myrow10=$result10->fetch_assoc()) {
		$found10 = 1;
	  $empproflicenseid = $myrow10['empproflicenseid'];
	  $regulatoryboard = $myrow10['regulatoryboard'];
	  $profession = $myrow10['profession'];
	  $licensenumber = $myrow10['licensenumber'];
	  $licensedate = $myrow10['licensedate'];
	  echo "<tr><td>$regulatoryboard</td>";
	  echo "<td>$profession</td>";
	  echo "<td>$licensenumber</td>";
	  echo "<td>$licensedate</td>";
	  echo "<td><a href=\"personnelempproflicedit.php?loginid=$loginid&eid=$employeeid&eplid=$empproflicenseid\" class='btn bg-warning text-white mx-1' role='button'>Edit</a> <a href=\"personnelempproflicdel.php?loginid=$loginid&eid=$employeeid&eplid=$empproflicenseid\" class='btn bg-danger text-white mx-1' role='button'>Delete</a></td>";
	  echo "</tr>";		
		} // while($myrow10=$result10->fetch_assoc())
	} // if($result10->num_rows>0)
	echo "</tr>";
	echo "</tbody></table>";
	echo "</div>";

// end prof license details

//
// start passport details
// added 20161024
echo "<div class = 'shadow border px-5 py-3 my-5'>";
echo "<h4 class = 'fw-bold'>Passport Details</h4>";
echo "<div class = 'text-end mb-3'><button  data-toggle='modal' data-target='#aps' type ='button' class='btn bg-primary text-white' role='button'>Add Passport + </button></div>";
	echo "<table class = 'table table-hover table-bordered border table-striped'>";
	echo "<thead><tr>
	<th>Passport Number</th>
	<th>Country</th>
	<th>Date issued</th>
	<th>Expiry date</th>
	<th>Issued at</th>
	<th>Remarks</th>
	<th>Action</th>
	</tr></thead><tbody>";
	$res17query="SELECT tblemppassport.idtblemppassport, tblemppassport.passportnum, tblemppassport.countrycd, tblemppassport.issuedby, tblemppassport.dateissued, tblemppassport.dateexpiry, tblemppassport.remarks, tblcountrycd.cname FROM tblemppassport LEFT JOIN tblcountrycd ON tblemppassport.countrycd=tblcountrycd.letter2cd WHERE tblemppassport.employeeid=\"$employeeid\" ORDER BY tblemppassport.dateexpiry DESC";
	$result17=""; $found17=0; $ctr17=0;
	$result17=$dbh2->query($res17query);
	if($result17->num_rows>0) {
		while($myrow17=$result17->fetch_assoc()) {
		$found17 = 1;
		$ctr17 = $ctr17 + 1;
		$idtblemppassport17 = $myrow17['idtblemppassport'];
		$passportnum17 = $myrow17['passportnum'];
		$countrycd17 = $myrow17['countrycd'];
		$issuedby17 = $myrow17['issuedby'];
		$dateissued17 = $myrow17['dateissued'];
		$dateexpiry17 = $myrow17['dateexpiry'];
		$remarks17 = $myrow17['remarks'];
		$cname17 = $myrow17['cname'];
		echo "<tr><td>$passportnum17</td><td>$cname17</td><td>$dateissued17</td><td>$dateexpiry17</td><td>$issuedby17</td><td>$remarks17</td><td> <a href=\"personnelpassportedt.php?loginid=$loginid&eid=$employeeid&idpp=$idtblemppassport17\" class='btn mx-1 bg-warning text-white' role='button'>Edit</a><a href=\"personnelpassportdel.php?loginid=$loginid&eid=$employeeid&idpp=$idtblemppassport17\" class='btn mx-1 bg-danger text-white' role='button'>Delete</a></td></tr>";
		}
	}	

	echo "</tbody></table></div>";
// end passport details

//	Start Education background
echo "<div class = 'shadow border px-5 py-3 my-5'>";
echo "<h4 class = 'fw-bold'>Education Background</h4>";
echo "<div class = 'text-end mb-3'><button  data-toggle='modal' data-target='#aeb' type ='button' class='btn bg-primary text-white' role='button'>Add Education Details +</button></div>";
echo "<table class = 'table table-hover table-bordered border table-striped'>";
	echo "<thead><tr><th>Course</th>
	<th>YearGraduated</th>
	<th>School/University</th>
	<th>Address</th>
	<th>Action</th>
	</tr></thead><tbody>";
	$res4query = "SELECT empeducationid, coursegraduated, yeargraduated, schoolgraduated, schooladdress FROM tblempeducation WHERE employeeid='$pid'";
	$result4=""; $found4=0; $ctr4=0;
	$result4=$dbh2->query($res4query);
	if($result4->num_rows>0) {
		while($myrow4=$result4->fetch_assoc()) {
	  $empeducationid = $myrow4['empeducationid'];
	  $coursegraduated = $myrow4['coursegraduated'];
	  $yeargraduated = $myrow4['yeargraduated'];
	  $schoolgraduated = $myrow4['schoolgraduated'];
	  $schooladdress = $myrow4['schooladdress'];
	  echo "<tr><td>$coursegraduated</td>";
	  echo "<td>$yeargraduated</td>";
	  echo "<td>$schoolgraduated</td>";
	  echo "<td>$schooladdress</td>";
	  echo "<td><a href=\"personnelempeducedit.php?loginid=$loginid&eid=$employeeid&edid=$empeducationid\" class='btn text-white bg-warning mx-1 ' role='button'>Edit</a><a href=\"personnelempeducdel.php?loginid=$loginid&eid=$employeeid&edid=$empeducationid\" class='btn text-white bg-danger mx-1 ' role='button'>Delete</a>";
	  echo "</td></tr>";
		} // while($myrow4=$result4->fetch_assoc())
	} // if($result4->num_rows>0)


	echo "</tbody></table>
<div id = 'emerg'></div>
	
	</div>";
//	End Education background

echo "<div id = 'emerg' class = 'mt-5 text-center'><h1 class = 'text-uppercase my-4' style  ='color: #cccccc !important'>EMERGENCY DETAILS</h1></div>";

// start emergency contact details

	$res7query = "SELECT contactid, name_last, name_first, name_middle, contact_address1, contact_address2, contact_city, contact_province, contact_zipcode, contact_country, num_res1_cc, num_res1_ac, num_res1, num_res2_cc, num_res2_ac, num_res2, num_mobile1_cc, num_mobile1_ac, num_mobile1, num_mobile2_cc, num_mobile2_ac, num_mobile2, email1, email2, emergrelation FROM tblcontact WHERE emergempid = '$employeeid' AND contact_type = 'emergency'";
	$result7=""; $found7=0; $ctr7=0;
	$result7=$dbh2->query($res7query);
	if($result7->num_rows>0) {
		while($myrow7=$result7->fetch_assoc()) {
    $found7=1;
	$em_contactid = $myrow7['contactid'];
	$em_name_last = $myrow7['name_last'];
	$em_name_first = $myrow7['name_first'];
	$em_name_middle = $myrow7['name_middle'];
	$em_contact_address1 = $myrow7['contact_address1'];
	$em_contact_address2 = $myrow7['contact_address2'];
	$em_contact_city = $myrow7['contact_city'];
	$em_contact_province = $myrow7['contact_province'];
	$em_contact_zipcode = $myrow7['zipcode'];
	$em_contact_country = $myrow7['country'];
	$em_num_res1_cc = $myrow7['num_res1_cc'];
	$em_num_res1_ac = $myrow7['num_res1_ac'];
	$em_num_res1 = $myrow7['num_res1'];
	$em_num_res2_cc = $myrow7['num_res2_cc'];
	$em_num_res2_ac = $myrow7['num_res2_ac'];
	$em_num_res2 = $myrow7['num_res2'];
	$em_num_mobile1_cc = $myrow7['num_mobile1_cc'];
	$em_num_mobile1_ac = $myrow7['num_mobile1_ac'];
	$em_num_mobile1 = $myrow7['num_mobile1'];
	$em_num_mobile2_cc = $myrow7['num_mobile1_cc'];
	$em_num_mobile2_ac = $myrow7['num_mobile2_ac'];
	$em_num_mobile2 = $myrow7['num_mobile2'];
	$em_email1 = $myrow7['email1'];
	$em_email2 = $myrow7['email2'];
	$em_emergrelation = $myrow7['emergrelation'];
		} // while($myrow7=$result7->fetch_assoc())
	} // if($result7->num_rows>0)
	echo "<div class = 'shadow border px-5 py-3 my-5'>";
	echo "<h4 class = 'fw-bold'>Emergency Details</h4>";
	echo "<div class = 'text-end mb-3'><button  data-toggle='modal' data-target='#aed' type ='button' class='btn bg-primary text-white' role='button'>Add Emergency Details +</button></div>";
	echo "<table class = 'table table-hover table-bordered border table-striped'>";
     echo "<thead><tr>
	 <th>Name</th>
	 <th>Relation</th>
	 <th>Landline</th>
	 <th>Mobile</th>
	 <th>Email</th>
	 <th>Action</th>
	</tr> </thead><tbody>";
    if($found7==1) {
     echo "<tr>
	 <td>$em_name_first  $em_name_middle[0] $em_name_last</td>
	 <td>$em_emergrelation</td>
	 <td>$em_num_res1_cc $em_num_res1_ac $em_num_res1</td>
	 <td>$em_num_mobile1_cc $em_num_mobile1_ac $em_num_mobile1</td>
	 <td>$em_email1</td>
	 <td><a href=\"personnelemergencyadd.php?loginid=$loginid&eid=$employeeid&cid=$em_contactid\" class='btn text-white bg-warning ' role='button'>Update</a></td></tr>";
    } //if
     echo "</tbody></table></div>";

// end emergency contact details

// start spouse details

  if ($emp_civilstatus <> "Single")
  {
	$res4query = "SELECT empspouseid, empspousectr, empspouselast, empspousefirst, empspousemiddle, empspousebirthdate FROM tblempspouse WHERE employeeid='$employeeid'";
	$result4=""; $found4=0; $ctr4=0;
	$result4=$dbh2->query($res4query);
	if($result4->num_rows>0) {
		while($myrow4=$result4->fetch_assoc()) {
		$found4=1;
	  $empspouseid = $myrow4['empspouseid'];
	  $empspousectr = $myrow4['empspousectr'];
	  $empspouselast = $myrow4['empspouselast'];
	  $empspousefirst = $myrow4['empspousefirst'];
	  $empspousemiddle = $myrow4['empspousemiddle'];
	  $empspousebirthdate = $myrow4['empspousebirthdate'];
		} // while($myrow4=$result4->fetch_assoc())
	} // if($result4->num_rows>0)

	$res41query = "SELECT tblempspouseemployer.empspouseemployerid, tblempspouseemployer.empspouseid, tblempspouseemployer.companyid, tblempspouseemployer.datefrom, tblempspouseemployer.dateto FROM tblempspouseemployer WHERE tblempspouseemployer.employeeid=\"$employeeid\"";
	$result41=""; $found41=0; $ctr41=0;
	$result41=$dbh2->query($res41query);
	if($result41->num_rows>0) {
		while($myrow41=$result41->fetch_assoc()) {
	  $found41 = 1;
	  $empspouseemployerid41 = $myrow41['empspouseemployerid'];
	  $empspouseid41 = $myrow41['empspouseid'];
	  $companyid41 = $myrow41['companyid'];
	  $datefrom41 = $myrow41['datefrom'];
	  $dateto41 = $myrow41['dateto'];
		} // while($myrow41=$result41->fetch_assoc())
	} // if($result41->num_rows>0)

	$res42query = "SELECT companyid, company, ofc_address1, ofc_num1, ofc_num2, ofc_email FROM tblcompany WHERE employeeid=\"$employeeid\" AND company_type=\"spouse_employer\"";
	$result42=""; $found42=0; $ctr42=0;
	$result42=$dbh2->query($res42query);
	if($result42->num_rows>0) {
		while($myrow42=$result42->fetch_assoc()) {
	  $found42 = 1;
	  $companyid42 = $myrow42['companyid'];
	  $company42 = $myrow42['company'];
	  $ofc_address142 = $myrow42['ofc_address1'];
	  $ofc_num142 = $myrow42['ofc_num1'];
	  $ofc_num242 = $myrow42['ofc_num2'];
	  $ofc_email42 = $myrow42['ofc_email'];
		} // while($myrow42=$result42->fetch_assoc())
	} // if($result42->num_rows>0)

		echo "<form  class = 'shadow border px-5 py-3 my-5' action=\"personnelupdspouse.php?loginid=$loginid&eid=$employeeid\" method=\"post\" name=\"personnelupdspouse\">";
		echo "<h4 class = 'fw-bold'>Spouse Details</h4>";
     echo "<table class = 'table table-hover table-bordered border table-striped'>";
	echo "<tr><td align=\"right\">Full Name</td>";
	?>
		<td>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Last name</label>
      <input type="text"  class="form-control" name = 'empspouselast' value = '<?php echo $empspouselast ?>' id="validationDefault01" placeholder="Last name" >
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">First name</label>
      <input type="text" class="form-control"  name = 'empspousefirst' value = '<?php echo $empspousefirst ?>' id="validationDefault02" placeholder="First name" >
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefaultUsername">Middle Name</label>
      <input type="text" class="form-control"  name = 'empspousemiddle' value = '<?php echo $empspousemiddle ?>' id="validationDefault02" placeholder="Middle name" >
    
    </div>
  </div>
  </td>
  </tr>
  <?php
	

	echo "<tr><td align=\"right\">Spouse' Birthdate</td><td><input name='empspousebirthdate' value = '$empspousebirthdate' class = 'form-control' type='date'></td></tr>";

	echo "<tr><td align=\"right\">Employer</td><td><input name=\"empspouseemployer\" class = 'form-control' placeholder = 'Employer here..' value=\"$company42\" size=\"30\"></td></tr>";
	echo "<tr><td align=\"right\">Employer address</td><td><textarea rows=\"2\" class = 'form-control' placeholder = 'Employer Address here..' cols=\"30\" name=\"empspouseemployeraddress\">$ofc_address142</textarea></td></tr>";
	echo "<tr><td align=\"right\">Employer Contact Number 1</td><td><input name=\"empspouseemployertel1\" class = 'form-control' placeholder = 'Employer Contact 1 here...' value=\"$ofc_num142\"></td></tr>";
	echo "<tr><td align=\"right\">Employer  Contact Number 2</td><td><input name=\"empspouseemployertel2\" class = 'form-control' placeholder = 'Employer Contact 2 here...' value=\"$ofc_num242\"></td></tr>";
	echo "<tr><td align=\"right\">Employer Email</td><td><input name=\"empspouseemployeremail\" class = 'form-control' placeholder = 'Employer Email here...' value=\"$ofc_email42\"></td></tr>";
	echo "<tr><td align=\"right\">Employment period</td>";
	?>
	<td>
	<div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">From</label>
      <input type="date"  class="form-control" name = 'empspouseemployerperiodfr' value = '<?php echo $datefrom41 ?>' id="validationDefault01">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">To</label>
      <input type="date"e class="form-control"  name = 'empspouseemployerperiodto' value = '<?php echo $dateto41 ?>' id="validationDefault02" >
    </div>
    </div>
	</td></tr>

	</table>
	<?php
	
	// echo "<td>From&nbsp;<input name=\"empspouseemployerperiodfr\" value=\"$datefrom41\">&nbsp;To&nbsp;<input name=\"empspouseemployerperiodto\" value=\"$dateto41\"></td></tr>";
	echo "<div class = 'text-end my-3'><button type=\"submit\" class='btn text-white bg-success'>Update Spouse Details</button></div>";
	echo "</form>";
  }
  else
  {
  }
// end spouse details
// start dependents details

echo "<div class = 'shadow border px-5 py-3 my-5'>";
echo "<h4 class = 'fw-bold'>Dependent Details</h4>";
echo "<div class = 'text-end mb-3'><button  data-toggle='modal' data-target='#adep' type ='button' class='btn bg-primary text-white' role='button'>Add Dependent + </button></div>";
	echo "<table class = 'table table-hover table-bordered border table-striped'>";
     echo "<thead><tr>
	 <th>FirstName</th>
	 <th>Middle</th>
	 <th>LastName</th>
	 <th>Birthdate</th>
	 <th>Relationship</th>
	 <th>Action</th>

	 </tr></thead><tbody>";
		$res5query = "SELECT empdependentid, empdependentctr, dependentlast, dependentfirst, dependentmiddle, dependentbirthdate, dependentrelation FROM tblempdependent WHERE employeeid='$employeeid'";
		$result5=""; $found5=0; $ctr5=0;
		$result5=$dbh2->query($res5query);
		if($result5->num_rows>0) {
			while($myrow5=$result5->fetch_assoc()) {
			$found5 = 1;
	$empdependentid = $myrow5['empdependentid'];
	$empdependentctr = $myrow5['empdependentctr'];
	$dependentlast = $myrow5['dependentlast'];
	$dependentfirst = $myrow5['dependentfirst'];
	$dependentmiddle = $myrow5['dependentmiddle'];
	$dependentbirthdate = $myrow5['dependentbirthdate'];
	$dependentrelation = $myrow5['dependentrelation'];
	if($dependentfirst != '') {
	echo "<tr>
	<td>$dependentfirst</td>
	<td>$dependentmiddle</td>
	<td>$dependentlast</td>
	<td>$dependentbirthdate</td>
	<td>$dependentrelation</td>
	<td><a href=\"personnelempdependentedit.php?loginid=$loginid&eid=$employeeid&did=$empdependentid\" class='btn bg-warning text-white mx-1' role='button'>Edit</a><a href=\"personnelempdependentdel.php?loginid=$loginid&eid=$employeeid&did=$empdependentid\" class='btn text-white bg-danger mx-1 ' role='button'>Delete</a></td></tr>";
	}// if($dependentfirst != '')
			} // while($myrow5=$result5->fetch_assoc())
		} // if($result5->num_rows>0)


// end dependents details

	} // if($pid == '')

	echo "</tbody></table></div>";

echo "</div>";

?>

<?php
		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result=$dbh2->query($resquery);

     include ("footer.php");

	 ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
	// Initialize Select2
	$(document).ready(function() {
$('.form-select').select2();
});
</script>


<?php
} else {

     include("logindeny.php");

}

// mysql_close($dbh);
$dbh2->close();
?> 

<!-- <script type="text/javascript">
function popupwindow(loginid, pid) {
//     alert("This is a test");
     window.open("personnelpicbrowse.php?loginid=" + loginid + "&eid=" + pid,"Upload","menubar=no,width=430,height=260,toolbar=no");
}
</script> -->
