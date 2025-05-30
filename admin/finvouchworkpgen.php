<?php

include("addons.php");
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

?>
<div class="shadow border border-1 rounded p-5">
<div class="w-100  mb-5">
     <h4 class=" text-black fw-semibold m-0">PKII Working Paper - Generate</h4>
</div>

<div>
     <form action="finvouchworkpgen2.php?loginid=<?php echo $loginid; ?>" method="post">
          <div class="d-flex justify-content-center align-items-center gap-3">
               <input name="wpgenyear" value="<?php echo $yearnow; ?>" class=" text-black border border-1 border-dark rounded-2 px-2" style="width: 120px; height: 35px;">
               <select name="wpgenmonth" class=" text-black border border-1 border-dark rounded-2" style="width: 120px; height: 35px;">
                    <option value="01" <?php if($monthnow == "01") echo "selected"; ?>>Jan</option>
                    <option value="02" <?php if($monthnow == "02") echo "selected"; ?>>Feb</option>
                    <option value="03" <?php if($monthnow == "03") echo "selected"; ?>>Mar</option>
                    <option value="04" <?php if($monthnow == "04") echo "selected"; ?>>Apr</option>
                    <option value="05" <?php if($monthnow == "05") echo "selected"; ?>>May</option>
                    <option value="06" <?php if($monthnow == "06") echo "selected"; ?>>Jun</option>
                    <option value="07" <?php if($monthnow == "07") echo "selected"; ?>>Jul</option>
                    <option value="08" <?php if($monthnow == "08") echo "selected"; ?>>Aug</option>
                    <option value="09" <?php if($monthnow == "09") echo "selected"; ?>>Sep</option>
                    <option value="10" <?php if($monthnow == "10") echo "selected"; ?>>Oct</option>
                    <option value="11" <?php if($monthnow == "11") echo "selected"; ?>>Nov</option>
                    <option value="12" <?php if($monthnow == "12") echo "selected"; ?>>Dec</option>
               </select>
               <input type="submit" value="Submit" class=" rounded-2 btn btn-success" style="width: 100px; height: 35px;">
          </div>
     </form>
</div>
<table class="table table-striped table-hover table-bordered">

<tr>
    <th colspan="4" class="  fs-2 fw-semibold py-4">List of Generated Working Papers</th>
</tr>
<tr>
    <th class=" fw-medium ">Year</th>
    <th class=" fw-medium ">Month</th>
    <th colspan="2" class=" fw-medium ">Action</th>
</tr>

<?php

$debitmonthtot = 0; 
$creditmonthtot = 0;

$result11 = mysql_query("SELECT DISTINCT month FROM tblfinworkpaper WHERE workpaperid<>'' ORDER BY month DESC", $dbh);

if($result11 != '')
{
  while($myrow11 = mysql_fetch_row($result11))
  {
     $found11 = 1;
     $month11 = $myrow11[0];

     $count1 = $count1 + 1;

     $cutarrmonth11 = split("-", $month11);
     $cutarryear = $cutarrmonth11[0];
     $cutarrmonth = $cutarrmonth11[1];

     $cutarrmonthname = date("F", strtotime($month11));
     ?>
     <tr>
          <td class="  align-middle"><?php echo $cutarryear; ?></td>
          <td class="  align-middle"><?php echo $cutarrmonthname; ?></td>
          <td colspan="2" class="  align-middle">
               <a href="finvouchworkpgendel.php?loginid=<?php echo $loginid; ?>&gd=<?php echo $month11; ?>" class="btn btn-danger btm-md" role="button">Del</a>
          </td>
     </tr>
     <?php
  }
}

?>

</table>
</div>

<div class="d-flex justify-content-end pt-5">
	<a href="<?php echo 'finvouchmain.php?loginid=' . $loginid ?>" class="text-white text-decoration-none  fw-medium fs-4">
		<button class="border-0 rounded-3" style="width: 170px; height: 40px; background-color: #0a1d44;">Back</button>
	</a>
</div>

<?php

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
    $result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>