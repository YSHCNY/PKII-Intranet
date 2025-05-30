<?php 

$res11query = "SELECT adminloginid, adminuid, adminpw, date_created, remarks_login, adminloginstat, adminloginlevel, employeeid, contactid, accesslevel FROM tbladminlogin WHERE adminloginid <> '' ORDER BY adminloginid ASC";
$result11=""; $found11=0; $ctr11=0;
$result11=$dbh2->query($res11query);
if($result11->num_rows>0) {
    while($myrow11=$result11->fetch_assoc()) {
$found11 = 1;
$adminloginid11 = $myrow11['adminloginid'];
$adminuid11 = $myrow11['adminuid'];
$adminpw11 = $myrow11['adminpw'];
$date_created11 = $myrow11['date_created'];
$remarks_login11 = $myrow11['remarks_login'];
$adminloginstat11 = $myrow11['adminloginstat'];
$adminloginlevel11 = $myrow11['adminloginlevel'];
$employeeid11 = $myrow11['employeeid'];
$contactid11 = $myrow11['contactid'];
$accesslevel11 = $myrow11['accesslevel'];

$count11 = $count11 + 1;

$res12query = "SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$employeeid11\"";
    $result12=""; $found12=0;
    $result12=$dbh2->query($res12query);
    if($result12->num_rows>0) {
        while($myrow12=$result12->fetch_assoc()) {
$found12 = 1;
$name_last12 = $myrow12['name_last'];
$name_first12 = $myrow12['name_first'];
$name_middle12 = $myrow12['name_Middle'];
        } // while($myrow12=$result12->fetch_assoc())
    } // if($result12->num_rows>0)

//20221021 incl tblsysusracctmgt to chk if attempt>=5, then show disabled account
$res14query=""; $result14=""; $found14=0;
$res14query="SELECT idtblsysusracctmgt, attempt FROM tblsysusracctmgt WHERE loginid=0 AND admloginid=$adminloginid11 AND employeeid=\"$employeeid11\" LIMIT 1";
$result14=$dbh2->query($res14query);
if($result14->num_rows>0) {
while($myrow14=$result14->fetch_assoc()) {
$found14=1;
$idtblsysusracctmgt14 = $myrow14['idtblsysusracctmgt'];
$attempt14 = $myrow14['attempt'];
} //while
} //if

//20221021 chk tblsysusracctmgt for non-admin based on employeeid
$res15query=""; $result15=""; $found15=0;
$res15query="SELECT idtblsysusracctmgt, loginid, attempt FROM tblsysusracctmgt WHERE employeeid=\"$employeeid11\" AND admloginid=0";
$result15=$dbh2->query($res15query);
if($result15->num_rows>0) {
while($myrow15=$result15->fetch_assoc()) {
$found15=1;
$idtblsysusracctmg15 = $myrow15['idtblsysusracctmgt'];
$loginid15 = $myrow15['admloginid'];
$attempt15 = $myrow15['attempt'];
} //while
} //if

$remarksfin=""; $fontclr="#000000";
if($attempt14>=$usrpwretries || $attempt15>=$usrpwretries) {
$fontclr="text-danger";
$remadd="";
if($attempt14>=$usrpwretries) { $remadd .= " on admin profile."; }
if($attempt15>=$usrpwretries) { $remadd .= " on non-admin profile."; }
$remarksfin = $remarks_login11." "."reached max password retries".$remadd;
} else {
$fontclr="#000000"; 
$remarksfin = "";
} //if-else

echo "<tr class = '$fontclr'>";

echo "<td>$adminuid11</td>";
echo "<td>$accesslevel11</td>";
echo "<td>$date_created11</td>";
echo "<td>$employeeid11</td>";
echo "<td>$name_last12, $name_first12 $name_middle12[0]</td>";
echo "<td>$remarksfin</td>";
echo "<td>";
echo "<a href=\"mngadmuserchgpass.php?loginid=$loginid&admid=$adminloginid11&admuid=$adminuid11\" class='px-3 py-2 ms-1 rounded-3 border-0 text-white bg-warning ' role='button'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='#fff' class='bi bi-gear-wide' viewBox='0 0 16 16'>
<path d='M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434zM8 12.997a4.998 4.998 0 1 1 0-9.995 4.998 4.998 0 0 1 0 9.996z'/>
</svg></a></td>";


echo "<td>";
echo "<a href=\"mngadmuseredit.php?loginid=$loginid&admid=$adminloginid11\" class='px-3 py-2 ms-1 rounded-3 border-0 bg-success text-white' role='button'><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pencil-square\" viewBox=\"0 0 16 16\">
<path d=\"M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z\"/>
<path fill-rule=\"evenodd\" d=\"M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z\"/>
</svg></a>";
echo "</td>";

echo "<td>";
echo "<a href=\"mngadmuserdel.php?loginid=$loginid&admid=$adminloginid11&admuid=$adminuid11\" class='px-3 py-2 ms-1 rounded-3 border-0 bg-danger text-white' role='button'><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash3\" viewBox=\"0 0 16 16\">
<path d=\"M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5\"/>
</svg></a>";

echo "</td>";
echo "</tr>";

    } // while($myrow11=$result11->fetch_assoc())


} // if($result11->num_rows>0)
?>

