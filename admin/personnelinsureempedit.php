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
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Edit insurance policy</b></font></td></tr>";

     echo "<FORM METHOD=\"post\" ACTION=\"personnelinsureempedit2.php?loginid=$loginid&eid=$employeeid&ieid=$insuranceempid\">";

     $found11 = 0;

     $result11 = mysql_query("SELECT policynum, insurancename, emppolicynum, effectivedate, durationfrom, durationto, proj_code, proj_name, location, coverages, remarks FROM tblinsuranceemp WHERE insuranceempid=\"$insuranceempid\" AND employeeid=\"$employeeid\"", $dbh);

     while ($myrow11 = mysql_fetch_row($result11))
     {
	$found11 = 1;
	$policynum = $myrow11[0];
	$insurancename = $myrow11[1];
	$emppolicynum = $myrow11[2];
	$effectivedate = $myrow11[3];
	$durationfrom = $myrow11[4];
	$durationto = $myrow11[5];
	$proj_code = $myrow11[6];
	$proj_name = $myrow11[7];
	$location = $myrow11[8];
	$coverages = $myrow11[9];
	$remarks = $myrow11[10];
     }

     $arreffectivedate = split("-", $effectivedate);
     $effectiveyear = $arreffectivedate[0];
     $effectivemonth = $arreffectivedate[1];
     $effectiveday = $arreffectivedate[2];

     $arrfromdate = split("-", $durationfrom);
     $fromyear = $arrfromdate[0];
     $frommonth = $arrfromdate[1];
     $fromday = $arrfromdate[2];

     $arrtodate = split("-", $durationto);
     $toyear = $arrtodate[0];
     $tomonth = $arrtodate[1];
     $today = $arrtodate[2];

     echo "<tr><td align=center colspan=2>";
     echo "<i>Edit Individual Policy Details</i></td></tr>";

     $result12 = mysql_query("SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$employeeid\"", $dbh);
     while ($myrow12 = mysql_fetch_row($result12))
     {
	$found12 = 1;
	$name_last = $myrow12[0];
	$name_first = $myrow12[1];
	$name_middle = $myrow12[2];
     }
     echo "<tr><td colspan=2>For: <b>$employeeid - $name_last, $name_first $name_middle[0]</b></td></tr>";

     echo "<tr><td>Group Policy No.:</td><td><b>$policynum</b></td></tr>";

     echo "<tr><td>Effectivity Date</td><td>";

     include("dtpckpersonnelinsureempeffective.php");


     echo "<tr><td colspan=2 align=center><br>Period of Insurance</td></tr>";

     echo "<tr><td>From</td><td>";

     include("dtpckpersonnelinsureempfrom.php");

     echo "</td></tr>";

     echo "<tr><td>To</td><td>";

     include("dtpckpersonnelinsureempto.php");

     echo "</td></tr>";

     echo "<tr><td colspan=2><br>Insurance Vendor (Company Name)<br>";
     echo "<input name=insurancename size=50 value=\"$insurancename\"></td></tr>";

     echo "<tr><td>Individual Policy No.</td><td><input name=emppolicynum size=50 value=\"$emppolicynum\"></td></tr>";

     echo "<tr><td>Project Name</td>";

     $result14 = mysql_query("SELECT proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code=\"$proj_code\"", $dbh);

     while ($myrow14 = mysql_fetch_row($result14))
     {
       $found14 = 1;
       $proj_code = $myrow14[0];
       $proj_fname = $myrow14[1];
       $proj_sname = $myrow14[2];
       $proj_fname2 = substr("$proj_fname", 0, 30);
     }
     echo "<td>$proj_code - $proj_sname - $proj_fname2 <a href=\"personnelinsureempeditchgproj.php?loginid=$loginid&eid=$employeeid&ieid=$insuranceempid&prjcd=$proj_code\">Change</a></td></tr>";

     echo "<tr><td>Location</td><td><input name=location size=50 value=\"$location\"></td></tr>";

     echo "<tr><td>Coverages</td>";
     echo "<td><textarea rows=4 cols=50 name=coverages>$coverages</textarea></td></tr>";

     echo "<tr><td>Remarks</td>";
     echo "<td><textarea rows=4 cols=50 name=remarks>$remarks</textarea></td></tr>";

     echo "<tr><td colspan=2 align=center><INPUT TYPE=SUBMIT VALUE=\"Update\"></td></tr></table>";
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
