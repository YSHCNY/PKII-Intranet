<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$pid = $_GET['eid'];


$empspouselast = $_POST['empspouselast'];
$empspousefirst = $_POST['empspousefirst'];
$empspousemiddle = $_POST['empspousemiddle'];
$empspousebirthdate = $_POST['empspousebirthdate'];


$empspouseemployer = $_POST['empspouseemployer'];
$empspouseemployeraddress = $_POST['empspouseemployeraddress'];
$empspouseemployertel1 = $_POST['empspouseemployertel1'];
$empspouseemployertel2 = $_POST['empspouseemployertel2'];
$empspouseeemployeremail = $_POST['empspouseemployeremail'];
$empspouseemployerperiodfr = $_POST['empspouseemployerperiodfr'];
$empspouseemployerperiodto = $_POST['empspouseemployerperiodto'];

$company_type = "spouse_employer";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{

     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit spouse details</font></p>";

  echo "<p><font color=green><b>Update successful!</b></font></p>";

	$result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
//	  $employeeid = $myrow0[0];
	  $name_last = $myrow0[1];
	  $name_first = $myrow0[2];
	  $name_middle = $myrow0[3];
	}

	echo "<p>For: <b>$employeeid - $name_last, $name_first $name_middle[0]</b></p>";

	$result0 = mysql_query("SELECT empspouseid, employeeid FROM tblempspouse WHERE employeeid=\"$employeeid\"", $dbh);
	if($result0 != '') {
	  while($myrow0 = mysql_fetch_row($result0)) {
	  $found0 = 1;
	  $empspouseid0 = $myrow0[0];
	  $employeeid0 = $myrow0[1];
	  }
	}
	if($found0 == 1) {
	  $result = mysql_query("UPDATE tblempspouse SET empspousebirthdate = '$empspousebirthdate', empspouselast = \"$empspouselast\", empspousefirst = \"$empspousefirst\", empspousemiddle = \"$empspousemiddle\" WHERE employeeid=\"$employeeid\"", $dbh) or die ("Couldn\'t execute query.".mysql_error());
	} else {
	  $result = mysql_query("INSERT INTO tblempspouse SET empspousebirthdate = '$empspousebirthdate', employeeid=\"$employeeid\", empspouselast = \"$empspouselast\", empspousefirst = \"$empspousefirst\", empspousemiddle = \"$empspousemiddle\"", $dbh) or die ("Couldn\'t execute query.".mysql_error());
	}

	echo "empspouselast:$empspouselast<br>";
	echo "empspousefirst:$empspousefirst<br>";
	echo "empspousefirst:$empspousemiddle<br>";

	$found11 = 0;
	$result11 = mysql_query("SELECT empspouseemployerid, employeeid, empspouseid, companyid FROM tblempspouseemployer WHERE employeeid=\"$employeeid\"", $dbh);
	if($result11 != "") {
	  while($myrow11 = mysql_fetch_row($result11)) {
	  $found11 = 1;
	  $empspouseemployerid11 = $myrow11[0];
//	  $employeeid11 = $myrow11[1];
	  $empspouseid11 = $myrow11[2];
	  $companyid11 = $myrow11[3];
	  }
	}

	if($found11 == 1) {
	  $result12 = mysql_query("UPDATE tblcompany SET employeeid=\"$employeeid\", company_type=\"$company_type\", company=\"$empspouseemployer\", ofc_address1=\"$empspouseemployeraddress\", ofc_num1=\"$empspouseemployertel1\", ofc_num2=\"$empspouseemployertel2\", ofc_email=\"$empspouseeemployeremail\" WHERE employeeid=\"$employeeid\" AND company_type=\"$company_type\"", $dbh);
	  $result14 = mysql_query("UPDATE tblempspouseemployer SET lastupdate=\"$now\", datefrom=\"$empspouseemployerperiodfr\", dateto=\"$empspouseemployerperiodto\" WHERE employeeid=\"$employeeid\"", $dbh);
	}
	else {
	  $result14 = mysql_query("INSERT INTO tblcompany SET employeeid=\"$employeeid\", company_type=\"$company_type\", company=\"$empspouseemployer\", ofc_address1=\"$empspouseemployeraddress\", ofc_num1=\"$empspouseemployertel1\", ofc_num2=\"$empspouseemployertel2\", ofc_email=\"$empspouseeemployeremail\"", $dbh);
	  $result15 = mysql_query("SELECT companyid FROM tblcompany WHERE company_type=\"$company_type\" AND employeeid=\"$employeeid\"", $dbh);
	  if($result15 != "") {
	    while($myrow15 = mysql_fetch_row($result15)) {
	      $found15 = 1;
	      $companyid15 = $myrow15[0];
	    }
	  }
	  $result16 = mysql_query("INSERT INTO tblempspouseemployer SET lastupdate=\"$now\", employeeid=\"$employeeid\", empspouseid=$empspouseid0, companyid=$companyid15, datefrom=\"$empspouseemployerperiodfr\", dateto=\"$empspouseemployerperiodto\"", $dbh);
	}

	// echo "employer:$empspouseemployer<br>";
	// echo "address:$empspouseemployeraddress<br>";
	// echo "contact:$empspouseemployertel1, $empspouseemployertel2, $empspouseeemployeremail<br>";
	// echo "period:$empspouseemployerperiodfr-$empspouseemployerperiodto<br>";
	// echo "Update Record - OK<br>";

    //  echo "<p><a href = personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel Info</a></p>";

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

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

