<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$pid = (isset($_GET['pid'])) ? $_GET['pid'] :'';
$regularizationdt = (isset($_GET['regndt'])) ? $_GET['regndt'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");
?>
<script language="JavaScript" src="ts_picker.js"></script>
<?php
     echo "<p><font size=1>Directory >> Manage Personnel >> Change Regularization Date</font></p>";

     echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th class='text-center' colspan='2'>Change Date of Regularization</b></font></td></tr>";

     if ($pid == '') {

	echo "<tr><td colspan=2><font color=red><b>Sorry. No data available</b></font></td></tr>";

     } else {

        $res11query=""; $result11=""; $found11=0;
	$res11query="SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$pid'";
        $result11=$dbh2->query($res11query);
        if($result11->num_rows>0) {
            while($myrow11=$result11->fetch_assoc()) {
            $found11=1;
	  $employeeid = $myrow11['employeeid'];
	  $name_last = $myrow11['name_last'];
	  $name_first = $myrow11['name_first'];
	  $name_middle = $myrow11['name_middle'];
            } //while
        } //if

	echo "<tr><td colspan=2>For: <b>$employeeid - $name_last, $name_first $name_middle[0].</b></td></tr>";

	// echo "<tr><td>Date Resigned</td><td align=center>$emp_birthdate<br><font size=2><i>yyyy-mm-dd</i></font></td></tr>";
	echo "<tr><th class='text-right'>Regularization date</th><td>";

	echo "<form action=\"personnelchgregularizationdt2.php?loginid=$loginid&pid=$pid\" method=\"POST\" name=\"empchgregularizationdt2\">";

		echo "<input type=\"date\" name=\"regndt\" value=\"$regularizationdt\">";
		echo "</td></tr>";
     echo "<tr><td colspan=\"2\" align=\"center\"><button type='submit' class='btn btn-success'>Update</button></td></tr>";
     echo "</form>";

     // echo "<tr><td colspan=2 class='font-italic'>Note: If personnel is not yet regularized,<br>please change date to '0000-00-00' or '0000-01-01'<br>Thank you.</td></tr>";
     }

     echo "</table>";
 
     $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 

     echo "<br><p><a href=\"personneledit2.php?pid=$pid&loginid=$loginid\" class='btn btn-default' role='button'>Back</a>";

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
