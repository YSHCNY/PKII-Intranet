<?php 

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrtapaygrp0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';

$idhrtapaygrp = (isset($_POST['idhrtapaygrp'])) ? $_POST['idhrtapaygrp'] :'';

if($idhrtapaygrp0 != "") { $idhrtapaygrp=$idhrtapaygrp0; }

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
// edit body-header





// start contents here...
// echo "<a class=\"btn mainbtnclr mb-3 text-white\" href=\"hrtimeatt.php?loginid=$loginid\">Back</a>";
include 'timeattmenu.php';

  echo "<div>";

  if($accesslevel >= 3)
  {



		echo "<form action=\"hrtimeattcutoff.php?loginid=$loginid\" method=\"post\" name=\"modhrtacutoff\" class = 'shadow p-5'>";
		// paygroupname dropdown list
		echo "<div class = 'mb-4'><h5 class = 'mb-0 fw-bold pb-0'>Define cut-off period</h5><p>Manage Cutoff period per paygroup</p></div>";
		
	echo "<div class = 'row'>";

	echo "<div class = 'col'>";
		echo "<select name=\"idhrtapaygrp\" class = 'form-select h5' onchange=\"this.form.submit()\">";
		if($idhrtapaygrp == "") { echo "<option value=''>select paygroup</option>"; }
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("SELECT idtblhrtapaygrp, paygroupname FROM tblhrtapaygrp ORDER BY datecreated DESC", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$idtblhrtapaygrp11 = $myrow11[0];
			$paygroupname11 = $myrow11[1];
			if($idtblhrtapaygrp11 == $idhrtapaygrp) { $idhrtapgsel="selected"; } else { $idhrtapgsel=""; }
			echo "<option value=\"$idtblhrtapaygrp11\" $idhrtapgsel>$paygroupname11</option>";
			}
		}
		echo "</select>";
		echo "</div>";


		echo "<div class = 'col'>";
		echo "<button type=\"submit\" class=\"btn mt-3 bg-success text-white\">Submit</button>";
		echo "</div>";

		echo "</div>";

	
		echo "</form>";

	//
	// add function
	//
	echo "<div class = 'shadow border p-4'>";

		echo "<form action=\"hrtimeattcutoffadd.php?loginid=$loginid\" method=\"post\" name=\"modhrtacutoffadd\">";
		$result12=""; $found12=0; $ctr12=0;
		$result12 = mysql_query("SELECT paygroupname FROM tblhrtapaygrp WHERE idtblhrtapaygrp=$idhrtapaygrp", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
			$found12 = 1;
			$paygroupname12 = $myrow12[0];
			}
		}

		echo "<input type=\"hidden\" name=\"idhrtapaygrp\" value=\"$idhrtapaygrp\">";
    	echo "<div class = 'row p-4'>";

    	echo "<div class = 'col text-center'>";
		echo "<input class = 'hidden' name=\"paygroupname\" value=\"$paygroupname12\"><p>Paygroupname:</p>
		<h4>$paygroupname12</h4>";
		echo "</div>";


		// cutstart input
    	echo "<div class = 'col'>";
		echo "Cut-off start:<input type=\"date\" class = 'form-control' name=\"cutstart\" value=\"$datenow\">";
		echo "</div>";

		// cutstart input
    	echo "<div class = 'col'>";
		echo "Cut-off end:<input type=\"date\" class = 'form-control' name=\"cutend\" value=\"$datenow\">";
		echo "</div>";

		// submit button
		echo "<div class = 'col text-center'>";
		echo "<button type=\"submit\" class=\"btn mt-3 text-white bg-success\">Add new cut-off</button>";
    	echo "</div>";

    	echo "</div>";


		echo "</form>";

  } // endif accesslevel >= 4


	//
	// list defined cutoff
	//
	if($idhrtapaygrp != "") {

	echo "<table width=\"100%\" class=\"table table-bordered table-striped\">";
	// query cutoff
	echo "<thead>";
	echo "<tr>";
	echo "<th>Cutoff Start</th>";
	echo "<th>Cutoff End</th>";
	echo "<th>Paygroup Name</th>";
	echo "<th>Action</th>";
	echo "</tr>";

	echo "</thead>";
	echo "<tbody>";

	$result14=""; $found14=0;
	$result14 = mysql_query("SELECT tblhrtacutoff.idhrtacutoff, tblhrtacutoff.cutstart, tblhrtacutoff.cutend, tblhrtacutoff.remarks, tblhrtapaygrp.paygroupname FROM tblhrtacutoff LEFT JOIN tblhrtapaygrp ON tblhrtacutoff.idhrtapaygrp=tblhrtapaygrp.idtblhrtapaygrp WHERE tblhrtapaygrp.idtblhrtapaygrp=$idhrtapaygrp AND status=1 ORDER BY cutstart DESC", $dbh);
	if($result14 != "") {
		while($myrow14 = mysql_fetch_row($result14)) {
		$found14 = 1;
		$idhrtacutoff14 = $myrow14[0];
		$cutstart14 = $myrow14[1];
		$cutend14 = $myrow14[2];
		$remarks14 = $myrow14[3];
		$paygroupname14 = $myrow14[4];
		$ctr14 = $ctr14 + 1;
		echo "<tr><td>".date("M d Y", strtotime($cutstart14))."</td><td>".date("M d Y", strtotime($cutend14))."</td>";
		echo "<td>$paygroupname14</td>";
		echo "<td><a class=\"btn mx-1 text-white bg-warning\" href=\"hrtimeattcutoffedit.php?loginid=$loginid&idpg=$idhrtapaygrp&idct=$idhrtacutoff14\">Edit</a>";
		echo "<a class=\"btn mx-1 text-white bg-danger\" href=\"hrtimeattcutoffdel.php?loginid=$loginid&idpg=$idhrtapaygrp&idct=$idhrtacutoff14\">Delete</a></td>";
		echo "</tr>";
		}
	}
	echo "</tbody>";

	echo "</table>";

	}

// end contents here...

echo "</div>";

// edit body-footer

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
