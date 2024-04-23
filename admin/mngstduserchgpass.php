<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$loginid0 = (isset($_GET['stdlid'])) ? $_GET['stdlid'] :'';
$username0 = (isset($_GET['stduid'])) ? $_GET['stduid'] :'';
$genranchars = (isset($_GET['genranchar'])) ? $_GET['genranchar'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

  if($accesslevel >= 4 && $accesslevel <= 5) {
 

    $result11 = mysql_query("SELECT password, employeeid FROM tbllogin WHERE loginid=$loginid0 AND username=\"$username0\"", $dbh);
    while($myrow11 = mysql_fetch_row($result11)) {
      $found11 = 1;
      $password11 = $myrow11[0];
      $employeeid11 = $myrow11[1];
    }


    if($employeeid11 <> '') {
      $result12 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$employeeid11\"", $dbh);
      while($myrow12 = mysql_fetch_row($result12)) {
        $found12 = 1;
        $employeeid12 = $myrow12[0];
        $name_last12 = $myrow12[1];
        $name_first12 = $myrow12[2];
        $name_middle12 = $myrow12[3];
      }
    } else {
      $employeeid12 = ''; $name_last12 = ''; $name_first12 = ''; $name_middle12 = '';
    }
    echo "
    <div class = 'shadow p-5 m-3'>
    <div class = 'border-bottom pb-3 mb-5'>
    <div class=' mt-3'>";
    echo "<div class = 'border-bottom pb-3 mb-5'>
    <p class = 'fs-2  mb-0'><span class  = 'text-muted'>Change Password for</span>  <span class = 'text-uppercase fw-bold '> $name_first12 $name_middle12[0] $name_last12</span>  </p>
  </div>";
    echo "<form action='mngstduserchgpass2.php?loginid=$loginid&stdlid=$loginid0&stduid=$username0' method='post' class='form-group'>";
    
    echo "<div class='mb-3'>";
    echo "<label class='form-label  form-label text-normal fs-5 text-muted mb-0' for = 'un'>Username</label>";
    echo "<p class='form-control-static' id = 'un'><b>$username0</b></p>";
    echo "</div>";
    

    // Uncomment the next line if the link should be displayed
    // echo "<a href='mngadmuserchgpers.php?loginid=$loginid&admid=$adminloginid' class='btn btn-link'>Change</a>";
    echo "</div>";
    
    echo "<div class='mb-3'>";
    echo "<label for='newpassword' class='form-label text-normal fs-5 text-muted mb-0'>New Password</label> ";
    if($genranchars != "") {
        echo "<input type='text'  id='newpassword' name='newpassword' value='$genranchars'> ";
    } else {
        echo "<input type='text'  id='newpassword' name='newpassword'> ";
    }
    echo "<a href='mngstduserchgpassgenranchars.php?loginid=$loginid&stdlid=$loginid0&stduid=$username0'>Generate</a></i></div>";
   
    
    echo "<div class='text-end'>";
    echo "<a class = 'text-decoration-none text-dark mx-2' href=\"mngstdusers.php?loginid=$loginid\">Back</a>";
    echo "<input type='submit' class='btn mainbtnclr text-white mx-2' value='Save'>";
   
    echo "</div>";
    
    echo "</form>";
    echo "</div></div></div>";
    





  }


// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
