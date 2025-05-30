<?php 

require("db1.php");
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

<div class="text-center">
  <div class="text-center mb-3">
    <h3 class="poppins">Post-Process Tools</h3>
  </div>
<?php
  if(substr($level, -6, 1) == 1) {
		$res0query="SELECT employeeid, accesslevel FROM tbladminlogin WHERE adminloginid=$loginid";
		$result0=""; $found0=0; $ctr0=0;
		$result0=$dbh2->query($res0query);
		if($result0->num_rows>0) {
			while($myrow0=$result0->fetch_assoc()) {
			$found0 = 1;
			$employeeid = $myrow0['employeeid'];
			$accesslevel = $myrow0['accesslevel'];
			}
		}
?>

<form action="confipaytools2.php?loginid=<?php echo $loginid; ?>" method="POST" target="frame" name="confipaytools2">
    <h6 class="poppins text-dark">Select Payroll Group and Cutoff period:</h6>
    <div class="d-flex justify-content-center align-items-center gap-2">
      <select class="form-select" name="groupcut" class="poppins rounded-2" style="width: 300px; height: 35px;">
      <?php
      if($accesslevel == "5") {
        $resquery = "SELECT DISTINCT cutstart, cutend, groupname, accesslevel FROM tblconfipayroll WHERE accesslevel <= \"5\" ORDER BY groupname ASC, cutstart DESC";
      } else if($accesslevel <= "4") {
        $resquery = "SELECT DISTINCT cutstart, cutend, groupname, accesslevel FROM tblconfipayroll WHERE accesslevel <= \"4\" ORDER BY groupname ASC, cutstart DESC";
      }
      $result="";
      $result=$dbh2->query($resquery);
      if($result->num_rows>0) {
        while($myrow=$result->fetch_assoc()) {
      $cutstart = $myrow['cutstart'];
      $cutend = $myrow['cutend'];
      $groupname = $myrow['groupname'];
      $confiaccesslevel = $myrow['accesslevel'];
      if($confiaccesslevel==5) {
      echo "<option value=\"$groupname,$cutstart,$cutend\">";
        include("mcryptdec.php");
        echo "$groupname";
        echo ": $cutstart to $cutend</option>";
      } else if($confiaccesslevel<=4) {
      echo "<option value=\"$groupname,$cutstart,$cutend\">$groupname: $cutstart to $cutend</option>";
      }
        }
      }
      ?>
      </select>
      <button type="submit" class="poppins btn btn-success">Submit</button>
    </div>
</form>

<div>
  <iframe src="blank3.htm" width="1000" height="500" name="frame" class="border border-1 border-black"></iframe>
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