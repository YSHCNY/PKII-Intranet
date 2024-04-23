<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$companyid = $_POST['companyid'];
if($companyid == "") { $companyid=null; }
$name_first = trim($_POST['name_first']);
$name_middle = trim($_POST['name_middle']);
$name_last = trim($_POST['name_last']);
$gender = $_POST['gender'];
$position = $_POST['position'];
$contact_address1 = $_POST['contact_address1'];
$contact_address2 = $_POST['contact_address2'];
$contact_city = $_POST['contact_city'];
$contact_province = $_POST['contact_province'];
$contact_zipcode = $_POST['contact_zipcode'];
$contact_country= $_POST['contact_country'];
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
$contact_type = $_POST['contact_type'];
$proj_code = $_POST['proj_code'];
if($proj_code == "") { $proj_code=null; }
$employeeid0 = $_POST['employeeid0'];
if($employeeid0 == "") { $employeeid0=null; }
$persrelation = $_POST['persrelation'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
  include ("header.php");
  include ("sidebar.php");

  if($accesslevel >= 4 && $accesslevel <= 5)
  {
    echo "<p><font size=1>Directory >> Business Contacts</font></p>";

    echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
    echo "<tr><th colspan=\"2\">PKII Business Directory - Add new personal contact</th><tr>";

    // check name if exists
    $result11 = 0;
    $result11 = mysql_query("SELECT contactid, name_last, name_first, name_middle FROM tblcontact WHERE name_last=\"$name_last\" AND name_first=\"$name_first\"", $dbh);
    if ($result11 != '')
    {
      while($myrow11 = mysql_fetch_row($result11))
      {
	$found11 = 1;
	$contactid11 = $myrow11[0];
	$name_last11 = $myrow11[1];
	$name_first11 = $myrow11[2];
	$name_middle11 = $myrow11[3];
      }
    }

    if($found11 == 1)
    {
      echo "<tr><td>Warning</td><td><font color=\"red\">Sorry, name already exists. Please try again.</font></td></tr>";
    }
    else
    {
// get supplierid
      $result14 = mysql_query("SELECT supplierid FROM tblcompany WHERE companyid=$companyid", $dbh);
      if($result14 != '')
      {
	while($myrow14 = mysql_fetch_row($result14))
	{ $found14 = 1; $supplierid14 = $myrow14[0]; }
      }

// insert new record
      $result12 = mysql_query("INSERT INTO tblcontact SET companyid=\"$companyid\", name_first=\"$name_first\", name_middle=\"$name_middle\", name_last=\"$name_last\", contact_gender=\"$gender\", position=\"$position\", contact_address1=\"$contact_address1\", contact_address2=\"$contact_address2\", contact_city=\"$contact_city\", contact_province=\"$contact_province\", contact_zipcode=\"$contact_zipcode\", contact_country=\"$contact_country\", num_res1_cc=\"$num_res1_cc\", num_res1_ac=\"$num_res1_ac\", num_res1=\"$num_res1\", num_res2_cc=\"$num_res2_cc\", num_res2_ac=\"$num_res2_ac\", num_res2=\"$num_res2\", num_mobile1_cc=\"$num_mobile1_cc\", num_mobile1_ac=\"$num_mobile1_ac\", num_mobile1=\"$num_mobile1\", num_mobile2_cc=\"$num_mobile2_cc\", num_mobile2_ac=\"$num_mobile2_ac\", num_mobile2=\"$num_mobile2\", num_mobile3_cc=\"$num_mobile3_cc\", num_mobile3_ac=\"$num_mobile3_ac\", num_mobile3=\"$num_mobile3\", email1=\"$email1\", email2=\"$email2\", email3=\"$email3\", url=\"$url\", remarks_contact=\"$remarks_contact\", contact_type=\"$contact_type\", supplierid=\"$supplierid14\", proj_code=\"$proj_code\", persempid=\"$employeeid0\", persrelation=\"$persrelation\"", $dbh);

// display new record
      echo "<tr><td>details</td><td>";
      echo "Saving...<br>";
      echo "name: $name_first $name_middle $name_last<br>";
      echo "$gender, $position, $companyid<br>";
      echo "address1: $contact_address1, $contact_address2, $contact_city, $contact_province, $contact_zipcode, $contact_country<br>";
      echo "telres1: $num_res1_cc $num_res1_ac $num_res1<br>";
      echo "telres2: $num_res2_cc $num_res2_ac $num_res2<br>";
      echo "mobile1: $num_mobile1_cc $num_mobile1_ac $num_mobile1<br>";
      echo "mobile2: $num_mobile2_cc $num_mobile2_ac $num_mobile2<br>";
      echo "mobile3: $num_mobile3_cc $num_mobile3_ac $num_mobile3<br>";
      echo "emails: $email1, $email2, $email3<br>";
      echo "url: $url<br>";
      echo "rem: $remarks_contact<br>";
      echo "type: $contact_type<br>";
      echo "</td></tr>";

      echo "<tr><td>status</td><td>";
      echo "<b>Saved.</b>";
      echo "</td></tr>";

      // create log
      include('datetimenow.php');
      $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
      while($myrow16 = mysql_fetch_row($result16))
      { $adminuid16=$myrow16[0]; }
      $adminlogdetails = "$loginid:$adminloginuid - add new personal contact record in business directory:$companyid - $name_first $name_middle $name_last";
      $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid16\", adminlogdetails=\"$adminlogdetails\"", $dbh);
    }

    echo "</table>"; 
  }

  echo "<p><a href=\"businessedit.php?loginid=$loginid\">Back</a><br>";
   
  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

  include ("footer.php");
}
else
{
  include ("logindeny.php");
}

mysql_close($dbh);
?>
