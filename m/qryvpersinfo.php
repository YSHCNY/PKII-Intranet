<?php
//
// qryvpersinfo.php
// fr: ./vc/ddash.php

// db conn string
include '../includes/dbh.php';

	$res11query="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.picture, tblcontact.position, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.num_mobile3_cc, tblcontact.num_mobile3_ac, tblcontact.num_mobile3, tblcontact.email1, tblcontact.email2, tblcontact.url, tblcontact.remarks_contact, tblcontact.picfn, tblemployee.emp_ref_num, tblemployee.date, tblemployee.date_hired, tblemployee.date_expired, tblemployee.emp_birthdate, tblemployee.emp_birthplace, tblemployee.emp_civilstatus, tblemployee.empeducationid, tblemployee.emp_num1, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_pagibig2, tblemployee.emp_gsis, tblemployee.emp_insuranceid, tblemployee.emp_emergencyid, tblemployee.emp_skills, tblemployee.emp_status, tblemployee.emp_remarks, tblemployee.employee_type, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.employeeid=\"$employeeid0\" AND tblcontact.contactid=$contactid0";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$name_last11=$myrow11['name_last'];
		$name_first11=$myrow11['name_first'];
		$name_middle11=$myrow11['name_middle'];
		$contact_gender11=$myrow11['contact_gender'];
		$picture11=$myrow11['picture'];
		$position=$myrow11['position'];
		$contact_address111=$myrow11['contact_address1'];
		$contact_address211=$myrow11['contact_address2'];
		$contact_city11=$myrow11['contact_city'];
		$contact_province11=$myrow11['contact_province'];
		$contact_zipcode11=$myrow11['contact_zipcode'];
		$contact_country11=$myrow11['contact_country'];
		$num_res1_cc11=$myrow11['num_res1_cc'];
		$num_res1_ac11=$myrow11['num_res1_ac'];
		$num_res111=$myrow11['num_res1'];
		$num_res2_cc11=$myrow11['num_res2_cc'];
		$num_res2_ac11=$myrow11['num_res2_ac'];
		$num_res211=$myrow11['num_res2'];
		$num_mobile1_cc11=$myrow11['num_mobile1_cc'];
		$num_mobile1_ac11=$myrow11['num_mobile1_ac'];
		$num_mobile111=$myrow11['num_mobile1'];
		$num_mobile2_cc11=$myrow11['num_mobile2_cc'];
		$num_mobile2_ac11=$myrow11['num_mobile2_ac'];
		$num_mobile211=$myrow11['num_mobile2'];
		$num_mobile3_cc11=$myrow11['num_mobile3_cc'];
		$num_mobile3_ac11=$myrow11['num_mobile3_ac'];
		$num_mobile311=$myrow11['num_mobile3'];
		$email111=$myrow11['email1'];
		$email211=$myrow11['email2'];
		$url11=$myrow11['url'];
		$remarks_contact11=$myrow11['remarks_contact'];
		$picfn11=$myrow11['picfn'];
		$emp_ref_num11=$myrow11['emp_ref_num'];
		$date11=$myrow11['date'];
		$date_hired11=$myrow11['date_hired'];
		$date_expired11=$myrow11['date_expired'];
		$emp_birthdate11=$myrow11['emp_birthdate'];
		$emp_birthplace11=$myrow11['emp_birthplace'];
		$emp_civilstatus11=$myrow11['emp_civilstatus'];
		$empeducationid11=$myrow11['empeducationid'];
		$emp_num111=$myrow11['emp_num1'];
		$emp_tin11=$myrow11['emp_tin'];
		$emp_sss11=$myrow11['emp_sss'];
		$emp_philhealth11=$myrow11['emp_philhealth'];
		$emp_pagibig11=$myrow11['emp_pagibig'];
		$emp_pagibig211=$myrow11['emp_pagibig2'];
		$emp_gsis11=$myrow11['emp_gsis'];
		$emp_insuranceid11=$myrow11['emp_insuranceid'];
		$emp_emergencyid11=$myrow11['emp_emergencyid'];
		$emp_skills11=$myrow11['emp_skills'];
		$emp_status11=$myrow11['emp_status'];
		$emp_remarks11=$myrow11['emp_remarks'];
		$employee_type11=$myrow11['employee_type'];
		$term_resign11=$myrow11['term_resign'];
		} // while
	} // if
	
	//Start of Employement Details
	
		$res3query = "SELECT empdepartment, empposition, emppositionlevel, empsalarygrade FROM tblempdetails WHERE employeeid='$employeeid0'";
		$result3="";
		$result3=$dbh->query($res3query);
		if($result3->num_rows>0) {
		while($myrow3=$result3->fetch_assoc()) {
		$found3 = 1;
		$department = $myrow3['empdepartment'];
		$position = $myrow3['position'];
		$positionlevel = $myrow3['emppositionlevel'];
		$salarygrade = $myrow3['empsalarygrade'];
		} // while($myrow3=$result3->fetch_assoc())
	} // if($result3->num_rows>0)
		
	//	End Employement details

//	Start Display project(s) involvement
		echo "<tr><td colspan=2>";
		echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
		
	 
	$res2query = "SELECT ref_no, projassignid, proj_code, proj_name, position, durationfrom, durationto, idhrpositionctg FROM tblprojassign WHERE employeeid='$employeeid0' ORDER BY durationfrom DESC";
	$result2=""; $found2=0; $ctr11=0;
	$result2=$dbh->query($res2query);
	/*if($result2->num_rows>0) {
		while($myrow2=$result2->fetch_assoc()) {
	  $ref_no = $myrow2['ref_no'];
	  $projectid = $myrow2['projassignid'];
	  $proj_code = $myrow2['proj_code'];
	  $proj_name = $myrow2['proj_name'];
	  $position = $myrow2['position'];
	  $durationfrom = $myrow2['durationfrom'];
	  $durationto = $myrow2['durationto'];
		$idhrpositionctg = $myrow2['idhrpositionctg'];*/
		
	//$result11=""; $found11=0; $ctr11=0; $data="";
	//$result11=$dbh->query($res11query);
	$ref_noArr=array();
	$projassignidArr=array();
	$proj_codeArr=array();
	$proj_nameArr=array();
	$positionArr=array();
	$date_fromArr=array();
	$date_toArr=array();
	$idhrpositionctgArr=array();
	if($result2->num_rows>0) {
		while($myrow2=$result2->fetch_assoc()) {
		$found2=1;
		array_push($ref_noArr, $myrow2['ref_no']);
		array_push($projassignidArr, $myrow2['projassignid']);
		array_push($proj_codeArr, $myrow2['proj_code']);
		array_push($proj_nameArr, $myrow2['proj_name']);
		array_push($positionArr, $myrow2['position']);
		array_push($date_fromArr, $myrow2['durationfrom']);
		array_push($date_toArr, $myrow2['durationto']);
		array_push($idhrpositionctgArr, $myrow2['idhrpositionctg']);
		
	// check if tblprojcdassign has related records
	$res5aquery = "SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projectid AND empid=\"$employeeid0\"";
	$result5a=""; $found5a=0;
	$result5a=$dbh->query($res5aquery);
	$projectid5aArr=array();
	$projcode5aArr=array();
	$projname5a=array();
	if($result5a->num_rows>0) {
		while($myrow5a=$result5a->fetch_assoc()) {
		$found5a=1;
		array_push($projectid5aArr, $myrow5a['projectid']);
		array_push($projcode5aArr, $myrow5a['projcode']);
		array_push($projname5aArr, $myrow5a['projname']);
		/*$projectid5a = $myrow5a['projectid'];
		$projcode5a = $myrow5a['projcode'];
		$projname5a = $myrow5a['projname'];*/
		//echo "<td align=\"center\"><font size=1>$projcode5a - $projname5a</td>";
		} // while($myrow5a=$result5a->fetch_assoc())
	} // if($result5a->num_rows>0)
	// echo "<td>$position</td>";
	
	$res8query="SELECT code, name, deptcd FROM tblhrpositionctg WHERE idhrpositionctg=$idhrpositionctg";
	$result8=""; $found8=0;
	$result8=$dbh->query($res8query);
	$code8Arr=array();
	$name8Arr=array();
	$deptcd8Arr=array();
	
	if($result8->num_rows>0) {
		while($myrow8=$result8->fetch_assoc()) {
		$found8=1;
		array_push($code8Arr, $myrow8['projectid']);
		array_push($name8Arr, $myrow8['projcode']);
		array_push($deptcd8Arr, $myrow8['projname']);
		
		} // while($myrow8=$result8->fetch_assoc())
	} // if($result8->num_rows>0)
		}
	}	
	
		
	// start tmp.project assignments
	$empprojctr = 0;
	$res9query = "SELECT projectassign0id, ref_no, proj_code, proj_name, position, durationfrom, durationto FROM tblprojassign0 WHERE employeeid1 = '$employeeid0' ORDER BY durationto DESC";
	$result9="";
	$result9=$dbh->query($res9query);
	if($result9->num_rows>0) {
		while($myrow9=$result9->fetch_assoc()) {
	  $found9 = 1;
	  $projectassign0id = $myrow9['projectiassign0id'];
	  $ref_no1 = $myrow9['ref_no'];
	  $proj_code1 = $myrow9['proj_code'];
	  $proj_name1 = $myrow9['proj_name'];
	  $position1 = $myrow9['position'];
	  $durationfrom1 = $myrow9['durationfrom'];
	  $durationto1 = $myrow9['durationto'];

	  //$empprojctr = $empprojctr + 1;

	  //echo "<tr><td>$ref_no</td><td>$proj_name</td><td>$position</td><td>$durationfrom -to- $durationto</td></tr>";
		} // while($myrow9=$result9->fetch_assoc())
	} // if($result9->num_rows>0)

	//echo "</table>";
	//echo "</td></tr>";
	// end tmp.project assignments
	
	// start insurance details
	
	$res11query = "SELECT insuranceempid, policynum, insurancename, emppolicynum, durationfrom, durationto, location FROM tblinsuranceemp WHERE employeeid=\"$employeeid0\" ORDER BY durationto DESC, durationfrom DESC";
	$result11="";
	$result11=$dbh->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
	  $insuranceempid = $myrow11['insuranceempid'];
	  $policynum = $myrow11['policynum'];
	  $insurancename = $myrow11['insurancename'];
	  $emppolicynum = $myrow11['emppolicynum'];
	  $durationfrom = $myrow11['durationfrom'];
	  $durationto = $myrow11['durationto'];
	  $location = $myrow11['location'];
	 // echo "<tr><td>$insurancename</td><td>$policynum</td><td>$emppolicynum</td><td>$durationfrom</td><td>$durationto</td><td>$location</td></tr>";
		} // while($myrow11=$result11->fetch_assoc())
	} // if($result11->num_rows>0)

	// end insurance details

	//start of prof license
	$res10query = "SELECT empproflicenseid, regulatoryboard, profession, licensenumber,licensedate FROM tblempproflicense WHERE employeeid='$employeeid0'";
	$result10=""; $found10=0; $ctr10=0;
	$result10=$dbh->query($res10query);
	if($result10->num_rows>0) {
		while($myrow10=$result10->fetch_assoc()) {
	  $empproflicenseid = $myrow10['empproflicenseid'];
	  $regulatoryboard = $myrow10['regulatoryboard'];
	  $profession = $myrow10['profession'];
	  $licensenumber = $myrow10['licensenumber'];
	  $licensedate = $myrow10['licensedate'];
		}
	}
	
	//start of educational background
	$res4query = "SELECT empeducationid, coursegraduated, yeargraduated, schoolgraduated, schooladdress FROM tblempeducation WHERE employeeid='$employeeid0'";
	$result4="";
	$result4=$dbh->query($res4query);
	if($result4->num_rows>0) {
		while($myrow4=$result4->fetch_assoc()) {
	  $empeducationid = $myrow4['empeducationid'];
	  $coursegraduated = $myrow4['coursegraduated'];
	  $yeargraduated = $myrow4['yeargraduated'];
	  $schoolgraduated = $myrow4['schoolgraduated'];
	  $schooladdress = $myrow4['schooladdress'];
		}
	}
	
	//start of bank account details
	$res6query = "SELECT bankacctid, bankid, contactid, bank_name, bank_branch, acct_name, acct_num, acct_type, acct_currency, bankacctremarks FROM tblbankacct WHERE employeeid = '$employeeid0'";
	$result6="";
	$result6=$dbh->query($res6query);
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
		}
	}
	
	//start of emergency info
	 $res7query = "SELECT contactid, name_last, name_first, name_middle, contact_address1, contact_address2, contact_city, contact_province, contact_zipcode, contact_country, num_res1_cc, num_res1_ac, num_res1, num_res2_cc, num_res2_ac, num_res2, num_mobile1_cc, num_mobile1_ac, num_mobile1, num_mobile2_cc, num_mobile2_ac, num_mobile2, email1, email2, emergrelation FROM tblcontact WHERE emergempid = '$employeeid0' AND contact_type = 'emergency'";
	$result7="";
	$result7=$dbh->query($res7query);
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
		
	//start pf dependents
	
	$res5query = "SELECT empdependentctr, dependentlast, dependentfirst, dependentmiddle, dependentbirthdate, dependentrelation FROM tblempdependent WHERE employeeid='$employeeid0'";
	$result5="";
	$result5=$dbh->query($res5query);
	if($result5->num_rows>0) {
		while($myrow5=$result5->fetch_assoc()) {
		$empdependentctr = $myrow5['empdependentctr'];
	  $dependentlast = $myrow5['dependentlast'];
	  $dependentfirst = $myrow5['dependentfirst'];
	  $dependentmiddle = $myrow5['dependentmiddle'];
	  $dependentbirthdate = $myrow5['dependentbirthdate'];
	  $dependentrelation = $myrow5['dependentrelation'];
		}
	}
	
// close database

$dbh->close();
?>
