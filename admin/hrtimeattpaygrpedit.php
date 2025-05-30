<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idtblhrtapaygrp = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
    //  echo "<p><font size=1>Modules >> Time and Attendance >> Pay group</font></p>";

    //  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...


  if($accesslevel >= 4) {
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

		?>


<?php
		echo "<div class = 'text-end mb-5'><a class = 'btn mainbtnclr text-white text-decoration-none' href=\"hrtimeattpaygrp.php?loginid=$loginid\">Back</a></div>";
		echo "<div class = ' '>";
		
		echo "<form action=\"hrtimeattpaygrpedit2.php?loginid=$loginid&idpg=$idtblhrtapaygrp\" method=\"post\" name=\"modhrtapaygrpedit\">";

		?>

		<div class="row gap-4">

		
<?php


		echo "<div class = 'col-lg shadow p-5 '>";
		echo "<h4>Edit pay group <span class ='fw-bold'>($paygroupname11)</span></h4>";
		echo "<div class = 'my-4'>";
		echo "<p class ='text-secondary mb-1'>Pay group name: </p><input class = 'form-control p-3' name=\"paygroupname\" value=\"$paygroupname11\" required>";
		echo "</div>";

		echo "<div class = 'my-4'>";
		echo "<p  class ='text-secondary mb-1'>Description</p>";
		echo "<textarea name=\"remarks\" class = 'form-control p-3'>$remarks11</textarea>";
		echo "</div>";

		echo "<div class = 'text-end'>";
		echo "<button type=\"submit\" class = 'btn bg-success text-white' value=\"Update\">Update</button>";
		echo "</div>";

		

		echo "</form>";
		echo "</div>";
	}

	// echo "<tr><td colspan=\"6\" align=\"center\">Note:&nbsp;<font color=\"red\"><b>*</b></font> - required field</td></tr>";

	
?>





<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Add members to <?php echo $paygroupname11;?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php include 'hrtimeattpaygrpaddemp.php';?>
      </div>
   
    </div>
  </div>
</div>



<?php
	

	echo"<div class = 'col-lg border rounded-3 p-5'>";
	echo "<div class = 'text-end mb-5 mt-3'><button type = 'button' data-toggle='modal' data-target='#exampleModalScrollable' class=\"btn text-white bg-success\">Add members +</button></div>";
	// echo "<form action=\"hrtimeattpaygrpaddemp.php?loginid=$loginid&idpg=$idtblhrtapaygrp\" method=\"post\" name=\"modhrtapaygrpaddemp\">";
	echo "<h4>List of members</h4>";
	// echo "<input type=\"submit\" value=\"add\">";


	
	// echo "</form>";

	echo"<table class ='table table-hover' width = '100%' id = 'edpged'>";
	echo"<thead>";
	echo "<tr>";
	echo "<th>Count</th>";
	echo "<th>Employee Name</th>";
	echo "<th>Employee ID</th>";
	echo "<th>Action</th>";
	echo "</tr>";
	echo"</thead>";

	echo"<tbody>";

	$result12=""; $found12=0; $ctr12=0;
	$result12 = mysql_query("SELECT tblhrtapaygrpemplst.idhrtapaygrpemplst, tblhrtapaygrpemplst.employeeid, tblhrtapaygrpemplst.contactid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.position FROM tblhrtapaygrpemplst INNER JOIN tblemployee ON tblhrtapaygrpemplst.employeeid=tblemployee.employeeid INNER JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtapaygrpemplst.idtblhrtapaygrp=$idtblhrtapaygrp ORDER BY tblcontact.name_last ASC", $dbh);
	if($result12 != "") {
		while($myrow12 = mysql_fetch_row($result12)) {
		$found12 = 1;
		$idhrtapaygrpemplst12 = $myrow12[0];
		$employeeid12 = $myrow12[1];
		$contactid12 = $myrow12[2];
		$name_last12 = $myrow12[3];
		$name_first12 = $myrow12[4];
		$name_middle12 = $myrow12[5];
		$contact_gender12 = $myrow12[6];
		$position12 = $myrow12[7];
		$ctr12 = $ctr12 + 1;
		echo "<tr>";
		echo "<td>$ctr12</td>";
		echo "<td>$employeeid12</td>";
		echo "<td>$name_last12, $name_first12 $name_middle12[0]</td>";
		echo "<td>";
		?>
<a  class = 'btn bg-danger text-white'
    onclick="return confirm('Remove personnel from the list? <?php echo $name_last12; ?>, <?php echo $name_first12; ?> <?php echo $name_middle12[0]; ?>');" 
    href="hrtimeattpaygrpempdel.php?loginid=<?php echo $loginid; ?>&idpg=<?php echo $idtblhrtapaygrp; ?>&idel=<?php echo $idhrtapaygrpemplst12; ?>&eid=<?php echo $employeeid12; ?> ">
    Remove
</a>
		<?php
		echo"</td>";
		echo "</tr>";
		}
	}
	echo"</tbody>";
// end contents here...
echo"</table>";
echo"</div>";



     echo "</div>";

// edit body-footer
     // echo "<p><a href=\"hrtimeattpaygrp.php?loginid=$loginid\">Back</a></p>";
	

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
