<?php 

include("db1.php");

$loginid = $_GET['loginid'];

?>
<script language="JavaScript" src="./js/auto_search.js"></script>
<?php

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
   include ("header.php");
   include ("sidebar.php");

   echo "<p><font size=1>Directory >> Business Contacts</font></p>";

   echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
   echo "<tr><th colspan=\"2\">PKII Business Directory - Add new</th><tr>";

// companyid  company   branch  ofc_address1  ofc_address2  ofc_city  ofc_province  ofc_zipcode   ofc_country   ofc_num1_cc   ofc_num1_ac   ofc_num1  ofc_num1_ext  ofc_num2_cc   ofc_num2_ac   ofc_num2  ofc_num2_ext  ofc_num3_cc   ofc_num3_ac   ofc_num3  ofc_num3_ext  ofc_fax_cc  ofc_fax_ac  ofc_fax   ofc_fax2_cc   ofc_fax2_ac   ofc_fax2  ofc_mobile_cc   ofc_mobile_ac   ofc_mobile  ofc_email   ofc_url   products  services  remarks_company   company_type  supplierid

  echo "<form action=\"businessadd2.php?loginid=$loginid\" method=\"post\" name=\"bizaddform1\">";

  echo "<tr><td>type</td><td>";
    echo "<select name=\"company_type\">";
    echo "<option value=\"supplier\">supplier</option>";
    echo "<option value=\"client\">client</option>";
    echo "<option value=\"partner\">partner</option>";
    echo "<option value=\"associate\">associate</option>";
    echo "<option value=\"project\">project</option>";
    echo "<option value=\"personal\">personal</option>";
    echo "<option value=\"uncategorized\">uncategorized</option>";
    echo "</select>";
  echo "</td></tr>";

// input supplierid if type = supplier
  echo "<tr><td>supplier_id</td><td><input name=\"supplierid\" size=\"8\"></td></tr>";

// choose proj_code if type = project, partner or client
  echo "<tr><td>project_code</td>";
  echo "<td><select name=\"proj_code\">";
  echo "<option value=\"-\">Select Project</option>";
  $result11 = mysql_query("SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid <> '' ORDER BY proj_period DESC", $dbh);
  if($result11 <> '')
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $projectid11 = $myrow11[0];
      $proj_code11 = $myrow11[1];
      $proj_fname11 = $myrow11[2];
      $proj_sname11 = $myrow11[3];
      echo "<option value=\"$proj_code11\">$proj_code11 - $proj_sname11</option>";
    }
  }
  echo "</select></td></tr>";

// choose employeeid if type = personal
  echo "<tr><td>employeeid</td>";
  echo "<td><select name=\"employeeid0\">";
  echo "<option value=\"-\">Select Personnel</option>";
  $result12 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = \"personnel\" AND tblemployee.emp_record = \"active\" ORDER BY name_first ASC", $dbh);
  if($result12 <> '')
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

  // echo "<tr><td>company_name</td><td><input name=\"company\"></td></tr>";
  echo "<tr><td>company_name</td><td>";
  echo "<input name=\"company\" onkeyup=\"search(document.bizaddform1.company.value, document.bizaddform1.company, document.bizaddform1.company0, document.getElementById('contentcompany'), comp, compid)\")>";
    echo "<input name=\"company0\" type=\"hidden\">";
    echo "<div id=\"contentcompany\">";
    echo "</div>";
    $result11b=""; $found11b=0; $ctr11b=0;
    $result11b = mysql_query("SELECT DISTINCT company FROM tblcompany WHERE company IS NOT NULL OR company != '' ORDER BY company ASC", $dbh);
    if($result11b != "") {
      while($myrow11b = mysql_fetch_row($result11b)) {
      $found11b=1;
      $company11b = $myrow11b[0];
      $compid[$ctr11b] = "$ctr11b";
      $comp[$ctr11b] = "$company11b";
      $ctr11b = $ctr11b + 1;
      }
    }
  echo "</td></tr>";

  echo "<tr><td>branch</td><td><input name=\"branch\"></td></tr>";
  echo "<tr><td>BIR TIN</td><td><input name=\"tin_number\"></td></tr>";
  echo "<tr><td>address</td><td><input name=\"ofc_address1\"></td></tr>";
  echo "<tr><td>&nbsp;</td><td><input name=\"ofc_address2\"></td></tr>";
  echo "<tr><td>city</td><td><input name=\"ofc_city\"></td></tr>";
  echo "<tr><td>state/province</td><td><input name=\"ofc_province\"></td></tr>";
  echo "<tr><td>zip_code</td><td><input name=\"ofc_zipcode\" size=\"8\"></td></tr>";
  echo "<tr><td>country</td><td><input name=\"ofc_country\"></td></tr>";
  echo "<tr><td>landline1</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"ofc_num1_cc\" size=\"3\"></td><td><input name=\"ofc_num1_ac\" size=\"4\"></td><td><input name=\"ofc_num1\" size=\"8\"></td><td><font size=\"1\">loc.</font><input name=\"ofc_num1_ext\" size=\"4\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td><td><font size=\"1\"><i>&nbsp;</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>landline2</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"ofc_num2_cc\" size=\"3\"></td><td><input name=\"ofc_num2_ac\" size=\"4\"></td><td><input name=\"ofc_num2\" size=\"8\"></td><td><font size=\"1\">loc.</font><input name=\"ofc_num2_ext\" size=\"4\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td><td><font size=\"1\"><i>&nbsp;</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>landline3</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"ofc_num3_cc\" size=\"3\"></td><td><input name=\"ofc_num3_ac\" size=\"4\"></td><td><input name=\"ofc_num3\" size=\"8\"></td><td><font size=\"1\">loc.</font><input name=\"ofc_num3_ext\" size=\"4\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td><td><font size=\"1\"><i>&nbsp;</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>fax1</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"ofc_fax_cc\" size=\"3\"></td><td><input name=\"ofc_fax_ac\" size=\"4\"></td><td><input name=\"ofc_fax\" size=\"8\"></td><td><font size=\"1\">loc.</font><input name=\"ofc_fax_ext\" size=\"4\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td><td><font size=\"1\"><i>&nbsp;</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>fax2</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"ofc_fax2_cc\" size=\"3\"></td><td><input name=\"ofc_fax2_ac\" size=\"4\"></td><td><input name=\"ofc_fax2\" size=\"8\"></td><td><font size=\"1\">loc.</font><input name=\"ofc_fax2_ext\" size=\"4\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td><td><font size=\"1\"><i>&nbsp;</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>mobile</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"ofc_mobile_cc\" size=\"3\"></td><td><input name=\"ofc_mobile_ac\" size=\"4\"></td><td><input name=\"ofc_mobile\" size=\"8\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>email</td><td><input name=\"ofc_email\"></td></tr>";
  echo "<tr><td>website</td><td>http://<input name=\"ofc_url\"></td></tr>";
  echo "<tr><td>products</td><td><textarea name=\"products\" rows=\"3\" cols=\"30\"></textarea></td></tr>";
  echo "<tr><td>services</td><td><textarea name=\"services\" rows=\"3\" cols=\"30\"></textarea></td></tr>";
  echo "<tr><td>remarks</td><td><textarea name=\"remarks_company\" rows=\"3\" cols=\"30\"></textarea></td></tr>";
/*  echo "<tr><td>contact person</td><td>";
    echo "<select name=\"contactid\">";
    
    echo "</select>";
  echo "</td></tr>"; */
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

?>

<SCRIPT type="text/javascript" language="JavaScript">

var compid = [
<?php
  foreach ($compid as $value)
  {
       echo "$value,";
  }
  echo "0";
?>
];

var comp = [
<?php
  foreach ($comp as $value)
  {
       echo "\"$value\",";
  }
  echo "\"Select\"";
?>
];

</SCRIPT>

<?php
mysql_close($dbh);
?>