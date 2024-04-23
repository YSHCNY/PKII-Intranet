<?php
//
// read password column of tbllogin, encrypt and update
//

$hostname = 'localhost';
$dbname = 'maindb';
$dbuser = 'root';
$dbuserpass = '';

$dbh = mysql_connect("$hostname", "$dbuser", "$dbuserpass") or die("Connection Error");
mysql_select_db("$dbname", $dbh) or die("Database Error");

?>
<table border="1" spacing="0" cellspacing="0" cellpadding="0">
<tr><th colspan="7">tbladminlogin password hashing...</th></tr>
<tr><th>ctr</th><th>id</th><th>username</th><th>prev_pw</th><th>empID</th><th>contactID</th><th>result</th></tr>
<?
	$result11=""; $found11=0; $ctr11=0;
	$result11 = mysql_query("SELECT adminloginid, adminuid, adminpw, employeeid, contactid FROM tbladminlogin ORDER BY adminloginid ASC", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$adminloginid11 = $myrow11[0];
		$adminuid11 = trim($myrow11[1]);
		$adminpw11 = trim($myrow11[2]);
		$employeeid11 = $myrow11[3];
		$contactid11 = $myrow11[4];
		$ctr11 = $ctr11 + 1;

		echo "<tr><td>$ctr11</td><td>$adminloginid11</td><td>$adminuid11</td><td>$adminpw11</td>";
		echo "<td>$employeeid11</td><td>$contactid11</td>";

		// hash/encrypt and update password field
		$result12 = mysql_query("UPDATE tbladminlogin SET adminpw=md5('$adminpw11') WHERE adminloginid=$adminloginid11", $dbh);

		// query result of password field
		$result14=""; $found14=0; $ctr14=0;
		$result14 = mysql_query("SELECT adminpw FROM tbladminlogin WHERE adminloginid=$adminloginid11 LIMIT 1", $dbh);
		if($result14 != "") {
			while($myrow14 = mysql_fetch_row($result14)) {
			$found14 = 1;
			$adminpw14 = trim($myrow14[0]);
			}
		}
		echo "<td>$adminpw14</td>";
		echo "</tr>";
		}
	}
mysql_close($dbh);
?>
<tr><th colspan="7">OK - eof<br>
<script language="javascript">
 <!--
 var today = new Date();
 document.write(today);
 //-->
</script>
</th></tr>
</table>
