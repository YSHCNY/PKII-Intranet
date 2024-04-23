<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$insuranceempid = $_GET['ieid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Manage Individual Insurance</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Add insurance policy</b></font></td></tr>";

     echo "<FORM METHOD=\"post\" ACTION=\"personnelinsureempadd2.php?loginid=$loginid&eid=$employeeid\">";

     $found11 = 0;

     echo "<tr><td align=center colspan=2>";
     echo "<i>Add Individual Insurance Policy</i></td></tr>";

     $result12 = mysql_query("SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$employeeid\"", $dbh);
     while ($myrow12 = mysql_fetch_row($result12))
     {
	$found12 = 1;
	$name_last = $myrow12[0];
	$name_first = $myrow12[1];
	$name_middle = $myrow12[2];
     }
     echo "<tr><td colspan=2>For: <b>$employeeid - $name_last, $name_first $name_middle[0]</b></td></tr>";

     echo "<tr><td>Group Policy No.:</td>";
     echo "<td><select name=policynum>";
     echo "<option>Select</option>";
     $found14 = 0;
     $result14 = mysql_query("SELECT empinsuranceid, policynum, companyid, insurancename, durationfrom, durationto FROM tblinsurance WHERE empinsuranceid != \"\" ORDER BY durationto DESC", $dbh);
     while ($myrow14 = mysql_fetch_row($result14))
     {
	$found14 = 1;
	$empinsuranceid = $myrow14[0];
	$policynum = $myrow14[1];
	$companyid = $myrow14[2];
	$insurancename = $myrow14[3];
	$durationfrom = $myrow14[4];
	$durationto = $myrow14[5];
	echo "<option name=policynum value=\"$policynum\">$durationfrom - $durationto - $insurancename - $policynum</option>";
     }
     echo "</select></td></tr>";

     echo "<tr><td>Effectivity Date</td><td>";

     include("dtpckpersonnelinsureempeffective.php");


     echo "<tr><td colspan=2 align=center><br>Period of Insurance</td></tr>";

     echo "<tr><td>From</td><td>";

     include("dtpckpersonnelinsureempfrom.php");

     echo "</td></tr>";

     echo "<tr><td>To</td><td>";

     include("dtpckpersonnelinsureempto.php");

     echo "</td></tr>";

     echo "<tr><td>Insurance Vendor<br>(Company Name)</td>";
     echo "<td><input name=insurancename2 size=50></td></tr>";

     echo "<tr><td>Individual Policy No.</td><td><input name=emppolicynum size=50></td></tr>";

     echo "<tr><td>Project Name</td>";

	echo "<td><select name=proj_code>";
	echo "<option>Select</option>";

	$result2 = mysql_query("SELECT proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code != ''", $dbh);
	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $found2 = 1;
	  $proj_code2 = $myrow2[0];
	  $proj_fname = $myrow2[1];
	  $proj_sname = $myrow2[2];
	  $proj_fname2 = substr("$proj_fname", 0, 50);

	  echo "<option name=proj_code value=\"$proj_code2\">$proj_code2 - $proj_sname - $proj_fname2</option>";
	}
     echo "</td></tr>";

     echo "<tr><td>Location</td><td><input name=location size=50></td></tr>";

     echo "<tr><td>Coverages</td>";
     echo "<td><textarea rows=4 cols=50 name=coverages></textarea></td></tr>";

     echo "<tr><td>Remarks</td>";
     echo "<td><textarea rows=4 cols=50 name=remarks></textarea></td></tr>";

     echo "<tr><td colspan=2 align=center><INPUT TYPE=SUBMIT VALUE=\"Add new\"></td></tr></table>";
     echo "</form>";

     echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel Info</a><br>";    

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
