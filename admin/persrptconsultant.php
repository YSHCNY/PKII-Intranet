<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$employeetype = (isset($_POST['employeetype'])) ? $_POST['employeetype'] :'';
$employeeorder = (isset($_POST['employeeorder'])) ? $_POST['employeeorder'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> <a href=\"persrptmnu.php?loginid=$loginid\">HR Reports</a> >> List of Consultants</font></p>";

     echo "<table class=\"fin\" border=1>";
     echo "<tr><th colspan=12>List of Consultants</th></tr>";

     echo "<tr><td colspan=12>";

     echo "<form action=persrptconsultant.php?loginid=$loginid method=POST>";
     echo "<table><tr>";

     echo "<td valign=bottom><font size=1>Choose criteria</font><br>";
     echo "<select name=employeetype>";
     echo "<option value=active-consultants selected>Active Consultants</option>";
     echo "<option value=inactive-consultants>Inactive Consultants</option>";
     echo "<option value=all-consultants>All Consultants</option>";
     echo "</select></td>";

     echo "<td valign=bottom><font size=1>Sort by</font><br>";
     echo "<select name=employeeorder>";
     echo "<option value=tblcontact.employeeid>Employee Number</option>";
     echo "<option value=tblcontact.name_last selected>Last Name</option>";
     echo "<option value=tblcontact.name_first>First Name</option>";
     echo "<option value=tblemployee.emp_birthdate>Birthdate</option>";
     echo "<option value=tblemployee.date_hired>DateHired</option>";
     echo "</select></td>";

     echo "<td valign=bottom><button type='submit' class='btn btn-primary'>Go</button></td>";
     echo "</tr></table>";
     echo "</form>";

     echo "</td></tr>";

     if($employeetype == 'active-consultants') {
          $resquery="SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.num_mobile3_cc, tblcontact.num_mobile3_ac, tblcontact.num_mobile3, tblcontact.email1, tblcontact.email2, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.term_resign, tblempdetails.idhrpositionctg FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder";
     }
     else if($employeetype == 'inactive-consultants')
     {
          $resquery="SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.num_mobile3_cc, tblcontact.num_mobile3_ac, tblcontact.num_mobile3, tblcontact.email1, tblcontact.email2, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.term_resign, tblempdetails.idhrpositionctg FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' AND tblemployee.emp_record = 'inactive' ORDER BY $employeeorder";
     }
     else if($employeetype == 'all-consultants')
     {
	$resquery="SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.num_mobile3_cc, tblcontact.num_mobile3_ac, tblcontact.num_mobile3, tblcontact.email1, tblcontact.email2, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.term_resign, tblempdetails.idhrpositionctg FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' ORDER BY $employeeorder";
     }
    $result=$dbh2->query($resquery);

     echo "<tr><th colspan=12>Displaying list: <b>$employeetype</b> in <b>$employeeorder</b> order</th></tr>";
     echo "<tr><th>Count</th><th>EmpNum</th><th>LastName</th><th>FirstName</th><th>Middle</th><th>Gender</th><th>Address</th><th>Birthdate</th>";
     echo "<th>Landline(s)</th><th>Mobile(s)</th><th>e-mail(s)</th>";
     echo "<th>Position</th><th>Level</th><th>Salary Grade</th><th>Date Hired</th><th>Date Resigned</th><th>Status</th>";
     echo "<th>RefNum</th><th>Project</th><th>Position</th><th>Salary</th><th>Currency-Type</th><th>Incentives Allowance</th><th>Currency-Type</th><th>Project Allowance</th><th>Currency-Type</th><th>ECola1</th><th>Currency</th><th>ECola2</th><th>Currency</th><th>Field Allowance</th><th>Currency-Type</th><th>Accommodation Allowance</th><th>Currency-Type</th><th>Transportation Allowance</th><th>Currency-Type</th><th>Per diem</th><th>Currency</th><th>From</th><th>To</th>";
//     echo "<th>From2</th><th>To2</th>";
     echo "<th>Action</th></tr>";

     $count = 0;

    if($result->num_rows>0) {
        while($myrow=$result->fetch_assoc()) {
	$count = $count + 1;
	$pid = $myrow['employeeid'];
	$employeeid = $pid;

	$name_first = $myrow['name_first'];
	$name_last = $myrow['name_last'];
	$name_middle = $myrow['name_middle'];
	$contact_gender = $myrow['contact_gender'];
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

	$empposition = $myrow['empposition'];
	$emppositionlevel = $myrow['emppositionlevel'];
	$empsalarygrade = $myrow['empsalarygrade'];

	$emp_birthdate = $myrow['emp_birthdate'];
	$date_hired = $myrow['date_hired'];
	$emp_status = $myrow['emp_status'];
	$term_resign = $myrow['term_resign'];
	$idhrpositionctg = $myrow['idhrpositionctg'];

	// 20190506
	// $idhrpositionctg = $myrow[35];

	$found2 = 0;

	$res2query="SELECT DISTINCT employeeid, projdate, ref_no, proj_name, position, salary, salarycurrency, salarytype, allow_inc, allow_inc_currency, allow_inc_paytype, allow_proj, allow_proj_currency, allow_proj_paytype, ecola1, ecola1_currency, ecola2, ecola2_currency, allow_field_currency, allow_field_paytype, allow_field, allow_accomm, allow_accomm_currency, allow_accomm_paytype, allow_transpo, allow_transpo_currency, allow_transpo_paytype, perdiem, perdiem_currency, durationfrom, durationto, durationtotal, durationtotprop, durationfrom2, durationto2, duration2total, duration2totprop, idhrpositionctg FROM tblprojassign WHERE employeeid = '$pid' ORDER BY durationto ASC";
        $result2=$dbh2->query($res2query);
        if($result2->num_rows>0) {
            while($myrow2=$result2->fetch_assoc()) {
	  $found2 = 1;
	  $employeeid = $myrow2['employeeid'];
	  $projdate = $myrow2['projdate'];
	  $ref_no = $myrow2['ref_no'];
	  $proj_name = $myrow2['proj_name'];
	  $position = $myrow2['position'];
	  $salary = $myrow2['salary'];
	  $salarycurrency = $myrow2['salarycurrency'];
	  $salarytype = $myrow2['salarytype'];
	  $allow_inc = $myrow2['allow_inc'];
	  $allow_inc_currency = $myrow2['allow_inc_currency'];
	  $allow_inc_paytype = $myrow2['allow_inc_paytype'];
	  $allow_proj = $myrow2['allow_proj'];
	  $allow_proj_currency = $myrow2['allow_proj_currency'];
	  $allow_proj_paytype = $myrow2['allow_proj_paytype'];
	  $ecola1 = $myrow2['ecola1'];
	  $ecola1_currency = $myrow2['ecola1_currency'];
	  $ecola2 = $myrow2['ecola2'];
	  $ecola2_currency = $myrow2['ecola2_currency'];
	  $allow_field_currency = $myrow2['allow_field_currency'];
	  $allow_field_paytype = $myrow2['allow_field_paytype'];
	  $allow_field = $myrow2['allow_field'];
	  $allow_accomm = $myrow2['allow_accomm'];
	  $allow_accomm_currency = $myrow2['allow_accomm_currency'];
	  $allow_accomm_paytype = $myrow2['allow_accomm_paytype'];
	  $allow_transpo = $myrow2['allow_transpo'];
	  $allow_transpo_currency = $myrow2['allow_transpo_currency'];
	  $allow_transpo_paytype = $myrow2['allow_transpo_paytype'];
	  $perdiem = $myrow2['perdiem'];
	  $perdiem_currency = $myrow2['perdiem_currency'];
	  $durationfrom = $myrow2['durationfrom'];
	  $durationto = $myrow2['durationto'];
	  $durationtotal = $myrow2['durationtotal'];
	  $durationtotprop = $myrow2['durationtotprop'];
	  $durationfrom2 = $myrow2['durationfrom2'];
	  $durationto2 = $myrow2['durationto2'];
	  $duration2total = $myrow2['duration2total'];
	  $duration2totprop = $myrow2['duration2totprop'];
        $idhrpositionctg2 = $myrow2['idhrpositionctg'];
            } //while
        } //if

	echo "<tr><td>$count</td><td><a href=\"personnelmoreinfo.php?pid=$pid&loginid=$loginid\" target=\"_blank\">$employeeid</a></td>";
	echo "<td><a href=\"personnelmoreinfo.php?pid=$pid&loginid=$loginid\" target=\"_blank\"><b>$name_last</b></a></td><td><a href=\"personnelmoreinfo.php?pid=$pid&loginid=$loginid\" target=\"_blank\"><b>$name_first</b></a></td><td><a href=\"personnelmoreinfo.php?pid=$pid&loginid=$loginid\" target=\"_blank\">$name_middle</a></td><td>$contact_gender</td>";
	echo "<td>$contact_address1";
	if($contact_address2 <> '') { echo ", $contact_address2"; }
	if($contact_city <> '') { echo ", $contact_city"; }
	if($contact_province <> '') { echo ", $contact_province"; }
	if($contact_zipcode <> '') { echo ", $contact_zipcode"; }
	if($contact_country <> '') { echo ", $contact_country"; }
	echo "<td>".date("Y-M-d", strtotime($emp_birthdate))."</td>";
	echo "<td>";
	if($num_res1<>'') { echo "$num_res1_cc $num_res1_ac $num_res1"; }
	if(($num_res2<>'') && ($num_res1<>'')) { echo "<br>$num_res2_cc $num_res2_ac $num_res2"; }
	else if(($num_res2<>'') && ($num_res1=='')) { echo "$num_res2_cc $num_res2_ac $num_res2"; }
	echo "</td><td>";
	if($num_mobile1<>'') { echo "$num_mobile1_cc $num_mobile1_ac $num_mobile1"; }
	if(($num_mobile2<>'') && ($num_mobile1<>'')) { echo "<br>$num_mobile2_cc $num_mobile2_ac $num_mobile2"; }
	else if(($num_mobile2<>'') && ($num_mobile1=='')) { echo "$num_mobile2_cc $num_mobile2_ac $num_mobile2"; }
	echo "</td>";
	echo "<td>";
	if($email1<>'') { echo "<a href=mailto:$email1>$email1</a>"; }
	if(($email2<>'') && ($email1<>'')) { echo "<br><a href=mailto:$email2>$email2</a>"; }
	else if(($email2<>'') && ($email1=='')) { echo "<a href=mailto:$email2>$email2</a>"; }
	echo "</td>";

	// 20190506 requested by mcc
	if($idhrpositionctg!=0) {
	$res18query="SELECT code, name, deptcd FROM tblhrpositionctg WHERE idhrpositionctg=$idhrpositionctg LIMIT 1";
	$result18=""; $found18=0; $ctr18=0;
	$result18=$dbh2->query($res18query);
	if($result18->num_rows>0) {
		while($myrow18=$result18->fetch_assoc()) {
		$found18=1;
		$code18 = $myrow18['code'];
		$name18 = $myrow18['name'];
		$deptcd18 = $myrow18['deptcd'];
		echo "<td>$name18</td>";
		} // while($myrow18=$result18->fetch_assoc())
	} // if($result18->num_rows>0)
	} else {
	echo "<td>$empposition</td>";
	} // if-else

	echo "<td>$emppositionlevel</td><td>$empsalarygrade</td><td>$date_hired</td>";
	echo "<td>";
	if($term_resign <> '0000-00-00') { echo "$term_resign"; }
	echo "</td><td>$emp_status</td>";
// display latest proj assign details

        if($idhrpositionctg2!=0) {
        // query tblhrpositionctg
        $res18bquery=""; $result18b=""; $found18b=0;
        $res18bquery="SELECT code, name, deptcd FROM tblhrpositionctg WHERE idhrpositionctg=$idhrpositionctg2 LIMIT 1";
        $result18b=$dbh2->query($res18bquery);
        if($result18b->num_rows>0) {
            while($myrow18b=$result18b->fetch_assoc()) {
            $found18b=1;
            $code18b = $myrow18b['code'];
            $name18b = $myrow18b['name'];
            $deptcd18b = $myrow18b['deptcd'];
            } //while
        } //if
        if($found18b==1 && $name18b!="") {
        $positionprojfin = $name18b;
        } else {
        $positionprojfin="";
        } //if-else
        } else {
        $positionprojfin=$position;
        } //if-else

      if ($found2 == 1)
      {
	if($accesslevel>=5) {
	echo "<td>$ref_no</td><td>$proj_name</td>";
        echo "<td>$positionprojfin</td>";
	echo "<td>$salary</td><td>$salarycurrency $salarytype</td><td>$allow_inc</td><td>$allow_inc_currency $allow_inc_paytype</td><td>$allow_proj</td><td>$allow_proj_currency $allow_proj_paytype</td><td>$ecola1</td><td>$ecola1_currency</td><td>$ecola2</td><td>$ecola2_currency</td><td>$allow_field</td><td>$allow_field_currency $allow_field_paytype</td><td>$allow_accomm</td><td>$allow_accomm_currency $allow_accomm_paytype</td><td>$allow_transpo</td><td>$allow_transpo_currency $allow_transpo_paytype</td><td>$perdiem</td><td>$perdiem_currency</td>";
	echo "<td>$durationfrom</td><td>$durationto</td>";
	} else {
	echo "<td>$ref_no</td><td>$proj_name</td>";
        echo "<td>$positionprojfin</td>";
	echo "<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";
	echo "<td>$durationfrom</td><td>$durationto</td>";
	} // if($accesslevel>=5)
      }
      else
      {
	echo "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
      }
	echo "<td><a href = personnelmoreinfo.php?pid=$pid&loginid=$loginid target=_blank>More</a></td></tr>";

        } //while
    } //if

     echo "</table>"; 
   
     echo "<br><p><a href=persrptmnu.php?loginid=$loginid class='btn btn-default' role='button'>Back to HR Reports Menu</a><br>";

    $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
