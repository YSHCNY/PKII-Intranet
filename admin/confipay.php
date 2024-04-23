<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeetype = (isset($_POST['employeetype'])) ? $_POST['employeetype'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> Custom Payroll System</font></p>";

     echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th>Custom Payroll System</th></tr>";

  if(substr($level, -6, 1) == 1) {
     echo "<tr><td><a href=\"configrpadd.php?loginid=$loginid\" class='btn btn-primary' role='button'>Create Pay Group</a></td></tr>";
     echo "<tr><td><a href=\"confipay1.php?loginid=$loginid\" class='btn btn-primary' role='button'>Individual Info</a></td></tr>";

     echo "<tr><td><a href=\"confipayrun.php?loginid=$loginid\" class='btn btn-primary' role='button'>RUN PAYROLL SYSTEM</a></td></tr>";

     echo "<tr><td><a href=\"confipaytools.php?loginid=$loginid\" class='btn btn-primary' role='button'>Post-Process Tools</a></td></tr>";

  } else {

    echo "<tr><td><font color=\"red\">Sorry, you don't have access to this page.</font></td></tr>";

  } //if-else

     echo "</table>";

     echo "<p><a href=\"index2.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
