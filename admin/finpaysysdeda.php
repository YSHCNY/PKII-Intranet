<?php 
	session_start();

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$employeeid0 = (isset($_GET['eid'])) ? $_GET['eid'] :'';
$tab0 = (isset($_GET['tab'])) ? $_GET['tab'] :'';

$tabinctyp = (isset($_POST['tabinctyp'])) ? $_POST['tabinctyp'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$employeeid = (isset($_POST['empid'])) ? $_POST['empid'] :'';
$geturl = (isset($_GET['frm'])) ? $_GET['frm'] :'';



if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($employeeid0 != "") { $employeeid=$employeeid0; }

$tab0="a";
$tabinctyp="add";

// echo "<p>vartest idpg:$idpaygroup, empid:$employeeid</p>";

$found = 0;


// edit body-header


// start contents here...
// if (isset($_SESSION['success'])) {
// 	echo '<div id="alert" class="alert alert-success fade show" role="alert">'
// 		. $_SESSION['success'] . 
// 		'
// 	</div>';

// 	// Clear the alert after displaying it
// 	unset($_SESSION['success']);
// }
?>
<!-- <script>
	document.addEventListener("DOMContentLoaded", function () {
		const alert = document.getElementById('alert');
		if (alert) {
			setTimeout(() => {
				alert.classList.remove('show');
				alert.classList.add('fade');
			}, 3000); // 3 seconds
		}
	});
</script> -->
<?php
  if($accesslevel >= 4) {




	echo "<div class = ' px-5 '>";

		echo "<form action=\"finpaysysded.php?loginid=$loginid&frm=$geturl\" class = '' method=\"post\" name=\"finpaysysdeda\">";
		echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"add\">";

		echo "<div class = 'row p-4 '>";
		echo "<div class = 'col-lg-5 col-12 '>";
		// pay group name dropdown
    echo "<select name=\"idpaygroup\" class = ' GlobalSelectWx w-100' onchange=\"this.form.submit()\">";
		echo "<option value=''>select paygroup</option>";
		$res11query = "SELECT idtblhrtapaygrp, paygroupname FROM tblhrtapaygrp ORDER BY timestamp DESC";
		$result11=""; $found11=0; $ctr11=0;
		/*
		$result11 = mysql_query("", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
		*/
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$idtblhrtapaygrp11 = $myrow11['idtblhrtapaygrp'];
			$paygroupname11 = $myrow11['paygroupname'];
			if($idtblhrtapaygrp11 == $idpaygroup) { $idpaygrpsel="selected"; } else { $idpaygrpsel=""; }
			echo "<option value=\"$idtblhrtapaygrp11\" $idpaygrpsel>$paygroupname11</option>";
			}
		}
		echo "</select>";

		echo "</div>";


		echo "<div class = 'col-lg-5 col-12'>";

		// individual personnel dropdown
		if($idpaygroup != "") {

		echo "<select name=\"empid\" class = 'GlobalSelectWx w-100' onchange=\"this.form.submit()\">";
		echo "<option value=''>select personnel</option>";
		$res12query = "SELECT tblhrtapaygrpemplst.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrtapaygrpemplst INNER JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtapaygrpemplst.idtblhrtapaygrp=$idpaygroup AND tblcontact.contact_type=\"personnel\"";
		$result12=""; $found12=0;
		/*
		$result12 = mysql_query("", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
		*/
		$result12 = $dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12 = $result12->fetch_assoc()) {
			$found12 = 1;
			$employeeid12 = $myrow12['employeeid'];
			$name_last12 = $myrow12['name_last'];
			$name_first12 = $myrow12['name_first'];
			$name_middle12 = $myrow12['name_middle'];
			if($employeeid12 == $employeeid) { $empidsel="selected"; } else { $empidsel=""; }
			echo "<option value=\"$employeeid12\" $empidsel>$employeeid12 - $name_last12, $name_first12 $name_middle12[0]</option>";
			}
		}
		echo "</select>";

		}
		echo "</div>";
		


		// submit button

		echo "<div class = 'col-lg-2 col-12'>";
		echo "<input type=\"submit\" class = 'btn  py-1 bg-success text-white border'>";
 
		echo "</div>";

		echo "</div>";
		echo "</form>";
		echo "</div>";
		echo "</div>";



  } // endif accesslevel >= 4

	//
	// display individual info based on selected dropdown personnel
	//
	if($idpaygroup=="") {
	$filesrc = "finpaysysded";
	} else {
	$filesrc = "finpaysysdeda"; $tab="a";
	}
	echo "<div class = 'shadow border p-5'>";
	include("finpaysysded2.php");
	echo "</div>";

// end contents here...

    
// edit body-footer
    //  echo "<a class = 'mainbtnclr px-3 py-2 rounded-3 text-white btn' href=\"$filesrc.php?loginid=$loginid&tab=$tab\">Back</a>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 


// mysql_close($dbh);
$dbh2->close();
?> 
