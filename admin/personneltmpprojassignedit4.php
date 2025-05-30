<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$projectassign0id = $_GET['pr0id'];
$employeeid = $_GET['eid'];
$projectassign0id = $_GET['pid'];

$employeeidnew = $_POST['employeeidnew'];
$employeeidnew2 = $_POST['employeeidnew2'];

$salaryremarks = $_POST['salaryremarks'];
$salary = $_POST['salary'];
$salarycurrency = $_POST['salarycurrency'];
$salarytype = $_POST['salarytype'];
$allow_inc = $_POST['allow_inc'];
$allow_inc_currency = $_POST['allow_inc_currency'];
$allow_inc_paytype = $_POST['allow_inc_paytype'];
$allow_proj = $_POST['allow_proj'];
$allow_proj_fin = $_POST['allow_proj_fin'];
$allow_proj_currency = $_POST['allow_proj_currency'];
$allow_proj_paytype = $_POST['allow_proj_paytype'];
$allow_field = $_POST['allow_field'];
$allow_field_currency = $_POST['allow_field_currency'];
$allow_field_paytype = $_POST['allow_field_paytype'];
$allow_accomm = $_POST['allow_accomm'];
$allow_accomm_currency = $_POST['allow_accomm_currency'];
$allow_accomm_paytype = $_POST['allow_accomm_paytype'];
$allow_transpo = $_POST['allow_transpo'];
$allow_transpo_currency = $_POST['allow_transpo_currency'];
$allow_transpo_paytype = $_POST['allow_transpo_paytype'];
$perdiem = $_POST['perdiem'];
$perdiem_fin = $_POST['perdiem_fin'];
$perdiem_currency = $_POST['perdiem_currency'];
$ecola1 = $_POST['ecola1'];
$ecola1_currency = $_POST['ecola1_currency'];
$ecola2 = $_POST['ecola2'];
$ecola2_currency = $_POST['ecola2_currency'];
$durationfrom = $_POST['durationfrom'];
$durationto = $_POST['durationto'];
$durationfrom2 = $_POST['durationfrom2'];
$durationto2 = $_POST['durationto2'];
$durationtotal = $_POST['durationtotal'];
$durationtotal_fin = $_POST['durationtotal_fin'];
$durationtotprop = $_POST['durationtotprop'];
$duration2total = $_POST['duration2total'];
$duration2totprop = $_POST['duration2totprop'];
$durationprojassigntot = $_POST['durationprojassigntot'];
$durationprojassigntotprop = $_POST['durationprojassigntotprop'];
$term_resign = $_POST['term_resign'];
$remarks = $_POST['remarks'];
$remarks2 = $_POST['remarks2'];

if ($salary == '')
{ $salary = 0.00; }
if ($allow_inc == '')
{ $allow_inc = 0.00; }
if ($allow_proj_fin == '')
{ $allow_proj_fin = 0.00; }
if ($allow_field == '')
{ $allow_field = 0.00; }
if ($allow_accomm == '')
{ $allow_accomm = 0.00; }
if ($perdiem_fin == '')
{ $perdiem_fin = 0.00; }

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit tmp.project assignment</font></p>";

  if ($employeeid == '')
  {
    $employeeid = $employeeidnew;
  }
  else if ($employeeid != $employeeidnew2)
  {
    $employeeid = $employeeidnew2;
  }

  echo "<p><font color=green><b>tmp.Project assignment updated!</b></font></p>";

  $result = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
  while ($myrow = mysql_fetch_row($result))
  {    
	$found = 1;
	$name_last = $myrow[1];
	$name_first = $myrow[2];
	$name_middle = $myrow[3];
  }
  if ($employeeid != '')
  {  echo "For: $employeeid - $name_last, $name_first $name_middle[0]</p>"; }
  else { echo "<font color=red>Warning: No assigned Employee Number for this record.<br>Please click the 'Back' link below and assign one.<br>Thank you.</font></p>"; }

  $result2 = mysql_query("UPDATE tblprojassign0 SET
	employeeid1 = '$employeeid', salaryremarks = '$salaryremarks', salary = $salary, salarycurrency = '$salarycurrency', salarytype = '$salarytype', allow_inc = '$allow_inc', allow_inc_currency = '$allow_inc_currency', allow_inc_paytype = '$allow_inc_paytype', allow_proj = '$allow_proj', allow_proj_fin = '$allow_proj_fin', allow_proj_currency = '$allow_proj_currency', allow_proj_paytype = '$allow_proj_paytype', allow_field = '$allow_field', allow_field_currency = '$allow_field_currency', allow_field_paytype = '$allow_field_paytype', allow_accomm = '$allow_accomm', allow_accomm_currency = '$allow_accomm_currency', allow_accomm_paytype = '$allow_accomm_paytype', allow_transpo = '$allow_transpo', allow_transpo_currency = '$allow_transpo_currency', allow_transpo_paytype = '$allow_transpo_paytype', perdiem = '$perdiem', perdiem_fin = '$perdiem_fin', perdiem_currency = '$perdiem_currency', ecola1 = '$ecola1', ecola1_currency = '$ecola1_currency', ecola2 = '$ecola2', ecola2_currency = '$ecola2_currency', durationfrom = '$durationfrom', durationto = '$durationto', durationfrom2 = '$durationfrom2', durationto2 = '$durationto2', durationtotal = '$durationtotal', durationtotal_fin = '$durationtotal_fin', durationtotprop = '$durationtotprop', duration2total = '$duration2total', duration2totprop = '$duration2totprop', durationprojassigntot = '$durationprojassigntot', durationprojassigntotprop = '$durationprojassigntotprop', term_resign = '$term_resign', remarks = '$remarks', remarks2 = '$remarks2'
	WHERE projectassign0id = $projectassign0id", $dbh) or die ("Couldn't execute query.".mysql_error());

  echo "Details:<br>";
  echo "employee#:$employeeid<br>";
  echo "salaryremarks:$salaryremarks<br>";
  echo "salary:$salary $salarycurrency $salarytype<br>";
  echo "allow_inc:$allow_inc $allow_inc_currency $allow_inc_paytype<br>";
  echo "allow_proj:$allow_proj<br>";
  echo "allow_proj_fin:$allow_proj_fin $allow_proj_currency $allow_proj_paytype<br>";
  echo "allow_field:$allow_field $allow_field_currency $allow_field_paytype<br>";
  echo "allow_accomm:$allow_accomm $allow_accomm_currency $allow_accomm_paytype<br>";
  echo "perdiem:$perdiem<br>";
  echo "perdiem_fin:$perdiem_fin $perdiem_currency<br>";
  echo "duration: from:$durationfrom to:$durationto total:$durationtotal $durationtotal_fin $durationtotprop<br>";
  echo "duration2: from2:$durationfrom2 to2:$durationto2 total:$duration2total $duration2totprop<br>";
  echo "totalprojectduration:$durationprojassigntot $durationprojassigntotprop<br>";
  echo "term_resign: $term_resign<br>";
  echo "remarks:$remarks<br>";
  echo "remarks2:$remarks2<br>";
  echo "Update Record - OK<br>";

  echo "<p><a href=personneltmpprojassignedit3.php?loginid=$loginid&eid=$employeeid&prjid=$projectassign0id>Back</a></p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

