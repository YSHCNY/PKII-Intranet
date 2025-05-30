<?php 

require("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$confipaygrpid = $_GET['cpgid'];
$employeeid = $_POST['eid'];
$groupname = $_POST['gn'];

$projassignid10 = $_POST['projassignid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

	include("mcryptdec.php");

// query record
  $result11 = mysql_query("SELECT ref_no, proj_code, proj_name, position, salary, salarycurrency, salarytype, allow_inc, allow_inc_currency, allow_inc_paytype, allow_proj, allow_proj_currency, allow_proj_paytype, ecola1, ecola1_currency, ecola2, ecola2_currency, allow_field_currency, allow_field_paytype, allow_field, allow_accomm, allow_accomm_currency, allow_accomm_paytype, allow_transpo, allow_transpo_currency, allow_transpo_paytype, allow_comm, allow_comm_currency, allow_comm_paytype, perdiem, perdiem_currency, durationfrom, durationto, durationtotal, durationtotprop, durationfrom2, durationto2, duration2total, duration2totprop, durationprojassigntot, durationprojassigntotprop, term_resign, net_of_tax FROM tblprojassign WHERE employeeid=\"$employeeid\" AND projassignid=$projassignid10", $dbh);
  if($result11 != '') {
    while($myrow11 = mysql_fetch_row($result11)) {
    $found11 = 1;
    $ref_no11 = $myrow11[0];
    $proj_code11 = $myrow11[1];
    $proj_name11 = $myrow11[2];
    $position11 = $myrow11[3];
    $salary11 = $myrow11[4];
    $salarycurrency11 = $myrow11[5];
    $salarytype11 = $myrow11[6];
    $allow_inc11 = $myrow11[7];
    $allow_inc_currency11 = $myrow11[8];
    $allow_inc_paytype11 = $myrow11[9];
    $allow_proj11 = $myrow11[10];
    $allow_proj_currency11 = $myrow11[11];
    $allow_proj_paytype11 = $myrow11[12];
    $ecola111 = $myrow11[13];
    $ecola1_currency11 = $myrow11[14];
    $ecola211 = $myrow11[15];
    $ecola2_currency11 = $myrow11[16];
    $allow_field_currency11 = $myrow11[17];
    $allow_field_paytype11 = $myrow11[18];
    $allow_field11 = $myrow11[19];
    $allow_accomm11 = $myrow11[20];
    $allow_accomm_currency11 = $myrow11[21];
    $allow_accomm_paytype11 = $myrow11[22];
    $allow_transpo11 = $myrow11[23];
    $allow_transpo_currency11 = $myrow11[24];
    $allow_transpo_paytype11 = $myrow11[25];
    $allow_comm11 = $myrow11[26];
    $allow_comm_currency11 = $myrow11[27];
    $allow_comm_paytype11 = $myrow11[28];
    $perdiem11 = $myrow11[29];
    $perdiem_currency11 = $myrow11[30];
    $durationfrom11 = $myrow11[31];
    $durationto11 = $myrow11[32];
    $durationtotal11 = $myrow11[33];
    $durationtotprop11 = $myrow11[34];
    $durationfrom211 = $myrow11[35];
    $durationto211 = $myrow11[36];
    $duration2total11 = $myrow11[37];
    $duration2totprop11 = $myrow11[38];
    $durationprojassigntot11 = $myrow11[39];
    $durationprojassigntotprop11 = $myrow11[40];
    $term_resign11 = $myrow11[41];
    $net_of_tax11 = $myrow11[42];
    }
  }

	include("mcryptenc.php");

  $result12 = mysql_query("INSERT INTO tblconfipaymemproj SET timestamp=\"$now\", loginid=$loginid, employeeid=\"$employeeid\", groupname=\"$groupname\", proj_code=\"$proj_code11\", proj_name=\"$proj_name11\", position=\"$position11\", durationfrom=\"$durationfrom11\", durationto=\"$durationto11\", durationfrom2=\"$durationfrom211\", durationto2=\"$durationto211\", status=\"active\", confipaygrpid=$confipaygrpid", $dbh);

// create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Add or include project to custom payroll personnel info with details: empnum:$employeeid10 groupname-$groupname10 project:$proj_code11 $proj_name11";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  header("Location: confipay3.php?loginid=$loginid&cpgid=$confipaygrpid11");
  exit;

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);


//     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

