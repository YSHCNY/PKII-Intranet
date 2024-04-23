<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$contactid = $_GET['cid'];

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

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Edit Emergency Contact Details</b></font></td></tr>";

     if ($employeeid == '')
     {
	echo "<tr><td colspan=2><font color=red><b>Sorry. No data available</b></font></td></tr>";
     }
     else
     {

	$result = mysql_query("SELECT name_last, name_first, name_middle, position FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow = mysql_fetch_row($result))
	{
	  $found = 1;
	  $name_last = $myrow[0];
	  $name_first = $myrow[1];
	  $name_middle = $myrow[2];
	  $position = $myrow[3];
	}

	echo "<tr><td colspan=2>For: $employeeid - <b>$name_last, $name_first $name_middle[0]</b> - $position</</td></tr>";

// start edit emergency contact

	$result = mysql_query("SELECT tblcontact.contactid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.email1, tblcontact.remarks_contact, tblcontact.emergrelation, tblcontact.emergempid FROM tblcontact WHERE tblcontact.contactid='$contactid' AND tblcontact.contact_type = 'emergency'", $dbh);
   
	while ($myrow = mysql_fetch_row($result))
	{
	  $em_contactid = $myrow[0];
	  $em_name_last = $myrow[1];
	  $em_name_first = $myrow[2];
	  $em_name_middle = $myrow[3];
	  $em_contact_address1 = $myrow[4];
	  $em_contact_address2 = $myrow[5];
	  $em_contact_city = $myrow[6];
	  $em_contact_province = $myrow[7];
	  $em_contact_zipcode = $myrow[8];
	  $em_contact_country = $myrow[9];
	  $em_num_res1_cc = $myrow[10];
	  $em_num_res1_ac = $myrow[11];
	  $em_num_res1 = $myrow[12];
	  $em_num_mobile1_cc = $myrow[13];
	  $em_num_mobile1_ac = $myrow[14];
	  $em_num_mobile1 = $myrow[15];
	  $em_num_mobile2_cc = $myrow[16];
	  $em_num_mobile2_ac = $myrow[17];
	  $em_num_mobile2 = $myrow[18];
	  $em_email1 = $myrow[19];
	  $em_remarks_contact = $myrow[20];
	  $em_emergrelation = $myrow[21];
	}

	echo "<form action=personnelemergencyedit2.php?loginid=$loginid&eid=$employeeid&cid=$contactid method=post>";
	echo "<input type=\"hidden\" name=\"em_contactid\" value=\"$em_contactid\">";
	echo "<tr><td>Name</td>";
	echo "<td><table border=0 spacing=1><tr><td><input name=name_last value=\"$em_name_last\"></td><td><input name=name_first value=\"$em_name_first\"></td><td><input name=name_middle value=\"$em_name_middle\"></td></tr>";
	echo "<tr><td><font size=1>LastName</font></td><td><font size=1>FirstName</font></td><td><font size=1>MiddleName</font></td></tr></table></td></tr>";
	echo "<tr><td>Relation</td><td><input name=emergrelation value=\"$em_emergrelation\"></td></tr>";

	echo "<tr><td>Address</td><td><textarea name=contact_address1 rows=2 cols=50>$em_contact_address1</textarea></td></tr>";
	echo "<tr><td></td><td><textarea name=contact_address2 rows=2 cols=50>$em_contact_address2</textarea></td></tr>";
	echo "<tr><td>City</td><td><input name=contact_city value=\"$em_contact_city\"></td></tr>";
	echo "<tr><td>Province</td><td><input name=contact_province value=\"$em_contact_province\"></td></tr>";
	echo "<tr><td>Zip Code</td><td><input name=contact_zipcode value=$em_contact_zipcode></td></tr>";
	echo "<tr><td>Country</td><td><input name=contact_country value=\"$em_contact_country\"></td></tr>";

	echo "<tr><td>Landline1</td>";
	echo "<td><table border=0 spacing=0><tr><td>+<input size=4 name=num_res1_cc value=$em_num_res1_cc></td><td><input size=5 name=num_res1_ac value=$em_num_res1_ac></td><td><input name=num_res1 value=\"$em_num_res1\"></td></tr>";
	echo "<tr><td><font size=1>Country</font></td><td><font size=1>Area</font></td><td><font size=1>PhoneNumber</font></td></tr></table></td></tr>";

	echo "<tr><td>Mobile1</td><td><table border=0 spacing=0><tr><td>+<input size=4 name=num_mobile1_cc value=$em_num_mobile1_cc></td><td><input size=5 name=num_mobile1_ac value=$em_num_mobile1_ac></td><td><input name=num_mobile1 value=\"$em_num_mobile1\"></td></tr>";
	echo "<tr><td><font size=1>Country</font></td><td><font size=1>Area</font></td><td><font size=1>CellNumber</font></td></tr></table></td></tr>";

	echo "<tr><td>Mobile2</td><td><table border=0 spacing=0><tr><td>+<input size=4 name=num_mobile2_cc value=$em_num_mobile2_cc></td><td><input size=5 name=num_mobile2_ac value=$em_num_mobile2_ac></td><td><input name=num_mobile2 value=\"$em_num_mobile2\"></td></tr>";
	echo "<tr><td><font size=1>Country</font></td><td><font size=1>Area</font></td><td><font size=1>CellNumber</font></td></tr></table></td></tr>";

	echo "<tr><td>Email1</td><td><input size=50 name=email1 value=$em_email1></td></tr>";

        echo "<tr><td>Remarks</td><td><textarea name=remarks_contact value=$em_remarks_contact rows=3 cols=50>$em_remarks_contact</textarea></td></tr>";

	echo "<tr><td>&nbsp</td><td><input type=submit value='Update Emergency Contact Details'></td></tr>";
	echo "</table></form>";

// end edit emergency contact

     }
 
     echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
