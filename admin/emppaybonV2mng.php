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
     echo "<tr><th colspan='2'>Manage pay group</th></tr>";
    echo "<tr><td>";
    echo "<a href=\"./emppaybonV2mngnew.php?loginid=$loginid\" class='btn btn-primary' role='button'>Create new group</a>";
    // echo "</td><td>";
    // echo "<a href=\"./emppaybonV2mnglst.php?loginid=$loginid\" class='btn btn-primary' role='button'>List group</a>";
    // echo "</td><td>";
    // echo "<a href=\"./emppaybonV2mngaddrmv.php?loginid=$loginid\" class='btn btn-primary' role='button'>Add/Remove personnel</a>";
    echo "</td></tr>";

     echo "</table>";

    echo "<table class='fin'>";
    // list groups
    echo "<tr><th colspan='7'>List of pay groups...</th></tr>";
    echo "<tr><th>ctr</th><th>name</th><th>description</th><th>date created</th><th>date last modified</th><th colspan='2'>action</th></tr>";
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
    $res11query="SELECT idpay2notifref, timestamp, dt_created, groupname, description, userlevel, activesw FROM tblfinpay2notifref WHERE userlevel<=$accesslevel ORDER BY dt_created DESC";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11=1;
        $ctr11++;
        $idpay2notifref11 = $myrow11['idpay2notifref'];
        $timestamp11 = $myrow11['timestamp'];
        $dt_created11 = $myrow11['dt_created'];
        $groupname11 = $myrow11['groupname'];
        $description11 = $myrow11['description'];
        $userlevel11 = $myrow11['userlevel'];
        $activesw11 = $myrow11['activesw'];
        echo "<tr><td>$ctr11</td><td>$groupname11</td><td>$description11</td><td>$dt_created11</td><td>$timestamp11</td>";
/*
        echo "<form action=\"emppaybonV2mnggrpactv?loginid=$loginid\" method=\"POST\" name=\"emppaybonV2mnggrpactv\">";
        echo "<input type=\"hidden\" name=\"frfile\" value=\"emppaybonV2mngnew.php\">";
        echo "<td>";
        if($activesw11==1) { 
        $activeswlbl="Disable"; 
        echo "<button class='btn btn-warning' name='submactivesw' value=0>$activeswlbl</button>";
        } elseif($activesw11==0) { 
        $activeswlbl="Enable"; 
        echo "<button class='btn btn-success' name='submactivesw' value=1>$activeswlbl</button>";
        } //if-else
        echo "</td>";
        echo "</form>";
*/
        echo "<form action=\"emppaybonV2mnggrpedt?loginid=$loginid\" method=\"POST\" name=\"emppaybonV2mnggrpedt\">";
        echo "<input type=\"hidden\" name=\"frfile\" value=\"emppaybonV2mng.php\">";
        echo "<td><button class='btn btn-warning' name='submgrpedt' value=1>Edit</button></td>";
        echo "</form>";
        echo "<form action=\"emppaybonV2mnggrpdel?loginid=$loginid\" method=\"POST\" name=\"emppaybonV2mnggrpdel\">";
        echo "<input type=\"hidden\" name=\"frfile\" value=\"emppaybonV2mng.php\">";
        echo "<td><button class='btn btn-danger' name='submgrpdel' value=1>Del</button></td>";
        echo "</form>";
        echo "</tr>";
        } //while
    } //if

     echo "</table>";


     echo "<br><p><a href=\"emppaybonV2.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
