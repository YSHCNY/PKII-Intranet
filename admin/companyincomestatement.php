

<?php 

include("db1.php");

$loginid = $_GET['loginid'];
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


      <?php

// edit body-header
     echo "<div class='mainContainer'>";
     echo "<div class='container-fluid'>";
     echo "<input type='hidden' id='loginid' value='".$loginid."'/>";
     $projcode = '-';
     include('incomestatementproject.php');
     ?>
     
      </div>
      </div>

      <?php 

      ?>

<link rel="stylesheet" type="text/css" href="tjaddons/projectreports.css">
<script src="tjaddons/charts.js"></script>
<script src="tjaddons/projectreports.js"></script>
      <?php 
     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
