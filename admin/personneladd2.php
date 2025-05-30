<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$employeeid = trim((isset($_POST['employeeid'])) ? $_POST['employeeid'] :'');
$name_last = trim((isset($_POST['name_last'])) ? $_POST['name_last'] :'');
$name_first = trim((isset($_POST['name_first'])) ? $_POST['name_first'] :'');
$name_middle = trim((isset($_POST['name_middle'])) ? $_POST['name_middle'] :'');
$personnel_type = (isset($_POST['personnel_type'])) ? $_POST['personnel_type'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
	include ("header.php");
  include ("sidebar.php");

  echo "<p><font size=1>Directory >> Manage Personnel >> Add new personnel</font></p>";

    $res0query=""; $result0=0; $found0=0;
  $res0query = "SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'";
    $result0=$dbh2->query($res0query);
	if($result0->num_rows>0) {
		while($myrow0=$result0->fetch_assoc()) {
	$found0 = 1;
	$employeeid0 = $myrow0['employeeid'];
	$name_last0 = $myrow0['name_last'];
	$name_first0 = $myrow0['name_first'];
	$name_middle0 = $myrow0['name_middle'];			
		} //while
	} //if

  if ($found0 == 1) {
		echo "<p><font color=red><b>Sorry. EmployeeID is already assigned to:</b></font><br>";
		echo "<b>$employeeid0 - $name_last0, $name_first0 $name_middle0</b></p>";
		echo "<form action=personneladd.php?loginid=$loginid method=post name=personneladd>";
		echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
		echo "<input type=\"hidden\" name=\"name_last\" value=\"$name_last\">";
		echo "<input type=\"hidden\" name=\"name_first\" value=\"$name_first\">";
		echo "<input type=\"hidden\" name=\"name_middle\" value=\"$name_middle\">";
		echo "<input type=\"hidden\" name=\"personnel_type\" value=\"$personnel_type\">";
		echo "<p>Please provide new employee number.</p>";
		echo "<input type=\"submit\" value=\"back\">";
		echo "</form>";
  } else {
        $res1query=""; $result1=""; $found1=0;
		$res1query = "SELECT contactid, employeeid, name_last, name_first, name_middle, contact_type FROM tblcontact WHERE name_last = '$name_last' AND name_first = '$name_first' AND (employeeid='' OR employeeid IS NULL)";
		$result1=$dbh2->query($res1query);
		if($result1->num_rows>0) {
			while($myrow1=$result1->fetch_assoc()) {
			$found1 = 1;
			$contactid1 = $myrow1['contactid'];
			$employeeid1 = $myrow1['employeeid'];
			$name_last1 = $myrow1['name_last'];
			$name_first1 = $myrow1['name_first'];
			$name_middle1 = $myrow1['name_middle'];
			$contact_type1 = $myrow1['contact_type'];
			} //while
		} //if

		if ($found1 == 1) {
	  	echo "<p><font color=red><b>Sorry. LastName and FirstName entered already on database:</b></font><br>";
	  	echo "<b>$employeeid1 - $name_last1, $name_first1 $name_middle1 - $contact_type1</b></p>";
			if($employeeid1 == "") {
				echo "<form action=\"personneladd3.php?loginid=$loginid\" method=\"post\" name=\"newemployeeid\">";
				echo "<p>You may convert this person to PKII personnel.<br>Please provide a new employee number here <input name=\"newemployeeid\" value=\"$employeeid\">";
				echo "<input type=\"hidden\" name=\"contactid\" value=\"$contactid1\">";
				echo "<input type=\"hidden\" name=\"name_last\" value=\"$name_last\">";
				echo "<input type=\"hidden\" name=\"name_first\" value=\"$name_first\">";
				echo "<input type=\"hidden\" name=\"name_middle\" value=\"$name_middle\">";
				echo "<input type=\"hidden\" name=\"personnel_type\" value=\"$personnel_type\">";
				echo "<input type=\"submit\"></p>";
				echo "</form>";
			}
		} else {

            $res2query=""; $result2="";
			$res2query = "INSERT INTO tblcontact (employeeid, name_last, name_first, name_middle, contact_type) VALUES ('$employeeid', '$name_last', '$name_first', '$name_middle', 'personnel')";
			$result2=$dbh2->query($res2query);
			
			// query leavectg values
			$res4query=""; $result4=""; $found4=0; $ctr4=0;
			$res4query="SELECT idhrtaleavectg, code, name, quota FROM tblhrtaleavectg WHERE idhrtaleavectg<>''";
			$result4=$dbh2->query($res4query);
			if($result4->num_rows>0) {
				while($myrow4=$result4->fetch_assoc()) {
					$found4=1;
					$idhrtaleavectg4 = $myrow4['idhrtaleavectg'];
					$code4 = $myrow4['code'];
					$name4 = $myrow4['name'];
					$quota4 = $myrow4['quota'];
					if($code4=='sick') {
						$lvctgsick=$quota4;
					} else if($code4=='vacation') {
						$lvctgvacation=$quota4;
					} else if($code4=='paternity') {
						$lvctgpater=$quota4;
					} else if($code4=='maternityn') {
						$lvctgmatern=$quota4;
					} else if($code4=='maternityc') {
						$lvctgmaterc=$quota4;
					} else if($code4=='special') {
						$lvctgspecial=$quota4;
					} else if($code4=='aspl') {
						$lvctgaspl=$quota4;
					} //if-else
				} //while
			} //if

			$datenow = date('Y-m-d');

            $res3query=""; $result3="";
			$res3query = "INSERT INTO tblemployee (employeeid, date, employee_type, term_resign, emp_record, vacation, sick, paternity, maternityn, maternityc, special, aspl) VALUES ('$employeeid', '$datenow', '$personnel_type', '0000-00-00', \"active\", $lvctgsick, $lvctgvacation, $lvctgpater, $lvctgmatern, $lvctgmaterc, $lvctgspecial, $lvctgaspl)";
			$result3=$dbh2->query($res3query);

		// create log
    include('datetimenow.php');
	$res16query=""; $result16="";
    $res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
	$result16=$dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
		$adminuid=$myrow16['adminuid'];	
		} //while
	} //if
    $adminlogdetails = "$loginid:$adminloginuid - Add new personnel: $employeeid - $name_last, $name_first $name_middle - $personnel_type";
	$res17query=""; $result17="";
    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
	$result17=$dbh2->query($res17query);

			echo "<p><font color=green><b>New personnel record saved.</b></font></p>";
			echo "employeeid: $employeeid<br>";
			echo "name: $name_last, $name_first $name_middle<br>";
			echo "personneltype: $personnel_type<br>";
			echo "date: $datenow<br></p>";

			echo "<p>Click <a href=personneledit2.php?loginid=$loginid&pid=$employeeid>here</a> to enter more information to currently saved personnel</p>";

			echo "<p><a href=personneledit.php?loginid=$loginid>Back to Manage Personnel</a><br>";

		}

  }

  $message = "New Personnel Added Sucessfully! <br> <a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Click Here to add more infromation to <b>$name_first $name_last</b>!  </a>";
  $_SESSION['success_message_newper'] = $message;
?>
  <script>
		 const employeeid = encodeURIComponent("<?php echo $employeeid; ?>");
		 const loginid = encodeURIComponent("<?php echo $loginid; ?>");
		

		 window.location.href = `personneledit.php?loginid=${loginid}&eid=${employeeid}`;
	 </script>
	   <?php
     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);	 

     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
