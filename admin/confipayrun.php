<?php 

require("db1.php");
include("datetimenow.php");
include("clsmcrypt.php");
include("addons");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");
?>
     <div class="text-center mb-5">
          <h2 class="poppins">Confidential Payroll</h2>
     </div>

     <div>
          <div class="text-center mb-3">
               <h3 class="poppins">Process Payroll Period</h3>
          </div>
     <?php
     if(substr($level, -6, 1) == 1) {
		$res0query="SELECT employeeid, accesslevel FROM tbladminlogin WHERE adminloginid=$loginid";
		$result0=""; $found0=0; $ctr0=0;
		$result0 = $dbh2->query($res0query);
		if($result0->num_rows>0) {
			while($myrow0 = $result0->fetch_assoc()) {
                    $found0 = 1;
                    $employeeid = $myrow0['employeeid'];
                    $accesslevel = $myrow0['accesslevel'];
			}
		}
     ?>
     <div class="text-center">
          <h6 class="poppins text-dark">Select Payroll Group:</h6>
          <form action="confipayrun2.php?loginid=<?php echo $loginid; ?>" method="POST" target="frame" class="d-flex align-items-center justify-content-center gap-2">
          <select name="groupname" class="poppins rounded-2" style="width: 100px; height: 35px;">
          <?php
               if($accesslevel == "5") {
               $resquery = "SELECT DISTINCT groupname, accesslevel FROM tblconfipaygrp WHERE accesslevel <= \"5\"";
               } elseif($accesslevel <= "4") {
               $resquery = "SELECT DISTINCT groupname, accesslevel FROM tblconfipaygrp WHERE accesslevel <= \"4\"";
               }
               $result = $dbh2->query($resquery);
               if($result->num_rows>0) {
               while($myrow = $result->fetch_assoc()) {
                    $groupname = $myrow['groupname'];
                    $confiaccesslevel = $myrow['accesslevel'];

                    if($confiaccesslevel >= 5 && $accesslevel >= 5) {
                         echo "<option value=\"$groupname\">";
                         include("mcryptdec.php");
                         echo "$groupname";
                         include("mcryptenc.php");
                         echo "</option>";
                    } else if($confiaccesslevel <= 4) {
                         echo "<option value=\"$groupname\">$groupname</option>";
                    }
               }
               }
           ?>
          </select>
          <input type="submit" value="Go" class="poppins btn btn-success">
          </form>
          <iframe src="blank3.htm" width="1000" height="600" name="frame" class="border border-1 border-black"></iframe>
     </div>
     <?php
     } else {
     ?>
     <div class="bg-danger-subtle border border-1 border-danger d-flex justify-content-center align-items-center gap-3 poppins rounded-2 shadow" style="height: 250px;">
          <i class="bi bi-info-circle-fill text-danger" style="font-size: 60px;"></i>
          <h2 class="m-0 text-danger">Sorry, you don't have access to this page.</h2>
     </div>
     <?php
     }
     ?>
     </div>

     <div class="d-flex justify-content-end mt-4">
          <a href="<?php echo 'confipay.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
               <button class="rounded-3 border border-1 px-3" style="height: 40px; background-color: #0a1d44;">Back to Custom Payroll Menu</button>
          </a>
     </div>
     <?php

     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?> 