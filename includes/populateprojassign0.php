<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection error" . mysql_errno() . " " . mysql_error());
mysql_select_db("maindb", $dbh) or die("Database Error" . mysql_errno() . " " . mysql_error());

$projdate = $_POST['projdate'];
$ref_no = $_POST['ref_no'];
$employeeid = $_POST['employeeid'];
$name_last = $_POST['name_last'];
$name_first = $_POST['name_first'];
$name_middle = $_POST['name_middle'];
$proj_name = $_POST['proj_name'];
$status = $_POST['status'];
$position = $_POST['position'];
$origdatehired = $_POST['origdatehired'];
$salaryremarks = $_POST['salaryremarks'];
$allow_inc = $_POST['allow_inc'];
$allow_proj = $_POST['allow_proj'];
$perdiem = $_POST['perdiem'];
$durationfrom = $_POST['durationfrom'];
$durationto = $_POST['durationto'];
$durationfrom2 = $_POST['durationfrom2'];
$durationto2 = $_POST['durationto2'];
$durationtotal = $_POST['durationtotal'];
$term_resign = $_POST['term_resign'];
$remarks = $_POST['remarks'];
$remarks2 = $_POST['remarks2'];

if ($allow_inc == '')
{ $allow_inc = 0.00; }
if ($allow_proj == '')
{ $allow_proj = 0.00; }
if ($perdiem == '')
{ $perdiem = 0.00; }


// if($name_first != "")
// {
//      $result = mysql_query("INSERT INTO tblprojassign0
// 	(projdate, ref_no, employeeid, name_last, name_first, name_middle,
// 	proj_name, status, position, origdatehired, salaryremarks,
// 	allow_inc, allow_proj, perdiem, durationfrom, durationto,
// 	durationfrom2, durationto2, remarks, remarks2)
// 	VALUES
// 	('$projdate', '$ref_no', '$employeeid', '$name_last', '$name_first', '$name_middle',
// 	'$proj_name', '$status', '$position', '$origdatehired', '$salaryremarks',
// 	$allow_inc, $allow_proj, $perdiem, '$durationfrom', '$durationto',
// 	'$durationfrom2', '$durationto2', '$remarks', '$remarks2')", $dbh); 
// }

      $result = mysql_query("INSERT INTO tblprojassign0
 	(projdate, ref_no, employeeid, name_last, name_first, name_middle,
 	proj_name, status, position, origdatehired, salaryremarks,
 	allow_inc, allow_proj, perdiem, durationfrom, durationto,
 	durationfrom2, durationto2, durationtotal, term_resign, remarks, remarks2)
 	VALUES
 	('$projdate', '$ref_no', '$employeeid', '$name_last', '$name_first', '$name_middle',
 	'$proj_name', '$status', '$position', '$origdatehired', '$salaryremarks',
 	$allow_inc, '$allow_proj', '$perdiem', '$durationfrom', '$durationto',
 	'$durationfrom2', '$durationto2', $durationtotal, '$term_resign', '$remarks', '$remarks2')", $dbh);

echo "<html><br>vartest populateprojassign0.php $projdate $ref_no $employeeid $name_last $name_first $name_middle $proj_name $status $position $origdatehired $salaryremarks $allow_inc $allow_proj $perdiem $durationfrom $durationto $durationfrom2 $durationto2 $durationtotal $term_resign $remarks $remarks2<br>";

echo "ok</html>";

mysql_close($dbh);
?> 
