<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$contactid0 = $_GET['cid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
   include ("header.php");
   include ("sidebar.php");

   echo "<p><font size=1>Manage >> Business Contacts</font></p>";

   echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
   echo "<tr><th colspan=\"2\">PKII Business Directory - Edit personal contact</th><tr>";

  $result11 = mysql_query("SELECT contactid, loginid, companyid, employeeid, name_last, name_first, name_middle, contact_gender, picture, position, contact_address1, contact_address2, contact_city, contact_province, contact_zipcode, contact_country, num_res1_cc, num_res1_ac, num_res1, num_res2_cc, num_res2_ac, num_res2, num_mobile1_cc, num_mobile1_ac, num_mobile1, num_mobile2_cc, num_mobile2_ac, num_mobile2, num_mobile3_cc, num_mobile3_ac, num_mobile3, email1, email2, email3, url, remarks_contact, contact_type, supplierid, emergrelation, emergempid, proj_code, persempid, persrelation FROM tblcontact WHERE contactid=$contactid0", $dbh);
  if($result11 <> '')
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $contactid11 = $myrow11[0];
      $loginid11 = $myrow11[1];
      $companyid11 = $myrow11[2];
      $employeeid11 = $myrow11[3];
      $name_last11 = $myrow11[4];
      $name_first11 = $myrow11[5];
      $name_middle11 = $myrow11[6];
      $contact_gender11 = $myrow11[7];
      $picture11 = $myrow11[8];
      $position11 = $myrow11[9];
      $contact_address111 = $myrow11[10];
      $contact_address211 = $myrow11[11];
      $contact_city11 = $myrow11[12];
      $contact_province11 = $myrow11[13];
      $contact_zipcode11 = $myrow11[14];
      $contact_country11 = $myrow11[15];
      $num_res1_cc11 = $myrow11[16];
      $num_res1_ac11 = $myrow11[17];
      $num_res111 = $myrow11[18];
      $num_res2_cc11 = $myrow11[19];
      $num_res2_ac11 = $myrow11[20];
      $num_res211 = $myrow11[21];
      $num_mobile1_cc11 = $myrow11[22];
      $num_mobile1_ac11 = $myrow11[23];
      $num_mobile111 = $myrow11[24];
      $num_mobile2_cc11 = $myrow11[25];
      $num_mobile2_ac11 = $myrow11[26];
      $num_mobile211 = $myrow11[27];
      $num_mobile3_cc11 = $myrow11[28];
      $num_mobile3_ac11 = $myrow11[29];
      $num_mobile311 = $myrow11[30];
      $email111 = $myrow11[31];
      $email211 = $myrow11[32];
      $email311 = $myrow11[33];
      $url11 = $myrow11[34];
      $remarks_contact11 = $myrow11[35];
      $contact_type11 = $myrow11[36];
      $supplierid11 = $myrow11[37];
      $emergrelation11 = $myrow11[38];
      $emergempid11 = $myrow11[39];
      $proj_code11 = $myrow11[40];
      $persempid11 = $myrow11[41];
      $persrelation11 = $myrow11[42];
    }
  }

// contactid 	loginid 	companyid 	employeeid 	name_last 	name_first 	name_middle 	contact_gender 	picture 	position 	contact_address1 	contact_address2 	contact_city 	contact_province 	contact_zipcode 	contact_country 	num_res1_cc 	num_res1_ac 	num_res1 	num_res2_cc 	num_res2_ac 	num_res2 	num_mobile1_cc 	num_mobile1_ac 	num_mobile1 	num_mobile2_cc 	num_mobile2_ac 	num_mobile2 	num_mobile3_cc 	num_mobile3_ac 	num_mobile3 	email1 	email2 	email3 	url 	remarks_contact 	contact_type 	supplierid 	emergrelation 	emergempid 	proj_code 	persempid 	persrelation

  echo "<form METHOD=\"post\" ACTION=\"businesspersedit2.php?loginid=$loginid&cid=$contactid0\">";
  echo "<tr><td>type</td><td>";
  if($contact_type11 == 'supplier') { $contactsupplier = "selected"; }
  else if($contact_type11 == "client") { $contactclient = "selected"; }
  else if($contact_type11 == "project") { $contactproject = "selected"; }
  else if($contact_type11 == "partner") { $contactpartner = "selected"; }
  else if($contact_type11 == "personal") { $contactpersonal = "selected"; }
//  else if($contact_type11 == "emergency") { $contactemerg = "selected"; }
  else if($contact_type11 == "uncategorized") { $contactuncateg = "selected"; }
  echo "<select name=\"contact_type\">";
  echo "<option value=\"supplier\" $contactsupplier>supplier</option>";
  echo "<option value=\"client\" $contactclient>client</option>";
  echo "<option value=\"project\" $contactproject>project</option>";
  echo "<option value=\"partner\" $contactpartner>partner</option>";
  echo "<option value=\"personal\" $contactpersonal>personal</option>";
//  echo "<option value=\"emergency\" $contactemerg>emergency</option>";
  echo "<option value=\"uncategorized\" $contactuncateg>uncategorized</option>";
  echo "</select></td></tr>";

// select company if type = supplier or client
    echo "<tr><td>company_name</td><td>";
    echo "<select name=\"companyid\">";

  if($supplierid11 != "") {
    $result14 = mysql_query("SELECT companyid, company, branch, supplierid FROM tblcompany WHERE supplierid=\"$supplierid11\"", $dbh);
  } else if($companyid11 != "") {
    $result14 = mysql_query("SELECT companyid, company, branch, supplierid FROM tblcompany WHERE companyid=\"$companyid11\"", $dbh);
  } else {
    echo "<option>Select Company</option>";
  }
  if($result14 != ""); {
    while($myrow14 = mysql_fetch_row($result14)) {
      $found14 = 1;
      $companyid14 = $myrow14[0];
      $company14 = $myrow14[1];
      $branch14 = $myrow14[2];
      $supplierid14 = $myrow14[3];
      echo "<option value=\"$companyid14\">$company14 - $branch14 - $supplierid14</option>";
    }
  }

  $result17 = mysql_query("SELECT companyid, company, branch, supplierid FROM tblcompany WHERE company_type=\"supplier\" OR company_type=\"client\" ORDER BY company ASC", $dbh);
  if($result17 != ""); {
    while($myrow17 = mysql_fetch_row($result17)) {
      $found17 = 1;
      $companyid17 = $myrow17[0];
      $company17 = $myrow17[1];
      $branch17 = $myrow17[2];
      $supplierid17 = $myrow17[3];
      echo "<option value=\"$companyid17\">$company17 - $branch17 - $supplierid17</option>";
    }
  }
  echo "</select>";
  echo "</td></tr>";

// choose proj_code if type = project, partner or client
    echo "<tr><td>project_code</td>";
    echo "<td><select name=\"proj_code\">";

  if($proj_code11 <> '')
  {
    $result16 = mysql_query("SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code = '$proj_code11' ORDER BY proj_period DESC", $dbh);
    if($result16 <> '')
    {
      while($myrow16 = mysql_fetch_row($result16))
      {
        $found16 = 1;
        $projectid16 = $myrow16[0];
        $proj_code16 = $myrow16[1];
        $proj_fname16 = $myrow16[2];
        $proj_sname16 = $myrow16[3];
      }
      echo "<option value=\"$proj_code16\">$proj_code16 - $proj_sname16</option>";
    }
  }
  else
  {
    echo "<option value=\"\">Select Project</option>";
    $result15 = mysql_query("SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid <> '' ORDER BY proj_period DESC", $dbh);
    if($result15 <> '')
    {
      while($myrow15 = mysql_fetch_row($result15))
      {
        $found15 = 1;
        $projectid15 = $myrow15[0];
        $proj_code15 = $myrow15[1];
        $proj_fname15 = $myrow15[2];
        $proj_sname15 = $myrow15[3];
        echo "<option value=\"$proj_code15\">$proj_code15 - $proj_sname15</option>";
      }
    }
  }
  echo "</select></td></tr>";

// choose employeeid if type = personal
    echo "<tr><td>employeeid</td>";
    echo "<td>";
    echo "<select name=\"employeeid0\">";

  if($persempid11 != '')
  {
    $result16 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact WHERE persempid=\"$persempid11\"", $dbh);
    if($result16 != "")
    {
      while($myrow16 = mysql_fetch_row($result16))
      {
        $found16 = 1;
        $employeeid16 = $myrow16[0];
        $name_last16 = $myrow16[1];
        $name_first16 = $myrow16[2];
        $name_middle16 = $myrow16[3];
      }
      echo "<option value=\"$employeeid16\">$employeeid16 - $name_first16 $name_middle16[0] $name_last16</option>";
    }
  }
  else
  {
    echo "<option value=''>Select Personnel</option>";
  }
    $result16 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = \"personnel\" AND tblemployee.emp_record = \"active\" ORDER BY name_first ASC", $dbh);
    if($result16 != "")
    {
      while($myrow16 = mysql_fetch_row($result16))
      {
        $found16 = 1;
        $employeeid16 = $myrow16[0];
        $name_last16 = $myrow16[1];
        $name_first16 = $myrow16[2];
        $name_middle16 = $myrow16[3];
	// if($employeeid16 == $persempid11) { $persempidsel="selected"; } else { $persempidsel=""; }
        echo "<option value=\"$employeeid16\">$employeeid16 - $name_first16 $name_middle16[0] $name_last16</option>";
      }
    }
  echo "</select>";
  echo "</td></tr>";

// input relation to personnel if personal selected
  echo "<tr><td>relation to personnel</td><td><input name=\"persrelation\" value=\"$persrelation11\"></td></tr>";

  echo "<tr><td>fullname</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td><input name=\"name_first\" size=\"20\" value=\"$name_first11\"></td><td><input name=\"name_middle\" size=\"15\" value=\"$name_middle11\"></td><td><input name=\"name_last\" size=\"20\" value=\"$name_last11\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>first_name</i></font></td><td><font size=\"1\"><i>middle</i></font></td><td><font size=\"1\"><i>last_name</i></font></td></tr>";
  echo "</table></td></tr>";

  if($contact_gender11 == 'male') { $contgenmale = "selected"; }
  else if($contact_gender11 == 'female') { $contgenfemale = "selected"; }
  echo "<tr><td>gender</td><td>";
    echo "<select name=\"gender\">";
    echo "<option value=\"male\" $contgenmale>male</option>";
    echo "<option value=\"female\" $contgenfemale>female</option>";
    echo "</select>";
  echo "</td></tr>";

  echo "<tr><td>job_position</td><td><input name=\"position\" size=\"25\" value=\"$position11\"></td></tr>";
  echo "<tr><td>personal_address</td><td><input name=\"contact_address1\" value=\"$contact_address111\"></td></tr>";
  echo "<tr><td>&nbsp;</td><td><input name=\"contact_address2\" value=\"$contact_address211\"></td></tr>";
  echo "<tr><td>city</td><td><input name=\"contact_city\" value=\"$contact_city11\"></td></tr>";
  echo "<tr><td>state/province</td><td><input name=\"contact_province\" value=\"$contact_province11\"></td></tr>";
  echo "<tr><td>zip_code</td><td><input name=\"contact_zipcode\" size=\"8\" value=\"$contact_zipcode11\"></td></tr>";
  echo "<tr><td>country</td><td><input name=\"contact_country\" value=\"$contact_country11\"></td></tr>";
  echo "<tr><td>residence_tel1</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"num_res1_cc\" size=\"3\" value=\"$num_res1_cc11\"></td><td><input name=\"num_res1_ac\" size=\"4\" value=\"$num_res1_ac11\"></td><td><input name=\"num_res1\" size=\"8\" value=\"$num_res111\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>residence_tel2</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"num_res2_cc\" size=\"3\" value=\"$num_res2_cc11\"></td><td><input name=\"num_res2_ac\" size=\"4\" value=\"$num_res2_ac11\"></td><td><input name=\"num_res2\" size=\"8\" value=\"$num_res211\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>mobile1</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"num_mobile1_cc\" size=\"3\" value=\"$num_mobile1_cc11\"></td><td><input name=\"num_mobile1_ac\" size=\"4\" value=\"$num_mobile1_ac11\"></td><td><input name=\"num_mobile1\" size=\"8\" value=\"$num_mobile111\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>mobile2</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"num_mobile2_cc\" size=\"3\" value=\"$num_mobile2_cc11\"></td><td><input name=\"num_mobile2_ac\" size=\"4\" value=\"$num_mobile2_ac11\"></td><td><input name=\"num_mobile2\" size=\"8\" value=\"$num_mobile211\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>mobile3</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"num_mobile3_cc\" size=\"3\" value=\"$num_mobile3_cc11\"></td><td><input name=\"num_mobile3_ac\" size=\"4\" value=\"$num_mobile3_ac11\"></td><td><input name=\"num_mobile3\" size=\"8\" value=\"$num_mobile311\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>email1</td><td><input name=\"email1\" value=\"$email111\"></td></tr>";
  echo "<tr><td>email2</td><td><input name=\"email2\" value=\"$email211\"></td></tr>";
  echo "<tr><td>email3</td><td><input name=\"email3\" value=\"$email311\"></td></tr>";
  echo "<tr><td>website</td><td>http://<input name=\"url\" value=\"$url11\"></td></tr>";
  echo "<tr><td>remarks</td><td><textarea name=\"remarks_contact\" rows=\"3\" cols=\"30\">$remarks_contact11</textarea></td></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Submit\"></td></tr>";
  echo "</form>";

  echo "</table>"; 

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
