<?php 

include("db1.php");

$loginid = (isset($_POST['loginid'])) ? $_POST['loginid'] :'';
$companyid = (isset($_POST['pid'])) ? $_POST['pid'] :'';

$found = 0;
// echo "<p>vartest lid:$loginid, cid:$companyid</p>";
if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
   include ("header.php");
   include ("sidebar.php");

   echo "<p><font size=1>Directory >> Business Contacts</font></p>";

   echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
   echo "<tr><th colspan=\"2\">PKII Business Directory - Edit</th><tr>";

  $result11 = mysql_query("SELECT companyid, company, branch, ofc_address1, ofc_address2, ofc_city, ofc_province, ofc_zipcode, ofc_country, ofc_num1_cc, ofc_num1_ac, ofc_num1, ofc_num1_ext, ofc_num2_cc, ofc_num2_ac, ofc_num2, ofc_num2_ext, ofc_num3_cc, ofc_num3_ac, ofc_num3, ofc_num3_ext, ofc_fax_cc, ofc_fax_ac, ofc_fax, ofc_fax2_cc, ofc_fax2_ac, ofc_fax2, ofc_mobile_cc, ofc_mobile_ac, ofc_mobile, ofc_email, ofc_url, products, services, remarks_company, company_type, supplierid, contactid, proj_code, employeeid, comptypassocrel, tin_number FROM tblcompany WHERE companyid=$companyid", $dbh);
  if($result11 <> '')
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $companyid11 = $myrow11[0];
      $company11 = $myrow11[1];
      $branch11 = $myrow11[2];
      $ofc_address111 = $myrow11[3];
      $ofc_address211 = $myrow11[4];
      $ofc_city11 = $myrow11[5];
      $ofc_province11 = $myrow11[6];
      $ofc_zipcode11 = $myrow11[7];
      $ofc_country11 = $myrow11[8];
      $ofc_num1_cc11 = $myrow11[9];
      $ofc_num1_ac11 = $myrow11[10];
      $ofc_num111 = $myrow11[11];
      $ofc_num1_ext11 = $myrow11[12];
      $ofc_num2_cc11 = $myrow11[13];
      $ofc_num2_ac11 = $myrow11[14];
      $ofc_num211 = $myrow11[15];
      $ofc_num2_ext11 = $myrow11[16];
      $ofc_num3_cc11 = $myrow11[17];
      $ofc_num3_ac11 = $myrow11[18];
      $ofc_num311 = $myrow11[19];
      $ofc_num3_ext11 = $myrow11[20];
      $ofc_fax_cc11 = $myrow11[21];
      $ofc_fax_ac11 = $myrow11[22];
      $ofc_fax11 = $myrow11[23];
      $ofc_fax2_cc11 = $myrow11[24];
      $ofc_fax2_ac11 = $myrow11[25];
      $ofc_fax211 = $myrow11[26];
      $ofc_mobile_cc11 = $myrow11[27];
      $ofc_mobile_ac11 = $myrow11[28];
      $ofc_mobile11 = $myrow11[29];
      $ofc_email11 = $myrow11[30];
      $ofc_url11 = $myrow11[31];
      $products11 = $myrow11[32];
      $services11 = $myrow11[33];
      $remarks_company11 = $myrow11[34];
      $company_type11 = $myrow11[35];
      $supplierid11 = $myrow11[36];
      $contactid11 = $myrow11[37];
      $proj_code11 = $myrow11[38];
      $employeeid11 = $myrow11[39];
			$comptypassocrel11 = $myrow11[40];
			$tin_number11 = $myrow11[41];
    }
  }
    echo "<div class='form-group'>";
  echo "<form METHOD=\"post\" ACTION=\"businessedit3.php?loginid=$loginid&cid=$companyid11\">";

  echo "<tr><th class='text-right'>type</th><td>";
  if($company_type11 == 'supplier') { $typesupplier = 'selected'; }
  else if($company_type11 == 'client') { $typeclient = 'selected'; }
  else if($company_type11 == 'partner') { $typepartner = 'selected'; }
  else if($company_type11 == 'associate') { $typeassociate = 'selected'; }
  else if($company_type11 == 'project') { $typeproject = 'selected'; }
  else if($company_type11 == 'personal') { $typepersonal = 'selected'; }
  else if($company_type11 == 'uncategorized') { $typeuncateg = 'selected'; }
    echo "<select name=\"company_type\" class='form-control'>";
    echo "<option value=\"supplier\" $typesupplier>supplier</option>";
    echo "<option value=\"client\" $typeclient>client</option>";
    echo "<option value=\"partner\" $typepartner>partner</option>";
    echo "<option value=\"associate\" $typeassociate>associate</option>";
    echo "<option value=\"project\" $typeproject>project</option>";
    echo "<option value=\"personal\" $typepersonal>personal</option>";
    echo "<option value=\"uncategorized\" $typeuncateg>uncategorized</option>";
    echo "</select>";
  echo "</td></tr>";

	if((($company_type11 != "") || ($company_type11 != "-")) && ($company_type11 == "associate")) {
		echo "<tr><th class='text-right'>assoc_relation</th>";
		if($comptypassocrel11 == "nkmain") { $assocrelnkmsel="selected"; $assocrelnkgsel=""; $assocrelothrsel=""; $assocrelnonesel=""; }
		else if($comptypassocrel11 == "nkgroup") { $assocrelnkmsel=""; $assocrelnkgsel="selected"; $assocrelothrsel=""; $assocrelnonesel=""; }
		else if($comptypassocrel11 == "others") { $assocrelnkmsel=""; $assocrelnkgsel=""; $assocrelothrsel="selected"; $assocrelnonesel=""; }
		else { $assocrelnkmsel=""; $assocrelnkgsel=""; $assocrelothrsel=""; $assocrelnonesel="selected"; }
		echo "<td><select name=\"assoc_relation\" class='form-control'>";
		echo "<option value=\"-\" $assocrelnonesel>-</option>";
		echo "<option value=\"nkmain\" $assocrelnkmsel>NK main</option>";
		echo "<option value=\"nkgroup\" $assocrelnkgsel>NK group</option>";
		echo "<option value=\"others\" $assocrelothrsel>others</option>";
		echo "</select>";
		echo "</td></tr>";
	}

// choose employeeid
	/*
  echo "<tr><td>employeeid : $employeeid11</td>";
  echo "<td><select name=\"employeeid\">";
  if($employeeid11 != "-" || $employeeid11 != "") {
    $result12 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.employeeid = \"$employeeid11\"", $dbh);
    if($result12 != "") {
      while($myrow12 = mysql_fetch_row($result12)) {
      $found12 = 1;
      $employeeid12 = $myrow12[0];
      $name_last12 = $myrow12[1];
      $name_first12 = $myrow12[2];
      $name_middle12 = $myrow12[3];
      echo "<option value=\"$employeeid12\">$employeeid12 - $name_first12 $name_middle12[0] $name_last12</option>";
      }
    }
  } else {
    echo "<option value=\"-\">Select Personnel</option>";
  }

  $result12 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = \"personnel\" AND tblemployee.emp_record = \"active\" ORDER BY name_first ASC", $dbh);
  echo "<option value=\"-\">Select Personnel</option>";
  if($result12 != "")
  {
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $employeeid12 = $myrow12[0];
      $name_last12 = $myrow12[1];
      $name_first12 = $myrow12[2];
      $name_middle12 = $myrow12[3];
      echo "<option value=\"$employeeid12\">$employeeid12 - $name_first12 $name_middle12[0] $name_last12</option>";
    }
  } 
  echo "</select></td></tr>";
	*/

  echo "<tr><th class='text-right'>supplier_id</th><td><input type='text' class='form-control' name=\"supplierid\" size=\"20\" value=\"$supplierid11\"></td></tr>";

  echo "<tr><th class='text-right'>company_name</th><td><input type='text' class='form-control' name=\"company\" value=\"$company11\"></td></tr>";
  echo "<tr><th class='text-right'>branch</th><td><input type='text' class='form-control' name=\"branch\" value=\"$branch11\"></td></tr>";
  echo "<tr><th class='text-right'>BIR TIN</th><td><input class='form-control' name=\"tin_number\" value=\"$tin_number11\"></td></tr>";
  echo "<tr><th class='text-right'>address</th><td><input type='text' class='form-control' name=\"ofc_address1\" value=\"$ofc_address111\"></td></tr>";
  echo "<tr><td>&nbsp;</td><td><input type='text' class='form-control' name=\"ofc_address2\" value=\"$ofc_address211\"></td></tr>";
  echo "<tr><th class='text-right'>city</th><td><input class='form-control' name=\"ofc_city\" value=\"$ofc_city11\"></td></tr>";
  echo "<tr><th class='text-right'>state/province</th><td><input class='form-control' name=\"ofc_province\" value=\"$ofc_province11\"></td></tr>";
  echo "<tr><th class='text-right'>zip_code</th><td><input class='form-control' name=\"ofc_zipcode\" size=\"8\" value=\"$ofc_zipcode11\"></td></tr>";
  echo "<tr><th class='text-right'>country</th><td><input class='form-control' name=\"ofc_country\" value=\"$ofc_country11\"></td></tr>";
  echo "<tr><th class='text-right'>landline1</th>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td><input class='form-control' name=\"ofc_num1_cc\" size=\"3\" value=\"$ofc_num1_cc11\"></td><td><input class='form-control' name=\"ofc_num1_ac\" size=\"4\" value=\"$ofc_num1_ac11\"></td><td><input class='form-control' name=\"ofc_num1\" size=\"8\" value=\"$ofc_num111\"></td><td><input class='form-control' name=\"ofc_num1_ext\" size=\"4\" value=\"$ofc_num1_ext11\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td><td><font size=\"1\"><i>loc.</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><th class='text-right'>landline2</th>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td><input class='form-control' name=\"ofc_num2_cc\" size=\"3\" value=\"$ofc_num2_cc11\"></td><td><input class='form-control' name=\"ofc_num2_ac\" size=\"4\" value=\"$ofc_num2_ac11\"></td><td><input class='form-control' name=\"ofc_num2\" size=\"8\" value=\"$ofc_num211\"></td><td><input class='form-control' name=\"ofc_num2_ext\" size=\"4\" value=\"$ofc_num2_ext11\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td><td><font size=\"1\"><i>loc.</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><th class='text-right'>landline3</th>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td><input class='form-control' name=\"ofc_num3_cc\" size=\"3\" value=\"$ofc_num3_cc11\"></td><td><input class='form-control' name=\"ofc_num3_ac\" size=\"4\" value=\"$ofc_num3_ac11\"></td><td><input class='form-control' name=\"ofc_num3\" size=\"8\" value=\"$ofc_num311\"></td><td><input class='form-control' name=\"ofc_num3_ext\" size=\"4\" value=\"$ofc_num3_ext11\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td><td><font size=\"1\"><i>loc.</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><th class='text-right'>fax1</th>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td><input class='form-control' name=\"ofc_fax_cc\" size=\"3\" value=\"$ofc_fax_cc11\"></td><td><input class='form-control' name=\"ofc_fax_ac\" size=\"4\" value=\"$ofc_fax_ac11\"></td><td><input class='form-control' name=\"ofc_fax\" size=\"8\" value=\"$ofc_fax11\"></td><td><input class='form-control' name=\"ofc_fax_ext\" size=\"4\" value=\"$ofc_fax_ext11\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td><td><font size=\"1\"><i>loc.</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><th class='text-right'>fax2</th>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td><input class='form-control' name=\"ofc_fax2_cc\" size=\"3\" value=\"$ofc_fax2_cc11\"></td><td><input class='form-control' name=\"ofc_fax2_ac\" size=\"4\" value=\"$ofc_fax2_ac11\"></td><td><input class='form-control' name=\"ofc_fax2\" size=\"8\" value=\"$ofc_fax211\"></td><td><input class='form-control' name=\"ofc_fax2_ext\" size=\"4\" value=\"$ofc_fax2_ext11\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td><td><font size=\"1\"><i>loc.</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><th class='text-right'>mobile</th>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td><input class='form-control' name=\"ofc_mobile_cc\" size=\"3\" value=\"$ofc_mobile_cc11\"></td><td><input class='form-control' name=\"ofc_mobile_ac\" size=\"4\" value=\"$ofc_mobile_ac11\"></td><td><input class='form-control' name=\"ofc_mobile\" size=\"8\" value=\"$ofc_mobile11\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><th class='text-right'>email</th><td><input class='form-control' type='email' name=\"ofc_email\" value=\"$ofc_email11\"></td></tr>";
  echo "<tr><th class='text-right'>website</th><td><input class='form-control' name=\"ofc_url\" value=\"$ofc_url11\"></td></tr>";
  echo "<tr><th class='text-right'>products</th><td><textarea class='form-control' name=\"products\" rows=\"3\" cols=\"30\">$products11</textarea></td></tr>";
  echo "<tr><th class='text-right'>services</th><td><textarea class='form-control' name=\"services\" rows=\"3\" cols=\"30\">$services11</textarea></td></tr>";
  echo "<tr><th class='text-right'>remarks</th><td><textarea class='form-control' name=\"remarks_company\" rows=\"3\" cols=\"30\">$remarks_company11</textarea></td></tr>";
//  echo "<tr><td>contact person</td><td>";
//    echo "<select name=\"contactid\">";
//    
//    echo "</select>";
//  echo "</td></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><button type=\"submit\" class='btn btn-success'>Submit</button></td></tr>";
  echo "</form>";
	echo "</div>";

  echo "</table>"; 

  echo "<p><a href=\"businessedit.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a><br>";
   
  $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);	

  include ("footer.php");
} else {
  include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>