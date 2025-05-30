<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$contactid0 = $_GET['cid'];

$em_contactid = $_POST['em_contactid'];
$em_name_last = $_POST['name_last'];
$em_name_first = $_POST['name_first'];
$em_name_middle = $_POST['name_middle'];
$em_contact_address1 = $_POST['contact_address1'];
$em_contact_address2 = $_POST['contact_address2'];
$em_contact_city = $_POST['contact_city'];
$em_contact_province = $_POST['contact_province'];
$em_contact_zipcode = $_POST['contact_zipcode'];
$em_contact_country = $_POST['contact_country'];
$em_num_res1_cc = $_POST['num_res1_cc'];
$em_num_res1_ac = $_POST['num_res1_ac'];
$em_num_res1 = $_POST['num_res1'];
$em_num_mobile1_cc = $_POST['num_mobile1_cc'];
$em_num_mobile1_ac = $_POST['num_mobile1_ac'];
$em_num_mobile1 = $_POST['num_mobile1'];
$em_num_mobile2_cc = $_POST['num_mobile2_cc'];
$em_num_mobile2_ac = $_POST['num_mobile2_ac'];
$em_num_mobile2 = $_POST['num_mobile2'];
$em_email1 = $_POST['email1'];
$em_remarks_contact = $_POST['remarks_contact'];
$em_emergrelation = $_POST['emergrelation'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit emergency details</font></p>";

  echo "<p><font color=green><b>Update Emergency Contact Details Successful!</b></font></p>";

  $result = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
  while ($myrow = mysql_fetch_row($result))
  {    
	$found = 1;
	$name_last = $myrow[1];
	$name_first = $myrow[2];
	$name_middle = $myrow[3];
  }
  echo "<p>For: $employeeid - <b>$name_last, $name_first $name_middle[0]</b></p>";

  if ($em_contactid == '')
  {
	$result1 = mysql_query("INSERT INTO tblcontact (name_last, name_first, name_middle, contact_address1, contact_address2, contact_city, contact_province, contact_zipcode, contact_country, num_res1_cc, num_res1_ac, num_res1, num_mobile1_cc, num_mobile1_ac, num_mobile1, num_mobile2_cc, num_mobile2_ac, num_mobile2, email1, remarks_contact, contact_type, emergrelation, emergempid) VALUES ('$em_name_last', '$em_name_first', '$em_name_middle', '$em_contact_address1', '$em_contact_address2', '$em_contact_city', '$em_contact_province', '$em_contact_zipcode', '$em_contact_country', '$em_num_res1_cc', '$em_num_res1_ac', '$em_num_res1', '$em_num_mobile1_cc', '$em_num_mobile1_ac', '$em_num_mobile1', '$em_num_mobile2_cc', '$em_num_mobile2_ac', '$em_num_mobile2', '$em_email1', '$em_remarks_contact', 'emergency', '$em_emergrelation', '$employeeid')", $dbh) or die("Couldn't execute query.".mysql_eror());

  }
  else
  {
	$result2 = mysql_query("UPDATE tblcontact SET name_last='$em_name_last', name_first='$em_name_first', name_middle='$em_name_middle', contact_address1='$em_contact_address1', contact_address2='$em_contact_address2', contact_city='$em_contact_city', contact_province='$em_contact_province', contact_zipcode='$em_contact_zipcode', contact_country='$em_contact_country', num_res1_cc='$em_num_res1_cc', num_res1_ac='$em_num_res1_ac', num_res1='$em_num_res1', num_mobile1_cc='$em_num_mobile1_cc', num_mobile1_ac='$em_num_mobile1_ac', num_mobile1='$em_num_mobile1', num_mobile2_cc='$em_num_mobile2_cc', num_mobile2_ac='$em_num_mobile2_ac', num_mobile2='$em_num_mobile2', email1='$em_email1', remarks_contact='$em_remarks_contact', contact_type='emergency', emergrelation='$em_emergrelation', emergempid='$employeeid' WHERE contactid = $em_contactid", $dbh) or die("Couldn't execute query.".mysql_error());
  }

  // echo "Details:<br>id:$contactid0<br>";
  // echo "name_last=$em_name_last<br>";
  // echo "name_first=$em_name_first<br>";
  // echo "name_middle=$em_name_middle<br>";
  // echo "contact_address1=$em_contact_address1<br>";
  // echo "contact_address2=$em_contact_address2<br>";
  // echo "contact_city=$em_contact_city<br>";
  // echo "contact_province=$em_contact_province<br>";
  // echo "contact_zipcode=$em_contact_zipcode<br>";
  // echo "contact_country=$em_contact_country<br>";
  // echo "num_res1=$em_num_res1_cc $em_num_res1_ac $em_num_res1<br>";
  // echo "num_mobile1=$em_num_mobile1_cc $em_num_mobile1_ac $em_num_mobile1<br>";
  // echo "num_mobile2=$em_num_mobile2_cc $em_num_mobile2_ac $em_num_mobile2<br>";
  // echo "email1=$em_email1<br>";
  // echo "remarks_contact=$em_remarks_contact<br>";
  // echo "contact_type='emergency'<br>";
  // echo "emergrelation=$em_emergrelation<br>";
  // echo "emergempid=$employeeid<br>";
  // echo "Update Record - OK<br>";

  // echo "<p>";

  // echo "<a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel Info</a><br>";

  $message = "Emergency Details Added!";
  $_SESSION['success_message'] = $message;
?>

<script>
			const pid = encodeURIComponent("<?php echo $employeeid; ?>");
			const loginid = encodeURIComponent("<?php echo $loginid; ?>");
			window.location.href = `personneledit2.php?pid=${pid}&loginid=${loginid}`;
		</script>
          <?php

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

