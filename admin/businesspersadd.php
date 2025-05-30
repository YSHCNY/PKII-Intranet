<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$found = 0;

?>
<script language="JavaScript" src="./js/auto_search.js"></script>
<?php

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
   echo "<tr><th colspan=\"2\">PKII Business Directory - Add new personal contact</th><tr>";

// contactid 	loginid 	companyid 	employeeid 	name_last 	name_first 	name_middle 	contact_gender 	picture 	position 	contact_address1 	contact_address2 	contact_city 	contact_province 	contact_zipcode 	contact_country 	num_res1_cc 	num_res1_ac 	num_res1 	num_res2_cc 	num_res2_ac 	num_res2 	num_mobile1_cc 	num_mobile1_ac 	num_mobile1 	num_mobile2_cc 	num_mobile2_ac 	num_mobile2 	num_mobile3_cc 	num_mobile3_ac 	num_mobile3 	email1 	email2 	email3 	url 	remarks_contact 	contact_type 	supplierid 	emergrelation 	emergempid

  echo "<form METHOD=\"post\" ACTION=\"businesspersadd2.php?loginid=$loginid\" name=\"bizpersaddform\">";
  echo "<tr><td>type</td><td>";
  echo "<select name=\"contact_type\">";
  echo "<option value=\"supplier\">supplier</option>";
  echo "<option value=\"client\">client</option>";
  echo "<option value=\"project\">project</option>";
  echo "<option value=\"partner\">partner</option>";
  echo "<option value=\"personal\">personal</option>";
//  echo "<option value=\"emergency\">emergency</option>";
  echo "<option value=\"uncategorized\">uncategorized</option>";
  echo "</select></td></tr>";

// select company if type = supplier or client
  echo "<tr><td>company_name</td><td>";
  echo "<select name=\"companyid\">";
  echo "<option value=\"\">Select Company</option>";
  $result11 = mysql_query("SELECT companyid, company, branch, supplierid FROM tblcompany WHERE company_type=\"supplier\" OR company_type=\"client\" ORDER BY company ASC", $dbh);
  if($result <> '');
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $companyid11 = $myrow11[0];
      $company11 = $myrow11[1];
      $branch11 = $myrow11[2];
      $supplierid11 = $myrow11[3];
      echo "<option value=\"$companyid11\">$company11 - $branch11 - $supplierid11</option>";
    }
  }
  echo "</select>";
  echo "</td></tr>";

// choose proj_code if type = project, partner or client
  echo "<tr><td>project_code</td>";
  echo "<td><select name=\"proj_code\">";
  echo "<option value=\"\">Select Project</option>";
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
  echo "<option value=\"\">Select Personnel</option>";
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

// input relation to personnel if personal selected
  echo "<tr><td>relation to personnel</td><td><input name=\"persrelation\"></td></tr>";

  echo "<tr><td>fullname</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td><input name=\"name_first\" size=\"20\" onkeyup=\"search(document.bizpersaddform.name_first.value, document.bizpersaddform.name_first, document.bizpersaddform.name_first0, document.getElementById('contentname_first'), namefirst, namefirstid)\">";
		echo "<input name=\"name_first0\" type=\"hidden\">";
		echo "<div id=\"contentname_first\">";
		echo "</div>";
		$result11b=""; $found11b=0; $ctr11b=0;
		$result11b = mysql_query("SELECT DISTINCT name_first FROM tblcontact WHERE name_first IS NOT NULL OR name_first != '' ORDER BY name_first ASC", $dbh);
		if($result11b != "") {
			while($myrow11b = mysql_fetch_row($result11b)) {
			$found11b=1;
			$name_first11b = $myrow11b[0];
			$namefirstid[$ctr11b] = "$ctr11b";
			$namefirst[$ctr11b] = "$name_first11b";
			$ctr11b = $ctr11b + 1;
			}
		}

		echo "</td><td><input name=\"name_middle\" size=\"15\" onkeyup=\"search(document.bizpersaddform.name_middle.value, document.bizpersaddform.name_middle, document.bizpersaddform.name_middle0, document.getElementById('contentname_middle'), namemiddle, namemiddleid)\">";
		echo "<input name=\"name_middle0\" type=\"hidden\">";
		echo "<div id=\"contentname_middle\">";
		echo "</div>";
		$result11c=""; $found11c=0; $ctr11c=0;
		$result11c = mysql_query("SELECT DISTINCT name_middle FROM tblcontact WHERE name_middle IS NOT NULL OR name_middle != '' ORDER BY name_middle ASC", $dbh);
		if($result11c != "") {
			while($myrow11c = mysql_fetch_row($result11c)) {
			$found11c=1;
			$name_middle11c = $myrow11c[0];
			$namemiddleid[$ctr11c] = "$ctr11c";
			$namemiddle[$ctr11c] = "$name_middle11c";
			$ctr11c = $ctr11c + 1;
			}
		}

		echo "</td><td><input name=\"name_last\" size=\"20\" onkeyup=\"search(document.bizpersaddform.name_last.value, document.bizpersaddform.name_last, document.bizpersaddform.name_last0, document.getElementById('contentname_last'), namelast, namelastid)\">";
		echo "<input name=\"name_last0\" type=\"hidden\">";
		echo "<div id=\"contentname_last\">";
		echo "</div>";
		$result11d=""; $found11d=0; $ctr11d=0;
		$result11d = mysql_query("SELECT DISTINCT name_last FROM tblcontact WHERE name_last IS NOT NULL OR name_last != '' ORDER BY name_last ASC", $dbh);
		if($result11d != "") {
			while($myrow11d = mysql_fetch_row($result11d)) {
			$found11d=1;
			$name_last11d = $myrow11d[0];
			$namelastid[$ctr11d] = "$ctr11d";
			$namelast[$ctr11d] = "$name_last11d";
			$ctr11d = $ctr11d + 1;
			}
		}

		echo "</td></tr>";
    echo "<tr><td><font size=\"1\"><i>first_name</i></font></td><td><font size=\"1\"><i>middle</i></font></td><td><font size=\"1\"><i>last_name</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>gender</td><td>";
    echo "<select name=\"gender\">";
    echo "<option value=\"male\">male</option>";
    echo "<option value=\"female\">female</option>";
    echo "</select>";
  echo "</td></tr>";
  echo "<tr><td>job_position</td><td><input name=\"position\" size=\"25\"></td></tr>";
  echo "<tr><td>personal_address</td><td><input name=\"contact_address1\"></td></tr>";
  echo "<tr><td>&nbsp;</td><td><input name=\"contact_address2\"></td></tr>";
  echo "<tr><td>city</td><td><input name=\"contact_city\"></td></tr>";
  echo "<tr><td>state/province</td><td><input name=\"contact_province\"></td></tr>";
  echo "<tr><td>zip_code</td><td><input name=\"contact_zipcode\" size=\"8\"></td></tr>";
  echo "<tr><td>country</td><td><input name=\"contact_country\"></td></tr>";
  echo "<tr><td>residence_tel1</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"num_res1_cc\" size=\"3\"></td><td><input name=\"num_res1_ac\" size=\"4\"></td><td><input name=\"num_res1\" size=\"8\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>residence_tel2</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"num_res2_cc\" size=\"3\"></td><td><input name=\"num_res2_ac\" size=\"4\"></td><td><input name=\"num_res2\" size=\"8\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>mobile1</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"num_mobile1_cc\" size=\"3\"></td><td><input name=\"num_mobile1_ac\" size=\"4\"></td><td><input name=\"num_mobile1\" size=\"8\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>mobile2</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"num_mobile2_cc\" size=\"3\"></td><td><input name=\"num_mobile2_ac\" size=\"4\"></td><td><input name=\"num_mobile2\" size=\"8\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>mobile3</td>";
    echo "<td><table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>+<input name=\"num_mobile3_cc\" size=\"3\"></td><td><input name=\"num_mobile3_ac\" size=\"4\"></td><td><input name=\"num_mobile3\" size=\"8\"></td></tr>";
    echo "<tr><td><font size=\"1\"><i>country</i></font></td><td><font size=\"1\"><i>area</i></font></td><td><font size=\"1\"><i>number</i></font></td></tr>";
  echo "</table></td></tr>";
  echo "<tr><td>email1</td><td><input name=\"email1\"></td></tr>";
  echo "<tr><td>email2</td><td><input name=\"email2\"></td></tr>";
  echo "<tr><td>email3</td><td><input name=\"email3\"></td></tr>";
  echo "<tr><td>website</td><td>http://<input name=\"url\"></td></tr>";
  echo "<tr><td>remarks</td><td><textarea name=\"remarks_contact\" rows=\"3\" cols=\"30\"></textarea></td></tr>";
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

var namefirstid = [
<?php
  foreach ($namefirstid as $value)
  {
       echo "$value,";
  }
  echo "0";
?>
];

var namefirst = [
<?php
  foreach ($namefirst as $value)
  {
       echo "\"$value\",";
  }
  echo "\"Select\"";
?>
];

var namemiddleid = [
<?php
  foreach ($namemiddleid as $value)
  {
       echo "$value,";
  }
  echo "0";
?>
];

var namemiddle = [
<?php
  foreach ($namemiddle as $value)
  {
       echo "\"$value\",";
  }
  echo "\"Select\"";
?>
];

var namelastid = [
<?php
  foreach ($namelastid as $value)
  {
       echo "$value,";
  }
  echo "0";
?>
];

var namelast = [
<?php
  foreach ($namelast as $value)
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
