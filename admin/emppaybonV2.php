<?php 

require './db1.php';

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeetype = (isset($_POST['employeetype'])) ? $_POST['employeetype'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include './header.php';
     include './sidebar.php';

     echo "<p><font size=1>Modules >> Personnel Pay/Bonus Notifier ver. 2.0</font></p>";

     echo "<table class='fin'>";
     echo "<tr><th colspan='2'>Personnel Pay/Bonus Notifier ver. 2.0</th></tr>";
    echo "<tr><td>";
    echo "<a href=\"./emppaybonV2mng.php?loginid=$loginid\" class='btn btn-primary' role='button'>Manage group</a>";
    echo "</td><td>";
    echo "<a href=\"./emppaybonV2mngaddrmv.php?loginid=$loginid\" class='btn btn-primary' role='button'>Add/Remove personnel</a>";
    echo "</td><td>";
    echo "<a href=\"./emppaybonV2dtls.php?loginid=$loginid\" class='btn btn-primary' role='button'>Personnel details</a>";
    echo "</td><td>";
    echo "<a href=\"./emppaybonV2bpi.php?loginid=$loginid\" class='btn btn-primary' role='button'>Prepare BPI file</a>";
    echo "</td><td>";
    echo "<a href=\"./emppaybonV2eml.php?loginid=$loginid\" class='btn btn-primary' role='button'>Send e-mails</a>";
    echo "</td></tr>";
    echo "</table>";

     echo "<br><p><a href=\"emppaybon00.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 