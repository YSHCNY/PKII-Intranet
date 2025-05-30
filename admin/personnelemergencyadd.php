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

	 echo "<tr><td bgcolor=blue colspan=2><b></b></td></tr>";

     if ($employeeid == '')
     {
	echo "<tr><td colspan=2><b>Sorry. No data available</b></td></tr>";
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

	echo "<div class = 'p-4 shadow mb-2'><h4>Edit Emergency Contact Details For: $name_last, $name_first $name_middle[0] ($employeeid) - $position</h4></div>";

     echo "<table class = 'table table-striped table-hover table-bordered table'>";
    

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
	echo "<input class = 'form-control' type=\"hidden\" name=\"em_contactid\" value=\"$em_contactid\">";
	echo "<tr><td align='right'>Name</td>";
	echo "<td><table><tr><td><input class = 'form-control' name=name_last value=\"$em_name_last\"></td><td><input class = 'form-control' name=name_first value=\"$em_name_first\"></td><td><input class = 'form-control' name=name_middle value=\"$em_name_middle\"></td></tr>";
	echo "<tr><td>LastName</td><td>FirstName</td><td>MiddleName</td></tr></table></td></tr>";
	echo "<tr><td align='right'>Relation</td><td><input class = 'form-control' name=emergrelation value=\"$em_emergrelation\"></td></tr>";

	echo "<tr><td align='right'>Address 1</td><td><textarea class = 'form-control' name=contact_address1 >$em_contact_address1</textarea></td></tr>";
	echo "<tr><td align='right'>Address 2</td><td><textarea class = 'form-control' name=contact_address2 >$em_contact_address2</textarea></td></tr>";
	echo "<tr><td align='right'>City</td><td><input class = 'form-control' name=contact_city value=\"$em_contact_city\"></td></tr>";
	echo "<tr><td align='right'>Province</td><td><input class = 'form-control' name=contact_province value=\"$em_contact_province\"></td></tr>";
	echo "<tr><td align='right'>Zip Code</td><td><input class = 'form-control' name=contact_zipcode value=$em_contact_zipcode></td></tr>";
	echo "<tr><td align='right'>Country</td><td><input class = 'form-control' name=contact_country value=\"$em_contact_country\"></td></tr>";

	echo "<tr><td align='right'>Landline1</td>";
	echo "<td><table><tr><td><input class = 'form-control' size=4 name=num_res1_cc value=$em_num_res1_cc></td><td><input class = 'form-control' size=5 name=num_res1_ac value=$em_num_res1_ac></td><td><input class = 'form-control' name=num_res1 value=\"$em_num_res1\"></td></tr>";
	echo "<tr><td>Country</td><td>Area</td><td>PhoneNumber</td></tr></table></td></tr>";

	echo "<tr><td align='right'>Mobile1</td><td><table><tr><td><input class = 'form-control' size=4 name=num_mobile1_cc value=$em_num_mobile1_cc></td><td><input class = 'form-control' size=5 name=num_mobile1_ac value=$em_num_mobile1_ac></td><td><input class = 'form-control' name=num_mobile1 value=\"$em_num_mobile1\"></td></tr>";
	echo "<tr><td>Country</td><td>Area</td><td>CellNumber</td></tr></table></td></tr>";

	echo "<tr><td align='right'>Mobile2</td><td><table><tr><td><input class = 'form-control' size=4 name=num_mobile2_cc value=$em_num_mobile2_cc></td><td><input class = 'form-control' size=5 name=num_mobile2_ac value=$em_num_mobile2_ac></td><td><input class = 'form-control' name=num_mobile2 value=\"$em_num_mobile2\"></td></tr>";
	echo "<tr><td>Country</td><td>Area</td><td>CellNumber</td></tr></table></td></tr>";

	echo "<tr><td align='right'>Email1</td><td><input class = 'form-control' name=email1 value=$em_email1></td></tr>";

        echo "<tr><td align='right'>Remarks</td><td><textarea class = 'form-control' name=remarks_contact value=$em_remarks_contact rows=3 cols=50>$em_remarks_contact</textarea></td></tr>";

	echo "</table>";
	echo "<div class = 'text-end'><a href=personneledit2.php?loginid=$loginid&pid=$employeeid class = 'mx-1 btn'>Back</a> <button type=submit class = 'btn mx-1 bg-success text-white'>Update</button></div>";

	echo"</form>";

// end edit emergency contact

     }
 
     echo "<p><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
