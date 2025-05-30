


<?php
echo "<div class=' mt-4'>";
echo "<form action='mngstduseradd2.php?loginid=$loginid' method='post' class='form-group'>";

echo "<div class='mb-3'>";
echo "<label for='username' class='form-label'>Username</label>";
echo "<input type='text' class='form-control' id='username' name='username'>";
echo "</div>";

echo "<div class='mb-3'>";
echo "<label for='password1' class='form-label'>Password</label>";
echo "<input type='password' class='form-control' id='password1' name='password1'>";
echo "</div>";

echo "<div class='mb-3'>";
echo "<label for='password2' class='form-label'>Confirm Password</label>";
echo "<input type='password' class='form-control' id='password2' name='password2'>";
echo "</div>";

echo "<div class='mb-3'>";
echo "<label for='employeeid' class='form-label'>Link to Personnel</label>";
echo "<select class='form-control' id='employeeid' name='employeeid'>";
echo "<option value=''>-</option>";

$result11 = mysql_query("SELECT employeeid FROM tblemployee WHERE emp_record = 'active' ORDER BY employeeid ASC", $dbh);
while($myrow11 = mysql_fetch_row($result11)) {
    $employeeid11 = $myrow11[0];
    $result12 = mysql_query("SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid='$employeeid11'", $dbh);
    while($myrow12 = mysql_fetch_row($result12)) {
        $name_last12 = $myrow12[0];
        $name_first12 = $myrow12[1];
        $name_middle12 = $myrow12[2];
        echo "<option value='$employeeid11'>$employeeid11 - $name_first12 " . $name_middle12[0] . " $name_last12</option>";
    }
}
echo "</select>";
echo "</div>";

echo "<div class='text-end'>";
echo "<input type='submit' class='btn mainbtnclr text-white' value='Add New User'>";
echo "</div>";

echo "</form>";
echo "</div>";
?>
























<?php 

//     echo "<table class=\"fin\" border=\"1\">";
//     echo "<tr><th colspan=\"2\">Manage Users - Add new</th></tr>";
//     echo "<form action=\"mngstduseradd2.php?loginid=$loginid\" method=\"post\">";
//     echo "<tr><td>username</td><td><input name=\"username\"></td></tr>";
//     echo "<tr><td>password</td><td><input type=\"password\" name=\"password1\"></td></tr>";
//     echo "<tr><td>confirm password</td><td><input type=\"password\" name=\"password2\"></td></tr>";
//     echo "<tr><td>link to personnel</td><td>";

//     echo "<select name=\"employeeid\">";
//     echo "<option value=\"\">-</option>";
//     $result11 = mysql_query("SELECT employeeid FROM tblemployee WHERE emp_record = \"active\" ORDER BY employeeid ASC", $dbh);
//     while($myrow11 = mysql_fetch_row($result11))
//     {
//       $found11 = 1;
//       $employeeid11 = $myrow11[0];
//       $result12 = mysql_query("SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$employeeid11\"", $dbh);
//       while($myrow12 = mysql_fetch_row($result12))
//       {
// 	$found12 = 1;
// 	$name_last12 = $myrow12[0];
// 	$name_first12 = $myrow12[1];
// 	$name_middle12 = $myrow12[2];
//       }
//       echo "<option value=\"$employeeid11\">$employeeid11 - $name_first12 $name_middle12[0] $name_last12</option>";
//     }
//     echo "</select></td></tr>";

//     echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Add new user\"></form></td></tr>";
//     echo "</table>";


// // end contents here

//      $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 


// mysql_close($dbh);
?>




















