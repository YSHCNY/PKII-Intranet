<?php 

require("db1.php");
include("clsmcrypt.php");
include("addons");

$loginid = $_GET['loginid'];
$employeetype = $_POST['employeetype'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");
?>
<div class="text-center mb-5">
     <h2 class="poppins m-0">Custom Payroll</h2>
</div>
<div class="poppins">
<h2 class="poppins text-center">Personnel Data</h2>
<?php
  if(substr($level, -6, 1) == 1) {
     $result0 = mysql_query("SELECT employeeid, accesslevel FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
     while ($myrow0 = mysql_fetch_row($result0)) {
	     $found0 = 1;
	     $employeeid = $myrow0[0];
	     $accesslevel = $myrow0[1];
     }
?>

     <div class="text-center">
          <h4>Select Payroll Group:</h4>

     <form action="confipay2.php?loginid=<?php echo $loginid ?>" method="POST" target="frame">
          <select name="groupname" class="poppins bg-transparent text-black border border-1 border-black rounded-2" style="width: 200px; height: 35px;">

<?php
     if($accesslevel == "5") {
          $result1 = mysql_query("SELECT DISTINCT groupname, datecreated, accesslevel FROM tblconfipaygrp WHERE accesslevel <= '5'", $dbh); 
     } else if($accesslevel <= "4") {
         $result1 = mysql_query("SELECT DISTINCT groupname, datecreated, accesslevel FROM tblconfipaygrp WHERE accesslevel <= '4'", $dbh);
     }

     while ($myrow1 = mysql_fetch_row($result1)) {
          $found1 = 1;
          $groupname1 = $myrow1[0];
          $datecreated1 = $myrow1[1];
          $confiaccesslevel1 = $myrow1[2];
          if($confiaccesslevel1 >= 5 && $accesslevel >= 5) {
               $decrypted = $mcrypt->decrypt($groupname1);
               $decgrpnm = $decrypted;
               echo "<option value=\"$groupname1\">$decgrpnm &nbsp $datecreated1</option>";				
        } else if($confiaccesslevel1 <= 4) {
               echo "<option value=\"$groupname1\">$groupname1 &nbsp $datecreated1</option>";
        }
     }
?>
          </select>
          <input type="submit" value="Go" class="poppins btn btn-success fw-medium" style="width: 70px; height: 35px;">
     </form>
     </div>
     <div class="text-center">
          <iframe src="blank3.htm" width="100%" height="600" name="frame" class="border border-1 border-black rounded-3"></iframe>
     </div>
<?php
  } else {
?>
     <div class="bg-danger-subtle border border-1 border-danger d-flex justify-content-center align-items-center gap-3 poppins rounded-2 shadow" style="height: 250px;">
          <i style="font-size: 60px;" class="bi bi-info-circle-fill text-danger"></i>
          <h2 class="m-0 text-danger">Sorry, you don't have access to this page.</h2>
     </div>
<?php
  }
?>
<div class="d-flex justify-content-end mt-4">
     <a href="<?php echo 'confipay.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
          <button class="rounded-3 border border-1 px-3" style="height: 40px; background-color: #0a1d44;">Back to Custom Payroll Menu</button>
     </a>
</div>
<?php
     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>