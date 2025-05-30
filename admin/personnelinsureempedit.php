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
     ?>
<style>

</style>

     <?php
     
     include ("header.php");
     include ("sidebar.php");

     ?>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />


     <?php
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

     echo "<div class = 'shadow p-4 mb-3'>";

     $result12 = mysql_query("SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$employeeid\"", $dbh);
     while ($myrow12 = mysql_fetch_row($result12))
     {
	$found12 = 1;
	$name_last = $myrow12[0];
	$name_first = $myrow12[1];
	$name_middle = $myrow12[2];
     }
   


     echo "<h4>Edit Individual Policy Details For: <span class = 'fw-semibold'>$employeeid - $name_last, $name_first $name_middle[0]</span></h4>";
     
     echo "<p>Group Policy No.: $policynum</p>
     </div>";




     echo "<FORM METHOD=\"post\" ACTION=\"personnelinsureempedit2.php?loginid=$loginid&eid=$employeeid&ieid=$insuranceempid\">";
     echo "<table class = 'table table-striped table-hover table-bordered table-striped'>";
     echo "<tr><td align='right'>Effectivity Date</td><td>";

     echo "<input class = 'form-control' type ='date' name ='effectivedate' value = '$effectivedate'>";
     // include("dtpckpersonnelinsureempeffective.php");



     echo "<tr><td align='right'>From</td><td>";
     echo "<input class = 'form-control' type ='date' name ='fromdate' value = '$durationfrom'>";

     // include("dtpckpersonnelinsureempfrom.php");

     echo "</td></tr>";
     echo "<tr><td align='right'>To</td><td>";
     echo "<input class = 'form-control' type ='date' name ='todate' value = '$durationto'>";

     // include("dtpckpersonnelinsureempto.php");

     echo "</td></tr>";

     echo "<tr><td align='right'>Insurance Vendor (Company Name)</td>";
     echo "<td><input class = 'form-control' name=insurancename  value=\"$insurancename\"></td></tr>";

     echo "<tr><td align='right'>Individual Policy No.</td><td><input class = 'form-control' name=emppolicynum  value=\"$emppolicynum\"></td></tr>";

     echo "<tr><td align='right'>Project Name</td>";
     // echo "<td class ='projnamme'>$proj_code - $proj_sname - $proj_fname2 <a href=\"personnelinsureempeditchgproj.php?loginid=$loginid&eid=$employeeid&ieid=$insuranceempid&prjcd=$proj_code\">Change</a></td></tr>";

     $result14 = mysql_query("SELECT proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code=\"$proj_code\"", $dbh);

     while ($myrow14 = mysql_fetch_row($result14))
     {
       $found14 = 1;
       $proj_codeDisplay = $myrow14[0];
       $proj_fnameDisplay = $myrow14[1];
       $proj_snameDisplay = $myrow14[2];
       $proj_fname2Display = substr("$proj_fname", 0, 30);
     }

     echo "<td><select class = ' inputselect62' name='proj_code'>";
     // echo "<option value = '0' disabled selected>Select</option>";

	echo "<option value = '$proj_codeDisplay' selected>$proj_codeDisplay - $proj_snameDisplay - $proj_fnameDisplay</option>";


     // display selected/existing query while can be changed
	$result2 = mysql_query("SELECT proj_code, proj_fname, proj_sname FROM tblproject1", $dbh);
	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $found2 = 1;
	  $proj_code2 = $myrow2[0];
	  $proj_fname = $myrow2[1];
	  $proj_sname = $myrow2[2];
	  $proj_fname2 = substr("$proj_fname", 0, 50);

	  echo "<option name='proj_code' value='$proj_code2'>$proj_code2 - $proj_sname - $proj_fname2</option>";
	}
     echo "</select></td>";

     echo "<tr><td align='right'>Location</td><td><input class = 'form-control' name=location  value=\"$location\"></td></tr>";

     echo "<tr><td align='right'>Coverages</td>";
     echo "<td><textarea class = 'form-control' name=coverages>$coverages</textarea></td></tr>";

     echo "<tr><td align='right'>Remarks</td>";
     echo "<td><textarea class = 'form-control' name=remarks>$remarks</textarea></td></tr>";

     echo "</table>";

     echo "<div class = 'text-end'><a href=personneledit2.php?loginid=$loginid&pid=$employeeid class = 'btn'>Cancel</a><button class = 'btn bg-success text-white' TYPE=SUBMIT>Update</button></div>";    
     echo "</form>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);
?>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const element = document.querySelector('.inputselect62');
        new Choices(element, { searchEnabled: true });
    });

 
</script>
<?php
     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
