<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Main menu >> sub-menu >> sub-menu2</font></p>";

echo "<table border=0 spacing=0 cellspacing=0 cellpadding=0><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Main title here</b></font></td></tr>";

// start contents here...

     echo "<tr><td>text</td></tr>";

     echo "<tr><td>text</td></tr>";

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"admlogin.php?loginid=$loginid\" class='btn btn-default' role='button'>Back to Main Menu</a></p>";

     $resquery("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
