<?php 

// require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idtblhrtapaygrp = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';

// $found = 0;

// if($loginid != "") {
//      include("logincheck.php");
// }

// if ($found == 1) {
//      include ("header.php");
//      include ("sidebar.php");

// edit body-header
    //  echo "<p><font size=1>Modules >> Time and Attendance >> Pay group</font></p>";

    //  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

// echo "<div class ='p-4 shadow'>";
	// echo "<h4 class = 'mb-3'>Add Members</h4>";

  if($accesslevel >= 4)
  {
		// query paygroup details based on id
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("SELECT paygroupname, remarks FROM tblhrtapaygrp WHERE idtblhrtapaygrp=$idtblhrtapaygrp", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$paygroupname11 = $myrow11[0];
			$remarks11 = $myrow11[1];
			}
		}
	//   
	// 	echo "<p class  = 'text-secondary'> Description: <span class = 'text-dark'>$remarks11</span></p>";
	}
	?>
<!-- </div> -->

	<?php

	
	echo "<form action=\"hrtimeattpaygrpaddemp2.php?loginid=$loginid&idpg=$idtblhrtapaygrp\" method=\"post\" name=\"modhrtapaygrpaddemp\" class = 'shadow mt-3 border rounded-3 p-5'>";
	echo "<div class = 'text-center border rounded mb-5 p-2 bg-white row' style = ' position: sticky; z-index: 2;
  top: -10px;'>";
  echo "<div class = 'col'><p class  = 'text-secondary py-2 '>Pay group: <span class = 'text-dark'>$paygroupname11</span></p></div>";
	echo "<div class = 'col py-2'><button type=\"submit\"  class=\"btn bg-success text-white\">Add selected</button></div>";
	echo "</div>";

	echo "<div class =' '>";
	echo "<table class ='table table-hover table-striped table-bordered' id = 'addedgp' style = 'z-index: -1;'>";
	// echo "<tr><td>select from list</td>";
	echo "<thead>";
	echo "<tr>";
	
	echo "<th align = 'center' class = 'h5 text-secondary'>ID Number</th>";
	echo "<th align = 'center' class = 'h5 text-secondary'>Name</th>";
	echo "<th align = 'center' class = 'h5 text-secondary'>status</th>";
	// echo "<th align = 'center' class = 'h5 text-secondary'>Check if Flexi</th>";

	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

	$result12=""; $found12=0; $ctr12=0;
	$result12 = mysql_query("SELECT tblemployee.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblemployee.emp_status, tblemployee.employee_type, tblemployee.emp_record FROM tblemployee INNER JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE emp_record = 'active' ORDER BY tblcontact.name_last ASC", $dbh);
	if($result12 != "") {
		while($myrow12 = mysql_fetch_row($result12)) {
		$found12 = 1;
		$employeeid12 = $myrow12[0];
		$name_last12 = $myrow12[1];
		$name_first12 = $myrow12[2];
		$name_middle12 = $myrow12[3];
		$emp_status12 = $myrow12[4];
		$employee_type12 = $myrow12[5];
		$emp_record12 = $myrow12[6];
		$ctr12 = $ctr12 + 1;
		// query tblhrtapaygrpemplst if employeeid exists and check selected
		$result14=""; $found14=0; $ctr14=0;
		$result14 = mysql_query("SELECT idhrtapaygrpemplst, employeeid FROM tblhrtapaygrpemplst WHERE idtblhrtapaygrp=$idtblhrtapaygrp AND employeeid=\"$employeeid12\"", $dbh);
		if($result14 != "") {
			while($myrow14 = mysql_fetch_row($result14)) {
			$found14 = 1;
			$idhrtapaygrpemplst14 = $myrow14[0];
			$employeeid14 = $myrow14[1];
			}
		}
		if($found14 == 1) { $empidsel="checked"; } else { $empidsel=""; }
		if($emp_record12 == "active") {
		echo "<tr>";
		// echo "<td>$ctr12</td>";
		echo "<td ><input type=\"checkbox\" name=\"employeeid[]\" value=\"$employeeid12\" $empidsel> $employeeid12</td>";
		echo "<td >$name_last12, $name_first12 $name_middle12[0]</td>";
		echo "<td >$emp_status12</td>";
		// echo "<td ><input type=\"checkbox\" name=\"cflexi[]\" value=\"$employeeid12\" >Flexi Time</td>";

		echo "</tr>";
		} 
		
		
		else if($emp_record12 == "inactive") {
		echo "<tr>";
		// echo "<td>$ctr12</td>";
		echo "<td><input type=\"checkbox\" name=\"employeeid[]\" value=\"$employeeid12\" $empidsel>$employeeid12</td>";
		echo"<td><font color=\"gray\">$name_last12, $name_first12 $name_middle12[0]</font></td>";
		echo "<td><font color=\"gray\">$emp_status12</font></td>";
		echo "</tr>";
		}
		}
	}

	echo "</tr>";
	echo "</tbody>";
	echo "</table>";
	echo "</div>";


	echo "</form>";
	
	


// end contents here...

   

// edit body-footer
     // echo "<p><a href=\"hrtimeattpaygrpedit.php?loginid=$loginid&idpg=$idtblhrtapaygrp\">Back</a></p>";
	//  echo "<p><button type=\"button\" class=\"btn btn-default\"><a href=\"hrtimeattpaygrpedit.php?loginid=$loginid&idpg=$idtblhrtapaygrp\">Back</a></button></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

//      include ("footer.php");
// } else {
//      include("logindeny.php");
// }

// mysql_close($dbh);
// $dbh2->close();
?> 

<!-- <script type="text/javascript">
	$(document).ready(function(){

	});

	function myFunction() {
	  var input, filter, table, tr, td, i, txtValue;
	  input = document.getElementById("myInput");
	  filter = input.value.toUpperCase();
	  table = document.getElementById("myTable");
	  tr = table.getElementsByTagName("tr");
	  for (i = 0; i < tr.length; i++) {
	    td = tr[i].getElementsByTagName("td")[2];
	    if (td) {
	      txtValue = td.textContent || td.innerText;
	      if (txtValue.toUpperCase().indexOf(filter) > -1) {
	        tr[i].style.display = "";
	      } else {
	        tr[i].style.display = "none";
	      }
	    }       
	  }
	}
</script> -->
<style type="text/css">
	#myInput {
  width: 100%;
  font-size: 12px;
  padding: 12px 20px 12px 20px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}
</style>