
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
session_start();


echo "<div class = 'px-4'>";
echo "<div>Contract Reference Number: <input class = 'form-control' placeholder = 'Reference Number here...' name='ref_no'></div>";

echo "<div class = 'mt-3'>Project Code/Name:</div> ";
echo "<div><select class='inputselect' name=\"proj_code\">";
echo "<option value = ''>Select Project</option>";
$res2query = "SELECT * FROM tblproject1";
$result2=""; $found2=0;
$result2=$dbh2->query($res2query);
if($result2->num_rows>0) {
  while($myrow2=$result2->fetch_assoc()) {
  $found2 = 1;
  $proj_code = $myrow2['proj_code'];
  $proj_fname = $myrow2['proj_fname'];
  $proj_sname = $myrow2['proj_sname'];
  $proj_fname2 = substr("$proj_fname", 0, 50);
  echo "<option value=\"$proj_code\">$proj_code - $proj_sname - $proj_fname2</option>";
  } // while($myrow2=$result2->fetch_assoc())
} // if($result2->num_rows>0)
echo "</select></div>";

echo "<div class = 'mt-3'>Position";
// echo "<input size=30 name=position>";
echo "<select class = 'inputselect2' name=\"idhrpositionctg\">";
echo "<option value=0>-</option>";
$res3query="SELECT idhrpositionctg, code, name, deptcd FROM tblhrpositionctg ORDER BY name ASC";
$result3=""; $found3=0; $ctr3=0;
$result3=$dbh2->query($res3query);
if($result3->num_rows>0) {
  while($myrow3=$result3->fetch_assoc()) {
  $found3=1;
  $idhrpositionctg3 = $myrow3['idhrpositionctg'];
  $code3 = $myrow3['code'];
  $name3 = $myrow3['name'];
  $deptcd3 = $myrow3['name'];
  echo "<option value=\"$idhrpositionctg3\">$name3</option>";
  } // while($myrow3=$result3->fetch_assoc())
} // if($result3->num_rows>0)
echo "</select>";
echo "</div>";

echo "<div class = 'row mt-3'>";
echo "<div class = 'col'>Duration From";
echo "<input class = 'form-control' type=\"date\" name=\"datefrom\" value=\"$datenow\">";
echo "</div>";

echo "<div class = 'col'>Duration To";
echo "<input class = 'form-control' type=\"date\" name=\"dateto\" value=\"$datenow\">";

echo "</div>";
echo "</div>";


echo "</div>";


?>


<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const element = document.querySelector('.inputselect');
        new Choices(element, { searchEnabled: true });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const element = document.querySelector('.inputselect2');
        new Choices(element, { searchEnabled: true });
    });
</script>
</body>
</html>


