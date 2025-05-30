<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeetype = (isset($_POST['employeetype'])) ? $_POST['employeetype'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> Custom pay notifier</font></p>";
/*
     echo "<p><center><img src=\"./images/page-under-construction1.jpg\"></center></p>";
*/
     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th colspan='2'>Custom Pay Notifier</th></tr>";

//     echo "<tr><td><form action=emailnotifier3.php?loginid=$loginid method=POST target=frame>";
    echo "<tr><td><form action=emailnotifier3.php?loginid=$loginid method=POST>";
     echo "<div class='form-group'><label>Select type:<select class='form-control' name=\"employeetype\">";
     echo "<option value=\"consultant\">consultant</option>";
     echo "<option value=\"employee\">employee</option>";
     // echo "<option value=\"others\">others</option>";
     echo "</select></div></td>";
     echo "<td><button type='submit' class='btn btn-primary'>Go</button></label>";
     echo "</form></td></tr>";

     // echo "<tr><td><iframe src=\"blank2.htm\" width=\"100%\" height=\"450\" name=\"frame\"><iframe></td></tr>";
     echo "</table>";

     echo "<p><a href=\"index2.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

     $resquery="UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery);	 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
