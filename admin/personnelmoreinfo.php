<?php 

include("db1.php");
include ("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$pid = (isset($_GET['pid'])) ? $_GET['pid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
    include ("header2.php");
	
	echo "<div class='w-100 d-flex justify-content-center'>";
    echo "<table class='w-75 fin' spacing=0 cellspacing=0 cellpadding=0>";
    echo "<tr><th colspan=2 class='text-center fs-2'>Personnel Information</th></tr>";

//     echo "vartest pid:$pid loginid:$loginid<br>";

if($pid == '') {
	echo "<tr><td colspan=2><font color=red><b>Sorry. No data available</b></font></td></tr>";
} else {
	$resquery = "SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.picture, tblcontact.position, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.num_mobile3_cc, tblcontact.num_mobile3_ac, tblcontact.num_mobile3, tblcontact.email1, tblcontact.email2, tblcontact.url, tblcontact.remarks_contact, tblcontact.picfn, tblemployee.emp_ref_num, tblemployee.date, tblemployee.date_hired, tblemployee.date_expired, tblemployee.emp_birthdate, tblemployee.emp_birthplace, tblemployee.emp_civilstatus, tblemployee.empeducationid, tblemployee.emp_num1, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_pagibig2, tblemployee.emp_gsis, tblemployee.emp_insuranceid, tblemployee.emp_emergencyid, tblemployee.emp_skills, tblemployee.emp_status, tblemployee.emp_remarks, tblemployee.employee_type, tblemployee.term_resign FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.employeeid='$pid'";
	$result="";
	$result=$dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
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
		$num_mobile3_cc = $myrow['num_mobile_cc'];
		$num_mobile3_ac = $myrow['num_mobile3_ac'];
		$num_mobile3 = $myrow['num_mobile3'];
		$email1 = $myrow['email1'];
		$email2 = $myrow['email2'];
		$url = $myrow['url'];
		$remarks_contact = $myrow['remarks_contact'];
		$picfn = $myrow['picfn'];
		$emp_ref_num = $myrow['emp_ref_num'];
		$date = $myrow['date'];
		$date_hired = $myrow['date_hired'];
		$date_expired = $myrow['date_expired'];
		$emp_birthdate = $myrow['emp_birthdate'];
		$emp_birthplace = $myrow['emp_birthplace'];
		$emp_civilstatus = $myrow['civilstatus'];
		$empeducationid = $myrow['empeducationid'];
		$emp_num1 = $myrow['emp_num1'];
		$emp_tin = $myrow['emp_tin'];
		$emp_sss = $myrow['emp_sss'];
		$emp_philhealth = $myrow['emp_philhealth'];
		$emp_pagibig = $myrow['emp_pagibig'];
		$emp_pagibig2 = $myrow['emp_pagibig2'];
		$emp_gsis = $myrow['emp_gsis'];
		$emp_insuranceid = $myrow['emp_insuranceid'];
		$emp_emergencyid = $myrow['emp_emergencyid'];
		$emp_skills = $myrow['emp_skills'];
		$emp_status = $myrow['emp_status'];
		$emp_remarks = $myrow['emp_remarks'];
		$employee_type = $myrow['employee_type'];
		$term_resign = $myrow['term_resign'];
        // $pid = $employeeid;
         echo "<tr><td>Employee No.</td><td>$pid</td></tr>";
	 echo "<tr><td></td>";
	 if($picfn != "") { 
	 echo "<td><img src=\"images/$picfn\" height=\"150\"></td>";
	 } else { echo "<td></td>"; }
	 echo "</tr>";
         echo "<tr><td>Name</td><td><b>$name_first $name_middle $name_last</b></td></tr>";
//         echo "<tr><td>Position</td><td>$myrow[6]";
         echo "<tr><td></td><td></td></tr>";
         echo "<tr><td>Sex</td><td>$contact_gender";
         echo "<tr><td>Address</td><td>$contact_address1<br>$contact_address2<br>$contact_city<br>$contact_province $contact_zipcode $contact_country</td></tr>";
         echo "<tr><td>Landline(s)</td><td>$num_res1_cc $num_res1_ac $num_res1</td></tr>";
         echo "<tr><td></td><td>$num_res2_cc $num_res2_ac $num_res2</td></tr>";
         echo "<tr><td>Mobile(s)</td><td>$num_mobile1_cc $num_mobile1_ac $num_mobile1</td></tr>";
         echo "<tr><td></td><td>$num_mobile2_cc $num_mobile2_ac $num_mobile2</td></tr>";
         echo "<tr><td></td><td>$num_mobile3_cc $num_mobile3_ac $num_mobile3</td></tr>";
         echo "<tr><td>Email(s)</td><td><a href=mailto:'$email1'>$email1</a></td></tr>";
         echo "<tr><td></td><td><a href=mailto:'$email2'>$email2</a></td></tr>";
         echo "<tr><td>Website</td><td>$url</td></tr>";
         echo "<tr><td>Remarks</td><td>$remarks_contact</td></tr>";

	echo "<tr valign=top><td bgcolor=lightgray colspan=2>Employment Details</td></tr>";

         echo "<tr><td>Employee Ref#</td><td>$emp_ref_num</td></tr>";
         echo "<tr><td>Date Hired</td><td>$date_hired</td></tr>";
//         echo "<tr><td>Date Expired</td><td>$date_expired</td></tr>";

	if ($term_resign != '0000-00-00')
	{
	 echo "<tr><td>Term Ended</td><td>$term_resign</td></tr>";
	}

         echo "<tr><td>Birthdate</td><td>$emp_birthdate</td></tr>";
         echo "<tr><td>Birthplace</td><td>$emp_birthplace</td></tr>";
         echo "<tr><td>Civil Status</td><td>$emp_civilstatus</td></tr>";
         echo "<tr><td>BIR TIN</td><td>$emp_tin</td></tr>";
         echo "<tr><td>SSS</td><td>$emp_sss</td></tr>";
         echo "<tr><td>Philhealth</td><td>$emp_philhealth</td></tr>";
         echo "<tr><td>Pag-IBIG</td><td>$emp_pagibig</td></tr>";
				if($emp_pagibig2!='') {
					echo "<tr><td>Pag-IBIG2</td><td>$emp_pagibig2</td></tr>";
				} // if($emp_pagibig2!='')
         echo "<tr><td>GSIS</td><td>$emp_gsis</td></tr>";

         echo "<tr><td>Skills</td><td>$emp_skills</td></tr>";
         echo "<tr><td>Employment Status</td><td>"; // $emp_status
	  if($emp_status == 'R') {
	    echo "Regular";
	  } else if($emp_status == 'P') {
	    echo "Probationary";
	  } else if($emp_status == 'T') {
	    echo "Temporary";
	  } else if($emp_status == 'I') {
	    echo "Intern";
	  } else {
        echo "";
    } //if-else
        echo "</td></tr>";
         echo "<tr><td>Remarks</td><td>$emp_remarks</td></tr>";
         echo "<tr><td>Type</td><td>$employee_type</td></tr>";

//	Start Employment details

	$res3query = "SELECT empdepartment, empposition, emppositionlevel, empsalarygrade, empregularship, idhrpositionctg FROM tblempdetails WHERE employeeid='$pid'";
	$result3=""; $found3=0; $ctr3=0;
	$result3=$dbh2->query($res3query);
	if($result3->num_rows>0) {
		while($myrow3=$result3->fetch_assoc()) {
	  $found3 = 1;
	  $department = $myrow3['empdepartment'];
	  $position = $myrow3['empposition'];
	  $positionlevel = $myrow3['emppositionlevel'];
	  $salarygrade = $myrow3['empsalarygrade'];
		$idhrpositionctg = $myrow3['idhrpositionctg'];
	  echo "<tr><td>Position</td><td>";
		if($idhrpositionctg!=0) {
			$res8query="SELECT code, name, deptcd FROM tblhrpositionctg WHERE idhrpositionctg=$idhrpositionctg LIMIT 1";
			$result8=""; $found8=0; $ctr8=0;
			$result8=$dbh2->query($res8query);
			if($result8->num_rows>0) {
				while($myrow8=$result8->fetch_assoc()) {
				$found8=1;
				$code8 = $myrow8['code'];
				$name8 = $myrow8['name'];
				$deptcd8 = $myrow8['deptcd'];
				} // while($myrow8=$result8->fetch_assoc())
			} // if($result8->num_rows>0)
			if($found8==1) {
				echo "$name8";
			} else {
				echo "$position";
			} // if($found8==1)
		} else {
			echo "$position";
		} // if($idhrpositionctg!=0)
		echo "</td></tr>";
	  echo "<tr><td>Department</td><td>$department</td></tr>";
	  echo "<tr><td>Position Level</td><td>$positionlevel</td></tr>";
	  echo "<tr><td>Salary grade</td><td>$salarygrade</td></tr>";
		} // while($myrow3=$result3->fetch_assoc())
	} // if($result3->num_rows>0)
//	End Employement details

//	Start Display project(s) involvement
	echo "<tr valign=top><th colspan=2>Project Assignment(s)</th></tr>";

	echo "<tr><td colspan=2>";

	echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
	echo "<tr><td align=center><font size=1>Reference#</font></td><td align=center><font size=1>Proj_code</font></td><td align=center><font size=1>Project Name</font></td><td align=center><font size=1>Position</font></td><td align=center><font size=1>Duration</font></td></tr>";

	$res2query = "SELECT ref_no, projassignid, proj_code, proj_name, position, durationfrom, durationto, idhrpositionctg FROM tblprojassign WHERE employeeid='$pid' ORDER BY durationfrom DESC";
	$result2=""; $found2=0; $ctr2=0;
	$result2=$dbh2->query($res2query);
	if($result2->num_rows>0) {
		while($myrow2=$result2->fetch_assoc()) {
		$found2 = 1;
	  $ref_no = $myrow2['ref_no'];
	  $projectid = $myrow2['projassignid'];
		$proj_code = $myrow2['proj_code'];
	  $proj_name = $myrow2['proj_name'];
	  $position = $myrow2['position'];
	  $durationfrom = $myrow2['durationfrom'];
	  $durationto = $myrow2['durationto'];
		$idhrpositionctg2 = $myrow2['idhrpositionctg'];
    echo "<tr>";
		if($accesslevel >= 5) {
		echo "<td><a href=\"personnelmoreinfoproj.php?loginid=$loginid&eid=$pid&prjid=$projectid\" target=\"_blank\">$ref_no</a></td>";
		// echo "<td>$ref_no</td>";
		} else {
		echo "<td>$ref_no</td>";
		}
		echo "<td colspan=\"2\">";
		// echo "<td>$proj_name</td>";
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
	$res5aquery = "SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projectid AND empid=\"$pid\"";
	$result5a=""; $found5a=0;
	$result5a=$dbh2->query($res5aquery);
	if($result5a->num_rows>0) {
		while($myrow5a=$result5a->fetch_assoc()) {
		$found5a=1;
		$projectid5a = $myrow5a['projectid'];
		$projcode5a = $myrow5a['projcode'];
		$projname5a = $myrow5a['projname'];
		echo "$projcode5a - $projname5a<br>";
		} // while($myrow5a=$result5a->fetch_assoc())
	} // if($result5a->num_rows>0)
		echo "</td>";

	// 20171018 query tblhrpositionctg
	$res19query="SELECT idhrpositionctg, code, name, deptcd FROM tblhrpositionctg WHERE idhrpositionctg=$idhrpositionctg2";
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
		echo "<td>$name19</td>";
	} else {
		echo "<td>$position</td>";
	} // if($found19==1)

		echo "<td>";
		// if($durationfrom=="0000-00-00" || ) { echo "&nbsp;"; } else { echo date("Y-M-d", strtotime("$durationfrom")); }
		// echo "&nbsp;-&nbsp;";
		// if($durationto=="0000-00-00" || ) { echo "&nbsp;"; } else { echo date("Y-M-d", strtotime("$durationto")); }
		$durfromyr=substr($durationfrom,0,4);
		$durtoyr=substr($durationto,0,4);
		if($durfromyr=="0000") { echo ""; } else { echo date("Y-M-d", strtotime($durationfrom)); }
		echo "&nbsp;-&nbsp;";
		if($durtoyr=="0000") { echo ""; } else { echo date("Y-M-d", strtotime($durationto)); }
		echo "</td>";
		echo "</tr>";

		} // while($myrow2=$result2->fetch_assoc())
	} // if($result2->num_rows>0)

	echo "</table>";

        echo "</td></tr>";
//	End Display project(s) involvement

// start tmp.project assignments
	echo "<tr valign=top><th colspan=2>tmp.Project Assignment(s)</th></tr>";

	echo "<tr><td colspan=2>";

	echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";

	$empprojctr = 0;

	echo "<tr><td><font size=1>Ref#</font></td><td><font size=1>Acronym/Project Name</font></td><td><font size=1>Position</font></td><td><font size=1>Duration</font></td></tr>";
	$res9query = "SELECT projectassign0id, ref_no, proj_code, proj_name, position, durationfrom, durationto FROM tblprojassign0 WHERE employeeid1 = '$pid' ORDER BY durationto DESC";
	$result9=""; $found9=0; $ctr9=0;
	$result9=$dbh2->query($res9query);
	if($result9->num_rows>0) {
		while($myrow9=$result9->fetch_assoc()) {
	  $found9 = 1;
	  $projectassign0id = $myrow9['projassign0id'];
	  $ref_no = $myrow9['ref_no'];
	  $proj_code = $myrow9['proj_code'];
	  $proj_name = $myrow9['proj_name'];
	  $position = $myrow9['position'];
	  $durationfrom = $myrow9['durationfrom'];
	  $durationto = $myrow9['durationto'];

	  $empprojctr = $empprojctr + 1;

	  echo "<tr><td>$ref_no</td><td>$proj_name</td><td>$position</td><td>$durationfrom -to- $durationto</td></tr>";

		} // while($myrow9=$result9->fetch_assoc())
	} // if($result9->num_rows>0)
	echo "</table>";
	echo "</td></tr>";
// end tmp.project assignments

// start insurance details
	echo "<tr valign=top><th colspan=2>Insurance details</th></tr>";
	echo "<tr><td colspan=2><table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
	echo "<tr><td align=center><font size=1>InsuranceName</font></td><td align=center><font size=1>GroupPolicy#</font></td><td align=center><font size=1>EmployeePolicy#</font></td><td align=center><font size=1>From</font></td><td align=center><font size=1>To</font></td><td align=center><font size=1>Location</font></td></tr>";
	
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
	  echo "<tr><td>$insurancename</td><td>$policynum</td><td>$emppolicynum</td><td>".date("Y-M-d", strtotime($durationfrom))."</td><td>".date("Y-M-d", strtotime($durationto))."</td><td>$location</td></tr>";
		} // while($myrow11=$result11->fetch_assoc())
	} // if($result11->num_rows>0)
	echo "</table></td></tr>";
// end insurance details

// start prof license details
	echo "<tr valign=top><th colspan=2>Professional License details</th></tr>";
	echo "<tr><td colspan=2>";
	echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
	echo "<tr><td align=center><font size=1>Regulatory Board</font></td><td align=center><font size=1>Profession</font></td><td align=center><font size=1>License Number</font></td><td align=center><font size=1>Date</font></td></tr>";

	$res10query = "SELECT empproflicenseid, regulatoryboard, profession, licensenumber, licensedate FROM tblempproflicense WHERE employeeid='$pid'";
	$result10=""; $found10=0; $ctr10=0;
	$result10=$dbh2->query($res10query);
	if($result10->num_rows>0) {
		while($myrow10=$result10->fetch_assoc()) {
	  $empproflicenseid = $myrow10['empproflicenseid'];
	  $regulatoryboard = $myrow10['regulatoryboard'];
	  $profession = $myrow10['profession'];
	  $licensenumber = $myrow10['licensenumber'];
	  $licensedate = $myrow10['licensedate'];
	  echo "<tr><td>$regulatoryboard</td>";
	  echo "<td>$profession</td>";
	  echo "<td>$licensenumber</td>";
	  echo "<td>$licensedate</td></tr>";
		} // while($myrow10=$result10->fetch_assoc())
	} // if($result10->num_rows>0)
	echo "</table>";
	echo "</td></tr>";
// end prof license details

// 20171017
// start passport details
	echo "<tr valign=top><th colspan=2>Passport details</th></tr>";
	echo "<tr><td colspan=2>";
	echo "<table width=\"100%\" class=\"fin2\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	echo "<tr><td><i>Passport No.</i></td><td><i>Country</i></td><td><i>Date issued</i></td><td><i>Expiry date</i></td><td><i>Issued at</i></td><td><i>Remarks</i></td></tr>";
	$res17query="SELECT tblemppassport.idtblemppassport, tblemppassport.passportnum, tblemppassport.countrycd, tblemppassport.issuedby, tblemppassport.dateissued, tblemppassport.dateexpiry, tblemppassport.remarks, tblcountrycd.cname FROM tblemppassport LEFT JOIN tblcountrycd ON tblemppassport.countrycd=tblcountrycd.letter2cd WHERE tblemppassport.employeeid=\"$pid\" ORDER BY tblemppassport.dateexpiry DESC";
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
		echo "<tr><td>$passportnum17</td><td>$cname17</td><td>".date("Y-M-d", strtotime($dateissued17))."</td><td>".date("Y-M-d", strtotime($dateexpiry17))."</td><td>$issuedby17</td><td>$remarks17</td></tr>";
		}
	}	
	echo "<tr><td colspan=\"8\" align=\"center\"><a href=\"personnelpassportadd.php?loginid=$loginid&eid=$employeeid\">Add new passport</a></td></tr>";
	echo "</table>";
	echo "</td></tr>";
// end passport details

//	Start Education background
	echo "<tr valign=top><th colspan=2>Educational background</th></tr>";
	echo "<tr><td colspan=2>";
	echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
	echo "<tr><td align=center><font size=1>Course</font></td><td align=center><font size=1>YearGraduated</font></td><td align=center><font size=1>School/University</font></td></tr>";

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
	  echo "<td>$schoolgraduated</td></tr>";
		} // while($myrow4=$result4->fetch_assoc())
	} // if($result4->num_rows>0)
	echo "</table>";
	echo "</td></tr>";
//	End Education background

// start bank account details
     echo "<tr><td colspan=2>";
     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th colspan=6>Bank Account Details</th></tr>";
	echo "<tr><td align=center><font size=1>BankName</font></td><td align=center><font size=1>Branch</font></td><td align=center><font size=1>AcctNumber</font></td><td align=center><font size=1>Type</font></td><td align=center><font size=1>Currency</font></td><td align=center><font size=1>AcctName</font></td><td align=center><font size=1>PayrollAcct</font></td></tr>";

	$res6query = "SELECT bankacctid, bankid, contactid, bank_name, bank_branch, acct_name, acct_num, acct_type, acct_currency, bankacctremarks, payrolldflt FROM tblbankacct WHERE employeeid = '$pid'";
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
		if($payrolldflt==1) { echo "<td>Yes</td>"; } else { echo "<td></td>"; }
		echo "</tr>";

		} // while($myrow6=$result6->fetch_assoc())
	} // if($result6->num_rows>0)
	echo "</table>";
	echo "</td></tr>";
// end bank account details

// start emergency contact details
	echo "<tr><td colspan=2>";

	$res7query = "SELECT contactid, name_last, name_first, name_middle, contact_address1, contact_address2, contact_city, contact_province, contact_zipcode, contact_country, num_res1_cc, num_res1_ac, num_res1, num_res2_cc, num_res2_ac, num_res2, num_mobile1_cc, num_mobile1_ac, num_mobile1, num_mobile2_cc, num_mobile2_ac, num_mobile2, email1, email2, emergrelation FROM tblcontact WHERE emergempid = '$pid' AND contact_type = 'emergency'";
	$result7=""; $found7=0; $ctr7=0;
	$result7=$dbh2->query($res7query);
	if($result7->num_rows>0) {
		while($myrow7=$result7->fetch_assoc()) {
	$em_contactid = $myrow7['contactid'];
	$em_name_last = $myrow7['name_last'];
	$em_name_first = $myrow7['name_first'];
	$em_name_middle = $myrow7['name_middle'];
	$em_contact_address1 = $myrow7['contact_address1'];
	$em_contact_address2 = $myrow7['contact_address2'];
	$em_contact_city = $myrow7['contact_city'];
	$em_contact_province = $myrow7['contact_province'];
	$em_contact_zipcode = $myrow7['contact_zipcode'];
	$em_contact_country = $myrow7['contact_country'];
	$em_num_res1_cc = $myrow7['num_res1_cc'];
	$em_num_res1_ac = $myrow7['num_res1_ac'];
	$em_num_res1 = $myrow7['num_res1'];
	$em_num_res2_cc = $myrow7['num_res2_cc'];
	$em_num_res2_ac = $myrow7['num_res2_ac'];
	$em_num_res2 = $myrow7['num_res2'];
	$em_num_mobile1_cc = $myrow7['num_mobile1_cc'];
	$em_num_mobile1_ac = $myrow7['num_mobile1_ac'];
	$em_num_mobile1 = $myrow7['num_mobile1'];
	$em_num_mobile2_cc = $myrow7['num_mobile2_cc'];
	$em_num_mobile2_ac = $myrow7['num_mobile2_ac'];
	$em_num_mobile2 = $myrow7['num_mobile2'];
	$em_email1 = $myrow7['email1'];
	$em_email2 = $myrow7['email2'];
	$em_emergrelation = $myrow7['emergrelation'];
		} // while($myrow7=$result7->fetch_assoc())
	} // if($result7->num_rows>0)

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th colspan=5>Emergency contact info</th></tr>";
     echo "<tr><td align=center><font size=1>Name</font></td><td align=center><font size=1>Relation</font></td><td align=center><font size=1>Landline</font></td><td align=center><font size=1>Mobile</font></td><td align=center><font size=1>Email</font></td></tr>";
     echo "<tr><td>$em_name_first  $em_name_middle[0] $em_name_last</td><td>$em_emergrelation</td><td>$em_num_res1_cc $em_num_res1_ac $em_num_res1</td><td>$em_num_mobile1_cc $em_num_mobile1_ac $em_num_mobile1</td><td>$em_email1</td></tr>";
     echo "</table>";
	echo "</td></tr>";
// end emergency contact details

// start spouse details
  if ($emp_civilstatus <> "Single") {
	
	$res4query = "SELECT empspouseid, empspousectr, empspouselast, empspousefirst, empspousemiddle, empspousebirthdate FROM tblempspouse WHERE employeeid='$pid'";
	$result4=""; $found4=0; $ctr4=0;
	$result4=$dbh2->query($res4query);
	if($result4->num_rows>0) {
		while($myrow4=$result4->fetch_assoc()) {
	  $empspouseid = $myrow4['empspouseid'];
	  $empspousectr = $myrow4['empspousectr'];
	  $empspouselast = $myrow4['empspouselast'];
	  $empspousefirst = $myrow4['empspousefirst'];
	  $empspousemiddle = $myrow4['empspousemiddle'];
	  $empspousebirthdate = $myrow4['empspousebirthdate'];
		} // while($myrow4=$result4->fetch_assoc())
	} // if($result4->num_rows>0)

     echo "<tr><td colspan=2><table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th colspan=2>Spouse Details</th></tr>";
	echo "<tr><td align=center><font size=1>Name</font></td><td align=center><font size=1>Birthdate</font></td></tr>";
	echo "<tr><td>$empspousefirst $empspousemiddle[0] $empspouselast</td><td>$empspousebirthdate</td></tr>";
	echo "</table></td></tr>";
  }
// end spouse details

//	Start List of Dependents
	echo "<tr valign=top><th colspan=2>List of Dependents</th></tr>";
	echo "<tr><td colspan=2>";

	echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0 width=100%>";
	echo "<tr><td align=center><font size=1>Name</font></td><td align=center><font size=1>Birthdate</font></td><td align=center><font size=1>Relationship</font></td></tr>";
	
	$res5query = "SELECT dependentlast, dependentfirst, dependentmiddle, dependentbirthdate, dependentrelation FROM tblempdependent WHERE employeeid='$pid'";
	$result5=""; $found5=0; $ctr5=0;
	$result5=$dbh2->query($res5query);
	if($result5->num_rows>0) {
		while($myrow5=$result5->fetch_assoc()) {
	  $dependentlast = $myrow5['dependentlast'];
	  $dependentfirst = $myrow5['dependentfirst'];
	  $dependentmiddle = $myrow5['dependentmiddle'];
	  $dependentbirthdate = $myrow5['dependentbirthdate'];
	  $dependentrelation = $myrow5['dependentrelation'];
	  echo "<tr><td>$dependentfirst $dependentmiddle[0] $dependentlast</td><td>$dependentbirthdate</td><td>$dependentrelation</td></tr>";
		} // while($myrow5=$result5->fetch_assoc())
	} // if($result5->num_rows>0)
	echo "</table>";

	echo "</td></tr>";
//	End List of Dependents

//	Start Emergency contact details
//	need to join with tblcontact.contactid
//	echo "<tr><td colspan=2>&nbsp;</td></tr>";
//	echo "<tr valign=top><td colspan=2><i>Emergency Contact Details</i></td></tr>";
//	echo "<tr><td>&nbsp;</td><td>";
//	$result6 = mysql_query("SELECT * FROM tblempdependent WHERE employeeid='$pid'", $dbh);
//	while ($myrow6 = mysql_fetch_row($result6))
//	{
//	  echo "$myrow6[3] - $myrow6[5] - $myrow6[6]<br>";
//	}
//	echo "</td></tr>";
//	End Emergency contact details

	  echo "</table>";
	  echo "</div>";
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)
   

	} //  if($pid=='')
 
     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     echo "<div class='d-flex justify-content-end px-5 pt-5'>
	 			<form>
					<input type='button' value='Close Window' onClick='window.close()'>
				</form>
			</div>";

     include ("footer.php");

} else {

     include("logindeny.php");

}

// mysql_close($dbh);
$dbh2->close();
?> 