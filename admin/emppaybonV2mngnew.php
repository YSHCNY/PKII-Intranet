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
     echo "<tr><th colspan='7'>Manage pay group > Create new group</th></tr>";

    // form: create new group
    echo "<form action=\"./emppaybonV2mngnew2.php?loginid=$loginid\" method=\"POST\" name=\"emppaybonV2mngnew2\">";
    echo "<input type=\"hidden\" name=\"frfile\" value=\"emppaybonV2mngnew.php\">";
    echo "<tr><td colspan='7'>";
    echo "<div class='form-group'>";
    echo "<input class='form-control' name=\"grpnmnew\" placeholder=\"New pay groupname\">";
    echo "</div>";
    echo "</td></tr>";
    echo "<tr><td colspan='7'>";
    echo "<textarea class='form-control' rows='4' name=\"grpdesc\" placeholder=\"Description (optional)\"></textarea>";
    echo "</td></tr>";
    echo "<tr><td colspan='6'>No. of input fields for Add'l Income</td><td colspan='1'><div class='form-group'><input class='form-control' type='number' min='1' max='5' name=\"dfltcoladdinc\" value=1></div></td></tr>";
    echo "<tr><td colspan='6'>No. of input fields for Deductions</td><td colspan='1'><div class='form-group'><input class='form-control' type='number' min='1' max='10' name=\"dfltcoldeduct\" value=1></div></td></tr>";
    echo "<tr><td colspan='6'>User access level</td><td colspan='1'>";
    echo "<select name=\"usraccesslevel\">";
    for($x=1; $x<=$accesslevel ;$x++) {
        if($x==$accesslevel) { $xsel="selected"; } else { $xsel=""; }
        echo "<option value=$x $xsel>$x</option>";
    } //for
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td colspan='7'>";
    echo "<button type=\"submit\" class=\"btn btn-success\" name=\"submnewgrp\" value=\"1\">Save</button>";
    echo "</td></tr>";
    echo "</form>";

     echo "</table>";

     echo "<br><p><a href=\"emppaybonV2mng.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
