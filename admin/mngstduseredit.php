<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$loginid0 = (isset($_GET['stdlid'])) ? $_GET['stdlid'] :'';
$username0 = (isset($_GET['stduid'])) ? $_GET['stduid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

  if($accesslevel >= 4 && $accesslevel <= 5) {


    $res11query="SELECT loginid, username, date_created, time_login, time_logout, remarks_login, login_status, login_level, employeeid, contactid FROM tbllogin WHERE loginid=$loginid0 AND username=\"$username0\"";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
      $loginid11 = $myrow11['loginid'];
      $username11 = $myrow11['username'];
      $date_created11 = $myrow11['date_created'];
      $time_login11 = $myrow11['time_login'];
      $time_logout11 = $myrow11['time_logout'];
      $remarks_login11 = $myrow11['remarks_login'];
      $login_status11 = $myrow11['login_status'];
      $login_level11 = $myrow11['login_level'];
      $employeeid11 = $myrow11['employeeid'];
      $contactid11 = $myrow11['contactid'];			
			} // while
		} // if

    if($employeeid11!='') {
      $res12query="SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$employeeid11\"";
			$result12=""; $found12=0; $ctr12=0;
			$result12=$dbh2->query($res12query);
			if($result12->num_rows>0) {
				while($myrow12=$result12->fetch_assoc()) {
				$found12=1;
        $employeeid12 = $myrow12['employeeid'];
        $name_last12 = $myrow12['name_last'];
        $name_first12 = $myrow12['name_first'];
        $name_middle12 = $myrow12['name_middle'];
				} // while
			} // if
    } else {
      $employeeid12 = ''; $name_last12 = ''; $name_first12 = ''; $name_middle12 = '';
    } // if

    // chk in tblsysusracctmgt if attempt>=5
    $res15query=""; $result15=""; $found15=0;
    $res15query="SELECT idtblsysusracctmgt, attempt FROM tblsysusracctmgt WHERE loginid=$loginid0 AND admloginid=0 LIMIT 1";
    $result15=$dbh2->query($res15query);
    if($result15->num_rows>0) {
        while($myrow15=$result15->fetch_assoc()) {
        $found15=1;
        $idtblsysusracctmgt15 = $myrow15['idtblsysusracctmgt'];
        $attempt15 = $myrow15['attempt'];
        } //while
    } //if

    // chk again in tblsysusracctmgt for admloginid based on username if attempt>=5
    $res16query=""; $result16=""; $found16=0;
    $res16query="SELECT adminloginid FROM tbladminlogin WHERE adminuid=\"$username11\" LIMIT 1";
    $result16=$dbh2->query($res16query);
    if($result16->num_rows>0) {
        while($myrow16=$result16->fetch_assoc()) {
        $found16=1;
        $adminloginid16 = $myrow16['adminloginid'];
        } //while
    } //if
    if($found16==1) {
        $res16bquery=""; $result16b=""; $found16b=0;
        $res16bquery="SELECT idloginstatus, status, disabled FROM tblloginstatus WHERE loginid=$adminloginid16 AND logintype=2 LIMIT 1";
        $result16b=$dbh2->query($res16bquery);
        if($result16b->num_rows>0) {
            while($myrow16b=$result16b->fetch_assoc()) {
            $found16b=1;
            $idloginstatus16b = $myrow16b['idloginstatus'];
            $status16b = $myrow16b['status'];
            $disabled16b = $myrow16b['disabled'];
            } //while
        } //if
    } //if

    echo "
    <div class='shadow p-5'>
    <div class=' mt-3'>";
    echo "<div class = 'my-5'>";
    echo "<h3 class = 'text-capitalize'><span class = 'text-muted'>Edit user</span> $username11</h3>";
    echo "</div>";
    echo "<form action='mngstduseredit2.php?loginid=$loginid&stdlid=$loginid0' method='post'>";
    
    echo "<div class='mb-3'>";
    echo "<label class='form-label'>Username</label>";
    echo "<input class='form-control' name='username' value='$username11' readonly>";
    echo "</div>";
    
    echo "<div class='mb-3'>";
    echo "<label class='form-label'>Link to Personnel</label>";
    echo "<select class='form-control' name='newempid'>";
    $res14query="SELECT tblemployee.employeeid, tblemployee.emp_record, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblemployee LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE tblcontact.contact_type='personnel' ORDER BY tblcontact.name_last ASC, tblcontact.name_first ASC";
    $result14=$dbh2->query($res14query);
    if ($result14->num_rows > 0) {
        while ($myrow14 = $result14->fetch_assoc()) {
            $employeeid14 = $myrow14['employeeid'];
            $emp_record14 = $myrow14['emp_record'];
            $name_last14 = $myrow14['name_last'];
            $name_first14 = $myrow14['name_first'];
            $name_middle14 = $myrow14['name_middle'];
            $empidsel = ($employeeid14 == $employeeid11) ? "selected" : "";
            $style = ($emp_record14 == 'inactive') ? "<i>" : "";
            $style_close = ($emp_record14 == 'inactive') ? "</i>" : "";
            echo "<option value='$employeeid14' $empidsel>$style$name_last14, $name_first14 $name_middle14[0] - ($employeeid14)$style_close</option>";
        }
    }
    echo "</select>";
    echo "</div>";
    
    echo "<div class='mb-3'>";
    echo "<label class='form-label'>Access Status</label>";
    echo "<select class='form-control' name='loginremarks'>";
    $disabledsel = (strpos($remarks_login11, "disabled") === FALSE && $attempt15 >= $usrpwretries) || $disabled16b == 1 ? "selected" : "";
    $enabledsel = $disabledsel == "selected" ? "" : "selected";
    echo "<option value='enabled' $enabledsel>Enabled</option>";
    echo "<option value='disabled' $disabledsel>Disabled</option>";
    echo "</select>";
    echo "</div>";
    
    echo "<div class='text-end'>";
    echo "<a class = 'text-dark text-decoration-none mx-2 btn' href=\"mngstdusers.php?loginid=$loginid\">Back</a>";
    echo "<input type='submit' class='btn mx-2 mainbtnclr text-white' value='Save'>";

    echo "</div>";
    
    echo "</form>";
    echo "</div>
    </div>";
  }
   

// end contents here

		$resquery="UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
		$result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include ("logindeny.php");
}
// mysql_close($dbh);
$dbh2->close();
?>
