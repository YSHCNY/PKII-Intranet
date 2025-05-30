<?php 

include("db1.php");
include("datetimenow.php");
include("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] : '';
$wpgenyear = (isset($_POST['wpgenyear'])) ? $_POST['wpgenyear'] : '';
$wpgenmonth = (isset($_POST['wpgenmonth'])) ? $_POST['wpgenmonth'] : '';
$wpgendate = $wpgenyear . "-" . $wpgenmonth;
$wpgenmonthname = date("F", mktime(0, 0, 0, $wpgenmonth));
$found = 0;

if ($loginid != "") {
    include("logincheck.php");
}  

if ($found == 1) {
    include ("header.php");
    include ("sidebar.php");
?>

<div class="d-flex justify-content-center p-5">
  <div class="bg-white w-50 rounded-4 border border-1 shadow p-3" style="height: 350px;">
    <div class="text-center">
        <h3 class="poppins text-black fw-medium">PKII Working Paper - Generate</h3>
    </div>

<?php

    $found11 = 0;
    $result11 = mysql_query("SELECT month FROM tblfinworkpaper WHERE month LIKE '$wpgendate%'", $dbh);
    if ($result11 != '') {
        while ($myrow11 = mysql_fetch_row($result11)) {
            $found11 = 1;
            $month11 = $myrow11[0];
        }
        if ($found11 == 1) {
?>
            <div style="height: 210px; display: grid; place-items: center;">
              <p class="poppins text-danger text-center fs-1">Selected month already processed.<br>Please try again.</p>
            </div>
            <div class="d-flex justify-content-end m-4">
              <form action="finvouchworkpgen.php?loginid=<?php echo $loginid; ?>" method="post">
                <button type="submit" class="btn poppins fw-medium text-white border border-1 rounded-3" style="width: 100px; height: 40px; background-color: #0a1d44;">Back</button>
              </form>
            </div>
<?php
        } else {

?>
            <div class="text-center mt-4 mb-5">
                <p class="poppins text-muted fs-4">Ready to retrieve the beggining balance from the previous month. <br> Click on the '<strong class="text-black">OK</strong>' button to display beginning balances.</p>
            </div>
            <div class="text-center mb-5">
              <i class="bi bi-file-earmark-spreadsheet-fill text-info" style="font-size: 100px;"></i>
            </div>
            <div class="d-flex justify-content-center align-items-center gap-5">
              <div>
                <form action="finvouchworkpgen.php?loginid=<?php echo $loginid; ?>" method="post">
                  <button type="submit" class="poppins fw-medium btn btn-danger" style="width: 100px; height: 40px;">Cancel</button>
                </form>
              </div>
              <div>
                <form action="finvouchworkpgen2a.php?loginid=<?php echo $loginid; ?>&gd=<?php echo $wpgendate; ?>" method="post">
                  <button type="submit" class="poppins fw-medium btn btn-success" style="width: 100px; height: 40px;">OK</button>
                </form>
              </div>
            </div>
<?php
        }
    }
?>
  </div>
</div>

<div class="d-flex justify-content-end mt-4">
   <button class="border border-1 rounded-3" style="width: 12.5%; height: 40px; background-color: #0a1d44;">
      <a href="finvouchworkpgen.php?loginid=86" class="text-white text-decoration-none poppins fw-medium fs-4">Back</a>
   </button>
</div>

<?php
    $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result = $dbh2->query($resquery); 
    include ("footer.php");
} else {
    include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>