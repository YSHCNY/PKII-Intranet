<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

<!-- Include JS -->


</head>
<body>

<?php 
     // echo "<FORM METHOD=\"post\" ACTION=\"personnelinsureempadd2.php?loginid=$loginid&eid=$employeeid\">";
    
  

echo "<div class = 'px-4'>";
echo "<div class = ''>";

echo "Group Policy No.:";
echo "<select class = 'inputselect6' name='policynum'>";
echo "<option value = '0' disabled selected>Select</option>";
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
echo "<option name='policynum' value=\"$policynum\">$durationfrom - $durationto - $insurancename - $policynum</option>";
}
echo "</select>";
echo "</div>";



echo "<div class = 'mt-3'>";

echo "Effectivity Date";
echo "<input class = 'form-control' type = 'date' name ='effdate' value = ''>";
// include("dtpckpersonnelinsureempeffective.php");
echo "</div>";


// echo "Period of Insurance";
echo "<div class = 'mt-3'>";

echo "From";
echo "<input class = 'form-control' type = 'date' name ='fromperiod' value = ''>";
echo "</div>";

// include("dtpckpersonnelinsureempfrom.php");

echo "";
echo "<div class = 'mt-3'>";

echo "To";
// include("dtpckpersonnelinsureempto.php");
echo "<input class = 'form-control' type = 'date' name ='toperiod' value = ''>";
echo "</div>";


echo "";
echo "<div class = 'mt-3'>";

echo "(Company Name)";
echo "<input class = 'form-control' name='insurancename2' >";
echo "</div>";

echo "<div class = 'mt-3'>";
echo "Individual Policy No.<input class = 'form-control' name='emppolicynum' >";
echo "</div>";

echo "<div class = 'mt-3'>";
echo "Project Name";
echo "<select class = 'inputselect7' name='proj_code'>";
echo "<option value = '0' disabled selected>Select</option>";


$result2 = mysql_query("SELECT proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code != ''", $dbh);
while ($myrow2 = mysql_fetch_row($result2))
{
  $found2 = 1;
  $proj_code2 = $myrow2[0];
  $proj_fname = $myrow2[1];
  $proj_sname = $myrow2[2];
  $proj_fname2 = substr("$proj_fname", 0, 50);

  echo "<option name='proj_code' value=\"$proj_code2\">$proj_code2 - $proj_sname - $proj_fname2</option>";
}
echo "</select>";
echo "</div>";

echo "<div class = 'mt-3'>";

echo "Location<input  class = 'form-control' name='location' >";
echo "<div class = 'mt-3'>";

echo "Coverages";
echo "<textarea class = 'form-control' name='coverages'></textarea>";
echo "</div>";

echo "<div class = 'mt-3'>";

echo "Remarks";
echo "<textarea class = 'form-control' name='remarks'></textarea>";
echo "</div>";

// echo "<INPUT TYPE=SUBMIT VALUE=\"Add new\">";

echo "</div>";
echo "</div>";


// echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel Info</a><br>";    

$result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

?> 
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const element = document.querySelector('.inputselect6');
        new Choices(element, { searchEnabled: true });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const element = document.querySelector('.inputselect7');
        new Choices(element, { searchEnabled: true });
    });
</script>
</body>
</html>
