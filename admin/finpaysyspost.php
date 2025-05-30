<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$pg = (isset($_GET['pg'])) ? $_GET['pg'] :'';
$act = (isset($_GET['act'])) ? $_GET['act'] :'';



$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");



	echo "<div class =  ' mb-5'><h4 class = 'mb-0'>Post-process Tools</h4>
    <p class = 'text-secondary'>Tools for payroll results, payslip distribution, and BPI integration.</p>
  ";

if ( $act == 1){
       $btnact = 'btn-success border-success';
} else if ( $act == 2){
       $btnact2 = 'btn-success border-success';
} else if ( $act == 3){
       $btnact3 = 'btn-success border-success';
} else {
  $btnact = '';
  $btnact2 = '';
  $btnact3 = '';
}
  if($accesslevel >= 4) {
      echo "<div class = 'd-flex align-items-center  my-5 border-bottom border-success'>";
          
        
          echo " <a href = 'finpaysyspost.php?loginid=$loginid&pg=vr&act=1'  class='btn rounded-0  border $btnact  '>View results</a>";
          echo " <a href = 'finpaysyspost.php?loginid=$loginid&pg=pn&act=2'  class='btn rounded-0  border $btnact2  '>Payslip notifier</a>";
          echo " <a href = 'finpaysyspost.php?loginid=$loginid&pg=bpi&act=3'  class='btn rounded-0  border $btnact3  '>BPI BizLink</a>";

          //  echo "<div>";
          // echo "<form action=\"?loginid=$loginid\" method=\"post\" name=\"finpaysyspostrpt\">";
          // echo "<button type=\"submit\" class='btn btn-default'>Reports Summary</button>";
          // echo "</form>";
          // echo "</div>";

          // echo "<div>";
          // echo "<form action=\"?loginid=$loginid\" method=\"post\" name=\"finpaysysrfp\">";
          // echo "<button type=\"submit\" class='btn btn-default'>Request for payment</button>";
          // echo "</form>";
          // echo "</div>";
    echo "</div>";
  }
 echo "</div>";


  if ($pg == 'vr' && $act == 1){
    include 'finpaysyspostresult.php';
  } else if ($pg == 'pn' && $act == 2){
        include 'finpaysyspostpayslip.php';

  } else if ($pg == 'bpi' && $act == 3){
        include 'finpaysyspostbpi.php';

  } else {
     echo"<div class = 'text-center p-5'>
        <h3 class='text-secondary font-italic'>No module selected</h3>

     </div>";
  }


// end contents here...



// edit body-footer
    //  echo "<p><a href=\"finpaysys.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
