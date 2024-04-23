<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die(mysql_error());
mysql_select_db("maindb", $dbh) or die(mysql_error());

$projdate = $_POST['projdate'];
$ref_no = $_POST['ref_no'];
$employeeid = $_POST['employeeid'];
$name_last = $_POST['name_last'];
$name_first = $_POST['name_first'];
$name_middle = $_POST['name_middle'];
$proj_name = $_POST['proj_name'];
$position = $_POST['position'];
$salaryremarks = $_POST['salaryremarks'];
$allow_inc = $_POST['allow_inc'];
$allow_proj = $_POST['allow_proj'];
$ecola1 = $_POST['ecola1'];
$ecola2 = $_POST['ecola2'];
$perdiem = $_POST['perdiem'];
$durationfrom = $_POST['durationfrom'];
$durationto = $_POST['durationto'];
$durationtotal = $_POST['durationtotal'];
$remarks = $_POST['remarks'];
$remarks2 = $_POST['remarks2'];

if ($allow_inc == '')
{ $allow_inc = 0.00; }
if ($allow_proj == '')
{ $allow_proj = 0.00; }
if ($ecola1 == '')
{ $ecola1 = 0.00; }
if ($ecola2 == '')
{ $ecola2 = 0.00; }
if ($perdiem == '')
{ $perdiem = 0.00; }

// if($name_first != "")
// {
     $result = mysql_query("INSERT INTO tblprojassign0
	(projdate, ref_no, employeeid, name_last, name_first, name_middle,
	proj_name, position, salaryremarks, allow_inc, allow_proj,
	ecola1, ecola2, perdiem, durationfrom, durationto, durationtotal, term_resign, remarks)
	VALUES
	('$projdate', '$ref_no', '$employeeid', '$name_last', '$name_first', '$name_middle',
	'$proj_name', '$position', '$salaryremarks', $allow_inc, '$allow_proj',
	'$perdiem', $ecola1, $ecola2, '$durationfrom', '$durationto', $durationtotal, '$term_resign', '$remarks')", $dbh); 
// }

echo "<html><br>vartest populateprojassign0b $projdate $ref_no $employeeid $name_last $name_first $name_middle $proj_name $position $salaryremarks $allow_inc $allow_proj $perdiem $ecola1 $ecola2 $durationfrom $durationto $durationtotal $term_resign $remarks<br>";

echo "ok</html>";

mysql_close($dbh);
?> 
