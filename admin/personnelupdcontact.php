<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$pid = $_GET['pid'];
$employeeid = $pid;

$name_last = $_POST['name_last'];
$name_first = $_POST['name_first'];
$name_middle = $_POST['name_middle'];
$contact_gender = $_POST['contact_gender'];
$picture = $_POST['picture'];
$position = $_POST['position'];
$contact_address1 = $_POST['contact_address1'];
$contact_address2 = $_POST['contact_address2'];
$contact_city = $_POST['contact_city'];
$contact_province = $_POST['contact_province'];
$contact_zipcode = $_POST['contact_zipcode'];
$contact_country = $_POST['contact_country'];
$num_res1_cc = $_POST['num_res1_cc'];
$num_res1_ac = $_POST['num_res1_ac'];
$num_res1 = $_POST['num_res1'];
$num_res2_cc = $_POST['num_res2_cc'];
$num_res2_ac = $_POST['num_res2_ac'];
$num_res2 = $_POST['num_res2'];
$num_mobile1_cc = $_POST['num_mobile1_cc'];
$num_mobile1_ac = $_POST['num_mobile1_ac'];
$num_mobile1 = $_POST['num_mobile1'];
$num_mobile2_cc = $_POST['num_mobile2_cc'];
$num_mobile2_ac = $_POST['num_mobile2_ac'];
$num_mobile2 = $_POST['num_mobile2'];
$num_mobile3_cc = $_POST['num_mobile3_cc'];
$num_mobile3_ac = $_POST['num_mobile3_ac'];
$num_mobile3 = $_POST['num_mobile3'];
$email1 = $_POST['email1'];
$email2 = $_POST['email2'];
$email3 = $_POST['email3'];
$url = $_POST['url'];
$remarks_contact = $_POST['remarks_contact'];

$found = 0;
$found2 = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit contact info</font></p>";

  echo "<p><font color=green><b>Update successful!</b></font></p>";

	echo "<p>For: <b>$pid - $name_last, $name_first $name_middle[0]</b></p>";

	$result = mysql_query("UPDATE tblcontact SET name_last = '$name_last', name_first = '$name_first', name_middle = '$name_middle',
		contact_gender = '$contact_gender', picture = '$picture', position = '$position',
		contact_address1 = '$contact_address1', contact_address2 = '$contact_address2',
		contact_city = '$contact_city', contact_province = '$contact_province',
		contact_zipcode = '$contact_zipcode', contact_country = '$contact_country',
		num_res1_cc = '$num_res1_cc', num_res1_ac = '$num_res1_ac', num_res1 = '$num_res1',
		num_res2_cc = '$num_res2_cc', num_res2_ac = '$num_res2_ac', num_res2 = '$num_res2',
		num_mobile1_cc = '$num_mobile1_cc', num_mobile1_ac = '$num_mobile1_ac', num_mobile1 = '$num_mobile1',
		num_mobile2_cc = '$num_mobile2_cc', num_mobile2_ac = '$num_mobile2_ac', num_mobile2 = '$num_mobile2', 
		num_mobile3_cc = '$num_mobile3_cc', num_mobile3_ac = '$num_mobile3_ac', num_mobile3 = '$num_mobile3',
		email1 = '$email1', email2 = '$email2', email3 = '$email3', url = '$url', remarks_contact = '$remarks_contact'
	WHERE employeeid='$pid'", $dbh) or die ("Couldn't execute query.".mysql_error());

// 	echo "name_last = $name_last<br>";
// 	echo "name_first = $name_first<br>";
// 	echo "name_middle = $name_middle<br>";
// 	echo "contact_gender = $contact_gender<br>";
// 	echo "picture = $picture<br>";
// 	echo "position = $position<br>";
// 	echo "contact_address1 = $contact_address1<br>";
// 	echo "contact_address2 = $contact_address2<br>";
// 	echo "contact_city = $contact_city<br>";
// 	echo "contact_province = $contact_province<br>";
// 	echo "contact_zipcode = $contact_zipcode<br>";
// 	echo "contact_country = $contact_country<br>";
// 	echo "num_res1_cc = $num_res1_cc $num_res1_ac $num_res1<br>";
// 	echo "num_res2_cc = $num_res2_cc $num_res2_ac $num_res2<br>";
// 	echo "num_mobile1_cc = $num_mobile1_cc $num_mobile1_ac $num_mobile1<br>";
// 	echo "num_mobile2_cc = $num_mobile2_cc $num_mobile2_ac $num_mobile2<br>";
// 	echo "num_mobile3_cc = $num_mobile3_cc $num_mobile3_ac $num_mobile3<br>";
// 	echo "email1 = $email1<br>";
// 	echo "email2 = $email2<br>";
// 	echo "email3 = $email3<br>";
// 	echo "url = $url<br>";
// 	echo "remarks_contact = $remarks_contact<br>";
// 	echo "Update Record - OK<br>";

//   echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$pid>Back to Edit Personnel Info</a></p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

  $message = "Update Success!";
	$_SESSION['success_message'] = $message;
	echo "old: $pid";
	header("location: personneledit2.php?pid=$pid&loginid=$loginid");
	?>
	<script>
		const pid = encodeURIComponent("<?php echo $pid; ?>");
		const loginid = encodeURIComponent("<?php echo $loginid; ?>");
		window.location.href = `personneledit2.php?pid=${pid}&loginid=${loginid}`;
	</script>
	<?php
     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

