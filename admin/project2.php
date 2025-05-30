<div class="modal fade mb-5" id="exampleModalLong" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title poppins" id="exampleModalLongTitle">New Project Listing</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-5">
        <?php include 'addproject.php'; ?>
      </div>
    </div>
  </div>
</div>


<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$company_type = $_POST['company_type'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");
	?>



<div class="p-5 shadow rounded-3 border">


<?php
	 echo "<p class = 'fw-bold fs-4 mb-0'>PKII Projects Listing</p>";
	 echo "<p class = 'text-muted fs-6'>Manage project listings</p>";
	 echo "<div class = 'text-end my-3'>";
	echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
	+ New Project
  </button>';
	echo "</div>";


	echo "<form action=projects.php?loginid=$loginid method=POST>";
 

	$result = mysql_query("SELECT tblproject1.projectid, tblproject1.proj_num, tblproject1.proj_code, tblproject1.proj_fname, tblproject1.proj_sname, tblproject1.proj_services, tblproject1.proj_period, tblproject1.proj_duty, tblproject1.sw_nk, tblproject1.sw_jica, tblproject1.sw_icg, tblproject1.proj_relation0, tblproject1.proj_relation1, tblproject1.proj_relation2, tblproject1.proj_relation3, tblproject1.proj_class FROM tblproject1 ORDER BY tblproject1.proj_code DESC, tblproject1.proj_period DESC, tblproject1.date_start DESC", $dbh);
	echo "<div class = 'table-responsive'><table class = 'table-hover table-striped table-bordered' id = 'project2' style='width:100%'>";

		echo"<thead class = 'fs-5 text-muted'>";
		echo "<tr>";
		echo "<th>Project Code</th>";
		echo "<th>Acronym</th>";
		echo "<th>Project Name</th>";
		echo "<th>Services</th>";
		echo "<th>Period</th>";
		echo "<th>Relationship</th>";
		echo "<th>Classification</th>";
		echo "<th>Details</th>";
		echo "<th>Info</th>";
		echo "<th>Edit</th>";
		echo "</tr>";
		echo "</thead>";

		echo "<tbody>";
     while ($myrow = mysql_fetch_row($result))
     {
          $pid = $myrow[0];
          $proj_num = $myrow[1];
          $proj_code = $myrow[2];
	  $proj_fname = $myrow[3];
	  $proj_sname = $myrow[4];
	  $proj_services = $myrow[5];
	  $proj_period = $myrow[6];
	  $proj_duty = $myrow[7];
		$sw_nk = $myrow[8];
		$sw_jica = $myrow[9];
		$sw_icg = $myrow[10];
		$proj_relation0 = $myrow[11];
		$proj_relation1 = $myrow[12];
		$proj_relation2 = $myrow[13];
		$proj_relation3 = $myrow[14];
		$proj_class = $myrow[15];
		
    	echo "<tr>";
		echo "<td>$proj_code</td>";
		echo "<td>$proj_sname</td>";
		echo "<td>$proj_fname</td>";
		echo "<td>$proj_services</td>";
		echo "<td>$proj_period</td>";
		// echo "<td>$proj_duty</td>";
		echo "<td>";
		/*
		if($sw_nk == 1) { echo "NK&nbsp;&nbsp;"; } 
		if($sw_jica == 1) { echo "JICA&nbsp;&nbsp;"; }
		if($sw_icg == 1) { echo "ICG"; }
		*/

		if(($proj_relation0 != "") || ($proj_relation0 != "-")) {
			if(($proj_relation1 != "") || ($proj_relation1 != "-")) {
				$result6=""; $found6=0;
				$result6 = mysql_query("SELECT name FROM tblprojrelref WHERE code=\"$proj_relation1\" AND level=1", $dbh);
				if($result6 != "") {
					while($myrow6 = mysql_fetch_row($result6)) {
					$found6 = 1;
					$name6 = $myrow6[0];
					}
				}
				if($proj_relation0 == "others") { echo "$name6"; }

				if(($proj_relation2 != "") || ($proj_relation2 != "-")) {
					$result7=""; $found7=0;
					$result7 = mysql_query("SELECT name FROM tblprojrelref WHERE code=\"$proj_relation2\" AND level=2 LIMIT 1", $dbh);
					if($result7 != "") {
						while($myrow7 = mysql_fetch_row($result7)) {
						$found7=1;
						$name7 = $myrow7[0];
						echo "$name7";
						}
					}

					if(($proj_relation3 != "") || ($proj_relation3 != "-")) {
						$result8=""; $found8=0;
						$result8 = mysql_query("SELECT name FROM tblprojrelref WHERE code=\"$proj_relation3\" AND level=3 LIMIT 1", $dbh);
						if($result8 != "") {
							while($myrow8 = mysql_fetch_row($result8)) {
							$found8 = 1;
							$name8 = $myrow8[0];
							echo " - $name8";
							}
						}
					}
				}
			}
		}
		echo "</td>";

		echo "<td>$proj_class</td>";
		echo "<td>";
		echo "<a class = 'px-3 py-2 rounded-3 bg-primary rounded-3 text-white' href = projectManagement.php?pid=$pid&loginid=$loginid target=_blank><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clipboard2-data' viewBox='0 0 16 16'>
		<path d='M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z'/>
		<path d='M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5'/> <path d='M10 7a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm4-3a1 1 0 0 0-1 1v3a1 1 0 1 0 2 0V9a1 1 0 0 0-1-1'/></svg></a>";
		echo "</td>";


echo "<td>";
    	echo "<a class = 'px-3 py-2 rounded-3 bg-primary text-white' href = moreinfoproj.php?pid=$pid&loginid=$loginid target=_blank><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-card-list' viewBox='0 0 16 16'>
		<path d='M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z'/>
		<path d='M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0'/>
	  </svg>
	  </a>";
	  echo "</td>";


echo "<td>";
	  	echo "<a class = 'px-3 py-2 rounded-3 bg-success text-white' href = editproj.php?pid=$pid&loginid=$loginid><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
		  <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
		  <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
		</svg>
		</a>";
		echo "</td>";
	  	echo "</tr>";
	
     }
	 echo "</tbody>";
     echo "</table></div>";
	 ?>
</div>

<div class="d-flex justify-content-end mt-5">
	<a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
		<button class="border-0 rounded-3" style="width: 170px; height: 40px; background-color: #0a1d44;">Back</button>
	</a>
</div>

<?php



     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
